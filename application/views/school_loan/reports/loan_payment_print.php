<?php

include_once APPPATH . '/third_party/mpdf/mpdf.php';
$mpdf = new mPDF('th', 'A4-P', '0', '0', '10', '5', '28', '5');
$stylesheet = file_get_contents(base_url("assets/css/mpdf.css"));
$mpdf->WriteHTML($stylesheet, 1);
$mpdf->SetDisplayMode('fullpage');
//------------------------------------------------------------------------------
$mpdf->SetHTMLHeader("<div class='header header-top'>ข้อมูลการเบิกจ่ายงบประมาณ</div>"
        . "<div class='header header-middle'>ประเภทงบประมาณ: {$payment['loan_group']} จำนวนเงิน: " . number_format($payment['loan_amount'], 2, '.', ',') . " บาท ประจำปีงบประมาณ {$payment['loan_year']}</div>");
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
        . "<th>วัน/เดือน/ปี</th>"
        . "<th>เลขที่สำคัญ</th>"
        . "<th>จำนวนเงิน</th>"
        . "<th>ผู้รับเงิน</th>"
        . "</tr>"
        . "</thead>";
$content .= "<tbody>";
$row = 1;
foreach ($rs as $r) {
    $content .= "<tr>"
            . "<td>{$row}</td>"
            . "<td>" . datethai($r['payment_date']) . "</td>"
            . "<td>{$r['payment_no']}</td>"
            . "<td>" . number_format($r['payment_amount'], 2, '.', ',') . "</td>"
            . "<td>{$r['payment_reciever']}</td>"
            . "</tr>";
    $row++;
}
$content .= "</tbody>"
        . "<tfoot>"
        . "<tr style='background-color:#eaeaea;'>"
        . "<td colspan='3' style='text-align:center;font-weight:bold;'>รวมเป็นเงิน</td>"
        . "<td>" . number_format($amount['payment_amount'], 2, '.', ',') . "</td>"
        . "<td></td>"
        . "</tr>"
        . "</tfoot>";
$content .= "</table>";
//
$mpdf->WriteHTML($content);
$mpdf->Output();
