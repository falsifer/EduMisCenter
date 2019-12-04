<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/*
  | ----------------------------------------------------------------------------
  |  Title--> Human Resources
  | ----------------------------------------------------------------------------
  | Copyright
  | Purpose     การบริหารงานบุคลากร
  | Author	Mr.Hidemi Minakawa
  | Create Date
  | Last edit	-
  | Comment	-
  | ----------------------------------------------------------------------------
 */

class Human_resources extends CI_Controller {

    public function __construct() {
        parent::__construct();
        if ($this->session->userdata('status') == "") {
            redirect("/");
        }
        $this->load->model('Hr_model');
        $this->load->model('My_model');
    }

    //
    public function index() {
        $data['tbDivision'] = $this->My_model->get_all('tb_division');
        $data['tbGroupLearning'] = $this->My_model->get_all('tb_group_learning');
        $data['tbHrDegree'] = $this->My_model->get_all('tb_hr_degree');

        $data['rank'] = $this->My_model->get_all_order('tb_rank', 'rank_name asc');
        $data['school'] = $this->My_model->get_all_order('tb_school', 'sc_thai_name asc');
        $data['hr_type'] = $this->My_model->get_all_order('tb_human_resources_type', 'human_resources_type asc');
        $data['rs'] = $this->Hr_model->get_hr();
        $this->load->view("layout/header");
        $this->load->view("human_resources/index", $data);
        $this->load->view("layout/footer");
    }

    // save human_resources data;
    public function insert_hr_01() {
        $id = $_POST['id'];
        if ($id != '') {
            if ($_FILES['inHrImage']['name'] != '') {
                $row = $this->My_model->get_where_row('tb_human_resources_01', array('id' => $id));
                @unlink('upload/' . $row['hr_image']);
                //
                $config = array(
                    "upload_path" => "upload/",
                    "allowed_types" => "jpg|png",
                    "max_size" => 0,
                    "file_name" => md5(date("YmdHis"))
                );
                $this->upload->initialize($config);
                $this->upload->do_upload("inHrImage");
                $data = $this->upload->data();

                $this->load->library("image_lib");
                $config['image_library'] = "gd2";
                $config["source_image"] = "upload/" . $data['file_name'];
                $config['maintain_ratio'] = TRUE;
                $config['width'] = 600;
                $config['height'] = 500;

                $this->image_lib->initialize($config);
                $this->image_lib->resize();
                $arr = array('hr_image' => $data['file_name']);
                $this->My_model->update_data('tb_human_resources_01', array('id' => $id), $arr);
            }
            //
            $arr = array(
                'hr_type_id' => $this->input->post('inHrTypeId'),
                //--- Chairatto
                'hr_degree' => $this->input->post('inHrDegree'),
                'hr_group_learning' => $this->input->post('inHrGroupLearning'),
                'hr_group_learning_class' => $this->input->post('inHrGroupLearningClass'),
                'hr_division' => $this->input->post('inHrDivision'),
                'hr_division_class' => $this->input->post('inHrDivisionClass'),
                //--- End
                "hr_thai_symbol" => $this->input->post('inHrThaiSymbol'),
                "hr_thai_name" => $this->input->post('inHrThaiName'),
                "hr_thai_lastname" => $this->input->post('inHrThaiLastname'),
                "hr_eng_symbol" => $this->input->post("inHrEngSymbol"),
                "hr_eng_name" => $this->input->post('inHrEngName'),
                "hr_eng_lastname" => $this->input->post('inHrEngLastname'),
                "hr_id_card" => $this->input->post('inHrIdCard'),
                "hr_blood_group" => $this->input->post('inHrBloodGroup'),
                "hr_day_birthday" => $this->input->post('inHrDayBirthday'),
                "hr_month_birthday" => $this->input->post('inHrMonthBirthday'),
                "hr_year_birthday" => $this->input->post('inHrYearBirthday'),
                "hr_nationality" => $this->input->post('inHrNationality'),
                "hr_origin" => $this->input->post('inHrOrigin'),
                "hr_religion" => $this->input->post('inHrReligion'),
                "hr_status" => $this->input->post('inHrStatus'),
                "hr_consort_name" => $this->input->post('inHrConsortName'),
                "hr_son_amount" => $this->input->post('inHrSonAmount'),
                "hr_daugther_amount" => $this->input->post('inHrDaugtherAmount'),
                "hr_father_name" => $this->input->post('inHrFatherName'),
                "hr_mother_name" => $this->input->post('inHrMotherName'),
                "hr_mobile" => $this->input->post("inHrMobile"),
                "hr_email" => $this->input->post("inHrEmail"),
                'hr_office' => $this->input->post('inHrOffice'),
                'hr_rank' => $this->input->post('inHrRank'),
                'salary' => $this->input->post('inSalary'),
                'hr_level' => $this->input->post('inHrLevel'),
                "hr_recorder" => $this->session->userdata('name'),
                'hr_department' => $this->session->userdata('department')
            );
            $this->My_model->update_data('tb_human_resources_01', array('id' => $id), $arr);
        } else {
            if ($_FILES['inHrImage']['name'] != "") {
                $config = array(
                    "upload_path" => "upload/",
                    "allowed_types" => "jpg|png",
                    "max_size" => 0,
                    "file_name" => md5(date("YmdHis"))
                );
                $this->upload->initialize($config);
                $this->upload->do_upload("inHrImage");
                $data = $this->upload->data();

                $this->load->library("image_lib");
                $config['image_library'] = "gd2";
                $config["source_image"] = "upload/" . $data['file_name'];
                $config['maintain_ratio'] = TRUE;
                $config['width'] = 600;
                $config['height'] = 500;

                $this->image_lib->initialize($config);
                $this->image_lib->resize();
                $filename = $data['file_name'];
            } else {
                $filename = "";
            }
            $arr = array(
                'hr_type_id' => $this->input->post('inHrTypeId'),
                //--- Chairatto
                'hr_degree' => $this->input->post('inHrDegree'),
                'hr_group_learning' => $this->input->post('inHrGroupLearning'),
                'hr_group_learning_class' => $this->input->post('inHrGroupLearningClass'),
                'hr_division' => $this->input->post('inHrDivision'),
                'hr_division_class' => $this->input->post('inHrDivisionClass'),
                //--- End
                "hr_thai_symbol" => $this->input->post('inHrThaiSymbol'),
                "hr_thai_name" => $this->input->post('inHrThaiName'),
                "hr_thai_lastname" => $this->input->post('inHrThaiLastname'),
                "hr_eng_symbol" => $this->input->post("inHrEngSymbol"),
                "hr_eng_name" => $this->input->post('inHrEngName'),
                "hr_eng_lastname" => $this->input->post('inHrEngLastname'),
                "hr_id_card" => $this->input->post('inHrIdCard'),
                "hr_blood_group" => $this->input->post('inHrBloodGroup'),
                "hr_day_birthday" => $this->input->post('inHrDayBirthday'),
                "hr_month_birthday" => $this->input->post('inHrMonthBirthday'),
                "hr_year_birthday" => $this->input->post('inHrYearBirthday'),
                "hr_nationality" => $this->input->post('inHrNationality'),
                "hr_origin" => $this->input->post('inHrOrigin'),
                "hr_religion" => $this->input->post('inHrReligion'),
                "hr_status" => $this->input->post('inHrStatus'),
                "hr_consort_name" => $this->input->post('inHrConsortName'),
                "hr_son_amount" => $this->input->post('inHrSonAmount'),
                "hr_daugther_amount" => $this->input->post('inHrDaugtherAmount'),
                "hr_father_name" => $this->input->post('inHrFatherName'),
                "hr_mother_name" => $this->input->post('inHrMotherName'),
                "hr_mobile" => $this->input->post("inHrMobile"),
                "hr_email" => $this->input->post("inHrEmail"),
                "hr_image" => $filename,
                "hr_recorder" => $this->session->userdata('name'),
                'hr_department' => $this->session->userdata('department')
            );
            $insert_id = $this->My_model->insert_data('tb_human_resources_01', $arr);
        }
    }

    // update human resources part 1;
    public function update_hr_01() {
        $id = $_POST['id'];
        $row = $this->My_model->get_where_row('tb_human_resources_01', array('id' => $id));
        echo json_encode($row);
    }

