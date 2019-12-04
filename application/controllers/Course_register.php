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
  | Create Date 15/2/2562
  | Last edit	3/3/2562
  | Comment	แก้บัค Checkbox
  | ----------------------------------------------------------------------------
 */

Class Course_register extends CI_Controller {

    public function __construct() {
        parent::__construct();
        if ($this->session->userdata('status') == "") {
            redirect("/");
        }
        $this->load->model("My_model");
        $this->load->model("Cm_model");
        $this->load->model("Cr_model");
        $this->load->model("Chairatto_model");
        $this->load->model("Std_model");
    }

    //------------------ ลงทะเบียนเรียน
    public function cr_base() {
        $this->load->view("layout/header");
        $this->load->view("course_register/cr_base");
        $this->load->view("layout/footer");
    }

    public function cr_std_modal() {
        $id = $_POST['id'];

        $output = "";


        $Student = $this->Std_model->get_std_base_w_stdid_return_row($id);

        $course = $this->Cr_model->get_course_list_by_stdid($Student[0]['StdId']);

//        $output .= "<div class=\"col-md-3 col-md-offset-1\">";
//
//        $output .= "</div>";

//        $output .= "<div class=\"col-md-8\">";

        $output .= "<b>วิชาที่ลงทะเบียนไว้แล้ว</b>";
        $output .= "<br/>";
        $output .= "<table class=\"table table-hover table-striped table-bordered display\" id=\"CourseBody\">";
        $output .= "<thead>";
        $output .= "<tr>";
        $output .= "<th style=\"text-align: center; width:5%;\">ที่</th>";
        $output .= "<th style=\"text-align: center; width:15%;\" class=\"no-sort\">รหัสวิชา</th>";
        $output .= "<th style=\"text-align: center; width:40%;\" class=\"no-sort\">ชื่อวิชา</th>";
        $output .= "<th style=\"text-align: center; width:20%;\" class=\"no-sort\">ประเภทวิชา</th>";
        $output .= "<th style=\"text-align: center; width:10%;\" class=\"no-sort\">หน่วยกิต</th>";
        $output .= "<th style=\"text-align: center; width:10%;\" class=\"no-sort\"></th>";
        $output .= "</tr>";
        $output .= "</thead>";

        $output .= "<tbody>";

        $ii = 1;
        foreach ($course as $r) {

            $output .= "<tr>";
            $output .= "<td style=\"text-align: center;\">" . $ii . "</td>";
            $output .= "<td style=\"text-align: center;\">" . $r['tb_course_code'] . "</td>";
            $output .= "<td style=\"text-align: center;\">" . $r['tb_subject_name'] . "</td>";
            $output .= "<td style=\"text-align: center;\">" . $r['tb_subject_type'] . "</td>";
            $output .= "<td style=\"text-align: center;\">" . $r['tb_course_credit'] . "</td>";
            $output .= "<td style=\"text-align: center;\">"
                    . "<button type=\"button\" class=\"btn btn-danger btn-registered-delete\" id=\"" . $r['id'] . "\" onclick=\"RegisteredDelete(this)\"><i class=\"icon-trash icon-large\"></i> ลบ</button>"
                    . "</td>";
            $output .= "<tr>";
            $ii++;
        }

        $output .= "</tbody>";
        $output .= "</table>";

//        $output .= "</div>";

        echo $output;
    }

    public function course_register_base() {
        $rid = $_POST['roomid'];
        $cid = $_POST['classid'];
        $edyear = $_POST['edyear'];
        $term = $_POST['term'];
        echo $this->Cr_model->course_register_base($rid, $cid, $edyear, $term);
    }

    //--------- เลื่อนชั้นแจ้งจบซ้ำชั้น
    public function class_management_base() {
        $this->load->view("layout/header");
        $this->load->view("course_register/class_management_base");
        $this->load->view("layout/footer");
    }

    public function get_std_registered_list() {
        $rid = $_POST['roomid'];
        $cid = $_POST['classid'];
        $edyear = $_POST['edyear'];
        echo $this->Cm_model->get_std_registered_list($rid, $cid, $edyear);
    }

    public function insert_repeat_class() {
        $id = $_POST['id'];
        $edyear = $_POST['edyear'];

        $arr = array(
            "tb_student_base_id" => $id,
            "tb_ed_repeat_classroom_edyear" => $edyear,
            "tb_ed_repeat_classroom_recorder" => $this->session->userdata('name'),
            "tb_ed_repeat_classroom_department" => $this->session->userdata('department'),
            "tb_ed_repeat_classroom_createdate" => date('Y-m-d')
        );

        $this->My_model->insert_data('tb_ed_repeat_classroom', $arr);
    }

    //----ลบการซ้ำชั้น
    public function clear_repeat_class() {
        $id = $_POST['id'];
        $this->My_model->delete_data('tb_ed_repeat_classroom', array('id' => $id));
    }

    public function cm_insert_graduate() {

        foreach ($_POST['inStdId'] as $StdId) {
            $arr = array(
                "tb_student_base_id" => $StdId,
                "tb_ed_graduate_date" => $this->input->post('inGradDate'),
                "tb_ed_graduate_recorder" => $this->session->userdata('name'),
                "tb_ed_graduate_department" => $this->session->userdata('department'),
                "tb_ed_graduate_createdate" => date('Y-m-d')
            );
            $this->My_model->insert_data('tb_ed_graduate', $arr);

            $arr = array(
                "tb_student_base_status" => "G"
            );

            $this->My_model->update_data('tb_student_base', array('id' => $StdId), $arr);
        }
    }

    public function cm_insert_room() {

        $planid = $_POST['PlanId'];
        $roomnum = $_POST['RoomNum'];
        $stdamount = $_POST['StdAmount'];
        $registerid = $_POST['RegisterId'];

        $arr = array(
            "tb_ed_plan_id" => $planid,
            "tb_classroom_room" => $roomnum,
            "tb_classroom_student_amount" => $stdamount,
            "tb_ed_school_register_class_id" => $registerid,
            "tb_ed_classroom_recoder" => $this->session->userdata('name'),
            "tb_ed_classroom_department" => $this->session->userdata('department')
        );

        $this->My_model->insert_data('tb_ed_room', $arr);
    }

    public function cm_insert_class_upgrade() {
        $Stdarr = explode(',', $this->input->post('inStdId'));
        foreach ($Stdarr as $StdId) {
            if ($StdId != "") {
                $this->db->select("*")->from("tb_ed_classroom");
                $this->db->where("tb_ed_room_id", $this->input->post('inNextRoomId'));
                $this->db->where("tb_student_base_id", $StdId);
                $myQ = $this->db->get()->result_array();

                if (count($myQ) > 0) {
                    
                } else {
                    $arr = array(
                        "tb_ed_classroom_number" => $this->input->post('inStdNumber' . $StdId),
                        "tb_ed_room_id" => $this->input->post('inNextRoomId'),
                        "tb_student_base_id" => $StdId
                    );
                    $this->My_model->insert_data('tb_ed_classroom', $arr);
                }
            }
        }
//        print_r($Stdarr);
    }

    public function register_course() {
        $Stdarr = explode(',', $_POST['StdIdArray']);
        foreach ($Stdarr as $StdId) {
            $NowStdId = $this->input->post('StdId' . $StdId);
            if ($NowStdId != "") {
                foreach ($_POST['CourseIdArray'] as $CId) {
                    $NowCId = $this->input->post('CourseId' . $CId);
                    if ($NowCId != "") {
                        $check = $this->Chairatto_model->count_w2c('tb_register_course', array("tb_student_base_id" => $NowStdId), array("tb_course_id" => $NowCId));
                        if ($check == 0) {
                            $arr = array(
                                "tb_student_base_id" => $this->input->post('StdId' . $StdId),
                                "tb_course_id" => $this->input->post('CourseId' . $CId)
                            );
                            $this->My_model->insert_data('tb_register_course', $arr);
                        }
                    }
                }
            }
        }
    }

    public function registered_delete() {
        if ($_POST['id'] != "") {
            $this->My_model->delete_data("tb_register_course", array("id" => $_POST['id']));
        }
    }

}
