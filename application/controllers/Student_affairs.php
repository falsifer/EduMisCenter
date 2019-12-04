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
  | Create Date 30/7/2562
  | Last edit	30/7/2562
  | Comment	-
  | ----------------------------------------------------------------------------
 */

Class Student_affairs extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model("My_model");
        $this->load->model("Chairatto_model");
        $this->load->model("Homeroom_model");
        $this->load->model("Std_model");
    }

//---------กิจการนักเรียน View---------//
    public function student_affairs_base() {
        $this->load->view("layout/header");
        $this->load->view("student_affairs/student_affairs_base");
        $this->load->view("layout/footer");
    }

    public function student_affairs_std_absent_record_base() {

        $output = "";

        $edyear = get_edyear();
        $school_id = $this->session->userdata('sch_id');
        $StartDate = date('Y') + 543 . date('-m-d');
        $EndDate = date('Y') + 543 . date('-m-d');

        $ClassArray = $this->Chairatto_model->get_class_by_school_id_edyear($school_id, $edyear);



//        $output .= "<table class='table table-hover table-striped table-bordered display' id='StdAbsentRecSchoolTable'>";
        $output .= "<thead>";
        $output .= "<tr style='background-color: #eee;'>";
        $output .= "<th style='width:25%;text-align: center;' >ระดับชั้น</th>";
        $output .= "<th style='width:10%;text-align: center;' >มา</th>";
        $output .= "<th style='width:10%;text-align: center;' >สาย</th>";
        $output .= "<th style='width:10%;text-align: center;' >ขาด</th>";
        $output .= "<th style='width:10%;text-align: center;' >ลากิจ</th>";
        $output .= "<th style='width:10%;text-align: center;' >ลาป่วย</th>";
        $output .= "<th style='width:25%;text-align: center;' >ผู้รับผิดชอบ</th>";
        $output .= "</tr>";
        $output .= "</thead>";
//
        $output .= "<tbody >";
        foreach ($ClassArray as $cr) {

            $RoomArray = $this->My_model->get_where_order('tb_ed_room', array('tb_ed_school_register_class_id' => $cr['ClassId']), 'tb_classroom_room asc');

            foreach ($RoomArray as $r) {

                $output .= "<tr >";
                $output .= "<td class='TdSelect' onclick='SelectThisRoom(" . $r['id'] . ")' style='text-align: center;'>" . $cr['tb_ed_school_class_name'] . "ปีที่ " . $cr['tb_ed_school_class_level'] . " ห้องที่ " . $r['tb_classroom_room'] . "</td>";

                $AbsentArray = array('C', 'L', 'S', 'E', 'A');
                $IChecker = 0;
                foreach ($AbsentArray as $rStatus) {
                    $Stat = $this->Homeroom_model->get_all_absent_period($r['id'], $StartDate, $EndDate, $rStatus);
                    $output .= "<td class='TdSelect'  onclick='SelectThisStatus(\"" . $r['id'] . "," . $rStatus . "," . $Stat . "\")' style='text-align: center;'>" . $Stat . "</td>";
                    $IChecker += $Stat;
                }
                $output .= "<td class='TdSelect' onclick='SelectThisRoom(" . $r['id'] . ")' style='text-align: center;'>";
                if ($IChecker > 0) {
                    $mychecker = $this->Chairatto_model->select_distinct_where('tb_std_absent_record', array('tb_std_absent_record_date' => $StartDate), 'tb_student_absent_record_recorder');
                    if ($mychecker) {
                        $output .= "<i class='icon-check icon-large' style='color:green'></i> เช็คแล้วโดย<br/>";
                        foreach ($mychecker as $mycheckers) {
                            $output .= "<p style='font-size:0.9em;'>" . $mycheckers['tb_student_absent_record_recorder'] . "</p>";
                        }
                    } else {
                        $output .= "<i class='icon-remove icon-large' style='color:red'></i> ยังไม่มีการเช็ค";
                    }
                }



                $output .= "</td>";

                $output .= "</tr>";
            }
        }
        $output .= "</tbody>";

        $data['ToDay'] = $output;
        $this->load->view("layout/header");
        $this->load->view("student_affairs/student_affairs_std_absent_record_base", $data);
        $this->load->view("layout/footer");
    }

    public function get_std_absent_record_by_date() {
        $output = "";
        $date = $this->input->post('date');
        $edyear = get_edyear();
        $school_id = $this->session->userdata('sch_id');

        $StartDate = $date;
        $EndDate = $date;

        $ClassArray = $this->Chairatto_model->get_class_by_school_id_edyear($school_id, $edyear);



//        $output .= "<table class='table table-hover table-striped table-bordered display' id='StdAbsentRecSchoolTable'>";
        $output .= "<thead>";
        $output .= "<tr style='background-color: #eee;'>";
        $output .= "<th style='width:25%;text-align: center;' >ระดับชั้น</th>";
        $output .= "<th style='width:10%;text-align: center;' >มา</th>";
        $output .= "<th style='width:10%;text-align: center;' >สาย</th>";
        $output .= "<th style='width:10%;text-align: center;' >ขาด</th>";
        $output .= "<th style='width:10%;text-align: center;' >ลากิจ</th>";
        $output .= "<th style='width:10%;text-align: center;' >ลาป่วย</th>";
        $output .= "<th style='width:25%;text-align: center;' >ผู้รับผิดชอบ</th>";
        $output .= "</tr>";
        $output .= "</thead>";
//
        $output .= "<tbody >";
        foreach ($ClassArray as $cr) {

            $RoomArray = $this->My_model->get_where_order('tb_ed_room', array('tb_ed_school_register_class_id' => $cr['ClassId']), 'tb_classroom_room asc');

            foreach ($RoomArray as $r) {

                $output .= "<tr >";
                $output .= "<td class='TdSelect' onclick='SelectThisRoom(" . $r['id'] . ")' style='text-align: center;'>" . $cr['tb_ed_school_class_name'] . "ปีที่ " . $cr['tb_ed_school_class_level'] . " ห้องที่ " . $r['tb_classroom_room'] . "</td>";

                $AbsentArray = array('C', 'L', 'S', 'E', 'A');
                $IChecker = 0;
                foreach ($AbsentArray as $rStatus) {
                    $Stat = $this->Homeroom_model->get_all_absent_period($r['id'], $StartDate, $EndDate, $rStatus);
                    $output .= "<td class='TdSelect'  onclick='SelectThisStatus(\"" . $r['id'] . "," . $rStatus . "," . $Stat . "\")' style='text-align: center;'>" . $Stat . "</td>";
                    $IChecker += $Stat;
                }
                $output .= "<td class='TdSelect' onclick='SelectThisRoom(" . $r['id'] . ")' style='text-align: center;'>";
                if ($IChecker > 0) {
                    $mychecker = $this->Chairatto_model->select_distinct_where('tb_std_absent_record', array('tb_std_absent_record_date' => $StartDate), 'tb_student_absent_record_recorder');
                    if ($mychecker) {
                        $output .= "<i class='icon-check icon-large' style='color:green'></i> เช็คแล้วโดย<br/>";
                        foreach ($mychecker as $mycheckers) {
                            $output .= "<p style='font-size:0.9em;'>" . $mycheckers['tb_student_absent_record_recorder'] . "</p>";
                        }
                    } else {
                        $output .= "<i class='icon-remove icon-large' style='color:red'></i> ยังไม่มีการเช็ค";
                    }
                }



                $output .= "</td>";

                $output .= "</tr>";
            }
        }
        $output .= "</tbody>";


//        $output .= "</table>";

        echo ($output);
    }

    public function get_headthai_by_date() {
        $inputdate = $this->input->post('date');
        $ArrayDate = explode("-", $inputdate);

        $y = $ArrayDate[0] - 543;
        $m = $ArrayDate[1];
        $d = $ArrayDate[2];

        $date = $y . "-" . $m . "-" . $d;
        echo " สถิติการมาเรียนประจำวันที่ (" . (datethaifull($date)) . ")";
    }

    public function get_std_absent_record_status_modal_by_room_id_status() {
        $output = "";
        $room_id = $this->input->post('room_id');
        $status = $this->input->post('status');
        $date = $this->input->post('date');

        $StudentArray = $this->Homeroom_model->get_std_absent_record_by_room_id_status_date($room_id, $status, $date);
        foreach ($StudentArray as $r) {
            $Student = $this->Std_model->get_std_base_w_stdid_return_row($r['StdId']);

            $output .= "<tr >";
            $output .= "<td  style='text-align: center;'>" . $Student[0]['std_number'] . "</td>";
            $output .= "<td  style='text-align: center;'>";
            $output .= "<img style='float:left;margin-right:20px;' width='50px;' src='" . $Student[0]['std_profile_picture'] . "' /><div style='float:left;'>" . $Student[0]['std_fullname'] . "</div>";
            $output .= "</td>";
            $output .= "<td  style='text-align: center;'><i class='icon-check icon-large' ></i> " . $r['tb_student_absent_record_recorder'] . "</td>";
//            $output .= "<td  style='text-align: center;'>มาเรียน</td>";
            $output .= "</tr>";
        }


        echo $output;
    }

}
