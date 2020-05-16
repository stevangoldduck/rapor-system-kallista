<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Classes extends CI_Controller
{

	protected $department_code = ['ES','JH','SH'];

	public function __construct()
	{
		parent::__construct();

		$this->load->helper(array('url', 'date'));

		$this->load->library(array('template', 'form_validation'));

		$this->load->model(array("user_model", "class_model", "student_model", "subject_model", "class_subject_model", "student_subject_model","student_class_model","department_model","class_sequence_model"));

		if ($this->user_model->isNotAuthenticated()) redirect(site_url('/'));
	}

	public function index()
	{
		$this->template->set('title', 'Classes | Dashboard');
		$this->template->load('app', 'contents', 'class/index.php', []);
		$this->template->push_js('push_js', 'class/scripts/datatable.php');
	}

	public function create()
	{
		$homerooms = $this->user_model->getAllUser();
		$departments = $this->department_model->getAllDepartment();
		$this->template->set('title', 'Class Create | Dashboard');
		$this->template->load('app', 'contents', 'class/create.php', ['view_type' => 'create', 'homerooms' => $homerooms, 'departments' => $departments]);
	}

	public function list_class()
	{
		$class = new Class_model();
		return $class->class_datatable();
	}

	public function student_list()
	{
		$studes = new Student_model();
		return $studes->student_datatable_by_department($_REQUEST['dp_id'], $_REQUEST['class_id']);
	}

	public function subject_list()
	{
		$subjects = new Subject_model();
		return $subjects->subject_datatable_by_grade($_REQUEST['grade']);
	}

	public function edit($id)
	{
		$class = new Class_model();
		$data = $class->findClassById($id);

		$data['homerooms'] = $this->user_model->getAllUser();
		$data['departments'] = $this->department_model->getAllDepartment();
		

		$this->template->set('title', 'Class Edit | Dashboard');
		$this->template->load('app', 'contents', 'class/edit.php', $data);
		$this->template->push_js('push_js', 'class/scripts/datatable.php');
	}

	public function formAction()
	{

		$this->form_validation->set_rules('class_name', 'Class Name', 'required');
		$this->form_validation->set_rules('department', 'Department', 'required');
		$this->form_validation->set_rules('grade', 'Grade', 'required');
		$this->form_validation->set_rules('homeroom', 'Homeroom', 'required');
		$this->form_validation->set_rules('ay_start', 'Academic Year Start', 'required');
		$this->form_validation->set_rules('ay_end', 'Academic Year End', 'required');

		$data = array(
			'class_name' => $this->input->post('class_name'),
			'class_grade' => $this->input->post('grade'),
			'class_department_id' => $this->input->post('department'),
			'class_homeroom_id' => $this->input->post('homeroom'),
			'class_start_ay' => $this->input->post('ay_start'),
			'class_end_ay' => $this->input->post('ay_end'),
		);

		$id = "";

		if ($this->input->post('action_type') == "update") {
			$id = $this->input->post('class_id');
		}

		if ($this->form_validation->run() != false) {
			if ($this->input->post('action_type') == "update") {
				if ($this->class_model->edit($id, $data)) {
					$this->session->set_flashdata('success', 'Record saved!!');
					$this->edit($id);
				}
			} else {

				$sq = $this->class_sequence_model->findSeqById(1);

				$class_code = $this->input->post('grade').strtoupper(substr($this->input->post('class_name'),0,2)).$sq['cseq_sequence_num']."-".substr(date('Y'), -2);

				$data['class_code'] = $class_code;

				$data_seq = [
					'cseq_sequence_num' => $sq['cseq_sequence_num']
				];

				$this->class_sequence_model->edit(1,$data_seq);

				if ($this->class_model->insert($data)) {
					$this->session->set_flashdata('success', 'Record saved!!');
					$this->create();
				}
			}
		} else {
			if ($this->input->post('action_type') == "update") {
				$this->edit($id);
			} else {
				$this->create();
			}
		}
	}

	public function classByGrade()
	{
		$class = new Class_model();
		return $class->class_by_grade_datatable($_REQUEST['subject_id'], $_REQUEST['grade']);
	}

	public function add_subject_student()
	{
		//student_id[] and subject_id[]
		//delete all first in class_subject and student_subject

		$class_id = $this->input->post('class_id');

		$cs = new Class_Subject_model();
		$cs->delete($class_id);

		$sc = new Student_Class_model();
		$sc->delete($class_id,null);
		
		foreach ($this->input->post('subject_id') as $item) {
			$data = [
				'cs_class_id' => $class_id,
				'cs_subject_id' => $item
			];

			$cs->insert($data);
		}

		foreach ($this->input->post('student_id') as $value) {
			$ssm = new Student_Subject_model();
			$ssm->delete(null,$value);

			$data2 = [
				'sclass_student_id' => $value,
				'sclass_class_id' => $class_id
			];

			$sc->insert($data2);

			foreach ($this->input->post('subject_id') as $item) {

				$data = [
					'ss_subject_id' => $item,
					'ss_student_id' => $value
				];

				$ssm->insert($data);
			}
		}

		$this->session->set_flashdata('success', 'Class Edited!!');
		redirect($_SERVER['HTTP_REFERER']);
	}
}
