<?php

class Class_model extends CI_Model
{
    private $_table = "classes";

	
	public function class_datatable()
	{
		$this->load->library('datatables');
		$this->datatables->select('class_id,class_name,class_code,class_grade');
		$this->datatables->from($this->_table);
		$this->datatables->join('users', 'classes.class_homeroom_id = users.id','LEFT');
		$this->datatables->select('users.name as teacher');
		$this->datatables->join('departments', 'classes.class_department_id = departments.department_id','LEFT');
		$this->datatables->select('departments.department_name');
		$this->datatables->edit_column('class_id', anchor('classes/$1/edit','Edit',array('class'=>'btn btn-info btn-sm')).' '.anchor('classes/$1/delete','Delete',array('class'=>'btn btn-danger btn-sm')), 'class_id');
		//$this->datatables->add_column('action', anchor('users/edit/$1','Edit',array('class'=>'btn btn-danger btn-sm')));
        
        return print_r($this->datatables->generate());
	}

	public function findClassById(int $id)
	{
		$this->db->where('class_id',$id);
		$student = $this->db->get($this->_table)->row_array();
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
		$this->db->where('class_id',$id);
		$this->db->update($this->_table,$data);
		return true;
	}

	public function insert($data)
	{
		$this->db->insert($this->_table,$data);
		return true;
	}

	public function class_by_grade_datatable($subject_id,$grade_id)
	{
		$this->load->library('datatables');
		$this->datatables->select('class_id,class_name,class_code,class_grade,class_start_ay,class_end_ay');
		$this->datatables->from($this->_table);
		$this->datatables->where('class_grade',$grade_id);
		$this->datatables->edit_column('class_start_ay','$1/$2','class_start_ay,class_end_ay');
		$this->datatables->edit_column('class_id', anchor('subjects/$1/class/$2/grading','Select',array('class'=>'btn btn-info btn-sm')),$subject_id.',class_id');
		//$this->datatables->add_column('action', anchor('users/edit/$1','Edit',array('class'=>'btn btn-danger btn-sm')));
        
        return print_r($this->datatables->generate());
	}
}
