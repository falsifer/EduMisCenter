<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/*
  | ----------------------------------------------------------------------------
  |  Title
  | ----------------------------------------------------------------------------
  | Copyright	Edutech Co.,Ltd.
  | Purpose     โมเดลนักเรียน
  | Author      chairatto
  | Create Date 22/11/2561
  | Last edit	8/3/2562
  | Comment	-
  | ----------------------------------------------------------------------------
 */

Class Student extends CI_Controller {

    public function __construct() {
        parent::__construct();
        if ($this->session->userdata('status') == "") {
            redirect("/");
        }
        $this->load->model("My_model");
        $this->load->model("Std_model");
    }

// index
    public function index() {
        
    }

//------------- งานนักเรียนใหม่ เพิ่มงานทะเบียน let's go !

    public function student_management_base() {

        $data['rs'] = $this->Std_model->get_register_base();
        $this->load->view("layout/header");
        $this->load->view("student/student_management/student_management_base", $data);
        $this->load->view("layout/footer");
    }

    //---- Filter student 
    // เขียนต่อตรงนี้
    public function get_student_management_base_filter() {
        $rid = $_POST['rid'];
        $cid = $_POST['cid'];
        $edyear = $_POST['edyear'];
        $StdStatus = "S";

        $StdArr = $this->Std_model->get_std_base_list($rid, $cid, $edyear, $StdStatus);
        $output = "";

        $output .= "<table class=\"table table-hover table-striped table-bordered display\" id=\"example\">";
        $output .= "<thead>";
        $output .= "<tr>";
        $output .= "<th style=\"width:5%;\">ที่</th>";
        $output .= "<th style=\"width:20%;\" class=\"no-sort\">รหัสนักเรียน</th>";
        $output .= "<th style=\"width:50%;\" class=\"no-sort\">ชื่อ-นามสกุล</th>";
        if ($this->session->userdata("status") == "ผู้ปฏิบัติงาน") {
            $output .= "<th style=\"width:25%;\" class=\"no-sort\"></th>";
        }
        $output .= "</tr>";
        $output .= "</thead>";

        if ($StdArr != "FALSE") {
            $output .= "<tbody>";
            $i = 1;

            foreach ($StdArr as $row) {

                $output .= "<tr>";
                $output .= "<td style=\"text-align:center;\">" . $row->tb_ed_classroom_number . "</td>";
                $output .= "<td style=\"text-align:center;\">" . $row->std_code . "</td>";
                $output .= "<td>";
                $output .= "<button class=\"btn btn-link btn-detail\" onclick=\"StdDetail(this)\" id=\"" . $row->StdId . "\">" . $row->std_fullname . "</button>";
                $output .= "</td>";

                if ($this->session->userdata("status") == "ผู้ปฏิบัติงาน") {
                    $output .= "<td style=\"text-align: center;\">";
                    $output .= "<div class=\"dropdown\">";
                    $output .= "<button class=\"btn btn-primary dropdown-toggle\" type=\"button\" data-toggle=\"dropdown\"><i class=\"icon-print icon-large\"></i> พิมพ์เอกสาร<span style=\"margin-left:5px;\" class=\"caret\"></span></button>";
                    $output .= "<ul class=\"dropdown-menu\">";
                    $output .= "<li><a href=\"javascript:StdPP1(" . $row->StdId . ");\">ปพ. 1</a></li>";
                    $output .= "<li><a href=\"javascript:StdPP2(" . $row->StdId . ");\">ปพ. 2</a></li>";
                    $output .= "<li><a href=\"javascript:StdPP6(" . $row->StdId . ");\">ปพ. 6</a></li>";
                    $output .= "<li><a href=\"javascript:StdPP8(" . $row->StdId . ");\">ปพ. 8</a></li>";
                    $output .= "</ul>";
                    $output .= "</div>";
                    $output .= "</td>";
                }
                $output .= "</tr>";
                $i++;
            }
            $output .= "</tbody>";
        }

        $output .= "</table>";
        echo $output;
    }

//--- เขียนใหม่จบตรงนี้
//
//
//
//----------------ข้อมูลนักเรียน-------------------------------//
//---------เรียก View---------//
    public function std_base() {

//        $data['rs'] = $this->Std_model->get_std_base_list();
        $data['rClass'] = $this->Std_model->get_school_class();

        $this->load->view("layout/header");
        $this->load->view("student/std_base", $data);
        $this->load->view("layout/footer");
    }

    public function std_insert_view() {
        $this->load->view("layout/header");
        $this->load->view("student/std_insert_view");
        $this->load->view("layout/footer");
    }

    //---- Filter student 
    // เขียนต่อตรงนี้
    public function get_std_base_list() {
        $rid = $_POST['rid'];
        $cid = $_POST['cid'];
        $edyear = $_POST['edyear'];
        $StdStatus = "S";

        $StdArr = $this->Std_model->get_std_base_list($rid, $cid, $edyear, $StdStatus);
        $output = "";

        $output .= "<table class=\"table table-hover table-striped table-bordered display\" id=\"example\">";
        $output .= "<thead>";
        $output .= "<tr>";
        $output .= "<th style=\"width:5%;\">ที่</th>";
        $output .= "<th style=\"width:20%;\" class=\"no-sort\">รหัสนักเรียน</th>";
        $output .= "<th style=\"width:50%;\" class=\"no-sort\">ชื่อ-นามสกุล</th>";
        if ($this->session->userdata("status") == "ผู้ปฏิบัติงาน") {
            $output .= "<th style=\"width:25%;\" class=\"no-sort\"></th>";
        }
        $output .= "</tr>";
        $output .= "</thead>";

        if ($StdArr != "FALSE") {
            $output .= "<tbody>";
            $i = 1;

            foreach ($StdArr as $row) {

                $output .= "<tr>";
                $output .= "<td style=\"text-align:center;\">" . $row->tb_ed_classroom_number . "</td>";
                $output .= "<td style=\"text-align:center;\">" . $row->std_code . "</td>";
                $output .= "<td>";
                $output .= "<button class=\"btn btn-link btn-detail\" onclick=\"StdDetail(this)\" id=\"" . $row->StdId . "\">" . $row->std_fullname . "</button>";
                $output .= "</td>";

                if ($this->session->userdata("status") == "ผู้ปฏิบัติงาน") {
                    $output .= "<td style=\"text-align: center;\">";
                    $output .= "&nbsp;<button type=\"button\" class=\"btn btn-warning btn-edit\" onclick=\"StdEdit(this)\" id=\"" . $row->StdId . "\"><i class=\"icon-pencil icon-large\"></i> แก้ไข</button>";
//                    $output .= "&nbsp;<button type=\"button\" class=\"btn btn-info btn-print\" onclick=\"StdPrint(this)\" id=\"" . $row->StdId . "\"><i class=\"icon-print icon-large\"></i> สั่งพิมพ์</button>";
                    $output .= "&nbsp;<button type=\"button\" class=\"btn btn-danger btn-delete\" onclick=\"StdDelete(this)\" id=\"" . $row->StdId . "\"><i class=\"icon-trash icon-large\"></i> ลบ</button>";
                    $output .= "</td>";
                }
                $output .= "</tr>";
                $i++;
            }
            $output .= "</tbody>";
        }

        $output .= "</table>";
        echo $output;
    }

//-------- End view -------//
//    
//----- Code Control ------//
//----- Code Delete ------//
    public function std_delete() {
        $id = $_POST['id'];
        $status = $_POST['status'];
        $arr = array(
            "tb_student_base_status" => $status
        );

        if ($id != "") {
            $this->My_model->update_data('tb_student_base', array('id' => $id), $arr);
            $this->My_model->delete_data('tb_ed_classroom', array('tb_student_base_id' => $id));
        }
    }

//----- End Code Delete ------//
//
////----- Code Delete ------//
    public function std_waiting_delete() {
        $id = $_POST['id'];
        if ($id != "") {
            $this->My_model->delete_data('tb_std_before_register', array('tb_student_base_id' => $id));
            $this->My_model->delete_data('tb_student_base', array('id' => $id));
        }
    }

//----- End Code Delete ------//
//----- Code Edit ------//
    public function std_edit() {
        $id = $_POST['id'];
//$rs = $this->My_model->join2table_row("tb_student_base a","tb_std_health b","a.id = b.own_id", array("own_id" => $id));
//        $rs = $this->Std_model->get_std_edit($id);
        $rs = $this->Std_model->student_edit($id);
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
        $id = $this->input->post('bid');
        $did = $this->input->post('did');
        $jid = $this->input->post('jid');
        $addid = $this->input->post('addid');

//////////////ภาพปิด///////////
        $arr = array(
            "std_titlename" => $this->input->post('inStdTitlename2'),
            "std_firstname" => $this->input->post('inStdFirstname2'),
            "std_lastname" => $this->input->post('inStdLastname2'),
            "std_nickname" => $this->input->post('inStdNickname2'),
            "std_idcard" => $this->input->post('inStdIdcard2'),
            "std_code" => $this->input->post('inStdCode2'),
            "std_Religion" => $this->input->post('inStdReligion2'),
            "std_Ethnicity" => $this->input->post('inStdEthnicity2'),
            "std_Nationality" => $this->input->post('inStdNationality2'),
            "std_birth_hospital" => $this->input->post('inStdBirthhospital2'),
            "std_bloodtype" => $this->input->post('inStdBloodtype2'),
            "std_birthday" => $this->input->post('inStdBirthyear2') . "-" . insert_zero_f_position($this->input->post('inStdBirthmonth'), 2) . "-" . insert_zero_f_position($this->input->post('inStdBirthday'), 2)
        );
        if ($id != "") {
            $this->My_model->update_data('tb_student_base', array('id' => $id), $arr);
        }




//ข้อมูลอาชีพของผู้ปกครอง
        $arr = array(
            "cr_career_name" => $this->input->post('inFmCareerName'),
            "cr_company_name" => $this->input->post('inFmCompanyName'),
            "cr_income" => $this->input->post('inFmIncome')
        );
        if ($id != "") {
            $this->My_model->update_data('tb_fm_career', array('id' => $jid), $arr);
        }
////////////
    }

//--- End Code update ---//
//--- Code Code Detail ---//
    public function std_detail() {
        $id = $_POST['id'];
        $row = $this->Std_model->student_detail($id);
//        $row = $this->My_model->get_where_row("tb_student_base", array("id" => $id));


        $outp = "<div class='container-fluid'>"
                . "<div class='row'>";
//---- แสดงภาพประกอบ ----//
//        $outp .= "<tr><td style='padding-top:20px;'>";
        $outp .= "<div class=\"col-md-4\">";
        if (file_exists("upload/" . $row['pic_name']) && !empty($row['pic_name'])) {
            $outp .= "<center>";
            $outp .= img(array('src' => "upload/" . $row['pic_name'], "style" => "width:250px;height:300px;border:5px solid #C0C0C0;")) . nbs(5);
            $outp .= "</center>";
            $outp .= "<br></br>";
        }
        $outp .= "</div>";
//---- จบภาพประกอบ ----//
//------ โชว์ข้อมูล ------//
        $outp .= "<div class=\"col-md-8\">";
        $outp .= "<div class=\"row\">";
        $outp .= "<table style='width:100%;'>"
                . "<tr>"
                . "<td class='data-title'>ชื่อ-นามสกุล</td>"
                . "<td class='data-show'>{$row['std_titlename']}{$row['std_firstname']}  {$row['std_lastname']}</td>"
                . "</tr>"
                . "<tr>"
                . "<td class='data-title'>รหัสนักเรียน</td>"
                . "<td class='data-show'>{$row['std_code']}</td>"
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
//                . "<tr>"
//                . "<td class='data-title'>วันเดือนปีเกิด</td>"
//                . "<td class='data-show'>{$row['std_birth_day']} " . month_num($row['std_birth_month']) . " {$row['std_birth_year']}</td>"
//                . "</tr>"
                . "</table>";

        $outp .= "</div>";
        $outp .= "</div>";
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
        $data['rClass'] = $this->Std_model->get_school_class();
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
            "tb_student_base_createdate" => date('Y-m-d'),
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
        $arr = array(
            "pic_name" => $filename1,
            "pic_year" => date('Y'),
            "own_id" => $id
        );
        $this->My_model->insert_data('tb_std_picture', $arr);


        //ข้อมูลก่อนเข้ารับการศึกษา
        $arr = array(
            "tb_ed_school_register_class_id" => $this->input->post('inStdClass'),
            "tb_student_base_id" => $id
        );
        $this->My_model->insert_data('tb_std_before_register', $arr);
    }

    public function std_register_update() {
        $sid = $_POST['sid'];
        $rid = $_POST['rid'];

        if ($sid != "") {

            $NextNumber = $this->Std_model->std_max_number($rid) + 1;
            print_r($NextNumber);
            $arr = array(
                "tb_ed_classroom_number" => $NextNumber,
                "tb_ed_room_id" => $rid,
                "tb_student_base_id" => $sid
            );
            $this->My_model->insert_data('tb_ed_classroom', $arr);

            $arr = array(
                "tb_student_base_status" => "S"
            );
            $this->My_model->update_data('tb_student_base', array('id' => $sid), $arr);
        }
    }

    //-------------///
    //------- รายชื่อนักเรียนที่ยังไม่ลงทะเบียน อ้างอิงด้วย Class ID
    public function get_std_waiting_list() {
        $id = $_POST['id'];
        echo $this->Std_model->get_std_waiting_list($id);
    }

    //------- รายชื่อนักเรียนที่ยังไม่ลงทะเบียน อ้างอิงด้วย Class ID
    public function get_room_id() {
        $id = $_POST['id'];
        echo $this->Std_model->get_std_waiting_list($id);
    }

    //------- รายชื่อนักเรียนที่ลงทะเบียนแล้ว อ้างอิงด้วย Class ID Room number
    public function get_std_registered_list() {
        $rid = $_POST['rid'];
        $cid = $_POST['cid'];
        echo $this->Std_model->get_std_registered_list($rid, $cid);
    }

    public function std_registered_update() {
        $id = $this->input->post('id');
        $status = $this->input->post('status');
        $this->My_model->delete_data('tb_ed_classroom', array('tb_student_base_id' => $id));

        $arr = array(
            "tb_student_base_status" => $status
        );
        $this->My_model->update_data('tb_student_base', array('id' => $id), $arr);
    }

    public function std_registered_move_room() {
        $rid = $this->input->post('rid');
        $stdid = $this->input->post('stdid');
        $oldrid = $this->input->post('oldid');

        $arr = array(
            "tb_ed_room_id" => $rid,
            "tb_student_base_id" => $stdid,
        );
        $this->My_model->update_data('tb_ed_classroom', array('id' => $oldrid), $arr);
        echo 'ห้องใหม่' . $rid . 'รหัสเด็ก' . $stdid . 'คลาสเก่า' . $oldrid;
    }

    public function std_registered_move_out() {
        $id = $this->input->post('id');
        $status = $this->input->post('status');
        $this->My_model->delete_data('tb_ed_classroom', array('tb_student_base_id' => $id));

        $classroom = $this->My_model->get_where_row('tb_ed_classroom', array('tb_student_base_id' => $id));
        $room = $this->My_model->get_where_row('tb_ed_room', array('id' => $classroom['tb_ed_room_id']));
        $schoolclass = $this->My_model->get_where_row('tb_ed_school_register_class', array('id' => $room['tb_ed_school_register_class_id']));

//        $beforeregister = $this->My_model->get_where_row('tb_std_before_register', array('id' => $schoolclass['id'], 'tb_student_base_id' => $id));
        $arr = array(
            "tb_ed_school_register_class_id" => $schoolclass['id'],
            "tb_student_base_id" => $id,
        );
        $this->My_model->insert_data('tb_std_before_register', $arr);

        $arr = array(
            "tb_student_base_status" => $status
        );
        $this->My_model->update_data('tb_student_base', array('id' => $id), $arr);
    }

}
