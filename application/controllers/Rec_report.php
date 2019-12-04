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

class Rec_report extends CI_Controller {

    public function __construct() {
        parent::__construct();

        if ($this->session->userdata('status') == "") {
            redirect("/");
        }
    }

    /*
     * To change this license header, choose License Headers in Project Properties.
     * To change this template file, choose Tools | Templates
     * and open the template in the editor.
     */

// ประชาสัมพันธ์
    public function rec_report_base() {



        $data['rs'] = $this->My_model->get_where_order('tb_rec_report', array('tb_rec_report_recorder' => $this->session->userdata('name')), 'id ASC');


        $this->load->view("layout/header");
        $this->load->view("rec_report/rec_report_base", $data);
        $this->load->view("layout/footer");
    }

    public function rec_report_insert_view() {

        $this->load->view("layout/header");
        $this->load->view("rec_report/rec_report_insert_view");
        $this->load->view("layout/footer");
    }

    //----- Code Delete ------//
    public function rec_report_delete() {
        $id = $_POST['id'];
        $this->My_model->delete_data('tb_rec_report', array('id' => $id));
    }

    //----- End Code Delete ------//
//--- Code Insert ---//
    public function rec_report_insert() {
        if ($_FILES['inTbRecReportImg1']['name'] != "") {
            $config = array(
                "upload_path" => "upload/",
                "allowed_types" => "jpg",
                "max_size" => 0,
                "file_name" => md5(date("YmdHis"))
            );
            $this->upload->initialize($config);
            $this->upload->do_upload("inTbRecReportImg1");
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
        if ($_FILES['inTbRecReportImg2']['name'] != "") {
            $config = array(
                "upload_path" => "upload/",
                "allowed_types" => "jpg",
                "max_size" => 0,
                "file_name" => md5(date("YmdHis"))
            );
            $this->upload->initialize($config);
            $this->upload->do_upload("inTbRecReportImg2");
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
        if ($_FILES['inTbRecReportImg3']['name'] != "") {
            $config = array(
                "upload_path" => "upload/",
                "allowed_types" => "jpg",
                "max_size" => 0,
                "file_name" => md5(date("YmdHis"))
            );
            $this->upload->initialize($config);
            $this->upload->do_upload("inTbRecReportImg3");
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
        if ($_FILES['inTbRecReportFile']['name'] != "") {
            $row = $this->My_model->get_where_row("tb_rec_report", array("id" => $id0));
            @unlink("upload/" > $row['tb_rec_report_file']);
            $config = array(
                "upload_path" => "upload/",
                "allowed_types" => "pdf",
                "max_size" => 0,
                "file_name" => md5(date("YmdHis"))
            );
            $this->upload->initialize($config);
            $this->upload->do_upload("inTbRecReportFile");
            $data = $this->upload->data();
            $filename4 = $data['file_name'];
            $arr = array("tb_rec_report_file" => $filename4);
            $this->My_model->update_data("tb_rec_report", array("id" => $id), $arr);
        }
        $arr = array(
            "tb_rec_report_topic" => $this->input->post('inTbRecReportTopic'),
            "tb_rec_report_date" => $this->input->post('inTbRecReportDate'),
            "tb_rec_report_for" => $this->input->post('inTbRecReportFor'),
            "tb_rec_report_refer" => $this->input->post('inTbRecReportRefer'),
            "tb_rec_report_attach" => $this->input->post('inTbRecReportAttach'),
            "tb_rec_report_content" => $this->input->post('inTbRecReportContent'),
            "tb_rec_report_conclude" => $this->input->post('inTbRecReportConclude'),
            "tb_rec_report_recorder" => $this->session->userdata('name'),
            "tb_rec_report_department" => $this->session->userdata('department'),
            "tb_rec_report_img1" => $filename1,
            "tb_rec_report_img2" => $filename2,
            "tb_rec_report_img3" => $filename3,
            "tb_rec_report_file" => $filename4
        );
        $this->My_model->insert_data('tb_rec_report', $arr);
        $id = $this->db->insert_id();
    }

    //--- end Code Insert ---//
    //--- Code Code Detail ---//
    public function rec_report_detail() {
        $id = $_POST['id'];
        $row = $this->My_model->get_where_row("tb_rec_report", array("id" => $id));
        $outp = "<div class='container-fluid'>"
                . "<div class='row'>";
        //---- แสดงภาพประกอบ ----//

        $outp .= "<div class=\"row\">";

        $outp .= "<div class=\"col-md-4\">";
        if (file_exists("upload/" . $row['tb_rec_report_img1']) && !empty($row['tb_rec_report_img1'])) {
            $outp .= img(array('src' => "upload/" . $row['tb_rec_report_img1'], "style" => "width:100%;height:50%;border:5px solid #C0C0C0;")) . nbs(5);
        }
        $outp .= "</div>";

        $outp .= "<div class=\"col-md-4\">";
        if (file_exists("upload/" . $row['tb_rec_report_img2']) && !empty($row['tb_rec_report_img2'])) {
            $outp .= img(array('src' => "upload/" . $row['tb_rec_report_img2'], "style" => "width:100%;height:50%;border:5px solid #C0C0C0;")) . nbs(5);
        }
        $outp .= "</div>";

        $outp .= "<div class=\"col-md-4\">";
        if (file_exists("upload/" . $row['tb_rec_report_img3']) && !empty($row['tb_rec_report_img3'])) {
            $outp .= img(array('src' => "upload/" . $row['tb_rec_report_img3'], "style" => "width:100%;height:50%;border:5px solid #C0C0C0;")) . nbs(5);
        }
        $outp .= "</div>";

        $outp .= "</div>";
        //---- จบภาพประกอบ ----//
        //------ โชว์ข้อมูล ------//
        $outp .= "<table style='width:100%;'>"
                . "<tr>"
                . "<td class='data-title' style='width:20%;'>เรื่อง</td>"
                . "<td class='data-show'>{$row['tb_rec_report_topic']}</td>"
                . "<tr>"
                . "<td class='data-title'>เรียน</td>"
                . "<td class='data-show'>{$row['tb_rec_report_for']}</td>"
                . "</tr>"
                . "<tr>"
                . "<td class='data-title'>อ้างถึง</td>"
                . "<td class='data-show'>{$row['tb_rec_report_refer']}</td>"
                . "</tr>"
                . "<td class='data-title'>เนื้อหา</td>"
                . "<td class='data-show'>{$row['tb_rec_report_content']}</td>"
                . "</tr>"
                . "<tr>"
                . "<td class='data-title'>สรุปผล</td>"
                . "<td class='data-show'>{$row['tb_rec_report_conclude']}</td>"
                . "</tr>"
                . "<tr>"
                . "<td class='data-title'>สิ่งที่แนบมาด้วย</td>"
                . "<td class='data-show'>{$row['tb_rec_report_attach']}"
                . ""
                . "";
        if (file_exists("upload/" . $row["tb_rec_report_file"]) && !empty($row["tb_rec_report_file"])) {
            $outp .= '&nbsp;' .anchor(base_url() . "upload/" . $row["tb_rec_report_file"], "ดูเอกสารแนบ", array("target" => "_blank")) . "";
        }
        $outp .= "</td><tr></table>";


        //------ จบโชว์ข้อมูล ------//

        $outp .= "</div></div>";
        echo $outp;
    }

    //--- End Code Detail ---//
    //
    //
    //----- Code Edit ------//
    public function rec_report_edit() {
        $id = $_POST['id'];
        $rs = $this->My_model->get_where_row("tb_rec_report", array("id" => $id));
        echo json_encode($rs);
    }

    //----- End Code Edit ------//
    //
    //
    //--- Code Update ---//
    public function rec_report_update() {

        $id = $_POST['id'];
        if ($_FILES['inTbRecReportImg1']['name'] != "") {
            $config = array(
                "upload_path" => "upload/",
                "allowed_types" => "jpg",
                "max_size" => 0,
                "file_name" => md5(date("YmdHis"))
            );
            $this->upload->initialize($config);
            $this->upload->do_upload("inTbRecReportImg1");
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
        if ($_FILES['inTbRecReportImg2']['name'] != "") {
            $config = array(
                "upload_path" => "upload/",
                "allowed_types" => "jpg",
                "max_size" => 0,
                "file_name" => md5(date("YmdHis"))
            );
            $this->upload->initialize($config);
            $this->upload->do_upload("inTbRecReportImg2");
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
        if ($_FILES['inTbRecReportImg3']['name'] != "") {
            $config = array(
                "upload_path" => "upload/",
                "allowed_types" => "jpg",
                "max_size" => 0,
                "file_name" => md5(date("YmdHis"))
            );
            $this->upload->initialize($config);
            $this->upload->do_upload("inTbRecReportImg3");
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
        if ($_FILES['inTbRecReportFile']['name'] != "") {
            $row = $this->My_model->get_where_row("tb_rec_report", array("id" => $id0));
            @unlink("upload/" > $row['tb_rec_report_file']);
            $config = array(
                "upload_path" => "upload/",
                "allowed_types" => "pdf",
                "max_size" => 0,
                "file_name" => md5(date("YmdHis"))
            );
            $this->upload->initialize($config);
            $this->upload->do_upload("inTbRecReportFile");
            $data = $this->upload->data();
            $filename4 = $data['file_name'];
            $arr = array("tb_rec_report_file" => $filename4);
            $this->My_model->update_data("tb_rec_report", array("id" => $id), $arr);
        }
        $arr = array(
            "tb_rec_report_topic" => $this->input->post('inTbRecReportTopic'),
            "tb_rec_report_date" => $this->input->post('inTbRecReportDate'),
            "tb_rec_report_for" => $this->input->post('inTbRecReportFor'),
            "tb_rec_report_refer" => $this->input->post('inTbRecReportRefer'),
            "tb_rec_report_attach" => $this->input->post('inTbRecReportAttach'),
            "tb_rec_report_content" => $this->input->post('inTbRecReportContent'),
            "tb_rec_report_conclude" => $this->input->post('inTbRecReportConclude'),
            "tb_rec_report_recorder" => $this->session->userdata('name'),
            "tb_rec_report_department" => $this->session->userdata('department'),
            "tb_rec_report_img1" => $filename1,
            "tb_rec_report_img2" => $filename2,
            "tb_rec_report_img3" => $filename3,
            "tb_rec_report_file" => $filename4
        );
        if ($id != "") {
            $this->My_model->update_data('tb_rec_report', array('id' => $id), $arr);
        }
    }

    //--- End Code update ---//
}
