<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Subjects extends CI_Controller
{

	protected $alpha = ['a', 'b', 'c', 'd', 'e', 'f', 'g'];

	public function __construct()
	{
		parent::__construct();

		$this->load->helper(array('url', 'date'));

		$this->load->library(array('template', 'form_validation'));

		$this->load->model(
			[
				"user_model",
				"subject_model",
				"subject_group_model",
				"class_model", "student_model",
				"grade_submission_model",
				"student_knowledge_grading_model",
				"student_skill_grading_model",
				"student_club_grading_model",
				"student_social_grading_model",
				"student_spiritual_grading_model",
				"subject_aw_knowledge_model",
				"subject_aw_skill_model",
				"subject_predicate_model"
			]
		);

		if ($this->user_model->isNotAuthenticated()) redirect(site_url('/'));
	}

	public function index()
	{
		$this->template->set('title', 'Subjects | Dashboard');
		$this->template->load('app', 'contents', 'subject/index.php', []);
		$this->template->push_js('push_js', 'subject/scripts/datatable.php');
	}

	public function create()
	{
		$homerooms = $this->user_model->getAllUser();
		$sg = $this->subject_group_model->getAllSG();
		$this->template->set('title', 'Subject Create | Dashboard');
		$this->template->load('app', 'contents', 'subject/create.php', ['view_type' => 'create', 'teachers' => $homerooms, 'subject_groups' => $sg]);
	}

	public function list_subject()
	{
		$class = new Subject_model();
		return $class->subject_datatable();
	}


	public function list_subject_student()
	{
		$class = new Subject_model();
		return $class->getStudents($_REQUEST['subject_id']);
	}

	public function edit($id)
	{
		$class = new Subject_model();
		$data = $class->findSubjectById($id);
		$homerooms = $this->user_model->getAllUser();
		$sg = $this->subject_group_model->getAllSG();

		$data['teachers'] = $homerooms;
		$data['subject_groups'] = $sg;

		$this->template->set('title', 'Subject Edit | Dashboard');
		$this->template->load('app', 'contents', 'subject/edit.php', $data);
		$this->template->push_js('push_js', 'subject/scripts/datatable.php');
	}

	public function formAction()
	{
		if ($this->input->post('action_type') == "update") {
			$id = $this->input->post('subject_id');

			$subject = new Subject_model();
			$data = $subject->findSubjectById($id);

			if ($data['subject_code'] !=  $this->input->post('subject_code')) {
				$is_unique_code = '|is_unique[subjects.subject_code]';
			} else {
				$is_unique_code = '';
			}
		} else {
			$is_unique_code = '|is_unique[subjects.subject_code]';
		}

		$this->form_validation->set_rules('subject_code', 'Code', 'required' . $is_unique_code);
		$this->form_validation->set_rules('subject_name', 'Name', 'required');
		$this->form_validation->set_rules('subject_scc', 'SCC', 'required');
		$this->form_validation->set_rules('grade', 'Grade', 'required');
		$this->form_validation->set_rules('teacher', 'Teacher', 'required');
		$this->form_validation->set_rules('category', 'Category', 'required');
		$this->form_validation->set_rules('group', 'Group', 'required');

		$data = array(
			'subject_code' => $this->input->post('subject_code'),
			'subject_name' => $this->input->post('subject_name'),
			'subject_scc' => $this->input->post('subject_scc'),
			'subject_grade' => $this->input->post('grade'),
			'subject_group_id' => $this->input->post('group'),
			'subject_teacher_id' => $this->input->post('teacher'),
			'subject_category' => $this->input->post('category'),
			'subject_aw_knowledge_id' => $data['subject_aw_knowledge_id'] ?? null,
			'subject_aw_skill_id' => $data['subject_aw_skill_id'] ?? null,
			'subject_predicate_id' => $data['subject_predicate_id'] ?? null
		);

		$data_aw_k = [
			'sak_u_aw' => $this->input->post('awk_ulangan') ?? 0,
			'sak_t_aw' => $this->input->post('awk_tugas') ?? 0,
			'sak_md_aw' => $this->input->post('awk_md') ?? 0,
			'sak_st_aw' => $this->input->post('awk_st') ?? 0
		];

		$data_aw_s = [
			'sas_aw_ppk' => $this->input->post('aws_ppk') ?? 0,
			'sas_aw_ppr' => $this->input->post('aws_ppr') ?? 0,
			'sas_aw_ppj' => $this->input->post('aws_ppj') ?? 0,
			'sas_aw_md' => $this->input->post('aws_md') ?? 0,
			'sas_aw_st' => $this->input->post('aws_st') ?? 0
		];

		$awk = new Subject_Aw_Knowledge_model();
		$sp = new Subject_Predicate_model();

		if ($data['subject_aw_knowledge_id'] != null) {
			//$awk_data = $awk->findSAKById($data['subject_aw_knowledge_id']);
			$awk->edit($data['subject_aw_knowledge_id'], $data_aw_k);
		} else {
			$last_id = $awk->insert($data_aw_k);
			$data['subject_aw_knowledge_id'] = $last_id;
		}

		$aws = new Subject_Aw_Skill_model();
		if ($data['subject_aw_skill_id'] != null) {
			//$aws_data = $aws->findSAKById($data['subject_aw_skill_id']);
			$aws->edit($data['subject_aw_skill_id'], $data_aw_s);
		} else {
			$last_id = $aws->insert($data_aw_s);
			$data['subject_aw_skill_id'] = $last_id;
		}

		$data_sp = [];

		for ($i = 0; $i < 7; $i++) {
			$data_sp['sp_min_' . $this->alpha[$i]] = $this->input->post('min_score_' . $i) ? $this->input->post('min_score_' . $i) : 0;
			$data_sp['sp_max_' . $this->alpha[$i]] = $this->input->post('max_score_' . $i) ? $this->input->post('max_score_' . $i) : 0;
			$data_sp['sp_p_' . $this->alpha[$i]] = $this->input->post('predicate_' . $i) ? $this->input->post('predicate_' . $i) : "-";
		}

		if ($data['subject_predicate_id'] != null) {
			$sp->edit($data['subject_predicate_id'], $data_sp);
		} else {
			$last_id = $sp->insert($data_sp);
			$data['subject_predicate_id'] = $last_id;
		}

		if ($this->form_validation->run() != false) {
			if ($this->input->post('action_type') == "update") {

				if ($this->subject_model->edit($id, $data)) {
					$this->session->set_flashdata('success', 'Record saved!!');
					$this->edit($id);
				}
			} else {
				if ($this->subject_model->insert($data)) {
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

	public function grading($subject_id, $grade)
	{
		$subject = new Subject_model();
		$data['subject'] = $subject->findSubjectById($subject_id);

		if ($grade != $data['subject']['subject_grade']) {
			show_error('This subject is for ' . $data['subject']['subject_grade'] . ' grade', 500, 'Unknown Class Grade');
		}

		$student = new Student_model();
		$data['student'] = $student->getStudentbyGrade($subject_id, $grade);

		$this->template->set('title', 'Subject Grading | Dashboard');
		$this->template->load('app', 'contents', 'subject/grading.php', $data);
		//$this->template->push_js('push_js', 'subject/scripts/validation.php');

	}

	public function grading_submission()
	{
		$subject_id = $this->input->post('subject_id');
		$grade = $this->input->post('grade');
		$subject_type = $this->input->post('type');

		//define which semester now
		$sy = '';
		if (date('Y-m-d') < date('Y-06-30')) {
			$sy = (date('Y') - 1) . '/' . date('Y');
		} else {
			$sy = (date('Y')) . '/' . date('Y') + 1;
		}

		$alpa = ['a', 'b', 'c', 'd', 'e'];

		//get subject related

		$gs = new Grade_Submission_model();
		$data = [
			'gs_submitted_by' => $_SESSION['user_logged']->id,
			'gs_submitted_date' =>  date('Y-m-d'),
			'gs_subject_id' => $this->input->post('subject_id'),
			'gs_sy' => $sy
		];

		$gs_id = $gs->insert($data);

		$student = new Student_model();
		$data['student'] = $student->getStudentbyGrade($subject_id, $grade);

		//students
		foreach ($data['student'] as $key => $item) {

			if ($subject_type == "subject") {
				//insert knowledge grade
				$this->insertKnowledgeGrade($subject_id, $item->student_id, $gs_id);
				//insert skill grade
				$this->insertSkillGrade($subject_id, $item->student_id, $gs_id);
			} elseif ($subject_type == "curricular") {
				$this->insertClubGrading($subject_id, $item->student_id, $gs_id);
			} elseif ($subject_type == "social") {
				$this->insertSocialOrSpiritualGrading("social", $subject_id, $item->student_id, $gs_id);
			} else {
				$this->insertSocialOrSpiritualGrading("spiritual", $subject_id, $item->student_id, $gs_id);
			}
		}

		$this->session->set_flashdata('success', 'Grade submitted!!');
		redirect($_SERVER['HTTP_REFERER']);
	}

	protected function insertKnowledgeGrade($subject_id, $student_id, $gs_id)
	{
		$data = [];
		$score_u = [];
		$score_urem = [];
		$score_t = [];
		$score_trem = [];
		$avgDataCount_u = 0; //max 10
		$avgDataCount_t = 0; //max 10
		$total_u = 0;
		$total_t = 0;

		$subject = new Subject_model();
		$aw = $subject->findSubjectById($subject_id);
		$aw_u = $aw['sak_u_aw'] / 100;
		$aw_t = $aw['sak_t_aw'] / 100;
		$aw_md = $aw['sak_md_aw'] / 100;
		$aw_st = $aw['sak_st_aw'] / 100;

		foreach ($this->input->post('skg_u' . $student_id) as $k => $value) {
			$letter = $this->alpha[$k];
			$data['skg_u_' . $letter] = $value ? $value : null;

			$avgDataCount_u = $value ? $avgDataCount_u + 1 : $avgDataCount_u;
			$value ? array_push($score_u, $value) : '';
		}

		foreach ($this->input->post('skg_u_rem' . $student_id) as $k => $value) {
			$letter = $this->alpha[$k];
			$data['skg_u_rem' . $letter] = $value ? $value : null;
			$value ? array_push($score_urem, $value) : '';
		}

		foreach ($score_u as $key => $item) {
			$max = (max($item, $score_urem[$key]));
			$total_u = $total_u + $max;
		}

		$avg_u = ($total_u / $avgDataCount_u) * $aw_u;
		$data['skg_avg_u'] = $avg_u;

		foreach ($this->input->post('skg_t' . $student_id) as $k => $value) {
			$letter = $this->alpha[$k];
			$data['skg_t_' . $letter] = $value ? $value : null;
			$avgDataCount_t = $value ? $avgDataCount_t + 1 : $avgDataCount_t;
			$value ? array_push($score_t, $value) : '';
		}

		foreach ($this->input->post('skg_t_rem' . $student_id) as $k => $value) {
			$letter = $this->alpha[$k];
			$data['skg_t_rem' . $letter] = $value ? $value : null;
			$value ? array_push($score_trem, $value) : '';
		}

		foreach ($score_t as $key => $item) {
			$max = (max($item, $score_trem[$key]));
			$total_t = $total_t + $max;
		}

		$avg_t = ($total_t / $avgDataCount_t) * $aw_t;
		$data['skg_avg_t'] = $avg_t;

		$md_avg = $this->input->post('skg_md' . $student_id) * $aw_md;
		$st_avg = $this->input->post('skg_st' . $student_id) * $aw_st;

		$data['skg_md_score'] = $this->input->post('skg_md' . $student_id);
		$data['skg_avg_md'] = $md_avg;

		$data['skg_st_score'] = $this->input->post('skg_st' . $student_id);
		$data['skg_avg_st'] = $st_avg;

		$final_score = $avg_u + $avg_t + $md_avg + $st_avg;
		$data['skg_final_score'] = $final_score;

		foreach ($this->alpha as $item) {
			if ($aw['sp_max_' . $item] != null) {
				if (($final_score >= $aw['sp_min_' . $item]) && ($final_score <= $aw['sp_max_' . $item])) {
					$data['skg_predikat'] = $aw['sp_p_' . $item];
					break;
				} else {
					$data['skg_predikat'] = null;
				}
			}
		}

		$data['skg_student_id'] = $student_id;
		$data['skg_subject_id'] = $subject_id;
		$data['skg_gs_id'] = $gs_id;
		$data['skg_remark'] = $this->input->post('skg_remark' . $student_id);

		$skg = new Student_Knowledge_Grading_model();
		$skg->insert($data);
	}

	protected function insertSkillGrade($subject_id, $student_id, $gs_id)
	{
		$data = [];

		$score_ppk = [];
		$score_ppkrem = [];

		$score_ppr = [];
		$score_pprrem = [];

		$score_ppj = [];
		$score_ppjrem = [];

		$avgDataCount_ppk = 0; //max 6
		$avgDataCount_ppr = 0; //max 6
		$avgDataCount_ppj = 0; //max 10

		$total_ppk = 0;
		$total_ppr = 0;
		$total_ppj = 0;

		$subject = new Subject_model();
		$aw = $subject->findSubjectById($subject_id);
		$aw_ppk = $aw['sas_aw_ppk'] / 100;
		$aw_ppr = $aw['sas_aw_ppr'] / 100;
		$aw_ppj = $aw['sas_aw_ppj'] / 100;
		$aw_md = $aw['sas_aw_md'] / 100;
		$aw_st = $aw['sas_aw_st'] / 100;

		foreach ($this->input->post('ssg_ppk' . $student_id) as $k => $value) {
			$letter = $this->alpha[$k];
			$data['ssg_ppk_' . $letter] = $value ? $value : null;

			$avgDataCount_ppk = $value ? $avgDataCount_ppk + 1 : $avgDataCount_ppk;
			$value ? array_push($score_ppk, $value) : '';
		}

		foreach ($this->input->post('ssg_ppk_rem' . $student_id) as $k => $value) {
			$letter = $this->alpha[$k];
			$data['ssg_ppk_rem' . $letter] = $value ? $value : null;
			$value ? array_push($score_ppkrem, $value) : '';
		}

		foreach ($score_ppk as $key => $item) {
			$max = (max($item, $score_ppkrem[$key]));
			$total_ppk = $total_ppk + $max;
		}

		$avg_ppk = ($total_ppk / $avgDataCount_ppk) * $aw_ppk;
		$data['ssg_avg_ppk'] = $avg_ppk;

		foreach ($this->input->post('ssg_ppr' . $student_id) as $k => $value) {
			$letter = $this->alpha[$k];
			$data['ssg_ppr_' . $letter] = $value ? $value : null;
			$avgDataCount_ppr = $value ? $avgDataCount_ppr + 1 : $avgDataCount_ppr;
			$value ? array_push($score_ppr, $value) : '';
		}

		foreach ($this->input->post('ssg_ppr_rem' . $student_id) as $k => $value) {
			$letter = $this->alpha[$k];
			$data['ssg_ppr_rem' . $letter] = $value ? $value : null;
			$value ? array_push($score_pprrem, $value) : '';
		}

		foreach ($score_ppr as $key => $item) {
			$max = (max($item, $score_pprrem[$key]));
			$total_ppr = $total_ppr + $max;
		}

		$avg_ppr = ($total_ppr / $avgDataCount_ppr) * $aw_ppr;
		$data['ssg_avg_ppr'] = $avg_ppr;

		foreach ($this->input->post('ssg_ppj' . $student_id) as $k => $value) {
			$letter = $this->alpha[$k];
			$data['ssg_ppj_' . $letter] = $value ? $value : null;
			$avgDataCount_ppj = $value ? $avgDataCount_ppj + 1 : $avgDataCount_ppj;
			$value ? array_push($score_ppj, $value) : '';
		}

		foreach ($this->input->post('ssg_ppj_rem' . $student_id) as $k => $value) {
			$letter = $this->alpha[$k];
			$data['ssg_ppj_rem' . $letter] = $value ? $value : null;
			$value ? array_push($score_ppjrem, $value) : '';
		}

		foreach ($score_ppj as $key => $item) {
			$max = (max($item, $score_ppjrem[$key]));
			$total_ppj = $total_ppj + $max;
		}

		$avg_ppj = ($total_ppj / $avgDataCount_ppj) * $aw_ppj;
		$data['ssg_avg_ppj'] = $avg_ppj;

		$md_avg = $this->input->post('ssg_md' . $student_id) * $aw_md;
		$st_avg = $this->input->post('ssg_st' . $student_id) * $aw_st;

		$data['ssg_md_score'] = $this->input->post('ssg_md' . $student_id);
		$data['ssg_avg_md'] = $md_avg;

		$data['ssg_st_score'] = $this->input->post('ssg_st' . $student_id);
		$data['ssg_avg_st'] = $st_avg;

		$final_score = $avg_ppk + $avg_ppr + $md_avg + $st_avg;
		$data['ssg_final_score'] = $final_score;

		foreach ($this->alpha as $item) {
			if ($aw['sp_max_' . $item] != null) {
				if (($final_score >= $aw['sp_min_' . $item]) && ($final_score <= $aw['sp_max_' . $item])) {
					$data['ssg_predikat'] = $aw['sp_p_' . $item];
					break;
				} else {
					$data['ssg_predikat'] = null;
				}
			}
		}

		$data['ssg_student_id'] = $student_id;
		$data['ssg_subject_id'] = $subject_id;
		$data['ssg_gs_id'] = $gs_id;
		$data['ssg_remark'] = $this->input->post('ssg_remark' . $student_id);

		$ssg = new Student_Skill_Grading_model();
		$ssg->insert($data);
	}

	public function insertClubGrading($subject_id, $student_id, $gs_id)
	{

		$data = [
			'scg_student_id' => $student_id,
			'scg_subject_id' => $subject_id,
			'scg_gs_id' => $gs_id,
			'scg_club_grade' => $this->input->post('scg_club' . $student_id),
			'scg_pmr_grade' => $this->input->post('scg_pmr' . $student_id)
		];

		$scg = new Student_Club_Grading_model();
		$scg->insert($data);
	}

	public function insertSocialOrSpiritualGrading($type, $subject_id, $student_id, $gs_id)
	{
		$data = [];
		if ($type == "social") {
			$data['ssbg_subject_id'] = $subject_id;
			$data['ssbg_student_id'] = $student_id;
			$data['ssbg_gs_id'] = $gs_id;
			$data['ssbg_grade'] = $this->input->post('ssbg_grade' . $student_id);
			$data['ssbg_remark'] = $this->input->post('ssbg_remark' . $student_id);

			$ssbg = new Student_Social_Grading_model();
			$ssbg->insert($data);
		} else {
			$data['sspg_subject_id'] = $subject_id;
			$data['sspg_student_id'] = $student_id;
			$data['sspg_gs_id'] = $gs_id;
			$data['sspg_grade'] = $this->input->post('sspg_grade' . $student_id);
			$data['sspg_remark'] = $this->input->post('sspg_remark' . $student_id);

			$sspg = new Student_Spiritual_Grading_model();
			$sspg->insert($data);
		}
	}
}
