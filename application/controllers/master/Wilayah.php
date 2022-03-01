<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Wilayah extends CI_Controller
{


	public function __construct()
	{
		parent::__construct();
		$this->load->model('master/M_wilayah', 'model');
		is_log();
	}

	public function index()
	{
		$data = [
			'title'		=> 'Wilayah',
			'userdata'	=> $this->M_user->get_user(),
			'wilayah'		=> $this->model->all(),
			'menu'		=> $this->menu()
		];
		$this->load->view('master/wilayah/wilayah_list', $data);
	}
	public function store()
	{
		$this->model->store();
		$this->session->set_flashdata('success', 'Wilayah Berhasil ditambahkan !');
		redirect('master/wilayah');
	}
	public function update()
	{
		$this->model->update();
		$this->session->set_flashdata('success', 'Wilayah Berhasil diedit !');
		redirect('master/wilayah');
	}
}

/* End of file Wilayah.php */