    // Delete human resources;
    public function delete_hr_01() {
        $id = $_POST['id'];

        //--- ลบก่อน
        $this->My_model->delete_data('tb_assessment_personal_result', array('tb_hr_id' => $id));


        $row = $this->My_model->delete_data('tb_human_resources_01', array('id' => $id));


        @unlink('upload/' . $row['hr_image']);
        $this->My_model->delete_data('tb_human_resources_01', array('id' => $id));
    }

    // print data
    public function print_hr_01($id) {
        $data['rs'] = $this->My_model->get_where_row('tb_human_resources_01', array('id' => $id));
        $data['hr02'] = $this->My_model->get_where_row('tb_human_resources_02', array('hr_id' => $id));
        $data['hr03'] = $this->My_model->join2table_result('tb_human_prefix a', 'tb_human_resources_03 b', 'b.prefix_id = a.id', 'b.hr03_name asc');
        $data['hr15'] = $this->My_model->get_where_order("tb_human_resources_15", array("hr_id" => $id), "edu_year asc"); // ประวัติการศึกษา
        $data['hr05'] = $this->My_model->get_where_order("tb_human_resources_05", array("hr_id" => $id), "hr05_year asc"); // ประวัติการรับราชการ
        // ประวัติการปฏิบัติงาน
        $data['human_resources_04'] = $this->My_model->get_where_order('tb_human_resources_04', array('hr_id' => $id), 'hr04_year asc');
        // ประวัติการสอน
        $data['human_resources_06'] = $this->My_model->get_where_order('tb_human_resources_06', array('hr_id' => $id), 'hr06_loanyear');


        $this->load->view('human_resources/reports/hr_01_report', $data);
    }

    #--------------------------------------------------------------------------
    # Human Resources Part 02
    # ข้อมูลที่อยู่
    #--------------------------------------------------------------------------

    public function hr02($id) {
        // ดึงข้อมูลจาก hr01 เพื่อนำไปแสดงส่วนหัวของบล็อก
        $data['hr'] = $this->My_model->get_where_row('tb_human_resources_01', array('id' => $id));
        // ตรวจสอบข้อมูลที่อยู่ว่ามีอยู่หรือไม่ถ้ามีให้นำไปแก้ไขถ้าไม่มีให้เพิ่ม
        $hr02 = $this->My_model->get_where_row('tb_human_resources_02', array('hr_id' => $id));
        $data['rs'] = $hr02;

        if (!isset($hr02['id'])) {
            $hr_id = $this->uri->segment(2);
            $arr = array(
//                'hr_id' => $this->session->userdata('hr_id'),
                'hr_id' => $hr_id = $hr_id,
            );
             if (count($hr02) < 1) {
                $this->My_model->insert_data('tb_human_resources_02', $arr);
            }
        }

        $this->load->view("layout/header");
        $this->load->view("human_resources/hr02", $data);
        $this->load->view("layout/footer");
    }

    // insert data;
    public function hr02_insert() {
        $hr_id = $this->input->post('hr_id');
//        $id = $this->input->post('id');

        $arr = array(
//            'hr_id' => $hr_id,
            'hr_address_no' => $this->input->post('inHrAddressNo'),
            'hr_address_moo' => $this->input->post('inHrAddressMoo'),
            'hr_address_village' => $this->input->post('inHrAddressVillage'),
            'hr_address_soi' => $this->input->post('inHrAddressSoi'),
            'hr_address_building' => $this->input->post('inHrAddressBuilding'),
            'hr_address_street' => $this->input->post('inHrAddressStreet'),
            'hr_address_tambon' => $this->input->post('inHrAddressTambon'),
            'hr_address_amphur' => $this->input->post('inHrAddressAmphur'),
            'hr_address_province' => $this->input->post('inHrAddressProvince'),
            'hr_address_zipcode' => $this->input->post('inHrAddressZipcode'),
            'hr_address_telephone' => $this->input->post('inHrAddressTelephone'),
            'hr_address_lat' => $this->input->post('inHrAddressLat'),
            'hr_address_long' => $this->input->post('inHrAddressLong'),
            'tmp_address_no' => $this->input->post('inTmpAddressNo'),
            'tmp_address_moo' => $this->input->post('inTmpAddressMoo'),
            'tmp_address_village' => $this->input->post('inTmpAddressVillage'),
            'tmp_address_soi' => $this->input->post('inTmpAddressSoi'),
            'tmp_address_street' => $this->input->post('inTmpAddressStreet'),
            'tmp_address_tambon' => $this->input->post('inTmpAddressTambon'),
            'tmp_address_amphur' => $this->input->post('inTmpAddressAmphur'),
            'tmp_address_province' => $this->input->post('inTmpAddressProvince'),
            'tmp_address_zipcode' => $this->input->post('inTmpAddressZipcode'),
            'tmp_address_telephone' => $this->input->post('inTmpAddressTelephone'),
            'tmp_address_lat' => $this->input->post('inTmpAddressLat'),
            'tmp_address_long' => $this->input->post('inTmpAddressLong')
        );

//        if ($id != "") {
        $this->My_model->update_data('tb_human_resources_02', array('hr_id' => $hr_id), $arr);
//        } else {
//            $this->My_model->insert_data('tb_human_resources_02', $arr);
//        }
    }

    // ลบข้อมูลที่อยู่บุคลากร
    public function hr02_delete() {
        $id = $_POST['id'];
        $this->My_model->delete_data('tb_human_resources_02', array('id' => $id));
    }

    // พิมพ์ข้อมูล
    public function hr02_print($id) {
        $data['human'] = $this->My_model->get_where_row('tb_human_resources_01', array('id' => $id));
        $data['rs'] = $this->My_model->get_where_row('tb_human_resources_02', array('hr_id' => $id));
        $this->load->view('human_resources/reports/hr_02_report', $data);
    }

    #--------------------------------------------------------------------------
    # Human Resources Part 03
    # ข้อมูลครอบครัว
    #--------------------------------------------------------------------------

    public function hr03() {
        $hr_id = $this->uri->segment(2);
        $data['human'] = $this->My_model->get_where_row('tb_human_resources_01', array('id' => $hr_id));
//        $data['human_prefix'] = $this->My_model->get_all_order('tb_human_prefix', 'prefix_name asc');
//        $data['education'] = $this->My_model->get_all_order('tb_education', 'education asc');


        $data['rs'] = $this->My_model->get_where_order('tb_human_resources_03', array('hr_id' => $hr_id), 'hr03_name asc');
//        $data['rs'] = $this->My_model->join2table_where_result('tb_human_prefix a', 'tb_human_resources_03 b', 'b.prefix_id = a.id', array('b.hr_id' => $hr_id), 'b.hr03_name asc');
        $this->load->view('layout/header');
        $this->load->view('human_resources/hr03', $data);
        $this->load->view('layout/footer');
    }

    // insert data
    public function hr03_insert() {
        $id = $_POST['id'];
        if ($id != '') {
            $arr = array(
                'hr03_titlename' => $this->input->post('inHr03TitleName'),
                'hr03_name' => $this->input->post('inHr03Name'),
                'hr03_lastname' => $this->input->post('inHr03Lastname'),
//                'hr03_day_birthday' => $this->input->post('inHr03DayBirthday'),
//                'hr03_month_birthday' => $this->input->post('inHr03MonthBirthday'),
//                'hr03_year_birthday' => $this->input->post('inHr03YearBirthday'),
                'hr03_relationship' => $this->input->post('inHr03Relation'),
//                'hr03_education' => $this->input->post('inHr03Education'),
                'hr03_career' => $this->input->post('inHr03Career'),
                'hr03_status' => $this->input->post('inHr03Status')
            );
            $this->My_model->update_data('tb_human_resources_03', array('id' => $id), $arr);
        } else {
            $arr = array(
                'hr_id' => $this->input->post('hr_id'),
                'hr03_titlename' => $this->input->post('inHr03TitleName'),
                'hr03_name' => $this->input->post('inHr03Name'),
                'hr03_lastname' => $this->input->post('inHr03Lastname'),
//                'hr03_day_birthday' => $this->input->post('inHr03DayBirthday'),
//                'hr03_month_birthday' => $this->input->post('inHr03MonthBirthday'),
//                'hr03_year_birthday' => $this->input->post('inHr03YearBirthday'),
                'hr03_relationship' => $this->input->post('inHr03Relation'),
//                'hr03_education' => $this->input->post('inHr03Education'),
                'hr03_career' => $this->input->post('inHr03Career'),
                'hr03_status' => $this->input->post('inHr03Status')
            );
            $this->My_model->insert_data('tb_human_resources_03', $arr);
        }
    }

