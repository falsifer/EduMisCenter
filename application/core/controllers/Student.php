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
  | Create Date 22/11/2561
  | Last edit	22/11/2561
  | Comment	-
  | ----------------------------------------------------------------------------
 */

Class Student extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model("My_model");
        $this->load->model("Std_model");
    }

    // index
    public function index() {
        
    }

//----------------ข้อมูลนักเรียน-------------------------------//
    //---------เรียก View---------//
    public function std_base() {

        $check = $this->session->userdata('department');

        if ($check == "กองการศึกษา") {
            $data['rs'] = $this->Std_model->get_std_base();
            //$data['rs'] = $this->My_model->get_all_order('tb_student_base', 'std_firstname ASC');
        } else {
            $data['rs'] = $this->Std_model->get_std_base_where($check);
            //$data['rs'] = $this->My_model->get_where_order('tb_student_base', array("std_department" => $check), 'std_firstname ASC');
        }
        $this->load->view("layout/header");
        $this->load->view("student/std_base", $data);
        $this->load->view("layout/footer");
    }

    public function std_insert_view() {
        $this->load->view("layout/header");
        $this->load->view("student/std_insert_view");
        $this->load->view("layout/footer");
    }

//-------- End view -------//    
//----- Code Control ------//
//----- Code Delete ------//
    public function std_delete() {
        $id = $_POST['id'];
        $arr = array(
            "tb_student_base_status" => "C"
        );

        if ($id != "") {
            $this->My_model->update_data('tb_student_base', array('id' => $id), $arr);
        }
        
//        $id = $_POST['id'];
//        $this->My_model->delete_data('tb_std_other', array('tb_student_base_id' => $id));
//        $this->My_model->delete_data('tb_std_before_register', array('tb_student_base_id' => $id));
//        $this->My_model->delete_data('tb_std_doc', array('tb_student_base_id' => $id));
//        $this->My_model->delete_data('tb_std_health', array('own_id' => $id));
//        $this->My_model->delete_data('tb_registration_address', array('own_id' => $id));
//        $this->My_model->delete_data('tb_current_address', array('own_id' => $id));
//        $this->My_model->delete_data('tb_family', array('own_id' => $id));
//        $this->My_model->delete_data('tb_student_base', array('id' => $id));
    }

//----- End Code Delete ------//
//----- Code Edit ------//
    public function std_edit() {
        $id = $_POST['id'];
        //$rs = $this->My_model->join2table_row("tb_student_base a","tb_std_health b","a.id = b.own_id", array("own_id" => $id));
        $rs = $this->Std_model->get_std_edit($id);
        echo json_encode($rs);
    }

