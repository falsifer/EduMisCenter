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

class Public_relations extends CI_Controller {

    public function __construct() {
        parent::__construct();
    }

    /*
     * To change this license header, choose License Headers in Project Properties.
     * To change this template file, choose Tools | Templates
     * and open the template in the editor.
     */

    // ประชาสัมพันธ์
    public function pr_base() {
        if ($this->session->userdata("status") == "") {
            //redirect('login');
        }
//        $data['rs'] = $this->My_model->get_where_order('tb_public_relations', array('pr_department' => $this->session->userdata('department')), 'pr_date desc');
//        $this->db->select('*');
//        $this->db->from('tb_public_relations');
//        $this->db->where(array('pr_department' => $this->session->userdata('department')));
//        $this->db->where('date(pr_date) <= date(\''.date('Y-m-d').'\')');
//        $this->db->where('date(pr_enddate) >= date(\''.date('Y-m-d').'\')');
//        $this->db->order_by('pr_date desc');
//        
//        
//        $data['rs'] = $this->db->get()->result_array();

        $data['rs'] = $this->Pr_model->get_PR();
        $this->load->view("layout/header");
        $this->load->view("public_relations/pr_base", $data);
        $this->load->view("layout/footer");
    }

    //insert data;
    public function pr_insert() {
        $id = $_POST['id'];
        if ($id != '') {
            // image 1
            if (!empty($_FILES["inPrImage1"]["name"])) {
                $row = $this->My_model->get_where_row('tb_public_relations', array('id' => $id));
                @unlink('upload/' . $row['pr_image_1']);
                $config = array(
                    "upload_path" => "upload/",
                    "allowed_types" => "jpg|png",
                    "max_size" => 0,
                    "file_name" => md5(date("YmdHis"))
                );
                $this->upload->initialize($config);
                $this->upload->do_upload("inPrImage1");
                $data = $this->upload->data();

                $this->load->library("image_lib");
                $config['image_library'] = "gd2";
                $config["source_image"] = "upload/" . $data['file_name'];
                $config['maintain_ratio'] = TRUE;
                $config['width'] = 600;
                $config['height'] = 500;

                $this->image_lib->initialize($config);
                $this->image_lib->resize();
                $img1 = $data['file_name'];
                $arr = array('pr_image_1' => $img1);
                $this->My_model->update_data('tb_public_relations', array('id' => $id), $arr);
            }
            // image 2
            if (!empty($_FILES["inPrImage2"]["name"])) {
                $row = $this->My_model->get_where_row('tb_public_relations', array('id' => $id));
                @unlink('upload/' . $row['pr_image_2']);
                $config = array(
                    "upload_path" => "upload/",
                    "allowed_types" => "jpg|png",
                    "max_size" => 0,
                    "file_name" => md5(date("YmdHis"))
                );
                $this->upload->initialize($config);
                $this->upload->do_upload("inPrImage2");
                $data = $this->upload->data();

                $this->load->library("image_lib");
                $config['image_library'] = "gd2";
                $config["source_image"] = "upload/" . $data['file_name'];
                $config['maintain_ratio'] = TRUE;
                $config['width'] = 600;
                $config['height'] = 500;

                $this->image_lib->initialize($config);
                $this->image_lib->resize();
                $img2 = $data['file_name'];
                $arr = array('pr_image_2' => $img2);
                $this->My_model->update_data('tb_public_relations', array('id' => $id), $arr);
            }
            // image 3
            if (!empty($_FILES["inPrImage3"]["name"])) {
                $row = $this->My_model->get_where_row('tb_public_relations', array('id' => $id));
                @unlink('upload/' . $row['pr_image_3']);
                $config = array(
                    "upload_path" => "upload/",
                    "allowed_types" => "jpg|png",
                    "max_size" => 0,
                    "file_name" => md5(date("YmdHis"))
                );
                $this->upload->initialize($config);
                $this->upload->do_upload("inPrImage3");
                $data = $this->upload->data();

                $this->load->library("image_lib");
                $config['image_library'] = "gd2";
                $config["source_image"] = "upload/" . $data['file_name'];
                $config['maintain_ratio'] = TRUE;
                $config['width'] = 600;
                $config['height'] = 500;

                $this->image_lib->initialize($config);
                $this->image_lib->resize();
                $img3 = $data['file_name'];
                $arr = array('pr_image_3' => $img3);
                $this->My_model->update_data('tb_public_relations', array('id' => $id), $arr);
            }
            // image 4
            if (!empty($_FILES["inPrImage4"]["name"])) {
                $row = $this->My_model->get_where_row('tb_public_relations', array('id' => $id));
                @unlink('upload/' . $row['pr_image_4']);
                $config = array(
                    "upload_path" => "upload/",
                    "allowed_types" => "jpg|png",
                    "max_size" => 0,
                    "file_name" => md5(date("YmdHis"))
                );
                $this->upload->initialize($config);
                $this->upload->do_upload("inPrImage4");
                $data = $this->upload->data();

                $this->load->library("image_lib");
                $config['image_library'] = "gd2";
                $config["source_image"] = "upload/" . $data['file_name'];
                $config['maintain_ratio'] = TRUE;
                $config['width'] = 600;
                $config['height'] = 500;

                $this->image_lib->initialize($config);
                $this->image_lib->resize();
                $img4 = $data['file_name'];
                $arr = array('pr_image_4' => $img4);
                $this->My_model->update_data('tb_public_relations', array('id' => $id), $arr);
            }
            //
            $arr = array(
                'pr_date' => $this->input->post('inPrDate'),
                'pr_enddate' => $this->input->post('inPrEndDate'),
                'pr_topic' => $this->input->post('inPrTopic'),
                'pr_detail' => $this->input->post('inPrDetail'),
                'pr_owner' => $this->session->userdata('name'),
                'hr_id' => $this->session->userdata('hr_id'),
                'tb_school_id' => $this->session->userdata('sch_id'),
                "pr_status" => $this->input->post('inPRStatus'),
                'pr_department' => $this->session->userdata('department'),
            );
            $this->My_model->update_data('tb_public_relations', array('id' => $id), $arr);
        } else {
            // image 1
            if (!empty($_FILES["inPrImage1"]["name"])) {
                $config = array(
                    "upload_path" => "upload/",
                    "allowed_types" => "jpg|png",
                    "max_size" => 0,
                    "file_name" => md5(date("YmdHis"))
                );
                $this->upload->initialize($config);
                $this->upload->do_upload("inPrImage1");
                $data = $this->upload->data();

                $this->load->library("image_lib");
                $config['image_library'] = "gd2";
                $config["source_image"] = "upload/" . $data['file_name'];
                $config['maintain_ratio'] = TRUE;
                $config['width'] = 600;
                $config['height'] = 500;

                $this->image_lib->initialize($config);
                $this->image_lib->resize();
                $img1 = $data['file_name'];
            } else {
                $img1 = "";
            }
            // image 2
            if (!empty($_FILES["inPrImage2"]["name"])) {
                $config = array(
                    "upload_path" => "upload/",
                    "allowed_types" => "jpg|png",
                    "max_size" => 0,
                    "file_name" => md5(date("YmdHis"))
                );
                $this->upload->initialize($config);
                $this->upload->do_upload("inPrImage2");
                $data = $this->upload->data();

                $this->load->library("image_lib");
                $config['image_library'] = "gd2";
                $config["source_image"] = "upload/" . $data['file_name'];
                $config['maintain_ratio'] = TRUE;
                $config['width'] = 600;
                $config['height'] = 500;

                $this->image_lib->initialize($config);
                $this->image_lib->resize();
                $img2 = $data['file_name'];
            } else {
                $img2 = "";
            }
            // image 3
            if (!empty($_FILES["inPrImage3"]["name"])) {
                $config = array(
                    "upload_path" => "upload/",
                    "allowed_types" => "jpg|png",
                    "max_size" => 0,
                    "file_name" => md5(date("YmdHis"))
                );
                $this->upload->initialize($config);
                $this->upload->do_upload("inPrImage3");
                $data = $this->upload->data();

                $this->load->library("image_lib");
                $config['image_library'] = "gd2";
                $config["source_image"] = "upload/" . $data['file_name'];
                $config['maintain_ratio'] = TRUE;
                $config['width'] = 600;
                $config['height'] = 500;

                $this->image_lib->initialize($config);
                $this->image_lib->resize();
                $img3 = $data['file_name'];
            } else {
                $img3 = "";
            }
            // image 4
            if (!empty($_FILES["inPrImage4"]["name"])) {
                $config = array(
                    "upload_path" => "upload/",
                    "allowed_types" => "jpg|png",
                    "max_size" => 0,
                    "file_name" => md5(date("YmdHis"))
                );
                $this->upload->initialize($config);
                $this->upload->do_upload("inPrImage4");
                $data = $this->upload->data();

                $this->load->library("image_lib");
                $config['image_library'] = "gd2";
                $config["source_image"] = "upload/" . $data['file_name'];
                $config['maintain_ratio'] = TRUE;
                $config['width'] = 600;
                $config['height'] = 500;

                $this->image_lib->initialize($config);
                $this->image_lib->resize();
                $img4 = $data['file_name'];
            } else {
                $img4 = "";
            }
            //
            $arr = array(
                'pr_date' => $this->input->post('inPrDate'),
                'pr_enddate' => $this->input->post('inPrEndDate'),
                'pr_topic' => $this->input->post('inPrTopic'),
                'pr_detail' => $this->input->post('inPrDetail'),
                'pr_image_1' => $img1,
                'pr_image_2' => $img2,
                'pr_image_3' => $img3,
                'pr_image_4' => $img4,
                "pr_status" => $this->input->post('inPRStatus'),
                'pr_owner' => $this->session->userdata('name'),
                'hr_id' => $this->session->userdata('hr_id'),
                'tb_school_id' => $this->session->userdata('sch_id'),
                'pr_department' => $this->session->userdata('department')
            );
            $this->My_model->insert_data('tb_public_relations', $arr);
        }
    }

