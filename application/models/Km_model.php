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

class Km_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    // ดึงข้อมูลแหล่งท่องเทียวภายใน/ภายนอก
    function get_tour_place() {
        $this->db->select("a.*, b.*, c.*, b.id AS bid")->from("tb_km_history a");
        $this->db->join("tb_km_base b", "b.id = a.km_id");
        $this->db->join("tb_km_picture c", "c.km_id = b.id");
        $this->db->order_by("b.km_name asc");
        $rs = $this->db->get();
        if ($rs->num_rows() > 0) {
            return $rs->result_array();
        }
        return array();
    }

    // แก้ไขข้อมูลแหล่งเรียนรู้
    function get_km_edit($id) {
        $this->db->select("a.*, b.*, c.*, b.id AS bid")->from("tb_km_history a");
        $this->db->join("tb_km_base b", "b.id = a.km_id");
        $this->db->join("tb_km_picture c", "c.km_id = b.id");
        $this->db->where("b.id", $id);
        $rs = $this->db->get();
        if ($rs->num_rows() > 0) {
            return $rs->row_array();
        }
        return array();
    }

}
