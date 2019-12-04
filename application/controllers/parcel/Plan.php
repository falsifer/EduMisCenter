<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Plan extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        if ($this->session->userdata('status') == "") {
            redirect("/");
        }
        $this->load->model("parcel/Plan_model");
    }

    public function index() {
        $data['title'] = "โปรแกรมบริหารจัดการสารสนเทศทางการศึกษา eSchool 1.0";
        $this->load->view('parcel/inc/header',$data);
//        $this->load->view('layout/header');
        $this->load->view('parcel/plan');
//        $this->load->view("layout/footer");
        $this->load->view('parcel/inc/footer');
    }

    public function process() {
//        $user37 = $this->Plan_model->year_parcel();
//        $year_parcel37 = $user37['year_parcel'];
        $status = $this->Plan_model->insert_update();
        if ($status == 1) {
            print "<SCRIPT LANGUAGE='JavaScript'>window.alert('สำเร็จ');window.location.href='" . base_url('index.php/plan') . "';</SCRIPT>";
        } else {
            print "<SCRIPT LANGUAGE='JavaScript'>window.alert('ไม่สำเร็จ');window.location.href='" . base_url('index.php/plan') . "';</SCRIPT>";
        }
    }
    
     // edit data
    public function edit() {
        $id = $_POST['id'];
        $rs = $this->My_model->get_where_row("tb_parcel_plan", array("id" => $id));
        echo json_encode($rs);
    }
    
    

    public function delete() {
        $id = $this->input->post('id');
        $status = $this->Plan_model->delete($id);
        if ($status == 1) {
            print "<SCRIPT LANGUAGE='JavaScript'>window.alert('ลบข้อมูลสำเร็จ');window.location.href='" . base_url('index.php/plan') . "';</SCRIPT>";
        } else {
            print "<SCRIPT LANGUAGE='JavaScript'>window.alert('ลบข้อมูลไม่สำเร็จ');window.location.href='" . base_url('index.php/plan') . "';</SCRIPT>";
        }
    }

}

/* End of file Plan.php */
/* Location: .//C/Users/supun/Desktop/controller/Plan.php */
