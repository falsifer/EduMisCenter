<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/*
  | ----------------------------------------------------------------------------
  |  Title
  | ----------------------------------------------------------------------------
  | Copyright	Edutech Co.,Ltd.
  | Purpose
  | Author      chairatto
  | Create Date 22/7/2019
  | Last edit	22/7/2019
  | Comment	-
  | ----------------------------------------------------------------------------
 */

Class Classroom_online extends CI_Controller {

    public function __construct() {
        parent::__construct();
        if ($this->session->userdata('status') == "") {
            redirect("/");
        }
//        aaa();
        $this->load->model("My_model");
        $this->load->model("Std_model");
        $this->load->model("Classroom_online_model");
    }

    public function classroom_online_base() {

//        $g
//                  $owner_course_id = $this->input->get('own_id');
        $owner_course_id = 1732;
        $data['row'] = $this->My_model->get_where_order('tb_classroom_online', array('tb_course_detail_id' => $owner_course_id), 'id asc');
        $this->load->view("layout/header");
        $this->load->view("classroom_online/classroom_online_base", $data);
        $this->load->view("layout/footer");
    }

    public function classroom_online_room_base() {
        $classroom_online_id = $this->input->get('class_room_id');
        $data['row'] = $this->My_model->get_where_order('tb_classroom_online_member', array('tb_classroom_online_id' => $classroom_online_id), 'id asc');
        $data['classroom_online'] = $this->My_model->get_where_row('tb_classroom_online', array('id' => $this->input->get('class_room_id')));
        $this->load->view("layout/header");
        $this->load->view("classroom_online/classroom_online_room_base", $data);
        $this->load->view("layout/footer");
    }

    public function classroom_online_member_base() {
        $data['classroom_online'] = $this->My_model->get_where_row('tb_classroom_online', array('id' => $this->input->get('class_room_id')));
//        $data['member_list'] = $this->My_model->get_where_order('tb_classroom_online_member', array('tb_classroom_online_id' => $this->input->get('class_room_id')), 'id asc');
        $data['member_list'] = $this->Classroom_online_model->get_std_base_w_classroom_online_id($this->input->get('class_room_id'));

        $this->load->view("layout/header");
        $this->load->view("classroom_online/classroom_online_member_base", $data);
        $this->load->view("layout/footer");
    }

    public function classroom_online_work_base() {
        $data['classroom_online'] = $this->My_model->get_where_row('tb_classroom_online', array('id' => $this->input->get('class_room_id')));
        $data['work_list'] = $this->My_model->get_where_order('tb_classroom_online_work', array('tb_classroom_online_id' => $this->input->get('class_room_id')), 'tb_classroom_online_work_startdate asc');
        $this->load->view("layout/header");
        $this->load->view("classroom_online/classroom_online_work_base", $data);
        $this->load->view("layout/footer");
    }

    public function classroom_online_assignment_base() {
        $data['classroom_online'] = $this->My_model->get_where_row('tb_classroom_online', array('id' => $this->input->get('class_room_id')));
        $data['work_list'] = $this->My_model->get_where_order('tb_classroom_online_work', array('tb_classroom_online_id' => $this->input->get('class_room_id')), 'tb_classroom_online_work_startdate asc');
        $this->load->view("layout/header");
        $this->load->view("classroom_online/classroom_online_assignment_base", $data);
        $this->load->view("layout/footer");
    }

    public function classroom_online_work_insert() {
        $id = $this->input->post('id');
        $class_id = $this->input->post('classroom_online_id');

        $total = count($_FILES['inClassroomOnlineWorkFile']['name']);
        $file = "";
        for ($i = 0; $i < $total; $i++) {

            $_FILES['file']['name'] = $_FILES['inClassroomOnlineWorkFile']['name'][$i];
            $_FILES['file']['type'] = $_FILES['inClassroomOnlineWorkFile']['type'][$i];
            $_FILES['file']['tmp_name'] = $_FILES['inClassroomOnlineWorkFile']['tmp_name'][$i];
            $_FILES['file']['error'] = $_FILES['inClassroomOnlineWorkFile']['error'][$i];
            $_FILES['file']['size'] = $_FILES['inClassroomOnlineWorkFile']['size'][$i];

            $uploadPath = classroom_online_path($class_id, $this->session->userdata('sch_id'));

            $config = array(
                "upload_path" => $uploadPath,
                "allowed_types" => "*",
                "max_size" => 0,
//                "file_name" => md5(date("YmdHis"))
            );

            $this->upload->initialize($config);
            $this->upload->do_upload('file');
            $data = $this->upload->data();
            if ($i > 0) {
                $file .= "," . $data['file_name'];
            } else {
                $file .= $data['file_name'];
            }
        }

        $arr = array(
            "tb_classroom_online_id" => $class_id,
            "tb_classroom_online_work_name" => $this->input->post('inClassroomOnlineWorkName'),
            "tb_classroom_online_work_detail" => $this->input->post('inClassroomOnlineWorkDetail'),
            "tb_classroom_online_work_type" => $this->input->post('inClassroomOnlineWorkType'),
            "tb_classroom_online_work_startdate" => $this->input->post('inClassroomOnlineWorkStartdate'),
            "tb_classroom_online_work_enddate" => $this->input->post('inClassroomOnlineWorkEnddate'),
            "tb_classroom_online_work_file" => $file,
            "tb_classroom_online_work_recorder" => $this->session->userdata('name'),
            "tb_classroom_online_work_department" => $this->session->userdata('department'),
            "tb_classroom_online_work_createdate" => date('Y-m-d')
        );

        if ($id != "") {
            $this->My_model->update_data('tb_classroom_online_work', array('id' => $id), $arr);
        } else {
            $this->My_model->insert_data('tb_classroom_online_work', $arr);
        }
    }

    public function classroom_online_work_edit() {
        $id = $_POST['id'];
        echo json_encode($this->My_model->get_where_row("tb_classroom_online_work", array("id" => $id)));
    }

    public function classroom_online_work_delete() {
        $id = $_POST['id'];
        $this->My_model->delete_data("tb_classroom_online_work", array("id" => $id));
    }

    public function classroom_online_member_list() {
        $id = $_POST['id'];

        $StdArr = $this->Std_model->get_std_base_w_roomid_return_array($id);
        $output = "";
        foreach ($StdArr as $r) {
            $output .= "<tr>";
            $output .= "<td style=\"text-align:center;\">" . $r['std_number'] . "</td>";
            $output .= "<td style=\"text-align:center;\">" . $r['std_code'] . "</td>";
            $output .= "<td style=\"text-align:center;\">" . $r['std_fullname'] . "</td>";
            $output .= "<td style=\"text-align: center;\">";
            $output .= "&nbsp;<button type=\"button\" class=\"btn btn-info\" onclick=\"InviteThis(" . $r['std_member_id'] . ")\" ><i class=\"icon-plus icon-large\"></i> เลือก(นักเรียน)</button>";
            $output .= "</td>";
            $output .= "</tr>";
        }
        echo $output;
    }

    public function classroom_online_member_invite() {
        $classroom_id = $this->input->post('classroom_id');
        $member_id = $this->input->post('member_id');

        $arr = array(
            "tb_classroom_online_id" => $classroom_id,
            "tb_member_id" => $member_id,
            "tb_classroom_online_member_type" => "Student",
            "tb_classroom_online_member_status" => "TRUE",
            "tb_classroom_online_member_recorder" => $this->session->userdata('name'),
            "tb_classroom_online_member_department" => $this->session->userdata('department'),
            "tb_classroom_online_member_createdate" => date('Y-m-d')
        );
        $this->My_model->insert_data('tb_classroom_online_member', $arr);
    }

    public function classroom_online_member_insert() {
        $id = $this->input->post('id');

        $arr = array(
            "tb_classroom_online_member_nickname" => $this->input->post('inClassroomOnlineMemberNickname'),
            "tb_classroom_online_member_type" => $this->input->post('inClassroomOnlineMemberType'),
            "tb_classroom_online_member_status" => $this->input->post('inClassroomOnlineMemberStatus'),
        );
        $this->My_model->update_data('tb_classroom_online_member', array('id' => $id), $arr);
    }

    public function classroom_online_member_edit() {
        $id = $_POST['id'];
        echo json_encode($this->My_model->get_where_row("tb_classroom_online_member", array("id" => $id)));
    }

    public function classroom_online_member_delete() {
        $id = $_POST['id'];
        $this->My_model->delete_data("tb_classroom_online_member", array("id" => $id));
    }

    public function classroom_online_assignment_assign() {
        $work_id = $_POST['id'];
        $classroom_id = $_POST['classroom_id'];

        $member_list = $this->My_model->get_where_order('tb_classroom_online_member', array('tb_classroom_online_id' => $classroom_id), 'id asc');

        $output = "";
        foreach ($member_list as $m) {
            $r = $this->My_model->get_where_row('tb_student_base', array('tb_member_id' => $m['tb_member_id']));

            $output .= "<tr>";
            $output .= "<td style=\"text-align:center;\">" . $r['std_code'] . "</td>";
            $output .= "<td style=\"text-align:center;\">" . $r['std_titlename'] . $r['std_firstname'] . " " . $r['std_lastname'] . "</td>";
            $output .= "<td style=\"text-align:center;\">" . $r['std_nickname'] . "</td>";

            $output .= "<td style=\"text-align: center;\">";

            $check = $this->My_model->get_where_row('tb_classroom_online_work_assignment', array('tb_member_id' => $m['tb_member_id'], 'tb_classroom_online_work_id' => $work_id));
            if (isset($check['id'])) {
                $output .= "<font color='grey'>ได้รับมอบหมายแล้ว</font>&nbsp;<span class='pull-right' style='color:red;'><button type=\"button\" class=\"btn btn-link\" onclick=\"ClearThisAssignMember(" . $check['id'] . ")\" ><i class=\"icon-remove icon-large\"></i></button></span>";
            } else {
                $output .= "&nbsp;<button type=\"button\" class=\"btn btn-info\" onclick=\"AssignThisMember(" . $r['tb_member_id'] . ")\" ><i class=\"icon-check icon-large\"></i> มอบหมายงาน</button>";
            }

            $output .= "</td>";
            $output .= "</tr>";
        }
        echo $output;
    }

    public function classroom_online_assignment_assign_member() {
        $work_id = $_POST['work_id'];
        $id = $_POST['id'];

        $arr = array(
            "tb_classroom_online_work_id" => $work_id,
            "tb_member_id" => $id,
            "tb_classroom_online_work_assignment_status" => "Waiting",
            "tb_classroom_online_work_assignment_recorder" => $this->session->userdata('name'),
            "tb_classroom_online_work_assignment_department" => $this->session->userdata('department'),
            "tb_classroom_online_work_assignment_createdate" => date('Y-m-d')
        );
        $this->My_model->insert_data('tb_classroom_online_work_assignment', $arr);
    }

    public function classroom_online_assignment_clear_assign_member() {
        $id = $_POST['id'];
        $this->My_model->delete_data("tb_classroom_online_work_assignment", array("id" => $id));
    }

    public function classroom_online_member_registered() {
      
        $classroom_id = $_POST['classroom_id'];
        $member_list = $this->My_model->get_where_order('tb_classroom_online_member', array('tb_classroom_online_id' => $classroom_id), 'id asc');

        $output = "";
        foreach ($member_list as $m) {
            $r = $this->My_model->get_where_row('tb_student_base', array('tb_member_id' => $m['tb_member_id']));

            $output .= "<tr>";
            $output .= "<td style=\"text-align:center;\">" . $r['std_code'] . "</td>";
            $output .= "<td style=\"text-align:center;\">" . $r['std_titlename'] . $r['std_firstname'] . " " . $r['std_lastname'] . "</td>";
            $output .= "<td style=\"text-align:center;\">" . $r['std_nickname'] . "</td>";

            $output .= "<td style=\"text-align: center;\">";

            $check = $this->My_model->get_where_row('tb_classroom_online_work_assignment', array('tb_member_id' => $m['tb_member_id'], 'tb_classroom_online_work_id' => $work_id));
            if (isset($check['id'])) {
                $output .= "<font color='grey'>ได้รับมอบหมายแล้ว</font>&nbsp;<span class='pull-right' style='color:red;'><button type=\"button\" class=\"btn btn-link\" onclick=\"ClearThisAssignMember(" . $check['id'] . ")\" ><i class=\"icon-remove icon-large\"></i></button></span>";
            } else {
                $output .= "&nbsp;<button type=\"button\" class=\"btn btn-info\" onclick=\"AssignThisMember(" . $r['tb_member_id'] . ")\" ><i class=\"icon-check icon-large\"></i> มอบหมายงาน</button>";
            }

            $output .= "</td>";
            $output .= "</tr>";
        }
        echo $output;
    }

}
