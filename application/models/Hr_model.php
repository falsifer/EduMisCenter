<?php

// Human Resources model
class Hr_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    // get hr;
    function get_hr() {

        $this->db->select('*')->from('tb_human_resources_type a');
        $this->db->join("tb_human_resources_01 b", 'b.hr_type_id = a.id', 'right');
        $this->db->where('hr_department', $this->session->userdata('department'));
        $this->db->order_by('b.hr_thai_name asc');
        $rs = $this->db->get();
        if ($rs->num_rows() > 0) {
            return $rs->result_array();
        }
        return array();
    }

    //
    function get_hr_dev() {
        if ($this->session->userdata('status') == "ผู้ปฏิบัติงาน") {
            $this->db->select("*")->from('tb_hr_upgrade');
            $this->db->where("upgrade_recorder", $this->session->userdata("name"));
            $this->db->order_by("upgrade_date desc");
            $rs = $this->db->get();
            if ($rs->num_rows() > 0) {
                return $rs->result_array();
            }
            return array();
        } else {
            $this->db->select("*")->from('tb_hr_upgrade');
            $this->db->where("upgrade_department", $this->session->userdata("department"));
            $this->db->order_by("upgrade_date desc");
            $rs = $this->db->get();
            if ($rs->num_rows() > 0) {
                return $rs->result_array();
            }
            return array();
        }
    }

    // ดึงข้อมูลประวัติการรับเครื่องราชฯ
    function get_hr_13($hr_id) {
        $this->db->select("a.*, b.*, c.*, b.id AS hr13_id")->from("tb_human_resources_01 a");
        $this->db->join("tb_human_resources_13 b", "b.hr_id = a.id");
        $this->db->join("tb_insignia c", "c.insignia_name = b.hr13_insignia");
        $this->db->where('b.hr_id', $hr_id);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return array();
    }

    // นับจำนวนข้อมูลการลาแต่ละประเภท
    function count_hr11_type($hr_id, $hr_type) {
        $this->db->select("*")->from('tb_human_resources_11');
        $this->db->where('hr_id', $hr_id)->where('hr11_type', $hr_type);
        $query = $this->db->get();
        return $query->num_rows();
    }

}
