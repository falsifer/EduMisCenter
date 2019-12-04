<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/*
  | ----------------------------------------------------------------------------
  |  Title  Management_model
  | ----------------------------------------------------------------------------
  | Copyright	Edutech Co.,Ltd.
  | Purpose     ส่วนโมเดลของการบริหารงานทั่วไป
  | Author	นายบัณฑิต ไชยดี
  | Create Date
  | Last edit	-
  | Comment	-
  | ----------------------------------------------------------------------------
 */

class Management_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    // ดึงข้อมูลยกย่องเชิดชูเกียรติ
    function get_give_up() {
        $this->db->select("*")->from('tb_human_resources_01 a');
        $this->db->join('tb_hr_give_up b', 'b.hr_id = a.id');
        $this->db->where('hr_department',$this->session->userdata('department'));
        $this->db->order_by('a.hr_thai_name asc');
        //
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return array();
    }
    
    

    // ดึงข้อมูลยกย่องฯ มาเรคคอร์ดเดียว
    function get_give_up_row($id) {
        $this->db->select("*")->from('tb_human_resources_01 a');
        $this->db->join('tb_hr_give_up b', 'b.hr_id = a.id');
        $this->db->where('b.id', $id);
        //
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->row_array();
        }
        return array();
    }

}
