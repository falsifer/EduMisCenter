<?php
 include_once APPPATH.'/third_party/mpdf/mpdf.php';

$mpdf = new mPDF('th', 'A4-P', '0', '0', '15', '15', '20', '5');
$stylesheet = file_get_contents(base_url("assets/css/mpdf.css"));
$mpdf->WriteHTML($stylesheet, 1);
$mpdf->SetDisplayMode('fullpage');
//------------------------------------------------------------------------------
$mpdf->SetHTMLHeader("<div class='header header-top'>ข้อมูลบุคลากร ข้อมูลที่อยู่</div>");
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
$content .= "<h2>{$human['hr_thai_symbol']}{$human['hr_thai_name']}&nbsp;&nbsp;{$human['hr_thai_lastname']}</h2>";
$content .= "<h2>ที่อยู่ตามบัตรประชาชน</h2>"
        . "<table class='table'>"
        . "<tr>"
        . "<td class='topic'>ที่อยู่เลขที่</td><td class='data'>";
$content .= $rs['hr_address_no'] . nbs(2);
$content .= $rs['hr_address_moo'] != '' ? ' หมู่ที่ ' . $rs['hr_address_moo'] : ' - ';
$content .= $rs['hr_address_village'] != '' ? ' หมู่บ้าน ' . $rs['hr_address_village'] : ' - ';
$content .= "</td></tr>";

$content .= "<tr>";
$content .= "<td class='topic'>ถนน</td>";
$content .= "<td class='data'>";
$content .= $rs['hr_address_street'];
$content .= "</td>";
$content .= "</tr>";

$content .= "<tr>";
$content .= "<td class='topic'>ตำบล</td>";
$content .= "<td class='data'>";
$content .= $rs['hr_address_tambon'];
$content .= "</td>";
$content .= "</tr>";

$content .= "<tr>";
$content .= "<td class='topic'>อำเภอ</td>";
$content .= "<td class='data'>";
$content .= $rs['hr_address_amphur'];
$content .= "</td>";
$content .= "</tr>";

$content .= "<tr>";
$content .= "<td class='topic'>จังหวัด</td>";
$content .= "<td class='data'>";
$content .= $rs['hr_address_province'];
$content .= "</td>";
$content .= "</tr>";

$content .= "<tr>";
$content .= "<td class='topic'>รหัสไปรษณีย์</td>";
$content .= "<td class='data'>";
$content .= $rs['hr_address_zipcode'];
$content .= "</td>";
$content .= "</tr>";

$content .= "<tr>";
$content .= "<td class='topic'>หมายเลขโทรศัพท์</td>";
$content .= "<td class='data'>";
$content .= $rs['hr_address_telephone'];
$content .= "</td>";
$content .= "</tr>";

$content .= "<tr>";
$content .= "<td class='topic'>พิกัดตำแหน่ง</td>";
$content .= "<td class='data'>";
$content .= $rs['hr_address_lat'] . ' / ' . $rs['hr_address_long'];
$content .= "</td>";
$content .= "</tr>";

$content .= "</table>";

$content .= "<h2>ที่อยู่ที่ติดต่อได้สะดวก</h2>"
        . "<table class='table'>"
        . "<tr>"
        . "<td class='topic'>ที่อยู่เลขที่</td><td class='data'>";
$content .= $rs['hr_address_no'] . nbs(2);
$content .= $rs['hr_address_moo'] != '' ? ' หมู่ที่ ' . $rs['hr_address_moo'] : ' - ';
$content .= $rs['hr_address_village'] != '' ? ' หมู่บ้าน ' . $rs['hr_address_village'] : ' - ';
$content .= "</td></tr>";

$content .= "<tr>";
$content .= "<td class='topic'>ถนน</td>";
$content .= "<td class='data'>";
$content .= $rs['hr_address_street'];
$content .= "</td>";
$content .= "</tr>";

$content .= "<tr>";
$content .= "<td class='topic'>ตำบล</td>";
$content .= "<td class='data'>";
$content .= $rs['hr_address_tambon'];
$content .= "</td>";
$content .= "</tr>";

$content .= "<tr>";
$content .= "<td class='topic'>อำเภอ</td>";
$content .= "<td class='data'>";
$content .= $rs['hr_address_amphur'];
$content .= "</td>";
$content .= "</tr>";

$content .= "<tr>";
$content .= "<td class='topic'>จังหวัด</td>";
$content .= "<td class='data'>";
$content .= $rs['hr_address_province'];
$content .= "</td>";
$content .= "</tr>";

$content .= "<tr>";
$content .= "<td class='topic'>รหัสไปรษณีย์</td>";
$content .= "<td class='data'>";
$content .= $rs['hr_address_zipcode'];
$content .= "</td>";
$content .= "</tr>";

$content .= "<tr>";
$content .= "<td class='topic'>หมายเลขโทรศัพท์</td>";
$content .= "<td class='data'>";
$content .= $rs['hr_address_telephone'];
$content .= "</td>";
$content .= "</tr>";

$content .= "<tr>";
$content .= "<td class='topic'>พิกัดตำแหน่ง</td>";
$content .= "<td class='data'>";
$content .= $rs['hr_address_lat'] . ' / ' . $rs['hr_address_long'];
$content .= "</td>";
$content .= "</tr>";

$content .= "</table>";

//
$mpdf->WriteHTML($content);
$mpdf->Output();
