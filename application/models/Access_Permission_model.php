<?php

class Access_Permission_model extends CI_Model
{
    private $_table = "access_permission";

	public function getAllAccess()
	{
		$ap = $this->db->get($this->_table);
		return $ap->result_array();
	}

}
