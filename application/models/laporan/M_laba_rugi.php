<?php

defined('BASEPATH') or exit('No direct script access allowed');

class M_laba_rugi extends CI_Model
{
	public function company()
	{
		return $this->db->get('setting_company')->row_array();
	}

	public function coa($y, $m)
	{
		$this->db->select('b.account_no,b.account_name,a.head_code,a.sub_code,b.account_no,sum(c.nominal) as total')
			->from('chart_of_account as b')
			->join('coa_subhead as a', 'a.sub_code=b.sub_code')
			->join('jurnal_umum as c', 'b.account_no=c.account_no and  month(c.tanggal) = "' . $m . '" and  year(c.tanggal) = "' . $y . '" ', 'left')
			->where_in('a.head_code', ['4', '5'])
			->group_by('b.account_no');
		return $this->db->get()->result_array();
	}
	public function try_laba($y, $m)
	{
		$this->db->select('a.head_code,sum(if(a.head_code = "4",c.nominal,0)) as total_pendapatan,sum(if(a.head_code = "5",c.nominal,0)) as total_beban')
			->from('chart_of_account as b')
			->join('coa_subhead as a', 'a.sub_code=b.sub_code')
			->join('jurnal_umum as c', 'b.account_no=c.account_no and  month(c.tanggal) = "' . $m . '" and  year(c.tanggal) = "' . $y . '" ', 'left')
			->where_in('a.head_code', ['4', '5']);
		return $this->db->get()->row_array();
	}

	public function head()
	{
		$this->db->where_in('head_code', ['4', '5']);
		return $this->db->get('coa_head')->result_array();
	}
	public function sub()
	{
		$this->db->where_in('head_code', ['4', '5']);
		return $this->db->get('coa_subhead')->result_array();
	}
}

/* End of file M_laba_rugi.php */
