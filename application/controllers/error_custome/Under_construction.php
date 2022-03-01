<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Under_construction extends CI_Controller
{

	public function index()
	{
		$data = [
			'title'	=> 'Under Construction'
		];
		$this->load->view('cutome_error/under_construction', $data);
	}
}

/* End of file Under_constructions.php */
