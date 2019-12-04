<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/*
  | ----------------+-----------------------------------------------------------
  |  Title          |   Human assessment model
  | ----------------+-----------------------------------------------------------
  |  Copyright      |   Edutech Co.,Ltd.
  |  Purpose        |   Model การประเมินผลการปฏิบัติงาน
  |  Author         |   นายบัณฑิต ไชยดี
  |  Create Date    |
  |  Last edit      |   -
  |  Comment        |   -
  | ----------------+-----------------------------------------------------------
 */

class HumanAssessment_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    #---------------+---------------------------------------------------------------
    #   Title       |
    #---------------+---------------------------------------------------------------
    #   Author      |   Mr.Hidemi Minakawa
    #   Date        |
    #   Last Update |
    #---------------+---------------------------------------------------------------
    //
    // ดึงข้อมูลจากตารางรายการประเมินย่อยไปแสดง

    function get_human_assessment_topic($group_id) {
        $this->db->select('a.*, b.*, b.id as topic_id')->from('tb_human_assessment_group a');
        $this->db->join('tb_human_assessment_topic b', 'b.group_id = a.id');
        $this->db->where('a.id', $group_id);
        $this->db->order_by('b.id asc');
        $rs = $this->db->get();
        if ($rs->num_rows() > 0) {
            return $rs->result_array();
        }
        return array();
    }

    // ดึงข้อมูลรายการประเมินย่อยเพื่อแก้ไข
    function human_assessment_edit($pid) {
        $this->db->select('a.*, b.*, b.id as topic_id')->from('tb_human_assessment_group a');
        $this->db->join('tb_human_assessment_topic b', 'b.group_id = a.id');
        $this->db->where('b.id', $pid);
        $rs = $this->db->get();
        if ($rs->num_rows() > 0) {
            return $rs->row_array();
        }
        return array();
    }

    // ดึงข้อมูลผลการประเมินฯ (tb_human_assessment_activities);
    function get_human_assessment_activities($hr_id) {
        $this->db->select('*')->from("tb_human_resources_01 a");
        $this->db->join('tb_human_assessment_activities b', 'b.hr_id = a.id');
        $this->db->join('tb_human_assessment_topic c', 'c.id = b.assessment_topic_id', 'right');
        $this->db->where('a.id', $hr_id);
        //
        $rs = $this->db->get();
        if ($rs->num_rows() > 0) {
            return $rs->result_array();
        }
        return array();
    }

    // ตรวจสอบสถานะว่าประเมินแล้วหรือยัง
    function chk_status($hr_id) {
        $this->db->select('id')->from('tb_human_assessment_topic');
        $rs1 = $this->db->get()->num_rows();
        //
        $this->db->select('id')->from('tb_human_assessment_activities');
        $this->db->where('hr_id', $hr_id);
        $rs2 = $this->db->get()->num_rows();
        //
        if ($rs2 == 0) {
            return '<center>ยังไม่ประเมิน</center>';
        } elseif ($rs2 == $rs1) {
            return '<center>ประเมินเรียบร้อย</center>';
        }else{
            return '<center>อยู่ระหว่างการประเมิน</center>';
        }
    }

}
