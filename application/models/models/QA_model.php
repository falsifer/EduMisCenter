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
  | Create Date 15/12/2018
  | Last edit	-
  | Comment	-
  | ----------------------------------------------------------------------------
 */

class QA_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function get_tools_link_view($tools, $toolsid, $id) {

        $out = "";

        $toolArr = explode(",", $tools);

        if ($toolsid != "") {

            $toolIdArr = explode(",", $toolsid);
            foreach ($toolIdArr as $r) {
                $rs = $this->My_model->get_where_row('tb_data_define', array('id' => $r));

                if (isset($rs['id'])) {
                    $out .= "<a href='" . site_url($rs['data_address']) . "' target='_blank'>" . $rs['data_name'] . "</a>&nbsp;";
                }
            }
        } else {
            foreach ($toolArr as $r) {
                
                $rs = $this->My_model->get_where_row('tb_qa_plan_kpi', array('id' => $id));

                if (isset($rs['id'])) {
                    if ($rs['tb_qa_plan_kpi_attachment']!=null && $rs['tb_qa_plan_kpi_attachment']!="") {
                        $out .= "<a href='" . base_url(qa_path() . $rs['tb_qa_plan_kpi_attachment']) . "' class='btn btn-link' target='_blank'>" . $r . "</a>&nbsp;";
                    }else{
                        $out .= "<button class='btn btn-link btn-upload' title='" . $r . "' id='".$id."'>" . $r . "</button>&nbsp;";
                    }
                }
            }
        }

        echo $out;
    }

}
