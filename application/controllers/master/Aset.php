<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Aset extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('master/M_aset', 'model');
		is_log();
	}


	public function index()
	{
		$data = [
			'title'		=> 'Aset',
			'userdata'	=> $this->M_user->get_user(),
			'head'		=> $this->model->head(),
			'sub'		=> $this->model->subhead(),
			'all'		=> $this->model->all(),
			'menu'		=> $this->menu()
		];
		$this->load->view('master/aset/aset_list', $data, FALSE);
	}
	public function create()
	{
		$data = [
			'title'		=> 'Tambah Aset',
			'userdata'	=> $this->M_user->get_user(),
			'head'		=> $this->model->head(),
			'sub'		=> $this->model->subhead(),
			'coa'		=> $this->model->coa(),
			'menu'		=> $this->menu()
		];
		$this->load->view('master/aset/aset_create', $data, FALSE);
	}
	public function store()
	{
		$this->model->store();
		$this->session->set_flashdata('success', 'Data Aset berhasi ditambahkan !');

		redirect('master/aset');
	}
	public function edit($id)
	{
		$data = [
			'title'		=> 'Edit Aset',
			'userdata'	=> $this->M_user->get_user(),
			'aset'		=> $this->model->select($id),
			'head'		=> $this->model->head(),
			'sub'		=> $this->model->subhead(),
			'coa'		=> $this->model->coa(),
			'menu'		=> $this->menu()
		];
		$this->load->view('master/aset/aset_edit', $data, FALSE);
	}
	public function update()
	{
		$this->model->update();
		$this->session->set_flashdata('success', 'Data Aset berhasi diedit !');

		redirect('master/aset');
	}
}

/* End of file Aset.php */
