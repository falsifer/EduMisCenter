<div class="box">
    <div class="box-heading"><i class="icon-user icon-large"></i>ระบบรายงานประกันคุณภาพภายในสถานศึกษา</div>
    <ul class="breadcrumb">
        <li><?php echo anchor(site_url(), "<i class='icon-home icon-large'></i> หน้าแรก"); ?></li>
        <li>งานประกันคุณภาพ</li>
    </ul>
    <div class="panel with-nav-tabs panel-default">
        <div class="panel-heading">
            <ul class="nav nav-tabs">
                <li class="active"><a href="#tab1default" data-toggle="tab">ขั้นพื้นฐาน</a></li>
                <li><a href="#tab2default" data-toggle="tab">ปฐมวัย</a></li>
            </ul>
        </div>
        <div class="panel-body">
            <div class="tab-content">
                <div class="tab-pane fade in active" id="tab1default">

                    <div class="table-responsive"  >
                        <div id='columnchart_material' class="databox"></div>
                    </div>
                </div>
                <div class="tab-pane fade" id="tab2default" >
                    <div class="table-responsive">
                        <div id='columnchart_material2' class="databox"></div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!--    <div class="databox" style="padding-top:10px;border:1px solid #C9302C;">
            <h3>กราฟแสดงผลการประเมินคุณภาพภายในสถานการศึกษา</h3>
            <div class="col-md-12 ">
                <input class="magic-radio " type="radio" name="inActivityPlanPublic"  value="2" id="r1" ><label for="r1">ขั้นพื้นฐาน</label>&nbsp;
                <input class="magic-radio " type="radio" name="inActivityPlanPublic"  value="1" id="r2" checked><label for="r2">ปฐมวัย</label>
            </div>
            <div style="clear: both"></div>
            <div id='columnchart_material'></div>
        </div>-->
    <div class="box-body">
        <div class="table-responsive">
            <table class="table table-hover table-striped table-bordered display" id="example">
                <thead>
                    <tr>
                        <th style="width:40px;">ที่</th>
                        <th class="no-sort">โรงเรียน</th>
                        <th class="no-sort">การประเมินตนเองประจำปี</th>
                        <th class="no-sort">การกำกับติดตามตรวจสอบ</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td style="width:40px;">1.</td>
                        <td>โรงเรียนเทศบาล ๑</td>
                        <td style="text-align:center;">
                            <?php echo img('images/checked.png'); ?>
                        </td>
                        <td style="text-align:center;"><button type="button" class="btn btn-success" id="1"><i class="icon-search icon-large"></i> รายงาน</button>
                        </td>
                    </tr>
                    <tr>
                        <td style="width:40px;">2.</td>
                        <td>โรงเรียนเทศบาล ๒</td>
                        <td style="text-align:center;" class="text-danger">
                            X
                        </td>
                        <td style="text-align:center;"><button type="button" class="btn btn-warning" id="1"><i class="icon-mail-forward icon-large"></i> แจ้งเตือน</button>
                        </td>
                    </tr>
                </tbody>
<!--                                <tbody>
                <?php $row = 1; ?>
                <?php foreach ($rs as $r): ?>
                    <?php // if ($r['username'] != 'admin'): ?>
                                            <tr>
                                                <td style="text-align:center;"><?php echo $row; ?></td>
                                                <td><?php echo $r['qa_owner']; ?></td>
                                                <td><?php echo $r['tb_activity_plan_type']; ?></td>                                              
                                                <td style="text-align: center;">
                                                    <button type="button" class="btn btn-warning btn-edit" id="<?php echo $r['id']; ?>"><i class="icon-pencil icon-large"></i> แก้ไข</button>
                                                    <button type="button" class="btn btn-danger btn-delete" id="<?php echo $r['id']; ?>"><i class="icon-trash icon-large"></i> ลบ</button>
                                                </td>

                                            </tr>
                    <?php // endif; ?>
                    <?php $row++; ?>
                <?php endforeach; ?>
                </tbody>-->
            </table>
        </div>
    </div>

</div>
<div class="box-footer" style="padding-top: 0px;">
    <div class="row">
        <div class="col-md-8">
            <?php echo img("images/footer_logox.png"); ?>
        </div>
        <div class="col-md-4" style="padding-top:8px;padding-bottom: 8px;padding-right:30px;">
            <span class="pull-right"><span style="color:#999999;">eSchool Version 1.0</span></span>
        </div>
    </div>
