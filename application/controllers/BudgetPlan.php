<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/*
  | ============================================================================
  |  Title: Class Setting
  | ============================================================================
  | Copyright	Edutech Co.,Ltd.
  | Purpose     กำหนดค่าเร่ิมต้นของโปรแกรม
  | Author	นายบัณฑิต ไชยดี
  | Create Date  November 13, 2018
  | Last edit	-
  | Comment	-
  | ============================================================================
 */

class BudgetPlan extends CI_Controller {

    public function __construct() {
        parent::__construct();
        if ($this->session->userdata('status') == "") {
            redirect("/");
        }
        $this->load->model('ProjectPlan_model');
    }

    public function index() {
        $data['plan'] = $this->ProjectPlan_model->get_all_plan_distinct();
        load_view($this, "budget_plan/index", $data);
    }

    public function budget() {
        $data['income'] = $this->My_model->get_where_order('tb_acc_income', array('tb_acc_income_department' => $this->session->userdata("department")), '');

        load_view($this, "budget_plan/budget", $data);
    }
    
    public function budget_plan_list(){
        $data['project'] = $this->My_model->get_where_order('tb_project_school',array('main_plan_name'=>$this->input->get('plan')),'project_name');
        
        load_view($this, "budget_plan/project_list", $data);
    }
    
    public function get_budget_plan(){
        $project_id = $this->input->post('project_id');
        
        $this->db->select('*');
        $this->db->from('tb_project_school a');
        $this->db->join('tb_project_plan_budget b','b.project_id=a.id','left outer');
        $this->db->join('tb_project_plan_budget_detail c','c.tb_project_plan_budget_id=b.id','left outer');
    }

}
