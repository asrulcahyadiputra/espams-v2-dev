<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Buku_kas extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('laporan/M_buku_kas', 'model');
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
			'title'			=> 'Buku Kas',
			'userdata'		=> $this->M_user->get_user(),
			'menu'			=> $this->menu(),
			'spam'			=> $this->model->company(),
			'kas'			=> $this->model->all($y, $m),
			'saldo_awal'		=> $this->model->saldo_awal($y, $m),
			'month'			=> $m,
			'year'			=> $y,
		];
		$this->load->view('laporan/pembantu/buku_kas', $data, FALSE);
	}
	public function excel($y, $m)
	{
		header("Content-type: application/vnd-ms-excel");
		header("Content-Disposition: attachment; filename=Buku Kas.xls");
		$data = [
			'title'			=> 'Buku Kas',
			'spam'			=> $this->model->company(),
			'kas'			=> $this->model->all($y, $m),
			'saldo_awal'		=> $this->model->saldo_awal($y, $m),
			'month'			=> $m,
			'year'			=> $y,
		];
		$this->load->view('laporan/pembantu/buku_kas_excel', $data);
	}
}

/* End of file Buku_kas.php */
