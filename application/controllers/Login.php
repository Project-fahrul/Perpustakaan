<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Login extends CI_Controller
{
    private $me;
    public function __construct()
    {
        parent::__construct();
        $this->load->library(array('session'));
        $this->load->helper(array('url'));
        $this->load->model('admin_model');

        
         //load data session
         $nim = $this->session->userdata("nim");
         $email = $this->session->userdata("email");
 
         //check if data session is exist
         if(!isset($nim) || !isset($email)){
             return;
         }
         
         // load data admin from database by email and nim
         $this->me = $this->admin_model->checkAdminByEmaiAndNim($email, $nim);

    }

    public function index()
    {         
         //check data admin if it have been set
         if(!is_null($this->me)){
             redirect($this->config->config['base_url'].'dashboard');
             return;
         }

        //create data objeck
        $data = new stdClass();

        //set title and body class in view login
        $data->title = "Login";
        $data->body_class = 'hold-transition login-page';

        //load form helper and validation
        $this->load->helper('form');
        $this->load->library('form_validation');

        //set validation rules
        $this->form_validation->set_rules('email', "Email", "required");
        $this->form_validation->set_rules('password', "Password", "required");

        //check validation
        if ($this->form_validation->run()) {
            //check mahasiswa in database
            $admin = $this->admin_model->checkAdminByEmailPassword($this->input->post("email"), 
                $this->input->post("password"));

            if (!is_null($admin)) {
                $this->session->set_userdata([
                    "nim" => $admin->nim,
                    "email" => $admin->email
                ]);
                redirect($this->config->config['base_url'] . "dashboard");
            } else
            $data->error = "Email or Password invalid";
        }else if($this->input->method() == 'post'){
            $data->error = validation_errors();
        }

        $this->load->view('header', $data);
        $this->load->view('login/index');
        $this->load->view('footer');
    }

    public function register()
    {
        //create data objeck
        $data = new stdClass();

        //set title and body class in view register
        $data->title = "Register";
        $data->body_class = 'hold-transition register-page';

        //load form helper and form validation library
        $this->load->helper('form');
        $this->load->library('form_validation');

        //set validate rules
        $this->form_validation->set_rules("nim", "Nim", "required");
        $this->form_validation->set_rules("kelas", "Kelas", "required");
        $this->form_validation->set_rules("fullname", "Nama", "required");
        $this->form_validation->set_rules("prodi", "Prodi", "required");
        $this->form_validation->set_rules("email", "Email", "required");
        $this->form_validation->set_rules("password", "Password", "required");
        $this->form_validation->set_rules("re-password", "Re Password", "required|matches[password]");

        //run form validation
        if($this->form_validation->run()){
            // validation is valid, then get form data
            $nim = $this->input->post('nim');
            $kelas    = $this->input->post('kelas');
            $nama = $this->input->post('fullname');
            $email    = $this->input->post('email');
            $password = $this->input->post('password');
            $prodi = $this->input->post('prodi');
            
            $this->admin_model->registerAdmin($email, $password, $nim, $nama, $kelas, $prodi);
            redirect($this->config->config['base_url']);
        }else if($this->input->method() == 'post'){
          $data->error = validation_errors();
        }

        $this->load->view('header', $data);
        $this->load->view('login/register');
        $this->load->view('footer');
    }

    public function signout(){
        if(!is_null($this->me)){
            $this->session->unset_userdata(["nim",'email']);
        }
        redirect($this->config->config['base_url']);
    } 
}
