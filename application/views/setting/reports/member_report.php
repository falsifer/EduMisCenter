<?php
 include_once APPPATH.'/third_party/mpdf/mpdf.php';

$mpdf = new mPDF('th', 'A4-L', '0', '0', '10', '5', '25', '5');
$stylesheet = file_get_contents(base_url("assets/css/mpdf.css"));
$mpdf->WriteHTML($stylesheet, 1);
$mpdf->SetDisplayMode('fullpage');
//------------------------------------------------------------------------------
$mpdf->SetHTMLHeader("<div class='header header-top'>ข้อมูลผู้ใช้งานระบบ</div>"
        . ""
        . "<hr/>");
$mpdf->SetHTMLFooter("<hr/>"
        . "<table style='width:100%;'>"
        . "<tr>"
        . "<td style='width:33%;'>ระบบการบริหารจัดการศึกษาอิเลคทรอนิกส์ 4.0 (eSchool 4.0)</td>"
        . "<td style='width:33%;text-align:center;'>หน้าที่ {PAGENO}</td>"
        . "<td style='width:33%;'>" . $this->session->userdata('department') . nbs(3) . $this->session->userdata('localgov') . "</td>"
        . "</tr>"
        . "</table>"
        . "");
//------------------------------------------------------------------------------
$content = "<table class='table'>"
        . "<thead>"
        . "<tr>"
        . "<th>No.</th>"
        . "<th>Name</th>"
        . "<th>Lastname</th>"
        . "<th>Username</th>"
        . "<th>Password</th>"
        . "<th>Statsus</th>"
        . "<th>งานที่รับผิดชอบ</th>"
        . "<th>Activate</th>"
        . "</tr>"
        . "</thead>";
$content .= "<tbody>";
$row = 1;
foreach ($rs as $r) {
    $content .= "<tr>"
            . "<td>{$row}</td>"
            . "<td>{$r['member_name']}</td>"
            . "<td>{$r['member_lastname']}</td>"
            . "<td>{$r['username']}</td>"
            . "<td>{$r['password']}</td>"
            . "<td>{$r['status']}</td>"
            . "<td>{$r['data_name']}</td><td>";
    if ($r['activate'] == 1) {
        $content .= 'Activate';
    } else {
        $content .= 'No-Activate';
    }
    $content .= "</td></tr>";
    $row++;
}

$content .= "</tbody>";
$content .= "</table>";
//
$mpdf->WriteHTML($content);
$mpdf->Output();
