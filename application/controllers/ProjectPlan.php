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

class ProjectPlan extends CI_Controller {

    public function __construct() {
        parent::__construct();
        if ($this->session->userdata('status') == "") {
            redirect("/");
        }
        $this->load->model('ProjectPlan_model');
    }

    public function init_plan() {

        $data['plan'] = $this->My_model->get_where_order('tb_project_plan', array('tb_project_plan_department' => $this->session->userdata('department')), 'tb_project_plan_name');
//        $data['plan'] = $this->ProjectPlan_model->get_all_plan_distinct();
        load_view($this, 'project_plan/plan', $data);
    }

    public function insert_plan() {
        $id = $this->input->post("id");

        $arr = array(
            'tb_project_plan_name' => $this->input->post("inMainPlanName"),
            'tb_project_plan_startdate' => $this->input->post("inProjectStart"),
            'tb_project_plan_enddate' => $this->input->post("inProjectEnd"),
            'tb_project_plan_department' => $this->session->userdata("department"),
        );

        if ($id != "") {
            $this->My_model->update_data('tb_project_plan', array('id' => $id), $arr);
        } else {
            $this->My_model->insert_data('tb_project_plan', $arr);
        }
    }

    public function edit_plan() {
        $id = $this->input->post("id");
        $rs = $this->My_model->get_where_row('tb_project_plan', array('id' => $id));
        echo json_encode($rs);
    }

    public function delete_plan() {
        $id = $this->input->post("id");
        $this->My_model->delete_data('tb_project_plan', array('id' => $id));
    }

    public function project_school() {

        $planId = $this->uri->segment(2);
        $rs = $this->My_model->get_where_row('tb_project_plan', array('id' => $planId));

        $plan = "";
        if (isset($rs['tb_project_plan_name'])) {
            $plan = $rs['tb_project_plan_name'];
        }

        $arr = array('main_plan_name' => $plan);

        $data['school_st'] = $this->My_model->get_where_order("tb_school_strategic", array('school_strategic_department' => $this->session->userdata('department')), "school_strategic_no ASC");
        $data['localgov'] = $this->My_model->get_all_order("tb_localgov_strategic", "localgov_st_no ASC");
        $data['edu_st'] = $this->My_model->get_all_order("tb_education_strategic", "education_st_no ASC");
        $data['division'] = $this->My_model->get_where_order("tb_division", array('tb_school_id' => $this->session->userdata('sch_id')), "tb_division_name ASC");
//        $data['plan'] = $this->My_model->get_where_order('tb_project_plan', array('tb_project_plan_department' => $this->session->userdata('department')), 'tb_project_plan_name');
        $data['plan'] = $this->ProjectPlan_model->get_all_plan_distinct();
        $data['budget'] = $this->My_model->get_where_order('tb_acc_income', array('tb_school_id' => $this->session->userdata('sch_id')), 'tb_acc_income_detail');
        $data['plan_ref'] = $plan;

        $data['rs'] = $this->My_model->get_where_order('tb_project_school', $arr, 'project_name');
        load_view($this, 'project_plan/index', $data);
    }

    function project_planing_personal() {
        $data['school_st'] = $this->My_model->get_where_order("tb_school_strategic", array('school_strategic_department' => $this->session->userdata('department')), "school_strategic_no ASC");
        $data['localgov'] = $this->My_model->get_all_order("tb_localgov_strategic", "localgov_st_no ASC");
        $data['edu_st'] = $this->My_model->get_all_order("tb_education_strategic", "education_st_no ASC");
        $data['division'] = $this->My_model->get_where_order("tb_division", array('tb_school_id' => $this->session->userdata('sch_id')), "tb_division_name ASC");
        $data['rs'] = $this->ProjectPlan_model->get_personal_project_plan();

//        $data['plan'] = $this->My_model->get_where_order('tb_project_plan', array('tb_project_plan_department' => $this->session->userdata('department')), 'tb_project_plan_name');
        $data['plan'] = $this->ProjectPlan_model->get_all_plan_distinct();
        $data['budget'] = $this->My_model->get_where_order('tb_acc_income', array('tb_school_id' => $this->session->userdata('sch_id')), 'tb_acc_income_detail');

        $this->load->view("layout/header");
        $this->load->view("project_plan/personal_project", $data);
        $this->load->view("layout/footer");
    }

