<?php
//include_once APPPATH . '/third_party/mpdf/mpdf.php';
////$this->load->library('mpdf/mpdf');
//$mpdf = new mPDF('th', 'A4-L', '0', '0', '5', '5', '35', '5');
//$stylesheet = file_get_contents(base_url("assets/css/mpdf.css"));
//$mpdf->WriteHTML($stylesheet, 1);
//$mpdf->SetDisplayMode('fullpage');
////------------------------------------------------------------------------------
$content = "";
$content .= "<center><h2>ตารางภาพรวมการนิเทศการจัดการเรียนการสอน</h2>"
        . "<h3>หน่วยดำเนินการ: สำนัก/{$supervision['supervision_department']}  </h3>"
        . "<h4 style='font-style:italic'>{$this->session->userdata('localgov')}</h4>";
$content .= "</center>"
        . "<br>";
//------------------------------------------------------------------------------


$content .= "<table style='width:100%;' border='1' cellspacing='0'>"
        . "<thead>"
        . "<tr>"
        . "<th rowspan='2' style='width:35px;'>ที่</th>"
        . "<th rowspan='2'>ปีการศึกษา</th>"
        . "<th rowspan='2'>เทอมที่</th>"
        . "<th rowspan='2' style='width:130px;'>วัน เดือน ปี นิเทศ</th>"
        . "<th rowspan='2'>กลุ่มสาระการเรียนรู้</th>"
        . "<th colspan='3'>รายการนิเทศ</th>"
        . "<th rowspan='2'>ผู้รับการนิเทศ</th>"
        . "<th rowspan='2'>ผู้นิเทศ</th>"
        . "</tr>"
        . "<tr>"
        . "<th>ระดับชั้น</th>"
        . "<th>รหัสวิชา</th>"
        . "<th>ชื่อวิชา</th>"
        . "</tr>"
        . "</thead>";
$row = 1;
foreach ($rs as $r) {
    $content .= "<tr>"
            . "<td style='text-align:center;'>{$row}</td>"
            . "<td style='text-align:center;'>{$r['loan_year']}</td>"
            . "<td style='text-align:center;'>{$r['loan_term']}</td>"
            . "<td>" . datethai($r['schedule_date']) . "</td>"
            . "<td>{$r['learning_group']}</td>"
            . "<td>{$r['class']}</td>"
            . "<td>{$r['tb_course_code']}</td>"
            . "<td>{$r['tb_subject_name']}</td>"
            . "<td>{$r['teacher_name']}</td>"
            . "<td>{$r['supervision_name']}</td>"
            . "</tr>";
    $row++;
}
if ($row < 10) {
    for ($i = 1; $i <= 10; $i++) {
        $content .= "<tr>"
                . "<td>&nbsp;</td>"
                . "<td>&nbsp;</td>"
                . "<td>&nbsp;</td>"
                . "<td>&nbsp;</td>"
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
//$mpdf->WriteHTML($content);
//$mpdf->Output();
?>
<div class="panel panel-primary">
    <div class="panel-heading">การนิเทศการเรียนการสอนประจำปีการศึกษา <?php echo loan_year(date('Y')); ?></div>
    <ul class="breadcrumb">
        <li><a href="http://localhost/eschool/index.php"><i class="icon-home icon-large"></i> หน้าแรก</a></li>
        <li><a href="http://localhost/eschool/index.php/supervision">การนิเทศการเรียนการสนอน</a></li>
        <li>รายงาน</li>
    </ul>
    <div class="row">
        <div class="col-md-12">
            <center>
                <textarea name="inReport" id="inReport"class='editor' > 
                    <?php echo $content; ?>
                </textarea>
            </center>

        </div>
    </div>
</div>

<script>
    tinymce.init({
        selector: '.editor',
        theme: 'modern',
        height: 200,
        plugins: "print",
        toolbar: "print",
        elements: "inReport",
        height: "842",
    });
</script>