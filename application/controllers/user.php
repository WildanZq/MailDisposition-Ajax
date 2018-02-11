<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		if (!$this->session->userdata('login')) {
			redirect('/');
		}
		$this->load->model('user_model');
	}

	public function index()
	{
		if ($this->session->userdata('level') != 1) {
			redirect('/');
		}
		$data['view'] = 'user';
		$this->load->view('template', $data);
	}

	public function getAll()
	{
		$r = $this->user_model->getAll();
		echo json_encode($r);
	}

	public function getAllLowLevel()
	{
		$r = $this->user_model->getAllLowLevel($this->input->get('level'));
		echo json_encode($r);
	}

	public function search()
	{
		$r = $this->user_model->search($this->input->get('query'));
		echo json_encode($r);
	}

	public function tambah()
	{
		$r = array( 'status' => false, 'error' => '' );

		$this->form_validation->set_rules('username', 'Username', 'trim|required');
		$this->form_validation->set_rules('nama', 'Full Name', 'trim|required');
		$this->form_validation->set_rules('level', 'Level', 'trim|required|numeric');

		if ($this->form_validation->run()) {
			$data = array(
				'username' => $this->input->post('username'),
				'fullname' => $this->input->post('nama'),
				'level' => $this->input->post('level'),
				'password' => password_hash($this->input->post('username'), PASSWORD_DEFAULT)
			);

			if ($this->user_model->tambah($data)) {
				$r['status'] = true;
			} else {
				$r['error'] = 'Add data failed';
			}
		} else {
			$r['error'] = validation_errors();
		}

		echo json_encode($r);
	}

	public function delete()
	{
		$r = array( 'status' => false, 'error' => '' );

		if ($this->user_model->delete($this->input->post('id'))) {
			$r['status'] = true;
		}

		echo json_encode($r);
	}

	public function getById()
	{
		$r = $this->user_model->getById($this->input->get('id'));
		echo json_encode($r[0]);
	}

	public function edit()
	{
		$r = array( 'status' => false, 'error' => '' );

		$this->form_validation->set_rules('nama', 'Nama Lengkap', 'trim|required');
		$this->form_validation->set_rules('level', 'Level', 'trim|required|numeric');
		$this->form_validation->set_rules('id', 'ID', 'trim|required');

		if ($this->form_validation->run()) {
			$data = array(
				'fullname' => $this->input->post('nama'),
				'level' => $this->input->post('level')
			);

			if ($this->user_model->edit($data, $this->input->post('id'))) {
				$r['status'] = true;
			} else {
				$r['error'] = 'Update data failed';
			}
		} else {
			$r['error'] = validation_errors();
		}

		echo json_encode($r);
	}

}

/* End of file user.php */
/* Location: ./application/controllers/user.php */