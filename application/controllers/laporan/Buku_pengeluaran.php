<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Buku_pengeluaran extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		date_default_timezone_set("Asia/Jakarta");
		$this->load->model('laporan/M_buku_pengeluaran', 'model');
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
			'title'			=> 'Buku Pengeluaran',
			'userdata'		=> $this->M_user->get_user(),
			'menu'			=> $this->menu(),
			'spam'			=> $this->model->company(),
			'pengeluaran'		=> $this->model->all($y, $m),
			'month'			=> $m,
			'year'			=> $y,
		];
		$this->load->view('laporan/pembantu/buku_pengeluaran', $data);
	}
	public function excel($y, $m)
	{
		header("Content-type: application/vnd-ms-excel");
		header("Content-Disposition: attachment; filename=Buku Pengeluaran.xls");
		$data = [
			'title'			=> 'Buku Pengeluaran',
			'menu'			=> $this->menu(),
			'spam'			=> $this->model->company(),
			'pengeluaran'		=> $this->model->all($y, $m),
			'month'			=> $m,
			'year'			=> $y,
		];
		$this->load->view('laporan/pembantu/buku_pengeluaran_excel', $data);
	}
}

/* End of file Buku_pengeluaran.php */
