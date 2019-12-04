<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/*
  | ============================================================================
  |  Title: Class Setting
  | ============================================================================
  | Copyright	Edutech Co.,Ltd.
  | Purpose     กำหนดค่าเร่ิมต้นของโปรแกรม
  | Author
  | Create Date
  | Last edit	-
  | Comment	-
  | ============================================================================
 */

class student_council extends CI_Controller {

    public function __construct() {
        parent::__construct();
    }

    /*
     * To change this license header, choose License Headers in Project Properties.
     * To change this template file, choose Tools | Templates
     * and open the template in the editor.
     */

// ประชาสัมพันธ์
    public function student_council() {
        $check = $this->session->userdata('department');
        $data['rs'] = $this->My_model->get_where_order('tb_student_council', array('tb_school_id' => $this->session->userdata('sch_id')), 'tb_student_council_date ASC');

        $this->load->view("layout/header");
        $this->load->view("student_council/student_council_base", $data);
        $this->load->view("layout/footer");
    }

    public function student_council_insert_view() {
        $this->load->view("layout/header");
        $this->load->view("student_council/student_council_insert_view");
        $this->load->view("layout/footer");
    }

    //----- Code Delete ------//
    public function student_council_delete() {
        $id = $_POST['id'];
        $this->My_model->delete_data('tb_student_council', array('id' => $id));
    }

