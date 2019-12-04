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
  | Create Date
  | Last edit	-
  | Comment	-
  | ----------------------------------------------------------------------------
 */

Class PP6 extends CI_Controller {

    public function __construct() {
        parent::__construct();
        if ($this->session->userdata('status') == "") {
            redirect("/");
        }
        $this->load->model('My_model');
        $this->load->model('StdScore_model');
        $this->load->model('Dcc_model');
        $this->load->model('Std_model');
    }

    public function get_std_pp6() {
        $output = "";
        $term = $_POST['term'];
        $edyear = $_POST['edyear'];
        $StdId = $_POST['stdid'];
        $Course = $this->Dcc_model->get_register_course_by_year_term_stdid($term, $edyear, $StdId);
        $Student = $this->Std_model->get_std_base_w_stdid($StdId);

        $output .= "<div style='width:850px;height: 1223px;padding: 10px;' >";
        $output .= "<div style='text-align:right'>ปพ.6</div>";
        $output .= "<center>";
        $output .= "<img src='" . base_url() . "upload/ExampleSchoolLogo.png' style='width: 100px;height: 100px;margin: 0px;'/>";
        $output .= "<p style='text-align:center;margin: 0px;'><span style='font-size:1em'>" . $this->session->userdata('deparment') . "</span></p>";
        $output .= "</center>";
        $output .= "<p style='text-align:center;margin: 0px;'><span style='font-size:1em'>แบบรายงานผลการพัฒนาผู้เรียนรายบุคคล</span></p>";
        $output .= "<p style='text-align:center;margin: 0px;'><span style='font-size:0.85em'>";

        $output .= "&nbsp;ระดับชั้น <span style='line-height:20px;border-bottom: 1px dashed #ccc;font-weight: bold;'>" . $Student['std_classname'] . "</span>";
        $output .= "&nbsp;ปีการศึกษา <span style='line-height:20px;border-bottom: 1px dashed #ccc;font-weight: bold;'>" . $Student['std_edyear'] . "</span> ";
        $output .= "&nbsp;เลขประจำตัวนักเรียน <span style='line-height:20px;border-bottom: 1px dashed #ccc;font-weight: bold;'>" . $Student['std_code'] . "</span>";
        $output .= "&nbsp;ชื่อ-ชื่อสกุล <span style='line-height:20px;border-bottom: 1px dashed #ccc;font-weight: bold;'>" . $Student['std_fullname'] . "</span>";
        $output .= "&nbsp;ห้องที่ <span style='line-height:20px;border-bottom: 1px dashed #ccc;font-weight: bold;'>" . $Student['std_room_number'] . "</span>";
        $output .= "&nbsp;เลขที่ <span style='line-height:20px;border-bottom: 1px dashed #ccc;font-weight: bold;'>" . $Student['std_number'] . "</span>";

        $output .= "</span></p>";
        $output .= "<hr/>";

        if ($Course) {
            $output .= "<center>";
            $output .= "<table class='table-bordered' id='ScoreTable'>";
            $output .= "<thead>";
            $output .= "<tr style='height:50px;background: whitesmoke;'> ";
            $output .= "<th class='no-sort' style='width:5%;text-align: center;'>ที่</th>";
            $output .= "<th class='no-sort' style='width:10%;text-align: center;'>รหัสวิชา</th>";
            $output .= "<th class='no-sort' style='width:40%;text-align: center;'>รายวิชา</th>";
            $output .= "<th class='no-sort' style='width:10%;text-align: center;'>ประเภท</th>";
            $output .= "<th class='no-sort' style='width:10%;text-align: center;'>น้ำหนัก/เวลา</th>";
            $output .= "<th class='no-sort' style='width:10%;text-align: center;'>คะแนน</th>";
            $output .= "<th class='no-sort' style='width:15%;text-align: center;'>ผลการเรียน</th>";
            $output .= "<th class='no-sort' style='width:10%;text-align: center;'>หมายเหตุ</th>";
            $output .= "</tr>";
            $output .= "</thead>";
            $output .= "<tbody>";

            $i = 1;
            $Credit1 = 0;
            $Credit2 = 0;
            $Grade = 0;
            
            foreach ($Course as $r) {
                $output .= "<tr style='height: 30px;'>";
                $output .= "<td style='width:5%;text-align: center;'>" . $i . "</td>";
                $output .= "<td style='width:10%;text-align: center;'>" . $r['tb_course_code'] . "</td>";
                $output .= "<td style='width:40%;text-align: center;'>" . $r['tb_subject_name'] . "</td>";
                $output .= "<td style='width:10%;text-align: center;'>" . $r['tb_subject_type'] . "</td>";
                
                if ($r['tb_subject_type'] == "พื้นฐาน") {
                    $Credit1 += $r['tb_course_credit'];
                    $output .= "<td style='width:10%;text-align: center;'>" . $r['tb_course_credit'] . "</td>";
                } elseif($r['tb_subject_type'] == "เพิ่มเติม") {
                    $Credit2 += $r['tb_course_credit'];
                    $output .= "<td style='width:10%;text-align: center;'>" . $r['tb_course_credit'] . "</td>";
                }elseif($r['tb_subject_type'] == "กิจกรรม"){
                     $output .= "<td style='width:10%;text-align: center;'>" . $r['tb_course_hour_term'] . "</td>";
                }
                $MidScore = $this->StdScore_model->get_std_course_midterm_score($StdId, $r['ed_course_id']);
                $FinalScore = $this->StdScore_model->get_std_course_final_score($StdId, $r['ed_course_id']);
                $StdScore = $MidScore + $FinalScore;

                $output .= "<td style='width:10%;text-align: center;'>";
                $output .= $StdScore;
                $output .= "</td>";

                $output .= "<td style='width:15%;text-align: center;'>";
                $output .= StudentGrade($StdScore);
                $output .= "</td>";
                $output .= "<td style='width:10%;text-align: center;'></td>";

                $output .= "</tr>";
                $i++;
            }
            $output .= "</tbody>";
            $output .= "</table>";
            $output .= "</center>";
            $output .= "<hr/>";
        }

        $output .= "<center>";
        $output .= "<table class='table-bordered display' style='width:40%;margin-left:10%;margin-right:50px;float: left;'>";
        $output .= "<thead>";
        $output .= "<tr style='height:40px;background: whitesmoke;'> ";
        $output .= "<th style='width:100%;text-align: center;font-size: 1.1em;' colspan='2'>สรุปผลการประเมิน</th>";
        $output .= "</tr>";
        $output .= "</thead>";
        $output .= "<tbody>";
        $output .= "<tr style='height: 30px;'> ";
        $output .= "<td style='width:80%;text-align: center;'>น้ำหนักวิชาพื้นฐาน</td> ";
        $output .= "<td style='width:20%;text-align: center;'>" . $Credit1 . "</td> ";
        $output .= "</tr>";
        $output .= "<tr style='height: 30px;'> ";
        $output .= "<td style='width:80%;text-align: center;'>น้ำหนักวิชาเพิ่มเติม</td>";
        $output .= "<td style='width:20%;text-align: center;'>" . $Credit2 . "</td> ";
        $output .= "</tr>";
        $output .= "<tr style='height: 30px;'> ";
        $output .= "<td style='width:80%;text-align: center;'>ระดับผลการเรียนเฉลี่ย</td>";
        $output .= "<td style='width:20%;text-align: center;'>" . $Grade . "</td> ";
        $output .= "</tr>";
        $output .= "</tbody>";
        $output .= "<thead>";
        $output .= "<tr style='height:40px;background: whitesmoke;'>";
        $output .= "<th style='width:100%;text-align: center;font-size: 1.1em;' colspan='2'>ผลการประเมินคุณลักษณะอันพึงประสงค์</th>";
        $output .= "</tr>";
        $output .= "</thead>";
        $output .= "<tbody>";
        $output .= "<tr style='height: 30px;'> ";
        $output .= "<td style='width:80%;text-align: center;'>คุณลักษณะอันพึงประสงค์</td>  ";
        $output .= "<td style='width:20%;text-align: center;'>ไม่ผ่าน</td> ";
        $output .= "</tr>";
        $output .= "<tr style='height: 30px;'> ";
        $output .= "<td style='width:80%;text-align: center;'>การอ่าน คิดวิเคราะห์และเขียน</td> ";
        $output .= "<td style='width:20%;text-align: center;'>ไม่ผ่าน</td>";
        $output .= "</tr>";
        $output .= "<tr style='height: 30px;'> ";
        $output .= "<td style='width:80%;text-align: center;'>กิจกรรมพัฒนาผู้เรียน</td> ";
        $output .= "<td style='width:20%;text-align: center;'>ไม่ผ่าน</td>";
        $output .= "</tr>";
        $output .= "</tbody>";
        $output .= "</table>";
        $output .= "<div style='width:30%;float: left;margin-right: 10%;'>";
        $output .= "<img src='" . base_url() . "upload/aceee9f66a9c704cffdb43e90227581e.png' style='width: 120px;'/>";
        $output .= "<p style='text-align:center;margin: 0px;'>";
        $output .= "(<span style='font-size:0.9em;line-height:20px;border-bottom: 1px dashed #ccc;font-weight: bold;'>นายพงพสฟห คงนพรฟห</span>)";
        $output .= "</p>";
        $output .= "<p style='text-align:center;margin: 0px;'>";
        $output .= "<span style='font-size:1em;'>ครูประจำชั้น</span> ";
        $output .= "</p>";
        $output .= "<br/>";
        $output .= "</div>";
        $output .= "</center>";

        $output .= "</div>";
        echo $output;
    }

}
