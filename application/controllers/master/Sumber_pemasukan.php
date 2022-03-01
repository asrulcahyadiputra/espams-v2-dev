<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Sumber_pemasukan extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('master/M_sumber_pemasukan', 'model');
		is_log();
	}


	public function index()
	{
		$data = [
			'title'			=> 'Sumber Pemasukan',
			'userdata'		=> $this->M_user->get_user(),
			'ref'			=> $this->model->ref(),
			'sumber_pemasukan'	=> $this->model->all(),
			'menu'			=> $this->menu()
		];
		$this->load->view('master/sumber_pemasukan/sumber_pemasukan', $data);
	}
	public function store()
	{
		$this->model->store();
		$this->session->set_flashdata('success', 'Sumber Pemasukan berhasil ditambahkan');
		redirect('master/sumber_pemasukan');
	}
	public function update()
	{
		$request = $this->model->update();
		$this->session->set_flashdata($request['label'], $request['msg']);
		redirect('master/sumber_pemasukan');
	}
}

/* End of file Sumber_pemasukan.php */
