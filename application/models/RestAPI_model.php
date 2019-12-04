<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class RestAPI_model extends CI_Model {

    // ดึงข้อมูลห้องโฮมรูม ที่ครูรับผิดชอบ
    function get_ed_homeroom_w_hr_id($hr_id) {
        $this->db->select("a.tb_room_id as ed_roomid");
        $this->db->select("b.tb_classroom_room as ed_roomnumber");
        $this->db->select("c.tb_ed_school_register_class_edyear as EdYear");
        $this->db->select("CONCAT (d.tb_ed_school_class_name,'ชั้นปีที ',d.tb_ed_school_class_level) as ed_classname");
        $this->db->from("tb_ed_homeroom a");
        $this->db->join("tb_ed_room b", "b.id = a.tb_room_id");
        $this->db->join("tb_ed_school_register_class c", "c.id = b.tb_ed_school_register_class_id");
        $this->db->join("tb_ed_school_class d", "d.id = c.tb_ed_school_class_id");
        $this->db->where("a.tb_human_resources_id", $hr_id);
        $this->db->order_by("a.id desc");
        $MyQ = $this->db->get();
        if ($MyQ->num_rows() > 0) {
            return $MyQ->result();
        } else {
            return false;
        }
    }

    function get_list_section_by_std($y, $t, $std) {

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
        $this->db->join('tb_ed_classroom cl', 'cl.tb_ed_room_id=r.id');
        $this->db->where('cl.tb_student_base_id', $std);
        $this->db->where('c.tb_course_term', $t);
        $this->db->where('src.tb_ed_school_register_class_edyear', $y);
        $this->db->order_by('tb_ed_schedule_day,tb_ed_section_class_sub,tb_ed_school_class_level,tb_classroom_room');
        $rs = $this->db->get();
        if ($rs->num_rows() > 0) {
            return $rs->result_array();
        }
        return array();
    }

    function get_admin_score($id) {
        $plusScore = 0;
        $minusScore = 0;
        //PLus
        $this->db->select("sum(tb_administrator_topic_maxscore) as score")->from("tb_school_administrator_score a");
        $this->db->join("tb_school_administrator_topic b", "b.id = a.tb_administrator_topic_id");
        $this->db->where("a.tb_student_base_id", $id);
        $this->db->where("tb_administrator_topic_type", "Plus");
        $this->db->order_by("a.id asc");
        $query = $this->db->get();
        if ($query) {
            $rs = $query->row_array();
            if (isset($rs['score'])) {
                $plusScore = $rs['score'];
            }
        }

        //Minus
        $this->db->select("sum(tb_administrator_topic_maxscore) as score")->from("tb_school_administrator_score a");
        $this->db->join("tb_school_administrator_topic b", "b.id = a.tb_administrator_topic_id");
        $this->db->where("a.tb_student_base_id", $id);
        $this->db->where("tb_administrator_topic_type", "Minus");
        $this->db->order_by("a.id asc");
        $query = $this->db->get();
        if ($query) {
            $rs = $query->row_array();
            if (isset($rs['score'])) {
                $minusScore = $rs['score'];
            }
        }

        $arr = array(
            'plus_score' => $plusScore,
            'minus_score' => $minusScore,
            'total_score' => (100 + $plusScore - $minusScore)
        );

        return $arr;
    }

    function get_absent_record_stat_by_student_id($student_id, $startdate, $enddate) {

        $StatusArray = array('มา', 'สาย', 'ลาป่วย', 'ลากิจ', 'ขาด');
        $AbsentArray = array('C', 'L', 'S', 'E', 'A');

        $i = 0;
        foreach ($AbsentArray as $absent) {
            $this->db->select("count(*) as result")->from("tb_std_absent_record");
            $this->db->where("tb_student_absent_record_status =", $absent);
            $this->db->where("tb_student_base_id =", $student_id);
            $this->db->where("tb_std_absent_record_date >=", $startdate);
            $this->db->where("tb_std_absent_record_date <=", $enddate);
            $MyQ = $this->db->get()->row_array();

            $StdArray = array(
                'name' => $StatusArray[$i],
                'amt' => $MyQ['result'],
            );
            $MyArray[$i] = ($StdArray);
            $i++;
        }

        return $MyArray;
    }

    function get_absent_record_all_by_student_id($student_id, $startdate, $enddate) {

        $this->db->select("*")->from("tb_std_absent_record");
        $this->db->where("tb_student_base_id =", $student_id);
        $this->db->where("tb_std_absent_record_date >=", $startdate);
        $this->db->where("tb_std_absent_record_date <=", $enddate);

        $MyQ = $this->db->get()->result_array();

        $arr = array();

        foreach ($MyQ as $r) {
            $date = $r['tb_std_absent_record_date'];
            if (date('Y', strtotime($date)) - 543 < 2004) {
                $y = date('Y', strtotime($date));
            } else {
                $y = date('Y', strtotime($date)) - 543;
            }
            $m = date('m', strtotime($date));
            $d = date('d', strtotime($date));
            $ar = array(
                'status' => $r['tb_student_absent_record_status'],
                'date' => $y . "-" . insert_zero_f_position($m, 2) . "-" . insert_zero_f_position($d, 2),
            );

            array_push($arr, $ar);
        }


        return $arr;
    }

    function insert_student_school_bus($hr_id, $sch_id, $std_id, $status) {

        $hr = $this->db->select("*")->from("tb_human_resources_01")->where("id", $hr_id)->get()->row_array();
        $MyQ = $this->db->select_max("id")->from("tb_vehicle")->where("hr_id", $hr_id)->get()->row_array();
        $arr = array(
            'tb_vehicle_id' => $MyQ['id'],
            'tb_student_id' => $std_id,
            'tb_school_id' => $sch_id,
            'tb_school_bus_transfer_destination' => $status,
            'tb_school_bus_transfer_datetime' => date('Y-m-d H:i:s'),
            'tb_school_bus_transfer_recorder' => $hr['hr_thai_symbol'] . $hr['hr_thai_name'] . " " . $hr['hr_thai_lastname'],
        );
        $id = $this->db->insert('tb_school_bus_transfer', $arr);
        return $id;
    }

    function get_transfer_status($vc_id, $std_id, $sch_id, $status) {
        $sql = 'SELECT * FROM tb_school_bus_transfer '
                . 'WHERE DATE_FORMAT(`tb_school_bus_transfer_datetime`, "%Y %m %d") = '
                . 'DATE_FORMAT("' . date('Y-m-d') . '", "%Y %m %d") '
                . 'and tb_vehicle_id = "' . $vc_id . '" '
                . 'and tb_student_id = "' . $std_id . '"  '
                . 'and tb_school_id = "' . $sch_id . '"  '
                . 'and tb_school_bus_transfer_destination = "' . $status . '"  '
                . 'ORDER BY `tb_school_bus_transfer`.`tb_school_bus_transfer_datetime` DESC';
        $rs = $this->db->query($sql)->row_array();
        return $rs;
    }

}
