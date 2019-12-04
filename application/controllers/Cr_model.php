<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/*
  | ----------------------------------------------------------------------------
  |  Title
  | ----------------------------------------------------------------------------
  | Copyright	Edutech Co.,Ltd.
  | Purpose     โมเดลเลื่อนชั้นแจ้งจบซ้ำชั้น
  | Author      Chairatto
  | Create Date 25/2/2562
  | Last edit	3/3/2562
  | Comment	แก้บัค Checkbox
  | ----------------------------------------------------------------------------
 */

class Cr_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    function course_register_base($rid, $cid, $edyear, $term) {
        $output = "";
//----------- Left panel start

        $this->db->select("a.tb_ed_classroom_number,b.id as StdId,b.std_code,CONCAT (b.std_titlename,b.std_firstname,\" \",b.std_lastname) as fullname");
        $this->db->select("c.tb_classroom_room,c.tb_classroom_student_amount,d.tb_ed_plan,e.tb_ed_school_register_class_edyear,f.tb_ed_school_class_name,f.tb_ed_school_class_level");
        $this->db->from("tb_ed_classroom a");
        $this->db->join("tb_student_base b", "b.id = a.tb_student_base_id");
        $this->db->join("tb_ed_room c", "c.id = a.tb_ed_room_id");
        $this->db->join("tb_ed_plan d", "d.id = c.tb_ed_plan_id");
        $this->db->join("tb_ed_school_register_class e", "e.id = c.tb_ed_school_register_class_id");
        $this->db->join("tb_ed_school_class f", "f.id = e.tb_ed_school_class_id");
        $this->db->order_by("c.tb_classroom_room asc");
        $this->db->order_by("a.tb_ed_classroom_number asc");

        if ($cid != "") {
            $this->db->where("e.id", $cid);
        }
        if ($rid != "") {
            $this->db->where("c.id", $rid);
        }

        $MyQ = $this->db->get();
        $MyStdQ = $MyQ->result();
        $MyStdHeader = $MyQ->result_array();
        $output .= "<div class=\"row\">";
        $output .= "<center><button type=\"button\" class=\"btn btn-primary btn-register-course\" onclick=\"ClickRegisterCourse(this)\"><i class=\"icon-tasks icon-large\"></i> ลงทะเบียนเรียน</button></center>";
        $output .= "</div>";
        $output .= "<br>";
        if (count($MyStdQ) > 0) {
            $output .= "<div class=\"col-md-6\">";
            $output .= "<div class=\"panel panel-primary\">";
            $output .= "<div class=\"panel-body\" id=\"StudentRegisteredBody\">";

            $output .= "<center><label class=\"control-label\">ชั้น" . $MyStdHeader[0]['tb_ed_school_class_name'] . "ปีที่ " . $MyStdHeader[0]['tb_ed_school_class_level'];
            if ($rid != "") {
                $output .= " ห้อง " . $MyStdHeader[0]['tb_classroom_room'] . " แผนการเรียน " . $MyStdHeader[0]['tb_ed_plan'];
            }

            $output .= " จำนวนเด็ก " . count($MyStdQ) . " คน</label></center>";
            $output .= "<input type=\"hidden\" id=\"StdCount\" name=\"StdCount\" value=\"" . count($MyStdQ) . "\" />";
            $output .= "<br></br>";

            $output .= "<table class=\"table table-hover table-striped table-bordered display\" id=\"StudentRoom\">";
            $output .= "<thead>";
            $output .= "<tr>";
            $output .= "<th style=\"text-align: center; width:5%;\">ที่</th>";
            $output .= "<th style=\"text-align: center; width:20%;\" class=\"no-sort\">รหัสนักเรียน</th>";
            $output .= "<th style=\"text-align: center; width:65%;\" class=\"no-sort\">ชื่อ-นามสกุล</th>";
            $output .= "<th style=\"text-align: center; width:10%;\" class=\"no-sort\">";
            $output .= "<button type=\"button\" class=\"btn-link\" id=\"\" onclick=\"StdClickCheckAll(this)\"><i class=\"icon-ok icon-large\"></i></button>";
            $output .= "</th>";
            $output .= "</tr>";
            $output .= "</thead>";

            $output .= "<tbody>";

            $tmp = "";
            foreach ($MyStdQ as $row) {

                $output .= "<tr>";

                $output .= "<td style=\"text-align: center;\">" . $row->tb_ed_classroom_number . "</td>";
                $output .= "<td style=\"text-align: center;\">" . $row->std_code . "</td>";
                $output .= "<td style=\"text-align: left;\"><button type=\"button\" class=\"btn-link\" id=\"" . $row->StdId . "\" onclick=\"StdClick(this)\">" . $row->fullname . "</button></td>";

                $output .= "<td style=\"text-align: left;\">";

                $output .= "<label class=\"containerzz\">";
                $output .= "<input type=\"checkbox\" id=\"StdId" . $row->StdId . "\" name=\"StdId" . $row->StdId . "\" value=\"" . $row->StdId . "\"\"checked>";
                $output .= "<span class=\"checkmark\"></span>";
                $output .= "</label>";

                $output .= "</td>";

                $output .= "<tr>";
                $tmp .= $row->StdId . ",";
            }

            $output .= "<input type=\"hidden\" id=\"StdIdArray\" name=\"StdIdArray\" value=\"" . $tmp . "\" />";

            $output .= "</tbody>";
            $output .= "</table>";

            $output .= "</div>";
            $output .= "</div>";
            $output .= "</div>";
        }

//----------- Left panel end
//      
//----------- right panel start   
//tb_subject_type
//        $MyStdHeader = $MyQ->result_array();

