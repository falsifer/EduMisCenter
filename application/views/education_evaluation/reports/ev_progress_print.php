<?php

include_once APPPATH . '/third_party/mpdf/mpdf.php';
$mpdf = new mPDF('th', 'A4-P', '0', '0', '10', '5', '30', '5');
$stylesheet = file_get_contents(base_url("assets/css/mpdf.css"));
$mpdf->WriteHTML($stylesheet, 1);
$mpdf->SetDisplayMode('fullpage');
//------------------------------------------------------------------------------
$mpdf->SetHTMLHeader("<div class='header header-top'>การส่งเสริม-สนับสนุน กำกับติดตาม และประเมินผลคุณภาพสถานศึกษาในสังกัด</div>"
        . "<div class='header header-top'>ขั้นตอนการดำเนินงาน</div>");
$mpdf->SetHTMLFooter("<hr/>"
        . "<table style='width:100%;'>"
        . "<tr>"
        . "<td style='width:33%;'>ระบบการบริหารจัดการศึกษาอิเลคทรอนิกส์ 4.0 (eSchool 4.0)</td>"
        . "<td style='width:33%;text-align:center;'>หน้าที่ {PAGENO}</td>"
        . "<td style='width:33%;'>" . $this->session->userdata('department') . nbs(3) . $this->session->userdata('localgov') . "</td>"
        . "</tr>"
        . "</table>"
        . "");
//------------------------------------------------------------------------------
$content ="<hr/>";
$content .= "<table class='table'>"
        . "<thead>"
        . "<tr>"
        . "<th style='width:50px;'>ที่</th>"
        . "<th style='width:120px;'>วัน/เดือน/ปี</th>"
        . "<th style='width:310px;'>การดำเนินงาน</th>"
        . "<th style='width:180px;'>ผู้ดำเนินงาน</th>"
        . "<th>หมายเหตุ</th>"
        . "</tr>"
        . "</thead>";
$content .= "<tbody>";
//
$row = 1;
foreach ($rs as $r) {
    $content .= "<tr>";
    $content .= "<td style='text-align:center;'>{$row}</td>"
            . "<td>" . datethai($r['progress_date']) . "</td>"
            . "<td>{$r['progress_detail']}</td>"
            . "<td>{$r['progress_person']}</td>"
            . "<td>{$r['progress_comment']}</td>";
    $content .= "</tr>";
    $row++;
}
//
$content .= "</tbody>";
$content .= "</table>";
//
$mpdf->WriteHTML($content);
$mpdf->Output();
