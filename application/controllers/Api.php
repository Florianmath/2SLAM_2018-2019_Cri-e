<?php
/*defined('BASEPATH') OR exit('NO direct script access allowed');

class Api extends CI_Controller {

	public function __construct()
	{
		parent::__construct();

		$this->load->model('Utilisateur_model')
	}

	public function send_message()
	{
		$message = $this->input->get('message', null);
		$pseudonyme = $this->input->get('pseudonyme', '');
		$guide = $this->input->get('guide', '');

		$this->Utilisateur_model->add_message($message, $pseudonyme, $guide);
		$this->_setOutput($message);
	}

	public function get_messages()
	{
		$timestamp = $this->input->get('timestamp', null);

		$message = $this->Utilisateur_model->get_messages($timestamp);

		$this->_setOutput($message);
	}

	private function _setOutput($data)
	{
		header('Cache-Control: no-cache, must-revalidate');
		header('Expires: Mon, 26 Jul 199 05:00:00 GMT');
		header('Content-type: application/json');

		echo json_encode($data);
	}
}

