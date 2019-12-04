<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/*
  | ============================================================================
  |  Title: Class Setting
  | ============================================================================
  | Copyright	Edutech Co.,Ltd.
  | Purpose     -
  | Author	chairatto
  | Create Date  14/1/2562
  | Last edit	-
  | Comment	-
  | ============================================================================
 */

class Admin_school extends CI_Controller {

    public function __construct() {
        parent::__construct();
        if ($this->session->userdata("status") == "") {
            redirect('/');
        }
        $this->load->model("Setting_model");
        $this->load->model("Admin_school_model");
        $this->load->model("Chairatto_model");
//$this->load->library('mpdf/mpdf');
    }

// เรียกส่วนจัดการระบบ (Administrator);
    public function admin_school_base() {
        $this->load->view("layout/header");
        $this->load->view("admin_school/admin_school_base");
        $this->load->view('layout/footer');
    }

    public function member() {
        $data['rs'] = $this->Chairatto_model->get_member_with_hr_list_by_department();
//        $data['rs'] = $this->My_model->get_where_order('tb_member', array('department' => $this->session->userdata('department'), 'status !=' => 'นักเรียน', 'status !=' => 'ผู้ปกครอง'), 'id asc');
//        $data['rs'] = $this->My_model->get_where_order('tb_data_define', array('department' => $this->session->userdata('department'), 'status !=' => 'นักเรียน', 'status !=' => 'ผู้ปกครอง'), 'data_group asc');
        $data['hr'] = $this->Chairatto_model->get_where_table('tb_human_resources_01', array('hr_department' => $this->session->userdata('department')));
        $this->load->view("layout/header");
        $this->load->view("admin_school/admin_school_member", $data);
        $this->load->view("layout/footer");
    }

// insert data;
    public function member_insert() {

        if ($_FILES['inSignature']['name'] != "") {

            $config = array(
                "upload_path" => "upload/",
                "allowed_types" => "png",
                "max_size" => 0,
                "file_name" => md5(date("YmdHis"))
            );
            $this->upload->initialize($config);

            $this->upload->do_upload("inSignature");
            $data = $this->upload->data();

            $this->load->library("image_lib");
            $config['image_library'] = "gd2";
            $config["source_image"] = "upload/" . $data['file_name'];
            $config['maintain_ratio'] = TRUE;
            $config['width'] = 350;
            $config['height'] = 200;

            $this->image_lib->initialize($config);
            $this->image_lib->resize();
            $filename = $data['file_name'];
        }

//        $get_image = file_get_contents($_FILES['inSignature']['name']);  //imgProfile is the name of the image tag
        $id = $_POST['id'];
        $hrid = $this->input->post("inHr");

        if ($id != "") {
            $CheckImg = $this->My_model->get_where_row("tb_member", array("id" => $id));
            if ($CheckImg['signature'] != "") {
                @unlink("upload/" . $CheckImg['signature']);
            }

            $arr = array(
                "signature" => $filename,
                "password" => $this->input->post("inPassword")
            );
            $this->My_model->update_data('tb_member', array('id' => $id), $arr);

            if ($hrid != "") {
                $arr = array(
                    "tb_member_id" => $id
                );
                $this->My_model->update_data('tb_human_resources_01', array('id' => $hrid), $arr);
            }
            $return = "TRUE";
        } else {
            $count = $this->My_model->chk_valid_data("tb_member", array('username' => $this->input->post("inUsername")));
            if (!$count) {

                $arr = array(
                    "status" => $this->input->post("inStatus"),
                    "username" => $this->input->post("inUsername"),
                    "password" => $this->input->post("inPassword"),
                    "activate" => $this->input->post("inActivate"),
                    "signature" => $filename,
                    "department" => $this->input->post("inDepartment")
                );
                $this->My_model->insert_data("tb_member", $arr);

                $memid = $this->db->insert_id();

                $arr = array(
                    "tb_member_id" => $memid
                );
                $this->My_model->update_data('tb_human_resources_01', array('id' => $hrid), $arr);


                echo True;
            } else {
                echo False;
            }
        }
    }

// edit data;
    public function member_hr_edit() {
        $id = $_POST['id'];
        $row = $this->Chairatto_model->member_hr_edit($id);
        echo json_encode($row);
    }

// member delete;
    public function member_delete() {
        $id = $_POST['id'];
        $this->My_model->delete_data("tb_member", array("id" => $id));
    }

// ดึงข้อมูลผู้ใช้งานระบบจากตารางข้อมูล member
    public function get_member() {
        $id = $_POST['id'];
        $rs = $this->My_model->get_where_row("tb_member", array("id" => $id));
        echo json_encode($rs);
    }

// set member responsible;
    public function member_resonsible() {
        $id = $this->uri->segment(2);
    }

// กำหนดหน้าที่รับผิดชอบของ member ว่าสามารถทำงานอะไรได้บ้าง
    public function member_responsible() {
        $data['rs'] = array();
        $this->load->view("layout/header");
        $this->load->view("setting/member_responsible", $data);
        $this->load->view("layout/footer");
    }

// พิมพ์ข้อมูลผู้ใช้งานระบบ
    public function print_member() {
        $data['rs'] = $this->My_model->get_all_order('tb_member', 'member_name asc');
        $this->load->view('setting/reports/member_report', $data);
    }

// กำหนดงานให้แต่ละผู้ใช้งานระบบ
    public function member_activities($id) {
        $data['member'] = $this->My_model->get_where_row('tb_member', array('id' => $id));
//        $data['rs'] = $this->My_model->get_where_order('tb_data_define', 'department like \'โรงเรียน%\' ', 'data_group asc, data_name asc');
        $data['rs'] = $this->My_model->get_where_order('tb_data_define', array('department' => $this->session->userdata('department')), 'data_group asc');
//        $data['member'] = $this->Admin_school_model->get_member_by_dep();

        $this->load->view('layout/header');
        $this->load->view('admin_school/admin_school_member_permission', $data);
        $this->load->view('layout/footer');
    }

// insert member activities
    public function insert_member_activities() {
        $permission_id = $this->input->post('permission_id');
        $row = $this->input->post('row');
        $member_id = $this->input->post('member_id');
        $data_define = $this->input->post('define_id');
//
        if ($permission_id != '') {
            $arr = array(
                'data_permission' => $this->input->post('inPermission' . $row)
            );
            $this->My_model->update_data('tb_member_activities', array('id' => $permission_id), $arr);
        } else {
            $arr = array(
                'member_id' => $member_id,
                'data_define_id' => $data_define,
                'data_permission' => $this->input->post('inPermission' . $row)
            );
            $this->My_model->insert_data('tb_member_activities', $arr);
        }
        redirect('school-member-permission/' . $member_id);
    }

// delete member activities
    public function delete_member_activities() {
        $id = $_POST['id'];
        $this->My_model->delete_data('tb_member_activities', array('id' => $id));
    }

// กำหนดกลุ่มข้อมูลสำหรับผู้ใช้งาน
    public function data_define_setting_base() {

        $data['rs'] = $this->My_model->get_where_order('tb_data_define', array('department' => $this->session->userdata('department')), 'data_group asc');

        $this->load->view('layout/header');
        $this->load->view('admin_school/data_define_setting/data_define_setting_base', $data);
        $this->load->view('layout/footer');
    }

