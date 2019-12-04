
<div id="chartTAGL" class="col-md-12" style="height: 370px; max-width: 920px; margin: 0px auto;"></div>

<script>


    var optionsTAGL = {
        exportEnabled: true,
        animationEnabled: true,
        title: {
            text: "จำนวนครูแยกตามกลุ่มสาระ",
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
$gl = $this->My_model->get_all_order('tb_education_learning_group', 'education_group_no');
foreach ($gl as $r) {
    $pnt = $this->Stat_model->get_ta_group_learning($r['education_group_name']);
    ?>

                        {y: <?php echo $pnt; ?>, name: "<?php echo $r['education_group_name']; ?>", label: "<?php echo $r['education_group_name']; ?>"},
    <?php
}
 $pnt = $this->Stat_model->get_ta_group_learning("");
 if($pnt>0){
    ?>

                        {y: <?php echo $pnt; ?>, name: "ยังไม่ระบุ", label: "ยังไม่ระบุ"},
<?php
 }
?>
                ]
            }
        ]
    };
    $("#chartTAGL").CanvasJSChart(optionsTAGL);


</script>