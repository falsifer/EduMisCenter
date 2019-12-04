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
  | Create Date 23/11/2018
  | Last edit	-
  | Comment	-
  | ----------------------------------------------------------------------------
 */

class Education_chat extends CI_Controller {

    public function __construct() {
        parent::__construct();
        if ($this->session->userdata('status') == "") {
            redirect("/");
        }
        $this->load->model("My_model");
        $this->load->model("Chairatto_model");
    }

    public function education_chat_base() {
        $data['rs'] = $this->Chairatto_model->education_chat_base();
        $this->load->view("layout/header");
        $this->load->view("education_chat/education_chat_base", $data);
        $this->load->view("layout/footer");
    }

    public function Education_chat_refresh() {

        $id = $_POST['GId'];
        $memberid = 9;
        $output = "";
        $MyQ = $this->db->select("*")->from("tb_chat_group_log")->where("tb_chat_group_id", $id)->get()->result();


        foreach ($MyQ as $row) {
//            if ($row->tb_member_id == $memberid) {
            if ($row->tb_chat_group_log_recorder == $this->session->userdata('name')) {
                $output .= "<div class=\"row\">";
                $output .= "<div class=\"col-md-6 col-md-offset-6\">";
                $output .= " <div class=\"chatcontainer darker\">";

                $output .= "<span class=\"pull-right\"><p>" . $row->tb_chat_group_log_content . "</p>";
                $output .= "<span class=\"time-right\">" . $row->tb_chat_group_log_time . "</span>";

                $output .= "</div>";
                $output .= "</div>";
                $output .= "</div>";
            } else {
                $output .= "<div class=\"row\">";
                $output .= "<div class=\"col-md-6 \">";
                $output .= " <div class=\"chatcontainer\">";

                $output .= "<img src=" . base_url() . "upload/Pr1.jpg" . " alt=\"Avatar\" style=\"width:100%;\">";
                $output .= "<p><b>" . $row->tb_chat_group_log_recorder . "</b></p>";
                $output .= "<p>" . $row->tb_chat_group_log_content . "</p>";
                $output .= "<span class=\"time-left\">" . $row->tb_chat_group_log_time . "</span>";

                $output .= "</div>";
                $output .= "</div>";
                $output .= "</div>";
            }
        }


        echo $output;
    }

    public function insert_log() {
        $arr = array(
            "tb_chat_group_id" => $this->input->post('inGroupId'),
            "tb_member_id" => 9,
            "tb_chat_group_log_content" => $this->input->post('inChatContent'),
            "tb_chat_group_log_type" => "Text",
            "tb_chat_group_log_recorder" => $this->session->userdata('name'),
            "tb_chat_group_log_department" => $this->session->userdata('department'),
            "tb_chat_group_log_time" => date('H:i:s'),
            "tb_chat_group_log_createdate" => date('Y-m-d H:i:s')
        );
        $this->My_model->insert_data('tb_chat_group_log', $arr);
    }

    public function Education_canvas_insert() {
        $img = $_POST['data'];
        $img = str_replace('data:image/png;base64,', '', $img);
        $img = str_replace(' ', '+', $img);
        $fileData = base64_decode($img);
        $fileName = 'steam/' . $this->session->userdata('member_id') . '_' . time() . '.png ';
        file_put_contents($fileName, $fileData);
    }

}
