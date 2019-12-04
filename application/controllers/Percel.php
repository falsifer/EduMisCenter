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

Class Percel extends CI_Controller {

    public function __construct() {
        parent::__construct();

    }

    public function index() {

//        $this->load->view("layout/header");
        $this->load->view("percel/inc/header");
        $this->load->view("percel/index");
        $this->load->view("percel/inc/footer");
//        $this->load->view("layout/footer");
    }
    
    public function department() {

        $this->load->view("percel/inc/header");
        $this->load->view("percel/department");
        $this->load->view("percel/inc/footer");
    }
    public function seller() {

        $this->load->view("percel/inc/header");
        
        $this->load->view("percel/seller");
        $this->load->view("percel/inc/footer");
    }
    public function purchaser() {

        $this->load->view("percel/inc/header");
        $this->load->view("percel/purchaser");
        $this->load->view("percel/inc/footer");
    }
    public function committee() {

        $this->load->view("percel/inc/header");
        $this->load->view("percel/committee");
        $this->load->view("percel/inc/footer");
    }
    public function number() {

        $this->load->view("percel/inc/header");
        $this->load->view("percel/number");
        $this->load->view("percel/inc/footer");
    }
    public function material() {

        $this->load->view("percel/inc/header");
        $this->load->view("percel/material");
        $this->load->view("percel/inc/footer");
    }
    public function unspec() {

        $this->load->view("percel/inc/header");
        $this->load->view("percel/unspec");
        $this->load->view("percel/inc/footer");
    }
    public function articles() {

        $this->load->view("percel/inc/header");
        $this->load->view("percel/articles");
        $this->load->view("percel/inc/footer");
    }
    public function plan() {

        $this->load->view("percel/inc/header");
        $this->load->view("percel/plan");
        $this->load->view("percel/inc/footer");
    }
    public function approve_purchase() {

        $this->load->view("percel/inc/header");
        $this->load->view("percel/approve_purchase");
        $this->load->view("percel/inc/footer");
    }
    public function carry() {

        $this->load->view("percel/inc/header");
        $this->load->view("percel/carry");
        $this->load->view("percel/inc/footer");
    }
    public function egp() {

        $this->load->view("percel/inc/header");
        $this->load->view("percel/egp");
        $this->load->view("percel/inc/footer");
    }
    public function selling() {

        $this->load->view("percel/inc/header");
        $this->load->view("percel/selling");
        $this->load->view("percel/inc/footer");
    }
}