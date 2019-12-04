<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/*
  | ----------------------------------------------------------------------------
  |  Title      Vichakarn
  | ----------------------------------------------------------------------------
  | Copyright	Edutech Co.,Ltd.
  | Purpose     Vichakarn Controller (School Zone)
  | Author
  | Create Date
  | Last edit	-
  | Comment	-
  | ----------------------------------------------------------------------------
 */

Class Vichakarn extends CI_Controller {

    public function __construct() {
        parent::__construct();
      
        $this->load->model("My_model");
        //$this->load->library('mpdf/mpdf');
    }

    // index
    public function index() {
        if ($this->session->userdata("status") == "") {
            redirect('login');
        }
        
        $data['class'] = $this->My_model->get_all('tb_ed_classroom_online');
        $this->load->view("layout/header");
        $this->load->view("vichakarn/school/schedule", $data);
        $this->load->view('layout/footer');
    }

}
