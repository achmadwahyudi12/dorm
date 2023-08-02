<?php

class Auth extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('auth_model');
	}

	public function index()
	{
		if ($this->session->userdata('user_id') != FALSE) {
			redirect('dashboard');
		}

		$this->load->view('pages/auth/login');
	}

	public function login()
	{	
		$username = $this->input->post('username', TRUE);
		$password = $this->input->post('password', TRUE);
		$is_login = $this->auth_model->login($username, $password);
		
		if($is_login){
			redirect('dashboard');
		} else {
			$this->session->set_flashdata('message_login_error', 'Username atau password salah');
		}
	}

	public function logout()
	{
		$this->auth_model->logout();
		var_dump($this->auth_model->logout());
		redirect('login');
	}
}