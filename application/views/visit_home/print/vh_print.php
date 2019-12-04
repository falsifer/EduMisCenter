<?php
 include_once APPPATH.'/third_party/mpdf/mpdf.php';
$mpdf = new mPDF('th', 'A4-P', '0', '0', '15', '10', '15', '5');
$stylesheet = file_get_contents(base_url("assets/css/mpdf.css"));
$mpdf->WriteHTML($stylesheet, 1);
$mpdf->SetDisplayMode('fullpage');
//------------------------------------------------------------------------------
$mpdf->SetHTMLHeader("<div class='header header-top'>ข้อมูลแหล่งเรียนรู้ภายในท้องถิ่น</div>");
$mpdf->SetHTMLFooter(" <div style='text-align:center;color:#666;font-size:16px;'>{PAGENO}</div>");
//------------------------------------------------------------------------------
$content .= "<div class='header header-middle' style='text-align:left;'>ข้อมูลทั่วไป</div>";
$content .= "<table class='table'>";
$content .= "<tbody>";
$content .= ""
        . "<tr>"
        . "<td class='topic'>ชื่อแหล่งเรียนรู้</td><td class='data'>{$rs['km_name']}</td>"
        . "</tr>"
        . "<tr>"
        . "<td class='topic'>ประเภทแหล่งเรียนรู้</td><td class='data'>{$rs['km_type']}</td>"
        . "</tr>"
        . "<tr>"
        . "<td class='topic'>ชนิดแหล่งเรียนรู้</td><td class='data'>{$rs['km_kind']}</td>"
        . "</tr>"
        . "<tr>"
        . "<td class='topic'>ที่อยู่</td><td class='data'>เลขที่ {$rs['km_add_no']} หมู่ที่ " . $rs['km_add_moo'];

$content .= $rs['km_add_village'] != '' ? ' หมู่บ้าน ' . $rs['km_add_village'] : ' หมู่บ้าน - ';
$content .= $rs['km_add_road'] != '' ? ' ถนน.' . $rs['km_add_road'] : ' ถนน. - ';
$content .= ' ตำบล ' . $rs['km_add_tambon'] . ' อำเภอ ' . $rs['km_add_amphur'] . ' จังหวัด ' . $rs['km_add_province'] . ' รหัสไปรษณีย์ ' . $rs['km_add_zipcode'];
$content .= ' โทรศัพท์ ' . $rs['km_phone'] . ' อีเมล์ ' . $rs['km_email'] . ' เวบไซต์ ' . $rs['km_website'];
$content .= "</td>"
        . "</tr>"
        . "";
$content .= "</tbody>";
$content .= "</table>";
// ประวัติแหล่งเรียนรู้
$content .= "<div class='header header-middle' style='text-align:left;'>ประวัติแหล่งเรียนรู้</div>";
$content .= "<table class='table'>";
$content .= "<tbody>";
$content .= ""
        . "<tr><td>{$rs['km_history']}</td></tr>";
$content .= "</tbody>";
$content .= "</table>";

// ประโยชน์แหล่งเรียนรู้
$content .= "<div class='header header-middle' style='text-align:left;'>ประโยชน์แหล่งเรียนรู้</div>";
$content .= "<table class='table'>";
$content .= "<tbody>";
$content .= "<tr><td>";
if(!empty($rs['km_benefit'])){
    $content .=$rs['km_benefit'];
}else{
    $content .="<center>## ไม่มีข้อมูล ##</center>"; 
}
$content .= "</td></tr>";
$content .= "</tbody>";
$content .= "</table>";
// ภาพประกอบ
$content .= "<div class='header header-middle' style='text-align:left;'>ภาพประกอบแหล่งเรียนรู้</div>";
$content .= "<table class='table'>";
$content .= "<tbody>";
$content .= "<tr><td style='border:none;'>";
if(file_exists('upload/'.$rs['km_image_1']) && !empty($rs['km_image_1'])){
    $content .= img(array('src'=>'upload/'.$rs['km_image_1'],'style'=>'width:220px;height:190px;border:1px solid #000;padding:8px;')).nbs(3);
}
if(file_exists('upload/'.$rs['km_image_2']) && !empty($rs['km_image_2'])){
    $content .= img(array('src'=>'upload/'.$rs['km_image_2'],'style'=>'width:220px;height:190px;border:1px solid #000;padding:8px;')).nbs(3);
}
if(file_exists('upload/'.$rs['km_image_3']) && !empty($rs['km_image_3'])){
    $content .= img(array('src'=>'upload/'.$rs['km_image_3'],'style'=>'width:220px;height:190px;border:1px solid #000;padding:8px;')).nbs(3);
}
if(file_exists('upload/'.$rs['km_image_4']) && !empty($rs['km_image_4'])){
    $content .= img(array('src'=>'upload/'.$rs['km_image_4'],'style'=>'width:220px;height:190px;border:1px solid #000;padding:8px;')).nbs(3);
}
$content .= "</td></tr>";
$content .= "</tbody>";
$content .= "</table>";

//
$mpdf->WriteHTML($content);
$mpdf->Output();
