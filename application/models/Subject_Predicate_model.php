<?php

class Subject_Predicate_model extends CI_Model
{
	private $_table = "subject_predicate";

	public function findPredicateById(int $id)
	{
		$this->db->where('sp_id', $id);
		$subject = $this->db->get($this->_table)->row_array();
		if (!empty($subject)) {
			return $subject;
		} else {
			show_404();
		}
	}

	public function edit($id, $data)
	{
		$this->db->where('sp_id', $id);
		$this->db->update($this->_table, $data);
		return true;
	}

	public function insert($data)
	{
		$this->db->trans_start();
		$this->db->insert($this->_table, $data);
		$insert_id = $this->db->insert_id();
		$this->db->trans_complete();
		return $insert_id;
	}

}
