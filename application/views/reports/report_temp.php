<?php
include_once APPPATH . '/third_party/mpdf/mpdf.php';
//$this->load->library('mpdf/mpdf');
$mpdf = new mPDF('th', 'A4-P', '0', '0', '15', '15', '25', '5');
$stylesheet = file_get_contents(base_url("assets/css/mpdf.css"));
$mpdf->WriteHTML($stylesheet, 1);
$mpdf->SetDisplayMode('fullpage');
//------------------------------------------------------------------------------
$mpdf->SetHTMLHeader(""
        . "<div class='header header-middle'>ตารางภาพรวมการนิเทศการจัดการเรียนการสอน</div>"
        . "<hr/>");
$mpdf->SetHTMLFooter(""
        . "<hr/>"
        . "<table style='width:100%;'>"
        . "<tr>"
        . "<td style='width:70%;color:#333;'><b>โปรแกรมบริหารจัดการศึกษาอิเลคทรอนิกส์ eSchool 4.0 (2018)</b></td>"
        . "<td style='color:#333;text-align:right;'>หน้าที่ {PAGENO}</td>"
        . "</tr>"
        . "</table>"
        . "");
//------------------------------------------------------------------------------

$content =""
        . "<table class='table'>"
        . "<thead>"
        . "<tr>"
        . "<th>ที่</th>"
        . "<th>ปีการศึกษา</th>"
        . "<th>เทอมที่</th>"
        . "<th>โรงเรียนเป้าหมาย</th>"
        . "<th>กลุ่มสาระการเรียนรู้</th>"
        . "</tr>"
        . "</thead>";
$row=1;
foreach($rs as $r){
    $content .="<tr>"
            . "<td style='text-align:center;'>{$row}</td>"
            . "<td style='text-align:center;'>{$r['loan_year']}</td>"
            . "<td style='text-align:center;'>{$r['loan_term']}</td>"
            . "<td>{$r['school_name']}</td>"
            . "<td>{$r['learning_group']}</td>"
            . "</tr>";
    $row++;
}
        $content.= "</table>";
//
$mpdf->WriteHTML($content);
$mpdf->Output();
