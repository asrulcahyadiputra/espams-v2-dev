<?php

defined('BASEPATH') or exit('No direct script access allowed');

class M_invoice extends CI_Model
{

	public function all()
	{
		return $this->db->get('setting_tagihan')->row_array();
	}

	public function update()
	{
		$data = [
			'denda_flat'			=> intval(preg_replace("/[^0-9]/", "", $this->input->post('denda_flat'))),
			'status_denda_flat'		=> $this->input->post('status_denda_flat'),
			'tarif_tunggal'		=> intval(preg_replace("/[^0-9]/", "", $this->input->post('tarif_tunggal'))),
			'jenis_tarif'			=> $this->input->post('jenis_tarif'),
			'batas_pembayaran'		=> $this->input->post('batas_pembayaran'),
			'catatan'				=> $this->input->post('catatan'),
		];

		$this->db->update('setting_tagihan', $data);

		if ($this->db->affected_rows() > 0) {
			$response = [
				'status'	=> 'OK',
				'label'	=> 'success',
				'msg'	=> 'Pengaturan Tagihan Berhasil Diperbaharui !'
			];
		} else {
			$response = [
				'status'	=> 'OK',
				'label'	=> 'warning',
				'msg'	=> 'Tidak ada perubahan yang dilakukan !'
			];
		}
		return $response;
	}
}

/* End of file M_invoice.php */
