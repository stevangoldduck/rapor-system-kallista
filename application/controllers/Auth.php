<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

    public function __construct() {
        parent::__construct();
		$this->load->helper('url');
		$this->load->library('template');
		$this->load->model("user_model");
        $this->load->library('form_validation');
	}
	
	public function index()
	{
		$this->template->set('title','Login');
		$this->template->load('auth','contents','auth/login.php',[]);

	}

	public function login()
	{
		$this->form_validation->set_rules('username', 'username', 'required');
		$this->form_validation->set_rules('password', 'password', 'required');
		
        if($this->form_validation->run() != false){
			if($this->user_model->doLogin())
			{
				redirect(site_url('dashboard'));
			}
			else{
				$this->session->set_flashdata('err_credentials', 'Wrong credentials!!');
				redirect(site_url('/'));
			}
		}
		else{
			$this->index();
		}
	}

	public function logout()
	{
		$this->session->sess_destroy();
        redirect(site_url('/'));
	}
}
