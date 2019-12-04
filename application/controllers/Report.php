<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/*
  | ============================================================================
  |  Title: Class Setting
  | ============================================================================
  | Copyright	Edutech Co.,Ltd.
  | Purpose     กำหนดค่าเร่ิมต้นของโปรแกรม
  | Author	นายบัณฑิต ไชยดี
  | Create Date  November 13, 2018
  | Last edit	-
  | Comment	-
  | ============================================================================
 */

class Report extends CI_Controller {

    public function __construct() {
        parent::__construct();
        if ($this->session->userdata('status') == "") {
            redirect("/");
        }
        $this->load->model('My_model');
        $this->load->model('PP5_model');
        $this->load->model('StdScore_model');
        $this->load->model('Std_model');
    }

    public function rwa_report() {
        $data['school'] = $this->input->get('school');
        $this->load->view("layout/header");
        $this->load->view("reports/rwa_report", $data);
        $this->load->view("layout/footer");
    }

    public function rwa_reload() {
        $edYear = $this->input->post('edYear');
        $edClass = $this->input->post('edClass');
        $school = $this->input->post('dept');
        
        if (isset($edClass) && $edClass != '') {
            $this->rwa_report_by_edclass($edClass, $school);
        }elseif (isset($edYear) && $edYear != '') {
            $this->rwa_report_by_edyear($edYear, $school);
        }
    }

    function rwa_report_by_edyear($edYear, $school) {
        echo $school;
        $this->db->distinct();
        $this->db->select('c.id as cid,concat(c.tb_ed_school_class_name," ",c.tb_ed_school_class_level) as class');
        $this->db->from('tb_ed_school_register_class rc');
        $this->db->join('tb_ed_room r', 'rc.id = r.tb_ed_school_register_class_id');
        $this->db->join('tb_ed_school_class c', 'c.id = rc.tb_ed_school_class_id');
        $this->db->where('rc.tb_ed_school_register_class_edyear', $edYear);

        if ($school == "") {
            $this->db->where('rc.tb_ed_school_register_class_department', $this->session->userdata('department'));
        } else {
            $this->db->where('rc.tb_ed_school_register_class_department', $school);
        }
        
        
        $rs = $this->db->get()->result_array();



        $output = "<table class='table table-bordered display' style='width: 100%;' id='myTab'>";
        $output .= "<thead>";
        $output .= "<tr> ";
        $output .= "<th  style='width:50%;text-align: center;'  >ระดับชั้น</th>";
        $output .= "<th  style='text-align: center;' >ไม่ผ่าน</th>";
        $output .= "<th  style='text-align: center;' >ผ่าน</th>";
        $output .= "<th  style='text-align: center;'>ดี</th>";
        $output .= "<th  style='text-align: center;'>ดีเยี่ยม</th>";
        $output .= "</tr></thead>";

        $output .= "<tbody> ";

        foreach ($rs as $r) {
            $class = $r['class'];
            $output .= "<tr> ";
            $output .= "<td style='text-align: center;'>" . $class . "</td> ";
            $output .= "<td style='text-align: center;'>" . $this->get_rw_base_class("ไม่ผ่าน", $r['cid'],$school) . "</td> ";
            $output .= "<td style='text-align: center;'>" . $this->get_rw_base_class("ผ่าน", $r['cid'],$school) . "</td> ";
            $output .= "<td style='text-align: center;'>" . $this->get_rw_base_class("ดี", $r['cid'],$school) . "</td> ";
            $output .= "<td style='text-align: center;'>" . $this->get_rw_base_class("ดีเยี่ยม", $r['cid'],$school) . "</td> ";
            $output .= "</tr> ";
        }

        $output .= "</tbody>";
        
        $output .="<tfoot>
		<tr style='background:#efefef'><th style='text-align: center;'></th>
                <th style='text-align: center;'></th>
                <th style='text-align: center;'></th>
                <th style='text-align: center;'></th>
                <th style='text-align: center;'></th></tr>
	</tfoot>";
        
        $output .="</table>  ";

        echo $output;
    }
    
