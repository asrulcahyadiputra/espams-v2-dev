<?php

defined('BASEPATH') or exit('No direct script access allowed');

class M_kpspams extends CI_Model
{

	public function all()
	{
		return $this->db->get('setting_company')->row_array();
	}

	public function update($data)
	{

		$logo				= $data['file_name'];

		$data = [
			'company_name'			=> $this->input->post('company_name'),
			'company_telp'			=> $this->input->post('company_telp'),
			'company_email'		=> $this->input->post('company_email'),
			'company_address'		=> $this->input->post('company_address'),
			'province'			=> $this->input->post('province'),
			'regency'				=> $this->input->post('regency'),
			'district'			=> $this->input->post('district'),
			'village'				=> $this->input->post('village'),
			'company_logo'			=> $logo
		];
		return $this->db->update('setting_company', $data);
	}
}

/* End of file M_kpspams.php */
