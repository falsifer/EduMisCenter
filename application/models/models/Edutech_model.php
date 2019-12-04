<?php

class Edutech_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }
  
    // ดึงข้อมูลไม่ซ้ำทั้งหมด
    function get_distinct_all_where($table,$cond) {
        $this->db->distinct();
        $this->db->select("*")->from($table);
        $this->db->where($cond);
        $query = $this->db->get();
        if ($query->num_rows() != 0) {
            return $query->result_array();
        }
        return array();
    }
    
    // ดึงข้อมูลไม่ซ้ำเฉพาะ column
    function get_distinct_col_where($table,$col,$cond) {
        $this->db->distinct();
        $this->db->select($col)->from($table);
        $this->db->where($cond);
        $query = $this->db->get();
        if ($query->num_rows() != 0) {
            return $query->result_array();
        }
        return array();
    }
    
    
    // Select Max record
    function get_max_where_col($table,$col,$cond) {
        $this->db->distinct();
        $this->db->select('max('.$col.') as col')->from($table);
        $this->db->where($cond);
        $query = $this->db->get();
        if ($query->num_rows() != 0) {
            return $query->row_array();
        }
        return array();
    }
    

    
    
}