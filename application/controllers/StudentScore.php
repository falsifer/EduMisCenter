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

Class StudentScore extends CI_Controller {

    public function __construct() {
        parent::__construct();
        if ($this->session->userdata('status') == "") {
            redirect("/");
        }

        $this->load->database();
        $this->load->model('import_model', 'import');
        require_once APPPATH . 'third_party/PHPExcel.php';
        $this->excel = new PHPExcel();

        $this->load->model('StdScore_model');
        $this->load->model('Dcc_model');
        $this->load->model('Std_model');
    }

    public function course_score_base() {
        if ($this->input->post('sc_id') != null) {
            $edyear = $_POST['EdYear'];
            $edterm = $_POST['edterm'];
            $scId = $this->input->post('sc_id');
        }
        if ($this->input->get('sc_id') != null) {

            $edyear = $this->input->get('EdYear');
            $edterm = $this->input->get('edterm');
            $scId = $this->input->get('sc_id');
        }
        $this->db->select("a.*,s.*,a.id as cid")->from("tb_course a");
        $this->db->join("tb_course_detail cd", "cd.tb_course_id=a.id"); //AB
        $this->db->join("tb_ed_schedule sc", "sc.tb_course_detail_id = cd.id"); //AB
        $this->db->join("tb_ed_room d", "sc.tb_ed_room_id=d.id");
        $this->db->join("tb_ed_school_register_class e", "e.id = d.tb_ed_school_register_class_id");
        $this->db->join("tb_subject s", "a.tb_subject_id=s.id");
        $this->db->where('sc.id', $scId); //AB
        $this->db->where('e.tb_ed_school_register_class_edyear', $edyear);

        $data['course'] = $this->db->get()->row_array();
        $data['sc_id'] = $scId;
        $data['edyear'] = $edyear;
        $data['edterm'] = $edterm;

        load_view($this, "student_score/course_score_base", $data);
    }

    public function submit_all_import() {
        $id = $this->input->post('id');
        $edyear = $this->input->post('edyear');
        $scId = $this->input->post('sc_id');
        $edterm = $this->input->post('edterm');

        $MyStdQ = $this->StdScore_model->get_std_by_sec($scId, $id, $edyear);

        foreach ($MyStdQ as $rStd) {
            $arr = array(
                'tb_course_id' => $id,
                'tb_student_base_id' => $rStd->StdId,
                'tb_std_course_score_term' => $edterm
            );
            $tempScore = $this->My_model->get_where_row('tb_std_course_score', $arr);

            //submit score to tb_std_course_midterm_score
            $arr1 = array(
                'tb_student_base_id' => $rStd->StdId,
                'tb_course_id' => $id,
                'tb_std_course_midterm_score_term' => $edterm,
                'tb_std_course_midterm_score_score' => $tempScore['tb_std_course_score_midterm_score'],
                'tb_std_course_midterm_score_recorder' => $this->session->userdata('name'),
                'tb_std_course_midterm_score_department' => $this->session->userdata('department'),
                'tb_std_course_midterm_score_createdate' => date('Y-m-d')
            );

            $mid = $this->My_model->insert_data('tb_std_course_midterm_score', $arr1);

            if (isset($mid)) {
                //submit score to tb_std_course_final_score
                $arr2 = array(
                    'tb_student_base_id' => $rStd->StdId,
                    'tb_course_id' => $id,
                    'tb_std_course_final_score_term' => $edterm,
                    'tb_std_course_final_score_seq' => '1',
                    'tb_std_course_final_score_score' => $tempScore['tb_std_course_score_final_score'],
                    'tb_std_course_final_score_recorder' => $this->session->userdata('name'),
                    'tb_std_course_final_score_department' => $this->session->userdata('department'),
                    'tb_std_course_final_score_createdate' => date('Y-m-d')
                );
                $this->My_model->insert_data('tb_std_course_final_score', $arr2);
            }
        }
    }

    public function submit_all() {
        $id = $this->input->post('id');
        $edyear = $this->input->post('edyear');
        $scId = $this->input->post('sc_id');
        $edterm = $this->input->post('edterm');

        $MyStdQ = $this->StdScore_model->get_std_by_sec($scId, $id, $edyear);

        foreach ($MyStdQ as $rStd) {
            $arr = array(
                'tb_course_id' => $id,
                'tb_student_base_id' => $rStd->StdId,
                'tb_std_course_score_term' => $edterm
            );
            $tempScore = $this->My_model->get_where_row('tb_std_course_score', $arr);
            //Get score from import
            if (isset($tempScore['tb_std_course_score_midterm_score'])) {
                //submit score to tb_std_course_midterm_score
                $arr1 = array(
                    'tb_student_base_id' => $rStd->StdId,
                    'tb_course_id' => $id,
                    'tb_std_course_midterm_score_term' => $edterm,
                    'tb_std_course_midterm_score_score' => $tempScore['tb_std_course_score_midterm_score'],
                    'tb_std_course_midterm_score_recorder' => $this->session->userdata('name'),
                    'tb_std_course_midterm_score_department' => $this->session->userdata('department'),
                    'tb_std_course_midterm_score_createdate' => date('Y-m-d')
                );
                $chk = $this->My_model->get_where_row('tb_std_course_midterm_score', array('tb_student_base_id' => $rStd->StdId,
                            'tb_course_id' => $id,
                            'tb_std_course_midterm_score_term' => $edterm,
                            'tb_std_course_midterm_score_score' => $tempScore['tb_std_course_score_midterm_score']));
                if (!isset($chk['id'])) {
                    $mid = $this->My_model->insert_data('tb_std_course_midterm_score', $arr1);

                    if (isset($mid)) {
                        //submit score to tb_std_course_final_score
                        $arr2 = array(
                            'tb_student_base_id' => $rStd->StdId,
                            'tb_course_id' => $id,
                            'tb_std_course_final_score_term' => $edterm,
                            'tb_std_course_final_score_seq' => '1',
                            'tb_std_course_final_score_score' => $tempScore['tb_std_course_score_final_score'],
                            'tb_std_course_final_score_recorder' => $this->session->userdata('name'),
                            'tb_std_course_final_score_department' => $this->session->userdata('department'),
                            'tb_std_course_final_score_createdate' => date('Y-m-d')
                        );
                        $this->My_model->insert_data('tb_std_course_final_score', $arr2);
                    }
                }
            } else {
                //get score from input
                $midS = $this->input->post('midscore' . $rStd->StdId);
                $finalS = $this->input->post('finalscore' . $rStd->StdId);
                if ($midS != 0 && $finalS != 0 ) {
                    $arr1 = array(
                        'tb_student_base_id' => $rStd->StdId,
                        'tb_course_id' => $id,
                        'tb_std_course_midterm_score_term' => $edterm,
                        'tb_std_course_midterm_score_score' => $midS,
                        'tb_std_course_midterm_score_recorder' => $this->session->userdata('name'),
                        'tb_std_course_midterm_score_department' => $this->session->userdata('department'),
                        'tb_std_course_midterm_score_createdate' => date('Y-m-d')
                    );

                    $mid = $this->My_model->insert_data('tb_std_course_midterm_score', $arr1);

                    if (isset($mid)) {
                        //submit score to tb_std_course_final_score
                        $arr2 = array(
                            'tb_student_base_id' => $stdId,
                            'tb_course_id' => $id,
                            'tb_std_course_final_score_term' => $edterm,
                            'tb_std_course_final_score_seq' => '1',
                            'tb_std_course_final_score_score' => $finalS,
                            'tb_std_course_final_score_recorder' => $this->session->userdata('name'),
                            'tb_std_course_final_score_department' => $this->session->userdata('department'),
                            'tb_std_course_final_score_createdate' => date('Y-m-d')
                        );
                        $this->My_model->insert_data('tb_std_course_final_score', $arr2);
                    }
                }
            }
        }
    }

    public function submit_import() {
        $id = $this->input->post('id');
        $edyear = $this->input->post('edyear');
        $stdId = $this->input->post('stdid');
        $edterm = $this->input->post('edterm');


        $arr = array(
            'tb_course_id' => $id,
            'tb_student_base_id' => $stdId,
            'tb_std_course_score_term' => $edterm
        );
        $tempScore = $this->My_model->get_where_row('tb_std_course_score', $arr);

        //submit score to tb_std_course_midterm_score
        $arr1 = array(
            'tb_student_base_id' => $stdId,
            'tb_course_id' => $id,
            'tb_std_course_midterm_score_term' => $edterm,
            'tb_std_course_midterm_score_score' => $tempScore['tb_std_course_score_midterm_score'],
            'tb_std_course_midterm_score_recorder' => $this->session->userdata('name'),
            'tb_std_course_midterm_score_department' => $this->session->userdata('department'),
            'tb_std_course_midterm_score_createdate' => date('Y-m-d')
        );

        $mid = $this->My_model->insert_data('tb_std_course_midterm_score', $arr1);

        if (isset($mid)) {
            //submit score to tb_std_course_final_score
            $arr2 = array(
                'tb_student_base_id' => $stdId,
                'tb_course_id' => $id,
                'tb_std_course_final_score_term' => $edterm,
                'tb_std_course_final_score_seq' => '1',
                'tb_std_course_final_score_score' => $tempScore['tb_std_course_score_final_score'],
                'tb_std_course_final_score_recorder' => $this->session->userdata('name'),
                'tb_std_course_final_score_department' => $this->session->userdata('department'),
                'tb_std_course_final_score_createdate' => date('Y-m-d')
            );
            $this->My_model->insert_data('tb_std_course_final_score', $arr2);
        }
    }

    public function submit() {
        $id = $this->input->post('id');
        $edyear = $this->input->post('edyear');
        $stdId = $this->input->post('stdid');
        $edterm = $this->input->post('edterm');
        $midS = $this->input->post('midscore');
        $finalS = $this->input->post('finalscore');

//        $arr = array(
//            'tb_course_id' => $id,
//            'tb_student_base_id' => $stdId,
//            'tb_std_course_score_term' => $edterm
//        );
//        $tempScore = $this->My_model->get_where_row('tb_std_course_score', $arr);
        //submit score to tb_std_course_midterm_score
        $arr1 = array(
            'tb_student_base_id' => $stdId,
            'tb_course_id' => $id,
            'tb_std_course_midterm_score_term' => $edterm,
            'tb_std_course_midterm_score_score' => $midS,
            'tb_std_course_midterm_score_recorder' => $this->session->userdata('name'),
            'tb_std_course_midterm_score_department' => $this->session->userdata('department'),
            'tb_std_course_midterm_score_createdate' => date('Y-m-d')
        );

        $mid = $this->My_model->insert_data('tb_std_course_midterm_score', $arr1);

        if (isset($mid)) {
            //submit score to tb_std_course_final_score
            $arr2 = array(
                'tb_student_base_id' => $stdId,
                'tb_course_id' => $id,
                'tb_std_course_final_score_term' => $edterm,
                'tb_std_course_final_score_seq' => '1',
                'tb_std_course_final_score_score' => $finalS,
                'tb_std_course_final_score_recorder' => $this->session->userdata('name'),
                'tb_std_course_final_score_department' => $this->session->userdata('department'),
                'tb_std_course_final_score_createdate' => date('Y-m-d')
            );
            $this->My_model->insert_data('tb_std_course_final_score', $arr2);
        }
    }

    public function get_list() {
        $id = $this->input->post('id');

        if ($this->input->post('sc_id') != null) {
            $edyear = $_POST['edyear'];
            $scId = $this->input->post('sc_id');
            $edterm = $this->input->post('edterm');
        }
        if ($this->input->get('sc_id') != null) {

            $edyear = $this->input->get('edyear');
            $scId = $this->input->get('sc_id');
            $edterm = $this->input->get('edterm');
        }

        $chk = false;

        $output = "";
        $MyStdQ = $this->StdScore_model->get_std_by_sec($scId, $id, $edyear);

        $output2 = "";

        foreach ($MyStdQ as $rStd) {
            $MidScore = 0;
            $FinalScore = 0;
            $MaxScore = 0;

            $arr = array(
                'tb_course_id' => $id,
                'tb_student_base_id' => $rStd->StdId,
                'tb_std_course_score_term' => $edterm
            );

            $tmpScore = $this->My_model->get_where_row('tb_std_course_score', $arr);

            if (isset($tmpScore['tb_std_course_score_midterm_score']) && $tmpScore['tb_std_course_score_midterm_score'] > 0) {
                $MidScore = $tmpScore['tb_std_course_score_midterm_score'];
                $FinalScore = $tmpScore['tb_std_course_score_final_score'];
            }

//            $MidScore = $this->StdScore_model->get_std_course_midterm_score($rStd->StdId, $id);
//            $FinalScore = $this->StdScore_model->get_std_course_final_score($rStd->StdId, $id);
//            $MaxScore = $MidScore + $FinalScore;
            //
            $output2 .= "<tr>";
            $output2 .= "<td style=\"text-align:center; \">" . $rStd->tb_ed_classroom_number . "</td>";
            $output2 .= "<td style=\"text-align:center; \">" . $rStd->std_code . "</td>";
            $output2 .= "<td style=\"text-align:left;\">" . $rStd->std_fullname . "</td>";


            if (($FinalScore) == 0 && $MidScore == 0) {
                $MidScore = $this->StdScore_model->get_std_course_midterm_score($rStd->StdId, $id);
                $FinalScore = $this->StdScore_model->get_std_course_final_score($rStd->StdId, $id);
            }


            if ($this->StdScore_model->get_std_course_final_score($rStd->StdId, $id) == 0) {
                $output2 .= "<td style=\"text-align:center;\"><input type='text' name='midscore" . $rStd->StdId . "' id='midscore" . $rStd->StdId . "' class='form-control' value='" . $MidScore . "' /></td>";
                $output2 .= "<td style=\"text-align:center;\"><input type='text' name='finalscore" . $rStd->StdId . "' id='finalscore" . $rStd->StdId . "' class='form-control' value='" . $FinalScore . "' /></td>";
                $output2 .= "<td style=\"text-align:center;\">" . ($MidScore + $FinalScore) . "</td>";

//                $chk = true;
                if (($MidScore + $FinalScore) < 50) {
                    $output2 .= "<td style=\"text-align:center;\">&nbsp;</td>";
                } else {
                    if (!$chk)
                        $chk = true;
                    $output2 .= "<td style=\"text-align:center;\"><button class='btn btn-primary' onclick=\"select('" . $rStd->StdId . "');\"><i class='icon-check'></i> ยืนยันคะแนน</button></td>";
                }
            }else {
                $MaxScore = $MidScore + $FinalScore;
                $output2 .= "<td style=\"text-align:center;\"><input type='text' name='midscore" . $rStd->StdId . "' id='midscore" . $rStd->StdId . "' class='form-control' value='" . $MidScore . "' /></td>";
                $output2 .= "<td style=\"text-align:center;\"><input type='text' name='finalscore" . $rStd->StdId . "' id='finalscore" . $rStd->StdId . "' class='form-control' value='" . $FinalScore . "' /></td>";
                $output2 .= "<td style=\"text-align:center;\">" . ($MidScore + $FinalScore) . "</td>";

                $chk = false;
                switch (StudentGrade(($MaxScore))) {
                    case 0 :
                        $col = 'red';
                        break;
                    case 1 :
                        $col = 'orange';
                        break;
                    case 4:
                        $col = 'green';
                        break;
                    default :
                        $col = 'black';
                        break;
                }
                $output2 .= "<td style=\"text-align:center;color:" . $col . "\">" . StudentGrade(($MaxScore)) . "</td>";
            }
            $output2 .= "</tr>";
        }


        $this->db->select("*")->from("tb_course");
        $this->db->where('id', $id);
        $MyCourseQ = $this->db->get()->result_array();

        $MyMidtermMaxScore = $MyCourseQ[0]['tb_course_mid_score'];
        $MyFinalMaxScore = $MyCourseQ[0]['tb_course_final_score'];
        $output .= "<table class=\"table table-hover table-striped table-bordered display\" style='background:whitesmoke;' id=\"StudentTable\">";
        $output .= "<thead>";
        $output .= "<tr>";
        $output .= "<th style=\"text-align:center; width:20px;\">ที่</th>";
        $output .= "<th style=\"text-align:center; width:10%;\">รหัสนักเรียน</th>";
        $output .= "<th style=\"text-align:center;\">ชื่อ - นามสกุล</th>";
        $output .= "<th style=\"text-align:center; width:20%;\">คะแนนระหว่างภาค/รายตัวชี้วัด(" . $MyMidtermMaxScore . ")</th>";
        $output .= "<th style=\"text-align:center; width:15%;\">คะแนนปลายภาค(" . $MyFinalMaxScore . ")</th>";
        $output .= "<th style=\"text-align:center; width:10%;\">รวม</th>";
//        $output .= "<th style=\"text-align:center; width:60px;\">ผลการเรียนเฉลี่ย</th>";

        if (!$chk) {
            $output .= "<th style=\"text-align:center; width:10%;\">สถานะ</th>";
        } else {
            $output .= "<th style=\"text-align:center; width:10%;\" class=\"no-sort\" ><button class='btn btn-primary btn-submit-all' onclick='selectAll()'><i class='icon-check'></i> ยืนยันคะแนนทั้งหมด</button></th>";
        }

        $output .= "</tr>";
        $output .= "</thead>";




        $output .= "<tbody>";
        $output .= $output2;

        $output .= "</tbody>";
        $output .= "</table>";
        echo $output;
    }

    public function ImportExcel() {
        $dept = $this->input->post('department');
        $uname = $this->input->post('recorder');
        $cid = $this->input->post('inCourseId');
        $edterm = $this->input->post('inEdTerm');
        $table = "tb_std_course_score";


        if ($_FILES['inImportExcel']['name'] != "") {
            $config = array(
                "upload_path" => "upload/",
                "allowed_types" => "xlsx|xls|xlsm",
                "max_size" => 0,
                "file_name" => md5(date("YmdHis"))
            );
            $this->upload->initialize($config);
            $this->upload->do_upload("inImportExcel");
            $data = $this->upload->data();
            $filename = $data['file_name'];
            $path = 'upload/';
        }



        $inputFileName = $path . $filename;






        try {
            $inputFileType = PHPExcel_IOFactory::identify($inputFileName);
            $objReader = PHPExcel_IOFactory::createReader($inputFileType);
            $objPHPExcel = $objReader->load($inputFileName);
            $objPHPExcel->getSheetByName('ประเมินผลสัมฤทธิ์');
//            $objPHPExcel->setActiveSheet(7);
            $allDataInSheet = $objPHPExcel->getActiveSheet()->toArray(null, true, true, true);
            $flag = true;
            $i = 0;
            $this->db->trans_begin();

            foreach ($allDataInSheet as $arr) {

                if ($i == 0) {
                    $colName = $arr;
                }
                if ($i != 0) {
                    $scoreArr = array();
                    $stdArr = array();


                    foreach (array_keys($arr) as $key => $value) {
//                        if ($colName[$value] == "ที่") {
//                            $col_name = "tb_ed_classroom_number";
//                            $ar = array($col_name => trim($arr[$value]));
//                            $stdArr = array_merge($stdArr, $ar);
//                        }

                        if ($colName[$value] == "รหัส") {
                            $col_name = "std_code";
                            $ar = array($col_name => trim($arr[$value]));
                            $stdArr = array_merge($stdArr, $ar);
                        } elseif (trim($colName[$value]) == "คำนำหน้า") {
                            $col_name = "std_titlename";
                            $ar = array($col_name => trim($arr[$value]));
                            $stdArr = array_merge($stdArr, $ar);
                        } elseif (trim($colName[$value]) == "ชื่อ") {
                            $col_name = "std_firstname";
                            $ar = array($col_name => trim($arr[$value]));
                            $stdArr = array_merge($stdArr, $ar);
                        } elseif (trim($colName[$value]) == "นามสกุล") {
                            $col_name = "std_lastname";
                            $ar = array($col_name => trim($arr[$value]));
                            $stdArr = array_merge($stdArr, $ar);
                        } elseif ($colName[$value] == "คะแนนระหว่างภาค") {
                            $col_name = "tb_std_course_score_midterm_score";
                            $ar = array($col_name => trim($arr[$value]));
                            $scoreArr = array_merge($scoreArr, $ar);
                        } elseif ($colName[$value] == "คะแนนปลายภาค") {
                            $col_name = "tb_std_course_score_final_score";
                            $ar = array($col_name => trim($arr[$value]));
                            $scoreArr = array_merge($scoreArr, $ar);
                        }
                    }

                    $std = $this->My_model->get_where_row('tb_student_base', array('std_code' => $stdArr['std_code']));
                    if (isset($std['id'])) {
                        $col_name = "tb_student_base_id";
                        $ar = array($col_name => $std['id']);
                        $scoreArr = array_merge($scoreArr, $ar);

                        $col_name = "tb_course_id";
                        $ar = array($col_name => $cid);
                        $scoreArr = array_merge($scoreArr, $ar);

                        $col_name = "tb_std_course_score_recorder";
                        $ar = array($col_name => $this->session->userdata('name'));
                        $scoreArr = array_merge($scoreArr, $ar);

                        $col_name = "tb_std_course_score_department";
                        $ar = array($col_name => $this->session->userdata('department'));
                        $scoreArr = array_merge($scoreArr, $ar);

                        $col_name = "tb_std_course_score_createdate";
                        $ar = array($col_name => date('Y-m-d'));
                        $scoreArr = array_merge($scoreArr, $ar);

                        $col_name = "tb_std_course_score_term";
                        $ar = array($col_name => $edterm);
                        $scoreArr = array_merge($scoreArr, $ar);

                        $rr = $this->My_model->get_where_row($table, array('tb_course_id' => $cid, 'tb_student_base_id' => $std['id']));
                        if (isset($rr['id'])) {
                            $sid = $rr['id'];
                        } else {
                            $sid = null;
                        }

                        if (!isset($sid)) {

                            $this->db->insert($table, $scoreArr);
                            $id = $this->db->insert_id();
                        } else {

                            $this->My_model->update_data($table, array('id' => $sid), $scoreArr);
                        }
                    }
                }




                $i++;
            }
        } catch (Exception $e) {
            echo $e->getMessage();
        } finally {
            if ($this->db->trans_status() === FALSE) {
                $this->db->trans_rollback();
            } else {
                $this->db->trans_commit();
            }
            @unlink($inputFileName);
        }
    }

    function get_std_id_by_std_code($std_code) {
        $rs = $this->My_model->get_where_row('tb_student_base', array('std_code' => $std_code));
        return $rs['id'];
    }

    function get_column_name_by_comment($comment, $table) {
//        $this->load->database();
        $dbname = $this->db->database;
        $query = $this->db->query("SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE table_schema='" . $dbname . "' AND table_name='" . $table . "' AND TRIM(COLUMN_COMMENT)= '" . trim($comment) . "' ");
        $row = $query->row();
        if (isset($row)) {
            return $row->COLUMN_NAME;
        } else {
            return "";
        }
    }

    function get_comment_by_column_name($col_name, $table) {
//        $this->load->database();
        $dbname = $this->db->database;
        $query = $this->db->query("SELECT COLUMN_COMMENT FROM INFORMATION_SCHEMA.COLUMNS WHERE table_schema='" . $dbname . "' AND table_name='" . $table . "' AND TRIM(COLUMN_NAME)= '" . trim($col_name) . "' ");
        $row = $query->row();
        if (isset($row)) {
            return $row->COLUMN_COMMENT;
        } else {
            return "";
        }
    }

    function chk_column_in_table($col_name, $table) {
        $fields = $this->db->list_fields($table);

        foreach ($fields as $field) {
            if ($field == $col_name) {
                return true;
            }
        }
        return false;
    }

    function ExportTemplateFull() {

        $column = 0;
        $object = new PHPExcel();
        $object->setActiveSheetIndex(0);



//        $object->getActiveSheet()->setCellValueByColumnAndRow($column, 1, "ที่");
//        $column++;

        $object->getActiveSheet()->setCellValueByColumnAndRow($column, 1, "รหัส");
        $column++;

        $object->getActiveSheet()->setCellValueByColumnAndRow($column, 1, "คำนำหน้า");
        $column++;

        $object->getActiveSheet()->setCellValueByColumnAndRow($column, 1, "ชื่อ");
        $column++;

        $object->getActiveSheet()->setCellValueByColumnAndRow($column, 1, "นามสกุล");
        $column++;

        $object->getActiveSheet()->setCellValueByColumnAndRow($column, 1, "คะแนนระหว่างภาค");
        $column++;

        $object->getActiveSheet()->setCellValueByColumnAndRow($column, 1, "คะแนนปลายภาค");
        $column++;


        $object_writer = PHPExcel_IOFactory::createWriter($object, 'Excel2007');

        header("Pragma: public");
        header("Expires: 0");
        header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
        header('Content-Type: application/vnd.ms-excel');
        header("Content-Type: application/force-download");
        header("Content-Type: application/octet-stream");
        header("Content-Type: application/download");
        header("Content-Disposition: attachment;filename=\"ScoreBaseTempData    .xlsx\"");
        // Write file to the browser
        $object_writer->save('php://output');
        set_time_limit(30);
        exit;
    }

    function getColumnEng($col) {
        $def = 'A';
        $fstr = '';
        $lstr = '';

        if ($col < 26) {
            if ($col == 0) {
                $fstr = $def;
            } else {
                $fstr = chr(ord($def) + $col);
            }
        } elseif ($col > 25) {
            $fstr = chr(ord($def) + (intdiv($col, 26)) - 1);
            $lstr = chr(ord($def) + ($col % 26));
        }

        return $fstr . $lstr;
    }

}
