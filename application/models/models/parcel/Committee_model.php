<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Committee_model extends CI_Model {

	public function __construct()
	{
		$this->load->database();
	}
	public function get()
	{
		$sql = "SELECT * FROM tb_parcel_commit";
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
		$name_com=$this->input->post('name_com');
		$last_com=$this->input->post('last_com');
		$position_com=$this->input->post('position_com');
		if($get_id == ''){
			$sql = "INSERT INTO tb_parcel_commit (name_com,last_com,position_com,year_parcel) VALUE ('$name_com','$last_com','$position_com','$year_parcel37')";
			$status = $this->db->query($sql);
		}else{
			$sql = "UPDATE tb_parcel_commit SET name_com='$name_com',last_com='$last_com',position_com='$position_com'WHERE id='$get_id'";
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
		$sql = "DELETE FROM tb_parcel_commit WHERE id='$id'";
		$status = $this->db->query($sql);
		if($status){
			return true;
		}
		else{
			return false;
		}
	}
}

/* End of file Committee_model.php */
/* Location: .//C/Users/COM-BIG-BEN/AppData/Local/Temp/fz3temp-2/Committee_model.php */