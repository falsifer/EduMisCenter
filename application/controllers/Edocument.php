<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/*
  | ----------------------------------------------------------------------------
  |  Title
  | ----------------------------------------------------------------------------
  | Copyright	Edutech Co.,Ltd.
  | Purpose     โมเดลนักเรียน
  | Author      chairatto
  | Create Date 22/11/2561
  | Last edit	8/3/2562
  | Comment	-
  | ----------------------------------------------------------------------------
 */

Class Edocument extends CI_Controller {

    public function __construct() {
        parent::__construct();
        if ($this->session->userdata('status') == "") {
            redirect("/");
        }
        $this->load->model("Edocument_model");
        $this->load->model("Edutech_model");
    }

    public function edocument_manual() {
        if ($_FILES['inEdocFile']['name'] != "") {
            $config = array(
                "upload_path" => "upload/",
                "allowed_types" => "jpg|png|pdf",
                "max_size" => 10000,
                "file_name" => md5(date("YmdHis"))
            );
            $this->upload->initialize($config);
            $this->upload->do_upload("inEdocFile");
            $data = $this->upload->data();
            $filename = $data['file_name'];
        } else {
            $filename = "";
        }
        if ($filename != "" && $filename != " " && $filename != null) {
            $arr = array(
                "edoc_rc_no" => $this->input->post('inEdocRCNo'),
                "edoc_no" => $this->input->post('inEdocNo'),
                "edoc_date" => $this->input->post('inEdocDate'),
                "edoc_rc_date" => date('Y-m-d'),
                "edoc_type" => $this->input->post('inEdocType'),
                "edoc_tracking_type" => $this->input->post('inEdocTackingType'),
                "edoc_from" => $this->input->post('inEdocFrom'),
                "edoc_to" => $this->input->post('inEdocTo'),
//            "edoc_responsible" => $this->input->post('inEdocResponsible'),
                "edoc_level" => "ปกติ",
                "edoc_psermission" => "ปกติ",
                "edoc_to_department" => $this->session->userdata('department'),
                "edoc_recorder" => $this->session->userdata('name'),
                "edoc_department" => $this->session->userdata('department'),
                "edoc_topic" => $this->input->post('inEdocTopic'),
                "edoc_file" => $filename
            );
        } else {
            $arr = array(
                "edoc_rc_no" => $this->input->post('inEdocRCNo'),
                "edoc_no" => $this->input->post('inEdocNo'),
                "edoc_date" => $this->input->post('inEdocDate'),
                "edoc_rc_date" => date('Y-m-d'),
                "edoc_type" => $this->input->post('inEdocType'),
                "edoc_tracking_type" => $this->input->post('inEdocTackingType'),
                "edoc_from" => $this->input->post('inEdocFrom'),
                "edoc_to" => $this->input->post('inEdocTo'),
//            "edoc_responsible" => $this->input->post('inEdocResponsible'),
                "edoc_level" => "ปกติ",
                "edoc_psermission" => "ปกติ",
                "edoc_to_department" => $this->session->userdata('department'),
                "edoc_recorder" => $this->session->userdata('name'),
                "edoc_department" => $this->session->userdata('department'),
                "edoc_topic" => $this->input->post('inEdocTopic'),
            );
        }

        if ($this->input->post('id') != null) {

            if ($filename != "" && $filename != " " && $filename != null) {
                $rs = $this->My_model->get_where_row('tb_e_document', array('id' => $this->input->post('id')));
                if (isset($rs['edoc_file'])) {
                    if (file_exists(base_url() . "upload/" . $rs['edoc_file'])) {
                        @unlink("upload/" . $rs['edoc_file']);
                    }
                }
            }

            $this->My_model->update_data('tb_e_document', array('id' => $this->input->post('id')), $arr);
        } else {
            $this->My_model->insert_data('tb_e_document', $arr);
        }
    }

    public function delete_inbox() {
        $id = $this->input->post('id');
        $rs = $this->My_model->get_where_row('tb_e_document', array('id' => $id));
        if (isset($rs['edoc_file'])) {
            @unlink("upload/" . $rs['edoc_file']);
        }
        $this->My_model->delete_data('tb_e_document', array('id' => $id));
    }

    public function edit_inbox() {
        $id = $this->input->post('id');
        $rs = $this->My_model->get_where_row('tb_e_document', array('id' => $id));
        echo json_encode($rs);
    }

    public function edocument_send_online() {
        if ($_FILES['outEdocFile']['name'] != "") {
            $config = array(
                "upload_path" => "upload/",
                "allowed_types" => "*",
                "max_size" => 10000,
                "file_name" => md5(date("YmdHis"))
            );
            $this->upload->initialize($config);
            $this->upload->do_upload("outEdocFile");
            $data = $this->upload->data();
            $filename = $data['file_name'];
        } else {
            $filename = "";
        }
        $reciverArr = $this->input->post('school');
        if (isset($reciverArr)) {
            foreach ($reciverArr as $r) {
                $arr = array(
                    "edoc_send_no" => $this->input->post('outEdocSendNo'),
                    "edoc_send_date" => date('Y-m-d'),
                    "edoc_no" => $this->input->post('outEdocNo'),
                    "edoc_date" => $this->input->post('outEdocDate'),
                    "edoc_type" => $this->input->post('outEdocType'),
                    "edoc_to" => $this->input->post('inEdocTo'),
                    "edoc_topic" => $this->input->post('inEdocTopic'),
                    "edoc_to_department" => $r,
                    "edoc_level" => "ปกติ",
                    "edoc_psermission" => "ปกติ",
                    "edoc_recorder" => $this->session->userdata('name'),
                    "edoc_department" => $this->session->userdata('department'),
                    "edoc_file" => $filename
                );
                $this->My_model->insert_data('tb_e_document', $arr);
            }
        }

        $reciverArr = $this->input->post('selectManager');
        if (isset($reciverArr)) {

            $arr = array(
                "edoc_send_no" => $this->input->post('outEdocSendNo'),
                "edoc_send_date" => date('Y-m-d'),
                "edoc_no" => $this->input->post('outEdocNo'),
                "edoc_date" => $this->input->post('outEdocDate'),
                "edoc_type" => $this->input->post('outEdocType'),
                "edoc_to" => $this->input->post('inEdocTo'),
                "edoc_topic" => $this->input->post('inEdocTopic'),
                "edoc_to_department" => $reciverArr,
                "edoc_level" => "ปกติ",
                "edoc_psermission" => "ปกติ",
                "edoc_recorder" => $this->session->userdata('name'),
                "edoc_department" => $this->session->userdata('department'),
                "edoc_file" => $filename
            );
            $this->My_model->insert_data('tb_e_document', $arr);
        }
    }

// index
    public function index() {
        $data['edoc_inbox'] = $this->Edocument_model->get_inbox();
        $data['edoc_outbox'] = $this->Edocument_model->get_outbox();

        $data['hr_manager'] = $this->My_model->get_where_order('tb_human_resources_01', array('hr_type_id' => '3', 'hr_department' => $this->session->userdata('department')), 'id');
        $data['hr_group_learning'] = $this->My_model->get_all_order('tb_group_learning', 'tb_group_learning_seq');
        $data['hr_division'] = $this->My_model->get_all_order('tb_division', 'tb_division_name');
        //$this->session->userdata('localgov'); 
        $data['school'] = $this->My_model->get_where_order('tb_school', array('sc_localgov' => $this->session->userdata('localgov'), 'school_type_id!=' => 0), 'sc_thai_name');

        $tmp = $this->Edutech_model->get_max_where_col('tb_e_document', 'edoc_rc_no', array('edoc_to_department' => $this->session->userdata('department'), 'edoc_department' => $this->session->userdata('department')));
        if (isset($tmp['col'])) {
            $arr = explode("/", $tmp['col']);
            $data['edoc_rc_no'] = $arr[0] . "/" . insert_zero_f_position((intval($arr[1]) + 1), 5);
        } else {
            $data['edoc_rc_no'] = (date('Y') + 543) . "/00001";
        }
        $tmp2 = $this->Edutech_model->get_max_where_col('tb_e_document', 'edoc_send_no', array('edoc_department' => $this->session->userdata('department')));
        if (isset($tmp2['col'])) {
            $arr2 = explode("/", $tmp2['col']);
            $data['edoc_send_no'] = $arr2[0] . "/" . insert_zero_f_position((intval($arr2[1]) + 1), 5);
        } else {
            $data['edoc_send_no'] = (date('Y') + 543) . "/00001";
        }
        $this->load->view("layout/header");
        $this->load->view("edocument/index", $data);
        $this->load->view("layout/footer");
    }

    public function inbox() {
        $data['edoc_inbox'] = $this->Edocument_model->get_inbox_personal();

        $this->load->view("layout/header");
        $this->load->view("edocument/inbox", $data);
        $this->load->view("layout/footer");
    }

    public function get_next_no($no, $delimited) {
        $str = explode($delimiter, $no);
        $nint = intval($str[sizeof($str) - 1]) + 1;
        $len = sizeof($str);
        $i = 0;
        $rest = "";
        foreach ($str as $val) {
            if ($i == ($len - 1)) {
                $rest .= (intval($str[i]) + 1);
            } else {
                $rest .= $str[i];
            }
        }
    }

}
