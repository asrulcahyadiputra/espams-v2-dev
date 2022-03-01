<?php

defined('BASEPATH') or exit('No direct script access allowed');

class M_arus_kas extends CI_Model
{
	public function company()
	{
		return $this->db->get('setting_company')->row_array();
	}
	public function opening_balance($y, $m)
	{
		$db = $this->db->query("SELECT 
		tb_mutasi.sub_code as header,
		tb_mutasi.account_no as kode_akun,
		tb_mutasi.account_name as nama_akun,
		tb_opening1.opening_debet + tb_opening2.opening_debet as opening_debet ,
		tb_opening1.opening_kredit + tb_opening2.opening_kredit as opening_kredit,
		tb_mutasi.post
		FROM (
				SELECT 
				a.sub_code,
				a.account_no,
				a.account_name,
				a.post
                FROM chart_of_account as a 
                LEFT OUTER JOIN jurnal_umum as b 
                ON a.account_no=b.account_no AND month(b.tanggal) = $m AND year(b.tanggal) = $y
                WHERE a.arus_kas = 1
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
                 WHERE a.arus_kas = 1
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
                  WHERE a.arus_kas = 1
				GROUP BY a.account_no
				) as tb_opening2
		ON tb_mutasi.account_no=tb_opening2.account_no
		GROUP BY tb_mutasi.account_no")->result_array();
		return $db;
	}
	public function coa($y, $m)
	{
		$this->db->select('b.account_no,b.account_name,a.head_code,a.sub_code,b.account_no,sum(c.nominal) as total,b.normal_balance')
			->from('chart_of_account as b')
			->join('coa_subhead as a', 'a.sub_code=b.sub_code')
			->join('jurnal_umum as c', 'b.account_no=c.account_no and  month(c.tanggal) = "' . $m . '" and  year(c.tanggal) = "' . $y . '" ', 'left')
			->where_in('a.activity', ['penerimaan', 'pengeluaran'])
			->group_by('b.account_no');
		return $this->db->get()->result_array();
	}
	public function bank($y, $m)
	{
		$this->db->select('b.account_no,b.account_name,a.head_code,a.sub_code,b.account_no,sum(IF(c.posisi="d",c.nominal,0)) as total,b.normal_balance')
			->from('chart_of_account as b')
			->join('coa_subhead as a', 'a.sub_code=b.sub_code')
			->join('jurnal_umum as c', 'b.account_no=c.account_no and  month(c.tanggal) = "' . $m . '" and  year(c.tanggal) = "' . $y . '" ', 'left')
			->where('b.kas_to_bank', 1)
			->group_by('b.account_no');
		return $this->db->get()->result_array();
	}
	public function saldo_akhir($y, $m)
	{
		$db = $this->db->query("SELECT 
			if(a.post = 'bank','Bank','Kas') as nama,
		    SUM(if(b.posisi = 'd',b.nominal,0)) - SUM(if(b.posisi = 'k',b.nominal,0)) as saldo_akhir
		    FROM chart_of_account as a 
		    LEFT OUTER JOIN jurnal_umum as b 
		    ON a.account_no=b.account_no 
		    WHERE a.arus_kas = 1
		    GROUP BY a.post
		    ORDER BY a.post DESC")->result_array();
		return $db;
	}
	public function try_laba($y, $m)
	{
		$this->db->select('a.head_code,sum(if(a.head_code = "4",c.nominal,0)) as total_pendapatan,sum(if(a.head_code = "5",c.nominal,0)) as total_beban')
			->from('chart_of_account as b')
			->join('coa_subhead as a', 'a.sub_code=b.sub_code')
			->join('jurnal_umum as c', 'b.account_no=c.account_no and  month(c.tanggal) = "' . $m . '" and  year(c.tanggal) = "' . $y . '" ', 'left')
			->where_in('a.activity', ['penerimaan', 'pengeluaran']);
		return $this->db->get()->row_array();
	}

	public function head()
	{
		$this->db->where_in('head_code', ['3', '4', '5']);
		return $this->db->get('coa_head')->result_array();
	}
	public function sub()
	{
		$this->db->where_in('head_code', ['3', '4', '5']);
		return $this->db->get('coa_subhead')->result_array();
	}
}

/* End of file M_arus_kas.php */
