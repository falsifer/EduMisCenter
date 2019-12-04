<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/*
  | ----------------------------------------------------------------------------
  |  Title  Accessories_model
  | ----------------------------------------------------------------------------
  | Copyright	Edutech Co.,Ltd.
  | Purpose     โมเดลการช่วยเหลือ
  | Author	นายบัณฑิต ไชยดี
  | Create Date
  | Last edit	-
  | Comment	-
  | ----------------------------------------------------------------------------
 */

class Parcel_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function get_depreciation_list() {
        $this->db->select('a.*,b.*,a.id as did');
        $this->db->from('tb_parcel_depreciate a');
        $this->db->join('tb_parcel_category b', 'a.tb_parcel_category_id=b.id');
        $this->db->where('b.type_category = 2');
        $this->db->order_by('b.name_cat');
        $query = $this->db->get();
        if ($query) {
            return $query->result_array();
        }
        return array();
    }
    
    public function get_asset_list() {
        $this->db->select('*,b.id as controlId');
        $this->db->from('tb_parcel_product a');
        $this->db->join('tb_parcel_purchase_itm i','a.id=i.parcel_product_id');
        $this->db->join('tb_parcel_control b', 'i.id=b.tb_parcel_purchase_item_id');
        $this->db->join('tb_parcel_category c', 'a.category_id=c.id');
        $this->db->join('tb_parcel_depreciate d', 'c.id=d.tb_parcel_category_id','left outer');
        $this->db->where(array('a.tb_school_id' => $this->session->userdata('sch_id')));
        $this->db->order_by('b.tb_parcel_control_rc_date');
        $query = $this->db->get();
        if ($query) {
            return $query->result_array();
        }
        return array();
    }
    

}
