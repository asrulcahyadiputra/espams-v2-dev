<?php

defined('BASEPATH') or exit('No direct script access allowed');

class M_login extends CI_Model
{
	public function select_user($post_username)
	{
		return $this->db->get_where('users', ['username' => $post_username])->row_array();
	}
}

/* End of file M_login.php */
