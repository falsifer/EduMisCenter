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
  | Create Date 15/12/2018
  | Last edit	-
  | Comment	-
  | ----------------------------------------------------------------------------
 */

class Ep_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    function ep_base() {
        $this->db->select("a.*, b.*, c.*, d.*, e.*, a.id AS aid")->from("tb_course a");
        $this->db->join("tb_subject b", "b.id = a.tb_subject_id");
        $this->db->join("tb_group_learning c", "c.id = b.tb_group_learning_id");
        $this->db->join("tb_course_detail d", "d.tb_course_id = a.id");
        $this->db->join("tb_human_resources_01 e", "e.id = d.tb_human_resources_01_id");
        $this->db->order_by("a.id asc");
        $rs = $this->db->get();
        if ($rs->num_rows() > 0) {
            return $rs->result_array();
        }
        return array();
    }

    function ep_unit($pram) {
        $this->db->select("*")->from("tb_unit_learning");
        $this->db->where("tb_course_detail_id", $pram);
        $this->db->order_by("id asc");
        $rs = $this->db->get();
        if ($rs->num_rows() > 0) {
            return $rs->result_array();
        }
        return array();
    }

    function ep_modal($clss, $lev) {
        $this->db->select("a.*, b.*,c.*,c.id AS cid,b.id AS bid")->from("tb_kpi_standard_learning a");
        $this->db->join("tb_standard_learning b", "b.id = a.tb_standard_learning_id");
        $this->db->join("tb_kpi_score c", "c.tb_kpi_standard_learning_id = a.id", 'left outer');
        $this->db->where("a.tb_kpi_standard_learning_class", $clss);
        $this->db->where("a.tb_kpi_standard_learning_lev", $lev);
        $rs = $this->db->get();
        if ($rs->num_rows() > 0) {
            return $rs->result_array();
        }
        return array();
    }

//    function ep_modal($sjcode) {
//        $this->db->select("a.*, b.*, c.*, d.*, e.*, f.*, g.*, h.*, a.id AS aid")->from("tb_course a");
//        $this->db->join("tb_subject b", "b.id = a.tb_subject_id");
//        $this->db->join("tb_group_learning c", "c.id = b.tb_group_learning_id");
//        $this->db->join("tb_course_detail d", "d.tb_course_id = a.id");
//        $this->db->join("tb_human_resources_01 e", "e.id = d.tb_human_resources_01_id");
//        $this->db->join("tb_group_learning_item f", "f.tb_group_learning_id = c.id");
//        $this->db->join("tb_standard_learning g", "g.tb_group_learning_item_id = f.id");
//        $this->db->join("tb_kpi_standard_learning h", "h.tb_standard_learning_id = g.id");
//        $this->db->where("a.id", $sjcode);
//        $rs = $this->db->get();
//        if ($rs->num_rows() > 0) {
//            return $rs->result_array();
//        }
//        return array();
//    }

    function subject_member($clss, $lev) {
        $this->db->select("a.*, b.*,c.*, a.id AS aid")->from("tb_course a");
        $this->db->join("tb_subject b", "b.id = a.tb_subject_id");
        $this->db->join("tb_course_detail c", "c.tb_course_id = a.id", 'left outer');
        $this->db->where("a.tb_course_class", $clss);
        $this->db->where("a.tb_course_lev", $lev);

        //$this->db->where("c.tb_human_resources_01_id <> 0");
        $rs = $this->db->get();
        $output = "<option value=''>---เลือกข้อมูล---</option>";
        foreach ($rs->result() as $row) {
            $output .= "<option value='" . $row->aid . "'>" . $row->tb_course_code . " | วิชา" . $row->tb_subject_name . "</option>";
        }
        return $output;
    }

    function hr_member($param) {
        //$this->db->where('id', $param);
        $this->db->order_by('hr_thai_name', 'asc');
        $query = $this->db->get('tb_human_resources_01');
        foreach ($query->result() as $row) {
            $output .= "<option value='" . $row->id . "'>" . $row->hr_thai_name . "</option>";
        }
        return $output;
    }

}
