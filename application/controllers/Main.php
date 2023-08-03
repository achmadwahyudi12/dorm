<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('auth_model');
		$this->load->model('main_model');
	}

	public function index()
	{
		if ($this->session->userdata('user_id') != TRUE) {
			redirect('auth');
		}

		// get dorm summary room
		$data['list_summary_room'] = $this->main_model->get_dorms_summary_room();

		$data['profil'] = $this->auth_model->current_user();
		$this->load->view('template/page_header', $data);
		$this->load->view('pages/dashboard/index');
		$this->load->view('template/page_footer');
	}
}
