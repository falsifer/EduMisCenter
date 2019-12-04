<?php

class School_loan_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    // ข้อมูลการจัดสรรงบประมาณให้สถานศึกษา
    public function get_loan_transfer($id) {
        $this->db->select('*')->from('tb_loan_transfer');

        //
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return array();
    }

    // ดึงข้อมูล loan-define มาแสดง
    public function get_loan_define() {
        $this->db->select('*')->from('tb_loan_category a');
        $this->db->join('tb_loan_type b', 'b.loan_category_id = a.id');
        $this->db->join('tb_loan_define c', 'c.loan_type_id = b.id');
        $this->db->order_by('a.loan_category asc, b.loan_type asc, c.loan_define asc');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return array();
    }

    // ดึงข้อมูล loan-define เพื่อแก้ไข
    public function get_loan_define_row($id) {
        $this->db->select('*')->from('tb_loan_category a');
        $this->db->join('tb_loan_type b', 'b.loan_category_id = a.id');
        $this->db->join('tb_loan_define c', 'c.loan_type_id = b.id');
        $this->db->where('c.id', $id);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->row_array();
        }
        return array();
    }

    // ดึงข้อมูลรายการค่าใช้จ่ายทั้งหมดไปแสดงเพื่อเลือก
    public function get_all_loan_define() {
        $this->db->select('*')->from('tb_loan_category a');
        $this->db->join('tb_loan_type b', 'b.loan_category_id = a.id');
        $this->db->join('tb_loan_define c', 'c.loan_type_id = b.id');
        $this->db->order_by('a.loan_category asc, b.loan_type asc, c.loan_define asc');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return array();
    }

    // ดึงรายการงบประมาณตั้งไว้สำหรับแต่ละโรงเรียน
    public function get_loan_define_detail($school_id) {
        $this->db->select('*')->from('tb_loan_category a');
        $this->db->join('tb_loan_type b', 'b.loan_category_id = a.id');
        $this->db->join('tb_loan_define c', 'c.loan_type_id = b.id');
        $this->db->join('tb_loan_define_detail d', 'd.loan_define_id = c.id');
        $this->db->where('d.school_id', $school_id);
        $this->db->order_by('a.loan_category asc, b.loan_type asc, c.loan_define asc');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return array();
    }

    // ดึงรายการงบประมาณตั้งไว้มาแก้ไข
    public function get_loan_define_detail_edit($id) {
        $this->db->select('*')->from('tb_loan_category a');
        $this->db->join('tb_loan_type b', 'b.loan_category_id = a.id');
        $this->db->join('tb_loan_define c', 'c.loan_type_id = b.id');
        $this->db->join('tb_loan_define_detail d', 'd.loan_define_id = c.id');
        $this->db->where('d.id', $id);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->row_array();
        }
        return array();
    }

    // ดึงข้อมูลการจัดสรรงบประมาณให้กับโรงเรียนในสังกัด
    public function get_school_loan($school_id) {
        $this->db->select('*')->from('tb_loan_category a');
        $this->db->join('tb_loan_type b', 'b.loan_category_id = a.id');
        $this->db->join('tb_loan_define c', 'c.loan_type_id = b.id');
        $this->db->join('tb_loan_define_detail d', 'd.loan_define_id = c.id');
        $this->db->join('tb_loan_transfer e', 'e.loan_define_detail_id = d.id');
        $this->db->where('d.school_id', $school_id);
        $this->db->order_by('e.loan_term asc, a.loan_category asc, b.loan_type asc');

        //
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return array();
    }

    // ดึงข้อมูลการจัดสรรงบประมาณตามไตรมาส
    public function get_loan_transfer_detail($school_id, $loan_define_detail_id) {
        $this->db->select('*')->from('tb_loan_define_detail a');
        $this->db->join('tb_loan_transfer b', 'b.loan_define_detail_id = a.id');
        $this->db->where('b.school_id', $school_id)->where('b.loan_define_detail_id', $loan_define_detail_id);
        $this->db->order_by('b.loan_term asc, b.loan_date asc');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return array();
    }

    // หายอดการโอนในแต่ละโรงเรียน, แต่ละกิจกรรม, และแต่ละไตรมาส
    public function loan_transfer_term($school_id, $define_id, $term) {
        $this->db->select('*')->from('tb_loan_transfer');
        $this->db->where('school_id', $school_id)->where('loan_define_detail_id', $define_id);
        $this->db->where('loan_term', $term);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->row_array();
        }
        return array();
    }

    // get school loan
    public function get_school_loan_ext($ext_id) {
        $this->db->select('*,b.id as payment_id')->from('tb_loan_ext a');
        $this->db->join('tb_loan_ext_payment b', 'b.loan_ext_id = a.id');
        $this->db->join('tb_unit c', 'c.id = b.unit_id');
        $this->db->where('a.id', $ext_id)->order_by('b.payment_date asc');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return array();
    }
    // get school loan row
    public function get_school_loan_ext_row($id){
        $this->db->select('*,b.id as payment_id')->from('tb_loan_ext a');
        $this->db->join('tb_loan_ext_payment b', 'b.loan_ext_id = a.id');
        $this->db->join('tb_unit c', 'c.id = b.unit_id');
        $this->db->where('b.id', $id);
        $query=$this->db->get();
        if($query->num_rows()>0){
            return $query->row_array();
        }
    }

}
