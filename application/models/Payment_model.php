<?php

class Payment_model extends CI_Model
{
	private $_table = "payments";

    public function get_payments()
	{
        $this->db->select('bookings.id, bookings.code, payments.*');
        $this->db->from('bookings');
        $this->db->join('payments', 'bookings.id = payments.id_booking');
        $query = $this->db->get();
		return $query->result_array();
	}

	public function add_payment($data) {
        $this->db->insert($this->_table, $data);
        return $this->db->insert_id();
    }
}