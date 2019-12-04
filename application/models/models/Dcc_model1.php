<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/*
  | ----------------------------------------------------------------------------
  |  Title
  | ----------------------------------------------------------------------------
  | Copyright	Edutech Co.,Ltd.
  | Purpose
  | Author      Chairatto
  | Create Date 15/12/2018
  | Last edit	8/2/2019
  | Comment	การดึงสรุปของแผนยังขาดตัวชี้วัด(เก็บข้อมูลเพิ่ม)
  | ----------------------------------------------------------------------------
 */

class Dcc_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    //--------- How to model boi
    // ดึงจุดประสงค์การเรียนรู้ของวิชาเพิ่มเติม return Array

    function get_course_purpose_list($CourseId) {
        $this->db->select("*")->from("tb_course_purpose");
        $this->db->where("tb_course_id", $CourseId);
        $this->db->order_by("id asc");
        $MyQ = $this->db->get();
        if ($MyQ->num_rows() > 0) {
            return $MyQ->result_array();
        } else {
            return false;
        }
    }

    function get_row_course_by_unitid($UnitId) {
        $this->db->select("a.*,b.*,c.*");
        $this->db->select("b.id as ed_course_id");
        $this->db->select("d.tb_ed_school_register_class_edyear as EdYear");
        $this->db->select("e.id as ed_school_class_id");
        $this->db->from("tb_unit_learning a");
        $this->db->join("tb_course b", "b.id = a.tb_course_id");
        $this->db->join("tb_subject c", "c.id = b.tb_subject_id");
        $this->db->join("tb_ed_school_register_class d", "d.id = b.tb_ed_school_register_class_id");
        $this->db->join("tb_ed_school_class e", "e.id = d.tb_ed_school_class_id");
        $this->db->where("a.id", $UnitId);
        $MyQ = $this->db->get();
        if ($MyQ->num_rows() > 0) {
            return $MyQ->row_array();
        } else {
            return false;
        }
    }

    function get_row_course_by_courseid($CourseId) {
        $this->db->select("a.*,b.*,c.*");
        $this->db->select("b.id as ed_course_id");
        $this->db->select("d.tb_ed_school_register_class_edyear as EdYear");
        $this->db->select("e.id as ed_school_class_id");
        $this->db->from("tb_unit_learning a");
        $this->db->join("tb_course b", "b.id = a.tb_course_id");
        $this->db->join("tb_subject c", "c.id = b.tb_subject_id");
        $this->db->join("tb_ed_school_register_class d", "d.id = b.tb_ed_school_register_class_id");
        $this->db->join("tb_ed_school_class e", "e.id = d.tb_ed_school_class_id");
        $this->db->where("b.id", $CourseId);
        $MyQ = $this->db->get();
        if ($MyQ->num_rows() > 0) {
            return $MyQ->row_array();
        } else {
            return false;
        }
    }

    function get_course_purpose_by_courseid($CourseId) {
        $this->db->select("*")->from("tb_course_purpose");
        $this->db->where("tb_course_id", $CourseId);
        $MyQ = $this->db->get();
        if ($MyQ->num_rows() > 0) {
            return $MyQ->result_array();
        } else {
            return false;
        }
    }

    function get_register_course_by_year_term_stdid($Term, $EdYear, $StdId) {

        $this->db->select("a.*,b.*,c.*");
        $this->db->select("a.id as ed_course_id");
        $this->db->select("d.tb_ed_school_register_class_edyear as EdYear");
        $this->db->select("e.id as ed_school_class_id");

        $this->db->from("tb_course a");
        $this->db->join("tb_register_course b", "b.tb_course_id = a.id");
        $this->db->join("tb_subject c", "c.id = a.tb_subject_id");
        $this->db->join("tb_ed_school_register_class d", "d.id = a.tb_ed_school_register_class_id");
        $this->db->join("tb_ed_school_class e", "e.id = d.tb_ed_school_class_id");

        if ($Term != "") {
            $this->db->where("a.tb_course_term", $Term);
        }

        if ($EdYear != "") {
            $this->db->where("d.tb_ed_school_register_class_edyear", $EdYear);
        }

        if ($StdId != "") {
            $this->db->where("b.tb_student_base_id", $StdId);
        }
        $this->db->order_by("c.tb_subject_type desc");

        $MyQ = $this->db->get();
        if ($MyQ->num_rows() > 0) {
            return $MyQ->result_array();
        } else {
            return false;
        }
    }

    //-----------  How to model boi
    function dc_base() {
        $this->db->select("a.*, b.*, c.*,d.*,e.*, a.id AS id , c.id AS cid ")->from("tb_course a");
        $this->db->join("tb_subject b", "b.id = a.tb_subject_id");
        $this->db->join("tb_group_learning c", "c.id = b.tb_group_learning_id");
        $this->db->join("tb_ed_school_register_class d", "d.id = a.tb_ed_school_register_class_id");
        $this->db->join("tb_ed_school_class e", "e.id = d.tb_ed_school_class_id");
        $this->db->where('a.tb_course_department', $this->session->userdata('department'));
        $this->db->order_by("a.id asc");
        $rs = $this->db->get();
        if ($rs->num_rows() > 0) {
            return $rs->result_array();
        }
        return array();
    }

    function dc_base_where($ClassId, $term, $edyear) {

        $CheckClass = "";

        if ($ClassId != "") {
            $this->db->select("a.id,b.tb_ed_school_class_abbreviation,b.id as schid")->from("tb_ed_school_register_class a");
            $this->db->join("tb_ed_school_class b", "b.id = a.tb_ed_school_class_id");
            if(isset($edyear)){
                $this->db->where(array('a.tb_ed_school_register_class_edyear',$edyear));
            }
            
            $this->db->where('a.id', $ClassId);
            $MyQ = $this->db->get()->result_array();
            $CheckClass = $MyQ[0]['tb_ed_school_class_abbreviation'];
            $MySchoolClassId = $MyQ[0]['schid'];
        }

        $output = "";

        if ($CheckClass = "ม") {

            $this->db->select("a.*, b.*, c.*,d.*,e.*,f.*, a.id AS id , c.id AS cid ")->from("tb_course a");
            $this->db->join("tb_subject b", "b.id = a.tb_subject_id");
            $this->db->join("tb_group_learning c", "c.id = b.tb_group_learning_id");
            $this->db->join("tb_ed_school_register_class d", "d.id = a.tb_ed_school_register_class_id");
            $this->db->join("tb_ed_school_class e", "e.id = d.tb_ed_school_class_id");
            $this->db->join("tb_course_detail f", "f.tb_course_id = a.id");

           // $this->db->where('a.tb_course_department', $this->session->userdata('department'));
            $this->db->where('f.tb_human_resources_01_id', $this->session->userdata('hr_id'));

//            if ($edyear != "") {
//                $this->db->where('d.tb_ed_school_register_class_edyear', $edyear);
//            }
//
//            if ($term != "") {
//                $this->db->where('a.tb_course_term', $term);
//            }
//
//            if ($ClassId != "") {
//                $this->db->where('d.id', $ClassId);
//            }

            $this->db->order_by("a.id asc");
            $query = $this->db->get();

            $output .= "<div class=\"row\">";
            $output .= "<b>โครงสร้างรายวิชา</b>";
            $output .= "<br></br>";
            $output .= "</div>";
            $output .= "<table class=\"table table-hover table-striped table-bordered display\" id=\"dcBaseTab\"> ";
            $output .= "<thead>";
            $output .= "<tr>";
            $output .= "<th style=\"width:5%; text-align: center\">ที่</th>";
            $output .= "<th style=\"width:15%; text-align: center\"class=\"no-sort\">กลุ่มสาระการเรียนรู้</th>";
            $output .= "<th style=\"width:20%; text-align: center\"class=\"no-sort\">วิชา/รหัสวิชา</th>";
            $output .= "<th style=\"width:15%; text-align: center\"class=\"no-sort\">ระดับชั้น</th>";
            $output .= "<th style=\"width:8%; text-align: center\"class=\"no-sort\">หน่วยกิต</th>";
            $output .= "<th style=\"width:10%; text-align: center\"class=\"no-sort\">ประเภทวิชา</th>";
            $output .= "<th style=\"width:27%; text-align: center\"class=\"no-sort\">จัดการ</th>";
            $output .= " </tr>";
            $output .= "</thead>";

            $output .= "<tbody id=\"CourseBody\">";

            $irow = 1;
            $TakeSometing = "";
            foreach ($query->result() as $row) {
                $output .= "<tr>";

                $output .= "<td style=\"text-align: center;\">" . $irow . "</td>";
                $output .= "<td style=\"text-align: center;\">" . $row->tb_group_learningcol_name . "</td>";
                $output .= "<td style=\"text-align: center;\">" . $row->tb_subject_name . " | " . $row->tb_course_code . "</td>";
                $output .= "<td style=\"text-align: center;\">" . $row->tb_ed_school_class_name . "ปีที่ " . $row->tb_ed_school_class_level . "</td>";
                $output .= "<td style=\"text-align: center;\">" . $row->tb_course_credit . "</td>";
                $output .= "<td style=\"text-align: center;\">" . $row->tb_subject_type . "</td>";
                $output .= "<td style=\"text-align:center;\">";


                $output .= "<button type=\"button\" class=\"btn btn-success btn-unit\" id=\"" . $row->id . "\" onclick=\"unitclick(this)\"><i class=\"icon-copy icon-large\" ></i> หน่วย</button>";
                $output .= "&nbsp;";
                if ($row->tb_subject_type == "พื้นฐาน") {
                    $output .= "<button type=\"button\" class=\"btn btn-warning btn-standard\" id=\"" . $row->id . "\" onclick=\"standardclick(this)\"><i class=\"icon-list icon-large\"></i> ตัวชี้วัด</button>";
                } else {
                    $output .= "<button type=\"button\" class=\"btn btn-primary btn-purpose\" id=\"" . $row->id . "\" onclick=\"purposeclick(this)\"><i class=\"icon-list icon-large\"></i> จุดประสงค์</button>";
                }
                $output .= "&nbsp;";
                $output .= "<button type=\"button\" class=\"btn btn-info btn-result\" id=\"" . $row->id . "\" onclick=\"resultclick(this)\"><i class=\"icon-search icon-large\"></i> สรุป</button>";

                $output .= "</td>";

                $output .= "</tr>";


                $irow++;
                $TakeSometing .= "<input type=\"hidden\" id=\"cls" . $row->id . "\"  value=\"" . $row->tb_ed_school_class_name . "\">";
                $TakeSometing .= "<input type=\"hidden\" id=\"lev" . $row->id . "\"  value=\"" . $row->tb_ed_school_class_level . "\">";
                $TakeSometing .= "<input type=\"hidden\" id=\"gl" . $row->id . "\"  value=\"" . $row->cid . "\">";
                $TakeSometing .= "<input type=\"hidden\" id=\"grouplearningname" . $row->id . "\"  value=\"" . $row->tb_group_learningcol_name . "\">";
                $TakeSometing .= "<input type=\"hidden\" id=\"hour" . $row->id . "\"  value=\"" . $row->tb_course_hour_term . "\">";
                $TakeSometing .= "<input type=\"hidden\" id=\"head" . $row->id . "\"  value=\"" . $row->tb_subject_name . "(" . $row->tb_course_code . ")" . "\">";
            }

            $output .= "</tbody>";
            $output .= "</table>";
        } else {
            
        }
        if ($ClassId != "") {
            $output .= "<input type=\"hidden\" id=\"MySchoolClassId\" name=\"MySchoolClassId\" value=\"" . $MySchoolClassId . "\">";
        }
        $output .= $TakeSometing;
        return $output;
    }

    function fetch_member($param) {
        $this->db->where('tb_group_learning_id', $param);
        $this->db->order_by('tb_group_learning_id', 'asc');
        $query = $this->db->get('tb_subject');
        $output = "<option value=''>---เลือกข้อมูล---</option>";
        foreach ($query->result() as $row) {
            $output .= "<option value='" . $row->id . "'>" . $row->tb_subject_name . "</option>";
        }
        return $output;
    }

    function code_member($param) {
        $this->db->where('id', $param);
        $rs = $this->db->get('tb_group_learning');
        return $rs;
    }

    function code_edit($id) {
        $this->db->select("*")->from("tb_group_learning");
        $this->db->where('id', $id);
        $query = $this->db->get()->row_array();
        if (count($query) > 0) {
            return $query;
        }
        return array();
    }

    function code_subject($id) {
        $this->db->select("*")->from("tb_subject");
        $this->db->where('id', $id);
        $query = $this->db->get()->row_array();
        if (count($query) > 0) {
            return $query;
        }
        return array();
    }

