<?php
include_once APPPATH . '/third_party/mpdf/mpdf.php';
$mpdf = new mPDF('th', 'A4-P', '0', '0', '10', '5', '35', '5');
$stylesheet = file_get_contents(base_url("assets/css/mpdf.css"));
$mpdf->WriteHTML($stylesheet, 1);
$mpdf->SetDisplayMode('fullpage');
//------------------------------------------------------------------------------
$mpdf->SetHTMLHeader("<div class='header header-top'>ข้อมูลประชาสัมพันธ์งานการศึกษา</div>"
        . "<div class='header header-middle'>หน่วยดำเนินการ: {$rs['pr_department']} ประชาสัมพันธ์ ณ วันที่ " . datethai($rs['pr_date']) . "</div><hr/>");
$mpdf->SetHTMLFooter("<hr/>"
        . "<table style='width:100%;'>"
        . "<tr>"
        . "<td style='width:33%;'>ระบบการบริหารจัดการศึกษาอิเลคทรอนิกส์ 4.0 (eSchool 4.0)</td>"
        . "<td style='width:33%;text-align:center;'>หน้าที่ {PAGENO}</td>"
        . "<td style='width:33%;'>".$this->session->userdata('department').nbs(3).$this->session->userdata('localgov')."</td>"
        . "</tr>"
        . "</table>"
        . "");
//------------------------------------------------------------------------------
$content = "<table class='table'>";
$content .= "<tbody>";
$content .= "<tr>"
        . "<td class='topic'>หัวข้อการประชาสัมพันธ์</td><td class='data'>{$rs['pr_topic']}</td>"
        . "</tr>"
        . "<tr>"
        . "<td class='topic'>รายละเอียด</td><td class='data'>{$rs['pr_detail']}</td>"
        . "</tr><tr><td class='topic'>ภาพประชาสัมพันธ์</td><td class='data'>";

if (file_exists('upload/' . $rs['pr_image_1']) && !empty($rs['pr_image_1'])) {
    $content .= img(array('src' => base_url() . 'upload/' . $rs['pr_image_1'], 'style' => 'width:220px;height:180px;border:1px solid #666;')).nbs(5);
}
if (file_exists('upload/' . $rs['pr_image_2']) && !empty($rs['pr_image_2'])) {
    $content .= img(array('src' => base_url() . 'upload/' . $rs['pr_image_2'], 'style' => 'width:220px;height:180px;border:1px solid #666;')).nbs(5);
}
if (file_exists('upload/' . $rs['pr_image_3']) && !empty($rs['pr_image_3'])) {
    $content .= img(array('src' => base_url() . 'upload/' . $rs['pr_image_3'], 'style' => 'width:220px;height:180px;border:1px solid #666;')).nbs(5);
}
if (file_exists('upload/' . $rs['pr_image_4']) && !empty($rs['pr_image_4'])) {
    $content .= img(array('src' => base_url() . 'upload/' . $rs['pr_image_4'], 'style' => 'width:220px;height:180px;border:1px solid #666;')).nbs(5);
}
$content .= "</td></tr>";
$content .= "</tbody>";
$content .= "</table>";
//
$mpdf->WriteHTML($content);
$mpdf->Output();
