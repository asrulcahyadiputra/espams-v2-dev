<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{


	public function __construct()
	{
		parent::__construct();
		is_log();
		$this->load->model('M_widget', 'model');
	}

	public function index()
	{
		$data = [
			'title'		=> 'Dashboard',
			'userdata'	=> $this->M_user->get_user(),
			'menu'		=> $this->menu(),
			'kas'		=> $this->model->saldo_akhir_kas(),
			'pelanggan'	=> $this->model->pelanggan(),
			'laba'		=> $this->model->try_laba()
		];
		// echo "<pre>";
		// print_r($data);
		// echo "</pre>";
		// die;
		$this->load->view('dashboard', $data);
	}
}

/* End of file Dashboard.php */