//------ ใช้ส่งงาน -----*
//------ เรียกตัวชี้วัดตามเงื่อน
    function get_standard_unit($id, $cls, $lev) {
        $this->db->select("a.*, b.*, c.*, d.* , c.id as id,a.id as aid")->from("tb_kpi_standard_learning a");
        $this->db->join("tb_standard_learning b", "b.id = a.tb_standard_learning_id");
        $this->db->join("tb_kpi_score c", "c.tb_kpi_standard_learning_id = a.id");
        $this->db->join("tb_group_learning_item d", "d.id = b.tb_group_learning_item_id");
        $this->db->where("d.tb_group_learning_id", $id);
//        $this->db->where("a.tb_kpi_standard_learning_class", $cls);
//        $this->db->where("a.tb_kpi_standard_learning_lev", $lev);
//        $this->db->where("c.tb_kpi_score_department", $this->session->userdata('department'));
//        $this->db->order_by("a.id asc");
        $query = $this->db->get();

        $ii = 1;

        $output = "<table class=\"table table-hover table-striped table-bordered display\">";

        $output .= "<thead>";
        $output .= "<tr>";
        $output .= "<th style=\"width:40px;\">ที่</th>";
        $output .= "<th style=\"width:150px;\" class=\"sorting\">ชื่อตัวชี้วัด</th>";
        $output .= "<th class=\"sorting\">รายละเอียด</th>";
        $output .= "<th style=\"width:40px;\" class=\"sorting\">คะแนนเต็ม</th>";
        $output .= "</tr>";
        $output .= "</thead>";

        $output .= "<tbody>";
        foreach ($query->result() as $row) {

            if ($ii > 1) {
                $output .= "<tr>";
            }

            $output .= "<td>" . $ii . "</td>";
            $output .= "<td>" . $row->tb_standard_learning_code . " " . $row->tb_kpi_standard_learning_level . "/" . thaidigit($row->tb_kpi_standard_learning_seq) . "</td>";
            $output .= "<td>" . $row->tb_kpi_standard_learning_content . "</td>";
            $output .= "<td>" . "<input type=\"text\" name=\"Score" . $row->aid . "\" id=\"Score" . $row->aid . "\" value=\"" . $row->tb_kpi_score . "\" />" . "</td>";
            $ii ++;

            $output .= "</tr>";
            $output .= "<input type=\"hidden\" name=\"kpiId[]\" id=\"kpiId[]\" value=\"" . $row->aid . "\" />";
            $output .= "<input type=\"hidden\" name=\"scId" . $row->aid . "\" id=\"scId" . $row->aid . "\" value=\"" . $row->id . "\" />";
        }
        $output .= "</tbody>";
        $output .= "</table>";


        return $output;
    }

