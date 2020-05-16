<?php

class Student_model extends CI_Model
{
    private $_table = "students";

	
	public function student_datatable()
	{
		$this->load->library('datatables');
		$this->datatables->select('student_id,student_name,student_nisn,student_dob,student_address,student_department_id');
		$this->datatables->from($this->_table);
		$this->datatables->edit_column('student_id', anchor('students/$1/edit','Edit',array('class'=>'btn btn-info btn-sm')).' '.anchor('students/$1/delete','Delete',array('class'=>'btn btn-danger btn-sm')), 'student_id');
		//$this->datatables->add_column('action', anchor('users/edit/$1','Edit',array('class'=>'btn btn-danger btn-sm')));
        
        return print_r($this->datatables->generate());
	}

	public function student_datatable_by_department($dp_id,$class_id)
	{
		$this->load->library('datatables');
		$this->datatables->select('student_id,student_name,student_nisn,sclass_class_id');
		$this->datatables->from($this->_table);
		$this->datatables->join('student_class','sclass_student_id = student_id','LEFT');
		//$this->datatables->where_not_in('ss_class_id',$class_id);
		$this->datatables->where('student_department_id',$dp_id);
		//$this->datatables->group_by('ss_student_id');
		//$this->datatables->edit_column('student_id', '<input type="checkbox" name="student_id[]" value="$1">', 'student_id');
        return print_r($this->datatables->generate());
	}

	public function findStudentById(int $id)
	{
		$this->db->where('student_id',$id);
		$student = $this->db->get($this->_table)->row();
		if(!empty($student))
		{
			return $student;
		}
		else{
			show_404();
		}
	}

	public function edit($id,$data)
	{
		$this->db->where('student_id',$id);
		$this->db->update($this->_table,$data);
		return true;
	}

	public function insert($data)
	{
		$this->db->insert($this->_table,$data);
		return true;
	}

	public function getList()
	{
		return $this->db->get($this->_table);
	}

	public function getStudentbyGrade($subject_id,$grade)
	{
		$this->db->select('student_id,student_name');
		$this->db->from('student_subject');
		$this->db->join('students','student_id = ss_student_id');
		$this->db->join('class_subject','ss_subject_id = cs_subject_id');
		$this->db->join('classes','class_id = cs_class_id');
		$this->db->where('class_grade',$grade);
		$this->db->where('ss_subject_id',$subject_id);
		return $this->db->get()->result();
	}
}