    public function data_define_setting_insert() {
        $id = $this->input->post('id');

        if ($_FILES['inDataDefinePicture']['name'] != "") {
            $arr = array(
                "id" => $id,
                "data_name" => $this->input->post('inDataDefineName'),
                "data_picture" => $_FILES['inDataDefinePicture']['name'],
                "data_color_bg" => $this->input->post('inDataDefineBgColor'),
                "data_color_font" => $this->input->post('inDataDefineFontColor'),
                "department" => $this->session->userdata('department')
            );
        } else {
            $arr = array(
                "id" => $id,
                "data_name" => $this->input->post('inDataDefineName'),
                "data_color_bg" => $this->input->post('inDataDefineBgColor'),
                "data_color_font" => $this->input->post('inDataDefineFontColor'),
                "department" => $this->session->userdata('department')
            );
        }

        if ($id != "") {
            $this->My_model->update_data('tb_data_define', array('id' => $id), $arr);
        } else {
            $this->My_model->insert_data('tb_data_define', $arr);
        }
    }

    public function data_define_setting_edit() {
        $id = $this->input->post('id');
        $output = "";
        $stdid = 1;
//        $MyPath = std_path($stdid, $this->session->userdata('sch_id'));

        $this->db->select("*")->from("tb_data_define");
        $this->db->where("id", $id);
        $MyQ = $this->db->get()->row_array();

//        $output .= $MyQ['id'];

        $output .= "<div class='row' style='margin-bottom: 20px;'> ";
        $output .= "<center>";
        $output .= "<div class='btn form-control' id='BtnPreview' style='height: 100px ;width: 400px; background: " . $MyQ['data_color_bg'] . "; font-size: 1.95em !important;text-align: left'>";

        $output .= "<div class='col-md-3'>";
//        
        if ($MyQ['data_picture'] != "") {
            $output .= "<img id='blah' src='" . base_url() . '/images/icon/' . $MyQ['data_picture'] . "' style='width: 85px' />";
        } else {
            $output .= "<img id='blah' src='" . base_url() . "/images/no-image.png' style='width: 85px' />";
        }

        $output .= "</div>";

        $output .= "<div class='col-md-8 col-md-offset-1' style='margin-top: 20px'>";
        $output .= "<p><font id='MyFont' style='color:" . $MyQ['data_color_font'] . "'>ตัวอย่าง Test 1234</font></p>";
        $output .= "</div>";

        $output .= "</div>";
        $output .= "</center>";
        $output .= "</div>";


        $output .= "<div class='row'>";
        $output .= "<div class='col-md-12'>";
        $output .= "<div class='row'>";

        $output .= "<div class='col-md-12 form-group'>";
        $output .= "<label class='control-label'>ชื่อเมนู</label>";
        $output .= "<input type='text' name='inDataDefineName' id='inDataDefineName' value='" . $MyQ['data_name'] . "' class='form-control' autofocus  required/>";
        $output .= "</div>";

        $output .= "</div>";

        $output .= "<div class='row'>";
        $output .= "<div class='col-md-4 form-group'>";
        $output .= "<label class='control-label'>ภาพสัญลักษ์เมนู</label>";
        $output .= "<input type='file' name='inDataDefinePicture' id='inDataDefinePicture' class='filestyle' onchange='ShowImg(this)'/>";
        $output .= "</div>";

        $output .= "<div class='col-md-4 form-group'>";
        $output .= "<label class='control-label'>สีเมนู</label>";
        $output .= "<br>";
        $output .= "<input type='color' id='inDataDefineBgColor' name='inDataDefineBgColor' value='" . $MyQ['data_color_bg'] . "'  style='width: 250px;height: 40px' onchange=\"BgColor(this)\">";
        $output .= "</div>";

        $output .= "<div class='col-md-4 form-group'>";
        $output .= "<label class='control-label'>สีตัวอักษร</label>";
        $output .= "<br>";
        $output .= "<input type='color' id='inDataDefineFontColor' name='inDataDefineFontColor' value='" . $MyQ['data_color_font'] . "'  style='width: 250px;height: 40px' onchange=\"FontColor(this)\">";
        $output .= "</div>";

        $output .= "</div>";
        $output .= "</div>";
        $output .= "</div>";

        $output .= "<div class='row'>";
        $output .= "<center><button type='submit' class='btn btn-success btn-insert'><i class='icon-save icon-large'></i> บันทึก</button></center>";
        $output .= "</div>";
        $output .= "<input type='hidden' name='id' id='id'  value='" . $MyQ['id'] . "'/>";

        echo $output;
    }

