<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
 
class Import_model extends CI_Model {
 
    public function importData($table,$data) {
 
        $res = $this->db->insert_batch($table,$data);
        if($res){
            return TRUE;
        }else{
            return FALSE;
        }
 
    }
 
}
 
?>