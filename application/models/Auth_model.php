<?php

class Auth_model extends CI_Model
{
	private $_table = "users";
	const SESSION_KEY = 'user_id';

	public function login($username, $password)
	{
		$this->db->where('username', $username);
		$query = $this->db->get($this->_table);
		$user = $query->row();

		// check user exists
		if (!$user) {
			return FALSE;
		}

		// check password is correct
		if (!password_verify($password, $user->password)) {
			return FALSE;
		}

		// create session
		$this->session->set_userdata([self::SESSION_KEY => $user->id]);

		return $this->session->has_userdata(self::SESSION_KEY);
	}

	public function current_user()
	{
		if (!$this->session->has_userdata(self::SESSION_KEY)) {
			return null;
		}

		$user_id = $this->session->userdata(self::SESSION_KEY);
		$query = $this->db->get_where($this->_table, ['id' => $user_id]);
		return $query->row();
	}

	public function logout()
	{
		$this->session->unset_userdata(self::SESSION_KEY);
		return !$this->session->has_userdata(self::SESSION_KEY);
	}
}