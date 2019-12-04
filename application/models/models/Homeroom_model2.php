<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/*
  | ----------------------------------------------------------------------------
  |  Title
  | ----------------------------------------------------------------------------
  | Copyright	Edutech Co.,Ltd.
  | Purpose
  | Author      chairatto
  | Create Date 15/1/2018
  | Last edit	3/3/2018
  | Comment	-
  | ----------------------------------------------------------------------------
 */

class Homeroom_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    // ดึงข้อมูลห้องโฮมรูม ที่ครูรับผิดชอบ
    function get_ed_homeroom_w_hr_id() {
        $this->db->select("a.tb_room_id as ed_roomid");
        $this->db->select("b.tb_classroom_room as ed_roomnumber");
        $this->db->select("c.tb_ed_school_register_class_edyear as EdYear");
        $this->db->select("CONCAT (d.tb_ed_school_class_name,'ชั้นปีที ',d.tb_ed_school_class_level) as ed_classname");
        $this->db->from("tb_ed_homeroom a");
        $this->db->join("tb_ed_room b", "b.id = a.tb_room_id");
        $this->db->join("tb_ed_school_register_class c", "c.id = b.tb_ed_school_register_class_id");
        $this->db->join("tb_ed_school_class d", "d.id = c.tb_ed_school_class_id");
        $this->db->where("a.tb_human_resources_id", $this->session->userdata('hr_id'));
        $this->db->order_by("a.id desc");
        $MyQ = $this->db->get();
        if ($MyQ->num_rows() > 0) {
            return $MyQ->result();
        } else {
            return false;
        }
    }

    function get_std_absent_record_w_stdid_n_date($StdId, $DateNow) {
        $this->db->select("tb_student_absent_record_status as std_record_status,id as ed_absent_record_id");
        $this->db->from("tb_std_absent_record");
        $this->db->where("tb_student_base_id", $StdId);
        $this->db->where("tb_std_absent_record_date", $DateNow);
        $MyQ = $this->db->get();
        if ($MyQ->num_rows() > 0) {
            return $MyQ->row_array();
        } else {
            return false;
        }
    }

    function get_std_absent_record_by_recordid($RecordId) {
        $this->db->select("tb_student_absent_record_status as std_record_status,id as ed_absent_record_id,tb_student_base_id as StdId");
        $this->db->from("tb_std_absent_record");
        $this->db->where("id", $RecordId);
        $MyQ = $this->db->get();
        if ($MyQ->num_rows() > 0) {
            return $MyQ->row_array();
        } else {
            return false;
        }
    }

    function get_all_absent($rid) {
        $date = date('Y') + 543 . date('-m-d');
        $this->db->select('a.tb_student_absent_record_status,count(*) as pnt');
        $this->db->from('tb_std_absent_record a');
        $this->db->join('tb_ed_classroom b','a.tb_student_base_id=b.tb_student_base_id');
        $this->db->where('a.tb_std_absent_record_date', $date);
        $this->db->where('b.tb_ed_room_id',$rid);
        $this->db->where("a.tb_student_absent_record_department", $this->session->userdata('department'));
        $this->db->group_by('a.tb_student_absent_record_status');
        $query = $this->db->get();
        if ($query->num_rows() != 0) {
            return $query->result_array();
        }
        return array();
    }

}