    // update data
    public function hr03_update() {
        $id = $_POST['id'];
        $row = $this->My_model->get_where_row('tb_human_resources_03', array('id' => $id));
        echo json_encode($row);
    }

    // delete data;
    public function hr03_delete() {
        $id = $_POST['id'];
        $this->My_model->delete_data('tb_human_resources_03', array('id' => $id));
    }

    // print data;
    public function hr03_print() {
        $hr_id = $this->uri->segment(2);
        $data['human'] = $this->My_model->get_where_row('tb_human_resources_01', array('id' => $hr_id));
        $data['rs'] = $this->My_model->join2table_where_result('tb_human_prefix a', 'tb_human_resources_03 b', 'b.prefix_id = a.id', array('b.hr_id' => $hr_id), 'b.hr03_name asc');
        $this->load->view('human_resources/reports/hr_03_report', $data);
    }

    #--------------------------------------------------------------------------
    # Human Resources Part 04
    # ประวัติการทำงาน
    #--------------------------------------------------------------------------

    public function hr04() {
        $hr_id = $this->uri->segment(2);
        $data['human'] = $this->My_model->get_where_row('tb_human_resources_01', array('id' => $hr_id));
        $data['rs'] = $this->My_model->get_where_order('tb_human_resources_04', array('hr_id' => $hr_id), 'hr04_year desc, hr04_month asc, hr04_day asc');
        $this->load->view('layout/header');
        $this->load->view('human_resources/hr04', $data);
        $this->load->view('layout/footer');
    }

    // insert data;
    public function hr04_add() {
        $id = $_POST['id'];
        if ($id != '') {
            if (!empty($_FILES["inHr04File"]["name"])) {
                $row = $this->My_model->get_where_row('tb_human_resources_04', array('id' => $id));
                @unlink('upload/' . $row['hr04_file']);
                //
                $config = array(
                    "upload_path" => "upload/",
                    "allowed_types" => "jpg",
                    "max_size" => 0,
                    "file_name" => md5(date("YmdHis"))
                );
                $this->upload->initialize($config);
                $this->upload->do_upload("inHr04File");
                $data = $this->upload->data();

                $this->load->library("image_lib");
                $config['image_library'] = "gd2";
                $config["source_image"] = "upload/" . $data['file_name'];
                $config['maintain_ratio'] = TRUE;
                $config['width'] = 1024;
                $config['height'] = 768;

                $this->image_lib->initialize($config);
                $this->image_lib->resize();
                $filename = $data['file_name'];
                $arr = array('hr04_file' => $filename);
                $this->My_model->update_data('tb_human_resources_04', array('id' => $id), $arr);
            }
            //
            $arr = array(
                'hr_id' => $this->input->post('hr_id'),
                'hr04_day' => $this->input->post('inHr04Day'),
                'hr04_month' => $this->input->post('inHr04Month'),
                'hr04_year' => $this->input->post('inHr04Year'),
                'hr04_rank' => $this->input->post('inHr04Rank'),
                'hr04_organization' => $this->input->post('inHr04Organization'),
                'hr04_operation' => $this->input->post('inHr04Operation'),
                'hr04_long' => $this->input->post('inHr04Long'),
            );
            $this->My_model->update_data('tb_human_resources_04', array('id' => $id), $arr);
        } else {
            if (!empty($_FILES["inHr04File"]["name"])) {
                $config = array(
                    "upload_path" => "upload/",
                    "allowed_types" => "jpg",
                    "max_size" => 0,
                    "file_name" => md5(date("YmdHis"))
                );
                $this->upload->initialize($config);
                $this->upload->do_upload("inHr04File");
                $data = $this->upload->data();

                $this->load->library("image_lib");
                $config['image_library'] = "gd2";
                $config["source_image"] = "upload/" . $data['file_name'];
                $config['maintain_ratio'] = TRUE;
                $config['width'] = 1024;
                $config['height'] = 768;

                $this->image_lib->initialize($config);
                $this->image_lib->resize();
                $filename = $data['file_name'];
            } else {
                $filename = "";
            }
            //
            $arr = array(
                'hr_id' => $this->input->post('hr_id'),
                'hr04_day' => $this->input->post('inHr04Day'),
                'hr04_month' => $this->input->post('inHr04Month'),
                'hr04_year' => $this->input->post('inHr04Year'),
                'hr04_rank' => $this->input->post('inHr04Rank'),
                'hr04_organization' => $this->input->post('inHr04Organization'),
                'hr04_operation' => $this->input->post('inHr04Operation'),
                'hr04_long' => $this->input->post('inHr04Long'),
                'hr04_file' => $filename
            );
            $this->My_model->insert_data('tb_human_resources_04', $arr);
        }
    }

    // edit data;
    public function hr04_edit() {
        $id = $_POST['id'];
        $row = $this->My_model->get_where_row('tb_human_resources_04', array('id' => $id));
        echo json_encode($row);
    }

    // delete data;
    public function hr04_delete() {
        $id = $_POST['id'];
        $row = $this->My_model->get_where_row('tb_human_resources_04', array('id' => $id));
        @unlink('upload/' . $row['hr04_file']);
        $this->My_model->delete_data('tb_human_resources_04', array('id' => $id), $arr);
    }

    // print data;
    public function hr04_print($hr_id) {
        $data['human'] = $this->My_model->get_where_row('tb_human_resources_01', array('id' => $hr_id));
        $data['rs'] = $this->My_model->get_where_order('tb_human_resources_04', array('hr_id' => $hr_id), 'hr04_year desc, hr04_month asc, hr04_day asc');
        $this->load->view('human_resources/reports/hr_04_report', $data);
    }

    #--------------------------------------------------------------------------
    # Human Resources Part 05
    # ประวัติการรับราชการ
    #--------------------------------------------------------------------------

    public function hr05() {
        $hr_id = $this->uri->segment(2);
        $data['human'] = $this->My_model->get_where_row('tb_human_resources_01', array('id' => $hr_id));
        $data['rs'] = $this->My_model->get_where_order('tb_human_resources_05', array('hr_id' => $hr_id), 'hr05_year desc, hr05_month asc, hr05_day asc');
        $this->load->view('layout/header');
        $this->load->view('human_resources/hr05', $data);
        $this->load->view('layout/footer');
    }

    // insert data;
    public function hr05_add() {
        $id = $_POST['id'];
        if ($id != '') {
            if (!empty($_FILES["inHr05File"]["name"])) {
                $row = $this->My_model->get_where_row('tb_human_resources_05', array('id' => $id));
                @unlink('upload/' . $row['hr05_file']);
                //
                $config = array(
                    "upload_path" => "upload/",
                    "allowed_types" => "jpg|png",
                    "max_size" => 0,
                    "file_name" => md5(date("YmdHis"))
                );
                $this->upload->initialize($config);
                $this->upload->do_upload("inHr05File");
                $data = $this->upload->data();

                $this->load->library("image_lib");
                $config['image_library'] = "gd2";
                $config["source_image"] = "upload/" . $data['file_name'];
                $config['maintain_ratio'] = TRUE;
                $config['width'] = 1024;
                $config['height'] = 768;

                $this->image_lib->initialize($config);
                $this->image_lib->resize();
                $filename = $data['file_name'];
                $arr = array('hr05_file' => $filename);
                $this->My_model->update_data('tb_human_resources_05', array('id' => $id), $arr);
            }
            //
            $arr = array(
                'hr_id' => $this->input->post('hr_id'),
                'hr05_day' => $this->input->post('inHr05Day'),
                'hr05_month' => $this->input->post('inHr05Month'),
                'hr05_year' => $this->input->post('inHr05Year'),
                'hr05_rank' => $this->input->post('inHr05Rank'),
                'hr05_level' => $this->input->post('inHr05Level'),
                'hr05_office' => $this->input->post('inHr05Office'),
                'hr05_salary' => $this->input->post('inHr05Salary'),
                'hr05_file' => $filename
            );
            $this->My_model->update_data('tb_human_resources_05', array('id' => $id), $arr);
        } else {
            if (!empty($_FILES["inHr05File"]["name"])) {
                $config = array(
                    "upload_path" => "upload/",
                    "allowed_types" => "jpg|png",
                    "max_size" => 0,
                    "file_name" => md5(date("YmdHis"))
                );
                $this->upload->initialize($config);
                $this->upload->do_upload("inHr05File");
                $data = $this->upload->data();

                $this->load->library("image_lib");
                $config['image_library'] = "gd2";
                $config["source_image"] = "upload/" . $data['file_name'];
                $config['maintain_ratio'] = TRUE;
                $config['width'] = 1024;
                $config['height'] = 768;

                $this->image_lib->initialize($config);
                $this->image_lib->resize();
                $filename = $data['file_name'];
            } else {
                $filename = "";
            }
            $arr = array(
                'hr_id' => $this->input->post('hr_id'),
                'hr05_day' => $this->input->post('inHr05Day'),
                'hr05_month' => $this->input->post('inHr05Month'),
                'hr05_year' => $this->input->post('inHr05Year'),
                'hr05_rank' => $this->input->post('inHr05Rank'),
                'hr05_level' => $this->input->post('inHr05Level'),
                'hr05_office' => $this->input->post('inHr05Office'),
                'hr05_salary' => $this->input->post('inHr05Salary'),
                'hr05_file' => $filename
            );
            $this->My_model->insert_data('tb_human_resources_05', $arr);
        }
    }

