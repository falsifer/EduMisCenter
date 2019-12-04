<?php

class Admin_school_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    // ข้อมูลบุคลากรของโรงเรียน
    public function member_base() {
        $check = $this->session->userdata('department');

        $this->db->select("*")->from("tb_member");
        $this->db->where("department", $check);
        $this->db->order_by("id ASC");
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return array();
    }

    // ข้อมูลบุคลากรของโรงเรียน
    public function hr_position_where_department() {
        $check = $this->session->userdata('department');
        $this->db->select("*")->from("tb_hr_position a");
        $this->db->join("tb_hr_position_register b", "b.tb_hr_position_id = a.id", "left outer");
        $this->db->join("tb_human_resources_01 c", "c.id = b.tb_hr_id", "left outer");
        $this->db->where("a.tb_hr_position_department", $check);        
        $this->db->order_by("a.tb_hr_position_tier ASC");
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return array();
    }

    //------ งานการจัดการเมนู
    function get_all_position_w_department() {
        $this->db->select("*")->from("tb_hr_position");
        $this->db->where("tb_hr_position_department", $this->session->userdata('department'));
        $this->db->order_by("tb_hr_position_tier asc");
        $query = $this->db->get()->result();
//        if ($query->num_rows() > 0) {
//            return $query;
//        }
        return $query;
    }

    function get_approver_n_position_w_datadefineid($id) {
        $this->db->select("a.*,b.*,a.id as id")->from("tb_hr_position a");
        $this->db->join("tb_edoc_approver b", "b.tb_hr_position_id = a.id", "left outer");
        $this->db->where("a.tb_hr_position_department", $this->session->userdata('department'));
        $this->db->where("b.tb_data_define_id", $id);
        $this->db->order_by("a.tb_hr_position_tier asc");
        $query = $this->db->get()->result();
//        if ($query->num_rows() > 0) {
//            return $query;
//        }
        return $query;
    }

    function get_member_by_dep() {
        $this->db->select("*")->from('tb_member');
        $this->db->where('status !=','นักเรียน');
        $this->db->order_by('id asc');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return array();
    }

}
