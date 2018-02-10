<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Inbox extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		if (!$this->session->userdata('login')) {
			redirect('/');
		}
		$this->load->model('desposisi_model');
	}

	public function index()
	{
		$data['view'] = 'inbox/index';
		$this->load->view('template', $data);
	}

}

/* End of file inbox.php */
/* Location: ./application/controllers/inbox.php */