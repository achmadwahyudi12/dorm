<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dorm extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('auth_model');
		$this->load->model('dorm_model');
		$this->load->helper('rupiah');
	}

	public function index()
	{
		if ($this->session->userdata('user_id') != TRUE) {
			redirect('auth');
		}

		$data['profil'] = $this->auth_model->current_user();
		$data['list_dorm'] = $this->dorm_model->get_dorms();

		$this->load->view('template/page_header', $data);
		$this->load->view('pages/dorm/listTable');
		$this->load->view('template/page_footer');
	}

	public function form(){
		if ($this->session->userdata('user_id') != TRUE) {
			redirect('auth');
		}

		$editValue = $this->input->get('edit');
		$checkDorm = $this->dorm_model->get_dorm($editValue);
		if ($checkDorm) {
			$data['dorm'] = $checkDorm;
		}

		$data['profil'] = $this->auth_model->current_user();

		$this->load->view('template/page_header', $data);
		$this->load->view('pages/dorm/forms');
		$this->load->view('template/page_footer');
	}

	public function add_dorm(){
		$data = array(
			'name' => $this->input->post('name', TRUE),
			'phone' => $this->input->post('phone', TRUE),
			'address' => $this->input->post('address', TRUE),
			'total_floors' => $this->input->post('total_floors', TRUE),
			'minimum_order' => $this->input->post('minimum_order', TRUE),
			'down_payment' => $this->input->post('down_payment', TRUE),
		);

		$result = $this->dorm_model->add_dorm($data);
		if($result){
			$this->session->set_flashdata('dorm_message_success', 'Data asrama berhasil disimpan.');
			redirect("dorm");
		}else{
			$this->session->set_flashdata('dorm_message_failed', 'Data asrama gagal disimpan.');
			redirect("dorm");
		}
	}

	public function update_dorm(){
		$dorm_id = $this->input->post('id', TRUE);
		$data = array(
			'name' => $this->input->post('name', TRUE),
			'phone' => $this->input->post('phone', TRUE),
			'address' => $this->input->post('address', TRUE),
		);

		$result = $this->dorm_model->update_dorm($dorm_id, $data);
		if($result){
			$this->session->set_flashdata('dorm_message_success', 'Data asrama berhasil diubah.');
			redirect("dorm");
		}else{
			$this->session->set_flashdata('dorm_message_failed', 'Data asrama gagal diubah.');
			redirect("dorm");
		}
	}

	public function delete_dorm(){
		$id = $this->input->post('deleteId', TRUE);
		$result = $this->dorm_model->delete_dorm($id);
		if($result){
			$this->session->set_flashdata('dorm_message_success', 'Data asrama berhasil dihapus.');
			redirect("dorm");
		}else{
			$this->session->set_flashdata('dorm_message_failed', 'Data asrama gagal dihapus.');
			redirect("dorm");
		}
	}
}
