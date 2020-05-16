<?php

class Subject_Group_model extends CI_Model
{
    private $_table = "subject_group";

	
	public function subject_group_datatable()
	{
		$this->load->library('datatables');
		$this->datatables->select('sg_id,sg_name');
		$this->datatables->from($this->_table);
		$this->datatables->edit_column('sg_id', anchor('subjects-group/$1/edit','Edit',array('class'=>'btn btn-info btn-sm')).' '.anchor('subjects-group/$1/delete','Delete',array('class'=>'btn btn-danger btn-sm')), 'sg_id');        
        return print_r($this->datatables->generate());
	}

	public function findSubjectGroupById(int $id)
	{
		$this->db->where('sg_id',$id);
		$sg = $this->db->get($this->_table)->row_array();
		if(!empty($sg))
		{
			return $sg;
		}
		else{
			show_404();
		}
	}

	public function edit($id,$data)
	{
		$this->db->where('sg_id',$id);
		$this->db->update($this->_table,$data);
		return true;
	}

	public function insert($data)
	{
		$this->db->insert($this->_table,$data);
		return true;
	}

	public function getAllSG()
	{
		$users = $this->db->get($this->_table);
		return $users->result();
	}
}
