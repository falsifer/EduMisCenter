<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/*
  | ----------------------------------------------------------------------------
  |  Title
  | ----------------------------------------------------------------------------
  | Copyright	Edutech Co.,Ltd.
  | Purpose     -
  | Author	chairatto
  | Create Date 5/4/2562
  | Last edit	5/4/2562
  | Comment	-
  | ----------------------------------------------------------------------------
 */

class Hr_member_profile extends CI_Controller {

    public function __construct() {
        parent::__construct();
        if ($this->session->userdata('status') == "") {
            redirect("/");
        }
        $this->load->model("My_model");
        $this->load->model("Chairatto_model");
        $this->load->model("SchoolSetting_model");
    }

// ระบบ
    public function hr_member_profile_base() {
        //---- test
        
//        
        $data['rs'] = $this->My_model->get_where_row("tb_human_resources_01", array('id' => $this->session->userdata('hr_id')));
        $data['tbHrDegree'] = $this->My_model->get_all_order("tb_hr_degree", 'tb_hr_degree_sequence asc');
$data['rHrType'] = $this->My_model->get_all_order("tb_human_resources_type", 'id asc');


        $data['tbDivision'] = $this->My_model->get_where_order("tb_division", array('tb_school_id' => $this->session->userdata('sch_id')), 'id asc');
//        $data['tbDivision'] = $this->Chairatto_model->select_distinct_where("tb_hr_degree",'data_group','tb_hr_degree_sequence asc');  
        $data['tbGroupLearning'] = $this->My_model->get_all_order("tb_group_learning", 'tb_group_learning_seq asc');
//        $data['rPos'] = $this->SchoolSetting_model->get_hr_position();
        $data['rPos'] = $this->My_model->get_where_order("tb_hr_position", array('tb_hr_position_department' => $this->session->userdata('department')), "tb_hr_position_tier asc");
        $this->load->view("layout/header");
        $this->load->view("hr_member_profile/hr_member_profile_base", $data);
        $this->load->view("layout/footer");
    }

    public function hr_member_profile_onload() {
        echo json_encode($this->Chairatto_model->get_hr_member_base());
    }

