<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/*
  | ----------------------------------------------------------------------------
  |  Title
  | ----------------------------------------------------------------------------
  | Copyright	Edutech Co.,Ltd.
  | Purpose     งานประเมิน
  | Author      chairatto
  | Create Date 10/2/2019
  | Last edit	10/2/2019
  | Comment	-
  | ----------------------------------------------------------------------------
 */

Class Childhood extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model("My_model");
        $this->load->model("Homeroom_model");
    }

    public function childhood_base() {
        $data['HomeroomList'] = $this->Homeroom_model->get_ed_homeroom_w_hr_id();
        $this->load->view("layout/header");
        $this->load->view("childhood/childhood_base", $data);
        $this->load->view("layout/footer");
    }

}
