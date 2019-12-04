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
  | Create Date 11/2/2562
  | Last edit	11/2/2562
  | Comment	-
  | ----------------------------------------------------------------------------
 */

class Ic_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    function get_ic_topic($id) {
        //------------
        $this->db->select("*")->from("tb_internal_control_topic");
        $this->db->where("tb_internal_control_id", $id);
        $this->db->order_by("tb_internal_control_topic_sequence asc");
        $query = $this->db->get();

        $ii = 1;

        $output = "<table class=\"table table-hover table-striped table-bordered display\" >";

        $output .= "<thead>";
        $output .= "<tr>";
        $output .= "<th style=\"text-align:center; width:5%;\">ที่</th>";
        $output .= "<th style=\"text-align:center; width:55%;\" class=\"no-sort\">องค์ประกอบของการควบคุมภายใน</th>";
        $output .= "<th style=\"text-align:center; width:40%;\" class=\"no-sort\">จัดการ</th>";
        $output .= "</tr>";
        $output .= "</thead>";

        $output .= "<tbody>";
        foreach ($query->result() as $row) {

            if ($ii > 1) {
                $output .= "<tr>";
            }

            $output .= "<td><center>" . $row->tb_internal_control_topic_sequence . "</center></td>";
            $output .= "<td>" . $row->tb_internal_control_topic_name . "</td>";
            $output .= "<td><center>" . "";
            $output .= "<button type=\"button\" class=\"btn btn-warning btn-topic-edit\" id=\"" . $row->id . "\"><i class=\"icon-pencil icon-large\"></i> แก้ไข</button> &nbsp;";
            $output .= "<button type=\"button\" class=\"btn btn-danger btn-topic-delete\" id=\"" . $row->id . "\"><i class=\"icon-trash icon-large\"></i> ลบ</button> &nbsp;";
            $output .= "<button type=\"button\" class=\"btn btn-success btn-topic-sub\" id=\"" . $row->id . "\"><i class=\"icon-play icon-large\"></i> จัดการ</button> &nbsp;";
            $output .= "" . "</center></td>";
            $ii ++;

            $output .= "</tr>";
        }
        $output .= "</tbody>";
        $output .= "</table>";


