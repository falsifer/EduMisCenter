<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Echo_Text_Model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    // ดึงข้อมูล
    function head_logo($title, $school_id) {

        if (!isset($school_id)) {
            $school_id = $this->session->userdata('sch_id');
        }

        $rs = $this->db->select("*")->from("tb_school")->where("id", $school_id)->get()->row_array();
        if ($rs['sc_logo'] != "") {
            $logo = 'upload/' . $rs['sc_logo'];
        } else {
            $logo = 'images/icon/default-logo.png';
        }

        $output = "";

        $output .= "<div style=\"width:100%;height: 70px;padding: 10px;marign-top:0px;\">";
        $output .= "<div style=\"width:100%;margin: 0px 10px 0px 10px;\">";

        $output .= "<div style=\"width: 30%;float: left;\">";
        $output .= "<img src=\"" . base_url() . $logo . "\" style=\"height:60px;\"/>";
        $output .= "</div>";

        $output .= "<div style=\"width: 50%;float: right;text-align:right;\">";
        $output .= "<span style=\"color:#999999;font-size:0.1em;\">" . $rs['sc_thai_name'] . "</span>";
        
        $output .= "</div>";

        $output .= "</div>";
        $output .= "</div>";

        $output .= "<hr/><center><h4>" . $title . "</h4></center>";

        return $output;
    }

}
