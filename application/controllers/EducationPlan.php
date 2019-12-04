<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/*
  | ----------------------------------------------------------------------------
  |  Title  Education Plan
  | ----------------------------------------------------------------------------
  | Copyright	Edutech Co.,Ltd.
  | Purpose     แหล่งเก็บข้อมูลแผนการศึกษา
  | Author	นายบัณฑิต ไชยดี
  | Create Date
  | Last edit	-
  | Comment	-
  | ----------------------------------------------------------------------------
 */

class EducationPlan extends CI_Controller {

    public function __construct() {
        parent::__construct();
        if ($this->session->userdata('status') == '') {
            redirect('/');
        }
        $this->load->model('EducationPlan_model');
    }

    //
    public function index() {
        if ($this->session->userdata("status") == "") {
            redirect('/');
        }

//        if ($this->session->userdata("department")== "กองการศึกษา") {
//
//            $data['province'] = $this->My_model->get_all_order("tb_province_strategic", "strategic_no ASC");
//            $data['localgov'] = $this->My_model->get_all_order("tb_localgov_strategic", "localgov_st_no ASC");
//            $data['sub_st'] = $this->My_model->get_all_order("tb_localgov_sub_st", "sub_st_name ASC");
//            $data['plan_type'] = $this->My_model->get_all_order("tb_localgov_plan_type", "localgov_plan_type ASC");
//            $data['rs'] = $this->EducationPlan_model->get_project();
//            $this->load->view("layout/header");
//            $this->load->view("education_plan/index", $data);
//            $this->load->view("layout/footer");
//        } else {
        $data['school_st'] = $this->My_model->get_all_order("tb_school_strategic", "school_strategic_no ASC");
        $data['localgov'] = $this->My_model->get_all_order("tb_localgov_strategic", "localgov_st_no ASC");
        $data['edu_st'] = $this->My_model->get_all_order("tb_education_strategic", "education_st_no ASC");
        $data['plan_type'] = $this->My_model->get_all_order("tb_localgov_plan_type", "localgov_plan_type ASC");
        $data['rs'] = $this->EducationPlan_model->get_project_plan();
        $this->load->view("layout/header");
        $this->load->view("project_plan/index", $data);
        $this->load->view("layout/footer");
//        }
    }

    // บันทึกแผนงานโครงการ
    public function insert_plan() {
        $id = $_POST['id'];
        if ($id != '') {
            if ($_FILES['inProjectFile']['name'] != '') {
                $row = $this->My_model->get_where_row('tb_project', array('id' => $id));
                @unlink("upload/" . $row['project_file']);
                //
                $config = array(
                    "upload_path" => "upload/",
                    "allowed_types" => "pdf|doc|docx|xls|xlsx",
                    "max_size" => 0,
                    "file_name" => md5(date("YmdHis"))
                );
                $this->upload->initialize($config);
                $this->upload->do_upload("inProjectFile");
                $data = $this->upload->data();
                $arr = array("project_file" => $data['file_name']);
                $this->My_model->update_data('tb_project', array('id' => $id), $arr);
            }
            //
            $arr = array(
                "province_strategies_id" => $this->input->post("inProvinceStrategiesId"),
                "localgov_strategies_id" => $this->input->post("inLocalgovStrategiesId"),
                "localgov_sub_st_id" => $this->input->post("inLocalgovSubStId"),
                "plan_type_id" => $this->input->post("inPlanTypeId"),
                "main_plan_name" => $this->input->post("inMainPlanName"),
                "project_date" => date("Y-m-d"),
                "project_name" => $this->input->post("inProjectName"),
//                "tb_plan_rational_criterion" => $_POST["inPlanRationalCriterion"],
                "project_recorder" => $this->session->userdata("name"),
                "project_department" => $this->session->userdata("department")
            );
            $this->My_model->update_data("tb_project", array("id" => $id), $arr);
        } else {
            $config = array(
                "upload_path" => "upload/",
                "allowed_types" => "pdf|doc|docx|xls|xlsx",
                "max_size" => 0,
                "file_name" => md5(date("YmdHis"))
            );
            $this->upload->initialize($config);
            $this->upload->do_upload("inProjectFile");
            $data = $this->upload->data();
            $arr = array(
                "province_strategies_id" => $this->input->post("inProvinceStrategiesId"),
                "localgov_strategies_id" => $this->input->post("inLocalgovStrategiesId"),
                "localgov_sub_st_id" => $this->input->post("inLocalgovSubStId"),
                "plan_type_id" => $this->input->post("inPlanTypeId"),
                "main_plan_name" => $this->input->post("inMainPlanName"),
                "project_date" => date("Y-m-d"),
                "project_name" => $this->input->post("inProjectName"),
                "project_file" => $data['file_name'],
//                "tb_plan_rational_criterion" => $_POST["inPlanRationalCriterion"],
                "project_recorder" => $this->session->userdata("name"),
                "project_department" => $this->session->userdata("department")
            );
            $this->My_model->insert_data("tb_project", $arr);
        }
    }

    // แก้ไขข้อมูลแผนงานโครงการ
    public function edit_plan() {
        $id = $_POST['id'];
        $row = $this->EducationPlan_model->get_project_row($id);
        echo json_encode($row);
    }

