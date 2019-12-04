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

Class Account extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model("My_model");

        //$this->load->library('mpdf/mpdf');
    }

    // index
    public function index() {
        
    }

    public function financial() {
        if ($this->session->userdata('status') == '') {
            redirect('/');
        }
        $data['income'] = $this->My_model->get_where_order('tb_acc_income', array('tb_school_id' => $this->session->userdata("sch_id")), '');
        $data['bookbank'] = $this->My_model->get_where_order('tb_acc_bookbank', array('tb_acc_bookbank_department' => $this->session->userdata("department")), '');
        $data['incomeSC'] = $this->My_model->get_where_order('tb_acc_school_income', array('tb_acc_school_income_department' => $this->session->userdata("department")), '');

        $this->load->view("layout/header");
        $this->load->view("account/financial", $data);
//        $this->load->view("account/financial");
        $this->load->view('layout/footer');
    }

    public function insert_income() {

        $id = $this->input->post('inAccIncomeId');
        $arr = array(
            "tb_acc_income_detail" => $this->input->post('inAccIncomeDetail'),
            "tb_acc_income_code" => $this->input->post('inAccIncomeCode'),
            "tb_acc_code" => $this->input->post('inAccCode'),
            "tb_school_id" => $this->session->userdata('sch_id'),
        );
        if ($id != null || $id != "") {
            $this->My_model->update_data('tb_acc_income', array('id' => $id), $arr);
        } else {
            $this->My_model->insert_data('tb_acc_income', $arr);
        }
    }

    public function income_delete() {
        $id = $this->input->post('id');
        $this->My_model->delete_data('tb_acc_income', array('id' => $id));
    }

    public function income_edit() {
        $id = $this->input->post('id');
        $rs = $this->My_model->get_where_row('tb_acc_income', array('id' => $id));
        echo json_encode($rs);
    }

    public function insert_income_school() {
        $arr = array(
            "tb_acc_school_income_type" => $this->input->post('inFinanceType'),
            "tb_acc_school_income_ref" => $this->input->post('inFinanceRef'),
            "tb_acc_income_id" => $this->input->post('inFinanceTitle'),
            "tb_acc_school_income_detail" => $this->input->post('inFinanceDetail'),
            "tb_acc_school_income_amt" => $this->input->post('inFinanceAmt'),
            "tb_acc_school_income_note" => $this->input->post('inFinanceNote'),
            "tb_acc_school_income_date" => $this->input->post('inFinanceDate'),
            "tb_acc_school_income_recorder" => $this->session->userdata('name'),
            "tb_acc_school_income_department" => $this->session->userdata('department')
        );
        $this->My_model->insert_data('tb_acc_school_income', $arr);
    }

    public function insert_expense_school() {
        $arr = array(
            "tb_acc_school_expense_type" => $this->input->post('inFinanceType'),
            "tb_acc_school_expense_ref" => $this->input->post('inFinanceRef'),
            "tb_acc_income_id" => $this->input->post('inFinanceTitle'),
            "tb_acc_school_expense_detail" => $this->input->post('inFinanceDetail'),
            "tb_acc_school_expense_amt" => $this->input->post('inFinanceAmt'),
            "tb_acc_school_expense_note" => $this->input->post('inFinanceNote'),
            "tb_acc_school_expense_date" => $this->input->post('inFinanceDate'),
            "tb_acc_school_expense_recorder" => $this->session->userdata('name'),
            "tb_acc_school_expense_department" => $this->session->userdata('department')
        );
        $this->My_model->insert_data('tb_acc_school_expense', $arr);
    }

    function accounting() {
        //$data['rs'] = $this->My_model->get_where_row('tb_ed_op_regulation',array('tb_ed_op_regulation_department' =>$this->session->userdata("department")));
        $this->load->view("layout/header");
//        $this->load->view("account/accounting", $data);
        $this->load->view("account/accounting");
        $this->load->view('layout/footer');
    }

    //---------------------------------------


    function expense() {
        $data['expenseSC'] = $this->My_model->get_where_order('tb_acc_school_expense', array('tb_acc_school_expense_department' => $this->session->userdata("department")), '');
        $data['income'] = $this->My_model->get_all('tb_acc_income');
        $this->load->view("layout/header");
//        $this->load->view("account/accounting", $data);
        $this->load->view("account/expense", $data);
        $this->load->view('layout/footer');
    }

    function loan() {
        $this->load->view("layout/header");
//        $this->load->view("account/loan", $data);
        $this->load->view("account/loan");
        $this->load->view('layout/footer');
    }

    function loan_clearing() {
        $this->load->view("layout/header");
//        $this->load->view("account/loan_clearing", $data);
        $this->load->view("account/loan_clearing");
        $this->load->view('layout/footer');
    }

    function accounting_code() {
        $data['acc_code'] = $this->My_model->get_all('tb_acc_code');
        $this->load->view("layout/header");
        $this->load->view("account/accounting_code", $data);
//        $this->load->view("account/accounting_code");
        $this->load->view('layout/footer');
    }

}
