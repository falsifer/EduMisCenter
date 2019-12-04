<?php

class ProjectPlan_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }
    
     // ดึงข้อมูลแผนงานโครงการโรงเรียนส่วนบุคคล
    public function get_personal_project_plan() {
        $this->db->select("a.*, b.*, c.*, d.*, e.*, a.id as project_id")->from("tb_project_school a");
        $this->db->join("tb_education_strategic b", "b.id = a.education_st_id","left outer");
        $this->db->join("tb_localgov_strategic c", "c.id = a.localgov_strategies_id","left outer");
        $this->db->join("tb_school_strategic d", "d.id = a.school_strategies_id","left outer");
        $this->db->join("tb_division e", "e.id = a.plan_type_id","left outer");
        $this->db->where("a.project_department", $this->session->userdata('department'));
        $this->db->where("a.project_recorder", $this->session->userdata('name'));
        $rs = $this->db->get();
        if ($rs->num_rows() > 0) {
            return $rs->result_array();
        }
        return array();
    }
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
    
    public function get_all_plan_distinct() {
        $this->db->distinct();
        $this->db->select('tb_project_plan_name');
        $this->db->from('tb_project_plan');
        $this->db->where('tb_project_plan_department',$this->session->userdata('department'));
        $this->db->order_by('tb_project_plan_name');
        
        $rs = $this->db->get()->result_array();
        
        return $rs;
    }
    
    public function get_budget_by_project($id){
        $this->db->select('sum(project_plan_budget) as total');
        $this->db->from('tb_project_plan_budget');
        $this->db->where('project_id',$id);
        $rs = $this->db->get()->row_array();
        
        return $rs;
    }
    
    public function get_budget_plan_by_project($id){
        $this->db->select('sum(tb_project_plan_budget_amt) as total');
        $this->db->from('tb_project_plan_budget a');
        $this->db->join('tb_project_plan_budget_detail b','a.id=b.tb_project_plan_budget_id');
        $this->db->where('project_id',$id);
        $rs = $this->db->get()->row_array();
        
        return $rs;
    }
    
    
    

}