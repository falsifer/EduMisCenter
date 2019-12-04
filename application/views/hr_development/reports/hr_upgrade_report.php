<?php

include_once APPPATH . '/third_party/mpdf/mpdf.php';
$mpdf = new mPDF('th', 'A4-P', '0', '0', '10', '5', '25', '5');
$stylesheet = file_get_contents(base_url("assets/css/mpdf.css"));
$mpdf->WriteHTML($stylesheet, 1);
$mpdf->SetDisplayMode('fullpage');
//------------------------------------------------------------------------------
$mpdf->SetHTMLHeader("<div class='header header-top'>รายงานข้อมูลการพัฒนาข้าราชการครูและบุคลากรทางการศึกษา</div>");
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
$content = "<table class='table'>"
        . "<thead>"
        . "<tr>"
        . "<th>ที่</th>"
        . "<th>วันที่ดำเนินงาน</th>"
        . "<th>ชื่อกิจกรรม/โครงการ</th>"
        . "<th>สถานที่</th>"
        . "<th>ระยะเวลา (วัน)</th>"
        . "<th>จำนวน (คน)</th>"
        . "<th>งบประมาณ (บาท)</th>"
        . "</tr>"
        . "</thead>";
$content .= "<tbody>";
$row = 1;
foreach ($rs as $r) {
    $content .= "<tr>"
            . "<td style='text-align:center;'>{$row}</td>"
            . "<td>" . datethai($r['upgrade_date']) . "</td>"
            . "<td>{$r['upgrade_topic']}</td>"
            . "<td>{$r['upgrade_place']}</td>"
            . "<td>{$r['upgrade_days']}</td>"
            . "<td>{$r['upgrade_amount']}</td>"
            . "<td>" . number_format($r['upgrade_loan'], 2, '.', ',') . "</td>"
            . "</tr>";
    $row++;
}
$content .= "</tbody>";
$content .= "<tfoot>"
        . "<tr style='background-color:#ebebeb;'>"
        . "<td colspan='4' style='text-align:center;font-weight:bold;'>รวมทั้งสิ้น</td>"
        . "<td>" . $days['upgrade_days'] . "</td>"
        . "<td>" . $person['upgrade_amount'] . "</td>"
        . "<td>" . number_format($loan['upgrade_loan'], 2, '.', ',') . "</td>"
        . "</tr>"
        . "</tfoot>";
$content .= "</table>";
//
$mpdf->WriteHTML($content);
$mpdf->Output();
