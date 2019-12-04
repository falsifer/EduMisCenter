<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/*
  | ----------------------------------------------------------------------------
  |  Title  Vichakarn_model
  | ----------------------------------------------------------------------------
  | Copyright	Edutech Co.,Ltd.
  | Purpose     โมเดลสำหรับงานวิชาการแผนงานวิชาการ
  | Author
  | Create Date 16/12/2018
  | Last edit	-
  | Comment	-
  | ----------------------------------------------------------------------------
 */

class Ed_Classroom_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    // 
    function get_all() {
//        $this->db->where("tb_ed_classroom_department",$this->session->userdata("department"));
//        $rs = $this->db->get("tb_ed_room");
//        
        $this->db->select("a.id as SchId,a.tb_ed_school_register_class_edyear,  b.*,c.*,d.*,b.id as ClsId");
        $this->db->from("tb_ed_school_register_class a");
        $this->db->join("tb_ed_school_class b", "b.id = a.tb_ed_school_class_id");
        $this->db->join("tb_school c", "c.id = a.tb_school_id");
        $this->db->join("tb_ed_room d", "d.tb_ed_school_register_class_id = a.id", "left ounter");
        $this->db->where("c.sc_thai_name", $this->session->userdata("department"));
        //  $this->db->where("a.tb_ed_school_register_class_edyear", $MyEdYear);
        $this->db->order_by("a.tb_ed_school_register_class_edyear desc");
        $this->db->order_by("b.tb_ed_school_class_name asc");
        $this->db->order_by("b.tb_ed_school_class_level asc");
        $this->db->order_by("d.tb_classroom_room asc");
        $rs = $this->db->get();

        if ($rs->num_rows() > 0) {
            return $rs->result_array();
        }
        return array();
    }

    function get_course_mis() {
        $this->db->select('count(a.id) as sbj,b.tb_group_learningcol_name,b.tb_group_learning_seq ');
        $this->db->from('tb_group_learning b');
        $this->db->join('tb_subject a ', 'b.id = a.tb_group_learning_id ', 'left outer');
        $this->db->join('tb_course c ', 'c.tb_subject_id = a.id ', 'left outer');
        $this->db->where('c.tb_course_department', $this->session->userdata('department'));
        $this->db->where('tb_course_edyear', get_edyear());
        $this->db->group_by('b.tb_group_learningcol_name,b.tb_group_learning_seq');
        $this->db->order_by('b.tb_group_learning_seq asc');


        $rs = $this->db->get();
        if ($rs->num_rows() > 0) {
            return $rs->result_array();
        }
        return array();
    }

    function get_all_TA_available() {

        $this->db->select('*');
        $this->db->from('tb_human_resources_01 a');
        $this->db->where('a.id not in (select tb_human_resources_id from tb_ed_homeroom )');
        $this->db->where('a.hr_department', $this->session->userdata('department'));
        $this->db->order_by("a.hr_thai_name,a.hr_thai_lastname asc");


        $rs = $this->db->get();
        if ($rs->num_rows() > 0) {
            return $rs->result_array();
        }
        return array();
    }

    function get_all_course() {
        $this->db->select('a.id as cid,a.tb_course_code,d.tb_subject_name,a.tb_course_hour_week,cls.* ');
        $this->db->from('tb_course a');
        $this->db->join('tb_ed_school_register_class reg', 'a.tb_ed_school_register_class_id = reg.id');
        $this->db->join('tb_ed_school_class cls', 'cls.id = reg.tb_ed_school_class_id');
        $this->db->join('tb_course_detail b', 'a.id = b.tb_course_id', 'left outer');
        $this->db->join('tb_ed_schedule c', 'b.id = c.tb_course_detail_id', 'left outer');
        $this->db->join('tb_subject d ', 'd.id = a.tb_subject_id ');
        $this->db->where('a.tb_course_department', $this->session->userdata("department"));
        $this->db->group_by('a.id,a.tb_course_code,d.tb_subject_name,a.tb_course_hour_week');
        $rs = $this->db->get();
        if ($rs->num_rows() > 0) {
            return $rs->result_array();
        }
        return array();
    }

    function get_course_credit_balance($cid, $rid) {
        $this->db->select('count(c.tb_ed_section_id) as balance');
        $this->db->from('tb_course a');
        $this->db->join('tb_course_detail b', 'a.id = b.tb_course_id', 'left outer');
        $this->db->join('tb_ed_schedule c', 'b.id = c.tb_course_detail_id', 'left outer');
        $this->db->join('tb_subject d ', 'd.id = a.tb_subject_id ');
        $this->db->where('a.id', $cid);
        if (isset($rid)) {
            $this->db->where(array('c.tb_ed_room_id' => $rid));
        }
        $this->db->group_by('a.id,c.tb_ed_room_id');
        $rs = $this->db->get()->row_array();
        if (isset($rs)) {
            return $rs;
        }

        return array();
    }

    function get_all_course_by($yearly, $class, $lev, $rid, $term) {
        $this->db->select('a.id as cid,a.tb_course_code,d.tb_subject_name,a.tb_course_hour_week');
        $this->db->from('tb_course a');
        $this->db->join('tb_ed_school_register_class rc', 'a.tb_ed_school_register_class_id=rc.id');
        $this->db->join('tb_ed_school_class scc', 'scc.id=rc.tb_ed_school_class_id');
        $this->db->join('tb_subject d ', 'd.id = a.tb_subject_id ');
        $this->db->where('a.tb_course_department', $this->session->userdata("department"));
        $this->db->where(array('rc.tb_ed_school_register_class_edyear' => $yearly));
        $this->db->where(array('a.tb_course_term' => $term));
        $this->db->where(array('scc.tb_ed_school_class_name' => $class, 'scc.tb_ed_school_class_level' => $lev));
        $rs = $this->db->get();

        return $rs;
    }

    function get_course_code_by_course_detail($cdid) {
        $this->db->select('*');
        $this->db->from('tb_course a');
        $this->db->join('tb_course_detail b', 'a.id = b.tb_course_id');
        $this->db->where(array('b.id' => $cdid));

        $rs = $this->db->get();

        return $rs->row_array();
    }

    function get_available_teacher_course($yearly, $class, $lev, $sec, $day, $term) {
        $this->db->select('c.*,cd.*,hr.*,cd.id as cdid');
        $this->db->from('tb_course c');
        $this->db->join('tb_course_detail cd', 'c.id = cd.tb_course_id');
        $this->db->join('tb_human_resources_01 hr', 'hr.id = cd.tb_human_resources_01_id');
        if (isset($sec)) {
            $tmp = "hr.id not in ( select cd.tb_human_resources_01_id from tb_course_detail cd inner join ";
            $tmp .= "tb_ed_schedule sc on sc.tb_course_detail_id = cd.id where ";
            $tmp .= "sc.tb_ed_section_id='" . $sec . "' and sc.tb_ed_schedule_day='" . $day . "' )";
            $this->db->where($tmp);
        }
        $this->db->join('tb_ed_school_register_class rc', 'c.tb_ed_school_register_class_id=rc.id');
        $this->db->join('tb_ed_school_class scc', 'scc.id=rc.tb_ed_school_class_id');
        $this->db->where('c.tb_course_department', $this->session->userdata("department"));
//        $this->db->where(array('c.tb_course_edyear' => $yearly));
        $this->db->where(array('rc.tb_ed_school_register_class_edyear' => $yearly));
        $this->db->where(array('c.tb_course_term' => $term));
        $this->db->where(array('scc.tb_ed_school_class_name' => $class, 'scc.tb_ed_school_class_level' => $lev));
        $tmp = "c.id not in (select c.id from tb_ed_schedule sc inner join tb_course_detail cd";
        $tmp .= " on sc.tb_course_detail_id = cd.id inner join tb_course c on c.id = cd.tb_course_id ";
        $tmp .= "group by  c.id,sc.tb_ed_room_id having c.tb_course_hour_week - count(sc.tb_ed_section_id)<= 0  )";
        $this->db->where($tmp);
        $this->db->order_by('c.tb_course_code');
        $rs = $this->db->get();
        if ($rs->num_rows() != 0) {
            return $rs->result_array();
        }
        return array();
    }

    function get_available_teacher_course_by_room($yearly, $class, $lev, $sec, $day, $term, $rid) {
        $this->db->select('c.*,cd.*,hr.*,cd.id as cdid');
        $this->db->from('tb_course c');
        $this->db->join('tb_course_detail cd', 'c.id = cd.tb_course_id');
        $this->db->join('tb_human_resources_01 hr', 'hr.id = cd.tb_human_resources_01_id');
        if (isset($sec)) {
            $tmp = "hr.id not in ( select cd.tb_human_resources_01_id from tb_course_detail cd inner join ";
            $tmp .= "tb_ed_schedule sc on sc.tb_course_detail_id = cd.id where ";
            $tmp .= "sc.tb_ed_section_id='" . $sec . "' and sc.tb_ed_schedule_day='" . $day . "' )";
            $this->db->where($tmp);
        }
        $this->db->join('tb_ed_school_register_class rc', 'c.tb_ed_school_register_class_id=rc.id');
        $this->db->join('tb_ed_school_class scc', 'scc.id=rc.tb_ed_school_class_id');
        $this->db->where('c.tb_course_department', $this->session->userdata("department"));
//        $this->db->where(array('c.tb_course_edyear' => $yearly));
        $this->db->where(array('rc.tb_ed_school_register_class_edyear' => $yearly));
//        if($term!=''||$term!=0){
//            $this->db->where(array('c.tb_course_term' => $term));
//        }else{
//            $this->db->where(array('c.tb_course_term' => 0)); 
//        }
        $this->db->where(array('scc.tb_ed_school_class_name' => $class, 'scc.tb_ed_school_class_level' => $lev));
        $tmp = "c.id not in (select c.id from tb_ed_schedule sc inner join tb_course_detail cd";
        $tmp .= " on sc.tb_course_detail_id = cd.id inner join tb_course c on c.id = cd.tb_course_id ";
        $tmp .= " where sc.tb_ed_room_id = " . $rid . " ";
        $tmp .= "group by  c.id,sc.tb_ed_room_id having c.tb_course_hour_week - count(sc.tb_ed_section_id)<= 0  )";
        $this->db->where($tmp);
        $this->db->order_by('c.tb_course_code');
        $rs = $this->db->get();
        if ($rs->num_rows() != 0) {
            return $rs->result_array();
        }
        return array();
    }

    function get_teacher_by_id($hrid) {
        $this->db->select('*');
        $this->db->from('tb_course a');
        $this->db->where(array('b.id' => $cdid));

        $rs = $this->db->get();

        return $rs->row_array();
    }

    function fetch_room($param) {
        $this->db->where('tb_classroom_year', $param);
        $this->db->where('tb_ed_classroom_department', $this->session->userdata("department"));
        $this->db->order_by('tb_classroom_class', 'asc');
        $this->db->order_by('tb_classroom_level', 'asc');
        $this->db->order_by('tb_classroom_room', 'asc');
        $query = $this->db->get('tb_ed_room');
        $output = "<option value=''>---เลือกข้อมูล---</option>";
        foreach ($query->result() as $row) {
            $output .= "<option value='" . $row->tb_classroom_class . " " . $row->tb_classroom_level . "/" . $row->tb_classroom_room . "'>" . $row->tb_classroom_class . " " . $row->tb_classroom_level . "/" . $row->tb_classroom_room . "</option>";
        }
        return $output;
    }

    function get_all_teacher_course() {
        $this->db->select('*,d.id hrid,a.id cid,cls.*');
        $this->db->from('tb_course a');
        $this->db->join('tb_ed_school_register_class reg', 'a.tb_ed_school_register_class_id = reg.id');
        $this->db->join('tb_ed_school_class cls', 'cls.id = reg.tb_ed_school_class_id');
        $this->db->join('tb_course_detail b', 'a.id = b.tb_course_id', 'left outer');
        $this->db->join('tb_subject c ', 'c.id = a.tb_subject_id ', 'left outer');
        $this->db->join('tb_human_resources_01 d ', 'd.id = b.tb_human_resources_01_id ', 'left outer');
        $this->db->where('a.tb_course_department', $this->session->userdata("department"));
        //$this->db->where('d.hr_department', $this->session->userdata("department"));
        $this->db->order_by('a.id');

        $rs = $this->db->get();
        if ($rs->num_rows() > 0) {
            return $rs->result_array();
        }
        return array();
    }

    function get_all_teacher() {
        $this->db->select('*,a.id hrid,c.tb_course_id cid');
        $this->db->from('tb_human_resources_01 a');
        $this->db->join('tb_human_resources_15 b', 'a.id = b.hr_id');
        $this->db->join('tb_course_detail c', 'c.tb_human_resources_01_id = b.hr_id', 'left outer');
        $this->db->where('a.hr_department', $this->session->userdata("department"));
        $this->db->order_by('a.id');
        $rs = $this->db->get();
        if ($rs->num_rows() > 0) {
            return $rs->result_array();
        }
        return array();
    }

    function get_all_teacher_list() {
//        $this->db->select('*,a.id hrid,c.tb_course_id cid');
        $this->db->select('*,a.id hrid');
        $this->db->from('tb_human_resources_01 a');
       // $this->db->join('tb_human_resources_15 b', 'a.id = b.hr_id');
//        $this->db->join('tb_course_detail c', 'c.tb_human_resources_01_id = b.hr_id', 'left outer');
        $this->db->where('a.hr_department', $this->session->userdata("department"));
        $this->db->order_by('a.hr_thai_name,a.hr_thai_lastname');
        $rs = $this->db->get();
        if ($rs->num_rows() > 0) {
            return $rs->result_array();
        }
        return array();
    }

    public function get_teacher_course($param) {
        $this->db->select('b.id hrid');
        $this->db->from('tb_course a');
        $this->db->join('tb_course_detail c', 'c.tb_course_id = a.id', 'left outer');
        $this->db->join('tb_human_resources_01 b', 'b.id = c.tb_human_resources_01_id');
        $this->db->where('a.tb_course_department', $this->session->userdata("department"));
        $this->db->where('a.tb_course_code', $param);
        $rs = $this->db->get();
        if ($rs->num_rows() > 0) {
            return $rs->result_array();
        }
        return array();
    }

    public function get_timetable($yearly, $class, $lev, $rid, $term, $sec, $day) {
//$string = $term.",0";
//
//        $ids = array(
//            $term, 0
//        );
//        $this->db->select('*,c.id as schid');
//        $this->db->from('tb_course a');
//        $this->db->join('tb_course_detail b', 'a.id = b.tb_course_id', 'left outer');
//        $this->db->join('tb_ed_schedule c', 'b.id = c.tb_course_detail_id', 'left outer');
//        $this->db->join('tb_subject d ', 'd.id = a.tb_subject_id ');
//        $this->db->join('tb_ed_school_register_class rc', 'a.tb_ed_school_register_class_id=rc.id');
//        $this->db->join('tb_ed_school_class scc', 'scc.id=rc.tb_ed_school_class_id');
//        $this->db->where('a.tb_course_department', $this->session->userdata("department"));
//        $this->db->where(array('rc.tb_ed_school_register_class_edyear' => $yearly));
//        $this->db->where_in('a.tb_course_term', $ids);
//        $this->db->where(array('c.tb_ed_section_id' => $sec));
//        $this->db->where(array('c.tb_ed_schedule_day' => $day));
//        $this->db->where(array('scc.tb_ed_school_class_name' => $class, 'scc.tb_ed_school_class_level' => $lev));
//        $this->db->where(array('c.tb_ed_room_id' => $rid));


        $sql = "SELECT *, `c`.`id` as `schid`
FROM `tb_course` `a`
LEFT OUTER JOIN `tb_course_detail` `b` ON `a`.`id` = `b`.`tb_course_id`
LEFT OUTER JOIN `tb_ed_schedule` `c` ON `b`.`id` = `c`.`tb_course_detail_id`
JOIN `tb_subject` `d` ON `d`.`id` = `a`.`tb_subject_id`
JOIN `tb_ed_school_register_class` `rc` ON `a`.`tb_ed_school_register_class_id`=`rc`.`id`
JOIN `tb_ed_school_class` `scc` ON `scc`.`id`=`rc`.`tb_ed_school_class_id`
WHERE `a`.`tb_course_department` = '{$this->session->userdata("department")}'
AND `rc`.`tb_ed_school_register_class_edyear` = '{$yearly}'
AND `a`.`tb_course_term` IN({$term}, 0)
AND `c`.`tb_ed_section_id` = '{$sec}'
AND `c`.`tb_ed_schedule_day` = {$day}
AND `scc`.`tb_ed_school_class_name` = '{$class}'
AND `scc`.`tb_ed_school_class_level` = '{$lev}'
AND `c`.`tb_ed_room_id` = '{$rid}'";

//        $rs = $this->db->get();
//        print($this->db->last_query());
        $rs = $this->db->query($sql);
        
        if ($rs->num_rows() > 0) {
            return $rs->row_array();
        }
        return array();
    }

    function get_list_section_by_user($y, $t, $u) {

        $this->db->select('sc.id as id,c.tb_course_code as tb_course_code, sbj.tb_subject_name as sbj,
          scc.tb_ed_school_class_abbreviation as class_short,
          scc.tb_ed_school_class_level as lev,
          r.tb_classroom_room as classroom,
          sc.`tb_ed_schedule_day` as tb_ed_schedule_day,
          sec.tb_ed_section_class_sub as tb_ed_section_class_sub, tb_ed_section_start,tb_ed_section_end');

        $this->db->from('tb_ed_schedule sc');
        $this->db->join('tb_course_detail cd', 'sc.tb_course_detail_id = cd.id');
        $this->db->join('tb_course c', 'c.id = cd.tb_course_id');
        $this->db->join('tb_subject sbj', 'c.tb_subject_id = sbj.id');
        $this->db->join('tb_ed_section sec', 'sec.id = sc.tb_ed_section_id');
        $this->db->join('tb_ed_room r', 'r.id = sc.tb_ed_room_id');
        $this->db->join('tb_ed_school_register_class src', 'src.id = r.tb_ed_school_register_class_id');
        $this->db->join('tb_ed_school_class scc', 'scc.id = src.tb_ed_school_class_id');
        $this->db->where('cd.tb_human_resources_01_id', $u);
        $this->db->where('c.tb_course_term', $t);
        $this->db->where('src.tb_ed_school_register_class_edyear', $y);
        $this->db->order_by('tb_ed_schedule_day,tb_ed_section_class_sub,tb_ed_school_class_level,tb_classroom_room');
        $rs = $this->db->get();
        if ($rs->num_rows() > 0) {
            return $rs->result_array();
        }
        return array();
    }

    function get_list_section_by_user_sec($y, $t, $u, $d, $s) {

        $this->db->select('sc.id as id,c.tb_course_code as tb_course_code, sbj.tb_subject_name as sbj,
          scc.tb_ed_school_class_abbreviation as class_short,
          scc.tb_ed_school_class_level as lev,
          r.tb_classroom_room as classroom,
          sc.`tb_ed_schedule_day` as tb_ed_schedule_day,
          sec.tb_ed_section_class_sub as tb_ed_section_class_sub, tb_ed_section_start,tb_ed_section_end');

        $this->db->from('tb_ed_schedule sc');
        $this->db->join('tb_course_detail cd', 'sc.tb_course_detail_id = cd.id');
        $this->db->join('tb_course c', 'c.id = cd.tb_course_id');
        $this->db->join('tb_subject sbj', 'c.tb_subject_id = sbj.id');
        $this->db->join('tb_ed_section sec', 'sec.id = sc.tb_ed_section_id');
        $this->db->join('tb_ed_room r', 'r.id = sc.tb_ed_room_id');
        $this->db->join('tb_ed_school_register_class src', 'src.id = r.tb_ed_school_register_class_id');
        $this->db->join('tb_ed_school_class scc', 'scc.id = src.tb_ed_school_class_id');
        $this->db->where('cd.tb_human_resources_01_id', $u);
        $this->db->where('sec.id', $s);
        $this->db->where('sc.tb_ed_schedule_day', $d);
        $this->db->where('c.tb_course_term', $t);
        $this->db->where('src.tb_ed_school_register_class_edyear', $y);
        $this->db->order_by('tb_ed_schedule_day,tb_ed_section_class_sub,tb_ed_school_class_level,tb_classroom_room');
        $rs = $this->db->get();
        if ($rs->num_rows() > 0) {
            return $rs->result_array();
        }
        return array();
    }

    function get_schedule_row_by_sectionid_day_hrid_term_edyear($sectionid, $daynum, $term, $yearly) {

        $this->db->select('a.*,a.id as ScheduleId,b.tb_human_resources_01_id,c.tb_course_code,d.tb_ed_school_register_class_edyear');
        $this->db->select('e.*,CONCAT (f.tb_ed_school_class_abbreviation,".",f.tb_ed_school_class_level,"/",e.tb_classroom_room) as ed_classroom');
        $this->db->from('tb_ed_schedule a');
        $this->db->join('tb_course_detail b', 'b.id = a.tb_course_detail_id');
        $this->db->join('tb_course c', 'c.id = b.tb_course_id');
        $this->db->join('tb_ed_school_register_class d', 'd.id = c.tb_ed_school_register_class_id');
        $this->db->join('tb_ed_room e', 'e.id = a.tb_ed_room_id');
        $this->db->join('tb_ed_school_class f', 'f.id = d.tb_ed_school_class_id');

        $this->db->where('a.tb_ed_section_id', $sectionid);
        $this->db->where('a.tb_ed_schedule_day', $daynum);
        $this->db->where('a.tb_ed_schedule_term', $term);
        $this->db->where('b.tb_human_resources_01_id', $this->session->userdata('hr_id'));
        $this->db->where('d.tb_ed_school_register_class_edyear', $yearly);

//        $this->db->order_by('tb_ed_schedule_day,tb_ed_section_class_sub,tb_ed_school_class_level,tb_classroom_room');
        $MyQ = $this->db->get();
        if ($MyQ->num_rows() > 0) {
            return $MyQ->row_array();
        } else {
            return false;
        }
    }

}
