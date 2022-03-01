<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Sumber_pengeluaran extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('master/M_sumber_pengeluaran', 'model');
		is_log();
	}


	public function index()
	{
		$data = [
			'title'				=> 'Sumber Pengeluaran',
			'userdata'			=> $this->M_user->get_user(),
			'ref'				=> $this->model->ref(),
			'sumber_pengeluaran'	=> $this->model->all(),
			'menu'				=> $this->menu()
		];
		$this->load->view('master/sumber_pengeluaran/sumber_pengeluaran', $data);
	}
	public function store()
	{
		$this->model->store();
		$this->session->set_flashdata('success', 'Sumber Pengeluaran berhasil ditambahkan');
		redirect('master/sumber_pengeluaran');
	}
	public function update()
	{
		$this->model->update();
		$this->session->set_flashdata('success', 'Sumber Pengeluaran berhasil diedit');
		redirect('master/sumber_pengeluaran');
	}
}

/* End of file Sumber_pengeluaran.php */
