<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Approve_purchase_model extends CI_Model {

    public function __construct() {
        $this->load->database();
    }

    public function get_all_plan($year_parcel) {
//        $this->db->distinct();
//
//        $this->db->select('responsible');
//
//        $this->db->where(array('project_department' => $this->session->userdata('department')));
//
//        $this->db->order_by('responsible');
//
//        $query = $this->db->get('tb_project_school');
//        $sdate=date_create((intval($year_parcel)-1).'-10-01');
//        $edate=date_create($year_parcel.'-09-30');

        $this->db->select("*");
        $this->db->from("tb_project_school");
        $this->db->where('"' . (intval($year_parcel) - 1) . '-10-01"' . ' BETWEEN tb_project_plan_start and tb_project_plan_end');
        $this->db->where('"' . $year_parcel . '-09-30"' . ' BETWEEN tb_project_plan_start and tb_project_plan_end');
        $this->db->where(array('	project_department' => $this->session->userdata('department')));
        $query = $this->db->get();

        return $query->result_array();
    }

    public function year_parcel() {
        $sql = "SELECT * FROM tb_parcel";
        $query = $this->db->query($sql);
        return $query->row_array();
    }

    public function insert_update($year_parcel37) {
        $get_id = $this->input->post('get_id');
        $name_com = $this->input->post('name_com');
        $last_com = $this->input->post('last_com');
        $position_com = $this->input->post('position_com');
        if ($get_id == '') {
            $sql = "INSERT INTO tb_parcel_commit (name_com,last_com,position_com,year_parcel) VALUE ('$name_com','$last_com','$position_com','$year_parcel37')";
            $status = $this->db->query($sql);
        } else {
            $sql = "UPDATE tb_parcel_commit SET name_com='$name_com',last_com='$last_com',position_com='$position_com'WHERE id='$get_id'";
            $status = $this->db->query($sql);
        }
        if ($status) {
            return true;
        } else {
            return false;
        }
    }

    public function delete($id) {
        $sql = "DELETE FROM tb_parcel_commit WHERE id='$id'";
        $status = $this->db->query($sql);
        if ($status) {
            return true;
        } else {
            return false;
        }
    }

    public function get_purchase_by_project($project) {

        $this->db->select('sum(parcel_price*parcel_product_amt) as purchase');
        $this->db->from('tb_parcel_purchase_itm as a');
        $this->db->join('tb_parcel_purchase as b', 'a.parcel_purchase_id = b.id');
        $this->db->where(array('b.parcel_project_plan' => $project));
        $query = $this->db->get();
        if ($query->num_rows() != 0) {
            return $query->row_array();
        }
        return array();
    }

    public function get_purchase_list_by_project($project_id) {

        $this->db->select('*,c.id as pid,b.id as itmid');
//        $this->db->from('tb_parcel_purchase_itm a');
        $this->db->from('tb_parcel_purchase as b');
        $this->db->join('tb_project_school as c', 'c.project_name = b.parcel_project_plan');
        $this->db->where(array('c.id' => $project_id));
        $query = $this->db->get();
        if ($query->num_rows() != 0) {
            return $query->result_array();
        }
        return array();
    }

    public function get_purchase_list_for_approve() {

        $this->db->select('*,c.id as pid,b.id as itmid');
        $this->db->from('tb_parcel_purchase as b');
        $this->db->join('tb_project_school as c', 'c.project_name = b.parcel_project_plan');
        $this->db->where(array('b.parcel_status' => 'รอการอนุมัติ','b.year_parcel'=> get_budget_year(date('Y-m-d'))));
        $query = $this->db->get();
        if ($query->num_rows() != 0) {
            return $query->result_array();
        }
        return array();
    }

    public function get_purchase_list_was_approved() {

//        $this->db->select('*,c.id as pid,b.id as itmid');
//        $this->db->from('tb_parcel_purchase as b');
//        $this->db->join('tb_project_school as c', 'c.project_name = b.parcel_project_plan');
//        $this->db->where(array('b.parcel_status' => 'อนุมัติ'));
//        $this->db->or_where(array('b.parcel_status' => 'เรียบร้อย'));
//        
        $sql = "select *,c.id as pid,b.id as itmid ";
        $sql .= "from tb_parcel_purchase as b ";
        $sql .= "inner join tb_project_school as c on c.project_name = b.parcel_project_plan ";
        $sql .= "where b.year_parcel = '". get_budget_year(date('Y-m-d'))."' ";
        $sql .= "and (b.parcel_status='อนุมัติ' or b.parcel_status='ตรวจรับ' or b.parcel_status='เรียบร้อย')";

        $query = $this->db->query($sql);
        if ($query->num_rows() != 0) {
            return $query->result_array();
        }
        return array();
    }

    public function get_purchase_list($id) {

        $this->db->select('*,b.id as pid');
        $this->db->from('tb_parcel_purchase_itm a');
        $this->db->join('tb_parcel_purchase as b', ' a.parcel_purchase_id= b.id');
        $this->db->where(array('b.id' => $id));
        $query = $this->db->get();
        if ($query->num_rows() != 0) {
            return $query->result_array();
        }
        return array();
    }

    public function get_purchase_total($parcel_id) {
        $this->db->select('sum(parcel_price*parcel_product_amt) as total');
        $this->db->from('tb_parcel_purchase_itm');
        $this->db->where(array('parcel_purchase_id' => $parcel_id));
        $query = $this->db->get();
        if ($query->num_rows() != 0) {
            $rs = $query->row_array();
            return $rs['total'];
        }
        return 0;
    }

}

/* End of file Committee_model.php */
/* Location: .//C/Users/COM-BIG-BEN/AppData/Local/Temp/fz3temp-2/Committee_model.php */