    public function data_define_setting_approve() {
        $id = $this->input->post('id');
        $HrPositionList = $this->Admin_school_model->get_all_position_w_department();
        $PosList = $this->Admin_school_model->get_approver_n_position_w_datadefineid($id);
        $output = "";


        $output .= "<div class='col-md-5'>";
        $output .= "<table class='table table-hover table-striped table-bordered display' id='PositionTable'> ";
        $output .= "<thead>";
        $output .= "<tr>";
        $output .= "<th style='width:10%;
        text-align: center' class='no-sort'>ที่</th>";
        $output .= "<th style='width:30%;
        text-align: center' class='no-sort'>เลขที่ตำแหน่ง</th>";
        $output .= "<th style='width:40%;
        text-align: center' class='no-sort'>ชื่อตำแหน่ง</th>";
        $output .= "<th style='width:20%;
        text-align: center' class='no-sort'></th>";
        $output .= "</tr>";
        $output .= "</thead>";
        $output .= "<tbody>";
        $i = 1;
        foreach ($HrPositionList as $r) {
            $output .= "<tr>";

            $output .= "<td style='text-align: center;
        '>" . $i . "</td>";
            $output .= "<td style='text-align: center;
        '>" . $r->tb_hr_position_code . "</td>";
            $output .= "<td style='text-align: center;
        '>" . $r->tb_hr_position_name . "</td>";
            $output .= "<td style='text-align: center;
        '>";
            $output .= "<button type='button' class='btn btn-success btn-approve' id='" . $r->id . "' onclick='SelectThis(this)'><i class='icon-arrow-right icon-large'></i> เลือก</button>";
            $output .= "</td>";

            $output .= "</tr>";
            $i++;
        }
        $output .= "</tbody>";
        $output .= "</table>";
        $output .= "</div>";





        //----- right table
        $output .= "<div class='col-md-7'>";
        $output .= "<table class='table table-hover table-striped table-bordered display' id='PositionTable'> ";
        $output .= "<thead>";
        $output .= "<tr>";
        $output .= "<th style='width:10%;
        text-align: center' class='no-sort'>ที่</th>";
        $output .= "<th style='width:20%;
        text-align: center' class='no-sort'>เลขที่ตำแหน่ง</th>";
        $output .= "<th style='width:20%;
        text-align: center' class='no-sort'>ชื่อตำแหน่ง</th>";
        $output .= "<th style='width:50%;
        text-align: center' class='no-sort'></th>";
        $output .= "</tr>";
        $output .= "</thead>";
        $output .= "<tbody>";
        $i = 1;
        foreach ($PosList as $r) {
            $output .= "<tr>";

            $output .= "<td style='text-align: center;
        '>" . $i . "</td>";
            $output .= "<td style='text-align: center;
        '>" . $r->tb_hr_position_code . "</td>";
            $output .= "<td style='text-align: center;
        '>" . $r->tb_hr_position_name . "</td>";
            $output .= "<td style='text-align: center;
        '>";
            $output .= "<button type='button' class='btn btn-primary btn-approve' id='" . $r->id . "' ><i class='icon-arrow-up icon-large'></i> เลื่อนขึ้น</button>";
            $output .= "&nbsp;";
            $output .= "<button type='button' class='btn btn-danger btn-approve' id='" . $r->id . "' ><i class='icon-arrow-down icon-large'></i> เลื่อนลง</button>";
            $output .= "</td>";

            $output .= "</tr>";
            $i++;
        }
        $output .= "</tbody>";
        $output .= "</table>";
        $output .= "</div>";
        $output .= "<input type='hidden' id='inDataDefineId'value='" . $id . "'>";


        echo $output;
    }

