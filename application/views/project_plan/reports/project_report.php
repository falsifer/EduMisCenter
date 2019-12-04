<?php

include_once APPPATH . '/third_party/mpdf/mpdf.php';
$mpdf = new mPDF('th', 'A4-P', '0', '0', '15', '15', '25', '5');
$stylesheet = file_get_contents(base_url("assets/css/mpdf.css"));
$mpdf->WriteHTML($stylesheet, 1);
$mpdf->SetDisplayMode('fullpage');
//------------------------------------------------------------------------------

$content = "<div style='width100%;font-size:16px;'>";
$content .= "<table stle='width:100%;font-size:16px;'>";
$content .= "<tr>";
$content .= "<td><b>๑. โครงการ</b>" . nbs(3) . $rs['project_name'] . "</td>";
$content .= "</tr>";
$content .= "<tr>";
$content .= "<td><b>๒. ความสอดคล้องกับมาตรฐานการศึกษา/ตัวบ่งชี้</b></td>";
$content .= "</tr>";
$kpi = $this->My_model->get_where_order("tb_project_plan_kpi", array("project_id" => $rs['project_id']), "kpi_detail asc");


foreach ($kpi as $r) {
    $content .= "<tr>";
    $content .= "<td style='padding-left:30px;'>";
    $content .= $r['kpi_detail'];
    $content .= "</td>";
    $content .= "</tr>";
}


$content .= "<tr>";
$content .= "<td><b>๓. หลักการและเหตุผล</b></td>";
$content .= "</tr>";

$content .= "<tr>";
$content .= "<td><div>" . $rs['tb_plan_rational_criterion'] . "</div></td>";
$content .= "</tr>";


$content .= "<tr>";
$content .= "<td><b>๔. วัตถุประสงค์</b></td>";
$content .= "</tr>";

$content .= "<tr>";
$content .= "<td style='padding-left:30px;'>";

$purpose = $this->My_model->get_where_order("tb_project_plan_purpose", array("project_id" => $rs['project_id']), 'id asc');

$cnt = 1;
foreach ($purpose as $r) {
    $content .= "<div>";
    $content .= '๔.' . thaidigit($cnt) . '.' . $r['purpose_description'];
    $content .= "</div>";
    $cnt++;
}
$content .= "</td>";
$content .= "</tr>";

$content .= "<tr>";
$content .= "<td><b>๕. เป้าหมาย</b></td>";
$content .= "</tr>";

$content .= "<tr>";
$content .= "<td style='padding-left:30px;'>";

$goal = $this->My_model->get_where_order("tb_project_plan_goal", array("project_id" => $rs['project_id']), 'type desc');

$cnt = 1;
$cc = 1;
$tmp = '';
foreach ($goal as $r) {
    if ($tmp != $r['type']) {
        $tmp = $r['type'];

        $content .= "<div style='font-weight:bold;'>";
        $content .= '๕.' . thaidigit($cnt) . '.' . $r['type'];
        $content .= "</div>";
        $cnt++;
    }
    $content .= "<div>";
    $content .= nbs(5) . '-' . $r['project_goal'];
    $content .= "</div>";
    $cnt++;
}
$content .= "</td>";
$content .= "</tr>";


$content .= "<tr>";
$content .= "<td><b>๖. ความสอดคล้องกับแผนพัฒนาท้องถิ่น/แผนพัฒนาการศึกษาของสถานศึกษา</b></td>";
$content .= "</tr>";


$prov = $this->My_model->get_where_row("tb_school", array("sc_thai_name" => $this->session->userdata("department")));

$content .= "<tr>";
$content .= "<td style='padding-left:30px;'>๖.๑ สอดคล้องกับแผนพัฒนา" . ($prov['sc_localgov'] ? $prov['sc_localgov'] : 'องค์การบริการส่วนจังหวัด') . "</td>";
$content .= "</tr>";


$content .= "<tr>";
$content .= "<td style='padding-left:60px;'>";
//$this->My_model->get_all_order("tb_localgov_strategies", "localgov_st_no ASC");
$local = $this->My_model->get_where_order("tb_localgov_strategic", array("id" => $rs['localgov_strategies_id']), 'localgov_st_no asc');

foreach ($local as $r) {
    $content .= "<div>";
    $content .= 'สอดคล้องกับยุทธศาสตร์ที่ ' . thaidigit($r['localgov_st_no']) . ' ' . $r['localgov_st_name'];
    $content .= "</div>";
    $localStg = $this->My_model->get_where_order("tb_localgov_strategies", array("tb_localgov_strategic_id" => $r['id']), 'localgov_st_no asc');
    foreach ($localStg as $rr) {
        $content .= "<div>";
        $content .= 'กลยุทธ์ที่ ' . thaidigit($r['localgov_st_no']) . '.' . thaidigit($rr['localgov_st_no']) . ' ' . $rr['localgov_st_name'];
        $content .= "</div>";
    }
}


