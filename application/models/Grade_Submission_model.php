<?php

class Grade_Submission_model extends CI_Model
{
	private $_table = "grade_submissions";

	public function gs_datatable()
	{
		$this->load->library('datatables');
		$this->datatables->select('gs_sy,gs_id');
		$this->datatables->from($this->_table);
		$this->datatables->join('users', 'grade_submissions.gs_submitted_by = users.id');
		$this->datatables->select('users.name as teacher');
		$this->datatables->join('subjects', 'grade_submissions.gs_subject_id = subjects.subject_id');
		$this->datatables->select('subjects.subject_name,subjects.subject_grade');
		$this->datatables->edit_column('gs_id', anchor('grading-submissions/$1/view', 'View', array('class' => 'btn btn-info btn-sm')), 'gs_id');
		//$this->datatables->add_column('action', anchor('users/edit/$1','Edit',array('class'=>'btn btn-danger btn-sm')));

		return print_r($this->datatables->generate());
	}

	public function insert($data)
	{
		$this->db->trans_start();
		$this->db->insert($this->_table, $data);
		$insert_id = $this->db->insert_id();
		$this->db->trans_complete();
		return $insert_id;
	}

	public function update($gs_id, $data)
	{
		$this->db->where('gs_id', $gs_id);
		$this->db->update($this->_table, $data);
	}

	public function show_gs_by_id($gs_id)
	{
		$this->db->where('gs_id', $gs_id);
		$this->db->from('grade_submissions');
		$this->db->join('subjects', 'subjects.subject_id = grade_submissions.gs_subject_id');
		$this->db->join('subject_aw_knowledge', 'subjects.subject_aw_knowledge_id = sak_id','LEFT');
		$this->db->join('subject_aw_skill', 'subjects.subject_aw_skill_id = sas_id','LEFT');
		$this->db->select('subjects.*,grade_submissions.*,subject_aw_knowledge.*,subject_aw_skill.*');

		$gs = $this->db->get()->row_array();
		if (!empty($gs)) {
			return $gs;
		} else {
			show_404();
		}
	}

	public function student_mid_raport($student_id,$ac_year)
	{
		$this->db->where('gs_sy',$ac_year);
		$this->db->where('skg_student_id',$student_id);
		$this->db->where('ssg_student_id',$student_id);
		$this->db->from('grade_submissions');
		$this->db->join('subjects', 'subjects.subject_id = grade_submissions.gs_subject_id','left');
		$this->db->join('student_sknowledge_grade', 'gs_id = skg_gs_id','left');
		$this->db->join('student_subjectskill_grade', 'gs_id = ssg_gs_id','left');
		$this->db->select('subjects.*,grade_submissions.*,student_sknowledge_grade.*,student_subjectskill_grade.*');
		return $this->db->get()->result();
	}
}
