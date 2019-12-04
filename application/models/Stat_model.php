<?php

// Human Resources model
class stat_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function get_std_base_stat_by_school($school) {

        $sql = "select a.tb_student_base_department as school,count(*) as pnt "
                . "from tb_student_base a inner join tb_ed_classroom b "
                . "on a.id = b.tb_student_base_id inner join tb_ed_room c "
                . "on b.tb_ed_room_id = c.id inner join tb_ed_school_register_class d "
                . "on c.tb_ed_school_register_class_id = d.id inner join tb_school e "
                . "on e.sc_thai_name = a.tb_student_base_department "
                . "where d.tb_ed_school_register_class_edyear =  " . get_edyear()
                . " and e.sc_localgov = '" . $this->session->userdata('localgov') . "' "
                . "and a.tb_student_base_status = 'S' "
                . "and c.tb_school_id = '" . $school . "'  "
                . "group by a.tb_student_base_department";

        $query = $this->db->query($sql);
        $rs = $query->result();
        if (isset($rs[0]->pnt)) {
            return $rs[0]->pnt;
        } else {
            return 0;
        }
    }
    public function get_std_base_stat_all_school() {

        $sql = "select a.tb_student_base_department as school,count(*) as pnt "
                . "from tb_student_base a inner join tb_ed_classroom b "
                . "on a.id = b.tb_student_base_id inner join tb_ed_room c "
                . "on b.tb_ed_room_id = c.id inner join tb_ed_school_register_class d "
                . "on c.tb_ed_school_register_class_id = d.id inner join tb_school e "
                . "on e.sc_thai_name = a.tb_student_base_department "
                . "where d.tb_ed_school_register_class_edyear =  " . get_edyear()
                . " and e.sc_localgov = '" . $this->session->userdata('localgov') . "' "
                . "and a.tb_student_base_status = 'S' "
                . "group by a.tb_student_base_department";

        $query = $this->db->query($sql);
        $rs = $query->result_array();
        
            return $rs;
        
    }

    public function get_teacher_stat_by_school($school) {
        
    }

    public function get_hr_absent_stat($status) {
        $pnt = 0;
        
        $sql = "select count(*) as pnt from tb_hr_absent_record ";
        $sql .= "where tb_hr_absent_record_status = '".trim($status)."' ";
        $sql .= "and tb_hr_absent_record_department ='".$this->session->userdata('department')."' ";
        $sql .= "and (tb_hr_absent_record_date = '".date('Y-m-d')."' or tb_hr_absent_record_date = '".(date('Y')+543).date('-m-d')."')";
        $query = $this->db->query($sql);
        
        
        
//        $this->db->select('count(*) as pnt');
//        $this->db->from('tb_hr_absent_record');
//        $this->db->where('tb_hr_absent_record_date',(date('Y')+543).date('-m-d'));
//        $this->db->where('tb_hr_absent_record_status', trim($status));
//        $this->db->where('tb_hr_absent_record_department',$this->session->userdata('department'));
//        $query = $this->db->get();
        if ($query->num_rows() != 0) {
            $pnt = $query->row_array()['pnt'];
        }
        return $pnt;
    }
    
    public function get_std_absent_stat($status) {
        $pnt = 0;
        $this->db->select('count(*) as pnt');
        $this->db->from('tb_std_absent_record');
        $this->db->where('tb_std_absent_record_date',(date('Y')+543).date('-m-d'));
        $this->db->where('tb_student_absent_record_status', trim($status));
        $this->db->where('tb_student_absent_record_department',$this->session->userdata('department'));
        $query = $this->db->get();
        if ($query->num_rows() != 0) {
            $pnt = $query->row_array()['pnt'];
        }
        return $pnt;
    }
    

    function get_ta_group_learning($gl) {
        $pnt = 0;
        $this->db->select('count(*) as pnt');
        $this->db->from('tb_human_resources_01 ');
        $this->db->where(array('hr_department' => $this->session->userdata('department')));
        $this->db->where('hr_group_learning', trim($gl));
        $query = $this->db->get();
        if ($query->num_rows() != 0) {
            $pnt = $query->row_array()['pnt'];
        }
        return $pnt;
    }
    
    function get_hr_type_stat($id){
        $pnt = 0;
        $this->db->select('count(*) as pnt');
        $this->db->from('tb_human_resources_01');
        $this->db->where('hr_type_id', $id);
        $this->db->where(array('hr_department' => $this->session->userdata('department')));
        $query = $this->db->get();
        if ($query->num_rows() != 0) {
            $pnt = $query->row_array()['pnt'];
        }
        return $pnt;
    }
    
    function get_hr_degree_stat($type){
        $pnt = 0;
        $this->db->select('count(*) as pnt');
        $this->db->from('tb_human_resources_01');
        $this->db->where('hr_degree', $type);
        $this->db->where(array('hr_department' => $this->session->userdata('department')));
        $query = $this->db->get();
        if ($query->num_rows() != 0) {
            $pnt = $query->row_array()['pnt'];
        }
        return $pnt;
    }

}
