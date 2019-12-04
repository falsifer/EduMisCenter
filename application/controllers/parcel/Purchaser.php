<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Purchaser extends CI_Controller {

    public function __construct() {
        parent::__construct();
        if ($this->session->userdata('status') == "") {
            redirect("/");
        }
        $this->load->model("parcel/Purchaser_model");
    }
	public function index()
	{

		$data['title'] = "โปรแกรมบริหารจัดการสารสนเทศทางการศึกษา eSchool 1.0";
		$data['purchaser'] = $this->Purchaser_model->get();
		$this->load->view('parcel/inc/header',$data);
		$this->load->view('parcel/purchaser');
		$this->load->view('parcel/inc/footer');
	}
	public function save1(){
		
		$user37=$this->Purchaser_model->get_save2();
		$year_parcel37=$user37['year_parcel'];
		$insert=$this->Purchaser_model->insert($year_parcel37);
		if($insert == 1){
			print "<SCRIPT LANGUAGE='JavaScript'>window.alert('เพิ่มข้อมูลสำเร็จ');window.location.href='".base_url('index.php/purchaser')."';</SCRIPT>";
		}else{
			print "<SCRIPT LANGUAGE='JavaScript'>window.alert('เพิ่มข้อมูลไม่สำเร็จ');window.location.href='".base_url('index.php/purchaser')."';</SCRIPT>";
		}
	}
	public function save2(){
		
		$user37=$this->Purchaser_model->get_save2();
		$year_parcel37=$user37['year_parcel'];
		$update=$this->Purchaser_model->update($year_parcel37);
		if($update == 1){
			print "<SCRIPT LANGUAGE='JavaScript'>window.alert('แก้ไขข้อมูลสำเร็จ');window.location.href='".base_url('index.php/purchaser')."';</SCRIPT>";
		}else{
			print "<SCRIPT LANGUAGE='JavaScript'>window.alert('แก้ไขข้อมูลไม่สำเร็จ');window.location.href='".base_url('index.php/purchaser')."';</SCRIPT>";
		}
	}

}

/* End of file Purchaser.php */
/* Location: .//C/Users/supun/Desktop/controller/Purchaser.php */