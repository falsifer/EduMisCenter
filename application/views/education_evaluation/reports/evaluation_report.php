<?php

include_once APPPATH . '/third_party/mpdf/mpdf.php';
$mpdf = new mPDF('th', 'A4-P', '0', '0', '15', '5', '30', '5');
$stylesheet = file_get_contents(base_url("assets/css/mpdf.css"));
$mpdf->WriteHTML($stylesheet, 1);
$mpdf->SetDisplayMode('fullpage');
//------------------------------------------------------------------------------
$mpdf->SetHTMLHeader(""
        . "<table style='width:100%;'>"
        . "<tr>"
        . "<td style='width:33%;'></td>"
        . "<td style='width:33%;font-size:24px;text-align:center;font-weight:bold;'>รายงานการส่งเสริม สนับสนุน กำกับติดตามและประเมินผลคุณภาพทางการศึกษา</td>"
        . "<td style='width:33%;text-align:right;'>พิมพ์รายงาน ณ วันที่ " . datethai(date('Y-m-d')) . "</td>"
        . "</tr>"
        . "</table>"
        . "");

$mpdf->SetHTMLFooter(""
        . "<table style='width:100%;'>"
        . "<tr>"
        . "<td style='width:33%;'>โปรแกรมบริหารจัดการสารสนเทศ eSchool 4.0 (2018)</td>"
        . "<td style='width:33%;text-align:right;font-size:16px;'>หน้าที่ {PAGENO}</td>"
        . "</tr>"
        . "</table>");
//------------------------------------------------------------------------------

$content .= ""
        . "<table style='width:100%;'>"
        . "<tr>"
        . "<td class='topic'>วันที่ดำเนินการ</td><td class='data'>" . datethai($rs['ev_date']) . "</td>"
        . "</tr>"
        . "<tr>"
        . "<td class='topic'>การดำเนินการ</td><td class='data'>{$rs['ev_topic']}</td>"
        . "</tr>"
        . "<tr>"
        . "<td class='topic'>ประเภทการดำเนินการ</td><td class='data'>{$rs['ev_type']}</td>"
        . "</tr>"
        . "<tr>"
        . "<td class='topic'>ดำเนินการที่</td><td class='data'>{$rs['sc_thai_name']}</td>"
        . "</tr>"
        . "<tr>"
        . "<td class='topic'>รายละเอียด</td><td class='data'>{$rs['ev_detail']}</td>"
        . "</tr>"
        . "<tr>"
        . "<td class='topic'>ภาพประกอบ</td><td class='data'>";
if (file_exists('upload/' . $rs['ev_image1']) && !empty($rs['ev_image1'])) {
    $content .= img(array('src' => base_url() . 'upload/' . $rs['ev_image1'], 'style' => 'width:200px;height:180px;')) . nbs(5);
}

if (file_exists('upload/' . $rs['ev_image2']) && !empty($rs['ev_image2'])) {
    $content .= img(array('src' => base_url() . 'upload/' . $rs['ev_image2'], 'style' => 'width:200px;height:180px;')) . nbs(5);
}
if (file_exists('upload/' . $rs['ev_image3']) && !empty($rs['ev_image3'])) {
    $content .= img(array('src' => base_url() . 'upload/' . $rs['ev_image3'], 'style' => 'width:200px;height:180px;')) . nbs(5);
}
if (file_exists('upload/' . $rs['ev_image4']) && !empty($rs['ev_image4'])) {
    $content .= img(array('src' => base_url() . 'upload/' . $rs['ev_image4'], 'style' => 'width:200px;height:180px;')) . nbs(5);
}
$content .= "</td>"
        . "</tr>"
        . "</table>"
        . "";

//
$mpdf->WriteHTML($content);
$mpdf->Output();
