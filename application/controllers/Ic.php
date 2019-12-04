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
  | Create Date 11/2/2562
  | Last edit	11/2/2562
  | Comment	-
  | ----------------------------------------------------------------------------
 */

Class Ic extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model("My_model");
        $this->load->model("Ic_model");

        if ($this->session->userdata('status') == "") {
            redirect("/");
        }
    }

    public function ic_base() {
        $data['rDivision'] = $this->My_model->get_all_order("tb_division", "id asc");
        $data['rs'] = $this->My_model->get_all_order("tb_internal_control", "id asc");
        $this->load->view("layout/header");
        $this->load->view("ic/ic_base", $data);
        $this->load->view("layout/footer");
    }

    public function get_ic_topic() {
        $id = $_POST['id'];
        echo $this->Ic_model->get_ic_topic($id);
    }

    public function get_ic_topic_sub() {
        $id = $_POST['id'];
        $topicid = $_POST['topicid'];
        echo $this->Ic_model->get_ic_topic_sub($id, $topicid);
    }

    public function get_ic_element_result() {
        $id = $_POST['id'];
        echo $this->Ic_model->get_ic_element_result($id);
    }

    //---- เพิ่มหัวข้อ
    public function topic_insert() {
        $content = $_POST['content'];
        $sequence = $_POST['seq'];
        $divisionId = $_POST['division'];
        $Id = $_POST['id'];

        $arr = array(
            "tb_internal_control_topic_id" => $Id,
            "tb_division_id" => $divisionId,
            "tb_internal_control_topic_sub_sequence" => $sequence,
            "tb_internal_control_topic_sub_name" => $content,
            "tb_internal_control_topic_sub_recorder" => $this->session->userdata('name'),
            "tb_internal_control_topic_sub_department" => $this->session->userdata('department'),
            "tb_internal_control_topic_sub_createdate" => date('Y-m-d')
        );
        $this->My_model->insert_data('tb_internal_control_topic_sub', $arr);
    }

}
