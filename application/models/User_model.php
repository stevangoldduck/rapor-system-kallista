<?php

class User_model extends CI_Model
{
    private $_table = "users";

    public function doLogin(){
		$post = $this->input->post();

        $this->db->where('username', $post["username"]);
        $user = $this->db->get($this->_table)->row();

        if($user){
            $isPasswordTrue = password_verify($post["password"], $user->password);

            // jika password benar dan dia admin
            if($isPasswordTrue){ 
                // login sukses yay!
                $this->session->set_userdata(['user_logged' => $user]);
                return true;
            }
        }
        
        // login gagal
		return false;
    }

    public function isNotAuthenticated(){
        return $this->session->userdata('user_logged') === null;
	}

	public function encryptPassword($password)
	{
		return  password_hash($password, PASSWORD_BCRYPT);
	}
	
	public function user_datatable()
	{
		$this->load->library('datatables');
		$this->datatables->select('id,username,name,phone,email');
		$this->datatables->from('users');
		$this->datatables->edit_column('id', anchor('users/$1/edit','Edit',array('class'=>'btn btn-info btn-sm')).' '.anchor('users/$1/delete','Delete',array('class'=>'btn btn-danger btn-sm')), 'id');
		//$this->datatables->add_column('action', anchor('users/edit/$1','Edit',array('class'=>'btn btn-danger btn-sm')));
        
        return print_r($this->datatables->generate());
	}

	public function findUserById(int $id)
	{
		$this->db->where('id',$id);
		$user = $this->db->get($this->_table)->row();
		if(!empty($user))
		{
			return $user;
		}
		else{
			show_404();
		}
	}

	public function edit($id,$data,$password)
	{
		$this->db->where('id',$id);
		if($password != '')
		{
			$this->db->set('password', $this->encryptPassword($password));
		}
		$this->db->update($this->_table,$data);

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

	public function getAuthUser()
	{
		return $_SESSION['user_logged'];
	}

	public function getAllUser()
	{
		$users = $this->db->get($this->_table);
		return $users->result();
	}

	public function hasAccess(string $permission_name)
	{
		$user_id = $this->session->userdata('user_logged');

		$user_access = $this->findUserById($user_id->id);


		$is_allowed = false;
		
		foreach(json_decode($user_access->user_access,TRUE) as $key => $item)
		{
			if($key == $permission_name)
			{
				$is_allowed = true;
				break;
			}
		}

		if($is_allowed == false)
		{
			// echo $user_access->user_access;
			return show_error('Unable to do this action',401,'Unrestricted Action');
		}
		else{
			return true;
		}
		
	}

}
