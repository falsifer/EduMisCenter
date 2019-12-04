<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/*
  | ----------------------------------------------------------------------------
  |  Title
  | ----------------------------------------------------------------------------
  | Copyright	Edutech Co.,Ltd.
  | Purpose     งานประเมิน
  | Author      chairatto
  | Create Date 11/5/2019
  | Last edit	11/5/2019
  | Comment	-
  | ----------------------------------------------------------------------------
 */

Class Performance_assessment extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model("My_model");
    }

    public function performance_assessment_base() {
//        $data['rs'] = $this->Ap_model->ap_base();
        $this->load->view("layout/header");
        $this->load->view("performance_assessment/performance_assessment_base");
        $this->load->view("layout/footer");
    }

    //---- ดึงหัวข้อในระบบ
    public function get_ap_topic() {
        echo $this->Ap_model->get_ap_topic();
    }

    //---- เพิ่มหัวข้อ
    public function topic_insert() {
        $content = $_POST['content'];
        $arr = array(
            "tb_assessment_personal_topic_content" => $content,
            "tb_assessment_personal_topic_recorder" => $this->session->userdata('name'),
            "tb_assessment_personal_topic_department" => $this->session->userdata('department'),
            "tb_assessment_personal_topic_createdate" => date('Y-m-d')
        );
        $this->My_model->insert_data('tb_assessment_personal_topic', $arr);
    }

    //---- การประเมินผล
    public function get_hr_ap() {
        $id = $_POST['id'];
        echo $this->Ap_model->get_hr_ap($id);
    }

    //---- 
    public function ap_pass() {
        $id = $_POST['id'];
        $Hrid = $_POST['Hrid'];

        $arr = array(
            "tb_hr_id" => $Hrid,
            "tb_assessment_personal_topic_id" => $id,
            "tb_assessment_personal_result_status" => "pass",
            "tb_assessment_personal_result_recorder" => $this->session->userdata('name'),
            "tb_assessment_personal_result_department" => $this->session->userdata('department'),
            "tb_assessment_personal_result_createdate" => date('Y-m-d')
        );
        $this->My_model->insert_data('tb_assessment_personal_result', $arr);
    }

    public function ap_fail() {
        $id = $_POST['id'];
        $this->My_model->delete_data("tb_assessment_personal_result", array("id" => $id));
    }

    //---- ดึงหัวข้อในระบบ
    public function get_ap_result() {
        $id = $_POST['id'];
        echo $this->Ap_model->get_ap_result($id);
    }

}
