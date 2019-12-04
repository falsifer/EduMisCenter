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
  | Create Date 27/4/2562
  | Last edit	27/4/2562
  | Comment	-
  | ----------------------------------------------------------------------------
 */

Class School_registration extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model("My_model");
        $this->load->model("Std_model");
    }

//---------เรียก View---------//
    public function school_registration_base() {
        $this->load->view("layout/header");
        $this->load->view("school_registration/school_registration_base");
        $this->load->view("layout/footer");
    }

//-------- End view -------// 

    public function student_list() {
        $this->load->view("layout/header");
        $this->load->view("school_registration/school_registration_base");
        $this->load->view("layout/footer");
    }

    public function get_student_list_by_filter() {
        $rid = $_POST['rid'];
        $cid = $_POST['cid'];
        $edyear = $_POST['edyear'];
        $StdStatus = "";

        $StdArr = $this->Std_model->get_std_base_w_filter($rid, $cid, $edyear, $StdStatus);
        $output = "";
        if ($StdArr) {
            foreach ($StdArr as $row) {
                $output .= "<tr class='trrow' id='" . $row->StdId . "' >";
                $output .= "<td style=\"text-align:center;\">" . $row->std_number . "</td>";
                $output .= "<td style=\"text-align:center;\">" . $row->std_code . "</td>";
                $output .= "<td style=\"text-align:center;\">" . $row->std_fullname . "</td>";

                $output .= "<td style=\"text-align: center;\">" . $row->std_classname . "/" . $row->std_room_number . "</td>";

                $output .= "<td style=\"text-align: center;\">";

                switch ($row->tb_student_base_status) {
                    case "S":
                        $output .= "<font color='green'>กำลังศึกษาอยู่</font>";
                        break;
                    case "G":
                        $output .= "<font color='blue'>จบการศึกษา</font>";
                        break;
                    case "C":
                        $output .= "<font color='red' >ลบออกจากระบบ</font>";
                        break;
                    case "W":
                        $output .= "<font color='orange'>ยังไม่ได้รับการศึกษา</font>";
                        break;
                }
                $output .= "</td>";
                $output .= "<td style=\"text-align: center;\">";
                $output .= "<label class='containerzz' >";
                $output .= "<input type='checkbox' name='c' value='C' id='c' onchange='clearcheck(this)'/>";
                $output .= "<span class='checkmark'></span>";
                $output .= "</label>";
                $output .= "</td>";
                $output .= "</tr>";
            }
        }
        echo $output;
    }

    public function get_std_pp1() {
        $this->load->view('school_registration/report/pp1');
    }
    
    public function get_std_pp2() {
        $this->load->view('school_registration/report/pp2');
    }
    
    public function get_std_pp3() {
        $this->load->view('school_registration/report/pp3');
    }
    
    public function get_std_pp6() {
        $this->load->view('school_registration/report/pp6');
    }
    
    public function get_std_pp7() {

        $this->load->view('school_registration/report/pp7');
    }

    public function get_std_pp4() {
        $output = "";

        $output .= "<div style='width:850px;height: 1235px;padding: 10px;' >";
        $output .= "<p style='text-align:center;margin: 0px;'><span style='font-size:1em'>แบบบันทึกการพัฒนาคุณลักษณะอันพึงประสงค์</span><span class='pull-right'>ปถ.๐๔</span></p>";
        $output .= "<p style='text-align:center;margin: 0px;'>";
        $output .= "<span style='font-size:0.85em'>";
        $output .= "ระดับชั้นประถมศึกษา ปีการศึกษา<span style='line-height:20px;border-bottom: 1px dashed #ccc;font-weight: bold;'> 2562</span>";
        $output .= "ถึง ปีการศึกษา <span style='line-height:20px;border-bottom: 1px dashed #ccc;font-weight: bold;'>2562</span>";
        $output .= "</span>";
        $output .= "</p>";
        $output .= "<p style='text-align:center;margin: 0px;'>";
        $output .= "<span style='font-size:0.85em'>";
        $output .= "ชื่อนักเรียน<span style='line-height:20px;border-bottom: 1px dashed #ccc;font-weight: bold;'> นายชัยรัธโต้ อ่วมอารีย์</span>";
        $output .= "ชั้น <span style='line-height:20px;border-bottom: 1px dashed #ccc;font-weight: bold;'> ประถมศึกษาปีที่ 6</span>";
        $output .= "โรงเรียน <span style='line-height:20px;border-bottom: 1px dashed #ccc;font-weight: bold;'> วัดเขมาภิรตาราม</span>";
        $output .= "</span>";
        $output .= "</p>";
        $output .= "<hr/>";
        $output .= "<center>";
        $output .= "<table class='table table-bordered display' style='width:90%;'>";
        $output .= "<thead>";

        $output .= "<tr style='height:50px;background: whitesmoke;'>";
        $output .= "<th class='no-sort' style='width:10%;text-align: center;'>คุณลักษณะอันพึงประสงค์</th>";
        $output .= "<th class='no-sort' style='width:10%;text-align: center;' >ระดับคุณภาพ</th>";
        $output .= "<th class='no-sort' style='width:65%;text-align: center;' colspan='12'>ความก้าวหน้าการพัฒนาคุณลักษณะอันพึงประสงค์</th>";
        $output .= "<th class='no-sort' style='width:15%;text-align: center;' rowspan='3'>สรุประดับคุณภาพ</th>";
        $output .= "</tr>";

        $output .= "<tr style='height:50px;background: whitesmoke;'> ";
        $output .= "<th class='no-sort' style='text-align: center;' colspan='2'>ชั้นประถมศึกษาปีที่</th>";
        $output .= "<th class='no-sort' style='text-align: center;' colspan='2'>1</th>";
        $output .= "<th class='no-sort' style='text-align: center;' colspan='2'>2</th>";
        $output .= "<th class='no-sort' style='text-align: center;' colspan='2'>3</th>";
        $output .= "<th class='no-sort' style='text-align: center;' colspan='2'>4</th>";
        $output .= "<th class='no-sort' style='text-align: center;' colspan='2'>5</th>";
        $output .= "<th class='no-sort' style='text-align: center;' colspan='2'>6</th>";
        $output .= "</tr>";

        $output .= "<tr style='height:50px;background: whitesmoke;'> ";
        $output .= "<th class='no-sort' style='text-align: center;' colspan='2'>ภาคเรียนที่</th>";
        $output .= "<th class='no-sort' style='text-align: center;' >1</th>";
        $output .= "<th class='no-sort' style='text-align: center;' >2</th>";
        $output .= "<th class='no-sort' style='text-align: center;' >1</th>";
        $output .= "<th class='no-sort' style='text-align: center;' >2</th>";
        $output .= "<th class='no-sort' style='text-align: center;' >1</th>";
        $output .= "<th class='no-sort' style='text-align: center;' >2</th>";
        $output .= "<th class='no-sort' style='text-align: center;' >1</th>";
        $output .= "<th class='no-sort' style='text-align: center;' >2</th>";
        $output .= "<th class='no-sort' style='text-align: center;' >1</th>";
        $output .= "<th class='no-sort' style='text-align: center;' >2</th>";
        $output .= "<th class='no-sort' style='text-align: center;' >1</th>";
        $output .= "<th class='no-sort' style='text-align: center;' >2</th>";
        $output .= "</tr>";
        $output .= "</thead>";
        $output .= "</table>";
        $output .= "</center>";
        $output .= "<hr/>";
        $output .= "</div>";

        echo $output;
    }

    public function get_std_pt2() {
        $output = "";

        $output .= "<div style='width:850px;height: 1235px;padding: 10px;' >";
        $output .= "<p style='text-align:center;margin: 0px;'><span style='font-size:1em'>แบบบันทึกการพัฒนาการอ่านคิดวิเคราะห์เขียน</span><span class='pull-right'>ปถ.๐๒</span></p>";
        $output .= "<p style='text-align:center;margin: 0px;'>";
        $output .= "<span style='font-size:0.85em'>";
        $output .= "ระดับชั้นประถมศึกษา ปีการศึกษา<span style='line-height:20px;border-bottom: 1px dashed #ccc;font-weight: bold;'> 2562</span>";
        $output .= "ถึง ปีการศึกษา <span style='line-height:20px;border-bottom: 1px dashed #ccc;font-weight: bold;'>2562</span>";
        $output .= "</span>";
        $output .= "</p>";
        $output .= "<p style='text-align:center;margin: 0px;'>";
        $output .= "<span style='font-size:0.85em'>";
        $output .= "ชื่อนักเรียน<span style='line-height:20px;border-bottom: 1px dashed #ccc;font-weight: bold;'> นายชัยรัธโต้ อ่วมอารีย์</span>";
        $output .= "ชั้น <span style='line-height:20px;border-bottom: 1px dashed #ccc;font-weight: bold;'> ประถมศึกษาปีที่ 6</span>";
        $output .= "โรงเรียน <span style='line-height:20px;border-bottom: 1px dashed #ccc;font-weight: bold;'> วัดเขมาภิรตาราม</span>";
        $output .= "</span>";
        $output .= "</p>";
        $output .= "<hr/>";
        $output .= "<center>";
        $output .= "<table class='table table-bordered display' style='width:90%;'>";
        $output .= "<thead>";

        $output .= "<tr style='height:50px;background: whitesmoke;'>";
        $output .= "<th class='no-sort' style='width:10%;text-align: center;'>อ่านคิดวิเคราะห์เขียน</th>";
        $output .= "<th class='no-sort' style='width:10%;text-align: center;' >ระดับคุณภาพ</th>";
        $output .= "<th class='no-sort' style='width:65%;text-align: center;' colspan='12'>ความก้าวหน้าการพัฒนาคุณลักษณะอันพึงประสงค์</th>";
        $output .= "<th class='no-sort' style='width:15%;text-align: center;' rowspan='3'>สรุประดับคุณภาพ</th>";
        $output .= "</tr>";

        $output .= "<tr style='height:50px;background: whitesmoke;'> ";
        $output .= "<th class='no-sort' style='text-align: center;' colspan='2'>ชั้นประถมศึกษาปีที่</th>";
        $output .= "<th class='no-sort' style='text-align: center;' colspan='2'>1</th>";
        $output .= "<th class='no-sort' style='text-align: center;' colspan='2'>2</th>";
        $output .= "<th class='no-sort' style='text-align: center;' colspan='2'>3</th>";
        $output .= "<th class='no-sort' style='text-align: center;' colspan='2'>4</th>";
        $output .= "<th class='no-sort' style='text-align: center;' colspan='2'>5</th>";
        $output .= "<th class='no-sort' style='text-align: center;' colspan='2'>6</th>";
        $output .= "</tr>";

        $output .= "<tr style='height:50px;background: whitesmoke;'> ";
        $output .= "<th class='no-sort' style='text-align: center;' colspan='2'>ภาคเรียนที่</th>";
        $output .= "<th class='no-sort' style='text-align: center;' >1</th>";
        $output .= "<th class='no-sort' style='text-align: center;' >2</th>";
        $output .= "<th class='no-sort' style='text-align: center;' >1</th>";
        $output .= "<th class='no-sort' style='text-align: center;' >2</th>";
        $output .= "<th class='no-sort' style='text-align: center;' >1</th>";
        $output .= "<th class='no-sort' style='text-align: center;' >2</th>";
        $output .= "<th class='no-sort' style='text-align: center;' >1</th>";
        $output .= "<th class='no-sort' style='text-align: center;' >2</th>";
        $output .= "<th class='no-sort' style='text-align: center;' >1</th>";
        $output .= "<th class='no-sort' style='text-align: center;' >2</th>";
        $output .= "<th class='no-sort' style='text-align: center;' >1</th>";
        $output .= "<th class='no-sort' style='text-align: center;' >2</th>";
        $output .= "</tr>";
        $output .= "</thead>";
        $output .= "</table>";
        $output .= "</center>";
        $output .= "<hr/>";
        $output .= "</div>";

        echo $output;
    }

}
