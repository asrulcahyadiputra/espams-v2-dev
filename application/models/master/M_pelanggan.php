<?php

defined('BASEPATH') or exit('No direct script access allowed');

class M_pelanggan extends CI_Model
{


	public function golongan()
	{
		return $this->db->get('m_golongan')->result_array();
	}
	public function wilayah()
	{
		return $this->db->get('m_wilayah')->result_array();
	}

	public function all()
	{
		$this->db->select('a.id_pelanggan,a.nama_pelanggan,a.no_telp,a.alamat,a.meteran_awal,a.tunggakan,a.denda,a.id_golongan,b.nama_golongan,b.biaya_admin,c.id_wilayah,c.nama_wilayah')
			->from('m_pelanggan as a')
			->join('m_golongan as b', 'a.id_golongan=b.id_golongan')
			->join('m_wilayah as c', 'c.id_wilayah=a.id_wilayah', 'left')
			->order_by('a.id_pelanggan', 'ASC');

		return $this->db->get()->result_array();
	}
	public function select($id_pelanggan)
	{
		$this->db->select('a.id_pelanggan,a.nama_pelanggan,a.no_telp,a.alamat,a.meteran_awal,a.tunggakan,a.denda,a.id_golongan,b.nama_golongan')
			->from('m_pelanggan as a')
			->join('m_golongan as b', 'a.id_golongan=b.id_golongan')
			->where('id_pelanggan', $id_pelanggan);

		return $this->db->get()->row_array();
	}

	public function find_trx($id_pelanggan)
	{
		return $this->db->get_where('transaksi', ['id_pelanggan' => $id_pelanggan, 'trans_type' => 'sr'])->row_array();
	}

	private function id_transaksi()
	{

		$ref = $this->db->get_where('ref_pemasukan', ['id_ref' => 5])->row_array(); //5=pendapatan atas pemasangan sr baru

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
		return $id;
	}

	private function id()
	{

		$this->db->select('RIGHT(id_pelanggan,9) as id', FALSE);
		$this->db->order_by('id_pelanggan', 'DESC');
		$this->db->limit(1);
		$query = $this->db->get('m_pelanggan');
		if ($query->num_rows() <> 0) {
			$data = $query->row();
			$code = intval($data->id) + 1;
		} else {
			$code = 1;
		}

		$interval = str_pad($code, 9, "0", STR_PAD_LEFT);
		$id = "MD-PL-" . $interval;
		return $id;
	}
	public function store()
	{
		$this->db->trans_start();
		$id_pelanggan 		= $this->id();
		$nama_pelanggan 	= $this->input->post('nama_pelanggan');
		$no_telp 			= $this->input->post('no_telp');
		$id_golongan 		= $this->input->post('id_golongan');
		$meteran_awal 		= $this->input->post('meteran_awal');
		$alamat 			= $this->input->post('alamat');
		$id_wilayah 		= $this->input->post('id_wilayah');
		$biaya_sr	  		= intval(preg_replace("/[^0-9]/", "", $this->input->post('biaya_sr')));
		$tunggakan	  	= intval(preg_replace("/[^0-9]/", "", $this->input->post('tunggakan')));
		$denda	  		= intval(preg_replace("/[^0-9]/", "", $this->input->post('denda')));

		if ($meteran_awal > 0) {
			$meteran = $this->input->post('meteran_awal');
		} else {
			$meteran = 0;
		}
		$pelanggan = [
			'id_pelanggan'			=> $id_pelanggan,
			'nama_pelanggan'		=> $nama_pelanggan,
			'no_telp'				=> $no_telp,
			'meteran_awal'			=> $meteran,
			'alamat'				=> $alamat,
			'id_wilayah'			=> $id_wilayah,
			'tunggakan'			=> $tunggakan,
			'denda'				=> $denda,
			'id_golongan'			=> $id_golongan
		];
		$this->db->insert('m_pelanggan', $pelanggan);
		if ($biaya_sr > 0) {

			$biaya = $biaya_sr;
			$ref = $this->db->get_where('ref_pemasukan', ['id_ref' => 5])->row_array(); //5=pendapatan atas pemasangan sr baru
			$id_transaksi = $this->id_transaksi();


			$transaksi = [
				'id_transaksi'		=> $id_transaksi,
				'id_pelanggan'		=> $id_pelanggan,
				'total'			=> $biaya,
				'tipe'			=> $ref['tipe'],
				'trans_type'		=> 'cash_in',
				'catatan'			=> 'Pendapatan Atas Pembayaran Biaya Pemsangan SR'
			];
			$gl = [
				[
					'account_no'		=> $ref['debet'],
					'id_transaksi'		=> $id_transaksi,
					'posisi'			=> 'd',
					'nominal'			=> $biaya
				],
				[
					'account_no'		=> $ref['kredit'],
					'id_transaksi'		=> $id_transaksi,
					'posisi'			=> 'k',
					'nominal'			=> $biaya
				],
			];
			$this->db->insert('transaksi', $transaksi);
			$this->db->insert_batch('jurnal_umum', $gl);
		}
		// echo "<pre>";
		// print_r($pelanggan);
		// print_r($transaksi);
		// print_r($gl);
		// echo "</pre>";
		// die;
		$this->db->trans_complete();
	}