    // ลบข้อมูลแผนงานโครงการ
    public function delete_plan() {
        $id = $_POST['id'];
        $row = $this->My_model->get_where_row("tb_project", array("id" => $id));
        @unlink("upload/" . $row['project_file']);
        $this->My_model->delete_data("tb_project", array("id" => $id));
    }
    
     // ลบข้อมูลแผนงานโครงการ
    public function delete_plan_plan() {
        $id = $_POST['id'];
        $row = $this->My_model->get_where_row("tb_project_school", array("id" => $id));
        @unlink("upload/" . $row['project_file']);
        $this->My_model->delete_data("tb_project_school", array("id" => $id));
    }

    // ดึงข้อมูลจากงานโครงการเพื่อไปยังหน้าอื่น
    public function get_project_detail() {
        $id = $_POST['id'];
        $row = $this->EducationPlan_model->get_project_row($id);
        echo json_encode($row);
    }

    // วัตถุประสงค์ของโครงการ
    public function project_purpose() {
        $id = $this->uri->segment(2);
        $data['purpose'] = $this->EducationPlan_model->get_project_row($id);
        $data['rs'] = $this->My_model->get_where_order('tb_project_purpose', array('project_id' => $id), 'id ASC');
        $this->load->view("layout/header");
        $this->load->view("education_plan/project_purpose", $data);
        $this->load->view("layout/footer");
    }

    // add project purpose
    public function project_purpose_add() {
        $id = $_POST['id'];
        if ($id != '') {
            $arr = array(
                "purpose_description" => $this->input->post("inPurposeDescription")
            );
            $this->My_model->update_data("tb_project_purpose", array("id" => $id), $arr);
        } else {
            $arr = array(
                "project_id" => $this->input->post("project_id"),
                "purpose_description" => $this->input->post("inPurposeDescription")
            );
            $this->My_model->insert_data("tb_project_purpose", $arr);
        }
    }

    // edit purpose data;
    public function project_purpose_edit() {
        $id = $_POST['id'];
        $row = $this->My_model->get_where_row("tb_project_purpose", array("id" => $id));
        echo json_encode($row);
    }

    // เป้าหมาย (ผลผลิตของโครงการ)
    public function project_goal() {
        $id = $this->uri->segment(2);
        $data['gold'] = $this->EducationPlan_model->get_project_row($id);
        $data['rs'] = $this->My_model->get_where_order("tb_project_goal", array("project_id" => $id), "id ASC");
        $this->load->view("layout/header");
        $this->load->view("education_plan/project_goal", $data);
        $this->load->view("layout/footer");
    }

    // บันทึกเป้าหมาย (ผลผลิตของโครงการ)
    public function project_goal_add() {
        $id = $_POST['id'];
        if ($id != '') {
            $arr = array('project_goal' => $this->input->post('inGoalDescription'));
            $this->My_model->update_data("tb_project_goal", array("id" => $id), $arr);
        } else {
            $arr = array("project_id" => $this->input->post('project_id'), 'project_goal' => $this->input->post('inGoalDescription'));
            $this->My_model->insert_data('tb_project_goal', $arr);
        }
    }

    // แก้ไขข้อมูลเป้าหมาย
    public function project_goal_edit() {
        $id = $_POST['id'];
        $row = $this->My_model->get_where_row("tb_project_goal", array("id" => $id));
        echo json_encode($row);
    }

    // ลบข้อมูลเป้าหมาย
    public function project_goal_delete() {
        $id = $_POST['id'];
        $this->My_model->delete_data("tb_project_goal", array("id" => $id));
    }

    // ข้อมูลงบประมาณที่ผ่านมา
    public function project_loan() {



        $id = $this->uri->segment(2);
        $data['rs'] = $this->My_model->join2table_where_result('tb_project a', 'tb_project_loan_year b', 'b.project_id= a.id', array('b.project_id' => $id), 'loan_year asc');
        $this->load->view("layout/header");
        $this->load->view("education_plan/project_loan", $data);
        $this->load->view("layout/footer");
    }

    // บันทึกปีงบประมาณที่ดำเนินการ
    public function loan_year_add() {
        $id = $_POST['id'];
        if ($id != '') {
            $arr = array(
                "loan_year" => $this->input->post("inLoanYear"),
                "project_loan" => $this->input->post("inProjectLoan")
            );
            $this->My_model->update_data('tb_project_loan_year', array('id' => $id), $arr);
        } else {
            $arr = array(
                "project_id" => $this->input->post("project_id"),
                "loan_year" => $this->input->post("inLoanYear"),
                "project_loan" => $this->input->post("inProjectLoan")
            );
            $this->My_model->insert_data("tb_project_loan_year", $arr);
        }
    }

    // edit loan year;
    public function loan_year_edit() {
        $id = $_POST['id'];
        $row = $this->My_model->get_where_row("tb_project_loan_year", array('id' => $id));
        echo json_encode($row);
    }

    // delete loan year;
    public function loan_year_delete() {
        $id = $_POST['id'];
        $this->My_model->delete_data('tb_project_loan_year', array('id' => $id));
    }

    // KPI
    public function project_kpi() {
        $id = $this->uri->segment(2);
        $data['rs'] = $this->My_model->get_where_order("tb_project_kpi", array("project_id" => $id), "kpi_detail asc");
        $this->load->view("layout/header");
        $this->load->view("education_plan/project_kpi", $data);
        $this->load->view("layout/footer");
    }