    public function data_define_setting_approve_insert_pos() {
        $PositionId = $this->input->post('PositionId');
        $DefineId = $this->input->post('DefineId');

        $check = $this->My_model->chk_valid_data('tb_edoc_approver', array("tb_hr_position_id" => $PositionId, "tb_data_define_id" => $DefineId));

        if (!$check) {
            $arr = array(
                "tb_hr_position_id" => $PositionId,
                "tb_data_define_id" => $DefineId,
                "tb_edoc_approver_sequence" => 1,
                "tb_edoc_approver_recorder" => $this->session->userdata('name'),
                "tb_edoc_approver_department" => $this->session->userdata('department'),
                "tb_edoc_approver_createdate" => date('Y-m-d')
            );
            $this->My_model->insert_data('tb_edoc_approver', $arr);
        }
    }

    //---- งานฟลุค
    public function hr_position_base() {
        //
        $data['rs'] = $this->Admin_school_model->hr_position_where_department();
        $this->load->view('layout/header');
        $this->load->view('admin_school/hr_position/hr_position_base', $data);
        $this->load->view('layout/footer');
    }

    public function hr_position_insert() {
        $id = $this->input->post('id');

        $arr = array(
            "id" => $id,
            "tb_hr_position_code" => $this->input->post('inHrPositionCode'),
            "tb_hr_position_name" => $this->input->post('inHrPositionName'),
            "tb_hr_position_under" => $this->input->post('inHrPositionUnder'),
            "tb_hr_position_tier" => $this->input->post('inHrPositionTier'),
            "tb_hr_position_detail" => $this->input->post('inHrPositionDetail'),
            "tb_hr_position_department" => $this->session->userdata('department')
        );

        if ($id != "") {
            $this->My_model->update_data('tb_hr_position', array('id' => $id), $arr);
        } else {
            $this->My_model->insert_data('tb_hr_position', $arr);
        }
    }

