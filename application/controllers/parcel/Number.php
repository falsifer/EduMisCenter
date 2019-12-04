<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Number extends CI_Controller {
     public function __construct() {
        parent::__construct();
        $this->load->model("parcel/Number_model");
    }


    public function index()
    {
        $data['title'] = "โปรแกรมบริหารจัดการสารสนเทศทางการศึกษา eSchool 1.0";
        $data['number'] = $this->Number_model->get();
        $this->load->view('parcel/inc/header',$data);
        $this->load->view('parcel/number');
        $this->load->view('parcel/inc/footer');
    }
     public function procress()
    {
        $user37=$this->Number_model->year_parcel();
		$year_parcel37=$user37['year_parcel'];
		$status=$this->Number_model->insert_update($year_parcel37);
		if($status == 1){
			print "<SCRIPT LANGUAGE='JavaScript'>window.alert('สำเร็จ');window.location.href='".base_url('index.php/number')."';</SCRIPT>";
		}else{
			print "<SCRIPT LANGUAGE='JavaScript'>window.alert('ไม่สำเร็จ');window.location.href='".base_url('index.php/number')."';</SCRIPT>";
		}
    }
    public function delete(){
    	$id = $this->input->get('id');
    	$status=$this->Number_model->delete($id);
		if($status == 1){
			print "<SCRIPT LANGUAGE='JavaScript'>window.alert('ลบข้อมูลสำเร็จ');window.location.href='".base_url('index.php/number')."';</SCRIPT>";
		}else{
			print "<SCRIPT LANGUAGE='JavaScript'>window.alert('ลบข้อมูลไม่สำเร็จ');window.location.href='".base_url('index.php/number')."';</SCRIPT>";
		}
    }

}

/* End of file Number.php */
/* Location: .//C/Users/supun/Desktop/controller/Number.php */