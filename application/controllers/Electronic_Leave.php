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

class Electronic_Leave extends CI_Controller {

    public function __construct() {
        parent::__construct();
        if ($this->session->userdata('status') == "") {
            redirect("/");
        }
        $this->load->model("My_model");
        $this->load->model("Chairatto_model");
    }

    public function electronic_leave_base() {

        $data['rs'] = $this->My_model->get_where_order('tb_work_record_topic_sub', array('tb_work_record_topic_sub_type' => "ลา"), 'id asc');
        $data['rsEList'] = $this->My_model->get_where_order('tb_electronic_leave', array('tb_hr_id' => $this->session->userdata('hr_id')), 'id asc');
        $this->load->view("layout/header");
        $this->load->view("electronic_leave/electronic_leave_base", $data);
        $this->load->view("layout/footer");
    }

    public function electronic_leave_request() {
        echo json_encode($this->Chairatto_model->hr01_join_hr02());
    }

    public function electronic_leave_delete() {
        $this->My_model->delete_data("tb_electronic_leave", array("id" => $_POST['id']));
    }

    public function electronic_leave_insert() {
        $id = $this->input->post('id');


        $total = count($_FILES['inELeaveRefer']['name']);

        $file = "";
        for ($i = 0; $i < $total; $i++) {

            $_FILES['file']['name'] = $_FILES['inELeaveRefer']['name'][$i];
            $_FILES['file']['type'] = $_FILES['inELeaveRefer']['type'][$i];
            $_FILES['file']['tmp_name'] = $_FILES['inELeaveRefer']['tmp_name'][$i];
            $_FILES['file']['error'] = $_FILES['inELeaveRefer']['error'][$i];
            $_FILES['file']['size'] = $_FILES['inELeaveRefer']['size'][$i];

            $uploadPath = hr_path($this->session->userdata('hr_id'), $this->session->userdata('sch_id'));

            $config = array(
                "upload_path" => $uploadPath,
                "allowed_types" => "*",
                "max_size" => 0,
                "file_name" => md5(date("YmdHis"))
            );

            $this->upload->initialize($config);
            $this->upload->do_upload('file');
            $data = $this->upload->data();
            if ($i > 0) {
                $file .= "," . $data['file_name'];
            } else {
                $file .= $data['file_name'];
            }
        }

        $arr = array(
            "id" => $id,
            "tb_hr_id" => $this->session->userdata('hr_id'),
            "tb_work_record_topic_sub_id" => $this->input->post('inTopicSub'),
            "tb_electronic_leave_reason" => $this->input->post('inReason'),
            "tb_electronic_leave_start_date" => $this->input->post('inStartDate'),
            "tb_electronic_leave_end_date" => $this->input->post('inEndDate'),
            "tb_electronic_leave_count_day" => $this->input->post('inCountDay'),
            "tb_electronic_leave_contract_address" => $this->input->post('inAddress'),
            "tb_electronic_leave_contract_phone" => $this->input->post('inPhone'),
            "tb_electronic_leave_contract_other" => $this->input->post('inOther'),
            "tb_electronic_leave_refer_file" => $file,
            "tb_electronic_leave_recorder" => $this->session->userdata('name'),
            "tb_electronic_leave_department" => $this->session->userdata('department'),
            "tb_electronic_leave_createdate" => date('Y-m-d')
        );

        if ($id != "") {
            $this->My_model->update_data('tb_electronic_leave', array('id' => $id), $arr);
        } else {
            $this->My_model->insert_data('tb_electronic_leave', $arr);
        }
    }