        $output .= "<div class=\"col-md-6\">"
                . "<div class=\"panel panel-primary\">"
                . "<div class=\"panel-body\">"
                . "<center><label class=\"control-label\">ลงทะเบียนวิชา</label></center>";

        $output .= "<div id=\"dashboardTAB\" class=\"row\">"
                . "<div class=\"col-md-12\">"
                . "<ul class=\"nav nav-tabs\">";

        $MyDynamicTabQ = $this->db->select("*")->from("tb_subject_type")->get()->result();
        $i = 1;
        foreach ($MyDynamicTabQ as $rowtab) {
            if ($i == 1) {
                $output .= "<li class=\"active\">";
            } else {
                $output .= "<li>";
            }
            $output .= "<a  href=\"#tab" . $i . "\" data-toggle=\"tab\" data-id=\"" . $i . "\">"
                    . "<b>วิชา" . $rowtab->tb_subject_type_name . "</b>"
                    . "</a>"
                    . "</li>";
            $i++;
        }


        $output .= "</ul>"
                . "</div>"
                . "</div>";


        $output .= "<div class=\"tab-content\">";
        $tabi = 1;
        foreach ($MyDynamicTabQ as $rowtab) {
            if ($tabi == 1) {
                $output .= "<div class=\"tab-pane active\" id=\"tab" . $tabi . "\" style=\"padding-top:10px;\"> ";
            } else {
                $output .= "<div class=\"tab-pane\" id=\"tab" . $tabi . "\" style=\"padding-top:10px;\"> ";
            }

            $output .= "<table class=\"table table-hover table-striped table-bordered display\" id=\"CourseBody\">";

            $output .= "<thead>";
            $output .= "<tr>";
            $output .= "<th style=\"text-align: center; width:5%;\">ที่</th>";
            $output .= "<th style=\"text-align: center; width:20%;\" class=\"no-sort\">รหัสวิชา</th>";
            $output .= "<th style=\"text-align: center; width:65%;\" class=\"no-sort\">ชื่อวิชา</th>";
            $output .= "<th style=\"text-align: center; width:10%;\" class=\"no-sort\">หน่วยกิต</th>";
            $output .= "<th style=\"text-align: center; width:10%;\" class=\"no-sort\">";
            $output .= "<button type=\"button\" class=\"btn-link\" id=\"" . $tabi . "\" onclick=\"CourseClickCheckAll(this)\"><i class=\"icon-ok icon-large\"></i></button>";
            $output .= "</th>";
            $output .= "</tr>";
            $output .= "</thead>";

            $this->db->select("a.*,b.*,c.*,a.id as CourseId");
            $this->db->from("tb_course a");
            $this->db->join("tb_subject b", "b.id = a.tb_subject_id");
            $this->db->join("tb_group_learning c", "c.id = b.tb_group_learning_id");
            $this->db->order_by("c.id asc");
            $this->db->where("a.tb_ed_school_register_class_id", $cid);
            $this->db->where("a.tb_course_term", $term);
            $this->db->where("b.tb_subject_type", $rowtab->tb_subject_type_name);
            $MyCourseQ = $this->db->get();
            $MyCourseListQ = $MyCourseQ->result();

            $output .= "<tbody>";
            $ii = 1;
            $tmpc = "";
            foreach ($MyCourseListQ as $row) {

                $output .= "<tr>";
                $output .= "<td style=\"text-align: center;\">" . $ii . "</td>";
                $output .= "<td style=\"text-align: center;\">" . $row->tb_course_code . "</td>";
                $output .= "<td style=\"text-align: center;\">" . $row->tb_subject_name . "</td>";
                $output .= "<td style=\"text-align: center;\">" . $row->tb_course_credit . "</td>";
                $output .= "<td style=\"text-align: center;\">";
                $output .= "<label class=\"containerzz\">";
                $output .= "<input type=\"checkbox\" id=\"Tab" . $tabi . "_CourseNum" . $ii . "\" name=\"CourseId" . $row->CourseId . "\" value=\"" . $row->CourseId . "\"\"checked>";
                $output .= "<span class=\"checkmark\"></span>";
                $output .= "</label>";
                $output .= "</td>";
                $output .= "<tr>";
                $output .= "<input type=\"hidden\" id=\"CourseIdArray[]\" name=\"CourseIdArray[]\" value=\"" . $row->CourseId . "\">";
                $ii++;
                $tmpc .= $row->CourseId . ",";
            }


            $output .= "<input type=\"hidden\" id=\"Tab" . $tabi . "\"  value=\"" . $ii . "\">";

//            $output .= "<input type=\"hidden\" id=\"CourseIdArray\" name=\"CourseIdArray\" value=\"" . $tmp . "\" />";
            $output .= "</tbody>";

            $output .= "</table>";

            $output .= "</div>";
            $tabi++;
        }
        $output .= "</div>";

