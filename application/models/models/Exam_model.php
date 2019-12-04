<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/*
  | ----------------------------------------------------------------------------
  |  Title
  | ----------------------------------------------------------------------------
  | Copyright	Edutech Co.,Ltd.
  | Purpose     โมเดลสำหรับงานแหล่งเรียนรู้
  | Author
  | Create Date 23/11/2018
  | Last edit	-
  | Comment	-
  | ----------------------------------------------------------------------------
 */

class Exam_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    // ดึงข้อมูลนักเรียน
    function get_std_data($param,$type) {

        $this->db->select("*")->from("tb_student_base a");
        $this->db->join("tb_std_health c", "c.own_id = a.id");
        
        
        if ($type == 'std_code') {
                $this->db->where(array('a.std_code' => $param));
            } else if ($type == 'std_name') {
                $std= explode(" ", $param);
                $this->db->where(array('a.std_firstname' => $std[0]));
                $this->db->where(array('a.std_lastname' => $std[1]));
            } else if ($type == 'std_idcard') {
                $this->db->where(array('a.std_idcard' => $param));
            }
        
        
        
        $rs = $this->db->get();
        if ($rs->num_rows() > 0) {
            return $rs->row_array();
        }
        return array();
    }
    
     // ดึงข้อมูลนักเรียน
    function check_std_data($param,$type) {

        $this->db->select("*")->from("tb_student_base a");
        $this->db->join("tb_std_health c", "c.own_id = a.id");
        
        
        if ($type == 'std_code') {
                $this->db->where(array('a.std_code' => $param));
            } else if ($type == 'std_name') {
                $std= explode(" ", $param);
                $this->db->where(array('a.std_firstname' => $std[0]));
                $this->db->where(array('a.std_lastname' => $std[1]));
            } else if ($type == 'std_idcard') {
                $this->db->where(array('a.std_idcard' => $param));
            }
        
        
        
        $rs = $this->db->get();
        if ($rs->num_rows() > 0) {
            return TRUE;
        }
        return FALSE;
    }


    function get_std_family($stdcode,$about) {
        $this->db->select("*")->from("tb_student_base a");
        $this->db->join("tb_family c", "c.own_id = a.id");
        $this->db->where(array('a.std_code' => $stdcode));
        $this->db->where(array('c.fm_about' => $about));
        $rs = $this->db->get();
        if ($rs->num_rows() > 0) {
            return $rs->row_array();
        }
        return array();
    }
    
    function get_my_class(){
        $this->db->select("*")->from("tb_course a");
        $this->db->join("tb_course_detail b", "b.tb_course_id = a.id");
        $this->db->join("tb_human_resources_01 c", "c.id = b.tb_human_resources_01_id");
        $this->db->join("tb_ed_room d", "d.tb_classroom_class = a.tb_course_class");
        $this->db->join("tb_ed_section e", "e.id = d.tb_ed_section_id");
        $this->db->join("tb_ed_room f", "f.id = d.tb_ed_homeroom_id");
        //$this->db->where("d.tb_ed_schedule_day",$now);
//        $this->db->order_by("a.id asc");
        $rs = $this->db->get();
        if ($rs->num_rows() > 0) {
            return $rs->result_array();
        }
        return array();
    }
    
    function teacher_base() {
//        $now = "monday";
        $this->db->select("a.*, b.*, c.*, d.*, e.*, f.*, a.id AS aid")->from("tb_course a");
        $this->db->join("tb_course_detail b", "b.tb_course_id = a.id");
        $this->db->join("tb_human_resources_01 c", "c.id = b.tb_human_resources_01_id");
        $this->db->join("tb_ed_schedule d", "d.tb_course_id = a.id");
        $this->db->join("tb_ed_section e", "e.id = d.tb_ed_section_id");
        $this->db->join("tb_ed_room f", "f.id = d.tb_ed_homeroom_id");
        //$this->db->where("d.tb_ed_schedule_day",$now);
        $this->db->order_by("a.id asc");
        $rs = $this->db->get();
        if ($rs->num_rows() > 0) {
            return $rs->result_array();
        }
        return array();
    }


}