    public function electronic_leave_detail() {
        $id = $this->input->post('id');
        $MyQ = $this->Chairatto_model->hr_e_leave_row_array($id);

//        $HrType = $this->My_model->get_where_row('');

        $output = "";

        $output .= "<div class='row'>";
        $output .= "<input type='hidden' id='HrId' value='" . $MyQ["HrId"] . "' />";
        $output .= "<input type='hidden' id='StartDate' value='" . $MyQ["tb_electronic_leave_start_date"] . "' />";
        $output .= "<input type='hidden' id='Numdate' value='" . $MyQ["tb_electronic_leave_count_day"] . "' />";
        $output .= "<center><h4><b>แบบบันทึกการลา</b></h4></center>";
        $output .= "</div>";

        $output .= "<div class='row'  align='right'>";
        $output .= "<div class='col-md-12'>";
        $output .= "<b>วันที่เขียน  " . datethaifull($MyQ["tb_electronic_leave_createdate"]) . "</b>";
        $output .= "<br>";
        $output .= "</div>";
        $output .= "</div>";

        $output .= "<div class='row'>";
        $output .= "<div class='col-md-12'>";
        $output .= "<b>เรื่อง ขออนุญาตลา</b> ";
        $output .= "</div>";
        $output .= "</div>";

        $output .= "<div class='row'>";
        $output .= "<div class='col-md-12'>";
        $output .= "<b>เรียน ผู้อำนวยการ" . $MyQ["hr_department"] . "</b> ";
        $output .= "</div>";
        $output .= "</div>";

        $output .= "<div class='row'>";
        $output .= "<div class='col-md-12'>";
        $output .= "<p style='text-indent: 3.5em;'>";
       

//        $rank = $this->My_model->get_where_row("tb_rank", array("id" => $MyQ["hr_level"]));
//        $output .= "ตำแหน่ง    <u id='inRank'>" . $rank["rank_name"] . "</u> ";
      
        $output .= "</p> ";
        $output .= "</div>";
        $output .= "</div>";

        $output .= "<div class='row'>";
        $output .= "<div class='col-md-12'>";
        
         $output .= "&nbsp;&nbsp;&nbsp;&nbsp;ข้าพเจ้า   <u id='inName'>" . $MyQ["HRfullname"] . "</u>  ";
          $output .= "สังกัด    <u id='inDepartment'>" . $MyQ["hr_department"] . "</u> ";
        $output .= " ขออนุญาต   <u>" . $MyQ["tb_work_record_topic_sub_name"] . "</u>";
        $output .= " เนื่องจาก   <u>" . $MyQ["tb_electronic_leave_reason"] . "</u>";
        $output .= " ตั้งแต่วันที่   <u>" . datethaifull($MyQ["tb_electronic_leave_start_date"]) . "</u>";
        $output .= " จนถึงวันที่   <u>" . datethaifull($MyQ["tb_electronic_leave_end_date"]) . "</u>";
        $output .= " เป็นจำนวน   <u>" . $MyQ["tb_electronic_leave_count_day"] . " วัน</u>";
        $output .= " ในระหว่างที่ลาสามารถติดต่อข้าพเจ้าได้ที่   <u>" . $MyQ["tb_electronic_leave_contract_address"] . "</u>";
        $output .= " เบอร์โทรศัพท์ <u>" . $MyQ["tb_electronic_leave_contract_phone"] . "</u>";
        $output .= " ช่องทางการติดต่ออื่นๆ <u>" . $MyQ["tb_electronic_leave_contract_other"] . "</u>";
        $output .= "</div>";
        $output .= "</div>";

//        $output .= "<br>";
//        $output .= "<br>";

        $output .= "<div class='row'>";

        $output .= "<div style='width:50% ;float: left;margin-bottom:10px;'>";

        $output .= "<table id='HrLeaveStat'>";


        $output .= "<thead> ";
        $output .= "<tr> ";
        $output .= "<th class='no-sort' style='text-align:center; width:45%; '>ประเภทการลา</th> ";
        $output .= "<th class='no-sort' style='text-align:center; width:20%; '>ลามาแล้ว</th> ";
        $output .= "<th class='no-sort' style='text-align:center; width:20%; '>ลาครั้งนี้</th> ";
        $output .= "<th class='no-sort' style='text-align:center; width:15%; '>รวม</th> ";
        $output .= "</tr> ";
        $output .= "</thead> ";


        $MyTopicQ = $this->Chairatto_model->get_e_leave_topic();

        $output .= "<tbody> ";

        foreach ($MyTopicQ as $r) {
            $count = $this->Chairatto_model->count_w2c('tb_hr_absent_record', array('tb_hr_id' => $id), array('tb_work_record_topic_sub_id' => $MyQ['tb_work_record_topic_sub_id']));

            if ($count != 0 | $r->id == $MyQ['tb_work_record_topic_sub_id']) {
                $output .= "<tr>";
                $output .= "<td style='text-align: center;'>" . $r->tb_work_record_topic_sub_name . "</td>";
                $output .= "<td style='text-align: center;'>" . $count . "</td>";

                if ($r->id != $MyQ['tb_work_record_topic_sub_id']) {
                    $output .= "<td style='text-align: center;'>0</td>";
                    $output .= "<td style='text-align: center;'>" . $count . "</td>";
                } else {
                    $output .= "<td style='text-align: center;'>" . $MyQ["tb_electronic_leave_count_day"] . "</td>";
                    $output .= "<td style='text-align: center;'>" . ($count + $MyQ["tb_electronic_leave_count_day"]) . "</td>";
                }
                $output .= "</tr>";
            }
        }

        $output .= "</tbody> ";
        $output .= "</table> ";

        $output .= "</div>";


        $output .= "<div style='width:50% ;float: left;margin-bottom:10px;'>";
        //  if (file_exists("upload/" . $MyQ['signature']) && !empty($MyQ['signature'])) {

        $output .= "<center>";
        $output .= "ขอแสดงความนับถือ<br/>";
        $output .= img(array('src' => hr_path($this->session->userdata('hr_id'), $this->session->userdata('sch_id')) . $MyQ['signature'], "style" => "width:98px;height:56px;")) . nbs(5);
        $output .= "<br/>(" . $MyQ["HRfullname"] . ")<br/>";

        $output .= " สังกัด" . $MyQ["hr_department"] . "<br/>";
        $output .= "</center>";
        // }
        $output .= "</div>";


        $output .= "</div>";
        //$output .= "<input type='text' value='".hr_path($this->session->userdata('hr_id'), $this->session->userdata('sch_id')). $MyQ['signature']."'/>";


        $output .= "</div>";

//        $output .= "<br>";
        $output .= "<hr/>";
        $output .= "<br>";

        $output .= "<div class='row'>";

        $MyEDocApproverList = $this->Chairatto_model->get_edoc_approver_list();

        foreach ($MyEDocApproverList as $rr) {

            $output .= "<div style='width:50% ;float: left;'>";
            $output .= "<center>";
            $MyApprove = $this->Chairatto_model->get_w2c_table("tb_electronic_leave_approve", array("tb_electronic_leave_id" => $id), array("tb_hr_position_register" => $rr->PosId));
            if (count($MyApprove) > 0) {
                if ($MyApprove[0]['tb_electronic_leave_approve_status'] == "YES") {
                    if (file_exists(hr_path($this->session->userdata('hr_id'), $this->session->userdata('sch_id')) . $rr->signature) && !empty($rr->signature)) {
                        $output .= $MyApprove[0]['tb_electronic_leave_approve_note'] . "<br>";
                        $output .= img(array('src' => hr_path($this->session->userdata('hr_id'), $this->session->userdata('sch_id')) . $rr->signature, "style" => "width:98px;height:56px;")) . nbs(5);
                    }
                } else {
                    $output .= "ไม่อนุมัติวันลา";
                    if ($MyApprove[0]['tb_electronic_leave_approve_note'] != "") {
                        $output .= "เนื่องจาก " . $MyApprove[0]['tb_electronic_leave_approve_note'] . "";
                    }
                    if (file_exists(hr_path($this->session->userdata('hr_id'), $this->session->userdata('sch_id')) . $rr->signature) && !empty($rr->signature)) {
                        $output .= "<br/>" . img(array('src' => hr_path($this->session->userdata('hr_id'), $this->session->userdata('sch_id')) . $rr->signature, "style" => "width:98px;height:56px;")) . nbs(5);
                    }
                }
            } else {
                if ($rr->tb_hr_id == $this->session->userdata('hr_id')) {
                    $output .= "<input type='text' id='inApproveNote' name='inApproveNote' placeholder='ความคิดเห็น..'>";
                    $output .= "<input type='hidden' id='inApproveId' name='inApproveId' value='" . $id . "'>";
                    $output .= "<button type='button' class='btn btn-success' style='margin-top:10px;' id='" . $rr->RegisId . "' onclick='ApproveThis(this)'><i class='icon-check icon-large'></i> อนุมัติการลา</button>";
                    $output .= "&nbsp;&nbsp;&nbsp;&nbsp;<button type='button' class='btn btn-danger' style='margin-top:10px;' id='" . $rr->RegisId . "' onclick='NotApprovedThis(this)'><i class='icon-remove icon-large'></i> ไม่อนุมัติการลา</button>";
                } else {
                    $output .= "<h2 style='color:red;'>รอการอนุมัติ</h2>";
                }
            }

            $output .= "<br>(" . $rr->hr_thai_symbol . $rr->hr_thai_name . " " . $rr->hr_thai_lastname . ")<br>";
            $output .= $rr->tb_hr_position_name . $rr->hr_department . "<br>";
            $output .= "</center>";
            $output .= "</div>";
        }
        $output .= "</div>";
        $output .= "<hr/>";
        $output .= "<legend>เอกสารที่แนบมาด้วย</legend>";
        $output .= "<div class='row'>";

        $ReferFile = explode(',', $MyQ['tb_electronic_leave_refer_file']);

        foreach ($ReferFile as $rf) {
            $output .= GenfileImages($rf, $MyQ['HrId'], $this->session->userdata('sch_id'));
//            $output .= "<a href='" . base_url() . hr_path($MyQ['HrId'], $this->session->userdata('sch_id')) . $rf . "' target='_BLANK'>เอกสารที่แนบมาด้วย</a>";
        }
        $output .= "</div>";
        echo $output;
//        $this->My_model->get_where_order('tb_work_record_topic_sub', array('tb_work_record_topic_sub_type' => "ลา"), 'id asc');
    }

