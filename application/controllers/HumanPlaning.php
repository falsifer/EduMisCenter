<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/*
  | ----------------------------------------------------------------------------
  |  Title      HumanPlaning
  | ----------------------------------------------------------------------------
  | Copyright	Edutech Co.,Ltd.
  | Purpose     ข้อมูลการวางแผนอัตรากำลัง
  | Author	นายบัณฑิต ไชยดี
  | Create Date 02/01/2019
  | Last edit	-
  | Comment	-
  | ----------------------------------------------------------------------------
 */

class HumanPlaning extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('HumanPlaning_model');
    }

    //
    public function index() {
        // ตรวจสอบข้อมูลแผนงานที่ตรงกับปีงบประมาณปัจจุบัน (ที่วางแผน) มีข้อมูลแล้วหรือไม่
        $data['rs'] = $this->My_model->get_all_order('tb_hr_plan', 'begin_year asc');
        $this->load->view('layout/header');
        $this->load->view('human_planing/index', $data);
        $this->load->view('layout/footer');
    }

    #---------------+---------------------------------------------------------------
    #   Title       |   กำหนดปีงบประมาณสำหรับการจัดทำแผน 3 ปี
    #---------------+---------------------------------------------------------------
    #   Author      |   Mr.Hidemi Minakawa
    #   Date        |   January 04, 2019
    #   Last Update |   -
    #---------------+---------------------------------------------------------------

    public function hr_plan_add() {
        $id = $_POST['id'];
        $arr = array(
            'begin_year' => $this->input->post('inBeginYear'),
            'end_year' => $this->input->post('inEndYear'),
            'plan_comment' => $this->input->post('inPlanComment'),
            'plan_recorder' => $this->session->userdata('name'),
            'plan_department' => $this->session->userdata('department')
        );
        if ($id != '') {
            $this->My_model->update_data('tb_hr_plan', array('id' => $id), $arr);
        } else {
            $this->My_model->insert_data('tb_hr_plan', $arr);
        }
    }

    // ดึงข้อมูลปีงบประมาณมาแก้ไข
    public function hr_plan_edit() {
        $id = $_POST['id'];
        $row = $this->My_model->get_where_row('tb_hr_plan', array('id' => $id));
        echo json_encode($row);
    }

    // ลบข้อมูลปีงบประมาณ
    public function hr_plan_delete() {
        $id = $_POST['id'];
        $this->My_model->delete_data('tb_hr_plan', array('id' => $id));
    }

    #---------------+---------------------------------------------------------------
    #   Title       |   รายละเอียดกรอบอัตรากำลังระยะเวลา 3 ปี
    #---------------+---------------------------------------------------------------
    #   Author      |   Mr.Hidemi Minakawa
    #   Date        |   January 04, 2019
    #   Last Update |   -
    #---------------+---------------------------------------------------------------
    // หน้าหลักแสดงข้อมูลกรอบอัตรากำลัง 3 ปี

    public function hr_plan_detail($id) {
        if ($this->session->userdata('status') == '') {
            redirect('login');
        }
        $data['rank'] = $this->My_model->get_all_order('tb_rank', 'rank_name asc');
        $data['plan'] = $this->My_model->get_where_row('tb_hr_plan', array('id' => $id));
        $data['rs'] = $this->HumanPlaning_model->get_hr_plan_detail($id);
        $data['chart'] = $this->HumanPlaning_model->some_field_plan_detail();
        $this->load->view('layout/header');
        $this->load->view('human_planing/hr_plan_detail', $data);
        $this->load->view('layout/footer');
    }

    // บันทึกรายละเอียดการจัดทำแผนกรอบอัตรากำลัง 3 ปี
    public function hr_plan_detail_add() {
        $id = $_POST['id'];
        $result = ($this->input->post('inOldHr') + $this->input->post('inIncrease')) - $this->input->post('inDecrease');
        if ($id != '') {
            $arr = array(
                'rank_id' => $this->input->post('inRankId'),
                'plan_year' => $this->input->post('inPlanYear'),
                'level' => $this->input->post('inLevel'),
                'old_hr' => $this->input->post('inOldHr'),
                'increase' => $this->input->post('inIncrease'),
                'decrease' => $this->input->post('inDecrease'),
                'result' => $result,
                'comment' => $this->input->post('inComment')
            );
            $this->My_model->update_data('tb_hr_plan_detail', array('id' => $id), $arr);
        } else {
            $arr = array(
                'hr_plan_id' => $this->input->post('hr_plan_id'),
                'rank_id' => $this->input->post('inRankId'),
                'plan_year' => $this->input->post('inPlanYear'),
                'level' => $this->input->post('inLevel'),
                'old_hr' => $this->input->post('inOldHr'),
                'increase' => $this->input->post('inIncrease'),
                'decrease' => $this->input->post('inDecrease'),
                'result' => $result,
                'comment' => $this->input->post('inComment')
            );
            $this->My_model->insert_data('tb_hr_plan_detail', $arr);
        }
    }

    // ดึงข้อมูลรายละเอียดกรอบอัตรากำลังมาแสดง
    public function hr_plan_detail_edit() {
        $id = $_POST['id'];
        $row = $this->HumanPlaning_model->push_hr_plan_detail($id);
        echo json_encode($row);
    }

    // ลบรายละเอียดแผนกรอบอัตรากำลังฯ
    public function hr_plan_detail_delete() {
        $id = $_POST['id'];
        $this->My_model->delete_data('tb_hr_plan_detail', array('id' => $id));
    }

    // พิมพ์ข้อมูลแผนอัตรากำลัง
    public function hr_plan_detail_print($plan_id) {
        $data['year'] = $this->My_model->get_where_group_by('tb_hr_plan_detail', array('hr_plan_id' => $plan_id), 'plan_year');
        $data['rs'] = $this->HumanPlaning_model->get_hr_plan_detail($plan_id);
        $this->load->view('human_planing/reports/hr_plan_detail_print', $data);
    }

}
