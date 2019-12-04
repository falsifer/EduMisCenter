<?php
 include_once APPPATH.'/third_party/mpdf/mpdf.php';
$mpdf = new mPDF('th', 'A4-P', '0', '0', '15', '15', '20', '5');
$stylesheet = file_get_contents(base_url("assets/css/mpdf.css"));
$mpdf->WriteHTML($stylesheet, 1);
$mpdf->SetDisplayMode('fullpage');
//------------------------------------------------------------------------------
$mpdf->SetHTMLHeader("<div class='header header-top'>ข้อมูลบุคลากร ประวัติการรับราชการ</div>");
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
        . "<th>วัน/เดือน/ปี</th>"
        . "<th>หน่วยงาน</th>"
        . "<th>ตำแหน่ง</th>"
        . "<th>ระดับ</th>"
        . "<th>ระดับเงินเดือน (บาท)</th>"        
        . "</tr>"
        . "</thead>"
        . "<tbody>";
$row = 1;
foreach ($rs as $r) {
    $content .= "<tr>"
            . "<td style='text-align:center;'>{$row}</td>"
            . "<td>{$r['hr05_day']} " . month_num($r['hr05_month']) . " {$r['hr05_year']}</td>"
            . "<td>{$r['hr05_office']}</td>"
            . "<td>{$r['hr05_rank']}</td>"
            . "<td>{$r['hr05_level']}</td>"
            . "<td>". number_format($r['hr05_salary'],2,'.',',')."</td>"
            . "</tr>";
    $row++;
}
$content .= "</tbody></table>";

//
$mpdf->WriteHTML($content);
$mpdf->Output();
