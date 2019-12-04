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

class Setting extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model("Setting_model");
        $this->load->model("Edutech_model");
        //$this->load->library('mpdf/mpdf');
    }

    // กำหนดค่าหน่วยงาน
    public function insert_organization() {
        $this->load->view("layout/header");
        $this->load->view("setting/insert_organization");
        $this->load->view("layout/footer");
    }

    // บันทึกหน่วยงาน
    public function organization_insert() {
        $id = $_POST['id'];
        if ($id != '') {
            if (!empty($_FILES["inOrgLogo"]["name"])) {
                $row = $this->My_model->get_row('tb_organization');
                @unlink('upload/' . $row['org_logo']);
                $config = array(
                    "upload_path" => "upload/",
                    "allowed_types" => "jpg|png",
                    "max_size" => 0,
                    "file_name" => md5(date("YmdHis"))
                );
                $this->upload->initialize($config);
                $this->upload->do_upload("inOrgLogo");
                $data = $this->upload->data();

                $this->load->library("image_lib");
                $config['image_library'] = "gd2";
                $config["source_image"] = "upload/" . $data['file_name'];
                $config['maintain_ratio'] = TRUE;
                $config['width'] = 500;
                $config['height'] = 500;

                $this->image_lib->initialize($config);
                $this->image_lib->resize();
                $filename = $data['file_name'];
                $arr = array('org_logo' => $filename);
                $this->My_model->update_data('tb_organization', array('id' => $id), $arr);
            }
            $arr = array(
                "org_thai_name" => $this->input->post('inOrgThaiName'),
                "org_eng_name" => $this->input->post('inOrgEngName'),
                "org_symbol" => $this->input->post('inOrgSymbol'),
                "org_address_no" => $this->input->post('inOrgAddressNo'),
                "org_address_moo" => $this->input->post('inOrgAddressMoo'),
                "org_address_village" => $this->input->post('inOrgAddressVillage'),
                "org_address_street" => $this->input->post('inOrgAddressStreet'),
                "org_address_tambon" => $this->input->post('inOrgAddressTambon'),
                "org_address_amphur" => $this->input->post('inOrgAddressAmphur'),
                "org_address_province" => $this->input->post('inOrgAddressProvince'),
                "org_address_zipcode" => $this->input->post('inOrgAddressZipcode'),
                "org_address_telephone" => $this->input->post('inOrgAddressTelephone'),
                "org_address_fax" => $this->input->post('inOrgAddressFax'),
                "org_address_email" => $this->input->post('inOrgAddressEmail'),
                "org_address_website" => $this->input->post('inOrgAddressWebsite'),
                "org_address_lat" => $this->input->post('inOrgAddressLat'),
                "org_address_long" => $this->input->post('inOrgAddressLong'),
                "org_begin_day" => $this->input->post('inOrgBeginDay'),
                "org_begin_month" => $this->input->post('inOrgBeginMonth'),
                "org_begin_year" => $this->input->post('inOrgBeginYear'),
                "org_from_amphur" => $this->input->post('inOrgFromAmphur'),
            );
            $this->My_model->update_data('tb_organization', array('id' => $id), $arr);
        } else {
            if (!empty($_FILES["inOrgLogo"]["name"])) {
                $config = array(
                    "upload_path" => "upload/",
                    "allowed_types" => "jpg|png",
                    "max_size" => 0,
                    "file_name" => md5(date("YmdHis"))
                );
                $this->upload->initialize($config);
                $this->upload->do_upload("inOrgLogo");
                $data = $this->upload->data();

                $this->load->library("image_lib");
                $config['image_library'] = "gd2";
                $config["source_image"] = "upload/" . $data['file_name'];
                $config['maintain_ratio'] = TRUE;
                $config['width'] = 500;
                $config['height'] = 500;

                $this->image_lib->initialize($config);
                $this->image_lib->resize();
                $filename = $data['file_name'];
            } else {
                $filename = "";
            }

            $arr = array(
                "org_thai_name" => $this->input->post('inOrgThaiName'),
                "org_eng_name" => $this->input->post('inOrgEngName'),
                "org_symbol" => $this->input->post('inOrgSymbol'),
                "org_address_no" => $this->input->post('inOrgAddressNo'),
                "org_address_moo" => $this->input->post('inOrgAddressMoo'),
                "org_address_village" => $this->input->post('inOrgAddressVillage'),
                "org_address_street" => $this->input->post('inOrgAddressStreet'),
                "org_address_tambon" => $this->input->post('inOrgAddressTambon'),
                "org_address_amphur" => $this->input->post('inOrgAddressAmphur'),
                "org_address_province" => $this->input->post('inOrgAddressProvince'),
                "org_address_zipcode" => $this->input->post('inOrgAddressZipcode'),
                "org_address_telephone" => $this->input->post('inOrgAddressTelephone'),
                "org_address_fax" => $this->input->post('inOrgAddressFax'),
                "org_address_email" => $this->input->post('inOrgAddressEmail'),
                "org_address_website" => $this->input->post('inOrgAddressWebsite'),
                "org_address_lat" => $this->input->post('inOrgAddressLat'),
                "org_address_long" => $this->input->post('inOrgAddressLong'),
                "org_begin_day" => $this->input->post('inOrgBeginDay'),
                "org_begin_month" => $this->input->post('inOrgBeginMonth'),
                "org_begin_year" => $this->input->post('inOrgBeginYear'),
                "org_from_amphur" => $this->input->post('inOrgFromAmphur'),
                'org_logo' => $filename
            );
            $this->My_model->insert_data("tb_organization", $arr);
        }
    }

    // แก้ไขข้อมูลหน่วยงาน
    public function edit_organization() {
        $data['rs'] = $this->My_model->get_row('tb_organization');
        $this->load->view('layout/header');
        $this->load->view('setting/organization_edit', $data);
        $this->load->view('layout/footer');
    }

    // หน้าจอสำหรับเข้าระบบ (login screen)
    public function login_view() {
        if ($this->session->userdata("status") != "") {
            redirect(site_url());
        }
        $data['logo'] = $this->My_model->get_row("tb_organization");
        $this->load->view("layout/header");
        $this->load->view("setting/login_view", $data);
        $this->load->view("layout/footer");
    }

    // Login process;
    public function do_login() {
        // fetch data from member table;
        $username = $this->input->post('inUsername');
        $password = $this->input->post('inPassword');
        $row = $this->My_model->get_where_row("tb_member", array("username" => $username, 'password' => $password));
        if (!empty($row)) {
            // กำหนด session ต่าง ๆ 
            if ($row['username'] == "admin") {
                // สำหรับผู้ดูแลระบบ
                $this->session->set_userdata('name', $row['member_name']);
                $this->session->set_userdata('status', $row['status']);
                $this->session->set_userdata('activate', $row['activate']);
                $this->session->set_userdata("department", $row['department']);
                $this->session->set_userdata("responsible", $row['responsible']);
                // ดึงข้อมูลหน่วยงานมากำหนด session
                $org = $this->My_model->get_row('tb_organization');
                $this->session->set_userdata('localgov', $org['org_thai_name']);
            } else {
                // สำหรับผู้ใช้อื่น'
                if($row['status'] == "นักเรียน"){
                    $tmp = $this->My_model->get_where_row("tb_student_base", array("tb_member_id" => $row['id']));
                }else{
                    $tmp = $this->My_model->get_where_row("tb_human_resources_01", array("tb_member_id" => $row['id']));
                }
                if(isset($tmp)){
                    $this->session->set_userdata('hr_id', $tmp['id']);
                    $this->session->set_userdata('name', $tmp['hr_thai_symbol'].$tmp['hr_thai_name'] . ' ' . $tmp['hr_thai_lastname']);
                }else{
                    $this->session->set_userdata('hr_id', '');
                    $this->session->set_userdata('name', $row['member_name'] . ' ' . $row['member_lastname']);
                }
                $this->session->set_userdata('member_id', $row['id']);
                
                $this->session->set_userdata('status', $row['status']);
                $this->session->set_userdata("department", $row['department']);
                $this->session->set_userdata("responsible", $row['responsible']);
                // ดึงข้อมูลหน่วยงานมากำหนด session
                $org = $this->My_model->get_row('tb_organization');
                $this->session->set_userdata('localgov', $org['org_thai_name']);
                //
            }
            
            $tmp = $this->My_model->get_where_row("tb_school", array("sc_thai_name" => $row['department']));
            if(isset($tmp[id])){
                $this->session->set_userdata('sch_id', $tmp['id']);
            }
            
            
            
        }
    }

    // logout;
    public function logout() {
  
        $this->session->sess_destroy();
        redirect(site_url());
        
    }

    // เรียกส่วนจัดการระบบ (Administrator);
    public function admin_page() {
//        if ($this->session->userdata("status") == "") {
//            //redirect('login');
//        }
        $this->load->view("layout/header");
        $this->load->view("setting/admin_page");
        $this->load->view('layout/footer');
    }

    // ประเภทหน่วยนับ
    public function unit_group() {
        $data['rs'] = $this->My_model->get_all_order('tb_unit_category', 'unit_category ASC');
        $this->load->view("layout/header");
        $this->load->view("setting/unit_group", $data);
        $this->load->view('layout/footer');
    }

    // บันทึกประเภทหน่วยนับ
    public function unit_group_save() {
        $id = $_POST['id'];
        $arr = array('unit_category' => $this->input->post('inUnitGroup'));
        if ($id != "") {
            $this->My_model->update_data("tb_unit_category", array("id" => $id), $arr);
        } else {
            $this->My_model->insert_data('tb_unit_category', $arr);
        }
    }

    // edit unit group
    public function unit_group_edit() {
        $id = $_POST['id'];
        $row = $this->My_model->get_where_row("tb_unit_category", array("id" => $id));
        echo json_encode($row);
    }

    // unit group delete;
    public function unit_group_delete() {
        $id = $_POST['id'];
        $this->My_model->delete_data("tb_unit_category", array("id" => $id));
    }

    // กำหนดค่าเริ่มต้น : หน่วยนับ
    public function unit() {
        $data['category'] = $this->My_model->get_all_order("tb_unit_category", "unit_category ASC");
        $data["rs"] = $this->My_model->join2table_result('tb_unit_category a', 'tb_unit b', 'b.category_id = a.id', 'unit_name ASC');
        $this->load->view("layout/header");
        $this->load->view("setting/unit", $data);
        $this->load->view('layout/footer');
    }

    // unit save
    public function unit_save() {
        $arr = array(
            'category_id' => $this->input->post("inCategoryId"),
            "unit_name" => $this->input->post("inUnitName")
        );
        $this->My_model->insert_data("tb_unit", $arr);
    }

    // องค์กรปกครองส่วนท้องถิ่น
    // ประเภท
    public function localgov_type() {
        $data['rs'] = $this->My_model->get_all_order("tb_localgov_type", "localgov_type ASC");
        $this->load->view("layout/header");
        $this->load->view("setting/localgov_type", $data);
        $this->load->view("layout/footer");
    }

    // Insert data;
    public function localgov_type_insert() {
        $id = $_POST['id'];
        $arr = array('localgov_type' => $this->input->post('inLocalgovType'));
        if ($id != "") {
            $this->My_model->update_data("tb_localgov_type", array("id" => $id), $arr);
        } else {
            $this->My_model->insert_data('tb_localgov_type', $arr);
        }
    }

    // edit data;
    public function localgov_type_edit() {
        $id = $_POST['id'];
        $row = $this->My_model->get_where_row("tb_localgov_type", array("id" => $id));
        echo json_encode($row);
    }

    // delete data;
    public function localgov_type_delete() {
        $id = $_POST['id'];
        $this->My_model->delete_data('tb_localgov_type', array('id' => $id));
    }

    // รายละเอียดองค์กรปกครองส่วนท้องถิ่น
    public function localgov_detail() {
        $data['localgov_type'] = $this->My_model->get_all_order("tb_localgov_type", "localgov_type asc");
        $data["rs"] = $this->My_model->join2table_result('tb_localgov_type a', 'tb_localgov_detail b', 'b.localgov_type_id = a.id', 'localgov_thai_name ASC');
        $this->load->view("layout/header");
        $this->load->view("setting/localgov_detail", $data);
        $this->load->view("layout/footer");
    }

    // insert data
    public function localgov_do_insert() {
        $arr = array(
            "localgov_type_id" => $this->input->post('inLocalgovTypeId'),
            "localgov_thai_name" => $this->input->post('inLocalgovThaiName'),
            "localgov_eng_name" => $this->input->post('inLocalgovEngName'),
            "localgov_add_no" => $this->input->post('inLocalgovAddNo'),
            "localgov_add_moo" => $this->input->post('inLocalgovAddMoo'),
            "localgov_add_village" => $this->input->post('inLocalgovAddVillage'),
            "localgov_add_street" => $this->input->post('inLocalgovAddStreet'),
            "localgov_add_tambon" => $this->input->post('inLocalgovAddTambon'),
            "localgov_add_amphur" => $this->input->post('inLocalgovAddAmphur'),
            "localgov_add_province" => $this->input->post('inLocalgovAddProvince'),
            "localgov_add_zipcode" => $this->input->post('inLocalgovAddZipcode'),
            "localgov_add_telephone" => $this->input->post('inLocalgovAddTelephone'),
            "localgov_add_fax" => $this->input->post('inLocalgovAddFax'),
            "localgov_add_website" => $this->input->post('inLocalgovAddWebsite'),
            "localgov_add_email" => $this->input->post('inLocalgovAddEmail'),
            "localgov_begin_day" => $this->input->post('inLocalgovBeginDay'),
            "localgov_begin_month" => $this->input->post('inLocalgovBeginMonth'),
            "localgov_begin_year" => $this->input->post('inLocalgovBeginYear'),
            "localgov_add_lat" => $this->input->post('inLocalgovAddLat'),
            "localgov_add_long" => $this->input->post('inLocalgovAddLong')
        );
        $this->My_model->insert_data('tb_localgov_detail', $arr);
    }

    // edit
    public function localgov_edit() {
        $id = $_POST['id'];
        $rs = $this->My_model->join2table_row('tb_localgov_type a', 'tb_localgov_detail b', 'b.localgov_type_id = a.id', array('b.id' => $id));
        echo json_encode($rs);
    }

    // delete
    public function localgov_delete() {
        $id = $_POST['id'];
        $this->My_model->delete_data('tb_localgov_detail', array('id' => $id));
    }

    //detail
    public function localgov_each_detail() {
        $id = $_POST['id'];
        $rs = $this->My_model->join2table_row('tb_localgov_type a', 'tb_localgov_detail b', 'b.localgov_type_id = a.id', array('b.id' => $id));
        //
        $outp = "<h3>{$rs['localgov_thai_name']}</h3>";
        $outp .= "<table style='width:100%;font-size:1em;'>"
                . "<tr>"
                . "<td class='data-title' style='width:25%;'>ชื่อภาษาอังกฤษ</td>"
                . "<td class='data-show'>{$rs['localgov_eng_name']}</td>"
                . "</tr>"
                . "<tr>"
                . "<td class='data-title'>ที่อยู่เลขที่</td>"
                . "<td class='data-show'>{$rs['localgov_add_no']} หมู่ที่ {$rs['localgov_add_moo']}</td>"
                . "</tr>"
                . "<tr>"
                . "<td class='data-title'>หมู่บ้าน</td>"
                . "<td class='data-show'>{$rs['localgov_add_village']}</td>"
                . "</tr>"
                . "<tr>"
                . "<td class='data-title'>ถนน</td>"
                . "<td class='data-show'>{$rs['localgov_add_street']}</td>"
                . "</tr>"
                . "<tr>"
                . "<td class='data-title'>ตำบล</td>"
                . "<td class='data-show'>{$rs['localgov_add_tambon']}</td>"
                . "</tr>"
                . "<tr>"
                . "<td class='data-title'>อำเภอ</td>"
                . "<td class='data-show'>{$rs['localgov_add_amphur']}</td>"
                . "</tr>"
                . "<tr>"
                . "<td class='data-title'>จังหวัด</td>"
                . "<td class='data-show'>{$rs['localgov_add_province']}</td>"
                . "</tr>"
                . "<tr>"
                . "<td class='data-title'>รหัสไปรษณีย์</td>"
                . "<td class='data-show'>{$rs['localgov_add_zipcode']}</td>"
                . "</tr>"
                . "<tr>"
                . "<td class='data-title'>โทรศัพท์ / โทรสาร</td>"
                . "<td class='data-show'>{$rs['localgov_add_telephone']} / {$rs['localgov_add_fax']}</td>"
                . "</tr>"
                . "<tr>"
                . "<td class='data-title'>อีเมล์ / เวบไซต์</td>"
                . "<td class='data-show'>{$rs['localgov_add_email']} / {$rs['localgov_add_website']}</td>"
                . "</tr>"
                . "<tr>"
                . "<td class='data-title'>ตำแหน่งทางภูมิศาสตร์</td>"
                . "<td class='data-show'><button class='btn btn-link'>{$rs['localgov_add_lat']} / {$rs['localgov_add_long']}</button></td>"
                . "</tr>"
                . "<tr>"
                . "<td class='data-title'>วันที่ก่อตั้ง</td>"
                . "<td class='data-show'>{$rs['localgov_begin_day']} " . month_num($rs['localgov_begin_month']) . " {$rs['localgov_begin_year']}</td>"
                . "</tr>"
                . "</table>";
        //
        echo $outp;
    }

    // ประเภทเครื่องราชอิสริยาภรณ์
    public function insignia() {
        if ($this->session->userdata('status') == '') {
            //redirect('login');
        }
        //
        $data['rs'] = $this->My_model->get_all_order('tb_insignia', 'insignia_level asc');
        $this->load->view('layout/header');
        $this->load->view('setting/insignia', $data);
        $this->load->view('layout/footer');
    }

    // add data;
    public function insignia_add() {
        $id = $_POST['id'];
        if ($id != '') {
            if (!empty($_FILES["inSigniaLabelImage"]["name"])) {
                $config = array(
                    "upload_path" => "upload/",
                    "allowed_types" => "jpg|png",
                    "max_size" => 0,
                    "file_name" => md5(date("YmdHis"))
                );
                $this->upload->initialize($config);
                $this->upload->do_upload("inSigniaLabelImage");
                $data = $this->upload->data();

                $this->load->library("image_lib");
                $config['image_library'] = "gd2";
                $config["source_image"] = "upload/" . $data['file_name'];
                $config['maintain_ratio'] = TRUE;
                $config['width'] = 110;
                $config['height'] = 55;

                $this->image_lib->initialize($config);
                $this->image_lib->resize();
                $label_image = $data['file_name'];
                $arr = array('insignia_label_image' => $label_image);
                $this->My_model->update_data('tb_insignia', array('id' => $id), $arr);
            }
            //
            if (!empty($_FILES["inSigniaCoinImage"]["name"])) {
                $config = array(
                    "upload_path" => "upload/",
                    "allowed_types" => "jpg|png",
                    "max_size" => 0,
                    "file_name" => md5(date("YmdHis"))
                );
                $this->upload->initialize($config);
                $this->upload->do_upload("inSigniaCoinImage");
                $data = $this->upload->data();

                $this->load->library("image_lib");
                $config['image_library'] = "gd2";
                $config["source_image"] = "upload/" . $data['file_name'];
                $config['maintain_ratio'] = TRUE;
                $config['width'] = 600;
                $config['height'] = 500;

                $this->image_lib->initialize($config);
                $this->image_lib->resize();
                $coin_image = $data['file_name'];
                $arr = array('insignia_coin_image' => $coin_image);
                $this->My_model->update_data('tb_insignia', array('id' => $id), $arr);
            }
            //
            $arr = array(
                'insignia_level' => $this->input->post('inSigniaLevel'),
                'insignia_name' => $this->input->post('inSigniaName'),
                'insignia_comment' => $this->input->post('inSigniaComment')
            );
            $this->My_model->update_data('tb_insignia', array('id' => $id), $arr);
        } else {
            if (!empty($_FILES["inSigniaLabelImage"]["name"])) {
                $config = array(
                    "upload_path" => "upload/",
                    "allowed_types" => "jpg|png",
                    "max_size" => 0,
                    "file_name" => md5(date("YmdHis"))
                );
                $this->upload->initialize($config);
                $this->upload->do_upload("inSigniaLabelImage");
                $data = $this->upload->data();

                $this->load->library("image_lib");
                $config['image_library'] = "gd2";
                $config["source_image"] = "upload/" . $data['file_name'];
                $config['maintain_ratio'] = TRUE;
                $config['width'] = 600;
                $config['height'] = 500;

                $this->image_lib->initialize($config);
                $this->image_lib->resize();
                $label_image = $data['file_name'];
            } else {
                $label_image = "";
            }
            //
            if (!empty($_FILES["inSigniaCoinImage"]["name"])) {
                $config = array(
                    "upload_path" => "upload/",
                    "allowed_types" => "jpg|png",
                    "max_size" => 0,
                    "file_name" => md5(date("YmdHis"))
                );
                $this->upload->initialize($config);
                $this->upload->do_upload("inSigniaCoinImage");
                $data = $this->upload->data();

                $this->load->library("image_lib");
                $config['image_library'] = "gd2";
                $config["source_image"] = "upload/" . $data['file_name'];
                $config['maintain_ratio'] = TRUE;
                $config['width'] = 600;
                $config['height'] = 500;

                $this->image_lib->initialize($config);
                $this->image_lib->resize();
                $coin_image = $data['file_name'];
            } else {
                $coin_image = "";
            }
            //
            $arr = array(
                'insignia_level' => $this->input->post('inSigniaLevel'),
                'insignia_name' => $this->input->post('inSigniaName'),
                'insignia_label_image' => $label_image,
                'insignia_coin_image' => $coin_image,
                'insignia_comment' => $this->input->post('inSigniaComment')
            );
            $this->My_model->insert_data('tb_insignia', $arr);
        }
    }

    // edit data;
    public function insignia_edit() {
        $id = $_POST['id'];
        $row = $this->My_model->get_where_row('tb_insignia', array('id' => $id));
        echo json_encode($row);
    }

    // delete data;
    public function insignia_delete() {
        $id = $_POST['id'];
        $row = $this->My_model->get_where_row('tb_insignia', array('id' => $id));
        @unlink('upload/' . $row['insignia_label_image']);
        @unlink('upload/' . $row['insignia_coin_image']);
        $this->My_model->delete_data('tb_insignia', array('id' => $id));
    }

    #-------------------------------------------------------------------------
    #  กำหนดคำนำหน้าชื่อ
    #-------------------------------------------------------------------------
    //
    public function human_prefix() {
        if ($this->session->userdata('status') == '') {
            //redirect('login');
        }
        //
        $data['rs'] = $this->My_model->get_all_order('tb_human_prefix', 'prefix_name asc');
        $this->load->view("layout/header");
        $this->load->view("setting/human_prefix", $data);
        $this->load->view("layout/footer");
    }

    // insert data;
    public function add_human_prefix() {
        $id = $_POST['id'];
        $arr = array('prefix_name' => $this->input->post('inPrefixName'));
        if ($id != '') {
            $this->My_model->update_data('tb_human_prefix', array('id' => $id), $arr);
        } else {
            $this->My_model->insert_data('tb_human_prefix', $arr);
        }
    }

    // update human prefix
    public function update_human_prefix() {
        $id = $_POST['id'];
        $row = $this->My_model->get_where_row('tb_human_prefix', array('id' => $id));
        echo json_encode($row);
    }

    // delete human prefix
    public function delete_human_prefix() {
        $id = $_POST['id'];
        $this->My_model->delete_data('tb_human_prefix', array('id' => $id));
    }

    #-------------------------------------------------------------------------
    #  ประเภทและข้อมูลโรงเรียน
    #-------------------------------------------------------------------------
    // ประเภทบุคลากร

    public function human_resources_type() {
        $data['rs'] = $this->My_model->get_all_order('tb_human_resources_type', 'human_resources_type asc');
        $this->load->view('layout/header');
        $this->load->view('setting/human_resources_type', $data);
        $this->load->view('layout/footer');
    }

    // add data;
    public function human_resources_type_add() {
        $id = $_POST['id'];
        $arr = array('human_resources_type' => $this->input->post('inHrType'));
        if ($id != '') {
            $this->My_model->update_data('tb_human_resources_type', array('id' => $id), $arr);
        } else {
            $this->My_model->insert_data('tb_human_resources_type', $arr);
        }
    }

    // edit data;
    public function human_resources_type_edit() {
        $id = $_POST['id'];
        $row = $this->My_model->get_where_row('tb_human_resources_type', array('id' => $id));
        echo json_encode($row);
    }

    // delete data;
    public function human_resources_type_delete() {
        $id = $_POST['id'];
        $this->My_model->delete_data('tb_human_resources_type', array('id' => $id));
    }

    #-------------------------------------------------------------------------
    #  ประเภทและข้อมูลโรงเรียน
    #-------------------------------------------------------------------------
    //
    
    // ประเภทสถานศึกษา
    public function school_type() {
        $data['rs'] = $this->My_model->get_all_order("tb_school_type", "school_type asc");
        $this->load->view("layout/header");
        $this->load->view("setting/school_type", $data);
        $this->load->view("layout/footer");
    }

    // insert data;
    public function school_type_insert() {
        $id = $_POST['id'];
        $arr = array("school_type" => $this->input->post("inSchoolType"));
        //
        if ($id != "") {
            $this->My_model->update_data("tb_school_type", array("id" => $id), $arr);
        } else {
            $this->My_model->insert_data("tb_school_type", $arr);
        }
    }

    // edit data;
    public function school_type_edit() {
        $id = $_POST['id'];
        $row = $this->My_model->get_where_row("tb_school_type", array("id" => $id));
        echo json_encode($row);
    }

    // delete school type data;
    public function school_type_delete() {
        $id = $_POST['id'];
        $this->My_model->delete_data("tb_school_type", array("id" => $id));
    }

    // ข้อมูลโรงเรียน
    public function school() {
        $data['school_type'] = $this->My_model->get_all_order('tb_school_type', 'school_type asc');
        $data['rs'] = $this->Setting_model->get_school();
        $this->load->view("layout/header");
        $this->load->view("setting/school", $data);
        $this->load->view("layout/footer");
    }

    // save school's data;
    public function do_insert_school() {
        $id = $_POST['id'];
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
    }

    // edit data;
    public function update_school() {
        $id = $_POST['id'];
        $row = $this->My_model->join2table_row('tb_school_type a', 'tb_school b', 'b.school_type_id = a.id', array('b.id' => $id));
        echo json_encode($row);
    }

    // delete school;
    public function delete_school() {
        $id = $_POST['id'];
        echo $id;
        die();
        $this->My_model->delete_data("tb_school", array("id" => $id));
    }

    #-------------------------------------------------------------------------
    #
    #  ประเภทเอกสาร (document-type)
    #
    #-------------------------------------------------------------------------

    public function document_type() {
        $data['rs'] = $this->My_model->get_all_order("tb_document_type", "document_type asc");
        $this->load->view("layout/header");
        $this->load->view("setting/document_type", $data);
        $this->load->view("layout/footer");
    }

    // insert document type
    public function document_type_insert() {
        $id = $_POST['id'];
        $arr = array("document_type" => $this->input->post('inDocumentType'));
        if ($id != "") {
            $this->My_model->update_data("tb_document_type", array("id" => $id), $arr);
        } else {
            $this->My_model->insert_data('tb_document_type', $arr);
        }
    }

    // update document type
    public function document_type_edit() {
        $id = $_POST['id'];
        $row = $this->My_model->get_where_row("tb_document_type", array("id" => $id));
        echo json_encode($row);
    }

    #-------------------------------------------------------------------------
    #
    #  กำหนดผู้อำนวยการโรงเรียน
    #
    #-------------------------------------------------------------------------

    public function school_director() {
        $data['school'] = $this->My_model->get_all_order("tb_school", "sc_thai_name asc");
        $data['human'] = $this->My_model->get_all_order('tb_human_resources_01', 'hr_thai_name asc');
        $data['rs'] = $this->Setting_model->school_director();
        $this->load->view("layout/header");
        $this->load->view("setting/school_director", $data);
        $this->load->view("layout/footer");
    }

    // บันทึกผู้อำนวยการโรงเรียน
    public function school_director_insert() {
        $id = $_POST['id'];
        $arr = array(
            "hr_id" => $this->input->post("inHrId"),
            "school_id" => $this->input->post("inSchoolId")
        );
        if ($id != "") {
            $this->My_model->update_data('tb_school_director', array("id" => $id), $arr);
        } else {
            $this->My_model->insert_data("tb_school_director", $arr);
        }
    }

    // แก้ไขข้อมูลผู้ดำนวยการโรงเรียน
    public function school_director_edit() {
        $id = $_POST['id'];
        $row = $this->Setting_model->get_school_director_row($id);
        echo json_encode($row);
    }

    // ลบข้อมุลผู้อำนวยการโรงเรียน
    public function school_director_delete() {
        $id = $_POST['id'];
        $this->My_model->delete_data("tb_school_director", array("id" => $id));
    }

    #-------------------------------------------------------------------------
    #
    #  ข้อมูลผู้ใช้งานระบบ
    #
    #-------------------------------------------------------------------------
    //
    // ข้อมูลผู้ใช้งานระบบ

    public function member() {
        if ($this->session->userdata("status") != "ผู้ดูแลระบบ") {
//            redirect("login");
        }
        $data['res'] = $this->My_model->get_all_order("tb_responsible", "responsible asc");
        $data['school'] = $this->My_model->get_all_order("tb_school", "sc_code asc");
        $data['inside_office'] = $this->My_model->get_all_order("tb_inside_office", "inside_office");
        $data['rs'] = $this->My_model->get_all_order("tb_member", "member_name ASC");
        $this->load->view("layout/header");
        $this->load->view("setting/member", $data);
        $this->load->view("layout/footer");
    }

    // insert data;
    public function member_insert() {
        $id = $_POST['id'];
        $arr = array(
            "member_name" => $this->input->post("inMemberName"),
            "member_lastname" => $this->input->post("inMemberLastname"),
            "member_email" => $this->input->post("inMemberEmail"),
            "member_mobile" => $this->input->post("inMemberMobile"),
            "username" => $this->input->post("inUsername"),
            "password" => $this->input->post("inPassword"),
            "status" => $this->input->post("inStatus"),
            "activate" => $this->input->post("inActivate"),
            'responsible' => "",
            "department" => $this->input->post("inDepartment"),
            'division' => ''
        );
        if ($id != "") {
            $this->My_model->update_data('tb_member', array('id' => $id), $arr);
        } else {
            $this->My_model->insert_data("tb_member", $arr);
        }
    }

    // edit data;
    public function member_edit() {
        $id = $_POST['id'];
        $row = $this->My_model->get_where_row("tb_member", array("id" => $id));
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

    // กำหนดตำแหน่ง
    public function rank() {
        $data['rs'] = $this->My_model->get_all_order('tb_rank', 'rank_name asc');
        $this->load->view('layout/header');
        $this->load->view('setting/rank', $data);
        $this->load->view('layout/footer');
    }

    // insert rank
    public function rank_add() {
        $id = $_POST['id'];
        $arr = array('rank_name' => $this->input->post('inRankName'));
        if ($id != '') {
            $this->My_model->update_data('tb_rank', array('id' => $id), $arr);
        } else {
            $this->My_model->insert_data('tb_rank', $arr);
        }
    }

    // push rank data for edit
    public function rank_edit() {
        $id = $_POST['id'];
        $row = $this->My_model->get_where_row('tb_rank', array('id' => $id));
        echo json_encode($row);
    }

    // delete rank data
    public function rank_delete() {
        $id = $_POST['id'];
        $this->My_model->delete_data('tb_rank', array('id' => $id));
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
        $data['rs'] = $this->Setting_model->get_member_data_define();
        $this->load->view('setting/reports/member_report', $data);
    }

    // กำหนดงานให้แต่ละผู้ใช้งานระบบ
    public function member_activities($id) {
        $data['member'] = $this->My_model->get_where_row('tb_member', array('id' => $id));

        $dept = $data['member']['department'];

        $data['rs'] = $this->My_model->get_where_order('tb_data_define', array('department' => $dept), 'id asc');
        $this->load->view('layout/header');
        $this->load->view('setting/member_activities', $data);
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
        redirect('define-member-activities/' . $member_id);
    }

    // delete member activities
    public function delete_member_activities() {
        $id = $_POST['id'];
        $this->My_model->delete_data('tb_member_activities', array('id' => $id));
    }

    // กำหนดกลุ่มข้อมูลสำหรับผู้ใช้งาน
    public function data_define() {
        if ($this->session->userdata('status') != 'ผู้ดูแลระบบ') {
            //redirect('login');
        }
        //
        $data['group'] = $this->My_model->get_all_order('tb_division', 'id asc');
        $data['rs'] = $this->My_model->get_where_order('tb_data_define', array('department' => $this->session->userdata('department')),  'data_group asc, data_name asc');
        $this->load->view('layout/header');
        $this->load->view('setting/data_define', $data);
        $this->load->view('layout/footer');
    }

    // insert data define
    public function insert_data_define() {
        $id = $_POST['id'];
        $arr = array(
            'data_group' => $this->input->post('inDataGroup'),
            'data_name' => $this->input->post('inDataName'),
            'data_address' => $this->input->post('inDataAddress'),
            'department' => $this->session->userdata('department')
        );
        if ($id != '') {
            $this->My_model->update_data('tb_data_define', array('id' => $id), $arr);
        } else {
            $this->My_model->insert_data('tb_data_define', $arr);
        }
    }

    // update data define
    public function update_data_define() {
        $id = $_POST['id'];
        $row = $this->My_model->get_where_row('tb_data_define', array('id' => $id));
        echo json_encode($row);
    }

    // delete data define;
    public function delete_data_define() {
        $id = $_POST['id'];
        $this->My_model->delete_data('tb_data_define', array('id' => $id));
    }

    // print data
    public function print_data_define() {
        $data['rs'] = $this->My_model->get_all_order('tb_data_define', 'data_group asc, data_name asc');
        $this->load->view('setting/reports/print_data', $data);
    }

    #-------------------------------------------------------------------------
    #
    #  ข้อมูลหน่วยงานภายใน
    #
    #-------------------------------------------------------------------------

    //
    public function inside_office() {
        $data['rs'] = $this->My_model->get_all_order("tb_inside_office", "inside_office asc");
        $this->load->view("layout/header");
        $this->load->view("setting/inside_office", $data);
        $this->load->view("layout/footer");
    }

    // inside office insert
    public function inside_office_insert() {
        $id = $_POST['id'];
        $arr = array("inside_office" => $this->input->post("inInsideOffice"));
        if ($id != "") {
            $this->My_model->update_data("tb_inside_office", array("id" => $id), $arr);
        } else {
            $this->My_model->insert_data("tb_inside_office", $arr);
        }
    }

    // edit inside office
    public function inside_office_edit() {
        $id = $_POST['id'];
        $row = $this->My_model->get_where_row("tb_inside_office", array("id" => $id));
        echo json_encode($row);
    }

    // delete inside office data;
    public function inside_office_delete() {
        $id = $_POST['id'];
        $this->My_model->delete_data("tb_inside_office", array("id" => $id));
    }

    #-------------------------------------------------------------------------
    #
    #  ข้อมูลหน้าที่รับผิดชอบ
    #
    #-------------------------------------------------------------------------

    //
    public function responsible() {
        $data['rs'] = $this->My_model->get_all_order("tb_responsible", "responsible asc");
        $this->load->view("layout/header");
        $this->load->view("setting/responsible", $data);
        $this->load->view("layout/footer");
    }

    //
    public function add_responsible_data() {
        $id = $_POST['id'];
        $arr = array('responsible' => $this->input->post("inResponsible"));
        if ($id != "") {
            $this->My_model->update_data("tb_responsible", array("id" => $id), $arr);
        } else {
            $this->My_model->insert_data('tb_responsible', $arr);
        }
    }

    // update responsible
    public function edit_responsible_data() {
        $id = $_POST['id'];
        $row = $this->My_model->get_where_row("tb_responsible", array("id" => $id));
        echo json_encode($row);
    }

    // delete responsible
    public function delete_responsible_data() {
        $id = $_POST["id"];
        $this->My_model->delete_data("tb_responsible", array("id" => $id));
    }

    #-------------------------------------------------------------------------
    #   ข้อมูลรายวิชา
    #   Suject detail
    #   December 18, 2018
    #-------------------------------------------------------------------------
    //    

    public function subject_detail() {
        $data['learning_group'] = $this->My_model->get_all_order('tb_education_learning_group', 'education_group_no asc');
        $data['level'] = $this->My_model->get_all_order('tb_education_level', 'education_level asc');
        $data['rs'] = $this->Setting_model->get_subject_detail();
        $this->load->view('layout/header');
        $this->load->view('setting/subject_detail', $data);
        $this->load->view('layout/footer');
    }

    // insert data;
    public function subject_detail_add() {
        $id = $_POST['id'];
        $arr = array(
            'subject_code' => $this->input->post('inSubjectCode'),
            'subject_name' => $this->input->post('inSubjectName'),
            'level_id' => $this->input->post('inLevelId'),
            'learning_group_id' => $this->input->post('inLearningGroupId'),
            'subject_detail' => $this->input->post('inSubjectDetail')
        );
        if ($id != '') {
            $this->My_model->update_data('tb_subject_detail', array('id' => $id), $arr);
        } else {
            $this->My_model->insert_data('tb_subject_detail', $arr);
        }
    }

    // edit data;
    public function subject_detail_edit() {
        $id = $_POST['id'];
        $row = $this->My_model->get_where_row('tb_subject_detail', array('id' => $id));
        echo json_encode($row);
    }

    // delete data
    public function subject_detail_delete() {
        $id = $_POST['id'];
        $this->My_model->delete_data('tb_subject_detail', array('id' => $id));
    }

    #-------------------------------------------------------------------------
    #   กำหนดชั้นเรียน
    #   Education Level
    #   December 18, 2018
    #-------------------------------------------------------------------------
    //    

    public function education_level() {
        $data['level_type'] = $this->My_model->get_all_order('tb_education_level_type', 'level_type asc');
        $data['rs'] = $this->My_model->join2table_result('tb_education_level_type a', 'tb_education_level b', 'b.level_type_id = a.id', 'education_level asc');
        $this->load->view('layout/header');
        $this->load->view('setting/education_level', $data);
        $this->load->view('layout/footer');
    }

    // add data;
    public function education_level_add() {
        $id = $_POST['id'];
        $arr = array(
            'level_type_id' => $this->input->post('inLevelTypeId'),
            'education_level' => $this->input->post('inEducationLevel'),
            'education_level_description' => $this->input->post('inEducationLevelDescription')
        );
        if ($id != '') {
            $this->My_model->update_data('tb_education_level', array('id' => $id), $arr);
        } else {
            $this->My_model->insert_data('tb_education_level', $arr);
        }
    }

    // edit data;
    public function education_level_edit() {
        $id = $_POST['id'];
        $row = $this->My_model->join2table_row('tb_education_level_type a', 'tb_education_level b', 'b.level_type_id = a.id', array('b.id' => $id));
        echo json_encode($row);
    }

    // delete data;
    public function education_level_delete() {
        $id = $_POST['id'];
        $this->My_model->delete_data('tb_education_level', array('id' => $id));
    }

    #-------------------------------------------------------------------------
    #   กำหนดประเภท
    #   Education Level Type
    #   December 18, 2018
    #-------------------------------------------------------------------------
    //    

    public function education_level_type() {
        $data['rs'] = $this->My_model->get_all_order('tb_education_level_type', 'level_type asc');
        $this->load->view('layout/header');
        $this->load->view('setting/education_level_type', $data);
        $this->load->view('layout/footer');
    }

    // add data;
    public function education_level_type_add() {
        $id = $_POST['id'];
        $arr = array(
            'level_type' => $this->input->post('inLevelType'),
            'level_type_description' => $this->input->post('inLevelTypeDescription')
        );
        if ($id != '') {
            $this->My_model->update_data('tb_education_level_type', array('id' => $id), $arr);
        } else {
            $this->My_model->insert_data('tb_education_level_type', $arr);
        }
    }

    // edit data;
    public function education_level_type_edit() {
        $id = $_POST['id'];
        $row = $this->My_model->get_where_row('tb_education_level_type', array('id' => $id));
        echo json_encode($row);
    }

    // delete data;
    public function education_level_type_delete() {
        $id = $_POST['id'];
        $this->My_model->delete_data('tb_education_level_type', array('id' => $id));
    }

    #-------------------------------------------------------------------------
    #   กลุ่มสาระการเรียนรู่้
    #   Education Group
    #   December 18, 2018
    #-------------------------------------------------------------------------
    //    

    public function education_group() {
        //$data['rs'] = $this->My_model->get_all_order('tb_education_learning_group', 'education_group_no asc');
        $data['edYear'] = $this->Edutech_model->get_distinct_col_where('tb_group_learning', 'ed_year', '1=1');
        $data['rs'] = $this->My_model->get_all_order('tb_group_learning', 'ed_year,tb_group_learning_seq asc');
        $this->load->view('layout/header');
        $this->load->view('setting/education_group', $data);
        $this->load->view('layout/footer');
    }

    public function education_group_list() {


        $edYear = $this->input->post('edYear');
        if ($edYear != '0') {
            $rs = $this->My_model->get_where_order('tb_group_learning', array('ed_year' => $edYear), 'tb_group_learning_seq asc');

            $output = "<tr>";
            $output .= "<td style=\"border-right:none;\"></td>";
            $output .= "<td style=\"font-weight: bold;\" colspan=\"3\">พุทธศักราช " . $edYear . "</td>";
            $output .= "<td style=\"display:none;\"></td>";
            if ($this->session->userdata("status") == "ผู้ดูแลระบบ"):
                $output .= "<td style=\"display:none;\"></td>";
            endif;
            $output .= "</tr>";
            foreach ($rs as $r) {
                $output .= "<tr>";
                $output .= "<td style=\"text-align:center;\">" . $r['tb_group_learning_seq'] . "</td>";
                $output .= "<td>" . $r['tb_group_learningcol_name'] . "</td>";
                $output .= "<td>" . $r['tb_group_learning_code'] . "</td>";
                if ($this->session->userdata("status") == "ผู้ดูแลระบบ"):
                    $output .= "<td style=\"text-align:center;border-right:none;\">";
                    $output .= "<button type=\"button\" class=\"btn btn-warning btn-edit\" id=\"" . $r['id'] . "\"><i class=\"icon-pencil icon-large\"></i> แก้ไข</button>";
                    $output .= "<button type=\"button\" class=\"btn btn-danger btn-delete\" id=\"" . $r['id'] . "\"><i class=\"icon-trash icon-large\"></i> ลบ</button>";
                    $output .= "</td>";
                endif;
                $output .= "</tr>";
            }
        }else{
            $output = "";
            $rs = $this->My_model->get_all_order('tb_group_learning', 'ed_year,tb_group_learning_seq asc');
            $tmp = "";

            foreach ($rs as $r) {
                if ($tmp != $r['ed_year']) {
                    $tmp = $r['ed_year'];
                    $output .= "<tr>";
                    $output .= "<td style=\"border-right:none;\"></td>";
                    $output .= "<td style=\"font-weight: bold;\" colspan=\"3\">พุทธศักราช " . $r['ed_year'] . "</td>";
                    $output .= "<td style=\"display:none;\"></td>";
                    if ($this->session->userdata("status") == "ผู้ดูแลระบบ"){
                        $output .= "<td style=\"display:none;\"></td>";
                    }
                    $output .= "</tr>";
                }
                $output .= "<tr>";
                $output .= "<td style=\"text-align:center;\">" . $r['tb_group_learning_seq'] . "</td>";
                $output .= "<td>" . $r['tb_group_learningcol_name'] . "</td>";
                $output .= "<td>" . $r['tb_group_learning_code'] . "</td>";
                if ($this->session->userdata("status") == "ผู้ดูแลระบบ"){
                    $output .= "<td style=\"text-align:center;border-right:none;\">";
                    $output .= "<button type=\"button\" class=\"btn btn-warning btn-edit\" id=\"" . $r['id'] . "\"><i class=\"icon-pencil icon-large\"></i> แก้ไข</button>";
                    $output .= "<button type=\"button\" class=\"btn btn-danger btn-delete\" id=\"" . $r['id'] . "\"><i class=\"icon-trash icon-large\"></i> ลบ</button>";
                    $output .= "</td>";
                }
                $output .= "</tr>";
            }
        }
        echo $output;
    }

    // add data;
    public function education_group_add() {
        $id = $_POST['id'];
        $arr = array(
            'tb_group_learning_seq' => $this->input->post('inEducationGroupNo'),
            'tb_group_learning_code' => $this->input->post('inEducationGroupCode'),
            'tb_group_learningcol_name' => $this->input->post('inEducationGroupName'),
            'ed_year' => $this->input->post('inEdYear')
        );
        if ($id != '') {
            $this->My_model->update_data('tb_group_learning', array('id' => $id), $arr);
        } else {
            $this->My_model->insert_data('tb_group_learning', $arr);
        }
//        $arr = array(
//            'education_group_no' => $this->input->post('inEducationGroupNo'),
//            'education_group_name' => $this->input->post('inEducationGroupName')
//        );
//        if ($id != '') {
//            $this->My_model->update_data('tb_education_learning_group', array('id' => $id), $arr);
//        } else {
//            $this->My_model->insert_data('tb_education_learning_group', $arr);
//        }
    }

    // edit data;
    public function education_group_edit() {
        $id = $_POST['id'];
//        $row = $this->My_model->get_where_row('tb_education_learning_group', array('id' => $id));
        $row = $this->My_model->get_where_row('tb_group_learning', array('id' => $id));
        echo json_encode($row);
    }

    // delete data;
    public function education_group_delete() {
        $id = $_POST['id'];
//        $this->My_model->delete_data('tb_education_learning_group', array('id' => $id));
        $this->My_model->delete_data('tb_group_learning', array('id' => $id));
    }

    #---------------+---------------------------------------------------------------
    #   Title       |   Carousel Setting (กำหนดภาพสไลด์)
    #---------------+---------------------------------------------------------------
    #   Author      |   Mr.Hidemi Minakawa
    #   Date        |   07/01/2019
    #   Last Update |
    #---------------+---------------------------------------------------------------
    //    

    public function carousel_setting() {
        if ($this->session->userdata('status') != 'ผู้ดูแลระบบ') {
            redirect(site_url());
        }
        //

        $data['rs'] = $this->My_model->get_all_order('tb_carousel', 'id asc');
        $this->load->view('layout/header');
        $this->load->view('setting/carousel_setting', $data);
        $this->load->view('layout/footer');
    }

    // insert data;
    public function carousel_setting_add() {
        $config = array(
            "upload_path" => "upload/carousel/",
            "allowed_types" => "jpg|png",
            "max_size" => 0,
            "file_name" => md5(date("YmdHis"))
        );
        $this->upload->initialize($config);
        $this->upload->do_upload("inCarouselName");
        $data = $this->upload->data();

        $this->load->library("image_lib");
        $config['image_library'] = "gd2";
        $config["source_image"] = "upload/carousel/" . $data['file_name'];
        $config['maintain_ratio'] = TRUE;
        $config['width'] = 1075;

        $this->image_lib->initialize($config);
        $this->image_lib->resize();
        //
        $arr = array('carousel_name' => $data['file_name']);
        $this->My_model->insert_data('tb_carousel', $arr);
    }

    // delete data;
    public function carousel_setting_delete() {
        $id = $_POST['id'];
        $row = $this->My_model->get_where_row('tb_carousel', array('id' => $id));
        @unlink('upload/carousel/' . $row['carousel_name']);
        $this->My_model->delete_data('tb_carousel', array('id' => $id));
    }

}
