<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Invoice extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('setting/M_invoice', 'model');
		is_log();
	}

	public function index()
	{
		$data = [
			'title'			=> 'Pengaturan Tagihan',
			'userdata'		=> $this->M_user->get_user(),
			'tagihan'			=>  $this->model->all(),
			'menu'			=> $this->menu()
		];
		$this->load->view('setting/tagihan/setting_invoice', $data);
	}
	public function update()
	{
		$request = $this->model->update();
		$this->session->set_flashdata($request['label'], $request['msg']);
		redirect('setting/tagihan');
	}
}

/* End of file Invoice.php */
