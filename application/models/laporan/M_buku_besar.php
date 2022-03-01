<?php

defined('BASEPATH') or exit('No direct script access allowed');

class M_buku_besar extends CI_Model
{
	public function coa()
	{
		return $this->db->get('chart_of_account')->result_array();
	}
	public function select_coa($a)
	{
		return $this->db->get_where('chart_of_account', ['account_no' => $a])->row_array();
	}

	public function head()
	{
		return $this->db->get('coa_head')->result_array();
	}
	public function subhead()
	{
		return $this->db->get('coa_subhead')->result_array();
	}
	public function company()
	{
		return $this->db->get('setting_company')->row_array();
	}
	private function opening_balance1($y, $m, $a)
	{
		$this->db->select('a.account_no,b.account_name,SUM(IF(a.posisi = "d",a.nominal,0)) as debet,sum(IF(a.posisi = "k",a.nominal,0)) as kredit,b.normal_balance')
			->from('jurnal_umum as a')
			->join('chart_of_account as b', 'a.account_no=b.account_no')
			->where('a.account_no', $a)
			->where('year(a.tanggal)', $y)
			->where('month(a.tanggal) <', $m);
		return $this->db->get()->row();
	}
	private function opening_balance2($y, $a)
	{
		$this->db->select('a.account_no,b.account_name,SUM(IF(a.posisi = "d",a.nominal,0)) as debet,sum(IF(a.posisi = "k",a.nominal,0)) as kredit,b.normal_balance')
			->from('jurnal_umum as a')
			->join('chart_of_account as b', 'a.account_no=b.account_no')
			->where('a.account_no', $a)
			->where('year(a.tanggal) <', $y);
		return $this->db->get()->row();
	}
	public function saldo_awal($y, $m, $a)
	{
		$db = $this->db->query("SELECT 
		tb_mutasi.sub_code as header,
		tb_mutasi.account_no as kode_akun,
		tb_mutasi.account_name as nama_akun,
		tb_opening1.opening_debet + tb_opening2.opening_debet as opening_debet ,
		tb_opening1.opening_kredit + tb_opening2.opening_kredit as opening_kredit,
		tb_mutasi.mutasi_debet,
		tb_mutasi.mutasi_kredit,
		tb_mutasi.normal_balance as saldo_normal
		FROM (
				SELECT 
				a.sub_code,
				a.account_no,
				a.account_name,
				SUM(IF(b.posisi = 'd',b.nominal,0)) as mutasi_debet,
				SUM(IF(b.posisi = 'k',b.nominal,0)) as mutasi_kredit,
					a.normal_balance
			FROM chart_of_account as a 
			LEFT OUTER JOIN jurnal_umum as b 
			ON a.account_no=b.account_no AND month(b.tanggal) = $m AND year(b.tanggal) = $y
			GROUP BY a.account_no
			) as tb_mutasi
			JOIN (
					SELECT 
					a.sub_code,
					a.account_no,
					a.account_name,
					SUM(IF(b.posisi = 'd',b.nominal,0)) as opening_debet,
					SUM(IF(b.posisi = 'k',b.nominal,0)) as opening_kredit
				FROM chart_of_account as a 
				LEFT OUTER JOIN jurnal_umum as b 
				ON a.account_no=b.account_no AND month(b.tanggal) < $m AND year(b.tanggal) = $y
				GROUP BY a.account_no
				) as tb_opening1
			ON tb_mutasi.account_no=tb_opening1.account_no
			JOIN (
					SELECT 
					a.sub_code,
					a.account_no,
					a.account_name,
					SUM(IF(b.posisi = 'd',b.nominal,0)) as opening_debet,
					SUM(IF(b.posisi = 'k',b.nominal,0)) as opening_kredit
				FROM chart_of_account as a 
				LEFT OUTER JOIN jurnal_umum as b 
				ON a.account_no=b.account_no AND  year(b.tanggal) < $y
				GROUP BY a.account_no
				) as tb_opening2
		ON tb_mutasi.account_no=tb_opening2.account_no
		WHERE tb_mutasi.account_name = '$a'
		GROUP BY tb_mutasi.account_no")->row_array();

		return $db;
	}
	public function all($y, $m, $a)
	{
		$this->db->select('b.tanggal,a.id_transaksi,a.account_no,b.catatan,IF(a.posisi = "d",a.nominal,0) as debet,IF(a.posisi = "k",a.nominal,0) as kredit,c.normal_balance')
			->from('jurnal_umum as a')
			->join('transaksi as b', 'a.id_transaksi=b.id_transaksi')
			->join('chart_of_account as c', 'a.account_no=c.account_no')
			->where('a.account_no', $a)
			->where('year(b.tanggal)', $y)
			->where('month(b.tanggal)', $m)
			->order_by('b.tanggal', 'ASC');
		return $this->db->get()->result_array();
	}
}

/* End of file M_buku_besar.php */
