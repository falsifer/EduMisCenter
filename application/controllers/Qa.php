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

class Qa extends CI_Controller {

    public function __construct() {
        parent::__construct();
        if ($this->session->userdata('status') == "") {
            redirect("/");
        }
        $this->load->model('QA_model');
    }

    /*
     * To change this license header, choose License Headers in Project Properties.
     * To change this template file, choose Tools | Templates
     * and open the template in the editor.
     */

// ประชาสัมพันธ์
    public function qa_base() {

        $data['rs'] = $this->My_model->get_all_order('qa_standard_master', 'id ASC');

        $this->load->view("layout/header");
        $this->load->view("qa/qa_base", $data);
        $this->load->view("layout/footer");
    }

    public function qa_insert_view() {
        $this->load->view("layout/header");
        $this->load->view("qa/qa_insert_view");
        $this->load->view("layout/footer");
    }

    public function qa_insert_sub_view() {
        $data['rs'] = $this->My_model->get_all_order('qa_standards', 'QAStandardMaster_id ASC');
        $data['rt'] = $this->My_model->get_all_order('qa_standard_master', 'id ASC');
        $this->load->view("layout/header");
        $this->load->view("qa/qa_insert_sub_view", $data);
        $this->load->view("layout/footer");
    }

    public function Qa_insert_issue_view() {
        $data['rs'] = $this->My_model->get_all_order('qa_issue', 'QaStandards_id ASC');
        $data['rt'] = $this->My_model->get_all_order('qa_standards', 'QAStandardMaster_id ASC');
        $data['ru'] = $this->My_model->get_all_order('qa_standard_master', 'id ASC');

        $this->load->view("layout/header");
        $this->load->view("qa/qa_insert_issue_view", $data);
        $this->load->view("layout/footer");
    }

    //----- Code Delete ------//
    public function er_delete() {
        $id = $_POST['id'];
        $this->My_model->delete_data('tb_edu_research', array('id' => $id));
    }

    //----- End Code Delete ------//
//--- Code Insert ---//
    public function qa_insert() {

        $arr = array(
            "QAStandardMasterTitle" => $this->input->post('inQAStandardMasterTitle')
        );
        $this->My_model->insert_data('qa_standard_master', $arr);
        $id = $this->db->insert_id();
    }

    public function qa_insert_sub() {

        $arr = array(
            "QAStandardMaster_id" => $this->input->post('inQAStandardMasterId'),
            "QAStandardsTitle" => $this->input->post('inQAStandardsTitle'),
            "QAStandardsTitleDesc" => $this->input->post('inQAStandardsTitleDesc'),
        );
        $this->My_model->insert_data('qa_standards', $arr);
        $id = $this->db->insert_id();
    }

