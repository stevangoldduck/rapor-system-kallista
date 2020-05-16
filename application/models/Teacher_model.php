<?php

class Teacher_model extends CI_Model
{
    private $_table = "teachers";

	
	public function teacher_datatable()
	{
		$this->load->library('datatables');
		$this->datatables->select('teacher_id,teacher_name,teacher_nip,teacher_department_id,department_name');
		$this->datatables->from($this->_table);
		$this->datatables->join('departments','department_id = teachers.teacher_department_id','LEFT');
		$this->datatables->edit_column('teacher_id', anchor('teachers/$1/edit','Edit',array('class'=>'btn btn-info btn-sm')).' '.anchor('teachers/$1/delete','Delete',array('class'=>'btn btn-danger btn-sm')), 'teacher_id');
		//$this->datatables->add_column('action', anchor('users/edit/$1','Edit',array('class'=>'btn btn-danger btn-sm')));
        
        return print_r($this->datatables->generate());
	}

	public function findTeacherById(int $id)
	{
		$this->db->where('teacher_id',$id);
		$teacher = $this->db->get($this->_table)->row_array();
		if(!empty($teacher))
		{
			return $teacher;
		}
		else{
			show_404();
		}
	}

	public function edit($id,$data)
	{
		$this->db->where('teacher_id',$id);
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

}
