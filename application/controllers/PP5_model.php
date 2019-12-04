<?php

class PP5_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function get_CourseId_By_SchId($id) {

        $this->db->select("a.id as aid,b.id as bid,c.id as cid,a.id as CourseId")->from("tb_course a");
        $this->db->join("tb_course_detail b", "b.tb_course_id = a.id");
        $this->db->join("tb_ed_schedule c", "c.tb_course_detail_id = b.id");
        $this->db->where('c.id', $id);
        $MyQ = $this->db->get()->result_array();
//        $output = "";
        $output = $MyQ[0]['CourseId'];
        echo $output;
    }

    function get_KpiList($id, $edyear) {

        $this->db->select("a.*,b.*,c.*,d.*,a.id as CourseId")->from("tb_course a");
        $this->db->join("tb_course_detail b", "b.tb_course_id = a.id");
        $this->db->join("tb_ed_schedule c", "c.tb_course_detail_id = b.id");
        $this->db->join("tb_subject d", "d.id = a.tb_subject_id");
        $this->db->where('c.id', $id);
        $query = $this->db->get()->result_array();

        $output = "<table class=\"table table-hover table-striped table-bordered display\" style='background:whitesmoke;' id=\"PP5Table\">";
        $SjType = $query[0]['tb_subject_type'];
        $CourseId = $query[0]['CourseId'];



        if ($SjType == "พื้นฐาน") {


            //------------
            $this->db->select("a.*,b.*,c.*,d.*,b.id as kpiid")->from("tb_unit_learning a");
            $this->db->join("tb_kpi_score b", "b.tb_unit_learning_id = a.id");
            $this->db->join("tb_kpi_standard_learning c", "c.id = b.tb_kpi_standard_learning_id");
            $this->db->join("tb_standard_learning d", "d.id = c.tb_standard_learning_id");
//        $this->db->join("tb_course e", "e.id = a.tb_course_id");
            $this->db->where('a.tb_course_id', $CourseId);
            $myQ = $this->db->get()->result();
//            $Checker = count($myQ);

            $output .= "<thead>";
            $output .= "<tr>";

            $output .= "<th class=\"no-sort\" style=\"text-align:center; width:20px;\" rowspan=\"2\">ที่</th>";
            $output .= "<th class=\"no-sort\" style=\"text-align:center; width:60px;\" rowspan=\"2\">รหัสนักเรียน</th>";
            $output .= "<th class=\"no-sort\" style=\"text-align:center; width:200px;\" rowspan=\"2\">ชื่อ - นามสกุล</th>";

            $i = 1;
            foreach ($myQ as $r) {
                $this->db->select("*")->from("tb_midterm_topic_score");
                $this->db->where('tb_kpi_score_id', $r->kpiid);
                $this->db->order_by("id asc");
                $mykpiQ = $this->db->get()->result_array();
                $MyCount = count($mykpiQ);
                $output .= "<th class=\"no-sort\" style=\"text-align:center; width:100px;\" colspan=\"" . $MyCount . "\" >";
                $output .= "<button type=\"button\" class=\"btn btn-link btn-add\" id=\"" . $r->kpiid . "\" onclick=\"MidTermTopic(this)\">";
                $output .= $r->tb_standard_learning_code . " " . $r->tb_kpi_standard_learning_level . "/" . thaidigit($r->tb_kpi_standard_learning_seq) . "<font color=\"red\"> (" . $r->tb_kpi_score . ")</font>";
                $output .= "</button>";
                $output .= "</th>";

                $i++;
            }
            $output .= "</tr>";

            $output .= "<tr>";
            $MyArrId = "";
            foreach ($myQ as $r) {
                $this->db->select("*")->from("tb_midterm_topic_score");
                $this->db->where('tb_kpi_score_id', $r->kpiid);
                $this->db->order_by("id asc");
                $MyMidtermQ = $this->db->get()->result();
                if (count($MyMidtermQ) > 0) {
                    foreach ($MyMidtermQ as $rr) {
                        //
                        $output .= "<th class=\"no-sort\" style=\"text-align:center;padding:0px;\" >";
//                        $output .= "<div class='row'>";
//                        $output .= "</div>";
//                        $output .= "<button type=\"button\" class=\"btn btn-link btn-remove\" id=\"" . $r->kpiid . "\" onclick=\"MidTermTopic(this)\"><i class=\"icon-remove icon-large\" style=\"color:red;\"></i></button>";
//                        $output .= "<div style='width:50%;'>";
//                        $output .= "</div>";

                        $output .= "<button type=\"button\" class=\"btn btn-link\" id=\"" . $rr->id . "\" onclick=\"MidTermTopicEdit(this)\" >";
                        $output .= $rr->tb_midterm_topic_score_name . " <font color=\"red\">(" . $rr->tb_midterm_topic_score_maxscore . ")</font>";
                        $output .= "</button>";
                        $output .= "</th>";
                        $MyArrId .= $rr->id . ",";
                    }
                } else {
                    $output .= "<th class=\"no-sort\" style=\"text-align:center; ;\" >"
                            . "<button type=\"button\" class=\"btn btn-primary btn-add\" id=\"" . $r->kpiid . "\" onclick=\"MidTermTopic(this)\"><i class=\"icon-plus icon-large\"></i> คะแนนเก็บ</button>"
                            . "</th>";
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
            $this->db->where('c.tb_course_id', $CourseId);
            $this->db->where('e.tb_ed_school_register_class_edyear', $edyear);
            $MyStdQ = $this->db->get()->result();
            $countstd = count($MyStdQ);
            $output .= "<tbody>";

//            $MyVI = 0;
            $MyV = "";
            foreach ($MyStdQ as $rr) {
                $output .= "<tr>";
                $output .= "<td style=\"text-align:center; \">" . $rr->tb_ed_classroom_number . "</td>";
                $output .= "<td style=\"text-align:center; \">" . $rr->std_code . "</td>";
                $output .= "<td style=\"text-align:center;\">" . $rr->std_fullname . "</td>";
                $MyV .= $rr->StdId . ",";

                $iautofocus = 1;

                //------------
                $MyArr = explode(',', $MyArrId);

                $MyH = "";

                $MyHI = 0;

                foreach ($MyArr as $r) {
                    if ($r != "") {
                        $this->db->select("*")->from("tb_std_midterm_score");
                        $this->db->where('tb_student_base_id', $rr->StdId);
                        $this->db->where('tb_midterm_topic_score_id', $r);
                        $MyMidtermQforStd = $this->db->get()->result_array();

                        if (count($MyMidtermQforStd) > 0) {
                            $output .= "<td style=\"text-align:center;\"><input type=\"text\" name=\"" . $MyHI . "\" id=\"" . $r . "," . $rr->StdId . "\" maxlength=\"2\" onkeypress='validate(event)' onfocus=\"MyCursorNow(this)\"  onkeyup=\"InsertScore(this)\" class=\"form-control\" size=\"1\" autofocus/ value=\"" . $MyMidtermQforStd[0]['tb_std_midterm_score_score'] . "\" style=\"color:blue;\"></td>";
                            $output .= "";
                        } else {
                            $output .= "<td style=\"text-align:center;\"><input type=\"text\" name=\"" . $MyHI . "\" id=\"" . $r . "," . $rr->StdId . "\" maxlength=\"2\" onkeypress='validate(event)'  onfocus=\"MyCursorNow(this)\" onkeyup=\"InsertScore(this)\" class=\"form-control\" size=\"1\" autofocus/></td>";
                        }
                        $MyH .= $r . ",";
                    }
                }

                $output .= "</tr>";
            }

            $output .= "</tbody>";
        } else {


            $MyQ = $this->My_model->get_where_order('tb_course_purpose', array('tb_course_id' => $CourseId), 'id asc');
//            $Checker = count($myQ);

            $output .= "<thead>";
            $output .= "<tr>";

            $output .= "<th class=\"no-sort\" style=\"text-align:center; width:20px;\" rowspan=\"2\">ที่</th>";
            $output .= "<th class=\"no-sort\" style=\"text-align:center; width:60px;\" rowspan=\"2\">รหัสนักเรียน</th>";
            $output .= "<th class=\"no-sort\" style=\"text-align:center; width:200px;\" rowspan=\"2\">ชื่อ - นามสกุล</th>";

            $i = 1;
            foreach ($MyQ as $r) {
                $this->db->select("*")->from("tb_midterm_topic_score");
                $this->db->where('tb_course_purpose_id', $r['id']);
                $this->db->order_by("id asc");
                $mykpiQ = $this->db->get()->result_array();
                $MyCount = count($mykpiQ);
                $output .= "<th class=\"no-sort\" style=\"text-align:center; width:100px;\" colspan=\"" . $MyCount . "\" >";
                $output .= "<button type=\"button\" class=\"btn btn-link btn-add\" id=\"" . $r['id'] . "\" onclick=\"MidTermTopicPurpose(this)\">";
                $output .= $r['tb_course_purpose_name'] . "<font color=\"red\"> (" . $r['tb_course_purpose_score'] . ")</font>";
                $output .= "</button>";
                $output .= "</th>";

                $i++;
            }
            $output .= "</tr>";

            $output .= "<tr>";
            $MyArrId = "";
            foreach ($MyQ as $r) {
                $this->db->select("*")->from("tb_midterm_topic_score");
                $this->db->where('tb_course_purpose_id', $r['id']);
                $this->db->order_by("id asc");
                $MyMidtermQ = $this->db->get()->result_array();
                if (count($MyMidtermQ) > 0) {
                    foreach ($MyMidtermQ as $rr) {
                        //
                        $output .= "<th class=\"no-sort\" style=\"text-align:center;padding:0px;\" >";
                        $output .= "<div class='row pull-right'>";
                        $output .= "<button type=\"button\" class=\"btn btn-link btn-remove\" id=\"" . $rr['id'] . "\" onclick=\"DelelteThisMidTermPurposeTopic(this)\"><i class=\"icon-trash icon-large\" style=\"color:red;\"></i></button>";
                       
                        $output .= "</div>";

                        $output .= "<button type=\"button\" class=\"btn btn-link\" id=\"" . $rr['id'] . "\" onclick=\"MidTermTopicEdit(this)\" >";
                        $output .= $rr['tb_midterm_topic_score_name'] . " <font color=\"red\">(" . $rr['tb_midterm_topic_score_maxscore'] . ")</font>";
                        $output .= "</button>";
                        $output .= "</th>";
                        $MyArrId .= $rr['id'] . ",";
                    }
                } else {
                    $output .= "<th class=\"no-sort\" style=\"text-align:center; ;\" >"
                            . "<button type=\"button\" class=\"btn btn-primary btn-add\" id=\"" . $r['id'] . "\" onclick=\"MidTermTopicPurpose(this)\"><i class=\"icon-plus icon-large\"></i> คะแนนเก็บ</button>"
                            . "</th>";
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
            $this->db->where('c.tb_course_id', $CourseId);
            $this->db->where('e.tb_ed_school_register_class_edyear', $edyear);
            $MyStdQ = $this->db->get()->result();
            $countstd = count($MyStdQ);
            $output .= "<tbody>";

//            $MyVI = 0;
            $MyV = "";
            foreach ($MyStdQ as $rr) {
                $output .= "<tr>";
                $output .= "<td style=\"text-align:center; \">" . $rr->tb_ed_classroom_number . "</td>";
                $output .= "<td style=\"text-align:center; \">" . $rr->std_code . "</td>";
                $output .= "<td style=\"text-align:center;\">" . $rr->std_fullname . "</td>";
                $MyV .= $rr->StdId . ",";

                $iautofocus = 1;

                //------------
                $MyArr = explode(',', $MyArrId);

                $MyH = "";

                $MyHI = 0;

                foreach ($MyArr as $r) {
                    if ($r != "") {
                        $this->db->select("*")->from("tb_std_midterm_score");
                        $this->db->where('tb_student_base_id', $rr->StdId);
                        $this->db->where('tb_midterm_topic_score_id', $r);
                        $MyMidtermQforStd = $this->db->get()->result_array();

                        if (count($MyMidtermQforStd) > 0) {
                            $output .= "<td style=\"text-align:center;\"><input type=\"text\" name=\"" . $MyHI . "\" id=\"" . $r . "," . $rr->StdId . "\" maxlength=\"2\" onkeypress='validate(event)' onfocus=\"MyCursorNow(this)\"  onkeyup=\"InsertScore(this)\" class=\"form-control\" size=\"1\" autofocus/ value=\"" . $MyMidtermQforStd[0]['tb_std_midterm_score_score'] . "\" style=\"color:blue;\"></td>";
                            $output .= "";
                        } else {
                            $output .= "<td style=\"text-align:center;\"><input type=\"text\" name=\"" . $MyHI . "\" id=\"" . $r . "," . $rr->StdId . "\" maxlength=\"2\" onkeypress='validate(event)'  onfocus=\"MyCursorNow(this)\" onkeyup=\"InsertScore(this)\" class=\"form-control\" size=\"1\" autofocus/></td>";
                        }
                        $MyH .= $r . ",";
                    }
                }

                $output .= "</tr>";
            }

            $output .= "</tbody>";
        }


        $output .= "</table>";
        $output .= "<input type=\"hidden\" name=\"MyH\" id=\"MyH\"  value=\"" . $MyH . "\" class=\"form-control\" />";
        $output .= "<input type=\"hidden\" name=\"MyV\" id=\"MyV\"  value=\"" . $MyV . "\" class=\"form-control\" />";

        return $output;
    }

}
