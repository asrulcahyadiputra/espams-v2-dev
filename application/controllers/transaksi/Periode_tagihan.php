<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Periode_tagihan extends CI_Controller
{


	public function __construct()
	{
		parent::__construct();
		$this->load->model('transaksi/M_periode_tagihan', 'model');
		is_log();
	}


	public function index()
	{
		$data = [
			'title'		=> 'Periode Tagihan',
			'userdata'	=> $this->M_user->get_user(),
			'periode'		=> $this->model->all(),
			'menu'		=> $this->menu()
		];
		$this->load->view('transaksi/periode_tagihan/periode_tagihan', $data);
	}
	public function store()
	{
		$request = $this->model->store();

		$this->session->set_flashdata($request['label'], $request['msg']);
		redirect('transaksi/periode_tagihan');
	}
	public function show($id_transaksi)
	{
		$data = [
			'title'		=> 'Rincian Periode Tagihan',
			'userdata'	=> $this->M_user->get_user(),
			'periode'		=> $this->model->find_transaksi($id_transaksi),
			'list'		=> $this->model->select($id_transaksi),
			'menu'		=> $this->menu()
		];
		$this->load->view('transaksi/periode_tagihan/periode_detail', $data);
	}
}

/* End of file Periode_iuran.php */
