<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Desposisi extends CI_Controller {

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
		$data['view'] = 'desposisi';
		$this->load->view('template', $data);
	}

	public function getByMailId()
	{
		$r = $this->desposisi_model->getByMailId($this->input->get('id'));
		echo json_encode($r);
	}

	public function tambah()
	{
		$r = array( 'status' => false, 'error' => '' );

		$this->form_validation->set_rules('id', 'ID', 'trim|required');
		$this->form_validation->set_rules('description', 'Description', 'trim|required');
		$this->form_validation->set_rules('notification', 'Notification', 'trim|required');
		$this->form_validation->set_rules('userid', 'To', 'trim|required');

		if ($this->form_validation->run()) {
			$data = array(
				'desposition_at' => date('Y-m-d H:i:s'),
				'description' => $this->input->post('description'),
				'notification' => $this->input->post('notification'),
				'mailid' => $this->input->post('id'),
				'userid' => $this->input->post('userid')
			);

			if ($this->desposisi_model->tambah($data)) {
				$r['status'] = true;
			} else {
				$r['error'] = 'Create data failed';
			}
		} else {
			$r['error'] = validation_errors();
		}

		echo json_encode($r);
	}

	public function delete()
	{
		$r = array( 'status' => false, 'error' => '' );

		if ($this->desposisi_model->delete($this->input->post('id'))) {
			$r['status'] = true;
		}

		echo json_encode($r);
	}

}

/* End of file desposisi.php */
/* Location: ./application/controllers/desposisi.php */