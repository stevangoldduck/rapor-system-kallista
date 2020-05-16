<?php

class Subject_model extends CI_Model
{
	private $_table = "subjects";


	public function subject_datatable()
	{
		$this->load->library('datatables');
		$this->datatables->select('subject_id,subject_code,subject_name,subject_grade,subject_group_id,subject_category,subject_teacher_id,subject_group.sg_name,users.name as teacher');
		$this->datatables->from($this->_table);
		$this->datatables->join('users', 'subject_teacher_id = users.id');
		$this->datatables->join('subject_group', 'subject_group_id = subject_group.sg_id');
		$this->datatables->edit_column('subject_id', anchor('subjects/$1/edit', 'Edit', array('class' => 'btn btn-info btn-sm')) . ' ' . anchor('subjects/$1/delete', 'Delete', array('class' => 'btn btn-danger btn-sm')), 'subject_id');
		return print_r($this->datatables->generate());
	}

	public function subject_datatable_by_grade($grade)
	{
		$this->load->library('datatables');
		$this->datatables->select('subject_id,subject_name,subject_code,cs_class_id,subject_grade');
		$this->datatables->from($this->_table);
		$this->datatables->join('class_subject','subject_id = cs_subject_id','LEFT');
		//$this->datatables->where_not_in('ss_class_id',$class_id);
		$this->datatables->where('subject_grade',$grade);
		//$this->datatables->group_by('ss_subject_id');
		//$this->datatables->edit_column('student_id', '<input type="checkbox" name="student_id[]" value="$1">', 'student_id');
        return print_r($this->datatables->generate());
	}

	public function findSubjectById(int $id)
	{
		$this->db->select('subjects.*,subject_aw_knowledge.*,subject_aw_skill.*,subject_predicate.*');
		$this->db->from($this->_table);
		$this->db->where('subject_id', $id);
		$this->db->join('subject_aw_knowledge','sak_id = subject_aw_knowledge_id','LEFT');
		$this->db->join('subject_aw_skill','sas_id = subject_aw_skill_id','LEFT');
		$this->db->join('subject_predicate','sp_id = subject_predicate_id','LEFT');
		$subject = $this->db->get()->row_array();
		if (!empty($subject)) {
			return $subject;
		} else {
			show_404();
		}
	}

	public function edit($id, $data)
	{
		$this->db->where('subject_id', $id);
		$this->db->update($this->_table, $data);
		return true;
	}

	public function insert($data)
	{
		$this->db->insert($this->_table, $data);
		return true;
	}

	public function getStudents($id)
	{

		$this->load->library('datatables');
		$this->datatables->select('student_name,student_nis,student_nisn');
		$this->datatables->from($this->_table);
		$this->datatables->join('student_subject', 'student_subject.ss_subject_id = subjects.subject_id');
		$this->datatables->join('students', 'student_subject.ss_student_id = students.student_id');
		$this->datatables->where('subjects.subject_id',$id);
		return print_r($this->datatables->generate());
	}

}
