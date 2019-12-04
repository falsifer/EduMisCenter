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

class Develop_courses extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model("Dc_model");
        $this->load->model("Edutech_model");
    }

    public function index() {
        $data['rs'] = $this->Dc_model->get_dc_data();
        $data['rsGl'] = $this->My_model->get_all_order('tb_group_learning', 'tb_group_learning_seq ASC');
        $data['rClass'] = $this->My_model->get_all_order('tb_ed_school_class', 'id ASC');

        $this->load->view("layout/header");
        $this->load->view("develop_courses/curriculum", $data);
        $this->load->view("layout/footer");
    }

    public function filter_dc_base() {
        $eyear = $this->input->post('edYear');
        $data['rs'] = $this->Dc_model->get_dc_data_yearly($eyear);
        $this->load->view("layout/header");
        $this->load->view("develop_courses/curriculum", $data);
        $this->load->view("layout/footer");
    }

// ระบบ
    public function dc_base() {

        $data['rs'] = $this->Dc_model->get_dc_data();
        $this->load->view("layout/header");
        $this->load->view("develop_courses/dc_base", $data);
        $this->load->view("layout/footer");
    }

    public function dc_insert_gl() {
        $data['rs'] = $this->My_model->get_all_order('tb_group_learning', 'tb_group_learning_seq ASC');
        $this->load->view("layout/header");
        $this->load->view("develop_courses/dc_insert_gl", $data);
        $this->load->view("layout/footer");
    }

    // edit
    public function dc_gl_edit() {
        $id = $_POST['id'];
        $rs = $this->My_model->get_where_row('tb_group_learning_item', array('id' => $id));
        echo json_encode($rs);
    }

    // edit
    public function dc_gl_delete() {
        $id = $_POST['id'];
        $this->Dc_model->delete_dc_gl($id);
    }

    // edit
    public function dc_std_edit() {
        $id = $_POST['id'];
//        $rs = $this->My_model->join2table_row('tb_standard_learning a','tb_group_learning_item b', 'a.tb_group_learning_item_id = b.id',array('a.id' => $id));

        $this->db->select("*,a.id as std_id")->from('tb_standard_learning a');
        $this->db->join('tb_group_learning_item b', 'a.tb_group_learning_item_id = b.id');
        $this->db->where(array('a.id' => $id));
        $rs = $this->db->get()->row_array();
        if (count($rs) > 0) {
            echo json_encode($rs);
        }
    }

    // edit
    public function dc_std_delete() {
        $id = $_POST['id'];
        $this->My_model->delete_data('tb_standard_learning', array('id' => $id));
    }

    public function dc_insert_std() {
        $data['rs'] = $this->My_model->get_all_order('tb_group_learning_item', 'tb_group_learning_id ASC');
        $data['rt'] = $this->My_model->get_all_order('tb_group_learning', 'tb_group_learning_seq ASC');
        $this->load->view("layout/header");
        $this->load->view("develop_courses/dc_insert_std", $data);
        $this->load->view("layout/footer");
    }

    public function dc_insert_kpi() {
        $data['rs'] = $this->My_model->get_all_order('tb_group_learning_item', 'tb_group_learning_id ASC');
        $data['rt'] = $this->My_model->get_all_order('tb_group_learning', 'tb_group_learning_seq ASC');
        $data['ru'] = $this->My_model->get_all_order('tb_standard_learning', 'tb_group_learning_item_id ASC');
        $this->load->view("layout/header");
        $this->load->view("develop_courses/dc_insert_kpi", $data);
        $this->load->view("layout/footer");
    }

    public function dc_kpi_edit() {

        $id = $_POST['id'];
        $rs = $this->Dc_model->get_kpi_edit($id);
        echo json_encode($rs);
    }

//--- Code Insert ---//
    public function dc_insert_1() {

        $arr = array(
            "tb_group_learning_id" => $this->input->post('inTbGroupLearningId'),
            "tb_group_learning_item_content" => $this->input->post('inTbGroupLearningItemContent'),
            "tb_group_learning_item_seq" => $this->input->post('inTbGroupLearningItemSeq')
        );
        if ($this->input->post('itm_id')) {
            $this->My_model->update_data('tb_group_learning_item', array('id' => $this->input->post('itm_id')), $arr);
        } else {
            $this->My_model->insert_data('tb_group_learning_item', $arr);
            $id = $this->db->insert_id();
        }
    }

    public function dc_insert_2() {

        $arr = array(
            "tb_group_learning_item_id" => $this->input->post('inTbGroupLearningItemId'),
            "tb_standard_learning_code" => $this->input->post('inTbStandardLearningCode'),
            "tb_standard_learning_content" => $this->input->post('inTbStandardLearningContent')
        );

        if ($this->input->post('std_id')) {
            $this->My_model->update_data('tb_standard_learning', array('id' => $this->input->post('std_id')), $arr);
        } else {
            $this->My_model->insert_data('tb_standard_learning', $arr);
        }
    }

    public function dc_insert_3() {

        $arr = array(
            "tb_ed_school_class_id" => $this->input->post('inSchoolClassId'),
            "tb_standard_learning_id" => $this->input->post('inTbKpiStandardLearningId'),
            "tb_kpi_standard_learning_seq" => $this->input->post('inTbKpiStandardLearningSeq'),
            "tb_kpi_standard_learning_content" => $this->input->post('inTbKpiStandardLearningContent'),
            "tb_kpi_standard_learning_level" => $this->input->post('inTbKpiStandardLearningLevel')
        );

        if ($this->input->post('kpi_id')) {
            $this->My_model->update_data('tb_kpi_standard_learning', array('id' => $this->input->post('kpi_id')), $arr);
        } else {
            $this->My_model->insert_data('tb_kpi_standard_learning', $arr);
        }
    }

    public function dc_kpi_delete() {
        if ($this->input->post('id')) {
            $this->My_model->delete_data('tb_kpi_standard_learning', array('id' => $this->input->post('id')), $arr);
        }
    }

    //--- end Code Insert ---//
    //----- Code Edit ------//
    public function dc_edit() {
        $id = $_POST['id'];
        $rs = $this->Dc_model->get_dc_edit();
        echo json_encode($rs);
    }

    //----- End Code Edit ------//
// delet data;
    public function dc_delete() {
        $id = $_POST['id'];
        $this->My_model->delete_data('tb_group_learning_item', array('id' => $id));
    }

    function group_learning_item_list() {
        if ($this->input->post('gl_id')) {
            $this->Dc_model->get_group_learning_item_list($this->input->post('gl_id'));
        }
    }

    function std_item_list() {
        if ($this->input->post('gli_id')) {
            $this->Dc_model->get_std_item_list($this->input->post('gli_id'));
        }
    }

}
