<div class="box">
    <div class="box-heading">ข้อมูลการวางแผนอัตรากำลัง
        <!--<button class='btn btn-add btn-primary ' style="float: right;margin-right: 3px;" ><i class='icon-save icon-large'></i> การวางแผนอัตรากำลัง</button>-->
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
                                    <th class="no-sort" style="text-align:center;"><?php echo $r['hr_year_birthday']; ?></th>
                                <?php endforeach; ?>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>

                                <?php foreach ($mp as $r): ?>
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
                            <th class="no-sort" style="text-align:center;"><?php echo date('Y') + 543; ?></th>
                            <th class="no-sort" style="text-align:center;"><?php echo date('Y') + 543 + 1; ?></th>
                            <th class="no-sort" style="text-align:center;"><?php echo date('Y') + 543 + 2; ?></th>
                            <th class="no-sort" style="text-align:center;"><?php echo date('Y') + 543 + 3; ?></th>
                            <th class="no-sort" style="text-align:center;"><?php echo date('Y') + 543 + 4; ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
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

            <div class="col-md-6">
                <div id="chartContainer" style="height: 370px; max-width: 920px; margin: 0px auto;"></div>
            </div>
            <div class="col-md-6">
                <div id="chartTAStd" style="height: 370px; max-width: 920px; margin: 0px auto;"></div>
            </div>
        </div>
        <div class="row" style="margin-top: 20px;">
            <div class="col-md-6">
                <div id="chartTAGL" style="height: 370px; max-width: 920px; margin: 0px auto;"></div>
            </div>
            <div class="col-md-6">
                <div id="chartHRG" style="height: 370px; max-width: 920px; margin: 0px auto;"></div>
            </div>
        </div>

    </div>

    <div class="box-footer" style="padding-top: 0px;">
        <div class="row">
            <div class="col-md-8" style="padding-top:3px;padding-right:8px;font-size:15px;color:#666;">
                <img src="<?php echo base_url() . 'images/box_logo.png' ?>" /> สถาบันเทคโนโลยีพระจอมเกล้าเจ้าคุณทหารลาดกระบัง
            </div>
            <div class="col-md-4" style="padding-top:8px;padding-bottom: 8px;padding-right:30px;">
                <span class="pull-right"><span style="color:#999999;">eSchool Version 4.0 (2018)</span></span>
            </div>
        </div>
    </div>
</div>
<!---------------------------------------------------------------------------->
<script>
    $('#example').DataTable({
    "responsive": true,
            "stateSave": true,
            "bSort": false,
            "ordering": true,
            columnDefs: [{
            orderable: false,
                    targets: "no-sort"
            }],
            "language": {
            "lengthMenu": "แสดง _MENU_ แถวต่อหน้า",
                    "zeroRecords": "## ไม่มีข้อมูล ##",
                    "info": "แสดงหน้าที่ _PAGE_ ในทั้งหมด _PAGES_ หน้า",
                    "infoEmpty": "",
                    "infoFiltered": "",
                    "sSearch": "ระบุคำค้น",
                    "sPaginationType": "full_numbers"
            },
    });
    $('.sorting_asc').removeClass('sorting_asc');</script>


<script type="text/javascript">

//    
    $(".btn-add").on("click", function () {
    location.href = "<?php echo site_url('human-planing/'); ?>";
    });
    window.onload = function () {

//Better to construct options first and then pass it as a parameter
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
            text: "จำนวนครูและนักเรียน"
            },
            data: [
            {
            type: "pie", //change it to line, area, bar, pie,column etc
                    showInLegend: true,
                    indexLabel: "{name} {y} คน",
                    dataPoints: [
                    {y: <?php echo $TaStat; ?>, name:"ครู", exploded: true },
                    {y: <?php echo $StdStat; ?>, name:"นักเรียน"},
                    ]
            }
            ]
    };
    var optionsTAGL = {
    exportEnabled: true,
            animationEnabled: true,
            title: {
            text: "จำนวนครูแยกตามกลุ่มสาระ"
            },
            data: [
            {
            type: "column", //change it to line, area, bar, pie,column etc
                    indexLabel: "{y} คน",
                    click: explodePie,
                    dataPoints: [
<?php foreach ($TaGroupL as $r): ?>

                        {y: <?php echo $r['pnt']; ?>, name:"<?php echo $r['hr_group_learning']; ?>", label:"<?php echo $r['hr_group_learning']; ?>"},
<?php endforeach; ?>

                    ]
            }
            ]
    };
    var optionsHRG = {
    exportEnabled: true,
            animationEnabled: true,
            showInLegend: true,
            title: {
            text: "จำนวนบุคลากรแยกตามประเภท"
            },
            data: [
            {
            type: "pie", //change it to line, area, bar, pie,column etc
                    indexLabel: "{name} {y} คน",
                    click: explodePie,
                    dataPoints: [
<?php foreach ($HrGroup as $r): ?>

                        {y: <?php echo $r['pnt']; ?>, name:"<?php echo $r['hr_rank']; ?>" },
<?php endforeach; ?>

                    ]
            }
            ]
    };
    $("#chartContainer").CanvasJSChart(options);
    $("#chartTAStd").CanvasJSChart(optionsTAStd);
    $("#chartTAGL").CanvasJSChart(optionsTAGL);
    $("#chartHRG").CanvasJSChart(optionsHRG);
    }



    function explodePie(){
    alert('ny');
    }


</script>
