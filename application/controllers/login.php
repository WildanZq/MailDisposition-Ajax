<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	public function index()
	{
		if ($this->session->userdata('login')) {
			redirect('dashboard');
		}
		$this->load->view('login/index');
	}

}

/* End of file login.php */
/* Location: ./application/controllers/login.php */