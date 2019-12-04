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

Class Ep extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('My_model');
        $this->load->model('Ep_model');
    }

    public function ep_base() {
        $data['rsunit'] = $this->Ep_model->ep_unit(1);
        $data['rsj'] = $this->Ep_model->ep_modal("ประถมศึกษา", "1");
        $data['row'] = $this->My_model->get_all_order("tb_human_resources_01", "hr_thai_name asc");
        $data['rscourse'] = $this->Ep_model->ep_base();
        $this->load->view("layout/header");
        $this->load->view("ep/ep_base", $data);
        $this->load->view("layout/footer");
    }

    public function subject_member() {
        $clss = $this->input->post('inclss');
        $lev = $this->input->post('inlev');
        echo $this->Ep_model->subject_member($clss, $lev);
//        if ($this->input->post('inclss')) {
//            echo $this->Ep_model->subject_member($this->input->post('inclss'));
//        }
    }

    public function ep_edit() {
        $clss = $_POST['clss'];
        $lev = $_POST['lev'];
        //$data['rsx'] = $this->My_model->get_all('tb_standard_learning');
        $data['rsx'] = $this->Ep_model->ep_modal($clss, $lev);
        echo json_encode($data);
    }

    public function ep_modal_save() {

        $inid = $this->input->post('inId');
        $instandid = $this->input->post('inStandId');
        $ii = 1;
        foreach ($inid as $i) {
            foreach ($instandid as $sid) {
                if ($i != "" || $i != 0) {
                    $inscore = $this->input->post('inScore' . $ii);
                    $inunit = $this->input->post('inUnit' . $ii);
                    $arr = array(
                        'id' => $i,
                        'tb_kpi_score' => $inscore,
                        'tb_kpi_standard_learning_id' => $sid,
                        'tb_unit_learning_id' => $inunit
                    );
                    $this->My_model->update_data("tb_kpi_score", array('id' => $i), $arr);
                } else {
                    $inscore = $this->input->post('inScore' . $ii);
                    $inunit = $this->input->post('inUnit' . $ii);
                    $arr = array(
                        'tb_kpi_score' => $inscore,
                        'tb_kpi_standard_learning_id' => $sid,
                        'tb_unit_learning_id' => $inunit
                    );
                    $this->My_model->insert_data("tb_kpi_score", $arr);
                }
            }
            $ii++;
        }
    }

    public function ep_insert() {
        $arr = array(
            "tb_course_id" => $this->input->post('inSubject'),
            "tb_human_resources_01_id" => $this->input->post('inHrthainame'),
            "tb_course_detail_mid_score " => $this->input->post('inCourseMidScore '),
            "tb_course_detail_final_score " => $this->input->post('inCourseFinalScore ')
        );
        $this->My_model->insert_data('tb_course_detail', $arr);
    }

}
