<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Laba_rugi extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		date_default_timezone_set("Asia/Jakarta");
		$this->load->model('laporan/M_laba_rugi', 'model');
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
			'title'			=> 'Laporan Laba/Rugi',
			'menu'			=> $this->menu(),
			'spam'			=> $this->model->company(),
			'userdata'		=> $this->M_user->get_user(),
			'head'			=> $this->model->head(),
			'sub'			=> $this->model->sub(),
			'coa'			=> $this->model->coa($y, $m),
			'income_stat'		=> $this->model->try_laba($y, $m),
			'month'			=> $m,
			'year'			=> $y
		];
		// echo "<pre>";
		// print_r($data['coa']);
		// echo "</pre>";
		// die;

		$this->load->view('laporan/akuntansi/laba_rugi', $data);
	}
	public function excel($y, $m)
	{
		header("Content-type: application/vnd-ms-excel");
		header("Content-Disposition: attachment; filename=Laporan Laba/Rugi.xls");
		$data = [
			'title'			=> 'Laporan Laba/Rugi',
			'spam'			=> $this->model->company(),
			'head'			=> $this->model->head(),
			'sub'			=> $this->model->sub(),
			'coa'			=> $this->model->coa($y, $m),
			'income_stat'		=> $this->model->try_laba($y, $m),
			'month'			=> $m,
			'year'			=> $y,
		];
		$this->load->view('laporan/akuntansi/laba_rugi_excel', $data);
	}
}

/* End of file Laba_rugi.php */
