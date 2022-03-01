<?php

function acc_menu1($uri)
{
	$CI = get_instance();
	$CI->db->select(" a.sub_id,a.sub_name,if(b.head_level=0,b.head_uri,a.sub_uri) as uri,b.head_level,c.role_id")
		->from(' menu_head as b ')
		->join('menu_sub as a', 'a.head_id=b.head_id', 'left')
		->join('menu_management as c', 'a.sub_id=c.sub_id', 'left')
		->having('uri', $uri);
	return $CI->db->get()->row_array();
}

function is_log()
{
	$CI = get_instance();
	$user_id = $CI->session->userdata('user_id');
	$role_id = $CI->session->userdata('role');
	if ($CI->session->userdata('login') != 1) {
		redirect('login');
	} else {
		$uri1 = $CI->uri->segment(1);
		$uri2 = $CI->uri->segment(2);
		if ($uri2 == '') {
			$try_access 	= $uri1;
		} else {
			$try_access 	= $uri1 . '/' . $uri2;
		}
		$menu = acc_menu1($try_access);
		if ($menu['head_level'] == 0) {
			// okey
		} else {
			if ($role_id == $menu['role_id']) {
				//okey
			} else {
				redirect('error403');
			}
		}
	}
}
