<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/*
  | ----------------------------------------------------------------------------
  |  Title      Vichakarn
  | ----------------------------------------------------------------------------
  | Copyright	Edutech Co.,Ltd.
  | Purpose     Vichakarn Controller (School Zone)
  | Author
  | Create Date
  | Last edit	-
  | Comment	-
  | ----------------------------------------------------------------------------
 */

Class Manpower extends CI_Controller {

    public function __construct() {
        parent::__construct();
        if ($this->session->userdata('status') == "") {
            redirect("/");
        }
        $this->load->model('Hr_model');
        $this->load->model('Manpower_model');
        $this->load->model('Icare_model');
    }

    // index
    public function index() {

        if ($this->session->userdata('department') != "กองการศึกษา") {
            $data['hr'] = $this->Hr_model->get_hr();
            $data['mp'] = $this->Manpower_model->get_manpower();
//            $data['workStat'] = $this->Manpower_model->get_all_absent();
//            $data['TaStat'] = $this->My_model->count_record_where('tb_human_resources_01', array('hr_office' => $this->session->userdata('department')));
//            $data['StdStat'] = $this->My_model->count_record_where('tb_student_base', array('tb_student_base_department' => $this->session->userdata('department')));
//            $data['TaGroupL'] = $this->Manpower_model->get_ta_group_learning();
//            $data['HrGroup'] = $this->Manpower_model->get_hr_group();
            load_view($this, "human_resources/manpower", $data);
        } else {
//            $data['hr'] = $this->Hr_model->get_hr();
//            $data['mp'] = $this->Manpower_model->get_manpower();
//            $data['workStat'] = $this->Manpower_model->get_all_absent();
//            $data['TaStat'] = $this->My_model->count_record_where('tb_human_resources_01', array('hr_office' => $this->session->userdata('department')));
//            $data['StdStat'] = $this->My_model->count_record_where('tb_student_base', array('tb_student_base_department' => $this->session->userdata('department')));
//            $data['TaGroupL'] = $this->Manpower_model->get_ta_group_learning();
//            $data['HrGroup'] = $this->Manpower_model->get_hr_group();


            $data['hr'] = $this->Hr_model->get_hr();
            $data['mp'] = $this->Manpower_model->get_manpower();
//            $data['workStat'] = $this->Manpower_model->get_all_absent();
//            $data['TaStat'] = $this->My_model->count_record_where('tb_human_resources_01', array('hr_department' => $this->session->userdata('department')));
//            $data['StdStat'] = $this->My_model->count_record_where('tb_student_base', '1=1');
//            $data['TaGroupL'] = $this->Manpower_model->get_ta_group_learning();
//            $data['HrGroup'] = $this->Manpower_model->get_hr_group();
//
//            $data['absentStdStat'] = $this->Icare_model->get_all_absent();
//            $data['stdStat'] = $this->Icare_model->get_std_gender_stat();


            load_view($this, "human_resources/manpower_zone", $data);
        }



//        $this->load->view("layout/header");
//        $this->load->view("human_resources/manpower", $data);
//        $this->load->view('layout/footer');
    }

}
