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

class Visit_home extends CI_Controller {

    public function __construct() {
        parent::__construct();
        if ($this->session->userdata('status') == "" && $this->session->userdata('status') !== "ผู้ปฏิบัติงาน") {
            redirect("/");
        }
        $this->load->model('Std_model');
    }

    /*
     * To change this license header, choose License Headers in Project Properties.
     * To change this template file, choose Tools | Templates
     * and open the template in the editor.
     */

    public function index() {
        $rid = $this->input->get('room_id');
        if (!isset($rid)) {
            if ($this->session->userdata('status') == "" && $this->session->userdata('status') !== "ผู้ปฏิบัติงาน") {
                redirect("/");
            }
        } else {


            $this->load->library('googlemaps');
            $config['apiKey'] = 'AIzaSyCYSxq9C7QyPsOOTjwLA3y_EtYlDvX5Im0';

            $scRS = $this->My_model->get_where_row('tb_school', array('id' => $this->session->userdata('sch_id')));

            if (isset($scRS['sc_lat'])) {
                $config['center'] = $scRS['sc_lat'] . ',' . $scRS['sc_long'];
            } else {
                $config['center'] = '15.5611959,101.9955651';
            }


            $config['zoom'] = '14';
            $config['onclick'] = 'get_GEO(event.latLng.lat(), event.latLng.lng())';
            $this->googlemaps->initialize($config);


            $rs = $this->Std_model->get_std_base_w_roomid_return_array($rid);
            if ($rs) {
                foreach ($rs as $r) {
                    $marker = array();
                    $addRS = $this->My_model->get_where_row('tb_std_address', array('std_id' => $r['StdId']));
                    if (isset($addRS['add_lat']) && isset($addRS['add_long'])) {
                        $marker['position'] = $addRS['add_lat'] . ',' . $addRS['add_long'];
                    }
//            } else {
//                $marker['position'] = $r['add_no'] . ' หมู่ ' . $r['add_moo'] . ' ตำบล' . $r['add_tambol'] . ' อำเภอ' . $r['add_amphur'] . ' จังหวัด' . $r['add_province'] . ' ' . $r['add_zipcode'];
//            }
//                    $pic = $this->My_model->get_where_row('tb_std_picture', array('own_id' => $r->StdId));

                    if (isset($r['std_profile_picture']) && !file_exists($r['std_profile_picture'])) {
                        $marker['icon'] = $r['std_profile_picture'];
                        $marker['icon_scaledSize'] = '28, 32';
                    } else {
                        $marker['icon'] = base_url('images/map_point.png');
                        $marker['icon_scaledSize'] = '30, 32';
                    }

                    $marker['infowindow_content'] = $this->get_marker_content($r['std_fullname'], $r['StdId']);
                    $this->googlemaps->add_marker($marker);
                }
            }
//
//            $map = $this->googlemaps->create_map();
//            echo $map['html'] . $map['js'];
            $data['rsT'] = $rs;
            $data['map'] = $this->googlemaps->create_map();

            $this->load->view('layout/header');
            $this->load->view('visit_home/index', $data);
            $this->load->view('layout/footer');
        }
    }

    function vh_base_default() {
        //row_array
//        $data['std'] = $this->Std_model->get_std_base_w_stdid($rid);
        $std_add = $this->Std_model->get_std_info($this->input->post('std_id'));
        echo json_encode($std_add);
    }

    function get_marker_content($tmp, $std_id) {
        $v = "<div class='panel'>";
        $v .= '<button type="button" class="btn btn-success"  /*onclick="pop(' . $std_id . ');"*/ onclick=\'ShowDetailModal(this)\'>';
        $v .= '<i class="glyphicon glyphicon-editglyphicon glyphicon-edit"></i> ดูรายงานการเยี่ยมบ้าน ' . $tmp . '</button>';
        $v .= "</div>";
        return $v;
    }

