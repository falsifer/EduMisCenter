<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/*
  | ----------------------------------------------------------------------------
  |  Title
  | ----------------------------------------------------------------------------
  | Copyright	Edutech Co.,Ltd.
  | Purpose
  | Author	นายบัณฑิต ไชยดี
  | Create Date
  | Last edit	-
  | Comment	-
  | ----------------------------------------------------------------------------
 */

class develop_courses extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model("Dc_model");
        
        
        
    }

// ระบบ
    public function dc_base() {
        
        $data['rs'] = $this->Dc_model->get_dc_data();
        $this->load->view("layout/header");
        $this->load->view("develop_courses/dc_base", $data);
        $this->load->view("layout/footer");
    }
    
    
    
    public function dc_insert_gl() {
        $data['rs'] = $this->My_model->get_all_order('tb_group_learning', 'tb_group_learning_seq ASC');
        $this->load->view("layout/header");
        $this->load->view("develop_courses/dc_insert_gl",$data);
        $this->load->view("layout/footer");
    }
    
    public function dc_insert_std() {
        $data['rs'] = $this->My_model->get_all_order('tb_group_learning_item', 'tb_group_learning_id ASC');
        $data['rt'] = $this->My_model->get_all_order('tb_group_learning', 'tb_group_learning_seq ASC');
        $this->load->view("layout/header");
        $this->load->view("develop_courses/dc_insert_std",$data);
        $this->load->view("layout/footer");
    }
    public function dc_insert_kpi() {
        $data['rs'] = $this->My_model->get_all_order('tb_group_learning_item', 'tb_group_learning_id ASC');
        $data['rt'] = $this->My_model->get_all_order('tb_group_learning', 'tb_group_learning_seq ASC');
        $data['ru'] = $this->My_model->get_all_order('tb_standard_learning', 'tb_group_learning_item_id ASC');
        $this->load->view("layout/header");
        $this->load->view("develop_courses/dc_insert_kpi",$data);
        $this->load->view("layout/footer");
    }
    

//--- Code Insert ---//
    public function dc_insert_1() {
        
        $arr = array(
            "tb_group_learning_id" => $this->input->post('inTbGroupLearningId'),
            "tb_group_learning_item_content" => $this->input->post('inTbGroupLearningItemContent'),
            "tb_group_learning_item_seq" => $this->input->post('inTbGroupLearningItemSeq')
            
          
            
        );
        $this->My_model->insert_data('tb_group_learning_item', $arr);
        $id = $this->db->insert_id();
    
    
    }
    
    public function dc_insert_2() {
        
        $arr = array(
            "tb_group_learning_item_id" => $this->input->post('inTbGroupLearningItemId'),
            "tb_standard_learning_code" => $this->input->post('inTbStandardLearningCode'),
            "tb_standard_learning_content" => $this->input->post('inTbStandardLearningContent')
            
          
            
        );
        $this->My_model->insert_data('tb_standard_learning', $arr);
        $id = $this->db->insert_id();
    
    
    }
    public function dc_insert_3() {
        
        $arr = array(
            "tb_standard_learning_id" => $this->input->post('inTbStandardLearningId'),
            "tb_kpi_standard_learning_seq" => $this->input->post('inTbKpiStandardLearningSeq'),
            "tb_kpi_standard_learning_content" => $this->input->post('inTbKpiStandardLearningContent'),
            "tb_kpi_standard_learning_level" => $this->input->post('inTbKpiStandardLearningLevel')
            
          
            
        );
        $this->My_model->insert_data('tb_kpi_standard_learning', $arr);
        $id = $this->db->insert_id();
    
    
    }
    //--- end Code Insert ---//

    //----- Code Edit ------//
    public function dc_edit() {
        $id = $_POST['id'];
        $rs = $this->Dc_model->get_dc_edit();
        echo json_encode($rs);
    }

    //----- End Code Edit ------//

// delet data;
    public function dc_delete() {
        $id = $_POST['id'];
        $this->My_model->delete_data('tb_group_learning_item', array('id' => $id));
        
        
        
    }

