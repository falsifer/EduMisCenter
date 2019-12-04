<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/*
  | ----------------+-----------------------------------------------------------
  |  Title          |   Vocational
  | ----------------+-----------------------------------------------------------
  |  Copyright      |   Edutech Co.,Ltd.
  |  Purpose        |   ระบบงานอาชีวศึกษา
  |  Author         |   นายบัณฑิต ไชยดี
  |  Create Date    |   January 11,2019
  |  Last edit      |   -
  |  Comment        |   -
  | ----------------+-----------------------------------------------------------
 */

class Vocational extends CI_Controller {

    public function __construct() {
        parent::__construct();
    }

    // กำหนดประเภทสถานประกอบการ
    public function company_type() {
        $this->load->view('layout/header');
        $this->load->view('vocational/company_type');
        $this->load->view('layout/footer');
    }

    //
    #===============================================================================
    #   Title       |   ข้อมูลสถานประกอบการ
    #===============================================================================
    #   Author      |   Mr.Hidemi Minakawa
    #   Date        |   January 11, 2019
    #   Last Update |
    #===============================================================================
    //
    public function company() {
        $this->load->view('layout/header');
        $this->load->view('vocational/company');
        $this->load->view('layout/footer');
    }

}