    public function electronic_leave_body() {
        $MyList = $this->Chairatto_model->get_e_leave_list();
        $output = "";

        $output .= "<div class='panel panel-info'>";

        $output .= "<div class='panel-body'>";
        $output .= "<div class='col-md-12'>";
        $output .= "<table class='table table-hover table-striped table-bordered display' id='example'>";
        $output .= "<thead>";
        $output .= "<tr>";
        $output .= "<th class='no-sort' style='text-align:center; width:5%;'>ที่</th>";
        $output .= "<th class='no-sort' style='text-align:center; width:30%; '>ผู้อนุมัติ</th>";
        $output .= "<th class='no-sort' style='text-align:center; width:40%; '>รายละเอียดการลา</th>";
        $output .= "<th class='no-sort' style='text-align:center; width:25%; '></th>";
        $output .= "</tr>";
        $output .= "</thead>";

        $output .= "<tbody>";
        $i = 1;
        $MyDeFineList = $this->Chairatto_model->get_edoc_approver_list();
        foreach ($MyList as $r) {
            $output .= "<tr>";

            $output .= "<td style=\"text-align: center;\">" . $i . "</td>";
            $output .= "<td style=\"text-align: center;\">";

            foreach ($MyDeFineList as $rr) {
                $MyApprove = $this->Chairatto_model->get_w2c_table("tb_electronic_leave_approve", array("tb_electronic_leave_id" => $r->id), array("tb_hr_position_register" => $rr->PosId));
                $Status = "";
                if (count($MyApprove) > 0) {
                    if ($MyApprove[0]['tb_electronic_leave_approve_status'] == "YES") {
                        $Status = "<i class='icon-check icon-large' style='color: green;'></i>";
                    } else {
                        $Status = "<i class='icon-remove icon-large' style='color: red;'></i>";
                    }
                } else {
                    $Status = "<i class='icon-remove icon-large'style='color: red;'></i>";
                }
                $output .= $Status . "&nbsp;" . $rr->hr_thai_symbol . $rr->hr_thai_name . " " . $rr->hr_thai_lastname;
                $output .= "<br>";
            }

            $output .= "</td>";

            $output .= "<td style=\"text-align: left;\">";
            $output .= $r->tb_work_record_topic_sub_name . " ตั้งแต่วันที่ " . datethaifull($r->tb_electronic_leave_start_date) . " จนถึง " . datethaifull($r->tb_electronic_leave_end_date) . " เป็นจำนวน " . $r->tb_electronic_leave_count_day . " วัน";
            $output .= "</td>";

            $output .= "<td style=\"text-align: center;\">";
            $output .= "<button type='button' class='btn btn-info btn-detail' id='" . $r->id . "' onclick='ELeaveDetail(this)'><i class='icon-file icon-large'></i> ดูใบลา</button>";
            $output .= "&nbsp;";
            $output .= "<button type='button' class='btn btn-danger btn-delete' id='" . $r->id . "' onclick='ELeaveDelete(this)'><i class='icon-trash icon-large'></i> ลบ</button>";
            $output .= "</td>";

            $output .= "</tr>";

            $i++;
        }

        $output .= "</tbody>";

        $output .= "</table>";
        $output .= "</div>";
        $output .= "</div>";
        $output .= "</div>";

        echo $output;
    }

