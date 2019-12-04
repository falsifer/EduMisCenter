<?php
 include_once APPPATH.'/third_party/mpdf/mpdf.php';

$mpdf = new mPDF('th', 'A4-P', '0', '0', '15', '15', '20', '5');
$stylesheet = file_get_contents(base_url("assets/css/mpdf.css"));
$mpdf->WriteHTML($stylesheet, 1);
$mpdf->SetDisplayMode('fullpage');
//------------------------------------------------------------------------------
$mpdf->SetHTMLHeader("<div class='header header-top'>ข้อมูลบุคลากร ประวัติการรับเครื่องราชอิสริยาภรณ์</div>");
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
        . "<th>เครื่องราชอิสริยาภรณ์</th>"
        . "<th>ชนิดแพรแถบ</th>"
        . "</tr>"
        . "</thead>"
        . "<tbody>";
$row = 1;
foreach ($rs as $r) {
    $content .= "<tr>"
            . "<td style='text-align:center;width:55px;'>{$row}</td>"
            . "<td style='width:22%;'>{$r['hr13_day']} " . month_num($r['hr13_month']) . "&nbsp;&nbsp;{$r['hr13_year']}</td>"
            . "<td>{$r['hr13_insignia']}</td>"
            . "<td style='text-align:center;'>";
    if (file_exists('upload/' . $r['insignia_label_image']) && !empty($r['insignia_label_image'])) {
        $content .= img(array('src' => 'upload/' . $r['insignia_label_image'], 'style' => 'width:110px;height:35px;'));
    }
    $content .= "</td></tr>";
    $row++;
}
$content .= "</tbody></table>";
//
$mpdf->WriteHTML($content);
$mpdf->Output();
