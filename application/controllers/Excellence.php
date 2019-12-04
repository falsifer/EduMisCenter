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
  | Create Date 23/8/2019
  | Last edit	23/8/2019
  | Comment	-
  | ----------------------------------------------------------------------------
 */

Class Excellence extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model("My_model");
    }

    public function excellence_base() {
        $MyArray = $this->My_model->get_where_order('tb_school_excellence', array('tb_school_id' => $this->session->userdata('sch_id')), 'id asc');
        $output = "";

        $i = 1;
        foreach ($MyArray as $r) {
            $output .= "<tr style='font-size:0.8em;'>";

            $output .= "<td style='text-align: center;'>" . $i . "</td>";
            $output .= "<td style='text-align: center;'>ตั้งแต่วันที่ " . datethaifull($r['tb_school_excellence_startdate']) . "<br/> จนถึงวันที่ " . datethaifull($r['tb_school_excellence_enddate']) . "</td>";
            $output .= "<td style='text-align: center;'><button type='button' alt='" . $r['tb_school_excellence_name'] . "' class='btn btn-link' id='" . $r['id'] . "' onclick='DetailThis(this)'>" . $r['tb_school_excellence_name'] . "</button></td>";
            $output .= "<td style='text-align: center;'>" . $r['tb_school_excellence_detail'] . "</td>";
            $output .= "<td style='text-align: center;'>การแข่งขันทางด้าน" . $r['tb_school_excellence_type'] . "</td>";
            $output .= "<td style='text-align: center;'>" . $r['tb_school_excellence_level'] . "</td>";

            $output .= "<td style='text-align: center;'><div class='btn-group'>";
            $output .= "<button type='button' class='col-md-6 btn btn-warning' id='" . $r['id'] . "' onclick='EditThis(this)'><i class='icon-pencil icon-large'></i> แก้ไข</button>";
            $output .= "<button type='button' class='col-md-6 btn btn-danger' id='" . $r['id'] . "' onclick='DeleteThis(this)'><i class='icon-trash icon-large'></i> ลบ</button>";
            $output .= "</div>";
//            $output .= "<i class='icon-eye-open icon-large'></i> รายละเอียด";
            $output .= "</td>";
            $output .= "</tr>";
            $i++;
        }

        $data['Tbody'] = $output;
        $this->load->view("layout/header");
        $this->load->view("excellence/excellence_base", $data);
        $this->load->view("layout/footer");
    }

    public function excellence_insert() {

        $id = $this->input->post('id');
        $arr = array(
            "id" => $id,
            "tb_school_id" => $this->session->userdata('sch_id'),
            "tb_school_excellence_name" => $this->input->post('inExcellenceName'),
            "tb_school_excellence_detail" => $this->input->post('inExcellenceDetail'),
            "tb_school_excellence_type" => $this->input->post('inExcellenceType'),
            "tb_school_excellence_level" => $this->input->post('inExcellenceLevel'),
            "tb_school_excellence_startdate" => $this->input->post('inExcellenceStartDate'),
            "tb_school_excellence_enddate" => $this->input->post('inExcellenceEndDate'),
//            "tb_school_excellence_file" => $file,
            "tb_school_excellence_recorder" => $this->session->userdata('name'),
            "tb_school_excellence_department" => $this->session->userdata('department'),
            "tb_school_excellence_createdate" => date('Y-m-d')
        );

        if ($id != "") {
            $this->My_model->update_data('tb_school_excellence', array('id' => $id), $arr);
        } else {
            $id = $this->My_model->insert_data('tb_school_excellence', $arr);
        }

        if ($_FILES['inExcellenceFile']['name'][0] != "") {
            $total = count($_FILES['inExcellenceFile']['name']);
            $file = "";
            for ($i = 0; $i < $total; $i++) {

                $_FILES['file']['name'] = $_FILES['inExcellenceFile']['name'][$i];
                $_FILES['file']['type'] = $_FILES['inExcellenceFile']['type'][$i];
                $_FILES['file']['tmp_name'] = $_FILES['inExcellenceFile']['tmp_name'][$i];
                $_FILES['file']['error'] = $_FILES['inExcellenceFile']['error'][$i];
                $_FILES['file']['size'] = $_FILES['inExcellenceFile']['size'][$i];

                $uploadPath = other_unique_path($this->session->userdata('sch_id'), 'tb_school_excellence', $id);

                $config = array(
                    "upload_path" => $uploadPath,
                    "allowed_types" => "*",
                    "max_size" => 0,
                    "file_name" => md5(date("YmdHis"))
                );

                $this->upload->initialize($config);
                $this->upload->do_upload('file');
                $data = $this->upload->data();
                if ($i > 0) {
                    $file .= "," . $data['file_name'];
                } else {
                    $file .= $data['file_name'];
                }
            }

            $arr = array("tb_school_excellence_file" => $file);
            if ($id != "") {
                $this->My_model->update_data('tb_school_excellence', array('id' => $id), $arr);
            }
        }
    }

    public function excellence_edit() {
        $id = $_POST['id'];
        $row = $this->My_model->get_where_row("tb_school_excellence", array("id" => $id));
        echo json_encode($row);
    }

    public function excellence_delete() {
        if ($_POST['id'] != "") {
            rmdir(base_url() . other_unique_path($this->session->userdata('sch_id'), 'tb_school_excellence', $_POST['id']));
            $this->My_model->delete_data("tb_school_excellence", array("id" => $_POST['id']));
        }
    }

    public function excellence_detail() {
        $id = $_POST['id'];
        $row = $this->My_model->get_where_row("tb_school_excellence", array("id" => $id));
        $output = "";
        $MyFile = $row['tb_school_excellence_file'];
        if ($MyFile != "") {
            $FileArray = explode(",", $MyFile);
            $output .= "<div class='col-md-5'>";
            foreach ($FileArray as $FA) {
                $uploadPath = other_unique_path($row['tb_school_id'], 'tb_school_excellence', $row['id']);
                $link = base_url() . $uploadPath . "/" . $FA;
                $output .= "<a target='_blank' href='" . $link . "'>";
                $output .= "<img class='img-thumbnail' src='" . $link . "'  style='width: 100%;'/>";
                $output .= "</a>";
            }
            $output .= "</div>";
            $output .= "<div class='col-md-7'>";
        } else {
            $output .= "<div class='col-md-12'>";
        }



        $output .= "<legend>เรื่อง " . $row['tb_school_excellence_name'] . "</legend>";
        $output .= "<table style='width:95%;float:right;'>";
        $output .= "<tr><td class='data-title' style='width:20%;' >ประเภท</td><td class='data-show' colspan='3'>" . $row['tb_school_excellence_type'] . "</td></tr>";
        $output .= "<tr><td class='data-title' style='width:20%;'>ระดับ</td><td class='data-show' colspan='3'>" . $row['tb_school_excellence_level'] . "</td></tr>";
        $output .= "<tr>"
                . "<td class='data-title' style='width:20%;'>เริ่มตั้งแต่</td><td class='data-show'>" . datethaifull($row['tb_school_excellence_startdate']) . "</td>"
                . "<td class='data-title' style='width:20%;'>จนถึงตั้งแต่</td><td class='data-show'>" . datethaifull($row['tb_school_excellence_enddate']) . "</td>"
                . "</tr>";
        $output .= "<tr><td class='data-title' style='width:20%;'>รายละเอียด</td><td class='data-show' colspan='3'>" . $row['tb_school_excellence_detail'] . "</td></tr>";

        $output .= "</table>";
        $output .= "</div>";


        echo $output;
    }

}
