<?php

class School_bus_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function get_transporter($hr) {
        $trName = "";
        $rs = $this->My_model->get_where_row('tb_human_resources_01', array('id' => $hr));

        if (isset($rs['id'])) {
            $trName = $rs['hr_thai_symbol'] . $rs['hr_thai_name'] . " " . $rs["hr_thai_lastname"];
        }

        return $trName;
    }

    function get_transpoter_list() {
        $this->db->select('*,a.id as hr_id');
        $this->db->from('tb_human_resources_01 a');
        $this->db->join('tb_human_resources_type b', 'a.hr_type_id=b.id');
        $this->db->where(array('hr_department' => $this->session->userdata('department'), 'b.human_resources_type' => 'คนขับรถ'));
        $this->db->order_by('hr_thai_symbol');
        $rs = $this->db->get();
        if (isset($rs)) {
            return $rs->result_array();
        } else {
            return false;
        }
    }

    function get_std_list_by_vehicle() {
        $this->db->select("*,CONCAT (a.std_titlename,a.std_firstname,\" \",a.std_lastname) as fullname");
        $this->db->select("a.id as StdId");
        $this->db->select("concat(tb_ed_school_class_abbreviation,'.',tb_ed_school_class_level,'/',r.tb_classroom_room) as class");

        $this->db->from('tb_student_base a');

        $this->db->join('tb_school_bus b', 'b.tb_student_id=a.id');
        $this->db->join('tb_vehicle v', 'v.id=b.tb_vehicle_id');
        $this->db->join('tb_school_bus_transfer c', 'c.tb_student_id=b.tb_student_id', 'left outer');

        $this->db->join("tb_ed_classroom cr", "cr.tb_student_base_id=a.id");
        $this->db->join("tb_ed_room r", "r.id = cr.tb_ed_room_id");
        $this->db->join("tb_ed_school_register_class d", "d.id = r.tb_ed_school_register_class_id");
        $this->db->join("tb_ed_school_class cl", "cl.id = d.tb_ed_school_class_id");

        $this->db->where(array('v.hr_id' => $this->session->userdata('hr_id')));
        $this->db->order_by('a.std_firstname');
        $rs = $this->db->get();
        if (isset($rs)) {
            return $rs->result_array();
        } else {
            return false;
        }
    }

    public function get_curr_transfer_data($std_id, $vc_id) {
        $sql = "select * from tb_school_bus_transfer where tb_vehicle_id=".$vc_id;
        $sql .= " and tb_student_id = ".$std_id;
        $sql .= " and tb_school_id = ".$this->session->userdata('sch_id');
        $sql .= " and tb_school_bus_transfer_datetime like '%".date("Y-m-d")."%'";
        $query = $this->db->query($sql);
        $outp = "";
        foreach ($query->result() as $row) {
            if($row->tb_school_bus_transfer_destination=='รับจากบ้าน'){
                $outp .= "รับ ". shortdate($row->tb_school_bus_transfer_datetime)." ". str_replace(date("Y-m-d"), "", $row->tb_school_bus_transfer_datetime)." น.";
            }elseif($row->tb_school_bus_transfer_destination=='ถึงโรงเรียน'){
                $outp .= "ถึง ". shortdate($row->tb_school_bus_transfer_datetime)." ". str_replace(date("Y-m-d"), "", $row->tb_school_bus_transfer_datetime)." น.";
            }elseif($row->tb_school_bus_transfer_destination=='รับจากโรงเรียน'){
                $outp .= "รับ ". shortdate($row->tb_school_bus_transfer_datetime)." ". str_replace(date("Y-m-d"), "", $row->tb_school_bus_transfer_datetime)." น.";
            }elseif($row->tb_school_bus_transfer_destination=='ถึงบ้าน'){
                $outp .= "ถึง ". shortdate($row->tb_school_bus_transfer_datetime)." ". str_replace(date("Y-m-d"), "", $row->tb_school_bus_transfer_datetime)." น.";
            }
        }
        
        return $outp;
    }

}
