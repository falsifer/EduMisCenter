<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/*
  | ----------------------------------------------------------------------------
  |  Title      EducationEvaluation
  | ----------------------------------------------------------------------------
  | Copyright	Edutech Co.,Ltd.
  | Purpose     ระบบกำกับติดตามและประเมินผล
  | Author	นายบัณฑิต ไชยดี
  | Create Date 01/12/2018
  | Last edit	-
  | Comment	-
  | ----------------------------------------------------------------------------
 */

class EducationEvaluation extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Ev_model');
    }

    // method index;
    public function inex() {
        
    }

    // method education evaluation;
    public function education_evaluation() {
        $data['ev_category'] = $this->My_model->join2table_result('tb_evaluation_category a', 'tb_evaluation_activities b', 'b.ev_category_id = a.id', 'a.evaluation_category asc');
        $data['school'] = $this->My_model->get_all_order("tb_school", "sc_code ASC");
        $data['rs'] = $this->Ev_model->get_education_evaluation_data();
        $this->load->view("layout/header");
        $this->load->view('education_evaluation/education_evaluation', $data);
        $this->load->view('layout/footer');
    }

    // insert data
    public function insert_evaluation() {
        $id = $_POST['id'];
        if ($id != '') {
            $arr = array(
                'ev_date' => $this->input->post('inEvDate'),
                'ev_days' => $this->input->post('inEvDay'),
                'activities_id' => $this->input->post('inActivitiesId'),
                'school_id' => $this->input->post('inSchoolId'),
                'ev_leader' => $this->input->post('inOfficeLeader')
            );
            $this->My_model->update_data('tb_education_evaluation', array('id' => $id), $arr);
        } else {
            $arr = array(
                'ev_date' => $this->input->post('inEvDate'),
                'ev_days' => $this->input->post('inEvDay'),
                'activities_id' => $this->input->post('inActivitiesId'),
                'school_id' => $this->input->post('inSchoolId'),
                'ev_leader' => $this->input->post('inOfficeLeader')
            );
            $this->My_model->insert_data('tb_education_evaluation', $arr);
        }
    }

    // update data;
    public function edit_evaluation() {
        $id = $_POST['id'];
        $row = $this->Ev_model->get_education_evaluation_row($id);
        echo json_encode($row);
    }

    // delete data;
    public function delete_evaluation() {
        $id = $_POST['id'];
        $this->My_model->delete_data('tb_education_evaluation', array('id' => $id));
    }

    // print data;
    public function print_evaluation($id) {
        $data['org'] = $this->My_model->get_row("tb_organization");
        $data['rs'] = $this->My_model->join2table_row('tb_school a', 'tb_education_evaluation b', 'b.school_id = a.id', array('b.id' => $id));
        $this->load->view('education_evaluation/reports/evaluation_report', $data);
    }

    // กำหนดกลุ่มรายการกิจกรรมส่งเสริม สนับสนุนฯ 
    public function ev_category() {
        if ($this->session->userdata('status') == '') {
            redirect('login');
        }
        $data['rs'] = $this->My_model->get_all_order('tb_evaluation_category', 'evaluation_category asc');
        $this->load->view('layout/header');
        $this->load->view('education_evaluation/ev_category', $data);
        $this->load->view('layout/footer');
    }

    // บันทึกกลุ่มของกิจกรรมกำกับติดตามฯ
    public function ev_category_add() {
        $id = $_POST['id'];
        $arr = array('evaluation_category' => $this->input->post('inEvaluationCategory'));
        if ($id != '') {
            $this->My_model->update_data('tb_evaluation_category', array('id' => $id), $arr);
        } else {
            $this->My_model->insert_data('tb_evaluation_category', $arr);
        }
    }

    // update data;
    public function ev_category_edit() {
        $id = $_POST['id'];
        $row = $this->My_model->get_where_row('tb_evaluation_category', array('id' => $id));
        echo json_encode($row);
    }

    // delete data
    public function ev_category_delete() {
        $id = $_POST['id'];
        $this->My_model->delete_data('tb_evaluation_category', array('id' => $id));
    }

    // รายการงานย่อย
    public function ev_activities() {
        if ($this->session->userdata('status') == '') {
            redirect('login');
        }
        $data['category'] = $this->My_model->get_all_order('tb_evaluation_category', 'evaluation_category asc');
        $data['rs'] = $this->My_model->join2table_result('tb_evaluation_category a', 'tb_evaluation_activities b', 'b.ev_category_id = a.id', 'a.evaluation_category asc');
        $this->load->view('layout/header');
        $this->load->view('education_evaluation/ev_activities', $data);
        $this->load->view('layout/footer');
    }

    // add data;
    public function ev_activities_add() {
        $id = $_POST['id'];
        $arr = array(
            'ev_category_id' => $this->input->post('inEvCategoryId'),
            'evaluation_activities' => $this->input->post('inEvActivities')
        );
        if ($id != '') {
            $this->My_model->update_data('tb_evaluation_activities', array('id' => $id), $arr);
        } else {
            $this->My_model->insert_data('tb_evaluation_activities', $arr);
        }
    }

    // edit data;
    public function ev_activities_edit() {
        $id = $_POST['id'];
        $row = $this->My_model->get_where_row('tb_evaluation_activities', array('id' => $id));
        echo json_encode($row);
    }

    // delete data;
    public function ev_activities_delete() {
        $id = $_POST['id'];
        $this->My_model->delete_data('tb_evaluation_activities', array('id' => $id));
    }

    // ขั้นตอนการดำเนินงาน
    public function ev_progress($id) {
        $data['ev'] = $this->My_model->get_where_row("tb_education_evaluation", array('id' => $id));
        $data['rs'] = $this->My_model->get_where_order('tb_ev_progress', array('ev_id' => $id), 'progress_date asc');
        $this->load->view('layout/header');
        $this->load->view('education_evaluation/ev_progress', $data);
        $this->load->view('layout/footer');
    }

    // add data;
    public function ev_progress_add() {
        $id = $_POST['id'];
        if ($id != '') {
            $arr = array(
                'progress_date' => $this->input->post('inProgressDate'),
                'progress_detail' => $this->input->post('inProgressDetail'),
                'progress_person' => $this->input->post('inProgressPerson'),
                'progress_comment' => $this->input->post('inProgressComment')
            );
            $this->My_model->update_data('tb_ev_progress', array('id' => $id), $arr);
        } else {
            $arr = array(
                'ev_id' => $this->input->post('ev_id'),
                'progress_date' => $this->input->post('inProgressDate'),
                'progress_detail' => $this->input->post('inProgressDetail'),
                'progress_person' => $this->input->post('inProgressPerson'),
                'progress_comment' => $this->input->post('inProgressComment')
            );
            $this->My_model->insert_data('tb_ev_progress', $arr);
        }
    }

    // แก้ไขข้อมูลการดำเนินงาน
    public function ev_progress_edit() {
        $id = $_POST['id'];
        $row = $this->My_model->get_where_row('tb_ev_progress', array('id' => $id));
        echo json_encode($row);
    }

    // ลบข้อมูลการดำเนินงาน
    public function ev_progress_delete() {
        $id = $_POST['id'];
        $this->My_model->delete_data('tb_ev_progress', array('id' => $id));
    }

    // พิมพ์ข้อมูลการดำเนินงาน
    public function ev_progress_print($id) {
        $data['rs'] = $this->My_model->get_where_order('tb_ev_progress', array('ev_id' => $id), 'progress_date asc');
        $this->load->view('education_evaluation/reports/ev_progress_print', $data);
    }

    // ค่าใช้จ่ายในการดำเนินงาน
    public function ev_payment($id) {
        $data['sum_cost'] = $this->My_model->sum_where('tb_ev_payment', 'payment_total', array('ev_id' => $id));
        $data['unit'] = $this->My_model->get_all_order('tb_unit', 'unit_name asc');
        $data['rs'] = $this->My_model->join2table_where_result('tb_unit a', 'tb_ev_payment b', 'b.unit_id = a.id', array('b.ev_id' => $id), 'b.payment_date asc');
        $this->load->view('layout/header');
        $this->load->view('education_evaluation/ev_payment', $data);
        $this->load->view('layout/footer');
    }

    // บันทีกข้อมูล
    public function ev_payment_add() {
        $total = $this->input->post('inPaymentAmount') * $this->input->post('inPaymentCost');
        $arr = array(
            'ev_id' => $this->input->post('ev_id'),
            'payment_date' => $this->input->post('inPaymentDate'),
            'payment_detail' => $this->input->post('inPaymentDetail'),
            'unit_id' => $this->input->post('inUnitId'),
            'payment_amount' => $this->input->post('inPaymentAmount'),
            'payment_cost' => $this->input->post('inPaymentCost'),
            'payment_total' => $total,
            'payment_comment' => $this->input->post('inPaymentComment')
        );
        $this->My_model->insert_data('tb_ev_payment', $arr);
    }

    // edit data;
    public function ev_payment_edit() {
        $id = $_POST['id'];
        $row = $this->My_model->get_where_row('tb_ev_payment', array('id' => $id));
        echo json_encode($row);
    }

    // delete data;
    public function ev_payment_delete() {
        $id = $_POST['id'];
        $this->My_model->delete_data('tb_ev_payment', array('id' => $id));
    }

    // พิมพ์ข้อมูล
    public function ev_payment_print($id) {
        $data['sum_cost'] = $this->My_model->sum_where('tb_ev_payment', 'payment_total', array('ev_id' => $id));
        $data['rs'] = $this->My_model->join2table_where_result('tb_unit a', 'tb_ev_payment b', 'b.unit_id = a.id', array('ev_id' => $id), 'payment_date asc');
        $this->load->view('education_evaluation/reports/ev_payment_print', $data);
    }

    // เอกสาร
    public function ev_documents($id) {
        $data['rs'] = $this->My_model->get_where_order('tb_ev_documents', array('ev_id' => $id), 'id asc');
        $this->load->view('layout/header');
        $this->load->view('education_evaluation/ev_documents', $data);
        $this->load->view('layout/footer');
    }

    // add 
    public function ev_documents_add() {
        $id = $_POST['id'];
        $filename = $_FILES['inDocumentsFile']['name'];
        $file_ext = pathinfo($filename, PATHINFO_EXTENSION);
        if ($id != '') {
            if ($_FILES['inDocumentsFile']['name'] != '') {
                $row = $this->My_model->get_where_row('tb_ev_documents', array('id' => $id));
                @unlink('upload/' . $row['document_file']);
                if ($file_ext == 'pdf' || $file_ext == 'doc' || $file_ext == 'docx') {
                    $config = array(
                        "upload_path" => "upload/",
                        "allowed_types" => "pdf|doc|docx",
                        "max_size" => 0,
                        "file_name" => md5(date("YmdHis"))
                    );
                    $this->upload->initialize($config);
                    $this->upload->do_upload("inDocumentsFile");
                    $data = $this->upload->data();
                } else {
                    $config = array(
                        "upload_path" => "upload/",
                        "allowed_types" => "jpg|png",
                        "max_size" => 0,
                        "file_name" => md5(date("YmdHis"))
                    );
                    $this->upload->initialize($config);
                    $this->upload->do_upload("inDocumentsFile");
                    $data = $this->upload->data();

                    $this->load->library("image_lib");
                    $config['image_library'] = "gd2";
                    $config["source_image"] = "upload/" . $data['file_name'];
                    $config['maintain_ratio'] = TRUE;
                    $config['width'] = 1024;
                    $config['height'] = 768;

                    $this->image_lib->initialize($config);
                    $this->image_lib->resize();
                }
                $arr = array('document_file' => $data['file_name']);
                $this->My_model->update_data('tb_ev_documents', array('id' => $id), $arr);
            }
            //
            $arr = array(
                'ev_id' => $this->input->post('ev_id'),
                'document_date' => $this->input->post('inDocumentsDate'),
                'document_type' => $this->input->post('inDocumentsType'),
            );
            $this->My_model->update_data('tb_ev_documents', array('id' => $id), $arr);
        } else {
            if ($file_ext == 'pdf' || $file_ext == 'doc' || $file_ext == 'docx') {
                $config = array(
                    "upload_path" => "upload/",
                    "allowed_types" => "pdf|doc|docx",
                    "max_size" => 0,
                    "file_name" => md5(date("YmdHis"))
                );
                $this->upload->initialize($config);
                $this->upload->do_upload("inDocumentsFile");
                $data = $this->upload->data();
                $doc_file = $data['file_name'];
                //
                $arr = array(
                    'ev_id' => $this->input->post('ev_id'),
                    'document_date' => $this->input->post('inDocumentsDate'),
                    'document_type' => $this->input->post('inDocumentsType'),
                    'document_file' => $doc_file
                );
            } else {
                $config = array(
                    "upload_path" => "upload/",
                    "allowed_types" => "jpg|png",
                    "max_size" => 0,
                    "file_name" => md5(date("YmdHis"))
                );
                $this->upload->initialize($config);
                $this->upload->do_upload("inDocumentsFile");
                $data = $this->upload->data();

                $this->load->library("image_lib");
                $config['image_library'] = "gd2";
                $config["source_image"] = "upload/" . $data['file_name'];
                $config['maintain_ratio'] = TRUE;
                $config['width'] = 1024;
                $config['height'] = 768;

                $this->image_lib->initialize($config);
                $this->image_lib->resize();
                $img_file = $data['file_name'];
                $arr = array(
                    'ev_id' => $this->input->post('ev_id'),
                    'document_date' => $this->input->post('inDocumentsDate'),
                    'document_type' => $this->input->post('inDocumentsType'),
                    'document_file' => $img_file
                );
            }
            $this->My_model->insert_data('tb_ev_documents', $arr);
        }
    }

    // edit data;
    public function ev_documents_edit() {
        $id = $_POST['id'];
        $row = $this->My_model->get_where_row('tb_ev_documents', array('id' => $id));
        echo json_encode($row);
    }

    // delete data;
    public function ev_documents_delete() {
        $id = $_POST['id'];
        $row = $this->My_model->get_where_row('tb_ev_documents', array('id' => $id));
        @unlink('upload/' . $r['document_file']);
        $this->My_model->delete_data('tb_ev_documents', array('id' => $id));
    }

}
