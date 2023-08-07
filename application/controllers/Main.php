<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->helper('rupiah');
		$this->load->model('auth_model');
		$this->load->model('main_model');
		$this->load->model('dorm_model');
		$this->load->model('payment_model');
		$this->load->model('booking_model');
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
		$data['earnings'] = $this->main_model->get_earnings_month($data['id_dorm']);
		// get total earnings
		$data['total_earnings'] = $this->main_model->get_total_earnings()->total;
		// get money booked
		$data['money_booked'] = $this->main_model->get_total_money_booked()->total;
		// get total room used
		$data['total_room_used'] = $this->main_model->get_total_room_used()->total;
		// get total room booked
		$data['total_room_booked'] = $this->main_model->get_total_room_booked()->total;

		// var_dump($data['total_earnings']);die;

		$data['profil'] = $this->auth_model->current_user();
		$this->load->view('template/page_header', $data);
		$this->load->view('pages/dashboard/index');
		$this->load->view('template/page_footer');
	}
}
