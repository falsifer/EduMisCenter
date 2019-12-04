<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/*
  | ----------------------------------------------------------------------------
  |  Title
  | ----------------------------------------------------------------------------
  | Copyright	Edutech Co.,Ltd.
  | Purpose     โมเดลนักเรียน
  | Author      chairatto
  | Create Date 22/11/2561
  | Last edit	8/3/2562
  | Comment	-
  | ----------------------------------------------------------------------------
 */

Class CourseImport extends CI_Controller {

    public function __construct() {
        parent::__construct();
        if ($this->session->userdata('status') == "") {
            redirect("/");
        }

        $this->load->database();
        $this->load->model('import_model', 'import');
        require_once APPPATH . 'third_party/PHPExcel.php';
        $this->excel = new PHPExcel();
    }

    public function UploadDataUpdate() {
        $dept = $this->input->post('department');
        $uname = $this->input->post('recorder');
        $myClass = $this->input->post('inStdClass');
        $table = 'tb_course';
        if ($_FILES['inImportExcel']['name'] != "") {
            $config = array(
                "upload_path" => "upload/",
                "allowed_types" => "xlsx", "xls",
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
            $objPHPExcel->setActiveSheetIndex(0);
            $allDataInSheet = $objPHPExcel->getActiveSheet()->toArray(null, true, true, true);
            $flag = true;
            $i = 0;
            $this->db->trans_begin();

            foreach ($allDataInSheet as $arr) {
                if ($i == 0) {
                    $colName = $arr;
                }
                if ($i != 0) {
                    $arry = array();

                    $code = "";
                    $sbj = "";
                    $gl = "";
                    $sbjid = "";
                    $sbjtype = "";
                    $term="";

                    foreach (array_keys($arr) as $key => $value) {
                        if ($colName[$value] != "ชื่อวิชา" && $colName[$value] != "กลุ่มสาระ" && $colName[$value] != "ประเภทวิชา") {
                            $col_name = $this->get_column_name_by_comment($colName[$value], $table);
                            if ($col_name != "" && $col_name != 'id') {
                                if ($col_name == "tb_course_code") {
                                    $code = $arr[$value];
                                }elseif($col_name == "tb_course_term") {
                                    $term = $arr[$value];
                                }
                                $ar = array($col_name => $arr[$value]);
                                $arry = array_merge($arry, $ar);
                            }
                        } else {
                            if ($colName[$value] == "ชื่อวิชา") {
                                $sbj = $arr[$value];
                            }

                            if ($colName[$value] == "กลุ่มสาระ") {
                                $gl = $arr[$value];
                            }

                            if ($colName[$value] == "ประเภทวิชา") {
                                $sbjtype = $arr[$value];
                            }
                        }
                    }

                    $sbjid = $this->get_subject_code_by_name($sbj, $gl, $sbjtype, $code);
                    $ar = array('tb_subject_id' => $sbjid);
                    $arry = array_merge($arry, $ar);

//                    $j++;


                    $rr = $this->My_model->get_where_row('tb_course', array('tb_course_code' => $code,'tb_course_term'=>$term, $dept => $this->session->userdata('department'), "tb_ed_school_register_class_id" => $myClass));
                    if (isset($rr['id'])) {
                        $id = $rr['id'];
                    } else {
                        $id = null;
                    }

                    if (!isset($id)) {
                        $ar = array(
                            "tb_ed_school_register_class_id" => $myClass,
                            "tb_course_createdate" => date('Y-m-d'),
                            $dept => $this->session->userdata('department'),
                            $uname => $this->session->userdata('name')
                        );
                        $arry = array_merge($arry, $ar);
                        $this->db->insert($table, $arry);
                        $id = $this->db->insert_id();
                    } else {
                        $ar = array(
                            "tb_course_createdate" => date('Y-m-d'),
                            $dept => $this->session->userdata('department'),
                            $uname => $this->session->userdata('name')
                        );
                        $arry = array_merge($arry, $ar);
                        $this->My_model->update_data($table, array('id' => $id), $arry);
                    }
                }




                $i++;
            }
        } catch (Exception $e) {
            die('Error loading file "' . pathinfo($inputFileName, PATHINFO_BASENAME)
                    . '": ' . $e->getMessage());
        } finally {
            if ($this->db->trans_status() === FALSE) {
                $this->db->trans_rollback();
            } else {
                $this->db->trans_commit();
            }
            @unlink($inputFileName);
        }
    }

    public function UploadScheduleData() {
        $dept = $this->input->post('department');
        $uname = $this->input->post('recorder');
        $myClass = $this->input->post('inStdClass');
        $table = 'tb_course';
        if ($_FILES['inImportExcel']['name'] != "") {
            $config = array(
                "upload_path" => "upload/",
                "allowed_types" => "xlsx", "xls",
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
            $allDataInSheet = $objPHPExcel->getActiveSheet()->toArray(null, true, true, true);
            $flag = true;
            $i = 1;
            $this->db->trans_begin();


            foreach ($allDataInSheet as $arr) {

                if ($i != 1) {
                    $arry = array();
                    //$colName['วัน']
                    $sec_id = $this->get_section_id($objPHPExcel->getActiveSheet()->getCellByColumnAndRow(5, $i)->getValue());

//                   $course_detail_id = $this->get_course_detail_id($colName['รหัสวิชา'], $colName['ปีการศึกษา'], $colName['เทอม'], $colName['ชื่อครูผู้สอน'], $colName['นามสกุลครูผู้สอน']);
                    $course_detail_id = $this->get_course_detail_id($objPHPExcel->getActiveSheet()->getCellByColumnAndRow(7, $i)->getValue(), $objPHPExcel->getActiveSheet()->getCellByColumnAndRow(0, $i)->getValue(), $objPHPExcel->getActiveSheet()->getCellByColumnAndRow(1, $i)->getValue(), $objPHPExcel->getActiveSheet()->getCellByColumnAndRow(8, $i)->getValue(), $objPHPExcel->getActiveSheet()->getCellByColumnAndRow(9, $i)->getValue());
                    //$class, $level, $room, $edyear
                    $room_id = $this->get_ed_room_id($objPHPExcel->getActiveSheet()->getCellByColumnAndRow(2, $i)->getValue(), $objPHPExcel->getActiveSheet()->getCellByColumnAndRow(3, $i)->getValue(), $objPHPExcel->getActiveSheet()->getCellByColumnAndRow(4, $i)->getValue(), $objPHPExcel->getActiveSheet()->getCellByColumnAndRow(0, $i)->getValue());

//                    foreach (array_keys($arr) as $key => $value) {
//                        if ($colName[$value] != "ชื่อวิชา" && $colName[$value] != "กลุ่มสาระ" && $colName[$value] != "ประเภทวิชา") {
//                            $col_name = $this->get_fix_column_name($colName[$value]);
//                            if ($col_name != "" && $col_name != 'id') {
//                                if ($col_name == "tb_course_code") {
//                                    $code = $arr[$value];
//                                }
//
//                                $ar = array($col_name => $arr[$value]);
//                                $arry = array_merge($arry, $ar);
//                            }
//                        } else {
//                            if ($colName[$value] == "ชื่อวิชา") {
//                                $sbj = $arr[$value];
//                            }
//
//                            if ($colName[$value] == "กลุ่มสาระ") {
//                                $gl = $arr[$value];
//                            }
//
//                            if ($colName[$value] == "ประเภทวิชา") {
//                                $sbjtype = $arr[$value];
//                            }
//                        }
//                    }

                    if($sec_id!="" && $course_detail_id !="" && $room_id !=""){
                    $rr = $this->My_model->get_where_row('tb_ed_schedule', array('tb_ed_section_id' => $sec_id, 'tb_ed_schedule_day' => $objPHPExcel->getActiveSheet()->getCellByColumnAndRow(7, $i)->getValue(), 'tb_ed_schedule_department' => $this->session->userdata('department'), "tb_ed_room_id" => $room_id, 'tb_course_detail_id' => $course_detail_id));
                    if (isset($rr['id'])) {
                        $id = $rr['id'];
                    } else {
                        $id = null;
                    }

                    if (!isset($id)) {
                        $ar = array(
                            "tb_ed_section_id" => $sec_id,
                            'tb_ed_schedule_department' => $this->session->userdata('department'),
                            "tb_ed_room_id" => $room_id,
                            'tb_ed_schedule_day' => $objPHPExcel->getActiveSheet()->getCellByColumnAndRow(7, $i)->getValue(),
                            'tb_course_detail_id' => $course_detail_id
                        );

                        $this->db->insert('tb_ed_schedule', $ar);
                        $id = $this->db->insert_id();
                    } else {
                        $ar = array(
                            "tb_ed_section_id" => $sec_id,
                            'tb_ed_schedule_department' => $this->session->userdata('department'),
                            "tb_ed_room_id" => $room_id,
                            'tb_ed_schedule_day' => $objPHPExcel->getActiveSheet()->getCellByColumnAndRow(7, $i)->getValue(),
                            'tb_course_detail_id' => $course_detail_id
                        );

                        $this->My_model->update_data('tb_ed_schedule', array('id' => $id), $ar);
                    }
                }
                }




                $i++;
            }
        } catch (Exception $e) {
            die('Error loading file "' . pathinfo($inputFileName, PATHINFO_BASENAME)
                    . '": ' . $e->getMessage());
        } finally {
            if ($this->db->trans_status() === FALSE) {
                $this->db->trans_rollback();
            } else {
                $this->db->trans_commit();
            }
            @unlink($inputFileName);
        }
    }

    function ExportTemplateFull() {

        $table = $this->input->get('tableName');
        $table = 'tb_course';
        $table_columns = $this->db->list_fields($table);
        $column = 0;
        $object = new PHPExcel();
        $object->setActiveSheetIndex(0);

        $object->getActiveSheet()->setCellValueByColumnAndRow($column, 1, 'กลุ่มสาระ');

        $grs = $this->My_model->get_where_order('tb_group_learning', array('ed_year' => '2551'), 'tb_group_learning_seq');
        $cnt = 2;
        foreach ($grs as $r) {
            $object->getActiveSheet()->setCellValueByColumnAndRow($column, $cnt, $r['tb_group_learningcol_name']);
            $cnt++;
        }
        $column++;

        $object->getActiveSheet()->setCellValueByColumnAndRow($column, 1, 'ชื่อวิชา');
        $column++;

        $object->getActiveSheet()->setCellValueByColumnAndRow($column, 1, 'ประเภทวิชา');
        $column++;


        //tb_student_base
        foreach ($table_columns as $field) {

            if ($field != 'id' && $field != 'tb_member_id' && stristr($field, 'recorder') === FALSE && stristr($field, 'department') === FALSE && stristr($field, 'createdate') === FALSE && stristr($field, 'status') === FALSE && $this->get_comment_by_column_name($field, $table) != "") {
                $object->getActiveSheet()->setCellValueByColumnAndRow($column, 1, $this->get_comment_by_column_name($field, $table));
                $column++;
            }
        }


        $object_writer = PHPExcel_IOFactory::createWriter($object, 'Excel2007');

        header("Pragma: public");
        header("Expires: 0");
        header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
        header('Content-Type: application/vnd.ms-excel');
        header("Content-Type: application/force-download");
        header("Content-Type: application/octet-stream");
        header("Content-Type: application/download");
        header("Content-Disposition: attachment;filename=\"CourseData.xlsx\"");
        // Write file to the browser
        $object_writer->save('php://output');
        set_time_limit(30);
        exit;
    }

    function ExportScheduleTemplate() {

        $column = 0;
        $object = new PHPExcel();
        $object->setActiveSheetIndex(0);

        $object->getActiveSheet()->setCellValueByColumnAndRow($column, 1, 'ปีการศึกษา');
        $column++;

        $object->getActiveSheet()->setCellValueByColumnAndRow($column, 1, 'เทอม');
        $column++;

        $object->getActiveSheet()->setCellValueByColumnAndRow($column, 1, 'ระดับชั้น');
        $column++;

        $object->getActiveSheet()->setCellValueByColumnAndRow($column, 1, 'ชั้น');
        $column++;

        $object->getActiveSheet()->setCellValueByColumnAndRow($column, 1, 'ห้อง');
        $column++;

        $object->getActiveSheet()->setCellValueByColumnAndRow($column, 1, 'วัน');
        $column++;

        $object->getActiveSheet()->setCellValueByColumnAndRow($column, 1, 'คาบ');
        $column++;

        $object->getActiveSheet()->setCellValueByColumnAndRow($column, 1, 'รหัสวิชา');
        $column++;

        $object->getActiveSheet()->setCellValueByColumnAndRow($column, 1, 'ชื่อครูผู้สอน');
        $column++;

        $object->getActiveSheet()->setCellValueByColumnAndRow($column, 1, 'นามสกุลครูผู้สอน');
        $column++;

        $object_writer = PHPExcel_IOFactory::createWriter($object, 'Excel2007');

        header("Pragma: public");
        header("Expires: 0");
        header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
        header('Content-Type: application/vnd.ms-excel');
        header("Content-Type: application/force-download");
        header("Content-Type: application/octet-stream");
        header("Content-Type: application/download");
        header("Content-Disposition: attachment;filename=\"ScheduleData.xlsx\"");
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

    function get_subject_code_by_name($sbj, $gl, $sbjtype, $code) {
        $rs = $this->My_model->get_where_row('tb_subject', array('tb_subject_name' => $sbj, 'tb_subject_department' => $this->session->userdata('department')));
        if (isset($rs['id'])) {
            return $rs['id'];
        } else {

            $grs = $this->My_model->get_where_row('tb_group_learning', array('tb_group_learningcol_name' => $gl));
            $sbjcode = substr($code, 0, 1);

            $ar = array(
                'tb_group_learning_id' => $grs['id'],
                'tb_subject_name' => $sbj,
                'tb_subject_type' => $sbjtype,
                'tb_subject_abbreviation' => $sbjcode,
                'tb_subject_recorder' => $this->session->userdata('name'),
                'tb_subject_department' => $this->session->userdata('department')
            );

            $id = $this->My_model->insert_data('tb_subject', $ar);

            return $id;
        }
    }

    function insert_std_member($std_id, $std_code, $dateOfBirth) {


        $std_arr = array(
            "department" => $this->session->userdata('department'),
            "status" => 'นักเรียน',
            "activate" => '1',
            "username" => $this->get_sch_code() . $std_code,
            "password" => str_replace("-", "", $dateOfBirth)
        );
        $mid = $this->My_model->insert_data('tb_member', $std_arr);
        if (isset($mid)) {
            $this->My_model->update_data('tb_student_base', array('id' => $std_id), array('tb_member_id' => $mid));
        }
    }

    function insert_fam_member($owner_id, $std_code, $fact) {
        $std_arr = array(
            "department" => $this->session->userdata('department'),
            "status" => 'ผู้ปกครอง',
            "activate" => '1',
            "username" => $this->get_sch_code() . $std_code . "P" . $fact,
            "password" => $this->get_sch_code() . $std_code . "P" . $fact
        );
        $mid = $this->My_model->insert_data('tb_member', $std_arr);
        if (isset($mid)) {

            $this->My_model->update_data('tb_outsider', array('id' => $owner_id), array('tb_member_id' => $mid));
        }
    }

    function get_sch_code() {
        $rs = $this->My_model->get_where_row('tb_school', array("sc_thai_name" => $this->session->userdata('department')));
        return trim(strtoupper($rs['sc_symbol']));
    }

    function get_std_id_by_std_code($std_code) {
        $rs = $this->My_model->get_where_row('tb_student_base', array('std_code' => $std_code));
        return $rs['id'];
    }

    function get_column_name_by_comment($comment, $table) {
//        $this->load->database();
        $dbname = $this->db->database;
        $query = $this->db->query("SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE table_schema='".$dbname."' AND table_name='" . $table . "' AND TRIM(COLUMN_COMMENT)= '" . trim($comment) . "' ");
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
        $query = $this->db->query("SELECT COLUMN_COMMENT FROM INFORMATION_SCHEMA.COLUMNS WHERE table_schema='".$dbname."' AND table_name='" . $table . "' AND TRIM(COLUMN_NAME)= '" . trim($col_name) . "' ");
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

    function get_ed_room_id($class, $level, $room, $edyear) {
        $id = "";
        print("class >> " . $edyear . ' ' . $class . '---' . $level . '/' . $room);
        $this->db->select('*,r.id as rid');
        $this->db->from('tb_ed_room r');
        $this->db->join('tb_ed_school_register_class c', 'c.id = r.tb_ed_school_register_class_id');
        $this->db->join('tb_ed_school_class sc', 'sc.id = c.tb_ed_school_class_id');

        $this->db->where('r.tb_ed_classroom_department', $this->session->userdata("department"));
        $this->db->where(array('sc.tb_ed_school_class_level' => $level));
        $this->db->where(array('c.tb_ed_school_register_class_edyear' => $edyear));
        $this->db->where(array('sc.tb_ed_school_class_name' => $class));
        $this->db->where(array('r.tb_classroom_room' => $room));

        $r = $this->db->get()->row_array();

        if (isset($r['rid'])) {
            $id = $r['rid'];
        }

        return $id;
    }

    function get_section_id($sec) {
        $id = "";
        print("sec >> " . $sec."<br>");
        $r = $this->My_model->get_where_row('tb_ed_section', array('tb_ed_section_class_sub' => $sec, 'tb_ed_section_department' => $this->session->userdata('department')));

        if (isset($r['id'])) {
            $id = $r['id'];
        }

        return $id;
    }

    function get_course_detail_id($code, $edyear, $term, $tname, $tlastname) {
        print("course_detail >> " . $code." ".$edyear." ".$term." ".$tname." ".$tlastname."<br>");
        $id = "";
        try {
            $this->db->select('*,cd.id as cdid');
            $this->db->from('tb_course_detail cd');
            $this->db->join('tb_course c', 'c.id = cd.tb_course_id', 'left outer');
            $this->db->join('tb_ed_school_register_class rc', 'rc.id = c.tb_ed_school_register_class_id', 'left outer');
            $this->db->join('tb_human_resources_01 hr', 'hr.id = cd.tb_human_resources_01_id', 'left outer');


            $this->db->where(array('c.tb_course_department' => $this->session->userdata('department')));
            $this->db->where(array('c.tb_course_code' => $code));
            $this->db->where(array('c.tb_course_term' => $term));
            $this->db->where(array('rc.tb_ed_school_register_class_edyear' => $edyear));
            $this->db->where(array('hr.hr_thai_name' => $tname));
            $this->db->where(array('hr.hr_thai_lastname' => $tlastname));

            $r = $this->db->get()->row_array();

            if (isset($r['id'])) {
                $id = $r['id'];
            } else {

                $this->db->select('*,cd.id as cdid');
                $this->db->from('tb_course_detail cd');
                $this->db->join('tb_course c', 'c.id = cd.tb_course_id', 'left outer');
                $this->db->join('tb_ed_school_register_class rc', 'rc.id = c.tb_ed_school_register_class_id', 'left outer');
                $this->db->where(array('c.tb_course_department' => $this->session->userdata('department')));
                $this->db->where(array('c.tb_course_code' => $code));
                $this->db->where(array('c.tb_course_term' => $term));
                $this->db->where(array('rc.tb_ed_school_register_class_edyear' => $edyear));
                $cr = $this->db->get()->row_array();
                if (isset($cr['id'])) {
                    $cid = $cr['id'];
                }

                $hr = $this->My_model->get_where_row('tb_human_resources_01', array('hr_department' => $this->session->userdata('department'), 'hr_thai_name' => $tname, 'hr_thai_lastname' => $tlastname));

                if (isset($hr['id'])) {
                    $hrid = $hr['id'];
                }

                if (isset($cid) && isset($hrid)) {
                    $ar = array(
                        'tb_course_id' => $cid,
                        'tb_human_resources_01_id' => $hrid
                    );
                    $id = $this->My_model->insert_data('tb_course_Detail', $ar);
                }
            }
        } catch (Exception $e) {
            print("Erro course_detail >> " . $e);
        }

        return $id;
    }

    function get_fix_column_name($name) {
        
        $cname = "";
        switch ($name) {
            case "ปีการศึกษา" : $cname = 'tb_ed_school_register_class_edyear';
                break;
            case "เทอม" : $cname = 'tb_course_term';
                break;
            case "ระดับชั้น" : $cname = 'tb_ed_school_class_nametb_ed_school_class_name';
                break;
            case "ชั้น" : $cname = 'tb_ed_school_class_level';
                break;
            case "ห้อง" : $cname = 'tb_classroom_room';
                break;
            case "วัน" : $cname = 'tb_ed_schedule_day';
                break;
            case "คาบ" : $cname = 'tb_ed_section_class_sub';
                break;
            case "รหัสวิชา" : $cname = 'tb_course_code';
                break;
            case "ชื่อครูผู้สอน" : $cname = 'hr_thai_name';
                break;
            case "นามสกุลครูผู้สอน" : $cname = 'hr_thai_lastname';
                break;
        }

        return $cname;
    }

}
