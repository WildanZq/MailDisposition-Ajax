<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mail_model extends CI_Model {

	public function getAll()
	{
		return $this->db
		->select('*, mail.id')
		->join('mail_type', 'mail_type.id = mail.mail_typeid')
		->join('user', 'user.id = mail.userid')
		->where('userid', $this->session->userdata('id'))
		->get('mail')->result();
	}

	public function search($query)
	{
		return $this->db
		->join('mail_type', 'mail_type.id = mail.mail_typeid')
		->join('user', 'user.id = mail.userid')
		->like('mail_code', $query)
		->like('mail_date', $query)
		->get('mail')->result();
	}

	public function tambah($data)
	{
		$this->db->insert('mail', $data);

		if ($this->db->affected_rows() == 0) {
			return false;
		}
		return true;
	}

	public function edit($data, $id)
	{
		$this->db->where('id',$id)->update('mail', $data);

		if ($this->db->affected_rows() == 0) {
			return false;
		}
		return true;
	}

}

/* End of file mail_model.php */
/* Location: ./application/models/mail_model.php */