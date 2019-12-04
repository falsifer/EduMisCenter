<?php
include_once APPPATH . '/third_party/mpdf/mpdf.php';
//$this->load->library('mpdf/mpdf');
$mpdf = new mPDF('th', 'A4-P', '0', '0', '15', '10', '15', '5');
$stylesheet = file_get_contents(base_url("assets/css/mpdf.css"));
$mpdf->WriteHTML($stylesheet, 1);
$mpdf->SetDisplayMode('fullpage');
//------------------------------------------------------------------------------
$mpdf->SetHTMLHeader("<div class='header header-top'>แบบฟอร์มการนิเทศการศึกษา</div>");
$mpdf->SetHTMLFooter(" <div style='text-align:center;color:#666;font-size:16px;'>{PAGENO}</div>");
//------------------------------------------------------------------------------
$content .= "<HR>";
$content .= "ผู้รับการนิเทศ................................................................................................";
$content .= "โรงเรียน...............................................................................<br>";
$content .= "วันที่นิเทศ.........................................................";
$content .= "<table class='table'>";
$content .= '<thead>
                                            <tr>
                                                <th class="no-sort" rowspan="2" style="text-align: center;" >ที่</th>
                                                <th class="no-sort" rowspan="2" style="text-align: center;" >ประเด็น</th>
                                                <th class="no-sort" style="text-align: center;"';
//if ( === "ระดับคุณภาพ") {
    $content .= ' colspan="5"';
//} else {
//    $content .= ' colspan="2"';
//}
//$content .= '>' . $inSupervisionTitleType . '</th>';
$content .= '>ระดับคุณภาพ</th>';
$content .= '<th class="no-sort" rowspan="2" style="text-align: center;" >บันทึกข้อความ</th>
                                            </tr>
                                            <tr>';
//if ($inSupervisionTitleType === "ระดับคุณภาพ") {
    $content .= '                                       <th style="text-align: center;" >1</th>
                                                    <th style="text-align: center;" >2</th>
                                                    <th style="text-align: center;" >3</th>
                                                    <th style="text-align: center;" >4</th>
                                                    <th style="text-align: center;" >5</th>';
//} else {
//    $content .= '                                                   <th style="text-align: center;" >มี/ปฏิบัติ</th>
//                                                    <th style="text-align: center;" >ไม่มี/ไม่ปฏิบัติ</th>';
//}
$content .= '                                           </tr>
                                        </thead>
                                        <tbody>';
$row = 1;
if ($form != null)
    
    $title="";
    foreach ($form as $r):
        if($title!=$r['tb_supervision_title_detail'])
        {
            $title = $r['tb_supervision_title_detail'];
            $content .= "<tr><td colspan='8'>".$title."</td></tr>";
        }

        $content .= '<tr>
                                                    <td style="text-align:center;">'.$row.'</td>
                                                    <td style="width:200px;">' . $r['tb_supervision_sub_title_detail'] . '</td>';
       // if ($inSupervisionTitleType === "ระดับคุณภาพ") {
            $content .= '<td style="text-align: center;" >&nbsp;</td>';
            $content .= '<td style="text-align: center;" >&nbsp;</td>';
            $content .= '<td style="text-align: center;" >&nbsp;</td>';
            $content .= '<td style="text-align: center;" >&nbsp;</td>';
            $content .= '<td style="text-align: center;" >&nbsp;</td>';
       // } else {
       //     $content .= '<td style="text-align: center;" >&nbsp;</td>';
       //     $content .= '<td style="text-align: center;" >&nbsp;</td>';
       // }
        $content .= '<td style="text-align: center;">';
        $content .= '<textarea rows="2" cols="40"></textarea>';
        $content .= '</td>';

        $content .= '</tr>';

        $row++;
    endforeach;
$content .= '</tbody>';
$content .= "</table>";
$content .= "<div style='width:200px;float:right;margin-right:20px;text-align:center;'>ผู้ทำการการนิเทศ<br><br>..............................................<br> (".$this->session->userdata("name").")</div>";
//
$mpdf->WriteHTML($content);
$mpdf->Output();
