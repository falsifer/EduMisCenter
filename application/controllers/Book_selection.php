<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/*
  | ============================================================================
  |  Title: Class Setting
  | ============================================================================
  | Copyright	Edutech Co.,Ltd.
  | Purpose     กำหนดค่าเร่ิมต้นของโปรแกรม
  | Author	นายบัณฑิต ไชยดี
  | Create Date  November 13, 2018
  | Last edit	-
  | Comment	-
  | ============================================================================
 */

class Book_selection extends CI_Controller {

    public function __construct() {
        parent::__construct();
    }

    /*
     * To change this license header, choose License Headers in Project Properties.
     * To change this template file, choose Tools | Templates
     * and open the template in the editor.
     */

// ประชาสัมพันธ์
    public function bs_base() {

        $data['rs'] = $this->My_model->get_where_order('tb_book_selection', array('bs_department' => $this->session->userdata('department')), 'bs_name ASC');

        $this->load->view("layout/header");
        $this->load->view("book_selection/bs_base", $data);
        $this->load->view("layout/footer");
    }

    public function bs_insert_view() {
        $this->load->view("layout/header");
        $this->load->view("book_selection/bs_insert_view");
        $this->load->view("layout/footer");
    }

    //----- Code Delete ------//
    public function bs_delete() {
        $id = $_POST['id'];
        $this->My_model->delete_data('tb_book_selection', array('id' => $id));
    }

    //----- End Code Delete ------//
//--- Code Insert ---//
    public function bs_insert() {
        if ($_FILES['inBsImage']['name'] != "") {
            $config = array(
                "upload_path" => "upload/",
                "allowed_types" => "jpg",
                "max_size" => 0,
                "file_name" => md5(date("YmdHis"))
            );
            $this->upload->initialize($config);
            $this->upload->do_upload("inBsImage");
            $data = $this->upload->data();

            $this->load->library("image_lib");
            $config['image_library'] = "gd2";
            $config["source_image"] = "upload/" . $data['file_name'];
            $config['maintain_ratio'] = TRUE;
            $config['width'] = 1024;
            $config['height'] = 768;

            $this->image_lib->initialize($config);
            $this->image_lib->resize();
            $filename1 = $data['file_name'];
        } else {
            $filename1 = "";
        }
        $arr = array(
            "bs_name" => $this->input->post('inBsName'),
            "bs_subj" => $this->input->post('inBsSubj'),
            "bs_sara" => $this->input->post('inBsSara'),
            "bs_class" => $this->input->post('inBsClass'),
            "bs_publisher" => $this->input->post('inBsPublisher'),
            "bs_writer" => $this->input->post('inBsWriter'),
            "bs_year" => $this->input->post('inBsYear'),
            "bs_price" => $this->input->post('inBsPrice'),
            "bs_recorder" => $this->session->userdata('name'),
            "bs_department" => $this->session->userdata('department'),
            "bs_pic" => $filename1
        );
        $this->My_model->insert_data('tb_book_selection', $arr);
        $id = $this->db->insert_id();
    }

    //--- end Code Insert ---//
    //--- Code Code Detail ---//
    public function bs_detail() {
        $id = $_POST['id'];
        $row = $this->My_model->get_where_row("tb_book_selection", array("id" => $id));
        $outp = "<div class='container-fluid'>"
                . "<div class='row'>";
        //---- แสดงภาพประกอบ ----//
        $outp .= "<table style='width:100%;'>";
        $outp .= "<tr><td style='padding-top:20px;'>";
        if (file_exists("upload/" . $row['bs_pic']) && !empty($row['bs_pic'])) {
            $outp .= img(array('src' => "upload/" . $row['bs_pic'], "style" => "width:238px;height:221px;border:5px solid #C0C0C0;")) . nbs(5);
        }
        //---- จบภาพประกอบ ----//
        //------ โชว์ข้อมูล ------//
        $outp .= "<table style='width:100%;'>"
                . "<tr>"
                . "<td class='data-title' style='width:20%;'>ชื่อหนังสือ</td>"
                . "<td class='data-show'>{$row['bs_name']}</td>"
                . "<tr>"
                . "<td class='data-title'>รายวิชา</td>"
                . "<td class='data-show'>{$row['bs_subj']}</td>"
                . "</tr>"
                . "<tr>"
                . "<td class='data-title'>กลุ่มสาระการเรียนรู้</td><td class='data-show'>{$row['bs_sara']}</td>"
                . "</tr>"
                . "</tr>"
                . "<tr>"
                . "<td class='data-title'>ชั้น</td><td class='data-show'>{$row['bs_class']}</td>"
                . "</tr>"
                . "<tr>"
                . "<td class='data-title'>ผู้จัดพิมพ์</td><td class='data-show'>{$row['bs_publisher']}</td>"
                . "</tr>"
                . "<tr>"
                . "<td class='data-title'>ผู้เรียบเรียง</td><td class='data-show'>{$row['bs_writer']}</td>"
                . "</tr>"
                . "<tr>"
                . "<td class='data-title'>ปี พ.ศ. ที่เผยแพร่</td><td class='data-show'>{$row['bs_year']}</td>"
                . "</tr>"
                . "<tr>"
                . "<td class='data-title'>ราคา(บาท)</td><td class='data-show'>{$row['bs_price']}</td>"
                . "</tr>"
                . "</table>";
        $outp .= "</table>";
        //------ จบโชว์ข้อมูล ------//

        $outp .= "</td></tr>";
        $outp .= "</div></div>";
        echo $outp;
    }

    //--- End Code Detail ---//
    //
    //
    //----- Code Edit ------//
    public function bs_edit() {
        $id = $_POST['id'];
        $rs = $this->My_model->get_where_row("tb_book_selection", array("id" => $id));
        echo json_encode($rs);
    }

    //----- End Code Edit ------//
    //
    //
    //--- Code Update ---//
    public function bs_update() {

        $id = $_POST['id'];
        if ($_FILES['inBsImage']['name'] != "") {
            $row = $this->My_model->get_where_row("tb_book_selection", array("id" => $id));
            @unlink("upload/" . $row['bs_pic']);
            $config = array(
                "upload_path" => "upload/",
                "allowed_types" => "jpg",
                "max_size" => 0,
                "file_name" => md5(date("YmdHis"))
            );
            $this->upload->initialize($config);
            $this->upload->do_upload("inBsImage");
            $data = $this->upload->data();

            $this->load->library("image_lib");
            $config['image_library'] = "gd2";
            $config["source_image"] = "upload/" . $data['file_name'];
            $config['maintain_ratio'] = TRUE;
            $config['width'] = 1024;
            $config['height'] = 768;
            $this->image_lib->initialize($config);
            $this->image_lib->resize();
            //
            $arr = array("bs_pic" => $data['file_name']);
            $this->My_model->update_data("tb_book_selection", array("id" => $id), $arr);
        }
        $arr = array(
            "bs_name" => $this->input->post('inBsName'),
            "bs_subj" => $this->input->post('inBsSubj'),
            "bs_sara" => $this->input->post('inBsSara'),
            "bs_class" => $this->input->post('inBsClass'),
            "bs_publisher" => $this->input->post('inBsPublisher'),
            "bs_writer" => $this->input->post('inBsWriter'),
            "bs_year" => $this->input->post('inBsYear'),
            "bs_price" => $this->input->post('inBsPrice')
        );
        if ($id != "") {
            $this->My_model->update_data('tb_book_selection', array('id' => $id), $arr);
        }
    }

    //--- End Code update ---//
}
