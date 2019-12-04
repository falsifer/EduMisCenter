<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {
	public function index()
	{
		$this->load->view('login');
	}
	public function login()
	{
		$password = $this->input->post('password');
		$username = $this->input->post('username');
		$check = $this->login_model->login($username,$password);
		$query_num = $this->login_model->login_num($username,$password);
		if ($query_num['query_num'] == 0) {
			print "<SCRIPT LANGUAGE='JavaScript'>window.alert('Username and Password ไม่ถูกต้อง!');window.location.href='".base_url('')."';</SCRIPT>";
		}
		elseif ($query_num['query_num'] == 1) {
			$query_num = $query_num['query'];
			if ($query_num->row_array()) {
				$data_query = $query_num->result();
				$id = $this->session->set_userdata('id',$data_query[0]->id);
				print "<SCRIPT LANGUAGE='JavaScript'>window.alert('ยินดีต้อนรับเข้าสู่ระบบ');window.location.href='".base_url('index.php/home_percel')."';</SCRIPT>";

			}else{
				$data['message'] = "Error";
			}
		}
	}
}

/* End of file Home.php */
/* Location: ./application/controllers/Home.php */