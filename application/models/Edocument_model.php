<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/*
  | ----------------------------------------------------------------------------
  |  Title
  | ----------------------------------------------------------------------------
  | Copyright	Edutech Co.,Ltd.
  | Purpose     งานประเมิน
  | Author      chairatto
  | Create Date 10/2/2019
  | Last edit	10/2/2019
  | Comment	-
  | ----------------------------------------------------------------------------
 */

class Edocument_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }
    
    
    public function get_inbox(){
        $this->db->select('*')->from('tb_e_document');
        $this->db->where(array('edoc_to_department'=>$this->session->userdata('department')));
        $this->db->order_by('edoc_rc_date desc');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return array();
    }
    
    public function get_inbox_personal(){
        $this->db->select('*')->from('tb_e_document');
        $this->db->where(array('edoc_psermission'=>'ปกติ','edoc_tracking_type'=>'เพื่อโปรดทราบ','edoc_to_department'=>$this->session->userdata('department')));
//        $this->db->or_where(array('edoc_to'=>$this->session->userdata('username')));
        $this->db->order_by('edoc_rc_date desc');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return array();
    }
    
    public function get_outbox(){
        $this->db->select('*')->from('tb_e_document');
        $this->db->where('edoc_to_department !="'.$this->session->userdata('department').'"');
        $this->db->where('edoc_department ="'.$this->session->userdata('department').'"');
        $this->db->order_by('edoc_send_date desc');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return array();
    }
}