    // insert kpi data;
    public function project_kpi_add() {
        $id = $_POST['id'];
        if ($id != '') {
            $arr = array("kpi_detail" => $this->input->post("inKpiDetail"));
            $this->My_model->update_data("tb_project_kpi", array("id" => $id), $arr);
        } else {
            $arr = array("project_id" => $this->input->post("project_id"), "kpi_detail" => $this->input->post("inKpiDetail"));
            $this->My_model->insert_data('tb_project_kpi', $arr);
        }
    }

    // แก้ไขข้อมูลตัวชี้วัด
    public function project_kpi_edit() {
        $id = $_POST['id'];
        $row = $this->My_model->get_where_row("tb_project_kpi", array("id" => $id));
        echo json_encode($row);
    }

    // delete kpi data;
    public function project_kpi_delete() {
        $id = $_POST['id'];
        $this->My_model->delete_data("tb_project_kpi", array("id" => $id));
    }

    // ผลที่คาดว่าจะได้รับ
    public function project_destination() {
        $id = $this->uri->segment(2);
        $data['rs'] = $this->My_model->get_where_order("tb_project_destination", array("project_id" => $id), "id asc");
        $this->load->view("layout/header");
        $this->load->view("education_plan/project_destination", $data);
        $this->load->view("layout/footer");
    }

    // บันทึกผลที่คาดว่าจะได้รับ
    public function project_destination_add() {
        $id = $_POST['id'];
        if ($id != '') {
            $arr = array(
                'destination' => $this->input->post("inDestination")
            );
            $this->My_model->update_data("tb_project_destination", array("id" => $id), $arr);
        } else {
            $arr = array(
                'project_id' => $this->input->post("project_id"),
                'destination' => $this->input->post("inDestination")
            );
            $this->My_model->insert_data("tb_project_destination", $arr);
        }
    }

    // update project destination;
    public function project_destination_edit() {
        $id = $_POST['id'];
        $row = $this->My_model->get_where_row("tb_project_destination", array("id" => $id));
        echo json_encode($row);
    }

    // delete project destination
    public function project_destination_delete() {
        $id = $_POST['id'];
        $this->My_model->delete_data("tb_project_destination", array("id" => $id));
    }

    // พิมพ์ข้อมูลทางเครื่องพิมพ์
    public function project_print($id) {
        $data['rs'] = $this->EducationPlan_model->get_project_row($id);
        $this->load->view("reports/project_report", $data);
    }

    public function project_plan_print_all() {
        $data['rs'] = $this->My_model->get_where_order("tb_project_school", array("project_department" => $this->session->userdata("department")));
        $this->load->view("project_plan/reports/project_report_all", $data);
    }

    // พิมพ์ข้อมูลทางเครื่องพิมพ์
    public function project_plan_print($id) {
        $data['rs'] = $this->EducationPlan_model->get_project_plan_row($id);
        $this->load->view("project_plan/reports/project_report", $data);
    }

    // กำหนดแผนยุทธศาสตร์จังหวัด
    public function province_strategic() {
        $data['rs'] = $this->My_model->get_all_order("tb_province_strategic", "strategic_no asc");
        $this->load->view("layout/header");
        $this->load->view("education_plan/province_strategic", $data);
        $this->load->view("layout/footer");
    }

    public function province_strategies() {
        $data['rs'] = $this->My_model->get_all_order("tb_province_strategies", "strategies_no asc");
        $this->load->view("layout/header");
        $this->load->view("education_plan/province_strategies", $data);
        $this->load->view("layout/footer");
    }

    // insert province strategies plan
    public function province_strategic_insert() {
        $id = $_POST['id'];
        $arr = array(
            "strategic_no" => $this->input->post('inProvinceStrategicNo'),
            "strategic_name" => $this->input->post("inProvinceStrategicName")
        );
        if ($id != "") {
            $this->My_model->update_data('tb_province_strategic', array("id" => $id), $arr);
        } else {
            $this->My_model->insert_data("tb_province_strategic", $arr);
        }
    }

    // insert province strategies plan
    public function province_strategies_insert() {
        $id = $_POST['id'];
        $stid = $_POST['stid'];
        $arr = array(
            "strategies_no" => $this->input->post('inProvinceStrategiesNo'),
            "strategies_name" => $this->input->post("inProvinceStrategiesName"),
            "tb_province_strategic_id" => $stid
        );
        if ($id != "") {
            $this->My_model->update_data('tb_province_strategies', array("id" => $id), $arr);
        } else {
            $this->My_model->insert_data("tb_province_strategies", $arr);
        }
    }

    // delete data
    public function province_strategies_delete() {
        $id = $_POST['id'];
        $this->My_model->delete_data("tb_province_strategies", array("id" => $id));
    }

    //
    public function province_strategies_edit() {
        $id = $_POST['id'];
        $row = $this->My_model->get_where_row("tb_province_strategies", array("id" => $id));
        echo json_encode($row);
    }

    // กำหนดแผนยุทธศาสตร์องค์กรปกครองส่วนท้องถิ่น

    public function localgov_strategic() {
        $data['rs'] = $this->My_model->get_all_order("tb_localgov_strategic", "localgov_st_no ASC");
        $this->load->view("layout/header");
        $this->load->view("education_plan/localgov_strategic", $data);
        $this->load->view("layout/footer");
    }

