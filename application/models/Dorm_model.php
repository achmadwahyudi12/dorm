<?php

class Dorm_model extends CI_Model
{
	private $_table = "dorms";

	public function get_dorms()
	{
		$this->db->select('dorms.*, dorms.name, dorms.phone, dorms.address, dorms.total_floors, dorms.down_payment, dorms.minimum_order, COUNT(rooms.id) as total_rooms');
		$this->db->from('dorms');
		$this->db->join('rooms', 'rooms.id_dorm = dorms.id', 'left');
		$this->db->group_by('dorms.id');

		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			$result = $query->result_array();
		} else {
			echo "No results found.";
		}

		return $query->result_array();
	}

	public function get_dorms_rooms()
	{
		$this->db->select('d.name AS name_dorm, r.*');
		$this->db->from('db_dorms.dorms AS d');
		$this->db->join('db_dorms.rooms AS r', 'd.id = r.id_dorm', 'inner');
		$this->db->join('db_dorms.bookings AS b', 'r.id = b.id_room AND CURDATE() >= b.end_date', 'left', false);
		$this->db->where('b.id_room IS NULL');

		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			$result = $query->result_array();
		} else {
			echo "No results found.";
		}

		return $query->result_array();
	}

	public function get_dorm($id)
	{
		$query = $this->db->get_where($this->_table, array('id' => $id));
		return $query->row();
	}

    public function add_dorm($data) {
        $this->db->insert($this->_table, $data);
        return $this->db->insert_id();
    }

	public function update_dorm($dorm_id, $data) {
        $this->db->where('id', $dorm_id);
        $this->db->update($this->_table, $data);
        return $this->db->affected_rows() > 0;
    }
	
    public function delete_dorm($id) {
		$this->db->where('id', $id);
        $this->db->delete($this->_table);
		// $this->db->where('id_dorm', $id);
        // $this->db->delete('rooms');
		return $this->db->affected_rows() > 0;
    }
}