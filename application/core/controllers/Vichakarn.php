<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/*
  | ----------------------------------------------------------------------------
  |  Title      Vichakarn
  | ----------------------------------------------------------------------------
  | Copyright	Edutech Co.,Ltd.
  | Purpose     Vichakarn Controller
  | Author
  | Create Date
  | Last edit	-
  | Comment	-
  | ----------------------------------------------------------------------------
 */

Class Vichakarn extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model("Vichakarn_model");
        //$this->load->library('mpdf/mpdf');
    }

    // index
    public function index() {
        
    }

//----------------แหล่งเรียนรู้ในท้องถิ่น------------------
    public function km() {
        $data['rs'] = $this->Vichakarn_model->get_tour_place();
        $this->load->view("layout/header");
        $this->load->view("vichakarn/km", $data);
        $this->load->view("layout/footer");
    }

    //เรียกหน้าเพิ่มแหล่งเรียนรู้
    public function km_insert_view() {
        $this->load->view("layout/header");
        $this->load->view("Vichakarn/km_insert_view");
        $this->load->view("layout/footer");
    }

    // edit
    public function km_edit() {
        $id = $_POST['id'];
        $rs = $this->Vichakarn_model->get_km_edit($id);
        echo json_encode($rs);
    }

    public function km_detailx() {
        $id = $_POST['id'];
        $rs = $this->Vichakarn_model->get_km_edit($id);
        $outp = "<table style='width:100%;font-size:1em;'>"
                . "<tr>"
                . "<td class='data-title'>ชื่อแหล่งเรียนรู้xxxx</td>"
                . "<td class='data-show'>{$rs['km_name']}</td>"
                . "</tr>"
                . "<tr>"
                . "<td class='data-title'>ประเภทของแหล่งเรียนรู้</td>"
                . "<td class='data-show'>{$rs['km_type']}</td>"
                . "</tr>"
                . "<tr>"
                . "<td class='data-title'>ชนิดของแหล่งเรียนรู้</td>"
                . "<td class='data-show'>{$rs['km_kind']}</td>"
                . "</tr>"
                . "<tr>"
                . "<td class='data-title'>ที่อยู่-ที่ตั้ง</td>"
                . "<td class='data-show'>เลขที่ {$rs['km_add_no']} หมู่ที่ {$rs['km_add_moo']} {$rs['km_add_village']} ถนน{$rs['km_add_road']} ตำบล{$rs['km_add_tambol']} อำเภอ{$rs['km_add_amphur']} จังหวัด{$rs['km_add_province']} {$rs['km_add_zipcode']} </td>"
                . "</tr>"
                . "<tr>"
                . "<td class='data-title'>เบอร์โทรศัพท์</td>"
                . "<td class='data-show'>{$rs['km_phone']}</td>"
                . "</tr>"
                . "<tr>"
                . "<td class='data-title'>อีเมล์</td>"
                . "<td class='data-show'>{$rs['km_email']}</td>"
                . "</tr>"
                . "<tr>"
                . "<td class='data-title'>เว็บไซต์</td>"
                . "<td class='data-show'>{$rs['km_website']}</td>"
                . "</tr>"
                . "<tr>"
                . "<td class='data-title'>ประวัติของแหล่งเรียนรู้</td>"
                . "<td class='data-show'>{$rs['km_history']}</td>"
                . "</tr>"
                . "<tr>"
                . "<td class='data-title'>ประโยชน์แหล่งเรียนรู้</td>"
                . "<td class='data-show'>{$rs['km_benefit']}</td>"
                . "</tr>"
                . "</table>";

        $outp .= "<table style='width:100%;margin-top:20px;'>"
                . "<tr><td>";
        if (file_exists('upload/' . $rs['km_image_1']) && !empty($rs['km_image_1'])) {
            $outp .= img(array('src' => base_url() . "upload/" . $rs['km_image_1'], 'style' => "width:280px;height:200px;", 'class' => 'thumbnail'));
        }
        if (file_exists('upload/' . $rs['km_image_2']) && !empty($rs['km_image_2'])) {
            $outp .= img(array('src' => base_url() . "upload/" . $rs['km_image_2'], 'style' => "width:280px;height:200px;", 'class' => 'thumbnail'));
        }
        $outp .= "</td></tr>";
        $outp .= "</td></tr>"
                . "";
        if (file_exists('upload/' . $rs['km_image_3']) && !empty($rs['km_image_3'])) {
            $outp .= img(array('src' => base_url() . "upload/" . $rs['km_image_3'], 'style' => "width:280px;height:200px;", 'class' => 'thumbnail'));
        }
        $outp .= "</td></tr>"
                . "";
        if (file_exists('upload/' . $rs['km_image_4']) && !empty($rs['km_image_4'])) {
            $outp .= img(array('src' => base_url() . "upload/" . $rs['km_image_4'], 'style' => "width:280px;height:200px;", 'class' => 'thumbnail'));
        }
        $outp .= "</td></tr>"
                . "</table>";
        echo $outp;
    }

    //save km_insert
    public function km_insert() {
        if ($_FILES['inKmImage1']['name'] != "") {
            $config = array(
                "upload_path" => "upload/",
                "allowed_types" => "jpg",
                "max_size" => 0,
                "file_name" => md5(date("YmdHis"))
            );
            $this->upload->initialize($config);
            $this->upload->do_upload("inKmImage1");
            $data = $this->upload->data();

            $this->load->library("image_lib");
            $config['image_library'] = "gd2";
            $config["source_image"] = "upload/" . $data['file_name'];
            $config['maintain_ratio'] = TRUE;
            $config['width'] = 600;
            $config['height'] = 500;

            $this->image_lib->initialize($config);
            $this->image_lib->resize();
            $filename1 = $data['file_name'];
        } else {
            $filename1 = "";
        }
        //
        if ($_FILES['inKmImage2']['name'] != "") {
            $config = array(
                "upload_path" => "upload/",
                "allowed_types" => "jpg",
                "max_size" => 0,
                "file_name" => md5(date("YmdHis"))
            );
            $this->upload->initialize($config);
            $this->upload->do_upload("inKmImage2");
            $data = $this->upload->data();

            $this->load->library("image_lib");
            $config['image_library'] = "gd2";
            $config["source_image"] = "upload/" . $data['file_name'];
            $config['maintain_ratio'] = TRUE;
            $config['width'] = 600;
            $config['height'] = 500;

            $this->image_lib->initialize($config);
            $this->image_lib->resize();
            $filename2 = $data['file_name'];
        } else {
            $filename2 = "";
        }
        //
        if ($_FILES['inKmImage3']['name'] != "") {
            $config = array(
                "upload_path" => "upload/",
                "allowed_types" => "jpg",
                "max_size" => 0,
                "file_name" => md5(date("YmdHis"))
            );
            $this->upload->initialize($config);
            $this->upload->do_upload("inKmImage3");
            $data = $this->upload->data();

            $this->load->library("image_lib");
            $config['image_library'] = "gd2";
            $config["source_image"] = "upload/" . $data['file_name'];
            $config['maintain_ratio'] = TRUE;
            $config['width'] = 600;
            $config['height'] = 500;

            $this->image_lib->initialize($config);
            $this->image_lib->resize();
            $filename3 = $data['file_name'];
        } else {
            $filename3 = "";
        }
        //
        if ($_FILES['inKmImage4']['name'] != "") {
            $config = array(
                "upload_path" => "upload/",
                "allowed_types" => "jpg",
                "max_size" => 0,
                "file_name" => md5(date("YmdHis"))
            );
            $this->upload->initialize($config);
            $this->upload->do_upload("inKmImage4");
            $data = $this->upload->data();

            $this->load->library("image_lib");
            $config['image_library'] = "gd2";
            $config["source_image"] = "upload/" . $data['file_name'];
            $config['maintain_ratio'] = TRUE;
            $config['width'] = 600;
            $config['height'] = 500;

            $this->image_lib->initialize($config);
            $this->image_lib->resize();
            $filename4 = $data['file_name'];
        } else {
            $filename4 = "";
        }
        //
        $arr = array(
            "km_name" => $this->input->post('inKmName'),
            "km_type" => $this->input->post('inKmType'),
            "km_kind" => $this->input->post('inKmKind'),
            "km_add_no" => $this->input->post('inKmAddNo'),
            "km_add_moo" => $this->input->post('inKmAddMoo'),
            "km_add_village" => $this->input->post('inKmAddVillage'),
            "km_add_road" => $this->input->post('inKmAddRoad'),
            "km_add_tambol" => $this->input->post('inKmAddTambol'),
            "km_add_amphur" => $this->input->post('inKmAddAmphur'),
            "km_add_province" => $this->input->post('inKmAddProvince'),
            "km_add_zipcode" => $this->input->post('inKmAddZipcode'),
            "km_phone" => $this->input->post('inKmPhone'),
            "km_email" => $this->input->post('inKmEmail'),
            "km_website" => $this->input->post('inKmWebsite')
        );
        $this->My_model->insert_data('tb_km_base', $arr);
        $id = $this->db->insert_id();

        /* ------------------------------------------------------------------- */
        // บันทึก tb_km_history;
        $arr = array("km_id" => $id, "km_history" => $this->input->post("inKmHistory"), "km_benefit" => $this->input->post("inKmBenefit"));
        $this->My_model->insert_data("tb_km_history", $arr);
        // บันทึก tb_km_picture
        $arr = array("km_id" => $id, "km_image_1" => $filename1, 'km_image_2' => $filename2, "km_image_3" => $filename3, "km_image_4" => $filename4);
        $this->My_model->insert_data("tb_km_picture", $arr);
    }

    // km_delete
    public function km_delete() {
        $id = $_POST['id'];
        $this->My_model->delete_data('tb_km_base', array('id' => $id));
    }

    //km_update
    public function km_update() {
        $id = $_POST['bid'];
        ////////////ภาพ////////
        if ($_FILES['inKmImage1']['name'] != "") {
            $row = $this->My_model->get_where_row("tb_km_picture", array("km_id" => $id));
            @unlink("upload/" . $row['km_image_1']);
            $config = array(
                "upload_path" => "upload/",
                "allowed_types" => "jpg",
                "max_size" => 0,
                "file_name" => md5(date("YmdHis"))
            );
            $this->upload->initialize($config);
            $this->upload->do_upload("inKmImage1");
            $data = $this->upload->data();

            $this->load->library("image_lib");
            $config['image_library'] = "gd2";
            $config["source_image"] = "upload/" . $data['file_name'];
            $config['maintain_ratio'] = TRUE;
            $config['width'] = 600;
            $config['height'] = 500;
            $this->image_lib->initialize($config);
            $this->image_lib->resize();
            //
            $arr = array("km_image_1" => $data['file_name']);
            $this->My_model->update_data("tb_km_picture", array("km_id" => $id), $arr);
        }
        //
        if ($_FILES['inKmImage2']['name'] != "") {
            $config = array(
                "upload_path" => "upload/",
                "allowed_types" => "jpg",
                "max_size" => 0,
                "file_name" => md5(date("YmdHis"))
            );
            $this->upload->initialize($config);
            $this->upload->do_upload("inKmImage2");
            $data = $this->upload->data();

            $this->load->library("image_lib");
            $config['image_library'] = "gd2";
            $config["source_image"] = "upload/" . $data['file_name'];
            $config['maintain_ratio'] = TRUE;
            $config['width'] = 600;
            $config['height'] = 500;

            $this->image_lib->initialize($config);
            $this->image_lib->resize();
            $arr = array("km_image_2" => $data['file_name']);
            $this->My_model->update_data("tb_km_picture", array("km_id" => $id), $arr);
        }
        //
        if ($_FILES['inKmImage3']['name'] != "") {
            $config = array(
                "upload_path" => "upload/",
                "allowed_types" => "jpg",
                "max_size" => 0,
                "file_name" => md5(date("YmdHis"))
            );
            $this->upload->initialize($config);
            $this->upload->do_upload("inKmImage3");
            $data = $this->upload->data();

            $this->load->library("image_lib");
            $config['image_library'] = "gd2";
            $config["source_image"] = "upload/" . $data['file_name'];
            $config['maintain_ratio'] = TRUE;
            $config['width'] = 600;
            $config['height'] = 500;

            $this->image_lib->initialize($config);
            $this->image_lib->resize();
            $arr = array("km_image_3" => $data['file_name']);
            $this->My_model->update_data("tb_km_picture", array("km_id" => $id), $arr);
        }
        //
        if ($_FILES['inKmImage4']['name'] != "") {
            $config = array(
                "upload_path" => "upload/",
                "allowed_types" => "jpg",
                "max_size" => 0,
                "file_name" => md5(date("YmdHis"))
            );
            $this->upload->initialize($config);
            $this->upload->do_upload("inKmImage4");
            $data = $this->upload->data();

            $this->load->library("image_lib");
            $config['image_library'] = "gd2";
            $config["source_image"] = "upload/" . $data['file_name'];
            $config['maintain_ratio'] = TRUE;
            $config['width'] = 600;
            $config['height'] = 500;

            $this->image_lib->initialize($config);
            $this->image_lib->resize();
            $arr = array("km_image_4" => $data['file_name']);
            $this->My_model->update_data("tb_km_picture", array("km_id" => $id), $arr);
        }
        //
        //////////////ภาพปิด///////////
        $arr = array(
            "km_name" => $this->input->post("inKmName"),
            "km_type" => $this->input->post("inKmType"),
            "km_kind" => $this->input->post("inKmKind"),
            "km_add_no" => $this->input->post("inKmAddNo"),
            "km_add_moo" => $this->input->post("inKmAddMoo"),
            "km_add_village" => $this->input->post("inKmAddVillage"),
            "km_add_road" => $this->input->post("inKmAddRoad"),
            "km_add_tambol" => $this->input->post("inKmAddTambol"),
            "km_add_amphur" => $this->input->post("inKmAddAmphur"),
            "km_add_province" => $this->input->post("inKmAddProvince"),
            "km_add_zipcode" => $this->input->post("inKmAddZipcode"),
            "km_phone" => $this->input->post("inKmPhone"),
            "km_email" => $this->input->post("inKmEmail"),
            "km_website" => $this->input->post("inKmWebsite")
        );
        if ($id != "") {
            $this->My_model->update_data('tb_km_base', array('id' => $id), $arr);
        }
        /* ------------------------------------------------------------------- */
        // บันทึก tb_km_history;
        $arr = array("km_history" => $this->input->post("inKmHistory"), "km_benefit" => $this->input->post("inKmBenefit"));
        $this->My_model->update_data("tb_km_history", array('km_id' => $id), $arr);
    }
    
    // km_print
    public function km_print($id){
        $data['rs']=$this->Vichakarn_model->get_km_edit($id);
        $this->load->view('vichakarn/reports/km_print',$data);
    }

