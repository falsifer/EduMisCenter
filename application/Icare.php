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
  | Create Date 22/11/2561
  | Last edit	22/11/2561
  | Comment	-
  | ----------------------------------------------------------------------------
 */

Class Icare extends CI_Controller {

    public function __construct() {
        parent::__construct();
        if ($this->session->userdata('status') == "") {
            redirect("/");
        }
        $this->load->model('Std_model');
        $this->load->model('Icare_model');
    }

    public function index() {



        $this->load->view("layout/header");
        $this->load->view("icare/index");
        $this->load->view("layout/footer");
    }

    public function sdq_base() {


        $data["sdq_topic"] = $this->My_model->get_where_order('tb_icare_sdq', array('tb_icare_sdq_department' => $this->session->userdata('department')), 'id');

        $this->load->view("layout/header");
        $this->load->view("icare/sdq_base", $data);
        $this->load->view("layout/footer");
    }

    public function sdq_type() {



        $data["sdq_type"] = $this->My_model->get_where_order('tb_icare_sdq_type', array('tb_sdq_type_department' => $this->session->userdata('department')), 'id');

        $this->load->view("layout/header");
        $this->load->view("icare/sdq_type", $data);
        $this->load->view("layout/footer");
    }

    public function sdq_type_insert() {
        $arr = array(
            "tb_sdq_type" => $this->input->post('inSdqType'),
            "tb_sdq_sar_normal" => $this->input->post('inSdqTypeSarNormal'),
            "tb_sdq_sar_risk" => $this->input->post('inSdqTypeSarRisk'),
            "tb_sdq_sar_problem" => $this->input->post('inSdqTypeSarProblem'),
            "tb_sdq_normal" => $this->input->post('inSdqTypeNormal'),
            "tb_sdq_risk" => $this->input->post('inSdqTypeRisk'),
            "tb_sdq_problem" => $this->input->post('inSdqTypeProblem'),
            "tb_sdq_type_department" => $this->session->userdata('department')
        );


        if ($this->input->post('id')) {
            $this->My_model->update_data('tb_icare_sdq_type', array('id' => $this->input->post('id')), $arr);
        } else {
            $this->My_model->insert_data('tb_icare_sdq_type', $arr);
        }
    }

    // edit
    public function sdq_type_edit() {
        $id = $_POST['id'];
        $rs = $this->My_model->get_where_row('tb_icare_sdq_type', array('id' => $id));
        echo json_encode($rs);
    }

    // edit
    public function sdq_type_delete() {
        $id = $_POST['id'];
        $this->My_model->delete_data('tb_icare_sdq_type', array('id' => $id));
    }

    public function sdq_topic() {


        $data["sdq_type"] = $this->My_model->get_where_order('tb_icare_sdq_type', array('tb_sdq_type_department' => $this->session->userdata('department')), 'id');
        $data["sdq_topic"] = $this->My_model->get_where_order('tb_icare_sdq', array('tb_icare_sdq_department' => $this->session->userdata('department')), 'id');

        $this->load->view("layout/header");
        $this->load->view("icare/sdq_topic", $data);
        $this->load->view("layout/footer");
    }

    public function sdq_temp_print() {



        $data["sdq_topic"] = $this->My_model->get_where_order('tb_icare_sdq', array('tb_icare_sdq_department' => $this->session->userdata('department')), 'tb_icare_sdq_seq');

        $this->load->view("layout/header");
        $this->load->view("icare/sdq_temp_print", $data);
        $this->load->view("layout/footer");
    }

    // edit
    public function sdq_edit() {
        $id = $_POST['id'];
        $rs = $this->My_model->get_where_row('tb_icare_sdq', array('id' => $id));
        echo json_encode($rs);
    }

    // edit
    public function sdq_delete() {
        $id = $_POST['id'];
        $this->My_model->delete_data('tb_icare_sdq', array('id' => $id));
    }

    public function home_base() {

        $this->load->view("layout/header");
        $this->load->view("icare/home_base");
        $this->load->view("layout/footer");
    }

    public function activity_base() {
        $this->load->view("layout/header");
        $this->load->view("icare/activity_base");
        $this->load->view("layout/footer");
    }

    public function help_base() {
        $this->load->view("layout/header");
        $this->load->view("icare/help_base");
        $this->load->view("layout/footer");
    }

    public function report_base() {
        $this->load->view("layout/header");
        $this->load->view("icare/report_base");
        $this->load->view("layout/footer");
    }

    public function correction_base() {
        $this->load->view("layout/header");
        $this->load->view("icare/correction_base");
        $this->load->view("layout/footer");
    }

    public function sdq_insert() {
        $arr = array(
            "tb_icare_sdq_seq" => $this->input->post('inIcareSdqSeq'),
            "tb_icare_sdq_type" => $this->input->post('inIcareSdqType'),
            "tb_icare_sdq_zero_points" => $this->input->post('inIcareSdqZero'),
            "tb_icare_sdq_topic" => $this->input->post('inIcaresdqTopic'),
            "tb_icare_sdq_recorder" => $this->session->userdata('name'),
            "tb_icare_sdq_department" => $this->session->userdata('department')
        );


        if ($this->input->post('id')) {
            $this->My_model->update_data('tb_icare_sdq', array('id' => $this->input->post('id')), $arr);
        } else {
            $this->My_model->insert_data('tb_icare_sdq', $arr);
        }
    }

    public function sdq_print() {
        $arr = array(
            "tb_icare_sdq_topic" => $this->input->post('inIcaresdqTopic'),
            "tb_icare_sdq_recorder" => $this->session->userdata('name'),
            "tb_icare_sdq_department" => $this->session->userdata('department')
        );


        if ($this->input->post('id')) {
            $this->My_model->update_data('tb_icare_sdq', array('id' => $this->input->post('id')), $arr);
        } else {
            $this->My_model->insert_data('tb_icare_sdq', $arr);
        }
    }

    public function sdq_list() {
        $rs = $this->My_model->get_where_order('tb_icare_sdq', array('tb_icare_sdq_department' => $this->session->userdata('department')), 'tb_icare_sdq_seq');


        $output = " <thead>
                                        <tr>
                                            <th style=\"width:40px; text-align: center\">ที่</th>
                                            <th class=\"no-sort\" style=\"text-align: center\">หัวข้อพฤติกรรมประเมิน</th> 
<th class=\"no-sort\" style=\"text-align: center\">ไม่จริง</th>
                                            <th class=\"no-sort\" style=\"text-align: center\">อาจจะจริง</th>
                                            <th class=\"no-sort\" style=\"text-align: center\">จริง</th>                                          
";

        if ($this->session->userdata("status") == "ผู้ปฏิบัติงาน"):
            $output .= "<th style=\"width:20%;\" class=\"no-sort\"></th>";
        endif;
        $output .= "</tr>
                                    </thead>
                                    <tbody>";




        foreach ($rs as $row) {
            $output .= "<tr>
                                            <td style=\"text-align: center;
        \">" . $row['tb_icare_sdq_seq'] . ".</td>
                                            <td style=\"text-align: left;
        \">" . $row['tb_icare_sdq_topic'] . "</td>";
            if ($row['tb_icare_sdq_zero_points'] == 'F') {
                $output .= "<td style=\"text-align: center;\">0</td>";
                $output .= "<td style=\"text-align: center;\">1</td>";
                $output .= "<td style=\"text-align: center;\">2</td>";
            } else {
                $output .= "<td style=\"text-align: center;\">2</td>";
                $output .= "<td style=\"text-align: center;\">1</td>";
                $output .= "<td style=\"text-align: center;\">0</td>";
            }
            if ($this->session->userdata("status") == "ผู้ปฏิบัติงาน") {

                $output .= "<td style=\"text-align:center;\">
            <button type=\"button\" class=\"btn btn-info btn-sdq-edit\" id=\"" . $row['id'] . "\"><i class=\"icon-plus icon-large\"></i> แก้ไข</button>
            <button type=\"button\" class=\"btn btn-warning btn-sdq-delete\" id=\"" . $row['id'] . "\"><i class=\"icon-plus icon-large\"></i> ลบ</button>
            </td>";
            }
            $output .= "</tr> ";
        }

        echo $output;
    }

    //---- ของฟลุค
    public function hr_homeroom_sdq_base() {
        $this->load->view("layout/header");
        $this->load->view("homeroom/hr_homeroom_sdq_base");
        $this->load->view("layout/footer");
    }

    public function student_list_by_filter() {
        $EdYear = $this->input->post('edyear');
        $Term = $this->input->post('term');

        $roomid = $this->input->post("roomid");

        $output = "";


        $Student = $this->Std_model->get_std_base_w_roomid_return_array($roomid);
        if ($Student) {
            foreach ($Student as $Std) {
                $output .= "<tr>";
                $output .= "<td style='text-align: center;'>" . $Std['std_number'] . "</td>";
                $output .= "<td style='text-align: center;'>" . $Std['std_code'] . "</td>";
                $output .= "<td>" . $Std['std_fullname'] . "</td>";

//                SELECT tb_student_base_id,tb_sdq_type,sum(tb_std_icare_sdq_score_score) FROM `tb_std_icare_sdq_score` a inner join tb_icare_sdq b on a.tb_icare_sdq_id = b.id inner join tb_icare_sdq_type c on b.tb_icare_sdq_type = c.id inner join tb_student_base d on a.tb_student_base_id = d.id where a.tb_std_icare_sdq_score_assessor = 'Teacher' and a.tb_std_icare_sdq_score_term = 1 and a.tb_std_icare_sdq_score_edyear = 2562 group by tb_student_base_id,tb_sdq_type

                $output .= "<td style='text-align: center;'>";
                $chk = $this->Icare_model->checkCompleteSDQ($Std['StdId'], 'Teacher', $Term, $EdYear);
                if ($chk) {
                    $output .= "<button type='button' class='btn btn-primary' onclick='HrHomeRoomSDQ(this)' id='" . $Std['StdId'] . "' ><i class='icon-print icon-large'></i> ครู</button>";
                } else {
                    $output .= "<button type='button' class='btn btn-primary' onclick='HrHomeRoomSDQ(this)' id='" . $Std['StdId'] . "' ><i class='icon-edit icon-large'></i> ครู</button>";
                }
//                $chk = $this->Icare_model->checkCompleteSDQ($Std['StdId'], 'Parent', $Term, $EdYear);
//                if ($chk) {
//                    $output .= "&nbsp;<button type='button' class='btn btn-warning' onclick='ParentSDQ(this)' id='" . $Std['StdId'] . "' ><i class='icon-file icon-large'></i> ผู้ปกครอง</button>";
//                } else {
//                    $output .= "&nbsp;<button type='button' class='btn btn-warning' onclick='ParentSDQ(this)' id='" . $Std['StdId'] . "' ><i class='icon-edit icon-large'></i> ผู้ปกครอง</button>";
//                }
//                $chk = $this->Icare_model->checkCompleteSDQ($Std['StdId'], 'Parent', $Term, $EdYear);
//                if ($chk) {
//                    $output .= "&nbsp;<button type='button' class='btn btn-success' onclick='StudentSDQ(this)' id='" . $Std['StdId'] . "' ><i class='icon-file icon-large'></i> นักเรียน</button>";
//                } else {
//                    $output .= "&nbsp;<button type='button' class='btn btn-success' onclick='StudentSDQ(this)' id='" . $Std['StdId'] . "' ><i class='icon-edit icon-large'></i> นักเรียน</button>";
//                }
                $output .= "</td>";
                $output .= "</tr>";
            }
        }
        echo $output;
    }

    public function student_sdq_show() {
        $StdId = $this->input->post('id');

        $Term = $this->input->post('term');
        $EdYear = $this->input->post('edyear');

        $Assessor = "Teacher";
        $output = "";

        $Student = $this->Std_model->get_std_base_w_stdid($StdId);

        $chk = $this->Icare_model->checkCompleteSDQ($StdId, $Assessor, $Term, $EdYear);
        if ($chk) {
            $output .= $this->Icare_model->getSDQChart($Assessor, $StdId, $Term, $EdYear);
        }


        $output .= "<center>";
        $output .= "<div style='margin: 30px 0px;line-height: 35px;font-size: 20px;font-weight: bold;'>แบบครูประเมินนักเรียน (SDQ)</div>";
        $output .= "</center>";
        $output .= "<div class='row'>";
        $output .= "<div style='margin-left:5%;'>";

        $output .= "<span>";
        $output .= "<div class='row-title'style='float: left;margin-left:5px;'>";
        $output .= "ชื่อ-สกุล นักเรียนที่รับการประเมิน";
        $output .= "</div> ";
        $output .= "<div class='row-content' style='float: left;font-weight: bold;'>";
        $output .= $Student['std_fullname'];
        $output .= "</div>";
        $output .= "</span>";

        $output .= "<span>";
        $output .= "<div class='row-title'style='float: left;margin-left:5px;'>";
        $output .= "ชั้น";
        $output .= "</div> ";
        $output .= "<div class='row-content' style='float: left;font-weight: bold;'>";
        $output .= $Student['std_classname'] . "/" . $Student['std_room_number'];
        $output .= "</div>";
        $output .= "</span>";

        $output .= "<span>";
        $output .= "<div class='row-title'style='float: left;margin-left:5px;'>";
        $output .= "เลขที่";
        $output .= "</div> ";
        $output .= "<div class='row-content' style='float: left;font-weight: bold;'>";
        $output .= $Student['std_number'];
        $output .= "</div>";
        $output .= "</span>";


        $output .= "<span>";
        $output .= "<div class='row-title'style='float: left;margin-left:5px;'>";
        $output .= "วัน/เดือน/ปี เกิด";
        $output .= "</div> ";
        $output .= "<div class='row-content' style='float: left;font-weight: bold;'>";
//        $output .= datethaifull($Student['std_birthday']);
        $output .= "</div>";
        $output .= "</span>";

        $output .= "<span>";
        $output .= "<div class='row-title'style='float: left;margin-left:5px;'>";
        $output .= "เพศ";
        $output .= "</div> ";
        $output .= "<div class='row-content' style='float: left;font-weight: bold;'>";
        $output .= $Student['std_gender'];
        $output .= "</div>";
        $output .= "</span>";

        $output .= "<span>";
        $output .= "<div class='row-title'style='float: left;margin-left:5px;'>";
        $output .= "ประจำภาคเรียนที่";
        $output .= "</div> ";
        $output .= "<div class='row-content' style='float: left;font-weight: bold;'>";
        $output .= $Term;
        $output .= "</div>";
        $output .= "</span>";

        $output .= "<span>";
        $output .= "<div class='row-title'style='float: left;margin-left:5px;'>";
        $output .= "ปีการศึกษา";
        $output .= "</div> ";
        $output .= "<div class='row-content' style='float: left;font-weight: bold;'>";
        $output .= $EdYear;
        $output .= "</div>";
        $output .= "</span>";



        $output .= "</div>";
        $output .= "</div>";
        $output .= "<label class='control-label' style='font-size:0.9em;'><u>คำชี้แจง</U> ให้ทำเครื่องหมาย <i class='icon-ok icon-large'></i> ในช่องท้ายหัวข้อให้ครบทุกข้อ กรุณาตอบให้ตรงกับความเป็นจริงที่เกิดขึ้นในช่วง 6 เดือน</label></br>";

        $output .= "<input type='hidden' id='StdId' value='" . $StdId . "' />";
        $output .= "<input type='hidden' id='Assessor' value='Teacher' />";

        $output .= "<table class='table table-hover table-bordered display'>";
        $output .= "<thead>";
        $output .= "<tr>";
        $output .= "<th style='width: 10%;text-align: center;'>ที่</th>";
        $output .= "<th style='width: 60%;text-align: center;'>พฤติกรรมประเมิน</th> ";
        $output .= "<th style='width: 10%;text-align: center;'>จริง</th>";
        $output .= "<th style='width: 10%;text-align: center;'>อาจจะจริง</th>";
        $output .= "<th style='width: 10%;text-align: center;'>ไม่จริง</th>";
        $output .= "</tr>";
        $output .= "</thead>";

        $SDQType = $this->My_model->get_where_order('tb_icare_sdq_type', array('tb_sdq_type_department' => $this->session->userdata('department')), 'id asc');

        $output .= "<tbody>";
        foreach ($SDQType as $rType) {
            $output .= "<tr>";
            $output .= "<td style='width: 100%;text-align: left;' colspan='5'>&nbsp;&nbsp;&nbsp;&nbsp;" . $rType['tb_sdq_type'] . "</td>  ";
            $output .= "</tr>";
            $SDQArray = $this->My_model->get_where_order('tb_icare_sdq', array('tb_icare_sdq_type' => $rType['id']), 'tb_icare_sdq_seq asc');
            foreach ($SDQArray as $rSDQ) {
                $output .= "<tr>";
                $output .= "<td style='width: 5%;text-align: center;'>" . $rSDQ['tb_icare_sdq_seq'] . "</td>";
                $output .= "<td style='width: 45%;text-align: left;'>" . $rSDQ['tb_icare_sdq_topic'] . "</td>";
                if ($rSDQ['tb_icare_sdq_zero_points'] != "T") {

                    $rRecord = $this->My_model->get_where_row('tb_std_icare_sdq_score', array('tb_std_icare_sdq_score_assessor' => $Assessor, 'tb_student_base_id' => $StdId, 'tb_icare_sdq_id' => $rSDQ['id']));
//                $output .= "<input value='" . $Assessor . "/" . $StdId . "/" . $rType['id'] . "' />";

                    if (isset($rRecord['tb_std_icare_sdq_score_score'])) {

                        switch ($rRecord['tb_std_icare_sdq_score_score']) {
                            case 2:
                                $output .= "<td class='TdSelect' id='R," . $rRecord['id'] . ",2' onclick='SelectThisTd(this)'><i class='icon-ok icon-large'></i></td>";
                                $output .= "<td class='TdSelect' id='R," . $rRecord['id'] . ",1' onclick='SelectThisTd(this)'></td>";
                                $output .= "<td class='TdSelect' id='R," . $rRecord['id'] . ",0' onclick='SelectThisTd(this)'></td>";
                                break;
                            case 1:
                                $output .= "<td class='TdSelect' id='R," . $rRecord['id'] . ",2' onclick='SelectThisTd(this)'></td>";
                                $output .= "<td class='TdSelect' id='R," . $rRecord['id'] . ",1' onclick='SelectThisTd(this)'><i class='icon-ok icon-large'></i></td>";
                                $output .= "<td class='TdSelect' id='R," . $rRecord['id'] . ",0' onclick='SelectThisTd(this)'></td>";
                                break;
                            case 0:
                                $output .= "<td class='TdSelect' id='R," . $rRecord['id'] . ",2' onclick='SelectThisTd(this)'></td>";
                                $output .= "<td class='TdSelect' id='R," . $rRecord['id'] . ",1' onclick='SelectThisTd(this)'></td>";
                                $output .= "<td class='TdSelect' id='R," . $rRecord['id'] . ",0' onclick='SelectThisTd(this)'><i class='icon-ok icon-large'></i></td>";
                                break;
                        }
                    } else {
                        $output .= "<td style='background:grey;' class='TdSelect' id='F," . $rSDQ['id'] . ",2' onclick='SelectThisTd(this)'></td>";
                        $output .= "<td style='background:grey;' class='TdSelect' id='F," . $rSDQ['id'] . ",1' onclick='SelectThisTd(this)'></td>";
                        $output .= "<td style='background:grey;' class='TdSelect' id='F," . $rSDQ['id'] . ",0' onclick='SelectThisTd(this)'></td>";
                    }
                } else {

                    $rRecord = $this->My_model->get_where_row('tb_std_icare_sdq_score', array('tb_std_icare_sdq_score_assessor' => $Assessor, 'tb_student_base_id' => $StdId, 'tb_icare_sdq_id' => $rSDQ['id']));
//                $output .= "<input value='" . $Assessor . "/" . $StdId . "/" . $rType['id'] . "' />";

                    if (isset($rRecord['tb_std_icare_sdq_score_score'])) {

                        switch ($rRecord['tb_std_icare_sdq_score_score']) {
                            case 0:
                                $output .= "<td class='TdSelect' id='R," . $rRecord['id'] . ",0' onclick='SelectThisTd(this)'><i class='icon-ok icon-large'></i></td>";
                                $output .= "<td class='TdSelect' id='R," . $rRecord['id'] . ",1' onclick='SelectThisTd(this)'></td>";
                                $output .= "<td class='TdSelect' id='R," . $rRecord['id'] . ",2' onclick='SelectThisTd(this)'></td>";
                                break;
                            case 1:
                                $output .= "<td class='TdSelect' id='R," . $rRecord['id'] . ",0' onclick='SelectThisTd(this)'></td>";
                                $output .= "<td class='TdSelect' id='R," . $rRecord['id'] . ",1' onclick='SelectThisTd(this)'><i class='icon-ok icon-large'></i></td>";
                                $output .= "<td class='TdSelect' id='R," . $rRecord['id'] . ",2' onclick='SelectThisTd(this)'></td>";
                                break;
                            case 2:
                                $output .= "<td class='TdSelect' id='R," . $rRecord['id'] . ",0' onclick='SelectThisTd(this)'></td>";
                                $output .= "<td class='TdSelect' id='R," . $rRecord['id'] . ",1' onclick='SelectThisTd(this)'></td>";
                                $output .= "<td class='TdSelect' id='R," . $rRecord['id'] . ",2' onclick='SelectThisTd(this)'><i class='icon-ok icon-large'></i></td>";
                                break;
                        }
                    } else {
                        $output .= "<td style='background:grey;' class='TdSelect' id='F," . $rSDQ['id'] . ",0' onclick='SelectThisTd(this)'></td>";
                        $output .= "<td style='background:grey;' class='TdSelect' id='F," . $rSDQ['id'] . ",1' onclick='SelectThisTd(this)'></td>";
                        $output .= "<td style='background:grey;' class='TdSelect' id='F," . $rSDQ['id'] . ",2' onclick='SelectThisTd(this)'></td>";
                    }
                }
                $output .= "</tr>";
            }
        }



        $output .= "</tbody>";
        $output .= "</table>";



        echo $output;
    }

    public function student_insert_sdq_score() {
        $Score = $this->input->post('Score');
        $SdqId = $this->input->post('SdqId');
        $StdId = $this->input->post('StdId');
        $Assessor = $this->input->post('Assessor');
        $Status = $this->input->post('status');

        $Term = $this->input->post('term');
        $EdYear = $this->input->post('edyear');

        if ($Status != "R") {
            $arr = array(
                'tb_student_base_id' => $StdId,
                'tb_icare_sdq_id' => $SdqId,
                'tb_std_icare_sdq_score_assessor' => $Assessor,
                'tb_std_icare_sdq_score_term' => $Term,
                'tb_std_icare_sdq_score_edyear' => $EdYear,
                'tb_std_icare_sdq_score_score' => $Score,
                'tb_std_icare_sdq_score_recorder' => $this->session->userdata('name'),
                'tb_std_icare_sdq_score_department' => $this->session->userdata('department'),
                'tb_std_icare_sdq_score_createdate' => date('Y-m-d')
            );
            $this->My_model->insert_data("tb_std_icare_sdq_score", $arr);
        } else {
            $arr = array(
                'tb_std_icare_sdq_score_score' => $Score
            );
            $this->My_model->update_data("tb_std_icare_sdq_score", array("id" => $SdqId), $arr);
        }

        return $EdYear;
    }
    
    public function get_std_base_list() {

        $cid = $_POST['cid'];
        $edyear = $_POST['edyear'];
        $edterm = $_POST['edterm'];

        $this->db->select("CONCAT (a.std_titlename,a.std_firstname,\" \",a.std_lastname) as std_fullname,a.id as StdId");

        $this->db->select("a.*,d.*");
        $this->db->from("tb_student_base a");
        $this->db->join("tb_std_before_register b", "a.id = b.tb_student_base_id");
        $this->db->join("tb_ed_school_register_class c", "b.tb_ed_school_register_class_id = c.id");
        $this->db->join("tb_ed_school_class d", "d.id=c.tb_ed_school_class_id");
        if ($edyear != "") {
            $this->db->where("c.tb_ed_school_register_class_edyear", $edyear);
        }
        if ($cid != "") {
            $this->db->where("c.id", $cid);
        }

        $this->db->order_by("a.std_code asc");
        $MyQ = $this->db->get();
        if ($MyQ->num_rows() > 0) {
            $StdArr = $MyQ->result();
        } else {
            $StdArr = "FALSE";
        }


        $op = "";

        $op .= "<table class=\"table table-hover table-striped table-bordered display\" id=\"example\">";
        $op .= "<thead>";
        $op .= "<tr>";
        $op .= "<th style=\"width:5%;\">ที่</th>";
        $op .= "<th style=\"width:15%;\" class=\"no-sort\">รหัสนักเรียน</th>";
        $op .= "<th  class=\"no-sort\">ชื่อ-นามสกุล</th>";
        $op .= "<th style='text-align: center;'><i class='icon-print'></i> รายงานการประเมิน</th>";
        $op .= "</tr>";
        $op .= "</thead>";

        if ($StdArr != "FALSE") {
            $op .= "<tbody>";
            $i = 1;

            foreach ($StdArr as $row) {

                $op .= "<tr>";
                $op .= "<td style=\"text-align:center;\">" . $i . "</td>";
                $op .= "<td style=\"text-align:center;\">" . $row->std_code . "</td>";
                $op .= "<td style=\"text-align:left;\">" . $row->std_fullname . "</td>";
                $op .= "<td style=\"text-align:center;\">";
                $chk = $this->Icare_model->checkCompleteSDQ($row->StdId, 'Teacher', $edterm, $edyear);
                if ($chk) {
                    $op .= "<button type='button' class='btn btn-primary' onclick='HrHomeRoomSDQ(this)' id='" . $row->StdId . "' ><i class='icon-print icon-large'></i> ครู</button>";
                } else {
                    $op .= "<button type='button' class='btn btn-primary' onclick='HrHomeRoomSDQ(this)' id='" . $row->StdId  . "' ><i class='icon-edit icon-large'></i> ครู</button>";
                }
//                $chk = $this->Icare_model->checkCompleteSDQ($Std['StdId'], 'Parent', $Term, $EdYear);
//                if ($chk) {
//                    $op .= "&nbsp;<button type='button' class='btn btn-warning' onclick='ParentSDQ(this)' id='" . $Std['StdId'] . "' ><i class='icon-file icon-large'></i> ผู้ปกครอง</button>";
//                } else {
//                    $op .= "&nbsp;<button type='button' class='btn btn-warning' onclick='ParentSDQ(this)' id='" . $Std['StdId'] . "' ><i class='icon-edit icon-large'></i> ผู้ปกครอง</button>";
//                }
//                $chk = $this->Icare_model->checkCompleteSDQ($Std['StdId'], 'Parent', $Term, $EdYear);
//                if ($chk) {
//                    $op .= "&nbsp;<button type='button' class='btn btn-success' onclick='StudentSDQ(this)' id='" . $Std['StdId'] . "' ><i class='icon-file icon-large'></i> นักเรียน</button>";
//                } else {
//                    $op .= "&nbsp;<button type='button' class='btn btn-success' onclick='StudentSDQ(this)' id='" . $Std['StdId'] . "' ><i class='icon-edit icon-large'></i> นักเรียน</button>";
//                }
                 $op .= "</td>";
        
                
                $op .= "</tr>";
                $i++;
            }
            $op .= "</tbody>";
        }

        $op .= "</table>";
        echo $op;
    }
    
    

}
