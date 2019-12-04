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
  | Create Date 6/3/2562
  | Last edit	10/3/2562
  | Comment	-
  | ----------------------------------------------------------------------------
 */

Class Teacher extends CI_Controller {

    public function __construct() {
        parent::__construct();
        if ($this->session->userdata('status') == "") {
            redirect("/");
        }
        $this->load->model("My_model");
        $this->load->model("Teacher_model");
        $this->load->model("Dcc_model");
    }

//----------------งานสอน-------------------------------//
    public function course_by_filter() {
        $classid = $_POST['id'];
        $term = $_POST['term'];
        $edyear = $_POST['edyear'];



        $course = $this->Dcc_model->course_by_class_term_edyear_hr_id($classid, $term, $edyear);
        if ($course) {
            $output = "";
            $i = 1;
            foreach ($course as $r) {
                $output .= "<tr>";
                $output .= "<td style='text-align: center;'>" . $i . "</td>";
                $output .= "<td style='text-align: center;'>" . $r['tb_group_learningcol_name'] . "</td>";
                $output .= "<td style='text-align: center;'>" . $r['tb_subject_name'] . " - " . $r['tb_course_code'] . "</td>";
                $output .= "<td style='text-align: center;'>" . $r['tb_ed_school_class_name'] . "ปีที่ " . $r['tb_ed_school_class_level'] . "</td>";
                $output .= "<td style='text-align: center;'>" . $r['tb_course_credit'] . "</td>";
                $output .= "<td style='text-align: center;'>" . $r['tb_subject_type'] . "</td>";

                $output .= "<td style='text-align: center;'>";

                $output .= "<button type=\"button\" class=\"btn btn-info btn-result\" id=\"" . $r['course_id'] . "\" onclick=\"resultclick(this)\"><i class=\"icon-search icon-large\"></i> สรุป</button>";
                $output .= "&nbsp;";
                $output .= "<button type=\"button\" class=\"btn btn-danger\" id=\"" . $r['course_id'] . "\" onclick=\"SelectThisCourse(this)\"><i class=\"glyphicon glyphicon-log-in\" ></i> จัดการวิชา</button>";

                $output .= "</td>";
                $output .= "</tr>";
                $i++;
            }
            echo $output;
        }
    }

    public function course_management() {
        $id = $this->input->get('course_id');
        $output = "";
        //----Course detail
        $data['course_detail'] = $this->My_model->get_where_row("tb_course_detail", array("tb_course_id" => $id, "tb_human_resources_01_id" => $this->session->userdata("hr_id")));
        $course = $this->Dcc_model->get_course_by_id($id);
        $data['course'] = $course;

        //----gen panel header  
        if ($course['tb_course_term'] > 0) {
            
        } else {
            
        }
        $term = $course['tb_course_term'];
        $output .= "<h3 style='text-align:center;'>การตั้งค่ารายวิชา</h3>";


        if ($term != 0) {
            $output .= "<div style='width:100%;'>";
            $output .= "<input type='radio' id='inRadioTerm{$term}' name='inRadioTerm{$term}' value='{$term}' checked/>ภาคเรียนที่ {$term}";
            $output .= "</div>";
        } else {
            $output .= "<div style='width:100%;'>";
            $output .= "<input type='radio' id='inRadioTerm1' name='inRadioTerm' value='1' checked/>ภาคเรียนที่ 1";
            $output .= "</div>";
            $output .= "<div style='width:100%;'>";
            $output .= "<input type='radio' id='inRadioTerm2' name='inRadioTerm' value='2' />ภาคเรียนที่ 2";
            $output .= "</div>";
        }



        $data['panel_header'] = $output;
        $this->load->view("layout/header");
        $this->load->view("teacher/setting/teaching_task_course_management", $data);
        $this->load->view("layout/footer");
    }

    public function manage_course_unit() {
        $unit_id = $this->input->post('id');

        $MyGlQ = $this->Dcc_model->get_unit_learning_by_id($unit_id);

        if ($MyGlQ) {
            $schoolclass_id = $MyGlQ[0]['tb_ed_school_class_id'];
            $grouplearning_id = $MyGlQ[0]['tb_group_learning_id'];
        }
        // ค้นหากลุ่มสาระ
        $MyQ = $this->Dcc_model->get_kpi_by_class_id_and_grouplearning_id($schoolclass_id, $grouplearning_id);
        $output = "";
        if ($MyQ) {
            $i = 1;
            if (count($MyQ) > 0) {
                foreach ($MyQ as $r) {
                    $output .= "<tr>";
                    $output .= "<td style='text-align: center;'>" . $i . "</td>";
                    $output .= "<td style='text-align: center;'>" . $r['tb_group_learning_item_content'] . "</td>";
                    $output .= "<td style='text-align: center;'>" . $r['tb_standard_learning_id'] . "</td>";
                    $output .= "<td style='text-align: center;'>" . $r['tb_kpi_standard_learning_content'] . "</td>";
                    $output .= "<td style='text-align: center;'><input value='" . $r['tb_kpi_score'] . "' id='' /></td>";

                    if ($r['tb_unit_learning_id'] == $unit_id) {
                        $output .= "<td> <center> <button type=\"button\" class=\"btn btn-success btn-check\" id=\"" . $r['id'] . "\"><i class=\"icon-ok icon-large\"></i> เลือกแล้ว </button> </center> </td>";
                    } else {
                        $output .= "<td> <center> <button type=\"button\" class=\"btn btn-light btn-uncheck\" id=\"" . $r['aid'] . "\"> คลิกเพื่อเลือก </button> </center> </td>";
                    }

                    $output .= "</tr>";
                }
                $i++;
            }
        }


        $MyQ = $this->Dcc_model->get_kpi_by_class_id_and_grouplearning_id($schoolclass_id, $grouplearning_id);

        $output = "";
        $i = 1;
        if (count($MyQ) > 0) {
            foreach ($MyQ as $r) {
                $output .= "<tr>";
                $output .= "<td style='text-align: center;'>" . $i . "</td>";
                $output .= "<td style='text-align: center;'>" . $r['tb_group_learning_item_content'] . "</td>";
                $output .= "<td style='text-align: center;'>" . $r['tb_standard_learning_code'] . " " . $r['tb_kpi_standard_learning_level'] . "/" . thaidigit($r['tb_kpi_standard_learning_seq']) . "</td>";

                $output .= "<td style='text-align: center;'>" . $r['tb_kpi_standard_learning_content'] . "</td>";
//                $output .= "<td style='text-align: center;'><input value='" . $r['tb_kpi_score'] . "' id='' /></td>";
//$row-> . " " . $row-> . "/" . ($row->)
                if ($r['tb_unit_learning_id'] == $unit_id) {
                    $output .= "<td> <center> <button type=\"button\" onclick='UnSelectThisKpi(this)'  class=\"btn btn-success btn-check\" id=\"" . $r['id'] . "\"><i class=\"icon-ok icon-large\"></i> เลือกแล้ว </button> </center> </td>";
                } else {
                    $output .= "<td> <center> <button type=\"button\" onclick='SelectThisKpi(this)' class=\"btn btn-light btn-uncheck\" id=\"" . $r['aid'] . "\"> คลิกเพื่อเลือก </button> </center> </td>";
                }

                $output .= "</tr>";
                $i++;
            }
        }
        echo $output;
    }

    public function manage_course_unit_purpose() {
//        $course_id = $this->input->post('course_id');
        $unit_id = $this->input->post('id');
        $purpose = $this->My_model->get_where_order('tb_course_purpose', array('tb_unit_learning_id' => $unit_id), 'id asc');
        $output = "";
        if ($purpose) {
            $i = 1;

            foreach ($purpose as $p) {
                $output .= "<tr>";
                $output .= "<td style='text-align: center;'>" . $i . "</td>";
                $output .= "<td style='text-align: center;'>" . $p['tb_course_purpose_name'] . "</td>";
                $output .= "<td style='text-align: center;'>" . $p['tb_course_purpose_score'] . "</td>";
                $output .= "<td> <center> "
                        . "<button type=\"button\" onclick='EditThisCoursePurpose(this)'  class=\"btn btn-warning btn-check\" id=\"" . $p['id'] . "\"><i class=\"icon-pencil icon-large\"></i> แก้ไข</button>"
                        . "&nbsp;<button type=\"button\" onclick='DeleteThisCoursePurpose(this)'  class=\"btn btn-danger btn-check\" id=\"" . $p['id'] . "\"><i class=\"icon-trash icon-large\"></i> ลบ</button>"
                        . " </center> </td>";
                $output .= "</tr>";
                $i++;
            }
        }
        echo $output;
    }

//    

    public function insert_course_purpose() {
        $id = $this->input->post('id');



        if ($id != "") {

            $arr = array(
                "tb_course_purpose_name" => $this->input->post('name'),
                "tb_course_purpose_score" => $this->input->post('score'),
            );

            $this->My_model->update_data('tb_course_purpose', array('id' => $id), $arr);
        } else {
            $arr = array(
                "id" => $id,
                "tb_course_id" => $this->input->post('course_id'),
                "tb_unit_learning_id" => $this->input->post('unit_id'),
                "tb_course_purpose_name" => $this->input->post('name'),
                "tb_course_purpose_score" => $this->input->post('score'),
            );
            $this->My_model->insert_data('tb_course_purpose', $arr);
        }
    }

    public function insert_course_unit() {
        $id = $this->input->post('unit_id');

        $arr = array(
            "id" => $id,
            "tb_course_id" => $this->input->post('course_id'),
            "tb_unit_learning_sequence" => $this->input->post('sequence'),
            "tb_unit_learning_name" => $this->input->post('name'),
            "tb_unit_learning_hour" => $this->input->post('hour'),
            "tb_unit_learning_score" => $this->input->post('score'),
            "tb_unit_learning_content" => $this->input->post('content'),
            "tb_unit_learning_term" => $this->input->post('term'),
        );

        if ($id != "") {
            $this->My_model->update_data('tb_unit_learning', array('id' => $id), $arr);
        } else {
            $this->My_model->insert_data('tb_unit_learning', $arr);
        }
    }

    public function edit_course_unit() {
        echo json_encode($this->My_model->get_where_row('tb_unit_learning', array('id' => $this->input->post('id'))));
    }

    public function delete_course_unit() {
        $this->My_model->delete_data('tb_unit_learning', array('id' => $this->input->post('id')));
    }

    public function delete_course_kpi() {
        $this->My_model->delete_data('tb_kpi_score', array('id' => $this->input->post('id')));
    }

    public function delete_course_purpose() {
        $this->My_model->delete_data('tb_course_purpose', array('id' => $this->input->post('id')));
    }

    public function delete_midterm_purpose_topic() {
        $id = $this->input->post('id');
        $this->My_model->delete_data('tb_std_midterm_score', array('tb_midterm_topic_score_id' => $id));

        $this->My_model->delete_data('tb_midterm_topic_score', array('id' => $id));
    }

    public function edit_course_purpose() {
        echo json_encode($this->My_model->get_where_row('tb_course_purpose', array('id' => $this->input->post('id'))));
    }

    public function update_course_detail() {
        $id = $this->input->post("course_id");
        $arr = array("tb_course_detail" => $this->input->post('course_detail'));
        $this->My_model->update_data('tb_course_detail', array('id' => $id), $arr);
    }

    //-- *
}
