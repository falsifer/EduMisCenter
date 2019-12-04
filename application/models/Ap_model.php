<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/*
  | ----------------------------------------------------------------------------
  |  Title
  | ----------------------------------------------------------------------------
  | Copyright	Edutech Co.,Ltd.
  | Purpose     งานประเมิน
  | Author      chairatto
  | Create Date 10/2/2019
  | Last edit	10/2/2019
  | Comment	-
  | ----------------------------------------------------------------------------
 */

class Ap_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    function ap_base() {
        $this->db->select("*")->from("tb_human_resources_01");
        $this->db->where('hr_department', $this->session->userdata('department'));
        $this->db->order_by("id asc");
        $rs = $this->db->get();
        if ($rs->num_rows() > 0) {
            return $rs->result_array();
        }
        return array();
    }

    function get_ap_topic() {
        $this->db->select("*")->from("tb_assessment_personal_topic");
        $this->db->where("tb_assessment_personal_topic_department", $this->session->userdata('department'));
        $this->db->order_by("id asc");
        $query = $this->db->get();

        $ii = 1;

        $output = "<table class=\"table table-hover table-striped table-bordered display\" >";

        $output .= "<thead>";
        $output .= "<tr>";
        $output .= "<th style=\"text-align:center; width:5%;\">ที่</th>";
        $output .= "<th style=\"text-align:center; width:75%;\" class=\"no-sort\">หัวข้อการประเมิน</th>";
        $output .= "<th style=\"text-align:center; width:20%;\" class=\"no-sort\">จัดการ</th>";
        $output .= "</tr>";
        $output .= "</thead>";

        $output .= "<tbody>";
        foreach ($query->result() as $row) {

            if ($ii > 1) {
                $output .= "<tr>";
            }

            $output .= "<td><center>" . $ii . "</center></td>";
            $output .= "<td>" . $row->tb_assessment_personal_topic_content . "</td>";
            $output .= "<td><center>" . "";
            $output .= "<button type=\"button\" class=\"btn btn-warning btn-topic-edit\" id=\"" . $row->id . "\"><i class=\"icon-pencil icon-large\"></i> แก้ไข</button> &nbsp;";
            $output .= "<button type=\"button\" class=\"btn btn-danger btn-topic-delete\" id=\"" . $row->id . "\"><i class=\"icon-trash icon-large\"></i> ลบ</button> &nbsp;";
            $output .= "" . "</center></td>";
            $ii ++;

            $output .= "</tr>";
        }
        $output .= "</tbody>";
        $output .= "</table>";


        return $output;
    }

    function get_hr_ap($Hrid) {
        //------------
        $this->db->select("*")->from("tb_assessment_personal_topic");
        $this->db->where("tb_assessment_personal_topic_department", $this->session->userdata('department'));
        $this->db->order_by("id asc");
        $query = $this->db->get();

        $ii = 1;

        $output = "<table class=\"table table-hover table-striped table-bordered display\" >";

        $output .= "<thead>";
        $output .= "<tr>";
        $output .= "<th style=\"text-align:center; width:5%;\">ที่</th>";
        $output .= "<th style=\"text-align:center; width:55%;\" class=\"no-sort\">หัวข้อการประเมิน</th>";
        $output .= "<th style=\"text-align:center; width:20%;\" class=\"no-sort\">ผลการประเมิน</th>";
//        $output .= "<th style=\"text-align:center; width:20%;\" class=\"no-sort\">หมายเหตุ</th>";
        $output .= "</tr>";
        $output .= "</thead>";

        $output .= "<tbody>";
        foreach ($query->result() as $row) {

            if ($ii > 1) {
                $output .= "<tr>";
            }



            $output .= "<td><center>" . $ii . "</center></td>";
            $output .= "<td>" . $row->tb_assessment_personal_topic_content . "</td>";

            $this->db->select("a.hr_type_id ,b.id as bid,b.tb_assessment_personal_result_status ,b.tb_assessment_personal_result_note as note");
            $this->db->from("tb_human_resources_01 a");
            $this->db->join("tb_assessment_personal_result b", "b.tb_hr_id = a.id", "right ounter");
            $this->db->where("b.tb_assessment_personal_topic_id", $row->id);
            $this->db->where("a.id", $Hrid);
            $MyQ = $this->db->get()->result_array();

            $Note = "";
            $Status = "";
            if (count($MyQ) > 0) {
                $Status = $MyQ[0]['bid'];
                $Note = $MyQ[0]['note'];
            }


            if ($Status == "") {
                $output .= "<td><center>" . "";
                $output .= "<button type=\"button\" class=\"btn btn-danger btn-ap-fail\" id=\"" . $row->id . "\"><i class=\"icon-remove icon-large\"></i> ไม่ผ่าน</button> &nbsp;";
                $output .= "" . "</center></td>";
//                $output .= "<td><input type=\"text\" name=\"inPlanName\" id=\"inPlanName\" class=\"form-control\" value=\"\"/></td>";
            } else {
                $output .= "<td><center>" . "";
                $output .= "<button type=\"button\" class=\"btn btn-success btn-ap-pass\" id=\"" . $Status . "\"><i class=\"icon-ok icon-large\"></i> ผ่าน</button> &nbsp;";
                $output .= "" . "</center></td>";
//                $output .= "<td><input type=\"text\" name=\"inPlanName\" id=\"inPlanName\" class=\"form-control\" value=\"" . $Note . "\"/></td>";
            }

            $ii ++;
            $output .= "</tr>";
        }
        $output .= "</tbody>";
        $output .= "</table>";


        return $output;
    }

    function get_ap_result($id) {

        $this->db->select("*")->from("tb_assessment_personal_topic");
        $this->db->where("tb_assessment_personal_topic_department", $this->session->userdata('department'));
        $this->db->order_by("id asc");
        $query = $this->db->get();

        $Allap = count($query->result());
        $pass = 0;


        foreach ($query->result() as $row) {

            $this->db->select("*")->from("tb_assessment_personal_result");
            $this->db->where("tb_hr_id", $id);
            $this->db->where("tb_assessment_personal_topic_id", $row->id);
            $this->db->order_by("id asc");
            $MyQ = $this->db->get();
            if (count($MyQ->result()) > 0) {
                $pass = $pass + 1;
            }
        }

        $fail = $Allap - $pass;
        
        $output = "";
        $output .= "<div class=\"row\">";
        $output .= "<font color=\"Blue\"><b>";
        $output .= "จำนวนข้อที่ผ่าน : " . $pass . "";
        $output .= "</b></font>";
        $output .= "</div>";

        $output .= "<Br>";

        $output .= "<div class=\"row\">";
        $output .= "<font color=\"Red\"><b>";
        $output .= "จำนวนข้อที่ไม่ผ่าน : " . $fail . "";
        $output .= "</b></font>";
        $output .= "</div>";


        return $output;
    }

}