    public function electronic_approve_body() {
        $MyList = $this->Chairatto_model->get_e_leave_approve_list($this->input->post('SDate'), $this->input->post('EDate'));
        $output = "";

        $output .= "<div class='panel panel-green'>";

        $output .= "<div class='panel-body'>";
        $output .= "<div class='col-md-12'>";
        $output .= "<table class='table table-hover table-striped table-bordered display'>";
        $output .= "<thead>";
        $output .= "<tr>";
        $output .= "<th class='no-sort' style='background-color: whitesmoke;text-align:center; width:5%;'>ที่</th>";
        $output .= "<th class='no-sort' style='background-color: whitesmoke;text-align:center; width:20%; '>ผู้อนุมัติ</th>";
        $output .= "<th class='no-sort' style='background-color: whitesmoke;text-align:center; width:20%; '>ผู้ขอลา</th>";
        $output .= "<th class='no-sort' style='background-color: whitesmoke;text-align:center; width:30%; '>รายละเอียดการลา</th>";
        $output .= "<th class='no-sort' style='background-color: whitesmoke;text-align:center; width:25%; '></th>";
        $output .= "</tr>";
        $output .= "</thead>";

        $output .= "<tbody>";
        $i = 1;
        $MyDeFineList = $this->Chairatto_model->get_edoc_approver_list();
        foreach ($MyList as $r) {
            $output .= "<tr>";

            $output .= "<td style=\"text-align: center;\">" . $i . "</td>";
            $output .= "<td style=\"text-align: center;\">";

            foreach ($MyDeFineList as $rr) {
                $MyApprove = $this->Chairatto_model->get_w2c_table("tb_electronic_leave_approve", array("tb_electronic_leave_id" => $r->id), array("tb_hr_position_register" => $rr->PosId));
                $Status = "";
                if (count($MyApprove) > 0) {
                    if ($MyApprove[0]['tb_electronic_leave_approve_status'] == "YES") {
                        $Status = "<i class='icon-check icon-large' style='color: green;'></i>";
                    } else {
                        $Status = "<i class='icon-remove icon-large' style='color: red;'></i>";
                    }
                } else {
                    $Status = "<i class='icon-remove icon-large'style='color: red;'></i>";
                }
                $output .= $Status . "&nbsp;" . $rr->hr_thai_symbol . $rr->hr_thai_name . " " . $rr->hr_thai_lastname;
                $output .= "<br>";
            }

            $output .= "</td>";
            $output .= "<td style=\"text-align: center;\">" . $r->HRfullname . "</td>";
            $output .= "<td style=\"text-align: left;\">";
            $output .= $r->tb_work_record_topic_sub_name . " ตั้งแต่วันที่ " . datethaifull($r->tb_electronic_leave_start_date) . " จนถึง " . datethaifull($r->tb_electronic_leave_end_date) . " เป็นจำนวน " . $r->tb_electronic_leave_count_day . " วัน";
            $output .= "</td>";

            $output .= "<td style=\"text-align: center;\">";
            $output .= "<button type='button' class='btn btn-info btn-detail' id='" . $r->id . "' onclick='ELeaveDetail(this)'><i class='icon-file icon-large'></i> ดูใบลา</button>";
            $output .= "&nbsp;";
//            $output .= "<button type='button' class='btn btn-secondary btn-approve' id='" . $r->id . "' >คลิกอนุมัติ</button>";
            $output .= "</td>";

            $output .= "</tr>";

            $i++;
        }

        $output .= "</tbody>";

        $output .= "</table>";
        $output .= "</div>";
        $output .= "</div>";
        $output .= "</div>";



//        $output= "123123";
        echo $output;
    }