    // edit data;
    public function hr05_edit() {
        $id = $_POST['id'];
        $row = $this->My_model->get_where_row('tb_human_resources_05', array('id' => $id));
        echo json_encode($row);
    }

    // delete data;
    public function hr05_delete() {
        $id = $_POST['id'];
        $row = $this->My_model->get_where_row('tb_human_resources_05', array('id' => $id));
        @unlink('upload/' . $row['hr05_file']);
        $this->My_model->delete_data('tb_human_resources_05', array('id' => $id));
    }

    // print data;
    public function hr05_print($hr_id) {
        $data['human'] = $this->My_model->get_where_row('tb_human_resources_01', array('id' => $hr_id));
        $data['rs'] = $this->My_model->get_where_order('tb_human_resources_05', array('hr_id' => $hr_id), 'hr05_year desc, hr05_month asc, hr05_day asc');
        $this->load->view('human_resources/reports/hr_05_report', $data);
    }

    #--------------------------------------------------------------------------
    # Human Resources Part 06
    # ประวัติการรับราชการ
    #--------------------------------------------------------------------------

    public function hr06() {
        $hr_id = $this->uri->segment(2);
        $data['human'] = $this->My_model->get_where_row('tb_human_resources_01', array('id' => $hr_id));
        $data['rs'] = $this->My_model->get_where_order('tb_human_resources_06', array('hr_id' => $hr_id), 'hr06_loanyear desc');
        $this->load->view('layout/header');
        $this->load->view('human_resources/hr06', $data);
        $this->load->view('layout/footer');
    }

    // insert data;
    public function hr06_add() {
        $id = $_POST['id'];
        if ($id != '') {
            $arr = array(
                'hr06_loanyear' => $this->input->post('inHr06LoanYear'),
                'hr06_subject' => $this->input->post('inHr06Subject'),
                'hr06_amount' => $this->input->post('inHr06Amount'),
                'hr06_grade' => $this->input->post('inHr06Grade'),
                'hr06_student' => $this->input->post('inHr06Student'),
                'hr06_comment' => $this->input->post('inHr06Comment')
            );
            $this->My_model->update_data('tb_human_resources_06', array('id' => $id), $arr);
        } else {
            $arr = array(
                'hr_id' => $this->input->post('hr_id'),
                'hr06_loanyear' => $this->input->post('inHr06LoanYear'),
                'hr06_subject' => $this->input->post('inHr06Subject'),
                'hr06_amount' => $this->input->post('inHr06Amount'),
                'hr06_grade' => $this->input->post('inHr06Grade'),
                'hr06_student' => $this->input->post('inHr06Student'),
                'hr06_comment' => $this->input->post('inHr06Comment')
            );
            $this->My_model->insert_data('tb_human_resources_06', $arr);
        }
    }

    // edit data;
    public function hr06_edit() {
        $id = $_POST['id'];
        $row = $this->My_model->get_where_row('tb_human_resources_06', array('id' => $id));
        echo json_encode($row);
    }

    // delete data;
    public function hr06_delete() {
        $id = $_POST['id'];
        $this->My_model->delete_data('tb_human_resources_06', array('id' => $id));
    }

    // print data;
    public function hr06_print($hr_id) {
        $data['human'] = $this->My_model->get_where_row('tb_human_resources_01', array('id' => $hr_id));
        $data['rs'] = $this->My_model->get_where_order('tb_human_resources_06', array('hr_id' => $hr_id), 'hr06_loanyear desc');
        $this->load->view('human_resources/reports/hr_06_report', $data);
    }

    #--------------------------------------------------------------------------
    # Human Resources Part 07
    # ประวัติการฝึกอบรม
    #--------------------------------------------------------------------------

    public function hr07() {
        $hr_id = $this->uri->segment(2);
        $data['human'] = $this->My_model->get_where_row('tb_human_resources_01', array('id' => $hr_id));
        $data['rs'] = $this->My_model->get_where_order('tb_human_resources_07', array('hr_id' => $hr_id), 'hr07_begin_date desc');
        $this->load->view('layout/header');
        $this->load->view('human_resources/hr07', $data);
        $this->load->view('layout/footer');
    }

    // insert data;
    public function hr07_add() {
        $id = $_POST['id'];
        if ($id != '') {
            if (!empty($_FILES["inHr07File"]["name"])) {
                $row = $this->My_model->get_where_row('tb_human_resources_07', array('id' => $id));
                @unlink('upload/' . $row['hr07_file']);
                //
                $config = array(
                    "upload_path" => "upload/",
                    "allowed_types" => "*",
                    "max_size" => 0,
                    "file_name" => md5(date("YmdHis"))
                );
                $this->upload->initialize($config);
                $this->upload->do_upload("inHr07File");
                $data = $this->upload->data();

//                $this->load->library("image_lib");
//                $config['image_library'] = "gd2";
//                $config["source_image"] = "upload/" . $data['file_name'];
//                $config['maintain_ratio'] = TRUE;
//                $config['width'] = 1024;
//                $config['height'] = 768;
//                $this->image_lib->initialize($config);
//                $this->image_lib->resize();
                $filename = $data['file_name'];
                $arr = array('hr07_file' => $filename);
                $this->My_model->update_data('tb_human_resources_07', array('id' => $id), $arr);
            }
            $arr = array(
                'hr07_topic' => $this->input->post('inHr07Topic'),
                'hr07_place' => $this->input->post('inHr07Place'),
                'hr07_comment' => $this->input->post('inHr07Comment'),
                'hr07_begin_date' => $this->input->post('inHr07StartDatePicker'),
                'hr07_end_date' => $this->input->post('inHr07EndDatePicker'),
                'hr07_day' => $this->input->post('inHr07Day'),
                'hr07_hour' => $this->input->post('inHr07Hour'),
                'hr07_detail' => $this->input->post('inHr07Detail'),
            );
            $this->My_model->update_data('tb_human_resources_07', array('id' => $id), $arr);
        } else {
            if (!empty($_FILES["inHr07File"]["name"])) {
                $config = array(
                    "upload_path" => "upload/",
                    "allowed_types" => "*",
                    "max_size" => 0,
                    "file_name" => md5(date("YmdHis"))
                );
                $this->upload->initialize($config);
                $this->upload->do_upload("inHr07File");
                $data = $this->upload->data();

                $this->load->library("image_lib");
                $config['image_library'] = "gd2";
                $config["source_image"] = "upload/" . $data['file_name'];
                $config['maintain_ratio'] = TRUE;
                $config['width'] = 1024;
                $config['height'] = 768;

                $this->image_lib->initialize($config);
                $this->image_lib->resize();
                $filename = $data['file_name'];
            } else {
                $filename = "";
            }
            $arr = array(
                'hr_id' => $this->input->post('hr_id'),
                'hr07_topic' => $this->input->post('inHr07Topic'),
                'hr07_place' => $this->input->post('inHr07Place'),
                'hr07_comment' => $this->input->post('inHr07Comment'),
                'hr07_begin_date' => $this->input->post('inHr07StartDatePicker'),
                'hr07_end_date' => $this->input->post('inHr07EndDatePicker'),
                'hr07_day' => $this->input->post('inHr07Day'),
                'hr07_hour' => $this->input->post('inHr07Hour'),
                'hr07_detail' => $this->input->post('inHr07Detail'),
//                'hr07_country' => $this->input->post('inHr07Country'),
                'hr07_file' => $filename,
            );
            $this->My_model->insert_data('tb_human_resources_07', $arr);
        }
    }

