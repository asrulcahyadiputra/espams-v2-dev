<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Trial_balance extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('laporan/M_trial_balance', 'model');
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
			'title'			=> 'Trial Balance',
			'userdata'		=> $this->M_user->get_user(),
			'menu'			=> $this->menu(),
			'spam'			=> $this->model->company(),
			'head'			=> $this->model->head(),
			'sub'			=> $this->model->subhead(),
			'coa'			=> $this->model->all($y, $m),
			'month'			=> $m,
			'year'			=> $y
		];
		$this->load->view('laporan/akuntansi/trial_balance', $data, FALSE);
	}
	public function excel($y, $m)
	{
		header("Content-type: application/vnd-ms-excel");
		header("Content-Disposition: attachment; filename=Trial Balance.xls");
		$data = [
			'title'			=> 'Trial Balance',
			'spam'			=> $this->model->company(),
			'head'			=> $this->model->head(),
			'sub'			=> $this->model->subhead(),
			'coa'			=> $this->model->all($y, $m),
			'month'			=> $m,
			'year'			=> $y
		];
		$this->load->view('laporan/akuntansi/trial_balance_excel', $data);
	}
}

/* End of file Trial_balance.php */
