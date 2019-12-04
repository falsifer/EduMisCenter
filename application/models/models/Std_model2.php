<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/*
  | ----------------------------------------------------------------------------
  |  Title
  | ----------------------------------------------------------------------------
  | Copyright	Edutech Co.,Ltd.
  | Purpose     โมเดลนักเรียน
  | Author      chairatto
  | Create Date 23/11/2561
  | Last edit	8/3/2562
  | Comment	-
  | ----------------------------------------------------------------------------
 */

class Std_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    function get_std_base_w_filter($RoomId, $ClassId, $EdYear, $StdStatus) {
        $this->db->select("CONCAT (a.std_titlename,a.std_firstname,\" \",a.std_lastname) as std_fullname,a.id as StdId,a.*");
        $this->db->select("b.tb_ed_classroom_number as std_number,");
        $this->db->select("c.tb_classroom_room as std_room_number,");
        $this->db->select("d.tb_ed_school_register_class_edyear as std_edyear,");
        $this->db->select("e.tb_ed_plan as std_plan,");
        $this->db->select("CONCAT (f.tb_ed_school_class_name,'ชั้นปีที ',f.tb_ed_school_class_level) as std_classname");
        $this->db->from("tb_student_base a");

        $this->db->join("tb_ed_classroom b", "b.tb_student_base_id = a.id");
        $this->db->join("tb_ed_room c", "c.id = b.tb_ed_room_id");
        $this->db->join("tb_ed_school_register_class d", "d.id = c.tb_ed_school_register_class_id");
        $this->db->join("tb_ed_plan e", "e.id = c.tb_ed_plan_id");
        $this->db->join("tb_ed_school_class f", "f.id = d.tb_ed_school_class_id");

        $this->db->where("a.tb_student_base_department", $this->session->userdata('department'));

        if ($StdStatus != "") {
            $this->db->where("a.tb_student_base_status", $StdStatus);
        }
        if ($EdYear != "") {
            $this->db->where("d.tb_ed_school_register_class_edyear", $EdYear);
            $this->db->order_by("f.id asc");
            $this->db->order_by("f.tb_ed_school_class_level asc");
        }
        if ($ClassId != "") {
            $this->db->where("d.id", $ClassId);
        }
        if ($RoomId != "") {
            $this->db->where("c.id", $RoomId);
        }

