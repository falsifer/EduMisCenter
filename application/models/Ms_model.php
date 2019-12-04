<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/*
  | ----------------------------------------------------------------------------
  |  Title
  | ----------------------------------------------------------------------------
  | Copyright	Edutech Co.,Ltd.
  | Purpose
  | Author      chairatto
  | Create Date 8/2/2019
  | Last edit	8/2/2019
  | Comment	-
  | ----------------------------------------------------------------------------
 */

class Ms_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    function ms_base() {
        $this->db->select("a.*, b.school_type")->from("tb_school a");
        $this->db->join("tb_school_type b", "b.id = a.school_type_id");
        $this->db->where('a.sc_thai_name', $this->session->userdata('department'));
        $this->db->order_by("a.id asc");
        $rs = $this->db->get();
        if ($rs->num_rows() > 0) {
            return $rs->result_array();
        }
        return array();
    }

    function get_school_type($id,$edyear) {
        
        $this->db->select("*")->from("tb_ed_school_class");
        $this->db->order_by("id asc");
        $query = $this->db->get();

        $ii = 1;

        $output = "<table  class=\"table table-hover table-striped table-bordered display\" id=\"MyClassTable\">";

        $output .= "<thead>";
        $output .= "<tr>";
        $output .= "<th style=\"text-align: center; width:10%\" class=\"sorting\">ลำดับที่</th>";
        $output .= "<th style=\"text-align: center; width:70%\">ระดับชั้น</th>";
        $output .= "<th style=\"text-align: center; width:20%\">สถานะ</th>";
        $output .= "</tr>";
        $output .= "</thead>";

        $output .= "<tbody>";
        foreach ($query->result() as $row) {
            if ($ii > 1) {
                $output .= "<tr>";
            }

            $output .= "<td><center>" . $ii . "</center></td>";
            $output .= "<td>" . $row->tb_ed_school_class_name . "ปีที่ " . $row->tb_ed_school_class_level . "</td>";
            $typeid = $row->id;
            
            $this->db->select("*")->from("tb_ed_school_register_class");
            $this->db->where('tb_school_id', $id);
            $this->db->where('tb_ed_school_register_class_edyear', $edyear);
            $this->db->where('tb_ed_school_class_id', $typeid);
            $this->db->order_by("id asc");
            $MyCheck = $this->db->get()->result_array();

            if (count($MyCheck) > 0) {
                $output .= "<td><center>" . "";
                $output .= "<button type=\"button\" class=\"btn btn-success btn-class-check\" id=\"" . $MyCheck[0]['id'] . "\"><i class=\"icon-ok icon-large\"></i> เลือกแล้ว </button>";
                $output .= "" . "</center></td>";
            } else {
                $output .= "<td><center>" . "";
                $output .= "<button type=\"button\" class=\"btn btn-light btn-class-uncheck\" id=\"" . $row->id . "\"> คลิกเพื่อเลือก </button>";
                $output .= "" . "</center></td>";
            }

            $ii ++;

            $output .= "</tr>";
        }
        $output .= "</tbody>";
        $output .= "</table>";


        return $output;
    }

}