        return $output;
    }

    function get_ic_topic_sub($id, $topicid) {
        //------------
        $this->db->select("a.*,b.*,a.id as id")->from("tb_internal_control_topic_sub a");
        $this->db->join("tb_division b", "b.id = a.tb_division_id");
        $this->db->where("a.tb_internal_control_topic_id", $topicid);
        $this->db->where("a.tb_division_id", $id);
        $this->db->order_by("a.tb_internal_control_topic_sub_sequence asc");
        $query = $this->db->get();

        $ii = 1;
        $output = "<label class=\"control-label\"><font color=\"red\"><label> (A)</label></font>กิจกรรมในระบบ</label>";
        $output .= "<table class=\"table table-hover table-striped table-bordered display\" >";

        $output .= "<thead>";
        $output .= "<tr>";
        $output .= "<th style=\"text-align:center; width:10%;\">ลำดับที่</th>";
        $output .= "<th style=\"text-align:center; width:20%;\" class=\"no-sort\">ฝ่ายงาน</th>";
        $output .= "<th style=\"text-align:center; width:40%;\" class=\"no-sort\">ชื่อกิจกรรม</th>";
        $output .= "<th style=\"text-align:center; width:30%;\" class=\"no-sort\">จัดการ</th>";
        $output .= "</tr>";
        $output .= "</thead>";

        $output .= "<tbody>";
        foreach ($query->result() as $row) {

            if ($ii > 1) {
                $output .= "<tr>";
            }

            $output .= "<td style=\"text-align: center;\"><center>" . $ii . "</center></td>";
            $output .= "<td style=\"text-align: center;\">" . $row->tb_division_name . "</td>";
            $output .= "<td style=\"text-align: left;\">";
            $output .= "<b>";
            $output .= "" . $row->tb_internal_control_topic_sub_sequence . ". " . $row->tb_internal_control_topic_sub_name . "";
            $output .= "</b>";


            $this->db->select("*")->from("tb_internal_control_topic_sub_content");
            $this->db->where("tb_internal_control_topic_sub_id", $row->id);
            $this->db->order_by("tb_internal_control_topic_sub_content_sequence asc");
            $MyQ = $this->db->get();
            foreach ($MyQ->result() as $r) {
                $output .= "<br>";
                $output .= " &nbsp;&nbsp;  " . $row->tb_internal_control_topic_sub_sequence . "." . $r->tb_internal_control_topic_sub_content_sequence . " " . $r->tb_internal_control_topic_sub_content_name;
            }

            $output .= "</td>";
            $output .= "<td><center>" . "";
            $output .= "<button type=\"button\" class=\"btn btn-info btn-topic-sub\" id=\"" . $row->id . "\"><i class=\"icon-plus icon-large\"></i> เพิ่มข้อย่อย</button> &nbsp;";
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

    function get_ic_element_result($id) {

        //------------
        $this->db->select("*")->from("tb_internal_control_topic");
        $this->db->where("tb_internal_control_id", $id);
        $this->db->order_by("tb_internal_control_topic_sequence asc");
        $query = $this->db->get();

        $ii = 1;
        $output = "";



        $output .= "<div class=\"container-fluid\">";

        $output .= "<div class=\"row\">";
        $output .= "<center><h3>โรงเรียนสระพังวิทยา</h3></center>";
        $output .= " </div>";

        $output .= "<div class=\"row\">";
        $output .= "<center><h4>รายงานการประเมินองค์ประกอบขอองการควบคุมภายใน</h4></center>";
        $output .= " </div>";

        $output .= "<div class=\"row\">";
        $output .= "<center><h4>สำหรับระยะเวลาดำเนินงานสิ้นสุด วันที่ 30 เดือน กันยายน พ.ศ. 2561</h4></center>";
        $output .= " </div>";

        $output .= "<br>";

        $output .= "<div class=\"row\">";

        $output .= "<table class=\"table table-hover table-striped table-bordered display\" id=\"example\">";

        $output .= "<thead>";
        $output .= "<tr>";
        $output .= "<th class=\"sorting\" style=\"text-align: center; width:50%;\">องค์ประกอบของการควบคุมภายใน</th>";
        $output .= "<th class=\"sorting\" style=\"text-align: center; width:50%;\">ผลการประเมิน / ข้อสรุป</th>";
        $output .= "</tr>";
        $output .= "</thead>";

        $output .= "<tbody>";

        foreach ($query->result() as $row) {
            $output .= "<tr>";
            $output .= "<td class=\"sorting\" style=\"text-align: left; \"><font color=\"#40180E\"><b>" . thaidigit($row->tb_internal_control_topic_sequence) . ". " . $row->tb_internal_control_topic_name . "</b></font>";
            $output .= "<br>";

            $output .= "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font color=\"#7D4739\">" . $row->tb_internal_control_topic_description . "</font>";

            $this->db->select("a.*,b.*, a.id as id")->from("tb_internal_control_topic_sub a");
            $this->db->join("tb_division b", "b.id = a.tb_division_id");
            $this->db->where("a.tb_internal_control_topic_id", $row->id);
            $this->db->order_by("tb_division_name asc");
            $this->db->order_by("tb_internal_control_topic_sub_sequence asc");
            $MyQ = $this->db->get();
            $check = "";
            $i = 1;

            foreach ($MyQ->result() as $r) {

                if ($check != $r->tb_division_name) {
                    $output .= "<br>";
                    $output .= "<b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" . thaidigit($i) . ". ฝ่าย" . $r->tb_division_name . "</b>";
                    $i++;
                }

                $output .= "<br>";
                $output .= "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font color=\"#855448\"><b>" . thaidigit($i - 1) . "." . thaidigit($r->tb_internal_control_topic_sub_sequence) . " " . $r->tb_internal_control_topic_sub_name . "</b></font>";

                $this->db->select("*")->from("tb_internal_control_topic_sub_content");
                $this->db->where("tb_internal_control_topic_sub_id", $r->id);
                $this->db->order_by("tb_internal_control_topic_sub_content_sequence asc");
                $MyContentQ = $this->db->get();

                foreach ($MyContentQ->result() as $rc) {
                    $output .= "<br>";
                    $output .= "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <font color=\"#855448\">- " . $rc->tb_internal_control_topic_sub_content_name . "</font>";
                }
            }

            $output .= "</td>";
            
            $output .= "<td class=\"sorting\" style=\"text-align: left; \">";
            $output .= "<br>";
            $output .= "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font color=\"#7D4739\">" . $row->tb_internal_control_topic_result . "</font>";
            $output .= "</td>";
            $output .= "</tr>";
        }

        $output .= "</tbody>";

        $output .= "</table>";

        $output .= "</div>";

        $output .= "<div class=\"row\">";

        $output .= "<form method = \"post\" id = \"ic-topic-insert-form\" enctype = \"multipart/form-data\">";
        $output .= "</form>";

        $output .= "</div>";
    return $output;
    }

}
