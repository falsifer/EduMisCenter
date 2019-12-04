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
  | Create Date 22/11/2561
  | Last edit	22/11/2561
  | Comment	-
  | ----------------------------------------------------------------------------
 */

Class Teach_results extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model("My_model");
        $this->load->model("Tr_model");
        $this->load->model("Kpi_std_model");
    }

    // index
    public function index() {
        
    }

    public function tr_base() {
        
        $data['rs'] = $this->Kpi_std_model->kpi_base();
        $data['std'] = $this->My_model->get_all('tb_human_resources_01');
        $this->load->view("layout/header");
        $this->load->view("teach_result/tr_base",$data);
        $this->load->view("layout/footer");
    }

    //-------------///
}
