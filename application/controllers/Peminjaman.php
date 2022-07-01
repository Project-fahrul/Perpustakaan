<?php

class Peminjaman extends CI_Controller
{

    private $me;
    public function __construct()
    {
        parent::__construct();
        $this->load->library(array('session'));
        $this->load->helper(array('url'));
        $this->load->model('admin_model');
        $this->load->model('buku_model');
        $this->load->model('mahasiswa_model');
        $this->load->model('peminjaman_model');

        //load data session
        $nim = $this->session->userdata("nim");
        $email = $this->session->userdata("email");

        //check if data session is exist
        if (!isset($nim) || !isset($email)) {
            redirect($this->config->config['base_url']);
        }

        // load data admin from database by email and nim
        $this->me = $this->admin_model->checkAdminByEmaiAndNim($email, $nim);

        //check data admin if it have been set
        if (is_null($this->me)) {
            redirect($this->config->config['base_url']);
        }
    }


    public function index()
    {
        //load form helper and validation
        $this->load->helper('form');
        $this->load->library('form_validation');

        //set validation rules
        $this->form_validation->set_rules('action', "Action", "required");
        $this->form_validation->set_rules('id', "id", "required");
        $this->form_validation->set_rules('id_peminjaman', "Judul", "required");
        $this->form_validation->set_rules('mahasiswa', "Pengarang", "required");
        $this->form_validation->set_rules('buku', "Jumlah", "required");
        $this->form_validation->set_rules('tanggal_pinjam', "Penerbit", "required");
        $this->form_validation->set_rules('tanggal_kembali', "Penerbit", "required");

        if ($this->form_validation->run()) {
            $action = $this->input->post('action');
            $id = $this->input->post('id');
            $id_peminjaman = $this->input->post('id_peminjaman');
            $mahasiswa = $this->input->post('mahasiswa');
            $buku = $this->input->post('buku');
            $tanggal_pinjam = $this->input->post('tanggal_pinjam');
            $tanggal_kembali = $this->input->post('tanggal_kembali');

            if ($action == 'add') {
                $this->peminjaman_model->insert(
                    $id_peminjaman,
                    $mahasiswa,
                    $buku,
                    $tanggal_pinjam,
                    $tanggal_kembali
                );
            } else if ($action == 'edit') {
                $this->peminjaman_model->update(
                    $id,
                    $id_peminjaman,
                    $mahasiswa,
                    $buku,
                    $tanggal_pinjam,
                    $tanggal_kembali
                );
            }
            redirect($this->config->config['base_url'] . 'peminjaman');
        }

        //create data objeck
        $data = new stdClass();

        //set title and body class in view register
        $data->title = "Dashboard";
        $data->body_class = 'hold-transition sidebar-mini layout-fixed';
        $data->greeting = "Data Peminjaman";
        $data->page = "Peminjaman";
        $data->admin = $this->me;
        $data->title = "Peminjaman";
        $data->template = "table_peminjaman";

        //call view
        $this->load->view('header', $data);
        $this->load->view('dashboard/navbar');
        $this->load->view('dashboard/sidebar', $data);
        $this->load->view('dashboard/main_page', $data);
        $this->load->view('dashboard/js_script');
        $this->load->view('footer');
    }

    public function list(){
        $res = [];
        $data = $this->peminjaman_model->get();
        foreach($data as $d){
            $d->mahasiswa = $this->mahasiswa_model->findById($d->mahasiswa)->fullname;
            $d->buku = $this->buku_model->findById($d->buku)->judul;
            array_push($res, $d);
        }
        return $this->output
            ->set_content_type('application/json')
            ->set_status_header(200)
            ->set_output(json_encode($res));       
    }

    public function delete(){
        $id = $this->input->get('id', true);
        if(isset($id)){
            $res = $this->peminjaman_model->delete($id);
            if(!$res)
                $this->session->set_flashdata('error', 'Error delete peminjaman');
        }
        redirect($this->config->config['base_url'].'peminjaman');
    }
}
