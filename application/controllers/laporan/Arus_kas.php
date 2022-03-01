<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Arus_kas extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		date_default_timezone_set("Asia/Jakarta");
		$this->load->model('laporan/M_arus_kas', 'model');
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
			'title'			=> 'Laporan Arus Kas',
			'menu'			=> $this->menu(),
			'spam'			=> $this->model->company(),
			'userdata'		=> $this->M_user->get_user(),
			'opening'			=> $this->model->opening_balance($y, $m),
			'close'			=> $this->model->saldo_akhir($y, $m),
			'sub'			=> $this->model->sub(),
			'coa'			=> $this->model->coa($y, $m),
			'month'			=> $m,
			'year'			=> $y
		];
		// echo "<pre>";
		// print_r($data['bank']);
		// echo "</pre>";
		// die;

		$this->load->view('laporan/akuntansi/arus_kas', $data);
	}
	public function excel($y, $m)
	{
		header("Content-type: application/vnd-ms-excel");
		header("Content-Disposition: attachment; filename=Laporan Arus Kas.xls");
		$data = [
			'title'			=> 'Laporan Arus Kas',
			'spam'			=> $this->model->company(),
			'opening'			=> $this->model->opening_balance($y, $m),
			'close'			=> $this->model->saldo_akhir($y, $m),
			'sub'			=> $this->model->sub(),
			'coa'			=> $this->model->coa($y, $m),
			'month'			=> $m,
			'year'			=> $y
		];
		$this->load->view('laporan/akuntansi/arus_kas_excel', $data);
	}
}

/* End of file Arus_kas.php */
