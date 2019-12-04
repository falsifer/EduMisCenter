<?php

class StdScore_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    // -- -Model คะแนนแบบง่าย คะแนนเก็บ + คะแนนเต็ม 70+30;
    function get_std_course_midterm_score($StdId, $CourseId) {
//        ตัวอย่าง
//        $StdId = id record ของเด็ก
//        $CourseId = id record ของวิชา

        $MyScore = 0;

        $this->db->select("tb_std_course_midterm_score_score")->from("tb_std_course_midterm_score");
        $this->db->where('tb_student_base_id', $StdId);
        $this->db->where('tb_course_id', $CourseId);
        $MyQ1 = $this->db->get()->result_array();

        if (count($MyQ1) > 0) {
            $MyScore = $MyQ1[0]['tb_std_course_midterm_score_score'];
        } else {
            $this->db->select("a.id,b.tb_subject_type as type");
            $this->db->from("tb_course a");
            $this->db->join("tb_subject b", "b.id = a.tb_subject_id");
            $this->db->where("a.id", $CourseId);
            $MyQ = $this->db->get()->row_array();

            if ($MyQ['type'] == "พื้นฐาน") {

                $MyScore = $this->get_std_course_mid_score($StdId, $CourseId);
            }
        }

        return $MyScore;
    }

    function get_std_course_final_score($StdId, $CourseId) {
//        ตัวอย่าง
//        $StdId = id record ของเด็ก
//        $CourseId = id record ของวิชา

        $MyScore = 0;

        $this->db->select_max("tb_std_course_final_score_score")->from("tb_std_course_final_score");
        $this->db->where('tb_student_base_id', $StdId);
        $this->db->where('tb_course_id', $CourseId);
        $MyQ1 = $this->db->get()->result_array();

        if (count($MyQ1) > 0) {
            $MyScore = $MyQ1[0]['tb_std_course_final_score_score'];
        }

        return $MyScore;
    }

    function get_std_course_cha_score($StdId, $CourseId, $Type) {
//        ตัวอย่าง
//        $StdId = id record ของเด็ก
//        $CourseId = id record ของวิชา
//        $Type = ประเภทของค่าที่จะคืนมี String กับ Integer

        $MyTopic = 0;
        $MyOutput = 0;
        $CountCha = $this->db->count_all_results("tb_ed_character_sub");

        if ($CountCha > 0) {
            $MyTopic = $CountCha * 3;
        }
        $this->db->select_sum("tb_ed_character_sub_score")->from("tb_ed_character_score");
        $this->db->where('tb_student_id', $StdId);
        $this->db->where('tb_course_id', $CourseId);
        $MyScoreQ1 = $this->db->get()->result_array();

        $MyPercent = ($MyScoreQ1[0]['tb_ed_character_sub_score'] / $MyTopic ) * 100;
        $MyScore = ($MyPercent / 100) * 3;

        if ($Type == "Integer") {
            $MyOutput = round($MyScore, 1);
        } elseif ($Type == "String") {
            if ($MyScore < 1) {
                $MyOutput = "ไม่ผ่าน";
            } elseif ($MyScore > 1 && $MyScore < 1.5) {
                $MyOutput = "ผ่าน";
            } elseif ($MyScore > 1.5 && $MyScore < 2) {
                $MyOutput = "ดี";
            } elseif ($MyScore >= 2.5) {
                $MyOutput = "ดีเยี่ยม";
            }
        }
        return $MyOutput;
    }

    function get_std_course_rwa_score($StdId, $CourseId, $Type) {
//        ตัวอย่าง
//        $StdId = id record ของเด็ก
//        $CourseId = id record ของวิชา
//        $Type = ประเภทของค่าที่จะคืนมี String กับ Integer

        $MyTopic = 0;
        $MyOutput = 0;
        $Count = $this->db->count_all_results("tb_ed_rw_analysis_sub");

        if ($Count > 0) {
            $MyTopic = $Count * 3;
        }
        $this->db->select_sum("tb_ed_rw_analysis_sub_score")->from("tb_ed_rw_analysis_score");
        $this->db->where('tb_student_id', $StdId);
        $this->db->where('tb_course_id', $CourseId);
        $MyScoreQ1 = $this->db->get()->result_array();

        $MyPercent = ($MyScoreQ1[0]['tb_ed_rw_analysis_sub_score'] / $MyTopic ) * 100;
        $MyScore = ($MyPercent / 100) * 3;

        if ($Type == "Integer") {
            $MyOutput = round($MyScore, 1);
        } elseif ($Type == "String") {
            if ($MyScore < 1) {
                $MyOutput = "ไม่ผ่าน";
            } elseif ($MyScore > 1 && $MyScore < 1.5) {
                $MyOutput = "ผ่าน";
            } elseif ($MyScore > 1.5 && $MyScore < 2) {
                $MyOutput = "ดี";
            } elseif ($MyScore >= 2.5) {
                $MyOutput = "ดีเยี่ยม";
            }
        }
        return $MyOutput;
    }

