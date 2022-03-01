<?php

defined('BASEPATH') or exit('No direct script access allowed');

class M_sumber_pengeluaran extends CI_Model
{
	public function all()
	{
		$this->db->select('a.id_sumber_pengeluaran,a.nama_sumber_pengeluaran,a.id_ref,b.nama_ref')
			->from('m_sumber_pengeluaran as a')
			->join('ref_pengeluaran as b', 'a.id_ref=b.id_ref');

		return $this->db->get()->result_array();
	}
	public function ref()
	{
		return $this->db->get('ref_pengeluaran')->result_array();
	}

	private function id_sumber_pengeluaran()
	{
		$this->db->select('RIGHT(id_sumber_pengeluaran,4) as id_sumber_pengeluaran', FALSE);
		$this->db->order_by('id_sumber_pengeluaran', 'DESC');
		$this->db->limit(1);
		$query = $this->db->get('m_sumber_pengeluaran');
		if ($query->num_rows() <> 0) {
			$data = $query->row();
			$kode = intval($data->id_sumber_pengeluaran) + 1;
		} else {
			$kode = 1;
		}
		// $tgl = date('Y-m-d');
		$batas = str_pad($kode, 4, "0", STR_PAD_LEFT);
		$id = 'MD-SPK-' . $batas;
		return $id;
	}
	public function store()
	{
		$id 					= $this->id_sumber_pengeluaran();
		$nama_sumber_pengeluran 	= $this->input->post('nama_sumber_pengeluaran');
		$id_ref				= $this->input->post('id_ref');

		$data = [
			'id_sumber_pengeluaran'		=> $id,
			'nama_sumber_pengeluaran'	=> $nama_sumber_pengeluran,
			'id_ref'					=> $id_ref
		];

		return $this->db->insert('m_sumber_pengeluaran', $data);
	}
	public function update()
	{
		$id 					= $this->input->post('id_sumber_pengeluaran');
		$nama_sumber_pengeluran 	= $this->input->post('nama_sumber_pengeluaran');
		$id_ref				= $this->input->post('id_ref');

		$data = [
			'nama_sumber_pengeluaran'	=> $nama_sumber_pengeluran,
			'id_ref'					=> $id_ref
		];

		return $this->db->update('m_sumber_pengeluaran', $data, ['id_sumber_pengeluaran' => $id]);
	}
}

/* End of file M_sumber_pengeluaran.php */