        $this->db->order_by("b.tb_ed_classroom_number asc");
        $MyQ = $this->db->get();
        if ($MyQ->num_rows() > 0) {
            return $MyQ->result();
        } else {
            return false;
        }
    }

    function get_std_base_w_stdid($StdId) {
        $this->db->select("CONCAT (a.std_titlename,a.std_firstname,\" \",a.std_lastname) as std_fullname,a.id as StdId,a.*");
        $this->db->select("b.tb_ed_classroom_number as std_number,");
        $this->db->select("c.tb_classroom_room as std_room_number,");
        $this->db->select("d.tb_ed_school_register_class_edyear as std_edyear,");
        $this->db->select("e.tb_ed_plan as std_plan,");
        $this->db->select("CONCAT (f.tb_ed_school_class_name,'ชั้นปีที ',f.tb_ed_school_class_level) as std_classname");
        $this->db->from("tb_student_base a");

        $this->db->join("tb_ed_classroom b", "b.tb_student_base_id = a.id");
        $this->db->join("tb_ed_room c", "c.id = b.tb_ed_room_id");
        $this->db->join("tb_ed_school_register_class d", "d.id = c.tb_ed_school_register_class_id");
        $this->db->join("tb_ed_plan e", "e.id = c.tb_ed_plan_id");
        $this->db->join("tb_ed_school_class f", "f.id = d.tb_ed_school_class_id");

        $this->db->where("a.id", $StdId);

        $MyQ = $this->db->get();
        if ($MyQ->num_rows() > 0) {
            return $MyQ->row_array();
        } else {
            return false;
        }
    }

    function get_std_base_w_roomid($RoomId) {
        $this->db->select("CONCAT (a.std_titlename,a.std_firstname,\" \",a.std_lastname) as std_fullname,a.id as StdId,a.*");
        $this->db->select("b.tb_ed_classroom_number as std_number,");
        $this->db->select("c.tb_classroom_room as std_room_number,");
        $this->db->select("d.tb_ed_school_register_class_edyear as std_edyear,");
        $this->db->select("e.tb_ed_plan as std_plan,");
        $this->db->select("CONCAT (f.tb_ed_school_class_name,'ชั้นปีที ',f.tb_ed_school_class_level) as std_classname");
        $this->db->from("tb_student_base a");

        $this->db->join("tb_ed_classroom b", "b.tb_student_base_id = a.id");
        $this->db->join("tb_ed_room c", "c.id = b.tb_ed_room_id");
        $this->db->join("tb_ed_school_register_class d", "d.id = c.tb_ed_school_register_class_id");
        $this->db->join("tb_ed_plan e", "e.id = c.tb_ed_plan_id");
        $this->db->join("tb_ed_school_class f", "f.id = d.tb_ed_school_class_id");

        $this->db->where("b.tb_ed_room_id", $RoomId);
        $this->db->order_by("b.tb_ed_classroom_number asc");
        $MyQ = $this->db->get();
        if ($MyQ->num_rows() > 0) {
            return $MyQ->result();
        } else {
            return false;
        }
    }

    function get_std_base_w_courseid($CourseId, $EdYear) {
        $this->db->select("CONCAT (a.std_titlename,a.std_firstname,\" \",a.std_lastname) as std_fullname,a.id as StdId,a.*");
        $this->db->select("b.tb_ed_classroom_number as std_number,");
        $this->db->select("c.tb_classroom_room as std_room_number,");
        $this->db->select("d.tb_ed_school_register_class_edyear as std_edyear,");
        $this->db->select("e.tb_ed_plan as std_plan,");
        $this->db->select("CONCAT (f.tb_ed_school_class_name,'ชั้นปีที ',f.tb_ed_school_class_level) as std_classname");
        $this->db->select("g.id as gid");
        $this->db->from("tb_student_base a");

        $this->db->join("tb_ed_classroom b", "b.tb_student_base_id = a.id");
        $this->db->join("tb_ed_room c", "c.id = b.tb_ed_room_id");
        $this->db->join("tb_ed_school_register_class d", "d.id = c.tb_ed_school_register_class_id");
        $this->db->join("tb_ed_plan e", "e.id = c.tb_ed_plan_id");
        $this->db->join("tb_ed_school_class f", "f.id = d.tb_ed_school_class_id");
        $this->db->join("tb_register_course g", "g.tb_student_base_id = a.id");

        $this->db->where("g.tb_course_id", $CourseId);
        $this->db->where('d.tb_ed_school_register_class_edyear', $EdYear);

        $this->db->order_by("b.tb_ed_classroom_number asc");
//$this->db->where("a.tb_student_base_status", "S");

        $MyQ = $this->db->get();
        if ($MyQ->num_rows() > 0) {
            return $MyQ->result_array();
        } else {
            return false;
        }
    }

    //-------------
    function get_std_base_where($check) {
        $stdstatus = "S";
        $this->db->select("a.*, b.*, a.id AS id")->from("tb_student_base a");
        $this->db->join("tb_std_before_register b", "b.tb_student_base_id = a.id", 'left outer');
        $this->db->where("a.tb_student_base_status", $stdstatus);
        //$this->db->where("d.fm_parent = 1");
        //$this->db->where("b.std_department = '$check'");
        $this->db->order_by("a.std_firstname asc");
        $rs = $this->db->get();
        if ($rs->num_rows() > 0) {
            return $rs->result_array();
        }
        return array();
    }

    //===== student filter
    function get_std_base_list($rid, $cid, $edyear, $StdStatus) {

        //-tb_student_base
        $this->db->select("*");
        $this->db->select("CONCAT (a.std_titlename,a.std_firstname,\" \",a.std_lastname) as std_fullname,a.id as StdId");
        $this->db->from("tb_student_base a");
        $this->db->join("tb_ed_classroom b", "b.tb_student_base_id = a.id");
        $this->db->join("tb_ed_room c", "c.id = b.tb_ed_room_id");
        $this->db->join("tb_ed_school_register_class d", "d.id = c.tb_ed_school_register_class_id");
        $this->db->join("tb_ed_plan e", "e.id = c.tb_ed_plan_id");
        $this->db->join("tb_ed_school_class f", "f.id = d.tb_ed_school_class_id");

        if ($StdStatus != "") {
            $this->db->where("a.tb_student_base_status", $StdStatus);
        }
        if ($edyear != "") {
            $this->db->where("d.tb_ed_school_register_class_edyear", $edyear);
            $this->db->order_by("f.id asc");
            $this->db->order_by("f.tb_ed_school_class_level asc");
        }
        if ($cid != "") {
            $this->db->where("d.id", $cid);
        }
        if ($rid != "") {
            $this->db->where("c.id", $rid);
        }

        $this->db->order_by("b.tb_ed_classroom_number asc");
        $MyQ = $this->db->get();
        if ($MyQ->num_rows() > 0) {
            return $MyQ->result();
        } else {
            $MyQ = "FALSE";
        }
        return $MyQ;
    }

    function get_std_edit($id) {
        $this->db->select("a.*, b.*, *c.*,d.*,e.*,f.*,b.id AS bid,d.id as did")->from("tb_registration_address a");
        $this->db->join("tb_student_base b", "b.id = a.own_id", "right outer");
        //$this->db->join("tb_std_health c", "c.own_id = b.id", "left outer");
        $this->db->join("tb_std_family d", "d.std_id = b.id", "left outer");
        $this->db->join("tb_outsider c", "c.id = d.tb_outsider_id", "left outer");
        $this->db->join("tb_fm_career e", "e.tb_outsider_id = c.id", "left outer");
        $this->db->join("tb_std_picture f", "f.own_id = b.id", "left outer");
        $this->db->where("b.id", $id);
//        $this->db->where("d.fm_parent = 1");
        $query = $this->db->get()->row_array();
        if (count($query) > 0) {
            return $query;
        }
        return array();
    }

    function student_edit($id) {
        //, b.*,c.*,d.*,e.*, c.id as FamId, e.id as JobId, b.id as AddId
        $this->db->select("a.*,a.id as StdId");
        $this->db->from("tb_student_base a");
//        $this->db->join("tb_std_address b", "b.std_id = a.id", "left outer");
//        $this->db->join("tb_std_family d", "d.std_id = a.id", "left outer");
//        $this->db->join("tb_outsider c", "c.id = d.tb_outsider_id", "left outer");
//        $this->db->join("tb_fm_career e", "e.tb_outsider_id = c.id", "left outer");
        $this->db->where("a.id", $id);
//        $this->db->or_where("c.tb_outsider_parent = 1");
//        $this->db->or_where("e.cr_createdate in (select max(cr_createdate) from tb_fm_career where tb_outsider_id = c.id)");
        $query = $this->db->get()->row_array();
        if (count($query) > 0) {
            return $query;
        }
        return array();
    }

    // ดึงข้อมูลเพียงเรคคอร์ดเดียว
    function get_student_by_id($id) {
        $this->db->select("* a.id as StdId");
        $this->db->from("tb_student_base a");
//        $this->db->join("tb_std_picture b", "b.own_id = a.id", "left outer");
        $this->db->join("tb_std_health c", "c.own_id = a.id", "left outer");
        $this->db->where("a.id", $id);
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->row_array();
        } else {
            return false;
        }
    }

    //====== งานรับนักเรียน ======//

    function get_register_base() {
        $stdstatus = "W";
        $this->db->select("a.*, b.*,c.*,d.*,c.id as ClsId, a.id AS id")->from("tb_student_base a");
        $this->db->join("tb_std_before_register b", "b.tb_student_base_id = a.id", 'left outer');
        $this->db->join("tb_ed_school_register_class c", "c.id = b.tb_ed_school_register_class_id");
        $this->db->join("tb_ed_school_class d", "d.id = c.tb_ed_school_class_id");
        $this->db->where("a.tb_student_base_status", $stdstatus);
        $this->db->order_by("a.std_firstname asc");
        $rs = $this->db->get();
        if ($rs->num_rows() > 0) {
            return $rs->result_array();
        }
        return array();
    }

    //====== งานรับนักเรียน ======//
    //===== แถบซ้าย นักเรียนที่รอรับเข้าระบบ
    function get_std_waiting_list($id) {
        $stdstatus = "W";

        $this->db->select("a.*, b.*,c.*,d.*,c.id as ClsId, a.id AS id")->from("tb_student_base a");
        $this->db->join("tb_std_before_register b", "b.tb_student_base_id = a.id", 'left outer');
        $this->db->join("tb_ed_school_register_class d", "d.id = b.tb_ed_school_register_class_id");
        $this->db->join("tb_ed_school_class c", "c.id = d.tb_ed_school_class_id");
        $this->db->where("a.tb_student_base_status", $stdstatus);
        $this->db->where("b.tb_ed_school_register_class_id", $id);
        $this->db->order_by("a.std_gender,a.std_firstname,a.std_lastname asc");

        $query = $this->db->get();
        $MyQ = $query->result_array();
        $Count = count($MyQ);
        $output = "";
        if ($Count > 0) {
            $ii = 1;


//            $output .= "<button type=\"button\" class=\"btn btn-default btn-insert\"><i class=\"icon-plus icon-large\"></i> เพิ่มข้อมูล</button>";
            $output .= "&nbsp;&nbsp;";
            $output .= "<button type=\"button\" class=\"btn btn-success btn-excel\"><i class=\"icon-file icon-large\"></i> นำเข้าข้อมูลจากไฟล์ Excel (.xls)</button>";
            $output .= "&nbsp;<button type=\"button\" onclick=\"ExportTemp(this)\" class=\"btn btn-success btn-excel-export\"><i class=\"icon-download-alt icon-large\"></i> ไฟล์ Excel (.xls)</button>";
            $output .= "&nbsp;&nbsp;&nbsp;&nbsp;";
            $output .= "<button type=\"button\" class=\"btn btn-light btn-show\"><i class=\"icon-user icon-large\"></i>&nbsp;&nbsp;นักเรียน (" . $MyQ[0]['tb_ed_school_class_abbreviation'] . "." . $MyQ[0]['tb_ed_school_class_level'] . ") ในระบบ " . $Count . " คน</button>";
            $output .= "<br></br>";
            $output .= "<table class=\"table table-hover table-striped table-bordered display\" id=\"StudentList\">";
            $output .= "<thead>";
            $output .= "<tr>";
            $output .= "<th style=\"text-align: center; width:10%;\">ที่</th>";
            $output .= "<th style=\"text-align: center; width:40%;\" class=\"no-sort\">ชื่อ-นามสกุล</th>";
            $output .= "<th style=\"text-align: center; width:35%;\" class=\"no-sort\">ระดับชั้น</th>";
            if ($this->session->userdata("status") == "ผู้ปฏิบัติงาน") {
                $output .= "<th style=\"width:15%;\" class=\"no-sort\"></th>";
            }
            $output .= "</tr>";
            $output .= "</thead>";

            $output .= "<tbody>";

            foreach ($query->result() as $row) {
                $output .= "<tr>";
                $output .= "<td style=\"text-align: center;\">" . $ii . "</td>";
                $output .= "<td style=\"text-align: center;\">" . $row->std_titlename . $row->std_firstname . " " . $row->std_lastname . "</td>";
                $output .= "<td style=\"text-align: center;\">" . $row->tb_ed_school_class_name . "ปีที่ " . $row->tb_ed_school_class_level . "</td>";

                if ($this->session->userdata("status") == "ผู้ปฏิบัติงาน") {
                    $output .= "<td style=\"text-align: center;\">";
                    $output .= "<button type=\"button\" class=\"btn btn-success btn-accept\" id=\"" . $row->id . "\"><i class=\"icon-check icon-large\"></i> รับนักเรียน</button>";
                    $output .= "<button type=\"button\" class=\"btn btn-danger btn-delete\" onclick=\"StdWDelete(this)\" id=\"" . $row->id . "\"><i class=\"icon-trash icon-large\"></i> ลบ</button>";
                    $output .= "</td>";
                }

                $output .= "</tr>";
                $output .= "<input type=\"hidden\" name=\"inClss" . $row->id . "\" id=\"inClss" . $row->id . "\" value=\"inClss" . $row->ClsId . "\" class=\"form-control\"/>";
                $ii++;
            }
            $output .= "</tbody>";
            $output .= "</table>";
        } else {
            $ii = 1;


//            $output .= "<button type=\"button\" class=\"btn btn-default btn-register-insert-modal\"><i class=\"icon-plus icon-large\"></i> เพิ่มข้อมูล</button>";
            $output .= "&nbsp;&nbsp;";
            $output .= "<button type=\"button\" class=\"btn btn-success btn-excel\"><i class=\"icon-file icon-large\"></i> นำเข้าข้อมูลจากไฟล์ Excel (.xls)</button>";
            $output .= "&nbsp;<button type=\"button\" onclick=\"ExportTemp(this)\" class=\"btn btn-success btn-excel-export\"><i class=\"icon-download-alt icon-large\"></i> ไฟล์ Excel (.xls)</button>";
            $output .= "&nbsp;&nbsp;&nbsp;&nbsp;";
            $output .= "<button type=\"button\" class=\"btn btn-light btn-show\"><i class=\"icon-user icon-large\"></i>&nbsp;&nbsp;ไม่มีรายชื่อนักเรียนในระบบ</button>";
            $output .= "<br></br>";
            $output .= "<table class=\"table table-hover table-striped table-bordered display\" id=\"StudentList\">";
            $output .= "<thead>";
            $output .= "<tr>";
            $output .= "<th style=\"text-align: center; width:10%;\">ที่</th>";
            $output .= "<th style=\"text-align: center; width:40%;\" class=\"no-sort\">ชื่อ-นามสกุล</th>";
            $output .= "<th style=\"text-align: center; width:35%;\" class=\"no-sort\">ระดับชั้น</th>";
            if ($this->session->userdata("status") == "ผู้ปฏิบัติงาน") {
                $output .= "<th style=\"width:15%;\" class=\"no-sort\"></th>";
            }
            $output .= "</tr>";
            $output .= "</thead>";

            $output .= "<tbody>";

            foreach ($query->result() as $row) {
                $output .= "<tr>";
                $output .= "<td style=\"text-align: center;\">" . $ii . "</td>";
                $output .= "<td style=\"text-align: center;\">" . $row->std_titlename . $row->std_firstname . " " . $row->std_lastname . "</td>";
                $output .= "<td style=\"text-align: center;\">" . $row->tb_ed_school_class_name . "ปีที่ " . $row->tb_ed_school_class_level . "</td>";

                if ($this->session->userdata("status") == "ผู้ปฏิบัติงาน") {
                    $output .= "<td style=\"text-align: center;\">";
                    $output .= "<button type=\"button\" class=\"btn btn-success btn-accept\" id=\"" . $row->id . "\"><i class=\"icon-check icon-large\"></i> รับนักเรียน</button>";
                    $output .= "<button type=\"button\" class=\"btn btn-danger btn-delete\" onclick=\"StdWDelete(this)\" id=\"" . $row->id . "\"><i class=\"icon-trash icon-large\"></i> ลบ</button>";
                    $output .= "</td>";
                }

                $output .= "</tr>";
                $output .= "<input type=\"hidden\" name=\"inClss" . $row->id . "\" id=\"inClss" . $row->id . "\" value=\"inClss" . $row->ClsId . "\" class=\"form-control\"/>";
                $ii++;
            }
            $output .= "</tbody>";
            $output .= "</table>";
        }
        return $output;
    }

    //===== แถบขวา ห้องเรียน
    function get_std_registered_list($rid, $cid) {
        $output = "";
        $this->db->select("a.*,b.tb_ed_school_class_name,b.tb_ed_school_class_level");
        $this->db->select("c.tb_ed_plan ,a.id as RId,d.*");
        $this->db->from("tb_ed_room a");
        $this->db->join("tb_ed_school_register_class d", "d.id = a.tb_ed_school_register_class_id");
        $this->db->join("tb_ed_school_class b", "b.id = d.tb_ed_school_class_id");
        $this->db->join("tb_ed_plan c", "c.id = a.tb_ed_plan_id");

        $this->db->where("tb_ed_school_register_class_id", $cid);
        $this->db->where("a.id", $rid);
        $this->db->order_by("tb_classroom_room asc");
        $query = $this->db->get()->result_array();
        $Count = count($query);
        if ($Count > 0) {
            $this->db->select("a.*,CONCAT (b.std_titlename,b.std_firstname,\" \",b.std_lastname) as fullname");
            $this->db->select("c.*,b.std_code, b.id as StdId");
            $this->db->from("tb_ed_classroom a");
            $this->db->join("tb_student_base b", "b.id = a.tb_student_base_id");
            $this->db->join("tb_ed_room c", "c.id = a.tb_ed_room_id");
            $this->db->where("c.id", $query[0]['RId']);
            $this->db->order_by("a.tb_ed_classroom_number asc");
            $MyStdQ = $this->db->get();
            $MyStdRoom = count($MyStdQ->result_array());

            $output .= "<input type=\"hidden\" name=\"inRoomId\" id=\"inRoomId\" value=\"" . $query[0]['RId'] . "\" class=\"form-control\"/>";

            $output .= "<center><label class=\"control-label\">รายชื่อนักเรียน</label></center>";
            $output .= "&nbsp;&nbsp;";
            $output .= "<center><label class=\"control-label\">ชั้น" . $query[0]['tb_ed_school_class_name'] . "ปีที่ " . $query[0]['tb_ed_school_class_level'] . " ห้อง " . $query[0]['tb_classroom_room'] . " แผนการเรียน " . $query[0]['tb_ed_plan'] . " จำนวนเด็ก " . $MyStdRoom . "/" . $query[0]['tb_classroom_student_amount'] . "คน</label></center>";
            $output .= "<br></br>";

            $output .= "<table class=\"table table-hover table-striped table-bordered display\" id=\"StudentRoom\">";
            $output .= "<thead>";
            $output .= "<tr>";
            $output .= "<th style=\"text-align: center; width:10%;\">เลขที่</th>";
            $output .= "<th style=\"text-align: center; width:40%;\" class=\"no-sort\">ชื่อ-นามสกุล</th>";
            $output .= "<th style=\"text-align: center; width:50%;\" class=\"no-sort\"></th>";
            $output .= "</tr>";
            $output .= "</thead>";

            $output .= "<tbody>";

            foreach ($MyStdQ->result() as $row) {
                $output .= "<tr>";
                $output .= "<td style=\"text-align: center;\">" . $row->tb_ed_classroom_number . "</td>";
                $output .= "<td style=\"text-align: center;\">" . $row->fullname . "</td>";
                $output .= "<td><center>";
                $output .= "&nbsp;<button type=\"button\" class=\"btn btn-warning btn-edit\" onclick=\"StdEdit(this)\" id=\"" . $row->StdId . "\"><i class=\"icon-pencil icon-large\"></i> แก้ไขข้อมูล</button>";
                $output .= "&nbsp;<button type=\"button\" class=\"btn btn-info btn-print\" onclick=\"StdPrint(this)\" id=\"" . $row->StdId . "\"><i class=\"icon-print icon-large\"></i> สั่งพิมพ์</button>";
//                $output .= "&nbsp;<button type=\"button\" class=\"btn btn-danger btn-delete\" onclick=\"StdDelete(this)\" id=\"" . $row->StdId . "\"><i class=\"icon-trash icon-large\"></i> ลบ</button>";
//                $output .= "<button type=\"button\" class=\"btn btn-warning btn-abc\" id=\"" . $row->id . "\"><i class=\"icon-pencil icon-large\"></i> แก้ไข</button>&nbsp;";
//                $output .= "<button type=\"button\" class=\"btn btn-primary btn-abc\" id=\"" . $row->id . "\"><i class=\"icon-list icon-large\"></i> ย้ายห้อง</button>&nbsp;";
//                $output .= "<button type=\"button\" class=\"btn btn-danger btn-abc\" id=\"" . $row->id . "\"><i class=\"icon-trash icon-large\"></i> ลบ</button>&nbsp;";
                $output .= "</center></td>";
                $output .= "</tr>";
            }
            $output .= "</tbody>";
            $output .= "</table>";
        }
        return $output;
    }

    function std_max_number($id) {
        $this->db->select_max('tb_ed_classroom_number');
        $this->db->from("tb_ed_classroom");
        $this->db->where("tb_ed_room_id", $id);
        $query = $this->db->get()->result_array();
        $output = $query[0]['tb_ed_classroom_number'];

        return $output;
    }

    function get_school_class() {
        $this->db->select("a.*, b.*, c.*, a.id as cid")->from("tb_ed_school_register_class a");
        $this->db->join("tb_ed_school_class b", "b.id = a.tb_ed_school_class_id");
        $this->db->join("tb_school c", "c.id = a.tb_school_id");
        $this->db->where("c.sc_thai_name", $this->session->userdata('department'));
        $this->db->where("a.tb_ed_school_register_class_edyear", date('Y') + 543);
        $this->db->order_by("b.tb_ed_school_class_name asc");
        $this->db->order_by("b.tb_ed_school_class_level asc");
        $rs = $this->db->get();
        if ($rs->num_rows() > 0) {
            return $rs->result_array();
        }
        return array();
    }

    function get_current_std_base() {

        $this->db->select("a.*, b.*, a.id AS id")->from("tb_student_base a");
        $this->db->join("tb_std_before_register b", "b.tb_student_base_id = a.id", 'left outer');
        $this->db->order_by("a.std_firstname asc");
        $rs = $this->db->get();
        if ($rs->num_rows() > 0) {
            return $rs->result_array();
        }
        return array();
    }

    ///------------------ ปรับโมเดลนักเรียนใหม่ right here

    function get_std_base_w_roomid_return_array($RoomId) {
        $this->db->select("CONCAT (a.std_titlename,a.std_firstname,\" \",a.std_lastname) as std_fullname,a.id as StdId,a.*");
        $this->db->select("b.tb_ed_classroom_number as std_number,b.id as tb_classroom_id");
        $this->db->select("c.tb_classroom_room as std_room_number,");
        $this->db->select("d.tb_ed_school_register_class_edyear as std_edyear,");
        $this->db->select("e.tb_ed_plan as std_plan,");
        $this->db->select("CONCAT (f.tb_ed_school_class_name,'ชั้นปีที ',f.tb_ed_school_class_level) as std_classname,d.tb_school_id as school_id");
        $this->db->from("tb_student_base a");

        $this->db->join("tb_ed_classroom b", "b.tb_student_base_id = a.id");
        $this->db->join("tb_ed_room c", "c.id = b.tb_ed_room_id");
        $this->db->join("tb_ed_school_register_class d", "d.id = c.tb_ed_school_register_class_id");
        $this->db->join("tb_ed_plan e", "e.id = c.tb_ed_plan_id");
        $this->db->join("tb_ed_school_class f", "f.id = d.tb_ed_school_class_id");

//        $this->db->join("tb_std_picture g", "a.id = g.own_id","left outer");


        $this->db->where("b.tb_ed_room_id", $RoomId);
        $this->db->order_by("b.tb_ed_classroom_number asc");
//        $this->db->where("g.id in","(select max() from tb_std_picture where )");

        $MyQ = $this->db->get();
        $MyArray = array();

        if ($MyQ->num_rows() > 0) {
            $arr = $MyQ->result_array();
//            print_r($arr);
            $i = 0;

            foreach ($arr as $r) {
                $this->db->select_max("id")->from("tb_std_picture");
                $this->db->where("own_id", $r['id']);
                $MyQ2 = $this->db->get()->row_array();

                $this->db->select("pic_name")->from("tb_std_picture");
                $this->db->where("id", $MyQ2['id']);
                $MyQ4 = $this->db->get()->row_array();

                if ($MyQ4['pic_name'] != "") {
                    $Std_pic = base_url() . std_path($r['StdId'], $r['school_id']) . $MyQ4['pic_name'];
                } else {
                    $Std_pic = base_url() . "images/avata.png";
                }


                $StdArray = array(
                    'StdId' => $r['StdId'],
                    'std_fullname' => $r['std_fullname'],
                    'std_code' => $r['std_code'],
                    'std_number' => $r['std_number'],
                    'std_room_number' => $r['std_room_number'],
                    'std_nickname' => $r['std_nickname'],
                    'std_classname' => $r['std_classname'],
                    'tb_classroom_id' => $r['tb_classroom_id'],
                    'std_profile_picture' => $Std_pic,
                );
//                base_url() . std_path($Std['StdId'], $this->session->userdata('sch_id')) . $Std['StdId']
                $MyArray[$i] = ($StdArray);
                $i++;
            }
            return $MyArray;
        } else {
            return false;
        }
    }

    function get_std_base_w_stdid_return_row($StdId) {
        $this->db->select("CONCAT (a.std_titlename,a.std_firstname,\" \",a.std_lastname) as std_fullname,a.id as StdId,a.*");
        $this->db->select("b.tb_ed_classroom_number as std_number,b.id as tb_classroom_id");
        $this->db->select("c.tb_classroom_room as std_room_number,");
        $this->db->select("d.tb_ed_school_register_class_edyear as std_edyear,");
        $this->db->select("e.tb_ed_plan as std_plan,");
        $this->db->select("CONCAT (f.tb_ed_school_class_name,'ชั้นปีที ',f.tb_ed_school_class_level) as std_classname,d.tb_school_id as school_id");
        $this->db->from("tb_student_base a");

        $this->db->join("tb_ed_classroom b", "b.tb_student_base_id = a.id");
        $this->db->join("tb_ed_room c", "c.id = b.tb_ed_room_id");
        $this->db->join("tb_ed_school_register_class d", "d.id = c.tb_ed_school_register_class_id");
        $this->db->join("tb_ed_plan e", "e.id = c.tb_ed_plan_id");
        $this->db->join("tb_ed_school_class f", "f.id = d.tb_ed_school_class_id");

//        $this->db->join("tb_std_picture g", "a.id = g.own_id","left outer");


        $this->db->where("a.id", $StdId);
        $this->db->order_by("b.tb_ed_classroom_number asc");
//        $this->db->where("g.id in","(select max() from tb_std_picture where )");

        $MyQ = $this->db->get();
        $MyArray = array();

        if ($MyQ->num_rows() > 0) {
            $arr = $MyQ->result_array();
//            print_r($arr);
            $i = 0;

            foreach ($arr as $r) {
                $this->db->select_max("id")->from("tb_std_picture");
                $this->db->where("own_id", $r['id']);
                $MyQ2 = $this->db->get()->row_array();

                $this->db->select("pic_name")->from("tb_std_picture");
                $this->db->where("id", $MyQ2['id']);
                $MyQ4 = $this->db->get()->row_array();

                if ($MyQ4['pic_name'] != "") {
                    $Std_pic = base_url() . std_path($r['StdId'], $r['school_id']) . $MyQ4['pic_name'];
                } else {
                    $Std_pic = base_url() . "images/avata.png";
                }


                $StdArray = array(
                    'StdId' => $r['StdId'],
                    'std_titlename' => $r['std_titlename'],
                     'std_firstname' => $r['std_firstname'],
                     'std_lastname' => $r['std_lastname'],
                     'std_nickname' => $r['std_nickname'],
                     'std_idcard' => $r['std_idcard'],
                     'std_religion' => $r['std_religion'],
                     'std_ethnicity' => $r['std_ethnicity'],
                    'std_nationality' => $r['std_nationality'],
                    'std_code' => $r['std_code'],
                    'std_birthday' => $r['std_birthday'],
                    'std_birth_hospital' => $r['std_birth_hospital'],
                    'std_bloodtype' => $r['std_bloodtype'],
                    
                    'std_code' => $r['std_code'],
//                    'std_number' => $r['std_number'],
//                    'std_room_number' => $r['std_room_number'],
//                    'std_nickname' => $r['std_nickname'],
//                    'std_classname' => $r['std_classname'],
//                    'tb_classroom_id' => $r['tb_classroom_id'],
                    'std_profile_picture' => $Std_pic,
                );
//                base_url() . std_path($Std['StdId'], $this->session->userdata('sch_id')) . $Std['StdId']
                $MyArray[$i] = ($StdArray);
                $i++;
            }
            return $MyArray;
        } else {
            return false;
        }
    }
    
    function get_std_info($id) {
        $this->db->select("a.*, b.*, c.*,d.*,e.*,f.*,b.id AS bid,d.id as did")->from("tb_std_address a");
        $this->db->join("tb_student_base b", "b.id = a.std_id", "right outer");
        //$this->db->join("tb_std_health c", "c.own_id = b.id", "left outer");
        $this->db->join("tb_std_family d", "d.std_id = b.id", "left outer");
        $this->db->join("tb_outsider c", "c.id = d.tb_outsider_id", "left outer");
        $this->db->join("tb_fm_career e", "e.tb_outsider_id = c.id", "left outer");
        $this->db->join("tb_std_picture f", "f.own_id = b.id", "left outer");
        $this->db->where("b.id", $id);
//        $this->db->where("d.fm_parent = 1");
        $query = $this->db->get()->row_array();
        if (count($query) > 0) {
            return $query;
        }
        return array();
    }

    function student_detail($id) {
        $this->db->select("a.*,b.*");
        $this->db->from("tb_student_base a");
        $this->db->join("tb_std_picture b", "b.own_id = a.id", "left outer");
//        $this->db->join("tb_std_health c", "c.own_id = a.id", "left outer");
        $this->db->where("a.id", $id);
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->row_array();
        }
        return array();
    }

}
