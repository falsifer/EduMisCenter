<?php

class EducationPlan_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    // ดึงข้อมูลแผนงานโครงการ
    public function get_project() {
        $this->db->select("a.*, b.*, c.*, d.*, e.*, a.id as project_id")->from("tb_project a");
        $this->db->join("tb_province_strategic b", "b.id = a.province_strategies_id");
        $this->db->join("tb_localgov_strategies c", "c.id = a.localgov_strategies_id");
        $this->db->join("tb_localgov_sub_st d", "d.id = a.localgov_sub_st_id");
        $this->db->join("tb_localgov_plan_type e", "e.id = a.plan_type_id");
        $this->db->where("a.project_department", $this->session->userdata('department'));
        $rs = $this->db->get();
        if ($rs->num_rows() > 0) {
            return $rs->result_array();
        }
        return array();
    }
    
    // ดึงข้อมูลแผนงานโครงการโรงเรียน
    public function get_project_plan() {
        $this->db->select("a.*, b.*, c.*, d.*, e.*, a.id as project_id")->from("tb_project_school a");
        $this->db->join("tb_education_strategic b", "b.id = a.education_st_id","left outer");
        $this->db->join("tb_localgov_strategic c", "c.id = a.localgov_strategies_id","left outer");
        $this->db->join("tb_school_strategic d", "d.id = a.school_strategies_id","left outer");
        $this->db->join("tb_localgov_plan_type e", "e.id = a.plan_type_id","left outer");
        $this->db->where("a.project_department", $this->session->userdata('department'));
        $rs = $this->db->get();
        if ($rs->num_rows() > 0) {
            return $rs->result_array();
        }
        return array();
    }
    
     // ดึงข้อมูลแผนงานโครงการโรงเรียนส่วนบุคคล
    public function get_personal_project_plan() {
        $this->db->select("a.*, b.*, c.*, d.*, e.*, a.id as project_id")->from("tb_project_school a");
        $this->db->join("tb_education_strategic b", "b.id = a.education_st_id","left outer");
        $this->db->join("tb_localgov_strategic c", "c.id = a.localgov_strategies_id","left outer");
        $this->db->join("tb_school_strategic d", "d.id = a.school_strategies_id","left outer");
        $this->db->join("tb_localgov_plan_type e", "e.id = a.plan_type_id","left outer");
        $this->db->where("a.project_department", $this->session->userdata('department'));
        $this->db->where("a.project_recorder", $this->session->userdata('name'));
        $rs = $this->db->get();
        if ($rs->num_rows() > 0) {
            return $rs->result_array();
        }
        return array();
    }

    //
    public function get_project_plan_row($id) {
        $this->db->select("a.*, b.*, c.*, d.*, e.*, a.id as project_id")->from("tb_project_school a");
        $this->db->join("tb_education_strategic b", "b.id = a.education_st_id","left outer");
        $this->db->join("tb_localgov_strategic c", "c.id = a.localgov_strategies_id","left outer");
        $this->db->join("tb_school_strategic d", "d.id = a.school_strategies_id","left outer");
        $this->db->join("tb_localgov_plan_type e", "e.id = a.plan_type_id","left outer");
        $this->db->where("a.id", $id);
        $rs = $this->db->get();
        if ($rs->num_rows() > 0) {
            return $rs->row_array();
        }
        return array();
    }
    
    public function get_project_row($id) {
        $this->db->select("a.*, b.*, c.*, d.*, e.*, a.id as project_id")->from("tb_project a");
        $this->db->join("tb_province_strategies b", "b.id = a.province_strategies_id");
        $this->db->join("tb_localgov_strategies c", "c.id = a.localgov_strategies_id");
        $this->db->join("tb_localgov_sub_st d", "d.id = a.localgov_sub_st_id");
        $this->db->join("tb_localgov_plan_type e", "e.id = a.plan_type_id");
        $this->db->where("a.id", $id);
        $rs = $this->db->get();
        if ($rs->num_rows() > 0) {
            return $rs->row_array();
        }
        return array();
    }


    //
    function get_education_plan() {
        if ($this->session->userdata('status') == "ผู้ปฏิบัติงาน") {
            $this->db->select("*")->from("tb_education_plan");
            $this->db->where("plan_recorder", $this->session->userdata('name'));
            $rs = $this->db->get();
            if ($rs->num_rows() > 0) {
                return $rs->result_array();
            }
            return array();
        } else {
            $this->db->select("*")->from("tb_education_plan");
            $this->db->where("plan_department", $this->session->userdata('department'));
            $rs = $this->db->get();
            if ($rs->num_rows() > 0) {
                return $rs->result_array();
            }
            return array();
        }
    }

}
