<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Committee extends CI_Controller {

    public function index()
    {
        $data['title'] = "โปรแกรมบริหารจัดการสารสนเทศทางการศึกษา eSchool 1.0";
        $data['committee'] = $this->committee_model->get();
        $this->load->view('parcel/inc/header',$data);
        $this->load->view('parcel/committee');
        $this->load->view('parcel/inc/footer');
    }
    public function procress()
    {
        $user37=$this->committee_model->year_parcel();
		$year_parcel37=$user37['year_parcel'];
		$status=$this->committee_model->insert_update($year_parcel37);
		if($status == 1){
			print "<SCRIPT LANGUAGE='JavaScript'>window.alert('สำเร็จ');window.location.href='".base_url('index.php/committee')."';</SCRIPT>";
		}else{
			print "<SCRIPT LANGUAGE='JavaScript'>window.alert('ไม่สำเร็จ');window.location.href='".base_url('index.php/committee')."';</SCRIPT>";
		}
    }
    public function delete_committee(){
    	$id = $this->input->get('id');
    	$status=$this->committee_model->delete($id);
		if($status == 1){
			print "<SCRIPT LANGUAGE='JavaScript'>window.alert('ลบข้อมูลสำเร็จ');window.location.href='".base_url('index.php/committee')."';</SCRIPT>";
		}else{
			print "<SCRIPT LANGUAGE='JavaScript'>window.alert('ลบข้อมูลไม่สำเร็จ');window.location.href='".base_url('index.php/committee')."';</SCRIPT>";
		}
    }

}

/* End of file Committee.php */
/* Location: .//C/Users/supun/Desktop/controller/Committee.php */