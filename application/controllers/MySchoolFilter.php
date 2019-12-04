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

Class MySchoolFilter extends CI_Controller {

    public function __construct() {
        parent::__construct();
//        $this->load->model("F_model");
    }

    public function MyHead() {
        $MyWidth = 0;
        $MyY = $_POST['MyY'];
        $MyT = $_POST['T'];
        $MyC = $_POST['C'];
        $MyR = $_POST['R'];

        $var = 0;
        if ($MyY != "") {
            $var += 4;
        }
        if ($MyT != "") {
            $var += 2;
        }
        if ($MyC != "") {
            $var += 4;
        }
        if ($MyR != "") {
            $var += 2;
        }

        $MyWidth = (80 / $var);

        if ($MyY == "") {
            $MyEdYear = date('Y');
        } else {
            $MyEdYear = $MyY;
        }
        $output = "";

        $output .= "<div class=\"col-md-12  form-group\">";
        $output .= "<div class=\"panel-group\">";
        $output .= "<div class=\"panel panel-primary\">";
        $output .= "<div class=\"panel-body\">";

        $output .= "<div style='width:  " . $MyWidth * 4 . " %;float:left;margin:0% 2.5% 0% 2.5%;'>";
        $output .= "<label class=\"control-label\">ปีการศึกษา</label>";
        $output .= "<select name=\"MyEdYear\" id=\"MyEdYear\" class=\"form-control\" onchange=\"MyOnChange(this)\">";

        $YearNow = date('Y') + 537;


        for ($iY = 1; $iY < 12; $iY++) {
            $YearNow++;
            if ($MyY == $YearNow) {
                $output .= "<option selected value=\"" . $YearNow . "\">" . $YearNow . "</option>";
            } else {
                $output .= "<option value=\"" . $YearNow . "\">" . $YearNow . "</option>";
            }
        }

        $output .= "</select>";
        $output .= "</div>";



        if ($MyT != "") {
            $output .= "<div style='width:  " . $MyWidth * 2 . " %;float:left;margin:0% 2.5% 0% 2.5%;'>";
            $output .= "<label class=\"control-label\">ภาคเรียน</label>";
            $output .= "<select name=\"MyTerm\" id=\"MyTerm\" class=\"form-control\" onchange=\"MyTermOnChange(this)\">";
            $output .= "<option value=\"\">---เลือกภาคเรียน---</option>";
            $output .= "<option value=\"1\">1</option>";
            $output .= "<option value=\"2\">2</option>";
            $output .= "</select>";
            $output .= "</div>";
        }

        if ($MyC != "") {
            $output .= "<div style='width:  " . $MyWidth * 4 . " %;float:left;margin:0% 2.5% 0% 2.5%;'>";
            $output .= "<label class=\"control-label\">ระดับชั้น</label>";
            $output .= "<select name=\"MyClass\" id=\"MyClass\" class=\"form-control\" onchange=\"MyClassOnChange(this)\">";
            $output .= "<option value=\"\">---เลือกระดับชั้น---</option>";
            $Myschoolname = $this->session->userdata('department');
            $this->db->select("a.id as SchId, b.*,c.*,b.id as ClsId");
            $this->db->from("tb_ed_school_register_class a");
            $this->db->join("tb_ed_school_class b", "b.id = a.tb_ed_school_class_id");
            $this->db->join("tb_school c", "c.id = a.tb_school_id");
//            $this->db->join("tb_ed_room d", "d.tb_ed_school_register_class_id = a.id", "right ounter");
            $this->db->where("c.sc_thai_name", $Myschoolname);
            $this->db->where("a.tb_ed_school_register_class_edyear", $MyEdYear);
            $this->db->order_by("b.tb_ed_school_class_name asc");
            $this->db->order_by("b.tb_ed_school_class_level asc");
            $MyClss = $this->db->get();

            $checkclss = "";
            foreach ($MyClss->result() as $row) {
                if ($checkclss != $row->tb_ed_school_class_name . $row->tb_ed_school_class_level) {
                    $output .= "<option value=\"" . $row->SchId . "\">" . $row->tb_ed_school_class_name . "ปีที่ " . $row->tb_ed_school_class_level . "</option>";
                }
                $checkclss = $row->tb_ed_school_class_name . $row->tb_ed_school_class_level;
            }
            $output .= "</select>";
            $output .= "</div>";
        }

        if ($MyR != "") {
            $output .= "<div style='width:  " . $MyWidth * 2 . " %;float:left;margin:0% 2.5% 0% 2.5%;'>";
            $output .= "<label class=\"control-label\">ห้อง</label>";
            $output .= "<select name=\"MyRoom\" id=\"MyRoom\" class=\"form-control\" onchange=\"MyRoomOnChange(this)\">";
            $output .= "<option value=\"\">---เลือกห้อง---</option>";

//            foreach ($MyClss->result() as $row) {
//                $output .= "<option value=\"" . $row->tb_classroom_room . "\">" . $row->tb_classroom_room . "</option>";
//            }

            $output .= "</select>";
            $output .= "</div>";
        }


        $output .= "</div>";
        $output .= "</div>";
        $output .= "</div>";
        $output .= "</div>";

        echo $output;
    }

    public function MyRoom() {

        $MyC = $_POST['MyC'];
        $output = "";
        $this->db->select("a.*,b.id as RId, b.*");
        $this->db->from("tb_ed_school_register_class a");
        $this->db->join("tb_ed_room b", "b.tb_ed_school_register_class_id = a.id");
        $this->db->where("a.id", $MyC);
        $this->db->order_by("b.tb_classroom_room asc");
        $MyQ = $this->db->get();

        $output .= "<option value=\"\">---เลือกห้อง---</option>";
        foreach ($MyQ->result() as $row) {
            $output .= "<option value=\"" . $row->RId . "\">" . $row->tb_classroom_room . "</option>";
        }

        echo $output;
    }

}