    public function electronic_leave_approve_this() {
        $id = $this->input->post('id');
        $apid = $this->input->post('apid');
        $apnote = $this->input->post('apnote');
        $status = $this->input->post('status');

        $arr = array(
            "tb_hr_position_register" => $id,
            "tb_electronic_leave_id" => $apid,
            "tb_electronic_leave_approve_status" => $status,
            "tb_electronic_leave_approve_note" => $apnote,
            "tb_electronic_leave_approve_recorder" => $this->session->userdata('name'),
            "tb_electronic_leave_approve_createdate" => date('Y-m-d H:i:s')
        );
        $this->My_model->insert_data('tb_electronic_leave_approve', $arr);

        $ApSq = $this->input->post('ApproverSeq');
        $Startdate = $this->input->post('Startdate');
        $Numdate = $this->input->post('Numdate');
        $HrId = $this->input->post('HrId');

        $Numdate -= 1;
        if ($ApSq == '1') {
            for ($i = 0; $i <= $Numdate; $i++) {
                $dateja = add_day($Startdate, $i);

                $arr = array(
                    "tb_hr_id" => $HrId,
                    "tb_hr_absent_record_date" => $dateja,
                    "tb_hr_absent_record_status" => "C",
                    "tb_hr_absent_record_recorder" => $this->session->userdata('name'),
                    "tb_hr_absent_record_department" => $this->session->userdata('department'),
                    "tb_hr_absent_record_createdate" => date('Y-m-d')
                );

                //----- เงื่อนไข
                if ($this->Chairatto_model->chk_row_hr_absentrec($HrId, $dateja)) {
                    $this->My_model->update_data('tb_hr_absent_record', array('tb_hr_id' => $HrId, 'tb_hr_absent_record_date' => $dateja), $arr);
                } else {
                    $this->My_model->insert_data('tb_hr_absent_record', $arr);
                }
            }
        }
    }

