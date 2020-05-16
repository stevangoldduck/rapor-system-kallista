<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Teachers extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();

		$this->load->helper(array('url','date'));

		$this->load->library(array('template','form_validation'));

		$this->load->model(array("user_model","teacher_model","department_model"));
		
		if ($this->user_model->isNotAuthenticated()) redirect(site_url('/'));
	}

	public function index()
	{
		$this->template->set('title', 'Teachers | Dashboard');
		$this->template->load('app', 'contents', 'teachers/index.php', []);
		$this->template->push_js('push_js', 'teachers/scripts/datatable.php');
	}

	public function create()
	{
		$this->template->set('title', 'Teacher Create | Dashboard');
		$this->template->load('app', 'contents', 'teachers/create.php', ['view_type' => 'create','departments' => $this->department_model->getAllDepartment()]);
	}

	public function list_teacher()
	{
		$teacher = new Teacher_model();
		return $teacher->teacher_datatable();
	}

	public function edit($id)
	{
		$teacher = new Teacher_model();
		$data = $teacher->findTeacherById($id);
		$data['departments'] = $this->department_model->getAllDepartment();

		$this->template->set('title', 'Teacher Edit | Dashboard');
		$this->template->load('app', 'contents', 'teachers/edit.php', $data);
	}

	public function formAction()
	{
		if($this->input->post('action_type') == "update")
		{
			$id = $this->input->post('teacher_id');

			$teacher = new Teacher_model();
			$data = $teacher->findTeacherById($id);

			if($data['teacher_nip'] !=  $this->input->post('nip'))
			{
				$is_unique_nip = '|is_unique[teachers.teacher_nip]';
			}
			else{
				$is_unique_nip = '';
			}
		}
		else{
			$is_unique_nip = '|is_unique[teachers.teacher_nip]';
		}
		
		$this->form_validation->set_rules('nip', 'NIP', 'required'.$is_unique_nip);
		$this->form_validation->set_rules('name', 'name', 'required');
		$this->form_validation->set_rules('department', 'department', 'required');

		$this->form_validation->set_rules('username', 'username', 'required');
		$this->form_validation->set_rules('password', 'password', 'required');

		$data_ = array(
			'teacher_name' => $this->input->post('name'),
			'teacher_email' => $this->input->post('email'),
			'teacher_phone' => $this->input->post('phone'),
			'teacher_address' => $this->input->post('address'),
			//'teacher_user_id' => $data['teacher_user_is'] ?  $data['teacher_user_is'] : null,
			'teacher_nip' => $this->input->post('nip'),
			'teacher_department_id' => $this->input->post('department'),
		);

		if($this->form_validation->run() != false){
			if($this->input->post('action_type') == "update")
			{
				if($this->teacher_model->edit($id,$data_))
				{
					$this->session->set_flashdata('success', 'Record saved!!');
					$this->edit($id);
				}
			}
			else{
				$data_user = array(
					'username' => $this->input->post('username'),
					'password' => password_hash($this->input->post('password'), PASSWORD_BCRYPT),
					'role' => 1,
					'name' => $data_['teacher_name'],
					'email' => $data_['teacher_email'],
					'phone' => $data_['teacher_phone'],
					'address' => $data_['teacher_address']
				);
				$user_id = $this->user_model->insert($data_user);
				$data_['teacher_user_id'] = $user_id;
				
				if($this->teacher_model->insert($data_))
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
