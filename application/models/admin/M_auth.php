<?php 

class M_auth extends CI_Model 
{
	public function get_user($params)
	{
		return $this->db->get_where('admin', $params)->row_array();
	}
}