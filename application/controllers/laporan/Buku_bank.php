<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Buku_bank extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('laporan/M_buku_bank', 'model');
		is_log();
	}

	public function index()
	{
		$periode = $this->input->get('periode');
		if ($periode === null) {
			$m = date('m');
			$y = date('Y');
		} else {
			$m = date('m', strtotime($periode));
			$y = date('Y', strtotime($periode));
		}
		$data = [
			'title'			=> 'Buku Bank',
			'menu'			=> $this->menu(),
			'userdata'		=> $this->M_user->get_user(),
			'spam'			=> $this->model->company(),
			'bank'			=> $this->model->all($y, $m),
			'saldo_awal'		=> $this->model->saldo_awal($y, $m),
			'month'			=> $m,
			'year'			=> $y,
		];
		$this->load->view('laporan/pembantu/buku_bank', $data, FALSE);
	}
	public function excel($y, $m)
	{
		header("Content-type: application/vnd-ms-excel");
		header("Content-Disposition: attachment; filename=Buku Bank.xls");
		$data = [
			'title'			=> 'Buku Bank',
			'spam'			=> $this->model->company(),
			'bank'			=> $this->model->all($y, $m),
			'saldo_awal'		=> $this->model->saldo_awal($y, $m),
			'month'			=> $m,
			'year'			=> $y,
		];
		$this->load->view('laporan/pembantu/buku_bank_excel', $data);
	}
}

/* End of file Buku_bank.php */
