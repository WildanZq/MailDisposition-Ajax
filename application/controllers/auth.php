<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('auth_model');
	}

	public function login()
	{
		// cek request dengan ajax
		if ($this->input->is_ajax_request()) {
			$r = array( 'status' => false, 'error' => '' );

			$this->form_validation->set_rules('username', 'Username', 'trim|required');
			$this->form_validation->set_rules('password', 'Password', 'trim|required');

			if ($this->form_validation->run()) {
				if ($this->auth_model->login($this->input->post('username'), $this->input->post('password'))) {
					$r['status'] = true;
				} else {
					$r['error'] = 'Login gagal';
				}
			} else {
				$r['error'] = validation_errors();
			}

			echo json_encode($r);
		} else {
			// jika bukan ajax
			$this->form_validation->set_rules('username', 'Username', 'trim|required');
			$this->form_validation->set_rules('password', 'Password', 'trim|required');

			if ($this->form_validation->run()) {
				if ($this->auth_model->login($this->input->post('username'), $this->input->post('password'))) {
					redirect('/');
				} else {
					$this->session->set_flashdata('notif', 'Login gagal');
				}
			} else {
				$this->session->set_flashdata('notif', validation_errors());
			}

			redirect('/');
		}
	}

	public function logout()
	{
		$this->session->unset_userdata('id');
		$this->session->unset_userdata('login');
		$this->session->unset_userdata('level');
		$this->session->unset_userdata('user');

		redirect('/');
	}

}

/* End of file auth.php */
/* Location: ./application/controllers/auth.php */