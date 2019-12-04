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

class Tr_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    function tr_base() {
        $this->db->select("a.*, b.*, c.*, a.id AS aid")->from("tb_course_detail a");
        $this->db->join("tb_unit_learning b", "b.tb_course_detail_id = a.id");
        $this->db->join("tb_kpi_score c", "c.tb_unit_learning_id = b.id");
        $this->db->order_by("a.id asc");
        $rs = $this->db->get();
        if ($rs->num_rows() > 0) {
            return $rs->result_array();
        }
        return array();
    }

}
