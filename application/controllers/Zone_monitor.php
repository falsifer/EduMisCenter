<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/*
  | ----------------------------------------------------------------------------
  |  Title
  | ----------------------------------------------------------------------------
  | Copyright	Edutech Co.,Ltd.
  | Purpose
  | Author      Chairatto
  | Create Date 19/8/2562
  | Last edit	19/8/2562
  | Comment	-
  | ----------------------------------------------------------------------------
 */

Class Zone_monitor extends CI_Controller {

    public function __construct() {
        parent::__construct();
        if ($this->session->userdata('status') == "") {
            redirect("/");
        }
        $this->load->model("My_model");
        $this->load->model("Chairatto_model");
    }

    public function bd_base_zone_view() {
        $school_list = $this->My_model->get_where_order('tb_school', array('school_type_id' => 3), 'id asc');
        $output = "";
        $output .= "<option value=''>----เลือกข้อมูล----</option>";
        foreach ($school_list as $s) {
            $output .= "<option value='" . $s['id'] . "'>" . $s['sc_thai_name'] . "</option>";
        }
        $data['school_list'] = $output;


        $building = $this->My_model->get_where_order('tb_building', array('tb_school_id !=' => ""), 'bd_value asc');
        $output = "";
        $i = 1;
        foreach ($building as $r) {
            $output .= "<tr>";
            $output .= "<td style='text-align:center;'>" . $i . "</td>";
            $output .= "<td style='text-align:center;'>" . $r['bd_type'] . "</td>";
            $output .= "<td style='text-align:center;'>" . $r['bd_detail'] . "</td>";
            $output .= "<td style='text-align:center;'>" . $r['bd_room'] . "</td>";
            $output .= "<td style='text-align:center;'>" . $r['bd_value'] . "</td>";
            $output .= "<td style='text-align:center;'>" . $r['bd_year'] . "</td>";
            $output .= "<td style='text-align:center;'>" . $r['bd_status'] . "</td>";
            $school = $this->Chairatto_model->select_column_where('tb_school', array('id' => $r['tb_school_id']), 'sc_thai_name');
            $output .= "<td style='text-align:center;'>" . $school[0]['sc_thai_name'] . "</td>";
            $output .= "</tr>";
            $i++;
        }
        $data['tbody'] = $output;
        $this->load->view("layout/header");
        $this->load->view("building/bd_base_zone_view", $data);
        $this->load->view("layout/footer");
    }

    public function bd_base_zone_view_by_school_id() {
        $school_id = $this->input->post('id');
        $building = $this->My_model->get_where_order('tb_building', array('tb_school_id' => $school_id), 'bd_value asc');
        $output = "";
        $i = 1;
        foreach ($building as $r) {
            $output .= "<tr>";
            $output .= "<td style='text-align:center;'>" . $i . "</td>";
            $output .= "<td style='text-align:center;'>" . $r['bd_type'] . "</td>";
            $output .= "<td style='text-align:center;'>" . $r['bd_detail'] . "</td>";
            $output .= "<td style='text-align:center;'>" . $r['bd_room'] . "</td>";
            $output .= "<td style='text-align:center;'>" . $r['bd_value'] . "</td>";
            $output .= "<td style='text-align:center;'>" . $r['bd_year'] . "</td>";
            $output .= "<td style='text-align:center;'>" . $r['bd_status'] . "</td>";
            $school = $this->Chairatto_model->select_column_where('tb_school', array('id' => $r['tb_school_id']), 'sc_thai_name');
            $output .= "<td style='text-align:center;'>" . $school[0]['sc_thai_name'] . "</td>";
            $output .= "</tr>";
            $i++;
        }
        echo $output;
    }

    public function hr07_zone_view() {
        if ($this->session->userdata('department') != "กองการศึกษา") {
            $human = $this->My_model->get_where_order('tb_human_resources_01', array('hr_department' => $this->session->userdata('department')), 'hr_rank desc');
        } else {
            $human = $this->My_model->get_all_order('tb_human_resources_01', 'hr_department asc');
        }

        $output = "";
        $i = 1;
        foreach ($human as $r) {
            $output .= "<tr id='" . $r['id'] . "' onclick='SelectThisTr(this)'>";
            $output .= "<td style='text-align:center;'>" . $i . "</td>";
            $output .= "<td style='text-align:center;'>" . $r['hr_thai_symbol'] . $r['hr_thai_name'] . " " . $r['hr_thai_lastname'] . "</td>";
            $output .= "<td style='text-align:center;'>" . $r['hr_rank'] . "</td>";

//            $hour = $this->Chairatto_model->select_sum_where('tb_human_resources_07', array('hr_id' => $r['id']), 'hr07_hour');
            $hr07 = $this->My_model->get_where_order('tb_human_resources_07', array('hr_id' => $r['id']), 'id asc');
            $count = count($hr07);
            $sum = 0;

            foreach ($hr07 as $h7) {
                $sum += $h7['hr07_hour'];
            }

            $output .= "<td style='text-align:center;'>" . $count . "</td>";
            $output .= "<td style='text-align:center;'>" . $sum . "</td>";
            $output .= "<td style='text-align:center;'>" . $r['hr_department'] . "</td>";
            $output .= "</tr>";
            $i++;
        }
        $data['tbody'] = $output;
        $this->load->view("layout/header");
        $this->load->view("human_resources/hr07_zone_view", $data);
        $this->load->view("layout/footer");
    }

    public function hr07_zone_view_modal() {
        $id = $this->input->post('id');
        $hr07 = $this->My_model->get_where_order('tb_human_resources_07', array('hr_id' => $id), 'id asc');
        $output = "";
        $count = count($hr07);
        $sum = 0;
        $i = 1;
        foreach ($hr07 as $h7) {
            $output .= "<legend>" . $i . ". " . $h7['hr07_topic'] . "</legend>";
            $output .= "<p>รายละเอียด : " . $h7['hr07_detail'] . "</p>";
            $output .= "<p>ระยะเวลา <font style='font-weight:bold;' color='blue'>" . $h7['hr07_day'] . "</font> วัน จำนวน : <font style='font-weight:bold;' color='blue'>" . $h7['hr07_hour'] . "</font> ชั่วโมง</p>";
            $output .= "<hr/>";
            $i++;
        }

        echo $output;
    }

}
