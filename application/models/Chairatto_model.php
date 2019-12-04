<?php

class Chairatto_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function get_class_where($id) {
        $this->db->select("a.*,b.*,a.id as CId")->from("tb_ed_school_register_class a");
        $this->db->join("tb_ed_school_class b", "b.id = a.tb_ed_school_class_id");
        $this->db->where('a.id', $id);
        $query = $this->db->get()->row_array();
        if (count($query) > 0) {
            return $query;
        }
        return array();
    }

    function get_subject_type_list() {
        $query = $this->db->select("tb_subject_type_name")->from("tb_subject_type")->get()->result_array();
        if (count($query) > 0) {
            return $query;
        }
        return array();
    }

    // นับจำนวนเรคคอร์ดแบบมี(2)เงื่อนไข
    function count_w2c($table, $condition1, $condition2) {
        $this->db->where($condition1);
        $this->db->where($condition2);
        $num_rows = $this->db->count_all_results($table);
        if ($num_rows != 0) {
            return $num_rows;
        }
        return 0;
    }

    // นับจำนวนเรคคอร์ดแบบมี(3)เงื่อนไข
    function count_w3c($table, $condition1, $condition2, $condition3) {
        $this->db->where($condition1);
        $this->db->where($condition2);
        $this->db->where($condition3);
        $num_rows = $this->db->count_all_results($table);
        if ($num_rows != 0) {
            return $num_rows;
        }
        return 0;
    }

    function education_chat_base() {
        $this->db->select("a.*, b.*, c.*")->from("tb_chat_group a");
        $this->db->join("tb_chat_group_member b", "b.tb_chat_group_id = a.id");
        $this->db->join("tb_chat_group_picture c", "c.tb_chat_group_id = a.id", "left outer");
        $this->db->order_by("a.id asc");
        $rs = $this->db->get();
        if ($rs->num_rows() > 0) {
            return $rs->result_array();
        }
        return array();
    }

    function get_where_table($table, $condition) {
        $this->db->select("*")->from($table);
        $this->db->where($condition);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return array();
    }

    function get_w2c_table($table, $condition1, $condition2) {
        $this->db->select("*")->from($table);
        $this->db->where($condition1);
        $this->db->where($condition2);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return array();
    }

    function get_w3c_table($table, $condition1, $condition2, $condition3) {
        $this->db->select("*")->from($table);
        $this->db->where($condition1);
        $this->db->where($condition2);
        $this->db->where($condition3);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return array();
    }

    // ----- for filter
    function school_class_to_array() {
        $this->db->select("*")->from("tb_ed_school_class");
        $query = $this->db->get()->result();
//        if ($query->num_rows() > 0) {
//            return $query;
//        }
        return $query;
    }

    function group_learning_to_array() {
        $this->db->select("*")->from("tb_group_learning");
        $query = $this->db->get()->result();
//        if ($query->num_rows() > 0) {
//            return $query;
//        }
        return $query;
    }

    function member_hr_edit($id) {
        $this->db->select("a.*, b.id as hrid")->from("tb_member a");
        $this->db->join("tb_human_resources_01 b", "b.tb_member_id = a.id", "left outer");
        $this->db->where("a.id", $id);
        $this->db->order_by("a.id asc");
        $rs = $this->db->get();
        if ($rs->num_rows() > 0) {
            return $rs->row_array();
        }
        return array();
    }

    function hr01_join_hr02() {
        $this->db->select("a.*,b.*,CONCAT (a.hr_thai_symbol,a.hr_thai_name,\" \",a.hr_thai_lastname) as HRfullname")->from("tb_human_resources_01 a");
        $this->db->join("tb_human_resources_02 b", "b.hr_id = a.id", "left outer");
        $this->db->where("a.id", $this->session->userdata('hr_id'));
        $rs = $this->db->get();
        if ($rs->num_rows() > 0) {
            return $rs->row_array();
        }
        return array();
    }

    function hr_e_leave_row_array($id) {
        $this->db->select("a.*,b.*,d.signature,a.id as HrId,CONCAT (a.hr_thai_symbol,a.hr_thai_name,\" \",a.hr_thai_lastname) as HRfullname,c.tb_work_record_topic_sub_name");
//        $this->db->select("c.tb_work_record_topic_sub_name,d.*");
        $this->db->from("tb_human_resources_01 a");
        $this->db->join("tb_electronic_leave b", "b.tb_hr_id = a.id");
        $this->db->join("tb_work_record_topic_sub c", "c.id = b.tb_work_record_topic_sub_id");
        $this->db->join("tb_member d", "d.id = a.tb_member_id");
        $this->db->where("b.id", $id);
        $rs = $this->db->get();
        if ($rs->num_rows() > 0) {
            return $rs->row_array();
        }
        return array();
    }

    function chk_row_hr_absentrec($HrId, $date) {
        $this->db->select("*");
        $this->db->from("tb_hr_absent_record");
        $this->db->where("tb_hr_id", $HrId);
        $this->db->where("tb_hr_absent_record_date", $date);
        $rs = $this->db->get();
        if ($rs->num_rows() > 0) {
            return True;
        } else {
            return False;
        }
    }

    function get_e_leave_topic() {
        $this->db->select("*")->from("tb_work_record_topic_sub");
        $this->db->where("tb_work_record_topic_sub_type", "ลา");
        $query = $this->db->get()->result();

//        if ($query->num_rows() > 0) {
//            return $query;
//        }
        return $query;
    }

    function get_e_leave_list() {
        $this->db->select("a.*,b.*,a.id as id")->from("tb_electronic_leave a");
        $this->db->join("tb_work_record_topic_sub b", "b.id = a.tb_work_record_topic_sub_id");
        $this->db->where("tb_hr_id", $this->session->userdata('hr_id'));
        $this->db->order_by("tb_electronic_leave_createdate asc");
        $query = $this->db->get()->result();
//        if ($query->num_rows() > 0) {
//            return $query;
//        }
        return $query;
    }

    function get_e_leave_approve_list($first_date, $second_date) {
//        print_r($first_date."|".$second_date);
        $this->db->select("a.*,b.*,a.id as id");
        $this->db->select("CONCAT (c.hr_thai_symbol,c.hr_thai_name,\" \",c.hr_thai_lastname) as HRfullname");
        $this->db->from("tb_electronic_leave a");
        $this->db->join("tb_work_record_topic_sub b", "b.id = a.tb_work_record_topic_sub_id");
        $this->db->join("tb_human_resources_01 c", "c.id = a.tb_hr_id");
        $this->db->where('a.tb_electronic_leave_start_date >=', $first_date);
        $this->db->where('a.tb_electronic_leave_start_date <=', $second_date);
        $this->db->where("tb_electronic_leave_department", $this->session->userdata('department'));
        $this->db->order_by("tb_electronic_leave_createdate asc");
        $query = $this->db->get()->result();
//        if ($query->num_rows() > 0) {
//            return $query;
//        }
        return $query;
    }

