<?php

defined('BASEPATH') or exit('No direct script access allowed');

class M_pengurus extends CI_Model
{
	public function jabatan()
	{
		return $this->db->get('m_jabatan')->result_array();
	}
	public function all()
	{
		$this->db->select('a.id_pengurus,a.nama_pengurus,a.no_hp,a.alamat,a.id_jabatan,a.foto,a.status,b.nama_jabatan')
			->from('m_pengurus as a')
			->join('m_jabatan as b', 'a.id_jabatan=b.id_jabatan');
		return $this->db->get()->result_array();
	}
	private function id()
	{
		$this->db->select('RIGHT(id_pengurus,9) as id', FALSE);
		$this->db->order_by('id_pengurus', 'DESC');
		$this->db->limit(1);
		$query = $this->db->get('m_pengurus');
		if ($query->num_rows() <> 0) {
			$data = $query->row();
			$code = intval($data->id) + 1;
		} else {
			$code = 1;
		}

		$interval = str_pad($code, 9, "0", STR_PAD_LEFT);
		$id = "MD-PG-" . $interval;
		return $id;
	}
	public function store($data)
	{
		$id_pengurus 		= $this->id();
		$nama_pengurus 	= $this->input->post('nama_pengurus');
		$id_jabatan		= $this->input->post('id_jabatan');
		$no_hp			= $this->input->post('no_hp');
		$alamat  			= $this->input->post('alamat');
		$foto 			= $data['file_name'];

		$pengurus = [
			'id_pengurus'		=> $id_pengurus,
			'nama_pengurus'	=> $nama_pengurus,
			'id_jabatan'		=> $id_jabatan,
			'no_hp'			=> $no_hp,
			'alamat'			=> $alamat,
			'foto'			=> $foto
		];
		return $this->db->insert('m_pengurus', $pengurus);
	}
	public function update($data)
	{
		$id_pengurus 		= $this->input->post('id_pengurus');
		$nama_pengurus 	= $this->input->post('nama_pengurus');
		$id_jabatan		= $this->input->post('id_jabatan');
		$no_hp			= $this->input->post('no_hp');
		$alamat  			= $this->input->post('alamat');
		$foto 			= $data['file_name'];

		$pengurus = [
			'nama_pengurus'	=> $nama_pengurus,
			'id_jabatan'		=> $id_jabatan,
			'no_hp'			=> $no_hp,
			'alamat'			=> $alamat,
			'foto'			=> $foto
		];
		return $this->db->update('m_pengurus', $pengurus, ['id_pengurus' => $id_pengurus]);
	}
	public function active($id, $param)
	{
		$data = [
			'status'	=> $param
		];
		return $this->db->update('m_pengurus', $data, ['id_pengurus' => $id]);
	}
}

/* End of file M_pengurus.php */
