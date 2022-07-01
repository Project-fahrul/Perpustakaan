<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller{

    private $me;
    public function __construct()
    {
        parent::__construct();
        $this->load->library(array('session'));
        $this->load->helper(array('url'));
        $this->load->model('admin_model');
        $this->load->model('mahasiswa_model');
        $this->load->model('penerbit_model');
        $this->load->model('buku_model');
        $this->load->model('peminjaman_model');

        //load data session
        $nim = $this->session->userdata("nim");
        $email = $this->session->userdata("email");

        //check if data session is exist
        if(!isset($nim) || !isset($email)){
            redirect($this->config->config['base_url']);
        }

        // load data admin from database by email and nim
        $this->me = $this->admin_model->checkAdminByEmaiAndNim($email, $nim);
        
        //check data admin if it have been set
        if(is_null($this->me)){
            redirect($this->config->config['base_url']);
        }
    }

    public function index(){
         //create data objeck
        $data = new stdClass();

        //set title and body class in view register
        $data->title = "Dashboard";
        $data->body_class = 'hold-transition sidebar-mini layout-fixed';
        $data->greeting = "Welcome To Perpustakaan Kampus";
        $data->page = "Dashboard";
        $data->admin = $this->me;

        //call view
        $this->load->view('header', $data);
        $this->load->view('dashboard/navbar');
        $this->load->view('dashboard/sidebar', $data);
        $this->load->view('dashboard/index', $data);
        $this->load->view('dashboard/js_script');
        $this->load->view('footer');
    }
}