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

class Public_relations extends CI_Controller {

    public function __construct() {
        parent::__construct();
    }

    /*
     * To change this license header, choose License Headers in Project Properties.
     * To change this template file, choose Tools | Templates
     * and open the template in the editor.
     */

    // ประชาสัมพันธ์
    public function pr_base() {
        if ($this->session->userdata("status") == "") {
            redirect('login');
        }
        $data['rs'] = $this->My_model->get_all_order('tb_public_relations', 'pr_date desc');
        $this->load->view("layout/header");
        $this->load->view("public_relations/pr_base", $data);
        $this->load->view("layout/footer");
    }

    //insert data;
    public function pr_insert() {
        $id = $_POST['id'];
        if ($id != '') {
            // image 1
            if (!empty($_FILES["inPrImage1"]["name"])) {
                $row = $this->My_model->get_where_row('tb_public_relations', array('id' => $id));
                @unlink('upload/' . $row['pr_image_1']);
                $config = array(
                    "upload_path" => "upload/",
                    "allowed_types" => "jpg|png",
                    "max_size" => 0,
                    "file_name" => md5(date("YmdHis"))
                );
                $this->upload->initialize($config);
                $this->upload->do_upload("inPrImage1");
                $data = $this->upload->data();

                $this->load->library("image_lib");
                $config['image_library'] = "gd2";
                $config["source_image"] = "upload/" . $data['file_name'];
                $config['maintain_ratio'] = TRUE;
                $config['width'] = 600;
                $config['height'] = 500;

                $this->image_lib->initialize($config);
                $this->image_lib->resize();
                $img1 = $data['file_name'];
                $arr = array('pr_image_1' => $img1);
                $this->My_model->update_data('tb_public_relations', array('id' => $id), $arr);
            }
            // image 2
            if (!empty($_FILES["inPrImage2"]["name"])) {
                $row = $this->My_model->get_where_row('tb_public_relations', array('id' => $id));
                @unlink('upload/' . $row['pr_image_2']);
                $config = array(
                    "upload_path" => "upload/",
                    "allowed_types" => "jpg|png",
                    "max_size" => 0,
                    "file_name" => md5(date("YmdHis"))
                );
                $this->upload->initialize($config);
                $this->upload->do_upload("inPrImage2");
                $data = $this->upload->data();

                $this->load->library("image_lib");
                $config['image_library'] = "gd2";
                $config["source_image"] = "upload/" . $data['file_name'];
                $config['maintain_ratio'] = TRUE;
                $config['width'] = 600;
                $config['height'] = 500;

                $this->image_lib->initialize($config);
                $this->image_lib->resize();
                $img2 = $data['file_name'];
                $arr = array('pr_image_2' => $img2);
                $this->My_model->update_data('tb_public_relations', array('id' => $id), $arr);
            }
            // image 3
            if (!empty($_FILES["inPrImage3"]["name"])) {
                $row = $this->My_model->get_where_row('tb_public_relations', array('id' => $id));
                @unlink('upload/' . $row['pr_image_3']);
                $config = array(
                    "upload_path" => "upload/",
                    "allowed_types" => "jpg|png",
                    "max_size" => 0,
                    "file_name" => md5(date("YmdHis"))
                );
                $this->upload->initialize($config);
                $this->upload->do_upload("inPrImage3");
                $data = $this->upload->data();

                $this->load->library("image_lib");
                $config['image_library'] = "gd2";
                $config["source_image"] = "upload/" . $data['file_name'];
                $config['maintain_ratio'] = TRUE;
                $config['width'] = 600;
                $config['height'] = 500;

                $this->image_lib->initialize($config);
                $this->image_lib->resize();
                $img3 = $data['file_name'];
                $arr = array('pr_image_3' => $img3);
                $this->My_model->update_data('tb_public_relations', array('id' => $id), $arr);
            }
            // image 4
            if (!empty($_FILES["inPrImage4"]["name"])) {
                $row = $this->My_model->get_where_row('tb_public_relations', array('id' => $id));
                @unlink('upload/' . $row['pr_image_4']);
                $config = array(
                    "upload_path" => "upload/",
                    "allowed_types" => "jpg|png",
                    "max_size" => 0,
                    "file_name" => md5(date("YmdHis"))
                );
                $this->upload->initialize($config);
                $this->upload->do_upload("inPrImage4");
                $data = $this->upload->data();

                $this->load->library("image_lib");
                $config['image_library'] = "gd2";
                $config["source_image"] = "upload/" . $data['file_name'];
                $config['maintain_ratio'] = TRUE;
                $config['width'] = 600;
                $config['height'] = 500;

                $this->image_lib->initialize($config);
                $this->image_lib->resize();
                $img4 = $data['file_name'];
                $arr = array('pr_image_4' => $img4);
                $this->My_model->update_data('tb_public_relations', array('id' => $id), $arr);
            }
            //
            $arr = array(
                'pr_date' => $this->input->post('inPrDate'),
                'pr_topic' => $this->input->post('inPrTopic'),
                'pr_detail' => $this->input->post('inPrDetail'),
                'pr_owner' => $this->session->userdata('name'),
                'pr_department' => $this->session->userdata('department')
            );
                $this->My_model->update_data('tb_public_relations', array('id' => $id), $arr);
        } else {
            // image 1
            if (!empty($_FILES["inPrImage1"]["name"])) {
                $config = array(
                    "upload_path" => "upload/",
                    "allowed_types" => "jpg|png",
                    "max_size" => 0,
                    "file_name" => md5(date("YmdHis"))
                );
                $this->upload->initialize($config);
                $this->upload->do_upload("inPrImage1");
                $data = $this->upload->data();

                $this->load->library("image_lib");
                $config['image_library'] = "gd2";
                $config["source_image"] = "upload/" . $data['file_name'];
                $config['maintain_ratio'] = TRUE;
                $config['width'] = 600;
                $config['height'] = 500;

                $this->image_lib->initialize($config);
                $this->image_lib->resize();
                $img1 = $data['file_name'];
            } else {
                $img1 = "";
            }
            // image 2
            if (!empty($_FILES["inPrImage2"]["name"])) {
                $config = array(
                    "upload_path" => "upload/",
                    "allowed_types" => "jpg|png",
                    "max_size" => 0,
                    "file_name" => md5(date("YmdHis"))
                );
                $this->upload->initialize($config);
                $this->upload->do_upload("inPrImage2");
                $data = $this->upload->data();

                $this->load->library("image_lib");
                $config['image_library'] = "gd2";
                $config["source_image"] = "upload/" . $data['file_name'];
                $config['maintain_ratio'] = TRUE;
                $config['width'] = 600;
                $config['height'] = 500;

                $this->image_lib->initialize($config);
                $this->image_lib->resize();
                $img2 = $data['file_name'];
            } else {
                $img2 = "";
            }
            // image 3
            if (!empty($_FILES["inPrImage3"]["name"])) {
                $config = array(
                    "upload_path" => "upload/",
                    "allowed_types" => "jpg|png",
                    "max_size" => 0,
                    "file_name" => md5(date("YmdHis"))
                );
                $this->upload->initialize($config);
                $this->upload->do_upload("inPrImage3");
                $data = $this->upload->data();

                $this->load->library("image_lib");
                $config['image_library'] = "gd2";
                $config["source_image"] = "upload/" . $data['file_name'];
                $config['maintain_ratio'] = TRUE;
                $config['width'] = 600;
                $config['height'] = 500;

                $this->image_lib->initialize($config);
                $this->image_lib->resize();
                $img3 = $data['file_name'];
            } else {
                $img3 = "";
            }
            // image 4
            if (!empty($_FILES["inPrImage4"]["name"])) {
                $config = array(
                    "upload_path" => "upload/",
                    "allowed_types" => "jpg|png",
                    "max_size" => 0,
                    "file_name" => md5(date("YmdHis"))
                );
                $this->upload->initialize($config);
                $this->upload->do_upload("inPrImage4");
                $data = $this->upload->data();

                $this->load->library("image_lib");
                $config['image_library'] = "gd2";
                $config["source_image"] = "upload/" . $data['file_name'];
                $config['maintain_ratio'] = TRUE;
                $config['width'] = 600;
                $config['height'] = 500;

                $this->image_lib->initialize($config);
                $this->image_lib->resize();
                $img4 = $data['file_name'];
            } else {
                $img4 = "";
            }
            //
            $arr = array(
                'pr_date' => $this->input->post('inPrDate'),
                'pr_topic' => $this->input->post('inPrTopic'),
                'pr_detail' => $this->input->post('inPrDetail'),
                'pr_image_1' => $img1,
                'pr_image_2' => $img2,
                'pr_image_3' => $img3,
                'pr_image_4' => $img4,
                'pr_owner' => $this->session->userdata('name'),
                'pr_department' => $this->session->userdata('department')
            );
            $this->My_model->insert_data('tb_public_relations', $arr);
        }
    }

