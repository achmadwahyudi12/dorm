<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Room extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('auth_model');
		$this->load->model('room_model');
		$this->load->model('dorm_model');
		$this->load->helper('rupiah');
	}

	public function index()
	{
		if ($this->session->userdata('user_id') != TRUE) {
			redirect('auth');
		}

		$data['list_room'] = array();
		$dormId = $this->input->get('dorm');
		$checkDorm = $this->dorm_model->get_dorm($dormId);
		if ($checkDorm) {
			$data['list_room'] = $this->room_model->get_rooms($dormId);
			$data['dorm'] = $checkDorm;
		}

		$data['profil'] = $this->auth_model->current_user();

		$this->load->view('template/page_header', $data);
		$this->load->view('pages/room/listTable');
		$this->load->view('template/page_footer');
	}

	public function form(){
		if ($this->session->userdata('user_id') != TRUE) {
			redirect('auth');
		}

		$dorm_id = $this->input->get('dorm');
		$editValue = $this->input->get('edit');
		$checkRoom = $this->room_model->get_room($editValue);
		if ($checkRoom) {
			$data['room'] = $checkRoom;
		}

		$data['profil'] = $this->auth_model->current_user();
		$data['dorm_detail'] = $this->dorm_model->get_dorm($dorm_id);

		$this->load->view('template/page_header', $data);
		$this->load->view('pages/room/forms');
		$this->load->view('template/page_footer');
	}

	public function add_room(){
		$data = array(
			'id_dorm' => $this->input->post('id_dorm', TRUE),
			'floor' => $this->input->post('floor', TRUE),
			'name' => $this->input->post('name', TRUE),
			'price' => $this->input->post('price', TRUE),
			'description' => $this->input->post('description', TRUE),
			'created_at' => (new DateTime())->format('Y-m-d H:i:s'),
			'updated_at' => (new DateTime())->format('Y-m-d H:i:s'),
			'created_by' => $this->session->userdata('user_id'),
			'updated_by' => $this->session->userdata('user_id'),
		);

		$result = $this->room_model->add_room($data);
		if($result){
			$this->session->set_flashdata('room_message_success', 'Data ruangan berhasil disimpan.');
			redirect("room?dorm=" . $data["id_dorm"]);
		}else{
			$this->session->set_flashdata('room_message_failed', 'Data ruangan gagal disimpan.');
			redirect("room?dorm=" . $data["id_dorm"]);
		}
	}

	public function update_room(){
		$dorm_id = $this->input->post('id_dorm', TRUE);
		$room_id = $this->input->post('id', TRUE);
		$data = array(
			'floor' => $this->input->post('floor', TRUE),
			'name' => $this->input->post('name', TRUE),
			'price' => $this->input->post('price', TRUE),
			'down_payment' => $this->input->post('down_payment', TRUE),
			'description' => $this->input->post('description', TRUE),
			'updated_at' => (new DateTime())->format('Y-m-d H:i:s'),
			'updated_by' => $this->session->userdata('user_id'),
		);

		$result = $this->room_model->update_room($room_id, $data);
		if($result){
			$this->session->set_flashdata('room_message_success', 'Data ruangan berhasil diubah.');
			redirect("room?dorm=" . $dorm_id);
		}else{
			$this->session->set_flashdata('room_message_failed', 'Data ruangan gagal diubah.');
			redirect("room?dorm=" . $dorm_id);
		}
	}

	public function delete_room(){
		$dorm_id = $this->input->post('dormId', TRUE);
		$id = $this->input->post('deleteId', TRUE);
		$result = $this->room_model->delete_room($id);
		if($result){
			$this->session->set_flashdata('room_message_success', 'Data ruangan berhasil dihapus.');
			redirect("room?dorm=" . $dorm_id);
		}else{
			$this->session->set_flashdata('room_message_failed', 'Data ruangan gagal dihapus.');
			redirect("room?dorm=" . $dorm_id);
		}
	}
}
