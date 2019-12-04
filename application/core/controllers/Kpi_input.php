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

Class Kpi_input extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model("My_model");
        $this->load->model("Kpi_std_model");
    }

    public function kpi_base() {
        //$data['row'] = $this->My_model->get_all_order("tb_group_learning", "tb_group_learning_seq asc");
        //$data['rscourse'] = $this->My_model->get_all_order("tb_course", "id asc");
        //$data['rscourse'] = $this->Dcc_model->dc_base();
        $data['rs'] = $this->Kpi_std_model->kpi_base();
        $data['std'] = $this->My_model->get_all('tb_student_base');
        $this->load->view("layout/header");
        $this->load->view("kpi_input/kpi_base",$data);
        $this->load->view("layout/footer");
    }

    public function member() {
        if ($this->input->post('subject')) {
            echo $this->Dcc_model->fetch_member($this->input->post('subject'));
        }
    }

    public function sj_code() {
        $id = $this->input->post('id');
        $rs = $this->Dcc_model->code_subject($id);
        echo json_encode($rs);
    }

    public function sj_count() {
        $id = $this->input->post('id');
        $rs = $this->My_model->count_record_where('tb_course',array('tb_subject_id' => $id));
        echo json_encode($rs);
    }

    public function dc_code() {
        $id = $this->input->post('id');
        $rs = $this->Dcc_model->code_edit($id);
        echo json_encode($rs);
    }

    public function dc_modal_insert() {
        $arr = array(
            "tb_group_learning_id" => $this->input->post('inGroupLearningName'),
            "tb_subject_name" => $this->input->post('inSubjectName'),
            "tb_subject_abbreviation" => $this->input->post('inSubjectAbbreviation'),
            "tb_subject_type" => $this->input->post('inSubjectType'),
            "tb_subject_recorder" => $this->session->userdata('name'),
            "tb_subject_department" => $this->session->userdata('department')
        );
        $this->My_model->insert_data('tb_subject', $arr);
    }

    public function dc_insert() {
        $arr = array(
            "tb_subject_id" => $this->input->post('inSubject'),
            "tb_course_class" => $this->input->post('inCourseClass'),
            "tb_course_lev" => $this->input->post('inCourseLev'),
            "tb_course_hour_week" => $this->input->post('inCourseHourWeek'),
            "tb_course_hour_term" => $this->input->post('inCourseHourTerm'),
            "tb_course_credit" => $this->input->post('inCourseCredit'),
            "tb_course_credit_sp" => $this->input->post('inCourseCreditSp'),
            "tb_course_code" => $this->input->post('inCourseCode'),
            "tb_course_recorder" => $this->session->userdata('name'),
            "tb_course_department" => $this->session->userdata('department')
        );
        $this->My_model->insert_data('tb_course', $arr);
    }

}
