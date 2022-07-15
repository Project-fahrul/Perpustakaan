<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Mahasiswa extends CI_Controller
{
    private $me;
    public function __construct()
    {
        parent::__construct();
        $this->load->library(array('session'));
        $this->load->helper(array('url'));
        $this->load->model('mahasiswa_model');

        //load data session
        $nim = $this->session->userdata("nim");
        $email = $this->session->userdata("email");

        //check if data session is exist
        if (!isset($nim) || !isset($email)) {
            redirect($this->config->config['base_url']);
        }

        // load data admin from database by email and nim
        $this->me = $this->mahasiswa_model->checkMahasiswaByEmaiAndNim($email, $nim);

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
        $this->form_validation->set_rules('email', "Email", "required");
        $this->form_validation->set_rules('name', "Name", "required");
        $this->form_validation->set_rules('nim', "NIM", "required");
        $this->form_validation->set_rules('born', "Tanggal Lahir", "required");
        $this->form_validation->set_rules('kelas', "Kelas", "required");
        $this->form_validation->set_rules('prodi', "Prodi", "required");
        $this->form_validation->set_rules('action', "Action", "required");
        $this->form_validation->set_rules('id', "ID", "required");

        //run validation
        if ($this->form_validation->run()) {
            $email =  $this->input->post("email");
            $name =  $this->input->post("name");
            $nim =  $this->input->post("nim");
            $born =  $this->input->post("born");
            $kelas =  $this->input->post("kelas");
            $prodi =  $this->input->post("prodi");

            if ($this->input->post("action") == 'add') {
                $query = $this->mahasiswa_model->insert(
                    $name,
                    $email,
                    $nim,
                    $kelas,
                    $prodi,
                    $born
                );
            }else if($this->input->post("action") == 'edit'){
                $query = $this->mahasiswa_model->update(
                    $this->input->post("id"),
                    $name,
                    $email,
                    $nim,
                    $kelas,
                    $prodi,
                    $born
                );
            }

            redirect($this->config->config['base_url'].'mahasiswa');
        }

         //create data objeck
         $data = new stdClass();

         //set title and body class in view register
         $data->title = "Dashboard";
         $data->body_class = 'hold-transition sidebar-mini layout-fixed';
         $data->greeting = "Data Mahasiswa";
         $data->page = "Mahasiswa";
         $data->admin = $this->me;
         $data->title = "Mahasiswa";
         $data->template = "table_mahasiswa";


        //call view
        $this->load->view('header', $data);
        $this->load->view('dashboard/navbar');
        $this->load->view('dashboard/sidebar', $data);
        $this->load->view('dashboard/main_page', $data);
        $this->load->view('dashboard/js_script');
        $this->load->view('footer');
    } 

    public function list(){
        $data = $this->mahasiswa_model->get_Rolemahasiswa();
        return $this->output
            ->set_content_type('application/json')
            ->set_status_header(200)
            ->set_output(json_encode($data));       
    }

    public function delete(){
        $id = $this->input->get('id', true);
        if(isset($id)){
            $this->mahasiswa_model->delete($id);
        }
        redirect($this->config->config['base_url'].'mahasiswa');
    }
}