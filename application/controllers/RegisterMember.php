<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/*
  | ----------------------------------------------------------------------------
  |  Title
  | ----------------------------------------------------------------------------
  | Copyright	Edutech Co.,Ltd.
  | Purpose
  | Author	นายบัณฑิต ไชยดี
  | Create Date
  | Last edit	-
  | Comment	-
  | ----------------------------------------------------------------------------
 */

class RegisterMember extends CI_Controller {

    public function __construct() {
        parent::__construct();
    }
    
    public function register(){
        $idcard= $this->input->post('inHrIdCard');
        $title= $this->input->post('inHrThaiSymbol');
        $fname= $this->input->post('inHrThaiName');
        $lname= $this->input->post('inHrThaiLastname');
        $school= $this->input->post('inDepartment');
        $chk = $this->My_model->count_record_where('tb_member',array('username'=>$idcard));
        
        if($chk==0)
        {
            $mid = $this->My_model->insert_data('tb_member',array('username'=>$idcard,'password'=>$idcard,'department'=>$school,'status'=>'ผู้ปฏิบัติงาน','activate'=>'1'));
            
            if(isset($mid))
            {
                $this->My_model->insert_data('tb_human_resources_01',array('tb_member_id'=>$mid,'hr_id_card'=>$idcard,'hr_department'=>$school,'hr_thai_symbol'=>$title,'hr_thai_name'=>$fname,'hr_thai_lastname'=>$lname));
            }
            
        }else{
            return false;
        }
        
    }
}