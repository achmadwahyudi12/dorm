<?php

class Room_model extends CI_Model
{
	private $_table = "rooms";

	public function get_rooms($dorm_id)
	{
		$query = $this->db->get_where($this->_table, array('id_dorm' => $dorm_id));
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