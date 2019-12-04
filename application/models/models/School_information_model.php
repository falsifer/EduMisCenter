
<?php

class School_information_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function count_std_gender_by_class($class, $stdstatus, $gender) {
        $this->db->select("*")->from("tb_student_base a");
        $this->db->join("tb_ed_classroom b", "b.tb_student_base_id = a.id");
        $this->db->join("tb_ed_room c", "c.id = b.tb_ed_room_id");

//        $this->db->where('a.tb_student_base_status', $stdstatus);
        $this->db->where('c.tb_ed_school_register_class_id', $class);
        $this->db->where('a.std_gender', $gender);
        $MyQ = $this->db->get()->result_array();

        return count($MyQ);
    }

    function count_std_bloodtype_by_class($class, $stdstatus, $bloodtype) {
        $this->db->select("*")->from("tb_student_base a");
        $this->db->join("tb_ed_classroom b", "b.tb_student_base_id = a.id");
        $this->db->join("tb_ed_room c", "c.id = b.tb_ed_room_id");

//        $this->db->where('a.tb_student_base_status', $stdstatus);
        $this->db->where('c.tb_ed_school_register_class_id', $class);
        $this->db->where('a.std_bloodtype', $bloodtype);
        $MyQ = $this->db->get()->result_array();

        return count($MyQ);
    }

    function Generate_My_Column_Chart($ChartHeight, $ChartWidth, $IndexLabel, $Array1, $Array2) {
        if (!$ChartHeight) {
            $ChartHeight = 300;
        }
        if (!$ChartWidth) {
            $ChartWidth = 80;
        }

        $stdstatus = "S";

        $output .= "<center>";
        $output .= "<div style='width: 100%;margin-top:20px;margin-right:200px; '>";
        $output .= "<div id='chartcolumn' style='height: " . $ChartHeight . "px; width: " . $ChartWidth . "%; '></div>";
        $output .= "</div>";
        $output .= "</center>";

        $output .= "<script>";
        $output .= "function chart() {";

        $output .= "var chartcolumn = {";
        $output .= "exportEnabled: false,";
        $output .= "animationEnabled: true,";
        $output .= "data: [";

        foreach ($Array1 as $r1) {
            $output .= "{type: 'column',";
            $output .= "indexLabel: '{y} " . $IndexLabel . "',";
            $output .= "dataPoints: [";
            foreach ($Array2 as $r2) {

                $count = $this->School_information_model->count_std_gender_by_class($r2['ClassId'], $stdstatus, $r1['tb_setting_gender_name']);

                $output .= "{y: " . $count . ", name: '" . $r1['tb_setting_gender_name'] . "', label: '" . $r2['tb_ed_school_class_abbreviation'] . "." . $r2['tb_ed_school_class_level'] . "'},";
            }
            $output .= "]},";
        }

        $output .= "]";
        $output .= "};";
        $output .= "$('#chartcolumn').CanvasJSChart(chartcolumn);";

        $output .= "}";
        $output .= "</script>";
    }

    function count_std_nationality_by_class($class, $stdstatus, $parameter) {

        $this->db->select("*")->from("tb_student_base a");
        $this->db->join("tb_ed_classroom b", "b.tb_student_base_id = a.id");
        $this->db->join("tb_ed_room c", "c.id = b.tb_ed_room_id");

//        $this->db->where('a.tb_student_base_status', $stdstatus);
        $this->db->where('c.tb_ed_school_register_class_id', $class);
        $this->db->where('a.std_nationality', $parameter);
        $MyQ = $this->db->get()->result_array();

        return count($MyQ);
    }

    function get_class_by_regisclass_id($id) {
        $this->db->select("*")->from("tb_ed_school_register_class a");
        $this->db->join("tb_ed_school_class b", "b.id = a.tb_ed_school_class_id");
        $this->db->where('a.id', $id);
        $MyQ = $this->db->get()->row_array();
        if (count($MyQ) > 0) {
            return $MyQ;
        } else {
            return false;
        }
    }

    function get_class_by_edyear($edyear, $department) {
        $this->db->select("*,a.id as id")->from("tb_ed_school_register_class a");
        $this->db->join("tb_ed_school_class b", "b.id = a.tb_ed_school_class_id");
        $this->db->where('a.tb_ed_school_register_class_edyear', $edyear);
        $this->db->where('a.tb_ed_school_register_class_department', $department);
        $this->db->order_by("b.id asc");

        $MyQ = $this->db->get()->result_array();

        if (count($MyQ) > 0) {
            return $MyQ;
        } else {
            return false;
        }
    }

    public function gen_chart_student_base($classarray, $GArray, $Column, $StdColumn, $Head) {
        $stdstatus = "S";
        $ChartType = "column";

        $output = "";
        $output .= "<legend>" . $Head . "</legend>";
        $output .= "<br/>";

        $output .= "<center>";
        $output .= "<div style='width: 100%;margin-top:20px;margin-right:200px; '>";
        $output .= "<div id='chartcolumn' style='height: 300px; width: 80%; '></div>";
        $output .= "</div>";
        $output .= "</center>";

        $output .= "<script>";
        $output .= "function MySchoolChart() {";

        $output .= "var chartcolumn = {";
        $output .= "exportEnabled: true,";
        $output .= "animationEnabled: false,";
        $output .= "data: [";

        foreach ($GArray as $g) {
            $countwhere = $g[$Column];

            $output .= "{type: '" . $ChartType . "',";
            $output .= "indexLabel: '{y} คน',";
            $output .= "dataPoints: [";

            foreach ($classarray as $cr) {
                $RowClass = $this->School_information_model->get_class_by_regisclass_id($cr);
                $count = $this->School_information_model->count_std_by_class($cr, $stdstatus, array($StdColumn => $g[$Column]));
                $output .= "{y: " . $count . ", name: '" . $countwhere . "', label: '" . $RowClass['tb_ed_school_class_abbreviation'] . "." . $RowClass['tb_ed_school_class_level'] . "'},";
            }

            $output .= "]},";
        }

        $output .= "]";
        $output .= "};";
        $output .= "$('#chartcolumn').CanvasJSChart(chartcolumn);";

        $output .= "}";
        $output .= "</script>";



        $output .= "<div style='width: 85%;margin:auto;margin-top:20px'>";
        $output .= "<table class='table table-bordered display' style='width: 100%;'>";
        $output .= "<thead>";
        $output .= "<tr  style='height:70px;background: whitesmoke !important ;height: 10px;'> ";
        $output .= "<th  style='width:50%;text-align: center;' rowspan='2'>ระดับชั้น</th>";
        $output .= "<th  style='width:50%;text-align: center;' colspan='10'>จำนวนนักเรียนทั้งหมด</th>";
        $output .= "</tr>";

        $output .= "<tr style='height:70px;background: whitesmoke;height: 10px;'>  ";

        foreach ($GArray as $g) {
            $output .= "<th style='width:12%;text-align: center;'>" . $g[$Column] . "</th>";
        }

        $output .= "<th style='width:12%;text-align: center;'>รวม</th>";
        $output .= "</tr>";
        $output .= "</thead>";
        $output .= " <tbody>";

        foreach ($classarray as $cr) {
            $RowClass = $this->School_information_model->get_class_by_regisclass_id($cr);
            $output .= "<tr style='height: 30px;'>";
            $output .= "<td style='width:50%;text-align: center;'><div class='btn btn-link' style='font-size:1em;'>" . $RowClass['tb_ed_school_class_name'] . "ปีที่ " . $RowClass['tb_ed_school_class_level'] . "</div></td>";

            $sum = 0;

            foreach ($GArray as $g) {
                $count = $this->School_information_model->count_std_by_class($cr, $stdstatus, array($StdColumn => $g[$Column]));
                $output .= "<td style='width:12%;text-align: center;'>" . $count . "</td> ";
                $sum += $count;
            }

            $output .= "<td style='width:12%;text-align: center;'>" . $sum . "</td> ";
            $output .= "</tr>";
        }

        $output .= "</tbody>";
        $output .= "</table>";
        $output .= "</div> ";

        return $output;
    }

    function count_std_by_class($class, $stdstatus, $where) {
        $this->db->select("*")->from("tb_student_base a");
        $this->db->join("tb_ed_classroom b", "b.tb_student_base_id = a.id");
        $this->db->join("tb_ed_room c", "c.id = b.tb_ed_room_id");
        $this->db->where('c.tb_ed_school_register_class_id', $class);
        $this->db->where($where);
        $MyQ = $this->db->get()->result_array();
        return count($MyQ);
    }

}
