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
       // $this->load->library('mpdf/mpdf');
    }

    // method index;
    public function inex() {
        
    }

    // method education evaluation;
    public function education_evaluation() {
        $data['school'] = $this->My_model->get_all_order("tb_school", "sc_code ASC");
        $data['rs'] = $this->My_model->join2table_result('tb_school a', 'tb_education_evaluation b', 'b.school_id = a.id', 'b.ev_date desc');
        $this->load->view("layout/header");
        $this->load->view('education_evaluation/education_evaluation', $data);
        $this->load->view('layout/footer');
    }

    // แสดงภาพประกอบ
    public function display_evaluation_image() {
        $id = $_POST['id'];
        $row = $this->My_model->get_where_row("tb_education_evaluation", array("id" => $id));
        $output = "<table style='width:100%;' cellspacing=1>"
                . "<tr>";

        $output .= "<td>";
        if (file_exists('upload/' . $row['ev_image1']) && !empty($row['ev_image1'])) {
            $output .= img(array('src' => base_url() . 'upload/' . $row['ev_image1'], 'style' => 'width:290px;height:220px;', 'class' => 'img-thumbnail'));
        }
        $output .= "</td>";
        $output .= "<td>";
        if (file_exists('upload/' . $row['ev_image2']) && !empty($row['ev_image2'])) {
            $output .= img(array('src' => base_url() . 'upload/' . $row['ev_image2'], 'style' => 'width:290px;height:220px;', 'class' => 'img-thumbnail'));
        }
        $output .= "</td>";
        $output .= "<td>";
        if (file_exists('upload/' . $row['ev_image3']) && !empty($row['ev_image3'])) {
            $output .= img(array('src' => base_url() . 'upload/' . $row['ev_image3'], 'style' => 'width:290px;height:220px;', 'class' => 'img-thumbnail'));
        }
        $output .= "</td>";
        $output .= "<td>";
        if (file_exists('upload/' . $row['ev_image4']) && !empty($row['ev_image4'])) {
            $output .= img(array('src' => base_url() . 'upload/' . $row['ev_image4'], 'style' => 'width:290px;height:220px;', 'class' => 'img-thumbnail'));
        }
        $output .= "</td>";
        $output .= "</tr>"
                . "</table>";
        echo $output;
    }

    // insert data
    public function insert_evaluation() {
        $id = $_POST['id'];
        if ($id != "") {
            // เอกสารประกอบ
            if (!empty($_FILES["inEvDocument"]["name"])) {
                $config = array(
                    "upload_path" => "upload/",
                    "allowed_types" => "pdf|doc|docx",
                    "max_size" => 0,
                    "file_name" => md5(date("YmdHis"))
                );
                $this->upload->initialize($config);
                $this->upload->do_upload("inEvDocument");
                $data = $this->upload->data();
                $document = $data['file_name'];
                $arr = array('ev_document' => $document);
                $this->My_model->update_data('tb_education_evaluation', array('id' => $id), $arr);
            }
            // ภาพประกอบ 1
            if (!empty($_FILES["inEvImage1"]["name"])) {
                $config = array(
                    "upload_path" => "upload/",
                    "allowed_types" => "jpg",
                    "max_size" => 0,
                    "file_name" => md5(date("YmdHis"))
                );
                $this->upload->initialize($config);
                $this->upload->do_upload("inEvImage1");
                $data = $this->upload->data();

                $this->load->library("image_lib");
                $config['image_library'] = "gd2";
                $config["source_image"] = "upload/" . $data['file_name'];
                $config['maintain_ratio'] = TRUE;
                $config['width'] = 700;
                $config['height'] = 600;

                $this->image_lib->initialize($config);
                $this->image_lib->resize();
                $img1 = $data['file_name'];
                $arr = array('ev_image1' => $img1);
                $this->My_model->update_data('tb_education_evaluation', array('id' => $id), $arr);
            }
            // ภาพประกอบ 2
            if (!empty($_FILES["inEvImage2"]["name"])) {
                $config = array(
                    "upload_path" => "upload/",
                    "allowed_types" => "jpg",
                    "max_size" => 0,
                    "file_name" => md5(date("YmdHis"))
                );
                $this->upload->initialize($config);
                $this->upload->do_upload("inEvImage2");
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
                $arr = array('ev_image2' => $img2);
                $this->My_model->update_data('tb_education_evaluation', array('id' => $id), $arr);
            }
            // ภาพประกอบ 3
            if (!empty($_FILES["inEvImage3"]["name"])) {
                $config = array(
                    "upload_path" => "upload/",
                    "allowed_types" => "jpg",
                    "max_size" => 0,
                    "file_name" => md5(date("YmdHis"))
                );
                $this->upload->initialize($config);
                $this->upload->do_upload("inEvImage3");
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
                $arr = array('ev_image3' => $img3);
                $this->My_model->update_data('tb_education_evaluation', array('id' => $id), $arr);
            }
            // ภาพประกอบ 4
            if (!empty($_FILES["inEvImage4"]["name"])) {
                $config = array(
                    "upload_path" => "upload/",
                    "allowed_types" => "jpg",
                    "max_size" => 0,
                    "file_name" => md5(date("YmdHis"))
                );
                $this->upload->initialize($config);
                $this->upload->do_upload("inEvImage4");
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
                $arr = array('ev_image4' => $img4);
                $this->My_model->update_data('tb_education_evaluation', array('id' => $id), $arr);
            }
            //
            $arr = array(
                "ev_date" => $this->input->post("inEvDate"),
                "ev_topic" => $this->input->post("inEvTopic"),
                "ev_type" => $this->input->post("inEvType"),
                "ev_detail" => $this->input->post("inEvDetail"),
                "school_id" => $this->input->post("inSchoolId"),
                "ev_owner" => $this->session->userdata("name"),
                "ev_department" => $this->session->userdata("department")
            );
            $this->My_model->update_data('tb_education_evaluation', array('id' => $id), $arr);
        } else {
            // เอกสารประกอบ
            if (!empty($_FILES["inEvDocument"]["name"])) {
                $config = array(
                    "upload_path" => "upload/",
                    "allowed_types" => "pdf|doc|docx",
                    "max_size" => 0,
                    "file_name" => md5(date("YmdHis"))
                );
                $this->upload->initialize($config);
                $this->upload->do_upload("inEvDocument");
                $data = $this->upload->data();
                $document = $data['file_name'];
            } else {
                $document = "";
            }
            // ภาพประกอบ 1
            if (!empty($_FILES["inEvImage1"]["name"])) {
                $config = array(
                    "upload_path" => "upload/",
                    "allowed_types" => "jpg",
                    "max_size" => 0,
                    "file_name" => md5(date("YmdHis"))
                );
                $this->upload->initialize($config);
                $this->upload->do_upload("inEvImage1");
                $data = $this->upload->data();

                $this->load->library("image_lib");
                $config['image_library'] = "gd2";
                $config["source_image"] = "upload/" . $data['file_name'];
                $config['maintain_ratio'] = TRUE;
                $config['width'] = 700;
                $config['height'] = 600;

                $this->image_lib->initialize($config);
                $this->image_lib->resize();
                $img1 = $data['file_name'];
            } else {
                $img1 = "";
            }
            // ภาพประกอบ 2
            if (!empty($_FILES["inEvImage2"]["name"])) {
                $config = array(
                    "upload_path" => "upload/",
                    "allowed_types" => "jpg",
                    "max_size" => 0,
                    "file_name" => md5(date("YmdHis"))
                );
                $this->upload->initialize($config);
                $this->upload->do_upload("inEvImage2");
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
            // ภาพประกอบ 3
            if (!empty($_FILES["inEvImage3"]["name"])) {
                $config = array(
                    "upload_path" => "upload/",
                    "allowed_types" => "jpg",
                    "max_size" => 0,
                    "file_name" => md5(date("YmdHis"))
                );
                $this->upload->initialize($config);
                $this->upload->do_upload("inEvImage3");
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
            // ภาพประกอบ 4
            if (!empty($_FILES["inEvImage4"]["name"])) {
                $config = array(
                    "upload_path" => "upload/",
                    "allowed_types" => "jpg",
                    "max_size" => 0,
                    "file_name" => md5(date("YmdHis"))
                );
                $this->upload->initialize($config);
                $this->upload->do_upload("inEvImage4");
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
                "ev_date" => $this->input->post("inEvDate"),
                "ev_topic" => $this->input->post("inEvTopic"),
                "ev_type" => $this->input->post("inEvType"),
                "ev_detail" => $this->input->post("inEvDetail"),
                "school_id" => $this->input->post("inSchoolId"),
                "ev_document" => $document,
                "ev_image1" => $img1,
                "ev_image2" => $img2,
                "ev_image3" => $img3,
                "ev_image4" => $img4,
                "ev_owner" => $this->session->userdata("name"),
                "ev_department" => $this->session->userdata("department")
            );
            $this->My_model->insert_data("tb_education_evaluation", $arr);
        }
    }

    // update data;
    public function edit_evaluation() {
        $id = $_POST['id'];
        $row = $this->My_model->join2table_row('tb_school a', 'tb_education_evaluation b', 'b.school_id = a.id', array('b.id' => $id));
        echo json_encode($row);
    }

    // delete data;
    public function delete_evaluation() {
        $id = $_POST['id'];
        $row = $this->My_model->get_where_row('tb_education_evaluation', array('id' => $id));
        @unlink('upload/' . $row['ev_document']);
        @unlink('upload/' . $row['ev_image1']);
        @unlink('upload/' . $row['ev_image2']);
        @unlink('upload/' . $row['ev_image3']);
        @unlink('upload/' . $row['ev_image4']);
        $this->My_model->delete_data('tb_education_evaluation', array('id' => $id));
    }

    // print data;
    public function print_evaluation($id) {
        $data['org'] = $this->My_model->get_row("tb_organization");
        $data['rs'] = $this->My_model->join2table_row('tb_school a', 'tb_education_evaluation b', 'b.school_id = a.id', array('b.id' => $id));
        $this->load->view('education_evaluation/reports/evaluation_report', $data);
    }

}