    function rwa_report_by_edclass($edClass, $school) {
   
        $this->db->select('r.*,r.id as rid,concat(c.tb_ed_school_class_name," ",c.tb_ed_school_class_level) as class');
        $this->db->from('tb_ed_school_register_class rc');
        $this->db->join('tb_ed_room r', 'rc.id = r.tb_ed_school_register_class_id');
        $this->db->join('tb_ed_school_class c', 'c.id = rc.tb_ed_school_class_id');
        $this->db->where('rc.id', $edClass);

        if ($school == "") {
            $this->db->where('rc.tb_ed_school_register_class_department', $this->session->userdata('department'));
        } else {
            $this->db->where('rc.tb_ed_school_register_class_department', $school);
        }
        $rs = $this->db->get()->result_array();



        $output = "<table class='table table-bordered display' style='width: 100%;' id='myTab'>";
        $output .= "<thead>";
        $output .= "<tr> ";
        $output .= "<th  style='width:50%;text-align: center;'  >ระดับชั้น</th>";
        $output .= "<th  style='text-align: center;' >ไม่ผ่าน</th>";
        $output .= "<th  style='text-align: center;' >ผ่าน</th>";
        $output .= "<th  style='text-align: center;'>ดี</th>";
        $output .= "<th  style='text-align: center;'>ดีเยี่ยม</th>";
        $output .= "</tr></thead>";

        $output .= "<tbody> ";

        foreach ($rs as $r) {
            $class = $r['class'];
            $output .= "<tr> ";
            $output .= "<td style='text-align: center;'>" . $class."/".$r['tb_classroom_room'] . "</td> ";   
            $output .= "<td style='text-align: center;'>" . $this->get_rw_base("ไม่ผ่าน", $r['rid'],$school) . "</td> ";
            $output .= "<td style='text-align: center;'>" . $this->get_rw_base("ผ่าน", $r['rid'],$school) . "</td> ";
            $output .= "<td style='text-align: center;'>" . $this->get_rw_base("ดี", $r['rid'],$school) . "</td> ";
            $output .= "<td style='text-align: center;'>" . $this->get_rw_base("ดีเยี่ยม", $r['rid'],$school) . "</td> ";
            $output .= "</tr> ";
        }

        $output .= "</tbody>";
        
        $output .="<tfoot>
		<tr style='background:#efefef'><th style='text-align: center;'></th>
                <th style='text-align: center;'></th>
                <th style='text-align: center;'></th>
                <th style='text-align: center;'></th>
                <th style='text-align: center;'></th></tr>
	</tfoot>";
        
        $output .="</table>  ";

        echo $output;
    }

    function get_rw_base($base, $rid,$school) {

        $sql = "select count(*) as pnt FROM tb_ed_rw_analysis_score rw";

        $sql .= " inner join tb_ed_classroom cl ";
        $sql .= " on cl.tb_student_base_id = rw.tb_student_id";

        $sql .= " inner join tb_ed_room r ";
        $sql .= " on r.id = cl.tb_ed_room_id";

        $sql .= " where r.id = '" . $rid . "' ";

        $sql .= " and r.tb_ed_classroom_department like '%" . $school . "%' ";

        $sql .= " group by rw.tb_student_id ";
        if ($base == 'ไม่ผ่าน') {
            $sql .= "having avg(rw.tb_ed_rw_analysis_sub_score) < 1";
        } elseif ($base == 'ผ่าน') {
            $sql .= "having avg(rw.tb_ed_rw_analysis_sub_score) BETWEEN 1 and 1.5";
        } elseif ($base == 'ดี') {
            $sql .= "having avg(rw.tb_ed_rw_analysis_sub_score) BETWEEN 1.5 and 2";
        } elseif ($base == 'ดีเยี่ยม') {
            $sql .= "having avg(rw.tb_ed_rw_analysis_sub_score) > 2";
        }

//        echo $sql;

        $query = $this->db->query($sql);
        $rest = 0;
        foreach ($query->result() as $row) {
            $rest = $row->pnt;
        }

        return $rest;
    }
    
     function get_rw_base_class($base, $cid,$school) {
         
        

        $sql = "select count(*) as pnt FROM tb_ed_rw_analysis_score rw";

        $sql .= " inner join tb_ed_classroom cl ";
        $sql .= " on cl.tb_student_base_id = rw.tb_student_id";

        $sql .= " inner join tb_ed_room r ";
        $sql .= " on r.id = cl.tb_ed_room_id";  
        
        $sql .= " inner join tb_ed_school_register_class rc ";
        $sql .= " on rc.id = r.tb_ed_school_register_class_id";

        $sql .= " inner join tb_ed_school_class c ";
        $sql .= " on c.id = rc.tb_ed_school_class_id";
        
        $sql .= " where c.id = '" . $cid . "' ";
        
        $sql .= " and rc.tb_ed_school_register_class_department like '%" . $school . "%' ";

        $sql .= " group by rw.tb_student_id ";
        if ($base == 'ไม่ผ่าน') {
            $sql .= "having avg(rw.tb_ed_rw_analysis_sub_score) < 1";
        } elseif ($base == 'ผ่าน') {
            $sql .= "having avg(rw.tb_ed_rw_analysis_sub_score) BETWEEN 1 and 1.5";
        } elseif ($base == 'ดี') {
            $sql .= "having avg(rw.tb_ed_rw_analysis_sub_score) BETWEEN 1.5 and 2";
        } elseif ($base == 'ดีเยี่ยม') {
            $sql .= "having avg(rw.tb_ed_rw_analysis_sub_score) > 2";
        }

//        echo $sql."<br>";

        $query = $this->db->query($sql);
        $rest = 0;
        foreach ($query->result() as $row) {
            $rest = $row->pnt;
        }

        return $rest;
    }

}
