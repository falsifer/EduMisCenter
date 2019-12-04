<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Import extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->model('import_model', 'import');
        require_once APPPATH . 'third_party/PHPExcel.php';
        $this->excel = new PHPExcel();
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

    //---test

    function ExportTemplate() {
        $table = $this->input->get('tableName');
        $table = 'tb_student_base';
        $table_columns = $this->db->list_fields($table);
        $column = 0;
        $object = new PHPExcel();
        $object->setActiveSheetIndex(0);
        foreach ($table_columns as $field) {
//            || $field!='tb_member_id' || stristr($field, 'recorder') === FALSE || stristr($field, 'department') === FALSE
            if($field!='id' &&  $field!='tb_member_id' && stristr($field, 'recorder') === FALSE  &&  stristr($field, 'department') === FALSE && stristr($field, 'createdate') === FALSE && stristr($field, 'status') === FALSE){
                $object->getActiveSheet()->setCellValueByColumnAndRow($column, 1, $field);
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

}

?>