$content .= "</td>";
$content .= "</tr>";

$content .= "<tr>";
$content .= "<td style='padding-left:30px;'>๖.๒ สอดคล้องกับแผนพัฒนาการศึกษากองการศึกษาและวัฒนธรรม " . ($prov['sc_localgov'] ? $prov['sc_localgov'] : 'องค์การบริการส่วนจังหวัด') . "</td>";
$content .= "</tr>";


$content .= "<tr>";
$content .= "<td style='padding-left:60px;'>";
//$this->My_model->get_all_order("tb_localgov_strategies", "localgov_st_no ASC");
$local = $this->My_model->get_where_order("tb_education_strategic", array("id" => $rs['education_st_id']), 'education_st_no asc');

foreach ($local as $r) {
    $content .= "<div>";
    $content .= 'สอดคล้องกับยุทธศาสตร์ที่ ' . thaidigit($r['education_st_no']) . ' ' . $r['education_st_name'];
    $content .= "</div>";
    $localStg = $this->My_model->get_where_order("tb_education_strategies", array("tb_education_strategic_id" => $r['id']), 'education_st_no asc');
    foreach ($localStg as $rr) {
        $content .= "<div>";
        $content .= 'กลยุทธ์ที่ ' . thaidigit($r['education_st_no']) . '.' . thaidigit($rr['education_st_no']) . ' ' . $rr['education_st_name'];
        $content .= "</div>";
    }
}


$content .= "</td>";
$content .= "</tr>";


$content .= "<tr>";
$content .= "<td style='padding-left:30px;'>๖.๓ สอดคล้องกับแผนพัฒนาการศึกษาของโรงเรียน</td>";
$content .= "</tr>";


$content .= "<tr>";
$content .= "<td style='padding-left:60px;'>";
//$this->My_model->get_all_order("tb_localgov_strategies", "localgov_st_no ASC");
$local = $this->My_model->get_where_order("tb_school_strategic", array("id" => $rs['school_strategies_id']), 'school_strategic_no asc');

foreach ($local as $r) {
    $content .= "<div>";
    $content .= 'สอดคล้องกับยุทธศาสตร์ที่ ' . thaidigit($r['school_strategic_no']) . ' ' . $r['school_strategic_name'];
    $content .= "</div>";
    $localStg = $this->My_model->get_where_order("tb_school_strategies", array("tb_school_strategic_id" => $r['id']), 'school_strategies_no asc');
    foreach ($localStg as $rr) {
        $content .= "<div>";
        $content .= 'กลยุทธ์ที่ ' . thaidigit($r['school_strategic_no']) . '.' . thaidigit($rr['school_strategies_no']) . ' ' . $rr['school_strategies_name'];
        $content .= "</div>";
    }
}


$content .= "</td>";
$content .= "</tr>";

$content .= "<tr>";
$content .= "<td><b>๗. วิธีการดำเนินงาน</b></td>";
$content .= "</tr>";
$content .= "<tr>";
$content .= "<td style='text-align:center;'>ขั้นตอนการดำเนินการในครั้งนี้ ดำเนินการภายใต้กิจกรรมและองค์ประกอบต่างๆ ดังนี้</td>";
$content .= "</tr>";

$content .= "<tr>";
$content .= "<td style='text-align:center;'><table stle='width:100%;font-size:16px;'>";
$content .= "<tr>";
$content .= "<td style='width:10%;text-align:center;border:1px solid #000;padding:5px 3px;'><b>ที่</b></td>";
$content .= "<td style='width:50%;text-align:center;border:1px solid #000;padding:5px 3px;'><b>กิจกรรม</b></td>";
$content .= "<td style='width:20%;text-align:center;border:1px solid #000;padding:5px 3px;'><b>ระยะเวลาดำเนินงาน</b></td>";
$content .= "<td style='width:20%;text-align:center;border:1px solid #000;padding:5px 3px;'><b>ผู้รับผิดชอบ</b></td>";
$content .= "</tr>";

$process = $this->My_model->get_where_order("tb_project_plan_timeline", array("project_id" => $rs['project_id']), "process_seq asc");

