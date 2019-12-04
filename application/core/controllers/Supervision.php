<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/*
  | ----------------------------------------------------------------------------
  |  Title ระบบตารางสำหรับโครงการ
  | ----------------------------------------------------------------------------
  | Copyright	Edutech Co.,Ltd.
  | Purpose
  | Author ภาวิณี ตรีหิรัญ
  | Create Date 25 Nov 2018
  | Last edit	-
  | Comment	-
  | ----------------------------------------------------------------------------
 */

Class Supervision extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('Supervision_model');
    }

    public function index() {
        // ตรวจสอบว่ากำหนดรายละเอียดของ อปท.หรือยัง
        $chk_org = $this->My_model->get_all('tb_organization');
        if (count($chk_org) == 0) {
            redirect("insert-organization");
        }
        //
        if ($this->session->userdata('status') == "ผู้ดูแลระบบ") {
            redirect("administrator");
        }

     
        $data['rs'] = $this->Supervision_model->get_all();
        $data['supervision'] = $this->Supervision_model->get_all();
        $data['division'] = $this->Supervision_model->get_division();
        $data['title'] = $this->Supervision_model->get_all_title();
        $data['school'] = $this->My_model->get_all_order("tb_school", "sc_code asc");
        $this->load->view("layout/header");
        $this->load->view("vichakarn/supervision", $data);
        $this->load->view("layout/footer");
    }

    public function get_all_title() {
        header('Content-Type: application/x-json; charset=utf-8');
        echo(json_encode($this->Supervision_model->get_all_title()));
    }

    public function get_title() {
        $id = $_POST['id'];
        $rs = $this->My_model->get_where_row('tb_supervision_title', array('id' => $id));
        echo json_encode($rs);
    }

    function get_title_view() {
        $id = $_POST['id'];
        $data['titleRS'] = $this->Supervision_model->get_sub_title_by_title($id);
        $this->load->view('vichakarn/supervision_title_view', $data);
    }

    // บันทึก
    public function supervision_issue_add() {
        $id = $_POST['id'];

        if ($id != "" || $id != 0) {

            $arr = array(
                "tb_division_id" => $this->input->post('inDivision'),
                "tb_supervision_issue_detail" => $this->input->post('inSupervisionIssueDetail')
            );

            $this->My_model->update_data('tb_supervision_issue', array('id' => $id), $arr);
        } else {
            $arr = array(
                "tb_division_id" => $this->input->post('inDivision'),
                "tb_supervision_issue_detail" => $this->input->post('inSupervisionIssueDetail'),
                "tb_supervision_issue_create_by" => $this->session->userdata("name")
            );
            $this->My_model->insert_data("tb_supervision_issue", $arr);
        }
    }

    // แก้ไขข้อมูล
    public function supervision_issue_edit() {
        $id = $_POST['id'];
        $rs = $this->My_model->get_where_row('tb_supervision_issue', array('id' => $id));
        echo json_encode($rs);
    }

    // ลบข้อมูล
    public function supervision_issue_delete() {
        $id = $_POST['id'];
        $this->My_model->delete_data('tb_supervision_issue', array('id' => $id));
    }

    public function supervision_subtitle_add() {
        $id = $_POST['id'];
        $arr = array(
            "tb_supervision_title_id" => $this->input->post('inSupervissionTitleId1'),
            "tb_supervision_sub_title_detail" => $this->input->post('inSupervisionSubTitleDetail'),
            "tb_supervision_sub_title_create_by" => $this->session->userdata("name")
        );
        if ($id != "" || $id != 0) {
            $this->My_model->update_data('tb_supervision_sub_title', array('id' => $id), $arr);
        } else {
            $this->My_model->insert_data("tb_supervision_sub_title", $arr);
        }
    }

    public function supervision_subtitle_edit() {
        $id = $_POST['id'];
        $rs = $this->My_model->get_where_row('tb_supervision_sub_title', array('id' => $id));
        echo json_encode($rs);
    }

    public function supervision_subtitle_delete() {
        $id = $_POST['id'];
        $rs = $this->My_model->delete_data('tb_supervision_sub_title', array('id' => $id));
    }

    public function get_supervision_form() {
        $id = $_POST['id'];

//        $this->session->unset_userdata('inSupervisionTitleType');
//        $this->session->unset_userdata('subtitle');
//        $this->session->set_userdata('subtitle',$this->Supervision_model->get_sub_title_by_title($id));
        $title = $this->Supervision_model->get_title($id);

        $data['subtitle'] = $this->Supervision_model->get_sub_title_by_title($id);
        $data['row'] = $id;
        $data['title'] = $title;
        if (count($title) > 0) {
//            $this->session->set_userdata('inSupervisionTitleType', $title[0]['tb_supervision_title_type']);
            $data['inSupervisionTitleType'] = $title[0]['tb_supervision_title_type'];
        }



        echo json_encode($data);
//       $this->load->view('modals/vichakarn/supervision_modal');
    }

    public function get_subtitle_form() {

        if (!isset($_POST['subtitle'])) {
            $data['subtitle'] = array();
        } else {
            $data['subtitle'] = $_POST['subtitle'];
        }
        $data['inSupervisionTitleType'] = $_POST['inSupervisionTitleType'];

        $this->load->view('vichakarn/supervision_rating_form', $data);

//         echo '<tr><td>55555</tr></tr>';
    }

    public function member() {
        if ($this->input->post('school')) {
            echo $this->Supervision_model->fetch_member($this->input->post('school'));
        }
    }

    public function supervision_rating_add() {
        $id = $_POST['id'];
        $inSubtitleId = $this->input->post('inSubtitleId');
        $supervision_by = $this->session->userdata("name");
        if (isset($_POST['member'])) {
            $supervision_for = $this->input->post('member');
        } else {
            $supervision_for = $this->input->post('inDepartment');
        }
        $n = 0;
        foreach ($inSubtitleId as $i) {
            $rating = $this->input->post('inSupervisionRating' . $i);
            $comment = $this->input->post('inSupervisionComment' . $i);
            $arr = array(
                'tb_supervision_sub_title_id' => $i,
                'tb_supervision_create_by' => $supervision_by,
                'tb_supervision_for' => $supervision_for,
                'tb_supervision_rating' => $rating,
                'tb_supervision_comment' => $comment);
            if ($id != "" || $id != 0) {
                $this->My_model->update_data("tb_supervision", array('id' => $id), $arr);
            } else {
                $this->My_model->insert_data("tb_supervision", $arr);
            }
            $n++;
        }
    }

    public function supervision_rating_edit() {
        $id = $_POST['id'];
        $rs = $this->My_model->get_where_row('tb_supervision', array('id' => $id));
        echo json_encode($rs);
    }

    public function supervision_rating_delete() {
        $id = $_POST['id'];
        $rs = $this->My_model->delete_data('tb_supervision', array('id' => $id));
    }
    
    public function report_view() {
        
    }
    
    public function form_view() {
        $data['form'] = $this->Supervision_model->get_supervision_form();
        $this->load->view('vichakarn/reports/supervision_form_print',$data);
    }

}
