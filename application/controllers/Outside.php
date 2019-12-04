<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/*
  | ============================================================================
  |  Title: Class Setting
  | ============================================================================
  | Copyright	Edutech Co.,Ltd.
  | Purpose     -
  | Author	chairatto
  | Create Date  12/11/2562
  | Last edit	-
  | Comment	สำหรับใช้งานภายนอก ความปลอดภัยต่ำ
  | ============================================================================
 */

class Outside extends CI_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function enroll_register_form_base() {
        $data['school'] = $this->My_model->get_where_row("tb_school", array("id" => $this->input->post("school_id")));
        load_view($this, "outside/enroll_register_form_base", $data);
    }

}
