<?php

class Icare_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function get_all_absent() {
        $date = date('Y') + 543 . date('-m-d');
        $this->db->select('tb_student_absent_record_status,count(*) as pnt');
        $this->db->from('tb_std_absent_record');
        $this->db->where('tb_std_absent_record_date', $date);
        $this->db->where("tb_student_absent_record_department",$this->session->userdata('department'));
        $this->db->group_by('tb_student_absent_record_status');
        $query = $this->db->get();
        if ($query->num_rows() != 0) {
            return $query->result_array();
        }
        return array();
    }
    
    
    function get_absent_by_class() {
        $date = date('Y') + 543 . date('-m-d');
        $this->db->select('a.tb_student_absent_record_status,count(*) as pnt');
        $this->db->from('tb_std_absent_record a');
        $this->db->join('tb_student_base b','a.tb_student_base_id=b.id');
        $this->db->where('a.tb_std_absent_record_date', $date);
        $this->db->where("a.tb_student_absent_record_department",$this->session->userdata('department'));
        $this->db->group_by('a.tb_student_absent_record_status');
        $query = $this->db->get();
        if ($query->num_rows() != 0) {
            return $query->result_array();
        }
        return array();
    }
    
    
    

    function get_std_gender_stat() {

        $this->db->select("f.tb_ed_school_class_name as class,f.tb_ed_school_class_level as lev,a.std_gender as std_gender, count(a.std_gender) as pnt");
        $this->db->from("tb_student_base a");
        $this->db->join("tb_ed_classroom b", "b.tb_student_base_id = a.id");
        $this->db->join("tb_ed_room c", "c.id = b.tb_ed_room_id");
        $this->db->join("tb_ed_school_register_class d", "d.id = c.tb_ed_school_register_class_id");

        $this->db->join("tb_ed_school_class f", "f.id = d.tb_ed_school_class_id");
        $this->db->where("a.tb_student_base_status", "S");
        $this->db->where("d.tb_ed_school_register_class_edyear", intval(date('Y') + 542));
        $this->db->where("tb_student_base_department", $this->session->userdata('department'));
        $this->db->group_by('f.tb_ed_school_class_name,f.tb_ed_school_class_level,a.std_gender');
        $MyQ = $this->db->get();
        if ($MyQ->num_rows() > 0) {
            return $MyQ->result_array();
        }
        return array();
    }

    function checkCompleteSDQ($std_id, $assessor, $term, $edyear) {

        $this->db->select('count(*) as num');
        $this->db->from('tb_std_icare_sdq_score');
        $this->db->where(array(
            'tb_student_base_id' => $std_id,
            'tb_std_icare_sdq_score_assessor' => $assessor,
            'tb_std_icare_sdq_score_term' => $term,
            'tb_std_icare_sdq_score_edyear' => $edyear
        ));
        $rs = $this->db->get()->row_array();


        $this->db->select('count(*) as num');
        $this->db->from('tb_icare_sdq');
        $this->db->where(array(
            'tb_icare_sdq_department' => $this->session->userdata('department')
        ));
        $rsT = $this->db->get()->row_array();
        
        
        if ($rsT['num'] == $rs['num']) {
            return true;
        } else {
            return false;
        }
    }

    function getSDQChart($Assessor, $StdId, $term, $edyear) {

        $this->db->select('tb_sdq_type,sum(tb_std_icare_sdq_score_score) as pnt');
        $this->db->from('tb_std_icare_sdq_score a');
        $this->db->join('tb_icare_sdq b', 'a.tb_icare_sdq_id = b.id');
        $this->db->join('tb_icare_sdq_type c', 'b.tb_icare_sdq_type = c.id');
        $this->db->join('tb_student_base d', 'a.tb_student_base_id = d.id');

        $this->db->where('a.tb_std_icare_sdq_score_assessor', $Assessor);
        $this->db->where('a.tb_std_icare_sdq_score_term', $term);
        $this->db->where('a.tb_std_icare_sdq_score_edyear', $edyear);
        $this->db->where('a.tb_student_base_id', $StdId);
        $this->db->group_by('tb_sdq_type');

        $rs = $this->db->get()->result_array();

        $output = "";
        $output .= "<center>";
        $output .= "<div style='width: 80%;margin-top:20px;height: 230px;  '>";
        $output .= "<div id='chartcolumn' style='height: 230px;'></div>";
        $output .= "</div>";
        $output .= "</center>";



        $output .= "<script>";
//        $output .= "function chart() {";

        $output .= "var chartcolumn = {";
        $output .= "exportEnabled: false,";
        $output .= "animationEnabled: true,";
        $output .= "data: [";
        $output .= "{type: 'column',";
        $output .= "indexLabel: '{name} ',";
        $output .= "dataPoints: [";
        foreach ($rs as $r) {
            $tmp = $this->SDQClustering($Assessor,$r['tb_sdq_type'],$r['pnt']);
            $output .= "{y: " . $r['pnt'] . ", name: '" . $tmp . "', label: '" . $r['tb_sdq_type']  . "',";
            if($tmp=="ปกติ"){
                $output .= "color: \"green\"   },";
            }else if($tmp=="เสี่ยง"){
                $output .= "color: \"orange\"   },";
            }else if($tmp=="มีปัญหา"){
                $output .= "color: \"red\"   },";
            }else{
                $output .= "},";
            }
        }
        $output .= "]},";

        $output .= "]";
        $output .= "};";
        $output .= "$('#chartcolumn').CanvasJSChart(chartcolumn);";

//        $output .= "}";
        $output .= "</script>";
        return $output;
    }

    function SDQClustering($assessor, $sdqType, $pnt) {
        $rs = $this->My_model->get_where_row('tb_icare_sdq_type', array('tb_sdq_type_department' => $this->session->userdata('department'), 'tb_sdq_type' => $sdqType));

        if ($assessor != 'Student') {
            $n = explode("-", $rs['tb_sdq_normal']);
            $r = explode("-", $rs['tb_sdq_risk']);
            $p = explode("-", $rs['tb_sdq_problem']);
        } else {
            $n = explode("-", $rs['tb_sdq_sar_normal']);
            $r = explode("-", $rs['tb_sdq_sar_risk']);
            $p = explode("-", $rs['tb_sdq_sar_problem']);
        }

        $sq = 'if(' . $pnt . ' BETWEEN ' . $n[0] . ' and ' . $n[count($n) - 1] . ',"ปกติ",';
        $sq .= 'if( ' . $pnt . ' BETWEEN ' . $r[0] . ' and ' . $r[count($r) - 1] . ',"เสี่ยง",';
        $sq .= 'if( ' . $pnt . ' BETWEEN ' . $p[0] . ' and ' . $p[count($p) - 1] . ',"มีปัญหา",""))) as cluster';

        $this->db->select($sq);
        $this->db->from('tb_icare_sdq_type');
        $rest = $this->db->get()->row_array();
        
        return $rest['cluster'];
        
    }

}
