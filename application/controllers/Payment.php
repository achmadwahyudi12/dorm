<?php

class Payment extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('auth_model');
		$this->load->model('payment_model');
		$this->load->helper('rupiah');
	}

	public function index()
	{
        if ($this->session->userdata('user_id') != TRUE) {
			redirect('auth');
		}

		$data['profil'] = $this->auth_model->current_user();
		$data['list_payment'] = $this->payment_model->get_payments();

		$this->load->view('template/page_header', $data);
		$this->load->view('pages/payment/listTable');
		$this->load->view('template/page_footer');
    }
}