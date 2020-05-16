<?php

class Class_Sequence_model extends CI_Model
{
    private $_table = "class_sequence";

	public function findSeqById(int $id)
	{
		$this->db->where('cseq_id',$id);
		$cseq = $this->db->get($this->_table)->row_array();
		if(!empty($cseq))
		{
			return $cseq;
		}
		else{
			show_404();
		}
	}

	public function edit($id,$data)
	{
		$this->db->where('cseq_id',$id);
		$this->db->update($this->_table,$data);
		return true;
	}

}
