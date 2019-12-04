<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/*
  | ----------------------------------------------------------------------------
  |  Title
  | ----------------------------------------------------------------------------
  | Copyright	Edutech Co.,Ltd.
  | Purpose
  | Author
  | Create Date 
  | Last edit	22/2/2562
  | Comment	-
  | ----------------------------------------------------------------------------
 */

Class Guidance extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('My_model');
        $this->load->model('Gd_model');
    }

    public function gd_base() {
        $data['rs'] = $this->Gd_model->gd_base();
        $this->load->view("layout/header");
        $this->load->view("guidance/gd_base", $data);
        $this->load->view("layout/footer");
    }

    public function gd_edit() {
        $id = $_POST['id'];
        $rs = $this->Gd_model->gd_base_where($id);
        echo json_encode($rs);
    }

    public function gd_insert() {
        if ($_FILES['inFile']['name'] != "") {

            $config = array(
                "upload_path" => "upload/",
                "allowed_types" => "jpg",
                "max_size" => 0,
                "file_name" => md5(date("YmdHis"))
            );

            $this->upload->initialize($config);
            $this->upload->do_upload("inFile");
            $data = $this->upload->data();

            $filename1 = $data['file_name'];
        } else {
            $filename1 = "";
        }

        $arr = array(
            "tb_student_base_id" => $this->input->post('aid'),
            "tb_guidance_id" => 1,
            "tb_guidance_result_description" => $this->input->post('inText'),
            "tb_guidance_result_file" => $filename1,
            "tb_guidance_result_recorder" => $this->session->userdata('name'),
            "tb_guidance_result_department" => $this->session->userdata('department'),
            "tb_guidance_result_creratedate" => date('Y-m-d H:i:s')
        );
        $this->My_model->insert_data('tb_guidance_result', $arr);
    }

    public function gd_update() {
        $id = $_POST['aid'];
        if ($_FILES['inFile']['name'] != "") {

            $config = array(
                "upload_path" => "upload/",
                "allowed_types" => "jpg",
                "max_size" => 0,
                "file_name" => md5(date("YmdHis"))
            );

            $this->upload->initialize($config);
            $this->upload->do_upload("inFile");
            $data = $this->upload->data();

            $filename1 = $data['file_name'];

            $arr = array(
                "tb_guidance_result_file" => $filename1,
                "tb_guidance_result_description" => $this->input->post('inText')
            );

            $this->My_model->update_data("tb_guidance_result", array("tb_student_base_id" => $id), $arr);
        } else {
            $arr = array(
                "tb_guidance_result_description" => $this->input->post('inText')
            );
            $this->My_model->update_data("tb_guidance_result", array("tb_student_base_id" => $id), $arr);
        }
    }

}
