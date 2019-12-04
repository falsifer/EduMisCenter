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
        $this->load->model('EducationPlan_model');
    }

    //
    public function index() {
        $data['province'] = $this->My_model->get_all_order("tb_province_strategies", "strategies_no ASC");
        $data['localgov'] = $this->My_model->get_all_order("tb_localgov_strategies", "localgov_st_no ASC");
        $data['sub_st'] = $this->My_model->get_all_order("tb_localgov_sub_st", "sub_st_name ASC");
        $data['plan_type'] = $this->My_model->get_all_order("tb_localgov_plan_type", "localgov_plan_type ASC");
        $data['rs'] = $this->EducationPlan_model->get_project();
        $this->load->view("layout/header");
        $this->load->view("education_plan/index", $data);
        $this->load->view("layout/footer");
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

    // กำหนดแผนยุทธศาสตร์จังหวัด
    public function province_strategies() {
        $data['rs'] = $this->My_model->get_all_order("tb_province_strategies", "strategies_no asc");
        $this->load->view("layout/header");
        $this->load->view("education_plan/province_strategies", $data);
        $this->load->view("layout/footer");
    }

    // insert province strategies plan
    public function province_strategies_insert() {
        $id = $_POST['id'];
        $arr = array(
            "strategies_no" => $this->input->post('inProvinceStrategiesNo'),
            "strategies_name" => $this->input->post("inProvinceStrategiesName")
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
    public function localgov_strategies() {
        $data['rs'] = $this->My_model->get_all_order("tb_localgov_strategies", "localgov_st_no ASC");
        $this->load->view("layout/header");
        $this->load->view("education_plan/localgov_strategies", $data);
        $this->load->view("layout/footer");
    }

    // insert data;
    public function localgov_strategies_insert() {
        $id = $_POST['id'];
        $arr = array(
            "localgov_st_no" => $this->input->post("inLocalgovStNo"),
            "localgov_st_name" => $this->input->post("inLocalgovStName")
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

}
