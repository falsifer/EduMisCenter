
    <!-- col-md-3-->
   
        <div class="box">
            <div class="box-body">


                <div class="row" style="margin-top: 20px;">
                    <legend class="legend-heading" style="padding:10px;"><i class="glyphicon glyphicon-user"></i> สารสนเทศด้านบุคลากร</legend>
                    <div class="col-md-6">
                        <div id="chartContainer" style="height: 370px; max-width: 920px; margin: 0px auto;"></div>
                    </div>
                    <div class="col-md-6">
                        <div id="chartTAStd" style="height: 370px; max-width: 920px; margin: 0px auto;"></div>
                    </div>

                    <div class="col-md-6">
                        <div id="chartTAGL" style="height: 370px; max-width: 920px; margin: 0px auto;"></div>
                    </div>
                    <div class="col-md-6">
                        <div id="chartHRG" style="height: 370px; max-width: 920px; margin: 0px auto;"></div>
                    </div>
                </div>

                <div class="row" style="margin-top: 20px;">
                    <legend class="legend-heading" style="padding:10px;"><i class="glyphicon glyphicon-education"></i> สารสนเทศด้านนักเรียน</legend>
                    <div class="col-md-6">
                        <div id="chartStdAb" style="height: 370px; max-width: 920px; margin: 0px auto;"></div>
                    </div>
                    <div class="col-md-6">
                        <div id="chartStd" style="height: 370px; max-width: 920px; margin: 0px auto;"></div>
                    </div>
                </div>

            </div> 
            <?php $this->load->view('layout/my_school_footer'); ?>
        </div>
    </div> <!-- end of col-md-9 -->
</div>


<script>

    window.onload = function () {

//Better to construct options first and then pass it as a parameter
    var options = {
    exportEnabled: true,
            animationEnabled: true,
            title: {
            text: "การมาทำงานของบุคลากร วันที่ <?php echo datethai(date('Y-m-d')); ?>",
                    fontSize:16,
                    fontFamily:'Sarabun'
            },
            data: [
            {
            type: "pie", //change it to line, area, bar, pie,column etc
                    indexLabel: "{name} - {y} คน",
                    dataPoints: [
<?php foreach ($workStat as $r): ?>
    <?php
    $tmp = "";
    switch ($r['tb_hr_absent_record_status']) {
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
    ?>
                        {y: <?php echo $r['pnt']; ?>, name:"<?php echo $tmp; ?>"},
<?php endforeach; ?>

                    ]
            }
            ]
    };
    var optionsTAStd = {
    exportEnabled: true,
            animationEnabled: true,
            title: {
            text: "จำนวนครูและนักเรียน",
                    fontSize:16,
                    fontFamily:'Sarabun'
            },
            data: [
            {
            type: "pie", //change it to line, area, bar, pie,column etc
                    showInLegend: true,
                    indexLabel: "{name} {y} คน",
                    dataPoints: [
                    {y: <?php echo $TaStat; ?>, name:"ครู", exploded: true },
                    {y: <?php echo $StdStat; ?>, name:"นักเรียน"},
                    ]
            }
            ]
    };
    var optionsTAGL = {
    exportEnabled: true,
            animationEnabled: true,
            title: {
            text: "จำนวนครูแยกตามกลุ่มสาระ",
                    fontSize:16,
                    fontFamily:'Sarabun'
            },
            data: [
            {
            type: "column", //change it to line, area, bar, pie,column etc
                    indexLabel: "{y} คน",
                    dataPoints: [
<?php foreach ($TaGroupL as $r): ?>

                        {y: <?php echo $r['pnt']; ?>, name:"<?php echo $r['hr_group_learning']; ?>", label:"<?php echo $r['hr_group_learning']; ?>"},
<?php endforeach; ?>

                    ]
            }
            ]
    };
    var optionsHRG = {
    exportEnabled: true,
            animationEnabled: true,
            showInLegend: true,
            title: {
            text: "จำนวนบุคลากรแยกตามประเภท",
                    fontSize:16,
                    fontFamily:'Sarabun'
            },
            data: [
            {
            type: "pie", //change it to line, area, bar, pie,column etc
                    indexLabel: "{name} {y} คน",
                    dataPoints: [
<?php foreach ($HrGroup as $r): ?>

                        {y: <?php echo $r['pnt']; ?>, name:"<?php echo $r['hr_rank']; ?>" },
<?php endforeach; ?>

                    ]
            }
            ]
    };
    $("#chartContainer").CanvasJSChart(options);
    $("#chartTAStd").CanvasJSChart(optionsTAStd);
    $("#chartTAGL").CanvasJSChart(optionsTAGL);
    $("#chartHRG").CanvasJSChart(optionsHRG);
    // student stat
    var optionsStdAb = {
    exportEnabled: true,
            animationEnabled: true,
            title: {
            text: "การมาเรียน วันที่ <?php echo datethai(date('Y-m-d')); ?>",
                    fontSize:16,
                    fontFamily:'Sarabun'
            },
            data: [
            {
            type: "pie", //change it to line, area, bar, pie,column etc
                    indexLabel: "{name} - {y} คน",
                    dataPoints: [
<?php foreach ($absentStdStat as $r): ?>
    <?php
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
    ?>
                        {y: <?php echo $r['pnt']; ?>, name:"<?php echo $tmp; ?>"},
<?php endforeach; ?>

                    ]
            }
            ]
    };
    $("#chartStdAb").CanvasJSChart(optionsStdAb);
    var optionsStd = {
    exportEnabled: true,
            animationEnabled: true,
            title: {
            text: "จำนวนนักเรียนแยก ชาย-หญิง ตามระดับชั้น",
                    fontSize:16,
                    fontFamily:'Sarabun'
            },
            data: [
            {
            type: "stackedColumn", //change it to line, area, bar, pie,column etc
                    indexLabel: "ชาย - {y} คน",
                    showInLegend: true,
                    name : "ชาย",
                    dataPoints: [
<?php foreach ($stdStat as $r): ?>
    <?php if ($r['std_gender'] == "ชาย") { ?>
                            {y: <?php echo $r['pnt']; ?>, label:"<?php echo $r['class'] . "" . $r['lev']; ?>"},
    <?php } ?>
<?php endforeach; ?>

                    ]
            },
            {
            type: "stackedColumn", //change it to line, area, bar, pie,column etc
                    indexLabel: "หญิง - {y} คน",
                    showInLegend: true,
                    name : "หญิง",
                    dataPoints: [
<?php foreach ($stdStat as $r): ?>
    <?php if ($r['std_gender'] == "หญิง") { ?>
                            {y: <?php echo $r['pnt']; ?>, label:"<?php echo $r['class'] . "" . $r['lev']; ?>"},
    <?php } ?>
<?php endforeach; ?>

                    ]
            }
            ]

    };
    $("#chartStd").CanvasJSChart(optionsStd);
    }


</script>







