<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Forbidden extends CI_Controller
{

	public function index()
	{
		$data = [
			'title'	=> '403'
		];
		$this->load->view('cutome_error/403', $data);
	}
}

/* End of file Forbidden.php */
