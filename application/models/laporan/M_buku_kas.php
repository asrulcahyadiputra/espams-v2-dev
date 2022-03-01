<?php

defined('BASEPATH') or exit('No direct script access allowed');

class M_buku_kas extends CI_Model
{
	public function company()
	{
		return $this->db->get('setting_company')->row_array();
	}
	private function opening_balance1($y, $m)
	{
		$this->db->select('SUM(IF(a.posisi = "d",a.nominal,0)) as debet,sum(IF(a.posisi = "k",a.nominal,0)) as kredit')
			->from('jurnal_umum as a')
			->where('a.account_no', '1-10001')
			->where('year(a.tanggal)', $y)
			->where('month(a.tanggal) <', $m);
		return $this->db->get()->row();
	}
	private function opening_balance2($y)
	{
		$this->db->select('SUM(IF(a.posisi = "d",a.nominal,0)) as debet,sum(IF(a.posisi = "k",a.nominal,0)) as kredit')
			->from('jurnal_umum as a')
			->where('a.account_no', '1-10001')
			->where('year(a.tanggal) <', $y);
		return $this->db->get()->row();
	}
	public function saldo_awal($y, $m)
	{
		$saldo_awal = ($this->opening_balance1($y, $m)->debet - $this->opening_balance1($y, $m)->kredit) + ($this->opening_balance2($y)->debet - $this->opening_balance2($y)->kredit);
		// var_dump($saldo_awal);
		// die;
		return $saldo_awal;
	}
	public function all($y, $m)
	{
		$this->db->select('b.tanggal,a.id_transaksi,a.account_no,b.catatan,IF(a.posisi = "d",a.nominal,0) as debet,IF(a.posisi = "k",a.nominal,0) as kredit')
			->from('jurnal_umum as a')
			->join('transaksi as b', 'a.id_transaksi=b.id_transaksi')
			->where('a.account_no', '1-10001')
			->where('year(b.tanggal)', $y)
			->where('month(b.tanggal)', $m)
			->order_by('b.tanggal', 'ASC');
		return $this->db->get()->result_array();
	}
}

/* End of file M_buku_kas.php */
