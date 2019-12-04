<?php

class Delete_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function delete_course_by_course_id($id) {
        
        $this->db->delete('tb_course_purpose', array('tb_course_id' => $id));
        $this->db->delete('tb_course_detail', array('tb_course_id' => $id));
        $this->db->delete('tb_unit_learning', array('tb_course_id' => $id));
        $this->db->delete('tb_course_credit', array('tb_course_id' => $id));
        $this->db->delete('tb_course', array('id' => $id));        
   
        }

}
