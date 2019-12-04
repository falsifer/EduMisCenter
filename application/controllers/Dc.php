<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/*
  | ----------------------------------------------------------------------------
  |  Title
  | ----------------------------------------------------------------------------
  | Copyright	Edutech Co.,Ltd.
  | Purpose
  | Author      Chairatto
  | Create Date 22/11/2561
  | Last edit	4/2/2562
  | Comment	-
  | ----------------------------------------------------------------------------
 */

Class Dc extends CI_Controller {

    public function __construct() {
        parent::__construct();
        if ($this->session->userdata('status') == "") {
            redirect("/");
        }
        $this->load->model("My_model");
        $this->load->model("Dcc_model");
        $this->load->model("Chairatto_model");
        $this->load->model("Ed_Classroom_model");
    }

    public function dc_base_setting() {
        // $data['row'] = $this->My_model->get_all_order("tb_group_learning", "tb_group_learning_seq asc");
        //$data['rscourse'] = $this->My_model->get_all_order("tb_course", "id asc");
        $data['rscourse'] = $this->Dcc_model->dc_base();
        $this->load->view("layout/header");
        $this->load->view("dc/dc_standard_score_base", $data);
        $this->load->view("layout/footer");
    }

    public function dc_base_setting_where() {
        $data['row'] = $this->My_model->get_all_order("tb_group_learning", "tb_group_learning_seq asc");
        //$data['rscourse'] = $this->My_model->get_all_order("tb_course", "id asc");
        $data['rscourse'] = $this->Dcc_model->dc_base();
        $this->load->view("layout/header");
        $this->load->view("dc/dc_standard_score_base", $data);
        $this->load->view("layout/footer");
    }

//----- ลวกๆ 
    public function dc_base() {
        $data['courseD'] = $this->Ed_Classroom_model->get_all_teacher_course();
        $data['course'] = $this->Ed_Classroom_model->get_all_course();
        $arr = array();

        foreach ($data['course'] as $c) {
            $arr[$c['cid']] = $this->get_teacher($c['cid']);
        }
        $data['teacher_arr'] = $arr;
        $this->load->view("layout/header");
        $this->load->view("dc/dc_base", $data);
        $this->load->view('layout/footer');
    }

    public function get_teacher($param) {
        $rs = $this->My_model->join2table_where_result('tb_course_detail a', 'tb_human_resources_01 b', 'a.tb_human_resources_01_id=b.id', array('tb_course_id' => $param), 'tb_human_resources_01_id');
        $str = "";
        foreach ($rs as $r) {
            $str .= $r['hr_thai_symbol'] . ' ' . $r['hr_thai_name'] . ' ' . $r['hr_thai_lastname'] . '<br>';
        }
        return $str;
    }

    //----- ลวกจบ


    public function dc_insert_base() {
        $data['row'] = $this->My_model->get_all_order("tb_group_learning", "tb_group_learning_seq asc");
        $data['rscourse'] = $this->Dcc_model->dc_base();
        $data['sjtype'] = $this->Chairatto_model->get_subject_type_list();
        $this->load->view("layout/header");
        $this->load->view("dc/dc_insert", $data);
        $this->load->view("layout/footer");
    }

    public function member() {
        if ($this->input->post('subject')) {
            echo $this->Dcc_model->fetch_member($this->input->post('subject'));
        }
    }

    public function sj_code() {
        $id = $_POST['id'];
        $rs = $this->Dcc_model->code_subject($id);
        echo json_encode($rs);
    }

    public function sj_count() {
        $id = $this->input->post('id');
        $rs = $this->My_model->count_record_where('tb_course', array('tb_subject_id' => $id));
        echo json_encode($rs);
    }

    public function dc_code() {
        $id = $this->input->post('id');
        $rs = $this->Dcc_model->code_edit($id);
        echo json_encode($rs);
    }

    public function dc_modal_insert() {
        $arr = array(
            "tb_group_learning_id" => $this->input->post('inGroupLearningName'),
            "tb_subject_name" => $this->input->post('inSubjectName'),
            "tb_subject_abbreviation" => $this->input->post('inSubjectAbbreviation'),
            "tb_subject_type" => $this->input->post('inSubjectType'),
            "tb_subject_recorder" => $this->session->userdata('name'),
            "tb_subject_department" => $this->session->userdata('department')
        );
        $this->My_model->insert_data('tb_subject', $arr);
    }

    public function dc_insert() {
        $arr = array(
            "tb_subject_id" => $this->input->post('inSubject'),
            "tb_ed_school_register_class_id" => $this->input->post('MyClass'),
            "tb_course_term" => $this->input->post('MyTerm'),
            "tb_course_hour_week" => $this->input->post('inCourseHourWeek'),
            "tb_course_hour_term" => $this->input->post('inCourseHourTerm'),
            "tb_course_credit" => $this->input->post('inCourseCredit'),
            "tb_course_credit_sp" => $this->input->post('inCourseCreditSp'),
            "tb_course_code" => $this->input->post('inCourseCode'),
            "tb_course_mid_score" => $this->input->post('inCourseMidScore'),
            "tb_course_final_score" => $this->input->post('inCourseFinalScore'),
            "tb_course_recorder" => $this->session->userdata('name'),
            "tb_course_department" => $this->session->userdata('department'),
            "tb_course_createdate" => date('Y-m-d')
        );
        $this->My_model->insert_data('tb_course', $arr);
    }

    //---------- งาน 27-1-2562 ใช้ส่งวัดผลประเมินผล
    //------- Stand list (ตัวชี้วัด)
    public function get_standard_unit() {
        $id = $_POST['id'];
        $cls = $_POST['cls'];
        $lev = $_POST['lev'];
        echo $this->Dcc_model->get_standard_unit($id, $cls, $lev);
    }

    //------- Standard list (ตัวชี้วัด - insert or update)
    public function insert_standard() {
        $id = $this->input->post('kpiId');
        print_r($this->input->post('Score'));
        foreach ($id as $kid) {
            $Scoreid = $this->input->post('scId' . $kid);
            $score = $this->input->post('Score' . $kid);

            if ($Scoreid != "") {
                $this->My_model->update_data('tb_kpi_score', array('id' => $Scoreid), array("tb_kpi_score" => $score));
            } else {
                $arr = array(
                    "tb_kpi_score" => $score,
                    "tb_kpi_standard_learning_id" => $kid,
                    "tb_unit_learning_id" => 1,
                    "tb_kpi_score_recorder" => $this->session->userdata('name'),
                    "tb_kpi_score_department" => $this->session->userdata('department'),
                    "tb_kpi_score_createdate" => date('Y-m-d')
                );
                $this->My_model->insert_data('tb_kpi_score', $arr);
            }
        }
    }

    //------- Unit list (หน่วยการเรียนรู้ เงื่อนไข = Course ID)
    public function get_unit_list() {
        $id = $_POST['id'];
        echo $this->Dcc_model->get_unit_list($id);
    }

    public function edit_unit_list() {
        $id = $_POST['id'];
        $rs = $this->My_model->get_where_row("tb_unit_learning", array("id" => $id));
        echo json_encode($rs);
    }

    public function delete_unit_list() {
        $id = $_POST['id'];
        $arr = array(
            "tb_unit_learning_id" => 0
        );
        $this->My_model->update_data('tb_kpi_score', array("tb_unit_learning_id" => $id), $arr);
        $this->My_model->delete_data("tb_unit_learning", array("id" => $id));
        echo json_encode($id);
    }

    public function get_standard_list() {
        $id = $_POST['id'];
        $output = "";
        $MyCourse = $this->Dcc_model->get_row_course_by_unitid($id);

        if ($MyCourse) {
            if ($MyCourse['tb_subject_type'] == "พื้นฐาน") {
                $output .= $this->Dcc_model->get_standard_list($id, $MyCourse['ed_school_class_id']);
            } else {

                //-- วิชาเพิ่มเติม วิชากิจกรรม วิชาSBMLD เริ่มในนี้
                $MyCoursePurpose = $this->Dcc_model->get_course_purpose_by_courseid($MyCourse['ed_course_id']);

                $output = "<table class=\"table table-hover table-striped table-bordered display\" id=\"KpiListTable\">";
                $output .= "<thead>";
                $output .= "<tr>";
                $output .= "<th style=\"width:40px;text-align:center;\">ที่</th>";
                $output .= "<center><th style=\"width:150px;text-align:center;\" class=\"sorting\">ชื่อจุดประสงค์</th></center>";
                $output .= "<center><th style=\"width:40px;text-align:center;\">สถานะ </th></center>";
//                style=\"text-align:center; \"
                $output .= "</tr>";
                $output .= "</thead>";

                $output .= "<tbody>";
                $i = 1;
                foreach ($MyCoursePurpose as $r) {
                    $checkid = $r['tb_unit_learning_id'];

                    $output .= "<tr>";
                    $output .= "<td>" . $i . "</td>";
                    $output .= "<td><center>" . $r['tb_course_purpose_name'] . "</center></td>";

                    if ($checkid == $id) {
                        $output .= "<td> <center> <button type=\"button\" class=\"btn btn-success \"  id=\"" . $r['id'] . "\"><i class=\"icon-ok icon-large\"></i> เลือกแล้ว </button> </center> </td>";
                    } else {
                        $output .= "<td> <center> <button type=\"button\" class=\"btn btn-light \" onclick='SelectThisPurpose(this)' id=\"" . $r['id'] . "\"> คลิกเพื่อเลือก </button> </center> </td>";
                    }

                    $i ++;

                    $output .= "</tr>";
                }
                $output .= "</tbody>";
                $output .= "</table>";
            }
        }

//        echo ;
        echo $output;
    }

    public function purpose_check() {
        $id = $_POST['recordid'];
        $uid = $_POST['uid'];

        $arr = array(
            "tb_unit_learning_id" => $uid
        );
        $this->My_model->update_data('tb_course_purpose', array("id" => $id), $arr);
    }

    //------- Insert Unit list (Insert หน่วยการเรียนรู้)
    public function insert_unit_list() {
        $id = $this->input->post('UnitId');
        if ($id != "") {
            $arr = array(
                "tb_unit_learning_sequence" => $this->input->post('inSequence'),
                "tb_unit_learning_name" => $this->input->post('inName'),
                "tb_unit_learning_content" => $this->input->post('inContent'),
                "tb_unit_learning_hour" => $this->input->post('inHour'),
                "tb_unit_learning_score" => $this->input->post('inScore')
            );
            $this->My_model->update_data('tb_unit_learning', array('id' => $id), $arr);
        } else {
            $arr = array(
                "tb_course_id" => $this->input->post('insertID'),
                "tb_unit_learning_sequence" => $this->input->post('inSequence'),
                "tb_unit_learning_name" => $this->input->post('inName'),
                "tb_unit_learning_content" => $this->input->post('inContent'),
                "tb_unit_learning_hour" => $this->input->post('inHour'),
                "tb_unit_learning_score" => $this->input->post('inScore'),
                "tb_unit_learning_recorder" => $this->session->userdata('name'),
                "tb_unit_learning_department" => $this->session->userdata('department'),
                "tb_unit_learning_createdate" => date('Y-m-d')
            );
            $this->My_model->insert_data('tb_unit_learning', $arr);
        }
    }

    //------- Check
    public function unit_check() {
        $sid = $_POST['sid'];
        $uid = $_POST['uid'];

        $this->db->select("*")->from("tb_kpi_score");
        $this->db->where("tb_kpi_standard_learning_id", $sid);
        $this->db->where("tb_unit_learning_id", $uid);
        $MyQ = $this->db->get()->result_array;

        $count = count($MyQ);

        if ($count > 0) {
            $arr = array(
                "tb_unit_learning_id" => $uid
            );
            $this->My_model->update_data('tb_kpi_score', array("id" => $MyQ[0]['id']), $arr);
        } else {
            $arr = array(
                "tb_kpi_standard_learning_id" => $sid,
                "tb_unit_learning_id" => $uid,
                "tb_kpi_score" => 10,
                "tb_kpi_score_recorder" => $this->session->userdata('name'),
                "tb_kpi_score_department" => $this->session->userdata('department'),
                "tb_kpi_score_createdate" => date('Y-m-d')
            );
            $this->My_model->insert_data('tb_kpi_score', $arr);
        }
    }

    //------- UnCheck
    public function unit_uncheck() {
        $id = $_POST['id'];
        $this->My_model->delete_data('tb_kpi_score', array('id' => $id));
    }

    //------- Unit list (หน่วยการเรียนรู้ เงื่อนไข = Course ID)
    public function get_result() {
        $id = $_POST['id'];
        $output = "";
        $MyCourse = $this->Dcc_model->get_row_course_by_courseid($id);
        if ($MyCourse) {
            if ($MyCourse['tb_subject_type'] == "พื้นฐาน") {
                $output .= $this->Dcc_model->get_result($id);
            } else {

                $UnitLearning = $this->My_model->get_where_order('tb_unit_learning', array('tb_course_id' => $id), 'tb_unit_learning_sequence asc');

                $sumhour = 0;
                $sumscore = 0;

                foreach ($UnitLearning as $r) {

                    $output .= "<tr>";

                    $sumhour = $sumhour + $r['tb_unit_learning_hour'];
                    $sumscore = $sumscore + $r['tb_unit_learning_score'];

                    $output .= "<td>" . $r['tb_unit_learning_sequence'] . "</td>";
                    $output .= "<td>" . $r['tb_unit_learning_name'] . "</td>";

                    $Coursepurpose = $this->My_model->get_where_order('tb_course_purpose', array('tb_unit_learning_id' => $r['id']), 'id asc');

                    $output .= "<td>";
                    foreach ($Coursepurpose as $rr) {
                        $output .= $rr['tb_course_purpose_name'];
                        $output .= "<br/>";
                    }
                    $output .= "</td>";

                    $output .= "<td>" . $r['tb_unit_learning_content'] . "</td>";
                    $output .= "<td><center>" . $r['tb_unit_learning_hour'] . "</center></td>";
                    $output .= "<td><center>" . $r['tb_unit_learning_score'] . "</center></td>";


                    $output .= "</tr>";
                }

                $output .= "<td colspan=\"4\"> <center><b> สรุปผล </b></center> </td>";
                $output .= "<td><center><font color=\"green\"><b>" . $sumhour . " ชั่วโมง</b></font></center></td>";
                $output .= "<td><center><font color=\"green\"><b>" . $sumscore . " คะแนน</b></font></center></td>";
            }
        }

        echo $output;
    }

//--------- แผนการสอน
    //------- Stand list (ตัวชี้วัด)
    public function get_plan_kpi_list() {
        $id = $_POST['id'];
        echo $this->Dcc_model->get_plan_kpi_list($id);
    }

    //------- Hour list (จำนวนชั่วโมง)
    public function get_plan_hour_list() {
        $id = $_POST['id'];
        echo $this->Dcc_model->get_plan_hour_list($id);
    }

    //------- Hour Edit list (จำนวนชั่วโมง)
    public function get_plan_edit_hour_list() {
        $UnitId = $_POST['UnitId'];
        $MyPlanId = $_POST['MyPlanId'];
        echo $this->Dcc_model->get_plan_edit_hour_list($UnitId, $MyPlanId);
    }

    //------- table plan (ตารางข้อมูลแผนการสอน)
    public function get_plan_list() {
        $id = $_POST['id'];
        echo $this->Dcc_model->get_plan_list($id);
    }

    public function get_head_plan() {
        $id = $_POST['id'];
        $rs = $this->My_model->get_where_row("tb_unit_learning", array("id" => $id));
        echo json_encode($rs);
    }

    public function edit_plan_list() {
        $id = $_POST['id'];
        $rs = $this->Dcc_model->edit_plan_list($id);
        //print_r($rs);
        echo json_encode($rs);
    }

    //--- insert plan
    public function insert_plan() {

        //---- insert only text         
        $id = $this->input->post('UnitIdforPlan');
        $arr = array(
            "tb_unit_learning_id" => $id,
            "tb_kpi_standard_learning_id" => $this->input->post('inPlanKpi'),
            "tb_lesson_plan_sequence" => $this->input->post('inPlanSequence'),
            "tb_lesson_plan_hour" => $this->input->post('inPlanHour'),
            "tb_lesson_plan_name" => $this->input->post('inPlanName'),
            "tb_lesson_plan_permission" => $this->input->post('inPlanPermission'),
            "tb_lesson_plan_status" => $this->input->post('inPlanStatus'),
            "tb_lesson_plan_recorder" => $this->session->userdata('name'),
            "tb_lesson_plan_department" => $this->session->userdata('department'),
            "tb_lesson_plan_createdate" => date('Y-m-d')
        );
        $this->My_model->insert_data('tb_lesson_plan', $arr);

        $id = $this->db->insert_id();

        //---- สาระสำคัญ
        $arr = array(
            "tb_lesson_plan_id" => $id,
            "tb_lesson_plan_essence_content" => $this->input->post('inEssence'),
            "tb_lesson_plan_essence_recorder" => $this->session->userdata('name'),
            "tb_lesson_plan_essence_department" => $this->session->userdata('department'),
            "tb_lesson_plan_essence_createdate" => date('Y-m-d')
        );
        $this->My_model->insert_data('tb_lesson_plan_essence', $arr);

        //---- จุดประสงค์
        $arr = array(
            "tb_lesson_plan_id" => $id,
            "tb_lesson_plan_purpose_content" => $this->input->post('inPurpose'),
            "tb_lesson_plan_purpose_recorder" => $this->session->userdata('name'),
            "tb_lesson_plan_purpose_department" => $this->session->userdata('department'),
            "tb_lesson_plan_purpose_createdate" => date('Y-m-d')
        );
        $this->My_model->insert_data('tb_lesson_plan_purpose', $arr);

        //---- สาระการเรียนรู้
        $arr = array(
            "tb_lesson_plan_id" => $id,
            "tb_lesson_plan_learning_content" => $this->input->post('inLearning'),
            "tb_lesson_plan_learning_recorder" => $this->session->userdata('name'),
            "tb_lesson_plan_learning_department" => $this->session->userdata('department'),
            "tb_lesson_plan_learning_createdate" => date('Y-m-d')
        );
        $this->My_model->insert_data('tb_lesson_plan_learning', $arr);

        //---- ผลการเรียนรู้ที่คาดหวัง
        $arr = array(
            "tb_lesson_plan_id" => $id,
            "tb_lesson_plan_expect_content" => $this->input->post('inExpect'),
            "tb_lesson_plan_expect_recorder" => $this->session->userdata('name'),
            "tb_lesson_plan_expect_department" => $this->session->userdata('department'),
            "tb_lesson_plan_expect_createdate" => date('Y-m-d')
        );
        $this->My_model->insert_data('tb_lesson_plan_expect', $arr);


        //---- การวัดและประเมินผล
        //---- วิธีการวัด
        $arr = array(
            "tb_lesson_plan_id" => $id,
            "tb_lesson_plan_evaluate_method_content" => $this->input->post('inEvaluateMethod'),
            "tb_lesson_plan_evaluate_method_recorder" => $this->session->userdata('name'),
            "tb_lesson_plan_evaluate_method_department" => $this->session->userdata('department'),
            "tb_lesson_plan_evaluate_method_createdate" => date('Y-m-d')
        );
        $this->My_model->insert_data('tb_lesson_plan_evaluate_method', $arr);

        //---- เครื่องมือการวัดผลและประเมินผล
        $arr = array(
            "tb_lesson_plan_id" => $id,
            "tb_lesson_plan_evaluate_tool_content" => $this->input->post('inEvaluateTool'),
            "tb_lesson_plan_evaluate_tool_recorder" => $this->session->userdata('name'),
            "tb_lesson_plan_evaluate_tool_department" => $this->session->userdata('department'),
            "tb_lesson_plan_evaluate_tool_createdate" => date('Y-m-d')
        );
        $this->My_model->insert_data('tb_lesson_plan_evaluate_tool', $arr);

        //---- เกณฑ์การวัดผลประเมินผล
        $arr = array(
            "tb_lesson_plan_id" => $id,
            "tb_lesson_plan_evaluate_criterion_content" => $this->input->post('inEvaluateCriterion'),
            "tb_lesson_plan_evaluate_criterion_recorder" => $this->session->userdata('name'),
            "tb_lesson_plan_evaluate_criterion_department" => $this->session->userdata('department'),
            "tb_lesson_plan_evaluate_criterion_createdate" => date('Y-m-d')
        );
        $this->My_model->insert_data('tb_lesson_plan_evaluate_criterion', $arr);

        //---- สื่อที่ใช้สอน
        //---- สื่อ(text)
        $arr = array(
            "tb_lesson_plan_id" => $id,
            "tb_lesson_plan_media_content" => $this->input->post('inMedia'),
            "tb_lesson_plan_media_recorder" => $this->session->userdata('name'),
            "tb_lesson_plan_media_department" => $this->session->userdata('department'),
            "tb_lesson_plan_media_createdate" => date('Y-m-d')
        );
        $this->My_model->insert_data('tb_lesson_plan_media', $arr);
    }

    //--- update plan
    public function update_plan() {

        //---- update only text         
        $id = $this->input->post('inPlanId');
        $arr = array(
            "tb_kpi_standard_learning_id" => $this->input->post('inPlanKpi'),
            "tb_lesson_plan_sequence" => $this->input->post('inPlanSequence'),
            "tb_lesson_plan_hour" => $this->input->post('inPlanHour'),
            "tb_lesson_plan_name" => $this->input->post('inPlanName'),
            "tb_lesson_plan_permission" => $this->input->post('inPlanPermission')
        );
        $this->My_model->update_data('tb_lesson_plan', array('id' => $id), $arr);

//---- สาระสำคัญ
        $arr = array(
            "tb_lesson_plan_essence_content" => $this->input->post('inEssence')
        );
        $this->My_model->update_data('tb_lesson_plan_essence', array('tb_lesson_plan_id' => $id), $arr);

        //---- จุดประสงค์
        $arr = array(
            "tb_lesson_plan_purpose_content" => $this->input->post('inPurpose')
        );
        $this->My_model->update_data('tb_lesson_plan_purpose', array('tb_lesson_plan_id' => $id), $arr);

        //---- สาระการเรียนรู้
        $arr = array(
            "tb_lesson_plan_learning_content" => $this->input->post('inLearning')
        );
        $this->My_model->update_data('tb_lesson_plan_learning', array('tb_lesson_plan_id' => $id), $arr);

        //---- ผลการเรียนรู้ที่คาดหวัง
        $arr = array(
            "tb_lesson_plan_expect_content" => $this->input->post('inExpect')
        );
        $this->My_model->update_data('tb_lesson_plan_expect', array('tb_lesson_plan_id' => $id), $arr);

        //---- การวัดและประเมินผล
        //---- วิธีการวัด
        $arr = array(
            "tb_lesson_plan_evaluate_method_content" => $this->input->post('inEvaluateMethod')
        );
        $this->My_model->update_data('tb_lesson_plan_evaluate_method', array('tb_lesson_plan_id' => $id), $arr);

        //---- เครื่องมือการวัดผลและประเมินผล
        $arr = array(
            "tb_lesson_plan_evaluate_tool_content" => $this->input->post('inEvaluateTool')
        );
        $this->My_model->update_data('tb_lesson_plan_evaluate_tool', array('tb_lesson_plan_id' => $id), $arr);

        //---- เกณฑ์การวัดผลประเมินผล
        $arr = array(
            "tb_lesson_plan_evaluate_criterion_content" => $this->input->post('inEvaluateCriterion')
        );
        $this->My_model->update_data('tb_lesson_plan_evaluate_criterion', array('tb_lesson_plan_id' => $id), $arr);

        //---- สื่อที่ใช้สอน
        //---- สื่อ(text)
        $arr = array(
            "tb_lesson_plan_media_content" => $this->input->post('inMedia')
        );
        $this->My_model->update_data('tb_lesson_plan_media', array('tb_lesson_plan_id' => $id), $arr);
    }

    //--- delete plan
    public function delete_plan() {

        //---- delete เปลี่ยน Status เป็น G ระบบก็จะมองไม่เห็น  
        $id = $this->input->post('inPlanId');
        Print_r($id);
        $MyStatus = "G";
        $arr = array(
            "tb_lesson_plan_status" => $MyStatus
        );
        $this->My_model->update_data('tb_lesson_plan', array('id' => $id), $arr);
    }

    //------- table plan (ตารางข้อมูลแผนการสอน)
    public function get_process_list() {
        $id = $_POST['id'];
        echo $this->Dcc_model->get_process_list($id);
    }

    //------ insert process บันทึกกระบวนการ
    public function insert_process() {
        $PlanId = $_POST['PlanId'];
        $MyContent = $_POST['MyContent'];
        $MySequence = $_POST['MySequence'];
        $ProcessId = $_POST['ProcessId'];

        if ($ProcessId == "") {
            $arr = array(
                "tb_lesson_plan_id" => $PlanId,
                "tb_lesson_plan_process_sequence" => $MySequence,
                "tb_lesson_plan_process_content" => $MyContent,
                "tb_lesson_plan_process_recorder" => $this->session->userdata('name'),
                "tb_lesson_plan_process_department" => $this->session->userdata('department'),
                "tb_lesson_plan_process_createdate" => date('Y-m-d')
            );
            $this->My_model->insert_data('tb_lesson_plan_process', $arr);
        } else {
            $arr = array(
                "tb_lesson_plan_process_sequence" => $MySequence,
                "tb_lesson_plan_process_content" => $MyContent
            );
            $this->My_model->update_data('tb_lesson_plan_process', array('id' => $ProcessId), $arr);
        }
    }

    //----แก้ไขกระบวนการ
    public function edit_process_list() {
        $id = $_POST['id'];
        $rs = $this->My_model->get_where_row("tb_lesson_plan_process", array("id" => $id));
        echo json_encode($rs);
    }

    //----ลบกระบวนการ
    public function delete_process_list() {
        $id = $_POST['id'];
        $this->My_model->delete_data('tb_lesson_plan_process', array('id' => $id));
    }

    //------- table doc (ตารางข้อมูลเอกสาร)
    public function get_doc_list() {
        $id = $_POST['id'];
        echo $this->Dcc_model->get_doc_list($id);
    }

    //---- นำเข้าไฟล์
    public function insert_file() {

        print_r($this->input->post('inPlanId'));

        if ($_FILES['inDocumentFile']['name'] != "") {
            $config = array(
                "upload_path" => "upload/",
                "allowed_types" => "pdf",
                "max_size" => 0,
                "file_name" => md5(date("YmdHis"))
            );
            $this->upload->initialize($config);
            $this->upload->do_upload("inDocumentFile");
            $data = $this->upload->data();

            $filename = $data['file_name'];
        } else {
            $filename = "";
        }



//        $this->load->library("image_lib");
//        $config['image_library'] = "gd2";
//        $config["source_image"] = "upload/" . $data['file_name'];
//        $config['maintain_ratio'] = TRUE;
//        $config['width'] = 1024;
//        $config['height'] = 768;
//
//        $this->image_lib->initialize($config);
//        $this->image_lib->resize();
//        
        //---- insert         
        $arr = array(
            "tb_lesson_plan_id" => $this->input->post('inPlanId'),
            "tb_lesson_plan_document_name" => $filename,
            "tb_lesson_plan_document_note" => $this->input->post('inDocumentNote'),
            "tb_lesson_plan_document_type" => $this->input->post('inDocumentType'),
            "tb_lesson_plan_document_recorder" => $this->session->userdata('name'),
            "tb_lesson_plan_document_department" => $this->session->userdata('department'),
            "tb_lesson_plan_document_createdate" => date('Y-m-d')
        );
        $this->My_model->insert_data('tb_lesson_plan_document', $arr);
    }

    //---- ลบไฟล์
    public function delete_doc_list() {
        $id = $_POST['id'];
        $this->My_model->delete_data('tb_lesson_plan_document', array('id' => $id));
    }

    //------- table other (ตาราง คุณลักษณะ อ่านคิด สมรรถนะ)
    public function get_other_list() {
        $id = $_POST['id'];
        echo $this->Dcc_model->get_other_list($id);
    }

    //---- อ่านคิดวิเคราะห์เขียน(1)
    //---- เพิ่มหัวข้อ อ่านคิดวิเคราะห์เขียน อ้างอิงด้วย Id แผนการสอน
    public function rwa_insert() {
        $MyId = $_POST['MyId'];
        $PlanId = $_POST['PlanId'];

        $arr = array(
            "tb_lesson_plan_id" => $PlanId,
            "tb_ed_rw_analysis_id" => $MyId,
            "tb_lesson_plan_rw_analysis_recorder" => $this->session->userdata('name'),
            "tb_lesson_plan_rw_analysis_department" => $this->session->userdata('department'),
            "tb_lesson_plan_rw_analysis_createdate" => date('Y-m-d')
        );

        $this->My_model->insert_data('tb_lesson_plan_rw_analysis', $arr);
    }

    //----ลบอ่านคิดวิเคราะห์เขียน
    public function rwa_delete() {
        $id = $_POST['id'];
        $this->My_model->delete_data('tb_lesson_plan_rw_analysis', array('id' => $id));
    }

    //---- อ่านคิดวิเคราะห์เขียน จบ(1)
    //
    //
    //---- คุณลักษณะอันพึงประสงค์(2)
    //---- เพิ่มหัวข้อ คุณลักษณะอันพึงประสงค์ อ้างอิงด้วย Id แผนการสอน
    public function cha_insert() {
        $MyId = $_POST['MyId'];
        $PlanId = $_POST['PlanId'];

        $arr = array(
            "tb_lesson_plan_id" => $PlanId,
            "tb_ed_character_id" => $MyId,
            "tb_lesson_plan_character_recorder" => $this->session->userdata('name'),
            "tb_lesson_plan_character_department" => $this->session->userdata('department'),
            "tb_lesson_plan_character_createdate" => date('Y-m-d')
        );

        $this->My_model->insert_data('tb_lesson_plan_character', $arr);
    }

    //----ลบคุณลักษณะอันพึงประสงค์
    public function cha_delete() {
        $id = $_POST['id'];
        $this->My_model->delete_data('tb_lesson_plan_character', array('id' => $id));
    }

    //---- คุณลักษณะอันพึงประสงค์ จบ(2)
    //
    //
    //---- สมรรถนะผู้เรียน(3)
    //---- เพิ่มหัวข้อ สมรรถนะผู้เรียน อ้างอิงด้วย Id แผนการสอน
    public function cap_insert() {
        $MyId = $_POST['MyId'];
        $PlanId = $_POST['PlanId'];

        $arr = array(
            "tb_lesson_plan_id" => $PlanId,
            "tb_ed_capacity_id" => $MyId,
            "tb_lesson_plan_capacity_recorder" => $this->session->userdata('name'),
            "tb_lesson_plan_capacity_department" => $this->session->userdata('department'),
            "tb_lesson_plan_capacity_createdate" => date('Y-m-d')
        );

        $this->My_model->insert_data('tb_lesson_plan_capacity', $arr);
    }

    //----ลบสมรรถนะผู้เรียน
    public function cap_delete() {
        $id = $_POST['id'];
        $this->My_model->delete_data('tb_lesson_plan_capacity', array('id' => $id));
    }

    //---- คุณสมรรถนะผู้เรียน จบ(3)
    //------- result list (สรุปแผน)
    public function get_result_plan() {
        $id = $_POST['id'];
        echo $this->Dcc_model->get_result_plan($id);
    }

    public function get_class_id() {
        $id = $_POST['id'];
        echo json_encode($this->Chairatto_model->get_class_where($id));
    }

    public function gen_subject_code() {
        $SId = $_POST['sid'];
        $CId = $_POST['cid'];
        echo json_encode($this->Dcc_model->gen_subject_code($SId, $CId));
    }

    public function dc_base_where() {
        $ClassId = $_POST['id'];
        $term = $_POST['term'];
        $edyear = $_POST['edyear'];

        echo $this->Dcc_model->dc_base_where($ClassId, $term, $edyear);
    }

    public function course_by_classid_term_edyear() {
        $classid = $_POST['id'];
        $term = $_POST['term'];
        $edyear = $_POST['edyear'];
        $courselist = $this->Dcc_model->course_by_class_term_edyear($classid, $term, $edyear);

        $output = "";
        
        $output = '<table class="table table-hover table-striped table-bordered display" id="DcTable">                        
                        <thead>
                            <tr>
                                <th style="width:5%; text-align: center">ที่</th>
                                <th style="width:20%; text-align: center">กลุ่มสาระการเรียนรู้</th>
                                <th style="width:10%; text-align: center">รหัสวิชา</th>
                                <th style="width:10%; text-align: center">ชื่อวิชา</th>
                                <th style="width:10%; text-align: center">ภาคเรียน</th>
                                <th style="width:10%; text-align: center">ระดับชั้น</th>
                                <th style="width:5%; text-align: center">หน่วยกิต</th>
                                <th style="width:10%; text-align: center">ประเภทวิชา</th>
                                <th style="width:20%; text-align: center">จัดการ</th>
                            </tr>
                        </thead>
                        <tbody id="CourseTBody">';

        $i = 1;
        if ($courselist) {
            foreach ($courselist as $r) {
                $output .= "<tr>";
                $output .= "<td style=\"text-align: center;\">" . $i . "</td>";
                $output .= "<td style=\"text-align: center;\">" . $r['tb_group_learningcol_name'] . "</td>";
                $output .= "<td style=\"text-align: center;\">" . $r['tb_course_code'] . "</td>";
                $output .= "<td style=\"text-align: center;\">" . $r['tb_subject_name'] . "</td>";
                $output .= "<td style=\"text-align: center;\">" . $r['tb_course_term'] . "</td>";
                $output .= "<td style=\"text-align: center;\">" . $r['tb_ed_school_class_name'] . "ปีที่ " . $r['tb_ed_school_class_level'] . "</td>";
                $output .= "<td style=\"text-align: center;\">" . $r['tb_course_credit'] . "</td>";
                $output .= "<td style=\"text-align: center;\">" . $r['tb_subject_type'] . "</td>";
                $output .= "<td style=\"text-align: center;\">";
 $output .= "&nbsp;<button type=\"button\" class=\"btn btn-info btn-result\" id=\"" . $r['course_id'] . "\" onclick=\"SelectThisCourse(this)\"><i class=\"icon-login icon-large\"></i> จัดการวิชา</button>";
                // $output .= "&nbsp;<button type=\"button\" class=\"btn btn-info btn-result\" id=\"" . $r['course_id'] . "\" onclick=\"resultclick(this)\"><i class=\"icon-search icon-large\"></i> สรุป</button>";
                $output .= "&nbsp;<button type=\"button\" class=\"btn btn-warning \" id=\"" . $r['course_id'] . "\" onclick=\"EditThisCourse(this)\"><i class=\"icon-pencil icon-large\"></i> แก้ไข</button>";
                $output .= "&nbsp;<button type=\"button\" class=\"btn btn-danger \" id=\"" . $r['course_id'] . "\" onclick=\"DeleteThisCourse(this)\"><i class=\"icon-trash icon-large\"></i> ลบ</button>";

                $output .= "</td>";
                $output .= "</tr>";
                $i++;
            }
        }
        
        $output .= '</tbody>

                    </table>';


        echo $output;
    }

    public function delete_course_by_id() {
        $id = $this->input->post('id');
        $this->My_model->delete_data('tb_course', array('id' => $id));
    }

    //------- จุดประสงค์การเรียนรู้สำหรับวิชาเพิ่มเติม
    public function get_course_purpose_list() {
        $id = $_POST['id'];
        $PurposeList = $this->Dcc_model->get_course_purpose_list($id);
        $output = "";
        if ($PurposeList) {
            $ii = 1;
            foreach ($PurposeList as $row) {
                $output .= "<tr>";
                $output .= "<td style=\"text-align: center;\">" . $ii . "</td>";
                $output .= "<td>" . $row['tb_course_purpose_name'] . "</td>";
                $output .= "<td style=\"text-align: center;\">" . $row['tb_course_purpose_score'] . "</td>";
                $output .= "<td><center>"
                        . "&nbsp;<button type=\"button\" class=\"btn btn-warning\" id=\"" . $row['id'] . "\" onclick='EditCoursePurpose(this)'><i class=\"icon-pencil icon-large\"></i> แก้ไข </button>"
                        . "&nbsp;<button type=\"button\" class=\"btn btn-danger\" id=\"" . $row['id'] . "\" onclick='DeleteCoursePurpose(this)'><i class=\"icon-trash icon-large\"></i> ลบ </button>"
                        . "</center></td>";
                $output .= "</tr>";
                $ii ++;
            }
        }
        echo $output;
    }

    public function dc_insert_course_purpose() {
        $CourseId = $_POST['CourseId'];
        $topic = $_POST['topic'];
        $score = $_POST['score'];
        $id = $_POST['recordid'];

        $arr = array(
            "id" => $id,
            "tb_course_id" => $CourseId,
            "tb_course_purpose_name" => $topic,
            "tb_course_purpose_score" => $score,
            "tb_course_purpose_recorder" => $this->session->userdata('name'),
            "tb_course_purpose_department" => $this->session->userdata('department'),
            "tb_course_purpose_createdate" => date('Y-m-d')
        );

        if ($id != "") {
            $this->My_model->update_data('tb_course_purpose', array('id' => $id), $arr);
        } else {
            $this->My_model->insert_data('tb_course_purpose', $arr);
        }
    }

    public function dc_edit_course_purpose() {
        $id = $_POST['id'];
        $rs = $this->My_model->get_where_row("tb_course_purpose", array("id" => $id));
        echo json_encode($rs);
    }

    public function dc_delete_course_purpose() {
        $id = $_POST['id'];
        $this->My_model->delete_data('tb_course_purpose', array('id' => $id));
    }

    public function edit_course_by_id() {
        $id = $_POST['id'];
        echo json_encode($this->My_model->get_where_row("tb_course", array("id" => $id)));
    }

    public function course_insert() {
        $id = $this->input->post('inCourseId');
        
        $arr = array(
            
            "id" => $id,
            "tb_course_code" => $this->input->post('inCourseCode'),
            "tb_course_hour_week" => $this->input->post('inCourseHourWeek'),
            "tb_course_hour_term" => $this->input->post('inCourseHourTerm'),
            "tb_course_credit" => $this->input->post('inCourseCredit'),
            "tb_course_credit_sp" => $this->input->post('inCourseCreditSp'),
            "tb_course_mid_score" => $this->input->post('inCourseMidScore'),
            "tb_course_final_score" => $this->input->post('inCourseFinalScore'),
            
        );

        if ($id != "") {
            $this->My_model->update_data('tb_course', array('id' => $id), $arr);
        } else {
            $this->My_model->insert_data('tb_course', $arr);
        }
    }

}
