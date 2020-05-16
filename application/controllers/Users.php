<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Users extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();

		$this->load->helper('url');
		$this->load->library(array('template','form_validation'));
		$this->load->model(array("user_model","access_permission_model"));

		if ($this->user_model->isNotAuthenticated()) redirect(site_url('/'));
	}

	public function index()
	{
		$this->template->set('title', 'Users | Dashboard');
		$this->template->load('app', 'contents', 'users/index.php', []);
		$this->template->push_js('push_js', 'users/scripts/datatable.php');
	}

	public function list_user()
	{
		$user = new User_model();
		return $user->user_datatable();
	}

	public function edit($id)
	{
		$user = new User_model();
		$data = $user->findUserById($id);

		$data->access = $this->access_permission_model->getAllAccess();

		$this->template->set('title', 'User Edit | Dashboard');
		$this->template->load('app', 'contents', 'users/edit.php', $data);
	}

	public function update()
	{
		$id = $this->input->post('user_id');
		$user = new User_model();
		$data = $user->findUserById($id);

		$access = new Access_Permission_model();
		$ap = $access->getAllAccess();

		if ($this->input->post('username') != $data->username) {
			$is_unique =  '|is_unique[users.username]';
		} else {
			$is_unique =  '';
		}

		if ($this->input->post('email') != $data->email) {
			$is_unique_email =  '|is_unique[users.email]';
		} else {
			$is_unique_email =  '';
		}

		$this->form_validation->set_rules('username', 'username', 'required' . $is_unique);
		$this->form_validation->set_rules('email', 'email', 'required' . $is_unique_email);


		$password = $this->input->post('password') ? $this->input->post('password') : '';

		$data = array(
			'username' => $this->input->post('username'),
			'email' => $this->input->post('email'),
			'phone' => $this->input->post('phone'),
			'address' => $this->input->post('address'),
			'name' => $this->input->post('name'),
			'role' => $this->input->post('role'),
		);

		$access_permission = [];
		foreach($ap as $item)
		{
			if(isset($_POST[$item['ap_permission']]))
			{
				$access_permission[$item['ap_permission']] = true;
			}
		}

		$data['user_access'] = json_encode($access_permission);

		if($this->form_validation->run() != false){
			if($this->user_model->edit($id,$data,$password))
			{
				$this->session->set_flashdata('success', 'Record saved!!');
				redirect(site_url('users/'.$id.'/edit'));
			}
		}
		else{
			$this->edit($id);
		}

		// $this->m_data->update_data($where, $data, 'user');
		// redirect('crud/index');
	}
}
