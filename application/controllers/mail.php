<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mail extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('mail_model');
	}

	public function getAll()
	{
		$r = $this->mail_model->getAll();
		echo json_encode($r);
	}

	public function search()
	{
		$r = $this->mail_model->search($this->input->get('query'));
		echo json_encode($r);
	}

	public function tambah()
	{
		$r = array( 'status' => false, 'error' => '' );

		$this->form_validation->set_rules('code', 'Code', 'trim|required');
		$this->form_validation->set_rules('date', 'Date', 'trim|required');
		$this->form_validation->set_rules('from', 'From', 'trim|required');
		$this->form_validation->set_rules('to', 'To', 'trim|required');
		$this->form_validation->set_rules('subject', 'Subject', 'trim|required');
		$this->form_validation->set_rules('description', 'Description', 'trim|required');
		$this->form_validation->set_rules('type', 'Type', 'trim|required');

		if ($this->form_validation->run()) {

			if (! empty($_FILES['file']['name'])) {
				
				$config['upload_path'] = './assets/upload/';
				$config['allowed_types'] = 'gif|jpg|png|pdf|docx|doc';
				
				$this->load->library('upload', $config);
				
				if ( ! $this->upload->do_upload('file')){
					$r['error'] = $this->upload->display_errors();
				} else {

					$data = array(
						'incoming_at' => date('Y-m-d'),
						'mail_code' => $this->input->post('code'),
						'mail_date' => $this->input->post('date'),
						'mail_from' => $this->input->post('from'),
						'mail_to' => $this->input->post('to'),
						'mail_subject' => $this->input->post('subject'),
						'description' => $this->input->post('description'),
						'mail_upload' => $this->upload->data()['file_name'],
						'mail_typeid' => $this->input->post('type'),
						'userid' => $this->session->userdata('id')
					);

					if ($this->mail_model->tambah($data)) {
						$r['status'] = true;
					} else {
						$r['error'] = 'Create data failed';
					}

				}

			} else {
				$r['error'] = 'The File field is required';
			}

		} else {
			$r['error'] = validation_errors();
		}

		echo json_encode($r);
	}

	public function editFile()
	{
		$r = array( 'status' => false, 'error' => '' );

		$this->form_validation->set_rules('id', 'ID', 'trim|required');

		if ($this->form_validation->run()) {

			if (! empty($_FILES['file']['name'])) {
				
				$config['upload_path'] = './assets/upload/';
				$config['allowed_types'] = 'gif|jpg|png|pdf|docx|doc';
				
				$this->load->library('upload', $config);
				
				if ( ! $this->upload->do_upload('file')){
					$r['error'] = $this->upload->display_errors();
				} else {

					$data = array( 'mail_upload' => $this->upload->data()['file_name'] );

					if ($this->mail_model->edit($data, $this->input->post('id'))) {
						$r['status'] = true;
					} else {
						$r['error'] = 'Create data failed';
					}

				}

			} else {
				$r['error'] = 'The File field is required';
			}

		} else {
			$r['error'] = validation_errors();
		}

		echo json_encode($r);
	}

}

/* End of file mail.php */
/* Location: ./application/controllers/mail.php */