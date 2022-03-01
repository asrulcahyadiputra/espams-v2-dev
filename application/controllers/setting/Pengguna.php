<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Pengguna extends CI_Controller
{


	public function __construct()
	{
		parent::__construct();
		$this->load->model('setting/M_pengguna', 'model');
		is_log();
	}

	public function index()
	{
		$data = [
			'title'		=> 'Pengaturan Pengguna',
			'userdata'	=> $this->M_user->get_user(),
			'pengguna'	=> $this->model->all(),
			'pengurus'	=> $this->model->pengurus(),
			'role'		=> $this->model->hak_akses(),
			'wilayah'		=> $this->model->wilayah(),
			'menu'		=> $this->menu()
		];
		$this->load->view('setting/pengguna/pengguna_list', $data);
	}
	public function store()
	{
		$request = $this->model->store();
		$this->session->set_flashdata($request['label'], $request['msg']);

		redirect('setting/pengguna');
	}
	public function update()
	{
		$request = $this->model->update();
		$this->session->set_flashdata($request['label'], $request['msg']);

		redirect('setting/pengguna');
	}
}

/* End of file Pengguna.php */
