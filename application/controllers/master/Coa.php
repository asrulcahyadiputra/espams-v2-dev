<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Coa extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('master/M_coa', 'model');
		is_log();
	}


	public function index()
	{
		$data = [
			'title'		=> 'Chart Of Account (CoA)',
			'userdata'	=> $this->M_user->get_user(),
			'all'		=> $this->model->all(),
			'sub'		=> $this->model->sub(),
			'head'		=> $this->model->head(),
			'menu'		=> $this->menu()
		];
		$this->load->view('master/coa/coa_list', $data);
	}
	public function create()
	{
		$data = [
			'title'		=> 'Tambah Chart Of Account (CoA)',
			'userdata'	=> $this->M_user->get_user(),
			'coa'		=> $this->model->all(),
			'head'		=> $this->model->head(),
			'sub'		=> $this->model->sub(),
			'menu'		=> $this->menu()
		];
		$this->load->view('master/coa/coa_create', $data);
	}
	public function store()
	{
		$request = $this->model->insert();
		if ($request['status'] == 1) {
			$this->session->set_flashdata('success', 'Chart of Account berhasil di tambahkan');
			redirect('master/coa');
		} else {
			$this->session->set_flashdata('error', 'Chart of Account berhasil di tambahkan');
			redirect('master/coa');
		}
	}
	public function edit($id)
	{
		$data = [
			'title'		=> 'Edit Chart Of Account (CoA)',
			'userdata'	=> $this->M_user->get_user(),
			'coa'		=> $this->model->select($id),
			'head'		=> $this->model->head(),
			'sub'		=> $this->model->sub(),
			'menu'		=> $this->menu()
		];
		$this->load->view('master/coa/coa_edit', $data);
	}
	public function update()
	{
		$request = $this->model->update();
		if ($request['status'] == 1) {
			$this->session->set_flashdata('success', 'Chart of Account berhasil di Update');
			redirect('master/coa');
		} else {
			$this->session->set_flashdata('error', 'Chart of Account berhasil di Update');
			redirect('master/coa');
		}
	}
}

/* End of file Coa.php */
