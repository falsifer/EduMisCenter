<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Plan_model extends CI_Model {

    public function __construct() {
        $this->load->database();
    }

    public function get() {
        $sql = "SELECT * FROM tb_parcel_commit";
        $query = $this->db->query($sql);
        return $query->result_array();
    }

    public function year_parcel() {
        $sql = "SELECT * FROM tb_parcel";
        $query = $this->db->query($sql);
        return $query->row_array();
    }

    public function insert_update() {
        $get_id = $this->input->post('get_id');
        $month_plan = $this->input->post('inMonthPlan');
        $depar_plan = $this->input->post('inDeparPlan');
        $week_plan = $this->input->post('inWeekPlan');
        $approval_plan = $this->input->post('inApprovalPlan');
        $number_plan = $this->input->post('inNumberPlan');
        $list_plan = $this->input->post('inListPlan');
        $total_plan = $this->input->post('inTotalPlan');
        
        $sql = "SELECT * FROM tb_parcel";
        $query = $this->db->query($sql);
        $year_plan = $query->row_array();

        $arr = array(
                'month_plan' => $month_plan,
                'depar_plan' => $depar_plan,
                'week_plan' => $week_plan,
                'number_plan' => $number_plan,
                'approval_plan' => $approval_plan,
                'list_plan' => $list_plan,
                'total_plan' => $total_plan,
                'year_parcel' => $year_plan['year_parcel']
            );
        if ($get_id == '') {  
            $status = $this->db->insert('tb_parcel_plan', $arr);
        } else {
            $status = $this->db->where(array('id'=>$get_id))->update('tb_parcel_plan', $arr);
        }
        if ($status) {
            return true;
        } else {
            return false;
        }
    }

    public function delete($id) {
        $sql = "DELETE FROM tb_parcel_plan WHERE id='$id'";
        $status = $this->db->query($sql);
        if ($status) {
            return true;
        } else {
            return false;
        }
    }

}

/* End of file Committee_model.php */
/* Location: .//C/Users/COM-BIG-BEN/AppData/Local/Temp/fz3temp-2/Committee_model.php */