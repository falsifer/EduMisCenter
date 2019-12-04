<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/*
  | ----------------------------------------------------------------------------
  |  Title
  | ----------------------------------------------------------------------------
  | Copyright	Edutech Co.,Ltd.
  | Purpose
  | Author      chairatto
  | Create Date 8/2/2019
  | Last edit	8/2/2019
  | Comment	-
  | ----------------------------------------------------------------------------
 */

Class Manage_school extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model("My_model");
        $this->load->model("Ms_model");
    }

    // index
    public function index() {
        
    }

    //-----------------------------------------------//
    //---------เรียก View---------//
    public function ms_base() {
        $data['row'] = $this->Ms_model->ms_base();
        $data['school_type'] = $this->My_model->get_all('tb_school_type');
        $this->load->view("layout/header");
        $this->load->view("manage_school/ms_base", $data);
        $this->load->view("layout/footer");
    }

    public function get_school_type() {
        $id = $_POST['id'];
        $edyear = $_POST['edyear'];
        echo $this->Ms_model->get_school_type($id, $edyear);
    }

    public function class_check() {
        $id = $_POST['id'];
        $edyear = $_POST['edyear'];
        $schoolid = $_POST['schId'];

        $arr = array(
            "tb_school_id" => $schoolid,
            "tb_ed_school_class_id" => $id,
            "tb_ed_school_register_class_edyear" => $edyear,
            "tb_ed_school_register_class_recorder" => $this->session->userdata("name"),
            "tb_ed_school_register_class_department" => $this->session->userdata('department'),
            "tb_ed_school_register_class_createdate" => date('Y-m-d')
        );
        $this->My_model->insert_data("tb_ed_school_register_class", $arr);
    }

    public function class_uncheck() {
        $id = $_POST['id'];
        $this->My_model->delete_data('tb_ed_school_register_class', array('id' => $id));
    }

    // save school's data;
    public function do_insert_school() {
        $id = $this->input->post("schoolid");
        $arr = array(
            "school_type_id" => $this->input->post("inScTypeId"),
            "sc_code" => $this->input->post("inScCode"),
            "sc_smis" => $this->input->post("inScSmis"),
            "sc_obec" => $this->input->post("inScObec"),
            "sc_thai_name" => $this->input->post("inScThaiName"),
            "sc_eng_name" => $this->input->post("inScEngName"),
            "sc_symbol" => $this->input->post("inScSymbol"),
            "sc_address_no" => $this->input->post("inScAddressNo"),
            "sc_address_village" => $this->input->post("inScAddressVillage"),
            "sc_address_moo" => $this->input->post("inScAddressMoo"),
            "sc_address_village" => $this->input->post("inScAddressVillage"),
            "sc_address_street" => $this->input->post("inScAddressStreet"),
            "sc_address_tambon" => $this->input->post("inScAddressTambon"),
            "sc_address_amphur" => $this->input->post("inScAddressAmphur"),
            "sc_address_province" => $this->input->post("inScAddressProvince"),
            "sc_address_zipcode" => $this->input->post("inScAddressZipcode"),
            "sc_address_telephone" => $this->input->post("inScAddressTelephone"),
            "sc_address_fax" => $this->input->post("inScAddressFax"),
            "sc_begin_day" => $this->input->post("inScBeginDay"),
            "sc_begin_month" => $this->input->post("inScBeginMonth"),
            "sc_begin_year" => $this->input->post("inScBeginYear"),
            "sc_email" => $this->input->post("inScEmail"),
            "sc_website" => $this->input->post("inScWebsite"),
            "sc_network" => $this->input->post("inScNetwork"),
            "sc_localgov" => $this->session->userdata("localgov"),
            "sc_long_hq" => $this->input->post("inScLongHq"),
            "sc_long_amphur" => $this->input->post("inScLongAmphur"),
            "sc_lat" => $this->input->post("inScLat"),
            "sc_long" => $this->input->post("inScLong"),
            "sc_owner" => $this->session->userdata('department'),
            "sc_recorder" => $this->session->userdata("name")
        );
        if ($id != "") {
            $this->My_model->update_data("tb_school", array("id" => $id), $arr);
        } else {
            $this->My_model->insert_data("tb_school", $arr);
        }

        //------ logo

        if ($_FILES['inScLogo']['name'] != "") {

            $config = array(
                "upload_path" => "upload/",
                "allowed_types" => "jpg|png",
                "max_size" => 0,
                "file_name" => md5(date("YmdHis"))
            );
            $this->upload->initialize($config);
            $this->upload->do_upload("inScLogo");
            $data = $this->upload->data();

            $ImageName = $data['file_name'];

            $this->load->library("image_lib");
            $config['image_library'] = "gd2";
            $config["source_image"] = "upload/" . $ImageName;
            $config['maintain_ratio'] = TRUE;
            $config['width'] = 200;
            $config['height'] = 200;
            $this->image_lib->initialize($config);
            $this->image_lib->resize();

            $row = $this->My_model->get_where_row("tb_school", array("id" => $id));
            @unlink("upload/" . $row['sc_logo']);

            if ($ImageName != "") {
                $arr = array("sc_logo" => $ImageName);
                $this->My_model->update_data("tb_school", array("id" => $id), $arr);
            }
        }
    }

}
