<?php

include_once APPPATH . '/third_party/mpdf/mpdf.php';
//$this->load->library('mpdf/mpdf');
$mpdf = new mPDF('th', 'A4-L', '0', '0', '15', '15', '25', '5');
$stylesheet = file_get_contents(base_url("assets/css/mpdf.css"));
$mpdf->WriteHTML($stylesheet, 1);
$mpdf->SetDisplayMode('fullpage');
//------------------------------------------------------------------------------
$mpdf->SetHTMLHeader(""
        . "<div class='header header-middle'>ข้อมูลการกำหนดงบประมาณตั้งไว้สำหรับ{$title['sc_thai_name']}</div>"
        . "<div class='header header-middle'>ประจำปีงบประมาณ ".  loan_year(date('Y'))."</div>"
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
        . "<th style='width:40px;'>ที่</th>"
        . "<th>ปีงบประมาณ</th>"
        . "<th style='width:110px;'>หมวด</th>"
        . "<th>ประเภท</th>"
        . "<th>รายการ</th>"
        . "<th>งบประมาณที่ตั้งไว้ (บาท)</th>"
        . "</tr>"
        . "</thead>";
$row = 1;
foreach ($rs as $r) {
    $content .="<tr>"
            . "<td style='text-align:center;'>{$row}</td>"
            . "<td style='text-align:center;'>{$r['loan_year']}</td>"
            . "<td>{$r['loan_category']}</td>"
            . "<td>{$r['loan_type']}</td>"
            . "<td>{$r['loan_define']}</td>"
            . "<td style='text-align:right;'>" . number_format($r['loan_begin'], 2, '.', ',') . "</td>"
            . "</tr>";
    $row++;
}
$content.= "</table>";
//
$mpdf->WriteHTML($content);
$mpdf->Output();
