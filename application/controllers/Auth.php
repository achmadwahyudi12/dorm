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
			redirect('auth');
		}
	}

	public function logout()
	{
		$this->auth_model->logout();
		redirect('login');
	}

	public function change_password()
	{
		if ($this->session->userdata('user_id') != TRUE) {
			redirect('auth');
		}

		$data['profil'] = $this->auth_model->current_user();

		$this->load->view('template/page_header', $data);
		$this->load->view('pages/auth/changePassword');
		$this->load->view('template/page_footer');
	}

	public function save_change_password()
	{
		$old_password = $this->input->post("old_password", TRUE);
		$new_password = $this->input->post("new_password", TRUE);
		$new_password_confirmation = $this->input->post("new_password_confirmation", TRUE);
		$user_id = $this->session->userdata('user_id');

		// Verify the current password
		if ($this->auth_model->verify_password($user_id, $old_password)) {
			if ($new_password != $new_password_confirmation) {
				$this->session->set_flashdata('change_password_message_failed', 'Password baru dan password konfirmasi tidak sesuai');
				redirect("auth/change_password");
			}else{
				// Update the password in the database
				$result = $this->auth_model->update_password($user_id, $new_password);
				if($result){
					$this->session->set_flashdata('change_password_message_success', 'Ubah password berhasil.');
					redirect("auth/change_password");
				}else{
					$this->session->set_flashdata('change_password_message_failed', 'Ubah password gagal.');
					redirect("auth/change_password");
				}
			}
		} else {
			$this->session->set_flashdata('change_password_message_failed', 'Password lama tidak sesuai.');
			redirect("auth/change_password");
		}
			
	}
	
}