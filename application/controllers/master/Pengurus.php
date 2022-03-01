<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Pengurus extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('master/M_pengurus', 'model');
		is_log();
	}


	public function index()
	{
		$data = [
			'title'		=> 'Pengurus',
			'userdata'	=> $this->M_user->get_user(),
			'pengurus'	=> $this->model->all(),
			'jabatan'		=> $this->model->jabatan(),
			'menu'		=> $this->menu()
		];
		$this->load->view('master/pengurus/pengurus_list', $data, FALSE);
	}
	public function store()
	{
		$config['upload_path'] 		= './uploads/pengurus/';
		$config['allowed_types'] 	= 'jpg|png|jpeg';
		$config['encrypt_name']		= true;
		$this->load->library('upload', $config);
		if (!$this->upload->do_upload('foto')) {
			$data = [
				'file_name'		=> 'default_foto.png'
			];
			$this->model->store($data);
			$this->session->set_flashdata('success', 'Pengurus Berhasil ditambahkan !');
			redirect('master/pengurus');
		} else {
			$data = $this->upload->data();
			$this->model->store($data);
			$this->session->set_flashdata('success', 'Pengurus Berhasil ditambahkan !');
			redirect('master/pengurus');
		}
	}
	public function update()
	{
		$config['upload_path'] 		= './uploads/pengurus/';
		$config['allowed_types'] 	= 'jpg|png|jpeg';
		$config['encrypt_name']		= true;
		$this->load->library('upload', $config);
		if (!$this->upload->do_upload('foto')) {
			$data = [
				'file_name'		=> $this->input->post('old_foto')
			];
			$this->model->update($data);
			$this->session->set_flashdata('success', 'Pengurus Berhasil ditambahkan !');
			redirect('master/pengurus');
		} else {
			$data = $this->upload->data();
			$this->model->update($data);
			$this->session->set_flashdata('success', 'Pengurus Berhasil ditambahkan !');
			redirect('master/pengurus');
		}
	}
	public function active($param, $id)
	{
		$this->model->active($id, $param);
		$this->session->set_flashdata('success', 'Status Pengurus Berhasil diperbaharui !');
		redirect('master/pengurus');
	}
}

/* End of file Pengurus.php */
