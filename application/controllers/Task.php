<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/*
  | ----------------------------------------------------------------------------
  |  Title ระบบตารางสำหรับโครงการ
  | ----------------------------------------------------------------------------
  | Copyright	Edutech Co.,Ltd.
  | Purpose
  | Author ภาวิณี ตรีหิรัญ
  | Create Date 25 Nov 2018
  | Last edit	-
  | Comment	-
  | ----------------------------------------------------------------------------
 */

Class Task extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model("Task_model");
    }

    public function index() {
        // ตรวจสอบว่ากำหนดรายละเอียดของ อปท.หรือยัง
        $chk_org = $this->My_model->get_all('tb_organization');
        if (count($chk_org) == 0) {
            redirect("insert-organization");
        }
        //
        if ($this->session->userdata('status') == "ผู้ดูแลระบบ") {
            redirect("administrator");
        }

        //ปฏิทินปฏิบัติงาน  

        $data['rs'] = $this->Task_model->get_all_task();
        $data['division'] = $this->Task_model->get_division();
        $data['team'] = $this->Task_model->get_team();
        $this->load->view("layout/header");
        $this->load->view("task/task", $data);
        $this->load->view("layout/footer");
    }

    public function task_add() {
        $id = $_POST['id'];
        if ($_FILES['inTaskDoc1']['name'] != "") {
            $row = $this->My_model->get_where_row("tb_task_doc", array("id" => $id));
            @unlink("upload/" . $row['filename']);
            //
            $config = array(
                "upload_path" => "upload/",
                "allowed_types" => "jpg|jpeg|png|pdf|doc|docx|xls|xlsx",
                "max_size" => 0,
                "file_name" => md5(date("YmdHis"))
            );
            $this->upload->initialize($config);
            $this->upload->do_upload("inTaskDoc1");
            $data = $this->upload->data();
            $arr = array("filename" => $data['file_name']);
            $this->My_model->update_data("tb_task_doc", array("id" => $id), $arr);
            $filename1 = $data['file_name'];
        } else {
            $filename1 = "";
        }
        //
        if ($_FILES['inTaskDoc2']['name'] != "") {
            $row = $this->My_model->get_where_row("tb_task_doc", array("id" => $id));
            @unlink("upload/" . $row['filename']);
            //
            $config = array(
                "upload_path" => "upload/",
                "allowed_types" => "jpg|jpeg|png|pdf|doc|docx|xls|xlsx",
                "max_size" => 0,
                "file_name" => md5(date("YmdHis"))
            );
            $this->upload->initialize($config);
            $this->upload->do_upload("inTaskDoc2");
            $data = $this->upload->data();
            $arr = array("filename" => $data['file_name']);
            $this->My_model->update_data("tb_task_doc", array("id" => $id), $arr);
            $filename2 = $data['file_name'];
        } else {
            $filename2 = "";
        }
        //
        if ($_FILES['inTaskDoc3']['name'] != "") {
            $row = $this->My_model->get_where_row("tb_task_doc", array("id" => $id));
            @unlink("upload/" . $row['filename']);
            //
            $config = array(
                "upload_path" => "upload/",
                "allowed_types" => "jpg|jpeg|png|pdf|doc|docx|xls|xlsx",
                "max_size" => 0,
                "file_name" => md5(date("YmdHis"))
            );
            $this->upload->initialize($config);
            $this->upload->do_upload("inTaskDoc3");
            $data = $this->upload->data();
            $arr = array("filename" => $data['file_name']);
            $this->My_model->update_data("tb_task_doc", array("id" => $id), $arr);
            $filename3 = $data['file_name'];
        } else {
            $filename3 = "";
        }
        //
        if ($_FILES['inTaskDoc4']['name'] != "") {
            $row = $this->My_model->get_where_row("tb_task_doc", array("id" => $id));
            @unlink("upload/" . $row['filename']);
            //
            $config = array(
                "upload_path" => "upload/",
                "allowed_types" => "jpg|jpeg|png|pdf|doc|docx|xls|xlsx",
                "max_size" => 0,
                "file_name" => md5(date("YmdHis"))
            );
            $this->upload->initialize($config);
            $this->upload->do_upload("inTaskDoc4");
            $data = $this->upload->data();
            $arr = array("filename" => $data['file_name']);
            $this->My_model->update_data("tb_task_doc", array("id" => $id), $arr);
            $filename4 = $data['file_name'];
        } else {
            $filename4 = "";
        }
        //

        $arr = array(
            "tb_task_title" => $this->input->post('inTaskTitle'),
            "tb_task_job" => $this->input->post('inTaskJob'),
            "tb_task_status" => $this->input->post('inTaskStatus'),
            "tb_task_complete" => $this->input->post('inTaskComplete'),
            "tb_task_assign" => $this->input->post('inTaskAssign'),
            "tb_task_comment" => $this->input->post('inTaskComment'),
            "tb_task_priority" => $this->input->post('inTaskPriority'),
            "tb_task_start_date" => $this->input->post('inTaskStartDate'),
            "tb_task_deadline" => $this->input->post('inTaskDeadline')
        );
        if ($id != "" || $id != 0) {


            $this->My_model->update_data('tb_task', array('id' => $id), $arr);
        } else {
            $this->My_model->insert_data('tb_task', $arr);
            $id = $this->db->insert_id();

            /* ------------------------------------------------------------------- */

            // บันทึกข้อมูล tb_task_doc
            if ($filename1 !== '') {
                $arr = array("task_id" => $id, "filename" => $filename1);
                $this->My_model->insert_data("tb_task_doc", $arr);
            }
            if ($filename2 !== '') {
                $arr = array("task_id" => $id, "filename" => $filename2);
                $this->My_model->insert_data("tb_task_doc", $arr);
            }
            if ($filename3 !== '') {
                $arr = array("task_id" => $id, "filename" => $filename3);
                $this->My_model->insert_data("tb_task_doc", $arr);
            }
            if ($filename4 !== '') {
                $arr = array("task_id" => $id, "filename" => $filename4);
                $this->My_model->insert_data("tb_task_doc", $arr);
            }
        }
    }

    // แก้ไขข้อมูล
    public function task_edit() {
        $id = $_POST['id'];
        $rs = $this->My_model->get_where_row('tb_task', array('id' => $id));
        echo json_encode($rs);
    }
    
    public function task_delete() {
        $id = $_POST['id'];
        $this->My_model->delete_data('tb_task', array('id' => $id));
    }

}
