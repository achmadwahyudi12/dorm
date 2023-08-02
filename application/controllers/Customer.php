<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Customer extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('auth_model');
		$this->load->model('customer_model');
	}

	public function index()
	{
		if ($this->session->userdata('user_id') != TRUE) {
			redirect('auth');
		}

		$data['profil'] = $this->auth_model->current_user();
		$data['list_customer'] = $this->customer_model->get_customers();

		$this->load->view('template/page_header', $data);
		$this->load->view('pages/customer/listTable');
		$this->load->view('template/page_footer');
	}

	public function form(){
		if ($this->session->userdata('user_id') != TRUE) {
			redirect('auth');
		}

		$editValue = $this->input->get('edit');
		$checkCustumer = $this->customer_model->get_customer($editValue);
		if ($checkCustumer) {
			$data['customer'] = $checkCustumer;
		}

		$data['profil'] = $this->auth_model->current_user();

		$this->load->view('template/page_header', $data);
		$this->load->view('pages/customer/forms');
		$this->load->view('template/page_footer');
	}

	public function add_customer(){
		$data = array(
			'nik' => $this->input->post('nik', TRUE),
			'name' => $this->input->post('name', TRUE),
			'gender' => $this->input->post('gender', TRUE),
			'phone' => $this->input->post('phone', TRUE),
			'phone_emergency' => $this->input->post('phone_emergency', TRUE),
			'address' => $this->input->post('address', TRUE),
		);

		$result = $this->customer_model->add_customer($data);
		if($result){
			$this->session->set_flashdata('customer_message_success', 'Data pelanggan berhasil disimpan.');
			redirect("customer");
		}else{
			$this->session->set_flashdata('customer_message_failed', 'Data pelanggan gagal disimpan.');
			redirect("customer");
		}
	}

	public function update_customer(){
		$customer_id = $this->input->post('id', TRUE);
		$data = array(
			'nik' => $this->input->post('nik', TRUE),
			'name' => $this->input->post('name', TRUE),
			'gender' => $this->input->post('gender', TRUE),
			'phone' => $this->input->post('phone', TRUE),
			'phone_emergency' => $this->input->post('phone_emergency', TRUE),
			'address' => $this->input->post('address', TRUE),
		);

		$result = $this->customer_model->update_customer($customer_id, $data);
		if($result){
			$this->session->set_flashdata('customer_message_success', 'Data pelanggan berhasil diubah.');
			redirect("customer");
		}else{
			$this->session->set_flashdata('customer_message_failed', 'Data pelanggan gagal diubah.');
			redirect("customer");
		}
	}

	public function delete_customer(){
		$id = $this->input->post('deleteId', TRUE);
		$result = $this->customer_model->delete_customer($id);
		if($result){
			$this->session->set_flashdata('customer_message_success', 'Data pelanggan berhasil dihapus.');
			redirect("customer");
		}else{
			$this->session->set_flashdata('customer_message_failed', 'Data pelanggan gagal dihapus.');
			redirect("customer");
		}
	}
}
