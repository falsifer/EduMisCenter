<div class="box">
    <div class="box-heading"><i class='icon-home icon-large'></i> ระบบบริหารจัดการศึกษาอิเล็กทรอนิกส์ (Thailand 4.0)<span class="pull-right" style="margin-right:15px;"><?php echo $this->session->userdata('department'); ?></span></div>
    <div class="box-body">


        <div class="row" style="margin-top: 20px;">
            <legend class="legend-heading" style="padding:10px;"><i class="glyphicon glyphicon-user"></i> สารสนเทศด้านบุคลากร</legend>
            <div class="col-md-6">
                <?php
                $this->load->view('stat/std_teacher_pie');
                ?>
            </div>
            <div class="col-md-6">
                <?php
                $data['workStat'] = $workStat;
                $this->load->view('stat/hr_absent_pie', $data);
                ?>
            </div>
            <div class="col-md-12" style="margin: 20px;">&nbsp;</div>

            <div class="col-md-6">
                <?php
                $this->load->view('stat/hr_group_learning_stat');
                ?>
            </div>
            <div class="col-md-6">
                <?php
                $this->load->view('stat/hr_position_stat');
                ?>
            </div>
            <div class="col-md-12" style="margin: 20px;">
                <?php
                $this->load->view('stat/hr_ta_type_stat');
                ?>
          </div>
        </div>

        <div class="row" style="margin-top: 20px;">
            <legend class="legend-heading" style="padding:10px;"><i class="glyphicon glyphicon-education"></i> สารสนเทศด้านนักเรียน</legend>
            <div class="col-md-6">
                <?php
                $this->load->view('stat/std_absent_stat');
                ?>
            </div>
            <div class="col-md-6">
                <?php
                $this->load->view('stat/std_gender_stat');
                ?>
             </div>
        </div>

    </div> 
    <?php
    
    $this->load->view('layout/my_school_footer');
    ?>
</div>

<script>

//    window.onload = function () {
//
////Better to construct options first and then pass it as a parameter


//    // student stat
//    var optionsStdAb = {
//    exportEnabled: true,
//            animationEnabled: true,
//            title: {
//            text: "การมาเรียน วันที่ <?php echo datethai(date('Y-m-d')); ?>",
//                    fontSize:16,
//                    fontFamily:'Sarabun'
//            },
//            data: [
//            {
//            type: "pie", //change it to line, area, bar, pie,column etc
//                    indexLabel: "{name} - {y} คน",
//                    dataPoints: [
//<?php foreach ($absentStdStat as $r): ?>
//    <?php
    $tmp = "";
    switch ($r['tb_student_absent_record_status']) {
        case 'A':
            $tmp = 'ขาด';
            break;
        case 'S':
            $tmp = 'ป่วย';
            break;
        case 'E':
            $tmp = 'ลา';
            break;
        case 'C':
            $tmp = 'มา';
            break;
    }
    ?>//
//                        {y: <?php echo $r['pnt']; ?>, name:"<?php echo $tmp; ?>"},
//<?php endforeach; ?>
//
//                    ]
//            }
//            ]
//    };
//    $("#chartStdAb").CanvasJSChart(optionsStdAb);
//    var optionsStd = {
//    exportEnabled: true,
//            animationEnabled: true,
//            title: {
//            text: "จำนวนนักเรียนแยก ชาย-หญิง ตามระดับชั้น",
//                    fontSize:16,
//                    fontFamily:'Sarabun'
//            },
//            data: [
//            {
//            type: "stackedColumn", //change it to line, area, bar, pie,column etc
//                    indexLabel: "ชาย - {y} คน",
//                    showInLegend: true,
//                    name : "ชาย",
//                    dataPoints: [
//<?php foreach ($stdStat as $r): ?>
//    <?php if ($r['std_gender'] == "ชาย") { ?>
//                            {y: <?php echo $r['pnt']; ?>, label:"<?php echo $r['class'] . "" . $r['lev']; ?>"},
//    <?php } ?>
//<?php endforeach; ?>
//
//                    ]
//            },
//            {
//            type: "stackedColumn", //change it to line, area, bar, pie,column etc
//                    indexLabel: "หญิง - {y} คน",
//                    showInLegend: true,
//                    name : "หญิง",
//                    dataPoints: [
//<?php foreach ($stdStat as $r): ?>
//    <?php if ($r['std_gender'] == "หญิง") { ?>
//                            {y: <?php echo $r['pnt']; ?>, label:"<?php echo $r['class'] . "" . $r['lev']; ?>"},
//    <?php } ?>
//<?php endforeach; ?>
//
//                    ]
//            }
//            ]
//
//    };
//    $("#chartStd").CanvasJSChart(optionsStd);
//    }


</script>


