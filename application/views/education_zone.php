<div class="box">
    <div class="box-heading"><i class='icon-home icon-large'></i> ระบบบริหารจัดการศึกษาอิเล็กทรอนิกส์ (Thailand 4.0)<span class="pull-right" style="margin-right:15px;">สำนักการศึกษา</span></div>
    <div class="box-body">
        <div class="row" style="margin-top: 20px;">
            <legend class="legend-heading" style="padding:10px;"><i class="glyphicon glyphicon-user"></i> สารสนเทศของโรงเรียนในสังกัด</legend>
            <!--            <div class="col-md-6">
                            <div id="chartContainer" style="height: 370px; max-width: 920px; margin: 0px auto;"></div>
                        </div>-->
            <div class="col-md-12" style="margin-top: 10px;">
                <div id="chartTAStd" style="height: 370px; max-width: 920px; margin: 0px auto;"></div>
            </div>
            <div class="col-md-12" style="margin-top: 10px;">
                <table id="stdStatTab" class="table table-bordered table-strip">
                    <thead>


                        <tr>
                            <th>ลำดับ</th>
                            <th>โรงเรียน</th>
                            <th>จำนวนครู</th>
                            <th>จำนวนนักเรียน</th>
                        </tr>

                    </thead>
                    <tbody>
                        <?php
                        $sql = "select a.tb_student_base_department as school,count(*) as pnt from tb_student_base a 
inner join tb_ed_classroom b on a.id = b.tb_student_base_id
inner join tb_ed_room c on b.tb_ed_room_id = c.id 
inner join tb_ed_school_register_class d on c.tb_ed_school_register_class_id = d.id 
inner join tb_school e on e.sc_thai_name = a.tb_student_base_department
where d.tb_ed_school_register_class_edyear = " . get_edyear() . "
and e.sc_localgov = '" . $this->session->userdata('localgov') . "'
group by a.tb_student_base_department";


                        $query = $this->db->query($sql);
                        $rr=1;
                        $sumstd =0;
$sumhr = 0;

                        foreach ($query->result() as $row) {
                            $sql2 = "select count(*) as pnt from tb_human_resources_01 where hr_department ='" . $row->school . "' 
   ";



                            $query2 = $this->db->query($sql2);
//                            foreach ($query2->result() as $r) {
                                ?>
                                <tr>
                                    <td><?php echo $rr;?></td>
                                    <td><?php echo $row->school; ?></td>
                                    <?php 
                                    $sumstd += $query2->result()[0]->pnt;
                                    $sumhr += $row->pnt;
                                    ?>
                                    <td><?php echo $query2->result()[0]->pnt; ?></td>
                                    <td><?php echo $row->pnt; ?></td>
                                    
                                </tr>
                                <?php
                                $rr++;
//                            }
                        }
                        ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th style='text-align:center;' colspan="2">รวม</th>
                          
                            <th><?php echo $sumstd;?></th>
                            <th><?php echo $sumhr;?></th>
                        </tr>
                    </tfoot>
                </table>
            </div>
            <div class="col-md-12" style="margin-top: 50px;">
                <div id="chartStd" style="height: 370px; max-width: 920px; margin: 0px auto;"></div>
            </div>
            <div class="col-md-12" style="margin-top: 50px;">
                <div id="chartTAGL" style="height: 370px; max-width: 920px; margin: 0px auto;"></div>
            </div>
            <div class="col-md-12" style="margin-top: 50px;">
                <div id="chartHRG" style="height: 370px; max-width: 920px; margin: 0px auto;"></div>
            </div>
            <div class="col-md-12" style="margin-top: 50px;">
                <div id="chartStdAb" style="height: 370px; max-width: 920px; margin: 0px auto;"></div>
            </div>

        </div>

    </div> 
    <?php $this->load->view('layout/my_school_footer'); ?>
</div>

<script>
    <?php
