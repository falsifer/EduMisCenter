<?php
 include_once APPPATH.'/third_party/mpdf/mpdf.php';

$mpdf = new mPDF('th', 'A4-P', '0', '0', '15', '15', '20', '5');
$stylesheet = file_get_contents(base_url("assets/css/mpdf.css"));
$mpdf->WriteHTML($stylesheet, 1);
$mpdf->SetDisplayMode('fullpage');
//------------------------------------------------------------------------------
$mpdf->SetHTMLHeader("<div class='header header-top'>ข้อมูลบุคลากร ข้อมูลครอบครัว</div>");
$mpdf->SetHTMLFooter("<hr/>"
        . "<table style='width:100%;'>"
        . "<tr>"
        . "<td style='width:45%;'>ระบบการบริหารจัดการศึกษาอิเลคทรอนิกส์ 4.0 (eSchool 4.0)</td>"
        . "<td style='width:25%;text-align:center;'>หน้าที่ {PAGENO}</td>"
        . "<td style='width:33%;'>" . $this->session->userdata('department') . nbs(3) . $this->session->userdata('localgov') . "</td>"
        . "</tr>"
        . "</table>"
        . "");
//------------------------------------------------------------------------------
$content = "";
// ข้อมูลทั่วไปประกอบ
$content .= "<h2>Name: {$human['hr_thai_symbol']}{$human['hr_thai_name']}&nbsp;&nbsp;{$human['hr_thai_lastname']}</h2>";
$content .= ""
        . "<table class='table'>"
        . "<thead>"
        . "<tr>"
        . "<th>ที่</th>"
        . "<th>ชื่อ-นามสกุล"
        . "<th>วัน/เดือน/ปี เกิด</th>"
        . "<th>ความสัมพันธ์</th>"
        . "<th>ระดับการศึกษา</th>"
        . "<th>สถานะภาพ</th>"
        . "<th>อาชีพ</th>"
        . "</tr>"
        . "</thead>"
        . "<tbody>";
$row = 1;
foreach ($rs as $r) {
    $content .= "<tr>"
            . "<td style='text-align:center;'>{$row}</td>"
            . "<td>{$r['prefix_name']}{$r['hr03_name']}" . nbs(3) . "{$r['hr03_lastname']}</td>"
            . "<td>{$r['hr03_day_birthday']} " . month_num($r['hr03_month_birthday']) . " {$r['hr03_year_birthday']}</td>"
            . "<td>{$r['hr03_relationship']}</td>"
            . "<td>{$r['hr03_education']}</td>"
            . "<td>{$r['hr03_status']}</td>"
            . "<td>{$r['hr03_career']}</td>"
            . "</tr>";
    $row++;
}
$content .= "</tbody></table>";

//
$mpdf->WriteHTML($content);
$mpdf->Output();
