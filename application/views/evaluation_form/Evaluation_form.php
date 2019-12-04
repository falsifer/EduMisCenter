<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/*
  | ----------------------------------------------------------------------------
  |  Title
  | ----------------------------------------------------------------------------
  | Copyright	Edutech Co.,Ltd.
  | Purpose
  | Author
  | Create Date 22/11/2561
  | Last edit	22/11/2561
  | Comment	-
  | ----------------------------------------------------------------------------
 */

Class Evaluation_form extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model("Ev_model");
    }

    // index
    public function index() {
        
    }

//----------------ข้อมูลนักเรียน-------------------------------//
    //---------เรียก View---------//
    // กำหนดค่าเริ่มต้น : หน่วยนับ
    public function ev_base() {
        //$data["rs"] = $this->My_model->join2table_result('tb_human_resources_01 a', 'tb_ev_result b', 'b.hr_id = a.id', 'hr_thai_name ASC');
        //$data["rs"] = $this->Ev_model->get_ev();
        $this->db->select('*');
        $this->db->from('tb_human_resources_01 a');
        $this->db->join('tb_ev_result b','b.hr_id = a.id','left outer');
        $data["rs"] = $this->db->get();
        $this->load->view("layout/header");
        $this->load->view("evaluation_form/ev_base", $data);
        $this->load->view('layout/footer');
    }

    //เรียกหน้า
    public function ev_insert_view() {
        $data["rs"] = $this->My_model->get_all('tb_ev_base');
        $this->load->view("layout/header");
        $this->load->view("evaluation_form/ev_insert_view", $data);
        $this->load->view("layout/footer");
    }

    public function ev_form() {
        $data["rs"] = $this->My_model->get_all('tb_ev_base');
        $this->load->view("layout/header");
        $this->load->view("evaluation_form/ev_form", $data);
        $this->load->view("layout/footer");
    }


    public function ev_insert_name() {
               
        $arr = array(
            "ev_basename" => $this->input->post('inEvBasename'),
            "ev_subname1" => $this->input->post('inEvSubname1'),
            "ev_subname2" => $this->input->post('inEvSubname2'),
            "ev_subname3" => $this->input->post('inEvSubname3'),
            "ev_subname4" => $this->input->post('inEvSubname4'),
            "ev_subname5" => $this->input->post('inEvSubname5')
        );
        $this->My_model->insert_data('tb_ev_base', $arr);
        $id = $this->db->insert_id();
    }

    // km_delete
    public function ev_delete() {
        $id = $_POST['id'];
        $this->My_model->delete_data('tb_ev_base', array('id' => $id));
    }
    
//----------------จบ-------------------------------//
}
