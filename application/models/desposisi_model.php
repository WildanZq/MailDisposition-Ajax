<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Desposisi_model extends CI_Model {

	public function getByMailId($id)
	{
		return $this->db
		->select('*,desposition.id')
		->join('user', 'user.id = desposition.userid')
		->where('mailid', $id)
		->get('desposition')->result();
	}

	public function tambah($data)
	{
		$this->db->insert('desposition', $data);

		if ($this->db->affected_rows() == 0) {
			return false;
		}
		return true;
	}

	public function delete($id)
	{
		$this->db
		->where('id', $id)
		->delete('desposition');

		if ($this->db->affected_rows() == 0) {
			return false;
		}
		return true;
	}

	public function getUnReadedByUserId($id)
	{
		return $this->db
		->select('*,desposition.description')
		->join('mail', 'mail.id = desposition.mailid')
		->join('user', 'user.id = mail.userid')
		->where('desposition.status', 0)
		->where('desposition.userid', $id)
		->get('desposition')->result();
	}

}

/* End of file desposisi_model.php */
/* Location: ./application/models/desposisi_model.php */