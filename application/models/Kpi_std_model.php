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

class Kpi_std_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    function kpi_base() {
        $this->db->select("a.*, b.*, b.id AS id")->from("tb_kpi_standard_learning a");
        $this->db->join("tb_standard_learning b", "b.id = a.tb_standard_learning_id");
        //$this->db->join("tb_kpi_score c", "c.tb_kpi_standard_learning_id = a.id");
        $this->db->order_by("a.id asc");
        $rs = $this->db->get();
        if ($rs->num_rows() > 0) {
            return $rs->result_array();
        }
        return array();
    }

}
