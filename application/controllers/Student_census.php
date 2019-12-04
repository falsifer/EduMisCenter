<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/*
  | ----------------------------------------------------------------------------
  |  Title
  | ----------------------------------------------------------------------------
  | Copyright	Edutech Co.,Ltd.
  | Purpose     โมเดลนักเรียน
  | Author      chairatto
  | Create Date 22/11/2561
  | Last edit	8/3/2562
  | Comment	-
  | ----------------------------------------------------------------------------
 */

Class Student_census extends CI_Controller {

    public function __construct() {
        parent::__construct();
        if ($this->session->userdata('status') == "") {
            redirect("/");
        }
        $this->load->model("My_model");
        $this->load->model("Chairatto_model");
        $this->load->model("Std_model");
    }

    public function student_census_base() {
//        $list = $this->My_model->get_where_order('tb_student_base', array('std_status' => 'S'), 'id asc');
//        $output = "<tr>";
//        $output .= "";
//        foreach ($list as $r) {
//            $output .= "";
//        }
//        $school_id = $this->input->get('school_id');
//        $edyear = get_edyear();
//
//        $MySchoolArray = $this->Chairatto_model->select_column_where('tb_school', array('sc_under' => $school_id), 'id');
//        if (isset($MySchoolArray['id'])) {
////            print_r($MySchoolArray);
////            $Student_array = $this->Std_model->get_std_base_w_schoolid_edyear_return_array($MySchoolArray, $edyear);
//        } else {
////            $Student_array = $this->Std_model->get_std_base_w_schoolid_edyear_return_array($school_id, $edyear);
//        }
//        $output = "";
//
//        $i = 1;
//        foreach ($Student_array as $r) {
//
//            $output .= "<tr id='" . $r['StdId'] . "' style='cursor: pointer;text-align: center;' onclick='SelectThisStudent(this)'>";
//
//            $output .= "<td>" . $i . "</td>";
//            $output .= "<td>" . $r['std_code'] . "</td>";
//            $output .= "<td style='text-align: left;'><img src='" . $r['std_profile_picture'] . "' width='30px'/>&nbsp;" . $r['std_fullname'] . "</td>";
//            $output .= "<td>" . $r['std_age'] . " ปี</td>";
//            $output .= "<td>" . $r['std_classname'] . "/" . $r['std_room_number'] . "</td>";
//            $output .= "<td style='text-align: left;'>" . $r['std_school_name'] . "</td>";
//            $output .= "<td>" . $r['std_status'] . "</td>";
//
//            $output .= "</tr>";
//            $i++;
//        }

        $data['school'] = $this->My_model->get_where_order('tb_school', array('school_type_id !=' => 0), 'sc_thai_name asc');
//        $data['Student'] = $output;
        $this->load->view("layout/header");
        $this->load->view("student_census/student_census_base", $data);
        $this->load->view("layout/footer");
    }

    public function get_student_by_school_id() {
        $edyear = get_edyear();
        $school_id = $this->input->post('school_id');
        $Student_array = $this->Std_model->get_std_base_w_schoolid_edyear_return_array($school_id, $edyear);
        $output = "";


        $output .= "<table class='table table-bordered table-hover' id='StudentTable'>";
        $output .= "<thead>";
        $output .= "<tr style='background: #eeeeee;'>";
        $output .= "<th style='width: 5%;text-align: center;'>ที่</th>";
        $output .= "<th style='width: 10%;text-align: center;'>รหัสนักเรียน</th>";
        $output .= "<th style='width: 20%;text-align: center;'>ชื่อ-นามสกุล</th>";
        $output .= "<th style='width: 10%;text-align: center;'>อายุ</th>";
        $output .= "<th style='width: 15%;text-align: center;'>ระดับชั้น</th>";
        $output .= "<th style='width: 15%;text-align: center;'>โรงเรียน</th>";
        $output .= "<th style='width: 10%;text-align: center;'>ตรวจสอบ</th>";
        $output .= "<th style='width: 10%;text-align: center;'>สถานะ</th>";
        $output .= "</tr>";
        $output .= "</thead>";
        $output .= "<tbody id='StudentBody'>";

        $i = 1;
        foreach ($Student_array as $r) {
            $output .= "<tr id='" . $r['StdId'] . "' style='cursor: pointer;text-align: center;' onclick='SelectThisStudent(this)'>";
            $output .= "<td>" . $i . "</td>";
            $output .= "<td>" . $r['std_code'] . "</td>";
            $output .= "<td style='text-align: left;'><img src='" . $r['std_profile_picture'] . "' width='30px'/>&nbsp;" . $r['std_fullname'] . "</td>";
            $output .= "<td>" . $r['std_age'] . " ปี</td>";
            $output .= "<td>" . $r['std_classname'] . "/" . $r['std_room_number'] . "</td>";
            $output .= "<td style='text-align: left;'>" . $r['std_school_name'] . "</td>";

            if ($r['std_idcard'] != "") {
                $checker = $this->My_model->get_where_order('tb_student_base', array('std_idcard' => $r['std_idcard']), 'id asc');


                if (count($checker) > 1) {
                    $output .= "<td style='color:orange;'>มีเด็กซ้ำอยู่ในระบบ " . count($checker) . " คน</td>";
                } else {
                    $output .= "<td style='color:green;'>ไม่มีเด็กซ้ำ</td>";
                }
            } else {
                $output .= "<td style='color:red;'>ไม่มีเลขบัตร</td>";
            }


            $output .= "<td>" . $r['std_status'] . "</td>";
            $output .= "</tr>";
            $i++;
        }
        $output .= " </tbody> ";
        $output .= "</table> ";
        echo $output;
    }

    public function student_census_detail() {
        $id = $this->input->post('id');
        if ($id != "") {
            $Student = $this->Std_model->get_std_base_w_stdid_return_row($id);
            if ($Student) {
                $output = "";

                $output .= "<div style='margin-left: 15px;margin-right: 15px;padding:10px;'>";
                $output .= "<div style='float: left;width:30%;padding:5px;'>";
                $output .= "<center><img  src='" . $Student[0]['std_profile_picture'] . "' style='width:120px;' /></center>";
                $output .= "</div>";
                $output .= "<div style='float: left;width:70%;padding:5px;font-size:1em;'>";
                $output .= "<p>ชื่อ <strong>" . $Student[0]['std_fullname'] . "</strong> รหัสนักเรียน <strong>" . $Student[0]['std_code'] . "</strong></p>";
                $output .= "<p></p>";
                $output .= "<p>ระดับชั้น <strong>" . $Student[0]['std_classname'] . "</strong></p>";
                $output .= "</div> ";
                $output .= "<div style='clear:both;'></div>";
                $output .= "</div>";
                $output .= "<hr/>";

                $output .= "<div style='margin-left: 15px;margin-right: 15px;padding:10px;'>";
//                $output .= "<fieldset>";
                $output .= "<legend >ข้อมูลที่อยู่</legend>";
                $Address1 = $this->My_model->get_where_order('tb_std_address', array('std_id' => $id), 'add_createdate asc');
                foreach ($Address1 as $a1) {
                    $output .= "<p> บ้านเลขที่ <b>" . $a1['add_no'] . "</b> หมู่ที่ <b>" . $a1['add_moo'] . "</b>";
                    $output .= " หมู่บ้าน <b>" . $a1['add_village'] . "</b> ถนน <b>" . $a1['add_road'] . "</b>";
                    $output .= " ตำบล <b>" . $a1['add_tambol'] . "</b> อำเภอ <b>" . $a1['add_amphur'] . "</b> จังหวัด <b>" . $a1['add_province'] . "</b></p>";
                    $output .= "<hr/>";
                }
//                $output .= "<fieldset/>";
                $output .= "<div style='clear:both;'></div>";
                $output .= "</div>";


                $father = $this->Std_model->get_outsider_by_stdid_about_return_row($id, 'บิดา');
                $output .= "<div style='margin-left: 15px;margin-right: 15px;padding:20px;'>";
//                $output .= "<fieldset>";
                $output .= "<h4>ข้อมูลบิดา</h4>";
                $output .= "&nbsp;&nbsp;&nbsp;&nbsp;<p> ชื่อ <b>" . $father['outsider_fullname'] . "</b>";
                $output .= "<p/>";
//                $output .= "<fieldset/>";
//                $output .= "<div style='clear:both;'></div>";
                $output .= "</div>";

                $mother = $this->Std_model->get_outsider_by_stdid_about_return_row($id, 'มารดา');
                $output .= "<div style='margin-left: 15px;margin-right: 15px;padding:20px;'>";
//                $output .= "<fieldset>";
                $output .= "<h4>ข้อมูลมารดา</h4>";
                $output .= "&nbsp;&nbsp;&nbsp;&nbsp;<p> ชื่อ <b>" . $mother['outsider_fullname'] . "</b>";
                $output .= "<p/>";
//                $output .= "<fieldset/>";
//                $output .= "<div style='clear:both;'></div>";
                $output .= "</div>";
            }
        }

        echo $output;
    }

}
