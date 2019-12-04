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

class Std_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    function get_std_base() {
        $this->db->select("a.*, b.*, c.*,d.*,e.*, b.id AS id")->from("tb_registration_address a");
        $this->db->join("tb_student_base b", "b.id = a.own_id");
        $this->db->join("tb_std_health c", "c.own_id = b.id");
        $this->db->join("tb_family d", "d.own_id = b.id");
        $this->db->join("tb_fm_career e", "e.own_id = d.id");
        $this->db->where("d.fm_parent = 1");
        $this->db->order_by("b.std_firstname asc");
        $rs = $this->db->get();
        if ($rs->num_rows() > 0) {
            return $rs->result_array();
        }
        return array();
    }

    function get_std_base_where($check) {
        $this->db->select("a.*, b.*, c.*,d.*,e.*, b.id AS id")->from("tb_registration_address a");
        $this->db->join("tb_student_base b", "b.id = a.own_id");
        $this->db->join("tb_std_health c", "c.own_id = b.id");
        $this->db->join("tb_family d", "d.own_id = b.id");
        $this->db->join("tb_fm_career e", "e.own_id = d.id");
        //$this->db->where("d.fm_parent = 1");
        //$this->db->where("b.std_department = '$check'");
        $this->db->order_by("b.std_firstname asc");
        $rs = $this->db->get();
        if ($rs->num_rows() > 0) {
            return $rs->result_array();
        }
        return array();
    }

    function get_std_edit($id) {
        $this->db->select("a.*, b.*, c.*,d.*,e.*,f.*,b.id AS bid,d.id as did")->from("tb_registration_address a");
        $this->db->join("tb_student_base b", "b.id = a.own_id");
        $this->db->join("tb_std_health c", "c.own_id = b.id");
        $this->db->join("tb_family d", "d.own_id = b.id");
        $this->db->join("tb_fm_career e", "e.own_id = d.id");
        $this->db->join("tb_std_picture f", "f.own_id = b.id");
        $this->db->where("b.id", $id);
        $this->db->where("d.fm_parent = 1");
        $query = $this->db->get()->row_array();
        if (count($query) > 0) {
            return $query;
        }
        return array();
    }

    //====== งานรับนักเรียน ======//

    function get_register_base() {
        $stdstatus = "W";
        $this->db->select("a.*, b.*,c.*, b.id AS id")->from("tb_std_picture a");
        $this->db->join("tb_student_base b", "b.id = a.own_id");
        $this->db->join("tb_std_before_register c", "b.id = c.tb_student_base_id");
        $this->db->where("b.tb_student_base_status", $stdstatus);
        $this->db->order_by("b.std_firstname asc");
        $rs = $this->db->get();
        if ($rs->num_rows() > 0) {
            return $rs->result_array();
        }
        return array();
    }

    //====== งานรับนักเรียน ======//
}
