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
}