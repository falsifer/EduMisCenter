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
  | Create Date 31/8/2562
  | Last edit	31/8/2562
  | Comment	-
  | ----------------------------------------------------------------------------
 */

Class School_bank extends CI_Controller {

    public function __construct() {
        parent::__construct();
        if ($this->session->userdata('status') == "") {
            redirect("/");
        }
//        aaa();
        $this->load->model("My_model");
        $this->load->model("Std_model");
    }

    public function school_bank_student_base() {
        $this->load->view("layout/header");
        $this->load->view("school_bank/school_bank_student_base");
        $this->load->view("layout/footer");
    }

    public function school_bank_student_list_by_filter() {
        $room_id = $this->input->post('room_id');
        $output = "";

        $StudentArray = $this->Std_model->get_std_base_w_roomid_return_array($room_id);

        $output .= "<table class='table table-hover table-striped table-bordered display' id='StudentTable'>";
        $output .= "<thead>";
        $output .= "<tr style='background-color: #eee;'>";
        $output .= "<th style='width:5%;text-align: center;' >ที่</th>";
        $output .= "<th style='width:10%;text-align: center;' >รหัสนักเรียน</th>";
        $output .= "<th style='width:20%;text-align: center;' >ชื่อ-นามสกุล</th>";
        $output .= "<th style='width:15%;text-align: center;' >ระดับชั้น</th>";
        $output .= "<th style='width:10%;text-align: center;' >ฝาก</th>";
        $output .= "<th style='width:10%;text-align: center;' >ถอน</th>";
        $output .= "<th style='width:10%;text-align: center;' >สะสม</th>";
        $output .= "<th style='width:20%;text-align: center;' ></th>";
        $output .= "</tr>";
        $output .= "</thead>";

        $output .= "<tbody >";
        foreach ($StudentArray as $r) {
            $output .= "<tr id='" . $r['StdId'] . "' style='cursor: pointer;text-align: center;' onclick='SelectThisStudent(this)'>";
            $output .= "<td>" . $r['std_number'] . "</td>";
            $output .= "<td>" . $r['std_code'] . "</td>";
            $output .= "<td style='text-align: left;'><img src='" . $r['std_profile_picture'] . "' width='30px'/>&nbsp;" . $r['std_fullname'] . "</td>";
//            $output .= "<td>" . $r['std_age'] . " ปี</td>";
            $output .= "<td>" . $r['std_classname'] . "/" . $r['std_room_number'] . "</td>";
            $sumDeposit = $this->My_model->sum_where('tb_school_bank', 'tb_school_bank_amount', array('tb_school_bank_type' => 'ฝาก', 'tb_student_base_id' => $r['StdId']));
            $output .= "<td>" . $sumDeposit['tb_school_bank_amount'] . "</td>";
            $sumWithdraw = $this->My_model->sum_where('tb_school_bank', 'tb_school_bank_amount', array('tb_school_bank_type' => 'ถอน', 'tb_student_base_id' => $r['StdId']));
            $output .= "<td>" . $sumWithdraw['tb_school_bank_amount'] . "</td>";
            $sum = $sumDeposit['tb_school_bank_amount'] - $sumWithdraw['tb_school_bank_amount'];
            $output .= "<td>" . $sum . "</td>";
            $output .= "<td>"
                    . "<button type='button' class='btn btn-primary' onclick='ShowThisModal(" . $r['StdId'] . ")' id='" . $r['StdId'] . "' ><i class='glyphicon glyphicon-piggy-bank'></i> ข้อมูล ฝาก/ถอน</button>"
                    . "</td>";
            $output .= "</tr>";
        }
        $output .= "</tbody>";

        echo $output;
    }

    public function get_school_bank_student_by_stdid() {
        $id = $this->input->post('id');
        $rs = $this->Std_model->get_std_base_w_stdid_return_row($id);
        $output = "";

        $output .= "<legend>ข้อมูลการบันทึกเงินออมทรัพย์นักเรียนรายบุคคล</legend>";
        $output .= "<input type='hidden' id='inStdId' name='inStdId' value='" . $rs[0]['StdId'] . "'/>";
        $output .= "<br/>";


        $output .= "<div style='float: left;width:30%;padding:5px;'>";
        $output .= "<center><img height='80px;' src='" . $rs[0]['std_profile_picture'] . "' /></center>";
        $output .= "</div>";

        $output .= "<div style='float: left;width:65%;padding:5px;font-size:0.9em;'>";
        $output .= "ชื่อ <strong>" . $rs[0]['std_fullname'] . "</strong> เลขที่ <strong>" . $rs[0]['std_number'] . "</strong>";
        $output .= "<p>รหัสนักเรียน <strong>" . $rs[0]['std_code'] . "</strong></p>";
        $output .= "<p>ระดับชั้น <strong>" . $rs[0]['std_classname'] . "</strong> ห้องที่ <strong>" . $rs[0]['std_room_number'] . "</strong> </p>";
        $output .= "</div>";


//         $output .= "<div style='border-button:solid 1px black;width:100%;'>asdasdasdasd</div>";
        $output .= "<div style='clear:both;'></div>";
        $output .= "<hr/>";
        $output .= "<div style='clear:both;'></div>";
        $output .= "<center>";
        $output .= "<div style='width:90%;padding:5px;'>";
        $output .= "<strong>ประวัติการฝาก/ถอน</strong>";
        $output .= "<table border='1' cellpadding='4' cellspacing='0' style='width:100%;font-size:0.9em;' >";
        $output .= "<thead>";
        $output .= "<tr style='background-color: #eeeeee;'>";
        $output .= "<th style='width:5%;text-align: center;padding: 3px;'>ที่</th>  ";
        $output .= "<th style='width:25%;text-align: center;padding: 3px;'>วันที่</th>";
        $output .= "<th style='width:10%;text-align: center;padding: 3px;'>ฝาก</th>";
        $output .= "<th style='width:10%;text-align: center;padding: 3px;'>ถอน</th>";
        $output .= "<th style='width:15%;text-align: center;padding: 3px;'>คงเหลือ</th>";
        $output .= "<th style='width:20%;text-align: center;padding: 3px;'>ผู้บันทึก</th>";
        $output .= "<th style='width:15%;text-align: center;padding: 3px;'>หมายเหตุ</th>";
        $output .= "</tr>";
        $output .= "</thead>";
        $output .= "<tbody  style='font-size:0.8em;' name='inTbody' id='inTbody'>";


        $output .= "<tr  style='text-align: center;' class='no-print'>";

        $output .= "<td colspan='2' >";
        $output .= "<font>" . datethaifull(date('Y-m-d')) . "</font>";
        $output .= "</td>";

        $output .= "<td  style='text-align: center;padding: 3px;'>";
        $output .= "<input type='radio' class='form-control' id='inSchoolBankType' name='inSchoolBankType' value='ฝาก'/>";
        $output .= "</td>";

        $output .= "<td  style='text-align: center;padding: 3px;'>";
        $output .= "<input type='radio' class='form-control' id='inSchoolBankType' name='inSchoolBankType' value='ถอน'/>";
        $output .= "</td>";

        $output .= "<td  style='text-align: center;padding: 3px;' colspan='2'>";
        $output .= "<input type='number' class='form-control' id='inSchoolBankAmount' name='inSchoolBankAmount' placeholder='กรอกจำนวนเงิน(บาท)...' />";
        $output .= "</td>";

        $output .= "<td  style='text-align: center;padding: 3px;'>";
        $output .= "<input type='text' class='form-control' id='inSchoolBankNote' name='inSchoolBankNote' placeholder='หมายเหตุ(โน้ต)...' />";
        $output .= "</td>";

        $output .= "<td  style='text-align: center;padding: 3px;'>";
        $output .= "<button type='button' class='btn btn-success' onclick='InsertThisMoney(this)'><i class='icon-save icon-large'></i> บันทึก</button>";
        $output .= "</td>";

        $output .= "</tr>";


        $list = $this->My_model->get_where_order('tb_school_bank', array('tb_student_base_id' => $id), 'tb_school_bank_createdate desc');
        $deposit = 0;
        $withdraw = 0;
        $balance = 0;

        $i = 1;
        foreach ($list as $r) {
            $output .= "<tr style='width:20%;text-align: center;padding: 3px;'>";
            $output .= "<td>" . $i . "</td>";
            $output .= "<td>" . datethaifull($r['tb_school_bank_createdate']) . "</td>";

            if ($r['tb_school_bank_type'] == 'ฝาก') {
                $output .= "<td>" . number_format($r['tb_school_bank_amount']) . "</td>";
                $output .= "<td> - </td>";
                $balance += $r['tb_school_bank_amount'];
                $deposit += $r['tb_school_bank_amount'];
            } else {
                $output .= "<td> - </td>";
                $output .= "<td>" . number_format($r['tb_school_bank_amount']) . "</td>";
                $balance -= $r['tb_school_bank_amount'];
                $withdraw += $r['tb_school_bank_amount'];
            }


            $output .= "<td>" . number_format($balance) . "</td>";
            $output .= "<td>" . $r['tb_school_bank_recorder'] . "</td>";
            $output .= "<td>" . $r['tb_school_bank_note'] . "</td>";

            $output .= "<td  style='text-align: center;padding: 3px;' class='no-print'>";
            $output .= "<button type='button' class='btn btn-link' onclick='DeleteThisRecord(this)' id='" . $r['id'] . "' name='" . $r['id'] . "' ><i style='color:red;' class='icon-trash icon-large'></i></button>";
            $output .= "</td>";
            $output .= "</tr>";
            $i++;
        }

//        $output .= $plus_appd;
//        $output .= $minus_appd;


        $output .= "</tbody>";

        $output .= "<tfooter>";
        $output .= "<tr style='width:20%;text-align: center;padding: 3px;backgroud:#eeeee;'>";
        $output .= "<td colspan='2'>ยอดรวม</td>";
        $output .= "<td style='text-align: center;padding: 3px;' >" . $deposit . "</td>";
        $output .= "<td style='text-align: center;padding: 3px;' >" . $withdraw . "</td>";
        $output .= "<td style='text-align: center;padding: 3px;' >" . $balance . "</td>";
        $output .= "<td colspan='2'>บาท</td>";
        $output .= "</tr>";
        $output .= "</tfooter>";

        $output .= " </table>";
        $output .= "</div> ";
        $output .= "</center>";


        echo $output;
    }

    public function school_bank_student_insert_money() {
        $student_id = $this->input->post('student_id');
        $type = $this->input->post('type');
        $amount = $this->input->post('amount');
        $note = $this->input->post('note');


        $arr = array(
            "tb_student_base_id" => $student_id,
            "tb_school_bank_type" => $type,
            "tb_school_bank_amount" => $amount,
            "tb_school_bank_note" => $note,
            "tb_school_bank_recorder" => $this->session->userdata('name'),
            "tb_school_bank_department" => $this->session->userdata('department'),
            "tb_school_bank_createdate" => date('Y-m-d'),
            "tb_school_bank_last_recorder" => $this->session->userdata('name'),
            "tb_school_bank_last_editdate" => date('Y-m-d'),
        );


//        if ($this->input->post('id')) {
//            $this->My_model->update_data('tb_school_bank', array('id' => $this->input->post('id')), $arr);
//        } else {
        $this->My_model->insert_data('tb_school_bank', $arr);
//        }
    }

    public function school_bank_student_delete_record() {
        $id = $this->input->post('id');
        if ($id != "") {
            $this->My_model->delete_data("tb_school_bank", array("id" => $id));
        }
    }

}
