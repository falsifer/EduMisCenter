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
  | Create Date 15/2/2562
  | Last edit	25/2/2562
  | Comment
  | ----------------------------------------------------------------------------
 */

class Classroom_online_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    function get_std_base_w_classroom_online_id($Classroom_online_id) {
        $this->db->select("CONCAT (a.std_titlename,a.std_firstname,\" \",a.std_lastname) as std_fullname,a.id as StdId,a.*");
        $this->db->select("b.tb_ed_classroom_number as std_number,");
        $this->db->select("c.tb_classroom_room as std_room_number,");
        $this->db->select("d.tb_ed_school_register_class_edyear as std_edyear,");
        $this->db->select("e.tb_ed_plan as std_plan,");
        $this->db->select("CONCAT (f.tb_ed_school_class_name,'ชั้นปีที ',f.tb_ed_school_class_level) as std_classname");
        $this->db->select("h.*,h.id as id");
        $this->db->from("tb_student_base a");

        $this->db->join("tb_ed_classroom b", "b.tb_student_base_id = a.id");
        $this->db->join("tb_ed_room c", "c.id = b.tb_ed_room_id");
        $this->db->join("tb_ed_school_register_class d", "d.id = c.tb_ed_school_register_class_id");
        $this->db->join("tb_ed_plan e", "e.id = c.tb_ed_plan_id");
        $this->db->join("tb_ed_school_class f", "f.id = d.tb_ed_school_class_id");

        $this->db->join("tb_member g", "g.id = a.tb_member_id");
        $this->db->join("tb_classroom_online_member h", "h.tb_member_id = g.id");

        $this->db->where('h.tb_classroom_online_id', $Classroom_online_id);

        $this->db->order_by("b.tb_ed_classroom_number asc");
        $MyQ = $this->db->get();
        if ($MyQ->num_rows() > 0) {
            return $MyQ->result_array();
        } else {
            return false;
        }
    }

//    title: "14103 - ตรรกะศาสตร์",
//              avatar:
//              "https://icon-library.net/images/homework-icon-png/homework-icon-png-25.jpg",
//              subtitle: "แบบฝึกหัด หน้า 14-18",
//              deadline: "6 ก.ย. 62",
//              status : "ใกล้วันส่ง"

    function get_homework_by_std_id($StdId, $school_id) {
        $this->db->select("CONCAT (a.std_titlename,a.std_firstname,\" \",a.std_lastname) as std_fullname,a.id as StdId,");
//        $this->db->select("b.tb_human_resources_01_id,");
        $this->db->select("c.tb_classroom_online_name,");
        $this->db->select("d.tb_course_code,");
        $this->db->select("e.tb_subject_name,e.tb_subject_type");
        $this->db->select("f.hr_image,f.id as hr_id");
        $this->db->select("CONCAT (f.hr_thai_symbol,f.hr_thai_name,\" \",f.hr_thai_lastname) as hr_fullname");
        $this->db->select("j.id as homework_id,j.*");
        $this->db->select("i.tb_classroom_online_work_assignment_status as homework_status");


        $this->db->from("tb_student_base a");
        $this->db->join("tb_member g", "g.id = a.tb_member_id");
        $this->db->join("tb_classroom_online_work_assignment i", "i.tb_member_id = g.id");
        $this->db->join("tb_classroom_online_work j", "j.id = i.tb_classroom_online_work_id");
        $this->db->join("tb_classroom_online c", "c.id = j.tb_classroom_online_id");

//$this->db->join("tb_classroom_online_member h", "h.tb_member_id = g.id");



        $this->db->join("tb_course_detail b", "b.id = c.tb_course_detail_id");

        $this->db->join("tb_course d", "d.id = b.tb_course_id");
        $this->db->join("tb_subject e", "e.id = d.tb_subject_id");
        $this->db->join("tb_human_resources_01 f", "f.id = b.tb_human_resources_01_id");




        $this->db->where('a.id', $StdId);

//        $this->db->order_by("b.tb_classroom_online_work_enddate asc");
        $MyQ = $this->db->get();

        $MyArray = array();
        if ($MyQ->num_rows() > 0) {
            $arr = $MyQ->result_array();
//            print_r($arr);
            $i = 0;

            foreach ($arr as $r) {

                if ($r['hr_image'] != "") {
                    $hr_pic = base_url() . hr_path($r['hr_id'], $school_id) . $r['hr_image'];
                } else {
                    $hr_pic = "https://icon-library.net/images/homework-icon-png/homework-icon-png-25.jpg";
                }

                if ($r['tb_classroom_online_work_file'] != "") {
                    $homework_file = base_url() . other_path($school_id) . $r['tb_classroom_online_work_file'];
                } else {
                    $homework_file = "";
                }


                $homework_status = $r['homework_status'];
                if ($r['homework_status'] == 'success') {
                    $homework_status = 'ส่งแล้ว';
                } else {
//$homework_status = "abcd";
                    $today = strtotime(date('Y-m-d'));
                    $deadline = strtotime($r['tb_classroom_online_work_enddate']);
                    $startline = strtotime($r['tb_classroom_online_work_startdate']);
                    $diff = $today - $deadline;
//                    $mydate = $diff->format("%a");
                    $cal = ($diff / 86400);


                    if ($startline == $today) {
                        $homework_status = 'ใหม่';
                    } else {
                        if ($cal > 0) {
                            $homework_status = 'ยังไม่ส่ง';
                        } elseif ($cal == 1) {
                            $homework_status = 'ใกล้วันส่ง';
                        } elseif ($cal < 1) {
                            $homework_status = 'ปกติ';
                        }
                    }
                }

//                 status : 
//                 "ยังไม่ส่ง" = การบ้าน > today
//                 ,"ใหม่"  = การบ้าน = today
//                 ,"ใกล้วันส่ง" = การบ้าน < today = 1
//                 ,"ส่งแล้ว" = status

                $coursetitle = $r['tb_course_code'] . " - " . $r['tb_subject_name'];
                $WorkArray = array(
                    'StdId' => $r['StdId'],
                    'classroom_name' => $r['tb_classroom_online_name'],
//                    'course_code' => $r['tb_course_code'],
//                    'subject_name' => $r['tb_subject_name'],
                    'title' => $coursetitle,
                    'subject_type' => $r['tb_subject_type'],
                    'avatar' => $hr_pic,
                    'hr_fullname' => $r['hr_fullname'],
                    'homework_id' => $r['homework_id'],
                    'subtitle' => $r['tb_classroom_online_work_name'],
                    'homework_detail' => $r['tb_classroom_online_work_detail'],
                    'homework_type' => $r['tb_classroom_online_work_type'],
                    'homework_file' => $homework_file,
                    'status' => $homework_status,
                    'homework_startdate' => shortdate($r['tb_classroom_online_work_startdate']),
                    'deadline' => shortdate($r['tb_classroom_online_work_enddate']),
                );
                $MyArray[$i] = ($WorkArray);
                $i++;
            }

            return $MyArray;
        } else {
            return false;
        }
    }

}