    function get_position_list($rid) {
//        $this->db->select("std.*,std.id as stdId,add.*");
//        $this->db->from('tb_student_base std');
//        $this->db->join('tb_std_address add', 'std.id=add.std_id');
//        $this->db->where(array('tb_student_base_department' => $this->session->userdata('department')))->order_by('std.id');
//        $this->db->limit(50);
//        


        $this->db->select("CONCAT (a.std_titlename,a.std_firstname,\" \",a.std_lastname) as std_fullname,a.id as stdId");
        $this->db->select("a.*,b.*,c.*,d.*,e.*,f.*");
        $this->db->select("add.*");
        $this->db->from("tb_student_base a");
        $this->db->join('tb_std_address add', 'a.id=add.std_id');
        $this->db->join("tb_ed_classroom b", "b.tb_student_base_id = a.id");
        $this->db->join("tb_ed_room c", "c.id = b.tb_ed_room_id");
        $this->db->join("tb_ed_school_register_class d", "d.id = c.tb_ed_school_register_class_id");
        $this->db->join("tb_ed_plan e", "e.id = c.tb_ed_plan_id");
        $this->db->join("tb_ed_school_class f", "f.id = d.tb_ed_school_class_id");
        $this->db->where("a.tb_student_base_status", 'S');
        if ($rid != "") {
            $this->db->where("c.id", $rid);
        }
        $this->db->where(array('a.tb_student_base_department' => $this->session->userdata('department')));
        $this->db->order_by("b.tb_ed_classroom_number asc");


        $query = $this->db->get();
        if ($query->num_rows() != 0) {
            return $query->result_array();
        }
        return array();
    }

// 
    public function vh_base() {

        if ($this->session->userdata('status') == "") {
            redirect("/");
        }

        $data['rs'] = $this->My_model->get_all_order('tb_visit_home', 'std_name ASC');

        $this->load->view("layout/header");
        $this->load->view("visit_home/vh_base", $data);
        $this->load->view("layout/footer");
    }

    public function vh_insert_view() {
        $this->load->view("layout/header");
        $this->load->view("visit_home/vh_insert_view");
        $this->load->view("layout/footer");
    }

    //----- Code Delete ------//
    public function vh_delete() {
        $id = $_POST['id'];
        $this->My_model->delete_data('tb_visit_home', array('id' => $id));
    }

