<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Golongan extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('master/M_golongan', 'model');
		is_log();
	}

	public function index()
	{
		$data = [
			'title'		=> 'Golongan Tarif',
			'all'		=> $this->model->all(),
			'userdata'	=> $this->M_user->get_user(),
			'menu'		=> $this->menu()
		];
		$this->load->view('master/golongan/golongan_list', $data);
	}
	public function create()
	{
		$data = [
			'title'		=> 'Tambah Golongan Tarif',
			'userdata'	=> $this->M_user->get_user(),
			'menu'		=> $this->menu()
		];
		$this->load->view('master/golongan/golongan_create', $data);
	}
	public function store()
	{
		$this->model->store();
		$this->session->set_flashdata('success', 'Golongan Tarif Berhasil ditambahkan');
		redirect('master/golongan');
	}
	public function show($id)
	{
		$data = [
			'title'		=> 'Detail Golongan Tarif',
			'userdata'	=> $this->M_user->get_user(),
			'golongan'	=> $this->model->select($id),
			'detail'		=> $this->model->detail($id),
			'menu'		=> $this->menu()
		];
		$this->load->view('master/golongan/golongan_detail', $data);
	}
	public function edit($id)
	{
		$data = [
			'title'		=> 'Edit Golongan Tarif',
			'userdata'	=> $this->M_user->get_user(),
			'id_golongan'	=> $id,
			'golongan'	=> $this->model->select($id),
			'detail'		=> $this->model->detail($id),
			'menu'		=> $this->menu()
		];
		$this->load->view('master/golongan/golongan_edit', $data);
	}
	public function update()
	{
		$this->model->update();
		$this->session->set_flashdata('success', 'Golongan Tarif Berhasil di update');
		redirect('master/golongan');
	}
	public function delete_item($id_golongan, $id_golongan_detail)
	{
		$request = $this->model->delete_item($id_golongan_detail);
		if ($request['status'] == 1) {
			$this->session->set_flashdata('success', 'Fluktuasi tarif berhasil di hapus');
			redirect('master/golongan/edit/' . $id_golongan);
		} else {
			$this->session->set_flashdata('warning', 'Request tidak dikenali');
			redirect('master/golongan/edit/' . $id_golongan);
		}
	}
	public function store_item()
	{
		$request = $this->model->store_item();
		$id_golongan = $this->input->post('id_golongan');
		$this->session->set_flashdata('success', 'Fluktuasi tarif berhasil di tambahkan');
		redirect('master/golongan/edit/' . $id_golongan);
	}
}

/* End of file Golongan.php */
