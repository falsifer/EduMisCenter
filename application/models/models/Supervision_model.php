<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/*
  | ----------------------------------------------------------------------------
  |  Title  Task_model
  | ----------------------------------------------------------------------------
  | Copyright	Edutech Co.,Ltd.
  | Purpose     โมเดลสำหรับตารางการดำเนินงานโครงการ
  | Author
  | Create Date 25/11/2018
  | Last edit	-
  | Comment	-
  | ----------------------------------------------------------------------------
 */

class Supervision_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function get_all() {
        $this->db->select('a.id id,a.tb_division_name,b.id,b.`tb_supervision_title_detail`, avg(c.tb_supervision_rating) rating');
        $this->db->from('tb_division a');
        $this->db->join('tb_supervision_title b', 'b.tb_division_id=a.id', 'left outer');
        $this->db->join('tb_supervision_sub_title d', 'd.tb_supervision_title_id=b.id', 'left outer');
        $this->db->join('tb_supervision c', 'd.id = c.tb_supervision_sub_title_id', 'left outer');
        $this->db->group_by('a.id,a.tb_division_name,`b`.`id`,b.`tb_supervision_title_detail`');
        $this->db->order_by('a.id,b.id');

        $query = $this->db->get();
        if ($query->num_rows() != 0) {
            return $query->result_array();
        } else {
            return array();
        }
    }

    public function get_supervision_form() {
        $this->db->select('b.tb_supervision_title_detail as tb_supervision_title_detail, d.tb_supervision_sub_title_detail as tb_supervision_sub_title_detail');
        $this->db->from('tb_supervision_title b');
        $this->db->join('tb_supervision_sub_title d', 'd.tb_supervision_title_id=b.id');
        $this->db->order_by('b.id,d.id');


        $query = $this->db->get();
        if ($query->num_rows() != 0) {
            return $query->result_array();
        } else {
            return array();
        }
    }

    function get_all_title() {
        $query = $this->db->get('tb_supervision_title');
        if ($query->num_rows() != 0) {
            return $query->result_array();
        } else {
            return array();
        }
    }

    function get_title($param) {
        $query = $this->db->get_where('tb_supervision_title', array('id' => $param));
        if ($query->num_rows() != 0) {
            return $query->result_array();
        } else {
            return array();
        }
    }

    function get_sub_title_by_title($param) {
        $query = $this->db->get_where('tb_supervision_sub_title', array('tb_supervision_title_id' => $param));
        if ($query->num_rows() != 0) {
            return $query->result_array();
        } else {
            return array();
        }
    }

    function get_division() {
        $query = $this->db->get('tb_division');
        if ($query->num_rows() != 0) {
            return $query->result_array();
        } else {
            return array();
        }
    }

    function fetch_member($param) {
        $this->db->where('department', $param);
        $this->db->order_by('member_name', 'asc');
        $query = $this->db->get('tb_member');
        $output = "<option value=''>---เลือกผู้รับการนิเทศ---</option>";
        foreach ($query->result() as $row) {
            $output .= "<option value='" . $row->member_name . " " . $row->member_lastname . "'>" . $row->member_name . " " . $row->member_lastname . "</option>";
        }
        return $output;
    }

    ############################################################################
    // ข้อมูลการนิเทศการศึกษาประจำปีการศึกษาปัจจุบัน

    function get_supervision_schedule() {
        $loan_year = get_edyear();
        $this->db->select('*,concat(tb_ed_school_class_abbreviation,'.',tb_ed_school_class_level) as class,  b.id AS detail_id')->from('tb_supervision_schedule a');
        $this->db->join('tb_supervision_schedule_detail b', 'b.schedule_id = a.id');
        $this->db->join('tb_course c', 'c.id = b.tb_course_id');
        $this->db->join("tb_subject f", "c.tb_subject_id = f.id");
        $this->db->join('tb_ed_school_register_class d','d.id=c.tb_ed_school_register_class_id');
        $this->db->join('tb_ed_school_class e','e.id=d.tb_ed_school_class_id');
        $this->db->where('a.loan_year', $loan_year);
        $this->db->order_by('b.schedule_date asc');
        
        
//        $this->db->select('*, c.id as detail_id')->from('tb_education_level a');
//        $this->db->join('tb_subject_detail b', 'b.level_id = a.id');
//        $this->db->join('tb_supervision_schedule_detail c', 'c.subject_detail_id = b.id');
//        $this->db->join('tb_supervision_schedule d', 'd.id = c.schedule_id');
//        $this->db->where('d.loan_year', $loan_year);
//        $this->db->order_by('d.loan_year asc, d.loan_term asc, c.schedule_date asc');
        //
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return array();
    }

    // ดึงข้อมูลการนิเทศเพียงเรคคอร์ดเดียว
    function get_supervision_schedule_row($plan_id) {
        
        
        $this->db->select('*,concat(tb_ed_school_class_abbreviation,'.',tb_ed_school_class_level) as class,  b.id AS detail_id')->from('tb_supervision_schedule a');
        $this->db->join('tb_supervision_schedule_detail b', 'b.schedule_id = a.id');
        $this->db->join('tb_course c', 'c.id = b.tb_course_id');
        $this->db->join("tb_subject f", "c.tb_subject_id = f.id");
        $this->db->join('tb_ed_school_register_class d','d.id=c.tb_ed_school_register_class_id');
        $this->db->join('tb_ed_school_class e','e.id=d.tb_ed_school_class_id');
        $this->db->where('b.id', $plan_id);
        $this->db->order_by('b.schedule_date asc');
        
        
//        $this->db->select('a.*, b.*, c.*, d.*, c.id as detail_id')->from('tb_education_level a');
//        $this->db->join('tb_subject_detail b', 'b.level_id = a.id');
//        $this->db->join('tb_supervision_schedule_detail c', 'c.subject_detail_id = b.id');
//        $this->db->join('tb_supervision_schedule d', 'd.id = c.schedule_id');
//        $this->db->where('c.id', $plan_id);
        //
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->row_array();
        }
        return array();
    }

    // ดึงข้อมูลรายวิชามาแสดง
    function get_subject1($learning_group) {
        $this->db->select("a.*, b.*, c.*, b.id AS subject_id")->from("tb_education_learning_group a");
        $this->db->join("tb_subject_detail b", "b.learning_group_id = a.id");
        $this->db->join('tb_education_level c', 'c.id = b.level_id');
        $this->db->where("a.education_group_name", $learning_group);
        $this->db->order_by('b.subject_code asc');
        //
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return array();
    }
    function get_subject($learning_group,$school) {
        $this->db->select("*,concat(tb_ed_school_class_abbreviation,'.',tb_ed_school_class_level) as class, b.id AS subject_id, c.id as cid")->from("tb_group_learning a");
        $this->db->join("tb_subject b", "b.tb_group_learning_id = a.id");
        $this->db->join('tb_course c', 'c.tb_subject_id = b.id');
        $this->db->join('tb_ed_school_register_class d','d.id=c.tb_ed_school_register_class_id');
        $this->db->join('tb_ed_school_class e','e.id=d.tb_ed_school_class_id');
        $this->db->where("a.tb_group_learningcol_name", $learning_group);
        $this->db->where("c.tb_course_department", $school);
        $this->db->order_by('tb_ed_school_class_abbreviation,tb_ed_school_class_level,c.tb_course_code asc');
        //
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return array();
    }

    // ดึงข้อมูลตารางการนิเทศการจัดการเรียนการสอนมาแสดง
    function get_supervision_schedule_detail2($id) {
        $this->db->select('a.*, b.*, c.*, d.*,b.id AS detail_id')->from('tb_supervision_schedule a');
        $this->db->join('tb_supervision_schedule_detail b', 'b.schedule_id = a.id');
        $this->db->join('tb_subject_detail c', 'c.id = b.subject_detail_id');
        $this->db->join('tb_education_level d', 'd.id = c.level_id');
        $this->db->where('b.schedule_id', $id);
        $this->db->order_by('b.schedule_date asc');
        //
        $result = $this->db->get();
        if ($result->num_rows() > 0) {
            return $result->result_array();
        }
        return array();
    }
    
    function get_supervision_schedule_detail($id) {
        $this->db->select('*,concat(tb_ed_school_class_abbreviation,'.',tb_ed_school_class_level) as class,  b.id AS detail_id')->from('tb_supervision_schedule a');
        $this->db->join('tb_supervision_schedule_detail b', 'b.schedule_id = a.id');
        $this->db->join('tb_course c', 'c.id = b.tb_course_id');
        $this->db->join("tb_subject f", "c.tb_subject_id = f.id");
        $this->db->join('tb_ed_school_register_class d','d.id=c.tb_ed_school_register_class_id');
        $this->db->join('tb_ed_school_class e','e.id=d.tb_ed_school_class_id');
        $this->db->where('b.schedule_id', $id);
        $this->db->order_by('b.schedule_date asc');
        //
        $result = $this->db->get();
        if ($result->num_rows() > 0) {
            return $result->result_array();
        }
        return array();
    }

    // ดึงข้อมูลการนิเทศการจัดการเรียนการสอนเพื่อแก้ไข
    public function get_suervision_schedule_detail_edit($id) {
        $this->db->select('a.*, b.*, c.*, d.*, b.id AS detail_id')->from('tb_supervision_schedule a');
        $this->db->join('tb_supervision_schedule_detail b', 'b.schedule_id = a.id');
        $this->db->join('tb_subject_detail c', 'c.id = b.subject_detail_id');
        $this->db->join('tb_education_level d', 'd.id = c.level_id');
        $this->db->where('b.id', $id);
        //
        $result = $this->db->get();
        if ($result->num_rows() > 0) {
            return $result->row_array();
        }
        return array();
    }

    // ดึงข้อมูลรายละเอียดแผนการนิเทศการศึกษา
    function get_supervision_plan_detail($plan_id) {
        $this->db->select('a.*, b.*, c.*, d.* , a.id as plan_detail_id')->from('tb_supervision_plan_detail a');
        $this->db->join('tb_supervision_plan b', 'b.id = a.plan_id');
        $this->db->join('tb_human_resources_01 c', 'c.id = a.hr_id');
        $this->db->join('tb_subject_detail d', 'd.id = a.subject_detail_id');
        $this->db->where('a.plan_id', $plan_id);
        $this->db->order_by('a.plan_detail_date asc');
        //
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return array();
    }

    // ดึงข้อมูลรายละเอียดแผนฯ เพื่อแก้ไข
    function get_supervision_plan_detail_edit($id) {
        $this->db->select('a.*, b.*, c.*, d.* , a.id as plan_detail_id')->from('tb_supervision_plan_detail a');
        $this->db->join('tb_supervision_plan b', 'b.id = a.plan_id');
        $this->db->join('tb_human_resources_01 c', 'c.id = a.hr_id');
        $this->db->join('tb_subject_detail d', 'd.id = a.subject_detail_id');
        $this->db->where('a.id', $id);
        //
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->row_array();
        }
        return array();
    }

    // ดึงข้อมูลบุคลากรตามเงื่อนไข
    function get_human_resources_type($type) {
        $this->db->select('a.*, b.*, b.id AS hr_id')->from('tb_human_resources_type a');
        $this->db->join('tb_human_resources_01 b', 'b.hr_type_id = a.id');
        $this->db->where('a.human_resources_type', $type);
//        $this->db->where('b.hr_department!=', 'กองการศึกษา');
        $this->db->order_by('b.hr_department,b.hr_thai_name');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return array();
    }
    
    // ดึงข้อมูลบุคลากรตามเงื่อนไข
    function get_human_resources_type_by_department($type,$department) {
        $this->db->select('a.*, b.*, b.id AS hr_id')->from('tb_human_resources_type a');
        $this->db->join('tb_human_resources_01 b', 'b.hr_type_id = a.id');
        $this->db->where('a.human_resources_type', $type);
        $this->db->where('b.hr_department', $department);
        $this->db->order_by('b.hr_department,b.hr_thai_name');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return array();
    }

    // ดึงข้อมูลบันทึกการสังเกตการสอน
    function get_observ($plan_id) {
        $this->db->select('*')->from('tb_supervision_schedule_detail a');
        $this->db->join('tb_supervision_observ b', 'b.schedule_detail_id = a.id');
        $this->db->where('b.schedule_detail_id', $plan_id);
        $query = $this->db->get();
        //
        if ($query->num_rows() > 0) {
            return $query->row_array();
        }
        return array();
    }

    // get observ for edit;
    function get_observ_edit($id) {
        $this->db->select('a.*, b.*, c.*, d.*, e.*, b.id AS observ_id')->from('tb_supervision_plan a');
        $this->db->join('tb_supervision_observ b', 'b.plan_id = a.id');
        $this->db->join('tb_human_resources_01 c', 'c.id = b.hr_id');
        $this->db->join('tb_school d', 'd.id = b.school_id');
        $this->db->join('tb_subject_detail e', 'e.id = b.subject_detail_id');
        $this->db->where('b.id', $id);
        //
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->row_array();
        }
        return array();
    }

    // ดึงข้อมูลกิจกรรมสำหรับการนิเทศระดับที่ 3 ไปแสดง
    function get_question_level3($level2_id) {
        $this->db->select('*')->from('tb_question_level1 a');
        $this->db->join('tb_question_level2 b', 'b.level1_id = a.id');
        $this->db->join('tb_question_level3 c', 'c.level2_id = b.id');
        $this->db->where('c.level2_id',$level2_id);
        //
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return array();
    }

    //
    function get_question_level3_row() {
        $this->db->select('*')->from('tb_question_level1 a');
        $this->db->join('tb_question_level2 b', 'b.level1_id = a.id');
        $this->db->join('tb_question_level3 c', 'c.level2_id = b.id');
        //
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->row_array();
        }
        return array();
    }

   function get_teacher_list_by_class_id($id){
        $this->db->select("CONCAT(a.hr_thai_symbol,a.hr_thai_name,\" \",a.hr_thai_lastname) as hr_fullname,a.id as hr_id");
        $this->db->from("tb_human_resources_01 a");
        $this->db->join('tb_course_detail b', 'b.tb_human_resources_01_id = a.id');
        $this->db->join('tb_course c', 'c.id = b.tb_course_id');
        $this->db->where('c.id', $id);

        $query = $this->db->get()->result_array();
        if ($query) {
            return $query;
        }else{
           return false; 
        }
    }
    
}
