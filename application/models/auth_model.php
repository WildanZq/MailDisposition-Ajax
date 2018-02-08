<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth_model extends CI_Model {

	public function login($username,$password)
	{
		$user = $this->db
		->where('username', $username)
		->get('user')->row_array();
		
		if (password_verify($password, $user['password'])) {
			$array = array(
				'id' => $user['id'],
				'login' => true,
				'level' => $user['level'],
				'user' => $user
			);
			$this->session->set_userdata( $array );

			return true;
		}

		return false;
	}

}

/* End of file auth_model.php */
/* Location: ./application/models/auth_model.php */