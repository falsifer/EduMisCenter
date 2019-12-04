<?php

// Human Resources model
class NT_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }
    
    public function get_nt_base() {
        $this->db->select('*,t.id as tid,nt.id as ntid');
        $this->db->from('tb_ed_nt_type t');
        $this->db->join('tb_ed_nt_base nt','t.id=nt.tb_ed_nt_type_id','left outer');
        $this->db->where('nt.tb_ed_nt_year', get_edyear());
        $rs = $this->db->get();
        if($rs){
            return $rs->result_array();
        }
        
        
    }
    
}