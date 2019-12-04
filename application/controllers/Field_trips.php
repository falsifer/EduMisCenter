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

class field_trips extends CI_Controller {

    public function __construct() {
        parent::__construct();
    }

    /*
     * To change this license header, choose License Headers in Project Properties.
     * To change this template file, choose Tools | Templates
     * and open the template in the editor.
     */

// ประชาสัมพันธ์
    public function field_trips_base() {
        $check = $this->session->userdata('department');
        $data['rs'] = $this->My_model->get_all_order('tb_field_trips', 'id ASC');

        $this->load->view("layout/header");
        $this->load->view("field_trips/field_trips_base", $data);
        $this->load->view("layout/footer");
    }

    public function field_trips_insert_view() {
        $this->load->view("layout/header");
        $this->load->view("field_trips/field_trips_insert_view");
        $this->load->view("layout/footer");
    }

    //----- Code Delete ------//
    public function field_trips_delete() {
        $id = $_POST['id'];
        $this->My_model->delete_data('tb_field_trips', array('id' => $id));
    }

    //----- End Code Delete ------//
//--- Code Insert ---//
    public function field_trips_insert() {
        if ($_FILES['inTbFieldTripsImg1']['name'] != "") {
            $config = array(
                "upload_path" => "upload/",
                "allowed_types" => "jpg",
                "max_size" => 0,
                "file_name" => md5(date("YmdHis"))
            );
            $this->upload->initialize($config);
            $this->upload->do_upload("inTbFieldTripsImg1");
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
        if ($_FILES['inTbFieldTripsImg2']['name'] != "") {
            $config = array(
                "upload_path" => "upload/",
                "allowed_types" => "jpg",
                "max_size" => 0,
                "file_name" => md5(date("YmdHis"))
            );
            $this->upload->initialize($config);
            $this->upload->do_upload("inTbFieldTripsImg2");
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
        if ($_FILES['inTbFieldTripsImg3']['name'] != "") {
            $config = array(
                "upload_path" => "upload/",
                "allowed_types" => "jpg",
                "max_size" => 0,
                "file_name" => md5(date("YmdHis"))
            );
            $this->upload->initialize($config);
            $this->upload->do_upload("inTbFieldTripsImg3");
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
            "tb_field_trips_content" => $this->input->post('inTbFieldTripsContent'),
            "tb_field_trips_detail" => $this->input->post('inTbFieldTripsDetail'),
            "tb_field_trips_date" => $this->input->post('inTbFieldTripsDate'),
            "tb_field_trips_amount" => $this->input->post('inTbFieldTripsAmount'),
            "tb_field_trips_budget" => $this->input->post('inTbFieldTripsBudget'),
            "tb_field_trips_place" => $this->input->post('inTbFieldTripsPlace'),
            "tb_field_trips_recorder" => $this->session->userdata('name'),
            "tb_field_trips_department" => $this->session->userdata('department'),
            "tb_field_trips_img1" => $filename1,
            "tb_field_trips_img2" => $filename2,
            "tb_field_trips_img3" => $filename3
        );
        $this->My_model->insert_data('tb_field_trips', $arr);
        $id = $this->db->insert_id();
    }

    //--- end Code Insert ---//
    //--- Code Code Detail ---//
    public function field_trips_detail() {
        $id = $_POST['id'];
        $row = $this->My_model->get_where_row("tb_field_trips", array("id" => $id));
        $outp = "<div class='container-fluid'>"
                . "<div class='row'>";
        //---- แสดงภาพประกอบ ----//
        $outp .= "<table style='width:100%;'>";
        $outp .= "<tr><td style='padding-top:20px;'>";
        $outp .= "<center>";
        if (file_exists("upload/" . $row['tb_field_trips_img1']) && !empty($row['tb_field_trips_img1'])) {
            $outp .= img(array('src' => "upload/" . $row['tb_field_trips_img1'], "style" => "width:238px;height:221px;border:5px solid #C0C0C0;")) . nbs(5);
        }
        if (file_exists("upload/" . $row['tb_field_trips_img2']) && !empty($row['tb_field_trips_img2'])) {
            $outp .= img(array('src' => "upload/" . $row['tb_field_trips_img2'], "style" => "width:238px;height:221px;border:5px solid #C0C0C0;")) . nbs(5);
        }
        if (file_exists("upload/" . $row['tb_field_trips_img3']) && !empty($row['tb_field_trips_img3'])) {
            $outp .= img(array('src' => "upload/" . $row['tb_field_trips_img3'], "style" => "width:238px;height:221px;border:5px solid #C0C0C0;")) . nbs(5);
        }
        $outp .= "</center>";
        $outp .= "<br></br>";
        //---- จบภาพประกอบ ----//
        //------ โชว์ข้อมูล ------//
        $outp .= "<table style='width:100%;'>"
                . "<tr>"
                . "<td class='data-title' style='width:20%;'>กิจกรรม</td>"
                . "<td class='data-show'>{$row['tb_field_trips_content']}</td>"
                . "<tr/>"
                . "<tr>"
                . "<td class='data-title'>รายละเอียดกิจกรรม</td>"
                . "<td class='data-show'>{$row['tb_field_trips_detail']}</td>"
                . "</tr>"
                . "<tr>"
                . "<td class='data-title'>วันที่</td>"
                . "<td class='data-show'>{$row['tb_field_trips_date']}</td>"
                . "</tr>"
                . "<tr>"
                . "<td class='data-title'>สถานที่</td>"
                . "<td class='data-show'>{$row['tb_field_trips_place']}</td>"
                . "</tr>"
                . "<tr>"
                . "<td class='data-title'>จำนวนนักเรียน</td>"
                . "<td class='data-show'>{$row['tb_field_trips_amount']} คน</td>"
                . "</tr>"
                . "<tr>"
                . "<td class='data-title'>งบประมาณ</td>"
                . "<td class='data-show'>{$row['tb_field_trips_budget']}</td>"
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
    public function field_trips_edit() {
        $id = $_POST['id'];
        $rs = $this->My_model->get_where_row("tb_field_trips", array("id" => $id));
        echo json_encode($rs);
    }

    //----- End Code Edit ------//
    //
    //
    //--- Code Update ---//
    public function field_trips_update() {

        $id = $_POST['id'];
        if ($_FILES['inTbFieldTripsImg1']['name'] != "") {
            $row = $this->My_model->get_where_row("tb_field_trips", array("id" => $id));
            @unlink("upload/" . $row['tb_field_trips_img1']);
            $config = array(
                "upload_path" => "upload/",
                "allowed_types" => "jpg",
                "max_size" => 0,
                "file_name" => md5(date("YmdHis"))
            );
            $this->upload->initialize($config);
            $this->upload->do_upload("inTbFieldTripsImg1");
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
            $arr = array("tb_field_trips_img1" => $data['file_name']);
            $this->My_model->update_data("tb_field_trips", array("id" => $id), $arr);
        }

        if ($_FILES['inTbFieldTripsImg2']['name'] != "") {
            $row = $this->My_model->get_where_row("tb_field_trips", array("id" => $id));
            @unlink("upload/" . $row['tb_field_trips_img2']);
            $config = array(
                "upload_path" => "upload/",
                "allowed_types" => "jpg",
                "max_size" => 0,
                "file_name" => md5(date("YmdHis"))
            );
            $this->upload->initialize($config);
            $this->upload->do_upload("inTbFieldTripsImg2");
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
            $arr = array("tb_field_trips_img2" => $data['file_name']);
            $this->My_model->update_data("tb_field_trips", array("id" => $id), $arr);
        }

        if ($_FILES['inTbFieldTripsImg3']['name'] != "") {
            $row = $this->My_model->get_where_row("tb_field_trips", array("id" => $id));
            @unlink("upload/" . $row['tb_field_trips_img3']);
            $config = array(
                "upload_path" => "upload/",
                "allowed_types" => "jpg",
                "max_size" => 0,
                "file_name" => md5(date("YmdHis"))
            );
            $this->upload->initialize($config);
            $this->upload->do_upload("inTbFieldTripsImg3");
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
            $arr = array("tb_field_trips_img3" => $data['file_name']);
            $this->My_model->update_data("tb_field_trips", array("id" => $id), $arr);
        }

        $arr = array(
            "tb_field_trips_content" => $this->input->post('inTbFieldTripsContent'),
            "tb_field_trips_detail" => $this->input->post('inTbFieldTripsDetail'),
            "tb_field_trips_date" => $this->input->post('inTbFieldTripsDate'),
            "tb_field_trips_amount" => $this->input->post('inTbFieldTripsAmount'),
            "tb_field_trips_budget" => $this->input->post('inTbFieldTripsBudget'),
            "tb_field_trips_place" => $this->input->post('inTbFieldTripsPlace')
        );
        if ($id != "") {
            $this->My_model->update_data('tb_field_trips', array('id' => $id), $arr);
        }
    }

    //--- End Code update ---//
}
