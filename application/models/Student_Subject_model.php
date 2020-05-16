<?php

class Student_Subject_model extends CI_Model
{
    private $_table = "student_subject";

	public function insert($data)
	{
		$this->db->insert($this->_table,$data);
		return true;
	}

	// public function student_datatable_by_class($class_id)
	// {
	// 	$this->load->library('datatables');
	// 	$this->datatables->select('student_id,student_name,student_nis,ss_class_id');
	// 	$this->datatables->from($this->_table);
	// 	$this->datatables->join('classes', 'class_id = ss_class_id');
	// 	$this->datatables->group_by('ss_class_id');
	// 	$this->datatables->where('ss_class_id',$class_id);
	// 	$this->datatables->edit_column('student_id', '<input type="checkbox" selected name="student_id[]" value="$1">', 'student_id');
	// 	return print_r($this->datatables->generate());
	// }

	public function delete($subject_id = null,$student_id = null)
	{
		$student_id ? $this->db->where('ss_student_id',$student_id) : '';
		$subject_id ? $this->db->where('ss_subject_id',$subject_id) : '';
		$this->db->delete($this->_table);
	}
}
