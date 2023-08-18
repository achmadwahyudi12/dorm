<?php

class Customer_model extends CI_Model
{
	private $_table = "customers";

	public function get_customers()
	{
		$this->db->select('*');
		$this->db->from('customers');
		$this->db->order_by('NAME', 'ASC');

		$query = $this->db->get();
		return $query->result_array();
	}

	public function get_customer($id)
	{
		$query = $this->db->get_where($this->_table, array('id' => $id));
		return $query->row();
	}

    public function add_customer($data) {
        $this->db->insert('customers', $data);
        return $this->db->insert_id();
    }

	public function update_customer($customer_id, $data) {
        $this->db->where('id', $customer_id);
        $this->db->update($this->_table, $data);
        return $this->db->affected_rows() > 0;
    }
	
    public function delete_customer($id) {
		$this->db->where('id', $id);
        $this->db->delete($this->_table);
		return $this->db->affected_rows() > 0;
    }
}