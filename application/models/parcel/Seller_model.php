<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Seller_model extends CI_Model {
	public function __construct()
	{
		$this->load->database();
	}
	public function get()
	{
		$sql = "SELECT * FROM tb_parcel_seller where tb_parcel_seller_department='".$this->session->userdata('department')."'";
		$query = $this->db->query($sql);
		return $query->result_array();
	}
	public function year_parcel(){
		$sql = "SELECT * FROM tb_parcel";
		$query = $this->db->query($sql);
		return $query->row_array();
	}
	public function insert_update($year_parcel37)
	{
		$get_id=$this->input->post('get_id');
		$name_seller=$this->input->post('name_seller');
		$address_seller=$this->input->post('address_seller');
		$amphur_seller=$this->input->post('amphur_seller');
		$province_seller=$this->input->post('province_seller');
		$phone_seller=$this->input->post('phone_seller');
		$id_card=$this->input->post('id_card');
		$bank_seller=$this->input->post('bank_seller');
		$name_bank_seller=$this->input->post('name_bank_seller');
		$bank=$this->input->post('bank');
		$name_manager=$this->input->post('name_manager');
		$type_seller=$this->input->post('type_seller');
                $dept=$this->session->userdata('department');
                $schid=$this->session->userdata('sch_id');
		if($get_id == ''){
			$sql = "INSERT INTO tb_parcel_seller (name_seller,address_seller,amphur_seller,province_seller,phone_seller,id_card,bank_seller,name_bank_seller,bank,name_manager,type_seller,year_parcel,tb_parcel_seller_department,tb_school_id) value ('$name_seller','$address_seller','$amphur_seller','$province_seller','$phone_seller','$id_card','$bank_seller','$name_bank_seller','$bank','$name_manager','$type_seller','$year_parcel37','$dept','$schid')";
			$status = $this->db->query($sql);
		}else{
			$sql = "UPDATE tb_parcel_seller set name_seller='$name_seller',address_seller='$address_seller',amphur_seller='$amphur_seller',province_seller='$province_seller',phone_seller='$phone_seller',id_card='$id_card',bank_seller='$bank_seller',name_bank_seller='$name_bank_seller',bank='$bank',name_manager='$name_manager',type_seller='$type_seller',tb_parcel_seller_department='$dept',tb_school_id='$schid' where id='$get_id'";
			$status = $this->db->query($sql);
		}
		if($status){
			return true;
		}
		else{
			return false;
		}
	}
	public function delete($id){
		$sql = "DELETE FROM tb_parcel_seller WHERE id='$id'";
		$status = $this->db->query($sql);
		if($status){
			return true;
		}
		else{
			return false;
		}
	}
	

}

/* End of file Seller_model.php */
/* Location: .//C/Users/COM-BIG-BEN/AppData/Local/Temp/fz3temp-2/Seller_model.php */