//------ เรียกหน่วยตามเงื่อน
    function get_unit_list($id) {
        $this->db->select("*")->from("tb_unit_learning");
        $this->db->where("tb_course_id", $id);
        $this->db->order_by("tb_unit_learning_sequence asc");
        $query = $this->db->get();

        $ii = 1;
        $output = "<tr>";
        foreach ($query->result() as $row) {

            if ($ii > 1) {
                $output .= "<tr>";
            }

            $output .= "<td>" . $row->tb_unit_learning_sequence . "</td>";
            $output .= "<td>" . $row->tb_unit_learning_name . "</td>";
            $output .= "<td>" . $row->tb_unit_learning_hour . "</td>";
            $output .= "<td>" . $row->tb_unit_learning_score . "</td>";



            $output .= "<td>" . "";
            $output .= "<button type=\"button\" class=\"btn btn-warning btn-edit\" id=\"" . $row->id . "\"><i class=\"icon-pencil icon-large\"></i> แก้ไข</button> &nbsp;";
            $output .= "<button type=\"button\" class=\"btn btn-danger btn-delete\" id=\"" . $row->id . "\"><i class=\"icon-trash icon-large\"></i> ลบ</button> &nbsp;";
            $output .= "" . "</td>";

            $output .= "<td>" . "";
            $output .= "<button type=\"button\" class=\"btn btn-success btn-plan\" id=\"" . $row->id . "\"><i class=\"icon-play icon-large\"></i> แผนการสอน</button> &nbsp;";
            $output .= "" . "</td>";
            $ii ++;

            $output .= "</tr>";
        }
        return $output;
    }

// เรียกตัวชี้วัดตามเงื่อนไขของหน่วย ---- *
    function get_standard_list($id, $cls) {

        $this->db->select("a.*, b.*, c.tb_group_learning_id")->from("tb_unit_learning a");
        $this->db->join("tb_course b", "b.id = a.tb_course_id");
        $this->db->join("tb_subject c", "c.id = b.tb_subject_id");
        $this->db->where("a.id", $id);
        $MyGlQ = $this->db->get()->result_array();
        $MyGlId = $MyGlQ[0]['tb_group_learning_id'];
        // ค้นหากลุ่มสาระ

        $this->db->select("a.*, b.*, c.*, d.* , c.id as id,a.id as aid")->from("tb_kpi_standard_learning a");
        $this->db->join("tb_standard_learning b", "b.id = a.tb_standard_learning_id");
        $this->db->join("tb_kpi_score c", "c.tb_kpi_standard_learning_id = a.id", "left outer");
        $this->db->join("tb_group_learning_item d", "d.id = b.tb_group_learning_item_id");
        $this->db->where("a.tb_ed_school_class_id", $cls);
        $this->db->where("d.tb_group_learning_id", $MyGlId);
        $this->db->order_by("a.id asc");
        $query = $this->db->get();

//tb_kpi_standard_learning คือ aid 
        $ii = 1;
        $output = "<table class=\"table table-hover table-striped table-bordered display\" id=\"KpiListTable\">";
        $output .= "<thead>";
        $output .= "<tr>";
        $output .= "<th style=\"width:40px;\">ที่</th>";
        $output .= "<center><th style=\"width:150px;\" class=\"sorting\">ชื่อตัวชี้วัด</th></center>";
        $output .= "<center><th style=\"width:40px;\">สถานะ </th></center>";
        $output .= "</tr>";
        $output .= "</thead>";

        $output .= "<tbody>";
        foreach ($query->result() as $row) {
            $checkid = $row->tb_unit_learning_id;

            if ($ii > 1) {
                $output .= "<tr>";
            }

            $output .= "<td>" . $ii . "</td>";
            $output .= "<td><center>" . $row->tb_standard_learning_code . " " . $row->tb_kpi_standard_learning_level . "/" . thaidigit($row->tb_kpi_standard_learning_seq) . "</center></td>";
            if ($checkid == $id) {
                $output .= "<td> <center> <button type=\"button\" class=\"btn btn-success btn-check\" id=\"" . $row->id . "\"><i class=\"icon-ok icon-large\"></i> เลือกแล้ว </button> </center> </td>";
            } else {
                $output .= "<td> <center> <button type=\"button\" class=\"btn btn-light btn-uncheck\" id=\"" . $row->aid . "\"> คลิกเพื่อเลือก </button> </center> </td>";
            }

            $ii ++;

            $output .= "</tr>";
        }
        $output .= "</tbody>";
        $output .= "</table>";


        return $output;
    }

//------ เรียกสรุป
    function get_result($id) {
        $this->db->select("*")->from("tb_unit_learning");
        $this->db->where("tb_course_id", $id);
        $this->db->order_by("tb_unit_learning_sequence asc");
        $query = $this->db->get();

        $ii = 1;
        $sumhour = 0;
        $sumscore = 0;
        $output = "<tr>";
        foreach ($query->result() as $row) {

            if ($ii > 1) {
                $output .= "<tr>";
            }
            $sumhour = $sumhour + $row->tb_unit_learning_hour;
            $sumscore = $sumscore + $row->tb_unit_learning_score;

            $output .= "<td>" . $row->tb_unit_learning_sequence . "</td>";
            $output .= "<td>" . $row->tb_unit_learning_name . "</td>";

//----- การดึงตัวชี้วัดตามเงื่อนไขของหน่วย
            $this->db->select("a.*, b.*, c.* ")->from("tb_kpi_standard_learning a");
            $this->db->join("tb_standard_learning b", "b.id = a.tb_standard_learning_id");
            $this->db->join("tb_kpi_score c", "c.tb_kpi_standard_learning_id = a.id", "left outer");
            $this->db->where("c.tb_unit_learning_id", $row->id);
            $this->db->order_by("tb_kpi_standard_learning_id asc");
            $kpi = $this->db->get();

            $output .= "<td>";
            foreach ($kpi->result() as $r) {
                $output .= $r->tb_standard_learning_code . " " . $r->tb_kpi_standard_learning_level . "/" . thaidigit($r->tb_kpi_standard_learning_seq) . " " . $r->tb_kpi_standard_learning_content;
                $output .= "<br></br>";
            }
            $output .= "</td>";
//----- end


            $output .= "<td>" . $row->tb_unit_learning_content . "</td>";
            $output .= "<td><center>" . $row->tb_unit_learning_hour . "</center></td>";
            $output .= "<td><center>" . $row->tb_unit_learning_score . "</center></td>";



            $ii ++;

            $output .= "</tr>";
        }


        $output .= "<td colspan=\"4\"> <center><b> สรุปผล </b></center> </td>";
        $output .= "<td><center><font color=\"green\"><b>" . $sumhour . " ชั่วโมง</b></font></center></td>";
        $output .= "<td><center><font color=\"green\"><b>" . $sumscore . " คะแนน</b></font></center></td>";
        return $output;
    }

