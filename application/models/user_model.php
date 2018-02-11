<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model {

	public function getAll()
	{
		return $this->db->get('user')->result();
	}

	public function getAllLowLevel($level)
	{
		return $this->db
		->where('level > '.$level)
		->get('user')->result();
	}

	public function search($query)
	{
		return $this->db
		->like('username', $query)
		->or_like('fullname', $query)
		->or_like('level', $query)
		->get('user')->result();
	}

	public function tambah($data)
	{
		$this->db->insert('user', $data);

		if ($this->db->affected_rows() == 0) {
			return false;
		}
		return true;
	}

	public function delete($id)
	{
		$this->db->where('id', $id)->delete('user');

		if ($this->db->affected_rows() == 0) {
			return false;
		}
		return true;
	}

	public function getById($id)
	{
		return $this->db->where('id', $id)->get('user')->result();
	}

	public function edit($data, $id)
	{
		$this->db->where('id', $id)->update('user', $data);
		
		if ($this->db->affected_rows() == 0) {
			return false;
		}
		return true;
	}

}

/* End of file user_model.php */
/* Location: ./application/models/user_model.php */