foreach ($process as $pr) {
    $content .= "<tr>";
    $content .= "<td style='text-align:center;vertical-align:top;border:1px solid #000;padding:5px 3px;'>" . $pr['process_seq'] . "</td>";
    $content .= "<td style='text-align:left;vertical-align:top;border:1px solid #000;padding:5px 3px;'>" . $pr['process'] . "</td>";
    if (($pr['process_start'] === $pr['process_end'])) {
        $content .= "<td style='text-align:center;vertical-align:top;border:1px solid #000;padding:5px 3px;'>" . datethai($pr['process_start']) . "</td>";
    } else {
        $content .= "<td style='text-align:center;vertical-align:top;border:1px solid #000;padding:5px 3px;'>" . datethai($pr['process_start']) . ' - ' . datethai($pr['process_end']) . "</td>";
    }
    $content .= "<td style='text-align:left;vertical-align:top;border:1px solid #000;padding:5px 3px;'>" . $pr['responsible'] . "</td>";
    $content .= "</tr>";
}

$content .= "</table></td>";
$content .= "</tr>";


$content .= "<tr>";
$content .= "<td><b>๘. ระยะเวลาดำเนินงาน</b></td>";
$content .= "</tr>";

$this->db->select("min(`process_start`) as mstart,MAX(`process_end`) as mend")->from('tb_project_plan_timeline');
$this->db->where(array('project_id' => $rs['project_id']));
$query = $this->db->get();

$period = $query->row_array();



$content .= "<tr>";
if (($period['mstart'] === $period['mend'])) {
    $mm = explode(" ", datethai($period['mstart']));
    $content .= "<td style='padding-left:30px;'>ระหว่างเดือน " . $mm[1] . ' ' . $mm[3] . "</td>";
} else {
    $mm = explode(" ", datethai($period['mstart']));
    $ee = explode(" ", datethai($period['mend']));
    $content .= "<td style='padding-left:30px;'>ระหว่างเดือน " . $mm[1] . ' ' . $mm[3] . ' - ' . $ee[1] . ' ' . $ee[3] . "</td>";
}

$content .= "</tr>";


$content .= "<tr>";
$content .= "<td><b>๙. สถานที่ดำเนินการ</b></td>";
$content .= "</tr>";
$content .= "<tr>";
$content .= "<td style='padding-left:30px;'>" . $this->session->userdata('department') . "</td>";
$content .= "</tr>";


$content .= "<tr>";
$content .= "<td><b>๑๐. หน่วยงานที่รับผิดชอบ</b></td>";
$content .= "</tr>";
$content .= "<tr>";
if(isset($rs['responsible'])){
$content .= "<td style='padding-left:30px;'>" . $rs['responsible']. "</td>";
}else{
   $content .= "<td style='padding-left:30px;'>&nbsp;</td>"; 
}
$content .= "</tr>";

$content .= "<tr>";
$content .= "<td><b>๑๑. งบประมาณในการดำเนินการ</b></td>";
$content .= "</tr>";
$budget = $this->My_model->get_where_order("tb_project_plan_loan", array("project_id" => $rs['project_id']), "id asc");
$rw=1;
$total=0;
foreach ($budget as $pr) {
    $content .= "<tr>";
    $content .= "<td style='padding-left:30px;'>";
    $content .= "<table style='width:100%'>";
    $content .= "<tr>";
$content .= "<td style='width:70%;'>๑๑." . thaidigit($rw).' ' . $pr['project_plan_item']."</td>";
$content .= "<td style='width:30%;text-align:right;'>" . number_format($pr['project_plan_budget'], 2, '.', ',') ." บาท</td>";
$content .= "</tr>";
    $content .= "</table>";
    $content .= "</td>";
    $content .= "</tr>";
    $total += $pr['project_plan_budget'];
    $rw++;
}
$content .= "<tr>";
$content .= "<td style='text-align:right;'><b>รวมเป็นเงินทั้งสิ้น จำนวน ".number_format($total, 2, '.', ',')." บาท</b></td>";
$content .= "</tr>";

$content .= "<tr>";
$content .= "<td style='text-align:left;'><b>หมายเหต</b> ทุกรายการสามารถถัวจ่ายกันได้</td>";
$content .= "</tr>";

$content .= "<tr>";
$content .= "<td><b>๑๒. การติดตามและประเมินผล</b></td>";
$content .= "</tr>";


