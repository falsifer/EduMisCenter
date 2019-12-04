
<div id="chartStdTAAll" class="col-md-12" style="height: 370px; max-width: 920px; margin: 0px auto;"></div>

<script>


    var optionsStdTAAll = {
        exportEnabled: true,
        animationEnabled: true,
        axisX: {
            interval: 1
        },
        title: {
            text: "จำนวนครูและนักเรียน",
            fontSize: 16,
            fontFamily: 'Sarabun'
        },
        data: [
            
            {
                type: "stackedColumn100", //change it to line, area, bar, pie,column etc
                indexLabel: "นักเรียน - {y} คน",
                showInLegend: true,
                name: "นักเรียน",
                dataPoints: [
<?php
$stdStatTmp = $this->Stat_model->get_std_base_stat_all_school();
foreach ($stdStatTmp as $row) {
    echo "{ label: \"" . $row['school'] . "\", y: " . $row['pnt'] . " },";
}
?>

                ]
            },
            {
                type: "stackedColumn100", //change it to line, area, bar, pie,column etc
                indexLabel: "ครู - {y} คน",
                showInLegend: true,
                name: "ครู",
                dataPoints: [

<?php

  $sql = "select hr_department as school, count(*) as pnt from tb_human_resources_01 a "
            . "inner join tb_human_resources_type b on a.hr_type_id = b.id where human_resources_type like '%ครู%' "
            . "and hr_department !='กองการศึกษา' group by hr_department";



//                $query = $this->db->query($sql);
//                if($query->result()!=null){
//                $TA = $query2->result()[0]->pnt;
//                }else{
//                    $TA = 0;
//                }
//                
//$sql = "select a.tb_student_base_department as school,count(*) as pnt from tb_student_base a 
//inner join tb_ed_classroom b on a.id = b.tb_student_base_id 
//inner join tb_ed_room c on b.tb_ed_room_id = c.id  
//inner join tb_ed_school_register_class d on c.tb_ed_school_register_class_id = d.id 
//inner join tb_school e on e.sc_thai_name = a.tb_student_base_department 
//where d.tb_ed_school_register_class_edyear = " . get_edyear() . " 
//and e.sc_localgov = '" . $this->session->userdata('localgov') . "' 
//and a.std_gender like '%ชาย%'  and a.tb_student_base_status = 'S' 
//group by a.tb_student_base_department";


$query = $this->db->query($sql);
foreach ($query->result() as $row) {
    echo "{ label: \"" . $row->school . "\", y: " . $row->pnt . " },";
}
?>

                ]
            },
        ]

    };
    $("#chartStdTAAll").CanvasJSChart(optionsStdTAAll);


</script>