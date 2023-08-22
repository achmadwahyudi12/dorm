<?php

class Booking_model extends CI_Model
{
	private $_table = "bookings";

	public function get_bookings()
	{
		$this->db->select('bookings.*, dorms.name AS dorm_name, rooms.floor, rooms.name AS room_name, customers.name AS customer_name');
		$this->db->from('bookings');
		$this->db->join('dorms', 'bookings.id_dorm = dorms.id');
		$this->db->join('customers', 'bookings.id_customer = customers.id');
		$this->db->join('rooms', 'bookings.id_room = rooms.id');
		$this->db->order_by('bookings.id', 'DESC');

		$query = $this->db->get();
		return $query->result_array();
	}
	
	public function get_booking_by_code($code){
		$query = $this->db->get_where($this->_table, array('code' => $code));
		return $query->row();
	}

	public function get_status_booking($current, $total){
		$status = "";
		if($current == 0){
			$status = "unpaid";
		}elseif($current > 0 && $current < $total){
			$status = "outstanding";
		}elseif($current > 0 && $current >= $total){
			$status = "paid";
		}else{
			$status = "failed";
		}

		return $status;
	}

	public function add_booking($data) {
        $this->db->insert($this->_table, $data);
        return $this->db->insert_id();
    }

	public function delete_booking($id) {
		$this->db->where('id', $id);
        $this->db->delete($this->_table);
		return $this->db->affected_rows() > 0;
    }

	public function update_booking($booking_id, $data) {
        $this->db->where('id', $booking_id);
        $this->db->update($this->_table, $data);
        return $this->db->affected_rows() > 0;
    }
}