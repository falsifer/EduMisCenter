
<div id="chartStdAb" class="col-md-12" style="height: 370px; max-width: 920px; margin: 0px auto;"></div>

<script>

 
        var optionsStdAb = {
        exportEnabled: true,
                animationEnabled: true,
                title: {
                text: "การมาเรียน วันที่ <?php echo datethai(date('Y-m-d')); ?>",
                        fontSize: 16,
                        fontFamily: 'Sarabun'
                },
                data: [
                {
                type: "pie", //change it to line, area, bar, pie,column etc
                        showInLegend: true,
                        indexLabel: "{name} {y} คน",
                        dataPoints: [
<?php
$ab = $this->Stat_model->get_std_absent_stat('A');
?>
                        {y: <?php echo $ab; ?>, name: "ขาด"},
<?php
$sick = $this->Stat_model->get_std_absent_stat('S');
?>
                        {y: <?php echo $sick; ?>, name: "ป่วย"},
<?php
$errand = $this->Stat_model->get_std_absent_stat('E');
?>
                        {y: <?php echo $errand; ?>, name: "ลา"},
<?php
$come = $this->Stat_model->get_std_absent_stat('C');
?>
                        {y: <?php echo $come; ?>, name: "มา"},
                        ]
                }
                ]
        };



        $("#chartStdAb").CanvasJSChart(optionsStdAb);


</script>