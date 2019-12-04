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

class Ed_rw_analysis extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model("Exam_model");
    }

    /*
     * To change this license header, choose License Headers in Project Properties.
     * To change this template file, choose Tools | Templates
     * and open the template in the editor.
     */
    
    
    public function index(){
 
        $this->load->view("layout/header");
        $this->load->view("ed_rw_analysis/ed_rw_analysis_form");
        $this->load->view("layout/footer");
    }

// 
    public function ed_rw_analysis() {
       
        $data['rs'] = $this->My_model->get_all_order('tb_ed_rw_analysis', 'id ASC');

        $this->load->view("layout/header");
        $this->load->view("ed_rw_analysis/ed_rw_analysis_base", $data);
        $this->load->view("layout/footer");
    }

    public function ed_rw_analysis_insert_view() {
        $this->load->view("layout/header");
        $this->load->view("ed_rw_analysis/ed_rw_analysis_insert_view");
        $this->load->view("layout/footer");
    }
    
    public function ed_rw_analysis_insert_sub_view() {
        $data['rs'] = $this->My_model->get_all_order('tb_ed_rw_analysis_sub', 'tb_ed_rw_analysis_id ASC');
        $data['rt'] = $this->My_model->get_all_order('tb_ed_rw_analysis', 'tb_ed_rw_analysis_seq ASC');
        $this->load->view("layout/header");
        $this->load->view("ed_rw_analysis/ed_rw_analysis_insert_sub_view",$data);
        $this->load->view("layout/footer");
    }
    
    public function ed_rw_analysis_insert_score_view() {
        $data['rs'] = $this->My_model->get_all_order('tb_ed_rw_analysis_score', 'tb_ed_rw_analysis_sub_id ASC');
        $data['rt'] = $this->My_model->get_all_order('tb_ed_rw_analysis_sub', 'tb_ed_rw_analysis_id ASC');
        $data['ru'] = $this->My_model->get_all_order('tb_ed_rw_analysis', 'tb_ed_rw_analysis_seq ASC');
        $data['rv'] = $this->My_model->get_all_order('tb_student_base', 'id ASC');
        $data['rw'] = $this->My_model->get_all_order('tb_course', 'id ASC');
        $this->load->view("layout/header");
        $this->load->view("ed_rw_analysis/ed_rw_analysis_insert_score_view",$data);
        $this->load->view("layout/footer");
    }

    //----- Code Delete ------//
    public function er_delete() {
        $id = $_POST['id'];
        $this->My_model->delete_data('tb_edu_research', array('id' => $id));
    }

    //----- End Code Delete ------//
//--- Code Insert ---//
    public function ed_rw_analysis_insert() {
        
        $arr = array(
            "tb_ed_rw_analysis_seq" => $this->input->post('inTbEdRwAnalysisSeq'),
            "tb_ed_rw_analysis_content" => $this->input->post('inTbEdRwAnalysisContent'),
            "tb_ed_rw_analysis_recorder" => $this->session->userdata('name'),
            "tb_ed_rw_analysis_department" => $this->session->userdata('department')
            
        );
        $this->My_model->insert_data('tb_ed_rw_analysis', $arr);
        $id = $this->db->insert_id();
    }
    
    public function ed_rw_analysis_insert_sub() {
        
        $arr = array(
            "tb_ed_rw_analysis_id" => $this->input->post('inTbEdRwAnalysisId'),
            "tb_ed_rw_analysis_sub_content" => $this->input->post('inTbEdRwAnalysisSubContent')
            
            
        );
        $this->My_model->insert_data('tb_ed_rw_analysis_sub', $arr);
        $id = $this->db->insert_id();
    }
    
    public function ed_rw_analysis_insert_score() {
        
        $arr = array(
            "tb_student_id" => $this->input->post('inTbStudentId'),
            "tb_course_id" => $this->input->post('inTbCourseId'),
            "tb_ed_rw_analysis_sub_id" => $this->input->post('inTbEdRwAnalysisSubId'),
            "tb_ed_rw_analysis_sub_score" => $this->input->post('inTbEdRwAnalysisSubScore'),
            "tb_ed_rw_analysis_score_recorder" => $this->session->userdata('name'),
            "tb_ed_rw_analysis_score_department" => $this->session->userdata('department')
            
            
        );
        $this->My_model->insert_data('tb_ed_rw_analysis_score', $arr);
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
    public function ed_rw_analysis_edit() {
        $id = $_POST['id'];
        $rs = $this->My_model->get_where_row("tb_ed_rw_analysis", array("id" => $id));
        echo json_encode($rs);
    }

    //----- End Code Edit ------//
    //
    //
    //--- Code Update ---//
    public function ed_rw_analysis_update() {

        $id = $_POST['id'];
        
        $arr = array(
            "tb_ed_rw_analysis_content" => $this->input->post('inTbEdRwAnalysisContent')
            
            
        );
        if ($id != "") {
            $this->My_model->update_data('tb_ed_rw_analysis', array('id' => $id), $arr);
        }
    }

    //--- End Code update ---//
}