// km network detail;
    public function bd_detail() {
        $id = $_POST['id'];
        $row = $this->My_model->get_where_row("tb_building", array("id" => $id));
        $outp = "<div class='container-fluid'>"
                . "<div class='row'>";
        
        $outp .= "<table style='width:100%;'>"
                . "<tr>"
                . "<td class='data-title' style='width:20%;'>ประเภท</td>"
                . "<td class='data-show'>{$row['bd_type']}</td>"
                . "<tr>"
                . "<td class='data-title'>ลักษณะรายละเอียด</td>"
                . "<td class='data-show'>{$row['bd_detail']}</td>"
                . "</tr>"
                . "<tr>"
                . "<td class='data-title'>จำนวนนักเรียนที่รับได้(คน)</td><td class='data-show'>{$row['bd_cap']}</td>"
                . "</tr>"
                . "</tr>"
                . "<tr>"
                . "<td class='data-title'>จำนวนห้อง</td><td class='data-show'>{$row['bd_room']}</td>"
                . "</tr>"
                . "<tr>"
                . "<td class='data-title'>ราคา/มูลค่า(บาท)</td><td class='data-show'>{$row['bd_value']}</td>"
                . "</tr>"
                . "<tr>"
                . "<td class='data-title'>ปีที่ได้รับ</td><td class='data-show'>{$row['bd_year']}</td>"
                . "</tr>"
                . "<tr>"
                . "<td class='data-title'>สภาพ</td><td class='data-show'>{$row['bd_status']}</td>"
                . "</tr>"
                        
                . "</table>";
        $outp .= "</table>";
        
        

        $outp .= "</td></tr>";
        $outp .= "</div></div>";
        echo $outp;
    }
    

//--- Code Update ---//
    public function bd_update() {

        $id = $_POST['id'];
        if ($_FILES['inBdImg1']['name'] != "") {
            $row = $this->My_model->get_where_row("tb_building_img", array("bd_id" => $id));
            @unlink("upload/" . $row['bd_img1']);
            $config = array(
                "upload_path" => "upload/",
                "allowed_types" => "jpg",
                "max_size" => 0,
                "file_name" => md5(date("YmdHis"))
            );
            $this->upload->initialize($config);
            $this->upload->do_upload("inBdImg1");
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
            $arr = array("bd_img1" => $data['file_name']);
            $this->My_model->update_data("tb_building_img", array("bd_id" => $id), $arr);
        }
        if ($_FILES['inBdImg2']['name'] != "") {
            $row = $this->My_model->get_where_row("tb_building_img", array("bd_id" => $id));
            @unlink("upload/" . $row['bd_img2']);
            $config = array(
                "upload_path" => "upload/",
                "allowed_types" => "jpg",
                "max_size" => 0,
                "file_name" => md5(date("YmdHis"))
            );
            $this->upload->initialize($config);
            $this->upload->do_upload("inBdImg2");
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
            $arr = array("bd_img2" => $data['file_name']);
            $this->My_model->update_data("tb_building_img", array("bd_id" => $id), $arr);
        }
        if ($_FILES['inBdImg3']['name'] != "") {
            $row = $this->My_model->get_where_row("tb_building_img", array("bd_id" => $id));
            @unlink("upload/" . $row['bd_img3']);
            $config = array(
                "upload_path" => "upload/",
                "allowed_types" => "jpg",
                "max_size" => 0,
                "file_name" => md5(date("YmdHis"))
            );
            $this->upload->initialize($config);
            $this->upload->do_upload("inBdImg3");
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
            $arr = array("bd_img3" => $data['file_name']);
            $this->My_model->update_data("tb_building_img", array("bd_id" => $id), $arr);
        }
        $arr = array(
            "bd_type" => $this->input->post('inBdType'),
            "bd_detail" => $this->input->post('inBdDetail'),
            "bd_cap" => $this->input->post('inBdCap'),
            "bd_room" => $this->input->post('inBdRoom'),
            "bd_value" => $this->input->post('inBdValue'),
            "bd_year" => $this->input->post('inBdYear'),
            "bd_status" => $this->input->post('inBdStatus')
            
        );
        if ($id != "") {
            $this->My_model->update_data('tb_building', array('id' => $id), $arr);
        }
    }

    //--- End Code update ---//

}