</div>
</div>

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





    $('.sorting_asc').removeClass('sorting_asc');
    //
    var status = "<?php //echo $this->session->userdata("status");                          ?>";
    $("div#example_length.dataTables_length").append("&nbsp;<button class='btn btn-default btn-insert'><i class='icon-print icon-large'></i> พิมพ์ข้อมูล</button>");
//    $("div#example_length.dataTables_length").append("&nbsp;<a href='<?php echo site_url('hr01'); ?>' class='btn btn-default'><i class='icon-plus icon-large'></i> บันทึกข้อมูล</a>");

    $('.table-responsive').on('show.bs.dropdown', function () {
        $('.table-responsive').css("overflow", "inherit");
    });

    $('.table-responsive').on('hide.bs.dropdown', function () {
        $('.table-responsive').css("overflow", "auto");
    });



    $("#example").on("click", ".btn-edit", function () {
        var uid = $(this).attr('id');
        $.ajax({
            url: "<?php echo site_url('Vichakarn/activity_plan_edit'); ?>",
            method: "post",
            data: {id: uid},
            dataType: "json",
            success: function (data) {

                $("#id").val(data.id);
                $('#inActivityPlanSubject').val(data.tb_activity_plan_subject);
                $("#inActivityPlanDetail").val(data.tb_activity_plan_detail);
                $("#inActivityPlanStartDate").val(data.tb_activity_plan_start_date);
                $("#inActivityPlanEndDate").val(data.tb_activity_plan_end_date);
                $("#inActivityPlanType").val(data.tb_activity_plan_type);
                $('h4.modal-title').text('แก้ไขข้อมูลรายละเอียดแผนการศึกษาและปฏิทินปฏิทินปฏิบัติ');
                if (data.tb_activity_plan_public === 'Y') {
                    $('input[name="inActivityPlanPublic"]')[0].checked = true;
                } else {
                    $('input[name="inActivityPlanPublic"]')[1].checked = true;
                }
                $('#insert-modal').modal('show');

            }
        });
    });



</script>

<!-- Load Google chart api -->
<script type="text/javascript" src="https://www.google.com/jsapi"></script>
<script type="text/javascript">
    google.load("visualization", "1.1", {packages: ['bar', 'timeline']});
    google.setOnLoadCallback(drawChart);
//    googles.setOnLoadCallback(drawChart2);
    function drawChart() {
        var data = google.visualization.arrayToDataTable([
            [{type: 'string', label: 'ปีการศึกษา'}, {type: 'number', label: 'มาตรฐานด้านปัจจัยทางการศึกษา'}, 'มาตรฐานด้านกระบวนการทางการศีกษา', 'มาตรฐานด้านผลผลิตทางการศึกษา'],
<?php
foreach ($chart_data as $data) {
    echo '[' . $data->performance_year . ',' . $data->performance_sales . ',' . $data->performance_expense . ',' . $data->performance_profit . '],';
}
?>
        ]);

        var options = {
            chart: {
//                    title: 'Company Performance',
//                    subtitle: 'Sales, Expenses, and Profit: <?php echo $min_year . '-' . $max_year; ?>'
            }
        };

        var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

        chart.draw(data, options);


    }

  


    /*   function drawChart2() {
     var data = google.visualization.arrayToDataTable([
     [{type: 'string', label: 'ปีการศึกษา'}, {type: 'number', label: 'มาตรฐานด้านปัจจัยทางการศึกษา'}, 'มาตรฐานด้านกระบวนการทางการศีกษา', 'มาตรฐานด้านผลผลิตทางการศึกษา'],
<?php
//  echo '[' . $data->performance_year . ',' . $data->performance_sales . ',' . $data->performance_expense . ',' . $data->performance_profit . '],';
//}foreach ($chart_data2 as $data) {
//    echo '[' . $data->performance_year . ',' . $data->performance_sales . ',' . $data->performance_expense . ',' . $data->performance_profit . '],';
//}
?>
     ]);
     
     var options = {
     chart: {
     //                    title: 'Company Performance',
     //                    subtitle: 'Sales, Expenses, and Profit: <?php echo $min_year . '-' . $max_year; ?>'
     }
     };
     
     var chart = new google.charts.Bar(document.getElementById('columnchart_material2'));
     
     chart.draw(data, options);
     
     
     }*/
</script>