    // delete data;
    public function pr_delete() {
        $id = $_POST['id'];
        $this->My_model->delete_data('tb_public_relations', array('id' => $id));
    }

    //--- end Code Insert ---//
    //--- Code Code Detail ---//
    public function pr_detail() {

        $type = "post";
        if (isset($_POST['id'])) {
            $id = $_POST['id'];
            $type = "post";
        }

        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $type = "get";
        }
        $row = $this->My_model->get_where_row("tb_public_relations", array("id" => $id));



        $outp = "<div class='row'><div class='col-md-6'>";
        if (file_exists('upload/' . $row['pr_image_1']) && !empty($row['pr_image_1'])) {
            $outp .= img(array('src' => base_url() . 'upload/' . $row['pr_image_1'], 'style' => 'width:100%;', 'class' => 'img-thumbnail')) . nbs(3);
        }
        if (file_exists('upload/' . $row['pr_image_2']) && !empty($row['pr_image_2'])) {
            $outp .= img(array('src' => base_url() . 'upload/' . $row['pr_image_2'], 'style' => 'width:100%;', 'class' => 'img-thumbnail')) . nbs(3);
        }
        if (file_exists('upload/' . $row['pr_image_3']) && !empty($row['pr_image_3'])) {
            $outp .= img(array('src' => base_url() . 'upload/' . $row['pr_image_3'], 'style' => 'width:100%;', 'class' => 'img-thumbnail')) . nbs(3);
        }
        if (file_exists('upload/' . $row['pr_image_4']) && !empty($row['pr_image_4'])) {
            $outp .= img(array('src' => base_url() . 'upload/' . $row['pr_image_4'], 'style' => 'width:100%;', 'class' => 'img-thumbnail')) . nbs(3);
        }
        $outp .= "</div>";

