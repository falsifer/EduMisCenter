<?php

class My_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    /*
     * work with no session
     */

    // ดึงข้อมูลทั่งหมด
    function get_all($table) {
        $this->db->select("*")->from($table);
        $query = $this->db->get();
        if ($query->num_rows() != 0) {
            return $query->result_array();
        }
        return array();
    }

    // get order;
    function get_order($table, $order) {
        $this->db->select("*")->from($table);
        $this->db->order_by($order);
        $rs = $this->db->get();
        if ($rs->num_rows() > 0) {
            return $rs->row_array();
        }
        return array();
    }

    // ดังข้อมูลทั้งหมดและเรียงลำดับ
    function get_all_order($table, $order) {
        $this->db->select("*")->from($table);
        $this->db->order_by($order);
        $query = $this->db->get()->result_array();
        if (count($query) > 0) {
            return $query;
        }
        return array();
    }

    // นับจำนวนเรคคอร์ดทั้งหมดจากตาราง
    function count_all_record($table) {
        return $this->db->count_all($table);
    }

    // นับจำนวนเรคคอร์ดแบบมีเงื่อนไข
    function count_record_where($table, $condition) {
        $this->db->where($condition);
        $num_rows = $this->db->count_all_results($table);
        if ($num_rows != 0) {
            return $num_rows;
        }
        return 0;
    }

    function get_group_by($table, $group_by, $order) {
        $this->db->select("*")->from($table);
        $this->db->group_by($group_by)->order_by($order);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return array();
    }

    // get_where_group_by;
    function get_where_group_by($table, $con, $group_by) {
        $this->db->select("*")->from($table);
        $this->db->where($con)->group_by($group_by);
        $query = $this->db->get();
        if ($query->num_rows() != 0) {
            return $query->result_array();
        }
        return array();
    }

    // get where row;
    function get_row($table) {
        $this->db->select("*")->from($table);
        $rs = $this->db->get();
        if ($rs->num_rows() > 0) {
            return $rs->row_array();
        }
        return array();
    }
    // ดึงเรคคอร์ดเดียวโดยมีการจัดเรียง
    function get_row_order($table,$order) {
        $this->db->select("*")->from($table)->order_by($order);
        $rs = $this->db->get();
        if ($rs->num_rows() > 0) {
            return $rs->row_array();
        }
        return array();
    }

    // ดึงข้อมูลเพียงเรคคอร์ดเดียว
    function get_where_row($table, $condition) {
        $this->db->select("*")->from($table);
        $this->db->where($condition);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->row_array();
        }
        return array();
    }

    // ดึงข้อมูลทั้งหมดแบบมีเงื่อนไขและเรียงลำดับ
    function get_where_order($table, $condition, $order) {
        $this->db->select("*")->from($table);
        $this->db->where($condition)->order_by($order);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return array();
    }

    // ดึงข้อมูลข้อมูลเรคคอร์ดสุดท้าย
    function get_where_row_order($table, $condition, $order) {
        $this->db->select("*")->from($table);
        $this->db->where($condition)->order_by($order);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->row_array();
        }
        return array();
    }

    // get_where_in
    function get_where_in() {
        $this->db->select("*")->from($table);
        $this->db->where_in();
    }

    // ดึงข้อมูลตามเงื่อนไขและระบุจำนวน
    function get_all_limit($table, $limit, $order) {
        $this->db->select("*")->from($table)->limit($limit)->order_by($order);
        $query = $this->db->get();
        if ($query->num_rows() != 0) {
            return $query->result_array();
        }
        return array();
    }

    ############################################################################
    ##
    ##  โมเดลสำหรับ บันทึก, ปรับปรุง, ลบข้อมูล
    ##
    ##
    ############################################################################
    // add data

    function insert_data($table, $arr) {
        $this->db->insert($table, $arr);
        $id = $this->db->insert_id();
        return $id;
    }

    // update data;
    function update_data($table, $con, $arr) {
        $this->db->where($con)->update($table, $arr);
    }

    // delete data;
    function delete_data($table, $con) {
        $this->db->delete($table, $con);
    }

    ############################################################################
    ##
    ##  Table relationship
    ##
    ############################################################################
    // เชื่อมสองตารางดึงข้อมูลทั้งหดและทำการแบ่งหน้า

    function join2table_result($table1, $table2, $condition, $order) {
        $this->db->select("*")->from($table1);
        $this->db->join($table2, $condition);
        $this->db->order_by($order);
        $query = $this->db->get()->result_array();
        if (count($query) > 0) {
            return $query;
        }
        return array();
    }

    // เชื่อมสองตารางแบบมีเงื่อนไข
    function join2table_where_result($tb1, $tb2, $con1, $con2, $order) {
        $this->db->select("*")->from($tb1)->join($tb2, $con1)->where($con2)->order_by($order);
        $query = $this->db->get();
        if ($query->num_rows() != 0) {
            return $query->result_array();
        }
        return array();
    }

    // เชื่อมสองตารางดึงข้อมูลเพียงเรคคอร์ดเดียว
    function join2table_row($table1, $table2, $condition, $where) {
        $this->db->select("*")->from($table1);
        $this->db->join($table2, $condition);
        $this->db->where($where);
        $query = $this->db->get()->row_array();
        if (count($query) > 0) {
            return $query;
        }
        return array();
    }

    // ตรวจสอบข้อมูลมีในตารางข้อมูลหรือไม่
    function chk_valid_data($table, $condition) {
        $this->db->select("*")->from($table);
        $this->db->where($condition);
        $result = $this->db->get();
        if ($result->num_rows() > 0) {
            return TRUE;
        }
        return FALSE;
    }

    // หาผลรวมอย่างมีเงื่อนไข
    function sum_where($table, $field, $con) {
        $query = $this->db->select_sum($field)->where($con)->get($table);
        if ($query->num_rows() > 0) {
            return $query->row_array();
        }
        return array();
    }

    // Sum field no have condition
    function get_sum($table, $field) {
        $this->db->select_sum($field);
        $this->db->from($table);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->row_array();
        }
        return array();
    }

    // Sum field no have condition
    function get_sum_where($table, $field,$cond) {
        $this->db->select_sum($field);
        $this->db->from($table);
        $this->db->where($cond);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->row_array();
        }
        return array();
    }
}
