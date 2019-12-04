<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Egp extends CI_Controller {

    public function index()
    {
        $data['title'] = "โปรแกรมบริหารจัดการสารสนเทศทางการศึกษา eSchool 1.0";
        $this->load->view('parcel/inc/header',$data);
        $this->load->view('parcel/egp');
        $this->load->view('parcel/inc/footer');
    }

}

/* End of file Egp.php */
/* Location: .//C/Users/supun/Desktop/controller/Egp.php */