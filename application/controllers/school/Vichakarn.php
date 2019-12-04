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
        if ($this->session->userdata('status') == '') {
            redirect('/');
        }
        $this->load->model("My_model");
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
            redirect('/');
        } else if ($this->session->userdata("status") == "ผู้ปฏิบัติงาน") {
            $monthly = date("Y-m-1");
            $monthly2 = date("Y-m-31");
            $this->db->where('tb_activity_plan_start_date >=', $monthly);
            $this->db->where('tb_activity_plan_end_date <=', $monthly2);
            $data['rs'] = $this->My_model->get_where_order("tb_activity_plan", array("tb_activity_plan_responsible" => "งานวิชาการ", "tb_activity_plan_department" => $this->session->userdata('department')), "tb_activity_plan_start_date asc");
            $monthly = date("Y-10-1");
            $monthly2 = date("Y-9-30", strtotime('+1 year'));
            $this->db->where('tb_activity_plan_start_date >=', $monthly);
            $this->db->where('tb_activity_plan_end_date <=', $monthly2);
            $data['rsY'] = $this->My_model->get_where_order("tb_activity_plan", array("tb_activity_plan_responsible" => "งานวิชาการ", "tb_activity_plan_department" => $this->session->userdata('department')), "tb_activity_plan_start_date asc");
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

    // บันทึกข้อมูล
    public function activity_plan_add() {
        $id = $_POST['id'];
        $dept = '';
        if (isset($_POST['dept'])) {
            $dept = $_POST['dept'];
        } else {
            $dept = $this->session->userdata('department');
        }

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
            "tb_activity_plan_sub_department" => 'งานวิชาการ',
            "tb_activity_plan_responsible" => $this->session->userdata("responsible"),
            "tb_activity_plan_department" => $this->session->userdata('department'),
            "tb_activity_plan_recorder" => $this->session->userdata("name")
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
                "tb_activity_plan_sub_department" => 'งานวิชาการ',
                "tb_activity_plan_department" => $this->session->userdata('department'),
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
                "tb_activity_plan_sub_department" => 'งานวิชาการ',
                "tb_activity_plan_department" => $this->session->userdata('department'),
                "tb_activity_plan_responsible" => $this->session->userdata("responsible"),
                "tb_activity_plan_recorder" => $this->session->userdata("name")
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
            //redirect('login');
        }
        $data['plan'] = $this->My_model->get_all('tb_ed_plan');
        //$data['class'] = $this->My_model->join2table_where_result('tb_ed_school_class a','tb_ed_school_register_class',array('tb_ed_school_class_department'=>$this->session->userdata('department')),'tb_ed_school_class_level');
        $data['roomRS'] = $this->Ed_Classroom_model->get_all();
        $this->load->view("layout/header");
        $this->load->view("vichakarn/school/room", $data);
        $this->load->view('layout/footer');
    }
    
    

    public function ed_room_admin() {
        if ($this->session->userdata('status') == '') {
            //redirect('login');
        }
        $data['plan'] = $this->My_model->get_all('tb_ed_plan');
        //$data['class'] = $this->My_model->join2table_where_result('tb_ed_school_class a','tb_ed_school_register_class',array('tb_ed_school_class_department'=>$this->session->userdata('department')),'tb_ed_school_class_level');
        $data['roomRS'] = $this->Ed_Classroom_model->get_all();
        $this->load->view("layout/header");
        $this->load->view("vichakarn/school/room_admin", $data);
        $this->load->view('layout/footer');
    }

    public function dc_index() {
        if ($this->session->userdata('status') == '') {
            //redirect('login');
        }
        $data['course'] = $this->Ed_Classroom_model->get_course_mis();
        $this->load->view("layout/header");
        $this->load->view("vichakarn/school/development_course", $data);
        $this->load->view('layout/footer');
    }

    public function ed_evaluation() {
        if ($this->session->userdata('status') == '') {
            //redirect('login');
        }
        //$data['course'] = $this->Ed__model->get_course_mis();
        $this->load->view("layout/header");
        $this->load->view("vichakarn/school/ed_evaluation"/* , $data */);
        $this->load->view('layout/footer');
    }

    public function room_add() {
        $id = $this->input->post('id');
        $eClass = $this->input->post('MyClass');

        $arr = array(
            "tb_ed_school_register_class_id" => $eClass,
            "tb_ed_plan_id" => $this->input->post('inEdPlan'),
            "tb_classroom_room" => $this->input->post('inClassroomRoom'),
            "tb_classroom_student_amount" => $this->input->post('inClassroomStudentAmount'),
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
    
    // ลบข้อมูล
    public function room_delete() {
        $id = $_POST['id'];
        $this->My_model->delete_data('tb_ed_room', array('id' => $id));
    }

    public function ed_homeroom() {



        $data['hr'] = $this->Ed_Classroom_model->get_all_TA_available();
        $this->load->view("layout/header");
        $this->load->view("vichakarn/school/homeroom", $data);
        $this->load->view('layout/footer');
    }

    public function ed_homeroom_add() {
        $rid = $this->input->post('MyRoom');
        $hrid = $this->input->post('hr');

        $this->My_model->delete_data('tb_ed_homeroom', array('tb_room_id' => $rid));

        foreach ($hrid as $hr) {

            $arr = array(
                'tb_room_id' => $rid,
                'tb_human_resources_id' => $hr,
                'tb_ed_homeroom_recorder' => $this->session->userdata("name"),
                'tb_ed_homeroom_department' => $this->session->userdata("department")
            );
            $this->My_model->insert_data("tb_ed_homeroom", $arr);
        }
    }

    public function homeroom_list() {
        $output = "";

        $rs = $this->My_model->join2table_where_result('tb_ed_homeroom a', 'tb_human_resources_01 b', 'a.tb_human_resources_id=b.id', array('tb_room_id' => $this->input->post('MyR')), 'a.id');
        $output = "<thead>
                            <tr>
                                <th style=\"width:40px;\">ที่</th>
                                <th class=\"no-sort\">ชื่อ</th>";
        if ($this->session->userdata("status") == "ผู้ปฏิบัติงาน"):
            $output .= "<th style=\"width:13%;\" class=\"no-sort\">คัดเลือก</th>";
        endif;
        $output .= " </tr>
                        </thead>";

        $output .= "<tbody>";

        $row = 1;
        if (count($rs) > 0) {
            foreach ($rs as $r):


                $output .= " <tr>";
                $output .= "<td style=\"text-align: center;\">" . $row . "</td>";
                $output .= "<td>" . $r['hr_thai_symbol'] . ' ' . $r['hr_thai_name'] . ' ' . $r['hr_thai_lastname'] . "</td>";
                if ($this->session->userdata("status") == "ผู้ปฏิบัติงาน"):
                    $output .= " <td style=\"text-align:center;\">";

                    $output .= " <label class=\"containerzz\">";
                    $output .= " <input type=\"checkbox\" name =\"hr[]\" id=\"hr[]\" value=\"" . $r['id'] . "\" checked />";
                    $output .= " <span class=\"checkmark\"></span>";
                    $output .= " </label>";




                    //$output .= "<input type=\"checkbox\" name =\"hr[]\" id=\"hr[]\" value=\"" . $r['id'] . "\" checked />";
                    //$output .= " <input name=\"isAdvisor[]\" id=\"isAdvisor[]\"  value=\"" . $r['id'] . "\" type=\"checkbox\" checked />";
                    $output .= " </td>";
                endif;
                $output .= " </tr>";

                $row++;
            endforeach;
            $output .= "  </tbody>";
        }
        $rs = $this->Ed_Classroom_model->get_all_TA_available();
        foreach ($rs as $r):


            $output .= " <tr>";
            $output .= "<td style=\"text-align: center;\">" . $row . "</td>";
            $output .= "<td>" . $r['hr_thai_symbol'] . ' ' . $r['hr_thai_name'] . ' ' . $r['hr_thai_lastname'] . "</td>";
            if ($this->session->userdata("status") == "ผู้ปฏิบัติงาน"):
                $output .= " <td style=\"text-align:center;\">";
                $output .= " <label class=\"containerzz\">";
                $output .= " <input type=\"checkbox\" name =\"hr[]\" id=\"hr[]\" value=\"" . $r['id'] . "\" />";
                $output .= " <span class=\"checkmark\"></span>";
                $output .= " </label>";
//                    $output .= "<input type=\"checkbox\" name =\"hr[]\" id=\"hr[]\" value=\"" . $r['id'] . "\" />";
                //$output .= " <input name=\"isAdvisor[]\" id=\"isAdvisor[]\" value=\"" . $r['id'] . "\" type=\"checkbox\" />";
                $output .= " </td>";
            endif;
            $output .= " </tr>";

            $row++;
        endforeach;
        $output .= "  </tbody>";

        echo $output;
    }

    function op_regulation_list() {
        $data['op'] = $this->My_model->get_where_order('tb_ed_op_regulation', array('tb_ed_op_regulation_department' => $this->session->userdata("department")), 'tb_division_id,tb_ed_op_regulation_title');
        $this->load->view("layout/header");
        $this->load->view("vichakarn/school/op_regulation_list", $data);
        $this->load->view('layout/footer');
    }
    function op_regulation() {
        $data['op'] = $this->My_model->get_where_order('tb_ed_op_regulation', array('tb_ed_op_regulation_department' => $this->session->userdata("department")), 'tb_ed_op_regulation_title');
        $data['division'] = $this->My_model->get_where_order('tb_division', array('tb_school_id' => $this->session->userdata("sch_id")), 'tb_division_name');
        $this->load->view("layout/header");
        $this->load->view("vichakarn/school/op_regulation", $data);
        $this->load->view('layout/footer');
    }

    // แก้ไขข้อมูล
    public function op_regulation_edit() {
        $id = $_POST['id'];
        $rs = $this->My_model->get_where_row('tb_ed_op_regulation', array('id' => $id));
        echo json_encode($rs);
    }
    
    public function op_regulation_delete() {
        $id = $_POST['id'];
        $rs = $this->My_model->delete_data('tb_ed_op_regulation', array('id' => $id));

    }

    public function op_regulation_add() {
        $id = $this->input->post('id');
        $inEdOpRegulationTitle = $this->input->post('inEdOpRegulationTitle');
        $inEdOpRegulationContent = $this->input->post('inEdOpRegulationContent');
        $arr = array(
            "tb_division_id"=>$this->input->post('inDivision'),
            "tb_ed_op_regulation_title" => $inEdOpRegulationTitle,
            "tb_ed_op_regulation_content" => $inEdOpRegulationContent,
            "tb_ed_op_regulation_recorder" => $this->session->userdata("name"),
            "tb_ed_op_regulation_department" => $this->session->userdata("department")
        );
        if ($id != "") {
            $this->My_model->update_data('tb_ed_op_regulation', array('id' => $id), $arr);
        } else {
            $this->My_model->insert_data("tb_ed_op_regulation", $arr);
        }
    }

    //---------------------------------------


    public function homeroom_checkin() {
        if ($this->session->userdata('status') == '') {
            //redirect('login');
        }
        $data['std'] = $this->My_model->join2table_where_result('tb_student_base', 'tb_std_picture', 'tb_std_picture.own_id=tb_student_base.id', array('tb_student_base.tb_student_base_department' => $this->session->userdata("department")), 'std_code');
        $this->load->view("layout/header");
        $this->load->view("vichakarn/school/homeroom_checkin", $data);
        $this->load->view('layout/footer');
    }

    public function classroom_checkin() {
        if ($this->session->userdata('status') == '') {
            //redirect('login');
        }
        $data['std'] = $this->My_model->join2table_where_result('tb_student_base', 'tb_std_picture', 'tb_std_picture.own_id=tb_student_base.id', array('tb_student_base.tb_student_base_department' => $this->session->userdata("department")), 'std_code');
        $this->load->view("layout/header");
        $this->load->view("vichakarn/school/classroom_checkin", $data);
        $this->load->view('layout/footer');
    }

}
