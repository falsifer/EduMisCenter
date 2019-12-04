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
        $this->load->model('School_loan_model');
    }

    //
    public function index() {
        $data['rs'] = $this->My_model->join2table_result('tb_school_type a', 'tb_school b', 'b.school_type_id = a.id', 'a.school_type asc, b.sc_thai_name asc');
        $this->load->view('layout/header');
        $this->load->view('school_loan/index', $data);
        $this->load->view('layout/footer');
    }

    /*
     * กำหนดหมวดค่าใช้สอย
     */

    public function loan_category() {
        if ($this->session->userdata('status') == '') {
            redirect('login');
        }
        //
        $data['rs'] = $this->My_model->get_all_order('tb_loan_category', 'loan_category asc');
        $this->load->view('layout/header');
        $this->load->view('school_loan/loan_category', $data);
        $this->load->view('layout/footer');
    }

    // insert loan category;
    public function loan_category_add() {
        $id = $_POST['id'];
        $arr = array(
            'loan_category' => $this->input->post('inLoanCategory')
        );
        if ($id != '') {
            $this->My_model->update_data('tb_loan_category', array('id' => $id), $arr);
        } else {
            $this->My_model->insert_data('tb_loan_category', $arr);
        }
    }

    // update data
    public function loan_category_edit() {
        $id = $_POST['id'];
        $row = $this->My_model->get_where_row('tb_loan_category', array('id' => $id));
        echo json_encode($row);
    }

    // delete loan category
    public function loan_category_delete() {
        $id = $_POST['id'];
        $this->My_model->delete_data('tb_loan_category', array('id' => $id));
    }

    /*
     * กำหนดประเภทค่าใช้จ่าย
     */

    public function loan_type() {
        if ($this->session->userdata('status') == '') {
            redirect('login');
        }
        //
        $data['category'] = $this->My_model->get_all_order('tb_loan_category', 'loan_category asc');
        $data['rs'] = $this->My_model->join2table_result('tb_loan_category a', 'tb_loan_type b', 'b.loan_category_id = a.id', 'a.loan_category, b.loan_type asc');
        $this->load->view('layout/header');
        $this->load->view('school_loan/loan_type', $data);
        $this->load->view('layout/footer');
    }

    // insert data;
    public function loan_type_add() {
        $id = $_POST['id'];
        $arr = array(
            'loan_category_id' => $this->input->post('inLoanCategoryId'),
            'loan_type' => $this->input->post('inLoanType')
        );
        if ($id != '') {
            $this->My_model->update_data('tb_loan_type', array('id' => $id), $arr);
        } else {
            $this->My_model->insert_data('tb_loan_type', $arr);
        }
    }

    // edit data
    public function loan_type_edit() {
        $id = $_POST['id'];
        $row = $this->My_model->get_where_row('tb_loan_type', array('id' => $id));
        echo json_encode($row);
    }

    // delete data
    public function loan_type_delete() {
        $id = $_POST['id'];
        $this->My_model->delete_data('tb_loan_type', array('id' => $id));
    }

    /*
     * loan define 
     * กำหนดรายการโอนเงินงบประมาณ
     */

    public function loan_define() {
        if ($this->session->userdata('status') == '') {
            redirect('login');
        }
        //
        $data['type'] = $this->My_model->join2table_result('tb_loan_category a', 'tb_loan_type b', 'b.loan_category_id = a.id', 'a.loan_category asc,b.loan_type asc');
        $data['rs'] = $this->School_loan_model->get_loan_define();
        $this->load->view('layout/header');
        $this->load->view('school_loan/loan_define', $data);
        $this->load->view('layout/footer');
    }

    // insert loan define
    public function loan_define_add() {
        $id = $_POST['id'];
        $arr = array(
            'loan_type_id' => $this->input->post('inLoanTypeId'),
            'loan_define' => $this->input->post('inLoanDefine')
        );
        if (!empty($id)) {
            $this->My_model->update_data('tb_loan_define', array('id' => $id), $arr);
        } else {
            $this->My_model->insert_data('tb_loan_define', $arr);
        }
    }

    // update loan define
    public function loan_define_edit() {
        $id = $_POST['id'];
        $row = $this->School_loan_model->get_loan_define_row($id);
        echo json_encode($row);
    }

    // delete loan define
    public function loan_define_delete() {
        $id = $_POST['id'];
        $this->My_model->delete_data('tb_loan_define', array('id' => $id));
    }

    /*
     * กำหนดงบประมาณที่ตั้งไว้สำหรับแต่ละโรงเรียน
     */

    public function loan_define_detail($school_id) {
        if ($this->session->userdata('status') == '') {
            redirect('login');
        }
        $data['school'] = $this->My_model->get_where_row('tb_school', array('id' => $school_id));
        $data['define'] = $this->School_loan_model->get_all_loan_define();
        $data['rs'] = $this->School_loan_model->get_loan_define_detail($school_id);
        $this->load->view('layout/header');
        $this->load->view('school_loan/loan_define_detail', $data);
        $this->load->view('layout/footer');
    }

    // insert data;
    public function loan_define_detail_add() {
        $id = $_POST['id'];
        if (!empty($id)) {
            $arr = array(
                'loan_year' => $this->input->post('inLoanYear'),
                'loan_define_id' => $this->input->post('inLoanDefineId'),
                'loan_begin' => $this->input->post('inLoanBegin')
            );
            $this->My_model->update_data('tb_loan_define_detail', array('id' => $id), $arr);
        } else {
            $arr = array(
                'school_id' => $this->input->post('school_id'),
                'loan_year' => $this->input->post('inLoanYear'),
                'loan_define_id' => $this->input->post('inLoanDefineId'),
                'loan_begin' => $this->input->post('inLoanBegin')
            );
            $this->My_model->insert_data('tb_loan_define_detail', $arr);
        }
    }

    // edit data
    public function loan_define_detail_edit() {
        $id = $_POST['id'];
        $row = $this->School_loan_model->get_loan_define_detail_edit($id);
        echo json_encode($row);
    }

    // delete data
    public function loan_define_detail_delete() {
        $id = $_POST['id'];
        $this->My_model->delete_data('tb_loan_define_detail', array('id' => $id));
    }

    // พิมพ์ข้อมูลงบประมาณที่ตั้งไว้
    public function loan_define_detail_print($school_id) {
        $data['title'] = $this->My_model->get_where_row('tb_school', array('id' => $school_id));
        $data['rs'] = $this->School_loan_model->get_loan_define_detail($school_id);
        $this->load->view('school_loan/reports/loan_define_detail_print', $data);
    }

    /*
     * รายละเอียดการจัดสรรงบประมาณให้กับสถานศึกษา
     */

    public function school_loan_detail($id) {
        $data['school'] = $this->My_model->get_where_row('tb_school', array('id' => $id));
        $data['define'] = $this->School_loan_model->get_loan_define_detail($id);
        $data['rs'] = $this->School_loan_model->get_school_loan($id);
        $this->load->view('layout/header');
        $this->load->view('school_loan/school_loan_detail', $data);
        $this->load->view('layout/footer');
    }

    /*
     * รายละเอียดการโอนงบประมาณแต่ละรายการ
     */

    public function school_loan_detail_transfer($school_id, $define_id) {
        if ($this->session->userdata('status') == '') {
            redirect('login');
        }
        $data['define'] = $this->School_loan_model->get_loan_define_detail_edit($define_id);
        $data['rs'] = $this->School_loan_model->get_loan_transfer_detail($school_id, $define_id);
        $this->load->view('layout/header');
        $this->load->view('school_loan/school_loan_detail_transfer', $data);
        $this->load->view('layout/footer');
    }

    // insert data
    public function loan_detail_transfer_add() {
        $id = $_POST['id'];
        if (!empty($id)) {
            $arr = array(
                'loan_date' => $this->input->post('inLoanDate'),
                'loan_term' => $this->input->post('inLoanTerm'),
                'loan_transfer' => $this->input->post('inLoanTransfer'),
                'loan_recorder' => $this->session->userdata('name')
            );
            $this->My_model->update_data('tb_loan_transfer', array('id' => $id), $arr);
        } else {
            $arr = array(
                'school_id' => $this->input->post('school_id'),
                'loan_define_detail_id' => $this->input->post('loan_define_detail_id'),
                'loan_date' => $this->input->post('inLoanDate'),
                'loan_term' => $this->input->post('inLoanTerm'),
                'loan_transfer' => $this->input->post('inLoanTransfer'),
                'loan_recorder' => $this->session->userdata('name')
            );
            $this->My_model->insert_data('tb_loan_transfer', $arr);
        }
    }

    // edit data
    public function loan_detail_transfer_edit() {
        $id = $_POST['id'];
        $row = $this->My_model->get_where_row('tb_loan_transfer', array('id' => $id));
        echo json_encode($row);
    }

    // delete data
    public function loan_detail_transfer_delete() {
        $id = $_POST['id'];
        $this->My_model->delete_data('tb_loan_transfer', array('id' => $id));
    }

    // print data
    public function loan_detail_transfer_print($school_id) {
        $data['school'] = $this->My_model->get_where_row('tb_school', array('id' => $school_id));
        $data['rs'] = $this->School_loan_model->get_loan_define_detail($school_id);
        $this->load->view('school_loan/reports/loan_detail_transfer_print', $data);
    }

    /*
     * การจัดสรรงบประมาณให้กับโรงเรียนที่ขอรับการสนับสนุน
     * งบประมาณจากองค์กรปกครองส่วนท้องถิ่น
     * 20 พฤษภาคม 2019
     * Author Mr.Bundhit Chaiyadee
     * Last update  -
     */

    public function loan_ext() {
        $data['rs'] = $this->My_model->get_all_order('tb_loan_ext', 'ext_date desc');
        $this->load->view('layout/header');
        $this->load->view('school_loan/loan_ext', $data);
        $this->load->view('layout/footer');
    }

    // insert data
    public function loan_ext_add() {
        $id = $_POST['id'];
        if ($id != '') {
            if (!empty($_FILES["inExtDocument"]["name"])) {
                $row = $this->My_model->get_where_row('tb_loan_ext', array('id' => $id));
                @unlink('upload/' . $row['ext_document']);
                $config = array(
                    "upload_path" => "upload/",
                    "allowed_types" => "pdf",
                    "max_size" => 0,
                    "file_name" => md5(date("YmdHis"))
                );
                $this->upload->initialize($config);
                $this->upload->do_upload("inExtDocument");
                $data = $this->upload->data();
                $filename = $data['file_name'];
                $arr = array('ext_document' => $filename);
                $this->My_model->update_data("tb_loan_ext", array('id' => $id), $arr);
            }
            //
            $arr = array(
                'ext_date' => $this->input->post('inExtDate'),
                'ext_name' => $this->input->post('inExtName'),
                'ext_type' => $this->input->post('inExtType'),
                'ext_place' => $this->input->post('inExtPlace'),
                'ext_loan' => $this->input->post('inExtLoan'),
                'ext_school' => $this->input->post('inExtSchool'),
                'ext_leader' => $this->input->post('inExtLeader'),
                'ext_leader_mobile' => $this->input->post('inExtLeaderMobile'),
                'ext_coordinator' => $this->input->post('inExtCoordinator'),
                'ext_coordinator_mobile' => $this->input->post('inExtCoordinatorMobile'),
                'recorder' => $this->session->userdata('name'),
                'department' => $this->session->userdata('department')
            );
            $this->My_model->update_data('tb_loan_ext', array('id' => $id), $arr);
            //
        } else {
            if (!empty($_FILES["inExtDocument"]["name"])) {
                $config = array(
                    "upload_path" => "upload/",
                    "allowed_types" => "pdf",
                    "max_size" => 0,
                    "file_name" => md5(date("YmdHis"))
                );
                $this->upload->initialize($config);
                $this->upload->do_upload("inExtDocument");
                $data = $this->upload->data();
                $filename = $data['file_name'];
            } else {
                $filename = "";
            }
            //
            $arr = array(
                'ext_date' => $this->input->post('inExtDate'),
                'ext_name' => $this->input->post('inExtName'),
                'ext_type' => $this->input->post('inExtType'),
                'ext_place' => $this->input->post('inExtPlace'),
                'ext_loan' => $this->input->post('inExtLoan'),
                'ext_school' => $this->input->post('inExtSchool'),
                'ext_leader' => $this->input->post('inExtLeader'),
                'ext_leader_mobile' => $this->input->post('inExtLeaderMobile'),
                'ext_coordinator' => $this->input->post('inExtCoordinator'),
                'ext_coordinator_mobile' => $this->input->post('inExtCoordinatorMobile'),
                'ext_document' => $filename,
                'recorder' => $this->session->userdata('name'),
                'department' => $this->session->userdata('department')
            );
            $this->My_model->insert_data('tb_loan_ext', $arr);
        }
    }

    // update data
    public function loan_ext_edit() {
        $id = $_POST['id'];
        $row = $this->My_model->get_where_row('tb_loan_ext', array('id' => $id));
        echo json_encode($row);
    }

    // delete data
    public function loan_ext_delete() {
        $id = $_POST['id'];
        $row = $this->My_model->get_where_row('tb_loan_ext', array('id' => $id));
        @unlink('upload/' . $row['ext_document']);
        $this->My_model->delete_data('tb_loan_ext', array('id' => $id));
    }

    // external loan print
    public function loan_ext_print() {
        $data['rs'] = $this->My_model->get_all_order('tb_loan_ext', 'ext_date desc');
        $this->load->view('school_loan/reports/loan_ext_print',$data);
    }

    // external loan payment
    public function loan_ext_payment($id) {
        if ($this->session->userdata('status') == '') {
            redirect(site_url());
        }
        $data['unit'] = $this->My_model->get_all_order('tb_unit', 'unit_name asc');
        $data['project'] = $this->My_model->get_where_row('tb_loan_ext', array('id' => $id));
        $data['rs'] = $this->School_loan_model->get_school_loan_ext($id);
        $this->load->view('layout/header');
        $this->load->view('school_loan/loan_ext_payment', $data);
        $this->load->view('layout/footer');
    }

    // insert data
    public function loan_payment_add() {
        $id = $_POST['id'];
        if ($id != '') {
            $arr = array(
                'unit_id' => $this->input->post('inUnitId'),
                'payment_date' => $this->input->post('inPaymentDate'),
                'payment_title' => $this->input->post('inPaymentTitle'),
                'payment_amount' => $this->input->post('inPaymentAmount'),
                'payment_cost' => $this->input->post('inPaymentCost'),
                'payment_total' => $this->input->post('inPaymentAmount') * $this->input->post("inPaymentCost"),
                'payment_comment' => $this->input->post('inPaymentComment'),
                'recorder' => $this->session->userdata('name'),
                'department' => $this->session->userdata('department')
            );
            $this->My_model->update_data('tb_loan_ext_payment', array('id' => $id), $arr);
        } else {
            $arr = array(
                'loan_ext_id' => $this->input->post('loan_ext_id'),
                'unit_id' => $this->input->post('inUnitId'),
                'payment_date' => $this->input->post('inPaymentDate'),
                'payment_title' => $this->input->post('inPaymentTitle'),
                'payment_amount' => $this->input->post('inPaymentAmount'),
                'payment_cost' => $this->input->post('inPaymentCost'),
                'payment_total' => $this->input->post('inPaymentAmount') * $this->input->post("inPaymentCost"),
                'payment_comment' => $this->input->post('inPaymentComment'),
                'recorder' => $this->session->userdata('name'),
                'department' => $this->session->userdata('department')
            );
            $this->My_model->insert_data('tb_loan_ext_payment', $arr);
        }
    }

    // update data
    public function loan_payment_edit() {
        $id = $_POST['id'];
        $row = $this->School_loan_model->get_school_loan_ext_row($id);
        echo json_encode($row);
    }

    // delete data
    public function loan_payment_delete() {
        $id = $_POST['id'];
        $this->My_model->delete_data('tb_loan_ext_payment', array('id' => $id));
    }

    // print data
    public function loan_payment_print($id) {
        $data['rs'] = $this->School_loan_model->get_school_loan_ext($id);
        $this->load->view('school_loan/reports/loan_ext_print', $data);
    }

}
