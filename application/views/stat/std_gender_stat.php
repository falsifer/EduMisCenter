
<div id="chartStd" class="col-md-12" style="height: 370px; max-width: 920px; margin: 0px auto;"></div>

<script>

<?php
$stdStatTmp = $this->Icare_model->get_std_gender_stat();
?>
    var optionsStd = {
    exportEnabled: true,
            animationEnabled: true,
            title: {
            text: "จำนวนนักเรียนแยก ชาย-หญิง ตามระดับชั้น",
                    fontSize:16,
                    fontFamily:'Sarabun'
            }, axisX:{
    interval: 1
    },
            data: [
            {
            type: "stackedColumn", //change it to line, area, bar, pie,column etc
                    indexLabel: "ชาย - {y} คน",
                    showInLegend: true,
                    name : "ชาย",
                    dataPoints: [
<?php foreach ($stdStatTmp as $r): ?>
    <?php if (trim($r['std_gender']) == "ชาย") { ?>
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
<?php foreach ($stdStatTmp as $r): ?>
    <?php if (trim($r['std_gender']) == "หญิง") { ?>
                            {y: <?php echo $r['pnt']; ?>, label:"<?php echo $r['class'] . "" . $r['lev']; ?>"},
    <?php } ?>
<?php endforeach; ?>

                    ]
            }
            ]

    };
    $("#chartStd").CanvasJSChart(optionsStd);


</script>