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

Class HrImport extends CI_Controller {

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
        
    }

    public function UploadDataUpdate() {

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

                    $idcard = "";

                    foreach (array_keys($arr) as $key => $value) {
                        $col_name = $this->get_column_name_by_comment($colName[$value], 'tb_human_resources_01');
                        if ($col_name != "" && $col_name != 'id') {
                            if ($col_name == "hr_id_card") {
                                $idcard = trim($arr[$value]);
                            }
                            $ar = array($col_name => trim($arr[$value]));
                            $arry = array_merge($arry, $ar);
                        }
                    }
                    $this->db->where(array('hr_id_card' => $idcard));
                    $hrrow = $this->db->count_all_results('tb_human_resources_01');
                    if($hrrow==0){
                    $ar = array(
                        "hr_office" => $this->session->userdata('department'),
                        "hr_department" => $this->session->userdata('department'),
                        "hr_recorder" => $this->session->userdata('name')
                    );
                    $arry = array_merge($arry, $ar);
                    $this->db->insert('tb_human_resources_01', $arry);
                    $id = $this->db->insert_id();
                    }else{
                        $rr = $this->My_model->get_where_row('tb_human_resources_01', array('hr_id_card' => $idcard));
                        if (isset($rr['id'])) {
                            $id = $rr['id'];
                        }
                        
                        $this->My_model->update_data('tb_human_resources_01', array('id' => $id), $arry);
                    }
                    if (isset($id)) {

                        //สร้างผู้ใช้ระบบ
                        $stRS = $this->My_model->get_where_row('tb_human_resources_01', array('id' => $id));
                        if ($stRS['tb_member_id'] == null || $stRS['tb_member_id'] == 0) {
                            $this->insert_hr_member($id, $idcard);
                        }

                        //ข้อมูลการศึกษา
                        $gradRS = $this->My_model->get_where_row('tb_human_resources_15', array('hr_id' => $id));
                        if ($gradRS['hr_id'] == null || $gradRS['hr_id'] == 0) {
                        $hr_grad_arr = array(
                            "hr_id" => $id
                        );

                        foreach (array_keys($arr) as $key => $value) {
                            $col_name = $this->get_column_name_by_comment($colName[$value], 'tb_human_resources_15');
                            if ($col_name != "" && $col_name != 'id' && $arr[$value] != '' && $arr[$value] != NULL) {

                                $ar = array($col_name => trim($arr[$value]));
                                $hr_grad_arr = array_merge($hr_grad_arr, $ar);
                            }
                        }
                        $this->My_model->insert_data('tb_human_resources_15', $hr_grad_arr);
                        }
                    }
                    
                }




                $i++;
            }
        } catch (Exception $e) {
            echo "Error" . $e->getMessage();
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

        $table = 'tb_human_resources_01';
        $table_columns = $this->db->list_fields($table);
        $column = 0;
        $object = new PHPExcel();
        $object->setActiveSheetIndex(0);

        //tb_student_base
        foreach ($table_columns as $field) {

            if ($field != 'id' && $field != 'tb_member_id' && stristr($field, 'recorder') === FALSE && stristr($field, 'department') === FALSE && stristr($field, 'createdate') === FALSE && stristr($field, 'status') === FALSE) {
                if ($this->get_comment_by_column_name($field, $table) != "") {
                    $object->getActiveSheet()->setCellValueByColumnAndRow($column, 1, $this->get_comment_by_column_name($field, $table));
                    if ($field == 'hr_degree') {
                        $object->getActiveSheet()->getComment($this->getColumnEng($column) . '1')->getText()->createTextRun('เช่น คศ.1, คศ.2, คศ.3');
                    }
                    if ($field == 'hr_division_class' || $field == 'hr_group_learning_class') {
                        $object->getActiveSheet()->getComment($this->getColumnEng($column) . '1')->getText()->createTextRun('เช่น หัวหน้า, เจ้าหน้าที่');
                    }
                    $column++;
                }
            }
        }




        //tb_human_resources_15 การศึกษา
        $table = 'tb_human_resources_15';
        $table_columns = $this->db->list_fields($table);
        foreach ($table_columns as $field) {

            if ($field != 'id' && $field != 'tb_member_id' && stristr($field, 'about') === FALSE && stristr($field, 'parent') === FALSE && stristr($field, 'recorder') === FALSE && stristr($field, 'department') === FALSE && stristr($field, 'createdate') === FALSE && stristr($field, 'status') === FALSE && stristr($field, 'relationship') === FALSE) {
                if ($this->get_comment_by_column_name($field, $table) != "") {
                    $object->getActiveSheet()->setCellValueByColumnAndRow($column, 1, $this->get_comment_by_column_name($field, $table));
                    $column++;
                }
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
        header("Content-Disposition: attachment;filename=\"HRTempData.xlsx\"");
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

    function insert_hr_member($hr_id, $idcard) {
        try {
            $hr_arr = array(
                "department" => $this->session->userdata('department'),
                "status" => 'ผู้ปฏิบัติงาน',
                "activate" => '1',
                "username" => $idcard,
                "password" => $idcard
            );
            $mid = $this->My_model->insert_data('tb_member', $hr_arr);
            if (isset($mid)) {
                $this->My_model->update_data('tb_human_resources_01', array('id' => $hr_id), array('tb_member_id' => $mid));
            }
        } catch (Exception $e) {
            echo "Error Member : " . $e->getMessage();
        }
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

    //---- Filter student 
    // เขียนต่อตรงนี้
    public function get_std_base_list() {

        $cid = $_POST['cid'];
        $edyear = $_POST['edyear'];


        $this->db->select("CONCAT (a.std_titlename,a.std_firstname,\" \",a.std_lastname) as std_fullname,a.id as StdId");

        $this->db->select("a.*,d.*");
        $this->db->from("tb_student_base a");
        $this->db->join("tb_std_before_register b", "a.id = b.tb_student_base_id");
        $this->db->join("tb_ed_school_register_class c", "b.tb_ed_school_register_class_id = c.id");
        $this->db->join("tb_ed_school_class d", "d.id=c.tb_ed_school_class_id");
        if ($edyear != "") {
            $this->db->where("c.tb_ed_school_register_class_edyear", $edyear);
        }
        if ($cid != "") {
            $this->db->where("c.id", $cid);
        }

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
        $op .= "<th style=\"width:20%;\" class=\"no-sort\">ระดับชั้น</th>";
        $op .= "<th style=\"width:15%;\" class=\"no-sort\">รหัสนักเรียน</th>";
        $op .= "<th  class=\"no-sort\">ชื่อ-นามสกุล</th>";
        $op .= "<th  class=\"no-sort\">วันที่นำเข้าข้อมูล</th>";
        $op .= "</tr>";
        $op .= "</thead>";

        if ($StdArr != "FALSE") {
            $op .= "<tbody>";
            $i = 1;

            foreach ($StdArr as $row) {

                $op .= "<tr>";
                $op .= "<td style=\"text-align:center;\">" . $i . "</td>";
                $op .= "<td style=\"text-align:center;\">" . $row->tb_ed_school_class_name . " " . $row->tb_ed_school_class_level . "</td>";
                $op .= "<td style=\"text-align:center;\">" . $row->std_code . "</td>";
                $op .= "<td>" . $row->std_fullname . "</td>";
                $op .= "<td style=\"text-align:center;\">" . datethaifull($row->tb_student_base_createdate) . "</td>";
                $op .= "</tr>";
                $i++;
            }
            $op .= "</tbody>";
        }

        $op .= "</table>";
        echo $op;
    }

//-------- End view -------//
}