    //----- End Code Delete ------//
//--- Code Insert ---//
    public function student_council_insert() {
        if ($_FILES['inTbStudentCouncilImg1']['name'] != "") {
            $config = array(
                "upload_path" => "upload/",
                "allowed_types" => "jpg|png|jpeg",
                "max_size" => 0,
                "file_name" => md5(date("YmdHis"))
            );
            $this->upload->initialize($config);
            $this->upload->do_upload("inTbStudentCouncilImg1");
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
        if ($_FILES['inTbStudentCouncilImg2']['name'] != "") {
            $config = array(
                "upload_path" => "upload/",
                "allowed_types" => "jpg|png|jpeg",
                "max_size" => 0,
                "file_name" => md5(date("YmdHis"))
            );
            $this->upload->initialize($config);
            $this->upload->do_upload("inTbStudentCouncilImg2");
            $data = $this->upload->data();

            $this->load->library("image_lib");
            $config['image_library'] = "gd2";
            $config["source_image"] = "upload/" . $data['file_name'];
            $config['maintain_ratio'] = TRUE;
            $config['width'] = 1024;
            $config['height'] = 768;

            $this->image_lib->initialize($config);
            $this->image_lib->resize();
            $filename2 = $data['file_name'];
        } else {
            $filename2 = "";
        }
        if ($_FILES['inTbStudentCouncilImg3']['name'] != "") {
            $config = array(
                "upload_path" => "upload/",
                "allowed_types" => "jpg|png|jpeg",
                "max_size" => 0,
                "file_name" => md5(date("YmdHis"))
            );
            $this->upload->initialize($config);
            $this->upload->do_upload("inTbStudentCouncilImg3");
            $data = $this->upload->data();

            $this->load->library("image_lib");
            $config['image_library'] = "gd2";
            $config["source_image"] = "upload/" . $data['file_name'];
            $config['maintain_ratio'] = TRUE;
            $config['width'] = 1024;
            $config['height'] = 768;

            $this->image_lib->initialize($config);
            $this->image_lib->resize();
            $filename3 = $data['file_name'];
        } else {
            $filename3 = "";
        }
        $arr = array(
            "tb_student_council_content" => $this->input->post('inTbStudentCouncilContent'),
            "tb_student_council_detail" => $this->input->post('inTbStudentCouncilDetail'),
            "tb_student_council_date" => $this->input->post('inTbStudentCouncilDate'),
            "tb_student_council_recorder" => $this->session->userdata('name'),
            "tb_student_council_department" => $this->session->userdata('department'),
            "tb_student_council_create_date" => date('Y-m-d'),
            "tb_student_council_img1" => $filename1,
            "tb_student_council_img2" => $filename2,
            "tb_student_council_img3" => $filename3,
            "tb_school_id" => $this->session->userdata('sch_id'),
        );
        $this->My_model->insert_data('tb_student_council', $arr);
//        $id = $this->db->insert_id();
    }

    //--- end Code Insert ---//
    //--- Code Code Detail ---//
    public function student_council_detail() {
        $id = $_POST['id'];
        $row = $this->My_model->get_where_row("tb_student_council", array("id" => $id));
        $outp = "<div class='container-fluid'>"
                . "<div class='row'>";
        //---- แสดงภาพประกอบ ----//
        $outp .= "<table style='width:100%;'>";
        $outp .= "<tr><td style='padding-top:20px;'>";
        $outp .= "<center>";
        if (file_exists("upload/" . $row['tb_student_council_img1']) && !empty($row['tb_student_council_img1'])) {
            $outp .= img(array('src' => "upload/" . $row['tb_student_council_img1'], "style" => "width:238px;height:221px;border:5px solid #C0C0C0;")) . nbs(5);
        }
        if (file_exists("upload/" . $row['tb_student_council_img2']) && !empty($row['tb_student_council_img2'])) {
            $outp .= img(array('src' => "upload/" . $row['tb_student_council_img2'], "style" => "width:238px;height:221px;border:5px solid #C0C0C0;")) . nbs(5);
        }
        if (file_exists("upload/" . $row['tb_student_council_img3']) && !empty($row['tb_student_council_img3'])) {
            $outp .= img(array('src' => "upload/" . $row['tb_student_council_img3'], "style" => "width:238px;height:221px;border:5px solid #C0C0C0;")) . nbs(5);
        }
        $outp .= "</center>";
        $outp .= "<br></br>";
        //---- จบภาพประกอบ ----//
        //------ โชว์ข้อมูล ------//
        $outp .= "<table style='width:100%;'>"
                . "<tr>"
                . "<td class='data-title' style='width:20%;'>กิจกรรม</td>"
                . "<td class='data-show'>{$row['tb_student_council_content']}</td>"
                . "</tr>"
                . "<tr>"
                . "<td class='data-title'>รายละเอียดกิจกรรม</td>"
                . "<td class='data-show'>{$row['tb_student_council_detail']}</td>"
                . "</tr>"
                . "<tr>"
                . "<td class='data-title'>วันที่</td>"
                . "<td class='data-show'>{$row['tb_student_council_date']}</td>"
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
    public function student_council_edit() {
        $id = $_POST['id'];
        $rs = $this->My_model->get_where_row("tb_student_council", array("id" => $id));
        echo json_encode($rs);
    }

    //----- End Code Edit ------//
    //
    //
    //--- Code Update ---//
    public function student_council_update() {

        $id = $_POST['id'];
        if ($_FILES['inTbStudentCouncilImg1']['name'] != "") {
            $row = $this->My_model->get_where_row("tb_student_council", array("id" => $id));
            @unlink("upload/" . $row['bs_pic']);
            $config = array(
                "upload_path" => "upload/",
                "allowed_types" => "jpg|png|jpeg",
                "max_size" => 0,
                "file_name" => md5(date("YmdHis"))
            );
            $this->upload->initialize($config);
            $this->upload->do_upload("inTbStudentCouncilImg1");
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
            $arr = array("tb_student_council_img1" => $data['file_name']);
            $this->My_model->update_data("tb_student_council", array("id" => $id), $arr);
        }

        if ($_FILES['inTbStudentCouncilImg2']['name'] != "") {
            $row = $this->My_model->get_where_row("tb_student_council", array("id" => $id));
            @unlink("upload/" . $row['bs_pic']);
            $config = array(
                "upload_path" => "upload/",
                "allowed_types" => "jpg|png|jpeg",
                "max_size" => 0,
                "file_name" => md5(date("YmdHis"))
            );
            $this->upload->initialize($config);
            $this->upload->do_upload("inTbStudentCouncilImg2");
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
            $arr = array("tb_student_council_img2" => $data['file_name']);
            $this->My_model->update_data("tb_student_council", array("id" => $id), $arr);
        }

        if ($_FILES['inTbStudentCouncilImg3']['name'] != "") {
            $row = $this->My_model->get_where_row("tb_student_council", array("id" => $id));
            @unlink("upload/" . $row['bs_pic']);
            $config = array(
                "upload_path" => "upload/",
                "allowed_types" => "jpg|png|jpeg",
                "max_size" => 0,
                "file_name" => md5(date("YmdHis"))
            );
            $this->upload->initialize($config);
            $this->upload->do_upload("inTbStudentCouncilImg3");
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
            $arr = array("tb_student_council_img3" => $data['file_name']);
            $this->My_model->update_data("tb_student_council", array("id" => $id), $arr);
        }
        $arr = array(
            "tb_student_council_content" => $this->input->post('inTbStudentCouncilContent'),
            "tb_student_council_detail" => $this->input->post('inTbStudentCouncilDetail'),
            "tb_student_council_date" => $this->input->post('inTbStudentCouncilDate')
        );
        if ($id != "") {
            $this->My_model->update_data('tb_student_council', array('id' => $id), $arr);
        }
    }

    //--- End Code update ---//
}
