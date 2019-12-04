<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Unspsc extends CI_Controller {

    public function index()
    {
        $data['title'] = "โปรแกรมบริหารจัดการสารสนเทศทางการศึกษา eSchool 1.0";
        $this->load->view('parcel/inc/header',$data);
        $this->load->view('parcel/unspsc');
        $this->load->view('parcel/inc/footer');
    }

}

/* End of file Unspsc.php */
/* Location: .//C/Users/supun/Desktop/controller/Unspsc.php */