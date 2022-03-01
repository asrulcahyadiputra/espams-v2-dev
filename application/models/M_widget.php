<?php

defined('BASEPATH') or exit('No direct script access allowed');

class M_widget extends CI_Model
{
	public function saldo_akhir_kas()
	{
		$this->db->select('SUM(IF( a.posisi = "d", nominal, 0)) - SUM(IF( a.posisi = "k", nominal, 0)) AS saldo_akhir')
			->from('jurnal_umum as a')
			->where('a.account_no', '1-10001');

		return $this->db->get()->row_array();
	}
	public function pelanggan()
	{
		return $this->db->count_all_results('m_pelanggan');
	}
	public function try_laba()
	{
		$y = date('Y');
		$m = date('m');
		$this->db->select('a.head_code,sum(if(a.head_code = "4",c.nominal,0)) as total_pendapatan,sum(if(a.head_code = "5",c.nominal,0)) as total_beban')
			->from('chart_of_account as b')
			->join('coa_subhead as a', 'a.sub_code=b.sub_code')
			->join('jurnal_umum as c', 'b.account_no=c.account_no and  month(c.tanggal) = "' . $m . '" and  year(c.tanggal) = "' . $y . '" ', 'left')
			->where_in('a.head_code', ['4', '5']);
		return $this->db->get()->row_array();
	}
}

/* End of file M_widget.php */
