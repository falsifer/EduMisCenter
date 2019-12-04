<?php

$mpdf = new mPDF('th', 'A4-P', '0', '0', '10', '5', '25', '5');
$stylesheet = file_get_contents(base_url("assets/css/mpdf.css"));
$mpdf->WriteHTML($stylesheet, 1);
$mpdf->SetDisplayMode('fullpage');
//------------------------------------------------------------------------------
$mpdf->SetHTMLHeader(""
        . "<table style='width:100%;'>"
        . "<tr>"
        . "<td style='width:33%;'>"
        . "<table style='width:100%;'>"
        . "<tr>"
        . "<td style='font-size:22px;'>งานกำกับและบังคับใช้กฎหมาย</td>"
        . "</tr>"
        . "<tr>"
        . "<td style='font-size:20px;'>โครงการประกันคุณภาพด้านงานกำกับและบังคับใช้กฎหมาย</td>"
        . "</tr>"
        . "<tr>"
        . "<td style='font-size:20px;'>กรมทางหลวงชนบท กระทรวงคมนาคม</td>"
        . "</tr>"
        . "</table>"
        . "</td>"
        . "<td style='width:33%;text-align:center;'>"
        . "<span style='font-size:24px;font-weight:bold;'>ข้อมูลฐานความผิด</span>"
        . "</td>"
        . "<td style='width:33%;'>"
        . "<table style='width:100%;'>"
        . "<tr>"
        . "<td style='font-size:14px;text-align:right;'>วันที่รายงาน ".datethai(date("Y-m-d"))."</td>"
        . "</tr>"
        . "<tr><td>&nbsp;</td></tr>"
        . "<tr><td>&nbsp;</td></tr>"
        . "</table>"
        . "</td>"
        . "</tr>"
        . "</table>"
        . "");
$mpdf->SetHTMLFooter(" <div style='text-align:center;color:#666;font-size:16px;'>{PAGENO}</div>");
//------------------------------------------------------------------------------
$content = "<table class='table'>";
$content.="<tbody>";


$content .="</tbody>";
$content .="</table>";
//
$mpdf->WriteHTML($content);
$mpdf->Output();
