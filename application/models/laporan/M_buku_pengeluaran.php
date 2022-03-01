<?php

defined('BASEPATH') or exit('No direct script access allowed');

class M_buku_pengeluaran extends CI_Model
{
	public function company()
	{
		return $this->db->get('setting_company')->row_array();
	}
	public function all($y, $m)
	{
		$this->db->where('year(tanggal)', $y);
		$this->db->where('month(tanggal)', $m);
		$this->db->where('trans_type', 'cash_out');
		$this->db->order_by('tanggal', 'ASC');
		return $this->db->get('transaksi')->result_array();
	}
}

/* End of file M_buku_pengeluaran.php */
