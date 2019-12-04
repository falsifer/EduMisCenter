
<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/*
  | ----------------------------------------------------------------------------
  |  Title--> eSchool
  | ----------------------------------------------------------------------------
  | Copyright	สถาบันเทคโนโลยีพระจอมเกล้าเจ้าคุณทหารลาดกระบัง
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
        $this->load->model('Hr_model');
        $this->load->model('Manpower_model');
        $this->load->model('Chairatto_model');
        $this->load->model('Icare_model');
        $this->load->model('School_bus_model');
    }

    function edoc_download() {
        $id = $this->input->post('id');
        $arr = array(
            "outbox_status" => 'รับแล้ว',
        );
        $this->My_model->update_data('tb_edoc_outbox', array('id' => $id), $arr);
        if (!$this->My_model->chk_valid_data('tb_edoc_inbox', array('inbox_from' => $id))) {
            $arr = array(
                "inbox_date" => date('Y-m-d'),
                "inbox_from" => $id,
                "inbox_owner" => $this->session->userdata("name"),
                "inbox_department" => $this->session->userdata("department")
            );
            $this->My_model->insert_data('tb_edoc_inbox', $arr);
        }

        $rs = $this->My_model->get_where_row('tb_edoc_outbox', array('id' => $id));
        echo json_encode($rs);
    }

    //
    public function index() {

        $chk_org = $this->My_model->get_row("tb_organization");
        if (empty($chk_org)) {
            redirect("insert-organization");
        }
        //
        //
        
        if ($this->session->userdata("department") == "กองการศึกษา") {

            $data['vichakarn'] = $this->Eschool_model->get_menu('วิชาการ');
            $data['management'] = $this->Eschool_model->get_menu('บริหารงานทั่วไป');
            $data['human'] = $this->Eschool_model->get_menu('บุคลากร');
            $data['loan'] = $this->Eschool_model->get_menu('งบประมาณ');
            $data['vocational'] = $this->Eschool_model->get_menu('อาชีวศึกษา');

            $monthly = date("Y-m-1");
            $monthly2 = date("Y-m-31");
            $this->db->where('tb_activity_plan_start_date >=', $monthly);
            $this->db->where('tb_activity_plan_end_date <=', $monthly2);
            $data['rsAct'] = $this->My_model->get_where_order("tb_activity_plan", array("tb_activity_plan_responsible" => $this->session->userdata("responsible")), "tb_activity_plan_start_date asc");
            $monthly = date("Y-10-1");
            $monthly2 = date("Y-9-30", strtotime('+1 year'));
            $this->db->where('tb_activity_plan_start_date >=', $monthly);
            $this->db->where('tb_activity_plan_end_date <=', $monthly2);
            $data['rsActY'] = $this->My_model->get_where_order("tb_activity_plan", array("tb_activity_plan_responsible" => $this->session->userdata("responsible")), "tb_activity_plan_start_date asc");
            $data['task'] = $this->My_model->get_where_order("tb_personal_activities", array('activities_owner' => $this->session->userdata('name')), 'activities_begin desc');
        }
//        else {
//            $data['admin'] = $this->Eschool_model->get_menu_sch_by('ผู้ดูแลระบบ');
//            $data['vichakarn'] = $this->Eschool_model->get_menu_sch_by('วิชาการ');
//            $data['management'] = $this->Eschool_model->get_menu_sch_by('งานบริหารทั่วไป');
//            $data['human'] = $this->Eschool_model->get_menu_sch_by('บุคลากร');
//            $data['loan'] = $this->Eschool_model->get_menu_sch_by('งานงบประมาณ');
//            $data['vocational'] = $this->Eschool_model->get_menu_sch_by('อาชีวศึกษา');
//        }
        // งานประชาสัมพันธ์

        $data['advertising'] = $this->My_model->get_where_order('tb_public_relations', array('pr_status' => 'สาธารณะ'), 'pr_date desc');
        $data['advertising_in'] = $this->My_model->get_where_order('tb_public_relations', array('pr_status' => 'ภายใน', 'pr_department' => $this->session->userdata('department')), 'pr_date desc');


        //
        $data['school'] = $this->My_model->get_all_order("tb_school", 'sc_thai_name asc');


//        $data['last_slide'] = $this->My_model->get_all_limit('tb_carousel', 1, 'id desc');
//        $data['carousel'] = $this->My_model->get_all_order('tb_carousel', 'id asc');

        $data['menu'] = $this->Eschool_model->get_menu_sch();

        if ($this->session->userdata("status") == 'นักเรียน') {
            $this->load->view('layout/header_std');
            $this->load->view('school_std_zone', $data);
        } elseif ($this->session->userdata('status') == 'คนขับรถ') {
            $data['rs'] = $this->School_bus_model->get_std_list_by_vehicle();
            $this->load->view('layout/header_std');
            $this->load->view('school_bus/index', $data);
        } else {
            $this->load->view('layout/header');
            if ($this->session->userdata("status") != '' && $this->session->userdata("department") != 'กองการศึกษา') {
                $data['hr'] = $this->Hr_model->get_hr();
                $data['mp'] = $this->Manpower_model->get_manpower();
                $data['workStat'] = $this->Manpower_model->get_all_absent();
                $data['TaStat'] = $this->My_model->count_record_where('tb_human_resources_01', array('hr_department' => $this->session->userdata('department'), 'hr_rank' => 'ครู'));
                $data['StdStat'] = $this->My_model->count_record_where('tb_student_base', array('tb_student_base_department' => $this->session->userdata('department')));
                $data['TaGroupL'] = $this->Manpower_model->get_ta_group_learning();
                $data['HrGroup'] = $this->Manpower_model->get_hr_group();


                $data['absentStdStat'] = $this->Icare_model->get_all_absent();
                $data['stdStat'] = $this->Icare_model->get_std_gender_stat();
                $this->load->view('school_zone', $data);
            } else {
                if ($this->session->userdata('department') == 'กองการศึกษา') {

                    $data['hr'] = $this->Hr_model->get_hr();
                    $data['mp'] = $this->Manpower_model->get_manpower();
                    $data['workStat'] = $this->Manpower_model->get_all_absent();
                    $data['TaStat'] = $this->My_model->count_record_where('tb_human_resources_01', array('hr_department' => $this->session->userdata('department')));
                    $data['StdStat'] = $this->My_model->count_record_where('tb_student_base', '1=1');
                    $data['TaGroupL'] = $this->Manpower_model->get_ta_group_learning();
                    $data['HrGroup'] = $this->Manpower_model->get_hr_group();

                    $data['absentStdStat'] = $this->Icare_model->get_all_absent();
                    $data['stdStat'] = $this->Icare_model->get_std_gender_stat();
                }
                $this->load->view('mainpage', $data);
            }
        }
        $this->load->view('layout/footer');
    }

    // คัดแยกเส้นทางตามประเภทผู้ใช้งานระบบ
    public function get_user_zone() {
        if ($this->session->userdata('status') == "ผู้ดูแลระบบ") {
            redirect("administrator");
        } else {
            if ($this->session->userdata("department") == "กองการศึกษา") {
                redirect('education-department-zone');
            } else {
                redirect('school-department-zone');
            }
        }
    }

    // Education Department
    public function education_zone() {
        if ($this->session->userdata('status') == '') {
            //redirect('login');
        }
        //
        $data['vichakarn'] = $this->Eschool_model->get_menu('วิชาการ');
        $data['management'] = $this->Eschool_model->get_menu('บริหารงานทั่วไป');
        $data['human'] = $this->Eschool_model->get_menu('บุคลากร');
        $data['loan'] = $this->Eschool_model->get_menu('งบประมาณ');
        $data['advertising'] = $this->My_model->get_all_order('tb_public_relations', 'pr_date desc');
        //
        $data['school'] = $this->My_model->get_all_order("tb_school", 'sc_thai_name asc');
        $data['inbox'] = $this->My_model->get_where_order('tb_edoc_inbox', array('inbox_department' => $this->session->userdata('department')), 'inbox_date desc');
        $data['outbox'] = $this->My_model->get_where_order('tb_edoc_outbox', array('outbox_department' => $this->session->userdata('department')), 'outbox_date desc');
        $this->load->view("layout/header");
        $this->load->view("education_zone", $data);
        $this->load->view("layout/footer");
    }

    // School department
    public function school_zone() {
        if ($this->session->userdata('status') == '') {
            //redirect('login');
        }


        $monthly = date("Y-m-1");
        $monthly2 = date("Y-m-31");
        $this->db->where('tb_activity_plan_start_date >=', $monthly);
        $this->db->where('tb_activity_plan_end_date <=', $monthly2);
        $data['rsAct'] = $this->My_model->get_where_order("tb_activity_plan", array("tb_activity_plan_responsible" => $this->session->userdata("responsible")), "tb_activity_plan_start_date asc");
        $monthly = date("Y-10-1");
        $monthly2 = date("Y-9-30", strtotime('+1 year'));
        $this->db->where('tb_activity_plan_start_date >=', $monthly);
        $this->db->where('tb_activity_plan_end_date <=', $monthly2);
        $data['rsActY'] = $this->My_model->get_where_order("tb_activity_plan", array("tb_activity_plan_responsible" => $this->session->userdata("responsible")), "tb_activity_plan_start_date asc");




        $data['rs'] = array();
        $this->load->view("layout/header");
        $this->load->view("school_zone", $data);
        $this->load->view("layout/footer");
    }

    public function activity_plan() {
        $data['task'] = $this->My_model->get_where_order("tb_personal_activities", array('activities_owner' => $this->session->userdata('name')), 'activities_begin desc');

//        if ($this->session->userdata("department") != "กองการศึกษา") {

            $data['rsAct'] = $this->My_model->get_where_order("tb_activity_plan", array("tb_activity_plan_department" => $this->session->userdata("department")), "tb_activity_plan_start_date asc");

            $monthly = date("Y-10-1");
            $monthly2 = date("Y-9-30", strtotime('+1 year'));
            $this->db->where('tb_activity_plan_start_date >=', $monthly);
            $this->db->where('tb_activity_plan_end_date <=', $monthly2);
            $data['rsActY'] = $this->My_model->get_where_order("tb_activity_plan", array("tb_activity_plan_department" => $this->session->userdata("department")), "tb_activity_plan_start_date asc");
//        }

        $this->load->view('layout/header');
        $this->load->view('vichakarn/school/school_activity', $data);
        $this->load->view('layout/footer');
    }

    public function activity_plan_insert_view() {
        $data['rsAct'] = $this->My_model->get_where_order("tb_activity_plan", array("tb_school_id" => $this->session->userdata("sch_id")), "tb_activity_plan_start_date asc");
        $data['Division'] = $this->My_model->get_where_order("tb_division", array("tb_school_id" => $this->session->userdata("sch_id")), "id asc");
       
        load_view($this, 'vichakarn/school/school_activity_insert_view', $data);
    }

}
