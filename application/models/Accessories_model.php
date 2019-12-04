<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/*
  | ----------------------------------------------------------------------------
  |  Title  Accessories_model
  | ----------------------------------------------------------------------------
  | Copyright	Edutech Co.,Ltd.
  | Purpose     โมเดลการช่วยเหลือ
  | Author	นายบัณฑิต ไชยดี
  | Create Date
  | Last edit	-
  | Comment	-
  | ----------------------------------------------------------------------------
 */

class Accessories_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    //
    function get_edoc() {
        $this->db->select("*")->from("tb_edoc");
        $this->db->where("edoc_department", $this->session->userdata("department"));
        $this->db->or_where("edoc_to",$this->session->userdata("department"));
        $this->db->order_by("edoc_send desc");
        $rs = $this->db->get();
        if ($rs->num_rows() > 0) {
            return $rs->result_array();
        }
        return array();
    }

}
