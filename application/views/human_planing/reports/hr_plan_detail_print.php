<?php

include_once APPPATH . '/third_party/mpdf/mpdf.php';
//$this->load->library('mpdf/mpdf');
$mpdf = new mPDF('th', 'A4-L', '0', '0', '15', '15', '25', '5');
$stylesheet = file_get_contents(base_url("assets/css/mpdf.css"));
$mpdf->WriteHTML($stylesheet, 1);
$mpdf->SetDisplayMode('fullpage');
//------------------------------------------------------------------------------
//
$mpdf->SetHTMLHeader(""
        . "<div class='header header-top'>กรอบอัตรากำลัง " . count($year) . " ปี</div>"
        . "<div class='header header-middle' style='text-align:left;'>หน่วยดำเนินการ : " . $this->session->userdata('department') . "</div>"
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

$content = ""
        . "<table class='table'>"
        . "<thead>"
        . "<tr>"
        . "<th>ที่</th>"
        . "<th>พ.ศ.</th>"
        . "<th>ตำแหน่ง</th>"
        . "<th>ระดับ</th>"
        . "<th>กรอบอัตรากำลังเดิม</th>"
        . "<th>ปรับเพิ่ม</th>"
        . "<th>ปรับลด</th>"
        . "<th>รวมเป็น</th>"
        . "<th>หมายเหตุ</th>"
        . "</tr>"
        . "</thead>"
        . "<tbody>";

$row = 1;
foreach ($rs as $r) {
    $content .= "<tr>"
            . "<td style='text-align:center;'>{$row}</td>"
            . "<td>{$r['plan_year']}</td>"
            . "<td>{$r['rank_name']}</td>"
            . "<td style='text-align:center;'>{$r['level']}</td>"
            . "<td style='text-align:center;'>{$r['old_hr']}</td>";
    $content .= $r['increase'] != 0 ? "<td style='text-align:center;'>{$r['increase']}</td>" : "<td></td>";
    $content .= $r['decrease'] != 0 ? "<td style='text-align:center;'>{$r['decrease']}</td>" : "<td></td>";
    $content .= $r['result'] != 0 ? "<td style='text-align:center;'>{$r['result']}</td>" : "<td></td>";
    $content .= "<td>{$r['comment']}</td>";
    $content .= "</tr>";
    $row++;
}
if($row<10){
    for($i=1;$i<=10;$i++){
        $content .="<tr>"
                . "<td>&nbsp;</td>"
                . "<td>&nbsp;</td>"
                . "<td>&nbsp;</td>"
                . "<td>&nbsp;</td>"
                . "<td>&nbsp;</td>"
                . "<td>&nbsp;</td>"
                . "<td>&nbsp;</td>"
                . "<td>&nbsp;</td>"
                . "<td>&nbsp;</td>"
                . "</tr>";
    }
}
$content .= "</tbody>"
        . "</table>";
//
$mpdf->WriteHTML($content);
$mpdf->Output();