$content .= "<tr>";
$content .= "<td style='text-align:center;'><table stle='width:100%;font-size:16px;'>";
$content .= "<tr>";
$content .= "<td style='width:50%;text-align:center;border:1px solid #000;padding:5px 3px;'><b>ตัวชี้วัดความสำเร็จ</b></td>";
$content .= "<td style='width:25%;text-align:center;border:1px solid #000;padding:5px 3px;'><b>วิธีการนิเทศติดตามและประเมินผล</b></td>";
$content .= "<td style='width:25%;text-align:center;border:1px solid #000;padding:5px 3px;'><b>เครื่องมือที่ใช้ในการประเมินผล</b></td>";
$content .= "</tr>";

$ev = $this->My_model->get_where_order("tb_project_plan_evaluation", array("project_id" => $rs['project_id']), "id asc");

foreach ($ev as $pr) {
    $content .= "<tr>";
    $content .= "<td style='text-align:left;vertical-align:top;border:1px solid #000;padding:5px 3px;'>" . $pr['project_plan_kpi'] . "</td>";
    $content .= "<td style='text-align:left;vertical-align:top;border:1px solid #000;padding:5px 3px;'>" . $pr['project_plan_evaluation'] . "</td>";
    $content .= "<td style='text-align:left;vertical-align:top;border:1px solid #000;padding:5px 3px;'>" . $pr['project_plan_evaluation_tools'] . "</td>";
    $content .= "</tr>";
}

$content .= "</table></td>";
$content .= "</tr>";

$content .= "<tr>";
$content .= "<td><b>๑๓. ผลที่คาดว่าจะได้รับ</b></td>";
$content .= "</tr>";

$dest = $this->My_model->get_where_order("tb_project_plan_destination", array("project_id" => $rs['project_id']), "id asc");
$rw=1;


foreach ($dest as $pr) {
    $content .= "<tr>";
    $content .= "<td style='padding-left:30px;'>";
    $content .= '๑๓.' . thaidigit($rw) . ' ' . $pr['destination'];
    $content .= "</td>";
    $content .= "</tr>";
}

$content .= "<tr>";
$content .= "<td><b>๑๔. ผู้จัดทำโครงการ</b></td>";
$content .= "</tr>";
$content .= "<tr>";
$content .= "<td style='text-align:right'>ลงชื่อ" . nbs(45) . "</td>";
$content .= "</tr>";
$content .= "<tr>";
$content .= "<td style='text-align:right'>(" . $this->session->userdata('name') . ")</td>";
$content .= "</tr>";
$content .= "<tr>";
$content .= "<td style='text-align:right'>ครู" . nbs(20) . "</td>";
$content .= "</tr>";

$content .= "<tr>";
$content .= "<td><b>๑๕. ผู้เสนอโครงการ</b></td>";
$content .= "</tr>";
$content .= "<tr>";
$content .= "<td style='text-align:right'>ลงชื่อ" . nbs(45) . "</td>";
$content .= "</tr>";
$content .= "<tr>";
$content .= "<td style='text-align:right'>(" . nbs(45) . ")</td>";
$content .= "</tr>";
$content .= "<tr>";
$content .= "<td style='text-align:right'>ครู" . nbs(20) . "</td>";
$content .= "</tr>";

$content .= "<tr>";
$content .= "<td><b>๑๖. ผู้เห็นชอบโครงการ</b></td>";
$content .= "</tr>";
$content .= "<tr>";
$content .= "<td style='text-align:right'>ลงชื่อ" . nbs(45) . "</td>";
$content .= "</tr>";
$content .= "<tr>";
$content .= "<td style='text-align:right'>(" . nbs(45) . ")</td>";
$content .= "</tr>";
$content .= "<tr>";
$content .= "<td style='text-align:right'>รองผู้อำนวยการ" . $this->session->userdata('department') . nbs(1) . "</td>";
$content .= "</tr>";

$content .= "<tr>";
$content .= "<td><b>๑๗. ผู้อนุมัติโครงการ</b></td>";
$content .= "</tr>";
$content .= "<tr>";
$content .= "<td>......................................................................................................................................................................................................................</td>";
$content .= "</tr>";
$content .= "<tr>";
$content .= "<td>......................................................................................................................................................................................................................</td>";
$content .= "</tr>";
$content .= "<tr>";
$content .= "<td style='text-align:right'>ลงชื่อ" . nbs(45) . "</td>";
$content .= "</tr>";
$content .= "<tr>";
$content .= "<td style='text-align:right'>(" . nbs(45) . ")</td>";
$content .= "</tr>";
$content .= "<tr>";
$content .= "<td style='text-align:right'>ผู้อำนวยการ" . $this->session->userdata('department') . nbs(3) . "</td>";
$content .= "</tr>";


$content .= "</table>";
$content .= "</div>";

$mpdf->WriteHTML($content);
$mpdf->Output();
