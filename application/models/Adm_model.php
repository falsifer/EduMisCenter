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
  | Create Date 23/11/2561
  | Last edit	14/4/2562
  | Comment	-
  | ----------------------------------------------------------------------------
 */

class Adm_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

//    function get_administrator_score_w_StdId($StdId, $TopicType) {
//
//        $this->db->select("a.*,b.*");
//        $this->db->from("tb_school_administrator_score a");
//        $this->db->join("tb_school_administrator_topic b", "b.id = a.tb_administrator_topic_id");
//        $this->db->where("a.tb_student_base_id", $StdId);
//        $this->db->where("b.tb_administrator_topic_type", $TopicType);
//
//        $MyQ = $this->db->get();
//        if ($MyQ->num_rows() > 0) {
//            return $MyQ->result();
//        } else {
//            return false;
//        }
//    }

    function get_administrator_score_w_StdId($StdId, $TopicType) {

        $this->db->select("a.*,b.*,a.id as id");
        $this->db->from("tb_school_administrator_score a");
        $this->db->join("tb_school_administrator_topic b", "b.id = a.tb_administrator_topic_id");
        $this->db->where("a.tb_student_base_id", $StdId);
        $this->db->where("b.tb_administrator_topic_type", $TopicType);

        $MyQ = $this->db->get();
        if ($MyQ->num_rows() > 0) {
            return $MyQ->result_array();
        } else {
            return false;
        }
    }
    
    //----------------------------
    function get_std_base() {
        $stdstatus = "S";
        $this->db->select("a.*, b.*, c.*, a.id AS id")->from("tb_student_base a");
        $this->db->join("tb_std_before_register b", "b.tb_student_base_id = a.id", 'left outer');
        $this->db->join("tb_std_picture c", "c.own_id = a.id", 'left outer');
        //$this->db->where("d.fm_parent = 1");
        $this->db->where("a.tb_student_base_status", $stdstatus);
        $this->db->order_by("a.std_firstname asc");
        $rs = $this->db->get();
        if ($rs->num_rows() > 0) {
            return $rs->result_array();
        }
        return array();
    }

    function get_std_base_where($check) {
        $stdstatus = "S";
        $this->db->select("a.*, b.*, c.*, a.id AS id")->from("tb_student_base a");
        $this->db->join("tb_std_before_register b", "b.tb_student_base_id = a.id", 'left outer');
        $this->db->join("tb_std_picture c", "c.own_id = a.id", 'left outer');
        $this->db->where("a.tb_student_base_status", $stdstatus);
        //$this->db->where("d.fm_parent = 1");
        //$this->db->where("b.std_department = '$check'");
        $this->db->order_by("a.std_firstname asc");
        $rs = $this->db->get();
        if ($rs->num_rows() > 0) {
            return $rs->result_array();
        }
        return array();
    }

    function get_std_edit($id) {
        $this->db->select("a.*, b.*,a.id AS id ")->from("tb_student_base a");
        $this->db->join("tb_std_picture b", "b.own_id = a.id", 'left outer');

        $this->db->where("a.id", $id);
        $query = $this->db->get()->row_array();
        if (count($query) > 0) {
            return $query;
        }
        return array();
    }

    function get_icare_topic() {
        $id = 4;
        $this->db->select("*")->from("tb_icare_topic");
        $this->db->where("tb_icare_group_id", $id);
        $this->db->order_by("id asc");
        $rs = $this->db->get();
        if ($rs->num_rows() > 0) {
            return $rs->result_array();
        }
        return array();
    }

    function get_admin_score($id) {
        $this->db->select("a.*, b.* ")->from("tb_school_administrator_score a");
        $this->db->join("tb_school_administrator_topic b", "b.id = a.tb_administrator_topic_id");
        $this->db->where("a.tb_student_base_id", $id);
        $this->db->order_by("a.id asc");
        $query = $this->db->get();
$output = "";

        $str = "";
        $ii = 1;
        foreach ($query->result() as $row) {

            $output .= "<tr>";

            if ($row->tb_administrator_topic_type == "Plus") {
                $str = "<font color='green';>เพิ่ม";
            } else {
                $str = "<font color='red';>ลด";
            }

            $output .= "<td>" . $ii . "</td>";
            $output .= "<td>" . datethaifull($row->tb_std_administrator_score_createdate) . "</td>";
            $output .= "<td>" . $row->tb_administrator_topic_content . " " . $str . $row->tb_administrator_topic_maxscore . "คะแนน" . "</font></td>";
            $output .= "<td>" . $row->tb_std_administrator_score_recorder . "</td>";

            $output .= "</tr>";
            $ii++;
        }



        return $output;
    }

    function fetch_member($param) {
        $this->db->where('tb_group_learning_id', $param);
        $this->db->order_by('tb_group_learning_id', 'asc');
        $query = $this->db->get('tb_subject');
        $output = "<option value=''>---เลือกข้อมูล---</option>";
        foreach ($query->result() as $row) {
            $output .= "<option value='" . $row->id . "'>" . $row->tb_subject_name . "</option>";
        }
        return $output;
    }

}
