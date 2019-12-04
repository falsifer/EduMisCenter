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
  | Create Date 1/4/2562
  | Last edit	1/4/2562
  | Comment	-
  | ----------------------------------------------------------------------------
 */

Class Media_online extends CI_Controller {

    public function __construct() {
        parent::__construct();
        if ($this->session->userdata('status') == "") {
            redirect("/");
        }
        $this->load->model('My_model');
        $this->load->model('Mo_model');
        $this->load->model('Chairatto_model');
    }

//-------------- Media Stock ----------//
    public function ms_base() {
//$data['rsj'] = $this->My_model->get_all_order("tb_media", "id asc");
//        $data['rbase'] = $this->Mo_model->media_stock_base();
//        $data['rClass'] = $this->My_model->get_where_order('tb_ed_school_class', array('id !=' => '0'), 'id asc');
        $data['rClass'] = $this->My_model->get_where_order('tb_ed_school_class', array('id !=' => '0'), 'id asc');
        $data['rbase'] = $this->My_model->get_where_order('tb_media', array('tb_media_department' => $this->session->userdata('department')), 'id asc');
        $this->load->view("layout/header");
        $this->load->view("mo/ms_base", $data);
        $this->load->view("layout/footer");
    }

    public function ms_insert() {
        $arr = array(
//            "tb_course_id" => $this->input->post('inSubject'),
            "tb_media_name" => $this->input->post('inMdName'),
            "tb_media_type " => $this->input->post('inMdType'),
            "tb_media_description " => $this->input->post('inMdDes'),
            "tb_media_link " => $this->input->post('inMdLink'),
            "tb_media_recorder" => $this->session->userdata('name'),
            "tb_media_department" => $this->session->userdata('department'),
            "tb_media_createdate" => date('Y-m-d')
        );
        $this->My_model->insert_data('tb_media', $arr);
    }

    public function ms_delete() {
        $id = $_POST['id'];
        $rs = $this->My_model->get_where_row('tb_media', array("id" => $id));
        if (isset($rs['id'])) {
            $this->My_model->delete_data('tb_media', array("id" => $id));
            if($rs['tb_media_type']=="PDF"){
                @unlink(base_url('/upload/' . $rs['tb_media_link']));
            }
        }
    }

//========== end ==========//  
//-------------- Media online ----------//
    public function mo_base() {
//$data['rsj'] = $this->My_model->get_all_order("tb_media", "id asc");
        $data['rs'] = $this->My_model->get_where_order('tb_blog', array('tb_blog_department' => $this->session->userdata('department')), 'tb_blog_createdate desc');
        $this->load->view("layout/header");
        $this->load->view("mo/mo_base", $data);
        $this->load->view("layout/footer");
    }

    public function blog_insert() {
        $id = $this->input->post('id');
        $arr = array(
            "id" => $id,
            "tb_group_learning_id" => $this->input->post('glid'),
            "tb_ed_school_class_id" => $this->input->post('scid'),
            "tb_blog_title " => $this->input->post('title'),
            "tb_blog_content " => $this->input->post('content'),
            "tb_blog_visibility " => $this->input->post('visib'),
            "tb_blog_recorder" => $this->session->userdata('name'),
            "tb_blog_department" => $this->session->userdata('department'),
            "tb_blog_createdate" => date('Y-m-d')
        );
        if ($id != "" && $id != 0) {
            $this->My_model->update_data('tb_blog', array('id' => $id), $arr);
        } else {
            $this->My_model->insert_data('tb_blog', $arr);
        }
    }

    public function blog_edit() {
        $id = $_POST['id'];
        $rs = $this->My_model->get_where_row('tb_blog', array("id" => $id));
        echo json_encode($rs);
    }

    public function blog_detail() {

        $arr = array(
            "tb_blog_id" => $this->input->post('id'),
            "tb_blog_visiter_recorder" => $this->session->userdata('name'),
            "tb_blog_visiter_department" => $this->session->userdata('department'),
            "tb_blog_visiter_createdate" => date('Y-m-d H:i:s')
        );
        $this->My_model->insert_data('tb_blog_visiter', $arr);


        $this->db->select("*")->from("tb_blog");
        $this->db->where("id", $this->input->post('id'));
        $MyQ = $this->db->get()->result_array();
        $output = "";

        $output .= "<div class='row'>";
        $output .= "<div class='col-md-12'>";

        $output .= "<div class='row'>";
        $output .= "<h1><center>" . $MyQ[0]['tb_blog_title'] . "</center></h1>";
        $output .= "</div>";

//        $output .= "<div class='row'>";
//        $output .= "<h2><center>" . $MyQ[0]['tb_blog_title'] . " | " . $MyQ[0]['tb_blog_title'] . " | " . $MyQ[0]['tb_blog_title'] . " | " . $MyQ[0]['tb_blog_title'] . "</center></h2>";
//        $output .= "</div>";
        $output .= "<hr>";


        $output .= "<div class='row'>";
        $output .= "<div class='col-md-10 col-md-offset-1'>";
        $output .= $MyQ[0]['tb_blog_content'];
        $output .= "</div>";
        $output .= "</div>";

        $output .= "</div>";
        $output .= "</div>";

        $output .= "<hr>";

        $this->db->select("*")->from("tb_blog_history");
        $this->db->where("tb_blog_id", $MyQ[0]['id']);
        $this->db->where("tb_blog_history_recorder", $this->session->userdata('name'));
        $MyHistory = $this->db->get()->result_array();

        $MyLike = 0;
        $MyPin = 0;

        $output .= "<div class=\"row col-md-10 col-md-offset-1\" >";
        if (count($MyHistory) > 0) {
            if ($MyHistory[0]['tb_blog_history_pin'] == 1) {
                $output .= "<button type=\"button\" class=\"btn btn-danger\" onclick=\"UnPinThisBlog(this)\"><i class=\"icon-remove icon-large\" style=\"margin-right: 10px;\"> ยกเลิกปักหมุด</i></button>";
            } else {
                $output .= "<button type=\"button\" class=\"btn btn-secondary\" onclick=\"PinThisBlog(this)\"><i class=\"icon-pushpin icon-large\" style=\"margin-right: 10px;\"> ปักหมุด</i></button>";
            }
            $output .= "&nbsp;";
            if ($MyHistory[0]['tb_blog_history_like'] == 1) {
                $output .= "<button type=\"button\" class=\"btn btn-info\" onclick=\"UnLikeThisBlog(this)\"><i class=\"icon-thumbs-up icon-large\" style=\"margin-right: 10px;\"> คุณชื่นชอบเนื้อหานี้แล้ว</i></button>";
            } else {
                $output .= "<button type=\"button\" class=\"btn btn-secondary\" onclick=\"LikeThisBlog(this)\"><i class=\"icon-thumbs-up icon-large\" style=\"margin-right: 10px;\"> ชื่นชอบเนื้อหานี้</i></button>";
            }
        } else {
            $output .= "<button type=\"button\" class=\"btn btn-secondary\" onclick=\"PinThisBlog(this)\"><i class=\"icon-pushpin icon-large\" style=\"margin-right: 10px;\"> ปักหมุด</i></button>";
            $output .= "&nbsp;";
            $output .= "<button type=\"button\" class=\"btn btn-secondary\" onclick=\"LikeThisBlog(this)\"><i class=\"icon-thumbs-up icon-large\" style=\"margin-right: 10px;\"> ชื่นชอบเนื้อหานี้</i></button>";
        }


        $output .= "</div>";

        $output .= "<input type=\"hidden\" id=\"BlogId\" value=\"" . $MyQ[0]['id'] . "\">";

        echo $output;
    }

    public function blog_base_all_blog() {

        $this->db->select("*")->from("tb_blog");
        $this->db->where(array('tb_blog_department' => $this->session->userdata('department')));
        $this->db->order_by('id asc');
        $MyQ = $this->db->get()->result();

        $output = "";
        $MyColor = "black";
        foreach ($MyQ as $r) {
            switch ($r->tb_group_learning_id) {
                case 1:
                    $MyColor = "red";
                    break;
                case 2:
                    $MyColor = "brown";
                    break;
                case 3:
                    $MyColor = "pink";
                    break;
                case 4:
                    $MyColor = "sky";
                    break;
                case 5:
                    $MyColor = "blue";
                    break;
                case 6:
                    $MyColor = "green";
                    break;
                case 7:
                    $MyColor = "yellow";
                    break;
                case 8:
                    $MyColor = "violet";
                    break;
                case 9:
                    $MyColor = "silver";
                    break;
                default:
                    $MyColor = "black";
            }

//            $output .= $r->id . ",";

            $output .= "<tr>";
            $output .= "<td>";
            $output .= "<div class=\"mycardcontent\" style=\"border:solid 3px " . $MyColor . ";\">";
//            $output .= "<button type=\"button\" class=\"btn btn-link  pull-right\" onclick=\"PinBlog(this)\">";
//            $output .= "<i class=\"icon-pushpin icon-large\"></i>  ";
//            $output .= " </button>";

            $output .= "<div class=\"row\">";
//            $output .= "<div class=\"col-md-3\">" . img("images/avata.png") . "</div>";

            $output .= "<div class=\"col-md-7  col-md-offset-1 \">";

            $output .= "<div class=\"row\"><h1 class=\"pull-left\">" . $r->tb_blog_title . "</h1></div>";
//            $output .= "<div class=\"row\" onmousedown='return false;' onselectstart='return false;'> " . substr(html_entity_decode($r->tb_blog_content), 0, 200) . "<button type='button' class='btn btn-link' onclick='BlogDetail(this)' id='" . $r->id . "'> ...อ่านเพิ่มเติม</button>";

            $output .= "<div class=\"row\" style=\"margin-top: 30px \">";
//            $output .= "<button type=\"button\" class=\"btn btn-link\"onclick=\"StdList(this)\">";
//            $output .= "<i class=\"icon-eye-open icon-large\" style=\"margin-right: 10px;\"> </i>";
//            $output .= "" . $r->tb_blog_visibility . "";
//            $output .= "</button>";

            $output .= "<button type=\"button\" class=\"btn btn-link\"onclick=\"StdList(this)\">";
            $output .= "<i class=\"icon-user icon-large\" style=\"margin-right: 10px;\"> </i>";

            $this->db->select("*")->from("tb_blog_visiter");
            $this->db->where("tb_blog_id", $r->id);
            $MyCountVisiterQ = $this->db->get()->result_array();
            $MyCountVisiter = count($MyCountVisiterQ);

            $output .= "เยี่ยมชม " . $MyCountVisiter . " ครั้ง";
            $output .= " </button>";

            $this->db->select("*")->from("tb_blog_history");
            $this->db->where("tb_blog_id", $r->id);
            $this->db->where("tb_blog_history_like", 1);
            $MyCountLikeQ = $this->db->get()->result_array();
            $MyCountLike = count($MyCountLikeQ);

            $output .= "<button type=\"button\" class=\"btn btn-link\"onclick=\"StdList(this)\">";
            $output .= "<i class=\"icon-thumbs-up icon-large\" style=\"margin-right: 10px;\"></i>";
            $output .= "ถูกใจ " . $MyCountLike . " คน";
            $output .= "</button>";
            $output .= "<button type=\"button\" class=\"btn btn-link\"onclick=\"ShereBlog(this)\">";
            $output .= "<i class=\"icon-share icon-large\" style=\"margin-right: 10px;\"></i>";
            $output .= "เผยแพร่ข้อมูล";
            $output .= "</button>";
            $output .= "<button type=\"button\" style=\"margin-left: 10px;\"class=\"btn btn-primary\" onclick=\"BlogDetail(this)\" id=\"" . $r->id . "\"><i class=\"icon-play icon-large\"></i> เข้าสู่เนื้อหา</button>";
            $output .= "</div>";
            $output .= "</div>";
            $output .= "</div>";
            $output .= "</div> ";
            $output .= "</td>";
            $output .= "</tr>";
        }
        echo $output;
    }

    public function media_online_insert_view() {

        $output = "";

        $output .= "<div class=\"row\">";
        $output .= "<button type=\"button\" class=\"btn btn-primary\" data-toggle=\"collapse\" data-target=\"#InsertNewBox\"><i class=\"icon-plus icon-large\"></i> เพิ่มข้อมูล</button>  ";
        $output .= "<span class='pull-right'>";
        $output .= "<button type=\"button\" class=\"btn btn-danger\" onclick=\"insert_view_close(this)\"><i class=\"icon-remove icon-large\"></i></button> ";
        $output .= "</span>";
        $output .= "</div>";

        $output .= "<br>";

        $output .= "<form method=\"post\" id=\"insert-form\" enctype=\"multipart/form-data\">";
        $output .= "<div class=\"row collapse\" id=\"InsertNewBox\">";
        $output .= "<div class=\"row\">";
        $output .= "<div class=\"col-md-12 form-group\">";

        $output .= "<div class=\"row\">";

        $output .= "<div class=\"col-md-9 form-group\">";
        $output .= "<label class=\"control-label\">หัวเรื่อง</label>";
        $output .= "<input type=\"text\" name=\"inBlogTitle\" id=\"inBlogTitle\" class=\"form-control\" />";
        $output .= "</div>";

        $output .= "<div class=\"col-md-3 form-group\">";
        $output .= "<label class=\"control-label\">การมองเห็น</label>";
        $output .= "<select name=\"inBlogVisibility\" id=\"inBlogVisibility\" class=\"form-control\" readonly>";
        $output .= "<option value=\"Public\">สาธารณะ</option>";
        $output .= "</select>";
        $output .= "</div>";


        $output .= "</div>";

        $output .= "<div class=\"row\">";


        $output .= "<div class=\"col-md-4 form-group\">";
        $output .= "<label class=\"control-label\">ระดับชั้น</label>";
        $output .= "<select name=\"inSchoolClassId\" id=\"inSchoolClassId\" class=\"form-control\">";
        $output .= "<option value=\"\">--เลือกข้อมูล--</option>";
        $ScClass = $this->Chairatto_model->school_class_to_array();
        foreach ($ScClass as $r) {
            $output .= "<option value=\"" . $r->id . "\">" . $r->tb_ed_school_class_name . "ปีที่ " . $r->tb_ed_school_class_level . "</option>";
        }

        $output .= "</select>";
        $output .= "</div>";


        $output .= "<div class=\"col-md-4 form-group\">";
        $output .= "<label class=\"control-label\">กลุ่มสาระ</label>";
        $output .= "<select name=\"inGroupLearning\" id=\"inGroupLearning\" class=\"form-control\">";
        $output .= "<option value=\"\">--เลือกข้อมูล--</option>";
        $Gl = $this->Chairatto_model->group_learning_to_array();
        foreach ($Gl as $r) {
            $output .= "<option value=\"" . $r->id . "\">" . $r->tb_group_learningcol_name . "</option>";
        }
        $output .= "</select>";
        $output .= "</div>";

//        $output .= "<div class=\"col-md-4 form-group\">";
//        $output .= "<label class=\"control-label\">วิชา</label>";
//        $output .= "<select name=\"inSubjectId\" id=\"inSubjectId\" class=\"form-control\">";
//        $output .= "<option value=\"\">--เลือกข้อมูล--</option>";
//        $output .= "</select>";
//        $output .= "</div>";

        $output .= "<input type=\"hidden\" name=\"inSubjectId\" id=\"inSubjectId\" value=\"\" class=\"form-control\" />";


        $output .= "</div>";

        $output .= "<div class=\"row\">";

        $output .= "<div class=\"col-md-12 form-group\">";
        $output .= "<label class=\"control-label\">เนื้อหา</label>";
        $output .= "<textarea id=\"inBlogContent\" name=\"inBlogContent\" style=\"width:100%;height:100px;\"></textarea>";
        $output .= "</div>";

        $output .= "</div>";

        $output .= "</div>";
        $output .= "</div>";

        $output .= "<div class=\"row\">";
//        $output .= "<center><button type=\"button\" class=\"btn btn-primary\" data-toggle=\"collapse\" data-target=\"#InsertNewBox\"><i class=\"icon-plus icon-large\"></i> เพิ่มข้อมูล</button>  ";

        $output .= "<center><button type=\"button\" class=\"btn btn-success btn-insert\" onclick=\"InsertBlog(this)\" ><i class=\"icon-save icon-large\"></i> บันทึก</button></center>";
        $output .= "</div>";
        $output .= "</div>";

        $output .= "<input type=\"hidden\" name=\"inId\" id=\"inId\" class=\"form-control\" />";

        $output .= "</form>";

        $this->db->select("*")->from("tb_blog");
        $this->db->where("tb_blog_recorder", $this->session->userdata('name'));
        $MyQ = $this->db->get()->result();

        $output .= "<table class=\"table table-hover table-striped table-bordered display\" id=\"BlogTable\">";
        $output .= "<thead>";
        $output .= "<tr>";
        $output .= "<th class=\"no-sort\" style=\"text-align:center; width:10%;\">ที่</th>";
        $output .= "<th class=\"no-sort\" style=\"text-align:center; width:60%px;\">หัวข้อ</th>";
        $output .= "<th class=\"no-sort\" style=\"text-align:center; width:10%;\">วันที่สร้าง</th>";
        $output .= "<th class=\"no-sort\" style=\"text-align:center; width:20%;\">จัดการ</th>";
        $output .= "</tr>";
        $output .= "</thead>";
        $output .= "<tbody>";

        $i = 1;
        foreach ($MyQ as $r) {
            $output .= "<tr>";
            $output .= "<td style=\"text-align:center; \">" . $i . "</td>";
            $output .= "<td style=\"text-align:center; \">" . $r->tb_blog_title . "</td>";
            $output .= "<td style=\"text-align:center;\">" . $r->tb_blog_createdate . "</td>";
            $output .= "<td style=\"text-align:center;\">";
            $output .= "<button type=\"button\" class=\"btn btn-warning btn-blog-edit\" style=\"margin-left:10px;\" id=\"" . $r->id . "\" onclick=\"EditBlog(this)\" data-toggle=\"collapse\" data-target=\"#InsertNewBox\"><i class=\"icon-pencil icon-large\"></i> แก้ไข</button>";
            $output .= "<button type=\"button\" class=\"btn btn-danger btn-blog-delete\" style=\"margin-left:10px;\onclick=\"b(this)\"><i class=\"icon-trash icon-large\"></i> ลบ</button>";
//            $output .= "<button type=\"button\" class=\"btn btn-info btn-insert\" style=\"margin-left:10px;\onclick=\"c(this)\"><i class=\"icon-eye-open icon-large\"></i> การมองเห็น</button>";
            $output .= "</td>";
            $output .= "</tr>";
            $i++;
        }
        $output .= "</tbody>";
        $output .= "</table>";


        echo $output;
    }

    public function like_this_blog() {
        $id = $this->input->post('id');
        $arr = array(
            "tb_blog_id" => $id,
            "tb_blog_history_like" => 1,
            "tb_blog_history_recorder" => $this->session->userdata('name'),
            "tb_blog_history_department" => $this->session->userdata('department'),
            "tb_blog_history_createdate" => date('Y-m-d')
        );

        $this->db->select("*")->from("tb_blog_history");
        $this->db->where("tb_blog_id", $id);
        $this->db->where("tb_blog_history_recorder", $this->session->userdata('name'));
        $MyQ = $this->db->get()->result_array();

        if (count($MyQ) > 0) {
            $this->My_model->update_data('tb_blog_history', array('id' => $MyQ[0]['id']), $arr);
        } else {
            $this->My_model->insert_data('tb_blog_history', $arr);
        }
    }

    public function pin_this_blog() {
        $id = $this->input->post('id');
        $arr = array(
            "tb_blog_id" => $id,
            "tb_blog_history_pin" => 1,
            "tb_blog_history_recorder" => $this->session->userdata('name'),
            "tb_blog_history_department" => $this->session->userdata('department'),
            "tb_blog_history_createdate" => date('Y-m-d')
        );

        $this->db->select("*")->from("tb_blog_history");
        $this->db->where("tb_blog_id", $id);
        $this->db->where("tb_blog_history_recorder", $this->session->userdata('name'));
        $MyQ = $this->db->get()->result_array();

        if (count($MyQ) > 0) {
            $this->My_model->update_data('tb_blog_history', array('id' => $MyQ[0]['id']), $arr);
        } else {
            $this->My_model->insert_data('tb_blog_history', $arr);
        }
    }

//========== end ==========//
}