    // delete data;
    public function pr_delete() {
        $id = $_POST['id'];
        $this->My_model->delete_data('tb_public_relations', array('id' => $id));
    }

    //--- end Code Insert ---//
    //--- Code Code Detail ---//
    public function pr_detail() {
        $id = $_POST['id'];
        $row = $this->My_model->get_where_row("tb_public_relations", array("id" => $id));
        //
        $outp = ""
                . "<table style='width:100%;'>"
                . "<tr>"
                . "<td class='data-title' style='width:28%;'>วันที่เผยแพร่</td><td class='data-show'>" . datethai($row['pr_date']) . "</td>"
                . "</tr>"
                . "<tr>"
                . "<td class='data-title'>หัวข้อประชาสัมพันธ์</td><td class='data-show'>{$row['pr_topic']}</td>"
                . "</tr>"
                . "<tr>"
                . "<td class='data-title'>หัวข้อประชาสัมพันธ์</td><td class='data-show'>{$row['pr_detail']}</td>"
                . "</tr>"
                . "<tr><td class='data-title'>ภาพประกอบ</td><td class='data-show'>";
        //
        if (file_exists('upload/' . $row['pr_image_1']) && !empty($row['pr_image_1'])) {
            $outp .= img(array('src' => base_url() . 'upload/' . $row['pr_image_1'], 'style' => 'width:262px;height:209px;', 'class' => 'img-thumbnail')) . nbs(3);
        }
        if (file_exists('upload/' . $row['pr_image_2']) && !empty($row['pr_image_2'])) {
            $outp .= img(array('src' => base_url() . 'upload/' . $row['pr_image_2'], 'style' => 'width:262px;height:209px;', 'class' => 'img-thumbnail')) . nbs(3);
        }
        if (file_exists('upload/' . $row['pr_image_3']) && !empty($row['pr_image_3'])) {
            $outp .= img(array('src' => base_url() . 'upload/' . $row['pr_image_3'], 'style' => 'width:262px;height:209px;', 'class' => 'img-thumbnail')) . nbs(3);
        }
        if (file_exists('upload/' . $row['pr_image_4']) && !empty($row['pr_image_4'])) {
            $outp .= img(array('src' => base_url() . 'upload/' . $row['pr_image_4'], 'style' => 'width:262px;height:209px;', 'class' => 'img-thumbnail')) . nbs(3);
        }
        $outp .= "</td></tr></table>";
        echo $outp;
    }

    // edit data
    public function pr_edit() {
        $id = $_POST['id'];
        $rs = $this->My_model->get_where_row("tb_public_relations", array("id" => $id));
        echo json_encode($rs);
    }

    //
    public function pr_update() {

        $id = $_POST['id'];
        $arr = array(
            "pr_topic" => $this->input->post('inPrTopic'),
            "pr_detail" => $this->input->post('inPrDetail'),
            "pr_day" => $this->input->post('inPrDay'),
            "pr_month" => $this->input->post('inPrMonth'),
            "pr_year" => $this->input->post('inPrYear')
        );
        if ($id != "") {
            $this->My_model->update_data('tb_public_relations', array('id' => $id), $arr);
        }
    }

    //--- End Code update ---//
    // พิมพ์ข้อมูลการประชาสัมพันธ์
    public function pr_print() {
        $id = $this->uri->segment(2);
        $data['rs'] = $this->My_model->get_where_row('tb_public_relations', array('id' => $id));
        $this->load->view('public_relations/reports/public_relations_report', $data);
    }

}
