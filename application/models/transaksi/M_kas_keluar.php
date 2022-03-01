<?php

defined('BASEPATH') or exit('No direct script access allowed');

class M_kas_keluar extends CI_Model
{

	public function all()
	{
		$this->db->order_by('tanggal', 'DESC');
		$this->db->where_in('trans_type', ['cash_out', 'bank_out']);
		return $this->db->get('transaksi')->result_array();
	}
	public function sumber()
	{
		return $this->db->get_where('m_sumber_pengeluaran', ['manual_entry' => 1])->result_array();
	}
	private function validate_kas()
	{
		$this->db->select('SUM(IF( posisi = "d", nominal, 0)) AS debet,SUM(IF( posisi = "k", nominal, 0)) AS kredit')
			->from('jurnal_umum')
			->where('account_no', '1-10001');

		return $this->db->get()->row_array();
	}

	private function id_transaksi($id_ref)
	{
		$ref = $this->db->get_where('ref_pengeluaran', ['id_ref' => $id_ref])->row_array();
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

		$kas 	= $this->validate_kas();

		$saldo 	= $kas['debet'] - $kas['kredit'];



		$id_sumber_pengeluaran 	= $this->input->post('id_sumber_pengeluaran');
		$tanggal 				= $this->input->post('tanggal');
		$catatan 				= $this->input->post('catatan');
		$id_sumber_pengeluaran 	= $this->input->post('id_sumber_pengeluaran');
		$total	  			= intval(preg_replace("/[^0-9]/", "", $this->input->post('total')));

		$ref 				= $this->db->get_where('m_sumber_pengeluaran', ['id_sumber_pengeluaran' => $id_sumber_pengeluaran])->row_array();
		$ledger 				= $this->db->get_where('ref_pengeluaran', ['id_ref' => $ref['id_ref']])->row_array();
		$code_gen	 			= $this->id_transaksi($ref['id_ref']);
		// echo "<pre>";
		// print_r($saldo);
		// echo "</pre>";
		// die;

		if ($saldo >= $total) {
			if ($total > 0) {
				if ($ledger['record'] == 'gl') {
					//general ledger only
					$trans_type = 'cash_out';
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
				} elseif ($ledger['record'] == 'rk') {
					$trans_type = 'bank_out';
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
					// rekening koran untuk pengeluaran bank
					$rekening_koran = [
						'id_transaksi'			=> $code_gen['id_transaksi'],
						'account_no'			=> $ledger['debet'],
						'tanggal'				=> $tanggal,
						'debet'				=> $total,
						'note'				=> $catatan
					];
				} elseif ($ledger['record'] == 'gk') {
					// ex. penarikan tunai dari bank
					$trans_type = 'cash_out';
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
					// rekening koran
					$rekening_koran = [
						'id_transaksi'			=> $code_gen['id_transaksi'],
						'account_no'			=> $ledger['debet'],
						'tanggal'				=> $tanggal,
						'kredit'				=> $total,
						'note'				=> $catatan
					];
				}

				$data = [
					'id_transaksi'			=> $code_gen['id_transaksi'],
					'tanggal'				=> $tanggal,
					'id_sumber_pengeluaran'	=> $id_sumber_pengeluaran,
					'total'				=> $total,
					'tipe'				=> $code_gen['tipe'],
					'trans_type'			=> $trans_type,
					'catatan'				=> $catatan
				];


				$this->db->trans_start();
				$this->db->insert('transaksi', $data);

				if ($rekening_koran) {
					$this->db->insert('rekening_koran', $rekening_koran);
				}
				if ($gl) {
					$this->db->insert_batch('jurnal_umum', $gl);
				}
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
					'msg'		=> 'Pengeluaran gagal ditambahkan, pastikan isian Anda benar !'
				];
			}
		} else {
			$response = [
				'status'		=> 'Warning',
				'label'		=> 'warning',
				'msg'		=> 'Pastikan saldo anda cukup, Pengeluaran gagal di simpan !'
			];
		}

		return $response;
	}

	public function update()
	{
		$kas 	= $this->validate_kas();

		$saldo 	= $kas['debet'] - $kas['kredit'];

		$id_transaksi			= $this->input->post('id_transaksi');
		$tanggal 				= $this->input->post('tanggal');
		$catatan 				= $this->input->post('catatan');
		$total	  			= intval(preg_replace("/[^0-9]/", "", $this->input->post('total')));
		$cek_rekening_koran		= $this->db->get_where('rekening_koran', ['id_transaksi' => $id_transaksi])->row_array();
		if ($cek_rekening_koran) {
			if ($cek_rekening_koran['debet'] == null) {
				$rekening_koran = [
					'tanggal'				=> $tanggal,
					'kredit'				=> $total,
					'note'				=> $catatan
				];
			} else {
				$rekening_koran = [
					'tanggal'				=> $tanggal,
					'debet'				=> $total,
					'note'				=> $catatan
				];
			}
		}
		if ($saldo >= $total) {
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
				if ($rekening_koran) {
					$this->db->update('rekening_koran', $rekening_koran, ['id_transaksi' => $id_transaksi]);
				}
				$this->db->trans_complete();
				$response = [
					'status'		=> 'OK',
					'label'		=> 'success',
					'msg'		=> 'Pengeluaran berhsail diedit !'
				];
			} else {
				$response = [
					'status'		=> 'Warning',
					'label'		=> 'warning',
					'msg'		=> 'Pengeluaran gagal ditambahkan, pastikan isian Anda benar !'
				];
			}
		} else {
			$response = [
				'status'		=> 'Warning',
				'label'		=> 'warning',
				'msg'		=> 'Pastikan saldo anda cukup, Kas Keluar gagal di simpan !'
			];
		}


		return $response;
	}
}

/* End of file M_kas_keluar.php */
