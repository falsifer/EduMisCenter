<div class="box">
    <div class="box-heading">ข้อมูลการวางแผนอัตรากำลัง
        <button class='btn btn-add btn-primary ' style="float: right;margin-right: 3px;" ><i class='icon-save icon-large'></i> การวางแผนอัตรากำลัง</button>
    </div>
    <ul class="breadcrumb">
        <li><?php echo anchor(site_url(), "<i class='icon-home icon-large'></i> หน้าแรก"); ?></li>
        <li>ข้อมูลการวางแผนอัตรากำลัง</li>
    </ul>
    <div class="box-body">
        <div class="row"><?php
            $row = -1;
            foreach ($mp as $r): $row++;
            endforeach;
            ?>
            <?php if ($row > 0) { ?>
                <div class="box-heading">อัตรากำลังที่จะเกษียนอายุในอีก <?php echo $row; ?> ปีข้างหน้า</div>
                <div class="table-responsive">
                    <table class="table table-hover table-striped table-bordered display" id="mp" >
                        <thead>
                            <tr>
                                <?php foreach ($mp as $r): ?>
                                    <th class="no-sort" colspan="2" style="text-align:center;"><?php echo $r['hr_year_birthday']; ?></th>
                                <?php endforeach; ?>
                            </tr>
                            <tr>
                                <?php for ($i = 0; $i < $row; $i++) { ?>
                                    <th class="no-sort" style="text-align:center;">กอง/สำนักการศึกษา</th>
                                    <th class="no-sort" style="text-align:center;">โรงเรียนในสังกัด</th>
                                <?php } ?>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>

                                <?php foreach ($mp as $r): ?>
                                    <td style="text-align:center;"><?php echo $r['cnt']; ?></td>
                                    <td style="text-align:center;"><?php echo $r['cnt']; ?></td>
                                <?php endforeach; ?>
                            </tr>
                        </tbody>
                    </table>
                </div>
            <?php }else { ?>
                <div class="box-heading">อัตรากำลังที่จะเกษียนอายุในอีก 4 ปีข้างหน้า</div>
                <table class="table table-hover table-striped table-bordered display" id="mp" >
                    <thead>
                        <tr>
                            <th class="no-sort" style="text-align:center;" colspan="2"><?php echo date('Y') + 543; ?></th>
                            <th class="no-sort" style="text-align:center;" colspan="2"><?php echo date('Y') + 543 + 1; ?></th>
                            <th class="no-sort" style="text-align:center;" colspan="2"><?php echo date('Y') + 543 + 2; ?></th>
                            <th class="no-sort" style="text-align:center;" colspan="2"><?php echo date('Y') + 543 + 3; ?></th>
                            <th class="no-sort" style="text-align:center;" colspan="2"><?php echo date('Y') + 543 + 4; ?></th>
                        </tr>
                        <tr>
                            <th class="no-sort" style="text-align:center;">กอง/สำนักการศึกษา</th>
                            <th class="no-sort" style="text-align:center;">โรงเรียนในสังกัด</th>
                            <th class="no-sort" style="text-align:center;">กอง/สำนักการศึกษา</th>
                            <th class="no-sort" style="text-align:center;">โรงเรียนในสังกัด</th>
                            <th class="no-sort" style="text-align:center;">กอง/สำนักการศึกษา</th>
                            <th class="no-sort" style="text-align:center;">โรงเรียนในสังกัด</th>
                            <th class="no-sort" style="text-align:center;">กอง/สำนักการศึกษา</th>
                            <th class="no-sort" style="text-align:center;">โรงเรียนในสังกัด</th>
                            <th class="no-sort" style="text-align:center;">กอง/สำนักการศึกษา</th>
                            <th class="no-sort" style="text-align:center;">โรงเรียนในสังกัด</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td style="text-align:center;">0</td>
                            <td style="text-align:center;">0</td>
                            <td style="text-align:center;">0</td>
                            <td style="text-align:center;">0</td>
                            <td style="text-align:center;">0</td>
                            <td style="text-align:center;">0</td>
                            <td style="text-align:center;">0</td>
                            <td style="text-align:center;">0</td>
                            <td style="text-align:center;">0</td>
                            <td style="text-align:center;">0</td>
                        </tr>
                    </tbody>
                </table>
            <?php } ?>
        </div>
        <div class="row">
<!--            <div class="col-md-12">
                <div id="chartContainer" style="height: 370px; max-width: 920px; margin: 0px auto;"></div>
            </div>-->
            <div class="col-md-12" style="margin-top: 10px;">
                <div id="chartTAStd" style="height: 370px; max-width: 920px; margin: 0px auto;"></div>
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
<!---------------------------------------------------------------------------->
<script>

<?php
$tabName = "mp";
$text = "อัตรากำลังที่จะเกษียนอายุในอีก 4 ปีข้างหน้า";
$title = $this->Echo_Text_Model->head_logo($text, $this->session->userdata('sch_id'));
$colStr = "0,1,2,3,4,5,6,7,8,9";
$btExArr = array();
load_datatable($tabName, $btExArr, $title, $colStr);
?>

    $(".btn-add").on("click", function () {
    location.href = "<?php echo site_url('human-planing/'); ?>";
    });
    window.onload = function () {

    var options = {
    exportEnabled: true,
            animationEnabled: true,
            title: {
            text: "การมาทำงานของบุคลากร"
            },
            data: [
            {
            type: "pie", //change it to line, area, bar, pie,column etc
                    indexLabel: "{name} - {y} คน",
                    click: explodePie,
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
left outer join tb_human_resources_type b 
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
left outer join tb_group_learning b 
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
    $("#chartTAStd").CanvasJSChart(optionsTAStd);
    $("#chartTAGL").CanvasJSChart(optionsTAGL);
    $("#chartHRG").CanvasJSChart(optionsHRG);
    $("#chartStd").CanvasJSChart(optionsStd);
//    $("#chartContainer").CanvasJSChart(options);
    }



    function explodePie(){
    //alert('ny');
    }


</script>
