<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/*
  | ----------------------------------------------------------------------------
  |  Title      HumanPlaning
  | ----------------------------------------------------------------------------
  | Copyright	Edutech Co.,Ltd.
  | Purpose     ข้อมูลการวางแผนอัตรากำลัง
  | Author	นายบัณฑิต ไชยดี
  | Create Date 02-01-2018
  | Last edit	-
  | Comment	-
  | ----------------------------------------------------------------------------
 */

class HumanPlaning_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    // นับจำนวนบุคลากรแต่ละประเภทโดยนำข้อมูลมาจากจากตาราง tb_human_resources_01
    // โดยทำการเชื่อมโยงกับ tb_human_resouces_type (ประเภทของบุคลากร)
    function count_human_resources_type($hr_type) {
        $this->db->select('COUNT(a.id) AS count_hr_type')->from('tb_human_resources_01 a');
        $this->db->join('tb_human_resources_type b', 'b.id = a.hr_type_id');
        $this->db->where('b.human_resources_type', $hr_type);
        //
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->row_array();
        }
        return 0;
    }

    // ดึงข้อมูลจาก tb_hr_plan_detail ทุกปีงบประมาณเพื่อนำไปสร้างชาร์ต
    function get_all_year() {
        $this->db->select('a.*, b.*, c.*, b.id as hr_id')->from('tb_rank a');
        $this->db->join('tb_hr_plan_detail b', 'b.rank_id = a.id');
        $this->db->join('tb_hr_plan c', 'c.id = b.hr_plan_id');
        $this->db->order_by('b.plan_year asc, a.rank_name asc, b.level asc');
        //
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return array();
    }

    // ดึงข้อมูลกรอบอัตรากำลัง 3 ปี จาก tb_hr_plan_detail;
    function get_hr_plan_detail($plan_id) {
        $this->db->select('a.*, b.*, c.*, b.id as hr_id')->from('tb_rank a');
        $this->db->join('tb_hr_plan_detail b', 'b.rank_id = a.id');
        $this->db->join('tb_hr_plan c', 'c.id = b.hr_plan_id');
        $this->db->where('b.hr_plan_id', $plan_id);
        $this->db->group_by('b.rank_id');
        $this->db->order_by('b.plan_year asc, a.rank_name asc, b.level asc');
        //
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return array();
    }

    // ดึงข้อมูลอัตรากำลังเพื่อการแก้ไข
    function push_hr_plan_detail($id) {
        $this->db->select("a.*, b.*, c.*, b.id AS hr_id")->from("tb_hr_plan a");
        $this->db->join("tb_hr_plan_detail b", "b.hr_plan_id = a.id");
        $this->db->join('tb_rank c', 'c.id = b.rank_id');
        $this->db->where('b.id', $id);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->row_array();
        }
        return array();
    }

    // นับจำนวนตำแหน่งที่มีอยู่จากรายการตำแหน่งที่ส่งมาให้ 
    function count_rank($rank) {
        $this->db->select('COUNT(a.id) AS count_rank')->from('tb_hr_plan_detail a');
        $this->db->join("tb_rank b", "b.id = a.rank_id");
        $this->db->where('b.rank_name', $rank);
        //
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->row_array();
        }
        return 0;
    }

    // เลือกเฉพาะบางฟิลด์ในตาราง tb_hr_plan_detail;
    function some_field_plan_detail() {
        $this->db->select('*, SUM(b.result)')->from('tb_rank a');
        $this->db->join('tb_hr_plan_detail b', 'b.rank_id = a.id');
        $this->db->group_by('rank_name');
        $rs = $this->db->get();
        if ($rs->num_rows() > 0) {
            return $rs->result_array();
        }
        return array();
    }

}
