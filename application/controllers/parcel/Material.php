<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Material extends CI_Controller {

	public function index()
	{
		$data['title'] = "โปรแกรมบริหารจัดการสารสนเทศทางการศึกษา eSchool 1.0";
		$this->load->view('parcel/inc/header',$data);
		$this->load->view('parcel/material');
		$this->load->view('parcel/inc/footer');

	}
	public function delete(){
		$id = $this->input->get('id');
		$category_id = $this->input->get('category_id');
		$sql = "DELETE FROM tb_parcel_product WHERE id='$id' AND category_id = '$category_id'";
		$status = $this->db->query($sql);
                if($status){
			print "<SCRIPT LANGUAGE='JavaScript'>window.alert('ลบข้อมูลสำเร็จ');window.location.href='".base_url('index.php/material?id='.$category_id)."';</SCRIPT>";
		}else{
			print "<SCRIPT LANGUAGE='JavaScript'>window.alert('ลบข้อมูลไม่สำเร็จ');window.location.href='".base_url('index.php/material?id='.$category_id)."';</SCRIPT>";
		}

	}
        
        

}

/* End of file Material.php */
/* Location: .//C/Users/supun/Desktop/controller/Material.php */