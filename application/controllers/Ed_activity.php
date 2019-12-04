<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/*
  | ============================================================================
  |  Title: Class Setting
  | ============================================================================
  | Copyright	Edutech Co.,Ltd.
  | Purpose     กำหนดค่าเร่ิมต้นของโปรแกรม
  | Author	นายบัณฑิต ไชยดี
  | Create Date  November 13, 2018
  | Last edit	-
  | Comment	-
  | ============================================================================
 */

class Ed_activity extends CI_Controller {

    public function __construct() {
        parent::__construct();
    }

    /*
     * To change this license header, choose License Headers in Project Properties.
     * To change this template file, choose Tools | Templates
     * and open the template in the editor.
     */

// ประชาสัมพันธ์
    public function ed_activity() {
       
        $data['rs'] = $this->My_model->get_all_order('tb_ed_activity', 'id ASC');
        
        $this->load->view("layout/header");
        $this->load->view("ed_activity/ed_activity_base", $data);
        $this->load->view("layout/footer");
    }

    public function ed_activity_insert_view() {
        $this->load->view("layout/header");
        $this->load->view("ed_activity/ed_activity_insert_view");
        $this->load->view("layout/footer");
    }
    
    public function ed_activity_insert_score_view() {
        $data['rs'] = $this->My_model->get_all_order('tb_ed_activity_score', 'tb_ed_activity_id ASC');
        $data['rt'] = $this->My_model->get_all_order('tb_ed_activity', 'tb_ed_activity_seq ASC');
        $data['ru'] = $this->My_model->get_all_order('tb_student_base', 'id ASC');
        $this->load->view("layout/header");
        $this->load->view("ed_activity/ed_activity_insert_score_view",$data);
        $this->load->view("layout/footer");
    }

    //----- Code Delete ------//
    public function er_delete() {
        $id = $_POST['id'];
        $this->My_model->delete_data('tb_edu_research', array('id' => $id));
    }

    //----- End Code Delete ------//
//--- Code Insert ---//
    public function ed_activity_insert() {
        
        $arr = array(
            "tb_ed_activity_seq" => $this->input->post('inTbEdActivitySeq'),
            "tb_ed_activity_content" => $this->input->post('inTbEdActivityContent'),
            "tb_ed_activity_recorder" => $this->session->userdata('name'),
            "tb_ed_activity_department" => $this->session->userdata('department')
            
        );
        $this->My_model->insert_data('tb_ed_activity', $arr);
        $id = $this->db->insert_id();
    }
    
    public function ed_activity_insert_score() {
        
        $arr = array(
            "tb_student_id" => $this->input->post('inTbStudentId'),
            "tb_ed_activity_id" => $this->input->post('inTbEdActivityId'),
            "tb_ed_activity_score_insert" => $this->input->post('inTbEdActivityScoreInsert'),
            "tb_ed_activity_score_recorder" => $this->session->userdata('name'),
            "tb_ed_activity_score_department" => $this->session->userdata('department')
            
            
        );
        $this->My_model->insert_data('tb_ed_activity_score', $arr);
        $id = $this->db->insert_id();
    }

    //--- end Code Insert ---//
    //--- Code Code Detail ---//
    public function ed_capacity_detail() {
        $id = $_POST['id'];
        $row = $this->My_model->get_where_row("tb_ed_capacity_sub", array("tb_ed_capacity_id" => $id));
        $outp = "<div class='container-fluid'>"
                . "<div class='row'>";
        //---- แสดงภาพประกอบ ----//
        //$outp .= "<table style='width:100%;'>";
        //$outp .= "<tr><td style='padding-top:20px;'>";
        //if (file_exists("upload/" . $row['bs_pic']) && !empty($row['bs_pic'])) {
            //$outp .= img(array('src' => "upload/" . $row['bs_pic'], "style" => "width:238px;height:221px;border:5px solid #C0C0C0;")) . nbs(5);
        //}
        //---- จบภาพประกอบ ----//
        //------ โชว์ข้อมูล ------//
        $outp .= "<table style='width:100%;'>"
                . "<tr>"
                . "<td class='data-title' style='width:20%;'>ชื่องานวิจัย</td>"
                . "<td class='data-show'>{$row['tb_ed_capacity_sub_content']}</td>"
                       
                . "</table>";
        $outp .= "</table>";
        //------ จบโชว์ข้อมูล ------//

        $outp .= "</td></tr>";
        $outp .= "</div></div>";
        echo $outp;
    }

    //--- End Code Detail ---//
    //
    //
    //----- Code Edit ------//
    public function ed_capacity_edit() {
        $id = $_POST['id'];
        $rs = $this->My_model->get_where_row("tb_ed_capacity", array("id" => $id));
        echo json_encode($rs);
    }

    //----- End Code Edit ------//
    //
    //
    //--- Code Update ---//
    public function ed_capacity_update() {

        $id = $_POST['id'];
        
        $arr = array(
            "tb_ed_capacity_content" => $this->input->post('inTbEdCapacityContent')
            
            
        );
        if ($id != "") {
            $this->My_model->update_data('tb_ed_capacity', array('id' => $id), $arr);
        }
    }

    //--- End Code update ---//
}