    // edit data;
    public function hr07_edit() {
        $id = $_POST['id'];
        $row = $this->My_model->get_where_row('tb_human_resources_07', array('id' => $id));
        echo json_encode($row);
    }

    // delete data;
    public function hr07_delete() {
        $id = $_POST['id'];
        $row = $this->My_model->get_where_row('tb_human_resources_07', array('id' => $id));
        @unlink('upload/' . $row['hr07_file']);
        $this->My_model->delete_data('tb_human_resources_07', array('id' => $id));
    }

    // print data;
    public function hr07_print($hr_id) {
        $data['human'] = $this->My_model->get_where_row('tb_human_resources_01', array('id' => $hr_id));
        $data['rs'] = $this->My_model->get_where_order('tb_human_resources_07', array('hr_id' => $hr_id), 'hr07_begin_year desc, hr07_begin_month asc, hr07_begin_day asc');
        $this->load->view('human_resources/reports/hr_07_report', $data);
    }

    #--------------------------------------------------------------------------
    # Human Resources Part 08
    # ประวัติการเลื่อนตำแหน่ง
    #--------------------------------------------------------------------------

    public function hr08() {
        $hr_id = $this->uri->segment(2);
        $data['human'] = $this->My_model->get_where_row('tb_human_resources_01', array('id' => $hr_id));
        $data['rs'] = $this->My_model->get_where_order('tb_human_resources_08', array('hr_id' => $hr_id), 'hr08_year desc, hr08_month asc, hr08_day asc');
        $this->load->view('layout/header');
        $this->load->view('human_resources/hr08', $data);
        $this->load->view('layout/footer');
    }

    // add data;
    public function hr08_add() {
        $id = $_POST['id'];
        if ($id != '') {
            if (!empty($_FILES["inHr08File"]["name"])) {
                $row = $this->My_model->get_where_row('tb_human_resources_08', array('id' => $id));
                @unlink('upload/' . $row['hr08_file']);
                //
                $config = array(
                    "upload_path" => "upload/",
                    "allowed_types" => "jpg|png",
                    "max_size" => 0,
                    "file_name" => md5(date("YmdHis"))
                );
                $this->upload->initialize($config);
                $this->upload->do_upload("inHr08File");
                $data = $this->upload->data();

                $this->load->library("image_lib");
                $config['image_library'] = "gd2";
                $config["source_image"] = "upload/" . $data['file_name'];
                $config['maintain_ratio'] = TRUE;
                $config['width'] = 1024;
                $config['height'] = 768;

                $this->image_lib->initialize($config);
                $this->image_lib->resize();
                $filename = $data['file_name'];
                $arr = array('hr08_file' => $filename);
                $this->My_model->update_data('tb_human_resources_08', array('id' => $id), $arr);
            }
            $arr = array(
                'hr08_day' => $this->input->post('inHr08Day'),
                'hr08_month' => $this->input->post('inHr08Month'),
                'hr08_year' => $this->input->post('inHr08Year'),
                'hr08_rank' => $this->input->post('inHr08Rank'),
                'hr08_level' => $this->input->post('inHr08Level'),
                'hr08_office' => $this->input->post('inHr08Office'),
                'hr08_province' => $this->input->post('inHr08Province'),
                'hr08_file' => $filename,
                'hr08_comment' => $this->input->post('inHr08Comment')
            );
            $this->My_model->update_data('tb_human_resources_08', array('id' => $id), $arr);
        } else {
            if (!empty($_FILES["inHr08File"]["name"])) {
                $config = array(
                    "upload_path" => "upload/",
                    "allowed_types" => "jpg|png",
                    "max_size" => 0,
                    "file_name" => md5(date("YmdHis"))
                );
                $this->upload->initialize($config);
                $this->upload->do_upload("inHr08File");
                $data = $this->upload->data();

                $this->load->library("image_lib");
                $config['image_library'] = "gd2";
                $config["source_image"] = "upload/" . $data['file_name'];
                $config['maintain_ratio'] = TRUE;
                $config['width'] = 1024;
                $config['height'] = 768;

                $this->image_lib->initialize($config);
                $this->image_lib->resize();
                $filename = $data['file_name'];
            } else {
                $filename = '';
            }
            $arr = array(
                'hr_id' => $this->input->post('hr_id'),
                'hr08_day' => $this->input->post('inHr08Day'),
                'hr08_month' => $this->input->post('inHr08Month'),
                'hr08_year' => $this->input->post('inHr08Year'),
                'hr08_rank' => $this->input->post('inHr08Rank'),
                'hr08_level' => $this->input->post('inHr08Level'),
                'hr08_office' => $this->input->post('inHr08Office'),
                'hr08_province' => $this->input->post('inHr08Province'),
                'hr08_file' => $filename,
                'hr08_comment' => $this->input->post('inHr08Comment')
            );
            $this->My_model->insert_data('tb_human_resources_08', $arr);
        }
    }

    // edit data;
    public function hr08_edit() {
        $id = $_POST['id'];
        $row = $this->My_model->get_where_row('tb_human_resources_08', array('id' => $id));
        echo json_encode($row);
    }

    // delete data;
    public function hr08_delete() {
        $id = $_POST['id'];
        $row = $this->My_model->get_where_row('tb_human_resources_08', array('id' => $id));
        @unlink('upload/' . $row['hr08_file']);
        $this->My_model->delete_data('tb_human_resources_08', array('id' => $id));
    }

    // print data;
    public function hr08_print($hr_id) {
        $data['human'] = $this->My_model->get_where_row('tb_human_resources_01', array('id' => $hr_id));
        $data['rs'] = $this->My_model->get_where_order('tb_human_resources_08', array('hr_id' => $hr_id), 'hr08_year desc, hr08_month asc, hr08_day asc');
        $this->load->view('human_resources/reports/hr_08_report', $data);
    }

    #--------------------------------------------------------------------------
    # Human Resources Part 09
    # ประวัติการสร้างผลงาน
    #--------------------------------------------------------------------------

    public function hr09() {
        $hr_id = $this->uri->segment(2);
        $data['human'] = $this->My_model->get_where_row('tb_human_resources_01', array('id' => $hr_id));
        $data['rs'] = $this->My_model->get_where_order('tb_human_resources_09', array('hr_id' => $hr_id), 'hr09_year desc, hr09_month asc, hr09_day asc');
        $this->load->view('layout/header');
        $this->load->view('human_resources/hr09', $data);
        $this->load->view('layout/footer');
    }

    // add data;
    public function hr09_add() {
        $id = $_POST['id'];
        if ($id != '') {
            if (!empty($_FILES["inHr09File"]["name"])) {
                $row = $this->My_model->get_where_row('tb_human_resources_09', array('id' => $id));
                @unlink('upload/' . $row['hr09_file']);
                $config = array(
                    "upload_path" => "upload/",
                    "allowed_types" => "pdf|doc|docx",
                    "max_size" => 0,
                    "file_name" => md5(date("YmdHis"))
                );
                $this->upload->initialize($config);
                $this->upload->do_upload("inHr09File");
                $data = $this->upload->data();
                $filename = $data['file_name'];
                $arr = array('hr09_file' => $filename);
                $this->My_model->update_data('tb_human_resources_09', array('id' => $id), $arr);
            }
            $arr = array(
                'hr09_day' => $this->input->post('inHr09Day'),
                'hr09_month' => $this->input->post('inHr09Month'),
                'hr09_year' => $this->input->post('inHr09Year'),
                'hr09_topic' => $this->input->post('inHr09Topic'),
                'hr09_detail' => $this->input->post('inHr09Detail'),
            );
            $this->My_model->update_data('tb_human_resources_09', array('id' => $id), $arr);
        } else {
            if (!empty($_FILES["inHr09File"]["name"])) {
                $config = array(
                    "upload_path" => "upload/",
                    "allowed_types" => "pdf|doc|docx",
                    "max_size" => 0,
                    "file_name" => md5(date("YmdHis"))
                );
                $this->upload->initialize($config);
                $this->upload->do_upload("inHr09File");
                $data = $this->upload->data();
                $filename = $data['file_name'];
            } else {
                $filename = "";
            }
            $arr = array(
                'hr_id' => $this->input->post('hr_id'),
                'hr09_day' => $this->input->post('inHr09Day'),
                'hr09_month' => $this->input->post('inHr09Month'),
                'hr09_year' => $this->input->post('inHr09Year'),
                'hr09_topic' => $this->input->post('inHr09Topic'),
                'hr09_detail' => $this->input->post('inHr09Detail'),
                'hr09_file' => $filename
            );
            $this->My_model->insert_data('tb_human_resources_09', $arr);
        }
    }

