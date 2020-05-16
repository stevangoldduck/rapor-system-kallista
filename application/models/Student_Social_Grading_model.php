<?php

class Student_Social_Grading_model extends CI_Model
{
    private $_table = "student_social_grade";

	public function insert($data)
	{
		$this->db->insert($this->_table,$data);
		return true;
	}

	public function social_grading_by_gs($gs_id)
	{
		$this->db->where('ssbg_gs_id',$gs_id);
		$this->db->from('student_social_grade');
		$this->db->join('students','students.student_id = student_social_grade.ssbg_student_id');
		$this->db->select('students.student_name,students.student_id,student_social_grade.*');
		
		$spiritual = $this->db->get()->result();
		if(!empty($spiritual))
		{
			return $spiritual;
		}
		else{
			show_404();
		}
	}
}
