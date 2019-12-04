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

class Hrup_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    function hrup_base() {
        $this->db->select("a.*, b.*, b.id AS id")->from("tb_human_resources_01 a");
        $this->db->join("tb_hr_upgrade b", "b.hr_id = a.id");
        $this->db->order_by("a.id asc");
        $rs = $this->db->get();
        if ($rs->num_rows() > 0) {
            return $rs->result_array();
        }
        return array();
    }

    function hrup_edit($prm1) {
        $this->db->select("a.*, b.*, b.id AS id")->from("tb_human_resources_01 a");
        $this->db->join("tb_hr_upgrade b", "b.hr_id = a.id");
        $this->db->where(array("b.id" => $prm1));
        //this->db->where(array("b.id" => $prm1));
        $this->db->order_by("a.id asc");
        $rs = $this->db->get();
        if ($rs->num_rows() > 0) {
            return $rs->result_array();
        }
        return array();
    }

    function gd_base_where($prm1) {
        $this->db->select("a.*, b.*, b.id AS id, a.id AS aid")->from("tb_human_resources_01 a");
        $this->db->join("tb_hr_upgrade b", "b.hr_id = a.id");
        $this->db->where(array("b.id" => $prm1));
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->row_array();
        }
        return array();
    }

}