    // edit data;
    public function hr09_edit() {
        $id = $_POST['id'];
        $row = $this->My_model->get_where_row('tb_human_resources_09', array('id' => $id));
        echo json_encode($row);
    }

    // delete data
    public function hr09_delete() {
        $id = $_POST['id'];
        $row = $this->My_model->get_where_row('tb_human_resources_09', array('id' => $id));
        @unlink('upload/' . $row['hr09_file']);
        $this->My_model->delete_data('tb_human_resources_09', array('id' => $id));
    }

    // print data;
    public function hr09_print($hr_id) {
        $data['human'] = $this->My_model->get_where_row('tb_human_resources_01', array('id' => $hr_id));
        $data['rs'] = $this->My_model->get_where_order('tb_human_resources_09', array('hr_id' => $hr_id), 'hr09_year desc, hr09_month asc, hr09_day asc');
        $this->load->view('human_resources/reports/hr_09_report', $data);
    }

    #--------------------------------------------------------------------------
    # Human Resources Part 10
    # ข้อมูลใบประกอบวิชาชีพ
    #--------------------------------------------------------------------------

    //
    public function hr10() {
        $hr_id = $this->uri->segment(2);
        $data['human'] = $this->My_model->get_where_row('tb_human_resources_01', array('id' => $hr_id));
        $data['rs'] = $this->My_model->get_where_order('tb_human_resources_10', array('hr_id' => $hr_id), 'hr10_begin_year desc, hr10_begin_month asc, hr10_begin_day asc');
        $this->load->view('layout/header');
        $this->load->view('human_resources/hr10', $data);
        $this->load->view('layout/footer');
    }

    // add data;
    public function hr10_add() {
        $id = $_POST['id'];
        if ($id != '') {
            if (!empty($_FILES["inHr10Image"]["name"])) {
                $row = $this->My_model->get_where_row('tb_human_resources_10', array('id' => $id));
                @unlink('upload/' . $row['hr10_image']);
                $config = array(
                    "upload_path" => "upload/",
                    "allowed_types" => "jpg|png",
                    "max_size" => 0,
                    "file_name" => md5(date("YmdHis"))
                );
                $this->upload->initialize($config);
                $this->upload->do_upload("inHr10Image");
                $data = $this->upload->data();

                $this->load->library("image_lib");
                $config['image_library'] = "gd2";
                $config["source_image"] = "upload/" . $data['file_name'];
                $config['maintain_ratio'] = TRUE;
                $config['width'] = 1024;
                $config['height'] = 768;

                $this->image_lib->initialize($config);
                $this->image_lib->resize();
                $filename = $data['file_name'];
                $arr = array('hr10_image' => $filename);
                $this->My_model->update_data('tb_human_resources_10', array('id' => $id), $arr);
            }
            $arr = array(
                'hr10_id' => $this->input->post('inHr10Id'),
                'hr10_type' => $this->input->post('inHr10Type'),
                'hr10_no' => $this->input->post('inHr10No'),
                'hr10_begin_day' => $this->input->post('inHr10BeginDay'),
                'hr10_begin_month' => $this->input->post('inHr10BeginMonth'),
                'hr10_begin_year' => $this->input->post('inHr10BeginYear'),
                'hr10_end_day' => $this->input->post('inHr10EndDay'),
                'hr10_end_month' => $this->input->post('inHr10EndMonth'),
                'hr10_end_year' => $this->input->post('inHr10EndYear'),
                'hr10_comment' => $this->input->post('inHr10Comment')
            );
            $this->My_model->update_data('tb_human_resources_10', array('id' => $id), $arr);
        } else {
            if (!empty($_FILES["inHr10Image"]["name"])) {
                $config = array(
                    "upload_path" => "upload/",
                    "allowed_types" => "jpg|png",
                    "max_size" => 0,
                    "file_name" => md5(date("YmdHis"))
                );
                $this->upload->initialize($config);
                $this->upload->do_upload("inHr10Image");
                $data = $this->upload->data();

                $this->load->library("image_lib");
                $config['image_library'] = "gd2";
                $config["source_image"] = "upload/" . $data['file_name'];
                $config['maintain_ratio'] = TRUE;
                $config['width'] = 1024;
                $config['height'] = 768;

                $this->image_lib->initialize($config);
                $this->image_lib->resize();
                $filename = $data['file_name'];
            } else {
                $filename = "";
            }
            $arr = array(
                'hr_id' => $this->input->post('hr_id'),
                'hr10_id' => $this->input->post('inHr10Id'),
                'hr10_type' => $this->input->post('inHr10Type'),
                'hr10_no' => $this->input->post('inHr10No'),
                'hr10_begin_day' => $this->input->post('inHr10BeginDay'),
                'hr10_begin_month' => $this->input->post('inHr10BeginMonth'),
                'hr10_begin_year' => $this->input->post('inHr10BeginYear'),
                'hr10_end_day' => $this->input->post('inHr10EndDay'),
                'hr10_end_month' => $this->input->post('inHr10EndMonth'),
                'hr10_end_year' => $this->input->post('inHr10EndYear'),
                'hr10_image' => $filename,
                'hr10_comment' => $this->input->post('inHr10Comment')
            );
            $this->My_model->insert_data('tb_human_resources_10', $arr);
        }
    }

    // update data;
    public function hr10_edit() {
        $id = $_POST['id'];
        $row = $this->My_model->get_where_row('tb_human_resources_10', array('id' => $id));
        echo json_encode($row);
    }

    // delete data;
    public function hr10_delete() {
        $id = $_POST['id'];
        $row = $this->My_model->get_where_row('tb_human_resources_10', array('id' => $id));
        @unlink('upload/' . $row['hr10_image']);
        $this->My_model->delete_data('tb_human_resources_10', array('id' => $id));
    }

    // print data;
    public function hr10_print($hr_id) {
        $data['human'] = $this->My_model->get_where_row('tb_human_resources_01', array('id' => $hr_id));
        $data['rs'] = $this->My_model->get_where_order('tb_human_resources_10', array('hr_id' => $hr_id), 'hr10_begin_year desc, hr10_begin_month asc, hr10_begin_day asc');
        $this->load->view('human_resources/reports/hr_10_report', $data);
    }

    #--------------------------------------------------------------------------
    # Human Resources Part 11
    # ข้อมูลการลาทุกประเภท
    #--------------------------------------------------------------------------

    public function hr11() {
        $hr_id = $this->uri->segment(2);
        $data['human'] = $this->My_model->get_where_row('tb_human_resources_01', array('id' => $hr_id));
        $data['rs'] = $this->My_model->get_where_order('tb_human_resources_11', array('hr_id' => $hr_id), 'hr11_date desc');
        $this->load->view('layout/header');
        $this->load->view('human_resources/hr11', $data);
        $this->load->view('layout/footer');
    }

    // insert data;
    public function hr11_add() {
        $id = $_POST['id'];
        if ($id != '') {
            if (!empty($_FILES["inHr11File"]["name"])) {
                $row = $this->My_model->get_where_row('tb_human_resources_11', array('id' => $id));
                @unlink('upload/' . $row['hr11_file']);
                //
                $config = array(
                    "upload_path" => "upload/",
                    "allowed_types" => "pdf|doc|docx",
                    "max_size" => 0,
                    "file_name" => md5(date("YmdHis"))
                );
                $this->upload->initialize($config);
                $this->upload->do_upload("inHr11File");
                $data = $this->upload->data();
                $filename = $data['file_name'];
                $arr = array('hr11_file' => $filename);
                $this->My_model->update_data('tb_human_resources_11', array('id' => $id), $arr);
            }
            //
            $arr = array(
                'hr11_date' => $this->input->post('inHr11Date'),
                'hr11_type' => $this->input->post('inHr11Type'),
            );
            $this->My_model->update_data('tb_human_resources_11', array('id' => $id), $arr);
        } else {
            if (!empty($_FILES["inHr11File"]["name"])) {
                $config = array(
                    "upload_path" => "upload/",
                    "allowed_types" => "pdf|doc|docx",
                    "max_size" => 0,
                    "file_name" => md5(date("YmdHis"))
                );
                $this->upload->initialize($config);
                $this->upload->do_upload("inHr11File");
                $data = $this->upload->data();
                $filename = $data['file_name'];
            } else {
                $filename = '';
            }
            //
            $arr = array(
                'hr_id' => $this->input->post('hr_id'),
                'hr11_date' => $this->input->post('inHr11Date'),
                'hr11_type' => $this->input->post('inHr11Type'),
                'hr11_file' => $filename
            );
            $this->My_model->insert_data('tb_human_resources_11', $arr);
        }
    }

