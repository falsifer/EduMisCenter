<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Plan_month extends CI_Controller {
	function story() {
        parent::__construct();
    }

    function _remap($parameter){
        $this->_index($parameter);
    }  

    public function _index($id) {   
    $data['get_id'] = $id;     
           $this->load->view('parcel/inc/header',$data);
		$this->load->view('parcel/plan_month');
		$this->load->view('parcel/inc/header');           

    }

}

/* End of file Plan_month.php */
/* Location: ./application/controllers/Plan_month.php */