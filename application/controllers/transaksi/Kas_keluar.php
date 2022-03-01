<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Kas_keluar extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('transaksi/M_kas_keluar', 'model');
		is_log();
	}

	public function index()
	{
		$data = [
			'title'		=> 'Pengeluaran',
			'userdata'	=> $this->M_user->get_user(),
			'menu'		=> $this->menu(),
			'sumber'		=> $this->model->sumber(),
			'keluar'		=> $this->model->all()
		];
		$this->load->view('transaksi/keuangan/kas_keluar', $data);
	}
	public function store()
	{
		$request = $this->model->store();
		$this->session->set_flashdata($request['label'], $request['msg']);
		redirect('keuangan/kas_keluar');
	}
	public function update()
	{
		$request = $this->model->update();
		$this->session->set_flashdata($request['label'], $request['msg']);
		redirect('keuangan/kas_keluar');
	}
}

/* End of file Kas_keluar.php */
