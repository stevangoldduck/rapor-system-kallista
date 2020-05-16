<?php

class Student_Club_Grading_model extends CI_Model
{
    private $_table = "student_club_grade";

	public function insert($data)
	{
		$this->db->insert($this->_table,$data);
		return true;
	}

	public function club_grading_by_gs($gs_id)
	{
		$this->db->where('scg_gs_id',$gs_id);
		$this->db->from('student_club_grade');
		$this->db->join('students','students.student_id = student_club_grade.scg_student_id');
		$this->db->select('students.student_name,students.student_id,student_club_grade.*');

		$scg = $this->db->get()->result();
		if(!empty($scg))
		{
			return $scg;
		}
		else{
			show_404();
		}
	}

}
