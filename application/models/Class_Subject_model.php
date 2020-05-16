<?php

class Class_Subject_model extends CI_Model
{
	private $_table = "class_subject";

	public function insert($data)
	{
		$this->db->trans_start();
		$this->db->insert($this->_table,$data);
		$insert_id = $this->db->insert_id();
		$this->db->trans_complete();
		return $insert_id;
	}

	public function delete($class_id)
	{
		$this->db->where('cs_class_id', $class_id);
		$this->db->delete($this->_table);
	}

}
