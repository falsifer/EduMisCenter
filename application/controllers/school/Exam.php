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

Class Exam extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model("My_model");
        $this->load->model("Exam_model");

        //$this->load->library('mpdf/mpdf');
    }

    // index
    public function index() {
        
    }

    //---------------------------------------


    function report_exam_01() {
        if ($this->session->userdata('status') == '') {
            redirect('login');
        }

        $this->load->view("layout/header");

        $data['school'] = $this->My_model->get_where_row('tb_school', array('sc_thai_name' => $this->session->userdata("department")));
        $data['glv'] = $this->My_model->get_all('tb_organization');
        $this->load->view("vichakarn/reports/report_exam_01", $data);
//        $this->load->view("vichakarn/reports/report_exam_01");
        $this->load->view('layout/footer');
    }

    function report_exam_01_view() {
        $std = '';
        $stdcode = '';

        if (isset($_POST['inStdName']) && isset($_POST['inStdType'])) {
            if ($_POST['inStdType'] == 'std_code') {
                $stdcode = $_POST['inStdName'];
                $std = $stdcode;
            } else if ($_POST['inStdType'] == 'std_name') {
                $std = $_POST['inStdName'];
            } else if ($_POST['inStdType'] == 'std_idcard') {
                $std = $_POST['inStdName'];
            }
        }

        if ($this->Exam_model->check_std_data($std, $_POST['inStdType'])) {
            $data['school'] = $this->My_model->get_where_row('tb_school', array('sc_thai_name' => $this->session->userdata("department")));
            $data['glv'] = $this->My_model->get_all('tb_organization');
            $data['std'] = $this->Exam_model->get_std_data($std, $_POST['inStdType']);
            $data['mom'] = $this->Exam_model->get_std_family($stdcode, 'มารดา');
            $data['dad'] = $this->Exam_model->get_std_family($stdcode, 'บิดา');
            $data['chk'] = TRUE;
        } else {
            $data['school'] = $this->My_model->get_where_row('tb_school', array('sc_thai_name' => $this->session->userdata("department")));
        $data['glv'] = $this->My_model->get_all('tb_organization');
            $data['chk'] = FALSE;
        }
        
        $this->load->view('vichakarn/reports/report_exam_01_view', $data);
    }

    // print
    public function report_exam_01_print() {
        $data['inExam01'] = $_POST['inExam01'];
        $this->load->view('vichakarn/reports/report_exam_01_print', $data);
    }

}