//----- End Code Edit ------//
//--- Code Insert ---//
    public function std_insert() {
        if ($_FILES['inStdImage']['name'] != "") {
            $config = array(
                "upload_path" => "upload/",
                "allowed_types" => "jpg",
                "max_size" => 0,
                "file_name" => md5(date("YmdHis"))
            );
            $this->upload->initialize($config);
            $this->upload->do_upload("inStdImage");
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
        //ข้อมูลพื้นฐาน
        $arr = array(
            "std_titlename" => $this->input->post('inStdTitlename'),
            "std_firstname" => $this->input->post('inStdFirstname'),
            "std_lastname" => $this->input->post('inStdLastname'),
            "std_nickname" => $this->input->post('inStdNickname'),
            "std_idcard" => $this->input->post('inStdIdcard'),
            "std_Religion" => $this->input->post('inStdReligion'),
            "std_Ethnicity" => $this->input->post('inStdEthnicity'),
            "std_Nationality" => $this->input->post('inStdNationality'),
            "tb_student_base_recorder" => $this->session->userdata('name'),
            "tb_student_base_department" => $this->session->userdata('department')
        );
        $this->My_model->insert_data('tb_student_base', $arr);
        $id = $this->db->insert_id();

        //ข้อมูลด้านสุขภาพ
        $arr = array(
            "std_birth_day" => $this->input->post('inStdBirthday'),
            "std_birth_month" => $this->input->post('inStdBirthmonth'),
            "std_birth_year" => $this->input->post('inStdBirthyear'),
            "std_birth_hospital" => $this->input->post('inStdBirthhospital'),
            "std_bloodtype" => $this->input->post('inStdBloodtype'),
            "Std_allergic" => $this->input->post('inStdAllergic'),
            "std_congenital_disease" => $this->input->post('inStdCongenitalDisease'),
            "std_disabled" => $this->input->post('inStdDisabled'),
            "own_id" => $id
        );
        $this->My_model->insert_data('tb_std_health', $arr);

        //ข้อมูลด้านที่อยู่อาศัย
        $arr = array(
            "add_no" => $this->input->post('inAddNo'),
            "add_moo" => $this->input->post('inAddMoo'),
            "add_village" => $this->input->post('inAddVillage'),
            "add_road" => $this->input->post('inAddRoad'),
            "add_tambol" => $this->input->post('inAddTambol'),
            "add_amphur" => $this->input->post('inAddAmphur'),
            "add_province" => $this->input->post('inAddProvince'),
            "add_zipcode" => $this->input->post('inAddZipcode'),
            "add_type" => $this->input->post('inAddType'),
            "own_id" => $id
        );
        $this->My_model->insert_data('tb_registration_address', $arr);

        //ภาพประจำตัวนักเรียน
        $arr = array(
            "pic_name" => $filename1,
            "pic_year" => 2561,
            "own_id" => $id
        );
        $this->My_model->insert_data('tb_std_picture', $arr);

        //ข้อมูลด้านผู้ปกครอง
        $arr = array(
            "fm_titlename" => $this->input->post('inFmTitlename'),
            "fm_firstname" => $this->input->post('inFmFirstname'),
            "fm_lastname" => $this->input->post('inFmLastname'),
            "fm_idcard" => $this->input->post('inFmIdcard'),
            "fm_religion" => $this->input->post('inFmReligion'),
            "fm_nationality" => $this->input->post('inFmNationality'),
            "fm_ethnicity" => $this->input->post('inFmEthnicity'),
            "fm_relationship" => $this->input->post('inFmRelationship'),
            "fm_status" => $this->input->post('inFmStatus'),
            "fm_about" => $this->input->post('inFmAbout'),
            "fm_parent" => 1,
            "own_id" => $id
        );
        $this->My_model->insert_data('tb_family', $arr);
        $id = $this->db->insert_id();

        //ข้อมูลอาชีพของผู้ปกครอง
        $arr = array(
            "cr_career_name" => $this->input->post('inFmCareerName'),
            "cr_company_name" => $this->input->post('inFmCompanyName'),
            "cr_income" => $this->input->post('inFmIncome'),
            "own_id" => $id
        );
        $this->My_model->insert_data('tb_fm_career', $arr);
    }

//--- end Code Insert ---//
///////////////////////////////////////////////////////////////
//--- Code Update ---//
    public function std_update() {
        $id = $_POST['bid'];
        $did = $_POST['did'];
        if ($_FILES['inStdImage']['name'] != "") {
            $row = $this->My_model->get_where_row("tb_student_base", array("id" => $id));
            @unlink("upload/" . $row['std_picture_name']);
            $config = array(
                "upload_path" => "upload/",
                "allowed_types" => "jpg",
                "max_size" => 0,
                "file_name" => md5(date("YmdHis"))
            );
            $this->upload->initialize($config);
            $this->upload->do_upload("inStdImage");
            $data = $this->upload->data();

            $this->load->library("image_lib");
            $config['image_library'] = "gd2";
            $config["source_image"] = "upload/" . $data['file_name'];
            $config['maintain_ratio'] = TRUE;
            $config['width'] = 1024;
            $config['height'] = 768;
            $this->image_lib->initialize($config);
            $this->image_lib->resize();

            $arr = array("pic_name" => $data['file_name'], "pic_year" => 2561);
            $this->My_model->update_data("tb_std_picture", array("own_id" => $id), $arr);
        }
        //////////////ภาพปิด///////////
        $arr = array(
            "std_titlename" => $this->input->post('inStdTitlename'),
            "std_firstname" => $this->input->post('inStdFirstname'),
            "std_lastname" => $this->input->post('inStdLastname'),
            "std_nickname" => $this->input->post('inStdNickname'),
            "std_idcard" => $this->input->post('inStdIdcard'),
            "std_Religion" => $this->input->post('inStdReligion'),
            "std_Ethnicity" => $this->input->post('inStdEthnicity'),
            "std_Nationality" => $this->input->post('inStdNationality'),
            "std_recorder" => $this->session->userdata('name'),
            "std_department" => $this->session->userdata('department')
        );
        if ($id != "") {
            $this->My_model->update_data('tb_student_base', array('id' => $id), $arr);
        }

        $arr = array(
            "std_birth_day" => $this->input->post('inStdBirthday'),
            "std_birth_month" => $this->input->post('inStdBirthmonth'),
            "std_birth_year" => $this->input->post('inStdBirthyear'),
            "std_birth_hospital" => $this->input->post('inStdBirthhospital'),
            "std_bloodtype" => $this->input->post('inStdBloodtype'),
            "Std_allergic" => $this->input->post('inStdAllergic'),
            "std_congenital_disease" => $this->input->post('inStdCongenitalDisease'),
            "std_disabled" => $this->input->post('inStdDisabled')
        );
        if ($id != "") {
            $this->My_model->update_data('tb_std_health', array('own_id' => $id), $arr);
        }

        $arr = array(
            "add_no" => $this->input->post('inAddNo'),
            "add_moo" => $this->input->post('inAddMoo'),
            "add_village" => $this->input->post('inAddVillage'),
            "add_road" => $this->input->post('inAddRoad'),
            "add_tambol" => $this->input->post('inAddTambol'),
            "add_amphur" => $this->input->post('inAddAmphur'),
            "add_province" => $this->input->post('inAddProvince'),
            "add_zipcode" => $this->input->post('inAddZipcode'),
            "add_type" => $this->input->post('inAddType')
        );
        if ($id != "") {
            $this->My_model->update_data('tb_registration_address', array('own_id' => $id), $arr);
        }


        //ข้อมูลด้านผู้ปกครอง
        $arr = array(
            "fm_titlename" => $this->input->post('inFmTitlename'),
            "fm_firstname" => $this->input->post('inFmFirstname'),
            "fm_lastname" => $this->input->post('inFmLastname'),
            "fm_idcard" => $this->input->post('inFmIdcard'),
            "fm_religion" => $this->input->post('inFmReligion'),
            "fm_nationality" => $this->input->post('inFmNationality'),
            "fm_ethnicity" => $this->input->post('inFmEthnicity'),
            "fm_relationship" => $this->input->post('inFmRelationship'),
            "fm_status" => $this->input->post('inFmStatus'),
            "fm_about" => $this->input->post('inFmAbout')
        );
        if ($id != "") {
            $this->My_model->update_data('tb_family', array('own_id' => $id), $arr);
        }

        //ข้อมูลอาชีพของผู้ปกครอง
        $arr = array(
            "cr_career_name" => $this->input->post('inFmCareerName'),
            "cr_company_name" => $this->input->post('inFmCompanyName'),
            "cr_income" => $this->input->post('inFmIncome')
        );
        if ($id != "") {
            $this->My_model->update_data('tb_fm_career', array('own_id' => $did), $arr);
        }
        ////////////
    }

//--- End Code update ---//
//--- Code Code Detail ---//
    public function std_detail() {
        $id = $_POST['id'];
        $row = $this->Std_model->get_std_edit($id);
        $outp = "<div class='container-fluid'>"
                . "<div class='row'>";
        //---- แสดงภาพประกอบ ----//
        $outp .= "<table style='width:100%;'>";
        $outp .= "<tr><td style='padding-top:20px;'>";
        if (file_exists("upload/" . $row['pic_name']) && !empty($row['pic_name'])) {
            $outp .= img(array('src' => "upload/" . $row['pic_name'], "style" => "width:238px;height:221px;border:5px solid #C0C0C0;")) . nbs(5);
        }
        //---- จบภาพประกอบ ----//
        //------ โชว์ข้อมูล ------//
        $outp .= "<table style='width:100%;'>"
                . "<tr>"
                . "<td class='data-title'>ชื่อ-นามสกุล</td>"
                . "<td class='data-show'>{$row['std_titlename']}{$row['std_firstname']}  {$row['std_lastname']}</td>"
                . "</tr>"
                . "<tr>"
                . "<td class='data-title'>รหัสนักเรียน</td>"
                . "<td class='data-show'></td>"
                . "</tr>"
                . "<tr>"
                . "<td class='data-title'>ระดับชั้น</td>"
                . "<td class='data-show'></td>"
                . "</tr>"
                . "<tr>"
                . "<td class='data-title'>เชื้อชาติ</td>"
                . "<td class='data-show'>{$row['std_ethnicity']}</td>"
                . "</tr>"
                . "<tr>"
                . "<td class='data-title'>สัญชาติ</td>"
                . "<td class='data-show'>{$row['std_nationality']}</td>"
                . "</tr>"
                . "<tr>"
                . "<td class='data-title'>ศาสนา</td>"
                . "<td class='data-show'>{$row['std_religion']}</td>"
                . "</tr>"
                . "<tr>"
                . "<td class='data-title'>วันเดือนปีเกิด</td>"
                . "<td class='data-show'>{$row['std_birth_day']} " . month_num($row['std_birth_month']) . " {$row['std_birth_year']}</td>"
                . "</tr>"
                . "</table>";
        $outp .= "</table>";
        //------ จบโชว์ข้อมูล ------//

        $outp .= "</td></tr>";
        $outp .= "</div></div>";
        echo $outp;
    }

//--- End Code Detail ---//
//--- Code Code search ---//
    public function std_search() {
        
    }

//--- End Code search ---//
//--- End Code Control ----//
//----------------ข้อมูลนักเรียนจบ-------------------------------//
    //-------งานรับนักเรียน---------------//
    public function std_register_base() {
        $data['rs'] = $this->Std_model->get_register_base();
        $this->load->view("layout/header");
        $this->load->view("student/std_register_base", $data);
        $this->load->view("layout/footer");
    }

    public function std_register() {
        $this->load->view("layout/header");
        $this->load->view("student/std_register");
        $this->load->view("layout/footer");
    }

    public function std_register_insert() {
        if ($_FILES['inStdImage']['name'] != "") {
            $config = array(
                "upload_path" => "upload/",
                "allowed_types" => "jpg",
                "max_size" => 0,
                "file_name" => md5(date("YmdHis"))
            );
            $this->upload->initialize($config);
            $this->upload->do_upload("inStdImage");
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
        //ข้อมูลพื้นฐาน
        $stdstatus = "W";
        $arr = array(
            "std_titlename" => $this->input->post('inStdTitlename'),
            "std_firstname" => $this->input->post('inStdFirstname'),
            "std_lastname" => $this->input->post('inStdLastname'),
            "std_nickname" => $this->input->post('inStdNickname'),
            "std_idcard" => $this->input->post('inStdIdcard'),
            "std_Religion" => $this->input->post('inStdReligion'),
            "std_Ethnicity" => $this->input->post('inStdEthnicity'),
            "std_Nationality" => $this->input->post('inStdNationality'),
            "tb_student_base_recorder" => $this->session->userdata('name'),
            "tb_student_base_department" => $this->session->userdata('department'),
            "tb_student_base_status" => $stdstatus
        );
        $this->My_model->insert_data('tb_student_base', $arr);
        $id = $this->db->insert_id();

        //ข้อมูลด้านสุขภาพ
        $arr = array(
            "std_birth_day" => $this->input->post('inStdBirthday'),
            "std_birth_month" => $this->input->post('inStdBirthmonth'),
            "std_birth_year" => $this->input->post('inStdBirthyear'),
            "std_birth_hospital" => $this->input->post('inStdBirthhospital'),
            "std_bloodtype" => $this->input->post('inStdBloodtype'),
            "Std_allergic" => $this->input->post('inStdAllergic'),
            "std_congenital_disease" => $this->input->post('inStdCongenitalDisease'),
            "std_disabled" => $this->input->post('inStdDisabled'),
            "own_id" => $id
        );
        $this->My_model->insert_data('tb_std_health', $arr);

        //ข้อมูลด้านที่อยู่อาศัย
        $arr = array(
            "add_no" => $this->input->post('inAddNo'),
            "add_moo" => $this->input->post('inAddMoo'),
            "add_village" => $this->input->post('inAddVillage'),
            "add_road" => $this->input->post('inAddRoad'),
            "add_tambol" => $this->input->post('inAddTambol'),
            "add_amphur" => $this->input->post('inAddAmphur'),
            "add_province" => $this->input->post('inAddProvince'),
            "add_zipcode" => $this->input->post('inAddZipcode'),
            "add_type" => $this->input->post('inAddType'),
            "own_id" => $id
        );
        $this->My_model->insert_data('tb_current_address', $arr);

        //ภาพประจำตัวนักเรียน
        $stdyear = 2561;
        $arr = array(
            "pic_name" => $filename1,
            "pic_year" => $stdyear,
            "own_id" => $id
        );
        $this->My_model->insert_data('tb_std_picture', $arr);


        //ข้อมูลการศึกษา
        $arr = array(
            "tb_std_before_register_class" => $this->input->post('inStdClass'),
            "tb_std_before_register_lev" => $this->input->post('inStdLev'),
            "tb_student_base_id" => $id
        );
        $this->My_model->insert_data('tb_std_before_register', $arr);
    }

    public function std_register_update() {
        $id = $_POST['id'];
        $arr = array(
            "tb_student_base_status" => "S"
        );

        if ($id != "") {
            $this->My_model->update_data('tb_student_base', array('id' => $id), $arr);
        }
    }

    //-------------///
}
