<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Carry extends CI_Controller {

	public function index()
	{
		$data['title'] = "โปรแกรมบริหารจัดการสารสนเทศทางการศึกษา eSchool 1.0";
        $this->load->view('parcel/inc/header',$data);
        $this->load->view('parcel/carry');
        $this->load->view('parcel/inc/footer');
	}

}

/* End of file Carry.php */
/* Location: .//C/Users/supun/Desktop/controller/Carry.php */