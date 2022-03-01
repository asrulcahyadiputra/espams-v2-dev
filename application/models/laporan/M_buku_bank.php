<?php

defined('BASEPATH') or exit('No direct script access allowed');

class M_buku_bank extends CI_Model
{
	public function company()
	{
		return $this->db->get('setting_company')->row_array();
	}
	private function opening_balance1($y, $m)
	{
		$this->db->select('sum(kredit) as kredit,sum(debet) as debet,')
			->from('rekening_koran')
			->where('year(tanggal)', $y)
			->where('month(tanggal) <', $m);
		return $this->db->get()->row();
	}
	private function opening_balance2($y)
	{
		$this->db->select('sum(kredit) as kredit,sum(debet) as debet,')
			->from('rekening_koran')
			->where('year(tanggal) <', $y);
		return $this->db->get()->row();
	}
	public function saldo_awal($y, $m)
	{
		$saldo_awal = ($this->opening_balance1($y, $m)->kredit - $this->opening_balance1($y, $m)->debet) + ($this->opening_balance2($y)->kredit - $this->opening_balance2($y)->debet);
		// var_dump($saldo_awal);
		// die;
		return $saldo_awal;
	}
	public function all($y, $m)
	{
		return $this->db->get_where('rekening_koran', ['month(tanggal)' => $m, 'year(tanggal)' => $y])->result_array();
	}
}

/* End of file M_buku_bank.php */
