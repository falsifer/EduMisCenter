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
  | Last edit	9/2/2562
  | Comment	-
  | ----------------------------------------------------------------------------
 */

Class Oc extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model("My_model");
        $this->load->model("Hr_model");
        $this->load->model("Chairatto_model");
    }

// index
    public function index() {
        
    }

//----------------ข้อมูลนักเรียน-------------------------------//
//---------เรียก View---------//
    public function oc_base() {
        $parm = $this->input->get("dept");
        if (isset($parm)) {
            $data['rs'] = $this->Hr_model->get_hr($parm);
            $data['parameterdept'] = $parm;
        } else {
            $data['rs'] = $this->Hr_model->get_hr($this->session->userdata('department'));
            $data['parameterdept'] = $this->session->userdata('department');
        }

        $data['tbDivision'] = $this->My_model->get_where_order('tb_division',array('tb_school_id'=>$this->session->userdata('sch_id')),'id asc');
        $data['tbGroupLearning'] = $this->My_model->get_all('tb_group_learning');

        $this->load->view("layout/header");
        $this->load->view("human_resources/hr_organize_chart_view", $data);
        $this->load->view("layout/footer");
    }

//-------- End view -------//  
    public function hr_executive_oc() {
        $output = "";
        $name = $this->input->post("name");
        $parm = $this->input->get("dept");

        $checkp = "";

        if (isset($parm)) {
            $checkp = $parm;
        } else {
            $checkp = $this->session->userdata('department');
        }
        $this->db->select("*,CONCAT (hr_thai_symbol,hr_thai_name,\" \",hr_thai_lastname) as fullname")->from("tb_human_resources_01");
        $this->db->order_by("hr_division_class");
        $this->db->where("hr_type_id", $name);
        $this->db->where("hr_department", $checkp);
        $MyQ = $this->db->get()->result();
        $count = count($MyQ);

        if ($count > 0) {
            $i = 1;
            foreach ($MyQ as $r) {
                if ($r->hr_rank == "ผู้อำนวยการ") {
                    $output .= "<div class=\"row\">";
                    $output .= "<div class=\"col-md-5 col-md-offset-4 form-group \">";
                    $output .= "<div class=\"panel panel-primary\">";
                    $output .= "<div class=\"panel-heading\"><center>ผู้อำนวยการ</center></div>";
                    $output .= "<div class=\"panel-body\">";

                    $output .= "<div class=\"row\">";
                    $output .= "<center>";
                    if (file_exists(hr_path($r->id, $this->session->userdata('sch_id')) . $r->hr_image) && !empty($r->hr_image)) {
                        $output .= img(array('src' => hr_path($r->id, $this->session->userdata('sch_id')) . $r->hr_image, "style" => "width:238px;height:250px;border:5px solid #C0C0C0;")) . nbs(5);
                    } else {
                        $output .= img(array('src' => "upload/MyDefaultStdPic.jpg", "style" => "width:238px;height:250px;border:5px solid #C0C0C0;")) . nbs(5);
                    }
                    $output .= "</center>";
                    $output .= "</div>";

                    $output .= "<br>";
                    $output .= "<div class=\"row\">";
                    $output .= "<center><label class=\"control-label\">";
                    $output .= "" . $r->fullname . " (" . $r->hr_degree . ")";
                    $output .= "</label></center>";
                    $output .= "</div>";



                    $output .= "</div>";
                    $output .= "</div>";
                    $output .= "</div>";
                    $output .= "</div>";
                } else {
                    $output .= "<div class=\"col-md-3 col-md-offset-1 form-group \">";
                    $output .= "<div class=\"panel panel-primary\">";
                    $output .= "<div class=\"panel-heading\"><center>บุคลากรภายในโรงเรียน</center></div>";
                    $output .= "<div class=\"panel-body\">";

                    $output .= "<div class=\"row\">";
                    $output .= "<center>";
//                    if (file_exists(hr_path($r->id, $this->session->userdata('sch_id')) . $r->hr_image) && !empty($r->hr_image)) {
                        $output .= img(array('src' => hr_path($r->id, $this->session->userdata('sch_id')) . $r->hr_image, "style" => "width:120px;height:150px;border:5px solid #C0C0C0;")) . nbs(5);
//                    } else {
//                        $output .= img(array('src' => "upload/MyDefaultStdPic.jpg", "style" => "width:120px;height:150px;border:5px solid #C0C0C0;")) . nbs(5);
//                    }
                    $output .= "</center>";
                    $output .= "</div>";

                    $output .= "<br>";
                    $output .= "<div class=\"row\">";
                    $output .= "<center><label class=\"control-label\">";
                    $output .= "" . $r->fullname . " (" . $r->hr_degree . ")";
                    $output .= "</label></center>";
                    $output .= "</div>";



                    $output .= "</div>";
                    $output .= "</div>";
                    $output .= "</div>";
                }


                $i++;
            }
        }
        echo $output;
    }
    
    public function group_learning_oc() {
        $output = "";
        $name = $this->input->post("name");
        $parm = $this->input->get("dept");

        $checkp = "";

        if (isset($parm)) {
            $checkp = $parm;
        } else {
            $checkp = $this->session->userdata('department');
        }


        $this->db->select("*,CONCAT (hr_thai_symbol,hr_thai_name,\" \",hr_thai_lastname) as fullname")->from("tb_human_resources_01");
        $this->db->order_by("hr_group_learning_class");
        $this->db->where("hr_group_learning", $name);
        $this->db->where("hr_department", $checkp);
        $MyQ = $this->db->get()->result();
        $count = count($MyQ);

        if ($count > 0) {
            $i = 1;
            foreach ($MyQ as $r) {
                if ($r->hr_group_learning_class == "หัวหน้า") {
                    $output .= "<div class=\"row\">";
                    $output .= "<div class=\"col-md-5 col-md-offset-4 form-group \">";
                    $output .= "<div class=\"panel panel-primary\">";
                    $output .= "<div class=\"panel-heading\"><center>หัวหน้ากลุ่มสาระ(" . $name . ")</center></div>";
                    $output .= "<div class=\"panel-body\">";

                    $output .= "<div class=\"row\">";
                    $output .= "<center>";
                    if (file_exists(hr_path($r->id, $this->session->userdata('sch_id')) . $r->hr_image) && !empty($r->hr_image)) {
                        $output .= img(array('src' => hr_path($r->id, $this->session->userdata('sch_id')) . $r->hr_image, "style" => "width:238px;height:250px;border:5px solid #C0C0C0;")) . nbs(5);
                    } else {
                        $output .= img(array('src' => "upload/MyDefaultStdPic.jpg", "style" => "width:238px;height:250px;border:5px solid #C0C0C0;")) . nbs(5);
                    }
                    $output .= "</center>";
                    $output .= "</div>";

                    $output .= "<br>";
                    $output .= "<div class=\"row\">";
                    $output .= "<center><label class=\"control-label\">";
                    $output .= "" . $r->fullname . " (" . $r->hr_degree . ")";
                    $output .= "</label></center>";
                    $output .= "</div>";



                    $output .= "</div>";
                    $output .= "</div>";
                    $output .= "</div>";
                    $output .= "</div>";
                } else {
                    $output .= "<div class=\"col-md-3 col-md-offset-1 form-group \">";
                    $output .= "<div class=\"panel panel-primary\">";
                    $output .= "<div class=\"panel-heading\"><center>เจ้าหน้าที่</center></div>";
                    $output .= "<div class=\"panel-body\">";

                    $output .= "<div class=\"row\">";
                    $output .= "<center>";
//                    if (file_exists(hr_path($r->id, $this->session->userdata('sch_id')) . $r->hr_image) && !empty($r->hr_image)) {
                        $output .= img(array('src' => hr_path($r->id, $this->session->userdata('sch_id')) . $r->hr_image, "style" => "width:120px;height:150px;border:5px solid #C0C0C0;")) . nbs(5);
//                    } else {
//                        $output .= img(array('src' => "upload/MyDefaultStdPic.jpg", "style" => "width:120px;height:150px;border:5px solid #C0C0C0;")) . nbs(5);
//                    }
                    $output .= "</center>";
                    $output .= "</div>";

                    $output .= "<br>";
                    $output .= "<div class=\"row\">";
                    $output .= "<center><label class=\"control-label\">";
                    $output .= "" . $r->fullname . " (" . $r->hr_degree . ")";
                    $output .= "</label></center>";
                    $output .= "</div>";



                    $output .= "</div>";
                    $output .= "</div>";
                    $output .= "</div>";
                }


                $i++;
            }
        }
        echo $output;
    }

    public function division_oc() {
        $output = "";
        $name = $this->input->post("name");
        $parm = $this->input->get("dept");

        $checkp = "";

        if (isset($parm)) {
            $checkp = $parm;
        } else {
            $checkp = $this->session->userdata('department');
        }
        $this->db->select("*,CONCAT (hr_thai_symbol,hr_thai_name,\" \",hr_thai_lastname) as fullname")->from("tb_human_resources_01");
        $this->db->order_by("hr_division_class");
        $this->db->where("hr_division", $name);
        $this->db->where("hr_department", $checkp);
        $MyQ = $this->db->get()->result();
        $count = count($MyQ);

        if ($count > 0) {
            $i = 1;
            foreach ($MyQ as $r) {
                if ($r->hr_division_class == "หัวหน้า") {
                    $output .= "<div class=\"row\">";
                    $output .= "<div class=\"col-md-5 col-md-offset-4 form-group \">";
                    $output .= "<div class=\"panel panel-primary\">";
                    $output .= "<div class=\"panel-heading\"><center>หัวหน้าฝ่าย(" . $name . ")</center></div>";
                    $output .= "<div class=\"panel-body\">";

                    $output .= "<div class=\"row\">";
                    $output .= "<center>";
//                    if (file_exists(hr_path($r->id, $this->session->userdata('sch_id')) . $r->hr_image) && !empty($r->hr_image)) {
                        $output .= img(array('src' => hr_path($r->id, $this->session->userdata('sch_id')) . $r->hr_image, "style" => "width:238px;height:250px;border:5px solid #C0C0C0;")) . nbs(5);
//                    } else {
//                        $output .= img(array('src' => "upload/MyDefaultStdPic.jpg", "style" => "width:238px;height:250px;border:5px solid #C0C0C0;")) . nbs(5);
//                    }
                    $output .= "</center>";
                    $output .= "</div>";

                    $output .= "<br>";
                    $output .= "<div class=\"row\">";
                    $output .= "<center><label class=\"control-label\">";
                    $output .= "" . $r->fullname . " (" . $r->hr_degree . ")";
                    $output .= "</label></center>";
                    $output .= "</div>";



                    $output .= "</div>";
                    $output .= "</div>";
                    $output .= "</div>";
                    $output .= "</div>";
                } else {
                    $output .= "<div class=\"col-md-3 col-md-offset-1 form-group \">";
                    $output .= "<div class=\"panel panel-primary\">";
                    $output .= "<div class=\"panel-heading\"><center>เจ้าหน้าที่</center></div>";
                    $output .= "<div class=\"panel-body\">";

                    $output .= "<div class=\"row\">";
                    $output .= "<center>";
//                    if (file_exists(hr_path($r->id, $this->session->userdata('sch_id')) . $r->hr_image) && !empty($r->hr_image)) {
                        $output .= img(array('src' => hr_path($r->id, $this->session->userdata('sch_id')). $r->hr_image, "style" => "width:120px;height:150px;border:5px solid #C0C0C0;")) . nbs(5);
//                    } else {
//                        $output .= img(array('src' => "upload/MyDefaultStdPic.jpg", "style" => "width:120px;height:150px;border:5px solid #C0C0C0;")) . nbs(5);
//                    }
                    $output .= "</center>";
                    $output .= "</div>";

                    $output .= "<br>";
                    $output .= "<div class=\"row\">";
                    $output .= "<center><label class=\"control-label\">";
                    $output .= "" . $r->fullname . " (" . $r->hr_degree . ")";
                    $output .= "</label></center>";
                    $output .= "</div>";



                    $output .= "</div>";
                    $output .= "</div>";
                    $output .= "</div>";
                }


                $i++;
            }
        }
        echo $output;
    }

}
