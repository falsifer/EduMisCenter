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
  | Create Date 22/4/2562
  | Last edit	22/4/2562
  | Comment	-
  | ----------------------------------------------------------------------------
 */

Class Student_self extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model("My_model");
        $this->load->model("Dcc_model");
        $this->load->model("StdScore_model");
    }

//----------------ข้อมูลนักเรียน-------------------------------//    
//---------เรียก View---------//
    public function student_self_score() {

        $this->load->view("layout/header_std");
        $this->load->view("student_self/student_self_score");
        $this->load->view("layout/footer");
    }

    public function get_student_self_score_by_filter() {
        $output = "";
        $term = $_POST['term'];
        $edyear = $_POST['edyear'];
        $StdId = $this->session->userdata('hr_id');
        $Course = $this->Dcc_model->get_register_course_by_year_term_stdid($term, $edyear, $StdId);

        if ($Course) {
            $output .= "<table class='table table-bordered display' id='ScoreTable'>";
            $output .= "<thead>";
            $output .= "<tr style='height:50px;background: whitesmoke;'> ";
            $output .= "<th class='no-sort' style='width:5%;text-align: center;'>ที่</th>";
            $output .= "<th class='no-sort' style='width:10%;text-align: center;'>รหัสวิชา</th>";
            $output .= "<th class='no-sort' style='width:35%;text-align: center;'>รายวิชา</th>";
            $output .= "<th class='no-sort' style='width:10%;text-align: center;'>ประเภท</th>";
            $output .= "<th class='no-sort' style='width:10%;text-align: center;'>น้ำหนัก/เวลา</th>";
            $output .= "<th class='no-sort' style='width:10%;text-align: center;'>คะแนน</th>";
            $output .= "<th class='no-sort' style='width:10%;text-align: center;'>ผลการเรียน</th>";
            $output .= "<th class='no-sort' style='width:10%;text-align: center;'>หมายเหตุ</th>";
            $output .= "</tr>";
            $output .= "</thead>";
            $output .= "<tbody>";
            $i = 1;
            foreach ($Course as $r) {
                $output .= "<tr style='height: 30px;'>";
                $output .= "<td style='width:5%;text-align: center;'>" . $i . "</td>";
                $output .= "<td style='width:10%;text-align: center;'>" . $r['tb_course_code'] . "</td>";
                $output .= "<td style='width:45%;text-align: center;'>" . $r['tb_subject_name'] . "</td>";
                $output .= "<td style='width:10%;text-align: center;'>" . $r['tb_subject_type'] . "</td>";
                $output .= "<td style='width:10%;text-align: center;'>" . $r['tb_course_credit'] . "</td>";

                $MidScore = $this->StdScore_model->get_std_course_midterm_score($StdId, $r['ed_course_id']);
                $FinalScore = $this->StdScore_model->get_std_course_final_score($StdId, $r['ed_course_id']);
                $StdScore = $MidScore + $FinalScore;

                $output .= "<td style='width:10%;text-align: center;'>";
                $output .= $StdScore;
                $output .= "</td>";

                $output .= "<td style='width:10%;text-align: center;'>";
                $output .= StudentGrade($StdScore);
                $output .= "</td>";
                $output .= "<td style='width:10%;text-align: center;'></td>";

                $output .= "</tr>";
                $i++;
            }



            $output .= "</tbody>";
            $output .= "</table>";
        }
        echo $output;
    }

}
