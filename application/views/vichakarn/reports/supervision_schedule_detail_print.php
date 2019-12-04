<?php

include_once APPPATH . '/third_party/mpdf/mpdf.php';
//$this->load->library('mpdf/mpdf');
$mpdf = new mPDF('th', 'A4-P', '0', '0', '15', '15', '33', '5');
$stylesheet = file_get_contents(base_url("assets/css/mpdf.css"));
$mpdf->WriteHTML($stylesheet, 1);
$mpdf->SetDisplayMode('fullpage');
//------------------------------------------------------------------------------
$mpdf->SetHTMLHeader(""
        . "<div class='header header-top'>รายละเอียดแผนการนิเทศการจัดการเรียนการสอน</div>"
        . "<div class='header header-middle' style='text-align:left;'>หน่วยดำเนินการ: ".$this->session->userdata('department')."</div>"
        . "<div class='header header-middle' style='text-align:left;'>เทอมที่ {$schedule['loan_term']} ปีการศึกษา {$schedule['loan_year']} {$schedule['learning_group']} / {$schedule['school_name']}</div>"
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
        . "<thead>"
        . "<tr>"
        . "<th rowspan='2' style='width:40px;'>ที่</th>"
        . "<th rowspan='2' style='width:150px;'>วัน เดือน ปี</th>"
        . "<th colspan='3'>รายการนิเทศ/สังเกตการสอน</th>"
        . "<th rowspan='2'>ผู้รับการนิเทศ</th>"
        . "<th rowspan='2'>ผู้นิเทศ</th>"
        . "</tr>"
        . "<tr>"
        . "<th>ระดับชั้น</th>"
        . "<th>รหัสวิชา</th>"
        . "<th>ชื่อวิชา</th>"
        . "</tr>"
        . "</thead>";
$row = 1;
$line = 1;
foreach ($rs as $r) {
    $content .= "<tr>"
            . "<td style='text-align:center;'>{$row}</td>"
            . "<td style='text-align:center;'>" . datethai($r['schedule_date']) . "</td>"
            . "<td style='text-align:center;'>{$r['education_level']}</td>"
            . "<td>{$r['subject_code']}</td>"
            . "<td>{$r['subject_name']}</td>"
            . "<td>{$r['teacher_name']}</td>"
            . "<td>{$r['supervision_name']}</td>"
            . "</tr>";
    $row++;
    $line++;
}
if ($line < 10) {
    for ($i = 1; $i <= 10; $i++) {
        $content .= "<tr>"
                . "<td>&nbsp;</td>"
                . "<td></td>"
                . "<td></td>"
                . "<td></td>"
                . "<td></td>"
                . "<td></td>"
                . "<td></td>"
                . "</tr>";
    }
}

$content .= "</table>";
//
$mpdf->WriteHTML($content);
$mpdf->Output();
