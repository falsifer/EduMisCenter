<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Title_model extends CI_Model {
	public function __construct()
	{
		$this->load->database();
	}
	public function news(){
		$sql = "SELECT * FROM news_has_passed ORDER BY news_id DESC";
		$query = $this->db->query($sql);
		return $query->result_array();
	}
	public function get_product()
    {
        $sql = "SELECT * FROM sbd_product WHERE automative_active = 'store' ORDER BY RAND() LIMIT 4";
        $query = $this->db->query($sql);
        return $query->result_array();
    }

}

/* End of file Title_model.php */
/* Location: .//C/Users/COM-BIG-BEN/AppData/Local/Temp/fz3temp-2/Title_model.php */