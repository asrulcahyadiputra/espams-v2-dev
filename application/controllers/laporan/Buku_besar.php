<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Buku_besar extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('laporan/M_buku_besar', 'model');
		is_log();
	}

	public function index()
	{
		$periode = $this->input->get('periode');
		$account_no = $this->input->get('account_no');
		if ($periode === null) {
			$m = date('m');
			$y = date('Y');
			$a = '1-10001';
		} else {
			$m = date('m', strtotime($periode));
			$y = date('Y', strtotime($periode));
			$a = $account_no;
		}
		$data = [
			'title'			=> 'Buku Besar',
			'userdata'		=> $this->M_user->get_user(),
			'menu'			=> $this->menu(),
			'spam'			=> $this->model->company(),
			'kas'			=> $this->model->all($y, $m, $a),
			'saldo_awal'		=> $this->model->saldo_awal($y, $m, $a),
			'coa'			=> $this->model->coa(),
			'sub'			=> $this->model->subhead(),
			'acc'			=> $this->model->select_coa($a),
			'month'			=> $m,
			'year'			=> $y,
			'account'			=> $a
		];
		$this->load->view('laporan/akuntansi/buku_besar', $data, FALSE);
	}
	public function excel($y, $m, $a)
	{
		header("Content-type: application/vnd-ms-excel");
		header("Content-Disposition: attachment; filename=Buku Besar.xls");
		$data = [
			'title'			=> 'Buku Besar',
			'spam'			=> $this->model->company(),
			'kas'			=> $this->model->all($y, $m, $a),
			'saldo_awal'		=> $this->model->saldo_awal($y, $m, $a),
			'acc'			=> $this->model->select_coa($a),
			'month'			=> $m,
			'year'			=> $y,
			'account'			=> $a
		];
		$this->load->view('laporan/akuntansi/buku_besar_excel', $data);
	}
}

/* End of file Buku_besar.php */