//------- แผนการสอน
    function get_plan_list($id) {

        $MyStatus = "G"; //-- สถานะ
        $this->db->select("*")->from("tb_lesson_plan");
        $this->db->where("tb_unit_learning_id", $id);
        $this->db->where("tb_lesson_plan_status <>", $MyStatus);
        $this->db->order_by("tb_lesson_plan_sequence asc");
        $query = $this->db->get();

        $ii = 1;

        $output = "<table  class=\"table table-hover table-striped table-bordered display\" id=\"PlanListTable\">";

        $output .= "<thead>";
        $output .= "<tr>";
        $output .= "<th style=\"text-align: center; width:10%\" class=\"sorting\">ลำดับที่</th>";
        $output .= "<th style=\"text-align: center; width:20%\">ชื่อแผนการสอน</th>";
        $output .= "<th style=\"text-align: center; width:10%\">เวลา(ชั่วโมง) </th>";
//        $output .= "<th style=\"text-align: center; width:15%\">เอกสารแนบ </th>";
        $output .= "<th style=\"text-align: center; width:5%\">สถานะ </th>";
        $output .= "<th style=\"text-align: center; width:10%\">การมองเห็น </th>";
        $output .= "<th style=\"text-align: center; width:15%\">คัดลอกแผน</th>";
        $output .= "<th style=\"text-align: center; width:40%\">การจัดการ</th>";
        $output .= "</tr>";
        $output .= "</thead>";

        $output .= "<tbody>";
        foreach ($query->result() as $row) {
            if ($ii > 1) {
                $output .= "<tr>";
            }

            $output .= "<td><center>" . $row->tb_lesson_plan_sequence . "</center></td>";
            $output .= "<td>" . $row->tb_lesson_plan_name . "</td>";
            $output .= "<td><center>" . $row->tb_lesson_plan_hour . "</center></td>";
//            $output .= "<td><center>" . "Doc" . "</center></td>";

            switch ($row->tb_lesson_plan_status) {
                case "S":
                    $output .= "<td><center>" . "<i class=\"icon-star icon-large\"></i>" . "</center></td>";
                    break;
                case "W":
                    $output .= "<td><center>" . "<i class=\"icon-star-empty icon-large\"></i>" . "</center></td>";
                    break;
                default:
                    $output .= "<td><center>" . "Nothing" . "</center></td>";
            }

            switch ($row->tb_lesson_plan_permission) {
                case "Private":
                    $output .= "<td><center>" . "<i class=\"icon-eye-close icon-large\"></i></center></td>";
                    break;
                case "Public":
                    $output .= "<td><center>" . "<i class=\"icon-eye-open icon-large\"></i></center></td>";
                    break;
                case "School":
                    $output .= "<td><center>" . "<i class=\"icon-flag icon-large\"></i></center></td>";
                    break;
                default:
                    $output .= "<td><center>" . "Nothing" . "</center></td>";
            }

            $output .= "<td><center>" . "";
            $output .= "<button type=\"button\" class=\"btn btn-secondary btn-plan-copy\" id=\"" . $row->id . "\"><i class=\"icon-copy icon-large\"></i> คัดลอกแผน</button> &nbsp;";
            $output .= "" . "</center></td>";

            $output .= "<td><center>" . "";
            $output .= "<button type=\"button\" class=\"btn btn-warning btn-plan-edit\" id=\"" . $row->id . "\"><i class=\"icon-pencil icon-large\"></i> แก้ไข</button> &nbsp;";
            $output .= "<button type=\"button\" class=\"btn btn-danger btn-plan-delete\" id=\"" . $row->id . "\"><i class=\"icon-trash icon-large\"></i> ลบ</button> &nbsp;";
            $output .= "<button type=\"button\" class=\"btn btn-info btn-plan-result\" id=\"" . $row->id . "\"><i class=\"icon-file icon-large\"></i> สรุป</button> &nbsp;";
            $output .= "" . "</center></td>";



            $ii ++;

            $output .= "</tr>";
        }
        $output .= "</tbody>";
        $output .= "</table>";


        return $output;
    }

//---- ตัวชี้วัดที่ใช้
    function get_plan_kpi_list($id) {
        $this->db->select("a.*, b.*, c.* , a.id as id")->from("tb_kpi_score a");
        $this->db->join("tb_kpi_standard_learning b", "b.id = a.tb_kpi_standard_learning_id");
        $this->db->join("tb_standard_learning c", "c.id = b.tb_standard_learning_id");
        $this->db->where("a.tb_unit_learning_id", $id);
        $query = $this->db->get();

        $output .= "<option value=\"\">----เลือกข้อมูล----</option> ";
        foreach ($query->result() as $row) {
            $output .= "<option value=\"" . $row->id . "\">" . $row->tb_standard_learning_code . " " . $row->tb_kpi_standard_learning_level . "/" . thaidigit($row->tb_kpi_standard_learning_seq) . "</option> ";
        }
        return $output;
    }

//---- จำนวนชั่วโมง
    function get_plan_hour_list($id) {
        $this->db->select("tb_unit_learning_hour")->from("tb_unit_learning");
        $this->db->where("id", $id);
        $MyQ = $this->db->get()->result_array();

        $UnitHour = $MyQ[0]['tb_unit_learning_hour'];
        $Status = "S";

        $this->db->select("tb_lesson_plan_hour")->from("tb_lesson_plan");
        $this->db->where("tb_unit_learning_id", $id);
        $this->db->where("tb_lesson_plan_status", $Status);
        $AllPlanHour = $this->db->get();

        $MyHour = $UnitHour;
        foreach ($AllPlanHour->result() as $ii) {
            $Minus = $ii->tb_lesson_plan_hour;
            $MyHour = $MyHour - $Minus;
        }

        $output .= "<option value=\"\">---เลือกชั่วโมง---</option> ";

        for ($i = 1; $i <= $MyHour; $i++) {
            $output .= "<option value=\"" . $i . "\">" . $i . " ชั่วโมง</option> ";
        }

        return $output;
    }

