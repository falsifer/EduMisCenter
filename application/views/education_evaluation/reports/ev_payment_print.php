<?php

include_once APPPATH . '/third_party/mpdf/mpdf.php';
$mpdf = new mPDF('th', 'A4-L', '0', '0', '10', '5', '30', '5');
$stylesheet = file_get_contents(base_url("assets/css/mpdf.css"));
$mpdf->WriteHTML($stylesheet, 1);
$mpdf->SetDisplayMode('fullpage');
//------------------------------------------------------------------------------
$mpdf->SetHTMLHeader("<div class='header header-top'>การส่งเสริม-สนับสนุน กำกับติดตาม และประเมินผลคุณภาพสถานศึกษาในสังกัด</div>"
        . "<div class='header header-top'>ค่าใช้จ่ายในการดำเนินงาน</div>");
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
$content = "<hr/>";
$content .= "<table class='table'>"
        . "<thead>"
        . "<tr>"
        . "<th style='width:50px;'>ที่</th>"
        . "<th>วัน/เดือน/ปี</th>"
        . "<th>รายการ</th>"
        . "<th>หน่วยนับ</th>"
        . "<th>จำนวน</th>"
        . "<th>หน่วยละ (บาท)</th>"
        . "<th>รวมเป็นเงิน (บาท)</th>"
        . "<th>หมายเหตุ</th>"
        . "</tr>"
        . "</thead>";
$content .= "<tbody>";
//
$row = 1;
foreach ($rs as $r) {
    $content .= "<tr>";
    $content .= "<td style='text-align:center;'>{$row}</td>"
            . "<td>" . datethai($r['payment_date']) . "</td>"
            . "<td>{$r['payment_detail']}</td>"
            . "<td>{$r['unit_name']}</td>"
            . "<td>" . number_format($r['payment_amount'], 2, '.', ',') . "</td>"
            . "<td>" . number_format($r['payment_cost'], 2, '.', ',') . "</td>"
            . "<td>" . number_format($r['payment_total'], 2, '.', ',') . "</td>"
            . "<td>{$r['payment_comment']}</td>"
            . "";
    $content .= "</tr>";
    $row++;
}
//
$content .= "</tbody>";
$content .="<tfoot>"
        . "<tr>"
        . "<td colspan='6' style='text-align:center;'><b>รวมทั้งสิ้น</b></td>"
        . "<td>". number_format($sum_cost['payment_total'],2,'.',',')."</td>"
        . "<td></td>"
        . "</tr>"
        . "</tfoot>";

$content .= "</table>";
//
$mpdf->WriteHTML($content);
$mpdf->Output();
