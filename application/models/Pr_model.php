<?php

class Pr_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function get_PR() {
        $this->db->select('*');
        $this->db->from('tb_public_relations');
        $this->db->where(array('pr_department' => $this->session->userdata('department')));
        $this->db->order_by('pr_date desc');
        
        
        $rs= $this->db->get()->result_array();
        
        return $rs;
    }
    
    function get_curr_PR() {
        $this->db->select('*');
        $this->db->from('tb_public_relations');
        $this->db->where(array('pr_department' => $this->session->userdata('department')));
        $this->db->where('date(pr_date) <= date(\''.date('Y-m-d').'\')');
        $this->db->where('date(pr_enddate) >= date(\''.date('Y-m-d').'\')');
        $this->db->order_by('pr_date desc');
        
        
        $rs= $this->db->get()->result_array();
        
        return $rs;
    }
    
    function get_PR_internal() {
        $this->db->select('*');
        $this->db->from('tb_public_relations');
        $this->db->where(array('pr_department' => $this->session->userdata('department')));
        $this->db->where('date(pr_date) <= date(\''.(date('Y')+543)."-".date('m-d').'\')');
        $this->db->where('date(pr_enddate) >= date(\''.(date('Y')+543)."-".date('m-d').'\')');
        $this->db->where(array('pr_status' => 'ภายใน'));
        $this->db->order_by('pr_date desc');
        
        
        $rs= $this->db->get()->result_array();
        
        return $rs;
    }
    
    function get_PR_external() {
        $this->db->select('*');
        $this->db->from('tb_public_relations');
        $this->db->where(array('pr_department' => $this->session->userdata('department')));
        $this->db->where('date(pr_date) <= date(\''.(date('Y')+543)."-".date('m-d').'\')');
        $this->db->where('date(pr_enddate) >= date(\''.(date('Y')+543)."-".date('m-d').'\')');
        $this->db->where(array('pr_status' => 'สาธารณะ'));
        $this->db->order_by('pr_date desc');
        
        
        $rs= $this->db->get()->result_array();
        
        return $rs;
    }
   
    
    function get_PR_by_school($sch) {
        
        $sql = "select * from tb_public_relations where tb_school_id = ".$sch;
        $sql .= " or (tb_school_id != ".$sch." and pr_status='สาธารณะ' ) and ";
        $sql .= " date(pr_date) <= date('".(date('Y')+543)."-".date('m-d')."') ";
        $sql .= " and date(pr_enddate) >= date('".(date('Y')+543)."-".date('m-d')."') order by pr_date desc";
        
        $q = $this->db->query($sql);

        $rs= $q->result_array();
        
        return $rs;
    }
}