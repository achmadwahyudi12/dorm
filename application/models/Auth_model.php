<?php

class Auth_model extends CI_Model
{
	private $_table = "users";
	const SESSION_KEY = 'user_id';

	public function verify_password($user_id, $current_password)
    {
        $query = $this->db->get_where('users', array('id' => $user_id));
        $user = $query->row();

        // Compare the hashed current password with the provided current password
        return password_verify($current_password, $user->password);
    }

    public function update_password($user_id, $new_password)
    {
        $data = array(
            'password' => password_hash($new_password, PASSWORD_DEFAULT),
        );
        $this->db->where('id', $user_id);
        $this->db->update('users', $data);
		return $this->db->affected_rows() > 0;
    }

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