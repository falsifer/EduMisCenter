<?php

include_once APPPATH . '/third_party/mpdf/mpdf.php';
//$this->load->library('mpdf/mpdf');
$mpdf = new mPDF('th', 'A4-P', '0', '0', '15', '15', '25', '5');
$stylesheet = file_get_contents(base_url("assets/css/mpdf.css"));
$mpdf->WriteHTML($stylesheet, 1);
$mpdf->SetDisplayMode('fullpage');
//------------------------------------------------------------------------------
$mpdf->SetHTMLHeader(""
        . "<div class='header header-top'>รายงานการประเมินผลการปฏิบัติงาน</div>"
        . "<hr/>");
$mpdf->SetHTMLFooter(""
        . "<hr/>"
        . "<table style='width:100%;'>"
        . "<tr>"
        . "<td style='width:70%;color:#333;'><b>โปรแกรมบริหารจัดการศึกษาอิเลคทรอนิกส์ eSchool 4.0 (2018)</b></td>"
        . "<td style='color:#333;text-align:right;'>หน้าที่ {PAGENO}</td>"
        . "</tr>"
        . "</table>"
        . "");
//------------------------------------------------------------------------------

$content = ""
        . "<table class='table'>"
        . "<tr>"
        . "<td class='topic' style='width:20%;'>ชื่อ-นามสกุล</td><td class='data'>{$hr['hr_thai_symbol']}{$hr['hr_thai_name']}&nbsp;&nbsp;{$hr['hr_thai_lastname']}</td>"
        . "<td class='topic' style='width:20%;'>ตำแหน่ง</td><td class='data'>{$hr['hr_rank']}</td>"
        . "</tr>"
        . "<tr>"
        . "<td class='topic' style='width:20%;'>ระดับเงินเดือน</td><td class='data'>" . number_format($hr['salary'], 0, '.', ',') . " บาท</td>"
        . "<td class='topic' style='width:20%;'>สังกัด</td><td class='data'>{$hr['hr_office']}</td>"
        . "</tr>"
        . "</table>";


$content .= "<table class='table' style='margin-top:10px;'>"
        . "<thead>"
        . "<tr>"
        . "<th style='width:40px;'></th>"
        . "<th>รายการประเมิน</th>"
        . "<th style='width:120px;'>คะแนนเต็ม</th>"
        . "<th style='width:120px;'>คะแนนที่ได้</th>"
        . "</tr>"
        . "</thead>"
        . "<tbody>";
$line = 1;
foreach ($assessment_group as $group) {
    $content .= "<tr>"
            . "<td style='text-align:center;font-weight:bold;'>{$line}</td>"
            . "<td style='font-weight:bold;'>{$group['assessment_group_name']}</td>"
            . "<td></td>"
            . "<td></td>"
            . "</tr>";
    $topic = $this->My_model->get_where_order('tb_human_assessment_topic', array('group_id' => $group['id']), 'id asc');
    $row = 1;
    foreach ($topic as $r) {
        $content .= "<tr>"
                . "<td></td>"
                . "<td>" . nbs(5) . $line . "." . $row . nbs(2) . "{$r['assessment_topic_name']}</td>"
                . "<td style='text-align:center;'>{$r['assessment_topic_score']}</d>";
        $score = $this->My_model->get_where_row('tb_human_assessment_activities', array('assessment_topic_id' => $r['id']));
        if ($type == "แบบฟอร์ม") {
            $content .= "<td></td></tr>";
        } else {
            $content .= "<td style='text-align:center;'>{$score['assessment_score']}</d>"
                    . "</tr>";
        }

        $row++;
    }
    $line++;
}
$content .= "</tbody>"
        . "<tfoot>"
        . "<tr style='background:#ebebeb;'>"
        . "<td colspan='3' style='text-align:center;font-weight:bold;'>รวมคะแนน</td>"
        . "<td style='text-align:center;'>" . $total_score['assessment_score'] . "</td>"
        . "</tr>"
        . "</tfoot>"
        . "</table>";

//
$mpdf->WriteHTML($content);
$mpdf->Output();