//---- จำนวนชั่วโมง
    function get_plan_edit_hour_list($UnitId, $MyPlanId) {
        $this->db->select("tb_unit_learning_hour")->from("tb_unit_learning");
        $this->db->where("id", $UnitId);
        $MyQ = $this->db->get()->result_array();

        $UnitHour = $MyQ[0]['tb_unit_learning_hour'];
        $Status = "S";

        $this->db->select("tb_lesson_plan_hour")->from("tb_lesson_plan");
        $this->db->where("tb_unit_learning_id", $UnitId);
        $this->db->where("tb_lesson_plan_status", $Status);
        $AllPlanHour = $this->db->get();

        $MyHour = $UnitHour;
        foreach ($AllPlanHour->result() as $ii) {
            $Minus = $ii->tb_lesson_plan_hour;
            $MyHour = $MyHour - $Minus;
        }

        $this->db->select("tb_lesson_plan_hour")->from("tb_lesson_plan");
        $this->db->where("id", $MyPlanId);
        $MyPlanQ = $this->db->get()->result_array();

        $MyPlanHour = $MyPlanQ[0]['tb_lesson_plan_hour'];
        $MySumHour = $MyHour + $MyPlanHour;

        $output .= "<option value=\"\">---เลือกชั่วโมง---</option> ";

        for ($i = 1; $i <= $MySumHour; $i++) {
            $output .= "<option value=\"" . $i . "\">" . $i . " ชั่วโมง</option> ";
        }

        return $output;
    }

//--- Edit plan แก้ไขแผนการสอน
    function edit_plan_list($id) {
        $this->db->select("a.*, b.*, c.*,d.*, e.*, f.*,g.*, h.*, i.*, a.id AS PlanId ")->from("tb_lesson_plan a");
        $this->db->join("tb_lesson_plan_essence b", "b.tb_lesson_plan_id = a.id");
        $this->db->join("tb_lesson_plan_learning c", "c.tb_lesson_plan_id = a.id");
        $this->db->join("tb_lesson_plan_purpose d", "d.tb_lesson_plan_id = a.id");
        $this->db->join("tb_lesson_plan_evaluate_tool e", "e.tb_lesson_plan_id = a.id");
        $this->db->join("tb_lesson_plan_evaluate_method f", "f.tb_lesson_plan_id = a.id");
        $this->db->join("tb_lesson_plan_evaluate_criterion g", "g.tb_lesson_plan_id = a.id");
        $this->db->join("tb_lesson_plan_media h", "h.tb_lesson_plan_id = a.id");
        $this->db->join("tb_lesson_plan_expect i", "i.tb_lesson_plan_id = a.id");
        $this->db->where("a.id", $id);
        $this->db->order_by("a.id asc");
        $rs = $this->db->get();
        if ($rs->num_rows() > 0) {
            return $rs->row_array();
        }
        return array();
    }