	public function update()
	{
		$this->db->trans_start();
		$id_pelanggan 		= $this->input->post('id_pelanggan');
		$nama_pelanggan 	= $this->input->post('nama_pelanggan');
		$no_telp 			= $this->input->post('no_telp');
		$id_golongan 		= $this->input->post('id_golongan');
		$meteran_awal 		= $this->input->post('meteran_awal');
		$alamat 			= $this->input->post('alamat');
		$id_wilayah 		= $this->input->post('id_wilayah');
		$biaya_sr	  		= intval(preg_replace("/[^0-9]/", "", $this->input->post('biaya_sr')));
		$tunggakan	  	= intval(preg_replace("/[^0-9]/", "", $this->input->post('tunggakan')));
		$denda	  		= intval(preg_replace("/[^0-9]/", "", $this->input->post('denda')));

		if ($meteran_awal > 0) {
			$meteran = $this->input->post('meteran_awal');
		} else {
			$meteran = 0;
		}
		$pelanggan = [
			'nama_pelanggan'		=> $nama_pelanggan,
			'no_telp'				=> $no_telp,
			'meteran_awal'			=> $meteran,
			'alamat'				=> $alamat,
			'id_wilayah'			=> $id_wilayah,
			'tunggakan'			=> $tunggakan,
			'denda'				=> $denda,
			'id_golongan'			=> $id_golongan
		];
		$this->db->update('m_pelanggan', $pelanggan, ['id_pelanggan' => $id_pelanggan]);

		$cek_trx = $this->db->get_where('transaksi', ['id_pelanggan' => $id_pelanggan, 'trans_type' => 'sr'])->row_array();
		if ($biaya_sr > 0) {
			if ($cek_trx) {
				$biaya = $biaya_sr;
				$ref = $this->db->get_where('ref_pemasukan', ['id_ref' => 5])->row_array(); //5=pendapatan atas pemasangan sr baru
				$id_transaksi = $cek_trx['id_transaksi'];
				$transaksi = [
					'total'			=> $biaya
				];
				$gl = [
					[
						'id_transaksi'		=> $id_transaksi,
						'nominal'			=> $biaya
					],
					[
						'id_transaksi'		=> $id_transaksi,
						'nominal'			=> $biaya
					],
				];
				$this->db->update('transaksi', $transaksi, ['id_transaksi' => $cek_trx['id_transaksi']]);
				$this->db->update_batch('jurnal_umum', $gl, 'id_transaksi');
			} else {
				$biaya = $biaya_sr;
				$ref = $this->db->get_where('ref_pemasukan', ['id_ref' => 5])->row_array(); //5=pendapatan atas pemasangan sr baru
				$id_transaksi = $this->id_transaksi();
				$transaksi = [
					'id_transaksi'		=> $id_transaksi,
					'id_pelanggan'		=> $id_pelanggan,
					'total'			=> $biaya,
					'tipe'			=> $ref['tipe'],
					'trans_type'		=> 'cash_in',
					'catatan'			=> 'Pendapatan Atas Pembayaran Biaya Pemsangan SR'
				];
				$gl = [
					[
						'account_no'		=> $ref['debet'],
						'id_transaksi'		=> $id_transaksi,
						'posisi'			=> 'd',
						'nominal'			=> $biaya
					],
					[
						'account_no'		=> $ref['kredit'],
						'id_transaksi'		=> $id_transaksi,
						'posisi'			=> 'k',
						'nominal'			=> $biaya
					],
				];
				$this->db->insert('transaksi', $transaksi);
				$this->db->insert_batch('jurnal_umum', $gl);
			}
		} else {
			if ($cek_trx) {
				$this->db->delete('transaksi', ['id_transaksi' => $cek_trx['id_transaksi']]);
			}
		}
		// echo "<pre>";
		// print_r($pelanggan);
		// print_r($transaksi);
		// print_r($gl);
		// echo "</pre>";
		// die;
		$this->db->trans_complete();
	}
}

/* End of file M_pelanggan.php */
