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
  | Create Date 15/3/2562
  | Last edit	15/3/2562
  | Comment	-
  | ----------------------------------------------------------------------------
 */

Class Transfer_score extends CI_Controller {

    public function __construct() {
        parent::__construct();
        if ($this->session->userdata('status') == "") {
            redirect("/");
        }
        $this->load->model("My_model");
        $this->load->model("Chairatto_model");
    }

    //--------- งานเทียบโอน
    public function transfer_score_base() {
        $this->load->view("layout/header");
        $this->load->view("transfer_score/transfer_score_base");
        $this->load->view("layout/footer");
    }

    public function genexcel() {
        $file = "test.xlsx";
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename=' . $file);
        $content = "Col1\tCol2\tCol3\t\n";
        $content .= "test1\ttest1\ttest3\t\n";
        $content .= "testtest1\ttesttest2\ttesttest3\t\n";
        echo $content;
    }

}
