<?php
 include_once APPPATH.'/third_party/mpdf/mpdf.php';

$mpdf = new mPDF('th', 'A4-L', '0', '0', '15', '15', '20', '5');
$stylesheet = file_get_contents(base_url("assets/css/mpdf.css"));
$mpdf->WriteHTML($stylesheet, 1);
$mpdf->SetDisplayMode('fullpage');
//------------------------------------------------------------------------------
$mpdf->SetHTMLHeader("<div class='header header-top'>ข้อมูลบุคลากร ข้อมูลใบประกอบวิชาชีพ</div>");
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
        . "<th>เลขประจำตัว</th>"
        . "<th>ประเภท</th>"
        . "<th>เลขที่ใบประกอบวิชาชีพ</th>"
        . "<th>วัน/เดือน/ปี เริ่มต้น</th>"
        . "<th>วัน/เดือน/ปี สิ้นสุด</th>"
        . "<th>ใบประกอบวิชาชีพ</th>"
        . "<th>หมายเหตุ</th>"
        . "</tr>"
        . "</thead>"
        . "<tbody>";
$row = 1;
foreach ($rs as $r) {
    $content .= "<tr>"
            . "<td style='text-align:center;width:55px;'>{$row}</td>"
            . "<td>{$r['hr10_id']}</td>"
            . "<td>{$r['hr10_type']}</td>"
            . "<td>{$r['hr10_no']}</td>"
            . "<td>{$r['hr10_begin_day']} " . month_num($r['hr10_begin_month']) . "&nbsp;&nbsp;{$r['hr10_begin_year']}</td>"
            . "<td>{$r['hr10_end_day']} " . month_num($r['hr10_end_month']) . "&nbsp;&nbsp;{$r['hr10_end_year']}</td>";
    if (file_exists('upload/' . $r['hr10_image']) && !empty($r['hr10_image'])) {
        $content .= "<td>" . img(array('src' => 'upload/' . $r['hr10_image'], 'style' => 'width:180px;height:120px;')) . "</td>";
    }
    $content .= "<td>{$r['hr10_comment']}</td></tr>";
    $row++;
}
$content .= "</tbody></table>";

//
$mpdf->WriteHTML($content);
$mpdf->Output();
