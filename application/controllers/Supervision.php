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
        if ($this->session->userdata('status') == '') {
            redirect('login');
        }
        //
        $data['rs'] = $this->Supervision_model->get_supervision_schedule(loan_year(date("Y")));
        $this->load->view("layout/header");
        $this->load->view("vichakarn/supervision", $data);
        $this->load->view("layout/footer");
    }

    // print data;
    public function supervision_print() {
        $data['supervision'] = $this->My_model->get_row('tb_supervision_schedule');
        $data['rs'] = $this->Supervision_model->get_supervision_schedule();
        $this->load->view("layout/header");
        $this->load->view('vichakarn/reports/supervision_print', $data);
        $this->load->view("layout/footer");
    }

    #-----------------------------------------------------------------------#
    # กำหนดกลุ่มงานสำหรับนิเทศการศึกษา
    # Define education supervision task
    # Date 16/12/2018
    #-----------------------------------------------------------------------#
    //
    public function supervision_define_task() {
        if ($this->session->userdata('status') == '') {
            redirect('login');
        }
        $data['rs'] = $this->My_model->get_all_order('tb_question_level1', 'id asc');
        $this->load->view('layout/header');
        $this->load->view('vichakarn/supervision_define_task', $data);
        $this->load->view('layout/footer');
    }

    // add data;
    public function supervision_task_add() {
        $id = $_POST['id'];
        $arr = array(
            'question_level1' => $this->input->post('inSupervisionTask')
        );
        if ($id != '') {
            $this->My_model->update_data('tb_question_level1', array('id' => $id), $arr);
        } else {
            $this->My_model->insert_data('tb_question_level1', $arr);
        }
    }

    // edit data;
    public function supervision_task_edit() {
        $id = $_POST['id'];
        $row = $this->My_model->get_where_row('tb_question_level1', array('id' => $id));
        echo json_encode($row);
    }

    // delete data;
    public function supervision_task_delete() {
        $id = $_POST['id'];
        $this->My_model->delete_data('tb_question_level1', array('id' => $id));
    }

    #-----------------------------------------------------------------------#
    # กำหนดรายการงานย่อยสำหรับการนิเทศลำดับที่ 2
    # -
    # Date 16/12/2018
    #-----------------------------------------------------------------------#
    //
    public function supervision_task_level2($level_id) {
        if ($this->session->userdata('status') == '') {
            redirect('login');
        }
        //
        $data['task'] = $this->My_model->get_where_row('tb_question_level1', array('id' => $level_id));
        $data['rs'] = $this->My_model->join2table_result('tb_question_level1 a', 'tb_question_level2 b', 'b.level1_id = a.id', 'b.id asc');
        $this->load->view('layout/header');
        $this->load->view('vichakarn/supervision_task_level2', $data);
        $this->load->view('layout/footer');
    }

    // insert data;
    public function supevision_task_level_2_add() {
        $id = $_POST['id'];

        if ($id != '') {
            $arr = array(
                'question_level2' => $this->input->post('inQuestionLevel2')
            );
            $this->My_model->update_data('tb_question_level2', array('id' => $id), $arr);
        } else {
            $arr = array(
                'level1_id' => $this->input->post('level1_id'),
                'question_level2' => $this->input->post('inQuestionLevel2')
            );
            $this->My_model->insert_data('tb_question_level2', $arr);
        }
    }

    // edit data;
    public function supevision_task_level_2_edit() {
        $id = $_POST['id'];
        $row = $this->My_model->join2table_row('tb_question_level1 a', 'tb_question_level2 b', 'b.level1_id = a.id', array('b.id' => $id));
        echo json_encode($row);
    }

    // delete data;
    public function supevision_task_level_2_delete() {
        $id = $_POST['id'];
        $this->My_model->delete_data('tb_question_level2', array('id' => $id));
    }

    #-----------------------------------------------------------------------#
    # กำหนดรายการงานย่อยสำหรับการนิเทศลำดับที่ 3
    # -
    # Date 29/12/2018
    #-----------------------------------------------------------------------#

    //
    public function supervision_task_level3($level_id, $pid) {
        $data['level1'] = $this->My_model->get_where_row('tb_question_level1', array('id' => $level_id));
        $data['level2'] = $this->My_model->get_where_row('tb_question_level2', array('level1_id' => $level_id));
        $data['rs'] = $this->Supervision_model->get_question_level3($pid);
        $this->load->view('layout/header');
        $this->load->view('vichakarn/supervision_task_level3', $data);
        $this->load->view('layout/footer');
    }

    // insert data;
    public function supervision_task_level3_add() {
        $level2_id = $_POST['level2_id'];
        $arr = array(
            'level2_id' => $level2_id,
            'question_level3' => $this->input->post('inQuestionLevel3')
        );
        $this->My_model->insert_data('tb_question_level3', $arr);
    }

    // edit data;
    public function supervision_task_level3_edit() {
        $id = $_POST['id'];
        $row = $this->My_model->get_where_row('tb_question_level3', array('id' => $id));
        echo json_encode($row);
    }

    #-----------------------------------------------------------------------#
    # กำหนดแผนการนิเทศการเรียนรการสอน
    # -
    # Date 18/12/2018
    #-----------------------------------------------------------------------#

    //
    public function supervision_schedule() {
        if ($this->session->userdata('status') == '') {
            redirect('login');
        }
        $data['group'] = $this->My_model->get_all_order('tb_group_learning', 'tb_group_learningcol_name asc');
        $data['school'] = $this->My_model->get_all_order('tb_school', 'sc_thai_name asc');
        $data['rs'] = $this->My_model->get_where_order('tb_supervision_schedule', array('supervision_department' => $this->session->userdata('department')), 'loan_year asc');
        $this->load->view('layout/header');
        $this->load->view('vichakarn/supervision_schedule', $data);
        $this->load->view('layout/footer');
    }

    // add data
    public function supervision_schedule_add() {
        $id = $_POST['id'];
        $arr = array(
            'loan_year' => $this->input->post('inLoanYear'),
            'loan_term' => $this->input->post('inLoanTerm'),
            'school_name' => $this->input->post('inSchoolName'),
            'learning_group' => $this->input->post('inLearningGroup'),
            'supervision_recorder' => $this->session->userdata('name'),
            'supervision_department' => $this->session->userdata('department')
        );
        if ($id != '') {
            $this->My_model->update_data('tb_supervision_schedule', array('id' => $id), $arr);
        } else {
            $this->My_model->insert_data('tb_supervision_schedule', $arr);
        }
    }

    // edit data
    public function supervision_schedule_edit() {
        $id = $_POST['id'];
        $row = $this->My_model->get_where_row('tb_supervision_schedule', array('id' => $id));
        echo json_encode($row);
    }

    // delete data;
    public function supervision_schedule_delete() {
        $id = $_POST['id'];
        $this->My_model->delete_data('tb_supervision_schedule', array('id' => $id));
    }

    // print data
    public function supervision_schedule_print() {
        $data['rs'] = $this->My_model->get_all_order('tb_supervision_schedule', 'loan_year asc, loan_term asc');
        $this->load->view('vichakarn/reports/supervision_schedule_print', $data);
    }

    #-----------------------------------------------------------------------#
    # รายละเอียดแผนการนิเทศการเรียนการสอน
    # -
    # Date 18/12/2018
    #-----------------------------------------------------------------------#

    //
    public function supervision_schedule_detail($id) {
        if ($this->session->userdata('status') == '') {
            redirect('login');
        }
        $schedule = $this->My_model->get_where_row('tb_supervision_schedule', array('id' => $id));
        $data['schedule_title'] = $this->My_model->get_where_row('tb_supervision_schedule', array('id' => $id));
        // ข้อมูลผู้นิเทศ
        if ($this->session->userdata('department') == 'กองการศึกษา') {
            $data['supervision'] = $this->Supervision_model->get_human_resources_type('ศึกษานิเทศ');
        }
// ข้อมูลผู้รับการนิเทศ
//        $data['teacher'] = $this->Supervision_model->get_human_resources_type_by_department('ครูผู้สอน');
        // ดึงข้อมูลรายการหลักการนิเทศการเรียนการสอน
        $data['supervision_issue'] = $this->My_model->get_where_row('tb_supervision_schedule', array('id' => $id));
        // ดึงรายวิชามาแสดง 
//        $data['subject'] = $this->Supervision_model->get_subject($schedule['learning_group']);
        $data['rs'] = $this->Supervision_model->get_supervision_schedule_detail($id);
        $data['subject_title'] = $schedule['learning_group'];
        $data['test'] = $id;
        $this->load->view('layout/header');
        $this->load->view('vichakarn/supervision_schedule_detail', $data);
        $this->load->view('layout/footer');
    }

    // add data
    public function supervision_schedule_detail_add() {
        $id = $_POST['id'];
        if ($id != '') {
            $arr = array(
                'schedule_date' => $this->input->post('inScheduleDate'),
                'tb_course_id' => $this->input->post('inSubjectDetailId'),
//                'subject_detail_id' => $this->input->post('inSubjectDetailId'),
                'teacher_name' => $this->input->post('inTeacherName'),
                'supervision_name' => $this->input->post('inSupervisionName')
            );
            $this->My_model->update_data('tb_supervision_schedule_detail', array('id' => $id), $arr);
        } else {
            $arr = array(
                'schedule_id' => $this->input->post('schedule_id'),
                'schedule_date' => $this->input->post('inScheduleDate'),
                'tb_course_id' => $this->input->post('inSubjectDetailId'),
//                'subject_detail_id' => $this->input->post('inSubjectDetailId'),
                'teacher_name' => $this->input->post('inTeacherName'),
                'supervision_name' => $this->input->post('inSupervisionName')
            );
            $this->My_model->insert_data('tb_supervision_schedule_detail', $arr);
        }
    }

    // edit data;
    public function supervision_schedule_detail_edit() {
        $id = $_POST['id'];
        $row = $this->Supervision_model->get_suervision_schedule_detail_edit($id);
        echo json_encode($row);
    }

    // delete data;
    public function supervision_schedule_detail_delete() {
        $id = $_POST['id'];
        $this->My_model->delete_data('tb_supervision_schedule_detail', array('id' => $id));
    }

    // Print data
    public function supervision_schedule_detail_print($id) {
        $data['schedule'] = $this->My_model->get_where_row('tb_supervision_schedule', array('id' => $id));
        $data['rs'] = $this->Supervision_model->get_supervision_schedule_detail($id);
        $this->load->view('vichakarn/reports/supervision_schedule_detail_print', $data);
    }

    #-----------------------------------------------------------------------#
    # บันทึกการสังเกตการณ์สอน
    # -
    # Date 22/12/2018
    #-----------------------------------------------------------------------#
    // 

    public function supervision_observ($schedule_detail_id) {
        if ($this->session->userdata('status') == '') {
            redirect('login');
        }
        // ข้อมูลทั่วไป
        $data['supervision'] = $this->Supervision_model->get_supervision_schedule_row($schedule_detail_id);
        // ครูผู้สอน
        $data['teacher'] = $this->Supervision_model->get_human_resources_type('ครูผู้สอน');
        // โรงเรียน
        $data['school'] = $this->My_model->get_all_order('tb_school', 'sc_thai_name asc');
        // วิชาที่สังเกตการณ์สอน
        $data['subject'] = $this->My_model->get_all_order('tb_subject_detail', 'subject_code asc');
        // หน่วยการเรียนรู้
        $data['learning_group'] = $this->My_model->get_all_order('tb_education_learning_group', 'education_group_no asc');
        // ไฟล์ภาพวาด
        $data['classroom'] = $this->My_model->get_where_row('tb_observ_classroom', array('schedule_detail_id' => $schedule_detail_id));
        // ส่วนเนื้อหา
        $data['content'] = $this->My_model->get_where_row('tb_observ_content', array('schedule_detail_id' => $schedule_detail_id));
        // ส่วนของความคิดรวบยอด
        $data['concept'] = $this->My_model->get_where_row('tb_observ_concept', array('schedule_detail_id' => $schedule_detail_id));
        // พฤติกรรมครู
        $data['teacher_act'] = $this->My_model->get_where_row('tb_observ_teacher_activities', array('schedule_detail_id' => $schedule_detail_id));
        // พฤติกรรมนักเรียน
        $data['student_act'] = $this->My_model->get_where_row('tb_observ_student_activities', array('schedule_detail_id' => $schedule_detail_id));
        // กิจกรรมการเรียนการสอน
        $data['study_act'] = $this->My_model->get_where_order('tb_observ_study_activities', array('schedule_detail_id' => $schedule_detail_id), 'activities_no asc');
        // การประเมินผล
        $data['valuation'] = $this->My_model->get_where_row('tb_observ_valuation', array('schedule_detail_id' => $schedule_detail_id));
        // การใช้สื่อการเรียนการสอน
        $data['media'] = $this->My_model->get_where_row('tb_observ_media', array('schedule_detail_id' => $schedule_detail_id));
        // การใช้คำถามของครู
        $data['teacher_question'] = $this->My_model->get_where_row('tb_observ_teacher_question', array('schedule_detail_id' => $schedule_detail_id));
        // การใช้คำถามของนักเรียน
        $data['student_question'] = $this->My_model->get_where_row('tb_observ_student_question', array('schedule_detail_id' => $schedule_detail_id));
        // จุดแข็งและการพัฒนา
        $data['strength'] = $this->My_model->get_where_row('tb_observ_strength', array('schedule_detail_id' => $schedule_detail_id));
        // จุดอ่อนและการพัฒนา
        $data['weakness'] = $this->My_model->get_where_row('tb_observ_weakness', array('schedule_detail_id' => $schedule_detail_id));
        //$data['observ'] = $this->My_model->get_where_row('tb_supervision_observ', array('schedule_detail_id' => $schedule_detail_id));

        $data['observ'] = $this->Supervision_model->get_observ($schedule_detail_id);
        $this->load->view('layout/header');
        $this->load->view('vichakarn/supervision_observ', $data);
        $this->load->view('layout/footer');
    }

    // insert data;
    public function supervision_observ_add() {
        $schedule_detail_id = $_POST['schedule_detail_id'];
        $status = $_POST['status'];
        if ($status == 'ปรับปรุงข้อมูล') {
            $arr = array(
                'observ_time' => $this->input->post('inObservTime'),
                'observ_no' => $this->input->post('inObservNo'),
                'observ_std_male' => $this->input->post('inObservStdMale'),
                'observ_std_female' => $this->input->post('inObservStdFemale'),
                'observ_std_absent' => $this->input->post('inObservStdAbsent'),
                'observ_issue' => $this->input->post('inObservIssue')
            );
            $this->My_model->update_data('tb_supervision_observ', array('schedule_detail_id' => $schedule_detail_id), $arr);
        } else {
            $arr = array(
                'schedule_detail_id' => $this->input->post('schedule_detail_id'),
                'observ_time' => $this->input->post('inObservTime'),
                'observ_no' => $this->input->post('inObservNo'),
                'observ_std_male' => $this->input->post('inObservStdMale'),
                'observ_std_female' => $this->input->post('inObservStdFemale'),
                'observ_std_absent' => $this->input->post('inObservStdAbsent'),
                'observ_issue' => $this->input->post('inObservIssue')
            );
            $this->My_model->insert_data('tb_supervision_observ', $arr);
        }
    }

    // delete data;
    public function supervision_observ_delete() {
        $id = $_POST['id'];
        $this->My_model->delete_data('tb_supervision_observ', array('id' => $id));
    }

    #-----------------------------------------------------------------------#
    # ส่วนประกอบต่าง ๆ ในห้องเรียน
    # -
    # Date 22/12/2018
    #-----------------------------------------------------------------------#
    // 

    public function classroom_component_add() {
        $schedule_detail_id = $_POST['schedule_detail_id'];
        $status = $_POST['status'];
        //
        if ($status == 'ปรับปรุงข้อมูล') {
            $row = $this->My_model->get_where_row('tb_observ_classroom', array('schedule_detail_id' => $schedule_detail_id));
            @unlink('upload/' . $row['observ_classroom']);
            $config = array(
                "upload_path" => "upload/",
                "allowed_types" => "jpg|png",
                "max_size" => 0,
                "file_name" => md5(date("YmdHis"))
            );
            $this->upload->initialize($config);
            $this->upload->do_upload("inObservClassroom");
            $data = $this->upload->data();

            $this->load->library("image_lib");
            $config['image_library'] = "gd2";
            $config["source_image"] = "upload/" . $data['file_name'];
            $config['maintain_ratio'] = TRUE;
            $config['width'] = 800;
            $config['height'] = 600;

            $this->image_lib->initialize($config);
            $this->image_lib->resize();
            $filename = $data['file_name'];
            $arr = array('observ_classroom' => $filename);
            $this->My_model->update_data('tb_observ_classroom', array('schedule_detail_id' => $schedule_detail_id), $arr);
            //
        } else {
            $config = array(
                "upload_path" => "upload/",
                "allowed_types" => "jpg|png",
                "max_size" => 0,
                "file_name" => md5(date("YmdHis"))
            );
            $this->upload->initialize($config);
            $this->upload->do_upload("inObservClassroom");
            $data = $this->upload->data();

            $this->load->library("image_lib");
            $config['image_library'] = "gd2";
            $config["source_image"] = "upload/" . $data['file_name'];
            $config['maintain_ratio'] = TRUE;
            $config['width'] = 800;
            $config['height'] = 600;

            $this->image_lib->initialize($config);
            $this->image_lib->resize();
            $filename = $data['file_name'];
            $arr = array(
                'schedule_detail_id' => $schedule_detail_id,
                'observ_classroom' => $filename
            );
            $this->My_model->insert_data('tb_observ_classroom', $arr);
        }
    }

    #-----------------------------------------------------------------------#
    # ส่วนของเนื้อหา
    # -
    # Date 22/12/2018
    #-----------------------------------------------------------------------#
    // 

    public function observ_content_add() {
        $status = $this->input->post('edit');
        $schedule_detail_id = $this->input->post('schedule_detail_id');
        if ($status == 'edit_data') {
            $arr = array(
                'observ_content' => $this->input->post('inObservContent')
            );
            $this->My_model->update_data('tb_observ_content', array('schedule_detail_id' => $schedule_detail_id), $arr);
        } else {
            $arr = array(
                'schedule_detail_id' => $this->input->post('schedule_detail_id'),
                'observ_content' => $this->input->post('inObservContent')
            );
            $this->My_model->insert_data('tb_observ_content', $arr);
        }
    }

    // delete content
    public function observ_content_delete() {
        $id = $_POST['id'];
        $this->My_model->delete_data('tb_observ_content', array('schedule_detail_id' => $id));
    }

    #-----------------------------------------------------------------------#
    # ส่วนของความคิดรวบยอด
    # -
    # Date 22/12/2018
    #-----------------------------------------------------------------------#
    // 

    public function observ_concept_add() {
        $schedule_detail_id = $this->input->post('schedule_detail_id');
        $status = $this->input->post('edit');
        if ($status == 'edit_data') {
            $arr = array(
                'observ_concept' => $this->input->post('inObservConcept')
            );
            $this->My_model->update_data('tb_observ_concept', array('schedule_detail_id' => $schedule_detail_id), $arr);
        } else {
            $arr = array(
                'schedule_detail_id' => $this->input->post('schedule_detail_id'),
                'observ_concept' => $this->input->post('inObservConcept')
            );
            $this->My_model->insert_data('tb_observ_concept', $arr);
        }
    }

    // delete data;
    public function observ_concept_delete() {
        $id = $_POST['id'];
        $this->My_model->delete_data('tb_observ_concept', array('schedul' => $id));
    }

    #-----------------------------------------------------------------------#
    # ส่วนของพฤติกรรมครู
    # -
    # Date 23/12/2018
    #-----------------------------------------------------------------------#
    // 

    public function observ_teacher_activities_add() {
        $schedule_detail_id = $this->input->post('schedule_detail_id');
        $status = $this->input->post('status');
        //
        if ($status == 'ปรับปรุงข้อมูล') {
            $arr = array(
                'teacher_activities' => $this->input->post('inObservTeacherActivities')
            );
            $this->My_model->update_data('tb_observ_teacher_activities', array('schedule_detail_id' => $schedule_detail_id), $arr);
        } else {
            $arr = array(
                'schedule_detail_id' => $schedule_detail_id,
                'teacher_activities' => $this->input->post('inObservTeacherActivities')
            );
            $this->My_model->insert_data('tb_observ_teacher_activities', $arr);
        }
    }

    // ลบข้อมูลพฤติกรรมครู
    public function observ_teacher_activities_delete() {
        $id = $_POST['id'];
        $this->My_model->delete_data('tb_observ_teacher_activities', array('schedule_detail_id' => $id));
    }

    #-----------------------------------------------------------------------#
    # ส่วนของพฤติกรรมนักเรียน
    # -
    # Date 23/12/2018
    #-----------------------------------------------------------------------#
    // 

    public function observ_student_activities_add() {
        $schedule_detail_id = $this->input->post('schedule_detail_id');
        $status = $this->input->post('status');
        //
        if ($status == 'ปรับปรุงข้อมูล') {
            $arr = array(
                'student_activities' => $this->input->post('inObservStudentActivities')
            );
            $this->My_model->update_data('tb_observ_student_activities', array('schedule_detail_id' => $schedule_detail_id), $arr);
        } else {
            $arr = array(
                'schedule_detail_id' => $schedule_detail_id,
                'student_activities' => $this->input->post('inObservStudentActivities')
            );
            $this->My_model->insert_data('tb_observ_student_activities', $arr);
        }
    }

    // ลบข้อมูลพฤติกรรมครู
    public function observ_student_activities_delete() {
        $id = $_POST['id'];
        $this->My_model->delete_data('tb_observ_student_activities', array('schedule_detail_id' => $id));
    }

    #-----------------------------------------------------------------------#
    # ส่วนของกิจกรรมการเรียนการสอน
    # -
    # Date 23/12/2018
    #-----------------------------------------------------------------------#
    // 

    public function observ_study_activities_add() {
        $schedule_detail_id = $_POST['schedule_detail_id'];
        $id = $_POST['activities_id'];
        if ($id != '') {
            $arr = array(
                'activities_no' => $this->input->post('inStudyActivitiesNo'),
                'activities_time' => $this->input->post('inStudyActivitiesTime'),
                'activities_detail' => $this->input->post('inStudyActivitiesDetail')
            );
            $this->My_model->update_data('tb_observ_study_activities', array('id' => $id), $arr);
        } else {
            $arr = array(
                'schedule_detail_id' => $schedule_detail_id,
                'activities_no' => $this->input->post('inStudyActivitiesNo'),
                'activities_time' => $this->input->post('inStudyActivitiesTime'),
                'activities_detail' => $this->input->post('inStudyActivitiesDetail')
            );
            $this->My_model->insert_data('tb_observ_study_activities', $arr);
        }
    }

    // edit data;
    public function observ_study_activities_edit() {
        $id = $_POST['id'];
        $row = $this->My_model->get_where_row('tb_observ_study_activities', array('id' => $id));
        echo json_encode($row);
    }

    // delete data;
    public function observ_study_activities_delete() {
        $id = $_POST['id'];
        $this->My_model->delete_data('tb_observ_study_activities', array('id' => $id));
    }

    #-----------------------------------------------------------------------#
    # ส่วนของการประเมินผล
    # -
    # Date 23/12/2018
    #-----------------------------------------------------------------------#
    // 

    public function observ_valuation_add() {
        $status = $_POST['status'];
        $schedule_detail_id = $_POST['schedule_detail_id'];
        if ($status == 'ปรับปรุงข้อมูล') {
            $arr = array(
                'valuation_detail' => $this->input->post('inValuationDetail')
            );
            $this->My_model->update_data('tb_observ_valuation', array('schedule_detail_id' => $schedule_detail_id), $arr);
        } else {
            $arr = array(
                'schedule_detail_id' => $this->input->post('schedule_detail_id'),
                'valuation_detail' => $this->input->post('inValuationDetail')
            );
            $this->My_model->insert_data('tb_observ_valuation', $arr);
        }
    }

    // delete data
    public function observ_valuation_delete() {
        $id = $_POST['id'];
        $this->My_model->delete_data('tb_observ_valuation', array('schedule_detail_id' => $id));
    }

    #-----------------------------------------------------------------------#
    # ส่วนของการใช้สื่อหรือนวัตกรรม
    # -
    # Date 23/12/2018
    #-----------------------------------------------------------------------#
    // 

    public function observ_media_add() {
        $schedule_detail_id = $_POST['schedule_detail_id'];
        $status = $_POST['status'];
        if ($status == 'ปรับปรุงข้อมูล') {
            $arr = array(
                'media_description' => $this->input->post('inMediaDescription')
            );
            $this->My_model->update_data('tb_observ_media', array('schedule_detail_id' => $schedule_detail_id), $arr);
        } else {
            $arr = array(
                'schedule_detail_id' => $schedule_detail_id,
                'media_description' => $this->input->post('inMediaDescription')
            );
            $this->My_model->insert_data('tb_observ_media', $arr);
        }
    }

    // delete data
    public function observ_media_delete() {
        $schedule_detail_id = $_POST['id'];
        $this->My_model->delete_data('tb_observ_media', array('schedule_detail_id' => $schedule_detail_id));
    }

    #-----------------------------------------------------------------------#
    # ส่วนของคำถามของครู
    # -
    # Date 23/12/2018
    #-----------------------------------------------------------------------#
    // 

    public function observ_teacher_question_add() {
        $schedule_detail_id = $_POST['schedule_detail_id'];
        $status = $_POST['status'];
        if ($status == 'ปรับปรุงข้อมูล') {
            $arr = array(
                'teacher_question' => $this->input->post('inTeacherQuestion')
            );
            $this->My_model->update_data('tb_observ_teacher_question', array('schedule_detail_id' => $schedule_detail_id), $arr);
        } else {
            $arr = array(
                'schedule_detail_id' => $schedule_detail_id,
                'teacher_question' => $this->input->post('inTeacherQuestion')
            );
            $this->My_model->insert_data('tb_observ_teacher_question', $arr);
        }
    }

    // delete data;
    public function observ_teacher_question_delete() {
        $schedule_detail_id = $_POST['id'];
        $this->My_model->delete_data('tb_observ_teacher_question', array('schedule_detail_id' => $schedule_detail_id));
    }

    #-----------------------------------------------------------------------#
    # ส่วนของคำถามของนักเรียน
    # -
    # Date 23/12/2018
    #-----------------------------------------------------------------------#
    // 

    public function observ_student_question_add() {
        $schedule_detail_id = $_POST['schedule_detail_id'];
        $status = $_POST['status'];
        if ($status == 'ปรับปรุงข้อมูล') {
            $arr = array(
                'student_question' => $this->input->post('inStudentQuestion')
            );
            $this->My_model->update_data('tb_observ_student_question', array('schedule_detail_id' => $schedule_detail_id), $arr);
        } else {
            $arr = array(
                'schedule_detail_id' => $schedule_detail_id,
                'student_question' => $this->input->post('inStudentQuestion')
            );
            $this->My_model->insert_data('tb_observ_student_question', $arr);
        }
    }

    // delete data;
    public function observ_student_question_delete() {
        $schedule_detail_id = $_POST['id'];
        $this->My_model->delete_data('tb_observ_student_question', array('schedule_detail_id' => $schedule_detail_id));
    }

    #-----------------------------------------------------------------------#
    # ส่วนของจุดแข็งและจุดที่ควรพัฒนา
    # -
    # Date 23/12/2018
    #-----------------------------------------------------------------------#
    // 

    public function observ_strength_add() {
        $schedule_detail_id = $_POST['schedule_detail_id'];
        $status = $_POST['status'];
        if ($status == 'ปรับปรุงข้อมูล') {
            $arr = array(
                'strength_detail' => $this->input->post('inStrengthDetail'),
                'strength_dev' => $this->input->post('inStrengthDev')
            );
            $this->My_model->update_data('tb_observ_strength', array('schedule_detail_id' => $schedule_detail_id), $arr);
        } else {
            $arr = array(
                'schedule_detail_id' => $schedule_detail_id,
                'strength_detail' => $this->input->post('inStrengthDetail'),
                'strength_dev' => $this->input->post('inStrengthDev')
            );

            $this->My_model->insert_data('tb_observ_strength', $arr);
        }
    }

    // delete data
    public function observ_strength_delete() {
        $schedule_detail_id = $_POST['schedule_detail_id'];
        $this->My_model->delete_data('tb_observ_strength', array('schedule_detail_id' => $schedule_detail_id));
    }

    #-----------------------------------------------------------------------#
    # ส่วนของจุดอ่อนและจุดที่ควรพัฒนา
    # -
    # Date 23/12/2018
    #-----------------------------------------------------------------------#
    // 

    public function observ_weakness_add() {
        $schedule_detail_id = $_POST['schedule_detail_id'];
        $status = $_POST['status'];
        if ($status == 'ปรับปรุงข้อมูล') {
            $arr = array(
                'weakness_detail' => $this->input->post('inWeaknessDetail'),
                'weakness_dev' => $this->input->post('inWeaknessDev')
            );
            $this->My_model->update_data('tb_observ_weakness', array('schedule_detail_id' => $schedule_detail_id), $arr);
        } else {
            $arr = array(
                'schedule_detail_id' => $schedule_detail_id,
                'weakness_detail' => $this->input->post('inWeaknessDetail'),
                'weakness_dev' => $this->input->post('inWeaknessDev')
            );
            $this->My_model->insert_data('tb_observ_weakness', $arr);
        }
    }

    // delete data
    public function observ_weakness_delete() {
        $schedule_detail_id = $_POST['schedule_detail_id'];
        $this->My_model->delete_data('tb_observ_weakness', array('schedule_detail_id' => $schedule_detail_id));
    }

    #-----------------------------------------------------------------------#
    # บันทึกเกี่ยวกับผู้รับการนิเทศ
    # -
    # Date 23/12/2018
    #-----------------------------------------------------------------------#
    // 

    public function supervision_destination_note($schedule_detail_id) {
        if ($this->session->userdata('status') == '') {
            redirect('login');
        }
        // ผู้นิเทศ
        $data['supervision'] = $this->Supervision_model->get_human_resources_type('ศึกษานิเทศ');
        // ผู้รับการนิเทศ
        $data['teacher'] = $this->Supervision_model->get_human_resources_type('ครูผู้สอน');
        // ข้อมูลทั่วไป
        $data['supervision_note'] = $this->My_model->get_where_row('tb_supervision_destination_note', array('schedule_detail_id' => $schedule_detail_id));
        // ข้อคิดเห็น
        $data['opinion'] = $this->My_model->get_where_row('tb_supervision_opinion', array('schedule_detail_id' => $schedule_detail_id));
        // สรุปผล
        $data['summary'] = $this->My_model->get_where_row('tb_supervision_summary', array('schedule_detail_id' => $schedule_detail_id));
        // กิจกรรมการนิเทศ
        // นำรายการกิจกรรมการนิเทศไปแสดง
        $data['activities'] = $this->My_model->get_all_order('tb_question_level1', 'id asc');

        // รายละเอียด
        $data['rs'] = $this->My_model->get_where_order('tb_supervision_destination_note_detail', array('schedule_detail_id' => $schedule_detail_id), 'id asc');
        $this->load->view('layout/header');
        $this->load->view('vichakarn/supervision_destination_note', $data);
        $this->load->view('layout/footer');
    }

    // insert data;
    public function supervision_destination_note_add() {
        $schedule_detail_id = $_POST['schedule_detail_id'];
        $id = $_POST['id'];
        if ($id != '') {
            $arr = array(
                'supervision_name' => $this->input->post('inSupervisionName'),
                'solution_in_step' => $this->input->post('inSolutionInStep'),
                'supervision_issue' => $this->input->post('inSupervisionIssue'),
                'supervision_to' => $this->input->post('inSupervisionTo'),
                'supervision_date' => $this->input->post('inSupervisionDate'),
                'supervision_comment' => $this->input->post('inSupervisionComment')
            );
            $this->My_model->update_data('tb_supervision_destination_note', array('id' => $id), $arr);
        } else {
            $arr = array(
                'schedule_detail_id' => $schedule_detail_id,
                'supervision_name' => $this->input->post('inSupervisionName'),
                'solution_in_step' => $this->input->post('inSolutionInStep'),
                'supervision_issue' => $this->input->post('inSupervisionIssue'),
                'supervision_to' => $this->input->post('inSupervisionTo'),
                'supervision_date' => $this->input->post('inSupervisionDate'),
                'supervision_comment' => $this->input->post('inSupervisionComment')
            );
            $this->My_model->insert_data('tb_supervision_destination_note', $arr);
        }
    }

    // edit data;
    public function supervision_destination_note_edit() {
        $id = $_POST['id'];
        $row = $this->My_model->get_where_row('tb_supervision_destination_note', array('id' => $id));
        echo json_encode($row);
    }

    // delete data;
    public function supervision_destination_note_delete() {
        $id = $_POST['id'];
        $this->My_model->delete_data('tb_supervision_destination_note', array('id' => $id));
    }

    // Table name: activities;
    public function supervision_destination_note_level_1_define() {
        $id = $_POST['id'];
        $row = $this->My_model->get_where_row('tb_question_level1', array('id' => $id));
        echo json_encode($row);
    }

    // บันทึกรายละเอียดผลการนิเทศ
    public function supervision_destination_note_detail_add() {
        $schedule_detail_id = $_POST['schedule_detail_id'];
        $id = $_POST['note-id'];
        if ($id != '') {
            $arr = array(
                'detail_destination' => $this->input->post('inDetailDestination'),
                'destination_activities' => $this->input->post('inDetailActivities'),
                'destination_result' => $this->input->post('inDestinationResult')
            );
            $this->My_model->update_data('tb_supervision_destination_note_detail', array('id' => $id), $arr);
        } else {
            $arr = array(
                'schedule_detail_id' => $schedule_detail_id,
                'detail_destination' => $this->input->post('inDetailDestination'),
                'destination_activities' => $this->input->post('inDetailActivities'),
                'destination_result' => $this->input->post('inDestinationResult')
            );
            $this->My_model->insert_data('tb_supervision_destination_note_detail', $arr);
        }
    }

    // แก้ไขรายละเอียดผลการนิเทศ
    public function supervision_destination_note_detail_edit() {
        $id = $_POST['id'];
        $row = $this->My_model->get_where_row('tb_supervision_destination_note_detail', array('id' => $id));
        echo json_encode($row);
    }

    // ลบรายละเอียดผลการนิเทศ
    public function supervision_destination_note_detail_delete() {
        $id = $_POST['id'];
        $this->My_model->delete_data('tb_supervision_destination_note_detail', array('id' => $id));
    }

    // ข้อคิดเห็น-ข้อตกลงร่วม
    public function supervsion_destination_add() {
        $schedule_detail_id = $_POST['schedule_detail_id'];
        $status = $_POST['status'];
        if ($status == 'ปรับปรุงข้อมูล') {
            $arr = array(
                'opinion_detail' => $this->input->post('inOpinionDetail')
            );
            $this->My_model->update_data('tb_supervision_opinion', array('schedule_detail_id' => $schedule_detail_id), $arr);
        } else {
            $arr = array(
                'schedule_detail_id' => $schedule_detail_id,
                'opinion_detail' => $this->input->post('inOpinionDetail')
            );
            $this->My_model->insert_data('tb_supervision_opinion', $arr);
        }
    }

    // delete data;
    public function supervsion_destination_delete() {
        $schedule_detail_id = $_POST['id'];
        $this->My_model->delete_data('tb_supervision_opinion', array('schedule_detail_id' => $schedule_detail_id));
    }

    // สรุปผล-ข้อคิดเห็นของผู้นิเทศ
    public function supervision_summary_add() {
        $schedule_detail_id = $_POST['schedule_detail_id'];
        $status = $_POST['status'];
        if ($status == 'ปรับปรุงข้อมูล') {
            $arr = array(
                'supervision_summary' => $this->input->post('inSummary')
            );
            $this->My_model->update_data('tb_supervision_summary', array('schedule_detail_id' => $schedule_detail_id), $arr);
        } else {
            $arr = array(
                'schedule_detail_id' => $schedule_detail_id,
                'supervision_summary' => $this->input->post('inSummary')
            );
            $this->My_model->insert_data('tb_supervision_summary', $arr);
        }
    }

    // delete data;
    public function supervision_summary_delete() {
        $id = $_POST['id'];
        $this->My_model->delete_data('tb_supervision_summary', array('schedule_detail_id' => $id));
    }

    // Add Supervision level 1
    public function supervision_level_1_add() {
        $id = $_POST['pid'];
        $arr = array(
            'level1_id' => $id,
            'level1_score' => $this->input->post('inQuestionScore')
        );
        $this->My_model->insert_data('tb_question_level1_score', $arr);
    }

    // Push Level 1 information
    public function supervision_push_level_1() {
        $id = $_POST['id'];
        $row = $this->My_model->get_where_row('tb_question_level1', array('id' => $id));
        echo json_encode($row);
    }

    // ยกเลิกการให้คะแนนในแบบสอบถามระดับที่ 1
    public function supervision_destination_note_1_define_delete() {
        $id = $_POST['id'];
        $arr = array('question_score' => '');
        $this->My_model->update_data('tb_question_level1', array('id' => $id), $arr);
    }

    // พิมพ์ข้อมูลแบบประเมินการนิเทศ
    public function supervision_define_destination_note_print() {
        
    }

    // แบบสอบถามระดับที่ 2
    public function supervision_destination_note_level_2($level1_id, $id) {
        $data["l1"] = $this->My_model->get_where_row('tb_question_level1', array('id' => $level1_id));
        $data['rs'] = $this->My_model->get_where_order('tb_question_level2', array('level1_id' => $id), 'id asc');
        $this->load->view('layout/header');
        $this->load->view('vichakarn/supervision_destination_level_2', $data);
        $this->load->view('layout/footer');
    }

    // แบบสอบถามระดับ 3
    public function supervision_destination_note_level_3($l1_id, $l2_id, $id) {
        // ดึงข้อมูลหัวข้อระดับที่ 2 ไปแสดง
        // $data['l2']=$this->My_model->get_where_row('tb_question_level2',array('id'=>$level2_id));
        $data['rs'] = $this->My_model->get_where_order('tb_question_level3', array('level2_id' => $id), 'id asc');
        $data['sum_score'] = $this->My_model->sum_where('tb_question_level3', 'question_score', array('level2_id' => $id));
        $this->load->view('layout/header');
        $this->load->view('vichakarn/supervision_destination_level_3', $data);
        $this->load->view('layout/footer');
    }

    // บันทึกผลการให้คะแนนแบบนิเทศระดับที่ 3
    public function supervision_destination_note_level_3_add() {
        $id = $_POST['id'];
        $arr = array('question_score' => $this->input->post('inQuestionScore'));
        $this->My_model->update_data('tb_question_level3', array('id' => $id), $arr);
    }

    // ดึงข้อมูลแบบนิเทศระดับที่ 3 ไปแสดง
    public function supervision_destination_note_level_3_edit() {
        $id = $_POST['id'];
        $row = $this->My_model->get_where_row('tb_question_level3', array('id' => $id));
        echo json_encode($row);
    }

    // ยกเลิกการให้คะแนนระดับที่ 3
    public function supervision_destination_note_level_3_delete() {
        $id = $_POST['id'];
        $arr = array('question_score' => '');
        $this->My_model->update_data('tb_question_level3', array('id' => $id), $arr);
    }

    #-----------------------------------------------------------------------#
    # บันทึก/สรุปผลการนิเทศ
    # -
    # Date 23/12/2018
    #-----------------------------------------------------------------------#
    // 

    public function supervision_final($schedule_detail_id) {
        if ($this->session->userdata('status') == '') {
            redirect('login');
        }
        // ผู้นิเทศ
        $data['supervision'] = $this->Supervision_model->get_human_resources_type('ศึกษานิเทศ');
        // ข้อมูลทั่วไป
        $data['normal'] = $this->My_model->get_where_row('tb_supervision_final', array('schedule_detail_id' => $schedule_detail_id));
        // ความเห็นของผู้นิเทศ
        $data['supervision_opinion'] = $this->My_model->get_where_row('tb_supervision_final_opinion', array('schedule_detail_id' => $schedule_detail_id));
        // ผู้รับการนิเทศ
        $data['teacher'] = $this->Supervision_model->get_human_resources_type('ครูผู้สอน');
        // ดึงข้อมูลผู้นิเทศที่ schedule_detail_id = $schedule_detail_id;
        $data['sp_name'] = $this->My_model->get_where_row('tb_supervision_schedule_detail', array('id' => $schedule_detail_id));
        // ตารางสรุปข้อมูล
        $data['rs'] = $this->My_model->get_where_order('tb_supervision_final_detail', array('schedule_detail_id' => $schedule_detail_id), 'supervision_date asc');
        $this->load->view('layout/header');
        $this->load->view('vichakarn/supervision_final', $data);
        $this->load->view('layout/footer');
    }

    // insert data;
    public function supervision_final_add() {
        $schedule_detail_id = $_POST['schedule_detail_id'];
        $status = $_POST['status'];
        if ($status == 'ปรับปรุงข้อมูล') {
            $arr = array(
                'final_project' => $this->input->post('inFinalProject'),
                'final_activities_1' => $this->input->post('inFinalActivities1'),
                'final_activities_2' => $this->input->post('inFinalActivities2'),
                'final_activities_3' => $this->input->post('inFinalActivities3'),
                'final_activities_4' => $this->input->post('inFinalActivities4'),
                'final_activities_5' => $this->input->post('inFinalActivities5'),
                'final_activities_6' => $this->input->post('inFinalActivities6'),
                'final_purpose_1' => $this->input->post('inFinalPurpose1'),
                'final_purpose_2' => $this->input->post('inFinalPurpose2'),
                'final_purpose_3' => $this->input->post('inFinalPurpose3'),
                'final_purpose_4' => $this->input->post('inFinalPurpose4'),
                'final_purpose_5' => $this->input->post('inFinalPurpose5'),
                'final_purpose_6' => $this->input->post('inFinalPurpose6'),
            );
            $this->My_model->update_data('tb_supervision_final', array('schedule_detail_id' => $schedule_detail_id), $arr);
        } else {
            $arr = array(
                'schedule_detail_id' => $schedule_detail_id,
                'final_project' => $this->input->post('inFinalProject'),
                'final_activities_1' => $this->input->post('inFinalActivities1'),
                'final_activities_2' => $this->input->post('inFinalActivities2'),
                'final_activities_3' => $this->input->post('inFinalActivities3'),
                'final_activities_4' => $this->input->post('inFinalActivities4'),
                'final_activities_5' => $this->input->post('inFinalActivities5'),
                'final_activities_6' => $this->input->post('inFinalActivities6'),
                'final_purpose_1' => $this->input->post('inFinalPurpose1'),
                'final_purpose_2' => $this->input->post('inFinalPurpose2'),
                'final_purpose_3' => $this->input->post('inFinalPurpose3'),
                'final_purpose_4' => $this->input->post('inFinalPurpose4'),
                'final_purpose_5' => $this->input->post('inFinalPurpose5'),
                'final_purpose_6' => $this->input->post('inFinalPurpose6'),
            );
            $this->My_model->insert_data('tb_supervision_final', $arr);
        }
    }

    // update data;
    public function supervision_final_edit() {
        $schedule_detail_id = $_POST['id'];
        $row = $this->My_model->get_where_row('tb_supervision_final', array('schedule_detail_id' => $schedule_detail_id));
        echo json_encode($row);
    }

    // delete supervision final
    public function supervision_final_delete() {
        $schedule_detail_id = $_POST['id'];
        $this->My_model->delete_data('tb_supervision_final', array('schedule_detail_id' => $schedule_detail_id));
    }

    // ความเห็น-สรุปผลของผู้นิเทศ
    public function supervision_final_opinion_add() {
        $schedule_detail_id = $_POST['schedule_detail_id'];
        $status = $_POST['status'];
        if ($status == 'ปรับปรุงข้อมูล') {
            $arr = array(
                'supervision_opinion' => $this->input->post('inSupervisionOpinion'),
                'supervision_summary' => $this->input->post('inSupervisionSummary')
            );
            $this->My_model->update_data('tb_supervision_final_opinion', array('schedule_detail_id' => $schedule_detail_id), $arr);
        } else {
            $arr = array(
                'schedule_detail_id' => $schedule_detail_id,
                'supervision_opinion' => $this->input->post('inSupervisionOpinion'),
                'supervision_summary' => $this->input->post('inSupervisionSummary')
            );
            $this->My_model->insert_data('tb_supervision_final_opinion', $arr);
        }
    }

    // delete ความเห็น-สรุปผลฯ
    public function supervision_final_opinion_delete() {
        $schedule_detail_id = $_POST['id'];
        $this->My_model->delete_data('tb_supervision_final_opinion', array('schedule_detail_id' => $schedule_detail_id));
    }

    // ตาราง supervision final detail;
    public function supervision_final_detail_add() {
        $schedule_detail_id = $_POST['schedule_detail_id'];
        $id = $_POST['id'];
        if ($id != '') {
            $arr = array(
                'supervision_target' => $this->input->post('inSupervisionTarget'),
                'supervision_date' => $this->input->post('inSupervisionDate'),
                'supervision_media' => $this->input->post('inSupervisionMedia'),
                'supervision_feedback' => $this->input->post('inSupervisionFeedback')
            );
            $this->My_model->update_data('tb_supervision_final_detail', array('id' => $id), $arr);
        } else {
            $arr = array(
                'schedule_detail_id' => $schedule_detail_id,
                'supervision_target' => $this->input->post('inSupervisionTarget'),
                'supervision_date' => $this->input->post('inSupervisionDate'),
                'supervision_media' => $this->input->post('inSupervisionMedia'),
                'supervision_feedback' => $this->input->post('inSupervisionFeedback')
            );
            $this->My_model->insert_data('tb_supervision_final_detail', $arr);
        }
    }

    //supervision_final_detail_edit
    public function supervision_final_detail_edit() {
        $id = $_POST['id'];
        $row = $this->My_model->get_where_row('tb_supervision_final_detail', array('id' => $id));
        echo json_encode($row);
    }

    // supervision_final_detail_delete
    public function supervision_final_detail_delete() {
        $id = $_POST['id'];
        $this->My_model->delete_data('tb_supervision_final_detail', array('id' => $id));
    }

    public function get_teacher_list_by_class_id() {
        $id = $_POST['id'];
        $output = "";


        $teacher = $this->Supervision_model->get_teacher_list_by_class_id($id);
        if ($teacher) {
            foreach ($teacher as $r) {
                $output .= "<option value='" . $r['hr_fullname'] . "'>" . $r['hr_fullname'] . "</option>";
            }
        }
        echo $output;
    }

}
