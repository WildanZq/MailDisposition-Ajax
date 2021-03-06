<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Desposisi_model extends CI_Model {

	public function getById($id)
	{
		return $this->db
		->select('*,desposition.id')
		->join('mail', 'mail.id = desposition.mailid')
		->join('user', 'user.id = mail.userid')
		->join('mail_type', 'mail_type.id = mail.mail_typeid')
		->where('desposition.id', $id)
		->get('desposition')->row();
	}

	public function getByDespositionId($id)
	{
		return $this->db
		->select('*,desposition.id')
		->join('user', 'user.id = desposition.userid')
		->where('despositionid', $id)
		->get('desposition')->result();
	}

	public function getStatus($id)
	{
		return $this->db
		->where('id', $id)
		->get('desposition')->row_array()['status'];
	}

	public function changeToRead($id)
	{
		$data = array( 'status' => 1 );

		$this->db
		->where('id', $id)
		->update('desposition', $data);

		if ($this->db->affected_rows() == 0) {
			return false;
		}
		return true;
	}

	public function changeToDes($id)
	{
		$data = array( 'status' => 2 );

		$this->db
		->where('id', $id)
		->update('desposition', $data);

		if ($this->db->affected_rows() == 0) {
			return false;
		}
		return true;
	}

	public function getByMailId($id)
	{
		return $this->db
		->select('*,desposition.id')
		->join('user', 'user.id = desposition.userid')
		->where('mailid', $id)
		->get('desposition')->result();
	}

	public function getByUserId($id)
	{
		return $this->db
		->select('*,desposition.description,desposition.id')
		->join('mail', 'mail.id = desposition.mailid')
		->join('user', 'user.id = mail.userid')
		->where('desposition.userid', $id)
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
		->select('*,desposition.description,desposition.id')
		->join('mail', 'mail.id = desposition.mailid')
		->join('user', 'user.id = mail.userid')
		->where('desposition.status', 0)
		->where('desposition.userid', $id)
		->get('desposition')->result();
	}

	public function cekId($id, $userId)
	{
		$data = $this->db
		->where('id', $id)
		->where('userid', $userId)
		->get('desposition')->num_rows();

		if ($data == 0) {
			return false;
		}
		return true;
	}

}

/* End of file desposisi_model.php */
/* Location: ./application/models/desposisi_model.php */