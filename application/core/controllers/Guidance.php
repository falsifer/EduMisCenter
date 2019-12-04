<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/*
  | ----------------------------------------------------------------------------
  |  Title
  | ----------------------------------------------------------------------------
  | Copyright	Edutech Co.,Ltd.
  | Purpose
  | Author
  | Create Date
  | Last edit	-
  | Comment	-
  | ----------------------------------------------------------------------------
 */

Class Guidance extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('My_model');
    }

    public function gd_base() {
        $data['rs'] = $this->My_model->get_all("tb_standard_learning");
        $this->load->view("layout/header");
        $this->load->view("guidance/gd_base", $data);
        $this->load->view("layout/footer");
    }

}