//     $this->db->select("tb_unit_learning_score as UnitScore,id as course_unit_id")->from("tb_unit_learning");
//                $this->db->where("tb_course_id", $CourseId);
//                $MyUnitQ = $this->db->get()->result_array();
//                foreach ($MyUnitQ as $rUnit) {
//                    //---- กวาดคะแนนระดับตัวชี้วัด
//                    $this->db->select("tb_kpi_score as KpiScore,id as course_kpi_id")->from("tb_kpi_score");
//                    $this->db->where("tb_unit_learning_id", $rUnit['course_unit_id']);
//                    $MyKpiQ = $this->db->get()->result_array();
//                    $GetKpiScore = 0;
//                    foreach ($MyKpiQ as $rKpi) {
//                        //---- กวาดคะแนนระดับคะแนนเก็บในแต่ละตัวชี้วัด
//                        $this->db->select("tb_midterm_topic_score_maxscore as TopicScore,id as course_topic_id")->from("tb_midterm_topic_score");
//                        $this->db->where("tb_kpi_score_id", $rKpi['course_kpi_id']);
//                        $MyTopQ = $this->db->get()->result_array();
////                        $CountTop = count($MyTopQ);
//                        $SumStdScore = 0;
//                        $TopicPencent = 0;
//                        $SumTopicMax = 0;
//                        foreach ($MyTopQ as $rTop) {
//                            //---- กวาดคะแนนของเด็ก
//                            $this->db->select("tb_std_midterm_score_score as StdScore")->from("tb_std_midterm_score");
//                            $this->db->where("tb_midterm_topic_score_id", $rTop['course_topic_id']);
//                            $this->db->where("tb_student_base_id", $StdId);
//                            $MyStdScoreQ = $this->db->get()->row_array();
//                            $SumStdScore += $MyStdScoreQ['StdScore'];
//                            $SumTopicMax += $rTop['TopicScore'];
//                        }
//                        $SumTopicScore = ($SumStdScore / $SumTopicMax) * 100;
//                        $TopicPencent += $SumTopicScore;
//                    }
//                    $SumKpiScore = ($GetKpiScore) * 100;
//                    $SumUnitScore += $SumKpiScore;
//                }

    function get_std_course_kpi_score($StdId, $KpiId) {

        $rs = $this->My_model->get_where_row('tb_kpi_score', array('id' => $KpiId));
        $maxkpi = $rs['tb_kpi_score'];


        $rs = $this->My_model->get_where_order('tb_midterm_topic_score', array('tb_kpi_score_id' => $KpiId), 'id');
        $max_array = array();
        $i = 0;
        foreach ($rs as $r) {
            $max_array[$i] = $r['tb_midterm_topic_score_maxscore'];
            $i++;
        }


        $rs = $this->My_model->get_where_order('tb_std_midterm_score', array('tb_student_base_id' => $StdId), 'id');
        $score_array = array();
        $i = 0;
        foreach ($rs as $r) {
            $score_array[$i] = $r['tb_std_midterm_score_score'];
            $i++;
        }
        print("<P>KPI</P>");
        print_r($maxkpi);
        print_r($max_array);
        print_r($score_array);
        print_r($this->get_weighting_score($maxkpi, $max_array, $score_array));
        return $this->get_weighting_score($maxkpi, $max_array, $score_array);
    }

    function get_std_course_unit_score($StdId, $UnitId) {

        $rs = $this->My_model->get_where_row('tb_unit_learning', array('id' => $UnitId));
        $maxunit = $rs['tb_unit_learning_score'];

        $rsKPI = $this->My_model->get_where_order('tb_kpi_score', array('tb_unit_learning_id' => $rs['id']), 'id');
        $maxkpi_array = array();
        $kpiScore_array = array();
        $i = 0;
        foreach ($rsKPI as $rk) {
            $maxkpi_array[$i] = $rk['tb_kpi_score'];

            $KpiScore = $this->get_std_course_kpi_score($StdId, $rk['id']);
            $kpiScore_array[$i] = $KpiScore;


            $i++;
        }

        print("<P>Unit</P>");
        print_r($maxunit);
        print_r($maxkpi_array);
        print_r($kpiScore_array);
        print_r($this->get_weighting_score($maxunit, $maxkpi_array, $kpiScore_array));
        return $this->get_weighting_score($maxunit, $maxkpi_array, $kpiScore_array);
    }

    function get_std_course_mid_score($StdId, $courseId) {

        $rs = $this->My_model->get_where_row('tb_course', array('id' => $courseId));
        $midScore = $rs['tb_course_mid_score'];


        $rsUnit = $this->My_model->get_where_order('tb_unit_learning', array('tb_course_id' => $rs['id']), 'id');
        $maxUnit_array = array();
        $unitScore_array = array();
        $i = 0;
        foreach ($rsUnit as $rk) {
            $maxUnit_array[$i] = $rk['tb_unit_learning_score'];

            $UnitScore = $this->get_std_course_unit_score($StdId, $rk['id']);
            $unitScore_array[$i] = $UnitScore;


            $i++;
        }

//        print("<P>Mid</P>");
//        print_r($midScore);
//        print_r($maxUnit_array);
//        print_r($unitScore_array);
//        print_r($this->get_weighting_score($midScore, $maxUnit_array, $unitScore_array));
        return $this->get_weighting_score($midScore, $maxUnit_array, $unitScore_array);
    }

    function get_weighting_score($total, $max_array, $score_array) {
        $sum = 0;
        $rest = 0;
        foreach ($max_array as $r) {
            $sum += $r;
        }
        
        if ($sum != 0) {
            foreach ($score_array as $r) {
                //$rest += ($r * ($total / $sum));
                $rest += $r;
            }
        }
        
        if($rest !=0 && $sum!=0 ){
            $rest = $total *  ($rest/$sum);
        }


        return round($rest);
    }

}