    public function qa_insert_issue() {

        $arr = array(
            "QAStandardMaster_id" => $this->input->post('inQAStandardMasterId'),
            "QaStandards_id" => $this->input->post('inQaStandardsId'),
            "QAIssueDetail" => $this->input->post('inQAIssueDetail')
        );
        $this->My_model->insert_data('qa_issue', $arr);
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
    public function qa_edit() {
        $id = $_POST['id'];
        $rs = $this->My_model->get_where_row("qa_standard_master", array("id" => $id));
        echo json_encode($rs);
    }

    //----- End Code Edit ------//
    //
    //
    //--- Code Update ---//
    public function qa_update() {

        $id = $_POST['id'];

        $arr = array(
            "QAStandardMasterTitle" => $this->input->post('inQAStandardMasterTitle')
        );
        if ($id != "") {
            $this->My_model->update_data('qa_standard_master', array('id' => $id), $arr);
        }
    }

    //--- End Code update ---//


    public function get_qa_by_school() {
        $out = "";
        $school = $this->input->post('school');
//        $std = $this->input->post('std');
        $out .= "<center><h3>รายงานการประกันคุณภาพในสถานศึกษา ".$school."</h3></center><hr/>";
        $stdRs = $this->My_model->get_where_order('tb_qa_standard', array('tb_qa_standard_type' => 'ขั้นพื้นฐาน'), 'tb_qa_standard_number');
        foreach ($stdRs as $stdr) {


            $out .= "<table class=\"table table-hover table-striped table-bordered display\" id=\"example" . $stdr['id'] . "\">
                        <thead>
                            <tr>
                                <th style=\"width:40px;\" class=\"no-sort\">ที่</th>
                                <th class=\"no-sort\">ประเด็นการพิจารณา</th>
                                <th class=\"no-sort\">ค่าเป้าหมายที่สถานศึกษากำหนด</th>
                                <th class=\"no-sort\">ผลลัพท์ที่สถานศึกษาได้</th>
                                <th class=\"no-sort\">ระดับคุณภาพ</th>
                            </tr>
                        </thead>";


            $out .= "<h3>มาตรฐานที่ " . $stdr['tb_qa_standard_number'] . ' ' . $stdr['tb_qa_standard_detail'] . "</h3>";


            $row = 1;
            $rs = $this->My_model->get_where_order('tb_qa_standard_detail', array('tb_qa_standard_id' => $stdr['id']), 'tb_qa_standard_detail_number');


            foreach ($rs as $scr) {
                $out .= "              
                                <tr style=\"font-weight:bold;\">
                                    <td>" . $row . "</td>
                                    <td>" . $scr['tb_qa_standard_detail'] . "</td>
                                    <td style=\"text-align: center\">
                                        &nbsp;
                                    </td>
                                    <td>
                                        &nbsp;
                                    </td>
                                    <td>
                                        &nbsp;
                                    </td>
                                </tr>
                           ";
                $this->db->select("*,a.id as qaId");
                $this->db->from('tb_qa_plan_kpi a');
                $this->db->join('tb_qa_plan b', 'a.tb_qa_plan_id=b.id');
                $this->db->where(array('tb_qa_plan_department' => $school));
                $this->db->where(array('tb_qa_standard_detail_id' => $scr['id'], 'tb_qa_plan_year' => get_edyear()));
                $this->db->order_by('tb_qa_plan_kpi_activity');
                $query = $this->db->get();
                if (isset($query)) {
                    $rest = $query->result_array();
                }
                foreach ($rest as $rs2) {
                    $out .= "       
                                    <tr>
                                        <td>&nbsp;</td>
                                        <td>" . $rs2['tb_qa_plan_kpi_activity'] . "</td>
                                        <td style=\"text-align: center\">";
                    if (isset($rs2['id'])) {
                        if ($rs2['tb_qa_plan_kpi_score_type'] == "ร้อยละ") {
                            $out .= $rs2['tb_qa_plan_kpi_score_type'];
                        }
                        $out .= " ";

                        $out .= $rs2['tb_qa_plan_kpi_target'];
                    }

                    $out .= "</td>";
                    if (isset($rs2['tb_qa_plan_kpi_score'])) {




                        $out .= "<td style=\"text-align:center;\">";
                        if ($rs2['tb_qa_plan_kpi_score_type'] == "ร้อยละ") {
                            $out .= $rs2['tb_qa_plan_kpi_score_type'];
                        }
                        $out .= " " . $rs2['tb_qa_plan_kpi_score'] . " </td>";


                        $color = "black";

                        switch ($rs2['tb_qa_plan_kpi_rank']) {
                            case "กำลังพัฒนา":
                                $color = "red";
                                break;
                            case "ปานกลาง":
                                $color = "orange";
                                break;
                            case "ดี":
                                $color = "#8ede0d";
                                break;
                            case "ดีเลิศ":
                                $color = "#7ec904";
                                break;
                            case "ยอดเยี่ยม":
                                $color = "green";
                                break;
                        }

                        $out .= "<td style=\"text-align:center;color:" . $color . "\"><i class='icon-dashboard'></i> " . $rs2['tb_qa_plan_kpi_rank'] . "</td>";
                    } else {
                        $out .= "<td style=\"text-align:center;\"><input type=\"number\" name=\"inTbQAPlanKPIScore" . $rs2['qaId'] . "\"  id=\"" . $rs2['qaId'] . "\" onfocus=\"MyCursorNow(this)\" onkeyup=\"InsertScore(this," . $rs2['tb_qa_plan_kpi_target'] . ")\" class=\"form-control\" autofocus/></td>";
                        $out .= "<td>&nbsp;</td>";
                    }

                    $out .= "</tr>";
                }
                $row++;
            }
        }

        echo $out;
    }

    public function qa_report_zone() {

//        $data['misTools'] = $this->My_model->get_where_order('tb_data_define', array('data_define_type' => 'Report'), 'data_name');
        $data['stdRs'] = $this->My_model->get_where_order('tb_qa_standard', array('tb_qa_standard_type' => 'ขั้นพื้นฐาน'), 'tb_qa_standard_number');
//        $data['schRs'] = $this->My_model->get_where_order('tb_schoool',array('sc_localgov'=>$this->session->userdata('localgov')),'sc_thai_name');
        $data['schRs'] = $this->My_model->get_where_order('tb_school','school_type_id!=0', 'sc_thai_name');
//        $data['stdPlan'] = $this->My_model->join2table_where_result('tb_qa_plan a', 'tb_qa_plan_kpi b', 'a.id=b.tb_qa_plan_id', array('tb_qa_plan_department' => $this->session->userdata('department')), 'b.id');

        $data['qaRank'] = $this->My_model->get_all_order('tb_qa_rank', 'tb_qa_rank_score');

        $this->load->view("layout/header");
        $this->load->view("vichakarn/qa_zone", $data);
        $this->load->view('layout/footer');
    }

    public function qa_report() {

        $data['misTools'] = $this->My_model->get_where_order('tb_data_define', array('data_define_type' => 'Report'), 'data_name');
        $data['stdRs'] = $this->My_model->get_where_order('tb_qa_standard', array('tb_qa_standard_type' => 'ขั้นพื้นฐาน'), 'tb_qa_standard_number');
//        $data['schRs'] = $this->My_model->get_where_order('tb_schoool',array('sc_localgov'=>$this->session->userdata('localgov')),'sc_thai_name');
        $data['schRs'] = $this->My_model->get_all_order('tb_school', 'sc_thai_name');
        $data['stdPlan'] = $this->My_model->join2table_where_result('tb_qa_plan a', 'tb_qa_plan_kpi b', 'a.id=b.tb_qa_plan_id', array('tb_qa_plan_department' => $this->session->userdata('department')), 'b.id');
        $data['qaRank'] = $this->My_model->get_all_order('tb_qa_rank', 'tb_qa_rank_score');

        $this->load->view("layout/header");
        $this->load->view("vichakarn/qa", $data);
        $this->load->view('layout/footer');
    }

    public function qa_report2() {
        $this->load->view("layout/header");
//        $this->load->view("vichakarn/qa", $data);
        $this->load->view('layout/footer');
    }

    public function qa_plan_add() {

        $tools = $this->input->post('tools');
        $toolsTxt = "";
        $toolsId = "";

        if (isset($tools)) {
            $this->db->select('data_name,id');
            $this->db->from('tb_data_define');
            $this->db->where_in('id', $tools);
            $qq = $this->db->get();
            $row = $qq->result_array();
            foreach ($row as $r) {
                $toolsTxt .= $r['data_name'] . ",";
                $toolsId .= $r['id'] . ",";
            }

            if (in_array("-1", $tools)) {
                if ($this->input->post('inTools') != null) {
                    $toolsTxt .= $this->input->post('inTools');
                }
            }
        }



        $arr = array(
            'tb_qa_plan_year' => get_edyear(),
            'tb_qa_plan_recorder' => $this->session->userdata('name'),
            'tb_qa_plan_department' => $this->session->userdata('department'),
            'tb_qa_plan_createdate' => date('Y-m-d')
        );


        $plans = $this->My_model->get_where_row('tb_qa_plan', array('tb_qa_plan_year' => get_edyear(),'tb_qa_plan_department' => $this->session->userdata('department')));

        if (isset($plans['id'])) {
            $planid = $plans['id'];
        } else {
            $planid = $this->My_model->insert_data('tb_qa_plan', $arr);
        }

        if ($planid != null || $planid != '') {
            $arrP = array(
                'tb_qa_plan_id' => $planid,
                'tb_qa_standard_detail_id' => $this->input->post('inQAStandardDetailId'),
                'tb_qa_plan_kpi_activity' => $this->input->post('inQAPlanActivity'),
                'tb_qa_plan_kpi_target' => $this->input->post('inQAPlanTarget'),
                'tb_qa_plan_kpi_score_type' => $this->input->post('inQAPlanScoreType'),
                'tb_qa_plan_kpi_target_base' => $this->input->post('inQAPlanTargetBase'),
                'tb_qa_plan_kpi_tools' => $toolsTxt,
                'tb_qa_plan_kpi_tools_id' => $toolsId,
                'tb_qa_plan_kpi_recorder' => $this->session->userdata('name'),
                'tb_qa_plan_kpi_department' => $this->session->userdata('department'),
                'tb_school_id' => $this->session->userdata('sch_id'),
                'tb_qa_plan_kpi_updatedate' => date('Y-m-d')
            );
            $id = $this->input->post('id');

            if (isset($id) && ($id != '')) {
                $this->My_model->update_data('tb_qa_plan_kpi', array('id' => $id), $arrP);
            } else {
                $this->My_model->insert_data('tb_qa_plan_kpi', $arrP);
            }
        }
    }

    public function qa_plan_delete() {
        $id = $this->input->post('id');
        $this->My_model->delete_data('tb_qa_plan_kpi', array('id' => $id));
    }

    public function qa_plan_edit() {
        $id = $this->input->post('id');
        $rs = $this->My_model->get_where_row('tb_qa_plan_kpi', array('id' => $id));
        echo json_encode($rs);
    }

    public function insert_score() {
        $qaId = $this->input->post('qaId');
        $score = $this->input->post('score');

        $qaRank = $this->input->post('qaRank');



        $arrP = array(
            'tb_qa_plan_kpi_score' => $score,
            'tb_qa_plan_kpi_rank' => $qaRank,
            'tb_qa_plan_kpi_recorder' => $this->session->userdata('name'),
            'tb_qa_plan_kpi_department' => $this->session->userdata('department'),
            'tb_school_id' => $this->session->userdata('sch_id'),
            'tb_qa_plan_kpi_updatedate' => date('Y-m-d')
        );
        if (isset($qaId) && isset($score) && ($qaId != '') && ($score != '')) {
            $this->My_model->update_data('tb_qa_plan_kpi', array('id' => $qaId), $arrP);
        }
    }

    public function insert_rank() {
        $qaId = $this->input->post('qaId');
        $qaRank = $this->input->post('qaRank');

        $arrP = array(
            'tb_qa_plan_kpi_rank' => $qaRank,
            'tb_qa_plan_kpi_recorder' => $this->session->userdata('name'),
            'tb_qa_plan_kpi_department' => $this->session->userdata('department'),
            'tb_school_id' => $this->session->userdata('sch_id'),
            'tb_qa_plan_kpi_updatedate' => date('Y-m-d')
        );
        if (isset($qaId) && isset($qaRank) && ($qaId != '') && ($qaRank != '')) {
            $this->My_model->update_data('tb_qa_plan_kpi', array('id' => $qaId), $arrP);
        }
    }

    public function attachment_insert() {

        $id = $this->input->post('inTbQAPlanKpiID');

        if ($_FILES['inTbQAPlanKpiAttachment']['name'] != "") {
            $config = array(
                "upload_path" => qa_path(),
                "allowed_types" => "*",
                "max_size" => 0,
                "file_name" => md5(date("YmdHis"))
            );
            $this->upload->initialize($config);
            $chk = $this->upload->do_upload("inTbQAPlanKpiAttachment");

            $data = $this->upload->data();

            $filename = $data['file_name'];
            $path = qa_path();
        }
        if ($chk) {
            $this->My_model->update_data('tb_qa_plan_kpi', array('id' => $id), array('tb_qa_plan_kpi_attachment' => $filename));
        }
        echo ($_FILES['inTbQAPlanKpiAttachment']['name']);
    }

}
