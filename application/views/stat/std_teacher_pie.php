
    <div id="chartTAStd" class="col-md-12" style="height: 370px; max-width: 920px; margin: 0px auto;"></div>

<script>
<?php
    $sql2 = "select count(*) as pnt from tb_human_resources_01 a "
            . "inner join tb_human_resources_type b on a.hr_type_id = b.id where human_resources_type like '%ครู%' "
            . "and hr_department ='" . $this->session->userdata('department') . "' ";



                $query2 = $this->db->query($sql2);
                if($query2->result()!=null){
                $TA = $query2->result()[0]->pnt;
                }else{
                    $TA = 0;
                }
                
                 $sql = "select a.tb_student_base_department as school,count(*) as pnt from tb_student_base a 
inner join tb_ed_classroom b on a.id = b.tb_student_base_id
inner join tb_ed_room c on b.tb_ed_room_id = c.id 
inner join tb_ed_school_register_class d on c.tb_ed_school_register_class_id = d.id 
inner join tb_school e on e.sc_thai_name = a.tb_student_base_department
where d.tb_ed_school_register_class_edyear = " . get_edyear() . "
and a.tb_student_base_department = '" . $this->session->userdata('department') . "'
group by a.tb_student_base_department";


                $query = $this->db->query($sql);
                if($query->result()!=null){
                $Std = $query->result()[0]->pnt;
                }else{
                    $Std = 0;
                }
?>
        var optionsTAStd = {
            exportEnabled: true,
            animationEnabled: true,
            title: {
                text: "จำนวนครูและนักเรียน",
                fontSize: 16,
                fontFamily: 'Sarabun'
            },
            data: [
                {
                    type: "pie", //change it to line, area, bar, pie,column etc
                    showInLegend: true,
                    indexLabel: "{name} {y} คน",
                    dataPoints: [
                        {y: <?php echo $TA; ?>, name: "ครู", exploded: true},
                        {y: <?php echo $Std; ?>, name: "นักเรียน"},
                    ]
                }
            ]
        };
        $("#chartTAStd").CanvasJSChart(optionsTAStd);


</script>