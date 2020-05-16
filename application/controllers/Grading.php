<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Grading extends CI_Controller
{

	protected $user_approval = [
		"gs_approval_one_by",
		"gs_approval_two_by",
		"gs_approval_three_by"
	];

	protected $user_approval_status = [
		"gs_approval_one",
		"gs_approval_two",
		"gs_approval_three"
	];

	public function __construct()
	{
		parent::__construct();

		$this->load->helper(array('url','date'));

		$this->load->library(array('template','form_validation'));

		$this->load->model([
			"user_model",
			"class_model",
			"grade_submission_model",
			"student_knowledge_grading_model",
			"student_skill_grading_model",
			"student_club_grading_model",
			"student_social_grading_model",
			"student_spiritual_grading_model"
		]);
		
		if ($this->user_model->isNotAuthenticated()) redirect(site_url('/'));
	}

	public function index()
	{
		$this->template->set('title', 'Grade Submission | Dashboard');
		$this->template->load('app', 'contents', 'grading/index.php', []);
		$this->template->push_js('push_js', 'grading/scripts/datatable.php');
	}

	public function list_grading()
	{
		$user = new Grade_Submission_model();
		return $user->gs_datatable();
	}

	public function show($gs_id)
	{
		$data = [];

		//get grade submission data and its relation to the subject
		$gs = new Grade_Submission_model();
		$data['gs_id'] = $gs_id;
		$data['subject'] = $gs->show_gs_by_id($gs_id);
		$subject_type = $data['subject']['subject_category'];
		if($subject_type == "subject")
		{
			$skg = new Student_Knowledge_Grading_model();
			$data['knowledge'] = $skg->knowledge_grading_by_gs($gs_id);

			$skg = new Student_Skill_Grading_model();
			$data['skill'] = $skg->skill_grading_by_gs($gs_id);
		}
		elseif($subject_type == "curricular"){
			$scg = new Student_Club_Grading_model();
			$data['club'] = $scg->club_grading_by_gs($gs_id);
		}
		elseif($subject_type == "social"){
			$ssbg = new Student_Social_Grading_model();
			$data['social'] = $ssbg->social_grading_by_gs($gs_id);
		}
		else{
			$sspg = new Student_Spiritual_Grading_model();
			$data['spiritual'] = $sspg->spiritual_grading_by_gs($gs_id);
		}

		$this->template->set('title', 'Grade Submission View | Dashboard');
		$this->template->load('app', 'contents', 'grading/show.php', $data);
		$this->template->push_js('push_js', 'grading/scripts/validation.php');
	}

	public function approve_grading()
	{
		$user_id = $_SESSION['user_logged']->id;
		$gs_id = $this->input->post('gs_id');
		$gs = new Grade_Submission_model();

		$gs_data = $gs->show_gs_by_id($gs_id);

		foreach($this->user_approval as $key => $item)
		{
			if($gs_data[$item] != null && $gs_data[$item] == $user_id)
			{
				$data = [
					$this->user_approval_status[$key] => 1
				];

				$gs->update($gs_id,$data);

				if(isset($_SESSION['success'])){
					unset($_SESSION['success']);
				}
				$this->session->set_flashdata('success', 'Approved!');
				break;
				return redirect($_SERVER['HTTP_REFERER']);
			}
			else{
				if(isset($_SESSION['error'])){
					unset($_SESSION['error']);
				}
				$this->session->set_flashdata('error', 'No approval user, please select first in Subject Page');
				
			}
		}

		redirect($_SERVER['HTTP_REFERER']);
	}

}
