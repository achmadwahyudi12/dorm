<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('auth_model');
		$this->load->model('main_model');
		$this->load->model('dorm_model');
		$this->load->model('payment_model');
	}

	public function index()
	{
		if ($this->session->userdata('user_id') != TRUE) {
			redirect('auth');
		}

		$data['id_dorm'] = $this->input->post('id_dorm', TRUE);

		// get dorm summary room
		$data['list_summary_room'] = $this->main_model->get_dorms_summary_room();
		// get list dorm
		$data['dorms'] = $this->dorm_model->get_dorms();
		// get earnings overview
		$data['earnings'] = $this->payment_model->get_earnings_month($data['id_dorm']);

		$data['profil'] = $this->auth_model->current_user();
		$this->load->view('template/page_header', $data);
		$this->load->view('pages/dashboard/index');
		$this->load->view('template/page_footer');
	}
}