        $outp .= "<div class='col-md-6'>";
        $outp .= "<h2>{$row['pr_topic']}</h2>";
        $outp .= "<div class='col-md-12'>{$row['pr_detail']}</div>";
        $outp .= "<div class='col-md-12' ";
        $outp .= "style='font-size:0.75em;border-top:solid #efefef 1px;margin-top:50px;padding:5px;text-align:right;'>";
        if (isset($row['hr_id']) && isset($row['tb_school_id'])) {
            $rs = $this->My_model->get_where_row('tb_human_resources_01', array('tb_member_id' => $this->session->userdata('member_id')));
            if (isset($rs['hr_image'])){
                $img = $rs['hr_image'];
//                if (file_exists(base_url() . hr_path($row['hr_id'], $row['tb_school_id']) . $img)) {
                $outp .= "<img src=\"".base_url() . hr_path($row['hr_id'], $row['tb_school_id']) . $img."\" class=\"img-circle\" width=\"25px\" /> ";
//                }
            }

            
        }

        $outp .= $row['pr_owner'] . " " . $row['pr_department'] . " " . datethai($row['pr_date']) . "</div>";

        $outp .= "</div>";
        $outp .= "</div>";

        if ($type == 'post') {
            echo $outp;
        } else {
            $data['outp'] = $outp;
            load_view($this, 'public_relations/pr_detail', $data);
        }
    }

// edit data
    public function pr_edit() {
        $id = $_POST['id'];
        $rs = $this->My_model->get_where_row("tb_public_relations", array("id" => $id));
        echo json_encode($rs);
    }

//
    public function pr_update() {

        $id = $_POST['id'];
        $arr = array(
            "pr_topic" => $this->input->post('inPrTopic'),
            "pr_detail" => $this->input->post('inPrDetail'),
            "pr_day" => $this->input->post('inPrDay'),
            "pr_month" => $this->input->post('inPrMonth'),
            "pr_year" => $this->input->post('inPrYear')
        );
        if ($id != "") {
            $this->My_model->update_data('tb_public_relations', array('id' => $id), $arr);
        }
    }

//--- End Code update ---//
// พิมพ์ข้อมูลการประชาสัมพันธ์
    public function pr_print() {
        $id = $this->uri->segment(2);
        $data['rs'] = $this->My_model->get_where_row('tb_public_relations', array('id' => $id));
        $this->load->view('public_relations/reports/public_relations_report', $data);
    }

}
