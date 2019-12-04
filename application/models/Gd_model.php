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

class Gd_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    function gd_base() {
        $stdstatus = "S";
        $this->db->select("a.*, b.*, a.id AS id")->from("tb_student_base a");
        $this->db->join("tb_guidance_result b", "b.tb_student_base_id = a.id", 'left outer');
        $this->db->where("a.tb_student_base_status", $stdstatus);
		$this->db->where("a.tb_student_base_department", $this->session->userdata('department'));
        $this->db->order_by("a.id asc");
        $rs = $this->db->get();
        if ($rs->num_rows() > 0) {
            return $rs->result_array();
        }
        return array();
    }

    function gd_base_where($prm1) {
        $this->db->select("a.*, b.*,c.*, a.id AS id, b.id AS chid")->from("tb_student_base a");
        $this->db->join("tb_guidance_result b", "b.tb_student_base_id = a.id", 'left outer');
        $this->db->join("tb_std_health c", "c.own_id = a.id", 'left outer');
        $this->db->where(array("a.id" => $prm1));
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->row_array();
        }
        return array();
    }

}