//--Edit plan แก้ไขแผนการสอน

    function get_result_plan($id) {
        $output = "";

//------- โหลดหัวเอกสาร
        $this->db->select("a.id,a.tb_lesson_plan_sequence,a.tb_lesson_plan_name,a.tb_lesson_plan_hour,");
        $this->db->select("b.tb_unit_learning_sequence,b.tb_unit_learning_name,b.tb_unit_learning_hour,");
        $this->db->select("c.tb_course_code,d.tb_subject_name,e.tb_group_learningcol_name");
        $this->db->select("f.id,g.tb_ed_school_class_name,g.tb_ed_school_class_level");
        $this->db->from("tb_lesson_plan a");
        $this->db->join("tb_unit_learning b", "b.id = a.tb_unit_learning_id");
        $this->db->join("tb_course c", "c.id = b.tb_course_id");
        $this->db->join("tb_subject d", "d.id = c.tb_subject_id");
        $this->db->join("tb_group_learning e", "e.id = d.tb_group_learning_id");
        $this->db->join("tb_ed_school_register_class f", "f.id = c.tb_ed_school_register_class_id");
        $this->db->join("tb_ed_school_class g", "g.id = f.tb_ed_school_class_id");
        $this->db->where("a.id", $id);
        $this->db->order_by("a.id asc");
        $MyHeadQ = $this->db->get()->result_array();
//----- จบ

        $output .= "<center><h2 class=\"modal-title\" id=\"\" ><b>แผนการจัดการเรียนรู้</b></h2></center>";
        $output .= "<br></br>";
        $output .= "<div class=\"col-md-12 col-md-offset-1\">";
        $output .= "<b id=\"HeadPlanResult\">กลุ่มสาระการเรียนรู้" . $MyHeadQ[0]['tb_group_learningcol_name'] . " วิชา : " . $MyHeadQ[0]['tb_subject_name'] . " ระดับชั้น : " . $MyHeadQ[0]['tb_ed_school_class_name'] . "ปีที่ " . $MyHeadQ[0]['tb_ed_school_class_level'] . "</b>";
        $output .= "</div>";
        $output .= "<br></br>";
        $output .= "<div class=\"col-md-12 col-md-offset-1\">";
        $output .= "<b id=\"HeadPlanResultSub\">หน่วยการเรียนรู้ที่ " . $MyHeadQ[0]['tb_unit_learning_sequence'] . " เรื่อง " . $MyHeadQ[0]['tb_unit_learning_name'] . " เวลาเรียน " . $MyHeadQ[0]['tb_unit_learning_hour'] . " ชั่วโมง</b>";
        $output .= "</div>";
        $output .= "<br></br>";
        $output .= "<div class=\"col-md-12 col-md-offset-1\">";
        $output .= "<b id=\"HeadPlanResultSub\">แผนการเรียนรู้ที่ " . $MyHeadQ[0]['tb_lesson_plan_sequence'] . " เรื่อง " . $MyHeadQ[0]['tb_lesson_plan_name'] . " เวลาเรียน " . $MyHeadQ[0]['tb_lesson_plan_hour'] . " ชั่วโมง</b>";
        $output .= "</div>";
        $output .= "<br></br>";

//------------

        $this->db->select("a.*, a.id AS PlanId, ");
        $this->db->select("b.tb_lesson_plan_essence_content, c.tb_lesson_plan_learning_content, d.tb_lesson_plan_purpose_content,");
        $this->db->select("e.tb_lesson_plan_evaluate_tool_content, f.tb_lesson_plan_evaluate_method_content, g.tb_lesson_plan_evaluate_criterion_content,");
        $this->db->select("h.tb_lesson_plan_media_content, i.tb_lesson_plan_expect_content,");
//        $this->db->select("j.tb_kpi_standard_learning_content, k.tb_standard_learning_content");
        $this->db->from("tb_lesson_plan a");
        $this->db->join("tb_lesson_plan_essence b", "b.tb_lesson_plan_id = a.id");
        $this->db->join("tb_lesson_plan_learning c", "c.tb_lesson_plan_id = a.id");
        $this->db->join("tb_lesson_plan_purpose d", "d.tb_lesson_plan_id = a.id");
        $this->db->join("tb_lesson_plan_evaluate_tool e", "e.tb_lesson_plan_id = a.id");
        $this->db->join("tb_lesson_plan_evaluate_method f", "f.tb_lesson_plan_id = a.id");
        $this->db->join("tb_lesson_plan_evaluate_criterion g", "g.tb_lesson_plan_id = a.id");
        $this->db->join("tb_lesson_plan_media h", "h.tb_lesson_plan_id = a.id");
        $this->db->join("tb_lesson_plan_expect i", "i.tb_lesson_plan_id = a.id");
//        $this->db->join("tb_kpi_standard_learning j", "j.id = a.tb_kpi_standard_learning_id");
//        $this->db->join("tb_standard_learning k", "k.id = j.tb_standard_learning_id");
        $this->db->where("a.id", $id);
        $this->db->order_by("a.id asc");
        $row = $this->db->get()->result_array();


        $output .= "<fieldset>";
        $output .= "<legend class=\"legend-heading\">มาตรฐานการเรียนรู้</legend>";
        $output .= "<div class=\"col-md-11 col-md-offset-1\">";
        $output .= "<p>" . "Content" . "</p>";
        $output .= "</div>";
        $output .= "</fieldset>";
        $output .= "<br></br>";


        $output .= "<fieldset>";
        $output .= "<legend class=\"legend-heading\">สาระสำคัญ</legend>";
        $output .= "<div class=\"col-md-11 col-md-offset-1\">";
        $output .= "<p>" . $row[0]['tb_lesson_plan_essence_content'] . "</p>";
        $output .= "</div>";
        $output .= "</fieldset>";
        $output .= "<br></br>";

//---------- loop คุณลักษณะอันพึงประสงค์
        $this->db->select("a.id,b.tb_ed_character_content");
        $this->db->from("tb_lesson_plan_character a");
        $this->db->join("tb_ed_character b", "b.id = a.tb_ed_character_id");
        $this->db->where("a.tb_lesson_plan_id", $id);
        $this->db->order_by("a.id asc");
        $MyCharacterQ = $this->db->get();

        if (count($MyCharacterQ->result()) > 0) {
            $output .= "<fieldset>";
            $output .= "<legend class=\"legend-heading\">คุณลักษณะอันพึงประสงค์</legend>";
            $i = 1;
            foreach ($MyCharacterQ->result() as $rCharacter) {
                $output .= "<div class=\"col-md-11 col-md-offset-1\">";
                $output .= "<p>" . $i . ". " . $rCharacter->tb_ed_character_content . "</p>";
                $output .= "</div>";
                $i++;
            }

            $output .= "</fieldset>";
            $output .= "<br></br>";
        }

//---------- End loop คุณลักษณะอันพึงประสงค์
//---------- loop อ่าน คิดวิเคราะห์และเขียน
        $this->db->select("a.id,b.tb_ed_rw_analysis_content");
        $this->db->from("tb_lesson_plan_rw_analysis a");
        $this->db->join("tb_ed_rw_analysis b", "b.id = a.tb_ed_rw_analysis_id");
        $this->db->where("a.tb_lesson_plan_id", $id);
        $this->db->order_by("a.id asc");
        $MyRw_analysisQ = $this->db->get();

        if (count($MyRw_analysisQ->result()) > 0) {
            $output .= "<fieldset>";
            $output .= "<legend class=\"legend-heading\">อ่าน คิดวิเคราะห์และเขียน</legend>";
            $i = 1;
            foreach ($MyRw_analysisQ->result() as $rRw_analysis) {
                $output .= "<div class=\"col-md-11 col-md-offset-1\">";
                $output .= "<p>" . $i . ". " . $rRw_analysis->tb_ed_rw_analysis_content . "</p>";
                $output .= "</div>";
                $i++;
            }

            $output .= "</fieldset>";
            $output .= "<br></br>";
        }

//---------- End loop อ่าน คิดวิเคราะห์และเขียน
//---------- loop สมรรถนะ
        $this->db->select("a.id,b.tb_ed_capacity_content");
        $this->db->from("tb_lesson_plan_capacity a");
        $this->db->join("tb_ed_capacity b", "b.id = a.tb_ed_capacity_id");
        $this->db->where("a.tb_lesson_plan_id", $id);
        $this->db->order_by("a.id asc");
        $MyCapacityQ = $this->db->get();

        if (count($MyCapacityQ->result()) > 0) {
            $output .= "<fieldset>";
            $output .= "<legend class=\"legend-heading\">สมรรถนะสำคัญของผู้เรียน</legend>";
            $i = 1;
            foreach ($MyCapacityQ->result() as $rCapacity) {
                $output .= "<div class=\"col-md-11 col-md-offset-1\">";
                $output .= "<p>" . $i . ". " . $rCapacity->tb_ed_capacity_content . "</p>";
                $output .= "</div>";
                $i++;
            }

            $output .= "</fieldset>";
            $output .= "<br></br>";
        }

//---------- End loop สมรรถนะ

        $output .= "<fieldset>";
        $output .= "<legend class=\"legend-heading\">ผลการเรียนรู้ที่คาดหวัง</legend>";
        $output .= "<div class=\"col-md-11 col-md-offset-1\">";
        $output .= "<p>" . $row[0]['tb_lesson_plan_expect_content'] . "</p>";
        $output .= "</div>";
        $output .= "</fieldset>";
        $output .= "<br></br>";


        $output .= "<fieldset>";
        $output .= "<legend class=\"legend-heading\">สาระการเรียนรู้</legend>";
        $output .= "<div class=\"col-md-11 col-md-offset-1\">";
        $output .= "<p>" . $row[0]['tb_lesson_plan_learning_content'] . "</p>";
        $output .= "</div>";
        $output .= "</fieldset>";
        $output .= "<br></br>";

//---------- loop กระบวนการ
        $this->db->select("tb_lesson_plan_process_content,tb_lesson_plan_process_sequence")->from("tb_lesson_plan_process");
        $this->db->where("tb_lesson_plan_id", $id);
        $this->db->order_by("tb_lesson_plan_process_sequence asc");
        $MyProQ = $this->db->get();


        $output .= "<fieldset>";
        $output .= "<legend class=\"legend-heading\">กระบวนการจัดการเรียนรู้</legend>";

        foreach ($MyProQ->result() as $rProcess) {
            $output .= "<div class=\"col-md-11 col-md-offset-1\">";
            $output .= "<p>" . $rProcess->tb_lesson_plan_process_sequence . ". " . $rProcess->tb_lesson_plan_process_content . "</p>";
            $output .= "</div>";
        }

        $output .= "</fieldset>";
        $output .= "<br></br>";
//---------- End loop กระบวนการ
//------- การวัดผลประเมินผล 
        $output .= "<fieldset>";
        $output .= "<legend class=\"legend-heading\">สื่อ/แหล่งเรียนรู้</legend>";
        $output .= "<div class=\"col-md-11 col-md-offset-1\">";
        $output .= "<p>" . $row[0]['tb_lesson_plan_media_content'] . "</p>";
        $output .= "</div>";
        $output .= "</fieldset>";
        $output .= "<br></br>";


        $output .= "<fieldset>";
        $output .= "<legend class=\"legend-heading\">การวัดผลประเมินผล</legend>";

        $output .= "<div class=\"col-md-11 col-md-offset-1\">";

        $output .= "<section>";
        $output .= "<h4><b>วิธีการวัด</b></h4>";
        $output .= "<p>&nbsp; - " . $row[0]['tb_lesson_plan_evaluate_method_content'] . "</p>";
        $output .= "</section>";
        $output .= "<br></br>";

        $output .= "<section>";
        $output .= "<h4><b>เครื่องมือที่ใช้ในการวัดผลและประเมินผล</b></h4>";
        $output .= "<p>&nbsp; - " . $row[0]['tb_lesson_plan_evaluate_tool_content'] . "</p>";
        $output .= "</section>";
        $output .= "<br></br>";

        $output .= "<section>";
        $output .= "<h4><b>เกณฑ์การวัดผลประเมินผล</b></h4>";
        $output .= "<p>&nbsp; - " . $row[0]['tb_lesson_plan_evaluate_criterion_content'] . "</p>";
        $output .= "</section>";
        $output .= "<br></br>";

        $output .= "</div>";

        $output .= "</fieldset>";
        $output .= "<br></br>";
//------- การวัดผลประเมินผล จบ *
//---------- loop เอกสารแนบ
        $this->db->select("tb_lesson_plan_document_name,tb_lesson_plan_document_note,tb_lesson_plan_document_type")->from("tb_lesson_plan_document");
        $this->db->where("tb_lesson_plan_id", $id);
        $this->db->order_by("tb_lesson_plan_document_type asc");
        $MyDocQ = $this->db->get();


        $output .= "<fieldset>";
        $output .= "<legend class=\"legend-heading\">เอกสารประกอบ</legend>";
        foreach ($MyDocQ->result() as $rDoc) {


            $output .= "<div class=\"col-md-3 col-md-offset-1\">";
            if ($rDoc->tb_lesson_plan_document_type == "Test") {
                $output .= "<div class=\"panel panel-danger\" style=\"margin-top:20px;\">";
            } else {
                $output .= "<div class=\"panel panel-info\" style=\"margin-top:20px;\">";
            }


            $output .= "<div class = \"panel-heading\">";
            $output .= "<div class=\"row\">";
            if ($rDoc->tb_lesson_plan_document_type == "Test") {
                $output .= "<p><center>แบบทดสอบ</center></p>";
            } else {
                $output .= "<p><center>ใบงาน</center></p>";
            }
            $output .= "<p><center>" . $rDoc->tb_lesson_plan_document_note . "</center></p>";
            $output .= "</div>";
            $output .= "</div>";

            $output .= "<div class=\"panel-body\">";
            $output .= "<div class=\"row\">";
            $output .= "<p>" . $rDoc->tb_lesson_plan_document_name . "</p>";
            $output .= "</div>";



            $output .= "</div>";
            $output .= "</div>";
            $output .= "</div>";
        }

        $output .= "</fieldset>";
        $output .= "<br></br>";
//---------- End loop เอกสารแนบ

        return $output;
    }

