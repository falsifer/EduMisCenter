<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/*
  | ============================================================================
  |  Title: Class Setting
  | ============================================================================
  | Copyright	Edutech Co.,Ltd.
  | Purpose     กำหนดค่าเร่ิมต้นของโปรแกรม
  | Author	
  | Create Date  
  | Last edit	-
  | Comment	-
  | ============================================================================
 */

class internal_control extends CI_Controller {

    public function __construct() {
        parent::__construct();
    }

    /*
     * To change this license header, choose License Headers in Project Properties.
     * To change this template file, choose Tools | Templates
     * and open the template in the editor.
     */

// ประชาสัมพันธ์
    public function internal_control_base() {
        $check = $this->session->userdata('department');
        $data['rs'] = $this->My_model->get_all_order('tb_internal_control', 'id ASC');
        $data['rt'] = $this->My_model->get_all_order('tb_division', 'tb_division_name ASC');
        $this->load->view("layout/header");
        $this->load->view("internal_control/internal_control_base", $data);
        $this->load->view("layout/footer");
    }

    public function internal_control_insert_view() {
        $data['rs'] = $this->My_model->get_all_order('tb_internal_control', 'id ASC');
        $data['rt'] = $this->My_model->get_all_order('tb_division', 'id ASC');
        $this->load->view("layout/header");
        $this->load->view("internal_control/internal_control_insert_view",$data);
        $this->load->view("layout/footer");
    }

    //----- Code Delete ------//
    public function internal_control_delete() {
        $id = $_POST['id'];
        $this->My_model->delete_data('tb_internal_control', array('id' => $id));
    }

    //----- End Code Delete ------//
//--- Code Insert ---//
    public function internal_control_insert() {
        
        $arr = array(
            
            "tb_division_name" => $this->input->post('inTbDivisionName'),
            "tb_internal_control_detail1" => $this->input->post('inTbInternalControlDetail1'),
            "tb_internal_control_detail2" => $this->input->post('inTbInternalControlDetail2'),
            "tb_internal_control_detail3" => $this->input->post('inTbInternalControlDetail3'),
            "tb_internal_control_detail4" => $this->input->post('inTbInternalControlDetail4'),
            "tb_internal_control_detail5" => $this->input->post('inTbInternalControlDetail5'),
            "tb_internal_control_detail6" => $this->input->post('inTbInternalControlDetail6'),
            
            "tb_internal_control_recorder" => $this->session->userdata('name'),
            "tb_internal_control_department" => $this->session->userdata('department')
            
        );
        $this->My_model->insert_data('tb_internal_control', $arr);
        $id = $this->db->insert_id();
    }

    //--- end Code Insert ---//
    //--- Code Code Detail ---//
    public function internal_control_detail() {
        $id = $_POST['id'];
        $row = $this->My_model->get_where_row("tb_internal_control", array("id" => $id));
        $outp = "<div class='container-fluid'>"
                . "<div class='row'>";
       
        //------ โชว์ข้อมูล ------//
        $outp .= "<table style='width:100%;'>"
                . "<tr>"
                . "<td class='data-title' style='width:20%;'>หน่วยงาน</td>"
                . "<td class='data-show'>{$row['tb_division_name']}</td>"
                . "<tr>"
                . "<td class='data-title'>กระบวนการปฏิบัติงาน/โครงการ/กิจกรรม/ด้านงานที่ประเมินและวัตถุประสงค์ของการควบคุม</td>"
                . "<td class='data-show'>{$row['tb_internal_control_detail1']}</td>"
                . "</tr>"
                . "<tr>"
                . "<td class='data-title'>ความเสี่ยงที่ยังมีอยู่</td>"
                . "<td class='data-show'>{$row['tb_internal_control_detail2']}</td>"
                . "</tr>"
                . "<tr>"
                . "<td class='data-title'>งวด/เวลาที่พบจุดอ่อน</td>"
                . "<td class='data-show'>{$row['tb_internal_control_detail3']}</td>"
                . "</tr>"
                . "<tr>"
                . "<td class='data-title'>การปรับปรุงการควบคุม</td>"
                . "<td class='data-show'>{$row['tb_internal_control_detail4']}</td>"
                . "</tr>"
                . "<tr>"
                . "<td class='data-title'>กำหนดเสร็จ/ผู้รับผิดชอบ</td>"
                . "<td class='data-show'>{$row['tb_internal_control_detail5']}</td>"
                . "</tr>"
                . "<tr>"
                . "<td class='data-title'>วิธีการติดตามและสรุปผลการประเมินผล/ข้อคิดเห็น</td>"
                . "<td class='data-show'>{$row['tb_internal_control_detail6']}</td>"
                . "</tr>"
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
    public function internal_control_edit() {
        $id = $_POST['id'];
        $rs = $this->My_model->get_where_row("tb_internal_control", array("id" => $id));
        echo json_encode($rs);
    }

    //----- End Code Edit ------//
    //
    //
    //--- Code Update ---//
    public function internal_control_update() {

        $id = $_POST['id'];
        
        $arr = array(
            
            "tb_division_name" => $this->input->post('inTbDivisionName'),
            "tb_internal_control_detail1" => $this->input->post('inTbInternalControlDetail1'),
            "tb_internal_control_detail2" => $this->input->post('inTbInternalControlDetail2'),
            "tb_internal_control_detail3" => $this->input->post('inTbInternalControlDetail3'),
            "tb_internal_control_detail4" => $this->input->post('inTbInternalControlDetail4'),
            "tb_internal_control_detail5" => $this->input->post('inTbInternalControlDetail5'),
            "tb_internal_control_detail6" => $this->input->post('inTbInternalControlDetail6')
            
        );
        if ($id != "") {
            $this->My_model->update_data('tb_internal_control', array('id' => $id), $arr);
        }
    }

    //--- End Code update ---//
}
