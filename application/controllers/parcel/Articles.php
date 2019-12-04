<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Articles extends CI_Controller {

    public function __construct() {
        parent::__construct();
        if ($this->session->userdata('status') == "") {
            redirect("/");
        }
        $this->load->model("parcel/Parcel_model");
    }
    public function index() {
        $data['title'] = "โปรแกรมบริหารจัดการสารสนเทศทางการศึกษา eSchool 1.0";
        $data['name_cat'] = $this->My_model->get_where_order('tb_parcel_category','type_category = 2','name_cat');
//        $this->load->view('parcel/inc/header', $data);
//        $this->load->view('parcel/articles');
//        $this->load->view('parcel/inc/footer');
        load_view($this, 'parcel/articles', $data);
    }

    public function delete() {
        $id = $this->input->get('id');
        $category_id = $this->input->get('category_id');
        $sql = "DELETE FROM tb_parcel_product WHERE id='$id' AND category_id = '$category_id'";
        $status = $this->db->query($sql);
        if ($status) {
            print "<SCRIPT LANGUAGE='JavaScript'>window.alert('ลบข้อมูลสำเร็จ');window.location.href='" . base_url('index.php/articles?id=' . $category_id) . "';</SCRIPT>";
        } else {
            print "<SCRIPT LANGUAGE='JavaScript'>window.alert('ลบข้อมูลไม่สำเร็จ');window.location.href='" . base_url('index.php/articles?id=' . $category_id) . "';</SCRIPT>";
        }
    }

    public function depreciate_base() {

        $data['depre'] = $this->Parcel_model->get_depreciation_list();
        $data['name_cat'] = $this->My_model->get_where_order('tb_parcel_category','type_category = 2','name_cat');
//        $this->load->view('parcel/inc/header', $data);
//        $this->load->view('parcel/depreciation');
//        $this->load->view('parcel/inc/footer');
        
        load_view($this, 'parcel/depreciation', $data);
        
    }
    public function insert_depreciation(){
        $id = $this->input->post('id');
        $arr = array(
            'tb_parcel_category_id'=> $this->input->post('inParcelCategory'),
            'tb_parcel_depreciate_age'=>$this->input->post('inDepreciateAge'),
            'tb_parcel_depreciate_value'=>$this->input->post('inDepreciateValue'),
            'tb_parcel_depreciate_recorder'=>$this->session->userdata('name'),
            
        );
        
        if($id!=null && $id != ""){
            $this->My_model->update_data('tb_parcel_depreciate',array('id'=>$id),$arr);
        }else{
           $this->My_model->insert_data('tb_parcel_depreciate',$arr); 
        }
    }
    
    public function edit_depreciation(){
        $id = $this->input->post('id');
        $rs = $this->My_model->get_where_row('tb_parcel_depreciate',array('id'=>$id));
        echo json_encode($rs);
    }
    
    public function delete_depreciation(){
        $id = $this->input->post('id');
        
        if($id!=null && $id != ""){
            $this->My_model->delete_data('tb_parcel_depreciate',array('id'=>$id));
        }
    }
    
    public function insert_category(){
        $id = $this->input->post('id');
        $arr = array(
            'name_cat'=> $this->input->post('inNameCat'),
            'type_category'=>'2',
            
        );
        
        if($id!=null && $id != ""){
            $this->My_model->update_data('tb_parcel_category',array('id'=>$id),$arr);
        }else{
           $this->My_model->insert_data('tb_parcel_category',$arr); 
        }
    }
    
    public function edit_category(){
        $id = $this->input->post('id');
        $rs = $this->My_model->get_where_row('tb_parcel_category',array('id'=>$id));
        echo json_encode($rs);
    }
    
    public function delete_category(){
        $id = $this->input->post('id');
        
        if($id!=null && $id != ""){
            $this->My_model->delete_data('tb_parcel_category',array('id'=>$id));
        }
    }

}
