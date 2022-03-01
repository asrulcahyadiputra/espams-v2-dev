<?php

defined('BASEPATH') or exit('No direct script access allowed');

class M_sumber_pemasukan extends CI_Model
{
	public function all()
	{
		$this->db->select('a.id_sumber_pemasukan,a.nama_sumber_pemasukan,a.id_ref,b.nama_ref,a.manual_entry')
			->from('m_sumber_pemasukan as a')
			->join('ref_pemasukan as b', 'a.id_ref=b.id_ref');

		return $this->db->get()->result_array();
	}
	public function ref()
	{
		return $this->db->get('ref_pemasukan')->result_array();
	}

	private function id_sumber_pemasukan()
	{
		$this->db->select('RIGHT(id_sumber_pemasukan,4) as id_sumber_pemasukan', FALSE);
		$this->db->order_by('id_sumber_pemasukan', 'DESC');
		$this->db->limit(1);
		$query = $this->db->get('m_sumber_pemasukan');
		if ($query->num_rows() <> 0) {
			$data = $query->row();
			$kode = intval($data->id_sumber_pemasukan) + 1;
		} else {
			$kode = 1;
		}
		// $tgl = date('Y-m-d');
		$batas = str_pad($kode, 4, "0", STR_PAD_LEFT);
		$id = 'MD-SPM-' . $batas;
		return $id;
	}
	public function store()
	{
		$id 					= $this->id_sumber_pemasukan();
		$nama_sumber_pemasukan 	= $this->input->post('nama_sumber_pemasukan');
		$id_ref				= $this->input->post('id_ref');

		$data = [
			'id_sumber_pemasukan'	=> $id,
			'nama_sumber_pemasukan'	=> $nama_sumber_pemasukan,
			'id_ref'				=> $id_ref
		];

		return $this->db->insert('m_sumber_pemasukan', $data);
	}
	public function update()
	{

		$id 					= $this->input->post('id_sumber_pemasukan');
		$nama_sumber_pemasukan 	= $this->input->post('nama_sumber_pemasukan');
		$id_ref				= $this->input->post('id_ref');
		$validate = $this->db->get_where('m_sumber_pemasukan', ['id_sumber_pemasukan' => $id])->row_array();
		if ($validate['manual_entry'] == 1) {
			$data = [
				'nama_sumber_pemasukan'	=> $nama_sumber_pemasukan,
				'id_ref'				=> $id_ref
			];
			$this->db->update('m_sumber_pemasukan', $data, ['id_sumber_pemasukan' => $id]);
			$response = [
				'status'		=> 'OK',
				'label'		=> 'success',
				'msg'		=> 'Sumber Pemasukan Berhasil di edit !'
			];
		} else {
			$response = [
				'status'		=> 'Warning',
				'label'		=> 'warning',
				'msg'		=> 'Anda hanya dapat mengedit Sumber Pemasukan yang bertipe manual entry !'
			];
		}

		return $response;
	}
}

/* End of file M_sumber_pemasukan.php */
