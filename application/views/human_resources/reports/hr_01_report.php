<?php

include_once APPPATH . '/third_party/mpdf/mpdf.php';
$mpdf = new mPDF('th', 'A4-P', '0', '0', '25', '15', '20', '5');
$stylesheet = file_get_contents(base_url("assets/css/mpdf.css"));
$mpdf->WriteHTML($stylesheet, 1);
$mpdf->SetDisplayMode('fullpage');
//------------------------------------------------------------------------------
$mpdf->SetHTMLHeader("<div class='h3'>ประวัติบุคลากร</div>");
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
$content = "<img src='" . base_url('upload/' . $rs['hr_image']) . "' style='position:relative;width:120px;height:150px;float:right;margin: -16mm -10mm 0 -9cm' />";
$content .= br();
$content .= "<div class='h4'><b>ชื่อ-นามสกุล (ภาษาไทย)</b>" . nbs(3) . "{$rs['hr_thai_symbol']}{$rs['hr_thai_name']}" . nbs(3) . "{$rs['hr_thai_lastname']}" . br();
$content .= "<b>ชื่อ-นามสกุล (ภาษาอังกฤษ)</b>" . nbs(3) . "{$rs['hr_eng_symbol']}{$rs['hr_eng_name']}" . nbs(3) . "{$rs['hr_eng_lastname']}</div>" . br();

// ข้อมูลทั่วไป
$content .= "<hr/>";
$content .= "<div class='h4'><b>ข้อมูลทั่วไป</b></div>";
$content .= ""
        . "<table class='data-table'>"
        . "<tr>"
        . "<td class='topic'>วัน/เดือน/ปี เกิด</td><td class='data'>{$rs['hr_day_birthday']} " . month_num($rs['hr_month_birthday']) . " {$rs['hr_year_birthday']}</td>"
        . "<td class='topic'>อายุ</td><td class='data'>45 ปี</td>"
        . "<td class='topic'>เชื้อชาติ</td><td class='data'>{$rs['hr_origin']}</td>"
        . "</tr>"
        . "<tr>"
        . "<td class='topic'>สัญชาติ</td><td class='data'>{$rs['hr_nationality']}</td>"
        . "<td class='topic'>ศาสนา</td><td class='data'>{$rs['hr_religion']}</td>"
        . "<td class='topic'>เลขที่บัตรประชาชน</td><td class='data'>{$rs['hr_id_card']}</td>"
        . "</tr>"
        . "<tr>"
        . "<td class='topic'>สถานะภาพ</td><td class='data'>{$rs['hr_status']}</td>"
        . "<td class='topic'>ชื่อ-สกุลคู่สมรส</td><td class='data'>{$rs['hr_consort_name']}</td>"
        . "<td class='topic'>จำนวนบุตร</td><td class='data'>" . ($rs['hr_son_amount'] + $rs['hr_daugther_amount']) . "</td>"
        . "</tr>"
        . "<tr>"
        . "<td class='topic'>ชื่อ-สกุลบิดา</td><td class='data'>{$rs['hr_father_name']}</td>"
        . "<td class='topic'>ชื่อ-สกุลมารดา</td><td class='data'>{$rs['hr_mother_name']}</td>"
        . "<td class='topic'>โทรศัพท์มือถือ</td><td class='data'>{$rs['hr_mobile']}</td>"
        . "</tr>"
        . "<tr>"
        . "<td class='topic'>อีเมล์</td><td class='data'>{$rs['hr_email']}</td>"
        . "<td class='topic'>ตำแหน่งปัจจุบัน</td><td class='data'>{$rs['hr_rank']}</td>"
        . "<td class='topic'>สังกัดหน่วยงาน</td><td class='data'>{$rs['hr_office']}</td>"
        . "</tr>"
        . "</table>"
        . "";
$mpdf->WriteHTML($content);


