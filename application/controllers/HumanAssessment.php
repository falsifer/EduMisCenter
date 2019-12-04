<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/*
  | ----------------+-----------------------------------------------------------
  |  Title          |   Human Assessment
  | ----------------+-----------------------------------------------------------
  |  Copyright      |   Edutech Co.,Ltd.
  |  Purpose        |   การประเมินผลครูและบุคลากรทางการศึกษา
  |  Author         |   นายบัณฑิต ไชยดี
  |  Create Date    |   04-01-2019
  |  Last edit      |   -
  |  Comment        |   -
  | ----------------+-----------------------------------------------------------
 */

class HumanAssessment extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('HumanAssessment_model');
    }

    //
    public function index() {
        // ผู้บริหาร
        $data['management'] = $this->My_model->join2table_where_result('tb_human_resources_type a', 'tb_human_resources_01 b', 'b.hr_type_id = a.id', array('a.human_resources_type' => 'ผู้บริหาร', 'b.hr_department' => $this->session->userdata('department')), 'b.hr_thai_name asc');
        // บุคลากรทางการศึกษา
        $data['employee'] = $this->My_model->join2table_where_result('tb_human_resources_type a', 'tb_human_resources_01 b', 'b.hr_type_id = a.id', array('a.human_resources_type' => 'บุคลากรทางการศึกษา', 'b.hr_department' => $this->session->userdata('department')), 'b.hr_thai_name asc');
        //
        $data['rs'] = array();
        $this->load->view('layout/header');

        if ($this->session->userdata('department') != "กองการศึกษา") {
            // ครูผู้สอน
            $data['teacher'] = $this->My_model->join2table_where_result('tb_human_resources_type a', 'tb_human_resources_01 b', 'b.hr_type_id = a.id', array('a.human_resources_type' => 'ครูผู้สอน'), 'b.hr_thai_name asc');

            $this->load->view('human_assessment/school', $data);
        } else {
            // ศึกษานิเทศ
            $data['supervision'] = $this->My_model->join2table_where_result('tb_human_resources_type a', 'tb_human_resources_01 b', 'b.hr_type_id = a.id', array('a.human_resources_type' => 'ศึกษานิเทศ', 'b.hr_department' => $this->session->userdata('department')), 'b.hr_thai_name asc');

            $this->load->view('human_assessment/index', $data);
        }
        $this->load->view('layout/footer');
    }

    #---------------+---------------------------------------------------------------
    #   Title       |   กำหนดกลุ่มรายการประเมินหลัก
    #---------------+---------------------------------------------------------------
    #   Author      |   Mr.Hidemi Minakawa
    #   Date        |   6 มกราคม 2019
    #   Last Update |   -
    #---------------+---------------------------------------------------------------
    //    
    // กลุ่มรายการประเมินผลการปฏิบัติงาน

    public function assessment_group() {
        $data['rs'] = $this->My_model->get_all_order('tb_human_assessment_group', 'id asc');
        $this->load->view('layout/header');
        $this->load->view('human_assessment/assessment_group', $data);
        $this->load->view('layout/footer');
    }

    // บันทึกกลุ่มรายการประเมินผลการปฏิบัติงาน
    public function assessment_group_add() {
        $id = $_POST['id'];
        $arr = array(
            'assessment_group_name' => $this->input->post('inHumanAssessmentGroup')
        );
        if ($id != '') {
            $this->My_model->update_data('tb_human_assessment_group', array('id' => $id), $arr);
        } else {
            $this->My_model->insert_data('tb_human_assessment_group', $arr);
        }
    }

    // ดึงข้อมูลมาแก้ไข
    public function assessment_group_edit() {
        $id = $_POST['id'];
        $row = $this->My_model->get_where_row('tb_human_assessment_group', array('id' => $id));
        echo json_encode($row);
    }

    // ลบข้อมูลกลุ่มรายการประเมินฯ
    public function assessment_group_delete() {
        $id = $_POST['id'];
        $this->My_model->delete_data('tb_human_assessment_group', array('id' => $id));
    }

    #---------------+---------------------------------------------------------------
    #   Title       |   กำหนดกลุ่มรายการประเมินย่อย
    #---------------+---------------------------------------------------------------
    #   Author      |   Mr.Hidemi Minakawa
    #   Date        |   6 มกราคม 2019
    #   Last Update |   -
    #---------------+---------------------------------------------------------------

    //
    public function assessment_topic($id) {
        $data['group'] = $this->My_model->get_where_row('tb_human_assessment_group', array('id' => $id));
        $data['rs'] = $this->HumanAssessment_model->get_human_assessment_topic($id);
        $this->load->view('layout/header');
        $this->load->view('human_assessment/assessment_topic', $data);
        $this->load->view('layout/footer');
    }

    // insert data;
    public function assessment_topic_add() {
        $id = $_POST['id'];
        if ($id != '') {
            $arr = array(
                'assessment_topic_name' => $this->input->post('inAssessmentTopicName'),
                'assessment_topic_score' => $this->input->post('inAssessmentTopicScore')
            );
            $this->My_model->update_data('tb_human_assessment_topic', array('id' => $id), $arr);
        } else {
            $arr = array(
                'group_id' => $this->input->post('group_id'),
                'assessment_topic_name' => $this->input->post('inAssessmentTopicName'),
                'assessment_topic_score' => $this->input->post('inAssessmentTopicScore')
            );
            $this->My_model->insert_data('tb_human_assessment_topic', $arr);
        }
    }

    // push data for edit
    public function assessment_topic_edit() {
        $id = $_POST['id'];
        $row = $this->HumanAssessment_model->human_assessment_edit($id);
        echo json_encode($row);
    }

    // delete data;
    public function assessment_topic_delete() {
        $id = $_POST['id'];
        $this->My_model->delete_data('tb_human_assessment_topic', array('id' => $id));
    }

    #---------------+---------------------------------------------------------------
    #   Title       |   รายละเอียดการประเมินผลการปฏิบัติงาน
    #---------------+---------------------------------------------------------------
    #   Author      |   Mr.Hidemi Minakawa
    #   Date        |   6 มกราคม 2019
    #   Last Update |   -
    #---------------+---------------------------------------------------------------

    //
    public function assessment_activities($hr_id) {

        $data['assessment_group'] = $this->My_model->get_all_order('tb_human_assessment_group', 'id asc'); // กลุ่มการประเมิน
        $data['hr'] = $this->My_model->get_where_row('tb_human_resources_01', array('id' => $hr_id)); // ผู้ถูกประเมิน
        $data['total_score'] = $this->My_model->sum_where('tb_human_assessment_activities', 'assessment_score', array('hr_id' => $hr_id)); // นับคะแนนรวม

        $this->load->view('layout/header');
        $this->load->view('human_assessment/assessment_activities', $data);
        $this->load->view('layout/footer');
    }

    // insert data;
    public function assessment_activities_add() {
        $hr_id = $_POST['hr_id'];
        $append_name = $_POST['append_name'];
        $status = $this->input->post('status');
        $id = $_POST['id'];
        if ($status == 'ปรับปรุงข้อมูล') {
            $arr = array(
                'assessment_topic_id' => $this->input->post('assessment_topic_id'),
                'assessment_score' => $this->input->post('inAssessmentScore' . $append_name)
            );
            $this->My_model->update_data('tb_human_assessment_activities', array('id' => $id), $arr);
        } else {
            $arr = array(
                'hr_id' => $this->input->post('hr_id'),
                'assessment_topic_id' => $this->input->post('assessment_topic_id'),
                'assessment_score' => $this->input->post('inAssessmentScore' . $append_name)
            );
            $this->My_model->insert_data('tb_human_assessment_activities', $arr);
        }
        redirect($this->input->post('current_page'));
    }

    // ลบข้อมูลการประเมิน
    public function assessment_activities_delete() {
        $id = $_POST['id'];
        $this->My_model->delete_data('tb_human_assessment_activities', array('id' => $id));
    }

    // พิมพ์ข้อมูล
    public function assessment_activities_print($hr_id) {
        $data['assessment_group'] = $this->My_model->get_all_order('tb_human_assessment_group', 'id asc'); // กลุ่มการประเมิน
        $data['hr'] = $this->My_model->get_where_row('tb_human_resources_01', array('id' => $hr_id)); // ผู้ถูกประเมิน
        $data['total_score'] = $this->My_model->sum_where('tb_human_assessment_activities', 'assessment_score', array('hr_id' => $hr_id)); // นับคะแนนรวม
        //
        $this->load->view('human_assessment/reports/human_assessment_report', $data);
    }

    // พิมพ์แบบฟอร์มสำหรับการประเมิน
    public function assessment_activites_form_print($hr_id) {
        $data['type'] = 'แบบฟอร์ม';
        $data['assessment_group'] = $this->My_model->get_all_order('tb_human_assessment_group', 'id asc'); // กลุ่มการประเมิน
        $data['hr'] = $this->My_model->get_where_row('tb_human_resources_01', array('id' => $hr_id)); // ผู้ถูกประเมิน
        $this->load->view('human_assessment/reports/human_assessment_report', $data);
    }

}
