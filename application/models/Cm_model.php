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
  | Create Date 15/2/2562
  | Last edit	25/2/2562
  | Comment	ยังไม่ได้เขียนเลื่อนทุกระดับชั้น/การเช็คหากเด็กเลื่อนชั้นไปแล้วให้ไม่แสดงปุ่มเลื่อนชั้น
  | ----------------------------------------------------------------------------
 */

class Cm_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    function get_std_registered_list($rid, $cid, $edyear) {
        $output = "";
        $output .= "<center>";

        $this->db->select("id")->from("tb_school")->where('sc_thai_name', $this->session->userdata('department'));
        $MySchoolIdQ = $this->db->get()->result_array();

        $this->db->select("b.tb_ed_school_class_kind_sequence,b.tb_ed_school_class_level,b.id as ,a.id as CId")->from("tb_ed_school_register_class a");
        $this->db->join("tb_ed_school_class b", "b.id = a.tb_ed_school_class_id");
        $this->db->where('a.id', $cid);
        $MyClassQ = $this->db->get()->result_array();
        $oldlevel = $MyClassQ[0]['tb_ed_school_class_level'];

        $this->db->select_max("tb_ed_school_class_level")->from("tb_ed_school_register_class a");
        $this->db->join("tb_ed_school_class b", "b.id = a.tb_ed_school_class_id");
        $this->db->where("b.tb_ed_school_class_kind_sequence", $MyClassQ[0]['tb_ed_school_class_kind_sequence']);
        $this->db->where("a.tb_ed_school_register_class_edyear", $edyear);
        $this->db->where("a.tb_school_id", $MySchoolIdQ[0]['id']);
        $MyKindQ = $this->db->get()->result_array();

        if ($MyClassQ[0]['tb_ed_school_class_level'] == $MyKindQ[0]['tb_ed_school_class_level']) {

            $output .= "<label class=\"control-label\" style=\"padding-top:10px;\">เลือกวันที่จบการศึกษา</label>  ";
            $output .= "<input type=\"date\" name=\"inGradDate\">&nbsp;";
            $output .= "<button type=\"button\" class=\"btn btn-primary btn-class-graduate\" onclick=\"ClassGraduate(this)\"><i class=\"icon-indent-right icon-large\"></i> แจ้งจบ</button>";
        } else {
            $output .= "<button type=\"button\" class=\"btn btn-success btn-class-upgrade\" onclick=\"ClassUpgrade(this)\"><i class=\"icon-upload icon-large\"></i> เลื่อนชั้น</button>";
        }

        $output .= "</center>";
        $output .= "<br>";


        //----------- Left panel start

        $this->db->select("a.*,b.tb_ed_school_class_name,b.tb_ed_school_class_level");
        $this->db->select("c.tb_ed_plan ,a.id as RId,d.*");
        $this->db->from("tb_ed_room a");
        $this->db->join("tb_ed_school_register_class d", "d.id = a.tb_ed_school_register_class_id");
        $this->db->join("tb_ed_school_class b", "b.id = d.tb_ed_school_class_id");
        $this->db->join("tb_ed_plan c", "c.id = a.tb_ed_plan_id");
        $this->db->where("a.id", $rid);
        $this->db->order_by("tb_classroom_room asc");
        $query = $this->db->get()->result_array();

        $MyCheckSchoolId = $query[0]['tb_school_id'];
        $nextclass = $query[0]['tb_ed_school_class_name'];

        $MyEdPlan = $query[0]['tb_ed_plan_id'];
        $MyEdRmNum = $query[0]['tb_classroom_room'];
        $MyEdStdAm = $query[0]['tb_classroom_student_amount'];


        $this->db->select("a.*,a.id as CRId,CONCAT (b.std_titlename,b.std_firstname,\" \",b.std_lastname) as fullname");
        $this->db->select("c.*,b.std_code ,b.tb_student_base_status as StdStatus,b.id as StdId,d.id as RepeatId");
        $this->db->from("tb_ed_classroom a");
        $this->db->join("tb_student_base b", "b.id = a.tb_student_base_id");
        $this->db->join("tb_ed_room c", "c.id = a.tb_ed_room_id");
        $this->db->join("tb_ed_repeat_classroom d", "d.tb_student_base_id = b.id", "left outer");
        $this->db->where("c.id", $query[0]['RId']);
        $this->db->order_by("a.tb_ed_classroom_number asc");
        $MyStdQ = $this->db->get();
        $MyStdRoom = count($MyStdQ->result_array());

        $output .= "<div class=\"col-md-6\">";
        $output .= "<div class=\"panel panel-primary\">";
        $output .= "<div class=\"panel-body\" id=\"StudentRegisteredBody\">";

