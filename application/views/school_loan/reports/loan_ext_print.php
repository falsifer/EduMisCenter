// mpdf template
<?php
include_once APPPATH . '/libraries/mpdf/mpdf.php';
$mpdf = new mPDF('th', 'A4-L', '0', '0', '10', '10', '30', '5');
$stylesheet = file_get_contents(base_url("assets/css/mpdf.css"));
$mpdf->WriteHTML($stylesheet, 1);
$mpdf->SetDisplayMode('fullpage');
//------------------------------------------------------------------------------
$page = "{PAGENO}";
$mpdf->SetHTMLHeader("<div class='header header-top'>ข้อมูลการจัดสรรงบประมาณให้สถานศึกษาที่ขอรับการสนับสนุน</div>"
        . "<div class='header header-middle'>ประปีการศึกษา " . thaidigit(loan_year(date('Y'))) . "</div>");

$mpdf->SetHTMLFooter(""
        . "<hr/>"
        . "<table style='width:100%;'>"
        . "<tr>"
        . "<td style='width:70%;color:#333;'>โปรแกรมบริหารจัดการศึกษาอิเลคทรอนิกส์ eSchool 4.0 (2018)</td>"
        . "<td style='color:#333;text-align:right;'>หน้าที่ {PAGENO} จาก {nb}</td>"
        . "</tr>"
        . "</table>"
        . "");
//------------------------------------------------------------------------------

$content = "<table class='table'>"
        . "<thead>"
        . "<tr>"
        . "<th style='width:40px;'>ที่</th>"
        . "<th>วัน/เดือน/ปี</th>"
        . "<th style='width:25%;'>ชื่อโครงการ</th>"
        . "<th>ประเภทโครงการ</th>"
        . "<th>งบประมาณ</th>"
        . "<th>สถานที่ดำเนินงาน</th>"
        . "<th>โรงเรียน</th>"
        . "<th>ผู้ประสานงาน/โทรศัพท์</th>"
        . "</tr>"
        . "</thead>";

$content .= "<tbody>";
$row = 1;
foreach ($rs as $r) {
    $content .= "<tr>"
            . "<td style='text-align:center;'>{$row}</td>"
            . "<td>" . shortdate($r['ext_date']) . "</td>"
            . "<td>{$r['ext_name']}</td>"
            . "<td>{$r['ext_type']}</td>"
            . "<td>" . number_format($r['ext_loan'], 2, '.', ',') . "</td>"
            . "<td>{$r['ext_place']}</td>"
            . "<td>{$r['ext_school']}</td>"
            . "<td>" . $r['ext_coordinator'] . ' (' . $r['ext_coordinator_mobile'] . " )</td>"
            . "</tr>";
    $row++;
}
$content .= "</tbody>";

$content .= "</table>";

//
$mpdf->WriteHTML($content);
$mpdf->Output();
