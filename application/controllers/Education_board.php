<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/*
  | ----------------------------------------------------------------------------
  |  Title
  | ----------------------------------------------------------------------------
  | Copyright	Edutech Co.,Ltd.
  | Purpose
  | Author      chairatto
  | Create Date 3/3/2562
  | Last edit	3/3/2562
  | Comment	-
  | ----------------------------------------------------------------------------
 */

class Education_board extends CI_Controller {

    public function __construct() {
        parent::__construct();
        if ($this->session->userdata('status') == "") {
            redirect("/");
        }
        $this->load->model("My_model");
        $this->load->model("Chairatto_model");
    }

    public function education_board_base() {
//        $data['rs'] = $this->Chairatto_model->education_chat_base();
        $this->load->view("layout/header");
        $this->load->view("education_board/education_board_base");
        $this->load->view("layout/footer");
    }

}
