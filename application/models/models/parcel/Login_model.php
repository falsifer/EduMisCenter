<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login_model extends CI_Model {
	public function __construct()
	{
		$this->load->database();
	}
	public function login($username,$password)
	{
		$sql = "SELECT * FROM tb_member WHERE username = '$username'  AND password = '$password'";
		$query = $this->db->query($sql);
		return $query->row_array();
	}
	public function login_num($username,$password)
	{
		$sql = "SELECT * FROM tb_member WHERE username = '$username'  AND password = '$password'";
		$query = $this->db->query($sql);
		return array(
			'query_num' => $query->num_rows(),
			'query' => $query
		);
	}
	

}

/* End of file Login_model.php */
/* Location: .//C/Users/COM-BIG-BEN/AppData/Local/Temp/fz3temp-2/Login_model.php */