//------- Table กระบวนการ
    function get_process_list($id) {

        $this->db->select("*")->from("tb_lesson_plan_process");
        $this->db->where("tb_lesson_plan_id", $id);
        $this->db->order_by("tb_lesson_plan_process_sequence asc");
        $query = $this->db->get();

        $ii = 1;

        $output = "<table  class=\"table table-hover table-striped table-bordered display\" >";

        $output .= "<thead>";
        $output .= "<tr>";
        $output .= "<th style=\"text-align: center; width:10%\" class=\"sorting\">ลำดับที่</th>";
        $output .= "<th style=\"text-align: center; width:60%\">กระบวนการ</th>";
        $output .= "<th style=\"text-align: center; width:30%\">การจัดการ</th>";
        $output .= "</tr>";
        $output .= "</thead>";

        $output .= "<tbody>";
        foreach ($query->result() as $row) {
            if ($ii > 1) {
                $output .= "<tr>";
            }

            $output .= "<td><center>" . $row->tb_lesson_plan_process_sequence . "</center></td>";
            $output .= "<td>" . $row->tb_lesson_plan_process_content . "</td>";

            $output .= "<td><center>" . "";
            $output .= "<button type=\"button\" class=\"btn btn-warning btn-process-edit\" id=\"" . $row->id . "\"><i class=\"icon-pencil icon-large\"></i> แก้ไข</button> &nbsp;";
            $output .= "<button type=\"button\" class=\"btn btn-danger btn-process-delete\" id=\"" . $row->id . "\"><i class=\"icon-trash icon-large\"></i> ลบ</button> &nbsp;";
            $output .= "" . "</center></td>";

            $ii ++;
            $output .= "</tr>";
        }
        $output .= "</tbody>";
        $output .= "</table>";


        return $output;
    }

//------- Table doc เอกสาร
    function get_doc_list($id) {

        $this->db->select("*")->from("tb_lesson_plan_document");
        $this->db->where("tb_lesson_plan_id", $id);
        $this->db->order_by("id asc");
        $query = $this->db->get();

        $ii = 1;

        $output = "<table  class=\"table table-hover table-striped table-bordered display\" >";

        $output .= "<thead>";
        $output .= "<tr>";
        $output .= "<th style=\"text-align: center; width:10%\" class=\"sorting\">ลำดับที่</th>";
        $output .= "<th style=\"text-align: center; width:20%\" class=\"no-sort\">เอกสาร</th>";
        $output .= "<th style=\"text-align: center; width:20%\" class=\"no-sort\">ประเภทเอกสาร</th>";
        $output .= "<th style=\"text-align: center; width:30%\" class=\"no-sort\">หมายเหตุ</th>";
        $output .= "<th style=\"text-align: center; width:20%\" class=\"no-sort\">จัดการ</th>";
        $output .= "</tr>";
        $output .= "</thead>";

        $output .= "<tbody>";
        foreach ($query->result() as $row) {
            if ($ii > 1) {
                $output .= "<tr>";
            }

            $output .= "<td><center>" . $ii . "</center></td>";

            $output .= "<td>" . $row->tb_lesson_plan_document_name . "</td>";

            switch ($row->tb_lesson_plan_document_type) {
                case "Test":
                    $output .= "<td><center><font color=\"Blue\">แบบทดสอบ</font></center></td>";
                    break;
                case "Sheet":
                    $output .= "<td><center><font color=\"Green\">ใบงาน</font></center></td>";
                    break;
            }

            $output .= "<td>" . $row->tb_lesson_plan_document_note . "</td>";

            $output .= "<td><center>" . "";
//            $output .= "<button type=\"button\" class=\"btn btn-warning btn-process-edit\" id=\"" . $row->id . "\"><i class=\"icon-pencil icon-large\"></i> แก้ไข</button> &nbsp;";
            $output .= "<button type=\"button\" class=\"btn btn-danger btn-doc-delete\" id=\"" . $row->id . "\"><i class=\"icon-trash icon-large\"></i> ลบ</button> &nbsp;";
            $output .= "" . "</center></td>";

            $ii ++;
            $output .= "</tr>";
        }
        $output .= "</tbody>";
        $output .= "</table>";


        return $output;
    }

