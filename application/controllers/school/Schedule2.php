<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/*
  | ----------------------------------------------------------------------------
  |  Title      Vichakarn
  | ----------------------------------------------------------------------------
  | Copyright	Edutech Co.,Ltd.
  | Purpose     Vichakarn Controller (School Zone)
  | Author
  | Create Date
  | Last edit	-
  | Comment	-
  | ----------------------------------------------------------------------------
 */

Class Schedule extends CI_Controller {

    public function __construct() {
        parent::__construct();
        if ($this->session->userdata('status') == '') {
            redirect('/');
        }
        $this->load->model("Ed_Classroom_model");
        $this->load->model("Dcc_model");
    }

    public function ed_schedule() {

        $data['course'] = $this->Ed_Classroom_model->get_all_course();
        $data['room'] = $this->Ed_Classroom_model->get_all();
        $data['hr'] = $this->Ed_Classroom_model->get_all_TA_available();
        $this->load->view("layout/header");
        $this->load->view("vichakarn/school/schedule", $data);
        $this->load->view('layout/footer');
    }

    public function ed_schedule_report() {

        $data['course'] = $this->Ed_Classroom_model->get_all_course();
        $data['roomDB'] = $this->Ed_Classroom_model->get_all();
        $data['hr'] = $this->Ed_Classroom_model->get_all_TA_available();
        $this->load->view("layout/header");
        $this->load->view("vichakarn/school/schedule_report", $data);
        $this->load->view('layout/footer');
    }

    public function ed_schedule_report_individual() {

        $data['course'] = $this->Ed_Classroom_model->get_all_course();
        $data['roomDB'] = $this->Ed_Classroom_model->get_all();
        $data['hr'] = $this->Ed_Classroom_model->get_all_TA_available();
        $this->load->view("layout/header");
        $this->load->view("vichakarn/school/schedule_report_individual", $data);
        $this->load->view('layout/footer');
    }

    public function ed_schedule_report_individual_list() {

        //$data['schedule'] = $this->Ed_Classroom_model->get_list_section_by_user($yearly, $term, $hr_id);
        $this->load->view("layout/header");
        $this->load->view("vichakarn/school/schedule_report_individual_list");
        $this->load->view('layout/footer');
    }

    public function ed_schedule_section() {
        if ($this->session->userdata('status') == '') {
            //redirect('login');
        }
        $data['course'] = $this->Ed_Classroom_model->get_all_course();
        $data['room'] = $this->Ed_Classroom_model->get_all();

        $data['section'] = $this->My_model->get_where_order('tb_ed_section', array('tb_ed_section_department' => $this->session->userdata("department")), 'tb_ed_section_class_sub');

        $this->load->view("layout/header");
        $this->load->view("vichakarn/school/schedule_section", $data);
        $this->load->view('layout/footer');
    }

    public function ed_schedule_section_edit() {
        $id = $this->input->post('id');
        $rs = $this->My_model->get_where_row('tb_ed_section', array('id' => $id));
        echo json_encode($rs);
    }
    
    public function ed_schedule_section_delete() {
        $id = $this->input->post('id');
        $this->My_model->delete_data('tb_ed_section', array('id' => $id));
    }
    
    public function ed_schedule_delete() {
        $id = $this->input->post('id');
        $this->My_model->delete_data('tb_ed_schedule', array('id' => $id));
    }

    public function ed_schedule_section_add() {
        $id = $this->input->post('id');

        if ($id != "") {
            $arr = array(
                "tb_ed_section_end" => $this->input->post('inSectionEnd'),
                "tb_ed_section_start" => $this->input->post('inSectionStart'),
                "tb_ed_section_class_sub" => $this->input->post('inSectionClassSub'),
//                "tb_ed_section_class" => $this->input->post('inSectionClass'),
            );
            $this->My_model->update_data('tb_ed_section', array('id' => $id), $arr);
        } else {
            $arr = array(
                "tb_ed_section_end" => $this->input->post('inSectionEnd'),
                "tb_ed_section_start" => $this->input->post('inSectionStart'),
                "tb_ed_section_class_sub" => $this->input->post('inSectionClassSub'),
//                "tb_ed_section_class" => $this->input->post('inSectionClass'),
                "tb_ed_section_department" => $this->session->userdata("department")
            );
            $this->My_model->insert_data("tb_ed_section", $arr);
        }
    }

    public function ed_schedule_teacher() {

        $data['courseD'] = $this->Ed_Classroom_model->get_all_teacher_course();
        $data['course'] = $this->Ed_Classroom_model->get_all_course();
        $arr = array();

        foreach ($data['course'] as $c) {
            $arr[$c['cid']] = $this->get_teacher($c['cid']);
        }
        $data['teacher_arr'] = $arr;
        $this->load->view("layout/header");
        $this->load->view("vichakarn/school/schedule_teacher", $data);
        $this->load->view('layout/footer');
    }

    public function ed_teacher_list_by_course() {
        if ($this->session->userdata('status') == '') {
            //redirect('login');
        }
        $data['sbj'] = $this->input->post('sbj');
        $code = $this->input->post('code');
        $data['id'] = $this->input->post('id');
        $data['teacher_d'] = $this->Ed_Classroom_model->get_teacher_course($code);
//        $data['teacher'] = $this->Ed_Classroom_model->get_all_teacher();
        $data['teacher'] = $this->Ed_Classroom_model->get_all_teacher_list();

        $this->load->view("vichakarn/school/schedule_teacher_list", $data);
    }

    public function ed_schedule_teacher_add() {
        $id = $this->input->post('cid');
        $hrid = $this->input->post('hr');

        $this->My_model->delete_data('tb_course_detail', array('tb_course_id' => $id));

        foreach ($hrid as $hr) {
            if (!$this->My_model->chk_valid_data('tb_course_detail', array('tb_human_resources_01_id' => $hr, 'tb_course_id' => $id))) {
                $arr = array(
                    'tb_human_resources_01_id' => $hr,
                    'tb_course_id' => $id
                );
                $this->My_model->insert_data("tb_course_detail", $arr);
            }
        }
    }

    public function get_teacher($param) {
        $rs = $this->My_model->join2table_where_result('tb_course_detail a', 'tb_human_resources_01 b', 'a.tb_human_resources_01_id=b.id', array('tb_course_id' => $param), 'tb_human_resources_01_id');
        $str = "";
        foreach ($rs as $r) {
            $str .= $r['hr_thai_symbol'] . ' ' . $r['hr_thai_name'] . ' ' . $r['hr_thai_lastname'] . '<br>';
        }
        return $str;
    }

    public function list_class() {
        
    }

    public function list_section() {
        $yearly = $this->input->post('yearly');
        $term = $this->input->post('eterm');
        $tmp = explode(' ', $this->input->post('lev'));
        $rid = $this->input->post('rid');
        if (sizeof($tmp) > 1) {
            $tt = str_replace('ปีที่', '', $tmp[0]);
            $lev = $tmp[1];

            $section = $this->My_model->get_where_order('tb_ed_section', array('tb_ed_section_department' => $this->session->userdata("department")), 'tb_ed_section_class_sub');

            $output = "";
            $sec = array();
            $day = 5;
            $output = "<thead>
                                    <tr>";
            $output .= "<th class=\"no-sort\" style=\"text-align: center;\">วัน</th>";
            foreach ($section as $s) {

                $output .= "<th class=\"no-sort\" style=\"text-align: center;\">คาบที่ " . $s['tb_ed_section_class_sub'] . "<br>" . $s['tb_ed_section_start'] . " - " . $s['tb_ed_section_end'] . "</th>";
                array_push($sec, $s['id']);
            }
            $output .= "</tr>
                                    </thead><tbody>";

            for ($i = 1; $i <= $day; $i++) {
                $output .= '<tr>';
                $output .= '<td style="text-align: center;">' . week_short_num($i, 'TH') . '</td>';
                for ($j = 1; $j <= sizeof($sec); $j++) {
                    $timetable = $this->Ed_Classroom_model->get_timetable($yearly, $tt, $lev, $rid, $term, $sec[$j - 1], $i);
//                    $timetable = $this->My_model->get_where_row('tb_ed_schedule', array('tb_ed_section_id' => $sec[$j-1], 'tb_ed_room_id' => $rid,'tb_ed_schedule_day'=>$i));
                    if (sizeof($timetable) > 0) {
                        $course = $this->Ed_Classroom_model->get_course_code_by_course_detail($timetable['tb_course_detail_id']);
                        $teacher = $this->My_model->join2table_row('tb_course_detail a', 'tb_human_resources_01 b', 'on a.tb_human_resources_01_id=b.id', array('a.id' => $timetable['tb_course_detail_id']));
                        $output .= '<td style="text-align: center;cursor:pointer;" id="' . week_short_num($i, '') . $j . '" onclick="delSec('. $timetable['schid'] . ',' . $sec[$j - 1] . ',' . $i . ',this);"  >' . $course['tb_course_code'] . '<br>' . $teacher['hr_thai_name'] . '</td>';
                    } else {

//                        $course = $this->Ed_Classroom_model->get_available_teacher_course($yearly, $tt, $lev, $sec[$j - 1], $i, $term);
                        $course = $this->Ed_Classroom_model->get_available_teacher_course_by_room($yearly, $tt, $lev, $sec[$j - 1], $i, $term,$rid);
                        $gl = "";
                        $output .= '<td style="text-align: center;" id="' . week_short_num($i, '') . $j . '">';

                        $output .= '<select name="inCourseSection" id="inCourseSection" onchange="updateSchedule(this,' . $sec[$j - 1] . ',' . $i . ');">';
                        $output .= '<option value="">--เลือกวิชา--</option>';

                        foreach ($course as $cd) {
                            if ($gl !== $cd['tb_course_code']) {
                                $gl = $cd['tb_course_code'];
                                $output .= '<optgroup label="' . $cd['tb_course_code'] . '">';
                            }
                            //if ($this->My_model->chk_valid_data('tb_ed_schedule', array('tb_ed_section_id' => $sec[$j - 1],'tb_ed_schedule_day'=>$dd))) {
                            $output .= '<option value="' . $cd['cdid'] . '">' . $cd['hr_thai_name'] . '</option>';
                            //}
                            if ($gl !== $cd['tb_course_code']) {
                                $gl = $cd['tb_course_code'];
                                $output .= '</optgroup>';
                            }
                        }


                        $output .= '</select>';
                        $output .= '</td>';
                    }
                }

                $output .= '</tr>';
            }

            $output .= "</tbody>";

            echo $output;
        }
    }

    public function list_section_report() {
        $yearly = $this->input->post('yearly');
        $term = $this->input->post('eterm');
        $tmp = explode(' ', $this->input->post('lev'));
        $rid = $this->input->post('rid');
        if (sizeof($tmp) > 1) {
            $tt = str_replace('ปีที่', '', $tmp[0]);
            $lev = $tmp[1];

            $section = $this->My_model->get_where_order('tb_ed_section', array('tb_ed_section_department' => $this->session->userdata("department")), 'tb_ed_section_class_sub');

            $output = "";
            $sec = array();
            $day = 5;
            $output = "<thead>
                                    <tr>";
            $output .= "<th class=\"no-sort\" style=\"text-align: center;\">วัน</th>";
            foreach ($section as $s) {

                $output .= "<th class=\"no-sort\" style=\"text-align: center;\">คาบที่ " . $s['tb_ed_section_class_sub'] . "</th>";
                array_push($sec, $s['id']);
            }
            $output .= "</tr>
                                    </thead><tbody>";

            for ($i = 1; $i <= $day; $i++) {
                $output .= '<tr>';
                $output .= '<td style="text-align: center;">' . week_short_num($i, 'TH') . '</td>';
                for ($j = 1; $j <= sizeof($sec); $j++) {

                    $timetable = $this->Ed_Classroom_model->get_timetable($yearly, $tt, $lev, $rid, $term, $sec[$j - 1], $i);
//                    $timetable = $this->My_model->get_where_row('tb_ed_schedule', array('tb_ed_section_id' => $sec[$j-1], 'tb_ed_room_id' => $rid,'tb_ed_schedule_day'=>$i));
                    if (sizeof($timetable) > 0) {
                        $course = $this->Ed_Classroom_model->get_course_code_by_course_detail($timetable['tb_course_detail_id']);
                        $teacher = $this->My_model->join2table_row('tb_course_detail a', 'tb_human_resources_01 b', 'on a.tb_human_resources_01_id=b.id', array('a.id' => $timetable['tb_course_detail_id']));
                        $output .= '<td style="text-align: center;" id="' . week_short_num($i, '') . $j . '">' . $course['tb_course_code'] . '<br>' . $teacher['hr_thai_name'] . '</td>';
                    } else {

                        $output .= '<td style="text-align: center;" id="' . week_short_num($i, '') . $j . '">';


                        $output .= '&nbsp;';
                        $output .= '</td>';
                    }
                }

                $output .= '</tr>';
            }

            $output .= "</tbody>";

            echo $output;
        }
    }

    public function list_section_report_print() {
        $yearly = $this->input->post('yearly');
        $term = $this->input->post('eterm');
        $tmp = explode(' ', $this->input->post('lev'));
        $rid = $this->input->post('rid');
        if (sizeof($tmp) > 1) {
            $tt = str_replace('ปีที่', '', $tmp[0]);
            $lev = $tmp[1];
            if (isset($tt)) {

                $section = $this->My_model->get_where_order('tb_ed_section', array('tb_ed_section_department' => $this->session->userdata("department")), 'tb_ed_section_class_sub');
            } else {
                $section = $this->My_model->get_where_order('tb_ed_section', array('tb_ed_section_department' => $this->session->userdata("department")), 'tb_ed_section_class_sub');
            }
            $output = "";
            $sec = array();
            $day = 5;
            $output = "<h2>ตารางสอน ปีการศึกษา " . $term . "/" . $yearly . "</h2>";
            $room = $this->My_model->get_where_row('tb_ed_room', array('id' => $rid));
            $output .= "<h3>ระดับชั้น " . $this->input->post('lev') . "/" . $room['tb_classroom_room'] . "</h3>";
            $output .= "<table width='100%' border='1' cellpadding='5' cellspacing='0'><thead>
                                    <tr>";
            $output .= "<th class=\"no-sort\" style=\"text-align: center;\">วัน</th>";
            foreach ($section as $s) {

                $output .= "<th class=\"no-sort\" style=\"text-align: center;\">คาบที่ " . $s['tb_ed_section_class_sub'] . "</th>";
                array_push($sec, $s['id']);
            }
            $output .= "</tr>
                                    </thead><tbody>";

            for ($i = 1; $i <= $day; $i++) {
                $output .= '<tr>';
                $output .= '<td style="text-align: center;">' . week_short_num($i, 'TH') . '</td>';
                for ($j = 1; $j <= sizeof($sec); $j++) {

                    $timetable = $this->Ed_Classroom_model->get_timetable($yearly, $tt, $lev, $rid, $term, $sec[$j - 1], $i);
//                    $timetable = $this->My_model->get_where_row('tb_ed_schedule', array('tb_ed_section_id' => $sec[$j-1], 'tb_ed_room_id' => $rid,'tb_ed_schedule_day'=>$i));
                    if (sizeof($timetable) > 0) {
                        $course = $this->Ed_Classroom_model->get_course_code_by_course_detail($timetable['tb_course_detail_id']);
                        $teacher = $this->My_model->join2table_row('tb_course_detail a', 'tb_human_resources_01 b', 'on a.tb_human_resources_01_id=b.id', array('a.id' => $timetable['tb_course_detail_id']));
                        $output .= '<td style="text-align: center;" id="' . week_short_num($i, '') . $j . '">' . $course['tb_course_code'] . '<br>' . $teacher['hr_thai_name'] . '</td>';
                    } else {

                        $output .= '<td style="text-align: center;" id="' . week_short_num($i, '') . $j . '">';


                        $output .= '&nbsp;';
                        $output .= '</td>';
                    }
                }

                $output .= '</tr>';
            }

            $output .= "</tbody></table>";

            echo $output;
        }
    }

    public function list_course() {
        if ($this->input->post('yearly') && $this->input->post('lev')) {
            $tmp = explode(' ', $this->input->post('lev'));
            if (sizeof($tmp) > 1) {
                // $arr = explode('/', $tmp[1]);
//                if ($this->My_model->chk_valid_data('tb_ed_schedule', array('tb_ed_room_id' => $this->input->post('rid')))) {
//                    $course = $this->Ed_Classroom_model->get_all_course_by($this->input->post('yearly'), str_replace('ปีที่', '', $tmp[0]), $tmp[1],$this->input->post('rid'));
//                }else{
                $course = $this->Ed_Classroom_model->get_all_course_by($this->input->post('yearly'), str_replace('ปีที่', '', $tmp[0]), $tmp[1], null, $this->input->post('eterm'));
//                }
                $output = "<thead>
                                    <tr>

                                        <th class=\"no-sort\">รหัสวิชา</th>
                                        <th class=\"no-sort\">วิชา</th>
                                        <th class=\"no-sort\">คาบ</th>
                                        <th class=\"no-sort\">คงเหลือ</th>
                                     
                                    </tr>
                                </thead>
                                <tbody>";
                foreach ($course->result() as $row) {
                    $output .= "<tr>";
                    $output .= "<td style='text-align: center'>" . $row->tb_course_code . "</td>";
                    $output .= "<td>" . $row->tb_subject_name . "</td>";
                    $output .= "<td>" . $row->tb_course_hour_week . "</td>";

                    $balance = $this->Ed_Classroom_model->get_course_credit_balance($row->cid, $this->input->post('rid'));
                    if (count($balance) > 0) {
                        $bal = (int) $balance['balance'];
                        $week = (int) $row->tb_course_hour_week;
                        $output .= "<td>" . ($week - $bal) . "</td>";
                    } else {
                        $output .= "<td>" . $row->tb_course_hour_week . "</td>";
                    }
                    $output .= "</tr>";
                }
                $output .= "</tbody>";
                echo $output;
            }
        }
    }

    public function update_schedule() {
        $cdid = $this->input->post('cdid');
        $sid = $this->input->post('sid');
        $rid = $this->input->post('rid');
        $dd = $this->input->post('dd');
        $term = $this->input->post('term');

        $arr = array(
            "tb_ed_section_id" => $sid,
            "tb_ed_room_id" => $rid,
            "tb_course_detail_id" => $cdid,
            "tb_ed_schedule_day" => $dd,
            "tb_ed_schedule_term" => $term,
            "tb_ed_schedule_department" => $this->session->userdata("department")
        );
        if ($sid != "") {

            if ($this->My_model->chk_valid_data('tb_ed_schedule', array('tb_ed_section_id' => $sid, 'tb_ed_schedule_day' => $dd, 'tb_ed_room_id' => $rid))) {
                $this->My_model->update_data('tb_ed_schedule', array('tb_ed_section_id' => $sid, 'tb_ed_schedule_day' => $dd), $arr);
            } else {
                $this->My_model->insert_data("tb_ed_schedule", $arr);
            }
        }
    }

    public function list_section_by_user() {
        $yearly = $this->input->post('yearly');
        $term = $this->input->post('eterm');
        $hr_id = $this->session->userdata('hr_id');

        $schedule = $this->Ed_Classroom_model->get_list_section_by_user($yearly, $term, $hr_id);
        $section = $this->My_model->get_where_order('tb_ed_section', array('tb_ed_section_department' => $this->session->userdata("department")), 'tb_ed_section_class_sub');
        $output = "";
        $sec = array();
        $day = 5;
        $output = "<thead>
                                    <tr>";
        $output .= "<th class=\"no-sort\" style=\"text-align: center;\">วัน</th>";
        foreach ($section as $s) {

            $output .= "<th class=\"no-sort\" style=\"text-align: center;\">คาบที่ " . $s['tb_ed_section_class_sub'] . "</th>";
            array_push($sec, $s['id']);
        }
        $output .= "</tr>
                                    </thead><tbody>";

        for ($i = 1; $i <= $day; $i++) {
            $output .= '<tr>';
            $output .= '<td style="text-align: center;">' . week_short_num($i, 'TH') . '</td>';
            for ($j = 1; $j <= sizeof($sec); $j++) {

                $output .= '<td style="text-align: center;">' . $schedule['tb_course_code'] . '<br>' . $teacher['hr_thai_name'] . '</td>';

                $output .= '</td>';
            }

            $output .= '</tr>';
        }

        $output .= "</tbody>";

        echo $output;
    }

    public function list_section_by_user_individual() {
        $yearly = $this->input->post('yearly');
        $term = $this->input->post('eterm');
        $hr_id = $this->session->userdata('hr_id');

        $schedule = $this->Ed_Classroom_model->get_list_section_by_user($yearly, $term, $hr_id);
        $output = "";
        $sec = array();

        $output = '<thead>
                                                <tr>

                                                    <th class="no-sort" style="text-align: center;">วัน</th>
                                                    <th class="no-sort" style="text-align: center;">คาบที่</th>
                                                    <th class="no-sort" style="text-align: center;">เวลา</th>
                                                    <th class="no-sort" style="text-align: center;">ระดับชั้น</th>
                                                    <th class="no-sort" style="text-align: center;">สถานที่</th>
                                                    <th class="no-sort" style="text-align: center;">วิชา</th>
                                                    <th class="no-sort" style="text-align: center;">&nbsp;</th>
                                                </tr>
                                            </thead><tbody>';


        foreach ($schedule as $sc) {
            $output .= '<tr>';
            $output .= '<td style="text-align: center;">' . week_short_num($sc['tb_ed_schedule_day'], 'TH') . '</td>';
            $output .= '<td style="text-align: center;">' . $sc['tb_ed_section_class_sub'] . '</td>';
            $output .= '<td style="text-align: center;">' . $sc['tb_ed_section_start'] . '</td>';
            $output .= '<td style="text-align: center;">' . $sc['class_short'] . '.' . $sc['lev'] . '/' . $sc['classroom'] . '</td>';
            $output .= '<td style="text-align: center;">&nbsp;</td>';
            $output .= '<td style="text-align: center;">' . $sc['tb_course_code'] . ' ' . $sc['sbj'] . '</td>';
            $output .= '<td style="text-align: center;"><span class="btn btn-success" year="' . $yearly . '" id="' . $sc['id'] . '"><i class="icon-save"></i> บันทึกการสอน</span></td>';
            $output .= '</tr>';
        }



//        for ($i = 1; $i <= $day; $i++) {
//            $output .= '<tr>';
//            $output .= '<td style="text-align: center;">' . week_short_num($i, 'TH') . '</td>';
//            for ($j = 1; $j <= sizeof($sec); $j++) {
//
//                $output .= '<td style="text-align: center;">' . $schedule['tb_course_code'] . '<br>' . $teacher['hr_thai_name'] . '</td>';
//
//                $output .= '</td>';
//            }
//
//            $output .= '</tr>';
//        }

        $output .= "</tbody>";

        echo $output;
    }
  
    
    
    public function get_course_by_term_edyear() {

        $term = $_POST['term'];
        $edyear = $_POST['edyear'];
        $edclass = $_POST['class'];
        $courselist = $this->Dcc_model->course_by_class_term_edyear($edclass, $term, $edyear);

       
        $output = "";
        
        $output = "<table class=\"table table-hover table-striped table-bordered display\" id=\"teacher\">";
        $output .= "<thead>";
        $output .= "            <tr>";
        $output .= "                <th class=\"no-sort\">ระดับชั้น</th>";
        $output .= "                <th class=\"no-sort\">รหัสวิชา</th>";
        $output .= "                <th class=\"no-sort\">ชื่อวิชา</th>";
        $output .= "                <th class=\"no-sort\">หน่วยกิต</th>";
        $output .= "                <th class=\"no-sort\">ครูผู้สอน</th>";
        $output .= "                <th style=\"width:13%;\" class=\"no-sort\"></th>";
        $output .= "            </tr>";
        $output .= "        </thead>";
        $output .= "        <tbody>";       

        
        $i = 1;
        if ($courselist) {
            foreach ($courselist as $r) {
                $output .= "<tr>";
                $output .= "<td style=\"text-align: center;width:20%\">" . $r['tb_ed_school_class_name'] . "ปีที่ " . $r['tb_ed_school_class_level'] . "</td>";
                $output .= "<td style=\"text-align: center;\">" . $r['tb_course_code'] . "</td>";
                $output .= "<td style=\"text-align: center;\">" . $r['tb_subject_name'] . "</td>";
                $output .= "<td style=\"text-align: center;\">" . $r['tb_course_credit'] . "</td>";
//                $output .= "<td style=\"text-align: center;\">" . $r['tb_course_hour_week'] . "</td>";
                $output .= '<td style="width:30%">'.$this->get_teacher($r['course_id']).'</td>';
                $output .= "<td style=\"text-align: center;\">";
                $output .= '<button type="button" class="btn btn-info btn-insert" sbj="'.$r['tb_subject_name'].'" code="'.$r['tb_course_code'].'" id="'.$r['course_id'].'"><i class="icon-plus icon-large"></i> เพิ่ม/แก้ไขครูผู้สอน</button>';
//                $output .= "&nbsp;<button type=\"button\" class=\"btn btn-info btn-result\" id=\"" . $r['course_id'] . "\" onclick=\"resultclick(this)\"><i class=\"icon-search icon-large\"></i> สรุป</button>";
//                $output .= "&nbsp;<button type=\"button\" class=\"btn btn-danger \" id=\"" . $r['course_id'] . "\" onclick=\"DeleteThisCourse(this)\"><i class=\"icon-trash icon-large\"></i> ลบ</button>";

                $output .= "</td>";
                $output .= "</tr>";
                $i++;
            }
        }
        $output .= "        </tbody>";
        $output .= "    </table>";

        echo $output;
    }

}
