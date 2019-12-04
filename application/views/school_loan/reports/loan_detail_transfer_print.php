<?php

include_once APPPATH . '/third_party/mpdf/mpdf.php';
//$this->load->library('mpdf/mpdf');
$mpdf = new mPDF('th', 'A4-L', '0', '0', '10', '5', '35', '5');
$stylesheet = file_get_contents(base_url("assets/css/mpdf.css"));
$mpdf->WriteHTML($stylesheet, 1);
$mpdf->SetDisplayMode('fullpage');
//------------------------------------------------------------------------------
$mpdf->SetHTMLHeader(""
        . "<div class='header header-top'>" . $this->session->userdata('localgov') . "</div>"
        . "<div class='header header-middle'>การโอนเงินให้โรงเรียนสังกัด{$this->session->userdata('localgov')} ตามข้อบัญญัติงบประมาณรายจ่ายประจำปี " . loan_year(date('Y')) . "</div>"
        . "<div class='header header-middle'>{$school['sc_thai_name']}</div>"
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
        . "<thead>"
        . "<tr>"
        . "<th style='width:40px;'>ที่</th>"
        . "<th>หมวด/ประเภท/รายการ</th>"
        . "<th style='width:100px;'>งบประมาณ<br/>ที่ตั้งไว้ (บาท)</th>"
        . "<th style='width:100px;'>ไตรมาส 1<br/>(บาท)</th>"
        . "<th style='width:100px;'>ไตรมาส 2<br/>(บาท)</th>"
        . "<th style='width:100px;'>ไตรมาส 3<br/>(บาท)</th>"
        . "<th style='width:100px;'>ไตรมาส 4<br/>(บาท)</th>"
        . "<th style='width:100px;'>ลด/เพิ่ม<br/>(บาท)</th>"
        . "<th style='width:100px;'>คงเหลือ<br/>(บาท)</th>"
        . "</tr>"
        . "</thead>";
$row = 1;
foreach ($rs as $r) {
    $content .=""
            . "<tr>"
            . "<td style='text-align:center;'>{$row}</td>"
            . "<td>{$r['loan_category']}/{$r['loan_type']}/{$r['loan_define']}</td>"
            . "<td style='text-align:right;'>" . number_format($r['loan_begin'], 2, '.', ',') . "</td>";

    $content .="<td style='text-align:right;'>";
    $term1 = $this->School_loan_model->loan_transfer_term($r['school_id'], $r['id'], 1);
    $content .= $term1['loan_transfer'] != 0 ? number_format($term1['loan_transfer'], 2, '.', ',') : '';
    $content .="</td>";

    $content .="<td style='text-align:right;'>";
    $term2 = $this->School_loan_model->loan_transfer_term($r['school_id'], $r['id'], 2);
    $content .= $term2['loan_transfer'] != 0 ? number_format($term2['loan_transfer'], 2, '.', ',') : '';
    $content .="</td>";

    $content .="<td style='text-align:right;'>";
    $term3 = $this->School_loan_model->loan_transfer_term($r['school_id'], $r['id'], 3);
    $content .= $term3['loan_transfer'] != 0 ? number_format($term3['loan_transfer'], 2, '.', ',') : '';
    $content .="</td>";

    $content .="<td style='text-align:right;'>";
    $term4 = $this->School_loan_model->loan_transfer_term($r['school_id'], $r['id'], 4);
    $content .= $term4['loan_transfer'] != 0 ? number_format($term4['loan_transfer'], 2, '.', ',') : '';
    $content .="</td>";

    // หาผลรวมของการโอนเงิน
    $total_transfer = $term1['loan_transfer'] + $term2['loan_transfer'] + $term3['loan_transfer'] + $term4['loan_transfer'];
    $result_loan = $r['loan_begin'] - $total_transfer;

    // โอนลด/โอนเพิ่ม
    $content .="<td>";
    $content .="</td>";

    // คงเหลือ
    $content .="<td style='text-align:right;'>";
    $content .= $result_loan != 0 ? number_format($result_loan, 2, '.', ',') : '';
    $content .="</td>";


    $content .= "</tr>";
    $row++;
}
$content.= "</table>";
//
$mpdf->WriteHTML($content);
$mpdf->Output();