    public function hr_position_edit() {
        $id = $this->input->post('id');
        echo json_encode($this->My_model->get_where_row("tb_hr_position", array("id" => $id)));
    }

    public function hr_position_delete() {
        $id = $this->input->post('id');
        $this->My_model->delete_data('tb_hr_position', array('id' => $id));
    }

    //-- division

    public function admin_school_division_base() {
        $data['divison'] = $this->My_model->get_where_order('tb_division', array('tb_school_id' => $this->session->userdata('sch_id')), 'id asc');
        $this->load->view("layout/header");
        $this->load->view("admin_school/admin_school_division_base", $data);
        $this->load->view('layout/footer');
    }

    public function admin_school_division_insert() {
        $id = $this->input->post('id');

        $arr = array(
            "tb_division_name" => $this->input->post('inDivisionName'),
            "tb_school_id" => $this->session->userdata('sch_id'),
        );

        if ($id != "") {
            $this->My_model->update_data('tb_division', array('id' => $id), $arr);
        } else {
            $this->My_model->insert_data('tb_division', $arr);
        }
    }

    public function admin_school_division_edit() {
        $id = $this->input->post('id');
        echo json_encode($this->My_model->get_where_row("tb_division", array("id" => $id)));
    }
    
    public function admin_school_division_delete() {
        $id = $this->input->post('id');
        $this->My_model->delete_data('tb_division', array('id' => $id));
    }
    
    
    public function insert_member_activities_all() {

        $member_id = $this->input->post('member_id');
        
        
        $this->My_model->delete_data('tb_member_activities', array('member_id' => $member_id));
 
        $data_define = $this->My_model->get_where_order('tb_data_define',array('department'=>$this->session->userdata('department')),'id');
//
        foreach ($data_define as $menu)
        {
            $arr = array(
                'member_id' => $member_id,
                'data_define_id' => $menu['id'],
                'data_permission' => 'Y'
            );
            $this->My_model->insert_data('tb_member_activities', $arr);
        }
        redirect('school-member-permission/' . $member_id);
    }

}