$html_i = "<hr/>";
$html_i .= "<span class='h4'><b>ข้อมูลที่อยู่</b></span>"
        . "<table class='data-table'>"
        . "<tr>"
        . "<td class='topic'>บ้านเลขที่</td><td class='data'>{$hr02['hr_address_no']} หมู่ที่ {$hr02['hr_address_moo']}</td>"
        . "<td class='topic'>ถนน</td><td class='data'>{$hr02['hr_address_street']}</td>"
        . "<td class='topic'>ตำบล/แขวง</td><td class='data'>{$hr02['hr_address_tambon']}</td>"
        . "</tr>"
        . "<tr>"
        . "<td class='topic'>อำเภอ/เขต</td><td class='data'>{$hr02['hr_address_amphur']}</td>"
        . "<td class='topic'>จังหวัด</td><td class='data'>{$hr02['hr_address_province']}</td>"
        . "<td class='topic'>รหัสไปรษณีย์</td><td class='data'>{$hr02['hr_address_zipcode']}</td>"
        . "</tr>"
        . "<tr>"
        . "<td class='topic'>โทรศัพท์</td><td class='data'>{$hr02['hr_address_telephone']}</td>"
        . "<td class='topic'>พิกัดละติจูด</td><td class='data'>{$hr02['hr_address_lat']}</td>"
        . "<td class='topic'>พิกัดลองจิจูด</td><td class='data'>{$hr02['hr_address_long']}</td>"
        . "</tr>"
        . "</table>";
$mpdf->WriteHTML($html_i);

$html_ii = "<hr/>"
        . "<span class='h4'><b>ข้อมูลที่อยู่ที่ติดต่อได้สะดวก</b></span>"
        . "<table class='data-table'>"
        . "<tr>"
        . "<td class='topic'>บ้านเลขที่</td><td class='data'>{$hr02['tmp_address_no']} หมู่ที่ {$hr02['tmp_address_moo']}</td>"
        . "<td class='topic'>ถนน</td><td class='data'>{$hr02['tmp_address_street']}</td>"
        . "<td class='topic'>ตำบล/แขวง</td><td class='data'>{$hr02['tmp_address_tambon']}</td>"
        . "</tr>"
        . "<tr>"
        . "<td class='topic'>อำเภอ/เขต</td><td class='data'>{$hr02['tmp_address_amphur']}</td>"
        . "<td class='topic'>จังหวัด</td><td class='data'>{$hr02['tmp_address_province']}</td>"
        . "<td class='topic'>รหัสไปรษณีย์</td><td class='data'>{$hr02['tmp_address_zipcode']}</td>"
        . "</tr>"
        . "</table>";
$mpdf->WriteHTML($html_ii);

$mpdf->AddPage('L');
$html_iii = "<hr/>"
        . "<span class='h4'>ข้อมูลครอบครัว</span>"
        . "<table class='table'>"
        . "<thead>"
        . "<tr style='background:#ebebeb;'>"
        . "<td>ลำดับที่</td>"
        . "<td>ชื่อ-นามสกุล</td>"
        . "<td>วัน/เดือน/ปี เกิด</td>"
        . "<td>ความสัมพันธ์</td>"
        . "<td>ระดับการศึกษา</td>"
        . "<td>สถานะภาพ</td>"
        . "<td>อาชีพ</td>"
        . "</tr>"
        . "</thead>"
        . "<tbody>";
$row = 1;
foreach ($hr03 as $h03) {
    $html_iii .= "<tr>"
            . "<td style='text-align:center;'>{$row}</td>"
            . "<td>{$hr03['prefix_name']}{$h03['hr03_name']} {$h03['hr03_lastname']}</td>"
            . "<td>{$h03['hr03_day_birthday']} " . month_num($h03['hr03_month_birthday']) . " {$h03['hr03_year_birthday']}</td>"
            . "<td>{$h03['hr03_relationship']}</td>"
            . "<td>{$h03['hr03_education']}</td>"
            . "<td>{$h03['hr03_career']}</td>"
            . "<td>{$h03['hr03_status']}</td>"
            . "</tr>";
    $row++;
}
$html_iii .= "</tbody>"
        . "</table>";
$mpdf->WriteHTML($html_iii);

// ข้อมูลประวัติการศึกษา
$html_iv .= "<hr/>"
        . "<span class='h4'>ข้อมูลประวัติการศึกษา</span>"
        . "<table class='table'>"
        . "<tr style='background:#ebebeb;'>"
        . "<td>ลำดับที่</td>"
        . "<td>ปี พ.ศ.</td>"
        . "<td>ระดับการศึกษา</td>"
        . "<td>คณะวิชา</td>"
        . "<td>สาขาวิชา</td>"
        . "<td>สถาบันการศึกษา</td>"
        . "<td>หมายเหตุ</td>"
        . "</tr>";
