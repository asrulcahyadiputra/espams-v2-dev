<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('M_login', 'login');
	}

	public function index()
	{
		$status = $this->session->userdata('login');
		if ($status == 1) {
			redirect('dashboard');
		} else {
			$data = [
				'title'		=> "Sistem Informasi Pengelolaan Administrasi Keuangan KP-SPAMS"
			];
			$this->load->view('auth/page/login', $data);
		}
	}
	public function verify()
	{
		$post_username = $this->input->post('username');
		$post_password = $this->input->post('password');

		if ($post_username || $post_password) {
			$user = $this->login->select_user($post_username);
			if ($user) {
				if ($user['status'] == 1) {
					if (password_verify($post_password, $user['password'])) {
						$create_session = [
							'user_id'		=> $user['id_user'],
							'role'		=> $user['role_id'],
							'login'		=> 1
						];
						$response = [
							'status'		=> 'OK',
							'label'		=> 'success',
							'msg'		=> 'Selamat Datang Kembali !'
						];
					} else {
						$response = [
							'status'		=> 'error',
							'label'		=> 'error',
							'msg'		=> 'Password yang Anda masukkan salah !'
						];
					}
				} else {
					$response = [
						'status'		=> 'error',
						'label'		=> 'error',
						'msg'		=> 'Akun telah di Non Aktifkan !'
					];
				}
			} else {
				$response = [
					'status'		=> 'error',
					'label'		=> 'error',
					'msg'		=> 'Akun tidak ditemukan atau tidak terdaftar !'
				];
			}
		} else {
			$response = [
				'status'		=> 'illegal',
				'label'		=> 'error',
				'msg'		=> 'Illegal Request !'
			];
		}
		if ($response['status'] == 'OK') {
			$this->session->set_userdata($create_session);
			$this->session->set_flashdata($response['label'], $response['msg']);
			redirect('dashboard');
		} else {
			$this->session->set_flashdata($response['label'], $response['msg']);
			redirect('login');
		}
	}

	public function destroy()
	{
		$this->session->unset_userdata('user_id');
		$this->session->unset_userdata('login');
		redirect('login');
	}
}

/* End of file Auth.php */
