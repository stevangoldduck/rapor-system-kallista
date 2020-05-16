<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->library('template');
		$this->load->model("user_model");
		$this->load->library('form_validation');

		if ($this->user_model->isNotAuthenticated()) redirect(site_url('/'));
	}

	public function index()
	{
		$this->template->set('title', 'Home | Dashboard');
		$this->template->load('app', 'contents', 'dashboard/index.php', []);
	}
}
