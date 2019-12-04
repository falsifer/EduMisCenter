
<div id="chartHRDG" class="col-md-12" style="height: 370px; max-width: 920px; margin: 0px auto;"></div>

<script>


    var optionsHRDG = {
    exportEnabled: true,
            animationEnabled: true,
            title: {
            text: "จำนวนครูแยกตามวิทยฐานะ",
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
$gl = $this->My_model->get_all('tb_hr_degree');
foreach ($gl as $r) {
    $pnt = $this->Stat_model->get_hr_degree_stat($r['tb_hr_degree_name']);
    ?>

                        {y: <?php echo $pnt; ?>, name: "<?php echo $r['tb_hr_degree_description']; ?>", label: "<?php echo $r['tb_hr_degree_description']; ?>"},
    <?php
}
$pnt = $this->Stat_model->get_hr_degree_stat("");
 if($pnt>0){
?>

                    {y: <?php echo $pnt; ?>, name: "ยังไม่ระบุวิทยฐานะ", label: "ยังไม่ระบุวิทยฐานะ"},
<?php 
 }
?>
                    ]
            }
            ]
    };
    $("#chartHRDG").CanvasJSChart(optionsHRDG);


</script>