<?php
$this->load->library('mpdf/mpdf');
$mpdf = new mPDF('th', 'A4-P', '0', '0', '15', '10', '15', '5');
$stylesheet = file_get_contents(base_url("assets/css/mpdf.css"));
$mpdf->WriteHTML($stylesheet, 1);
$mpdf->SetDisplayMode('fullpage');
//
$content = $inExam01;
//
$mpdf->WriteHTML($content);
$mpdf->Output();
