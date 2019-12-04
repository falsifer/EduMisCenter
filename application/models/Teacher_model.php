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
  | Create Date 14/1/2562
  | Last edit	10/3/2562
  | Comment	-
  | ----------------------------------------------------------------------------
 */

class Teacher_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    function test_base($hrid) {
        $this->db->select("a.*, b.*, a.id AS id")->from("tb_course a");
        $this->db->join("tb_course_detail b", "b.tb_course_id = a.id");
        $this->db->order_by("id asc");
        //$this->db->where("id",$hrid);
        $rs = $this->db->get();
        if ($rs->num_rows() > 0) {
            return $rs->result_array();
        }
        return array();
    }

    function teacher_base() {
        $hrid = 5;
        $this->db->select("a.*, b.*, c.*, d.*, e.*, f.*, a.id AS id")->from("tb_course a");
        $this->db->join("tb_course_detail b", "b.tb_course_id = a.id");
        $this->db->join("tb_human_resources_01 c", "c.id = b.tb_human_resources_01_id");
        $this->db->join("tb_ed_schedule d", "d.tb_course_detail_id = b.id");
        $this->db->join("tb_ed_section e", "e.id = d.tb_ed_section_id");
        $this->db->join("tb_ed_room f", "f.id = d.tb_ed_room_id");
        $this->db->where("d.tb_ed_schedule_day", date('N'));
        $this->db->where("b.tb_human_resources_01_id", $hrid);
//        $this->db->where("b.tb_human_resources_01_id", $this->session->userdata('tb_hr_id'));
        $this->db->order_by("a.id asc");
        $rs = $this->db->get();
        if ($rs->num_rows() > 0) {
            return $rs->result_array();
        }
        return array();
    }

}
