<?php

class Main_model extends CI_Model
{

	public function get_dorms_summary_room()
	{
		$query = $this->db->get("dorm_summary_room");
		return $query->result_array();
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

	public function get_total_earnings(){
        $this->db->select_sum('current_payment', 'total');
		$this->db->from('bookings');
		$this->db->where('status', 'paid');
		$query = $this->db->get();
        return $query->row();
    }

	public function get_total_money_booked(){
        $this->db->select_sum('current_payment', 'total');
		$this->db->from('bookings');
		$this->db->where('status !=', 'paid');
		$query = $this->db->get();
        return $query->row();
    }

	public function get_total_room_used(){
        $this->db->select_sum('total_room_used', 'total');
		$this->db->from('dorm_summary_room');
		$query = $this->db->get();
        return $query->row();
    }

	public function get_total_room_available(){
        $this->db->select_sum('total_room_available', 'total');
		$this->db->from('dorm_summary_room');
		$query = $this->db->get();
        return $query->row();
    }

}