        if ($rid != "") {
            $output .= "<input type=\"hidden\" name=\"inRoomId\" id=\"inRoomId\" value=\"" . $query[0]['RId'] . "\" class=\"form-control\"/>";
            $output .= "<center><label class=\"control-label\">ห้องต้นทาง (" . $edyear . ")</label></center>";
            $output .= "<center><label class=\"control-label\">ชั้น" . $query[0]['tb_ed_school_class_name'] . "ปีที่ " . $query[0]['tb_ed_school_class_level'] . " ห้อง " . $query[0]['tb_classroom_room'] . " แผนการเรียน " . $query[0]['tb_ed_plan'] . " จำนวนเด็ก " . $MyStdRoom . "/" . $query[0]['tb_classroom_student_amount'] . "คน</label></center>";
            $output .= "<br></br>";
        }



        $output .= "<table class=\"table table-hover table-striped table-bordered display\" id=\"StudentRoom\">";
        $output .= "<thead>";
        $output .= "<tr>";
        $output .= "<th style=\"text-align: center; width:10%;\">เลขที่</th>";
        $output .= "<th style=\"text-align: center; width:20%;\" class=\"no-sort\">รหัสนักเรียน</th>";
        $output .= "<th style=\"text-align: center; width:40%;\" class=\"no-sort\">ชื่อ-นามสกุล</th>";
        $output .= "<th style=\"text-align: center; width:30%;\" class=\"no-sort\">สถานะ</th>";
        $output .= "</tr>";
        $output .= "</thead>";

        $output .= "<tbody>";

        $getid = "";
        foreach ($MyStdQ->result() as $row) {

            $output .= "<tr>";
            $output .= "<td style=\"text-align: center;\">" . $row->tb_ed_classroom_number . "</td>";
            $output .= "<td style=\"text-align: center;\">" . $row->std_code . "</td>";
            $output .= "<td style=\"text-align: left;\">" . $row->fullname . "</td>";

            $ii = 1;
            $output .= "<td style=\"text-align: center;\">";
            if ($MyClassQ[0]['tb_ed_school_class_level'] != $MyKindQ[0]['tb_ed_school_class_level']) {

                if ($row->RepeatId == "") {
                    $output .= "<button type=\"button\" class=\"btn btn-secondary btn-uncheck\" id=\"" . $row->StdId . "\" onclick=\"UncheckClick(this)\">คลิกเลือกซ้ำชั้น</button>";
                } else {
                    $output .= "<button type=\"button\" class=\"btn btn-danger btn-uncheck\" id=\"" . $row->RepeatId . "\" onclick=\"CheckClick(this)\">นักเรียนซ้ำชั้น</button>";
                }
            } else {
                if ($row->StdStatus == "G") {
                    $output .= "<font color=\"green\"><i class=\"icon-ok icon-large\"></i>&nbsp;จบการศึกษา</font>";
                } else {
                    $output .= "<font color=\"yellow\"><i class=\"icon-remove icon-large\"></i>&nbsp;รอจบกาารศึกษา</font>";
                }
            }
            $output .= "</td>";
            $output .= "<tr>";


            if ($row->RepeatId == "") {
                $output .= "<input type=\"hidden\" name=\"inStdNumber" . $row->StdId . "\" id=\"inStdNumber\" value=\"" . $row->tb_ed_classroom_number . "\" class=\"form-control\"/>";

                $getid .= $row->StdId . ",";
            }
        }

        $output .= "</tbody>";
        $output .= "</table>";
        $output .= "<input type=\"text\" name=\"inStdId\" id=\"inStdId\" value=\"" . $getid . "\" class=\"form-control\"/>";

        $output .= "</div>";
        $output .= "</div>";
        $output .= "</div>";
        //----------- Left panel end




        $nextedyear = $edyear + 1;
        $nextlevel = $oldlevel + 1;
//$nextclass
//        $nextedyear,$rid, $cid
        $this->db->select("a.*,b.*,b.id as id")->from("tb_ed_school_register_class a");
        $this->db->join("tb_ed_school_class b", "b.id = a.tb_ed_school_class_id");
        $this->db->where("a.tb_ed_school_register_class_edyear", $nextedyear);
        $this->db->where("b.tb_ed_school_class_name", $nextclass);
        $this->db->where("b.tb_ed_school_class_level", $nextlevel);
        $MyNextQ = $this->db->get()->result_array();
        $MyCheckClassId = $MyNextQ[0]['id'];


        //----------- Right panel start
        $this->db->select("*")->from("tb_ed_school_register_class");
        $this->db->where("tb_ed_school_register_class_edyear", $nextedyear);
        $this->db->where("tb_ed_school_class_id", $MyCheckClassId);
        $this->db->where("tb_school_id", $MyCheckSchoolId);
        $MyRQ = $this->db->get()->result_array();

        $this->db->select("*")->from("tb_ed_room");
        $this->db->where("tb_ed_plan_id", $MyEdPlan);
        $this->db->where("tb_classroom_room", $MyEdRmNum);
        $this->db->where("tb_classroom_student_amount", $MyEdStdAm);
        $this->db->where("tb_ed_school_register_class_id", $MyRQ[0]['id']);
        $MyChecker = $this->db->get()->result_array();

