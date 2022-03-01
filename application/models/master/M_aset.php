<?php

defined('BASEPATH') or exit('No direct script access allowed');

class M_aset extends CI_Model
{


	public function coa()
	{
		return $this->db->get_where('chart_of_account', ['sub_code' => '1-2'])->result_array();
	}

	public function head()
	{
		return $this->db->get('aset_head')->result_array();
	}
	public function subhead()
	{
		return $this->db->get('aset_subhead')->result_array();
	}
	public function all()
	{
		$this->db->select('a.aset_code,a.aset_name,a.aset_unit,a.subhead_code,a.account_no,b.account_name')
			->from('aset as a')
			->join('chart_of_account as b', 'a.account_no=b.account_no');

		return $this->db->get()->result_array();
	}
	public function select($id)
	{
		$this->db->select('a.aset_code,a.aset_name,a.aset_unit,a.subhead_code,a.account_no,b.account_name')
			->from('aset as a')
			->join('chart_of_account as b', 'a.account_no=b.account_no')
			->where('a.aset_code', $id);

		return $this->db->get()->row_array();
	}
	private function id($subhead_code)
	{
		$this->db->select('RIGHT(aset_code,4) as id', FALSE);
		$this->db->where('subhead_code', $subhead_code);
		$this->db->order_by('aset_code', 'DESC');
		$this->db->limit(1);
		$query = $this->db->get('aset');
		if ($query->num_rows() <> 0) {
			$data = $query->row();
			$code = intval($data->id) + 1;
		} else {
			$code = 1;
		}
		$sub = $this->db->get_where('aset_subhead', ['subhead_code' => $subhead_code])->row_array();
		$interval = str_pad($code, 4, "0", STR_PAD_LEFT);
		$id = $sub['subhead_code'] . $interval;
		return $id;
	}
	public function store()
	{
		$subhead_code 	= $this->input->post('subhead_code');
		$aset_name	= $this->input->post('aset_name');
		$aset_unit	= $this->input->post('aset_unit');
		$account_no	= $this->input->post('account_no');
		$aset_code 	= $this->id($subhead_code);
		$data = [
			'aset_code'		=> $aset_code,
			'aset_name'		=> $aset_name,
			'aset_unit'		=> $aset_unit,
			'subhead_code'		=> $subhead_code,
			'account_no'		=> $account_no
		];
		return $this->db->insert('aset', $data);
	}
	public function update()
	{
		$subhead_code 	= $this->input->post('subhead_code');
		$aset_name	= $this->input->post('aset_name');
		$aset_unit	= $this->input->post('aset_unit');
		$account_no	= $this->input->post('account_no');
		$aset_code 	= $this->input->post('aset_code');
		$data = [
			'aset_code'		=> $aset_code,
			'aset_name'		=> $aset_name,
			'aset_unit'		=> $aset_unit,
			'subhead_code'		=> $subhead_code,
			'account_no'		=> $account_no
		];
		return $this->db->update('aset', $data, ['aset_code' => $aset_code]);
	}
}

/* End of file M_aset.php */
