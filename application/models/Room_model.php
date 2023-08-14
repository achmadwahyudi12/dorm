<?php

class Room_model extends CI_Model
{
	private $_table = "rooms";

	public function get_rooms($dorm_id)
	{
		$this->db->select('d.id AS dorm_id, d.name AS dorm_name, d.down_payment, d.total_floors, d.minimum_order, r.*');
		$this->db->from('dorms AS d');
		$this->db->join('rooms AS r', 'r.id_dorm = d.id');
		$this->db->where('r.id_dorm', $dorm_id);

		$query = $this->db->get();
		return $query->result_array();
	}

	public function get_rooms_available($dorm_id)
	{
		$query = $this->db->get_where($this->_table, array('id_dorm' => $dorm_id));
		$this->db->select('bookings.id, bookings.code as booking_code, payments.*');
        $this->db->from('bookings');
        $this->db->join('payments', 'bookings.id = payments.id_booking');
		return $query->result_array();
	}

	public function get_room($id)
	{
		$query = $this->db->get_where($this->_table, array('id' => $id));
		return $query->row();
	}

    public function add_room($data) {
        $this->db->insert($this->_table, $data);
        return $this->db->insert_id();
    }

	public function update_room($room_id, $data) {
        $this->db->where('id', $room_id);
        $this->db->update($this->_table, $data);
        return $this->db->affected_rows() > 0;
    }
	
    public function delete_room($id) {
		$this->db->where('id', $id);
        $this->db->delete($this->_table);
		return $this->db->affected_rows() > 0;
    }
}