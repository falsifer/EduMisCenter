<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Home_parcel extends CI_Controller {

    public function __construct() {
        parent::__construct();
        if ($this->session->userdata('status') == "") {
            redirect("/");
        }
    }

    public function index() {
        $data['title'] = "โปรแกรมบริหารจัดการสารสนเทศทางการศึกษา eSchool 1.0";
        //$this->load->view('parcel/inc/header',$data);
        $this->load->view('layout/header');
        $this->load->view('parcel/index');
        $this->load->view('layout/footer');
        $this->load->view('parcel/inc/footer2');
    }

}

/* End of file Home_percel.php */
/* Location: .//C/Users/COM-BIG-BEN/AppData/Local/Temp/fz3temp-2/Home_percel.php */