<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Jurnal_umum extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		date_default_timezone_set("Asia/Jakarta");
		$this->load->model('laporan/M_jurnal', 'model');
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
			'title'			=> 'Jurnal Umum',
			'userdata'		=> $this->M_user->get_user(),
			'row_jurnal'		=> $this->model->get_row_jurnal($y, $m),
			'jurnal'			=> $this->model->get_jurnal($y, $m),
			'month'			=> $m,
			'year'			=> $y,
			'menu'			=> $this->menu()
		];
		$this->load->view('laporan/akuntansi/jurnal_umum', $data);
	}
	public function excel($y, $m)
	{
		header("Content-type: application/vnd-ms-excel");
		header("Content-Disposition: attachment; filename=Jurnal Umum.xls");
		$data = [
			'title'			=> 'Jurnal Umum',
			'row_jurnal'		=> $this->model->get_row_jurnal($y, $m),
			'jurnal'			=> $this->model->get_jurnal($y, $m),
			'spam'			=> $this->model->company(),
			'month'			=> $m,
			'year'			=> $y,
		];
		$this->load->view('laporan/akuntansi/jurnal_umum_excel', $data);
	}
}

/* End of file Jurnal_umum.php */