    public function localgov_strategic_insert() {
        $id = $_POST['id'];
        $arr = array(
            "localgov_st_no" => $this->input->post("inLocalgovStNo"),
            "localgov_st_name" => $this->input->post("inLocalgovStName")
        );
        if ($id != "") {
            $this->My_model->update_data("tb_localgov_strategic", array("id" => $id), $arr);
        } else {
            $this->My_model->insert_data('tb_localgov_strategic', $arr);
        }
    }

    public function localgov_strategies() {
        $data['rs'] = $this->My_model->get_all_order("tb_localgov_strategies", "localgov_st_no ASC");
        $this->load->view("layout/header");
        $this->load->view("education_plan/localgov_strategies", $data);
        $this->load->view("layout/footer");
    }

    // insert data;
    public function localgov_strategies_insert() {
        $id = $_POST['id'];
        $stid = $_POST['stid'];
        $arr = array(
            "localgov_st_no" => $this->input->post("inLocalgovStNo"),
            "localgov_st_name" => $this->input->post("inLocalgovStName"),
            "tb_localgov_strategic_id" => $stid
        );
        if ($id != "") {
            $this->My_model->update_data("tb_localgov_strategies", array("id" => $id), $arr);
        } else {
            $this->My_model->insert_data('tb_localgov_strategies', $arr);
        }
    }

    // edit data;
    public function localgov_strategies_edit() {
        $id = $_POST['id'];
        $row = $this->My_model->get_where_row("tb_localgov_strategies", array("id" => $id));
        echo json_encode($row);
    }

    // ลบข้อมูลแผนยุทธศาสร์ อบจ.
    public function localgov_strategies_delete() {
        $id = $_POST['id'];
        $this->My_model->delete_data("tb_localgov_strategies", array("id" => $id));
    }

    // กำหนดยุทธศาสตร์ย่อย
    public function localgov_sub_st() {
        if ($this->session->userdata('status') == "") {
            redirect('login');
        }
        $data['rs'] = $this->My_model->get_all_order("tb_localgov_sub_st", "sub_st_name ASC");
        $this->load->view("layout/header");
        $this->load->view("education_plan/localgov_sub_st", $data);
        $this->load->view("layout/footer");
    }

    // insert data;
    public function localgov_sub_st_add() {
        $id = $_POST['id'];
        $arr = array(
            "sub_st_name" => $this->input->post('inLocagovSubSt')
        );
        if ($id != '') {
            $this->My_model->update_data("tb_localgov_sub_st", array("id" => $id), $arr);
        } else {
            $this->My_model->insert_data('tb_localgov_sub_st', $arr);
        }
    }

    // edit data
    public function localgov_sub_st_edit() {
        $id = $_POST['id'];
        $row = $this->My_model->get_where_row("tb_localgov_sub_st", array("id" => $id));
        echo json_encode($row);
    }

    // delete data;
    public function localgov_sub_st_delete() {
        $id = $_POST['id'];
        $this->My_model->delete_data("tb_localgov_sub_st", array("id" => $id));
    }

    // กำหนดประเภทของแผนงาน
    public function localgov_plan_type() {
        $data['rs'] = $this->My_model->get_all_order("tb_localgov_plan_type", "localgov_plan_type ASC");
        $this->load->view("layout/header");
        $this->load->view("education_plan/localgov_plan_type", $data);
        $this->load->view("layout/footer");
    }

    // insert localgov plan type data;
    public function localgov_plan_add() {
        $id = $_POST['id'];
        $arr = array(
            'localgov_plan_type' => $this->input->post('inLocalgovPlanType')
        );
        if ($id != "") {
            $this->My_model->update_data("tb_localgov_plan_type", array("id" => $id), $arr);
        } else {
            $this->My_model->insert_data("tb_localgov_plan_type", $arr);
        }
    }

    // แก้ไขข้อมูลประเภทแผนงานโครงการ
    public function localgov_plan_edit() {
        $id = $_POST['id'];
        $row = $this->My_model->get_where_row("tb_localgov_plan_type", array("id" => $id));
        echo json_encode($row);
    }

    // ลบข้อมูลประเภทแผนงานโครงการ
    public function localgov_plan_delete() {
        $id = $_POST['id'];
        $this->My_model->delete_data("tb_localgov_plan_type", array("id" => $id));
    }

    //----vision-----
    public function vision() {
        $data['rs'] = $this->My_model->get_where_row('tb_vision', array("tb_vision_department" => $this->session->userdata("department")));

        $this->load->view("layout/header");
        $this->load->view("education_plan/vision", $data);
        $this->load->view("layout/footer");
    }

    public function vision_add() {
        $id = $_POST['id'];
        $arr = array(
            'tb_vision_content' => $_POST['inVisionContent'],
            'tb_vision_recorder' => $this->session->userdata("name"),
            'tb_vision_department' => $this->session->userdata("department"),
        );
        if ($id != "") {
            $this->My_model->update_data("tb_vision", array("id" => $id), $arr);
        } else {
            $this->My_model->insert_data("tb_vision", $arr);
        }
    }

    public function purpose() {
        $data['rs'] = $this->My_model->get_where_row('tb_purpose', array("tb_purpose_department" => $this->session->userdata("department")));

        $this->load->view("layout/header");
        $this->load->view("education_plan/purpose", $data);
        $this->load->view("layout/footer");
    }

