<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/*
  | ----------------------------------------------------------------------------
  |  Title
  | ----------------------------------------------------------------------------
  | Copyright	Edutech Co.,Ltd.
  | Purpose
  | Author	นายบัณฑิต ไชยดี
  | Create Date
  | Last edit	-
  | Comment	-
  | ----------------------------------------------------------------------------
 */

class SchoolLoan extends CI_Controller {

    public function __construct() {
        parent::__construct();
    }

    //
    public function index($type) {
        if ($type == "inside_loan") {
            $data['type'] = "ให้สถานศึกษาในสังกัด";
        } else {
            $data['type'] = "ให้สถานศึกษาที่ขอรับการสนับสนุน";
        }
        $data['school'] = $this->My_model->get_all_order('tb_school', 'sc_thai_name asc');
        $data['rs'] = $this->My_model->join2table_result('tb_school a', "tb_loan_management b", 'b.school_id = a.id', "school_loan_date asc");
        $this->load->view("layout/header");
        $this->load->view("school_loan/index", $data);
        $this->load->view("layout/footer");
    }

    // add data;
    public function loan_add() {
        $id = $_POST['id'];
        if ($id != "") {
            $arr = array(
                "school_id" => $this->input->post('inSchoolId'),
                "school_loan_date" => $this->input->post("inSchoolLoanDate"),
                "school_type_divide" => $this->input->post('inSchoolTypeDivide'),
                "school_level" => $this->input->post('inSchoolLevel'),
                "school_student_amount" => $this->input->post('inSchoolStudentAmount'),
                "school_student_recieve" => $this->input->post('inSchoolStudentRecieve'),
                "school_recieve_amount" => $this->input->post('inSchoolRecieveAmount'),
                "school_recorder" => $this->session->userdata('name'),
                "school_department" => $this->session->userdata("department")
            );
            $this->My_model->update_data("tb_loan_management", array("id" => $id), $arr);
        } else {
            $arr = array(
                "school_id" => $this->input->post('inSchoolId'),
                "school_loan_date" => $this->input->post("inSchoolLoanDate"),
                "school_type_divide" => $this->input->post('inSchoolTypeDivide'),
                "school_level" => $this->input->post('inSchoolLevel'),
                "school_student_amount" => $this->input->post('inSchoolStudentAmount'),
                "school_student_recieve" => $this->input->post('inSchoolStudentRecieve'),
                "school_recieve_amount" => $this->input->post('inSchoolRecieveAmount'),
                "school_recorder" => $this->session->userdata('name'),
                "school_department" => $this->session->userdata("department")
            );
            $this->My_model->insert_data('tb_loan_management', $arr);
        }
    }

    // edit data;
    public function loan_edit() {
        $id = $_POST['id'];
        $row = $this->My_model->join2table_row('tb_school a', 'tb_loan_management b', 'b.school_id = a.id', array('b.id' => $id));
        echo json_encode($row);
    }

    //delete
    public function loan_delete() {
        $id = $_POST['id'];
        $this->My_model->delete_data('tb_loan_management', array('id' => $id));
    }

}
