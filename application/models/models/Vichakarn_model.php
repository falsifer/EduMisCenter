<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/*
  | ----------------------------------------------------------------------------
  |  Title  Vichakarn_model
  | ----------------------------------------------------------------------------
  | Copyright	Edutech Co.,Ltd.
  | Purpose     โมเดลสำหรับงานวิชาการ
  | Author
  | Create Date 19/11/2018
  | Last edit	-
  | Comment	-
  | ----------------------------------------------------------------------------
 */

class Vichakarn_model extends CI_Model {

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
private $performance = 'performance';

    function get_qa_chart() {
        $query = $this->db->get_where($this->performance,array('type'=>2)); 
        $results['chart_data'] = $query->result();
        $query = $this->db->get_where($this->performance,array('type'=>1));
        $results['chart_data2'] = $query->result();
        $this->db->select_min('performance_year');
        $this->db->limit(1);
        $query = $this->db->get($this->performance);
        $results['min_year'] = $query->row()->performance_year;
        $this->db->select_max('performance_year');
        $this->db->limit(1);
        $query = $this->db->get($this->performance);
        $results['max_year'] = $query->row()->performance_year;
        return $results;
  
    }
}
