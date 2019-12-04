<?php

class Ev_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    // get education evaluation data;
    function get_education_evaluation_data() {
        $this->db->select('a.*, b.*, c.*, d.*, c.id as ev_id')->from('tb_evaluation_category a');
        $this->db->join('tb_evaluation_activities b', 'b.ev_category_id = a.id');
        $this->db->join('tb_education_evaluation c', 'c.activities_id = b.id');
        $this->db->join('tb_school d', 'd.id = c.school_id');
        $this->db->order_by('c.ev_date desc');
        //
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return array();
    }

    // ดึงข้อมูลการส่งเสริมสนับสนุนเพียงเรคคอร์ดเดียว
    function get_education_evaluation_row($id) {
        $this->db->select('a.*, b.*, c.*, d.*, c.id as ev_id')->from('tb_evaluation_category a');
        $this->db->join('tb_evaluation_activities b', 'b.ev_category_id = a.id');
        $this->db->join('tb_education_evaluation c', 'c.activities_id = b.id');
        $this->db->join('tb_school d', 'd.id = c.school_id');
        $this->db->where('c.id', $id);
        //
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->row_array();
        }
        return array();
    }

}
