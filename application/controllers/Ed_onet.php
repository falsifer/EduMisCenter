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

class Ed_onet extends CI_Controller {

    public function __construct() {
        parent::__construct();
    }

    /*
     * To change this license header, choose License Headers in Project Properties.
     * To change this template file, choose Tools | Templates
     * and open the template in the editor.
     */

// ประชาสัมพันธ์
    public function ed_onet() {
       
        $data['rs'] = $this->My_model->get_all_order('tb_ed_onet', 'id ASC');

        $this->load->view("layout/header");
        $this->load->view("ed_onet/ed_onet_base", $data);
        $this->load->view("layout/footer");
    }

    public function ed_onet_insert_view() {
        $this->load->view("layout/header");
        $this->load->view("ed_onet/ed_onet_insert_view");
        $this->load->view("layout/footer");
    }

    //----- Code Delete ------//
    public function er_delete() {
        $id = $_POST['id'];
        $this->My_model->delete_data('tb_edu_research', array('id' => $id));
    }

    //----- End Code Delete ------//
//--- Code Insert ---//
    public function ed_onet_insert() {
        
        $arr = array(
            "tb_ed_onet_class" => $this->input->post('inTbEdOnetClass'),
            "tb_ed_onet_subj" => $this->input->post('inTbEdOnetSubj'),
            "tb_ed_onet_score" => $this->input->post('inTbEdOnetScore'),
            "tb_ed_onet_recoder" => $this->session->userdata('name'),
            "tb_ed_onet_department" => $this->session->userdata('department'),
            
        );
        $this->My_model->insert_data('tb_ed_onet', $arr);
        $id = $this->db->insert_id();
    }

    //--- end Code Insert ---//
    //--- Code Code Detail ---//
    public function er_detail() {
        $id = $_POST['id'];
        $row = $this->My_model->get_where_row("tb_edu_research", array("id" => $id));
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
                . "<td class='data-show'>{$row['er_name']}</td>"
                . "<tr>"
                . "<td class='data-title'>วิชา</td>"
                . "<td class='data-show'>{$row['er_subj']}</td>"
                . "</tr>"
                . "<tr>"
                . "<td class='data-title'>ภาคเรียนที่</td><td class='data-show'>{$row['er_term']}</td>"
                . "</tr>"
                . "</tr>"
                . "<tr>"
                . "<td class='data-title'>ปีการศึกษา</td><td class='data-show'>{$row['er_year']}</td>"
                . "</tr>"
                . "<tr>"
                . "<td class='data-title'>เจ้าของผลงาน</td><td class='data-show'>{$row['er_onw']}</td>"
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
    public function ed_onet_edit() {
        $id = $_POST['id'];
        $rs = $this->My_model->get_where_row("tb_ed_onet", array("id" => $id));
        echo json_encode($rs);
    }

    //----- End Code Edit ------//
    //
    //
    //--- Code Update ---//
    public function ed_onet_update() {

        $id = $_POST['id'];
        
        $arr = array(
            
            "tb_ed_onet_class" => $this->input->post('inTbEdOnetClass'),
            "tb_ed_onet_subj" => $this->input->post('inTbEdOnetSubj'),
            "tb_ed_onet_score" => $this->input->post('inTbEdOnetScore')
            
            
            
        );
        if ($id != "") {
            $this->My_model->update_data('tb_ed_onet', array('id' => $id), $arr);
        }
    }

    //--- End Code update ---//
}
