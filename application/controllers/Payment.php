<?php

class Payment extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('auth_model');
		$this->load->model('payment_model');
		$this->load->model('booking_model');
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

	public function form(){
		if ($this->session->userdata('user_id') != TRUE) {
			redirect('auth');
		}

		$data['profil'] = $this->auth_model->current_user();

		$this->load->view('template/page_header', $data);
		$this->load->view('pages/payment/forms');
		$this->load->view('template/page_footer');
	}

	public function add_payment(){
		$booking_code = $this->input->post("booking_code", TRUE); 
		$amount = $this->input->post("amount", TRUE); 
		$description = $this->input->post("description", TRUE); 
		$booking = $this->booking_model->get_booking_by_code($booking_code);

		if ($booking->id) {
			$data_payment = array(
				'id_booking' => $booking->id,
				'code' => "TRX-" . date('YmdHis'),
				'amount' => $amount,
				'description' => $description,
				'created_at' => (new DateTime())->format('Y-m-d H:i:s'),
				'updated_at' => (new DateTime())->format('Y-m-d H:i:s'),
				'created_by' => $this->session->userdata('user_id'),
				'updated_by' => $this->session->userdata('user_id'),
			);

			$result = $this->payment_model->add_payment($data_payment);
			if ($result) {
				// update current payment on data booking
				$current_payment = $booking->current_payment + $amount;
				$current_status = $this->booking_model->get_status_booking($current_payment, $booking->total_payment);
				$data_booking = array(
					'current_payment' => $current_payment,
					'status' => $current_status,
					'updated_at' => (new DateTime())->format('Y-m-d H:i:s'),
					'updated_by' => $this->session->userdata('user_id'),
				);
				$updated = $this->booking_model->update_booking($booking->id,$data_booking);

				// save payment data per month when the order status is paid
				if ($current_status == 'paid') {
					$start_date = new DateTime($booking->start_date);
					$end_date = new DateTime($booking->end_date);

					$interval = DateInterval::createFromDateString('1 month');
					$period = new DatePeriod($start_date, $interval, $end_date);

					foreach ($period as $date) {
						$data_payment_per_month = array(
							'id_booking' => $booking->id,
							'month_pay' => $date->modify('+1 month')->format('Y-m-d'),
							'amount' => $booking->total_payment / $booking->length_of_stay,
							'created_at' => (new DateTime())->format('Y-m-d H:i:s'),
							'created_by' => $this->session->userdata('user_id'),
						);
						
						$this->payment_model->add_payment_per_month($data_payment_per_month);
					}
				}

				$this->session->set_flashdata('payment_message_success', 'Data transaksi berhasil disimpan.');
				redirect("payment");
			} else {
				$this->session->set_flashdata('payment_message_failed', 'Data transaksi gagal disimpan.');
				redirect("payment");
			}
			
		}else{
			$this->session->set_flashdata('payment_message_failed', 'Kode booking tidak ditemukan.');
			redirect("payment/form");
		}
	}
}