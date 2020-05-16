<?php

class Department_model extends CI_Model
{
    private $_table = "departments";

	
	public function department_datatable()
	{
		$this->load->library('datatables');
		$this->datatables->select('department_id,department_name');
		$this->datatables->from($this->_table);
		$this->datatables->edit_column('department_id', anchor('departments/$1/edit','Edit',array('class'=>'btn btn-info btn-sm')).' '.anchor('departments/$1/delete','Delete',array('class'=>'btn btn-danger btn-sm')), 'department_id');        
        return print_r($this->datatables->generate());
	}

	public function findDepartmentById(int $id)
	{
		$this->db->where('department_id',$id);
		$dp = $this->db->get($this->_table)->row_array();
		if(!empty($dp))
		{
			return $dp;
		}
		else{
			show_404();
		}
	}

	public function edit($id,$data)
	{
		$this->db->where('department_id',$id);
		$this->db->update($this->_table,$data);
		return true;
	}

	public function insert($data)
	{
		$this->db->insert($this->_table,$data);
		return true;
	}

	public function getAllDepartment()
	{
		$dp = $this->db->get($this->_table);
		return $dp->result();
	}
}
