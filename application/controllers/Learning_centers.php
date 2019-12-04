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
  | Create Date 23/11/2561
  | Last edit	23/11/2561
  | Comment	-
  | ----------------------------------------------------------------------------
 */

Class Learning_centers extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model("Km_model");
    }

    // index
    public function index() {
        
    }

//----------------แหล่งเรียนรู้ในท้องถิ่น------------------//
    public function km_base() {
        if ($this->session->userdata('status') == '') {
            redirect('login');
        }
//        $data['rs'] = $this->Km_model->get_tour_place();
        $data['rs'] = $this->My_model->get_where_order('tb_km_base', array('km_department' => $this->session->userdata('department')), 'km_name asc');
        $this->load->view("layout/header");
        $this->load->view("learning_centers/km_base", $data);
        $this->load->view("layout/footer");
    }
    
    public function km_base_zone() {
        if ($this->session->userdata('status') == '') {
            redirect('login');
        }
        $data['rst'] = $this->My_model->get_where_order('tb_km_base',array('1'=>'1'), 'km_name asc');
        $this->load->view("layout/header");
        $this->load->view("learning_centers/km_base_zone", $data);
        $this->load->view("layout/footer");
    }

    //เรียกหน้าเพิ่มแหล่งเรียนรู้
    public function km_insert_view() {
        $this->load->view("layout/header");
        $this->load->view("learning_centers/km_insert_view");
        $this->load->view("layout/footer");
    }

    // edit
    public function km_edit() {
        $id = $_POST['id'];
        $rs = $this->Km_model->get_km_edit($id);
        echo json_encode($rs);
    }

    public function km_detail() {
        $id = $_POST['id'];
        $rs = $this->Km_model->get_km_edit($id);
        //
        $outp = "<div class='container-fluid'>"
                . "<div class='row'>";
        $outp .= "<table style='width:100%;'>"
                . "<tr>"
                . "<td class='data-title' style='width:20%;'>ชื่อแหล่งเรียนรู้</td><td class='data-show'>{$rs['km_name']}</td>"
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
                . "<td class='data-title'>อีเมล</td>"
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
                . "<td class='data-title'>ประโยชน์ของแหล่งเรียนรู้</td>"
                . "<td class='data-show'>{$rs['km_benefit']}</td>"
                . "</tr>"
                . "</table>";
        $outp .= "</table>";

        // แสดงภาพประกอบ
        $outp .= "<table style='width:100%;'>";
        $outp .= "<tr><td style='padding-top:20px;'>";
        if (file_exists("upload/" . $rs['km_image_1']) && !empty($rs['km_image_1'])) {
            $outp .= img(array('src' => "upload/" . $rs['km_image_1'], "style" => "width:238px;height:221px;border:5px solid #C0C0C0;")) . nbs(5);
        }
        if (file_exists("upload/" . $rs['km_image_2']) && !empty($rs['km_image_2'])) {
            $outp .= img(array('src' => "upload/" . $rs['km_image_2'], "style" => "width:238px;height:221px;border:5px solid #C0C0C0;")) . nbs(5);
        }
        if (file_exists("upload/" . $rs['km_image_3']) && !empty($rs['km_image_3'])) {
            $outp .= img(array('src' => "upload/" . $rs['km_image_3'], "style" => "width:238px;height:221px;border:5px solid #C0C0C0;")) . nbs(5);
        }
        if (file_exists("upload/" . $rs['km_image_4']) && !empty($rs['km_image_4'])) {
            $outp .= img(array('src' => "upload/" . $rs['km_image_4'], "style" => "width:238px;height:221px;border:5px solid #C0C0C0;")) . nbs(5);
        }

        $outp .= "</td></tr>";
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
            "km_website" => $this->input->post('inKmWebsite'),
            "km_recorder" => $this->session->userdata('name'),
            "km_department" => $this->session->userdata('department'),
        );
        $id = $this->My_model->insert_data('tb_km_base', $arr);

        /* ------------------------------------------------------------------- */
        // บันทึกข้อมูล tb_km_history;
        $arr = array("km_id" => $id, "km_history" => $this->input->post("inKmHistory"), "km_benefit" => $this->input->post("inKmBenefit"));
        $this->My_model->insert_data("tb_km_history", $arr);
        // บันทึกข้อมูล tb_km_picture
        $arr = array("km_id" => $id, "km_image_1" => $filename1, 'km_image_2' => $filename2, "km_image_3" => $filename3, "km_image_4" => $filename4);
        $this->My_model->insert_data("tb_km_picture", $arr);
    }

    // km_delete
    public function km_delete() {
        $id = $_POST['id'];
        $row = $this->My_model->get_where_row("tb_km_base", array('id' => $id)); // ดึงข้อมูลจากตารางหลัก tb_km_base;
        // ลบข้อมูลภาพประกอบ
        @unlink('upload/' . $row['km_image_1']);
        @unlink('upload/' . $row['km_image_2']);
        @unlink('upload/' . $row['km_image_3']);
        @unlink('upload/' . $row['km_image_4']);
        $this->My_model->delete_data('tb_km_history', array('km_id' => $id)); // ลบข้อมูลจาก tb_km_history
        $this->My_model->delete_data('tb_km_base', array('id' => $id)); // ลบข้อมูลจาก tb_km_base;
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
        // บันทึกข้อมูล tb_km_history;
        $arr = array("km_history" => $this->input->post("inKmHistory"), "km_benefit" => $this->input->post("inKmBenefit"));
        $this->My_model->update_data("tb_km_history", array('km_id' => $id), $arr);
    }

//----------------แหล่งเรียนรู้ในท้องถิ่นจบ-------------------------------//
}