        $output .= "</div>";
        $output .= "</div>";
        $output .= "</div>";
        $output .= "</div>";
        return $output;
    }

    function cr_std_modal($id) {
        $output = "";

        $this->db->select("a.*,b.*,c.*,d.*,a.id as RegisteredId");
        $this->db->from("tb_register_course a");
        $this->db->join("tb_course b", "b.id = a.tb_course_id");
        $this->db->join("tb_student_base c", "c.id = a.tb_student_base_id");
        $this->db->join("tb_subject d", "d.id = b.tb_subject_id");
        $this->db->order_by("a.id asc");
        $this->db->where("c.id", $id);
        $MyRegisterCourseQ = $this->db->get()->result();


        $this->db->select("*")->from("tb_std_picture");
        $this->db->order_by("tb_std_picture_createdate desc");
        $this->db->where("own_id", $id);
        $MyStdPicQ = $this->db->get()->result_array();

        $output .= "<div class=\"row\">";

        $output .= "<div class=\"col-md-4 col-md-offset-1\">";
        $output .= "<div class=\"row\">";
        if (file_exists("upload/" . $MyStdPicQ[0]['pic_name']) && !empty($MyStdPicQ[0]['pic_name'])) {
            $output .= img(array('src' => "upload/" . $MyStdPicQ[0]['pic_name'], "style" => "width:238px;height:250px;border:5px solid #C0C0C0;")) . nbs(5);
        } else {
            $output .= img(array('src' => "images/no-image.jpg", "style" => "width:238px;height:250px;border:5px solid #C0C0C0;")) . nbs(5);
        }
        $output .= "</div>";
        $output .= "<br></br>";
//        $output .= "<div class=\"row\">";
//        $output .= "<label class=\"control-label\">ชื่อ</label>";
//        $output .= "</div>";
//
//        $output .= "<div class=\"row\">";
//        $output .= "<label class=\"control-label\">ระดับชั้น</label>";
//        $output .= "</div>";

        $output .= "</div>";

        $output .= "<div class=\"col-md-7\">";

        $output .= "<b>วิชาที่ลงทะเบียนไว้แล้ว</b>";
        $output .= "<br></br>";
        $output .= "<table class=\"table table-hover table-striped table-bordered display\" id=\"CourseBody\">";
        $output .= "<thead>";
        $output .= "<tr>";
        $output .= "<th style=\"text-align: center; width:5%;\">ที่</th>";
        $output .= "<th style=\"text-align: center; width:15%;\" class=\"no-sort\">รหัสวิชา</th>";
        $output .= "<th style=\"text-align: center; width:40%;\" class=\"no-sort\">ชื่อวิชา</th>";
        $output .= "<th style=\"text-align: center; width:20%;\" class=\"no-sort\">ประเภทวิชา</th>";
        $output .= "<th style=\"text-align: center; width:10%;\" class=\"no-sort\">หน่วยกิต</th>";
        $output .= "<th style=\"text-align: center; width:10%;\" class=\"no-sort\"></th>";
        $output .= "</tr>";
        $output .= "</thead>";

        $output .= "<tbody>";

        $ii = 1;
        foreach ($MyRegisterCourseQ as $row) {

            $output .= "<tr>";
            $output .= "<td style=\"text-align: center;\">" . $ii . "</td>";
            $output .= "<td style=\"text-align: center;\">" . $row->tb_course_code . "</td>";
            $output .= "<td style=\"text-align: center;\">" . $row->tb_subject_name . "</td>";
            $output .= "<td style=\"text-align: center;\">" . $row->tb_subject_type . "</td>";
            $output .= "<td style=\"text-align: center;\">" . $row->tb_course_credit . "</td>";
            $output .= "<td style=\"text-align: center;\">"
                    . "<button type=\"button\" class=\"btn btn-danger btn-registered-delete\" id=\"" . $row->RegisteredId . "\" onclick=\"RegisteredDelete(this)\"><i class=\"icon-trash icon-large\"></i> ลบ</button>"
                    . "</td>";




            $output .= "<tr>";
            $ii++;
        }

        $output .= "</tbody>";
        $output .= "</table>";

        $output .= "</div>";
        $output .= "</div>";

        return $output;
    }

}
