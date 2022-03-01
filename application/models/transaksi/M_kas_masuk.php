<?php

defined('BASEPATH') or exit('No direct script access allowed');

class M_kas_masuk extends CI_Model
{

	public function all()
	{
		$this->db->order_by('tanggal', 'DESC');
		return $this->db->get_where('transaksi', ['trans_type' => 'cash_in'])->result_array();
	}
	public function sumber()
	{
		return $this->db->get_where('m_sumber_pemasukan', ['manual_entry' => 1])->result_array();
	}


	private function id_transaksi($id_ref)
	{
		$ref = $this->db->get_where('ref_pemasukan', ['id_ref' => $id_ref])->row_array();
		$this->db->select('RIGHT(id_transaksi,9) as id', FALSE);
		$this->db->where('tipe', $ref['tipe']);
		$this->db->order_by('id_transaksi', 'DESC');
		$this->db->limit(1);
		$query = $this->db->get('transaksi');
		if ($query->num_rows() <> 0) {
			$data = $query->row();
			$code = intval($data->id) + 1;
		} else {
			$code = 1;
		}

		$interval = str_pad($code, 9, "0", STR_PAD_LEFT);
		$id = $ref['kode_transaksi'] . $interval;

		$data = [
			'id_transaksi'		=> $id,
			'tipe'			=> $ref['tipe']
		];
		return $data;
	}

	public function store()
	{
		$id_sumber_pemasukan 	= $this->input->post('id_sumber_pemasukan');
		$tanggal 				= $this->input->post('tanggal');
		$catatan 				= $this->input->post('catatan');
		$id_sumber_pemasukan 	= $this->input->post('id_sumber_pemasukan');
		$total	  			= intval(preg_replace("/[^0-9]/", "", $this->input->post('total')));

		$ref = $this->db->get_where('m_sumber_pemasukan', ['id_sumber_pemasukan' => $id_sumber_pemasukan])->row_array();
		$ledger = $this->db->get_where('ref_pemasukan', ['id_ref' => $ref['id_ref']])->row_array();
		$code_gen = $this->id_transaksi($ref['id_ref']);
		if ($total > 0) {
			$data = [
				'id_transaksi'			=> $code_gen['id_transaksi'],
				'tanggal'				=> $tanggal,
				'id_sumber_pemasukan'	=> $id_sumber_pemasukan,
				'total'				=> $total,
				'tipe'				=> $code_gen['tipe'],
				'trans_type'			=> 'cash_in',
				'catatan'				=> $catatan
			];
			$gl = [
				[
					'account_no'			=> $ledger['debet'],
					'id_transaksi'			=> $code_gen['id_transaksi'],
					'tanggal'				=> $tanggal,
					'nominal'				=> $total,
					'posisi'				=> 'd'
				],
				[
					'account_no'			=> $ledger['kredit'],
					'id_transaksi'			=> $code_gen['id_transaksi'],
					'tanggal'				=> $tanggal,
					'nominal'				=> $total,
					'posisi'				=> 'k'
				]
			];
			$this->db->trans_start();
			$this->db->insert('transaksi', $data);
			$this->db->insert_batch('jurnal_umum', $gl);
			$this->db->trans_complete();
			$response = [
				'status'		=> 'OK',
				'label'		=> 'success',
				'msg'		=> 'Kas Masuk berhsail ditambahkan !'
			];
		} else {
			$response = [
				'status'		=> 'Warning',
				'label'		=> 'warning',
				'msg'		=> 'Kas Masuk gagal ditambahkan, pastikan isian Anda benar !'
			];
		}

		return $response;
	}

	public function update()
	{
		$id_transaksi			= $this->input->post('id_transaksi');
		$tanggal 				= $this->input->post('tanggal');
		$catatan 				= $this->input->post('catatan');
		$total	  			= intval(preg_replace("/[^0-9]/", "", $this->input->post('total')));
		if ($total > 0) {
			$data = [
				'tanggal'				=> $tanggal,
				'total'				=> $total,
				'catatan'				=> $catatan
			];
			$gl = [
				[
					'id_transaksi'			=> $id_transaksi,
					'tanggal'				=> $tanggal,
					'nominal'				=> $total,
				],
				[
					'id_transaksi'			=> $id_transaksi,
					'tanggal'				=> $tanggal,
					'nominal'				=> $total,
				]
			];
			$this->db->trans_start();
			$this->db->update('transaksi', $data, ['id_transaksi' => $id_transaksi]);
			$this->db->update_batch('jurnal_umum', $gl, 'id_transaksi');
			$this->db->trans_complete();
			$response = [
				'status'		=> 'OK',
				'label'		=> 'success',
				'msg'		=> 'Kas Masuk berhsail diedit !'
			];
		} else {
			$response = [
				'status'		=> 'Warning',
				'label'		=> 'warning',
				'msg'		=> 'Kas Masuk gagal ditambahkan, pastikan isian Anda benar !'
			];
		}

		return $response;
	}
}

/* End of file M_kas_masuk.php */
