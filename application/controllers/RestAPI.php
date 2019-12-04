<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/*
  | ============================================================================
  |  Title: Class Setting
  | ============================================================================
  | Copyright	Edutech Co.,Ltd.
  | Purpose     กำหนดค่าเร่ิมต้นของโปรแกรม
  | Author	นายบัณฑิต ไชยดี
  | Create Date  November 13, 2018
  | Last edit	-
  | Comment	-
  | ============================================================================
 */

class RestAPI extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model("Homeroom_model");
        $this->load->model("Std_model");
        $this->load->model("RestAPI_model");
        $this->load->model("PR_model");
        $this->load->model("Classroom_online_model");
    }

    public function check_login() {

        if (($this->input->get('username') != null) && ($this->input->get('password') != null)) {
            $username = $this->input->get('username');
            $password = $this->input->get('password');
        }
        $row = $this->My_model->get_where_row("tb_member", array("username" => $username, 'password' => $password));

        if (isset($row['id'])) {

            if ($row['status'] == "นักเรียน") {
                $tmp = $this->My_model->get_where_row("tb_student_base", array("tb_member_id" => $row['id']));
            } else {
                $tmp = $this->My_model->get_where_row("tb_human_resources_01", array("tb_member_id" => $row['id']));
            }

            if (isset($tmp['id'])) {
                $hr_id = $tmp['id'];
                if ($row['status'] == "นักเรียน") {
                    $name = $tmp['std_titlename'] . $tmp['std_firstname'] . ' ' . $tmp['std_lastname'];
                } else {
                    $name = $tmp['hr_thai_symbol'] . $tmp['hr_thai_name'] . ' ' . $tmp['hr_thai_lastname'];
                }
            } else {
                $hr_id = '';
                $name = $row['member_name'] . ' ' . $row['member_lastname'];
            }

            $tmp = $this->My_model->get_where_row("tb_school", array("sc_thai_name" => $row['department']));
            if (isset($tmp['id'])) {
                $sch_id = $tmp['id'];
                $org = $tmp['sc_localgov'];
            }
            if (isset($org) && isset($sch_id)) {
                $arr = array(
                    'log_status' => 'success',
                    'name' => $name,
                    'status' => $row['status'],
                    "department" => $row['department'],
                    'localgov' => $org,
                    'hr_id' => $hr_id,
                    'member_id' => $row['id'],
                    'sch_id' => $sch_id
                );
            } else {
                $arr = array(
                    'log_status' => 'fail',
                    'name' => $username
                );
            }
        } else {
            $arr = array(
                'log_status' => 'fail',
                'name' => $username
            );
        }

        echo json_encode($arr);
    }

    public function update_absent_record() {
        $recorder = "";
        $department = "";
        if ($this->input->get('std_id') != null) {
            $std_id = $this->input->get('std_id');
        }
        if ($this->input->get('absent') != null) {
            $absent = $this->input->get('absent');
        }
//        if($this->input->get('recorder')!=null){
//            $recorder = $this->input->get('recorder');
//        }
//        if($this->input->get('department')!=null){
//            $department = $this->input->get('department');
//        }
        $StdStatus = $this->Homeroom_model->get_std_absent_record_w_stdid_n_date($std_id, (date('Y') + 543) . "-" . date('m-d'));
        $arr = array(
            'tb_student_absent_record_status' => strtoupper($absent),
            'tb_student_base_id' => $std_id,
            'tb_std_absent_record_date' => (date('Y') + 543) . "-" . date('m-d'),
            "tb_student_absent_record_recorder" => $recorder,
            "tb_student_absent_record_department" => $department,
            'tb_student_absent_record_createdate' => date('Y-m-d')
        );
        if (!$StdStatus) {

            $id = $this->My_model->insert_data("tb_std_absent_record", $arr);
        } else {
            $id = $StdStatus['ed_absent_record_id'];
            $this->My_model->update_data("tb_std_absent_record", array('id' => $id), $arr);
        }
        if ($id != null && $id != "") {
            echo json_encode(array('status' => 'success'));
        } else {
            echo json_encode(array('status' => 'fail'));
        }
    }

    public function get_std_homeroom() {


        if ($this->input->get('hr_id') != null) {
            $hr_id = $this->input->get('hr_id');
        }
        if ($this->input->post('hr_id') != null) {
            $hr_id = $this->input->post('hr_id');
        }

        $row = $this->RestAPI_model->get_ed_homeroom_w_hr_id($hr_id);
        $arr = array();
        if (isset($row[0])) {

            foreach ($row as $r) {

                $Student = $this->Std_model->get_std_base_w_roomid_return_array($r->ed_roomid);
                foreach ($Student as $Std) {
                    $ar = array(
                        'std_number' => $Std['std_number'],
                        'std_code' => $Std['std_code'],
                        'std_full_name' => $Std['std_fullname'],
                        'std_profile_image' => $Std['std_profile_picture'],
                        'std_nickname' => $Std['std_nickname'] == null ? "" : $Std['std_nickname'],
                        'std_id' => $Std['StdId']
                    );
                    array_push($arr, $ar);
                }
            }
        } else {
            $arr = array(
                'request_status' => 'fail'
            );
        }
        echo json_encode($arr);
    }

    public function get_std_homeroom_absent() {


        if ($this->input->get('hr_id') != null) {
            $hr_id = $this->input->get('hr_id');
        }
        if ($this->input->post('hr_id') != null) {
            $hr_id = $this->input->post('hr_id');
        }

        $row = $this->RestAPI_model->get_ed_homeroom_w_hr_id($hr_id);
        $arr = array();
        if (isset($row[0])) {

            foreach ($row as $r) {

                $Student = $this->Std_model->get_std_base_w_roomid_return_array($r->ed_roomid);
                foreach ($Student as $Std) {
                    $ab = $this->My_model->get_where_row('tb_std_absent_record', array('tb_student_base_id' => $Std['StdId'], 'tb_std_absent_record_date' => (date('Y') + 543) . "-" . date('m-d')));

                    if (isset($ab['tb_student_absent_record_status'])) {
                        $ar = array(
                            'std_number' => $Std['std_number'],
                            'std_code' => $Std['std_code'],
                            'std_full_name' => $Std['std_fullname'],
                            'std_profile_image' => $Std['std_profile_picture'],
                            'std_nickname' => $Std['std_nickname'] == null ? "" : $Std['std_nickname'],
                            'std_id' => $Std['StdId'],
                            'absent' => $ab['tb_student_absent_record_status']
                        );
                    } else {
                        $ar = array(
                            'std_number' => $Std['std_number'],
                            'std_code' => $Std['std_code'],
                            'std_full_name' => $Std['std_fullname'],
                            'std_profile_image' => $Std['std_profile_picture'],
                            'std_nickname' => $Std['std_nickname'] == null ? "" : $Std['std_nickname'],
                            'std_id' => $Std['StdId'],
                            'absent' => 'C'
                        );
                    }

                    array_push($arr, $ar);
                }
            }
        } else {
            $arr = array(
                'request_status' => 'fail'
            );
        }
        echo json_encode($arr);
    }

    function get_std_list_by_vehicle() {
        if ($this->input->get('hr_id') != null) {
            $hr_id = $this->input->get('hr_id');

            $this->db->select("*,CONCAT (a.std_titlename,a.std_firstname,\" \",a.std_lastname) as std_fullname");
            $this->db->select("a.id as StdId");
            $this->db->select("concat(tb_ed_school_class_abbreviation,'.',tb_ed_school_class_level,'/',r.tb_classroom_room) as class");

            $this->db->from('tb_student_base a');

            $this->db->join('tb_school_bus b', 'b.tb_student_id=a.id');
            $this->db->join('tb_vehicle v', 'v.id=b.tb_vehicle_id');
//            $this->db->join('tb_school_bus_transfer c', 'c.tb_student_id=b.tb_student_id', 'left outer');

            $this->db->join("tb_ed_classroom cr", "cr.tb_student_base_id=a.id");
            $this->db->join("tb_ed_room r", "r.id = cr.tb_ed_room_id");
            $this->db->join("tb_ed_school_register_class d", "d.id = r.tb_ed_school_register_class_id");
            $this->db->join("tb_ed_school_class cl", "cl.id = d.tb_ed_school_class_id");

            $this->db->where(array('v.hr_id' => $hr_id));
            $this->db->order_by('a.std_firstname');
            $rs = $this->db->get();
        }
        if (isset($rs)) {

            $rs = $rs->result_array();

            $arr = array();

            foreach ($rs as $r) {

                $tmp = $this->Std_model->get_std_base_w_stdid_return_row($r['StdId']);
//$vc_id, $std_id, $sch_id, $status
                $MyQ = $this->db->select("*")->from("tb_vehicle")->where("hr_id", $hr_id)->get()->row_array();
                
                $phome = $this->RestAPI_model->get_transfer_status($MyQ['id'], $r['StdId'], $MyQ['tb_school_id'], "รับจากบ้าน");
                $dsch = $this->RestAPI_model->get_transfer_status($MyQ['id'], $r['StdId'], $MyQ['tb_school_id'], "ถึงโรงเรียน");
                $psch = $this->RestAPI_model->get_transfer_status($MyQ['id'], $r['StdId'], $MyQ['tb_school_id'], "รับจากโรงเรียน");
                $dhome = $this->RestAPI_model->get_transfer_status($MyQ['id'], $r['StdId'], $MyQ['tb_school_id'], "ถึงบ้าน");

                $ar = array(
                    'std_class' => $r['class'],
                    'std_full_name' => $r['std_fullname'],
                    'std_profile_image' => isset($tmp['std_profile_picture']) ? $tmp['std_profile_picture'] : base_url('images/avata.png'),
                    'std_nickname' => $r['std_nickname'] == null ? "" : $r['std_nickname'],
                    'std_id' => $r['StdId'],
                    'phome' => ($phome['tb_school_bus_transfer_datetime'] != null) ? date('H:i',strtotime($phome['tb_school_bus_transfer_datetime'])) : null,
                    'dsch' => ($dsch['tb_school_bus_transfer_datetime'] != null) ? date('H:i',strtotime($dsch['tb_school_bus_transfer_datetime'])) : null,
                    'psch' => ($psch['tb_school_bus_transfer_datetime'] != null) ? date('H:i',strtotime($psch['tb_school_bus_transfer_datetime'])) : null,
                    'dhome' => ($dhome['tb_school_bus_transfer_datetime'] != null) ? date('H:i',strtotime($dhome['tb_school_bus_transfer_datetime'])) : null,
                );
                array_push($arr, $ar);

            }
        } else {


            $arr = array(
                'request_status' => 'fail'
            );
        }

        echo json_encode($arr);
    }

    function get_schedule_by_teacher() {
        if ($this->input->get('hr_id') != null) {

            $hr_id = $this->input->get('hr_id');
            $dArr = array(
                'จันทร์' => $this->get_schd(1, $hr_id),
                'อังคาร' => $this->get_schd(2, $hr_id),
                'พุธ' => $this->get_schd(3, $hr_id),
                'พฤหัสบดี' => $this->get_schd(4, $hr_id),
                'ศุกร์' => $this->get_schd(5, $hr_id),
            );
        } else {


            $dArr = array(
                'request_status' => 'fail'
            );
        }

        echo json_encode($dArr);
    }

    function get_schedule_by_std() {
        if ($this->input->get('hr_id') != null) {

            $hr_id = $this->input->get('hr_id');
            $dArr = array(
                'จันทร์' => $this->get_schd_std(1, $hr_id),
                'อังคาร' => $this->get_schd_std(2, $hr_id),
                'พุธ' => $this->get_schd_std(3, $hr_id),
                'พฤหัสบดี' => $this->get_schd_std(4, $hr_id),
                'ศุกร์' => $this->get_schd_std(5, $hr_id),
            );
        } else {


            $dArr = array(
                'request_status' => 'fail'
            );
        }

        echo json_encode($dArr);
    }

    function get_schd_std($i, $std) {
        $arr = array();
        $this->db->select('sec.*,s.tb_subject_name,a.*,a.id as ScheduleId,b.tb_human_resources_01_id,c.tb_course_code,d.tb_ed_school_register_class_edyear');
        $this->db->select('e.*,CONCAT (f.tb_ed_school_class_abbreviation,".",f.tb_ed_school_class_level,"/",e.tb_classroom_room) as ed_classroom');
        $this->db->from('tb_ed_schedule a');
        $this->db->join('tb_ed_section sec', 'sec.id = a.tb_ed_section_id');
        $this->db->join('tb_course_detail b', 'b.id = a.tb_course_detail_id');
        $this->db->join('tb_course c', 'c.id = b.tb_course_id');
        $this->db->join('tb_subject s', 's.id = c.tb_subject_id');
        $this->db->join('tb_ed_school_register_class d', 'd.id = c.tb_ed_school_register_class_id');
        $this->db->join('tb_ed_room e', 'e.id = a.tb_ed_room_id');
        $this->db->join('tb_ed_school_class f', 'f.id = d.tb_ed_school_class_id');
        $this->db->join('tb_ed_classroom cl', 'cl.tb_ed_room_id=e.id');
        $this->db->where('a.tb_ed_schedule_day', $i);
        $this->db->where('a.tb_ed_schedule_term', $this->get_term());
        $this->db->where('cl.tb_student_base_id', $std);
        $this->db->where('d.tb_ed_school_register_class_edyear', get_edyear());
        $this->db->order_by('a.tb_ed_section_id');
        $rs = $this->db->get();


        if (isset($rs)) {

            $rs = $rs->result_array();


            foreach ($rs as $r) {

                $ar = array(
                    'title' => $r['tb_subject_name'] . " " . $r['tb_course_code'],
                    'subtitle' => $r['ed_classroom'],
                    'time' => date_format(date_create($r['tb_ed_section_start']), "H:i") . "-" . date_format(date_create($r['tb_ed_section_end']), "H:i")
                );
                array_push($arr, $ar);
            }
        }
        return $arr;
    }

    function get_schd($i, $hr_id) {
        $arr = array();
        $this->db->select('sec.*,s.tb_subject_name,a.*,a.id as ScheduleId,b.tb_human_resources_01_id,c.tb_course_code,d.tb_ed_school_register_class_edyear');
        $this->db->select('e.*,CONCAT (f.tb_ed_school_class_abbreviation,".",f.tb_ed_school_class_level,"/",e.tb_classroom_room) as ed_classroom');
        $this->db->from('tb_ed_schedule a');
        $this->db->join('tb_ed_section sec', 'sec.id = a.tb_ed_section_id');
        $this->db->join('tb_course_detail b', 'b.id = a.tb_course_detail_id');
        $this->db->join('tb_course c', 'c.id = b.tb_course_id');
        $this->db->join('tb_subject s', 's.id = c.tb_subject_id');
        $this->db->join('tb_ed_school_register_class d', 'd.id = c.tb_ed_school_register_class_id');
        $this->db->join('tb_ed_room e', 'e.id = a.tb_ed_room_id');
        $this->db->join('tb_ed_school_class f', 'f.id = d.tb_ed_school_class_id');
        $this->db->where('a.tb_ed_schedule_day', $i);
        $this->db->where('a.tb_ed_schedule_term', $this->get_term());
        $this->db->where('b.tb_human_resources_01_id', $hr_id);
        $this->db->where('d.tb_ed_school_register_class_edyear', get_edyear());
        $this->db->order_by('a.tb_ed_section_id');
        $rs = $this->db->get();


        if (isset($rs)) {

            $rs = $rs->result_array();


            foreach ($rs as $r) {

                $ar = array(
                    'title' => $r['tb_subject_name'] . " " . $r['tb_course_code'],
                    'subtitle' => $r['ed_classroom'],
                    'time' => date_format(date_create($r['tb_ed_section_start']), "H:i") . "-" . date_format(date_create($r['tb_ed_section_end']), "H:i")
                );
                array_push($arr, $ar);
            }
        }
        return $arr;
    }

    function get_term() {
        if (date('m') > 4 && date('m') < 10) {
            return 1;
        } else {
            return 2;
        }
    }

    public function get_activity_plan() {
        if ($this->input->get('sch_id') != null) {
            $arr = array();
            $monthly = date("Y-m-1");
            $y = date('Y');
            if (date('m') < 12) {
                $tmp = date('m') + 1;
                $monthly2 = date("Y-" . $tmp . "-31");
            } else {
                $tmp = date('Y') + 1;
                $monthly2 = date($tmp . "-1-31");
            }

//            $dArry[0]=array('start'=>$monthly,'end'=>$monthly2,'dept'=>$this->input->get('sch_id'));
//            $this->db->where('tb_activity_plan_start_date >=', $monthly);
            $this->db->where('tb_activity_plan_end_date <=', $monthly2);
            $rs = $this->My_model->get_where_order("tb_activity_plan", array("tb_school_id" => $this->input->get('sch_id')), "tb_activity_plan_start_date asc");
            $dArry = array();
            $i = 1;
            foreach ($rs as $r) {
                $ar = array(
                    'date' => $r['tb_activity_plan_start_date'],
                    'dateTH' => shortdate($r['tb_activity_plan_start_date']),
                    'title' => $r['tb_activity_plan_subject'],
                    'detail' => $r['tb_activity_plan_detail'],
                );
//                $arr = array($r['tb_activity_plan_start_date'] => $ar);
                array_push($dArry, $ar);
            }
        } else {


            $dArry = array(
                'request_status' => 'fail'
            );
        }

        echo json_encode($dArry);
    }

    public function get_advertise() {
        if ($this->input->get('sch_id') != null) {
            $arr = array();


            $advertising = $this->Pr_model->get_PR_by_school($this->input->get('sch_id'));
            $i = 1;

            foreach ($advertising as $r) {
                $img = "";
                if (file_exists('upload/' . $r['pr_image_1']) && !empty($r['pr_image_1'])) {
                    $img = base_url() . 'upload/' . $r['pr_image_1'];
                }
                $ar = array(
                    'title' => $r['pr_topic'],
                    'time' => datethaifull($r['pr_date']),
                    'description' => $r['pr_detail'],
                    'banner' => $img
                );

                array_push($arr, $ar);
            }
        } else {


            $arr = array(
                'request_status' => 'fail'
            );
        }

        echo json_encode($arr);
    }

    public function get_student() {
        if ($this->input->get('hr_id') != null) {

            $tmp = $this->Std_model->get_std_base_w_stdid_return_row($this->input->get('hr_id'));
            if (isset($tmp[0])) {
                $arr = $tmp[0];
                $ar = $this->RestAPI_model->get_admin_score($this->input->get('hr_id'));
                $arr = array_merge($tmp[0], $ar);
            } else {

                $arr = array(
                    'request_status' => 'fail'
                );
            }
        } else {

            $arr = array(
                'request_status' => 'fail'
            );
        }
        echo json_encode($arr);
    }

    public function get_homework() {
        $std_id = $this->input->get('hr_id');
        $sch_id = $this->input->get('sch_id');
        if ($std_id != null) {

            $rs = $this->Classroom_online_model->get_homework_by_std_id($std_id, $sch_id);
//            if (!$rs) {
//                $arr = array(
//                    'request_status' => 'fail'
//                );
//               
//            } else {
            $arr = $rs;
//            }
            /* tb_classroom_online_work_startdate = วันเริ่ม
              tb_classroom_online_work_enddate = วันจบ
              tb_classroom_online_work_name = ชื่อการบ้าน
              tb_classroom_online_work_detail = รายละเอียดการบ้าน
              tb_classroom_online_work_assignment_status = สถานะ
              สถานะมี Waiting = ยังไม่เสร็จ/รอทำ Success = การบ้านเสร็จแล้ว

              {
              title: "14103 - ตรรกะศาสตร์",
              avatar:
              "https://icon-library.net/images/homework-icon-png/homework-icon-png-25.jpg",
              subtitle: "แบบฝึกหัด หน้า 14-18",
              deadline: "6 ก.ย. 62",
              status : "ใกล้วันส่ง"
              }
             *              */
        } else {

            $arr = array(
                'request_status' => 'fail'
            );
        }
        echo json_encode($arr);
    }

    public function get_std_absent_stat() {
        $std_id = $this->input->get('hr_id');

        if ($std_id != null) {
            $start = get_edyear() . date("-05-01");
            $end = (get_edyear() + 1) . date("-03-31");
            $rs = $this->RestAPI_model->get_absent_record_stat_by_student_id($std_id, $start, $end);

            $arr = array();

            foreach ($rs as $r) {
                $ar = array(
                    'name' => $r['name'],
                    'amt' => $r['amt']
                );
                array_push($arr, $ar);
            }
        } else {

            $arr = array(
                'request_status' => 'fail'
            );
        }
        echo json_encode($arr);
    }

    public function get_std_absent_all() {
        $std_id = $this->input->get('hr_id');

        if ($std_id != null) {
            $start = get_edyear() . date("-05-01");
            $end = (get_edyear() + 1) . date("-03-31");
            $rs = $this->RestAPI_model->get_absent_record_all_by_student_id($std_id, $start, $end);

            $arr = $rs;
        } else {

            $arr = array(
                'request_status' => 'fail'
            );
        }
        echo json_encode($arr);
    }

    function insert_student_school_bus() {

        $hr_id = $this->input->get('hr_id');
        $sch_id = $this->input->get('sch_id');
        $std_id = $this->input->get('std_id');
        $status = $this->input->get('status');

        $id = $this->RestAPI_model->insert_student_school_bus($hr_id, $sch_id, $std_id, $status);

        if (isset($id)) {
            $arr = array();
            $MyQ = $this->db->select_max("id")->from("tb_vehicle")->where("hr_id", $hr_id)->get()->row_array();
            $sql = 'SELECT * FROM tb_school_bus_transfer '
                    . 'WHERE DATE_FORMAT(`tb_school_bus_transfer_datetime`, "%Y %m %d") = '
                    . 'DATE_FORMAT("' . date('Y-m-d') . '", "%Y %m %d") '
                    . 'and tb_vehicle_id = "' . $MyQ['id'] . '" '
                    . 'and tb_student_id = "' . $std_id . '"  '
                    . 'and tb_school_id = "' . $sch_id . '"  '
                    . 'ORDER BY `tb_school_bus_transfer`.`tb_school_bus_transfer_datetime` DESC';
//            $ar = array(
//                'tb_vehicle_id' => $MyQ['id'],
//                'tb_student_id' => $std_id,
//                'tb_school_id' => $sch_id,
//                'DATE_FORMAT(`tb_school_bus_transfer_datetime`, "%Y %m %d") ='=> 'DATE_FORMAT("'.date('Y-m-d').'", "%Y %m %d")'
//            );
//
//            $rs = $this->My_model->get_where_order('tb_school_bus_transfer', $ar, 'tb_student_id');
//            print($sql);
            $rs = $this->db->query($sql)->result_array();

            foreach ($rs as $r) {
                $ar = array(
                    'std_id' => $r['tb_student_id'],
                    'status' => $r['tb_school_bus_transfer_destination'],
                    'time' => date('H:i', strtotime($r['tb_school_bus_transfer_datetime'])),
                );
                array_push($arr, $ar);
            }
        } else {

            $arr = array(
                'request_status' => 'fail'
            );
        }

        echo json_encode($arr);
    }

}
