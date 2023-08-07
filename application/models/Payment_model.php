<?php

class Payment_model extends CI_Model
{
	private $_table = "payments";

    public function get_payments()
	{
        $this->db->select('bookings.id, bookings.code as booking_code, payments.*');
        $this->db->from('bookings');
        $this->db->join('payments', 'bookings.id = payments.id_booking');
        $query = $this->db->get();
		return $query->result_array();
	}

	public function add_payment($data) {
        $this->db->insert($this->_table, $data);
        return $this->db->insert_id();
    }

	public function add_payment_per_month($data) {
        $this->db->insert("payments_month", $data);
        return $this->db->insert_id();
    }

    public function get_earnings_month($id_dorm){
        if ($id_dorm) {
            $this->db->select('d.name AS dorm_name, YEAR(pm.month_pay) AS year, MONTH(pm.month_pay) AS month, SUM(pm.amount) AS total_earnings');
            $this->db->from('payments_month pm');
            $this->db->join('dorms d', 'pm.id_dorm = d.id');
            // $this->db->where('pm.month_pay >=', $start_date);
            // $this->db->where('pm.month_pay <=', $end_date);
            $this->db->where('d.id =', $id_dorm);
            $this->db->group_by('d.name, YEAR(pm.month_pay), MONTH(pm.month_pay)');
            $this->db->order_by('d.name, YEAR(pm.month_pay), MONTH(pm.month_pay)');
        }else{
            $this->db->select('YEAR(pm.month_pay) AS year, MONTH(pm.month_pay) AS month, SUM(pm.amount) AS total_earnings');
            $this->db->from('payments_month pm');
            $this->db->join('dorms d', 'pm.id_dorm = d.id');
            // $this->db->where('pm.month_pay >=', $start_date);
            // $this->db->where('pm.month_pay <=', $end_date);
            $this->db->group_by('YEAR(pm.month_pay), MONTH(pm.month_pay)');
            $this->db->order_by('YEAR(pm.month_pay), MONTH(pm.month_pay)');
        }
        
        $query = $this->db->get();
        return $query->result_array();
        
    }
}