
<div id="chartStdGenAll" class="col-md-12" style="height: 370px; max-width: 920px; margin: 0px auto;"></div>

<script>

<?php
//$stdStatTmp = $this->Stat_model->get_std_base_stat_all_school();
?>
    var optionsStdGenAll = {
        exportEnabled: true,
        animationEnabled: true,
        axisX: {
            interval: 1
        },
        title: {
            text: "จำนวนนักเรียนแยก ชาย-หญิง",
            fontSize: 16,
            fontFamily: 'Sarabun'
        },
        data: [
            {
                type: "stackedColumn", //change it to line, area, bar, pie,column etc
                indexLabel: "ชาย - {y} คน",
                showInLegend: true,
                name: "ชาย",
                dataPoints: [

<?php
$sql = "select a.tb_student_base_department as school,count(*) as pnt from tb_student_base a 
inner join tb_ed_classroom b on a.id = b.tb_student_base_id 
inner join tb_ed_room c on b.tb_ed_room_id = c.id  
inner join tb_ed_school_register_class d on c.tb_ed_school_register_class_id = d.id 
inner join tb_school e on e.sc_thai_name = a.tb_student_base_department 
where d.tb_ed_school_register_class_edyear = " . get_edyear() . " 
and e.sc_localgov = '" . $this->session->userdata('localgov') . "' 
and a.std_gender like '%ชาย%'  and a.tb_student_base_status = 'S' 
group by a.tb_student_base_department";


$query = $this->db->query($sql);
foreach ($query->result() as $row) {
    echo "{ label: \"" . $row->school . "\", y: " . $row->pnt . " },";
}
?>

                ]
            },
            {
                type: "stackedColumn", //change it to line, area, bar, pie,column etc
                indexLabel: "หญิง - {y} คน",
                showInLegend: true,
                name: "หญิง",
                dataPoints: [
<?php
$sql = "select a.tb_student_base_department as school,count(*) as pnt from tb_student_base a 
inner join tb_ed_classroom b on a.id = b.tb_student_base_id 
inner join tb_ed_room c on b.tb_ed_room_id = c.id  
inner join tb_ed_school_register_class d on c.tb_ed_school_register_class_id = d.id 
inner join tb_school e on e.sc_thai_name = a.tb_student_base_department 
where d.tb_ed_school_register_class_edyear = " . get_edyear() . " 
and e.sc_localgov = '" . $this->session->userdata('localgov') . "' 
and a.std_gender like '%หญิง%' and a.tb_student_base_status = 'S'
group by a.tb_student_base_department";


$query = $this->db->query($sql);
foreach ($query->result() as $row) {
    echo "{ label: \"" . $row->school . "\", y: " . $row->pnt . " },";
}
?>

                ]
            }
        ]

    };
    $("#chartStdGenAll").CanvasJSChart(optionsStdGenAll);


</script>