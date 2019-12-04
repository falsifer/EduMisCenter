<?php
 include_once APPPATH.'/third_party/mpdf/mpdf.php';
$mpdf = new mPDF('th', 'A4-L', '0', '0', '10', '5', '55', '5');
$stylesheet = file_get_contents(base_url("assets/css/mpdf.css"));
$mpdf->WriteHTML($stylesheet, 1);
$mpdf->SetDisplayMode('fullpage');
//------------------------------------------------------------------------------
$mpdf->SetHTMLHeader(""
        . "<div class='header header-top'>รายละเอียดโครงการพัฒนา</div>"
        . "<div class='header header-middle'>" . $rs['main_plan_name'] . "</div>"
        . "<div class='header header-middle'>สำหรับองค์กรปกครองส่วนท้องถิ่นดำเนินการ</div>"
        . "<div class='header header-middle'>" . $this->session->userdata('localgov') . "</div>"
        . "<table stle='width:100%;'>"
        . "<tr>"
        . "<td style='font-size:16px;'>ก.ยุทธศาสตร์จังหวัดที่ " . $rs['strategies_no'] . ' ' . $rs['strategies_name'] . "</td>"
        . "</tr>"
        . "<tr>"
        . "<td style='font-size:16px;'>ข.ยุทธศาสตร์การพัฒนาขององค์กรปกครองส่วนท้องถิ่นในเขตจังหวัด ยุทธศาสตร์ที่ " . $rs['localgov_st_no'] . ' ' . $rs['localgov_st_name'] . "</td>"
        . "</tr>"
        . "</table>");
$mpdf->SetHTMLFooter(" <div style='text-align:center;color:#666;font-size:16px;'>{PAGENO}</div>");
//------------------------------------------------------------------------------

$content = "<table class='table'>"
        . "<thead>"
        . "<tr>"
        . "<th rowspan='2' style='width:45px;'>ที่</th>"
        . "<th rowspan='2' style='width:14%;'>โครงการ</th>"
        . "<th rowspan='2' style='width:14%;'>วัตถุประสงค์</th>"
        . "<th rowspan='2' style='width:14%;'>เป้าหมาย<br/>(ผลผลิตของโครงการ)</th>"
        . "<th colspan='4' style='width:19%;'>งบประมาณและที่ผ่านมา</th>"
        . "<th rowspan='2' style='width:10%;'>ตัวชี้วัด (KPI)</th>"
        . "<th rowspan='2' style='width:8%;'>ผลที่คาดว่าจะได้รับ</th>"
        . "<th rowspan='2' style='width:8%;'>หน่วยงาน<br/>รับผิดชอบหลัก</th>"
        . "</tr>"
        . "<tr>";

$year = $this->My_model->get_where_order('tb_project_loan_year', array('project_id' => $rs['id']), 'loan_year asc');
foreach ($year as $y) {
    $content .= "<th>{$y['loan_year']}</th>";
}
$content .= "</tr>"
        . "</thead>";
$content .= "<tbody>";
$row = 1;
$content .= "<tr>"
        . "<td style='text-align:center;'>{$row}</td>"
        . "<td>{$rs['project_name']}</td>";
$purpose = $this->My_model->get_where_order("tb_project_purpose", array("project_id" => $rs['id']), 'id asc');
$content .= "<td>";
foreach ($purpose as $g) {
    $content .= $g['purpose_description'];
}
$content .= "</td>";
// เป้าหมาย
$goal = $this->My_model->get_where_order("tb_project_goal", array("project_id" => $rs['id']), 'id asc');
$content .= "<td>";
$no = 1;
foreach ($goal as $d) {
    $content .= $no . '' . $d['project_goal'];
    $no++;
}
$content .= "</td>";
// ดึงตัวเงินมาแสดง
$loan = $this->My_model->get_where_order("tb_project_loan_year", array("project_id" => $rs['id']), 'id asc');
foreach ($loan as $l) {
    if($l['project_loan']!=''){
            $content .= "<td style='text-align:right;'>" . number_format($l['project_loan'], 2, '.', '.') . "</td>";

    }else{
            $content .= "<td style='text-align:right;'></td>";

    }
}
$kpi = $this->My_model->get_where_order("tb_project_kpi", array("project_id" => $rs['id']), 'id asc');
$content .= "<td>";
foreach ($kpi as $k) {
    $content .= $k['kpi_detail'];
}
$content .= "</td>"
        . "<td style='width:20%;'>";
$des = $this->My_model->get_where_order('tb_project_destination', array('project_id' => $rs['id']), 'id asc');
foreach ($des as $d) {
    $content .= $d['destination'].br();
}
$content .= "</td>"
        . "<td>กองการศึกษา</td>"
        . "";
$content .= "</tr>";
$content .= "</tbody>";
$content .= "</table>";
//
$mpdf->WriteHTML($content);
$mpdf->Output();