    // edit data;
    public function hr11_edit() {
        $id = $_POST['id'];
        $row = $this->My_model->get_where_row('tb_human_resources_11', array('id' => $id));
        echo json_encode($row);
    }

    // delete data;
    public function hr11_delete() {
        $id = $_POST['id'];
        $row = $this->My_model->get_where_row('tb_human_resources_11', array('id' => $id));
        @unlink('upload/' . $row['hr11_file']);
        $this->My_model->delete_data('tb_human_resources_11', array('id' => $id));
    }

    // print data;
    public function hr11_print($hr_id) {
        $data['human'] = $this->My_model->get_where_row('tb_human_resources_01', array('id' => $hr_id));
        $data['rs'] = $this->My_model->get_where_order('tb_human_resources_11', array('hr_id' => $hr_id), 'hr11_date desc');
        $this->load->view('human_resources/reports/hr_11_report', $data);
    }

    // summary data;
    public function hr11_summary_print($hr_id) {
        $data['human'] = $this->My_model->get_where_row('tb_human_resources_01', array('id' => $hr_id));
        $data['rs'] = $this->My_model->get_where_order('tb_human_resources_11', array('hr_id' => $hr_id), 'hr11_date desc');
        $this->load->view('human_resources/reports/hr_11_summary_report', $data);
    }

    #--------------------------------------------------------------------------
    # Human Resources Part 12
    # ข้อมูลการกระทำผิด
    #--------------------------------------------------------------------------
    //
    public function hr12() {
        $hr_id = $this->uri->segment(2);
        $data['hr'] = $this->My_model->get_where_row('tb_human_resources_01', array('id' => $hr_id));
        $data['rs'] = $this->My_model->get_where_order('tb_human_resources_12', array('hr_id' => $hr_id), 'hr12_year desc, hr12_month asc, hr12_day asc');
        $this->load->view('layout/header');
        $this->load->view('human_resources/hr12', $data);
        $this->load->view('layout/footer');
    }

    // insert data;
    public function hr12_add() {
        $id = $_POST['id'];
        if ($id != '') {
            if (!empty($_FILES["inHr12File"]["name"])) {
                $row = $this->My_model->get_where_row('tb_human_resources_12', array('id' => $id));
                @unlink('upload/' . $row['hr12_file']);
                $config = array(
                    "upload_path" => "upload/",
                    "allowed_types" => "pdf|doc|docx",
                    "max_size" => 0,
                    "file_name" => md5(date("YmdHis"))
                );
                $this->upload->initialize($config);
                $this->upload->do_upload("inHr12File");
                $data = $this->upload->data();
                $filename = $data['file_name'];
                $arr = array('hr12_file' => $filename);
                $this->My_model->update_data('tb_human_resources_12', array('id' => $id), $arr);
            }
            //
            $arr = array(
                'hr12_day' => $this->input->post('inHr12Day'),
                'hr12_month' => $this->input->post('inHr12Month'),
                'hr12_year' => $this->input->post('inHr12Year'),
                'hr12_detail' => $this->input->post('inHr12Detail'),
                'hr12_file' => $filename
            );
            $this->My_model->update_data('tb_human_resources_12', array('id' => $id), $arr);
        } else {
            if (!empty($_FILES["inHr12File"]["name"])) {
                $config = array(
                    "upload_path" => "upload/",
                    "allowed_types" => "pdf|doc|docx",
                    "max_size" => 0,
                    "file_name" => md5(date("YmdHis"))
                );
                $this->upload->initialize($config);
                $this->upload->do_upload("inHr12File");
                $data = $this->upload->data();
                $filename = $data['file_name'];
            } else {
                $filename = '';
            }
            //
            $arr = array(
                'hr_id' => $this->input->post('hr_id'),
                'hr12_day' => $this->input->post('inHr12Day'),
                'hr12_month' => $this->input->post('inHr12Month'),
                'hr12_year' => $this->input->post('inHr12Year'),
                'hr12_detail' => $this->input->post('inHr12Detail'),
                'hr12_file' => $filename
            );
            $this->My_model->insert_data('tb_human_resources_12', $arr);
        }
    }

    // update data;
    public function hr12_edit() {
        $id = $_POST['id'];
        $row = $this->My_model->get_where_row('tb_human_resources_12', array('id' => $id));
        echo json_encode($row);
    }

    // delete data;
    public function hr12_delete() {
        $id = $_POST['id'];
        $row = $this->My_model->get_where_row('tb_human_resources_12', array('id' => $id));
        @unlink('upload/' . $row['hr12_file']);
        $this->My_model->delete_data('tb_human_resources_12', array('id' => $id));
    }

    // print data;
    public function hr12_print($hr_id) {
        $data['human'] = $this->My_model->get_where_row('tb_human_resources_01', array('id' => $hr_id));
        $data['rs'] = $this->My_model->get_where_order('tb_human_resources_12', array('hr_id' => $hr_id), 'hr12_year desc, hr12_month asc, hr12_day asc');
        $this->load->view('human_resources/reports/hr_12_report', $data);
    }

    #--------------------------------------------------------------------------
    # Human Resources Part 13
    # ประวัติการรับเครื่องราชอิสริยาภรณ์
    #--------------------------------------------------------------------------

    public function hr13($hr_id) {
        $data['hr'] = $this->My_model->get_where_row('tb_human_resources_01', array('id' => $hr_id));
        $data['insignia'] = $this->My_model->get_all_order('tb_insignia', 'insignia_level asc');
        $data['rs'] = $this->Hr_model->get_hr_13($hr_id);
        $this->load->view('layout/header');
        $this->load->view('human_resources/hr13', $data);
        $this->load->view('layout/footer');
    }

    // insert hr13 data;
    public function hr_13_insert() {
        $id = $_POST['id'];
        if ($id != '') {
            if (!empty($_FILES["inHr13Refer"]["name"])) {
                $row = $this->My_model->get_where_row('tb_human_resources_13', array('id' => $id));
                @unlink('upload/' . $row['hr13_refer']);
                //
                $config = array(
                    "upload_path" => "upload/",
                    "allowed_types" => "jpg|png",
                    "max_size" => 0,
                    "file_name" => md5(date("YmdHis"))
                );
                $this->upload->initialize($config);
                $this->upload->do_upload("inHr13Refer");
                $data = $this->upload->data();

                $this->load->library("image_lib");
                $config['image_library'] = "gd2";
                $config["source_image"] = "upload/" . $data['file_name'];
                $config['maintain_ratio'] = TRUE;
                $config['width'] = 1024;
                $config['height'] = 768;

                $this->image_lib->initialize($config);
                $this->image_lib->resize();
                $filename = $data['file_name'];
                $arr = array('hr13_refer' => $filename);
                $this->My_model->update_data('tb_human_resources_13', array('id' => $id), $arr);
            }
            //
            $arr = array(
                'hr_id' => $this->input->post('hr_id'),
                'hr13_day' => $this->input->post('inHr13Day'),
                'hr13_month' => $this->input->post('inHr13Month'),
                'hr13_year' => $this->input->post('inHr13Year'),
                'hr13_insignia' => $this->input->post('inHr13Insignia'),
                'hr13_comment' => $this->input->post('inHr13Comment')
            );
            $this->My_model->update_data('tb_human_resources_13', array('id' => $id), $arr);
        } else {
            if (!empty($_FILES["inHr13Refer"]["name"])) {
                $config = array(
                    "upload_path" => "upload/",
                    "allowed_types" => "jpg|png",
                    "max_size" => 0,
                    "file_name" => md5(date("YmdHis"))
                );
                $this->upload->initialize($config);
                $this->upload->do_upload("inHr13Refer");
                $data = $this->upload->data();

                $this->load->library("image_lib");
                $config['image_library'] = "gd2";
                $config["source_image"] = "upload/" . $data['file_name'];
                $config['maintain_ratio'] = TRUE;
                $config['width'] = 1024;
                $config['height'] = 768;

                $this->image_lib->initialize($config);
                $this->image_lib->resize();
                $filename = $data['file_name'];
            } else {
                $filename = '';
            }
            $arr = array(
                'hr_id' => $this->input->post('hr_id'),
                'hr13_day' => $this->input->post('inHr13Day'),
                'hr13_month' => $this->input->post('inHr13Month'),
                'hr13_year' => $this->input->post('inHr13Year'),
                'hr13_insignia' => $this->input->post('inHr13Insignia'),
                'hr13_refer' => $filename,
                'hr13_comment' => $this->input->post('inHr13Comment')
            );
            $this->My_model->insert_data('tb_human_resources_13', $arr);
        }
    }

