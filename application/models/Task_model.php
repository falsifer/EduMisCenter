<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/*
  | ----------------------------------------------------------------------------
  |  Title  Task_model
  | ----------------------------------------------------------------------------
  | Copyright	Edutech Co.,Ltd.
  | Purpose     โมเดลสำหรับตารางการดำเนินงานโครงการ
  | Author
  | Create Date 25/11/2018
  | Last edit	-
  | Comment	-
  | ----------------------------------------------------------------------------
 */

class Task_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    
    }
    public function get_all_task() {
        $rs = $this->My_model->get_all_order('tb_task', 'tb_task_deadline asc');
        return $rs;
    }
    
     function get_division(){
        $query=$this->db->get('tb_division');
        if ($query->num_rows() != 0) {
            return $query->result_array();
        } else {
            return array();
        }
    }
    
    function get_team(){
        $query=$this->db->get('tb_team');
        if ($query->num_rows() != 0) {
            return $query->result_array();
        } else {
            return array();
        }
    }
}