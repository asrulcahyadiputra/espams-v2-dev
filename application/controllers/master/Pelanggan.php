<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Pelanggan extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('master/M_pelanggan', 'model');
		is_log();
	}

	public function index()
	{
		$data = [
			'title'		=> 'Pelanggan',
			'userdata'	=> $this->M_user->get_user(),
			'pelanggan'	=> $this->model->all(),
			'menu'		=> $this->menu()
		];
		$this->load->view('master/pelanggan/pelanggan_list', $data);
	}
	public function create()
	{
		$data = [
			'title'		=> 'Tambah Pelanggan',
			'userdata'	=> $this->M_user->get_user(),
			'wilayah'		=> $this->model->wilayah(),
			'golongan'	=> $this->model->golongan(),
			'menu'		=> $this->menu()
		];
		$this->load->view('master/pelanggan/pelanggan_create', $data);
	}
	public function store()
	{
		$this->model->store();
		$this->session->set_flashdata('success', 'Data Pelanggan Berhasil ditambahkan !');
		redirect('master/pelanggan');
	}
	public function edit($id_pelanggan)
	{
		$data = [
			'title'		=> 'Edit Pelanggan',
			'userdata'	=> $this->M_user->get_user(),
			'pelanggan'	=> $this->model->select($id_pelanggan),
			'trx'		=> $this->model->find_trx($id_pelanggan),
			'wilayah'		=> $this->model->wilayah(),
			'golongan'	=> $this->model->golongan(),
			'menu'		=> $this->menu()
		];
		$this->load->view('master/pelanggan/pelanggan_edit', $data);
	}
	public function update()
	{
		$this->model->update();
		$this->session->set_flashdata('success', 'Data Pelanggan Berhasil diedit !');
		redirect('master/pelanggan');
	}
}

/* End of file Pelanggan.php */
