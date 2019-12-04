<?php

class Setting_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    // login เข้าระบบ
    public function login($username, $password) {
        $this->db->select("*")->from("tb_drr_office a");
        $this->db->join("tb_employee b", "b.office_id = a.id");
        $this->db->join("tb_member c", "c.employee_id = b.id");
        $this->db->where("c.member_username", $username)->where("c.member_password", $password);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->row_array();
        }
        return array();
    }

    // ดึงข้อมูลสำนักงานทางหลวงชนบท
    public function get_drr_office($office_type) {
        $this->db->select("*")->from("tb_drr_office");
        $this->db->where("office_type", $office_type);
        $this->db->order_by("office_index ASC");
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return array();
    }

    // ค้นหาข้อมูลหน่วยงาน 
    public function drr_office_search($search, $office_type) {
        $this->db->select("*")->from("tb_drr_office");
        $this->db->where("office_type", $office_type);
        $this->db->like("office_name", $search)->or_like("drr_buero", $search);
        $query = $this->db->get();
        if ($query->num_rows() != 0) {
            return $query->result_array();
        }
        return array();
    }

    // get_office;
    public function get_office() {
        $this->db->select("*")->from("tb_drr_office");
        $this->db->where("office_type", "สำนักทางหลวงชนบท");
        $this->db->or_where("office_type", "สำนักงานทางหลวงชนบท");
        $this->db->order_by("office_index asc");
        $query = $this->db->get();
        if ($query->num_rows() != 0) {
            return $query->result_array();
        }
        return array();
    }

    // ดึงข้อมูลหน่วยงานภายในมาแก้ไข
    public function get_drr_buero($id) {
        $this->db->select("*")->from("tb_province_name a");
        $this->db->join("tb_amphur_name b", "b.province_id = a.id");
        $this->db->join("tb_drr_office c", "c.amphur_id = b.id");
        $this->db->where("c.id", $id);
        $query = $this->db->get()->row_array();
        if (count($query) > 0) {
            return $query;
        }
        return array();
    }

    public function get_system_user($buero) {
        $this->db->select("*")->from("tb_drr_office a");
        $this->db->join("tb_employee b", "b.office_id = a.id");
        $this->db->join("tb_member c", "c.employee_id = b.id");
        $this->db->where("a.drr_buero", $buero)->where("a.office_type", "แขวงทางหลวงชนบท");
        $this->db->order_by("a.office_name asc");
        $this->db->group_by("b.office_id");
        //
        $query = $this->db->get();
        if ($query->num_rows() != 0) {
            return $query->result_array();
        }
        return array();
    }

    // ดึงข้อมูลผู้ใช้งานจากหมวดฯ
    public function get_user_from_drr_office($drr_office) {
        $this->db->select("*")->from("tb_drr_office a");
        $this->db->join("tb_employee b", "b.office_id = a.id");
        $this->db->join("tb_member c", "c.employee_id = b.id");
        $this->db->where("a.drr_office", $drr_office);

        $query = $this->db->get();
        if ($query->num_rows() != 0) {
            return $query->result_array();
        }
        return array();
    }

    // ดึงข้อมูลบุคลาการ
    public function get_employee($per_page) {
        $this->db->select("a.*,b.*,c.*, c.id as member_id, b.id as employee_id")->from("tb_drr_office a");
        $this->db->join("tb_employee b", "b.office_id = a.id");
        $this->db->join("tb_member c", "c.employee_id = b.id", "left");
        $this->db->limit($per_page, $this->uri->segment(3));
        $this->db->order_by("b.employee_name asc");
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return array();
    }

    public function get_employee_row($id) {
        $this->db->select("a.*,b.*,c.*, c.id as member_id, b.id as employee_id")->from("tb_drr_office a");
        $this->db->join("tb_employee b", "b.office_id = a.id");
        $this->db->join("tb_member c", "c.employee_id = b.id", "left");
        $this->db->where("c.id", $id);
        $this->db->order_by("b.employee_name asc");
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->row_array();
        }
        return array();
    }

    public function get_employee_edit($id) {
        $this->db->select("a.*, b.*, b.id as employee_id")->from("tb_drr_office a");
        $this->db->join("tb_employee b", "b.office_id = a.id");
        $this->db->where("b.id", $id);
        $query = $this->db->get();
        if ($query->num_rows() != 0) {
            return $query->row_array();
        }
        return array();
    }

    // ค้นหาข้อมูล employee;
    public function employee_search($search) {
        $this->db->select("a.*,b.*,c.*, c.id as member_id, b.id as employee_id")->from("tb_drr_office a");
        $this->db->join("tb_employee b", "b.office_id = a.id");
        $this->db->join("tb_member c", "c.employee_id = b.id", "left");
        $this->db->like("a.office_name", $search)->or_like("b.employee_name", $search)->or_like("rank_name", $search)->or_like("responsible_name", $search);
        $this->db->order_by("b.employee_name asc");
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return array();
    }

    // ดึงข้อมูลผู้ใช้งานระบบสำหรับพิมพ์รายงาน
    public function get_employee_print() {
        $this->db->select("drr_buero")->from("tb_drr_office");
        $this->db->group_by("drr_buero");
        $this->db->order_by("office_index asc");
        //
        $query = $this->db->get();
        if ($query->num_rows() != 0) {
            return $query->result_array();
        }
        return array();
    }

    // ดึงข้อมูลผู้ใช้งานระบบ
    public function get_member() {
        $this->db->select("*")->from("tb_employee a");
        $this->db->join("tb_member b", "b.employee_id = a.id");
        $this->db->order_by("b.member_username asc");
        $query = $this->db->get();
        if ($query->num_rows() != 0) {
            return $query->result_array();
        }
        return array();
    }

    // ดึงผู้ใช้งานระบบสำหรับการแก้ไข
    public function get_member_edit($id) {
        $this->db->select("*")->from("tb_employee a");
        $this->db->join("tb_member b", "b.employee_id = a.id");
        $this->db->where("b.id", $id);
        $query = $this->db->get();
        if ($query->num_rows() != 0) {
            return $query->row_array();
        }
        return array();
    }

    // ดึงข้อมูลเครื่องหมายจราจร
    public function get_trafficsign() {
        $this->db->select("*")->from("tb_trafficsign_type a");
        $this->db->join("tb_trafficsign b", "b.trafficsign_type_id = a.id");
        $this->db->order_by("b.trafficsign_name ASC");
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return array();
    }

    // illegal_no search;
    public function illegal_no_search($search) {
        $this->db->select("*")->from("tb_illegal_base");
        $this->db->like("illegal_no", $search)->or_like("illegal_description", $search);
        $this->db->or_like("group_description", $search);
        $query = $this->db->get();
        if ($query->num_rows() != 0) {
            return $query->result_array();
        }
        return array();
    }

}
