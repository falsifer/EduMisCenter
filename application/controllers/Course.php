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
  | Create Date 18/2/2562
  | Last edit	18/2/2562
  | Comment	
  | ----------------------------------------------------------------------------
 */

Class Course extends CI_Controller {

    public function __construct() {
        parent::__construct();
        if ($this->session->userdata('status') == "") {
            redirect("/");
        }
        
        $this->load->model("My_model");
    }

    //------------------ ลงทะเบียนเรียน
    public function cr_base() {
        $this->load->view("layout/header");
        $this->load->view("course_register/cr_base");
        $this->load->view("layout/footer");
    }

}
