<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Students extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();

		$this->load->helper(array('url','date'));

		$this->load->library(array('template','form_validation'));

		$this->load->model(array("user_model","student_model"));
		
		if ($this->user_model->isNotAuthenticated()) redirect(site_url('/'));
	}

	public function index()
	{
		$this->template->set('title', 'Students | Dashboard');
		$this->template->load('app', 'contents', 'students/index.php', []);
		$this->template->push_js('push_js', 'students/scripts/datatable.php');
	}

	public function create()
	{
		$this->template->set('title', 'Students Create | Dashboard');
		$this->template->load('app', 'contents', 'students/create.php', ['view_type' => 'create']);
	}

	public function list_student()
	{
		$user = new Student_model();
		return $user->student_datatable();
	}

	public function edit($id)
	{
		$student = new Student_model();
		$data = $student->findStudentById($id);
		

		$this->template->set('title', 'Student Edit | Dashboard');
		$this->template->load('app', 'contents', 'students/edit.php', $data);
	}

	public function formAction()
	{
		if($this->input->post('action_type') == "update")
		{
			$id = $this->input->post('student_id');

			$student = new Student_model();
			$data = $student->findStudentById($id);

			if($data->student_nis !=  $this->input->post('nis'))
			{
				$is_unique_nis = '|is_unique[students.student_nis]';
			}
			else{
				$is_unique_nis = '';
			}

			if($data->student_nisn != $this->input->post('nisn'))
			{
				$is_unique_nisn = '|is_unique[students.student_nisn]';
				
			}
			else{
				$is_unique_nisn = '';
			}

		}
		else{
			$is_unique_nis = '|is_unique[students.student_nis]';
			$is_unique_nisn = '|is_unique[students.student_nisn]';
		}
		
		$this->form_validation->set_rules('nis', 'NIS', 'required'.$is_unique_nis);
		$this->form_validation->set_rules('nisn', 'NISN', 'required'.$is_unique_nisn);
		$this->form_validation->set_rules('name', 'name', 'required');
		$this->form_validation->set_rules('department', 'department', 'required');

		$data = array(
			'student_name' => $this->input->post('name'),
			'student_email' => $this->input->post('email'),
			'student_phone' => $this->input->post('phone'),
			'student_address' => $this->input->post('address'),
			'student_nis' => $this->input->post('nis'),
			'student_nisn' => $this->input->post('nisn'),
			'student_pob' => $this->input->post('pob'),
			'student_dob' => $this->input->post('dob'),
			'student_department_id' => $this->input->post('department'),
			'student_father_name' => $this->input->post('f_name'),
			'student_father_phone' => $this->input->post('f_phone'),
			'student_father_address' => $this->input->post('f_address'),
			'student_mother_name' => $this->input->post('m_name'),
			'student_mother_phone' => $this->input->post('m_phone'),
			'student_mother_address' => $this->input->post('m_address'),
			'student_modified_at' => now(),
			'student_modified_by' => $this->user_model->getAuthUser()->id,
		);

		if($this->form_validation->run() != false){
			if($this->input->post('action_type') == "update")
			{
				if($this->student_model->edit($id,$data))
				{
					$this->session->set_flashdata('success', 'Record saved!!');
					$this->edit($id);
				}
			}
			else{
				if($this->student_model->insert($data))
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
