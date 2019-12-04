<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/*
  | ----------------------------------------------------------------------------
  |  Title      School_calendar
  | ----------------------------------------------------------------------------
  | Copyright	Edutech Co.,Ltd.
  | Purpose     School_calendar
  | Author
  | Create Date
  | Last edit	-
  | Comment	-
  | ----------------------------------------------------------------------------
 */

Class School_calendar extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model("My_model");
    }

    // บันทึกข้อมูล
    public function activity_plan_add() {
        $id = $_POST['id'];

        if ($id != "") {
            $arr = array(
                "tb_activity_plan_subject" => $this->input->post('inActivityPlanSubject'),
                "tb_activity_plan_type" => $this->input->post('inActivityPlanType'),
                "tb_activity_plan_detail" => $this->input->post('inActivityPlanDetail'),
                "tb_activity_plan_place" => $this->input->post('inActivityPlanPlace'),
                "tb_activity_plan_start_date" => $this->input->post('inActivityPlanStartDate'),
                "tb_activity_plan_end_date" => $this->input->post('inActivityPlanEndDate'),
                "tb_activity_plan_public" => $this->input->post('inActivityPlanPublic'),
                "tb_activity_plan_responsible" => $this->input->post('inActivityPlanDivision'),
                "tb_activity_plan_update_date" => date('Y-m-d H:i:s'),
                "tb_activity_plan_update_by" => $this->session->userdata("name")
            );

            $this->My_model->update_data('tb_activity_plan', array('id' => $id), $arr);
        } else {
            $arr = array(
                "tb_activity_plan_subject" => $this->input->post('inActivityPlanSubject'),
                "tb_activity_plan_type" => $this->input->post('inActivityPlanType'),
                "tb_activity_plan_detail" => $this->input->post('inActivityPlanDetail'),
                "tb_activity_plan_place" => $this->input->post('inActivityPlanPlace'),
                "tb_activity_plan_start_date" => $this->input->post('inActivityPlanStartDate'),
                "tb_activity_plan_end_date" => $this->input->post('inActivityPlanEndDate'),
                "tb_activity_plan_public" => $this->input->post('inActivityPlanPublic'),
                "tb_activity_plan_status" => "A",
                "tb_activity_plan_responsible" => $this->input->post('inActivityPlanDivision'),
                "tb_school_id" => $this->session->userdata('sch_id'),
                "tb_activity_plan_create_date" => date('Y-m-d H:i:s'),
                "tb_activity_plan_department" => $this->session->userdata('department'),
                "tb_activity_plan_recorder" => $this->session->userdata("name")
            );
            $this->My_model->insert_data("tb_activity_plan", $arr);
        }
    }

    // แก้ไขข้อมูล
    public function activity_plan_edit() {
        $id = $_POST['id'];
        $rs = $this->My_model->get_where_row('tb_activity_plan', array('id' => $id));
        echo json_encode($rs);
    }

    // ลบข้อมูล
    public function activity_plan_delete() {
        $id = $_POST['id'];
        $this->My_model->delete_data('tb_activity_plan', array('id' => $id));
    }

    public function get_activity_plan_detail_by_id() {
        $id = $_POST['id'];
        $Detail = $this->My_model->get_where_row('tb_activity_plan', array('id' => $id));
        $output = "";

        $output .= "<legend> เรื่อง : " . $Detail['tb_activity_plan_type'] . $Detail['tb_activity_plan_subject'] . " ประจำ " . $Detail['tb_activity_plan_responsible'] . "</legend>";
        $output .= "<p>สถานที่ : " . $Detail['tb_activity_plan_place'] . "ตั้งแต่วันที่ " . datethaifull($Detail['tb_activity_plan_start_date']) . " จนถึงวันที่ " . datethaifull($Detail['tb_activity_plan_end_date']) . "</p>";
        $output .= "<br/><p>" . $Detail['tb_activity_plan_detail'] . "</p>";

        echo $output;
    }

    public function get_task_list_detail_by_id() {
        $id = $_POST['id'];
        $Detail = $this->My_model->get_where_row('tb_personal_activities', array('id' => $id));
        $output = "";

        $output .= "<legend> เรื่อง : " . $Detail['activities_name'] . " " . $Detail['activities_group'] . "</legend>";
        $output .= "<p>สถานที่ : " . $Detail['activities_place'] . "ตั้งแต่วันที่ " . datethaifull($Detail['activities_begin']) . " จนถึงวันที่ " . datethaifull($Detail['activities_end']) . "</p>";
        $output .= "<br/><p>" . $Detail['activities_comment'] . "</p>";

        echo $output;
    }

}
