<?php

defined('BASEPATH') or exit('No direct script access allowed');

class M_buku_iuran extends CI_Model
{

	public function company()
	{
		return $this->db->get('setting_company')->row_array();
	}
	public function all($y, $m)
	{
		$this->db->select('c.id_pelanggan,a.nama_pelanggan,a.alamat,a.id_golongan,b.nama_golongan,c.meteran_awal,c.meteran_akhir,d.wajib,d.pemakaian,d.denda,d.tunggakan')
			->from('trx_tagihan as c')
			->join('transaksi as e', 'c.id_transaksi=e.id_transaksi')
			->join('trx_pembayaran_tagihan as d', 'd.id_tagihan=c.id_tagihan')
			->join('m_pelanggan as a', 'c.id_pelanggan=a.id_pelanggan')
			->join('m_golongan as b', 'c.id_golongan=b.id_golongan')
			->where('e.bulan', $m)
			->where('e.tahun', $y)
			->order_by('a.id_pelanggan', 'ASC');

		return $this->db->get()->result_array();
	}
}

/* End of file M_buku_iuran.php */
