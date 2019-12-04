<?php
 include_once APPPATH.'/third_party/mpdf/mpdf.php';

$mpdf = new mPDF('th', 'A4-L', '0', '0', '15', '15', '20', '5');
$stylesheet = file_get_contents(base_url("assets/css/mpdf.css"));
$mpdf->WriteHTML($stylesheet, 1);
$mpdf->SetDisplayMode('fullpage');
//------------------------------------------------------------------------------
$mpdf->SetHTMLHeader("<div class='header header-top'>ข้อมูลบุคลากร ประวัติการฝึกอบรม-ศึกษาดูงาน</div>");
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
        . "<th>จากวันที</th>"
        . "<th>ถึงวันที่</th>"
        . "<th>สถานที่</th>"
        . "<th>เรื่อง/รายละเอียด</th>"
        . "<th>จังหวัด</th>"
        . "<th>ประเทศ</th>"
        . "<th>หมายเหตุ</th>"        
        . "</tr>"
        . "</thead>"
        . "<tbody>";
$row = 1;
foreach ($rs as $r) {
    $content .= "<tr>"
            . "<td style='text-align:center;'>{$row}</td>"
            . "<td>{$r['hr07_begin_day']} ". month_num($r['hr07_begin_month']).nbs(2)."{$r['hr07_begin_year']}</td>"
            . "<td>{$r['hr07_end_day']} ". month_num($r['hr07_end_month']).nbs(2)."{$r['hr07_end_year']}</td>"
            . "<td>{$r['hr07_place']}</td>"
            . "<td>{$r['hr07_topic']}</td>"
            . "<td>{$r['hr07_province']}</td>"
            . "<td>{$r['hr07_country']}</td>"
            . "<td>{$r['hr07_comment']}</td>"
            . "</tr>";
    $row++;
}
$content .= "</tbody></table>";

//
$mpdf->WriteHTML($content);
$mpdf->Output();
