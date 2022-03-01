<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Kp_spams extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('setting/M_kpspams', 'model');
		is_log();
	}


	public function index()
	{
		$data = [
			'title'		=> 'KP-SPAMS',
			'userdata'	=> $this->M_user->get_user(),
			'kpspams'		=> $this->model->all(),
			'menu'		=> $this->menu()
		];
		$this->load->view('setting/kp_spams/company_profile', $data, FALSE);
	}
	public function update()
	{
		$config['upload_path'] 		= './uploads/logo/';
		$config['allowed_types'] 	= 'jpg|png|jpeg';
		$config['encrypt_name']		= true;
		$this->load->library('upload', $config);
		if (!$this->upload->do_upload('company_logo')) {
			$data = [
				'file_name'		=> $this->input->post('old_logo')
			];
			$this->model->update($data);
			$this->session->set_flashdata('success', 'Profil KP-SPAMS Berhasil diperbaharui !');
			redirect('setting/company_profile');
		} else {
			$data = $this->upload->data();
			$this->model->update($data);
			$this->session->set_flashdata('success', 'Profil KP-SPAMS Berhasil diperbaharui !');
			redirect('setting/company_profile');
		}
	}
}

/* End of file Kp_spams.php */
