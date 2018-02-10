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

	public function detail($id)
	{
		if (!$this->desposisi_model->cekId($id,$this->session->userdata('id'))) {
			redirect('inbox');
		}

		$data['view'] = 'inbox/detail';
		$data['id'] = $id;
		$this->load->view('template', $data);
	}

}

/* End of file inbox.php */
/* Location: ./application/controllers/inbox.php */