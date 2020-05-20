<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Subject_Group extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();

		$this->load->helper(array('url', 'date'));

		$this->load->library(array('template', 'form_validation'));

		$this->load->model(array("user_model", "subject_group_model"));

		if ($this->user_model->isNotAuthenticated()) redirect(site_url('/'));
	}

	public function index()
	{
		if ($this->user_model->hasAccess("view_subject_group")) {
			$this->template->set('title', 'Subject Group | Dashboard');
			$this->template->load('app', 'contents', 'subject_group/index.php', []);
			$this->template->push_js('push_js', 'subject_group/scripts/datatable.php');
		}
	}

	public function create()
	{
		if ($this->user_model->hasAccess("create_subject_group")) {
			$this->template->set('title', 'Subject Group Create | Dashboard');
			$this->template->load('app', 'contents', 'subject_group/create.php', ['view_type' => 'create']);
		}
	}

	public function list_sg()
	{
		$sg = new Subject_Group_model();
		return $sg->subject_group_datatable();
	}

	public function edit($id)
	{
		if ($this->user_model->hasAccess("view_subject_group")) {
			$sg = new Subject_Group_model();
			$data = $sg->findSubjectGroupById($id);


			$this->template->set('title', 'Subject Group Edit | Dashboard');
			$this->template->load('app', 'contents', 'subject_group/edit.php', $data);
		}
	}

	public function formAction()
	{
		if ($this->input->post('action_type') == "update") {
			$id = $this->input->post('sg_id');

			$sg = new Subject_Group_model();
			$data = $sg->findSubjectGroupById($id);

			if ($data['sg_name'] !=  $this->input->post('sg_name')) {
				$is_unique_name = '|is_unique[subject_group.sg_name]';
			} else {
				$is_unique_name = '';
			}
		} else {
			$is_unique_name = '|is_unique[subject_group.sg_name]';
		}

		$this->form_validation->set_rules('sg_name', 'Group Name', 'required' . $is_unique_name);

		$data = array(
			'sg_name' => $this->input->post('sg_name'),
		);

		if ($this->form_validation->run() != false) {
			if ($this->input->post('action_type') == "update") {
				if ($this->user_model->hasAccess("edit_subject_group")) {
					if ($this->subject_group_model->edit($id, $data)) {
						$this->session->set_flashdata('success', 'Record updated!!');
						$this->edit($id);
					}
				}
			} else {
				if ($this->user_model->hasAccess("create_subject_group")) {
					if ($this->subject_group_model->insert($data)) {
						$this->session->set_flashdata('success', 'Record saved!!');
						$this->create();
					}
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
}
