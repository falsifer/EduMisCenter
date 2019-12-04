<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/*
  | ----------------------------------------------------------------------------
  |  Title--> eSchool
  | ----------------------------------------------------------------------------
  | Copyright	Edutech Co,Ltd.
  | Purpose     หน้าหลักโปรแกรม eSchool
  | Author	Mr.Hidemi Minakawa
  | Create Date
  | Last edit	-
  | Comment	-
  | ----------------------------------------------------------------------------
 */

class Eschool extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Eschool_model');
    }

    //
    public function index() {
        $chk_org = $this->My_model->get_row("tb_organization");
        if (empty($chk_org)) {
            redirect("insert-organization");
        }

        //
        if ($this->session->userdata('status') == "ผู้ดูแลระบบ") {
            redirect("administrator");
        } else {
            if ($this->session->userdata("department") == "กองการศึกษา") {
                redirect('education-department-zone', $data);
            } else {
                redirect('school-department-zone', $data);
            }
        }
        /*
          $monthly = date("Y-m-1");
          $monthly2 = date("Y-m-31");
          $this->db->where('tb_activity_plan_start_date >=', $monthly);
          $this->db->where('tb_activity_plan_end_date <=', $monthly2);
          $data['rs'] = $this->My_model->get_where_order("tb_activity_plan", array("tb_activity_plan_responsible" =>$this->session->userdata("responsible")), "tb_activity_plan_start_date asc");
          $monthly = date("Y-10-1");
          $monthly2 = date("Y-9-30", strtotime('+1 year'));
          $this->db->where('tb_activity_plan_start_date >=', $monthly);
          $this->db->where('tb_activity_plan_end_date <=', $monthly2);
          $data['rsY'] = $this->My_model->get_where_order("tb_activity_plan", array("tb_activity_plan_responsible" => $this->session->userdata("responsible")), "tb_activity_plan_start_date asc");
          $this->load->view("layout/header");
          $this->load->view("eschool",$data);
          $this->load->view("layout/footer");
         * 
         */
    }

    // Education Department
    public function education_zone() {
        if ($this->session->userdata('status') == '') {
            redirect('login');
        }
        //
        $data['vichakarn']=$this->Eschool_model->get_menu('วิชาการ');
        $data['management']=$this->Eschool_model->get_menu('บริหารงานทั่วไป');
        $data['human']=$this->Eschool_model->get_menu('บุคลากร');
        $data['loan']=$this->Eschool_model->get_menu('งบประมาณ');
        // งานประชาสัมพันธ์
        $data['advertising']=$this->My_model->get_all_order('tb_public_relations','pr_date desc');
        //
        $data['school'] = $this->My_model->get_all_order("tb_school", 'sc_thai_name asc');
        $data['inbox'] = $this->My_model->get_where_order('tb_edoc_inbox', array('inbox_department' => $this->session->userdata('department')), 'inbox_date desc');
        $data['outbox'] = $this->My_model->get_where_order('tb_edoc_outbox', array('outbox_department' => $this->session->userdata('department')), 'outbox_date desc');
 
$monthly = date("Y-m-1");
          $monthly2 = date("Y-m-31");
          $this->db->where('tb_activity_plan_start_date >=', $monthly);
          $this->db->where('tb_activity_plan_end_date <=', $monthly2);
          $data['rsAct'] = $this->My_model->get_where_order("tb_activity_plan", array("tb_activity_plan_responsible" =>$this->session->userdata("responsible")), "tb_activity_plan_start_date asc");
          $monthly = date("Y-10-1");
          $monthly2 = date("Y-9-30", strtotime('+1 year'));
          $this->db->where('tb_activity_plan_start_date >=', $monthly);
          $this->db->where('tb_activity_plan_end_date <=', $monthly2);
          $data['rsActY'] = $this->My_model->get_where_order("tb_activity_plan", array("tb_activity_plan_responsible" => $this->session->userdata("responsible")), "tb_activity_plan_start_date asc");
          

       $this->load->view("layout/header");
        $this->load->view("education_zone", $data);
        $this->load->view("layout/footer");
    }

    // School department
    public function school_zone() {
        if ($this->session->userdata('status') == '') {
            redirect('login');
        }
        $data['vichakarn']=$this->Eschool_model->get_menu('วิชาการ');
        $data['management']=$this->Eschool_model->get_menu('บริหารงานทั่วไป');
        $data['human']=$this->Eschool_model->get_menu('บุคลากร');
        $data['loan']=$this->Eschool_model->get_menu('งบประมาณ');
        // งานประชาสัมพันธ์
        $data['advertising']=$this->My_model->get_all_order('tb_public_relations','pr_date desc');
        //
        $data['school'] = $this->My_model->get_all_order("tb_school", 'sc_thai_name asc');
        $data['inbox'] = $this->My_model->get_where_order('tb_edoc_inbox', array('inbox_department' => $this->session->userdata('department')), 'inbox_date desc');
        $data['outbox'] = $this->My_model->get_where_order('tb_edoc_outbox', array('outbox_department' => $this->session->userdata('department')), 'outbox_date desc');
        $data['rs'] = array();
        $this->load->view("layout/header");
        $this->load->view("school_zone", $data);
        $this->load->view("layout/footer");
    }

    //
}
