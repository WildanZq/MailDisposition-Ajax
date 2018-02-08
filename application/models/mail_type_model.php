<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mail_type_model extends CI_Model {

	public function getAll()
	{
		return $this->db->get('mail_type')->result();
	}

}

/* End of file mail_type_model.php */
/* Location: ./application/models/mail_type_model.php */