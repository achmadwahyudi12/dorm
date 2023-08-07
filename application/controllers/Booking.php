<?php

class Booking extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('auth_model');
		$this->load->model('booking_model');
		$this->load->model('customer_model');
		$this->load->model('dorm_model');
		$this->load->model('room_model');
		$this->load->model('payment_model');
		$this->load->helper('rupiah');
	}

	public function index()
	{
        if ($this->session->userdata('user_id') != TRUE) {
			redirect('auth');
		}

		$data['profil'] = $this->auth_model->current_user();
		$data['list_booking'] = $this->booking_model->get_bookings();

		$this->load->view('template/page_header', $data);
		$this->load->view('pages/booking/listTable');
		$this->load->view('template/page_footer');
    }

    public function form(){
		if ($this->session->userdata('user_id') != TRUE) {
			redirect('auth');
		}

		// $editValue = $this->input->get('edit');
		// $checkBooking = $this->customer_model->get_customer($editValue);
		// if ($checkBooking) {
		// 	$data['booking'] = $checkBooking;
		// }

		$data['profil'] = $this->auth_model->current_user();
        $data['list_customer'] = $this->customer_model->get_customers();
        $data['list_dorm'] = $this->dorm_model->get_dorms_rooms();

		$this->load->view('template/page_header', $data);
		$this->load->view('pages/booking/forms');
		$this->load->view('template/page_footer');
	}

    public function add_booking(){
        $room_id = $this->input->post('room_id', TRUE);
        $length_of_stay = $this->input->post('length_of_stay', TRUE);
        $current_payment = $this->input->post('current_payment', TRUE);
		$start_date = $this->input->post('start_date', TRUE);
        $result_room = $this->room_model->get_room($room_id);
        $total_payment = $result_room->price * $length_of_stay;
        
        $data = array(
            'id_dorm' => $result_room->id_dorm,
			'id_room' => $room_id,
			'id_customer' => $this->input->post('customer_id', TRUE),
			'code' => date('YmdHis'),
			'start_date' => $start_date,
			'end_date' => (new DateTime($start_date))->modify('+3 months')->format('Y-m-d H:i:s'),
			'length_of_stay' => $length_of_stay,
			'current_payment' => $current_payment,
			'total_payment' => $total_payment,
			'status' => $this->booking_model->get_status_booking($current_payment, $total_payment),
			'created_at' => (new DateTime())->format('Y-m-d H:i:s'),
			'updated_at' => (new DateTime())->format('Y-m-d H:i:s'),
			'created_by' => $this->session->userdata('user_id'),
			'updated_by' => $this->session->userdata('user_id'),
		);
		
		$result = $this->booking_model->add_booking($data);
		if($result){
			if ($current_payment > 0) {
				$data_payment = array(
					'id_booking' => $result,
					'code' => "TRX-" . date('YmdHis'),
					'amount' => $current_payment,
					'description' => "pembayaran DP",
					'created_at' => (new DateTime())->format('Y-m-d H:i:s'),
					'updated_at' => (new DateTime())->format('Y-m-d H:i:s'),
					'created_by' => $this->session->userdata('user_id'),
					'updated_by' => $this->session->userdata('user_id'),
				);
				$this->payment_model->add_payment($data_payment);
			}
			$this->session->set_flashdata('booking_message_success', 'Data booking berhasil disimpan.');
			redirect("booking");
		}else{
			$this->session->set_flashdata('booking_message_failed', 'Data booking gagal disimpan.');
			redirect("booking");
		}
	}

	public function delete_booking(){
		$id = $this->input->post('deleteId', TRUE);
		$result = $this->booking_model->delete_booking($id);
		if($result){
			$this->session->set_flashdata('customer_message_success', 'Data booking berhasil dihapus.');
			redirect("booking");
		}else{
			$this->session->set_flashdata('customer_message_failed', 'Data booking gagal dihapus.');
			redirect("booking");
		}
	}

	public function get_detail_room(){
		$room_id = $this->input->post('room_id', true);
		$room = $this->room_model->get_room($room_id);

		echo json_encode($room);
	}
}