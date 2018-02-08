<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	public function index()
	{
		$data['view'] = 'dashboard/index';
		$this->load->view('template', $data);
	}

}

/* End of file dashboard.php */
/* Location: ./application/controllers/dashboard.php */