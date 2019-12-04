<?php

include_once APPPATH . '/third_party/mpdf/mpdf.php';
//$this->load->library('mpdf/mpdf');
$mpdf = new mPDF('th', 'A4-P', '0', '0', '15', '15', '25', '5');
$stylesheet = file_get_contents(base_url("assets/css/mpdf.css"));
$mpdf->WriteHTML($stylesheet, 1);
$mpdf->SetDisplayMode('fullpage');
//------------------------------------------------------------------------------
$mpdf->SetHTMLHeader(""
        . "<div class='header header-middle'>แผนการนิเทศ</div>"
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
        . "<tr>"
        . "<td style='border:none;'><b>ชื่อผู้นิเทศ</b></td><td style='border:none;border-bottom:1px dotted #666;'>{$supervision['supervision_name']}</td>"
        . "<td style='border:none;'><b>กลุ่มเป้าหมาย</b></td><td style='border:none;border-bottom:1px dotted #666;'>{$supervision['supervision_destination']}</td>"
        . "</tr>"
        . "<tr>";
$content .= "<td style='border:none;'><b>วัตถุประสงค์</b></td></tr>";
//
if ($supervision['supervision_purpose1'] != '') {
    $content .= "<tr>"
            . "<td style='border:none;'>" . nbs(8) . "</td>"
            . "<td style='border:none;'>- {$supervision['supervision_purpose1']}</td>"
            . "</tr>";
} else {
    $content .= "<tr><td></td></tr>";
}
if ($supervision['supervision_purpose2'] != '') {
    $content .= "<tr>"
            . "<td style='border:none;'>" . nbs(8) . "</td>"
            . "<td style='border:none;'>- {$supervision['supervision_purpose2']}</td>"
            . "</tr>";
} else {
    $content .= "<tr><td></td></tr>";
}
if ($supervision['supervision_purpose3'] != '') {
    $content .= "<tr>"
            . "<td style='border:none;'>" . nbs(8) . "</td>"
            . "<td style='border:none;'>- {$supervision['supervision_purpose3']}</td>"
            . "</tr>";
} else {
    $content .= "";
}
if ($supervision['supervision_purpose4'] != '') {
    $content .= "<tr>"
            . "<td style='border:none;'>" . nbs(8) . "</td>"
            . "<td style='border:none;'>- {$supervision['supervision_purpose4']}</td>"
            . "</tr>";
} else {
    $content .= "";
}
if ($supervision['supervision_purpose5'] != '') {
    $content .= "<tr>"
            . "<td style='border:none;'>" . nbs(8) . "</td>"
            . "<td style='border:none;'>- {$supervision['supervision_purpose5']}</td>"
            . "</tr>";
} else {
    $content .= "";
}
if ($supervision['supervision_purpose6'] != '') {
    $content .= "<tr>"
            . "<td style='border:none;'>" . nbs(8) . "</td>"
            . "<td style='border:none;'>- {$supervision['supervision_purpose6']}</td>"
            . "</tr>";
} else {
    $content .= "";
}
if ($supervision['supervision_purpose7'] != '') {
    $content .= "<tr>"
            . "<td style='border:none;'>" . nbs(8) . "</td>"
            . "<td style='border:none;'>- {$supervision['supervision_purpose7']}</td>"
            . "</tr>";
} else {
    $content .= "";
}
if ($supervision['supervision_purpose8'] != '') {
    $content .= "<tr>"
            . "<td style='border:none;'>" . nbs(8) . "</td>"
            . "<td style='border:none;'>- {$supervision['supervision_purpose8']}</td>"
            . "</tr>";
} else {
    $content .= "";
}
//
$content .= "</table>"
        . "";
//
$content .= ""
        . "<table class='table' style='font-size:0.8em;'>"
        . "<thead>"
        . "<tr>"
        . "<th rowspan='2' style='width:30px;'>ที่</th>"
        . "<th rowspan='2'>ชื่อ-นามสกุล<br/>ผู้รับการนิเทศ</th>"
        . "<th rowspan='2'>วัน เดือน ปี</th>"
        . "<th rowspan='2'>วิชา</th>"
        . "<th colspan='2'>การนิเทศ กำกับ ติดตามและประเมินผล</th>"
        . "</tr>"
        . "<tr>"
        . "<th>กิจกรรม เทคนิค วิธีการนิเทศ</th>"
        . "<th>สื่อ/เครื่องมือนิเทศ</th>"
        . "</tr>"
        . "</thead>";
$row = 1;
$line = 1;
foreach ($rs as $r) {
    $content .= "<tr>"
            . "<td style='text-align:center;'>{$row}</td>"
            . "<td>{$r['hr_thai_symbol']}{$r['hr_thai_name']}&nbsp;&nbsp;{$r['hr_thai_lastname']}</td>"
            . "<td>" . datethai($r['plan_detail_date']) . "</td>"
            . "<td>รหัสวิชา {$r['subject_code']} ชื่อวิชา {$r['subject_name']}</td>"
            . "<td>{$r['plan_detail_activities']}</td>"
            . "<td>{$r['plan_detail_media']}</td>"
            . "</tr>";
    $row++;
    $line++;
}
if ($line < 15) {
    for ($i = 1; $i <= 10; $i++) {
        $content .= "<tr>"
                . "<td>&nbsp;</td>"
                . "<td>&nbsp;</td>"
                . "<td>&nbsp;</td>"
                . "<td>&nbsp;</td>"
                . "<td>&nbsp;</td>"
                . "<td>&nbsp;</td>"
                . "</tr>";
    }
}
$content .= "</table>";
//
$mpdf->WriteHTML($content);
$mpdf->Output();