    public function hr_member_profile_insert() {
        $id = $this->session->userdata('hr_id');



        //
        $arr = array(
            "tb_member_id" => $this->session->userdata('member_id'),
            "hr_type_id" => $this->input->post('inHrType'),
            "hr_thai_symbol" => $this->input->post('inHrThaiSymbol'),
            "hr_thai_name" => $this->input->post('inHrThaiName'),
            "hr_thai_lastname" => $this->input->post('inHrThaiLastname'),
            "hr_eng_symbol" => $this->input->post('inHrEngSymbol'),
            "hr_eng_name" => $this->input->post('inHrEngName'),
            "hr_eng_lastname" => $this->input->post('inHrEngLastname'),
//            "km_add_road" => $this->input->post('inHrRank'),
//            "km_add_tambol" => $this->input->post('inHrPositionId'),
            "hr_id_card" => $this->input->post('inHrIdCard'),
            "hr_day_birthday" => $this->input->post('inHrDayBirthday'),
            "hr_month_birthday" => $this->input->post('inHrMonthBirthday'),
            "hr_year_birthday" => $this->input->post('inHrYearBirthday'),
            "hr_religion" => $this->input->post('inHrReligion'),
            "hr_nationality" => $this->input->post('inHrNationality'),
            "hr_origin" => $this->input->post('inHrOrigin'),
            "hr_blood_group" => $this->input->post('inHrBloodGroup'),
            "hr_status" => $this->input->post('inHrStatus'),
            "hr_degree" => $this->input->post('inHrDegree'),
            "hr_division" => $this->input->post('inHrDivision'),
            "hr_division_class" => $this->input->post('inHrDivisionClass'),
            "hr_group_learning" => $this->input->post('inHrGroupLearning'),
            "hr_group_learning_class" => $this->input->post('inHrGroupLearningClass'),
//            "hr_father_name" => $this->input->post('inHrFatherName'),
//            "hr_mother_name" => $this->input->post('inHrMotherName'),
            "hr_mobile" => $this->input->post('inHrMobile'),
//            "hr_image" => $ImageName,
            "hr_email" => $this->input->post('inHrEmail')
        );

        if ($id != "") {
            $this->My_model->update_data('tb_human_resources_01', array('id' => $id), $arr);
        } else {
            $hrid = $this->My_model->insert_data('tb_human_resources_01', $arr);
            $this->session->set_userdata('hr_id', $hrid);
        }


        if ($_FILES['inHrImage']['name'] != "") {

            $config = array(
                "upload_path" => hr_path($this->session->userdata('hr_id'), $this->session->userdata('sch_id')),
                "allowed_types" => "jpg|png",
                "max_size" => 0,
                "file_name" => md5(date("YmdHis"))
            );
            $this->upload->initialize($config);
            $this->upload->do_upload("inHrImage");
            $data = $this->upload->data();

            $this->load->library("image_lib");
            $config['image_library'] = "gd2";
            $config["source_image"] = hr_path($this->session->userdata('hr_id'), $this->session->userdata('sch_id')) . $data['file_name'];
            $config['maintain_ratio'] = TRUE;
            $config['width'] = 400;
            $config['height'] = 500;
            $this->image_lib->initialize($config);
            $this->image_lib->resize();
            //
            $ImageName = $data['file_name'];

            if ($id != "") {
//                $row = $this->My_model->get_where_row("tb_human_resources_01", array("id" => $id));
//                @unlink("upload/" . $row['inHrImage']);
                $arr = array("hr_image" => $data['file_name']);
                $this->My_model->update_data("tb_human_resources_01", array("id" => $id), $arr);
            }
        }

        //--  End Hr01 here
        //--- Start Member

        if ($_FILES['inSignature']['name'] != "") {

            $config = array(
                "upload_path" => hr_path($this->session->userdata('hr_id'), $this->session->userdata('sch_id')),
                "allowed_types" => "jpg|png",
                "max_size" => 0,
                "file_name" => md5(date("YmdHis"))
            );
            $this->upload->initialize($config);
            $this->upload->do_upload("inSignature");
            $data = $this->upload->data();

            $this->load->library("image_lib");
            $config['image_library'] = "gd2";
            $config["source_image"] = hr_path($this->session->userdata('hr_id'), $this->session->userdata('sch_id')) . $data['file_name'];
            $config['maintain_ratio'] = TRUE;
            $config['width'] = 200;
            $config['height'] = 100;
            $this->image_lib->initialize($config);
            $this->image_lib->resize();
            //
//            $ImageName = $data['file_name'];


            $arr = array("signature" => $data['file_name']);
            $this->My_model->update_data("tb_member", array("id" => $this->session->userdata('member_id')), $arr);
        }

        $MemberArray = array(
            "password" => $this->input->post('inPassword')
        );
        $this->My_model->update_data('tb_member', array('id' => $this->session->userdata('member_id')), $MemberArray);





//        $PosId = $this->input->post('inHrPositionRecordId');


        $check = $this->My_model->get_where_row('tb_hr_position_register', array('tb_hr_id' => $id));
        if (count($check) > 0) {
            $arr = array(
                "tb_hr_position_id" => $this->input->post('inHrPosition')
            );
            $this->My_model->update_data('tb_hr_position_register', array('tb_hr_id' => $id), $arr);
        } else {
            $arr = array(
                "tb_hr_id" => $id,
                "tb_hr_position_id" => $this->input->post('inHrPosition'),
                "tb_hr_position_register_recorder" => $this->session->userdata('name'),
                "tb_hr_position_register_createdate" => date('Y-m-d')
            );
            $this->My_model->insert_data('tb_hr_position_register', $arr);
        }
    }

}
