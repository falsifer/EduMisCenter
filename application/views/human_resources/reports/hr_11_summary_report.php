<?php
 include_once APPPATH.'/third_party/mpdf/mpdf.php';

$mpdf = new mPDF('th', 'A4-P', '0', '0', '15', '15', '20', '5');
$stylesheet = file_get_contents(base_url("assets/css/mpdf.css"));
$mpdf->WriteHTML($stylesheet, 1);
$mpdf->SetDisplayMode('fullpage');
//------------------------------------------------------------------------------
$mpdf->SetHTMLHeader("<div class='header header-top'>ข้อมูลบุคลากร สรุปข้อมูลการลาทุกประเภท/การปฏิบัติงาน</div>");
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
        . "<th>รายการลา/การปฏิบัติงาน</th>"
        . "<th>จำนวน (ครั้ง)</th>"
        . "</tr>"
        . "</thead>"
        . "<tbody>";
$row = 1;
$arr = array('มาสาย', 'ลาป่วย', 'ลากิจ', 'ขาด', 'ไปราชการ', 'ลาพักผ่อน', 'ลาคลอด', 'ลาบวช/ฮัจช์', 'ลาศึกษาต่อ');
for ($i = 0; $i < count($arr); $i++) {
    $content .= "<tr>"
            . "<td style='width:55px;'>{$row}</td>"
            . "<td>{$arr[$i]}</td>";
// ไม่ควรเขียนไว้ตรงนี้
    $count_type = $this->Hr_model->count_hr11_type($human['id'], $arr[$i]);
    $content .= $count_type != 0 ? "<td style='text-align:center;'>" . $count_type . "</td>" : "<td></td>";
    $content .= "</tr>";
    $row++;
}
$content .= "</tbody></table>";

//
$mpdf->WriteHTML($content);
$mpdf->Output();