    public function purpose_add() {
        $id = $_POST['id'];
        $arr = array(
            'tb_purpose_content' => $_POST['inPurposeContent'],
            'tb_purpose_recorder' => $this->session->userdata("name"),
            'tb_purpose_department' => $this->session->userdata("department"),
        );
        if ($id != "") {
            $this->My_model->update_data("tb_purpose", array("id" => $id), $arr);
        } else {
            $this->My_model->insert_data("tb_purpose", $arr);
        }
    }

    public function mission() {
        $data['rs'] = $this->My_model->get_where_row('tb_mission', array("tb_mission_department" => $this->session->userdata("department")));

        $this->load->view("layout/header");
        $this->load->view("education_plan/mission", $data);
        $this->load->view("layout/footer");
    }

    public function mission_add() {
        $id = $_POST['id'];
        $arr = array(
            'tb_mission_content' => $_POST['inMissionContent'],
            'tb_mission_recorder' => $this->session->userdata("name"),
            'tb_mission_department' => $this->session->userdata("department"),
        );
        if ($id != "") {
            $this->My_model->update_data("tb_mission", array("id" => $id), $arr);
        } else {
            $this->My_model->insert_data("tb_mission", $arr);
        }
    }

    public function school_strategic() {
        $data['rs'] = $this->My_model->get_where_order("tb_school_strategic", array('school_strategic_department' => $this->session->userdata('department')), "school_strategic_no ASC");
        $this->load->view("layout/header");
        $this->load->view("project_plan/school_strategic", $data);
        $this->load->view("layout/footer");
    }

    public function school_strategic_insert() {
        $id = $_POST['id'];
        $arr = array(
            "school_strategic_no" => $this->input->post("inSchoolStNo"),
            "school_strategic_name" => $this->input->post("inSchoolStName"),
            "school_strategic_recorder" => $this->session->userdata('name'),
            "school_strategic_department" => $this->session->userdata('department'),
        );
        if ($id != "") {
            $this->My_model->update_data("tb_school_strategic", array("id" => $id), $arr);
        } else {
            $this->My_model->insert_data('tb_school_strategic', $arr);
        }
    }
    // แก้ไขข้อมูลประเภทแผนงานโครงการ
    public function school_strategic_edit() {
        $id = $_POST['id'];
        $row = $this->My_model->get_where_row("tb_school_strategic", array("id" => $id));
        echo json_encode($row);
    }

    // ลบข้อมูลประเภทแผนงานโครงการ
    public function school_strategic_delete() {
        $id = $_POST['id'];
        $this->My_model->delete_data("tb_school_strategic", array("id" => $id));
    }
    
    public function school_strategies() {
        $data['rs'] = $this->My_model->get_all_order("tb_school_strategies", "school_strategies_no ASC");
        $this->load->view("layout/header");
        $this->load->view("project_plan/school_strategies", $data);
        $this->load->view("layout/footer");
    }

    // insert data;
    public function school_strategies_insert() {
        $id = $_POST['stsid'];
        $stid = $_POST['stid'];
        $arr = array(
            "school_strategies_no" => $this->input->post("inSchoolStsNo"),
            "school_strategies_name" => $this->input->post("inSchoolStsName"),
            "tb_school_strategic_id" => $stid
        );
        if ($id != "") {
            $this->My_model->update_data("tb_school_strategies", array("id" => $id), $arr);
        } else {
            $this->My_model->insert_data('tb_school_strategies', $arr);
        }
    }
   // แก้ไขข้อมูลประเภทแผนงานโครงการ
    public function school_strategies_edit() {
        $id = $_POST['id'];
        $row = $this->My_model->get_where_row("tb_school_strategies", array("id" => $id));
        echo json_encode($row);
    }

    // ลบข้อมูลประเภทแผนงานโครงการ
    public function school_strategies_delete() {
        $id = $_POST['id'];
        $this->My_model->delete_data("tb_school_strategies", array("id" => $id));
    }

    public function education_strategic() {
        $data['rs'] = $this->My_model->get_all_order("tb_education_strategic", "education_st_no ASC");
        $this->load->view("layout/header");
        $this->load->view("education_plan/education_strategic", $data);
        $this->load->view("layout/footer");
    }

    public function education_strategic_insert() {
        $id = $_POST['id'];
        $arr = array(
            "education_st_no" => $this->input->post("inEducationStNo"),
            "education_st_name" => $this->input->post("inEducationStName")
        );
        if ($id != "") {
            $this->My_model->update_data("tb_education_strategic", array("id" => $id), $arr);
        } else {
            $this->My_model->insert_data('tb_education_strategic', $arr);
        }
    }

    public function education_strategies() {
        $data['rs'] = $this->My_model->get_all_order("tb_education_strategies", "education_st_no ASC");
        $this->load->view("layout/header");
        $this->load->view("education_plan/education_strategies", $data);
        $this->load->view("layout/footer");
    }

