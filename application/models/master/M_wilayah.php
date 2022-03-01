<?php

defined('BASEPATH') or exit('No direct script access allowed');

class M_wilayah extends CI_Model
{

	public function all()
	{
		return $this->db->get('m_wilayah')->result_array();
	}
	private function id_wilayah()
	{
		$this->db->select('RIGHT(id_wilayah,4) as id_wilayah', FALSE);
		$this->db->order_by('id_wilayah', 'DESC');
		$this->db->limit(1);
		$query = $this->db->get('m_wilayah');
		if ($query->num_rows() <> 0) {
			$data = $query->row();
			$kode = intval($data->id_wilayah) + 1;
		} else {
			$kode = 1;
		}
		// $tgl = date('Y-m-d');
		$batas = str_pad($kode, 4, "0", STR_PAD_LEFT);
		$id = 'MD-WLY-' . $batas;
		return $id;
	}
	public function store()
	{
		$id 					= $this->id_wilayah();
		$nama_wilayah 			= $this->input->post('nama_wilayah');
		$id_ref				= $this->input->post('id_ref');

		$data = [
			'id_wilayah'				=> $id,
			'nama_wilayah'				=> $nama_wilayah
		];

		return $this->db->insert('m_wilayah', $data);
	}
	public function update()
	{
		$id 					= $this->input->post('id_wilayah');
		$nama_wilayah 			= $this->input->post('nama_wilayah');

		$data = [
			'nama_wilayah'		=> $nama_wilayah,
		];

		return $this->db->update('m_wilayah', $data, ['id_wilayah' => $id]);
	}
}

/* End of file M_wilayah.php */
