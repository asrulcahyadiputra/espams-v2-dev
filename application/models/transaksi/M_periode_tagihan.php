<?php

defined('BASEPATH') or exit('No direct script access allowed');

class M_periode_tagihan extends CI_Model
{

	public function all()
	{
		return $this->db->get_where('transaksi', ['trans_type' => 'tagihan'])->result_array();
	}

	private function id()
	{
		$this->db->select('RIGHT(id_transaksi,9) as id', FALSE);
		$this->db->where('trans_type', 'tagihan');
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
		$id = "TRX-TGH-" . $interval;
		return $id;
	}
	private function pelanggan()
	{
		$this->db->select('a.id_pelanggan,a.meteran_awal,a.tunggakan,a.denda,a.id_golongan,b.nama_golongan,b.biaya_admin,b.biaya_beban')
			->from('m_pelanggan as a')
			->join('m_golongan as b', 'a.id_golongan=b.id_golongan')
			->order_by('a.id_pelanggan', 'ASC');

		return $this->db->get()->result_array();
	}


	public function select($id_transaksi)
	{
		$this->db->select('c.id_pelanggan,a.nama_pelanggan,a.id_golongan,b.nama_golongan,c.biaya_admin,c.biaya_beban,c.tunggakan,c.denda,c.pemakaian,c.total,c.status')
			->from('trx_tagihan as c')
			->join('m_pelanggan as a', 'c.id_pelanggan=a.id_pelanggan')
			->join('m_golongan as b', 'c.id_golongan=b.id_golongan')
			->where('c.id_transaksi', $id_transaksi)
			->order_by('a.id_pelanggan', 'ASC');

		return $this->db->get()->result_array();
	}

	public function find_transaksi($id_transaksi)
	{
		return $this->db->get_where('transaksi', ['id_transaksi' => $id_transaksi, 'trans_type' => 'tagihan'])->row_array();
	}
	public function store()
	{
		$setting = $this->db->get('setting_tagihan')->row_array();
		$periode = $this->input->post('periode');

		$id_transaksi			= $this->id();
		$bulan 				= date('m', strtotime($periode));
		$tahun 				= date('Y', strtotime($periode));
		$batas_pembayaran		= date('Y-m-d', strtotime($tahun . '-' . $bulan . '-' . $setting['batas_pembayaran']));
		$jenis_tarif			= $setting['jenis_tarif'];
		$validate = $this->db->get_where('transaksi', ['trans_type' => 'tagihan', 'bulan' => $bulan, 'tahun' => $tahun])->row_array();
		if ($validate) {
			$response = [
				'status'		=> 'Warning',
				'label'		=> 'warning',
				'msg'		=> 'Periode Duplikat !'
			];
		} else {
			if ($jenis_tarif == 1) {
				$tarif_tunggal = null;
			} else {
				$tarif_tunggal = $setting['tarif_tunggal'];
			}
			$status_denda = $setting['status_denda_flat'];
			if ($status_denda == 0) {
				$denda_flat = null;
			} else {
				$denda_flat = $setting['denda_flat'];
			}
			$catatan = $setting['catatan'];
			$tipe		= "pa";
			$trans_type 	= "tagihan";

			$transaksi = [
				'id_transaksi'		=> $id_transaksi,
				'bulan'			=> $bulan,
				'tahun'			=> $tahun,
				'jenis_tarif'		=> $jenis_tarif,
				'tarif_tunggal'	=> $tarif_tunggal,
				'batas_pembayaran'	=> $batas_pembayaran,
				'status_denda'		=> $status_denda,
				'denda_flat'		=> $denda_flat,
				'tipe'			=> $tipe,
				'trans_type'		=> $trans_type,
				'catatan'			=> 'Pendapatan dari Tagihan Pelanggan/Anggota KPSPAMS Periode Bulan ' . format_bulan($bulan) . ' ' . $tahun,
				'inv_note'		=> $catatan
			];

			$pelanggan = $this->pelanggan();
			if ($pelanggan) {
				foreach ($pelanggan as $key => $value) {
					$trx_iuran[] = [
						'id_transaksi'		=> $id_transaksi,
						'id_pelanggan'		=> $value['id_pelanggan'],
						'id_golongan'		=> $value['id_golongan'],
						'meteran_awal'		=> $value['meteran_awal'],
						'biaya_admin'		=> $value['biaya_admin'],
						'biaya_beban'		=> $value['biaya_beban'],
						'denda'			=> $value['denda'],
						'tunggakan'		=> $value['tunggakan'],
					];
				}
				$this->db->trans_start();
				$this->db->insert('transaksi', $transaksi);
				$this->db->insert_batch('trx_tagihan', $trx_iuran);
				$this->db->trans_complete();

				$response = [
					'status'		=> 'OK',
					'label'		=> 'success',
					'msg'		=> 'Periode Iuran Berhasil dibuat !'
				];
			} else {
				$response = [
					'status'		=> 'Warning',
					'label'		=> 'warning',
					'msg'		=> 'Pelanggan tidak ditemukan !'
				];
			}
		}
		return $response;
	}
}

/* End of file M_periode_tagihan.php */
