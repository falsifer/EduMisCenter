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

Class StudentImport extends CI_Controller {

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

// index
    public function index() {

        $this->load->model('Std_model');

        $data['rs'] = $this->Std_model->get_current_std_base();
        $data['rClass'] = $this->Std_model->get_school_class();

        $this->load->view("layout/header");
        $this->load->view("student/std_sis_base", $data);
        $this->load->view("layout/footer");
    }

    public function UploadData() {
        $table = $this->input->post('tableName');
        $dept = $this->input->post('department');
        $uname = $this->input->post('recorder');
        if ($_FILES['inImportExcel']['name'] != "") {
            $config = array(
                "upload_path" => "upload/",
                "allowed_types" => "xlsx",
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
            $i = 0;
            $j = 0;
            foreach ($allDataInSheet as $arr) {
                if ($i == 0) {
                    $colName = $arr;
                }
                if ($i != 0) {



                    if (isset($dept)) {
                        $inserdata[$j][$dept] = $this->session->userdata('department');
                    }
                    if (isset($uname)) {
                        $inserdata[$j][$uname] = $this->session->userdata('name');
                    }
                    foreach (array_keys($arr) as $key => $value) {
                        $inserdata[$j][$colName[$value]] = $arr[$value];
                    }
                    $inserdata[$j]['tb_student_base_status'] = 'W';
                    $j++;
                }




                $i++;
            }

            $result = $this->import->importdata($table, $inserdata);
            if ($result) {
                echo "Imported successfully";
            } else {
                echo "ERROR !";
            }
        } catch (Exception $e) {
            die('Error loading file "' . pathinfo($inputFileName, PATHINFO_BASENAME)
                    . '": ' . $e->getMessage());
        }
    }

    public function UploadDataSeq() {
        $table = $this->input->post('tableName');
        $dept = $this->input->post('department');
        $uname = $this->input->post('recorder');
        if ($_FILES['inImportExcel']['name'] != "") {
            $config = array(
                "upload_path" => "upload/",
                "allowed_types" => "xlsx",
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
            $i = 0;
//            $j = 0;
            foreach ($allDataInSheet as $arr) {
                if ($i == 0) {
                    $colName = $arr;
                }
                if ($i != 0) {

                    $arry = array(
                        "tb_student_base_status" => 'W',
                        $dept => $this->session->userdata('department'),
                        $uname => $this->session->userdata('name')
                    );

                    foreach (array_keys($arr) as $key => $value) {
                        $ar = array($this->get_column_name_by_comment($colName[$value], $table) => $arr[$value]);
                        $arry = array_merge($arry, $ar);
                    }

//                    $j++;

                    $this->db->insert($table, $arry);
                    $id = $this->db->insert_id();
                    if (isset($id)) {
                        //ข้อมูลก่อนเข้ารับการศึกษา
                        $std_arr = array(
                            "tb_ed_school_register_class_id" => $this->input->post('inStdClassM'),
                            "tb_student_base_id" => $id
                        );
                        $this->My_model->insert_data('tb_std_before_register', $std_arr);
                    }
                }




                $i++;
            }
        } catch (Exception $e) {
            die('Error loading file "' . pathinfo($inputFileName, PATHINFO_BASENAME)
                    . '": ' . $e->getMessage());
        }
    }

    public function UploadDataUpdate() {
        $dept = $this->input->post('department');
        $uname = $this->input->post('recorder');
        $table = $this->input->post('tableName');
        if ($_FILES['inImportExcel']['name'] != "") {
            $config = array(
                "upload_path" => "upload/",
                "allowed_types" => "xlsx",
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
            $i = 0;
            $this->db->trans_begin();

            foreach ($allDataInSheet as $arr) {
                if ($i == 0) {
                    $colName = $arr;
                }
                if ($i != 0) {
                    $arry = array();

                    $stdcode = "";

                    foreach (array_keys($arr) as $key => $value) {
                        $col_name = $this->get_column_name_by_comment($colName[$value], $table);
                        if ($col_name != "" && $col_name != 'id') {

                            if ($col_name == "std_code") {
                                $stdcode = $arr[$value];
                            }
                            if ($col_name == "std_titlename") {
                                $tname = $arr[$value];
                            }
                            if ($col_name == "std_firstname") {
                                $fname = $arr[$value];
                            }
                            if ($col_name == "std_lastname") {
                                $lname = $arr[$value];
                            }
                            if ($col_name == "std_birthday") {
                                $str = $arr[$value];
                                $dateArray = date_parse_from_format('d/m/Y', $str);
//                                list($d,$m,$y) = explode("/", $str);
                                $bdate = $dateArray['year'] . "-" . insert_zero_f_position($dateArray['month'], 2) . "-" . insert_zero_f_position($dateArray['day'], 2);
                                $ar = array($col_name => $bdate);
                                $arry = array_merge($arry, $ar);
                            } else {
                   
                                    $ar = array($col_name => $arr[$value]);
                                    $arry = array_merge($arry, $ar);
                                
                            }
                        }
                    }

//                    $j++;


                    $this->db->where(array('std_code' => $stdcode, $dept => $this->session->userdata('department'), $uname => $this->session->userdata('name')));
                    $stdrow = $this->db->count_all_results('tb_student_base');

                    if ($stdrow == 0) {
                        $ar = array(
                            "tb_student_base_status" => 'W',
                            "tb_student_base_createdate" => date('Y-m-d'),
                            $dept => $this->session->userdata('department'),
                            $uname => $this->session->userdata('name')
                        );
                        $arry = array_merge($arry, $ar);
                        $this->db->insert($table, $arry);
                        $id = $this->db->insert_id();
                        if (isset($id)) {
                            //ข้อมูลก่อนเข้ารับการศึกษา
                            $std_arr = array(
                                "tb_ed_school_register_class_id" => $this->input->post('inStdClassM'),
                                "tb_student_base_id" => $id
                            );
                            $this->My_model->insert_data('tb_std_before_register', $std_arr);
                        }
                    } else {
                        $rr = $this->My_model->get_where_row($table, array('std_code' => $stdcode, $dept => $this->session->userdata('department'), $uname => $this->session->userdata('name')));
                        if (isset($rr['id'])) {
                            $id = $rr['id'];
                        }
                        $ar = array(
                            "tb_student_base_createdate" => date('Y-m-d')
                        );
                        $arry = array_merge($arry, $ar);
                        $this->My_model->update_data('tb_student_base', array('id' => $id), $arry);
                    }
                    if (isset($id)) {

                        //สร้างผู้ใช้ระบบ
                        $stRS = $this->My_model->get_where_row('tb_student_base', array('id' => $id));
                        if ($stRS['tb_member_id'] == null) {
                            $this->insert_std_member($id, $stdcode, $bdate);
                        }

                        //ข้อมูลน้ำหนักส่วนสูง
                        $std_wh_arr = array(
                            "tb_std_wnh_recorder" => $this->session->userdata('name'),
                            "tb_std_wnh_department" => $this->session->userdata('department'),
                            "tb_std_wnh_createdate" => date('Y-m-d'),
                            "std_id" => $id
                        );
                      
                        foreach (array_keys($arr) as $key => $value) {
                            $col_name = $this->get_column_name_by_comment($colName[$value], 'tb_std_wnh');
                            if ($col_name != "" && $col_name != 'id' && $arr[$value] !='' && $arr[$value] != NULL ) {
                                    
                                    $ar = array($col_name => $arr[$value]);
                                    $std_wh_arr = array_merge($std_wh_arr, $ar);

                            }
                        }
                        $this->My_model->insert_data('tb_std_wnh', $std_wh_arr);
//                        ข้อมูลที่อยู่ 1.tb_outsider -> 2.tb_std_family (connector)



                        $dad_arr = array();
                        $mom_arr = array();
                        $par_arr = array();

                        $cn = 0;
                        foreach (array_keys($arr) as $key => $value) {

                            $comment = $objPHPExcel->getActiveSheet()->getComment($this->getColumnEng($cn) . '1')->getText();
                            if ($comment == "บิดา" || $comment == "มารดา" || $comment == "ผู้ปกครอง") {
                                $col_name = $this->get_column_name_by_comment($colName[$value], 'tb_outsider');
                                if ($col_name != "" && $col_name != 'id')  {



                                    if ($comment == "บิดา") {
                                        $ar = array($col_name => $arr[$value]);
                                        $dad_arr = array_merge($dad_arr, $ar);
                                    } elseif ($comment == "มารดา") {
                                        $ar = array($col_name => $arr[$value]);
                                        $mom_arr = array_merge($mom_arr, $ar);
                                    } elseif ($comment == "ผู้ปกครอง") {
                                        $ar = array($col_name => $arr[$value]);
                                        $par_arr = array_merge($par_arr, $ar);
                                    }
                                }
                            } else {
                                $col_name = $this->get_column_name_by_comment($colName[$value], 'tb_outsider');
                                if ($col_name != "" && $col_name != 'id') {
                                    if ($col_name == "tb_outsider_relationship") {
                                        if ($arr[$value] == "อยู่ด้วยกัน") {
                                            $ar = array("tb_outsider_status" => "มีชีวิตอยู่");
                                            $dad_arr = array_merge($dad_arr, $ar);
                                            $mom_arr = array_merge($mom_arr, $ar);
                                        } elseif ($arr[$value] == "บิดาถึงแก่กรรม") {
                                            $ar = array("tb_outsider_status" => "ถึงแก่กรรม");
                                            $dad_arr = array_merge($dad_arr, $ar);
                                        } elseif ($arr[$value] == "มารดาถึงแก่กรรม") {
                                            $ar = array("tb_outsider_status" => "ถึงแก่กรรม");
                                            $mom_arr = array_merge($mom_arr, $ar);
                                        }
                                    }
                                }
                            }
                            $cn++;
                        }



                        //check ข้อมูลบิดาว่ามีในฐานข้อมูลหรือยัง
                        $rr = $this->My_model->get_where_row('tb_outsider', array('tb_outsider_titlename' => $dad_arr['tb_outsider_titlename'], 'tb_outsider_firstname' => $dad_arr['tb_outsider_firstname'], 'tb_outsider_lastname' => $dad_arr['tb_outsider_lastname']));
                        if (isset($rr['id'])) {
                            $dad_id = $rr['id'];
                        }

                        //ข้อมูลบิดา
                        if (isset($dad_id)) {
                            $fm_arr = array(
                                "tb_outsider_createdate" => date('Y-m-d')
                            );
                            $dad_arr = array_merge($dad_arr, $fm_arr);
                            $this->My_model->update_data('tb_outsider', array("id" => $dad_id), $dad_arr);
                        } else {
                            $fm_arr = array(
                                "tb_outsider_createdate" => date('Y-m-d'),
                                "tb_outsider_about" => 'บิดา',
                                "tb_outsider_parent" => 0
                            );
                            $dad_arr = array_merge($dad_arr, $fm_arr);
//                            $did = $this->My_model->insert_data('tb_outsider', $dad_arr);
                            $this->db->insert('tb_outsider', $dad_arr);
                            $did = $this->db->insert_id();

                            if (isset($did)) {

                                $fmdArr = array(
                                    "tb_outsider_id" => $did,
                                    "std_id" => $id
                                );
//                                $this->My_model->insert_data('tb_std_family', $fmdArr);
                                $this->db->insert('tb_std_family', $fmdArr);

                                //ข้อมูลอาชีพบิดา

                                $fmcArr = array(
                                    "cr_createdate" => date('Y-m-d'),
                                    "tb_outsider_id" => $did
                                );
                                $c = 0;
                                foreach (array_keys($arr) as $key => $value) {
                                    $comment = $objPHPExcel->getActiveSheet()->getComment($this->getColumnEng($c) . '1')->getText();
                                    if ($comment == 'บิดา') {
                                        $col_name = $this->get_column_name_by_comment($colName[$value], 'tb_fm_career');
                                        if ($col_name != "" && $col_name != 'id') {
                                            $ar = array($col_name => $arr[$value]);
                                            $fmcArr = array_merge($fmcArr, $ar);
                                        }
                                    }
                                    $c++;
                                }
//                                $this->My_model->insert_data('tb_fm_career', $fmcArr);
                                $this->db->insert('tb_fm_career', $fmcArr);
                            }
                        }


                        //check ข้อมูลมารดาว่ามีในฐานข้อมูลหรือยัง
                        $rr = $this->My_model->get_where_row('tb_outsider', array('tb_outsider_titlename' => $mom_arr['tb_outsider_titlename'], 'tb_outsider_firstname' => $mom_arr['tb_outsider_firstname'], 'tb_outsider_lastname' => $mom_arr['tb_outsider_lastname']));
                        if (isset($rr['id'])) {
                            $mom_id = $rr['id'];
                        }

                        //ข้อมูลมารดา
                        if (isset($mom_id)) {


                            $fm_arr = array(
                                "tb_outsider_createdate" => date('Y-m-d')
                            );
                            $mom_arr = array_merge($mom_arr, $fm_arr);

                            $this->My_model->update_data('tb_outsider', array("id" => $mom_id), $mom_arr);
                        } else {

                            $fm_arr = array(
                                "tb_outsider_createdate" => date('Y-m-d'),
                                "tb_outsider_about" => 'มารดา',
                                "tb_outsider_parent" => 0
                            );
                            $mom_arr = array_merge($mom_arr, $fm_arr);

//                            $moid = $this->My_model->insert_data('tb_outsider', $mom_arr);
                            $this->db->insert('tb_outsider', $mom_arr);
                            $moid = $this->db->insert_id();
                            if (isset($moid)) {



                                $fmdArr = array(
                                    "tb_outsider_id" => $moid,
                                    "std_id" => $id
                                );
//                                $this->My_model->insert_data('tb_std_family', $fmdArr);
                                $this->db->insert('tb_std_family', $fmdArr);



                                //ข้อมูลอาชีพมารดา
                                $fmcArr = array(
                                    "cr_createdate" => date('Y-m-d'),
                                    "tb_outsider_id" => $moid
                                );

                                $c = 0;
                                foreach (array_keys($arr) as $key => $value) {
                                    $comment = $objPHPExcel->getActiveSheet()->getComment($this->getColumnEng($c) . '1')->getText();
                                    if ($comment == 'มารดา') {
                                        $col_name = $this->get_column_name_by_comment($colName[$value], 'tb_fm_career');
                                        if ($col_name != "" && $col_name != 'id') {
                                            $ar = array($col_name => $arr[$value]);
                                            $fmcArr = array_merge($fmcArr, $ar);
                                        }
                                    }
                                    $c++;
                                }
//                                $this->My_model->insert_data('tb_fm_career', $fmcArr);
                                $this->db->insert('tb_fm_career', $fmcArr);
                            }
                        }

                        //ข้อมูลที่อยู่ tb_std_address
                        $add_r_arr = array();
                        $add_c_arr = array();
                        $column = 0;
                        foreach (array_keys($arr) as $key => $value) {

                            $comment = $objPHPExcel->getActiveSheet()->getComment($this->getColumnEng($column) . '1')->getText();
                            if ($comment == "ที่อยู่ปัจจุบัน" || $comment == "ที่อยู่ตามทะเบียนบ้าน") {
                                $col_name = $this->get_column_name_by_comment($colName[$value], 'tb_std_address');
                                if ($col_name != "" && $col_name != 'id') {

                                    if ($comment == "ที่อยู่ตามทะเบียนบ้าน") {
                                        $ar = array($col_name => $arr[$value]);
                                        $add_r_arr = array_merge($add_r_arr, $ar);
                                    } elseif ($comment == "ที่อยู่ปัจจุบัน") {
                                        $ar = array($col_name => $arr[$value]);
                                        $add_c_arr = array_merge($add_c_arr, $ar);
                                    }
                                }
                            }
                            $column++;
                        }

                        //check ที่อยู่ตามทะเบียนบ้านว่ามีในฐานข้อมูลหรือยัง
                        $rr = $this->My_model->get_where_row('tb_std_address', array('std_id' => $id, 'add_no' => $add_r_arr['add_no'], 'add_moo' => $add_r_arr['add_moo'], 'add_road' => $add_r_arr['add_road'], 'add_tambol' => $add_r_arr['add_tambol'], 'add_amphur' => $add_r_arr['add_amphur'], 'add_province' => $add_r_arr['add_province']));
                        if (isset($rr['id']))
                            $add_r_id = $rr['id'];


                        if (isset($add_r_id)) {
                            //ที่อยู่ตามทะเบียนบ้าน
                            $add_arr = array(
                                "add_createdate" => date('Y-m-d'),
                                "std_id" => $id
                            );
                            $add_r_arr = array_merge($add_arr, $add_r_arr);
//                            $this->My_model->update_data('tb_std_address', array('id', $add_r_id), $add_r_arr);
                            $this->db->where(array('id', $add_r_id))->update('tb_std_address', $add_r_arr);
                        } else {
                            //ที่อยู่ตามทะเบียนบ้าน
                            $add_arr = array(
                                "add_createdate" => date('Y-m-d'),
                                "add_status" => 'ที่อยู่ตามทะเบียนบ้าน',
                                "std_id" => $id
                            );
                            $add_r_arr = array_merge($add_arr, $add_r_arr);
//                            $this->My_model->insert_data('tb_std_address', $add_r_arr);
                            $this->db->insert('tb_std_address', $add_r_arr);
                        }

                        //check ที่อยู่ปัจจุบันว่ามีในฐานข้อมูลหรือยัง
                        $rr = $this->My_model->get_where_row('tb_std_address', array('std_id' => $id, 'add_no' => $add_c_arr['add_no'], 'add_moo' => $add_c_arr['add_moo'], 'add_road' => $add_c_arr['add_road'], 'add_tambol' => $add_c_arr['add_tambol'], 'add_amphur' => $add_c_arr['add_amphur'], 'add_province' => $add_c_arr['add_province']));
                        if (isset($rr['id']))
                            $add_c_id = $rr['id'];

                        if (!isset($add_c_id)) {
                            //ที่อยู่ปัจจุบัน
                            $add_arr = array(
                                "add_createdate" => date('Y-m-d'),
                                "add_status" => 'ที่อยู่ปัจจุบัน',
                                "std_id" => $id
                            );
                            $add_c_arr = array_merge($add_arr, $add_c_arr);
//                            $this->My_model->insert_data('tb_std_address', $add_c_arr);
                            $this->db->insert('tb_std_address', $add_c_arr);
                        }
                    }
                }




                $i++;
            }
            // insert && update parent
            $i = 0;

            foreach ($allDataInSheet as $arr) {
                if ($i == 0) {
                    $colName = $arr;
                }
                if ($i != 0) {
                    $arry = array();
                    $stdcode = "";


                    $par_arr = array(
                        "tb_outsider_createdate" => date('Y-m-d'),
                        "tb_outsider_parent" => 1
                    );

                    $cn = 0;
                    foreach (array_keys($arr) as $key => $value) {
                        $col_name = $this->get_column_name_by_comment($colName[$value], 'tb_outsider');
                        $comment = $objPHPExcel->getActiveSheet()->getComment($this->getColumnEng($cn) . '1')->getText();
                        if ($col_name != "" && $col_name != 'id') {
                            if ($comment == "ผู้ปกครอง") {
                                $ar = array($col_name => $arr[$value]);
                                $par_arr = array_merge($par_arr, $ar);
                            }
                        } elseif ($colName[$value] == "รหัสนักเรียน") {
                            $stdcode = $arr[$value];
                        }

                        $cn++;
                    }

                    //get student id by std_code
                    $std_id = $this->get_std_id_by_std_code($stdcode);
                    $par_id = "";
                    //check ข้อมูลผู้ปกครองว่ามีในฐานข้อมูลหรือยัง
                    $rr = $this->My_model->get_where_row('tb_outsider', array('tb_outsider_titlename' => $par_arr['tb_outsider_titlename'], 'tb_outsider_firstname' => $par_arr['tb_outsider_firstname'], 'tb_outsider_lastname' => $par_arr['tb_outsider_lastname']));
                    if (isset($rr['id'])) {
                        $par_id = $rr['id'];
                    }

                    //insert
                    if ($par_id == "") {
                        $this->db->insert('tb_outsider', $par_arr);
                        $pid = $this->db->insert_id();
                        if (isset($pid)) {

                            //สร้างผู้ใช้ระบบ
                            $stRS = $this->My_model->get_where_row('tb_outsider', array('id' => $pid));
                            if ($stRS['tb_member_id'] == null) {
                                $this->insert_fam_member($pid, $stdcode, '');
                            }

                            $fmdArr = array(
                                "tb_outsider_id" => $pid,
                                "std_id" => $std_id
                            );
//                                $this->My_model->insert_data('tb_std_family', $fmdArr);
                            $this->db->insert('tb_std_family', $fmdArr);

                            //ข้อมูลอาชีพผู้ปกครอง
                            $fmcArr = array(
                                "cr_createdate" => date('Y-m-d'),
                                "tb_outsider_id" => $pid
                            );

                            $c = 0;
                            foreach (array_keys($arr) as $key => $value) {
                                $comment = $objPHPExcel->getActiveSheet()->getComment($this->getColumnEng($c) . '1')->getText();
                                if ($comment == 'ผู้ปกครอง') {
                                    $col_name = $this->get_column_name_by_comment($colName[$value], 'tb_fm_career');
                                    if ($col_name != "" && $col_name != 'id') {
                                        $ar = array($col_name => $arr[$value]);
                                        $fmcArr = array_merge($fmcArr, $ar);
                                    }
                                }
                                $c++;
                            }
                            $this->db->insert('tb_fm_career', $fmcArr);
                        }
                    } else {
                        //update
                        $this->db->where(array('id' => $par_id))->update('tb_outsider', $par_arr);

                        //สร้างผู้ใช้ระบบ
                        $stRS = $this->My_model->get_where_row('tb_outsider', array('id' => $par_id));
                        if ($stRS['tb_member_id'] == null) {
                            $this->insert_fam_member($par_id, $stdcode, '');
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

    function ExportTemplate() {
        $table = $this->input->get('tableName');
        $table = 'tb_student_base';
        $table_columns = $this->db->list_fields($table);
        $column = 0;
        $object = new PHPExcel();
        $object->setActiveSheetIndex(0);
        foreach ($table_columns as $field) {

            if ($field != 'id' && $field != 'tb_member_id' && stristr($field, 'recorder') === FALSE && stristr($field, 'department') === FALSE && stristr($field, 'createdate') === FALSE && stristr($field, 'status') === FALSE) {
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
        header("Content-Disposition: attachment;filename=\"TempData.xlsx\"");
        // Write file to the browser
        $object_writer->save('php://output');
        set_time_limit(30);
        exit;
    }

    function ExportTemplateFull() {

        $table = $this->input->get('tableName');
        $table = 'tb_student_base';
        $table_columns = $this->db->list_fields($table);
        $column = 0;
        $object = new PHPExcel();
        $object->setActiveSheetIndex(0);

        //tb_student_base
        foreach ($table_columns as $field) {

            if ($field != 'id' && $field != 'tb_member_id' && stristr($field, 'recorder') === FALSE && stristr($field, 'department') === FALSE && stristr($field, 'createdate') === FALSE && stristr($field, 'status') === FALSE) {
                $object->getActiveSheet()->setCellValueByColumnAndRow($column, 1, $this->get_comment_by_column_name($field, $table));
                $column++;
            }
        }

        //tb_std_wnh
        $table = 'tb_std_wnh';
        $table_columns = $this->db->list_fields($table);
        foreach ($table_columns as $field) {

            if ($field != 'id' && $field != 'std_id' && stristr($field, 'recorder') === FALSE && stristr($field, 'department') === FALSE && stristr($field, 'createdate') === FALSE && stristr($field, 'status') === FALSE) {
                $object->getActiveSheet()->setCellValueByColumnAndRow($column, 1, $this->get_comment_by_column_name($field, $table));
                $column++;
            }
        }


        //tb_outsider บิดา
        $table = 'tb_outsider';
        $table_columns = $this->db->list_fields($table);
        foreach ($table_columns as $field) {

            if ($field != 'id' && $field != 'tb_member_id' && stristr($field, 'about') === FALSE && stristr($field, 'parent') === FALSE && stristr($field, 'recorder') === FALSE && stristr($field, 'department') === FALSE && stristr($field, 'createdate') === FALSE && stristr($field, 'status') === FALSE && stristr($field, 'relationship') === FALSE) {
                $object->getActiveSheet()->setCellValueByColumnAndRow($column, 1, $this->get_comment_by_column_name($field, $table));
                $object->getActiveSheet()->getComment($this->getColumnEng($column) . '1')->getText()->createTextRun('บิดา');
                $column++;
            }
        }
        //อาชีพและรายได้
        $object->getActiveSheet()->setCellValueByColumnAndRow($column, 1, 'อาชีพ');
        $object->getActiveSheet()->getComment($this->getColumnEng($column) . '1')->getText()->createTextRun('บิดา');
        $column++;
        $object->getActiveSheet()->setCellValueByColumnAndRow($column, 1, 'รายได้ / เดือน');
        $object->getActiveSheet()->getComment($this->getColumnEng($column) . '1')->getText()->createTextRun('บิดา');
        $column++;

        //tb_outsider มารดา
        $table = 'tb_outsider';
        $table_columns = $this->db->list_fields($table);
        foreach ($table_columns as $field) {

            if ($field != 'id' && $field != 'tb_member_id' && stristr($field, 'about') === FALSE && stristr($field, 'parent') === FALSE && stristr($field, 'recorder') === FALSE && stristr($field, 'department') === FALSE && stristr($field, 'createdate') === FALSE && stristr($field, 'status') === FALSE && stristr($field, 'relationship') === FALSE) {
                $object->getActiveSheet()->setCellValueByColumnAndRow($column, 1, $this->get_comment_by_column_name($field, $table));
                $object->getActiveSheet()->getComment($this->getColumnEng($column) . '1')->getText()->createTextRun('มารดา');
                $column++;
            }
        }
        //อาชีพและรายได้
        $object->getActiveSheet()->setCellValueByColumnAndRow($column, 1, 'อาชีพ');
        $object->getActiveSheet()->getComment($this->getColumnEng($column) . '1')->getText()->createTextRun('มารดา');
        $column++;
        $object->getActiveSheet()->setCellValueByColumnAndRow($column, 1, 'รายได้ / เดือน');
        $object->getActiveSheet()->getComment($this->getColumnEng($column) . '1')->getText()->createTextRun('มารดา');
        $column++;

        //สถานะภาพ
        $object->getActiveSheet()->setCellValueByColumnAndRow($column, 1, 'สถานะภาพ');
        $column++;
        //tb_outsider ผู้ปกครอง
        $table = 'tb_outsider';
        $table_columns = $this->db->list_fields($table);
        foreach ($table_columns as $field) {

            if ($field != 'id' && $field != 'tb_member_id' && stristr($field, 'parent') === FALSE && stristr($field, 'recorder') === FALSE && stristr($field, 'department') === FALSE && stristr($field, 'createdate') === FALSE && stristr($field, 'status') === FALSE && stristr($field, 'relationship') === FALSE) {
                $object->getActiveSheet()->setCellValueByColumnAndRow($column, 1, $this->get_comment_by_column_name($field, $table));
                $object->getActiveSheet()->getComment($this->getColumnEng($column) . '1')->getText()->createTextRun('ผู้ปกครอง');
                $column++;
            }
        }
        //อาชีพและรายได้
        $object->getActiveSheet()->setCellValueByColumnAndRow($column, 1, 'อาชีพ');
        $object->getActiveSheet()->getComment($this->getColumnEng($column) . '1')->getText()->createTextRun('ผู้ปกครอง');
        $column++;
        $object->getActiveSheet()->setCellValueByColumnAndRow($column, 1, 'รายได้ / เดือน');
        $object->getActiveSheet()->getComment($this->getColumnEng($column) . '1')->getText()->createTextRun('ผู้ปกครอง');
        $column++;

        //tb_std_address ที่อยู่ตามทะเบียนบ้าน
        $table = 'tb_std_address';
        $table_columns = $this->db->list_fields($table);
        foreach ($table_columns as $field) {

            if ($field != 'id' && $field != 'std_id' && stristr($field, 'village') === FALSE && stristr($field, 'recorder') === FALSE && stristr($field, 'department') === FALSE && stristr($field, 'createdate') === FALSE && stristr($field, 'zipcode') === FALSE && stristr($field, 'type') === FALSE && stristr($field, 'status') === FALSE && stristr($field, 'add_long') === FALSE && stristr($field, 'add_lat') === FALSE) {
                $object->getActiveSheet()->setCellValueByColumnAndRow($column, 1, $this->get_comment_by_column_name($field, $table));
                $object->getActiveSheet()->getComment($this->getColumnEng($column) . '1')->getText()->createTextRun('ที่อยู่ตามทะเบียนบ้าน');
                $column++;
            }
        }

        //tb_std_address ที่อยู่ปัจจุบัน
        $table = 'tb_std_address';
        $table_columns = $this->db->list_fields($table);
        foreach ($table_columns as $field) {

            if ($field != 'id' && $field != 'std_id' && stristr($field, 'village') === FALSE && stristr($field, 'recorder') === FALSE && stristr($field, 'department') === FALSE && stristr($field, 'createdate') === FALSE && stristr($field, 'zipcode') === FALSE && stristr($field, 'type') === FALSE && stristr($field, 'status') === FALSE && stristr($field, 'add_long') === FALSE && stristr($field, 'add_lat') === FALSE) {
                $object->getActiveSheet()->setCellValueByColumnAndRow($column, 1, $this->get_comment_by_column_name($field, $table));
                $object->getActiveSheet()->getComment($this->getColumnEng($column) . '1')->getText()->createTextRun('ที่อยู่ปัจจุบัน');
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
        header("Content-Disposition: attachment;filename=\"TempData.xlsx\"");
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

 public function get_std_base_list() {

        $cid = $_POST['cid'];
        $edyear = $_POST['edyear'];
        $rid = $_POST['rid'];

        $this->db->select("*,CONCAT (a.std_titlename,a.std_firstname,\" \",a.std_lastname) as std_fullname,a.id as StdId");

//        $this->db->select("*");
        $this->db->from("tb_student_base a");
        if ($rid != "") {
            $this->db->join("tb_ed_classroom cr", "a.id=cr.tb_student_base_id");
            $this->db->where("cr.tb_ed_room_id", $rid);
        }
//        if ($edyear != "") {
//            $this->db->where("c.tb_ed_school_register_class_edyear", $edyear);
//        }
//        if ($cid != "") {
//            $this->db->where("c.id", $cid);
//        }

        $this->db->order_by("a.std_code asc");
        $MyQ = $this->db->get();
        if ($MyQ->num_rows() > 0) {
            $StdArr = $MyQ->result();
        } else {
            $StdArr = "FALSE";
        }


        $op = "";

        $op .= "<table class=\"table table-hover table-striped table-bordered display\" id=\"example\">";
        $op .= "<thead>";
        $op .= "<tr>";
        $op .= "<th style=\"width:5%;\">ที่</th>";
//        $op .= "<th style=\"width:20%;\" class=\"no-sort\">ระดับชั้น</th>";
        $op .= "<th style=\"width:15%;\" class=\"no-sort\">รหัสนักเรียน</th>";
        $op .= "<th  class=\"no-sort\">ชื่อ-นามสกุล</th>";
        $op .= "<th  class=\"no-sort\">วันที่นำเข้าข้อมูล</th>";
        $op .= "<th  class=\"no-sort\"><button class='btn btn-warning btn-delete-all'><i class='icon-trash icon-large'></i> ลบทั้งหมด</button></th>";
        $op .= "</tr>";
        $op .= "</thead>";

        if ($StdArr != "FALSE") {
            $op .= "<tbody>";
            $i = 1;

            foreach ($StdArr as $row) {

                $op .= "<tr>";
                $op .= "<td style=\"text-align:center;\">" . $i . "</td>";
//                $op .= "<td style=\"text-align:center;\">" . $row->tb_ed_school_class_name . " " . $row->tb_ed_school_class_level . "</td>";
                $op .= "<td style=\"text-align:center;\">" . $row->std_code . "</td>";
                $op .= "<td>" . $row->std_fullname . "</td>";
                $op .= "<td style=\"text-align:center;\">" . datethaifull($row->tb_student_base_createdate) . "</td>";
                $op .= "<td style=\"text-align:center;\"><button class='btn btn-danger btn-sis-delete' onclick=delStd('".$row->StdId."')><i class='icon-trash icon-large'></i> ลบ</button></td>";
                $op .= "</tr>";
                $i++;
            }
            $op .= "</tbody>";
        }

        $op .= "</table>";
        echo $op;
    }
    
    
    function delete_std(){
        $id = $_POST['id'];
        $arr = array(
            "tb_student_base_status" => $status
        );

        if ($id != "") {
            $del = $this->My_model->delete_data('tb_ed_classroom', array('tb_student_base_id' => $id));
            if($del){
                $this->My_model->delete_data('tb_student_base', array('id' => $id));
            }
            
        }
    }


//-------- End view -------//
}
