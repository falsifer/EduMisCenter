<div class="panel panel-primary">
    <div class="panel-heading">ข้อมูลการจัดสรรงบประมาณให้สถานศึกษาในสังกัด</div>
    <ul class="breadcrumb">
        <li><?php echo anchor(site_url(), "<i class='icon-home icon-large'></i> หน้าแรก"); ?></li>
        <li>รายละเอียด</li>
    </ul>
    <div class="panel-body">
        <div class='row'>
            <div class="col-md-12">
                <div id="chartSchBG" style="height: 370px; max-width: 920px; margin: 0px auto;"></div>
            </div>
        </div>
        <div class="row">
            <div class="table-responsive">
                <table class="table table-hover table-striped table-bordered display" id="example" style="width:100%;">
                    <thead>
                        <tr>
                            <th style="width:40px;">ที่</th>
                            <th class="no-sort">ชื่อโรงเรียน</th>
                            <th class="no-sort">ประเภท</th>
                            <th class="no-sort">โทรศัพท์</th>
                            <th class="no-sort">โทรสาร</th>
                            <th class="no-sort">อีเมล์</th>
                            <th class="no-sort">เวบไซต์</th>
                            <th class="no-sort">ผู้อำนวยการ</th>
                            <th class="no-sort">โทรศัพท์มือถือ</th>
                            <th class="no-sort" style="width:8%;"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $row = 1; ?>
                        <?php foreach ($rs as $r): ?>
                            <tr>
                                <td style="text-align:center;"><?php echo $row; ?></td>
                                <td><?php echo $r['sc_thai_name'] ?></td>
                                <td style="text-align:center;"><?php echo $r['school_type']; ?></td>
                                <td><?php echo $r['sc_address_telephone']; ?></td>
                                <td><?php echo $r['sc_address_fax']; ?></td>
                                <td><?php echo $r['sc_email']; ?></td>
                                <td><?php echo $r['sc_website']; ?></td>
                                <td></td>
                                <td></td>
                                <td>
                                    <div class="btn-group pull-right">
                                        <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            ดำเนินการ <span class="caret"></span>
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li><a href="<?php echo site_url('loan-define-detail/' . $r['id']); ?>">กำหนดงบประมาณตั้งไว้</a></li>
                                            <li role="separator" class="divider"></li>
                                            <li><a href="<?php echo site_url('school-loan-detail/' . $r['id']); ?>">ข้อมูลการจัดสรรงบประมาณ</a></li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                            <?php $row++; ?>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="panel-footer" style="padding-top: 0px;">
        <div class="row">
            <div class="col-md-8">
                <?php echo img("images/kmk_logo.png"); ?>
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
        }
    });
    $('.sorting_asc').removeClass('sorting_asc');
    $(".btn-insert").click(function () {
        $("#insert-form").trigger("reset");
        $("h3.modal-title").text("บันทึกข้อมูลการจัดสรรงบประมาณ");
        $("#loan-management-modal").modal("show");
    });
    // Tool tips;
    $(function () {
        $('[data-toggle="tooltip"]').tooltip();
    });
    $('.table-responsive').on('show.bs.dropdown', function () {
        $('.table-responsive').css("overflow", "inherit");
    });

    $('.table-responsive').on('hide.bs.dropdown', function () {
        $('.table-responsive').css("overflow", "auto");
    });
</script>


<script>

    window.onload = function () {


        // budget stat
        var optionsSchBG = {
        exportEnabled: true,
                animationEnabled: true,
                title: {
                text: "การมาเรียน วันที่ <?php echo datethai(date('Y-m-d')); ?>",
                        fontSize:16,
                        fontFamily:'Sarabun'
                },
                data: [
                {
                type: "pie", //change it to line, area, bar, pie,column etc
                        indexLabel: "{name} - {y} คน",
                        dataPoints: [
<?php foreach ($absentStdStat as $r): ?>
    <?php
    $tmp = "";
    switch ($r['tb_student_absent_record_status']) {
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
        $("#chartSchBG").CanvasJSChart(optionsSchBG);



    }


</script>