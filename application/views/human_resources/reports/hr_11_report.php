<?php
 include_once APPPATH.'/third_party/mpdf/mpdf.php';

$mpdf = new mPDF('th', 'A4-L', '0', '0', '15', '15', '20', '5');
$stylesheet = file_get_contents(base_url("assets/css/mpdf.css"));
$mpdf->WriteHTML($stylesheet, 1);
$mpdf->SetDisplayMode('fullpage');
//------------------------------------------------------------------------------
$mpdf->SetHTMLHeader("<div class='header header-top'>ข้อมูลบุคลากร ข้อมูลการลาทุกประเภท/การปฏิบัติงาน</div>");
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
$content .= "<h2>Name: {$human['hr_thai_symbol']}{$human['hr_thai_name']}&nbsp;&nbsp;{$human['hr_thai_lastname']}</h2>";
$content .= ""
        . "<table class='table'>"
        . "<thead>"
        . "<tr>"
        . "<th>ที่</th>"
        . "<th>วัน/เดือน/ปี</th>"
        . "<th>มาสาย</th>"
        . "<th>ลาป่วย</th>"
        . "<th>ลากิจ</th>"
        . "<th>ขาด</th>"
        . "<th>ไปราชการ</th>"
        . "<th>ลาพักผ่อน</th>"
        . "<th>ลาคลอด</th>"
        . "<th>ลาบวช/ฮัจช์</th>"
        . "<th>ลาศักษาต่อ</th>"
        . "</tr>"
        . "</thead>"
        . "<tbody>";
$row = 1;
foreach ($rs as $r) {
    $content .= "<tr>"
            . "<td style='text-align:center;width:55px;'>{$row}</td>"
            . "<td>". datethai($r['hr11_date'])."</td>";
            
    switch ($r['hr11_type']) {
        case 'มาสาย':
            $content .= ""
                    . "<td style='text-align:center;'>" . img('images/checked.png') . "</td>"
                    . "<td></td>"
                    . "<td></td>"
                    . "<td></td>"
                    . "<td></td>"
                    . "<td></td>"
                    . "<td></td>"
                    . "<td></td>"
                    . "<td></td>"
                    . "";
            break;
        case 'ลาป่วย':
            $content .= ""
                    . "<td></td>"
                    . "<td style='text-align:center;'>" . img('images/checked.png') . "</td>"
                    . "<td></td>"
                    . "<td></td>"
                    . "<td></td>"
                    . "<td></td>"
                    . "<td></td>"
                    . "<td></td>"
                    . "<td></td>"
                    . "";
            break;
        case 'ลากิจ':
            $content .= ""
                    . "<td></td>"
                    . "<td></td>"
                    . "<td style='text-align:center;'>" . img('images/checked.png') . "</td>"
                    . "<td></td>"
                    . "<td></td>"
                    . "<td></td>"
                    . "<td></td>"
                    . "<td></td>"
                    . "<td></td>"
                    . "";
            break;
        case 'ขาด':
            $content .= ""
                    . "<td></td>"
                    . "<td></td>"
                    . "<td></td>"
                    . "<td style='text-align:center;'>" . img('images/checked.png') . "</td>"
                    . "<td></td>"
                    . "<td></td>"
                    . "<td></td>"
                    . "<td></td>"
                    . "<td></td>"
                    . "";
            break;
        case 'ไปราชการ':
            $content .= ""
                    . "<td></td>"
                    . "<td></td>"
                    . "<td></td>"
                    . "<td></td>"
                    . "<td style='text-align:center;'>" . img('images/checked.png') . "</td>"
                    . "<td></td>"
                    . "<td></td>"
                    . "<td></td>"
                    . "<td></td>"
                    . "";
            break;
        case 'ลาพักผ่อน':
            $content .= ""
                    . "<td></td>"
                    . "<td></td>"
                    . "<td></td>"
                    . "<td></td>"
                    . "<td></td>"
                    . "<td style='text-align:center;'>" . img('images/checked.png') . "</td>"
                    . "<td></td>"
                    . "<td></td>"
                    . "<td></td>"
                    . "";
            break;
        case 'ลาคลอด':
            $content .= ""
                    . "<td></td>"
                    . "<td></td>"
                    . "<td></td>"
                    . "<td></td>"
                    . "<td></td>"
                    . "<td></td>"
                    . "<td style='text-align:center;'>" . img('images/checked.png') . "</td>"
                    . "<td></td>"
                    . "<td></td>"
                    . "";
            break;
        case 'ลาบวช/ฮัจช์':
            $content .= ""
                    . "<td></td>"
                    . "<td></td>"
                    . "<td></td>"
                    . "<td></td>"
                    . "<td></td>"
                    . "<td></td>"
                    . "<td></td>"
                    . "<td style='text-align:center;'>" . img('images/checked.png') . "</td>"
                    . "<td></td>"
                    . "";
            break;
        case 'ลาศึกษาต่อ':
            $content .= ""
                    . "<td></td>"
                    . "<td></td>"
                    . "<td></td>"
                    . "<td></td>"
                    . "<td></td>"
                    . "<td></td>"
                    . "<td></td>"
                    . "<td></td>"
                    . "<td style='text-align:center;'>" . img('images/checked.png') . "</td>";
            break;

        default:
            break;
    }
    $content .= "</tr>";
    $row++;
}
$content .= "</tbody></table>";

//
$mpdf->WriteHTML($content);
$mpdf->Output();
