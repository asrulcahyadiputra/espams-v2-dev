<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Kas_masuk extends CI_Controller
{


	public function __construct()
	{
		parent::__construct();
		$this->load->model('transaksi/M_kas_masuk', 'model');
		is_log();
	}

	public function index()
	{
		$data = [
			'title'		=> 'Penerimaan',
			'userdata'	=> $this->M_user->get_user(),
			'menu'		=> $this->menu(),
			'sumber'		=> $this->model->sumber(),
			'masuk'		=> $this->model->all()
		];
		$this->load->view('transaksi/keuangan/kas_masuk', $data);
	}
	public function store()
	{
		$request = $this->model->store();
		$this->session->set_flashdata($request['label'], $request['msg']);
		redirect('keuangan/kas_masuk');
	}
	public function update()
	{
		$request = $this->model->update();
		$this->session->set_flashdata($request['label'], $request['msg']);
		redirect('keuangan/kas_masuk');
	}
}

/* End of file Kas_masuk.php */