    // edit data;
    public function hr_13_edit() {
        $id = $_POST['id'];
        $row = $this->My_model->get_where_row('tb_human_resources_13', array('id' => $id));
        echo json_encode($row);
    }

    // delete hr13 data;
    public function hr_13_delete() {
        $id = $_POST['id'];
        $row = $this->My_model->get_where_row('tb_human_resources_13', array('id' => $id));
        $this->My_model->delete_data('tb_human_resources_13', array('id' => $id));
    }

    // print data;
    public function hr_13_print($hr_id) {
        $data['human'] = $this->My_model->get_where_row('tb_human_resources_01', array('id' => $hr_id));
        $data['rs'] = $this->My_model->join2table_where_result('tb_insignia a', 'tb_human_resources_13 b', 'b.hr13_insignia = a.insignia_name', array('b.hr_id' => $hr_id), 'b.hr13_year desc');
        $this->load->view('human_resources/reports/hr_13_report', $data);
    }

    #--------------------------------------------------------------------------
    # Human Resources Part 14
    # ข้อมูลด้านอื่น ๆ 
    #--------------------------------------------------------------------------

    //
    public function hr14($hr_id) {
        $data['human'] = $this->My_model->get_where_row('tb_human_resources_01', array('id' => $hr_id));
        $data['hr14'] = array();
        $data['rs'] = $this->My_model->get_where_order('tb_human_resources_14', array('hr_id' => $hr_id), 'hr14_year desc, hr14_month asc, hr14_day asc');
        $this->load->view('layout/header');
        $this->load->view('human_resources/hr14', $data);
        $this->load->view('layout/footer');
    }

    // Insert data;
    public function hr14_insert() {
        $id = $_POST['id'];
        if ($id != '') {
            if (!empty($_FILES["inHr14Document"]["name"])) {
                $row = $this->My_model->get_where_row('tb_human_resources_14', array('id' => $id));
                @unlink('upload/' . $row['hr14_document']);
                //
                $config = array(
                    "upload_path" => "upload/",
                    "allowed_types" => "jpg|png",
                    "max_size" => 0,
                    "file_name" => md5(date("YmdHis"))
                );
                $this->upload->initialize($config);
                $this->upload->do_upload("inHr14Document");
                $data = $this->upload->data();

                $this->load->library("image_lib");
                $config['image_library'] = "gd2";
                $config["source_image"] = "upload/" . $data['file_name'];
                $config['maintain_ratio'] = TRUE;
                $config['width'] = 1024;
                $config['height'] = 768;

                $this->image_lib->initialize($config);
                $this->image_lib->resize();
                $filename = $data['file_name'];
                $arr = array('hr14_document' => $filename);
                $this->My_model->update_data('tb_human_resources_14', array('id' => $id), $arr);
            }
            $arr = array(
                'hr14_day' => $this->input->post('inHr14Day'),
                'hr14_month' => $this->input->post('inHr14Month'),
                'hr14_year' => $this->input->post('inHr14Year'),
                'hr14_detail' => $this->input->post('inHr14Detail')
            );
            $this->My_model->update_data('tb_human_resources_14', array('id' => $id), $arr);
        } else {
            if (!empty($_FILES["inHr14Document"]["name"])) {
                $config = array(
                    "upload_path" => "upload/",
                    "allowed_types" => "jpg|png",
                    "max_size" => 0,
                    "file_name" => md5(date("YmdHis"))
                );
                $this->upload->initialize($config);
                $this->upload->do_upload("inHr14Document");
                $data = $this->upload->data();

                $this->load->library("image_lib");
                $config['image_library'] = "gd2";
                $config["source_image"] = "upload/" . $data['file_name'];
                $config['maintain_ratio'] = TRUE;
                $config['width'] = 1024;
                $config['height'] = 768;

                $this->image_lib->initialize($config);
                $this->image_lib->resize();
                $filename = $data['file_name'];
            } else {
                $filename = "";
            }

            $arr = array(
                'hr_id' => $this->input->post('hr_id'),
                'hr14_day' => $this->input->post('inHr14Day'),
                'hr14_month' => $this->input->post('inHr14Month'),
                'hr14_year' => $this->input->post('inHr14Year'),
                'hr14_detail' => $this->input->post('inHr14Detail'),
                'hr14_document' => $filename
            );
            $this->My_model->insert_data('tb_human_resources_14', $arr);
        }
    }

    // Update data;
    public function hr14_update() {
        $id = $_POST['id'];
        $row = $this->My_model->get_where_row('tb_human_resources_14', array('id' => $id));
        echo json_encode($row);
    }

    // delete data;
    public function hr14_delete() {
        $id = $_POST['id'];
        $row = $this->My_model->get_where_row('tb_human_resources_14', array('id' => $id));
        @unlink('upload/' . $row['hr14_document']);
        $this->My_model->delete_data('tb_human_resources_14', array('id' => $id));
    }

    // print data;
    public function hr_14_print() {
        $data['human'] = $this->My_model->get_where_row('tb_human_resources_01', array('id' => $hr_id));
        $data['rs'] = array();
        $this->load->view('human_resources/reports/hr_14_report', $data);
    }

    #--------------------------------------------------------------------------
    # Human Resources Part 15
    # ประวัติการศึกษา
    #--------------------------------------------------------------------------

    //
    public function hr15($hr_id) {
        if ($this->session->userdata('status') == '') {
            redirect('login');
        }
        //
        $data['rs'] = $this->My_model->join2table_where_result('tb_human_resources_01 a', 'tb_human_resources_15 b', 'b.hr_id = a.id', array('b.hr_id' => $hr_id), 'b.edu_year desc');
        $this->load->view('layout/header');
        $this->load->view('human_resources/hr15', $data);
        $this->load->view('layout/footer');
    }

    // add data;
    public function hr15_add() {
        $id = $_POST['id'];
        if ($id != '') {
            $arr = array(
                'edu_year' => $this->input->post('inEduYear'),
                'edu_level' => $this->input->post('inEduLevel'),
                'edu_group' => $this->input->post('inEduGroup'),
                'edu_branch' => $this->input->post('inEduBranch'),
                'edu_university' => $this->input->post('inEduUniversity'),
                'edu_comment' => $this->input->post('inEduComment')
            );
            $this->My_model->update_data('tb_human_resources_15', array('id' => $id), $arr);
        } else {
            $arr = array(
                'hr_id' => $this->input->post('hr_id'),
                'edu_year' => $this->input->post('inEduYear'),
                'edu_level' => $this->input->post('inEduLevel'),
                'edu_group' => $this->input->post('inEduGroup'),
                'edu_branch' => $this->input->post('inEduBranch'),
                'edu_university' => $this->input->post('inEduUniversity'),
                'edu_comment' => $this->input->post('inEduComment')
            );
            $this->My_model->insert_data('tb_human_resources_15', $arr);
        }
    }

    // edit data;
    public function hr15_edit() {
        $id = $_POST['id'];
        $row = $this->My_model->get_where_row('tb_human_resources_15', array('id' => $id));
        echo json_encode($row);
    }

    // delete data;
    public function hr15_delete() {
        $id = $_POST['id'];
        $this->My_model->delete_data('tb_human_resources_15', array('id' => $id));
    }

    // print data;
    public function hr15_print($hr_id) {
        $data['human'] = $this->My_model->get_where_row('tb_human_resources_01', array('id' => $hr_id));
        $data['rs'] = $this->My_model->join2table_where_result('tb_human_resources_01 a', 'tb_human_resources_15 b', 'b.hr_id = a.id', array('b.hr_id' => $hr_id), 'b.edu_year desc');
        $this->load->view('human_resources/reports/hr_15_report', $data);
    }

}
