<?php

class Student_Knowledge_Grading_model extends CI_Model
{
    private $_table = "student_sknowledge_grade";

	public function insert($data)
	{
		$this->db->insert($this->_table,$data);
		return true;
	}

	public function knowledge_grading_by_gs($gs_id)
	{
		$this->db->where('skg_gs_id',$gs_id);
		$this->db->from('student_sknowledge_grade');
		$this->db->join('students','students.student_id = student_sknowledge_grade.skg_student_id');
		$this->db->select('students.student_name,students.student_id,student_sknowledge_grade.*');

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
