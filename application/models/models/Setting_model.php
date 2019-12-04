<?php

class Setting_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    // login เข้าระบบ
    public function login($username, $password) {
        $this->db->select("*")->from("tb_drr_office a");
        $this->db->join("tb_employee b", "b.office_id = a.id");
        $this->db->join("tb_member c", "c.employee_id = b.id");
        $this->db->where("c.member_username", $username)->where("c.member_password", $password);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->row_array();
        }
        return array();
    }

    // ดึงข้อมูลบุคลาการ
    public function get_employee($per_page) {
        $this->db->select("a.*,b.*,c.*, c.id as member_id, b.id as employee_id")->from("tb_drr_office a");
        $this->db->join("tb_employee b", "b.office_id = a.id");
        $this->db->join("tb_member c", "c.employee_id = b.id", "left");
        $this->db->limit($per_page, $this->uri->segment(3));
        $this->db->order_by("b.employee_name asc");
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return array();
    }

    public function get_employee_row($id) {
        $this->db->select("a.*,b.*,c.*, c.id as member_id, b.id as employee_id")->from("tb_drr_office a");
        $this->db->join("tb_employee b", "b.office_id = a.id");
        $this->db->join("tb_member c", "c.employee_id = b.id", "left");
        $this->db->where("c.id", $id);
        $this->db->order_by("b.employee_name asc");
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->row_array();
        }
        return array();
    }

    // ดึงข้อมูลผู้ใช้งานระบบ
    public function get_member() {
        $this->db->select("*")->from("tb_employee a");
        $this->db->join("tb_member b", "b.employee_id = a.id");
        $this->db->order_by("b.member_username asc");
        $query = $this->db->get();
        if ($query->num_rows() != 0) {
            return $query->result_array();
        }
        return array();
    }

    // ดึงผู้ใช้งานระบบสำหรับการแก้ไข
    public function get_member_edit($id) {
        $this->db->select("*")->from("tb_employee a");
        $this->db->join("tb_member b", "b.employee_id = a.id");
        $this->db->where("b.id", $id);
        $query = $this->db->get();
        if ($query->num_rows() != 0) {
            return $query->row_array();
        }
        return array();
    }

    // ดึงข้อมูลโรงเรียนไปแสดง
    function get_school() {
        $this->db->select("a.*,b.*,c.*, d.*, b.id AS school_id,c.id AS director_id, d.id AS human_id")->from("tb_school_type a");
        $this->db->join("tb_school b", "b.school_type_id = a.id");
        $this->db->join('tb_school_director c', 'c.school_id = b.id', 'left');
        $this->db->join('tb_human_resources_01 d', 'd.id = c.hr_id', 'left');
        $this->db->order_by('b.sc_code asc, sc_thai_name asc');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return array();
    }

    // ดึงข้อมูลผู้อำนวยการโรงเรียน
    function school_director() {
        $this->db->select('a.*, b.*, c.*, b.id as director_id')->from('tb_human_resources_01 a');
        $this->db->join('tb_school_director b', 'b.hr_id = a.id');
        $this->db->join('tb_school c', 'c.id = b.school_id');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return array();
    }

    // ดึงข้อมูลผู้อำนวยการเรคคอร์ดเดียวเพื่อแก้ไข
    function get_school_director_row($id) {
        $this->db->select('a.*, b.*, c.*, b.id as director_id')->from('tb_human_resources_01 a');
        $this->db->join('tb_school_director b', 'b.hr_id = a.id');
        $this->db->join('tb_school c', 'c.id = b.school_id');
        $this->db->where('b.id', $id);
        $result = $this->db->get();
        if($result->num_rows()>0){
            return $result->row_array();
        }
        return array();
    }

    // ดึงข้อมูลจาก tb_member, tb_member_activities, tb_data_define;
    function get_member_activities($id) {
        $this->db->select("a.*, b.*, c.*, a.id AS data_define_id, b.id AS activities_id, c.id AS member_id")->from('tb_data_define a');
        $this->db->join('tb_member_activities b', 'b.data_define_id = a.id', 'left');
        $this->db->join('tb_member c', 'c.id = b.member_id', 'left');
        $this->db->where('c.id', $id);
        $this->db->order_by('a.data_group asc, a.data_name asc');
        $rs = $this->db->get();
        if ($rs->num_rows() > 0) {
            return $rs->result_array();
        }
        return array();
    }

    // Push member activities data;
    function get_member_data_define() {
        $this->db->select('*')->from('tb_member a');
        $this->db->join('tb_member_activities b', 'b.member_id = a.id');
        $this->db->join('tb_data_define c', 'c.id = b.data_define_id');
        $this->db->order_by('a.member_name asc');
        //
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return array();
    }

    // ดึงข้อมูลรายวิชา
    function get_subject_detail() {
        $this->db->select('a.*, b.*, c.*, b.id AS subject_id')->from('tb_education_learning_group a');
        $this->db->join('tb_subject_detail b', 'b.learning_group_id = a.id');
        $this->db->join('tb_education_level c', 'c.id = b.level_id');
        $this->db->order_by('b.subject_code asc');
        //
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return array();
    }

}
