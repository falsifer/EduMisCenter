<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Department extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model("parcel/Department_model");
    }
    public function index()
    {
        $data['title'] = "โปรแกรมบริหารจัดการสารสนเทศทางการศึกษา eSchool 1.0";
        $data['department'] = $this->Department_model->get();
        $this->load->view('parcel/inc/header',$data);
        $this->load->view('parcel/department');
        $this->load->view('parcel/inc/footer');
    }
    public function procress()
    {
        $user37=$this->Department_model->year_parcel();
		$year_parcel37=$user37['year_parcel'];
		$status=$this->Department_model->insert_update($year_parcel37);
		if($status == 1){
			print "<SCRIPT LANGUAGE='JavaScript'>window.alert('สำเร็จ');window.location.href='".base_url('index.php/department')."';</SCRIPT>";
		}else{
			print "<SCRIPT LANGUAGE='JavaScript'>window.alert('ไม่สำเร็จ');window.location.href='".base_url('index.php/department')."';</SCRIPT>";
		}
    }
    public function delete(){
    	$id = $this->input->get('id');
    	$status=$this->Department_model->delete($id);
		if($status == 1){
			print "<SCRIPT LANGUAGE='JavaScript'>window.alert('ลบข้อมูลสำเร็จ');window.location.href='".base_url('index.php/department')."';</SCRIPT>";
		}else{
			print "<SCRIPT LANGUAGE='JavaScript'>window.alert('ลบข้อมูลไม่สำเร็จ');window.location.href='".base_url('index.php/department')."';</SCRIPT>";
		}
    }

}

/* End of file Department.php */
/* Location: .//C/Users/supun/Desktop/controller/Department.php */