//------- Table doc เอกสาร
    function get_other_list($id) {


        $output = "<table  class=\"table table-hover table-striped table-bordered display\" >";

        $output .= "<thead>";
        $output .= "<tr>";
        $output .= "<th style=\"text-align: center; width:80%\" class=\"no-sort\">เนื้อหา</th>";
        $output .= "<th style=\"text-align: center; width:20%\" class=\"no-sort\">จัดการ</th>";
        $output .= "</tr>";
        $output .= "</thead>";

        $output .= "<tbody>";

//------ ข้อมูลชุดที่ 1 การอ่านคิดวิเคราะห์เขียน
        $this->db->select("*")->from("tb_ed_rw_analysis");
//$this->db->where("tb_lesson_plan_id", $id);
        $this->db->order_by("id asc");
        $query = $this->db->get();

        $ii = 1;
        $output .= "<tr>";
        $output .= "<td colspan=\"2\"><b><font color=\"blue\">&nbsp; อ่านคิดวิเคราะห์เขียน</font></b></td>";
        $output .= "</tr>";


        foreach ($query->result() as $row) {
            if ($ii > 1) {
                $output .= "<tr>";
            }
            $MyCheck = $row->id;

            $output .= "<td><font color=\"blue\">&nbsp;&nbsp; - " . $ii . ". " . $row->tb_ed_rw_analysis_content . "</font></td>";

            $output .= "<td><center>" . "";

            $this->db->select("id")->from("tb_lesson_plan_rw_analysis");
            $this->db->where("tb_ed_rw_analysis_id", $MyCheck);
            $this->db->where("tb_lesson_plan_id", $id);
            $MyQ = $this->db->get()->result_array();

            if (count($MyQ) > 0) {
                $output .= "<button type=\"button\" class=\"btn btn-success btn-rwa-check\" id=\"" . $MyQ[0]['id'] . "\"><i class=\"icon-ok icon-large\"></i> เลือกแล้ว</button> &nbsp;";
            } else {
                $output .= "<button type=\"button\" class=\"btn btn-light btn-rwa-uncheck\" id=\"" . $row->id . "\"> คลิกเพื่อเลือก </button> &nbsp;";
            }

            $output .= "" . "</center></td>";

            $ii ++;
            $output .= "</tr>";
        }

//------ ข้อมูลชุดที่ 2 คุณลักษณะ
        $this->db->select("*")->from("tb_ed_character");
//$this->db->where("tb_lesson_plan_id", $id);
        $this->db->order_by("id asc");
        $query = $this->db->get();

        $ii = 1;
        $output .= "<tr>";
        $output .= "<td colspan=\"2\"><b><font color=\"brown\">&nbsp; คุณลักษณะอังพึงประสงค์</font></b></td>";
        $output .= "</tr>";


        foreach ($query->result() as $row) {
            if ($ii > 1) {
                $output .= "<tr>";
            }
            $MyCheck = $row->id;

            $output .= "<td><font color=\"brown\">&nbsp;&nbsp; - " . $ii . ". " . $row->tb_ed_character_content . "</font></td>";

            $output .= "<td><center>" . "";

            $this->db->select("*")->from("tb_lesson_plan_character");
            $this->db->where("tb_ed_character_id", $MyCheck);
            $this->db->where("tb_lesson_plan_id", $id);
            $MyQ = $this->db->get()->result_array();

            if (count($MyQ) > 0) {
                $output .= "<button type=\"button\" class=\"btn btn-success btn-cha-check\" id=\"" . $MyQ[0]['id'] . "\"><i class=\"icon-ok icon-large\"></i> เลือกแล้ว</button> &nbsp;";
            } else {
                $output .= "<button type=\"button\" class=\"btn btn-light btn-cha-uncheck\" id=\"" . $row->id . "\"> คลิกเพื่อเลือก </button> &nbsp;";
            }
            $output .= "" . "</center></td>";

            $ii ++;
            $output .= "</tr>";
        }

//------ ข้อมูลชุดที่ 3 สมรรถนะผู้เรียน
        $this->db->select("*")->from("tb_ed_capacity");
//$this->db->where("tb_lesson_plan_id", $id);
        $this->db->order_by("id asc");
        $query = $this->db->get();

        $ii = 1;
        $output .= "<tr>";
        $output .= "<td colspan=\"2\"><b><font color=\"green\">&nbsp; สมรรถนะผู้เรียน</font></b></td>";
        $output .= "</tr>";


        foreach ($query->result() as $row) {
            if ($ii > 1) {
                $output .= "<tr>";
            }
            $MyCheck = $row->id;

            $output .= "<td><font color=\"green\">&nbsp;&nbsp; - " . $ii . ". " . $row->tb_ed_capacity_content . "</font></td>";

            $output .= "<td><center>" . "";

            $this->db->select("*")->from("tb_lesson_plan_capacity");
            $this->db->where("tb_ed_capacity_id", $MyCheck);
            $this->db->where("tb_lesson_plan_id", $id);
            $MyQ = $this->db->get()->result_array();


            if (count($MyQ) > 0) {
                $output .= "<button type=\"button\" class=\"btn btn-success btn-cap-check\" id=\"" . $MyQ[0]['id'] . "\"><i class=\"icon-ok icon-large\"></i> เลือกแล้ว</button> &nbsp;";
            } else {
                $output .= "<button type=\"button\" class=\"btn btn-light btn-cap-uncheck\" id=\"" . $row->id . "\"> คลิกเพื่อเลือก </button> &nbsp;";
            }
            $output .= "" . "</center></td>";

            $ii ++;
            $output .= "</tr>";
        }

        $output .= "</tbody>";
        $output .= "</table>";


        return $output;
    }

    function gen_subject_code($SId, $CId) {
        $output = "";

        $this->db->select("*");
        $this->db->from("tb_subject");
        $this->db->where("id", $SId);
        $MySubjectQ = $this->db->get()->result_array();


        $str1 = $MySubjectQ[0]['tb_subject_abbreviation'];


        switch ($MySubjectQ[0]['tb_subject_type']) {
            case "พื้นฐาน":
                $str4 = "1";
                break;
            default:
                $str4 = "2";
        }


        $this->db->select("a.*,b.*,a.id as CId");
        $this->db->from("tb_ed_school_register_class a");
        $this->db->join("tb_ed_school_class b", "b.id = a.tb_ed_school_class_id");
        $this->db->where("a.id", $CId);
        $MyClassQ = $this->db->get()->result_array();

        switch ($MyClassQ[0]['tb_ed_school_class_kind']) {
            case "มัธยมศึกษาตอนปลาย":
                $str2 = "3";
                break;
            case "มัธยมศึกษาตอนต้น":
                $str2 = "2";
                break;
            case "ประถมศึกษา":
                $str2 = "1";
                break;
            default:
                echo "";
        }

        $str3 = $MyClassQ[0]['tb_ed_school_class_level'];

        $this->db->select("a.*,b.*,a.id as id");
        $this->db->from("tb_course a");
        $this->db->join("tb_subject b", "b.id = a.tb_subject_id");
        $this->db->where("a.tb_subject_id", $SId);
        $this->db->where("a.tb_ed_school_register_class_id", $CId);
        $MyCountQ = $this->db->get()->result_array();

        $MyCount = count($MyCountQ);
        $MyCount++;

        if ($MyCount >= 9) {
            $str5 = $MyCount;
        } else {
            $str5 = "0" . $MyCount;
        }
        $output .= $str1 . $str2 . $str3 . $str4 . $str5;

        return $output;
    }

}
