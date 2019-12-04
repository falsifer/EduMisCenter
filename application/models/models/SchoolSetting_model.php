<?php

class SchoolSetting_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function get_hr_position() {
        $MyQuery = $this->db->query("SELECT * FROM `tb_hr_position` WHERE `id` not in (select tb_hr_position_id from tb_hr_position_register)");
        if ($MyQuery->num_rows() > 0) {
            return $MyQuery->result_array();
        } else {
            return false;
        }
    }

}
