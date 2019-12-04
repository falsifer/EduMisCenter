<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/*
  | ----------------------------------------------------------------------------
  |  Title      Vichakarn
  | ----------------------------------------------------------------------------
  | Copyright	Edutech Co.,Ltd.
  | Purpose     Vichakarn Controller (School Zone)
  | Author
  | Create Date
  | Last edit	-
  | Comment	-
  | ----------------------------------------------------------------------------
 */

Class Vichakarn extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model("Vichakarn_model");
        $this->load->model("Ed_Classroom_model");
        //$this->load->library('mpdf/mpdf');
    }

    // index
    public function index() {
        
    }

// -------------------งานวางแผนการศึกษาและปฏิทินปฏิบัติงานงานวางแผนการศึกษาและปฏิทินปฏิบัติงาน---------------------------------
    // หน้าจอหลักของงานวางแผนการศึกษาและปฏิทินปฏิบัติงานงานวางแผนการศึกษาและปฏิทินปฏิบัติงาน
    public function activity_plan() {
        if ($this->session->userdata("status") == "") {
            redirect('login');
        } else if ($this->session->userdata("status") == "ผู้ปฏิบัติงาน") {
            $monthly = date("Y-m-1");
            $monthly2 = date("Y-m-31");
            $this->db->where('tb_activity_plan_start_date >=', $monthly);
            $this->db->where('tb_activity_plan_end_date <=', $monthly2);
            $data['rs'] = $this->My_model->get_where_order("tb_activity_plan", array("tb_activity_plan_sub_department" => "ฝ่ายวิชาการ"), "tb_activity_plan_start_date asc");
            $monthly = date("Y-10-1");
            $monthly2 = date("Y-9-30", strtotime('+1 year'));
            $this->db->where('tb_activity_plan_start_date >=', $monthly);
            $this->db->where('tb_activity_plan_end_date <=', $monthly2);
            $data['rsY'] = $this->My_model->get_where_order("tb_activity_plan", array("tb_activity_plan_sub_department" => "ฝ่ายวิชาการ"), "tb_activity_plan_start_date asc");
            //กลับมาเพิ่มเงื่อนไขช่วงเวลาอีกที
            $this->load->view("layout/header");
            if ($this->session->userdata("department") == "กองการศึกษา") {
                $this->load->view("vichakarn/activity_plan", $data);
            } else {
                $this->load->view("vichakarn/school/activity_plan", $data);
            }
            
            $this->load->view('layout/footer');
        }
    }

    // บันทึก
    public function activity_plan_add() {
        $id = $_POST['id'];
        $arr = array(
            "tb_activity_plan_subject" => $this->input->post('inActivityPlanSubject'),
            "tb_activity_plan_type" => $this->input->post('inActivityPlanType'),
            "tb_activity_plan_detail" => $this->input->post('inActivityPlanDetail'),
            "tb_activity_plan_place" => $this->input->post('inActivityPlanPlace'),
            "tb_activity_plan_start_date" => $this->input->post('inActivityPlanStartDate'),
            "tb_activity_plan_end_date" => $this->input->post('inActivityPlanEndDate'),
            "tb_activity_plan_public" => $this->input->post('inActivityPlanPublic'),
            "tb_activity_plan_status" => 'A',
            "tb_activity_plan_create_date" => date('Y-m-d H:i:s'),
            "tb_activity_plan_responsible" => $this->session->userdata("responsible"),
            "tb_activity_plan_recorder" => $this->session->userdata("name"),
            "tb_activity_plan_department" => $this->session->userdata("department")
        );
        if ($id != "") {

            $arr = array(
                "tb_activity_plan_subject" => $this->input->post('inActivityPlanSubject'),
                "tb_activity_plan_type" => $this->input->post('inActivityPlanType'),
                "tb_activity_plan_detail" => $this->input->post('inActivityPlanDetail'),
                "tb_activity_plan_place" => $this->input->post('inActivityPlanPlace'),
                "tb_activity_plan_start_date" => $this->input->post('inActivityPlanStartDate'),
                "tb_activity_plan_end_date" => $this->input->post('inActivityPlanEndDate'),
                "tb_activity_plan_public" => $this->input->post('inActivityPlanPublic'),
                "tb_activity_plan_status" => $this->input->post('inActivityPlanStatus'),
                "tb_activity_plan_update_date" => date('Y-m-d H:i:s'),
                "tb_activity_plan_responsible" => $this->session->userdata("responsible"),
                "tb_activity_plan_update_by" => $this->session->userdata("name")
            );

            $this->My_model->update_data('tb_activity_plan', array('id' => $id), $arr);
        } else {
            $arr = array(
                "tb_activity_plan_subject" => $this->input->post('inActivityPlanSubject'),
                "tb_activity_plan_type" => $this->input->post('inActivityPlanType'),
                "tb_activity_plan_detail" => $this->input->post('inActivityPlanDetail'),
                "tb_activity_plan_place" => $this->input->post('inActivityPlanPlace'),
                "tb_activity_plan_start_date" => $this->input->post('inActivityPlanStartDate'),
                "tb_activity_plan_end_date" => $this->input->post('inActivityPlanEndDate'),
                "tb_activity_plan_public" => $this->input->post('inActivityPlanPublic'),
                "tb_activity_plan_status" => $this->input->post('inActivityPlanStatus'),
                "tb_activity_plan_create_date" => date('Y-m-d H:i:s'),
                "tb_activity_plan_responsible" => $this->session->userdata("responsible"),
                "tb_activity_plan_create_by" => $this->session->userdata("name")
            );
            $this->My_model->insert_data("tb_activity_plan", $arr);
        }
    }

    // แก้ไขข้อมูล
    public function activity_plan_edit() {
        $id = $_POST['id'];
        $rs = $this->My_model->get_where_row('tb_activity_plan', array('id' => $id));
        echo json_encode($rs);
    }

    // ลบข้อมูล
    public function activity_plan_delete() {
        $id = $_POST['id'];
        $this->My_model->delete_data('tb_activity_plan', array('id' => $id));
    }

    // --------------- สิ้นสุดงานวางแผนการศึกษาและปฏิทินปฏิบัติงาน ----------------------------------
    //-------------งานประกันคุณภาพ------------
    //----------หน้าจอหลัก--------------------
    public function school_qa_report() {

        $results = $this->Vichakarn_model->get_qa_chart();
        $data['chart_data'] = $results['chart_data'];
        $data['min_year'] = $results['min_year'];
        $data['max_year'] = $results['max_year'];
        $this->load->view("layout/header");
        $this->load->view("vichakarn/qa", $data);
        $this->load->view('layout/footer');
    }

    //----------หน้าผลการรายงาน-------------
    public function qa_standard() {
        
    }

    //--------------------------------------
    
    
    
    //--------------จัดการห้องเรียน------------
    
    public function ed_room() {
        if ($this->session->userdata('status') == '') {
            redirect('login');
        }
        $data['room'] = $this->Ed_Classroom_model->get_all();
        $this->load->view("layout/header");
        $this->load->view("vichakarn/school/room", $data);
        $this->load->view('layout/footer');
    }
    
       public function dc_index() {
           if ($this->session->userdata('status') == '') {
            redirect('login');
        }
        $data['course'] = $this->Ed_Classroom_model->get_course_mis();
        $this->load->view("layout/header");
        $this->load->view("vichakarn/school/development_course", $data);
        $this->load->view('layout/footer');
    }
    
    
    public function ed_evaluation() {
           if ($this->session->userdata('status') == '') {
            redirect('login');
        }
        //$data['course'] = $this->Ed__model->get_course_mis();
        $this->load->view("layout/header");
        $this->load->view("vichakarn/school/ed_evaluation"/*, $data*/);
        $this->load->view('layout/footer');
    }
    
    public function room_add() {
        $id = $this->input->post('id');
        $arr = array(
            "tb_classroom_class" => $this->input->post('inClassroomClass'),
            "tb_classroom_level" => $this->input->post('inClassroomLevel'),
            "tb_classroom_room" => $this->input->post('inClassroomRoom'),
            "tb_classroom_student_amount" => $this->input->post('inClassroomStudentAmount'),
            "tb_classroom_year" => $this->input->post('inClassroomYear'),
            "tb_ed_classroom_department" => $this->session->userdata("department"),
            "tb_ed_classroom_recoder" => $this->session->userdata("name")
        );
        if ($id != "") {
            $this->My_model->update_data('tb_ed_room', array('id' => $id), $arr);
        } else {
            $this->My_model->insert_data("tb_ed_room", $arr);
        }
    }
    
    public function room_edit() {
        $id = $this->input->post('id');
        $rs = $this->My_model->get_where_row('tb_ed_room', array('id' => $id));
        echo json_encode($rs);
    }
    
    public function ed_homeroom() {
        
        
           if ($this->session->userdata('status') == '') {
            redirect('login');
        }
        $data['hr'] = $this->Ed_Classroom_model->get_all_classroom();
        $this->load->view("layout/header");
        $this->load->view("vichakarn/school/homeroom", $data);
        $this->load->view('layout/footer');
    }
    
    public function ed_schedule(){
        if ($this->session->userdata('status') == '') {
            redirect('login');
        }
        $data['course'] = $this->Ed_Classroom_model->get_all_course();
        $data['room'] = $this->Ed_Classroom_model->get_all();
        $data['hr'] = $this->Ed_Classroom_model->get_all_classroom();
        $this->load->view("layout/header");
        $this->load->view("vichakarn/school/schedule", $data);
        $this->load->view('layout/footer');
    }


    //---------------------------------------
}