    //----- End Code Delete ------//
//--- Code Insert ---//
    public function vh_insert_2() {
        if ($_FILES['inVhImg1']['name'] != "") {
            $config = array(
                "upload_path" => "upload/",
                "allowed_types" => "jpg",
                "max_size" => 0,
                "file_name" => md5(date("YmdHis"))
            );
            $this->upload->initialize($config);
            $this->upload->do_upload("inVhImg1");
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
        if ($_FILES['inVhImg2']['name'] != "") {
            $config = array(
                "upload_path" => "upload/",
                "allowed_types" => "jpg",
                "max_size" => 0,
                "file_name" => md5(date("YmdHis"))
            );
            $this->upload->initialize($config);
            $this->upload->do_upload("inVhImg2");
            $data = $this->upload->data();

            $this->load->library("image_lib");
            $config['image_library'] = "gd2";
            $config["source_image"] = "upload/" . $data['file_name'];
            $config['maintain_ratio'] = TRUE;
            $config['width'] = 1024;
            $config['height'] = 768;

            $this->image_lib->initialize($config);
            $this->image_lib->resize();
            $filename2 = $data['file_name'];
        } else {
            $filename2 = "";
        }
        $arr = array(
            "std_name" => $this->input->post('inStdName'),
            "std_no" => $this->input->post('inStdNo'),
            "std_class" => $this->input->post('inStdClass'),
            "tech_name" => $this->input->post('inTechName'),
            "date_visit" => $this->input->post('inDateVisit'),
            "addv_detail" => $this->input->post('inAddvDetail'),
            "addc_name" => $this->input->post('inAddcName'),
            "addc_detail" => $this->input->post('inAddcDetail'),
            "father_name" => $this->input->post('inFatherName'),
            "father_career" => $this->input->post('inFatherCareer'),
            "father_salary" => $this->input->post('inFatherSalary'),
            "mother_name" => $this->input->post('inMotherName'),
            "mother_career" => $this->input->post('inMotherCareer'),
            "mother_salary" => $this->input->post('inMotherSalary'),
            "parent_name" => $this->input->post('inParentName'),
            "parent_career" => $this->input->post('inParentCareer'),
            "parent_salary" => $this->input->post('inParentSalary'),
            "home_structure" => $this->input->post('inHomeStructure'),
            "home_relation" => $this->input->post('inHomeRelation'),
            "std_task" => $this->input->post('inStdTask'),
            "parent_training" => $this->input->post('inParentTraining'),
            "parent_assistance" => $this->input->post('inParentAssistance'),
            "tech_comment" => $this->input->post('inTechComment'),
            "home_distance" => $this->input->post('inHomeDistance'),
            "vh_img1" => $filename1,
            "vh_img2" => $filename2
        );
        $this->My_model->insert_data('tb_visit_home', $arr);
        $id = $this->db->insert_id();
    }

    //--- end Code Insert ---//
    //--- Code Code Detail ---//
    public function vh_base_detail() {
        $id = $_POST['id'];
        $row = $this->My_model->get_where_row("tb_visit_home", array("id" => $id));
        $outp = "<div class='container-fluid'>"
                . "<div class='row'>";
        //---- แสดงภาพประกอบ ----//

        $outp .= "<div class=\"row\">";

        $outp .= "<div class=\"col-md-6\">";
        if (file_exists("upload/" . $row['vh_img1']) && !empty($row['vh_img1'])) {
            $outp .= img(array('src' => "upload/" . $row['vh_img1'], "style" => "width:100%;height:50%;border:5px solid #C0C0C0;")) . nbs(5);
        }
        $outp .= "</div>";

        $outp .= "<div class=\"col-md-6\">";
        if (file_exists("upload/" . $row['vh_img2']) && !empty($row['vh_img2'])) {
            $outp .= img(array('src' => "upload/" . $row['vh_img2'], "style" => "width:100%;height:50%;border:5px solid #C0C0C0;")) . nbs(5);
        }
        $outp .= "</div>";

        $outp .= "</div>";
        //---- จบภาพประกอบ ----//
        //------ โชว์ข้อมูล ------//
        $outp .= "<table style='width:100%;'>"
                . "<tr>"
                . "<td class='data-title' style='width:20%;'>ชื่อนักเรียน</td>"
                . "<td class='data-show'>{$row['std_name']}</td>"
                . "<tr>"
                . "<td class='data-title'>ชั้น</td>"
                . "<td class='data-show'>{$row['std_class']}</td>"
                . "</tr>"
                . "<tr>"
                . "<td class='data-title'>เลขที่</td>"
                . "<td class='data-show'>{$row['std_no']}</td>"
                . "</tr>"
                . "<tr>"
                . "<td class='data-title'>ครูประจำชั้น/ครูที่ปรึกษา</td>"
                . "<td class='data-show'>{$row['tech_name']}</td>"
                . "<tr>"
                . "<td class='data-title'>วันที่ออกเยี่ยม</td>"
                . "<td class='data-show'>{$row['date_visit']}</td>"
                . "</tr>"
                . "<tr>"
                . "<td class='data-title'>สถานที่ไปเยี่ยม</td>"
                . "<td class='data-show'>{$row['addv_detail']}</td>"
                . "</tr>"
                . "<tr>"
                . "<td class='data-title'>สถานที่ประกอบอาชีพ</td>"
                . "<td class='data-show'>{$row['addc_name']}</td>"
                . "<tr>"
                . "<td class='data-title'>ที่ตั้งสถานที่ประกอบอาชีพ</td>"
                . "<td class='data-show'>{$row['addc_detail']}</td>"
                . "</tr>"
                . "<tr>"
                . "<td class='data-title'>ชื่อ-นามสกุลบิดา</td>"
                . "<td class='data-show'>{$row['father_name']}</td>"
                . "</tr>"
                . "<td class='data-title'>อาชีพ</td>"
                . "<td class='data-show'>{$row['father_career']}</td>"
                . "</tr>"
                . "<tr>"
                . "<td class='data-title'>รายได้ต่อเดือน(บาท)</td>"
                . "<td class='data-show'>{$row['father_salary']}</td>"
                . "<tr>"
                . "<td class='data-title'>ชื่อ-นามสกุลมารดา</td>"
                . "<td class='data-show'>{$row['mother_name']}</td>"
                . "</tr>"
                . "<tr>"
                . "<td class='data-title'>อาชีพ</td>"
                . "<td class='data-show'>{$row['mother_career']}</td>"
                . "</tr>"
                . "<tr>"
                . "<td class='data-title'>รายได้ต่อเดือน(บาท)</td>"
                . "<td class='data-show'>{$row['mother_salary']}</td>"
                . "<tr>"
                . "<td class='data-title'>ชื่อ-นามสกุลผู้ปกครอง</td>"
                . "<td class='data-show'>{$row['parent_name']}</td>"
                . "</tr>"
                . "<tr>"
                . "<td class='data-title'>อาชีพ</td>"
                . "<td class='data-show'>{$row['parent_career']}</td>"
                . "</tr>"
                . "<tr>"
                . "<td class='data-title'>รายได้ต่อเดือน(บาท)</td>"
                . "<td class='data-show'>{$row['parent_salary']}</td>"
                . "</tr>"
                . "<tr>"
                . "<td class='data-title'>สภาพบ้านและสภาพแวดล้อม</td>"
                . "<td class='data-show'>{$row['home_structure']}</td>"
                . "</tr>"
                . "<tr>"
                . "<td class='data-title'>ความสัมพันธ์ในครอบครัว</td>"
                . "<td class='data-show'>{$row['home_relation']}</td>"
                . "<tr>"
                . "<td class='data-title'>การช่วยงานของนักเรียนในครอบครัว</td>"
                . "<td class='data-show'>{$row['std_task']}</td>"
                . "</tr>"
                . "<tr>"
                . "<td class='data-title'>ผู้ปกครองช่วยอบรมดูแลนักเรียนอย่างไร</td>"
                . "<td class='data-show'>{$row['parent_training']}</td>"
                . "</tr>"
                . "<tr>"
                . "<td class='data-title'>สิ่งที่ผู้ปกครองต้องการความช่วยเหลือจากโรงเรียน</td>"
                . "<td class='data-show'>{$row['parent_assistance']}</td>"
                . "</tr>"
                . "<tr>"
                . "<td class='data-title'>ความเห็น/ข้อเสนอของครูในการเยี่ยมบ้าน</td>"
                . "<td class='data-show'>{$row['tech_comment']}</td>"
                . "</tr>"
                . "<tr>"
                . "<td class='data-title'>ระยะทางจากบ้านมาโรงเรียน</td>"
                . "<td class='data-show'>{$row['home_distance']}</td>"
                . "</tr>"
                . "</table>";
        $outp .= "</table>";
        //------ จบโชว์ข้อมูล ------//

        $outp .= "</td></tr>";
        $outp .= "</div></div>";
        echo $outp;
    }

    //--- End Code Detail ---//
    //
    //
    //----- Code Edit ------//
    public function vh_edit() {
        $id = $_POST['id'];
        $rs = $this->My_model->get_where_row("tb_visit_home", array("id" => $id));
        echo json_encode($rs);
    }

    //----- End Code Edit ------//
    //
    //
    //--- Code Update ---//
    public function vh_update() {

        $id = $_POST['id'];
        if ($_FILES['inVhImg1']['name'] != "") {
            $row = $this->My_model->get_where_row("tb_visit_home", array("id" => $id));
            @unlink("upload/" . $row['vh_img1']);
            $config = array(
                "upload_path" => "upload/",
                "allowed_types" => "jpg",
                "max_size" => 0,
                "file_name" => md5(date("YmdHis"))
            );
            $this->upload->initialize($config);
            $this->upload->do_upload("inVhImg1");
            $data = $this->upload->data();

            $this->load->library("image_lib");
            $config['image_library'] = "gd2";
            $config["source_image"] = "upload/" . $data['file_name'];
            $config['maintain_ratio'] = TRUE;
            $config['width'] = 1024;
            $config['height'] = 768;
            $this->image_lib->initialize($config);
            $this->image_lib->resize();
            //
            $arr = array("vh_img1" => $data['file_name']);
            $this->My_model->update_data("tb_visit_home", array("id" => $id), $arr);
        }

        if ($_FILES['inVhImg2']['name'] != "") {
            $row = $this->My_model->get_where_row("tb_visit_home", array("id" => $id));
            @unlink("upload/" . $row['vh_img2']);
            $config = array(
                "upload_path" => "upload/",
                "allowed_types" => "jpg",
                "max_size" => 0,
                "file_name" => md5(date("YmdHis"))
            );
            $this->upload->initialize($config);
            $this->upload->do_upload("inVhImg2");
            $data = $this->upload->data();

            $this->load->library("image_lib");
            $config['image_library'] = "gd2";
            $config["source_image"] = "upload/" . $data['file_name'];
            $config['maintain_ratio'] = TRUE;
            $config['width'] = 1024;
            $config['height'] = 768;
            $this->image_lib->initialize($config);
            $this->image_lib->resize();
            //
            $arr = array("vh_img2" => $data['file_name']);
            $this->My_model->update_data("tb_visit_home", array("id" => $id), $arr);
        }
        $arr = array(
            "std_name" => $this->input->post('inStdName'),
            "std_no" => $this->input->post('inStdNo'),
            "std_class" => $this->input->post('inStdClass'),
            "tech_name" => $this->input->post('inTechName'),
            "date_visit" => $this->input->post('inDateVisit'),
            "addv_detail" => $this->input->post('inAddvDetail'),
            "addc_name" => $this->input->post('inAddcName'),
            "addc_detail" => $this->input->post('inAddcDetail'),
            "father_name" => $this->input->post('inFatherName'),
            "father_career" => $this->input->post('inFatherCareer'),
            "father_salary" => $this->input->post('inFatherSalary'),
            "mother_name" => $this->input->post('inMotherName'),
            "mother_career" => $this->input->post('inMotherCareer'),
            "mother_salary" => $this->input->post('inMotherSalary'),
            "parent_name" => $this->input->post('inParentName'),
            "parent_career" => $this->input->post('inParentCareer'),
            "parent_salary" => $this->input->post('inParentSalary'),
            "home_structure" => $this->input->post('inHomeStructure'),
            "home_relation" => $this->input->post('inHomeRelation'),
            "std_task" => $this->input->post('inStdTask'),
            "parent_training" => $this->input->post('inParentTraining'),
            "parent_assistance" => $this->input->post('inParentAssistance'),
            "tech_comment" => $this->input->post('inTechComment'),
            "home_distance" => $this->input->post('inHomeDistance')
        );
        if ($id != "") {
            $this->My_model->update_data('tb_visit_home', array('id' => $id), $arr);
        }
    }

    public function vh_insert() {

        $id = $this->input->post('inStdId');

        $arr = array(
            "add_lat" => $this->input->post('inAddLat'),
            "add_long" => $this->input->post('inAddLong'),
        );

        $rs = $this->My_model->get_where_row('tb_std_address', array('std_id' => $id));

        if (isset($rs['id'])) {
            $this->My_model->update_data('tb_std_address', array('std_id' => $id), $arr);
        } else {
            $arr = array(
                "add_lat" => $this->input->post('inAddLat'),
                "add_long" => $this->input->post('inAddLong'),
                "std_id" => $id
            );
            $this->My_model->insert_data('tb_std_address', $arr);
        }
//        if ($id != "") {
//            $this->My_model->update_data('tb_std_address', array('std_id' => $id), $arr);
//        } else {
//            $this->My_model->insert_data('tb_std_address', $arr);
//        }
//        $id = $this->db->insert_id();
    }

    //--- End Code update ---//
}
