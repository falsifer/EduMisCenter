
<div id="chartHRG" class="col-md-12" style="height: 370px; max-width: 920px; margin: 0px auto;"></div>

<script>


    var optionsHRG = {
    exportEnabled: true,
            animationEnabled: true,
            title: {
            text: "จำนวนบุคลากรแยกตามประเภท",
                    fontSize: 16,
                    fontFamily: 'Sarabun'
            },
            axisX:{
            interval: 1
            },
            data: [
            {
            type: "column", //change it to line, area, bar, pie,column etc
                    indexLabel: "{y} คน",
                    dataPoints: [
<?php
$gl = $this->My_model->get_all('tb_human_resources_type');
foreach ($gl as $r) {
    $pnt = $this->Stat_model->get_hr_type_stat($r['id']);
    ?>

                        {y: <?php echo $pnt; ?>, name: "<?php echo $r['human_resources_type']; ?>", label: "<?php echo $r['human_resources_type']; ?>"},
    <?php
}
$pnt = $this->Stat_model->get_hr_type_stat(0);
 if($pnt>0){
?>

                    {y: <?php echo $pnt; ?>, name: "ยังไม่ระบุประเภทบุคลากร", label: "ยังไม่ระบุประเภทบุคลากร"},
<?php 
 }
?>
                    ]
            }
            ]
    };
    $("#chartHRG").CanvasJSChart(optionsHRG);


</script>