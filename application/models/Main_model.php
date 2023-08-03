<?php

class Main_model extends CI_Model
{

	public function get_dorms_summary_room()
	{
		$query = $this->db->get("dorm_summary_room");
		return $query->result_array();
	}

}