    // insert data;
    public function education_strategies_insert() {
        $id = $_POST['id'];
        $stid = $_POST['stid'];
        $arr = array(
            "education_st_no" => $this->input->post("inEducationStNo"),
            "education_st_name" => $this->input->post("inEducationStName"),
            "tb_education_strategic_id" => $stid
        );
        if ($id != "") {
            $this->My_model->update_data("tb_education_strategies", array("id" => $id), $arr);
        } else {
            $this->My_model->insert_data('tb_education_strategies', $arr);
        }
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
                    "allowed_types" => "pdf|doc|docx|xls|xlsx",
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
//                "tb_project_plan_start" => $this->input->post("inProjectStart"),
//                "tb_project_plan_end" => $this->input->post("inProjectEnd"),
                "tb_project_plan_start" => '2561-10-01',
                "tb_project_plan_end" => '2562-09-30',
//                "tb_plan_rational_criterion" => $_POST["inPlanRationalCriterion"],
                "project_recorder" => $this->session->userdata("name"),
                "project_department" => $this->session->userdata("department")
            );
            $this->My_model->update_data("tb_project_school", array("id" => $id), $arr);
        } else {
            $config = array(
                "upload_path" => "upload/",
                "allowed_types" => "pdf|doc|docx|xls|xlsx",
                "max_size" => 0,
                "file_name" => md5(date("YmdHis"))
            );
            $this->upload->initialize($config);
            $this->upload->do_upload("inProjectFile");
            $data = $this->upload->data();
            $arr = array(
                "school_strategies_id" => $this->input->post("inSchoolStId"),
                "localgov_strategies_id" => $this->input->post("inLocalgovStrategiesId"),
                "education_st_id" => $this->input->post("inEducationStId"),
                "plan_type_id" => $this->input->post("inPlanTypeId"),
                "responsible" => $this->input->post("inResponsible"),
                "main_plan_name" => $this->input->post("inMainPlanName"),
                "project_date" => date("Y-m-d"),
                "project_name" => $this->input->post("inProjectName"),
//                "tb_project_plan_start" => $this->input->post("inProjectStart"),
//                "tb_project_plan_end" => $this->input->post("inProjectEnd"),
                "tb_project_plan_start" => '2561-10-01',
                "tb_project_plan_end" => '2562-09-30',
                "project_file" => $data['file_name'],
//                "tb_plan_rational_criterion" => $_POST["inPlanRationalCriterion"],
                "project_recorder" => $this->session->userdata("name"),
                "project_department" => $this->session->userdata("department")
            );
            $this->My_model->insert_data("tb_project_school", $arr);
        }
    }

    // แก้ไขข้อมูลแผนงานโครงการ
    public function edit_project_plan() {
        $id = $_POST['id'];
        $row = $this->EducationPlan_model->get_project_plan_row($id);
        echo json_encode($row);
    }

    // ลบข้อมูลแผนงานโครงการ
    public function delete_project_plan() {
        $id = $_POST['id'];
        $row = $this->My_model->get_where_row("tb_project_school", array("id" => $id));
        @unlink("upload/" . $row['project_file']);
        $this->My_model->delete_data("tb_project_school", array("id" => $id));
    }

    // ดึงข้อมูลจากงานโครงการเพื่อไปยังหน้าอื่น
    public function get_project_plan_detail() {
        $id = $_POST['id'];
        $row = $this->EducationPlan_model->get_project_plan_row($id);
        echo json_encode($row);
    }

    // วัตถุประสงค์ของโครงการ
    public function project_plan_purpose() {
        $id = $this->uri->segment(2);
        $data['purpose'] = $this->EducationPlan_model->get_project_plan_row($id);
        $data['rs'] = $this->My_model->get_where_order('tb_project_plan_purpose', array('project_id' => $id), 'id ASC');
        $this->load->view("layout/header");
        $this->load->view("project_plan/project_purpose", $data);
        $this->load->view("layout/footer");
    }

    // add project purpose
    public function project_plan_purpose_add() {
        $id = $_POST['id'];
        if ($id != '') {
            $arr = array(
                "purpose_description" => $this->input->post("inPurposeDescription")
            );
            $this->My_model->update_data("tb_project_plan_purpose", array("id" => $id), $arr);
        } else {
            $arr = array(
                "project_id" => $this->input->post("project_id"),
                "purpose_description" => $this->input->post("inPurposeDescription")
            );
            $this->My_model->insert_data("tb_project_plan_purpose", $arr);
        }
    }

    // edit purpose data;
    public function project_plan_purpose_edit() {
        $id = $_POST['id'];
        $row = $this->My_model->get_where_row("tb_project_plan_purpose", array("id" => $id));
        echo json_encode($row);
    }
    
    public function delete_project_plan_purpose() {
        $id = $_POST['id'];
        $row = $this->My_model->get_where_row("tb_project_plan_purpose", array("id" => $id));
        $this->My_model->delete_data("tb_project_plan_purpose", array("id" => $id));
    }

    // เป้าหมาย (ผลผลิตของโครงการ)
    public function project_plan_goal() {
        $id = $this->uri->segment(2);
        $data['gold'] = $this->EducationPlan_model->get_project_row($id);
        $data['rs'] = $this->My_model->get_where_order("tb_project_plan_goal", array("project_id" => $id), "type DESC");
        $this->load->view("layout/header");
        $this->load->view("project_plan/project_goal", $data);
        $this->load->view("layout/footer");
    }

    // บันทึกเป้าหมาย (ผลผลิตของโครงการ)
    public function project_plan_goal_add() {
        $id = $_POST['id'];
        if ($id != '') {
            $arr = array('project_goal' => $this->input->post('inGoalDescription'), 'type' => $this->input->post('inGoalType'));
            $this->My_model->update_data("tb_project_plan_goal", array("id" => $id), $arr);
        } else {
            $arr = array("project_id" => $this->input->post('project_id'), 'project_goal' => $this->input->post('inGoalDescription'), 'type' => $this->input->post('inGoalType'));
            $this->My_model->insert_data('tb_project_plan_goal', $arr);
        }
    }

    // แก้ไขข้อมูลเป้าหมาย
    public function project_plan_goal_edit() {
        $id = $_POST['id'];
        $row = $this->My_model->get_where_row("tb_project_plan_goal", array("id" => $id));
        echo json_encode($row);
    }

    // ลบข้อมูลเป้าหมาย
    public function project_plan_goal_delete() {
        $id = $_POST['id'];
        $this->My_model->delete_data("tb_project_plan_goal", array("id" => $id));
    }

    // KPI
    public function project_plan_kpi() {
        $id = $this->uri->segment(2);
        $data['rs'] = $this->My_model->get_where_order("tb_project_plan_kpi", array("project_id" => $id), "kpi_detail asc");
        $this->load->view("layout/header");
        $this->load->view("project_plan/project_kpi", $data);
        $this->load->view("layout/footer");
    }

    // insert kpi data;
    public function project_plan_kpi_add() {
        $id = $_POST['id'];
        if ($id != '') {
            $arr = array("kpi_detail" => $this->input->post("inKpiDetail"));
            $this->My_model->update_data("tb_project_plan_kpi", array("id" => $id), $arr);
        } else {
            $arr = array("project_id" => $this->input->post("project_id"), "kpi_detail" => $this->input->post("inKpiDetail"));
            $this->My_model->insert_data('tb_project_plan_kpi', $arr);
        }
    }

    // แก้ไขข้อมูลตัวชี้วัด
    public function project_plan_kpi_edit() {
        $id = $_POST['id'];
        $row = $this->My_model->get_where_row("tb_project_plan_kpi", array("id" => $id));
        echo json_encode($row);
    }

    // delete kpi data;
    public function project_plan_kpi_delete() {
        $id = $_POST['id'];
        $this->My_model->delete_data("tb_project_plan_kpi", array("id" => $id));
    }

    // ผลที่คาดว่าจะได้รับ
    public function project_plan_destination() {
        $id = $this->uri->segment(2);
        $data['rs'] = $this->My_model->get_where_order("tb_project_plan_destination", array("project_id" => $id), "id asc");
        $this->load->view("layout/header");
        $this->load->view("project_plan/project_destination", $data);
        $this->load->view("layout/footer");
    }

    // บันทึกผลที่คาดว่าจะได้รับ
    public function project_plan_destination_add() {
        $id = $_POST['id'];
        if ($id != '') {
            $arr = array(
                'destination' => $this->input->post("inDestination")
            );
            $this->My_model->update_data("tb_project_plan_destination", array("id" => $id), $arr);
        } else {
            $arr = array(
                'project_id' => $this->input->post("project_id"),
                'destination' => $this->input->post("inDestination")
            );
            $this->My_model->insert_data("tb_project_plan_destination", $arr);
        }
    }

    // update project destination;
    public function project_plan_destination_edit() {
        $id = $_POST['id'];
        $row = $this->My_model->get_where_row("tb_project_plan_destination", array("id" => $id));
        echo json_encode($row);
    }

    // delete project destination
    public function project_plan_destination_delete() {
        $id = $_POST['id'];
        $this->My_model->delete_data("tb_project_plan_destination", array("id" => $id));
    }

    // วิธีดำเนินงาน
    public function project_plan_timeline() {
        $id = $this->uri->segment(2);
        $data['rs'] = $this->My_model->get_where_order("tb_project_plan_timeline", array("project_id" => $id), "id asc");
        $this->load->view("layout/header");
        $this->load->view("project_plan/project_timeline", $data);
        $this->load->view("layout/footer");
    }

    // บันทึกผลที่คาดว่าจะได้รับ
    public function project_plan_timeline_add() {
        $id = $_POST['id'];
        if ($id != '') {
            $arr = array(
                'process' => $this->input->post("inProcess"),
                'responsible' => $this->input->post("inResponsible"),
                'process_start' => $this->input->post("inProcessStart"),
                'process_end' => $this->input->post("inProcessEnd"),
                'process_seq' => $this->input->post("inProcessSeq"),
            );
            $this->My_model->update_data("tb_project_plan_timeline", array("id" => $id), $arr);
        } else {
            $arr = array(
                'project_id' => $this->input->post("project_id"),
                'process' => $this->input->post("inProcess"),
                'responsible' => $this->input->post("inResponsible"),
                'process_start' => $this->input->post("inProcessStart"),
                'process_end' => $this->input->post("inProcessEnd"),
                'process_seq' => $this->input->post("inProcessSeq"),
            );
            $this->My_model->insert_data("tb_project_plan_timeline", $arr);
        }
    }

    // update project destination;
    public function project_plan_timeline_edit() {
        $id = $_POST['id'];
        $row = $this->My_model->get_where_row("tb_project_plan_timeline", array("id" => $id));
        echo json_encode($row);
    }

    // delete project destination
    public function project_plan_timeline_delete() {
        $id = $_POST['id'];
        $this->My_model->delete_data("tb_project_plan_timeline", array("id" => $id));
    }

    public function project_plan_responsible() {
        $row = $this->My_model->get_where_order("tb_human_resources_01", array("hr_department" => $this->session->userdata('department')), 'hr_thai_name');
//        $str = "";
//        foreach($row as $r){
//            $str .= $r['hr_thai_symbol'].' '.$r['hr_thai_name'].' '.$r['hr_thai_lastname'].",";
//        }
//
//        echo $str;
        echo json_encode($row);
    }

    // งบประมาณ
    public function project_plan_loan() {
        $id = $this->uri->segment(2);
        $data['rs'] = $this->My_model->get_where_order("tb_project_plan_budget", array("project_id" => $id), "id asc");
        $this->load->view("layout/header");
        $this->load->view("project_plan/project_loan", $data);
        $this->load->view("layout/footer");
    }

    public function project_plan_loan_item() {
        $row = $this->My_model->get_where_order("tb_project_plan_budget", '1=1', 'project_plan_item');
        echo json_encode($row);
    }

    // บันทึกผลที่คาดว่าจะได้รับ
    public function project_plan_loan_add() {
        $id = $_POST['id'];
        if ($id != '') {
            $arr = array(
                'project_plan_item' => $this->input->post("inProjectPlanItem"),
                'project_plan_budget' => $this->input->post("inProjectPlanBudget"),
            );
            $this->My_model->update_data("tb_project_plan_budget", array("id" => $id), $arr);
        } else {
            $arr = array(
                'project_id' => $this->input->post("project_id"),
                'project_plan_item' => $this->input->post("inProjectPlanItem"),
                'project_plan_budget' => $this->input->post("inProjectPlanBudget"),
            );
            $this->My_model->insert_data("tb_project_plan_budget", $arr);
        }
    }

    // update project destination;
    public function project_plan_loan_edit() {
        $id = $_POST['id'];
        $row = $this->My_model->get_where_row("tb_project_plan_budget", array("id" => $id));
        echo json_encode($row);
    }

    // delete project destination
    public function project_plan_loan_delete() {
        $id = $_POST['id'];
        $this->My_model->delete_data("tb_project_plan_budget", array("id" => $id));
    }

    // งบประมาณ
    public function project_plan_evaluation() {
        $id = $this->uri->segment(2);
        $data['rs'] = $this->My_model->get_where_order("tb_project_plan_evaluation", array("project_id" => $id), "id asc");
        $this->load->view("layout/header");
        $this->load->view("project_plan/project_evaluation", $data);
        $this->load->view("layout/footer");
    }

    public function project_plan_evaluation_item() {
        $row = $this->My_model->get_where_order("tb_project_plan_evaluation", '1=1', 'project_plan_item');
        echo json_encode($row);
    }

    // บันทึกผลที่คาดว่าจะได้รับ
    public function project_plan_evaluation_add() {
        $id = $_POST['id'];
        if ($id != '') {
            $arr = array(
                'project_plan_kpi' => $this->input->post("inProjectPlanKpi"),
                'project_plan_evaluation' => $this->input->post("inProjectPlanEvaluation"),
                'project_plan_evaluation_tools' => $this->input->post("inProjectPlanEvaluationTools"),
            );
            $this->My_model->update_data("tb_project_plan_evaluation", array("id" => $id), $arr);
        } else {
            $arr = array(
                'project_id' => $this->input->post("project_id"),
                'project_plan_kpi' => $this->input->post("inProjectPlanKpi"),
                'project_plan_evaluation' => $this->input->post("inProjectPlanEvaluation"),
                'project_plan_evaluation_tools' => $this->input->post("inProjectPlanEvaluationTools"),
            );
            $this->My_model->insert_data("tb_project_plan_evaluation", $arr);
        }
    }

    // update project ;
    public function project_plan_evaluation_edit() {
        $id = $_POST['id'];
        $row = $this->My_model->get_where_row("tb_project_plan_evaluation", array("id" => $id));
        echo json_encode($row);
    }

    // delete project 
    public function project_plan_evaluation_delete() {
        $id = $_POST['id'];
        $this->My_model->delete_data("tb_project_plan_evaluation", array("id" => $id));
    }

    public function school() {
        $localgov = $this->session->userdata('localgov');

        $rs = $this->join2table_result->get('tb_project_school a', 'tb_school b', 'a.project_department = b.sc_thai_name', array('b.sc_localgov' => $localgov), 'project_department');
    
        
    }

    function project_planing() {
        $data['school_st'] = $this->My_model->get_where_order("tb_school_strategic",array('school_strategic_department'=>$this->session->userdata('department')), "school_strategic_no ASC");
        $data['localgov'] = $this->My_model->get_all_order("tb_localgov_strategic", "localgov_st_no ASC");
        $data['edu_st'] = $this->My_model->get_all_order("tb_education_strategic", "education_st_no ASC");
        $data['plan_type'] = $this->My_model->get_all_order("tb_localgov_plan_type", "localgov_plan_type ASC");
        $data['rs'] = $this->EducationPlan_model->get_personal_project_plan();
        
        $data['plan'] = $this->My_model->get_where_row('tb_project_plan',array('tb_project_plan_department'=>$this->session->userdata('department')));
        
        $this->load->view("layout/header");
        $this->load->view("project_plan/personal_project", $data);
        $this->load->view("layout/footer");
    }

}