//----------------จบ-------------------------------
// -------------------งานวางแผนการศึกษาและปฏิทินปฏิบัติงานงานวางแผนการศึกษาและปฏิทินปฏิบัติงาน---------------------------------
    // หน้าจอหลักของงานวางแผนการศึกษาและปฏิทินปฏิบัติงานงานวางแผนการศึกษาและปฏิทินปฏิบัติงาน
    public function activity_plan() {
        if ($this->session->userdata("status") == "") {
            redirect('login');
        } else if ($this->session->userdata("status") == "ผู้ปฏิบัติงาน") {
            $monthly = date("Y-m-1");
            $monthly2 = date("Y-m-31");
            $this->db->where('tb_activity_plan_start_date >=', $monthly);
            $this->db->where('tb_activity_plan_end_date <=', $monthly2);
            $data['rs'] = $this->My_model->get_where_order("tb_activity_plan", array("tb_activity_plan_department" => "ฝ่ายวิชาการ"), "tb_activity_plan_start_date asc");
            $monthly = date("Y-10-1");
            $monthly2 = date("Y-9-30", strtotime('+1 year'));
            $this->db->where('tb_activity_plan_start_date >=', $monthly);
            $this->db->where('tb_activity_plan_end_date <=', $monthly2);
            $data['rsY'] = $this->My_model->get_where_order("tb_activity_plan", array("tb_activity_plan_department" => "ฝ่ายวิชาการ"), "tb_activity_plan_start_date asc");
            //กลับมาเพิ่มเงื่อนไขช่วงเวลาอีกที
            $this->load->view("layout/header");
            if ($this->session->userdata("department") == "กองการศึกษา") {
                $this->load->view("vichakarn/activity_plan", $data);
            } else {
                $this->load->view("vichakarn/school/activity_plan", $data);
            }
            
            $this->load->view('layout/footer');
        }
    }

    // บันทึก
    public function activity_plan_add() {
        $id = $_POST['id'];
        $arr = array(
            "tb_activity_plan_subject" => $this->input->post('inActivityPlanSubject'),
            "tb_activity_plan_type" => $this->input->post('inActivityPlanType'),
            "tb_activity_plan_detail" => $this->input->post('inActivityPlanDetail'),
            "tb_activity_plan_place" => $this->input->post('inActivityPlanPlace'),
            "tb_activity_plan_start_date" => $this->input->post('inActivityPlanStartDate'),
            "tb_activity_plan_end_date" => $this->input->post('inActivityPlanEndDate'),
            "tb_activity_plan_public" => $this->input->post('inActivityPlanPublic'),
            "tb_activity_plan_status" => 'A',
            "tb_activity_plan_create_date" => date('Y-m-d H:i:s'),
            "tb_activity_plan_responsible" => $this->session->userdata("responsible"),
            "tb_activity_plan_create_by" => $this->session->userdata("name")
        );
        if ($id != "") {

            $arr = array(
                "tb_activity_plan_subject" => $this->input->post('inActivityPlanSubject'),
                "tb_activity_plan_type" => $this->input->post('inActivityPlanType'),
                "tb_activity_plan_detail" => $this->input->post('inActivityPlanDetail'),
                "tb_activity_plan_place" => $this->input->post('inActivityPlanPlace'),
                "tb_activity_plan_start_date" => $this->input->post('inActivityPlanStartDate'),
                "tb_activity_plan_end_date" => $this->input->post('inActivityPlanEndDate'),
                "tb_activity_plan_public" => $this->input->post('inActivityPlanPublic'),
                "tb_activity_plan_status" => $this->input->post('inActivityPlanStatus'),
                "tb_activity_plan_update_date" => date('Y-m-d H:i:s'),
                "tb_activity_plan_responsible" => $this->session->userdata("responsible"),
                "tb_activity_plan_update_by" => $this->session->userdata("name")
            );

            $this->My_model->update_data('tb_activity_plan', array('id' => $id), $arr);
        } else {
            $arr = array(
                "tb_activity_plan_subject" => $this->input->post('inActivityPlanSubject'),
                "tb_activity_plan_type" => $this->input->post('inActivityPlanType'),
                "tb_activity_plan_detail" => $this->input->post('inActivityPlanDetail'),
                "tb_activity_plan_place" => $this->input->post('inActivityPlanPlace'),
                "tb_activity_plan_start_date" => $this->input->post('inActivityPlanStartDate'),
                "tb_activity_plan_end_date" => $this->input->post('inActivityPlanEndDate'),
                "tb_activity_plan_public" => $this->input->post('inActivityPlanPublic'),
                "tb_activity_plan_status" => $this->input->post('inActivityPlanStatus'),
                "tb_activity_plan_create_date" => date('Y-m-d H:i:s'),
                "tb_activity_plan_responsible" => $this->session->userdata("responsible"),
                "tb_activity_plan_create_by" => $this->session->userdata("name")
            );
            $this->My_model->insert_data("tb_activity_plan", $arr);
        }
    }

    // แก้ไขข้อมูล
    public function activity_plan_edit() {
        $id = $_POST['id'];
        $rs = $this->My_model->get_where_row('tb_activity_plan', array('id' => $id));
        echo json_encode($rs);
    }

    // ลบข้อมูล
    public function activity_plan_delete() {
        $id = $_POST['id'];
        $this->My_model->delete_data('tb_activity_plan', array('id' => $id));
    }

    // --------------- สิ้นสุดงานวางแผนการศึกษาและปฏิทินปฏิบัติงาน ----------------------------------
    //-------------งานประกันคุณภาพ------------
    //----------หน้าจอหลัก--------------------
    public function school_qa_report() {

        $results = $this->Vichakarn_model->get_qa_chart();
        $data['chart_data'] = $results['chart_data'];
        $data['min_year'] = $results['min_year'];
        $data['max_year'] = $results['max_year'];
        $this->load->view("layout/header");
        $this->load->view("vichakarn/qa", $data);
        $this->load->view('layout/footer');
    }

    //----------หน้าผลการรายงาน-------------
    public function qa_standard() {
        
    }

    //--------------------------------------
}
