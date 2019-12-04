<?php

class Manpower_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }
    
    function get_manpower(){
        $this->db->select('(hr_year_birthday)+60 hr_year_birthday,count(*) cnt');
        $this->db->from('tb_human_resources_01');
        $this->db->where('(hr_year_birthday = '.(date('Y')+543-60).' or hr_year_birthday = '.(date('Y')+544-60).' or hr_year_birthday = '.(date('Y')+545-60).' or hr_year_birthday = '.(date('Y')+546-60).' or hr_year_birthday = '.(date('Y')+547-60).')');
        $this->db->where(array('hr_department'=> $this->session->userdata('department')));
        $this->db->group_by('(hr_year_birthday)+60');
        $query = $this->db->get();
        if ($query->num_rows() != 0) {
            return $query->result_array();
        }
        return array();
        
    }
    
    
    function get_all_absent(){
        
        $this->db->select('tb_hr_absent_record_status,count(*) as pnt');
        $this->db->from('tb_hr_absent_record');
        $this->db->where('tb_hr_absent_record_date=DATE_FORMAT(NOW(),\'%Y-%m-%d\')');
        $this->db->group_by('tb_hr_absent_record_status');
        $query = $this->db->get();
        if ($query->num_rows() != 0) {
            return $query->result_array();
        }
        return array();
    }
    
    
   function get_ta_group_learning(){
       $this->db->select('a.tb_group_learningcol_name as hr_group_learning,count(*) as pnt');
       $this->db->from('tb_group_learning a');
       $this->db->join('tb_human_resources_01 b','a.tb_group_learningcol_name = b.hr_group_learning','left outer');
        $this->db->where(array('hr_department'=> $this->session->userdata('department')));
        $this->db->group_by('a.tb_group_learningcol_name');
        $query = $this->db->get();
        if ($query->num_rows() != 0) {
            return $query->result_array();
        }
        return array();
   }
   
   function get_hr_group(){
       $this->db->select('hr_rank,count(*) as pnt');
       $this->db->from('tb_human_resources_01');
       $this->db->where(array('hr_department'=> $this->session->userdata('department')));
        $this->db->group_by('hr_rank');
        $query = $this->db->get();
        if ($query->num_rows() != 0) {
            return $query->result_array();
        }
        return array();
   }
}