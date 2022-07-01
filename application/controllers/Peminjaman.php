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
        $this->load->model('penerbit_model');
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
        $this->form_validation->set_rules('judul', "Judul", "required");
        $this->form_validation->set_rules('pengarang', "Pengarang", "required");
        $this->form_validation->set_rules('jumlah', "Jumlah", "required");
        $this->form_validation->set_rules('penerbit', "Penerbit", "required");

        if ($this->form_validation->run()) {
            $action = $this->input->post('action');
            $id = $this->input->post('id');
            $judul = $this->input->post('judul');
            $pengarang = $this->input->post('pengarang');
            $jumlah = $this->input->post('jumlah');
            $penerbit = $this->input->post('penerbit');

            if ($action == 'add') {
                $this->buku_model->insert(
                    $judul,
                    $jumlah,
                    $pengarang,
                    $penerbit
                );
            } else if ($action == 'edit') {
                $this->buku_model->update(
                    $id,
                    $judul,
                    $jumlah,
                    $pengarang,
                    $penerbit
                );
            }
            redirect($this->config->config['base_url'] . 'buku');
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
        $data = $this->buku_model->get();
        foreach($data as $d){
            $d->penerbit = $this->penerbit_model->findById($d->penerbit)->penerbit_buku;
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
            $res = $this->buku_model->delete($id);
            if(!$res)
                $this->session->set_flashdata('error', 'Error delete buku');
        }
        redirect($this->config->config['base_url'].'buku');
    }
}
