<?php

defined('BASEPATH') or exit('No direct script access allowed');

class M_user extends CI_Model
{

	public function get_user()
	{
		$this->db->select('a.id_user,a.password,a.username,a.id_pengurus,b.nama_pengurus,b.foto')
			->from('users as a')
			->join('m_pengurus as b', 'a.id_pengurus=b.id_pengurus')
			->where('id_user', $this->session->userdata('user_id'));

		return $this->db->get()->row_array();
	}
}

/* End of file M_user.php */
