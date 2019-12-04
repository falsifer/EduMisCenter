<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/*
  | ----------------------------------------------------------------------------
  |  Title
  | ----------------------------------------------------------------------------
  | Copyright	Edutech Co.,Ltd.
  | Purpose     -
  | Author	prtc
  | Create Date -
  | Last edit	-
  | Comment	-
  | ----------------------------------------------------------------------------
 */

class Arsenal extends CI_Controller {

    public function __construct() {
        parent::__construct();
    }

// ระบบ
    public function arsenal_base() {
        $data['rs'] = $this->My_model->get_all_order("tb_arsenal", "id ASC");
        $this->load->view("layout/header");
        $this->load->view("arsenal/arsenal_base", $data);
        $this->load->view("layout/footer");
    }

//--- Code Insert ---//
    public function arsenal_insert() {
        if ($_FILES['inTbArsenalImg']['name'] != "") {
            $config = array(
                "upload_path" => "upload/",
                "allowed_types" => "jpg",
                "max_size" => 0,
                "file_name" => md5(date("YmdHis"))
            );
            $this->upload->initialize($config);
            $this->upload->do_upload("inTbArsenalImg");
            $data = $this->upload->data();

            $this->load->library("image_lib");
            $config['image_library'] = "gd2";
            $config["source_image"] = "upload/" . $data['file_name'];
            $config['maintain_ratio'] = TRUE;
            $config['width'] = 768;
            $config['height'] = 1280;

            $this->image_lib->initialize($config);
            $this->image_lib->resize();
            $filename1 = $data['file_name'];
        } else {
            $filename1 = "";
        }
        if ($_FILES['inTbArsenalDoc']['name'] != "") {
            $config = array(
                "upload_path" => "upload/",
                "allowed_types" => 'pdf|xls|xlsx|doc|docx|rar',
                "max_size" => 0,
                "file_name" => md5(date("YmdHis"))
            );
            $this->upload->initialize($config);
            $this->upload->do_upload("inTbArsenalDoc");
            $data = $this->upload->data();
            $filename2 = $data['file_name'];
        } else {
            $filename2 = "";
        }
        $arr = array(
            "tb_arsenal_link" => $this->input->post('inTbArsenalLink'),
            "tb_arsenal_data" => $this->input->post('inTbArsenalData'),
            "tb_arsenal_img" => $filename1,
            "tb_arsenal_doc" => $filename2
        );
        $this->My_model->insert_data('tb_arsenal', $arr);
        $id = $this->db->insert_id();
    }

    //--- end Code Insert ---//
    //----- Code Edit ------//
    public function arsenal_edit() {
        $id = $_POST['id'];
        $rs = $this->My_model->get_where_row("tb_arsenal", array("id" => $id));
        echo json_encode($rs);
    }

    //----- End Code Edit ------//
// delet data;
    public function arsenal_delete() {
        $id = $_POST['id'];
        $this->My_model->delete_data('tb_arsenal', array('id' => $id));
    }

// km network detail;
    public function bd_detail() {
        $id = $_POST['id'];
        $row = $this->My_model->get_where_row("tb_building", array("id" => $id));
        $outp = "<div class='container-fluid'>"
                . "<div class='row'>";

        $outp .= "<table style='width:100%;'>"
                . "<tr>"
                . "<td class='data-title' style='width:20%;'>ประเภท</td>"
                . "<td class='data-show'>{$row['bd_type']}</td>"
                . "<tr>"
                . "<td class='data-title'>ลักษณะรายละเอียด</td>"
                . "<td class='data-show'>{$row['bd_detail']}</td>"
                . "</tr>"
                . "<tr>"
                . "<td class='data-title'>จำนวนนักเรียนที่รับได้(คน)</td><td class='data-show'>{$row['bd_cap']}</td>"
                . "</tr>"
                . "</tr>"
                . "<tr>"
                . "<td class='data-title'>จำนวนห้อง</td><td class='data-show'>{$row['bd_room']}</td>"
                . "</tr>"
                . "<tr>"
                . "<td class='data-title'>ราคา/มูลค่า(บาท)</td><td class='data-show'>{$row['bd_value']}</td>"
                . "</tr>"
                . "<tr>"
                . "<td class='data-title'>ปีที่ได้รับ</td><td class='data-show'>{$row['bd_year']}</td>"
                . "</tr>"
                . "<tr>"
                . "<td class='data-title'>สภาพ</td><td class='data-show'>{$row['bd_status']}</td>"
                . "</tr>"
                . "</table>";
        $outp .= "</table>";
        //------ จบโชว์ข้อมูล ------//

        $outp .= "</td></tr>";
        $outp .= "</div></div>";
        echo $outp;
    }

//--- Code Update ---//
    public function arsenal_update() {
        if ($_FILES['inTbArsenalImg']['name'] != "") {
            $config = array(
                "upload_path" => "upload/",
                "allowed_types" => "jpg",
                "max_size" => 0,
                "file_name" => md5(date("YmdHis"))
            );
            $this->upload->initialize($config);
            $this->upload->do_upload("inTbArsenalImg");
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
        if ($_FILES['inTbArsenalDoc']['name'] != "") {
            $row = $this->My_model->get_where_row("tb_arsenal", array("id" => $id0));
            @unlink("upload/" > $row['tb_arsenal_doc']);
            $config = array(
                "upload_path" => "upload/",
                "allowed_types" => 'pdf|xls|xlsx|doc|doc|rar',
                "max_size" => 0,
                "file_name" => md5(date("YmdHis"))
            );
            $this->upload->initialize($config);
            $this->upload->do_upload("inTbArsenalDoc");
            $data = $this->upload->data();
            $filename2 = $data['file_name'];
            $arr = array("tb_arsenal_doc" => $filename2);
            $this->My_model->update_data("tb_arsenal", array("id" => $id), $arr);
        }
        $arr = array(
            "tb_arsenal_link" => $this->input->post('inTbArsenalLink'),
            "tb_arsenal_data" => $this->input->post('inTbArsenalData')
        );
        if ($id != "") {
            $this->My_model->update_data('tb_arsenal', array('id' => $id), $arr);
        }
    }

    //--- End Code update ---//
}