//        $tabName = "stdStatTab";
//        
//        $text = "จำนวนครูและนักเรียนโรงเรียนในสังกัด ".$this->session->userdata('localgov');
//        $title = $this->Echo_Text_Model->head_logo($text,$this->session->userdata('sch_id'));
//        $colStr = "0,1,2,3";
//        $btExArr = array();
//        
//    
//        load_datatable($tabName, $btExArr, $title, $colStr);
    
    ?>

    window.onload = function () {


    var optionsTAStd = {
    exportEnabled: true,
            animationEnabled: true,
            title: {
            text: "จำนวนครูและนักเรียน",
                    fontSize:16,
                    fontFamily:'Sarabun'
            },
            axisY: {
            suffix: "%"
            },
            toolTip: {
            shared: true
            },
            legend: {
            verticalAlign: "center",
                    horizontalAlign: "right"
            },
            data: [{
            type: "stackedColumn100",
                    name: "จำนวนนักเรียน",
//                    indexLabel: "นักเรียน - {y} คน",
                    showInLegend: true,
                    dataPoints: [

<?php
$sql = "select a.tb_student_base_department as school,count(*) as pnt from tb_student_base a 
inner join tb_ed_classroom b on a.id = b.tb_student_base_id
inner join tb_ed_room c on b.tb_ed_room_id = c.id 
inner join tb_ed_school_register_class d on c.tb_ed_school_register_class_id = d.id 
inner join tb_school e on e.sc_thai_name = a.tb_student_base_department
where d.tb_ed_school_register_class_edyear = " . get_edyear() . "
and e.sc_localgov = '" . $this->session->userdata('localgov') . "'
group by a.tb_student_base_department";


$query = $this->db->query($sql);
foreach ($query->result() as $row) {
    echo "{ label: \"" . $row->school . "\", y: " . $row->pnt . " },";
}
?>
                    ]
            },
            {
            type: "stackedColumn100",
                    name: "จำนวนครู",
//                    indexLabel: "ครู - {y} คน",
                    showInLegend: true,
                    toolTip: {
                    shared: true
                    },
                    dataPoints: [
<?php
$sql = "select a.hr_department as school,count(*) as pnt from tb_human_resources_01 a 
inner join tb_school e on e.sc_thai_name = a.hr_department
where e.sc_localgov = '" . $this->session->userdata('localgov') . "'
group by a.hr_department";


$query = $this->db->query($sql);
foreach ($query->result() as $row) {
    echo "{ label: \"" . $row->school . "\", y: " . $row->pnt . " },";
}
?>
                    ]
            }]
    };
    var optionsTAGL = {
    exportEnabled: true,
            animationEnabled: true,
            title: {
            text: "จำนวนบุคลากรแยกตามประเภท",
                    fontSize:16,
                    fontFamily:'Sarabun'
            },
            toolTip: {
            shared: true
            },
            data: [
<?php
$rsSc = $this->My_model->get_where_order('tb_school', array('sc_localgov' => $this->session->userdata('localgov')), 'sc_thai_name');
foreach ($rsSc as $r) {
    ?>


                {
                type: "column", //change it to line, area, bar, pie,column etc
                        name: '<?php echo $r['sc_thai_name']; ?>',
    //                        indexLabel: "<?php echo $r['sc_thai_name']; ?> {y} คน",
                        dataPoints: [
    <?php
    $sql = "SELECT b.human_resources_type as type,count(*) as pnt FROM `tb_human_resources_01` a 
right outer join tb_human_resources_type b 
on a.hr_type_id = b.id
where a.hr_department = '" . $r['sc_thai_name'] . "' 
group by b.human_resources_type order by b.human_resources_type";


    $query = $this->db->query($sql);
    foreach ($query->result() as $row) {
        echo "{ label: \"" . $row->type . "\", y: " . $row->pnt . " },";
    }
    ?>

                        ]
                },
    <?php
}
?>
            ]
    };
    var optionsHRG = {
    exportEnabled: true,
            animationEnabled: true,
            showInLegend: true,
            title: {
            text: "จำนวนครูแยกตามกลุ่มสาระ",
                    fontSize:16,
                    fontFamily:'Sarabun'
            },
            toolTip: {
            shared: true
            },
            data: [
<?php
$rsSc = $this->My_model->get_where_order('tb_school', array('sc_localgov' => $this->session->userdata('localgov')), 'sc_thai_name');
foreach ($rsSc as $r) {
    ?>


                {
                type: "column", //change it to line, area, bar, pie,column etc
                        name: '<?php echo $r['sc_thai_name']; ?>',
    //                        indexLabel: "<?php echo $r['sc_thai_name']; ?> {y} คน",
                        dataPoints: [
    <?php
    $sql = "SELECT trim(a.hr_group_learning) as gl,count(*) as pnt FROM `tb_human_resources_01` a 
right outer join tb_group_learning b 
on a.hr_group_learning = b.tb_group_learningcol_name
where a.hr_department = '" . $r['sc_thai_name'] . "' 
group by trim(a.hr_group_learning) order by trim(a.hr_group_learning)";


    $query = $this->db->query($sql);
    foreach ($query->result() as $row) {
        echo "{ label: \"" . $row->gl . "\", y: " . $row->pnt . " },";
    }
    ?>

                        ]
                },
    <?php
}
?>
            ]
    };
    $("#chartTAStd").CanvasJSChart(optionsTAStd);
    $("#chartTAGL").CanvasJSChart(optionsTAGL);
    $("#chartHRG").CanvasJSChart(optionsHRG);
    var optionsStd = {
    exportEnabled: true,
            animationEnabled: true,
            title: {
            text: "จำนวนนักเรียนแยก ชาย-หญิง",
                    fontSize:16,
                    fontFamily:'Sarabun'
            },
            axisY: {
            suffix: "%"
            },
            toolTip: {
            shared: true
            },
            legend: {
            verticalAlign: "center",
                    horizontalAlign: "right"
            },
            data: [
            {
            type: "stackedColumn", //change it to line, area, bar, pie,column etc
//                    indexLabel: "ชาย - {y} คน",
                    showInLegend: true,
                    name : "ชาย",
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
//                    indexLabel: "หญิง - {y} คน",
                    showInLegend: true,
                    name : "หญิง",
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
    $("#chartStd").CanvasJSChart(optionsStd);
    }


</script>


