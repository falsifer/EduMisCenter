<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/*
  | ----------------------------------------------------------------------------
  |  Title
  | ----------------------------------------------------------------------------
  | Copyright	Edutech Co.,Ltd.
  | Purpose     โมเดลสำหรับงานแหล่งเรียนรู้
  | Author
  | Create Date 23/11/2018
  | Last edit	-
  | Comment	-
  | ----------------------------------------------------------------------------
 */

class Dc_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    // ดึงข้อมูล
    function get_dc_data() {
        $this->db->select("a.*, b.*,  b.id AS bid,a.id as itm_id")->from("tb_group_learning_item a");
        $this->db->join("tb_group_learning b", "b.id = a.tb_group_learning_id", "left outer");
//        $this->db->join("tb_standard_learning c", "c.tb_group_learning_item_id = b.id","left outer");
        $this->db->order_by("b.tb_group_learning_seq ,a.tb_group_learning_item_seq  asc");
        $rs = $this->db->get();
        if ($rs->num_rows() > 0) {
            return $rs->result_array();
        }
        return array();
    }

    function get_dc_data_yearly($year) {
        $this->db->select("a.*, b.*,  b.id AS bid,a.id as itm_id")->from("tb_group_learning_item a");
        $this->db->join("tb_group_learning b", "b.id = a.tb_group_learning_id", "left outer");
//        $this->db->join("tb_standard_learning c", "c.tb_group_learning_item_id = b.id","left outer");
        $this->db->order_by("b.tb_group_learning_seq ,a.tb_group_learning_item_seq asc");
        $rs = $this->db->get();
        if ($rs->num_rows() > 0) {
            return $rs->result_array();
        }
        return array();
    }

    // แก้ไขข้อมูล
    function get_dc_edit($id) {
        $this->db->select("a.*, b.*, b.id AS bid")->from("tb_group_learning_item a");
        $this->db->join("tb_group_learning b", "b.id = a.tb_group_learning_id");
        //$this->db->join("tb_km_picture c", "c.km_id = b.id");
        $this->db->where("b.tb_group_learning_seq ,a.tb_group_learning_item_seq asc");
        $rs = $this->db->get();
        if ($rs->num_rows() > 0) {
            return $rs->row_array();
        }
        return array();
    }

    function delete_dc_gl($id) {
        try {
            $this->db->select("*")->from('tb_standard_learning');
            $this->db->where(array('tb_group_learning_item_id' => $id));
            $query = $this->db->get();

            $this->db->trans_start();


            if ($query->num_rows() > 0) {
                $std = $query->result_array();
                foreach ($std as $st) {
                    $this->db->delete('tb_kpi_standard_learning', array('tb_standard_learning_id' => $st['id']));
                }
            }
            print($id);

            $this->db->delete('tb_standard_learning', array('tb_group_learning_item_id' => $id));
            $this->db->delete('tb_group_learning_item', array('id' => $id));


            if ($this->db->trans_status() === FALSE) {
                $this->db->trans_rollback();
            } else {
                $this->db->trans_commit();
            }
        } catch (Exception $e) {
            print($e);
        }
    }

    function get_group_learning_item_list($id) {
        $output = "<option value=''>-เลือกข้อมูล-</option>";
        $this->db->select("*")->from('tb_group_learning_item');
        $this->db->where(array('tb_group_learning_id' => $id));
        $this->db->order_by('tb_group_learning_item_seq');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $gl = $query->result_array();
                foreach ($gl as $r) {
                    $output .= "<option value='".$r['id']."'>".$r['tb_group_learning_item_content']."</option>";
                }
        }
        echo $output;
    }
    
    
    function get_std_item_list($id) {
        $output = "<option value=''>-เลือกข้อมูล-</option>";
        $this->db->select("*")->from('tb_standard_learning');
        $this->db->where(array('tb_group_learning_item_id' => $id));
        $this->db->order_by('tb_standard_learning_code');
        $query = $this->db->get();
        
        if ($query->num_rows() > 0) {
            $gl = $query->result_array();
                foreach ($gl as $r) {
                    $output .= "<option value='".$r['id']."'>".$r['tb_standard_learning_code']." ".$r['tb_standard_learning_content']."</option>";
                }
        }
        echo $output;
    }
    
    
    function get_kpi_edit($id){
        $this->db->select("b.id as kpi_id, b.*,  a.*,c.*,d.*")->from("tb_standard_learning a");
        $this->db->join("tb_kpi_standard_learning b", "a.id = b.tb_standard_learning_id", "left outer");
        $this->db->join("tb_group_learning_item c", "c.id = a.tb_group_learning_item_id","left outer");
        $this->db->join("tb_group_learning d", "d.id = c.tb_group_learning_id","left outer");
        $this->db->where('b.id',$id);
        $rs = $this->db->get();
        if ($rs->num_rows() > 0) {
            return $rs->row_array();
        }
        return array();
    }

}
