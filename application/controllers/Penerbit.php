<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Penerbit extends CI_Controller
{
    private $me;
    public function __construct()
    {
        parent::__construct();
        $this->load->library(array('session'));
        $this->load->helper(array('url'));
        $this->load->model('admin_model');
        $this->load->model('penerbit_model');

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
        $this->form_validation->set_rules('kode', "Kode Penerbit", "required");
        $this->form_validation->set_rules('penerbit', "Penerbit", "required");

        //run validation
        if ($this->form_validation->run()) {
            $email =  $this->input->post("action");
            $kode =  $this->input->post("kode");
            $penerbit =  $this->input->post("penerbit");

            if ($this->input->post("action") == 'add') {
                $query = $this->penerbit_model->insert(
                    $kode,
                    $penerbit
                );
            }else if($this->input->post("action") == 'edit'){
                $query = $this->penerbit_model->update(
                    $this->input->post("id"),
                    $kode,
                    $penerbit
                );
            }

            redirect($this->config->config['base_url'].'penerbit');
        }

         //create data objeck
         $data = new stdClass();

         //set title and body class in view register
         $data->title = "Dashboard";
         $data->body_class = 'hold-transition sidebar-mini layout-fixed';
         $data->greeting = "Data Penerbit";
         $data->page = "Penerbit";
         $data->admin = $this->me;
         $data->title = "Buku";
         $data->template = "table_penerbit";


        //call view
        $this->load->view('header', $data);
        $this->load->view('dashboard/navbar');
        $this->load->view('dashboard/sidebar', $data);
        $this->load->view('dashboard/main_page', $data);
        $this->load->view('dashboard/js_script');
        $this->load->view('footer');
    } 

    public function list(){
        $data = $this->penerbit_model->get();
        return $this->output
            ->set_content_type('application/json')
            ->set_status_header(200)
            ->set_output(json_encode($data));       
    }

    public function delete(){
        $id = $this->input->get('id', true);
        if(isset($id)){
            $res = $this->penerbit_model->delete($id);
            if(!$res)
                $this->session->set_flashdata('error', 'Error delete penerbit');
        }
        redirect($this->config->config['base_url'].'penerbit');
    }
}