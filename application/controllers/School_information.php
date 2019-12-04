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
  | Create Date 30/4/2562
  | Last edit	30/4/2562
  | Comment
  | ----------------------------------------------------------------------------
 */

Class School_information extends CI_Controller {

    public function __construct() {
        parent::__construct();
        if ($this->session->userdata('status') == "") {
            redirect("/");
        }
        $this->load->model("My_model");
        $this->load->model("Std_model");
        $this->load->model("Chairatto_model");
        $this->load->model("School_information_model");
    }

//------ ปรับ
    public function get_class_list_by_edyear() {
        $edyear = $this->input->post('edyear');
        $department = $this->input->post('department');

        $ClassList = $this->School_information_model->get_class_by_edyear($edyear, $department);

        $output = "";

if(isset($ClassList[0]['id'])){
  foreach ($ClassList as $r) {
            $output .= "<label class='containerzz' style='font-size:1em;margin:5px;'>";
            $output .= "<input class='MySchoolCheckbox' type='checkbox' id='inClassArray[]'  name='inClassArray[]' value='" . $r['id'] . "'/>";
            $output .= "<span class='checkmark'> </span>";
            $output .= $r['tb_ed_school_class_name'] . "ปีที่ " . $r['tb_ed_school_class_level'];
            $output .= "</label>";
        }  
}else{
    $output .="<h1 style='color:red;'>ไม่มีข้อมูล ! ผู้ใช้ต้องตั้งค่าข้อมูลตั้งต้นในส่วนของเมนู -> ตั้งค่าระบบ -> ข้อมูลโรงเรียน -> ตั้งค่าระดับชั้น -> และเริ่มกำหนดระดับชั้นที่เปิดสอนของโรงเรียนที่สังกัด ถึงจะเริ่มการคัดกรองข้อมูลเด็กได้</h1>";
}
   



        
        echo $output;

    }

    public function select_case() {
        $parameter = $this->input->post('MyCase');
        $department = $this->input->post('Department');
        $term = $this->input->post('MyTerm');
        $edyear = $this->input->post('MyEdYear');
        $classarray = $this->input->post('inClassArray');

//        print_r($classarray);

        switch ($parameter) {
            case 'gender_with_class_by_school':
                echo $this->gender_with_class_by_school($classarray);
                break;
            case 'bloodtype_with_class_by_school':
                echo $this->bloodtype_with_class_by_school($classarray);
                break;
            case 'nationality_with_class_by_school':
                echo $this->nationality_with_class_by_school($classarray);
                break;
            case 'ethnicity_with_class_by_school':
                echo $this->ethnicity_with_class_by_school($classarray);
                break;
            case 'religion_with_class_by_school':
                echo $this->religion_with_class_by_school($classarray);
                break;
        }
    }

    public function gender_with_class_by_school($classarray) {
        $Head = "สารสนเทศแสดงนักเรียนแยกตามเพศ";
        $GArray = $this->My_model->get_all_order('tb_setting_gender', 'id asc');
        $Column = "tb_setting_gender_name";
        $StdColumn = "std_gender";
        echo $this->School_information_model->gen_chart_student_base($classarray, $GArray, $Column, $StdColumn, $Head);
    }

    public function bloodtype_with_class_by_school($classarray) {
        $Head = "สารสนเทศแสดงนักเรียนแยกตามกลุ่มเลือด";
        $GArray = $this->My_model->get_all_order('tb_setting_bloodtype', 'id asc');
        $Column = "tb_setting_bloodtype_thai_name";
        $StdColumn = "std_bloodtype";
        echo $this->School_information_model->gen_chart_student_base($classarray, $GArray, $Column, $StdColumn, $Head);
    }

    public function nationality_with_class_by_school($classarray) {
        $Head = "สารสนเทศแสดงนักเรียนแยกตามสัญชาติ";
        $GArray = $this->My_model->get_all_order('tb_setting_nationality', 'id asc');
        $Column = "tb_setting_nationality_name";
        $StdColumn = "std_nationality";
        echo $this->School_information_model->gen_chart_student_base($classarray, $GArray, $Column, $StdColumn, $Head);
    }

    public function ethnicity_with_class_by_school($classarray) {
        $Head = "สารสนเทศแสดงนักเรียนแยกตามเชื้อชาติ";
        $GArray = $this->My_model->get_all_order('tb_setting_ethnicity', 'id asc');
        $Column = "tb_setting_ethnicity_name";
        $StdColumn = "std_ethnicity";
        echo $this->School_information_model->gen_chart_student_base($classarray, $GArray, $Column, $StdColumn, $Head);
    }

    public function religion_with_class_by_school($classarray) {
        $Head = "สารสนเทศแสดงนักเรียนแยกตามศาสนา";
        $GArray = $this->My_model->get_all_order('tb_setting_religion', 'id asc');
        $Column = "tb_setting_religion_name";
        $StdColumn = "std_religion";
        echo $this->School_information_model->gen_chart_student_base($classarray, $GArray, $Column, $StdColumn, $Head);
    }

//------ ปรับ ----*


    public function school_information_base() {
        $data['school'] = $this->My_model->get_where_order('tb_school', array('sc_thai_name !=' => $this->session->userdata('department'),'school_type_id !='=>0), 'sc_thai_name asc');
        $data['rs'] = $this->Std_model->get_register_base();
        $this->load->view("layout/header");
        $this->load->view("school_information/school_information_base", $data);
        $this->load->view("layout/footer");
    }

}