$row = 1;
foreach ($hr15 as $h15) {
    $html_iv .= "<tr>"
            . "<td style='text-align:center;'>{$row}</td>"
            . "<td>{$h15['edu_year']}</td>"
            . "<td>{$h15['edu_level']}</td>"
            . "<td>{$h15['edu_group']}</td>"
            . "<td>{$h15['edu_branch']}</td>"
            . "<td>{$h15['edu_university']}</td>"
            . "<td>{$h15['edu_comment']}</td>"
            . "</tr>";
    $row++;
}
$html_iv .= "</table>";
$mpdf->WriteHTML($html_iv);

$mpdf->AddPage('L');
// ประวัติการรับราชการ
$html_v = "<hr/>"
        . "<span class='h4'>ประวัติการรับราชการ</span>"
        . "<table class='table'>"
        . "<tr style='background:#ebebeb;'>"
        . "<td>ลำดับที่</td>"
        . "<td>วัน/เดือน/ปี</td>"
        . "<td>หน่วยงาน</td>"
        . "<td>ตำแหน่ง</td>"
        . "<td>ระดับ</td>"
        . "<td>ขั้นเดือน</td>"
        . "<td>เอกสารอ้างอิง</td>"
        . "</tr>";
$row = 1;
foreach ($hr05 as $h05) {
    $html_v .= "<tr>"
            . "<td style='text-align:center;'>{$row}</td>"
            . "<td>{$h05['hr05_day']} " . month_num($h05['hr05_month']) . " {$h05['hr05_year']}</td>"
            . "<td>{$h05['hr05_office']}</td>"
            . "<td>{$h05['hr05_rank']}</td>"
            . "<td>{$h05['hr05_level']}</td>"
            . "<td>" . number_format($h05['hr05_salary'], 2, '.', ',') . "</td>";
    //
    if (file_exists($h05['hr05_file']) && !empty($hr05['hr05_file'])) {
        $html_v .= "<td>ระบุเอกสารอ้างอิง</td>";
    } else {
        $html_v .= "<td>ไม่ระบุเอกสารอ้างอิง</td>";
    }
    $hrml_v .= "</tr>";
    $row++;
}
$html_v .= "</table>";
$mpdf->WriteHTML($html_v);

// ประวัติการปฏิบัติงาน
$html_vi = "<hr/>"
        . "<span class='h4'>ประวัติการปฏิบัติงาน</span>"
        . "<table class='table'>"
        . "<tr style='background:#ebebeb;'>"
        . "<td>ลำดับที่</td>"
        . "<td>วัน/เดือน/ปี</td>"
        . "<td>ตำแหน่ง/ปฏิบัติหน้าที่</td>"
        . "<td>หน่วยงาน</td>"
        . "<td>ระยะเวลา</td>"
        . "</tr>";
$row = 1;
foreach ($human_resources_04 as $hr04) {
    $html_vi .= "<tr>"
            . "<td>{$row}</td>"
            . "<td>{$hr04['hr04_day']} " . month_num($hr04['hr04_month']) . " {$hr04['hr04_year']}</td>"
            . "<td>{$hr04['hr04_rank']} / {$hr04['hr04_operation']}</td>"
            . "<td>{$hr04['hr04_organization']}</td>"
            . "<td>{$hr04['hr04_long']}</td>"
            . "</tr>";
}
$html_vi .= "</table>";
$mpdf->WriteHTML($html_vi);

// ประวัติการสอน
$mpdf->AddPage('L');
$html_vii = "<hr/>"
        . "<span class='h4'>ประวัติการสอน</span>"
        . "<table class='table'>"
        . "<tr style='background:#ebebeb;'>"
        . "<td>ลำดับที่</td>"
        . "<td>วัน/เดือน/ปี</td>"
        . "<td>ตำแหน่ง/ปฏิบัติหน้าที่</td>"
        . "<td>หน่วยงาน</td>"
        . "<td>ระยะเวลา</td>"
        . "</tr>";
$row = 1;
foreach ($human_resources_06 as $hr06) {
    $html_vii .= "<tr>"
            . "<td>{$row}</td>"
            . "<td>{$hr06['hr04_day']} " . month_num($hr06['hr04_month']) . " {$hr06['hr04_year']}</td>"
            . "<td>{$hr06['hr04_rank']} / {$hr06['hr04_operation']}</td>"
            . "<td>{$hr06['hr04_organization']}</td>"
            . "<td>{$hr06['hr04_long']}</td>"
            . "</tr>";
}
$html_vii .= "</table>";
$mpdf->WriteHTML($html_vii);



//
$mpdf->Output();
