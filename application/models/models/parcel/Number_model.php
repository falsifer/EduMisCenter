<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Number_model extends CI_Model {
	public function __construct()
	{
		$this->load->database();
	}
	public function get()
	{
		$sql = "SELECT * FROM tb_parcel_number";
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
		$order_num=$this->input->post('order_num');
		$employ_num=$this->input->post('employ_num');
		$receipt_order=$this->input->post('receipt_order');
		$receipt_employ=$this->input->post('receipt_employ');
		$bill_num=$this->input->post('bill_num');
		if($get_id == ''){
			$sql = "INSERT INTO tb_parcel_number (order_num,employ_num,receipt_order,receipt_employ,bill_num,year_parcel) value ('$order_num','$employ_num','$receipt_order','$receipt_employ','$bill_num','$year_parcel37')";
			$status = $this->db->query($sql);
		}else{
			$sql = "UPDATE tb_parcel_number set order_num='$order_num',employ_num='$employ_num',receipt_order='$receipt_order',receipt_employ='$receipt_employ',bill_num='$bill_num'where id='$get_id'";
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
		$sql = "DELETE FROM tb_parcel_number WHERE id='$id'";
		$status = $this->db->query($sql);
		if($status){
			return true;
		}
		else{
			return false;
		}
	}
	

}

/* End of file Number_model.php */
/* Location: .//C/Users/COM-BIG-BEN/AppData/Local/Temp/fz3temp-2/Number_model.php */