        if (count($MyChecker) > 0) {

            $this->db->where('tb_ed_room_id', $MyChecker[0]['id']);
            $num_rows = $this->db->count_all_results('tb_ed_classroom');

            $output .= "<div class=\"col-md-6\">";
            $output .= "<div class=\"panel panel-primary\">";
            $output .= "<div class=\"panel-body\" id=\"StudentWaitingBody\">";
            $output .= "<center><label class=\"control-label\">ห้องปลายทาง (" . $nextedyear . ")</label></center>";
            $output .= "<center><label class=\"control-label\">ชั้น" . $query[0]['tb_ed_school_class_name'] . "ปีที่ " . $nextlevel . " ห้อง " . $query[0]['tb_classroom_room'] . " แผนการเรียน " . $query[0]['tb_ed_plan'] . " จำนวนเด็ก " . $num_rows . "/" . $query[0]['tb_classroom_student_amount'] . "คน</label></center>";
            $output .= "<br></br>";
            $output .= "<input type=\"hidden\" name=\"inNextRoomId\" id=\"inNextRoomId\" value=\"" . $MyChecker[0]['id'] . "\" class=\"form-control\"/>";
//            $output .= "<center><h4><font color=\"blue\">มีห้อง !</font></h4> </center>";

            $this->db->select("a.*,a.id as CRId,CONCAT (b.std_titlename,b.std_firstname,\" \",b.std_lastname) as fullname");
            $this->db->select("c.*,b.std_code ,b.tb_student_base_status as StdStatus,b.id as StdId,d.id as RepeatId");
            $this->db->from("tb_ed_classroom a");
            $this->db->join("tb_student_base b", "b.id = a.tb_student_base_id");
            $this->db->join("tb_ed_room c", "c.id = a.tb_ed_room_id");
            $this->db->join("tb_ed_repeat_classroom d", "d.tb_student_base_id = b.id", "left outer");
            $this->db->where("c.id", $MyChecker[0]['id']);
            $this->db->order_by("a.tb_ed_classroom_number asc");
            $MyNewStdQ = $this->db->get();

            if (count($MyNewStdQ->result_array()) > 0) {


                $output .= "<table class=\"table table-hover table-striped table-bordered display\" id=\"StudentRoom\">";
                $output .= "<thead>";
                $output .= "<tr>";
                $output .= "<th style=\"text-align: center; width:10%;\">เลขที่</th>";
                $output .= "<th style=\"text-align: center; width:20%;\" class=\"no-sort\">รหัสนักเรียน</th>";
                $output .= "<th style=\"text-align: center; width:40%;\" class=\"no-sort\">ชื่อ-นามสกุล</th>";
                $output .= "</tr>";
                $output .= "</thead>";

                $output .= "<tbody>";

                foreach ($MyNewStdQ->result() as $row) {
                    $output .= "<tr>";
                    $output .= "<td style=\"text-align: center;\">" . $row->tb_ed_classroom_number . "</td>";
                    $output .= "<td style=\"text-align: center;\">" . $row->std_code . "</td>";
                    $output .= "<td style=\"text-align: left;\">" . $row->fullname . "</td>";
                    $output .= "</tr>";
                }
                $output .= "</tbody>";
                $output .= "</table>";
            } else {
                $output .= "<center><h3><font color=\"blue\">ห้องว่าง !</font></h3></center>";
            }


            $output .= "</div>";
            $output .= "</div>";
            $output .= "</div>";
            //----------- right panel end
        } else {
            if ($MyClassQ[0]['tb_ed_school_class_level'] != $MyKindQ[0]['tb_ed_school_class_level']) {
//            
                $output .= "<input type=\"hidden\" name=\"inPlanId\" id=\"inPlanId\" value=\"" . $MyEdPlan . "\" class=\"form-control\"/>";
                $output .= "<input type=\"hidden\" name=\"inRoomNum\" id=\"inRoomNum\" value=\"" . $MyEdRmNum . "\" class=\"form-control\"/>";
                $output .= "<input type=\"hidden\" name=\"inStdAmount\" id=\"inStdAmount\" value=\"" . $MyEdStdAm . "\" class=\"form-control\"/>";
                $output .= "<input type=\"hidden\" name=\"inRegisterId\" id=\"inRegisterId\" value=\"" . $MyRQ[0]['id'] . "\" class=\"form-control\"/>";
                $output .= "<center><h3><font color=\"red\">ไม่พบห้องปลายทาง ! กรุณาสร้างห้อง</font></h3></center>";
                $output .= "<center><h4><font color=\"red\">คลิกที่ปุ่ม(สร้างห้อง)เพื่อสร้างห้อง</font></h4> </center>";
                $output .= "<center>"
                        . "<button type=\"button\" class=\"btn btn-info\" id=\"\" onclick=\"CreateRoom(this)\"><i class=\"icon-plus icon-large\"></i> สร้างห้อง(ห้องเดียว)</button>"
                        . "&nbsp;"
                        . "<button type=\"button\" class=\"btn btn-primary\" id=\"\" onclick=\"CreateAllRoom(this)\"><i class=\"icon-plus icon-large\"></i> สร้างห้อง(ทุกระดับชั้น)</button>"
                        . "</center>";
            }
        }
        return $output;
    }

}
