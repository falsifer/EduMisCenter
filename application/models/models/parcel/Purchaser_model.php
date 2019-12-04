<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Purchaser_model extends CI_Model {
	public function __construct()
	{
		$this->load->database();
	}
	public function get()
	{
		$sql = "SELECT * FROM tb_parcel_purchaser";
		$query = $this->db->query($sql);
		return $query->row_array();
	}
	public function get_save2()
	{
		$sql = "SELECT * FROM tb_parcel";
		$query = $this->db->query($sql);
		return $query->row_array();
	}
	public function insert($year_parcel37)
	{
		$pre_name=$this->input->post('pre_name');
		$name_dircetor=$this->input->post('name_dircetor');
		$name_de_dirce=$this->input->post('name_de_dirce');
		$position_pur=$this->input->post('position_pur');
		$name_author=$this->input->post('name_author');
		$name_head_author=$this->input->post('name_head_author');
		$name_head_parcel=$this->input->post('name_head_parcel');
		$name_head_finance=$this->input->post('name_head_finance');
		$code_parcel=$this->input->post('code_parcel');
		$school=$this->input->post('school');
		$affiliation=$this->input->post('affiliation');
		$sql = "INSERT INTO tb_parcel_purchaser (pre_name,name_dircetor,name_de_dirce,position_pur,name_author,name_head_author,name_head_parcel,name_head_finance,code_parcel,school,affiliation,year_parcel) VALUE ('$pre_name','$name_dircetor','$name_de_dirce','$position_pur','$name_author','$name_head_author','$name_head_parcel','$name_head_finance','$code_parcel','$school','$affiliation','$year_parcel37')";
		$status = $this->db->query($sql);
		if($status){
			return true;
		}
		else{
			return false;
		}
	}
	public function update($year_parcel37)
	{
		$get_id=$this->input->post('get_id');
		$pre_name=$this->input->post('pre_name');
		$name_dircetor=$this->input->post('name_dircetor');
		$name_de_dirce=$this->input->post('name_de_dirce');
		$position_pur=$this->input->post('position_pur');
		$name_author=$this->input->post('name_author');
		$name_head_author=$this->input->post('name_head_author');
		$name_head_parcel=$this->input->post('name_head_parcel');
		$name_head_finance=$this->input->post('name_head_finance');
		$code_parcel=$this->input->post('code_parcel');
		$school=$this->input->post('school');
		$affiliation=$this->input->post('affiliation');
		$sql = "UPDATE tb_parcel_purchaser SET pre_name='$pre_name',name_dircetor='$name_dircetor',name_de_dirce='$name_de_dirce',position_pur='$position_pur',name_author='$name_author',name_head_author='$name_head_author',name_head_parcel='$name_head_parcel',name_head_finance='$name_head_finance',code_parcel='$code_parcel',school='$school',affiliation='$affiliation',year_parcel='$year_parcel37' WHERE id = '$get_id'";
		$status = $this->db->query($sql);
		if($status){
			return true;
		}
		else{
			return false;
		}
	}
	

}

/* End of file Purchaser_model.php */
/* Location: .//C/Users/COM-BIG-BEN/AppData/Local/Temp/fz3temp-2/Purchaser_model.php */