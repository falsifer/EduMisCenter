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

Class School_administrator extends CI_Controller {

    public function __construct() {
        parent::__construct();
        if ($this->session->userdata('status') == "") {
            redirect("/");
        }

        $this->load->model("My_model");
        $this->load->model("Std_model");
        $this->load->model("Adm_model");
    }

    //----------------ข้อมูลนักเรียน-------------------------------//
    //---------เรียก View---------//
    public function std_base() {

        $data['admintopic'] = $this->My_model->get_all_order("tb_school_administrator_topic", "tb_administrator_topic_type asc");
//        $data['icaretopic'] = $this->Adm_model->get_icare_topic();
        $data['icaretopic'] = $this->My_model->get_where_order('tb_icare_topic', array('tb_icare_group_id' => 4), 'id asc');
        $this->load->view("layout/header");
        $this->load->view("school_administrator/adm_base", $data);
        $this->load->view("layout/footer");
    }

    public function get_std_tbody_list() {
        $RoomId = $_POST['RoomId'];
        $ClassId = $_POST['ClassId'];
        $EdYear = $_POST['EdYear'];
        $StdStatus = "S";
        $output = "";

        $StdList = $this->Std_model->get_std_base_w_filter($RoomId, $ClassId, $EdYear, $StdStatus);

        if ($StdList) {
            foreach ($StdList as $r) {
                $output .= "<tr>";
                $output .= "<td style='text-align: center'>" . $r->std_number . "</td>";
                $output .= "<td style='text-align: center'>" . $r->std_fullname . "</td>";
                $output .= "<td style='text-align: center'>" . $r->std_classname . "</td>";

                $output .= "<td style='text-align: center'>";

                $Plus = $this->Adm_model->get_administrator_score_w_StdId($r->StdId, "Plus");
                $PlusScore = 0;
                if ($Plus) {
                    foreach ($Plus as $rPlus) {
                        $PlusScore += $rPlus['tb_administrator_topic_maxscore'];
                    }
                }

                $Minus = $this->Adm_model->get_administrator_score_w_StdId($r->StdId, "Minus");
                $MinusScore = 0;
                if ($Minus) {
                    foreach ($Minus as $rMinus) {
                        $MinusScore += $rMinus['tb_administrator_topic_maxscore'];
                    }
                }

                $output .= "<font color='green'>+ " . $PlusScore . "</font>";
                $output .= "&nbsp;<strong>|</strong>&nbsp;";
                $output .= "<font color='red'>- " . $MinusScore . "</font>";

                $output .= "<br/>";
                $output .= "<font color='blue'><strong>ผลรวมคะแนน " . (($PlusScore - $MinusScore) + 100) . " คะแนน</strong></font>";

                $output .= "</td>";

                $output .= "<td style='text-align: center'>";
//                $output .= "<button type='button' class='btn btn-primary btn-input' id='" . $r->StdId . "'><i class='icon-plus icon-large'></i> บันทึกคะแนน</button>";
                $output .= "&nbsp;<button type='button' class='btn btn-info btn-show' id='" . $r->StdId . "'><i class='icon-plus icon-large'></i> บันทึกคะแนน</button>";
                $output .= "</td>";

                $output .= "</tr>";
            }
        }

        echo $output;
    }

//-------- End view -------// 
//----- Code Edit ------//
//    public function std_edit() {
//        $id = $_POST['id'];
//        $rs = $this->Std_model->get_std_base_w_stdid_return_row($id);
//        echo json_encode($rs);
//    }

    public function score_modal() {
        $id = $_POST['id'];
        echo $this->Adm_model->get_admin_score($id);
    }

    public function std_adm_insert_score() {
        $arr = array(
            "tb_administrator_topic_id" => $this->input->post('inTopic'),
            "tb_student_base_id" => $this->input->post('Stdid'),
            "tb_std_administrator_score_recorder" => $this->session->userdata('name'),
            "tb_std_administrator_score_department" => $this->session->userdata('department'),
            "tb_std_administrator_score_createdate" => date('Y-m-d H:i:s')
        );

        $this->My_model->insert_data('tb_school_administrator_score', $arr);
    }

    public function adm_topic_insert() {

        $id = $this->input->post('id');

        $arr = array(
            "id" => $id,
            "tb_administrator_topic_content" => $this->input->post('topicname'),
            "tb_administrator_topic_type" => $this->input->post('topictype'),
            "tb_administrator_topic_maxscore" => $this->input->post('topicscore'),
            "tb_administrator_topic_recorder" => $this->session->userdata('name'),
            "tb_administrator_topic_department" => $this->session->userdata('department'),
            "tb_administrator_topic_department_id" => $this->session->userdata('sch_id'),
            "tb_administrator_topic_createdate" => date('Y-m-d')
        );

        if ($id != "") {
            $this->My_model->update_data('tb_school_administrator_topic', array('id' => $id), $arr);
        } else {
            $this->My_model->insert_data('tb_school_administrator_topic', $arr);
        }
    }

    public function school_administrator_base() {

        $topic = $this->My_model->get_where_order("tb_school_administrator_topic", array('tb_administrator_topic_department_id' => $this->session->userdata('sch_id')), "tb_administrator_topic_maxscore asc");
//        $data['icaretopic'] = $this->Adm_model->get_icare_topic();
//        $data['icaretopic'] = $this->My_model->get_where_order('tb_icare_topic', array('tb_icare_group_id' => 4), 'id asc');
        $output = "";

        $i = 1;

        foreach ($topic as $r) {
            $output .= "<tr>";
            $output .= "<td style='text-align: center;'>" . $i . "</td>";
            $output .= "<td style='text-align: center;'>" . $r['tb_administrator_topic_content'] . "</td>";

            $output .= "<td style='text-align: center;'>";
            if ($r['tb_administrator_topic_type'] == "Plus") {
                $output .= "<font color='blue'>เพิ่มคะแนน</font>";
            } else {
                $output .= "<font color='red'>ลดคะแนน</font>";
            }
            $output .= "</td>";
            $output .= "<td style='text-align: center;'>" . $r['tb_administrator_topic_maxscore'] . "</td>";
            $output .= "<td style='text-align: center;'>";

            if ($r['tb_administrator_topic_type'] == "Plus") {
                $output .= "";
            } else {
                if ($r['tb_administrator_topic_maxscore'] <= 10) {
                    $output .= "ความผิดพื้นฐานระดับ 1";
                } elseif ($r['tb_administrator_topic_maxscore'] <= 20) {
                    $output .= "ความผิดพื้นฐานระดับ 2";
                } elseif ($r['tb_administrator_topic_maxscore'] <= 30) {
                    $output .= "ความผิดขั้นค่อนข้างร้ายแรง";
                } elseif ($r['tb_administrator_topic_maxscore'] >= 30) {
                    $output .= "ความผิดขั้นร้ายแรง";
                }
            }
            $output .= "</td>";
            $output .= "<td style='text-align: center;'>";
            $output .= "<button type='button' class='btn btn-warning btn-edit' id='" . $r['id'] . "'><i class='icon-pencil icon-large'></i> แก้ไข</button>";
            $output .= "&nbsp;<button type='button' class='btn btn-danger btn-delete' id='" . $r['id'] . "'><i class='icon-trash icon-large'></i> ลบ</button>";
            $output .= "</td>";

            $output .= "</tr>";

            $i++;
        }
        $data['dept'] = $this->session->userdata('sch_id');
        $data['admintopiclist'] = $output;
        $this->load->view("layout/header");
        $this->load->view("school_administrator/school_administrator_base", $data);
        $this->load->view("layout/footer");
    }

    public function adm_topic_edit() {
        $id = $this->input->post('id');
        $rs = $this->My_model->get_where_row('tb_school_administrator_topic', array('id' => $id));
        echo json_encode($rs);
    }

    public function get_std_adm_score() {
        $id = $this->input->post('id');
        $rs = $this->Std_model->get_std_base_w_stdid_return_row($id);
        $output = "";


        $output .= "<legend>ข้อมูลคะแนนความประพฤติของนักเรียนรายบุคคล</legend>";
        $output .= "<input type='hidden' id='inStdId' name='inStdId' value='" . $rs[0]['StdId'] . "'/>";
        $output .= "<br/>";


        $output .= "<div  style='float: left;width:60%;padding:5px;'>";
        $output .= "<div style='float: left;width:30%;padding:5px;'>";
        $output .= "<center><img width='90%;' src='" . $rs[0]['std_profile_picture'] . "' /></center>";
        $output .= "</div>";
        $output .= "<div style='float: left;width:65%;padding:5px;font-size:0.9em;'>";
        $output .= "ชื่อ <strong>" . $rs[0]['std_fullname'] . "</strong> เลขที่ <strong>" . $rs[0]['std_number'] . "</strong>";
        $output .= "<p>รหัสนักเรียน <strong>" . $rs[0]['std_code'] . "</strong></p>";
        $output .= "<p>ระดับชั้น <strong>" . $rs[0]['std_classname'] . "</strong> ห้องที่ <strong>" . $rs[0]['std_room_number'] . "</strong> </p>";
        $output .= "</div>";
        $output .= "</div>";
        $output .= "<div style='float: right;width:25%;padding:5px;'>";
        $output .= "<table border='1' cellpadding='4' cellspacing='0' style='width:100%;font-size:1em !important;' >";
        $output .= "<tbody>";


        $output .= "<tr style='color:black;'>";
        $output .= "<td style='text-align: center;padding: 3px;'>คะแนนตั้งต้น</td>";
        $output .= "<td style='text-align: center;padding: 3px;'>100</td>";
        $output .= "</tr>";

        $plus = $this->Adm_model->get_administrator_score_w_StdId($rs[0]['StdId'], 'Plus');
        $plus_appd = "";
        $plus_sum = 0;
        $RecNum = 1;
        if ($plus) {
            $plus_appd .= "<tr>";
            $plus_appd .= "<td style='width:10%;text-align: left;padding: 3px;font-size:1.1em;color:green;' colspan='5'>คะแนนส่วนประพฤติดี</td> ";
            $plus_appd .= "</tr>";
            foreach ($plus as $p) {
                $plus_appd .= "<tr>";
                $plus_appd .= "<td style='width:10%;text-align: center;padding: 3px;font-size:0.8em;'>" . $RecNum . "</td> ";
                $plus_appd .= "<td style='width:40%;text-align: center;padding: 3px;font-size:0.8em;'>" . $p['tb_administrator_topic_content'] . "</td> ";
                $plus_appd .= "<td style='width:10%;text-align: center;padding: 3px;font-size:0.8em;'>" . $p['tb_administrator_topic_maxscore'] . " </td>";
                $plus_appd .= "<td style='width:20%;text-align: center;padding: 3px;font-size:0.8em;'>" . $p['tb_std_administrator_score_recorder'] . "</td>";
                $plus_appd .= "<td style='width:30%;text-align: center;padding: 3px;font-size:0.8em;'>" . datethaifull($p['tb_std_administrator_score_createdate']) . "<button type='button' id='" . $p['id'] . " ' class='btn btn-link' onclick='DeleteThisRecord(this)' ><i style='color:red;' class='icon-trash icon-large'></button></td>";
                $plus_appd .= "</tr>";
                $plus_sum += $p['tb_administrator_topic_maxscore'];
                $RecNum++;
            }
        }


        $output .= "<tr style='color:green;'>";
        $output .= "<td style='text-align: center;padding: 3px;'>คะแนนที่เพิ่ม</td>";
        $output .= "<td style='text-align: center;padding: 3px;'>" . $plus_sum . "</td>";
        $output .= "</tr>";

        $minus = $this->Adm_model->get_administrator_score_w_StdId($rs[0]['StdId'], 'Minus');
        $minus_appd = "";
        $minus_sum = 0;
        $RecNum = 1;
        if ($minus) {
            $minus_appd .= "<tr>";
            $minus_appd .= "<td style='width:10%;text-align: left;padding: 3px;font-size:1.1em;color:red;' colspan='5'>คะแนนส่วนประพฤติแย่</td> ";
            $minus_appd .= "</tr>";
            foreach ($minus as $p) {
                $minus_appd .= "<tr>";
                $minus_appd .= "<td style='width:10%;text-align: center;padding: 3px;font-size:0.8em;'>" . $RecNum . "</td> ";
                $minus_appd .= "<td style='width:40%;text-align: center;padding: 3px;font-size:0.8em;'>" . $p['tb_administrator_topic_content'] . "</td>";
                $minus_appd .= "<td style='width:10%;text-align: center;padding: 3px;font-size:0.8em;'>" . $p['tb_administrator_topic_maxscore'] . " </td>";
                $minus_appd .= "<td style='width:20%;text-align: center;padding: 3px;font-size:0.8em;'>" . $p['tb_std_administrator_score_recorder'] . "</td>";
                $minus_appd .= "<td style='width:30%;text-align: center;padding: 3px;font-size:0.8em;'>" . datethaifull($p['tb_std_administrator_score_createdate']) . "<button type='button' id='" . $p['id'] . " ' class='btn btn-link' onclick='DeleteThisRecord(this)' ><i style='color:red;' class='icon-trash icon-large'></button></td>";
                $minus_appd .= "</tr>";
                $minus_sum += $p['tb_administrator_topic_maxscore'];
                $RecNum++;
            }
        }


        $output .= "<tr style='color:red;'>";
        $output .= "<td style='text-align: center;padding: 3px;'>คะแนนที่ลด</td>";
        $output .= "<td style='text-align: center;padding: 3px;'>" . $minus_sum . "</td>";
        $output .= "</tr>";

        $output .= "</tbody>";

        $output .= "<tfoot>";
        $output .= "<tr style='color:blue;background-color: #eeeeee;'>";
        $output .= "<td style='text-align: center;padding: 3px;'>คะแนนปัจจุบัน</td>";
        $output .= "<td style='text-align: center;padding: 3px;'>" . (($plus_sum - $minus_sum) + 100) . "</td>";
        $output .= "</tr>";
        $output .= "</tfoot>";
        $output .= "</table>";
        $output .= "</div>";
//         $output .= "<div style='border-button:solid 1px black;width:100%;'>asdasdasdasd</div>";
        $output .= "<div style='clear:both;'></div>";
        $output .= "<hr/>";
        $output .= "<div style='clear:both;'></div>";
        $output .= "<center>";
        $output .= "<div style='width:90%;padding:5px;'>";
        $output .= "<strong>ประวัติการบันทึกคะแนน</strong>";
        $output .= "<table border='1' cellpadding='4' cellspacing='0' style='width:100%;font-size:0.9em;' >";
        $output .= "<thead>";
        $output .= "<tr style='background-color: #eeeeee;'>";
        $output .= "<th style='width:10%;text-align: center;padding: 3px;'>ที่</th>  ";
        $output .= "<th style='width:40%;text-align: center;padding: 3px;'>ข้อมูลการบันทึก</th>";
        $output .= "<th style='width:10%;text-align: center;padding: 3px;'>คะแนน</th>";
        $output .= "<th style='width:20%;text-align: center;padding: 3px;'>ผู้บันทึก</th>";
        $output .= "<th style='width:30%;text-align: center;padding: 3px;'>วันที่บันทึก</th>";
        $output .= "</tr>";
        $output .= "</thead>";
        $output .= "<tbody  name='inTbody' id='inTbody'>";

        $output .= "<tr >";
        $output .= "<td class='no-print' style='width:10%;text-align: center;padding: 3px;' colspan='4'>";
        $output .= "<select name='inAdmTopicScore' id='inAdmTopicScore' class='form-control'>";
        $output .= "<option value=''>--เลือกหัวข้อ--</option>";
        $Topic_list = $this->My_model->get_where_order('tb_school_administrator_topic', array('tb_administrator_topic_department_id' => $this->session->userdata('sch_id')), 'tb_administrator_topic_type,tb_administrator_topic_maxscore asc');
        foreach ($Topic_list as $t) {
            if ($t['tb_administrator_topic_type'] == "Minus") {
                $status = " ลด ";
            } else {
                $status = " เพิ่ม ";
            }

            $output .= "<option value='" . $t['id'] . "'>" . $status . $t['tb_administrator_topic_maxscore'] . " คะแนน | " . $t['tb_administrator_topic_content'] . "</option>";
        }

        $output .= "</td>";

        $output .= "<td  style='width:30%;text-align: center;padding: 3px;'>";
        $output .= "<button type='button' class='btn btn-info ' onclick='InsertStdTopicScore()'><i class='icon-plus icon-large'></i> เพิ่มข้อมูล</button>";
        $output .= "</td>";
        $output .= "</tr>";
        $output .= $plus_appd;
        $output .= $minus_appd;


        $output .= "</tbody>";
        $output .= " </table>";
        $output .= "</div> ";
        $output .= "</center>";


        echo $output;
    }

    public function admin_insert_std_topic_score() {
//        $id = $this->input->post('id');
        $arr = array(
            "tb_administrator_topic_id" => $this->input->post('topic'),
            "tb_student_base_id" => $this->input->post('stdid'),
            "tb_std_administrator_score_recorder" => $this->session->userdata('name'),
            "tb_std_administrator_score_department" => $this->session->userdata('department'),
            "tb_std_administrator_score_createdate" => date('Y-m-d'),
        );
        $this->My_model->insert_data('tb_school_administrator_score', $arr);
    }

    public function adm_topic_delete() {
        $id = $_POST['id'];
        $this->My_model->delete_data('tb_school_administrator_topic', array('id' => $id));
    }

    public function std_adm_delete_score() {
        $id = $_POST['id'];
        $this->My_model->delete_data('tb_school_administrator_score', array('id' => $id));
    }

}
