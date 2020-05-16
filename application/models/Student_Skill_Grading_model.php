<?php

class Student_Skill_Grading_model extends CI_Model
{
    private $_table = "student_subjectskill_grade";

	public function insert($data)
	{
		$this->db->insert($this->_table,$data);
		return true;
	}

	public function skill_grading_by_gs($gs_id)
	{
		$this->db->where('ssg_gs_id',$gs_id);
		$this->db->from('student_subjectskill_grade');
		$this->db->join('students','students.student_id = student_subjectskill_grade.ssg_student_id');
		$this->db->select('students.student_name,students.student_id,student_subjectskill_grade.*');
		
		$gs = $this->db->get()->result();
		if(!empty($gs))
		{
			return $gs;
		}
		else{
			show_404();
		}
	}
}
