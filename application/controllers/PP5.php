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

Class PP5 extends CI_Controller {

    public function __construct() {
        parent::__construct();
        if ($this->session->userdata('status') == "") {
            redirect("/");
        }
        $this->load->model('My_model');
        $this->load->model('PP5_model');
        $this->load->model('StdScore_model');
        $this->load->model('Std_model');
    }

    public function PP5_base() {
        $sc_id = $this->input->get('sc_id');

        $this->db->select("*")->from("tb_course a");
        $this->db->join("tb_course_detail b", "b.tb_course_id = a.id");
        $this->db->join("tb_ed_schedule c", "c.tb_course_detail_id = b.id");
        $this->db->join("tb_subject d", "d.id = a.tb_subject_id");
        $this->db->where('c.id', $sc_id);
        $MyQ = $this->db->get()->row_array();

        $output = "";
//        foreach ($MyQ as $r) {
        $output .= "ประจำวิชา" . $MyQ['tb_subject_name'] . " (" . $MyQ['tb_course_code'] . ")";
//        }


        $data['head'] = $output;
        $this->load->view("layout/header");
        $this->load->view("pp5/pp5_base", $data);
        $this->load->view("layout/footer");
    }

    public function get_CourseId_By_SchId() {
        $id = $_POST['id'];
        echo $this->PP5_model->get_CourseId_By_SchId($id);
    }

    public function get_KpiList() {
        $id = $_POST['id'];
        $edyear = $_POST['edyear'];
        echo $this->PP5_model->get_KpiList($id, $edyear);
    }

    public function get_MidTermTopicEdit() {
        $id = $_POST['id'];
        echo json_encode($this->My_model->get_where_row("tb_midterm_topic_score", array("id" => $id)));
    }

    public function insert_midterm_topic() {
        $topic = $_POST['topic'];
        $score = $_POST['score'];
        $id = $_POST['id'];
        $recordid = $_POST['recordid'];

        if ($recordid != "") {
            $arr = array(
                "id" => $recordid,
                "tb_midterm_topic_score_name" => $topic,
                "tb_midterm_topic_score_maxscore" => $score,
            );
            $this->My_model->update_data('tb_midterm_topic_score', array('id' => $recordid), $arr);
        } else {
            $arr = array(
                "tb_kpi_score_id" => $id,
                "tb_midterm_topic_score_name" => $topic,
                "tb_midterm_topic_score_maxscore" => $score,
                "tb_midterm_topic_score_recorder" => $this->session->userdata('name'),
                "tb_midterm_topic_score_department" => $this->session->userdata('department'),
                "tb_midterm_topic_score_createdate" => date('Y-m-d')
            );
            $this->My_model->insert_data('tb_midterm_topic_score', $arr);
        }
    }

    public function insert_midterm_purpose_topic() {
        $topic = $_POST['topic'];
        $score = $_POST['score'];
        $id = $_POST['id'];
        $recordid = $_POST['recordid'];

        if ($recordid != "") {
            $arr = array(
                "id" => $recordid,
                "tb_midterm_topic_score_name" => $topic,
                "tb_midterm_topic_score_maxscore" => $score,
            );
            $this->My_model->update_data('tb_midterm_topic_score', array('id' => $recordid), $arr);
        } else {
            $arr = array(
                "tb_course_purpose_id" => $id,
                "tb_midterm_topic_score_name" => $topic,
                "tb_midterm_topic_score_maxscore" => $score,
                "tb_midterm_topic_score_recorder" => $this->session->userdata('name'),
                "tb_midterm_topic_score_department" => $this->session->userdata('department'),
                "tb_midterm_topic_score_createdate" => date('Y-m-d')
            );
            $this->My_model->insert_data('tb_midterm_topic_score', $arr);
        }
    }

    public function insert_pp5_score() {
        $topicid = $_POST['topicid'];
        $stdid = $_POST['stdid'];
        $score = $_POST['score'];

        $arr = array(
            "tb_student_base_id" => $stdid,
            "tb_midterm_topic_score_id" => $topicid,
            "tb_std_midterm_score_score" => $score,
            "tb_std_midterm_score_recorder" => $this->session->userdata('name'),
            "tb_std_midterm_score_department" => $this->session->userdata('department'),
            "tb_std_midterm_score_createdate" => date('Y-m-d')
        );

        $this->db->select("id")->from("tb_std_midterm_score");
        $this->db->where('tb_student_base_id', $stdid);
        $this->db->where('tb_midterm_topic_score_id', $topicid);
        $MyQ = $this->db->get()->result_array();

        if (count($MyQ) > 0) {
            $this->My_model->update_data('tb_std_midterm_score', array('id' => $MyQ[0]['id']), $arr);
        } else {
            $this->My_model->insert_data('tb_std_midterm_score', $arr);
        }
    }

    //--- Character
    public function get_StdList() {
//        $id = $_POST['id'];

        $id = $this->input->post('id');
        $edyear = $_POST['edyear'];
        $scId = $this->input->post('sc_id');

        $output = "";
        $this->db->select("a.*,a.id as StdId,b.*,c.*,d.*,e.*,CONCAT (a.std_titlename,a.std_firstname,\" \",a.std_lastname) as std_fullname")->from("tb_student_base a");
        $this->db->join("tb_ed_classroom b", "b.tb_student_base_id = a.id");
        $this->db->join("tb_register_course c", "c.tb_student_base_id = a.id");
        $this->db->join("tb_ed_room d", "d.id = b.tb_ed_room_id");
        $this->db->join("tb_ed_school_register_class e", "e.id = d.tb_ed_school_register_class_id");
        $this->db->join("tb_ed_schedule sc", "sc.tb_ed_room_id=d.id"); //AB
        $this->db->where('sc.id', $scId); //AB
        $this->db->where('c.tb_course_id', $id);
//        $this->db->where(array('c.tb_course_id' => $id));
        $this->db->where('e.tb_ed_school_register_class_edyear', $edyear);
        $this->db->order_by("b.tb_ed_classroom_number asc");
        $MyStdQ = $this->db->get()->result();



        $this->db->select("*")->from("tb_course");
        $this->db->where('id', $id);
        $MyCourseQ = $this->db->get()->result_array();

        $MyMidtermMaxScore = $MyCourseQ[0]['tb_course_mid_score'];
        $MyFinalMaxScore = $MyCourseQ[0]['tb_course_final_score'];
        $output .= "<table class=\"table table-hover table-striped table-bordered display\" style='background:whitesmoke;' id=\"PP5StdTable\">";
        $output .= "<thead>";
        $output .= "<tr>";
        $output .= "<th style=\"text-align:center; width:20px;\">ที่</th>";
        $output .= "<th style=\"text-align:center; width:60px;\">รหัสนักเรียน</th>";
        $output .= "<th style=\"text-align:center; width:200px;\">ชื่อ - นามสกุล</th>";
        $output .= "<th style=\"text-align:center; width:60px;\">คะแนนระหว่างภาค(" . $MyMidtermMaxScore . ")</th>";
        $output .= "<th style=\"text-align:center; width:60px;\">คะแนนสอบปลายภาค(" . $MyFinalMaxScore . ")</th>";
        $output .= "<th style=\"text-align:center; width:60px;\">ตลอดภาคเรียน(100)</th>";
        $output .= "<th style=\"text-align:center; width:60px;\">ผลการเรียนเฉลี่ย</th>";
        $output .= "<th style=\"text-align:center; width:60px;\">ผลคุณลักษณะ</th>";
        $output .= "<th style=\"text-align:center; width:60px;\">ผลอ่านคิดวิเคราะห์</th>";
        $output .= "<th style=\"text-align:center; width:60px;\">สถานะ</th>";
        $output .= "</tr>";
        $output .= "</thead>";

        $output .= "<tbody>";
        foreach ($MyStdQ as $rStd) {

            $MidScore = $this->StdScore_model->get_std_course_midterm_score($rStd->StdId, $id);
            $FinalScore = $this->StdScore_model->get_std_course_final_score($rStd->StdId, $id);
            $MaxScore = $MidScore + $FinalScore;

            $output .= "<tr>";
            $output .= "<td style=\"text-align:center; \">" . $rStd->tb_ed_classroom_number . "</td>";
            $output .= "<td style=\"text-align:center; \">" . $rStd->std_code . "</td>";
            $output .= "<td style=\"text-align:center;\">" . $rStd->std_fullname . "</td>";
            $output .= "<td style=\"text-align:center;\">" . $MidScore . "</td>";
            $output .= "<td style=\"text-align:center;\">" . $FinalScore . "</td>";
            $output .= "<td style=\"text-align:center;\">" . $MaxScore . "</td>";
            $output .= "<td style=\"text-align:center;\">" . StudentGrade(($MaxScore)) . "</td>";
            $output .= "<td style=\"text-align:center;\">" . $this->StdScore_model->get_std_course_cha_score($rStd->StdId, $id, "String") . "</td>";
            $output .= "<td style=\"text-align:center;\">" . $this->StdScore_model->get_std_course_rwa_score($rStd->StdId, $id, "String") . "</td>";
            $output .= "<td style=\"text-align:center;\">";
            $output .= "<font color='red'>ติด ร.</font>";
            $output .= "</td>";
            $output .= "</tr>";
        }

        $output .= "</tbody>";
        echo $output;
    }

    public function get_ScheduleRecordList() {
        $id = $this->input->post('id');
        $edyear = $_POST['edyear'];

        $output = "";
        $MyStdQ = $this->Std_model->get_std_base_w_courseid($id, $edyear);

        $this->db->select("*")->from("tb_course");
        $this->db->where('id', $id);
        $MyCourseQ = $this->db->get()->result_array();

        $output .= "<table class=\"table table-hover table-striped table-bordered display\" style='background:whitesmoke;' id=\"PP5StdTable\">";
        $output .= "<thead>";
        $output .= "<tr>";
        $output .= "<th style=\"text-align:center; width:20px;\" rowspan='2'>ที่</th>";
        $output .= "<th style=\"text-align:center; width:60px;\" rowspan='2'>รหัสนักเรียน</th>";
        $output .= "<th style=\"text-align:center; width:200px;\" rowspan='2'>ชื่อ - นามสกุล</th>";
        $output .= "<th style=\"text-align:center;\" colspan='40'>คาบเรียนที่</th>";

        $output .= "</tr>";

        $output .= "<tr>";
        for ($i = 1; $i <= 40; $i++) {
            $output .= "<td style=\"text-align:center;\">" . $i . "</td>";
        }
        $output .= "</tr>";
        $output .= "</thead>";

        $output .= "<tbody>";
        foreach ($MyStdQ as $rStd) {
            $output .= "<tr>";
            $output .= "<td style=\"text-align:center; \">" . $rStd['std_number'] . "</td>";
            $output .= "<td style=\"text-align:center; \">" . $rStd['std_code'] . "</td>";
            $output .= "<td style=\"text-align:center;\">" . $rStd['std_fullname'] . "</td>";


            $output .= "</tr>";
        }

        $output .= "</tbody>";
        echo $output;
    }

    //--- Character
    public function get_ChaList() {
//        $id = $_POST['id'];
        $id = $this->input->post('id');
        $edyear = $_POST['edyear'];
        $sc_id = $this->input->post('sc_id');

        $output = "";
        $this->db->select("*")->from("tb_ed_character");
        $this->db->order_by("tb_ed_character_seq asc");
        $MyQ = $this->db->get()->result();

        $output .= "<table class=\"table table-hover table-striped table-bordered display\" style='background:whitesmoke;' id=\"PP5ChaTable\">";
        $output .= "<thead>";
        $output .= "<tr>";
        $output .= "<th class=\"no-sort\" style=\"text-align:center; width:20px;\" rowspan=\"2\">ที่</th>";
        $output .= "<th class=\"no-sort\" style=\"text-align:center; width:60px;\" rowspan=\"2\">รหัสนักเรียน</th>";
        $output .= "<th class=\"no-sort\" style=\"text-align:center; width:200px;\" rowspan=\"2\">ชื่อ - นามสกุล</th>";

        foreach ($MyQ as $r) {
            $this->db->select("*")->from("tb_ed_character_sub");
            $this->db->where('tb_ed_character_id', $r->id);
            $this->db->order_by("id asc");
            $MySubQ = $this->db->get()->result();

            $output .= "<th class=\"no-sort\" style=\"text-align:center; width:20px;\" colspan=\"" . count($MySubQ) . "\" >" . $r->tb_ed_character_content;
            $output .= "&nbsp;<button class=\"btn btn-link\" type=\"button\"><i class=\"icon-ok icon-large\" style=\"color:sky;\"></i></button>";
            $output .= "</th>";
        }

        $output .= "</tr>";

        $output .= "<tr>";
        $MySubArr = "";


        foreach ($MyQ as $r) {

            $this->db->select("*")->from("tb_ed_character_sub");
            $this->db->where('tb_ed_character_id', $r->id);
            $this->db->order_by("id asc");
            $MySubQ = $this->db->get()->result();
            $ii = 1;
            foreach ($MySubQ as $rSubQ) {
                $output .= "<th class=\"no-sort\" style=\"text-align:center; width:20px;\"  tooltip=\"" . $rSubQ->tb_ed_character_sub_content . "\">" . $ii . "</th>";
                $MySubArr .= $rSubQ->id . ",";
                $ii++;
            }
        }

        $output .= "</tr>";
        $output .= "</thead>";

        //---------- ข้อมูลใน Table
        $this->db->select("a.*,a.id as StdId,b.*,c.*,d.*,e.*,CONCAT (a.std_titlename,a.std_firstname,\" \",a.std_lastname) as std_fullname")->from("tb_student_base a");
        $this->db->join("tb_ed_classroom b", "b.tb_student_base_id = a.id");
        $this->db->join("tb_register_course c", "c.tb_student_base_id = a.id");
        $this->db->join("tb_ed_room d", "d.id = b.tb_ed_room_id");
        $this->db->join("tb_ed_school_register_class e", "e.id = d.tb_ed_school_register_class_id");
        $this->db->join("tb_ed_schedule sc", "sc.tb_ed_room_id=d.id"); //AB
        $this->db->where('sc.id', $sc_id); //AB
        $this->db->where('c.tb_course_id', $id);
//        $this->db->where(array('c.tb_course_id' => $id));
        $this->db->where('e.tb_ed_school_register_class_edyear', $edyear);
        $this->db->order_by("b.tb_ed_classroom_number asc");
        $MyStdQ = $this->db->get()->result();

        $output .= "<tbody>";
        foreach ($MyStdQ as $rStd) {
            $output .= "<tr>";
            $output .= "<td style=\"text-align:center; \">" . $rStd->tb_ed_classroom_number . "</td>";
            $output .= "<td style=\"text-align:center; \">" . $rStd->std_code . "</td>";
            $output .= "<td style=\"text-align:center;\">" . $rStd->std_fullname . "</td>";

            $MyArr = explode(',', $MySubArr);
//
//            $MyH = "";
//            $MyV = "";
//            $MyHI = 0;
//
            foreach ($MyArr as $r) {
                if ($r != "") {
                    $this->db->select("*")->from("tb_ed_character_score");
                    $this->db->where('tb_student_id', $rStd->StdId);
                    $this->db->where('tb_ed_character_sub_id', $r);
                    $this->db->where('tb_course_id', $id);
                    $MyQforStd = $this->db->get()->result_array();
                    $MyChaScore = 0;


                    if (count($MyQforStd) > 0) {
                        $MyChaScore = $MyQforStd[0]['tb_ed_character_sub_score'];
                    } else {
                        $MyChaScore = 0;
                    }

                    switch ($MyChaScore) {
                        case 3:
                            $output .= "<td style=\"text-align:center;\">";
                            $output .= "<div class=\"dropdown\">";
                            $output .= "<button class=\"btn btn-success dropdown-toggle\" type=\"button\" data-toggle=\"dropdown\">3<span style=\"margin-left:5px;\" class=\"caret\"></span></button>";
                            $output .= "<ul class=\"dropdown-menu\">";
                            $output .= "<li><a href=\"javascript:MyCharacterInsert(" . $r . "," . $rStd->StdId . ",3);\">3</a></li>";
                            $output .= "<li><a href=\"javascript:MyCharacterInsert(" . $r . "," . $rStd->StdId . ",2);\">2</a></li>";
                            $output .= "<li><a href=\"javascript:MyCharacterInsert(" . $r . "," . $rStd->StdId . ",1);\">1</a></li>";
                            $output .= "<li><a href=\"javascript:MyCharacterInsert(" . $r . "," . $rStd->StdId . ",0);\">0</a></li>";
                            $output .= "</ul>";
                            $output .= "</div>";
//                        $output .= "<button type=\"button\" class=\"btn btn-success btn-add\" id=\"\" onclick=\"MidTermTopic(this)\">3</button>";
                            $output .= "</td>";
                            break;
                        case 2:
                            $output .= "<td style=\"text-align:center;\">";
                            $output .= "<div class=\"dropdown\">";
                            $output .= "<button class=\"btn btn-warning dropdown-toggle\" type=\"button\" data-toggle=\"dropdown\">2<span style=\"margin-left:5px;\" class=\"caret\"></span></button>";
                            $output .= "<ul class=\"dropdown-menu\">";
                            $output .= "<li><a href=\"javascript:MyCharacterInsert(" . $r . "," . $rStd->StdId . ",3);\">3</a></li>";
                            $output .= "<li><a href=\"javascript:MyCharacterInsert(" . $r . "," . $rStd->StdId . ",2);\">2</a></li>";
                            $output .= "<li><a href=\"javascript:MyCharacterInsert(" . $r . "," . $rStd->StdId . ",1);\">1</a></li>";
                            $output .= "<li><a href=\"javascript:MyCharacterInsert(" . $r . "," . $rStd->StdId . ",0);\">0</a></li>";
                            $output .= "</ul>";
                            $output .= "</div>";
//                        $output .= "<button type=\"button\" class=\"btn btn-success btn-add\" id=\"\" onclick=\"MidTermTopic(this)\">3</button>";
                            $output .= "</td>";
                            break;
                        case 1:
                            $output .= "<td style=\"text-align:center;\">";
                            $output .= "<div class=\"dropdown\">";
                            $output .= "<button class=\"btn btn-danger dropdown-toggle\" type=\"button\" data-toggle=\"dropdown\">1<span style=\"margin-left:5px;\" class=\"caret\"></span></button>";
                            $output .= "<ul class=\"dropdown-menu\">";
                            $output .= "<li><a href=\"javascript:MyCharacterInsert(" . $r . "," . $rStd->StdId . ",3);\">3</a></li>";
                            $output .= "<li><a href=\"javascript:MyCharacterInsert(" . $r . "," . $rStd->StdId . ",2);\">2</a></li>";
                            $output .= "<li><a href=\"javascript:MyCharacterInsert(" . $r . "," . $rStd->StdId . ",1);\">1</a></li>";
                            $output .= "<li><a href=\"javascript:MyCharacterInsert(" . $r . "," . $rStd->StdId . ",0);\">0</a></li>";
                            $output .= "</ul>";
                            $output .= "</div>";
//                        $output .= "<button type=\"button\" class=\"btn btn-success btn-add\" id=\"\" onclick=\"MidTermTopic(this)\">3</button>";
                            $output .= "</td>";
                            break;
                        case 0:
                            $output .= "<td style=\"text-align:center;\">";
                            $output .= "<div class=\"dropdown\">";
                            $output .= "<button class=\"btn btn-secondary dropdown-toggle\" type=\"button\" data-toggle=\"dropdown\">0<span style=\"margin-left:5px;\" class=\"caret\"></span></button>";
                            $output .= "<ul class=\"dropdown-menu\">";
                            $output .= "<li><a href=\"javascript:MyCharacterInsert(" . $r . "," . $rStd->StdId . ",3);\">3</a></li>";
                            $output .= "<li><a href=\"javascript:MyCharacterInsert(" . $r . "," . $rStd->StdId . ",2);\">2</a></li>";
                            $output .= "<li><a href=\"javascript:MyCharacterInsert(" . $r . "," . $rStd->StdId . ",1);\">1</a></li>";
                            $output .= "<li><a href=\"javascript:MyCharacterInsert(" . $r . "," . $rStd->StdId . ",0);\">0</a></li>";
                            $output .= "</ul>";
                            $output .= "</div>";
//                        $output .= "<button type=\"button\" class=\"btn btn-success btn-add\" id=\"\" onclick=\"MidTermTopic(this)\">3</button>";
                            $output .= "</td>";
                            break;
                    }
                }
            }

            $output .= "</tr>";
        }

        $output .= "</tbody>";
        $output .= "</table>";



        echo $output;
    }

    public function insert_cha_score() {
        $courseid = $_POST['courseid'];
        $characterid = $_POST['characterid'];
        $studentid = $_POST['studentid'];
        $score = $_POST['score'];

        $arr = array(
            "tb_course_id" => $courseid,
            "tb_ed_character_sub_id" => $characterid,
            "tb_student_id" => $studentid,
            "tb_ed_character_sub_score" => $score,
            "tb_ed_character_score_recorder" => $this->session->userdata('name'),
            "tb_ed_character_score_department" => $this->session->userdata('department'),
            "tb_ed_character_score_create_date" => date('Y-m-d')
        );

        $this->db->select("id")->from("tb_ed_character_score");
        $this->db->where('tb_student_id', $studentid);
        $this->db->where('tb_ed_character_sub_id', $characterid);
        $this->db->where('tb_course_id', $courseid);
        $MyQ = $this->db->get()->result_array();

        if (count($MyQ) > 0) {
            $this->My_model->update_data('tb_ed_character_score', array('id' => $MyQ[0]['id']), $arr);
        } else {
            $this->My_model->insert_data('tb_ed_character_score', $arr);
        }
    }

    //--- RWA
    public function get_RWAList() {
//        $id = $_POST['id'];
        $id = $this->input->post('id');
        $sc_id = $this->input->post('sc_id');
        $edyear = $_POST['edyear'];

        $output = "";
        $this->db->select("*")->from("tb_ed_rw_analysis");
        $this->db->order_by("tb_ed_rw_analysis_seq asc");
        $MyQ = $this->db->get()->result();

        $output .= "<table class=\"table table-hover table-striped table-bordered display\" style='background:whitesmoke;' id=\"PP5RWATable\">";
        $output .= "<thead>";
        $output .= "<tr>";
        $output .= "<th class=\"no-sort\" style=\"text-align:center; width:20px;\" rowspan=\"2\">ที่</th>";
        $output .= "<th class=\"no-sort\" style=\"text-align:center; width:60px;\" rowspan=\"2\">รหัสนักเรียน</th>";
        $output .= "<th class=\"no-sort\" style=\"text-align:center; width:200px;\" rowspan=\"2\">ชื่อ - นามสกุล</th>";

        foreach ($MyQ as $r) {
            $this->db->select("*")->from("tb_ed_rw_analysis_sub");
            $this->db->where('tb_ed_rw_analysis_id', $r->id);
            $this->db->order_by("id asc");
            $MySubQ = $this->db->get()->result();

            $output .= "<th class=\"no-sort\" style=\"text-align:center; width:20px;\" colspan=\"" . count($MySubQ) . "\" >" . $r->tb_ed_rw_analysis_content;
            $output .= "&nbsp;<button class=\"btn btn-link\" type=\"button\"><i class=\"icon-ok icon-large\" style=\"color:sky;\"></i></button>";
            $output .= "</th>";
        }

        $output .= "</tr>";

        $output .= "<tr>";
        $MySubArr = "";


        foreach ($MyQ as $r) {

            $this->db->select("*")->from("tb_ed_rw_analysis_sub");
            $this->db->where('tb_ed_rw_analysis_id', $r->id);
            $this->db->order_by("id asc");
            $MySubQ = $this->db->get()->result();
            $ii = 1;
            foreach ($MySubQ as $rSubQ) {
                $output .= "<th class=\"no-sort\" style=\"text-align:center; width:20px;\"  tooltip=\"" . $rSubQ->tb_ed_rw_analysis_sub_content . "\">" . $ii . "</th>";
                $MySubArr .= $rSubQ->id . ",";
                $ii++;
            }
        }

        $output .= "</tr>";
        $output .= "</thead>";

        //---------- ข้อมูลใน Table
        $this->db->select("a.*,a.id as StdId,b.*,c.*,d.*,e.*,CONCAT (a.std_titlename,a.std_firstname,\" \",a.std_lastname) as std_fullname")->from("tb_student_base a");
        $this->db->join("tb_ed_classroom b", "b.tb_student_base_id = a.id");
        $this->db->join("tb_register_course c", "c.tb_student_base_id = a.id");
        $this->db->join("tb_ed_room d", "d.id = b.tb_ed_room_id");
        $this->db->join("tb_ed_school_register_class e", "e.id = d.tb_ed_school_register_class_id");
        $this->db->join("tb_ed_schedule sc", "sc.tb_ed_room_id=d.id"); //AB
        $this->db->where('sc.id', $sc_id); //AB
        $this->db->where('c.tb_course_id', $id);
//        $this->db->where(array('c.tb_course_id' => $id));
        $this->db->where('e.tb_ed_school_register_class_edyear', $edyear);
        $this->db->order_by("b.tb_ed_classroom_number asc");
        $MyStdQ = $this->db->get()->result();

        $output .= "<tbody>";
        foreach ($MyStdQ as $rStd) {
            $output .= "<tr>";
            $output .= "<td style=\"text-align:center; \">" . $rStd->tb_ed_classroom_number . "</td>";
            $output .= "<td style=\"text-align:center; \">" . $rStd->std_code . "</td>";
            $output .= "<td style=\"text-align:center;\">" . $rStd->std_fullname . "</td>";

            $MyArr = explode(',', $MySubArr);
//
//            $MyH = "";
//            $MyV = "";
//            $MyHI = 0;
//
            foreach ($MyArr as $r) {
                if ($r != "") {
                    $this->db->select("*")->from("tb_ed_rw_analysis_score");
                    $this->db->where('tb_student_id', $rStd->StdId);
                    $this->db->where('tb_ed_rw_analysis_sub_id', $r);
                    $this->db->where('tb_course_id', $id);
                    $MyQforStd = $this->db->get()->result_array();
                    $MyChaScore = 0;


                    if (count($MyQforStd) > 0) {
                        $MyChaScore = $MyQforStd[0]['tb_ed_rw_analysis_sub_score'];
                    } else {
                        $MyChaScore = 0;
                    }

                    switch ($MyChaScore) {
                        case 3:
                            $output .= "<td style=\"text-align:center;\">";
                            $output .= "<div class=\"dropdown\">";
                            $output .= "<button class=\"btn btn-success dropdown-toggle\" type=\"button\" data-toggle=\"dropdown\">3<span style=\"margin-left:5px;\" class=\"caret\"></span></button>";
                            $output .= "<ul class=\"dropdown-menu\">";
                            $output .= "<li><a href=\"javascript:MyRWAInsert(" . $r . "," . $rStd->StdId . ",3);\">3</a></li>";
                            $output .= "<li><a href=\"javascript:MyRWAInsert(" . $r . "," . $rStd->StdId . ",2);\">2</a></li>";
                            $output .= "<li><a href=\"javascript:MyRWAInsert(" . $r . "," . $rStd->StdId . ",1);\">1</a></li>";
                            $output .= "<li><a href=\"javascript:MyRWAInsert(" . $r . "," . $rStd->StdId . ",0);\">0</a></li>";
                            $output .= "</ul>";
                            $output .= "</div>";
//                        $output .= "<button type=\"button\" class=\"btn btn-success btn-add\" id=\"\" onclick=\"MidTermTopic(this)\">3</button>";
                            $output .= "</td>";
                            break;
                        case 2:
                            $output .= "<td style=\"text-align:center;\">";
                            $output .= "<div class=\"dropdown\">";
                            $output .= "<button class=\"btn btn-warning dropdown-toggle\" type=\"button\" data-toggle=\"dropdown\">2<span style=\"margin-left:5px;\" class=\"caret\"></span></button>";
                            $output .= "<ul class=\"dropdown-menu\">";
                            $output .= "<li><a href=\"javascript:MyRWAInsert(" . $r . "," . $rStd->StdId . ",3);\">3</a></li>";
                            $output .= "<li><a href=\"javascript:MyRWAInsert(" . $r . "," . $rStd->StdId . ",2);\">2</a></li>";
                            $output .= "<li><a href=\"javascript:MyRWAInsert(" . $r . "," . $rStd->StdId . ",1);\">1</a></li>";
                            $output .= "<li><a href=\"javascript:MyRWAInsert(" . $r . "," . $rStd->StdId . ",0);\">0</a></li>";
                            $output .= "</ul>";
                            $output .= "</div>";
//                        $output .= "<button type=\"button\" class=\"btn btn-success btn-add\" id=\"\" onclick=\"MidTermTopic(this)\">3</button>";
                            $output .= "</td>";
                            break;
                        case 1:
                            $output .= "<td style=\"text-align:center;\">";
                            $output .= "<div class=\"dropdown\">";
                            $output .= "<button class=\"btn btn-danger dropdown-toggle\" type=\"button\" data-toggle=\"dropdown\">1<span style=\"margin-left:5px;\" class=\"caret\"></span></button>";
                            $output .= "<ul class=\"dropdown-menu\">";
                            $output .= "<li><a href=\"javascript:MyRWAInsert(" . $r . "," . $rStd->StdId . ",3);\">3</a></li>";
                            $output .= "<li><a href=\"javascript:MyRWAInsert(" . $r . "," . $rStd->StdId . ",2);\">2</a></li>";
                            $output .= "<li><a href=\"javascript:MyRWAInsert(" . $r . "," . $rStd->StdId . ",1);\">1</a></li>";
                            $output .= "<li><a href=\"javascript:MyRWAInsert(" . $r . "," . $rStd->StdId . ",0);\">0</a></li>";
                            $output .= "</ul>";
                            $output .= "</div>";
//                        $output .= "<button type=\"button\" class=\"btn btn-success btn-add\" id=\"\" onclick=\"MidTermTopic(this)\">3</button>";
                            $output .= "</td>";
                            break;
                        case 0:
                            $output .= "<td style=\"text-align:center;\">";
                            $output .= "<div class=\"dropdown\">";
                            $output .= "<button class=\"btn btn-secondary dropdown-toggle\" type=\"button\" data-toggle=\"dropdown\">0<span style=\"margin-left:5px;\" class=\"caret\"></span></button>";
                            $output .= "<ul class=\"dropdown-menu\">";
                            $output .= "<li><a href=\"javascript:MyRWAInsert(" . $r . "," . $rStd->StdId . ",3);\">3</a></li>";
                            $output .= "<li><a href=\"javascript:MyRWAInsert(" . $r . "," . $rStd->StdId . ",2);\">2</a></li>";
                            $output .= "<li><a href=\"javascript:MyRWAInsert(" . $r . "," . $rStd->StdId . ",1);\">1</a></li>";
                            $output .= "<li><a href=\"javascript:MyRWAInsert(" . $r . "," . $rStd->StdId . ",0);\">0</a></li>";
                            $output .= "</ul>";
                            $output .= "</div>";
//                        $output .= "<button type=\"button\" class=\"btn btn-success btn-add\" id=\"\" onclick=\"MidTermTopic(this)\">3</button>";
                            $output .= "</td>";
                            break;
                    }
                }
            }

            $output .= "</tr>";
        }

        $output .= "</tbody>";
        $output .= "</table>";



        echo $output;
    }

    public function insert_RWA_score() {
        $courseid = $_POST['courseid'];
        $RWAid = $_POST['RWAid'];
        $studentid = $_POST['studentid'];
        $score = $_POST['score'];

        $arr = array(
            "tb_course_id" => $courseid,
            "tb_ed_rw_analysis_sub_id" => $RWAid,
            "tb_student_id" => $studentid,
            "tb_ed_rw_analysis_sub_score" => $score,
            "tb_ed_rw_analysis_score_recorder" => $this->session->userdata('name'),
            "tb_ed_rw_analysis_score_department" => $this->session->userdata('department'),
            "tb_ed_rw_analysis_score_create_date" => date('Y-m-d')
        );

        $this->db->select("id")->from("tb_ed_rw_analysis_score");
        $this->db->where('tb_student_id', $studentid);
        $this->db->where('tb_ed_rw_analysis_sub_id', $RWAid);
        $this->db->where('tb_course_id', $courseid);
        $MyQ = $this->db->get()->result_array();

        if (count($MyQ) > 0) {
            $this->My_model->update_data('tb_ed_rw_analysis_score', array('id' => $MyQ[0]['id']), $arr);
        } else {
            $this->My_model->insert_data('tb_ed_rw_analysis_score', $arr);
        }
    }

}
