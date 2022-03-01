<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class M_golongan extends CI_Model {
	public function all(){
		return $this->db->get('m_golongan')->result_array();
	}
	public function select($id){
		return $this->db->get_where('m_golongan',['id_golongan' => $id])->row_array();
	}
	public function detail($id){
		return $this->db->get_where('m_golongan_detail',['id_golongan' => $id])->result_array();
	}

	private function id_golongan()
	{
		$this->db->select('RIGHT(id_golongan,4) as id_golongan', FALSE);
		$this->db->order_by('id_golongan', 'DESC');
		$this->db->limit(1);
		$query = $this->db->get('m_golongan');
		if ($query->num_rows() <> 0) {
			$data = $query->row();
			$kode = intval($data->id_golongan) + 1;
		} else {
			$kode = 1;
		}
		// $tgl = date('Y-m-d');
		$batas = str_pad($kode, 4, "0", STR_PAD_LEFT);
		$id = 'MD-GOL-'. $batas;
		return $id;
	}
	public function store(){
		$id_golongan			= $this->id_golongan();
		$batas_bawah			= $this->input->post('min_pemakaian');
		$batas_atas			= $this->input->post('max_pemakaian');
		$biaya_admin 			= intval(preg_replace("/[^0-9]/", "", $this->input->post('biaya_admin')));
		$biaya_beban 			= intval(preg_replace("/[^0-9]/", "", $this->input->post('biaya_beban')));
		$golongan=[
			'id_golongan'		=> $id_golongan,
			'nama_golongan'	=> $this->input->post('nama_golongan'),
			'biaya_admin'		=> $biaya_admin,
			'biaya_beban'		=> $biaya_beban,
			'interval_atas'	=> $this->input->post('interval_atas'),
			'max_tarif'		=> intval(preg_replace("/[^0-9]/", "", $this->input->post('max_tarif')))
		];
		foreach($batas_bawah as $key => $val){
			$detail[] = [
				'id_golongan'		=> $id_golongan,
				'min_pemakaian'	=> $batas_bawah[$key],
				'max_pemakaian'	=> $batas_atas[$key],
				'tarif'			=> intval(preg_replace("/[^0-9]/", "", $this->input->post('tarif')[$key]))
			];
		}
		$this->db->trans_start();
		$this->db->insert('m_golongan',$golongan);
		$this->db->insert_batch('m_golongan_detail',$detail);
		$this->db->trans_complete();
	}
	public function delete_item($id_golongan_detail){
		$validate = $this->db->get_where('m_golongan_detail',['id_golongan_detail' => $id_golongan_detail])->row_array();
		if($validate){
			$this->db->delete('m_golongan_detail',['id_golongan_detail' => $id_golongan_detail]);
			$response = [
				'status'	=> 1
			];
		}else{
			$response = [
				'status'	=> 0
			];
		}
		return $response;
	}
	public function store_item(){
		$detail = [
			'id_golongan'		=> $this->input->post('id_golongan'),
			'min_pemakaian'	=> $this->input->post('min_pemakaian'),
			'max_pemakaian'	=> $this->input->post('max_pemakaian'),
			'tarif'			=> intval(preg_replace("/[^0-9]/", "", $this->input->post('tarif')))
		];
		return $this->db->insert('m_golongan_detail',$detail);
	}
	public function update(){
		$id_golongan			= $this->input->post('id_golongan');
		$batas_bawah			= $this->input->post('min_pemakaian');
		$batas_atas			= $this->input->post('max_pemakaian');
		$biaya_admin 			= intval(preg_replace("/[^0-9]/", "", $this->input->post('biaya_admin')));
		$biaya_beban 			= intval(preg_replace("/[^0-9]/", "", $this->input->post('biaya_beban')));
		$golongan=[
			'nama_golongan'	=> $this->input->post('nama_golongan'),
			'biaya_admin'		=> $biaya_admin,
			'biaya_beban'		=> $biaya_beban,
			'interval_atas'	=> $this->input->post('interval_atas'),
			'max_tarif'		=> intval(preg_replace("/[^0-9]/", "", $this->input->post('max_tarif')))
		];
		foreach($batas_bawah as $key => $val){
			$detail[] = [
				'id_golongan_detail'=> $this->input->post('id_golongan_detail')[$key],
				'min_pemakaian'	=> $batas_bawah[$key],
				'max_pemakaian'	=> $batas_atas[$key],
				'tarif'			=> intval(preg_replace("/[^0-9]/", "", $this->input->post('tarif')[$key]))
			];
		}
		$this->db->trans_start();
		$this->db->update('m_golongan',$golongan,['id_golongan' => $id_golongan]);
		$this->db->update_batch('m_golongan_detail',$detail,'id_golongan_detail');
		$this->db->trans_complete();
	}
}

/* End of file M_golongan.php */


?>
