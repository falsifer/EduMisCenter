<?php

include_once APPPATH . '/third_party/mpdf/mpdf.php';
$mpdf = new mPDF('th', 'A4-P', '0', '0', '10', '5', '25', '5');
$stylesheet = file_get_contents(base_url("assets/css/mpdf.css"));
$mpdf->WriteHTML($stylesheet, 1);
$mpdf->SetDisplayMode('fullpage');
//------------------------------------------------------------------------------
$mpdf->SetHTMLHeader("<div class='header header-top'>การส่งเสริม-สนับสนุน กำกับติดตาม และประเมินผลคุณภาพสถานศึกษาในสังกัด</div>");
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
        . "<th>ที่</th>"
        . "</tr>"
        . "</thead>";
$content .= "<tbody>";
$content .= "</tbody>";
$content .= "</table>";
//
$mpdf->WriteHTML($content);
$mpdf->Output();
