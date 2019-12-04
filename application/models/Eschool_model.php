<?php
class Eschool_model extends CI_Model{
    public function __construct() {
        parent::__construct();
    }
    //
    function get_menu($item){
        $this->db->select("*")->from('tb_member a');
        $this->db->join('tb_member_activities b','b.member_id = a.id');
        $this->db->join('tb_data_define c','c.id = b.data_define_id');
        $this->db->where('a.id',$this->session->userdata('member_id'))->where('c.data_group',$item)->where('c.department=\'กองการศึกษา\'');
        $query=$this->db->get();
        if($query->num_rows()>0){
            return $query->result_array();
        }
        return array();
    }
    
    
    function get_menu_sch(){
        $this->db->select("*")->from('tb_member a');
        $this->db->join('tb_member_activities b','b.member_id = a.id');
        $this->db->join('tb_data_define c','c.id = b.data_define_id');
        $this->db->where('a.id',$this->session->userdata('member_id'))->where('c.department = \''.$this->session->userdata('department').'\'');
        $this->db->order_by('c.id');
        $query=$this->db->get();
        if($query->num_rows()>0){
            return $query->result_array();
        }
        return array();
    }
    
    
    function get_menu_sch_by($param){
        $this->db->select("*")->from('tb_member a');
        $this->db->join('tb_member_activities b','b.member_id = a.id');
        $this->db->join('tb_data_define c','c.id = b.data_define_id');
        $this->db->where('a.id',$this->session->userdata('member_id'));
//        $this->db->where('a.id',$this->session->userdata('member_id'))->where('c.department = \''.$this->session->userdata('department').'\'');
        $this->db->where('c.data_group',$param);
        $this->db->order_by('c.id');
        $query=$this->db->get();
        if($query->num_rows()>0){
            return $query->result_array();
        }
        return array();
    }
}