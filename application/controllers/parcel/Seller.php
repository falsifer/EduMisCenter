<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Seller extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        if ($this->session->userdata('status') == "") {
            redirect("/");
        }
        $this->load->model("parcel/Seller_model");
    }

        public function index()
    {
        $data['title'] = "โปรแกรมบริหารจัดการสารสนเทศทางการศึกษา eSchool 1.0";
        $data['seller'] = $this->Seller_model->get();
//        $this->load->view('parcel/inc/header',$data);
//        $this->load->view('parcel/seller');
//        $this->load->view('parcel/inc/footer');
        load_view($this, 'parcel/seller', $data);
    }
    public function procress()
    {
        $user37=$this->Seller_model->year_parcel();
		$year_parcel37=$user37['year_parcel'];
		$status=$this->Seller_model->insert_update($year_parcel37);
		if($status == 1){
			print "<SCRIPT LANGUAGE='JavaScript'>window.alert('สำเร็จ');window.location.href='".base_url('index.php/seller')."';</SCRIPT>";
		}else{
			print "<SCRIPT LANGUAGE='JavaScript'>window.alert('ไม่สำเร็จ');window.location.href='".base_url('index.php/seller')."';</SCRIPT>";
		}
    }
    public function delete(){
    	$id = $this->input->get('id');
    	$status=$this->Seller_model->delete($id);
		if($status == 1){
			print "<SCRIPT LANGUAGE='JavaScript'>window.alert('ลบข้อมูลสำเร็จ');window.location.href='".base_url('index.php/seller')."';</SCRIPT>";
		}else{
			print "<SCRIPT LANGUAGE='JavaScript'>window.alert('ลบข้อมูลไม่สำเร็จ');window.location.href='".base_url('index.php/seller')."';</SCRIPT>";
		}
    }

}

/* End of file Seller.php */
/* Location: .//C/Users/supun/Desktop/controller/Seller.php */