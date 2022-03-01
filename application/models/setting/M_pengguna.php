<?php

defined('BASEPATH') or exit('No direct script access allowed');

class M_pengguna extends CI_Model
{
	public function all()
	{
		$this->db->select('a.id_user,a.username,a.id_pengurus,a.id_wilayah,a.role_id,a.status,a.pass_status,b.nama_pengurus,b.foto,c.role_name')
			->from('users as a')
			->join('m_pengurus as b', 'a.id_pengurus=b.id_pengurus')
			->join('role_group as c', 'a.role_id=c.role_id');
		return $this->db->get()->result_array();
	}
	public function pengurus()
	{
		$this->db->select('a.id_pengurus,a.nama_pengurus,a.no_hp,a.alamat,a.id_jabatan,a.foto,a.status,b.nama_jabatan')
			->from('m_pengurus as a')
			->join('m_jabatan as b', 'a.id_jabatan=b.id_jabatan');
		return $this->db->get()->result_array();
	}
	public function hak_akses()
	{
		return $this->db->get('role_group')->result_array();
	}
	public function wilayah()
	{
		return $this->db->get('m_wilayah')->result_array();
	}

	private function id()
	{
		$this->db->select('RIGHT(id_user,4) as id', FALSE);
		$this->db->order_by('id_user', 'DESC');
		$this->db->limit(1);
		$query = $this->db->get('users');
		if ($query->num_rows() <> 0) {
			$data = $query->row();
			$code = intval($data->id) + 1;
		} else {
			$code = 1;
		}

		$interval = str_pad($code, 4, "0", STR_PAD_LEFT);
		$id = "STT-US-" . $interval;
		return $id;
	}
	public function store()
	{

		$id_user 			= $this->id();
		$id_pengurus		= $this->input->post('id_pengurus');
		$username			= $this->input->post('username');
		$role_id			= $this->input->post('role_id');
		$id_wilayah		= $this->input->post('id_wilayah');
		$password 		= password_hash($username, PASSWORD_DEFAULT);
		if ($id_wilayah === null) {
			$wilayah = null;
		} else {
			$wilayah = $id_wilayah;
		}

		$validate1 = $this->db->get_where('users', ['id_pengurus' => $id_pengurus])->row_array();
		$validate2 = $this->db->get_where('users', ['username' => $username])->row_array();
		if ($validate1) {
			$response = [
				'status'		=> 'warning',
				'label'		=> 'warning',
				'msg'		=> 'Satu pengurus hanya boleh mempunyai satu akun!'
			];
		} else {
			if ($validate2) {
				$response = [
					'status'		=> 'warning',
					'label'		=> 'warning',
					'msg'		=> 'Username sudah digunakan, silahkan gunakan yang lain!'
				];
			} else {
				if ($role_id == 6 && $wilayah == null) {
					$response = [
						'status'		=> 'warning',
						'label'		=> 'warning',
						'msg'		=> 'Hak Akses (cater) wajib memilih wilayah!'
					];
				} else {
					$data = [
						'id_user'			=> $id_user,
						'id_pengurus'		=> $id_pengurus,
						'username'		=> $username,
						'role_id'			=> $role_id,
						'id_wilayah'		=> $wilayah,
						'password'		=> $password
					];
					$this->db->insert('users', $data);
					$response = [
						'status'		=> 'OK',
						'label'		=> 'success',
						'msg'		=> 'User Berhasil di tambahkan!'
					];
				}
			}
		}
		return $response;
	}

	public function update()
	{

		$id_user 			= $this->input->post('id_user');
		$role_id			= $this->input->post('role_id');
		$id_wilayah		= $this->input->post('id_wilayah');
		if ($id_wilayah === null) {
			$wilayah = null;
		} else {
			$wilayah = $id_wilayah;
		}

		if ($role_id == 6 && $wilayah == null) {
			$response = [
				'status'		=> 'warning',
				'label'		=> 'warning',
				'msg'		=> 'Hak Akses (cater) wajib memilih wilayah!'
			];
		} else {
			$data = [
				'role_id'			=> $role_id,
				'id_wilayah'		=> $wilayah,
			];
			$this->db->update('users', $data, ['id_user' => $id_user]);
			$response = [
				'status'		=> 'OK',
				'label'		=> 'success',
				'msg'		=> 'User Berhasil di edit!'
			];
		}

		return $response;
	}
}

/* End of file M_pelanggan.php */