    public function electronic_leave_setting_base() {
        $output = "";
        $this->db->select("*")->from("tb_work_record_topic_sub a");
        $this->db->join("tb_work_record_school_setting b", "b.tb_work_record_topic_sub_id = a.id", "LEFT OUTER");
        $this->db->where("a.tb_work_record_topic_sub_type", "ลา");
        $query = $this->db->get()->result_array();

        foreach ($query as $r) {
//            $output .=  . "__  ";
            $output .= "<div class='col-md-4' style='margin-top: 10px'>";
            $output .= "<div class='input-group'>";
            $output .= "<div class='input-group-btn'>";
            $output .= "<button type='button' class='btn btn-primary'>{$r['tb_work_record_topic_sub_name']}</button>";
            $output .= "</div>";
            $limit = $r['tb_work_record_school_setting_limit'];
            if ($limit != "" && $limit != null) {
                $output .= "<input type='number' class='form-control' value='{$limit}'/>";
            } else {
                $output .= "<input type='number' class='form-control' value=0 />";
            }

            $output .= "<div class='input-group-btn'>";
            $output .= "<button type='button' class='btn btn-primary'>วัน</button>";
            $output .= "</div>";
            $output .= "</div>";
            $output .= "</div>";
        }

        $data['leavetype'] = $output;
        load_view($this, 'electronic_leave/electronic_leave_setting/electronic_leave_setting_base', $data);
    }

}
