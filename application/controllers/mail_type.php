<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mail_type extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		if ($this->session->userdata('level') != 1) {
			redirect('/');
		}
		$this->load->model('mail_type_model');
	}

	public function getAll()
	{
		$r = $this->mail_type_model->getAll();
		echo json_encode($r);
	}

}

/* End of file mail_type.php */
/* Location: ./application/controllers/mail_type.php */