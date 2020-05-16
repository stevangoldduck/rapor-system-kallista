<?php

class Student_Class_model extends CI_Model
{
    private $_table = "student_class";

	public function insert($data)
	{
		$this->db->insert($this->_table,$data);
		return true;
	}

	public function delete($class_id = null,$student_id = null)
	{
		$class_id ? $this->db->where('sclass_class_id',$class_id) : '';
		$student_id ? $this->db->where('sclass_subject_id',$student_id) : '';
		$this->db->delete($this->_table);
	}
}
