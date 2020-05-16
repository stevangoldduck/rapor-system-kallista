<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Department extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();

		$this->load->helper(array('url','date'));

		$this->load->library(array('template','form_validation'));

		$this->load->model(array("user_model","department_model"));
		
		if ($this->user_model->isNotAuthenticated()) redirect(site_url('/'));
	}

	public function index()
	{
		$this->template->set('title', 'Department | Dashboard');
		$this->template->load('app', 'contents', 'department/index.php', []);
		$this->template->push_js('push_js', 'department/scripts/datatable.php');
	}

	public function create()
	{
		$this->template->set('title', 'Department Create | Dashboard');
		$this->template->load('app', 'contents', 'subject_group/create.php', ['view_type' => 'create']);
	}

	public function list_dp()
	{
		$dp = new Department_model();
		return $dp->department_datatable();
	}

	public function edit($id)
	{
		$dp = new Department_model();
		$data = $dp->findDepartmentById($id);
		

		$this->template->set('title', 'Department Edit | Dashboard');
		$this->template->load('app', 'contents', 'department/edit.php', $data);
	}

	public function formAction()
	{
		if($this->input->post('action_type') == "update")
		{
			$id = $this->input->post('dp_id');

			$sg = new Department_model();
			$data = $sg->findDepartmentById($id);

			if($data['department_name'] !=  $this->input->post('dp_name'))
			{
				$is_unique_name = '|is_unique[departments.department_name]';
			}
			else{
				$is_unique_name = '';
			}
		}
		else{
			$is_unique_name = '|is_unique[departments.department_name]';
		}
		
		$this->form_validation->set_rules('dp_name', 'Department Name', 'required'.$is_unique_name);

		$data = array(
			'department_name' => $this->input->post('dp_name'),
		);

		if($this->form_validation->run() != false){
			if($this->input->post('action_type') == "update")
			{
				if($this->department_model->edit($id,$data))
				{
					$this->session->set_flashdata('success', 'Record updated!!');
					$this->edit($id);
				}
			}
			else{
				if($this->department_model->insert($data))
				{
					$this->session->set_flashdata('success', 'Record saved!!');
					$this->create();
				}
			}
		}
		else{
			if($this->input->post('action_type') == "update"){
				$this->edit($id);
			}
			else{
				$this->create();
			}
		}
	}
}