    // บันทึกแผนงานโครงการโรงเรียน
    public function insert_project_plan() {
        $id = $_POST['id'];
        if ($id != '') {
            if ($_FILES['inProjectFile']['name'] != '') {
                $row = $this->My_model->get_where_row('tb_project_school', array('id' => $id));
                @unlink("upload/" . $row['project_file']);
                //
                $config = array(
                    "upload_path" => "upload/",
                    "allowed_types" => "*",
                    "max_size" => 0,
                    "file_name" => md5(date("YmdHis"))
                );
                $this->upload->initialize($config);
                $this->upload->do_upload("inProjectFile");
                $data = $this->upload->data();
                $arr = array("project_file" => $data['file_name']);
                $this->My_model->update_data('tb_project_school', array('id' => $id), $arr);
            }
            //
            $arr = array(
                "school_strategies_id" => $this->input->post("inSchoolStId"),
                "localgov_strategies_id" => $this->input->post("inLocalgovStrategiesId"),
                "education_st_id" => $this->input->post("inEducationStId"),
                "plan_type_id" => $this->input->post("inPlanTypeId"),
                "responsible" => $this->input->post("inResponsible"),
                "main_plan_name" => $this->input->post("inMainPlanName"),
                "project_date" => date("Y-m-d"),
                "project_name" => $this->input->post("inProjectName"),
                "project_budget" => $this->input->post("inProjectPlanBudget"),
                "tb_project_plan_start" => $this->input->post("inProjectStart"),
                "tb_project_plan_end" => $this->input->post("inProjectEnd"),
//                "tb_project_plan_start" => '2561-10-01',
//                "tb_project_plan_end" => '2562-09-30',
//                "tb_plan_rational_criterion" => $_POST["inPlanRationalCriterion"],
                "project_recorder" => $this->session->userdata("name"),
                "project_department" => $this->session->userdata("department")
            );
           $check =  $this->My_model->update_data("tb_project_school", array("id" => $id), $arr);
        } else {
            if ($_FILES['inProjectFile']['name'] != '') {
                $config = array(
                    "upload_path" => "upload/",
                    "allowed_types" => "*",
                    "max_size" => 0,
                    "file_name" => md5(date("YmdHis"))
                );
                $this->upload->initialize($config);
                $this->upload->do_upload("inProjectFile");
                $data = $this->upload->data();
            }
            $arr = array(
                "school_strategies_id" => $this->input->post("inSchoolStId"),
                "localgov_strategies_id" => $this->input->post("inLocalgovStrategiesId"),
                "education_st_id" => $this->input->post("inEducationStId"),
                "plan_type_id" => $this->input->post("inPlanTypeId"),
                "responsible" => $this->input->post("inResponsible"),
                "main_plan_name" => $this->input->post("inMainPlanName"),
                "project_date" => date("Y-m-d"),
                "project_name" => $this->input->post("inProjectName"),
                "project_budget" => $this->input->post("inProjectPlanBudget"),
                "tb_project_plan_start" => $this->input->post("inProjectStart"),
                "tb_project_plan_end" => $this->input->post("inProjectEnd"),
//                "tb_project_plan_start" => '2561-10-01',
//                "tb_project_plan_end" => '2562-09-30',
                "project_file" => $data['file_name'],
//                "tb_plan_rational_criterion" => $_POST["inPlanRationalCriterion"],
                "project_recorder" => $this->session->userdata("name"),
                "project_department" => $this->session->userdata("department")
            );
           $check =  $this->My_model->insert_data("tb_project_school", $arr);
        }
        if($check){
           echo true;  
        }
       
    }

    // แก้ไขข้อมูลแผนงานโครงการ
    public function edit_project_plan() {
        $id = $_POST['id'];
        $row = $this->ProjectPlan_model->get_project_plan_row($id);
        echo json_encode($row);
    }

    // ลบข้อมูลแผนงานโครงการ
    public function delete_project_plan() {
        $id = $_POST['id'];
        $row = $this->My_model->get_where_row("tb_project_school", array("id" => $id));
        @unlink("upload/" . $row['project_file']);
        $this->My_model->delete_data("tb_project_school", array("id" => $id));
    }

}
