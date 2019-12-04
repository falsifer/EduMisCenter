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
  | Create Date 19/4/2562
  | Last edit	19/4/2562
  | Comment	-
  | ----------------------------------------------------------------------------
 */

Class Teaching_task extends CI_Controller {

    public function __construct() {
        parent::__construct();
        if ($this->session->userdata('status') == "") {
            redirect("/");
        }
        $this->load->model("My_model");
        $this->load->model("Dcc_model");
        $this->load->model("Ed_Classroom_model");
        $this->load->model("Std_model");
    }

    public function teaching_task_base() {
        $data['rSection'] = $this->My_model->get_where_order('tb_ed_section', array('tb_ed_section_department' => $this->session->userdata('department')), 'tb_ed_section_start asc');
//        $data['rCourse'] = $this->My_model->get_where_order('tb_course_detail', array('tb_human_resources_01_id' => $this->session->userdata('hr_id')), 'id asc');

        $this->db->select("a.tb_course_code,a.tb_course_term,a.id as id,c.tb_subject_name,d.tb_ed_school_register_class_edyear");
        $this->db->from("tb_course a");
        $this->db->join("tb_course_detail b", "b.tb_course_id = a.id");
        $this->db->join("tb_subject c", "c.id = a.tb_subject_id");
        $this->db->join("tb_ed_school_register_class d", "d.id = a.tb_ed_school_register_class_id");
        $this->db->where('b.tb_human_resources_01_id', $this->session->userdata('hr_id'));
        $MyQ = $this->db->get()->result_array();

        $data['rCourse'] = $MyQ;
        $this->load->view("layout/header");
        $this->load->view("teacher/teaching_task_base", $data);
        $this->load->view("layout/footer");
    }

    public function teaching_task_schedule_body() {
        $yearly = $this->input->post('yearly');
        $term = $this->input->post('eterm');
        $hr_id = $this->session->userdata('hr_id');

        $schedule = $this->Ed_Classroom_model->get_list_section_by_user($yearly, $term, $hr_id);
        $section = $this->My_model->get_where_order('tb_ed_section', array('tb_ed_section_department' => $this->session->userdata('department')), 'tb_ed_section_start asc');

        $numcol = (count($section)) + 1;
        $numrow = 6;

        $widthpercent = 100 / $numcol;
        $heightpercent = 100 / $numrow;

        $output = "";

        $day = array("จันทร์", "อังคาร", "พุธ", "พฤหัสบดี", "ศุกร์");



        $output .= "<tr>";
        $output .= "<td style='text-align: center;font-size: 0.9em;background: whitesmoke;width: " . $widthpercent . "%;height:" . $heightpercent . "%;padding: 5px;'></td>";

        $SectionNo = 1;
        foreach ($section as $rSection) {
            $output .= "<td style='text-align: center;font-size: 0.9em;background: whitesmoke;width: " . $widthpercent . "%;height:" . $heightpercent . "%;padding: 5px;'>";
            $output .= "คาบที่ " . $SectionNo;
            $output .= "<p>" . date('H:i', strtotime($rSection['tb_ed_section_start'])) . " - " . date('H:i', strtotime($rSection['tb_ed_section_end'])) . "</p>";
            $output .= "</td>";

            $SectionNo++;
        }
        $output .= "</tr>";


//        for ($i = 1; $i <= ($numrow - 1); $i++) {

        $daynum = 1;
        foreach ($day as $r) {
            $output .= "<tr>";
            $output .= "<td style='text-align: center;font-size: 0.9em;background: whitesmoke;width: " . $widthpercent . "%;height:" . $heightpercent . "%;padding: 5px;'>" . $r . "</td>";

            $SectionNo = 1;
            foreach ($section as $rSection) {
                $output .= "<td style='text-align: center;font-size: 0.9em;background: whitesmoke;width: " . $widthpercent . "%;height:" . $heightpercent . "%;'>";
                $schedule = $this->Ed_Classroom_model->get_schedule_row_by_sectionid_day_hrid_term_edyear($rSection['id'], $daynum, $term, $yearly);



                if ($schedule) {
//                    $output .= "<button type='button' class='btn btn-link' onclick='ScheduleDetail(this)' style='width:100%;height:100%;' id='" . $schedule['ScheduleId'] . "'>";
                    $output .= "<p>" . $schedule['tb_course_code'] . "</p>";
                    if ($schedule['tb_ed_schedule_room']) {
                        $output .= "<p>(ห้อง " . $schedule['tb_ed_schedule_room'] . ")</p>";
                    }
                    if ($schedule['ed_classroom']) {
                        $output .= "<p>(" . $schedule['ed_classroom'] . ")</p>";
                    }
//                    $output .= "</button>";
                } else {

                    $output .= "<font color='red'> - </font>";
                }


//                $output .= "<p>" . date('H:i', strtotime($rSection['tb_ed_section_start'])) . " - " . date('H:i', strtotime($rSection['tb_ed_section_end'])) . "</p>";
                $output .= "</td>";

                $SectionNo++;
            }
            $output .= "</tr>";
            $daynum++;
        }


        echo $output;
    }

    public function teaching_task_development() {
        $data['rSection'] = $this->My_model->get_where_order('tb_ed_section', array('tb_ed_section_department' => $this->session->userdata('department')), 'tb_ed_section_start asc');
        $this->load->view("layout/header");
        $this->load->view("teacher/teaching_task_development", $data);
        $this->load->view("layout/footer");
    }

    public function get_room_list_by_course_id() {
        $id = $this->input->post('id');
        $output = "";
        $course = $this->My_model->get_where_row("tb_course", array("id" => $id));
        $subject = $this->My_model->get_where_row("tb_subject", array("id" => $course['tb_subject_id']));

        $sql = "SELECT DISTINCT e.* FROM `tb_register_course` a inner join tb_student_base b on a.`tb_student_base_id` = b.id "
                . "inner join tb_ed_classroom d on d.tb_student_base_id = b.id "
                . "inner join tb_course_detail f on f.tb_course_id = a.tb_course_id "
                . "inner join tb_ed_room e on e.id = d.tb_ed_room_id where a.`tb_course_id` = " . $id . " and  f.`tb_human_resources_01_id` = " . $this->session->userdata('hr_id') . " ORDER BY `e`.`tb_classroom_room` ASC";

        if ($subject['tb_subject_type'] != "เลือกเรียน" && $subject['tb_subject_type'] != "กิจกรรม") {
            $rs = $this->db->query($sql);
            $MyQ = $rs->result_array();

            foreach ($MyQ as $r) {
                $output .= "<option value='{$r['id']}'>ห้องที่ " . $r['tb_classroom_room'] . "</option>";
            }

            echo $output;
        }
    }

    public function teaching_task_course_work_base() {
//        $this->My_model

        $course_detail = $this->My_model->get_where_row("tb_course_detail", array("id" => $this->input->get("course_detail_id")));
        $rUnit = $this->My_model->get_where_order('tb_unit_learning', array('tb_course_id' => $course_detail["tb_course_id"], 'tb_unit_learning_term' => $this->input->get("term")), 'tb_unit_learning_sequence asc');
        $output = "";
        $data['course'] = $this->Dcc_model->get_course_by_id($course_detail['tb_course_id']);
//       tb_course_work
        foreach ($rUnit as $r) {

            $output .= "<tr>"
                    . "<td colspan='5'>หน่วยการเรียนรู้ที่ {$r['tb_unit_learning_sequence']} เรื่อง{$r['tb_unit_learning_name']} ({$r['tb_unit_learning_score']} คะแนน)</td>"
                    . "<td><button type='button' class='btn btn-primary pull-right' id='{$r['id']}' onclick='AddCourseWork(this)'><i class='icon-plus icon-large'></i> เพิ่มข้อมูล</button></td>"
                    . "</tr>";
            $i = 1;
            $rWork = $this->My_model->get_where_order('tb_course_work', array('tb_unit_learning_id' => $r['id'], "tb_course_detail_id" => $course_detail['id']), 'id asc');
            foreach ($rWork as $rW) {



                $output .= "<tr>";
                $output .= "<td style='text-align:right;'>{$i}</td>";
                $output .= "<td style='text-align:center;'>{$rW['tb_course_work_name']}</td>";



                $my_kpi = "";
                $kpi_arr = $this->My_model->get_where_order("tb_course_work_kpi", array("tb_course_work_id" => $rW['id']), "id asc");

                if ($kpi_arr) {
                    foreach ($kpi_arr as $r) {
                        $kpi = $this->Dcc_model->get_kpi_by_id($r['tb_kpi_score_id']);
                        $my_kpi .= $kpi['tb_standard_learning_code'] . " " . $kpi['tb_kpi_standard_learning_level'] . "/" . $kpi['tb_kpi_standard_learning_seq'] . "<hr/>";
                    }
                }

                $output .= "<td style='text-align:center;'>{$my_kpi}</td>";

                $output .= "<td style='text-align:center;'>{$rW['tb_course_work_type']}</td>";
                $output .= "<td style='text-align:center;'>{$rW['tb_course_work_maxscore']}</td>";
                $output .= "<td style='text-align:center;'>";
//                        . "<button type='button' style='color:blue;' class='btn btn-link pull-left' id='{$rW['id']}' onclick='AddKpiThisCourseWork(this)'><i class='icon-plus icon-large'></i></button>"
                $output .= "<button type='button' style='color:orange;' class='btn btn-link pull-left' id='{$rW['id']}' onclick='EditThisCourseWork(this)'><i class='icon-pencil icon-large'></i></button>";
                $output .= "<button type='button' style='color:red;' class='btn btn-link pull-left' id='{$rW['id']}' onclick='DeleteThisCourseWork(this)'><i class='icon-trash icon-large'></i></button>";
                $output .= "</td>";
                $output .= "</tr>";
                $i++;
            }
        }

        $data['Tbody'] = $output;
        load_view($this, "teacher/setting/teaching_task_course_work_base", $data);
    }

    public function teaching_task_course_work_insert() {
        $id = $this->input->post('id');
        $course_work_id = 0;

        $arr = array(
            "tb_unit_learning_id" => $this->input->post('UnitId'),
            "tb_course_detail_id" => $this->input->post('inCourseDetailId'),
            "tb_course_work_name" => $this->input->post('inCourseWorkName'),
            "tb_course_work_detail" => $this->input->post('inCourseWorkDetail'),
            "tb_course_work_maxscore" => $this->input->post('inCourseWorkMaxscore'),
            "tb_course_work_type" => $this->input->post('inCourseWorkType'),
            "tb_course_work_recorder" => $this->session->userdata('name'),
            "tb_course_work_createdate" => date('Y-m-d')
        );

        if ($id != "") {
            $this->My_model->update_data('tb_course_work', array('id' => $id), $arr);
        } else {
            $course_work_id = $this->My_model->insert_data('tb_course_work', $arr);
        }

        //----- for course work kpi

        $kpi_arry = $this->input->post("inMyKpiCheckbox");
//        $output = "";
        foreach ($kpi_arry as $r) {
//            $output .= "{$r}|-|";
            $arr = array(
                "tb_course_work_id" => $course_work_id,
                "tb_kpi_score_id" => $r,
                "tb_course_work_kpi_maxscore" => $this->input->post($r),
            );
            $this->My_model->insert_data('tb_course_work_kpi', $arr);
        }

//        echo $this->input->post($r);
    }

    public function teaching_task_course_work_delete() {
        if ($_POST['id'] != "") {
            $this->My_model->delete_data("tb_course_work", array("id" => $_POST['id']));
        }
    }

    public function teaching_task_set_session() {
        $id = $this->input->post('id');

        $this->session->set_userdata('teaching_id', $id);
    }

    public function teaching_task_go_pp5_fill_score_base() {
        ///---- New boi
        $id = $this->input->get('course_id');
        $UnitList = $this->My_model->get_where_order('tb_unit_learning', array('tb_course_id' => $id), "tb_unit_learning_sequence asc");
        $output1 = "";
        foreach ($UnitList as $r) {
            $output1 .= "<option value='{$r['id']}'>หน่วยการเรียนรู้ที่ {$r['tb_unit_learning_sequence']} {$r['tb_unit_learning_name']} </option>";
        }
        $data['unit_learning'] = $output1;




//        $room_id = $this->input->get("room_id");
//        $output = "";
//        $courseworkmaxscore = 0;
//
//        $data['Tbody'] = $output;
//
////        $UnitList = $this->My_model->get_where_order('tb_unit_learning', array('tb_course_id' => $id), "tb_unit_learning_sequence asc");
//
//        if (isset($UnitList[0]['id'])) {
//            //----- Student list
//            $student = $this->Std_model->get_std_base_w_roomid_return_array($room_id);
//            $output .= "<table class='table table-bordered table-hover' id='MyTable'>";
//            $output .= "<thead>";
//            $output .= "<tr style='background:#eeeeee;'>";
//            $output .= "<th style='width: 5%;text-align: center;' rowspan='3'>เลขที่</th> ";
//            $output .= "<th style='width: 10%;text-align: center;' rowspan='3'>รหัสนักเรียน</th>";
//
//            $output .= "<th style='width: 15%;text-align: center;' rowspan='3'>ชื่อ-นามสกุล</th>";
//
//            $course_work = $this->My_model->get_where_order("tb_course_work", array("tb_unit_learning_id" => $UnitList[0]['id']), "id asc");
//            $count = count($course_work);
//            $output .= "<th style='width: 15%;text-align: center;'  colspan='{$count}'>";
////        $output .= "หน่วยการเรียนรู้ที่ {$UnitList[0]['tb_unit_learning_sequence']} ({$UnitList[0]['tb_unit_learning_score']} คะแนน)";
//
//            $output .= "<select onchange='UnitOnChange(this)' class='form-control'>";
//            foreach ($UnitList as $rU) {
//                $output .= "<option value='{$rU['id']}'>หน่วยการเรียนรู้ที่ {$rU['tb_unit_learning_sequence']}</option>";
//            }
//            $output .= "</select>";
//
//            $output .= "</th>";
//            $output .= "<th style='width: 15%;text-align: center;'  rowspan='3'>คะแนนเต็มหน่วย<p>({$UnitList[0]['tb_unit_learning_score']} คะแนน)</p></th>";
//            $output .= "</tr>";
//
//            $output .= "<tr style='background:#eeeeee;'>";
//            foreach ($course_work as $rCW) {
//                $courseworkmaxscore += $rCW['tb_course_work_maxscore'];
//                $output .= "<th style='width: 15%;text-align: center;' >{$rCW['tb_course_work_name']} ({$rCW['tb_course_work_maxscore']} คะแนน)</th>";
//            }
//
//
//            $output .= "</tr>";
//
//
//
////            $output .= "<tr style='background:#eeeeee;'>";
////            $output .= "<th style='width: 15%;text-align: center;' >ว ๑.๑ ม.๑/๑</th>";
////            $output .= "<th style='width: 15%;text-align: center;' >ว ๑.๑ ม.๑/๒</th>";
////            $output .= "<th style='width: 15%;text-align: center;' >ว ๑.๑ ม.๑/๑</th>";
////            $output .= "<th style='width: 15%;text-align: center;' >ว ๑.๑ ม.๑/๒</th>";
////            $output .= "</tr>";
//
//
//            $output .= "</thead> ";
//
//            $output .= "<tbody id='MyTBody'>";
//            foreach ($student as $r) {
//                $stdscore = 0;
//                $output .= ""
//                        . "<tr>"
//                        . "<td style='text-align: center;'>" . $r['std_number'] . "</td>"
//                        . "<td style='text-align: center;'>" . $r['std_code'] . "</td>"
//                        . "<td style='text-align: center;'>" . $r['std_fullname'] . "</td>";
//
//                foreach ($course_work as $rCW) {
//                    $output .= "<td style='text-align: center;'>";
//                    $checker = $this->My_model->get_where_row("tb_std_course_work_score", array("tb_course_work_id" => $rCW['id'], "tb_student_base_id" => $r['StdId']));
//                    if ($checker) {
//                        $stdscore += $checker['tb_std_course_work_score_score'];
//                        $output .= "<input type='number' style='text-align:center;' value='{$checker['tb_std_course_work_score_score']}' id=\"" . $rCW['id'] . "," . $r['StdId'] . "\" onkeyup='InsertScore(this)' />";
//                    } else {
//                        $output .= "<input type='number' style='text-align:center;' value='' id=\"" . $rCW['id'] . "," . $r['StdId'] . "\" onkeyup='InsertScore(this)' />";
//                    }
//                    $output .= "</td>";
//                }
//                $output .= "<td style='text-align: center;' id='result{$r['StdId']}'>";
//                $result = 0;
//                if ($courseworkmaxscore > 0) {
//
//                    $result = ($UnitList[0]['tb_unit_learning_score'] * $stdscore) / $courseworkmaxscore;
//                }
//                $output .= round($result, 2) . "</td>";
//
//                $output .= "</tr>";
//            }
//            $output .= "</tbody> ";
//
//            $output .= "</table>";
//        } else {
//            $output .= "<h2 style='color:red;'>ยังไม่มีการตั้งค่าหน่วยการเรียนรู้</h2>";
//        }
//
//
//        $data['StudentBody'] = $output;
        $data['course'] = $this->Dcc_model->get_course_by_id($id);
        load_view($this, "teacher/teaching_task/teaching_task_course_pp5_fill_score_base", $data);
    }

    public function teaching_task_course_work_insert_score() {
//        $id = $this->input->post('id');
        $topicid = $this->input->post('topicid');
        $stdid = $this->input->post('stdid');
        $score = $this->input->post('score');

        $checker = $this->My_model->get_where_row('tb_course_work_kpi_std_score', array('tb_course_work_kpi_id' => $topicid, 'tb_student_base_id' => $stdid));


        $arr = array(
            "tb_course_work_kpi_std_score_score" => $score,
            "tb_course_work_kpi_id" => $topicid,
            "tb_student_base_id" => $stdid,
        );
        if (isset($checker['id'])) {
            $this->My_model->update_data('tb_course_work_kpi_std_score', array('id' => $checker['id']), $arr);
        } else {
            $this->My_model->insert_data('tb_course_work_kpi_std_score', $arr);
        }
        echo $score;
    }

    public function teaching_task_course_work_insert_score_reload() {
        
    }

    public function teaching_task_course_work_base_by_filter() {



        $unit_id = $this->input->post("unit_id");
        $unit_learning = $this->My_model->get_where_row("tb_unit_learning", array("id" => $unit_id));
        //----
        $id = $this->input->post('course_id');
        $room_id = $this->input->post("room_id");
        $output = "";
        $courseworkmaxscore = 0;




        //----- Student list
        $student = $this->Std_model->get_std_base_w_roomid_return_array($room_id);
        $output .= "<table class='table table-bordered table-hover' id='MyTable'>";
        $output .= "<thead>";
        $output .= "<tr style='background:#eeeeee;'>";
        $output .= "<th style='width: 5%;text-align: center;' rowspan='3'>เลขที่</th> ";
        $output .= "<th style='width: 10%;text-align: center;' rowspan='3'>รหัสนักเรียน</th>";

        $output .= "<th style='width: 15%;text-align: center;' rowspan='3'>ชื่อ-นามสกุล</th>";

        $course_work = $this->My_model->get_where_order("tb_course_work", array("tb_unit_learning_id" => $unit_learning['id']), "id asc");
        $count = count($course_work);
        $output .= "<th style='width: 15%;text-align: center;'  colspan='{$count}'>";
//        $output .= "หน่วยการเรียนรู้ที่ {$UnitList[0]['tb_unit_learning_sequence']} ({$UnitList[0]['tb_unit_learning_score']} คะแนน)";

        $output .= "<select onchange='UnitOnChange(this)' class='form-control'>";
        foreach ($UnitList as $rU) {
            if ($rU['id'] == $unit_id) {
                $output .= "<option value='{$rU['id']}' selected>หน่วยการเรียนรู้ที่ {$rU['tb_unit_learning_sequence']}</option>";
            } else {
                $output .= "<option value='{$rU['id']}'>หน่วยการเรียนรู้ที่ {$rU['tb_unit_learning_sequence']}</option>";
            }
        }
        $output .= "</select>";

        $output .= "</th>";
        $output .= "<th style='width: 15%;text-align: center;'  rowspan='3'>คะแนนเต็มหน่วย<p>({$unit_learning['tb_unit_learning_score']} คะแนน)</p></th>";
        $output .= "</tr>";

        $output .= "<tr style='background:#eeeeee;'>";
        $MyThirdRow = "";
        foreach ($course_work as $rCW) {
            $courseworkmaxscore += $rCW['tb_course_work_maxscore'];
            $output .= "<th style='text-align: center;' >{$rCW['tb_course_work_name']} ({$rCW['tb_course_work_maxscore']} คะแนน)</th>";
//            $output .= "<th style='width: 15%;text-align: center;'  rowspan='2'>({$rCW['tb_course_work_maxscore']} คะแนน)</th>";
        }


        $output .= "</tr>";

        $output .= "<tr style='background:#eeeeee;'>";
        foreach ($course_work as $rCW) {
            $work_kpi = $this->My_model->get_where_order("tb_course_work_kpi");
            $courseworkmaxscore += $rCW['tb_course_work_maxscore'];
            $output .= "<th style='text-align: center;' >{$rCW['tb_course_work_name']} </th>";
        }
        $output .= "</tr>";

        $output .= "</thead> ";

        $output .= "<tbody id='MyTBody'>";
        foreach ($student as $r) {
            $stdscore = 0;
            $output .= ""
                    . "<tr>"
                    . "<td style='text-align: center;'>" . $r['std_number'] . "</td>"
                    . "<td style='text-align: center;'>" . $r['std_code'] . "</td>"
                    . "<td style='text-align: center;'>" . $r['std_fullname'] . "</td>";

            foreach ($course_work as $rCW) {
                $output .= "<td style='text-align: center;'>";
                $checker = $this->My_model->get_where_row("tb_std_course_work_score", array("tb_course_work_id" => $rCW['id'], "tb_student_base_id" => $r['StdId']));
                if ($checker) {
                    $stdscore += $checker['tb_std_course_work_score_score'];
                    $output .= "<input type='number' style='text-align:center;' value='{$checker['tb_std_course_work_score_score']}' id=\"" . $rCW['id'] . "," . $r['StdId'] . "\" onkeyup='InsertScore(this)' />";
                } else {
                    $output .= "<input type='number' style='text-align:center;' value='' id=\"" . $rCW['id'] . "," . $r['StdId'] . "\" onkeyup='InsertScore(this)' />";
                }
                $output .= "</td>";
            }

            $output .= "<td style='text-align: center;' id='result{$r['StdId']}'><b>";
            $result = 0;
            if ($courseworkmaxscore > 0) {

                $result = ($unit_learning['tb_unit_learning_score'] * $stdscore) / $courseworkmaxscore;
            }
            $output .= round($result, 2) . "</b></td>";

            $output .= "</tr>";
        }
        $output .= "</tbody> ";

        $output .= "</table>";

        echo $output;
    }

    public function teaching_task_course_unit_base() {
        $course_detail_id = $this->input->get("course_detail_id");
        $term = $this->input->get("term");
        //----Course detail
        $course_detail = $this->My_model->get_where_row("tb_course_detail", array("id" => $course_detail_id,));

        $id = $course_detail['tb_course_id'];
        //----Unit
        $course = $this->Dcc_model->get_course_by_id($id);
        $data['course'] = $course;
        $output = "";


        $unit = $this->My_model->get_where_order('tb_unit_learning', array('tb_course_id' => $id, 'tb_unit_learning_term' => $term,), 'tb_unit_learning_sequence asc');
        if (count($unit)) {

            foreach ($unit as $unit) {
                $output .= "<tr style='vertical-align:top'>";
                $output .= "<td style='text-align:center;vertical-align:top;'>" . $unit['tb_unit_learning_sequence'] . "</td>";

                $output .= "<td style='text-align:center;vertical-align:top'>";
//            $output .= "<button style='float:right;margin:0px;' id='" . $unit['id'] . "' type='button' class='btn-link' ><i class='icon-trash icon-large'></i> </button> <button style='float:right;margin:0px;' id='" . $unit['id'] . "' type='button' class='btn-link' ><i class='icon-pencil icon-large'></i></button> <br/>";
                $output .= $unit['tb_unit_learning_name'];
                $output .= "</td>";


                if ($course['tb_subject_type'] == "พื้นฐาน") {

                    $output .= "<td style='text-align: left;padding:10px;'>";

                    $Indicators = $this->Dcc_model->get_kpi_by_unit_id($unit['id']);
                    if ($Indicators) {
                        foreach ($Indicators as $Indicators) {
//                    b.tb_standard_learning_code,\" \",a.tb_kpi_standard_learning_level,\"/\",a.tb_kpi_standard_learning_seq,\" \",
                            $output .= "<button style='float:right;margin:0px;' id='" . $Indicators['kpi_id'] . "' type='button' class='btn-link no-print' onclick='KpiDelete(this)'><i class='icon-trash icon-large' style='color:red;'></i></button> ";

                            $output .= $Indicators['tb_standard_learning_code'] . " " . $Indicators['tb_kpi_standard_learning_level'] . "/" . thaidigit($Indicators['tb_kpi_standard_learning_seq']) . " " . $Indicators['tb_kpi_standard_learning_content'] . "<br/><br/>";
                        }
                    }
                    $output .= "</td>";
                } else {
                    $output .= "<td style='text-align: left;padding:10px;'>";
                    $purpose = $this->Dcc_model->get_course_purpose_by_unitid($unit['id']);
                    if ($purpose) {
                        $ii = 1;
                        foreach ($purpose as $p) {
                            $output .= "<button style='float:right;margin:0px;' id='" . $p['id'] . "' type='button' class='btn-link' onclick='PurposeDelete(this)'><i class='icon-trash icon-large' style='color:red;'></i></button> ";
                            $output .= "<button style='float:right;margin:0px;' id='" . $p['id'] . "' type='button' class='btn-link' onclick='PurposeEdit(this)'><i class='icon-pencil icon-large' style='color:orange;'></i></button> ";

                            $output .= $p['tb_course_purpose_name'] . "<hr/>";
                            $ii++;
                        }
                    }
                    $output .= "</td>";
                }

                $output .= "<td style='text-align: left;vertical-align:top'>" . $unit['tb_unit_learning_content'] . "</td>";
                $output .= "<td style='text-align: center;'>" . $unit['tb_unit_learning_hour'] . "</td>";
                $output .= "<td style='text-align: center;'>" . $unit['tb_unit_learning_score'] . "</td>";
                $output .= "<td class='no-print' style='text-align: center;display:'>";
                $output .= "<button style='float:right;margin:0px;' id='" . $unit['id'] . "' type='button' class='btn-link' onclick='UnitDelete(this)'><i class='icon-trash icon-large' style='color:red;'></i></button> ";
                $output .= "<button style='float:right;margin:0px;' id='" . $unit['id'] . "' type='button' class='btn-link' onclick='UnitEdit(this)'><i class='icon-pencil icon-large' style='color:orange;'></i></button> ";

                if ($course['tb_subject_type'] == "พื้นฐาน") {
                    $output .= "<button style='float:right;margin:0px;' id='" . $unit['id'] . "' type='button' class='btn-link' onclick='UnitManage(this)'><i class='icon-plus icon-large' style='color:blue;'></i></button><br/><br/> ";
                } else {
                    $output .= "<button style='float:right;margin:0px;' id='" . $unit['id'] . "' type='button' class='btn-link' onclick='UnitManagePurpose(this)'><i class='icon-plus icon-large' style='color:blue;'></i></button><br/><br/> ";
                }

                $output .= "</td>";
                $output .= "</tr>";
            }
        }

        $output .= "<input type='hidden' id='inTerm' name='inTerm' value='{$term}'/>";

        $data['tbody'] = $output;
        $this->load->view("layout/header");
        $this->load->view("teacher/setting/teaching_task_course_unit_base", $data);
        $this->load->view("layout/footer");
    }

    public function get_course_detail_by_id() {
        echo json_encode($this->My_model->get_where_row('tb_course_detail', array('id' => $this->input->post('id'))));
    }

    public function get_teaching_task_course_work_by_unit_id() {
        $output = "";
        $unit_id = $this->input->post("id");
        $kpi = $this->Dcc_model->get_kpi_by_unit_id($unit_id);



        foreach ($kpi as $r) {

            $my_kpi = $r['tb_standard_learning_code'] . " " . $r['tb_kpi_standard_learning_level'] . "/" . $r['tb_kpi_standard_learning_seq'] . "";
            $output .= "<tr >";

            $output .= "<td style='width:25%'>";
            $output .= "<input type='checkbox' id='inMyKpiCheckbox[]' name='inMyKpiCheckbox[]' value='{$r['kpi_id']}' />";
            $output .= "</td>";
            $output .= "<td style='width:50%;font-size: 1.0em;' >{$my_kpi}</td>";
            $output .= "<td style='width:25%;'><input type='number' id='{$r['kpi_id']}' name='{$r['kpi_id']}' class='form-control'></td>";

            $output .= "</tr>";
        }
        echo $output;
    }

    function teaching_task_absent_record() {
        $course_id = $this->input->get("course_id");
        $room_id = $this->input->get("room_id");
        $data['course'] = $this->Dcc_model->get_course_by_id($course_id);
        $data['student'] = $this->Std_model->get_std_base_w_courseid_roomid_return_array($course_id, $room_id);
        load_view($this, 'teacher/teaching_task/teaching_task_absent_record', $data);
    }

    function teaching_task_cha() {
        $course_id = $this->input->get("course_id");
        $room_id = $this->input->get("room_id");
        $data['course'] = $this->Dcc_model->get_course_by_id($course_id);
        $data['student'] = $this->Std_model->get_std_base_w_courseid_roomid_return_array($course_id, $room_id);
        load_view($this, 'teacher/teaching_task/teaching_task_cha', $data);
    }

    function teaching_task_rwa() {
        $course_id = $this->input->get("course_id");
        $room_id = $this->input->get("room_id");
        $data['course'] = $this->Dcc_model->get_course_by_id($course_id);
        $data['student'] = $this->Std_model->get_std_base_w_courseid_roomid_return_array($course_id, $room_id);
        load_view($this, 'teacher/teaching_task/teaching_task_rwa', $data);
    }
    
    

    function course_todolist_base() {
        load_view($this, 'teacher/setting/course_todolist_base', null);
    }

    function teaching_task_work_assignment_base() {
        $course_id = $this->input->get("course_id");
        $room_id = $this->input->get("room_id");
        $data['course'] = $this->Dcc_model->get_course_by_id($course_id);
        $data['table'] = $this->get_work_assignment_by_unit_id($course_id, $room_id);
        load_view($this, 'teacher/teaching_task/teaching_task_work_assignment_base', $data);
    }

    function gen_work_assignment_by_unit_id() {
        $unit_id = $this->input->post("unit_id");
        $course_id = $this->input->post("course_id");
        $room_id = $this->input->post("room_id");
        echo $this->get_work_assignment_by_unit_id($course_id, $room_id, $unit_id);
    }

    public function get_work_assignment_by_unit_id($course_id, $room_id, $unit_id = null) {
        $output = "";
        $student = $this->Std_model->get_std_base_w_courseid_roomid_return_array($course_id, $room_id);
        $unit_learning = $this->My_model->get_where_order("tb_unit_learning", array("tb_course_id" => $course_id), "tb_unit_learning_sequence asc");
        $course_detail = $this->My_model->get_where_row("tb_course_detail", array("tb_course_id" => $course_id, "tb_human_resources_01_id" => $this->session->userdata("hr_id")));

        if ($unit_id == null) {
            $unit_id = $unit_learning[0]['id'];
        }

        $course_work = $this->My_model->get_where_order("tb_course_work", array("tb_unit_learning_id" => $unit_id, "tb_course_detail_id" => $course_detail['id']), "id asc");
        $count = count($course_work);
        $output .= "<table class='table table-bordered table-hover'>";
        $output .= "<thead >";
        $output .= "<tr style='background: #eee;'>";
        $output .= "<th style='text-align: center;width:5%;' rowspan='2'>ที่</th>";
        $output .= "<th style='text-align: center;width:10%;' rowspan='2'>รหัสนักเรียน</th>";
        $output .= "<th style='text-align: center;width:20%;' rowspan='2' class='hidden-xs'>ชื่อ-นามสกุล</th>";
        $output .= "<th style='text-align: center;' colspan='{$count}'>";
        $output .= "<select class='form-control' id='inUnitLearningId' name='inUnitLearningId' onchange='SelectThisUnit(this)'>";
        foreach ($unit_learning as $r) {
            if ($r['id'] == $unit_id) {
                $output .= "<option value='{$r['id']}' selected>หน่วยการเรียนรู้ที่ {$r['tb_unit_learning_sequence']}</option>";
            } else {
                $output .= "<option value='{$r['id']}' >หน่วยการเรียนรู้ที่ {$r['tb_unit_learning_sequence']}</option>";
            }
        }
        $output .= "</select>";
        $output .= "</th>";
        $output .= "</tr>";

        $output .= "<tr style='background: #eee;'>";

        foreach ($course_work as $r) {
            $output .= "<th style='text-align: center;'>";

            $output .= $r['tb_course_work_name'] . " (" . $r['tb_course_work_type'] . ") ";
            if ($r['tb_course_work_deadline'] != "" && $r['tb_course_work_deadline'] != null) {
                $date = datethaifull($r['tb_course_work_deadline']);
                $output .= "<p>{$date}<button type='button' class='btn btn-link' id='{$r['id']}' onclick='AsignThisWork(this)' style='color:orange;'><i class='icon-pencil icon-large'></i></button></p>";
            } else {
                $output .= "<br/><button type='button' class='btn btn-primary' id='{$r['id']}' onclick='AsignThisWork(this)'><i class='glyphicon glyphicon-saved '></i> มอบหมาย</button>";
            }
            $output .= "</th>";
        }

        $output .= "</tr>";

        $output .= "</thead>";

        $output .= "<tbody>";

        foreach ($student as $r) {
            $output .= "<tr>";
            $output .= "<td style='text-align:center;'>{$r['std_number']}</td>";
            $output .= "<td style='text-align:center;'>{$r['std_code']}</td>";
            $output .= "<td style='text-align:center;' class='hidden-xs'>{$r['std_fullname']}</td>";
            foreach ($course_work as $rW) {
                $checker = $this->My_model->get_where_row("tb_course_work_std_assignment", array("tb_course_work_id" => $rW['id'], "tb_student_base_id" => $r['StdId']));
                $output .= "<td style='text-align:center;'>";
                if (isset($checker['id'])) {
                    if ($checker['tb_course_work_std_assignment_status'] == 1) {
                        $output .= "<button type='button' class='btn btn-link' onclick='ShowStdWork(this)'><i class='icon-ok icon-large' style='color:green;'></i> ส่งแล้ว</button>";
                    } else {
//                        $output .= "<input type='file' class='filestyle' multiple='multiple' name='inExcellenceFile[]' id='inExcellenceFile[]' />";
                        $output .= "<button type='button' class='btn btn-link' onclick='SendStdWork(this)' id='{$checker['id']}' name='{$checker['id']}'><i class='icon-folder-open icon-large' style='color:orange;'></i> คลิกเพื่อส่งงาน</button>";
                    }
                } else {
                    $output .= "<i class='icon-remove icon-large' style='color:red;'></i>";
                }
                $output .= "</td>";
            }
            $output .= "</tr>";
        }


        $output .= " </tbody>";
        $output .= "</table>";




        return $output;
    }

    public function assign_work_to_student_by_work_id() {
        $work_id = $this->input->post("work_id");
        $deadline = $this->input->post("deadline");
        $arr = array(
            "tb_course_work_deadline" => $deadline,
        );
        $this->My_model->update_data('tb_course_work', array('id' => $work_id), $arr);

        $course_id = $this->input->post("course_id");
        $room_id = $this->input->post("room_id");
        $student = $this->Std_model->get_std_base_w_courseid_roomid_return_array($course_id, $room_id);

        foreach ($student as $r) {
            $checker = $this->My_model->get_where_row("tb_course_work_std_assignment", array("tb_course_work_id" => $work_id, "tb_student_base_id" => $r['StdId']));


            $arr = array(
                "tb_course_work_id" => $work_id,
                "tb_student_base_id" => $r['StdId'],
                "tb_course_work_std_assignment_status" => 0,
                "tb_course_work_std_assignment_recorder" => $this->session->userdata('name'),
                "tb_course_work_std_assignment_createdate" => date('Y-m-d')
            );

            if (isset($checker['id'])) {
                $this->My_model->update_data('tb_course_work_std_assignment', array("tb_course_work_id" => $work_id, "tb_student_base_id" => $r['StdId']), $arr);
            } else {
                $this->My_model->insert_data('tb_course_work_std_assignment', $arr);
            }
        }
    }

    public function get_course_work_by_id() {
        echo json_encode($this->My_model->get_where_row("tb_course_work", array("id" => $this->input->post("id"))));
    }

    public function course_student_result_base() {
        $id = $this->input->get('course_id');
        //----Course detail
        $data['course_detail'] = $this->My_model->get_where_row("tb_course_detail", array("tb_course_id" => $id, "tb_human_resources_01_id" => $this->session->userdata("hr_id")));

        $data['course'] = $this->Dcc_model->get_course_by_id($id);


        load_view($this, "teacher/teaching_task/teaching_task_student_result_base", $data);
    }

    public function send_student_work() {
        $arr = array(
            "tb_course_work_std_assignment_status" => 1,
        );

        $this->My_model->update_data('tb_course_work_std_assignment', array("id" => $this->input->post("id")), $arr);
    }

    public function get_work_list_by_unit_id() {
        $id = $this->input->post('id');
        $work = $this->My_model->get_where_order("tb_course_work", array("tb_unit_learning_id" => $id), "id asc");
        $output = "<option value=''>---เลือกข้อมูล---</option>";
        foreach ($work as $r) {
            $output .= "<option value='{$r['id']}'>{$r['tb_course_work_name']} ({$r['tb_course_work_maxscore']}) </option>";
        }
        echo $output;
    }

    public function gen_work_kpi_score_by_work_id() {
        $id = $this->input->post('id');
        $course_id = $this->input->post("course_id");
        $room_id = $this->input->post("room_id");
        $student = $this->Std_model->get_std_base_w_courseid_roomid_return_array($course_id, $room_id);

        $work = $this->My_model->get_where_row("tb_course_work", array("id" => $id));
        $work_kpi = $this->My_model->get_where_order("tb_course_work_kpi", array("tb_course_work_id" => $id), "id asc");
        $output = "";

        $count = count($work_kpi);

        $output .= "<table class='table table-bordered table-hover'>";
        $output .= "<thead >";
        $output .= "<tr style='background: #eee;'>";
        $output .= "<th style='text-align: center;width:5%;' rowspan='2'>ที่</th>";
        $output .= "<th style='text-align: center;width:10%;' rowspan='2'>รหัสนักเรียน</th>";
        $output .= "<th style='text-align: center;width:20%;' rowspan='2' class='hidden-xs'>ชื่อ-นามสกุล</th>";
        $output .= "<th style='text-align: center;' colspan='{$count}'>{$work['tb_course_work_name']}</th>";
        $output .= "<th style='text-align: center;width:5%;' rowspan='2'>เต็ม {$work['tb_course_work_maxscore']} คะแนน</th>";
        $output .= "</tr>";

        $output .= "<tr style='background: #eee;'>";
        foreach ($work_kpi as $r) {
            $output .= "<th style='text-align: center;'>";
            $output .= $r['tb_kpi_score_id'] . " (" . $r['tb_course_work_kpi_maxscore'] . ") ";
            $output .= "</th>";
        }
        $output .= "</tr>";

        $output .= "</thead>";

        $output .= "<tbody>";

        foreach ($student as $r) {
            $score = 0;
            $output .= "<tr>";
            $output .= "<td style='text-align:center;'>{$r['std_number']}</td>";
            $output .= "<td style='text-align:center;'>{$r['std_code']}</td>";
            $output .= "<td style='text-align:center;' class='hidden-xs'>{$r['std_fullname']}</td>";
            foreach ($work_kpi as $rW) {
                $output .= "<td style='text-align: center;'>";
                $checker = $this->My_model->get_where_row("tb_course_work_kpi_std_score", array("tb_student_base_id" => $r['StdId'], "tb_course_work_kpi_id" => $rW['id']));
                if (isset($checker["id"])) {
                    $output .= "<input type='number' name='{$rW['tb_course_work_kpi_maxscore']}' value={$checker['tb_course_work_kpi_std_score_score']} id=\"" . $rW['id'] . "," . $r['StdId'] . "\" onkeyup='InsertScore(this)'/>";
                    $score += $checker['tb_course_work_kpi_std_score_score'];
                } else {
                    $output .= "<input type='number' name='{$rW['tb_course_work_kpi_maxscore']}' id=\"" . $rW['id'] . "," . $r['StdId'] . "\" onkeyup='InsertScore(this)'/>";
                }


                $output .= "</td>";
            }
            $output .= "<td style='text-align:center;'>{$score}</td>";
            $output .= "</tr>";
        }


        $output .= " </tbody>";
        $output .= "</table>";


        echo $output;
    }

    function teaching_task_stat_print_base() {
        $course_id = $this->input->get("course_id");
        $room_id = $this->input->get("room_id");
        $data['course'] = $this->Dcc_model->get_course_by_id($course_id);
        $data['student'] = $this->Std_model->get_std_base_w_courseid_roomid_return_array($course_id, $room_id);
        load_view($this, 'teacher/teaching_task/teaching_task_stat_print', $data);
    }
}