//    


    function get_e_leave_table_w_hr($id) {
        $this->db->select("*")->from($table);
        $this->db->where($condition);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return array();
    }

    function get_edoc_approver_list() {
        $this->db->select("a.*,b.*,c.*,d.*,f.signature,d.id as PosId,d.id as RegisId,e.*")->from("tb_data_define a");
        $this->db->join("tb_edoc_approver b", "b.tb_data_define_id = a.id");
        $this->db->join("tb_hr_position c", "c.id = b.tb_hr_position_id");
        $this->db->join("tb_hr_position_register d", "d.tb_hr_position_id = c.id");
        $this->db->join("tb_human_resources_01 e", "e.id = d.tb_hr_id");
        $this->db->join("tb_member f", "f.id = e.tb_member_id");
        $this->db->where("a.data_address", $this->session->userdata('data-define'));
        $this->db->where("a.department", $this->session->userdata('department'));
        $query = $this->db->get()->result();
//        $output = $query[0]['id'];
        return $query;
    }

    function get_datadefine_id() {
        $this->db->select("id")->from("tb_data_define");
        $this->db->where("data_address", $this->session->userdata('data-define'));
        $query = $this->db->get()->result_array();
        $output = $query[0]['id'];
        return $output;
    }

    function count_all_std() {
        $this->db->select("id")->from("tb_student_base");
        $this->db->where("tb_student_base_status", "S");
        $query = $this->db->get()->result_array();
        $count = count($query);
        return $count;
    }

    //-------- บุคลากร
    function count_all_hr() {
        $this->db->select("id")->from("tb_human_resources_01");
        $query = $this->db->get()->result_array();
        $count = count($query);
        return $count;
    }

    function get_hr_member_base() {
        $this->db->select("a.*,a.id as id, b.*,c.*")->from("tb_human_resources_01 a");
        $this->db->join("tb_hr_position_register b", "b.tb_hr_id = a.id", "left outer");
        $this->db->join("tb_member c", "c.id = a.tb_member_id");
        $this->db->where("a.id", $this->session->userdata('hr_id'));
        $this->db->order_by("a.id asc");
        $rs = $this->db->get();
        if ($rs->num_rows() > 0) {
            return $rs->row_array();
        }
        return array();
    }

    function get_member_with_hr_list_by_department() {
        $this->db->select("a.*,a.id as id");
        $this->db->select("CONCAT (b.hr_thai_symbol,b.hr_thai_name,\" \",b.hr_thai_lastname) as HRfullname");
        $this->db->from("tb_member a");
        $this->db->join("tb_human_resources_01 b", "b.tb_member_id = a.id", "left outer");
        $this->db->where("a.department", $this->session->userdata('department'));
        $this->db->where("a.status !=", "นักเรียน");
        $this->db->where("a.status !=", "ผู้ปกครอง");
        $this->db->order_by("a.id asc");
        $rs = $this->db->get()->result_array();

        if (count($rs) > 0) {
            return $rs;
        } else {
            return false;
        }
    }

    function get_logo_by_department() {
        $rs = $this->db->select("sc_logo")->from("tb_school")->where("department", $this->session->userdata('department'))->get()->result_array();
        if (count($rs) > 0) {
            return $rs['sc_logo'];
        } else {
            return false;
        }
    }

    ///------ School - information

    function get_class_by_dept($dept, $edyear) {
        $this->db->select("a.*,b.*,a.id as ClassId")->from("tb_ed_school_register_class a");
        $this->db->join("tb_ed_school_class b", "b.id = a.tb_ed_school_class_id");
        $this->db->where('a.tb_ed_school_register_class_department', $dept);
        $this->db->where('a.tb_ed_school_register_class_edyear', $edyear);
        $this->db->order_by('b.id asc');
        $query = $this->db->get()->result_array();
        if (count($query) > 0) {
            return $query;
        } else {
            return false;
        }
    }

    function get_class_edroom_by_school_id_edyear($school_id, $edyear) {
        $this->db->select("*,a.id as ClassId,c.id as room_id")->from("tb_ed_school_register_class a");
        $this->db->join("tb_ed_school_class b", "b.id = a.tb_ed_school_class_id");
        $this->db->join("tb_ed_room c", "c.tb_ed_school_register_class_id = a.id");
        $this->db->where('a.tb_school_id', $school_id);
        $this->db->where('a.tb_ed_school_register_class_edyear', $edyear);
         $this->db->order_by('b.id asc');
        $this->db->order_by('c.tb_classroom_room asc');
        
       
        $query = $this->db->get()->result_array();
        if (count($query) > 0) {
            return $query;
        } else {
            return false;
        }
    }

    function get_class_by_school_id_edyear($school_id, $edyear) {
        $this->db->select("a.*,b.*,a.id as ClassId,b.id as EdClassId,")->from("tb_ed_school_register_class a");
        $this->db->join("tb_ed_school_class b", "b.id = a.tb_ed_school_class_id");
        $this->db->where('a.tb_school_id', $school_id);
        $this->db->where('a.tb_ed_school_register_class_edyear', $edyear);
        $this->db->order_by('b.tb_ed_school_class_level');
        $query = $this->db->get()->result_array();
        if (count($query) > 0) {
            return $query;
        } else {
            return false;
        }
    }

    function select_column_where($table, $condition, $column) {
        $this->db->select($column)->from($table);
        $this->db->where($condition);
        $query = $this->db->get();

        if (isset($query)) {
            if ($query->num_rows() > 0) {
                return $query->result_array();
            }
        } else {
            return false;
        }
    }

    function select_distinct_where($table, $condition, $column) {
        $this->db->distinct();
        $this->db->select($column)->from($table);
        $this->db->where($condition);
        $query = $this->db->get();

        if (isset($query)) {
            if ($query->num_rows() > 0) {
                return $query->result_array();
            }
        } else {
            return false;
        }
    }

    function select_sum_where($table, $condition, $column) {
        $this->db->select('sum(' . $column . ') as total')->from($table);
        $this->db->where($condition);
        $query = $this->db->get();
        if (isset($query)) {
            if ($query->num_rows() > 0) {
                $query->row_array();
                return $column;
            }
        } else {
            return false;
        }
    }

}
