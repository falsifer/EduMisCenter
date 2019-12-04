<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/*
  | ----------------------------------------------------------------------------
  |  Title
  | ----------------------------------------------------------------------------
  | Copyright	Edutech Co.,Ltd.
  | Purpose
  | Author      Chairatto
  | Create Date 3/3/2562
  | Last edit	4/3/2562
  | Comment	
  | ----------------------------------------------------------------------------
 */

Class Examination extends CI_Controller {

    public function __construct() {
        parent::__construct();
        if ($this->session->userdata('status') == "") {
            redirect("/");
        }
        $this->load->model("My_model");
        $this->load->model("Chairatto_model");
    }

    //--------- 
    public function examination_base() {
        $this->load->view("layout/header");
        $this->load->view("Examination/examination_base");
        $this->load->view("layout/footer");
    }

}
