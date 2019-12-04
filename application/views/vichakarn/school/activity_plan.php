<div class="box">
    <div class="box-heading"><i class="icon-user icon-large"></i>การวางแผนงานวิชาการ/ปฏิทินการศึกษา/วางแผนวิชาการ</div>
    <ul class="breadcrumb">
        <li><?php echo anchor(site_url(), "<i class='icon-home icon-large'></i> หน้าแรก"); ?></li>
        <li>ปฏิทินการศึกษาและปฏิบัติงาน</li>
    </ul>

    <!-- Left side -->

    <div class="box-body">
        <div class="row">
            <div class="col-md-9">
                <div class="databox">
                    <div id="calendar">
                    </div>

                    <div class="panel with-nav-tabs panel-default">
                        <div class="panel-heading">
                            <ul class="nav nav-tabs">
                                <li class="active"><a href="#tab1default" data-toggle="tab">แผนการศึกษาและปฏิทินปฏิบัติงานประจำเดือน</a></li>
                                <li><a href="#tab2default" data-toggle="tab">ประจำปี</a></li>
                            </ul>
                        </div>
                        <div class="panel-body">
                            <div class="tab-content">
                                <div class="tab-pane fade in active" id="tab1default">

                                    <div class="table-responsive">
                                        <table class="table table-hover table-striped table-bordered display" id="example">
                                            <thead>
                                                <tr>
                                                    <th style="width:40px;">ที่</th>
                                                    <th class="no-sort">วันที่</th>
                                                    <th class="no-sort">โครงการ/กิจกรรม</th>
                                                    <th class="no-sort">หัวข้อ</th>
                                                    <th class="no-sort">รายละเอียด</th>
                                                    <th class="no-sort">การเผยแพร่</th>
                                                    <th class="no-sort">ผู้รับผิดชอบ</th>
                                                    <?php if ($this->session->userdata("status") == "ผู้ปฏิบัติงาน"): ?>
                                                        <th style="width:13%;" class="no-sort"></th>
                                                    <?php endif; ?>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $row = 1; ?>
                                                <?php foreach ($rs as $r): ?>
                                                    <?php // if ($r['username'] != 'admin'): ?>
                                                    <tr>
                                                        <td style="text-align:center;"><?php echo $row; ?></td>
                                                        <td><?php echo $r['tb_activity_plan_start_date'] == $r['tb_activity_plan_end_date'] ? $r['tb_activity_plan_start_date'] : $r['tb_activity_plan_start_date'] . " ถึง " . $r['tb_activity_plan_end_date']; ?></td>
                                                        <td><?php echo $r['tb_activity_plan_type']; ?></td>                                              
                                                        <td><?php echo $r['tb_activity_plan_subject']; ?></td>
                                                        <td><?php echo $r['tb_activity_plan_detail']; ?></td>
                                                        <td><?php echo $r['tb_activity_plan_public'] == "Y" ? "สาธารณะ" : "ภายใน"; ?></td>
                                                        <td><?php echo $r['tb_activity_plan_create_by']; ?></td>
                                                        <td style="text-align: center;">
                                                            <button type="button" class="btn btn-warning btn-edit" id="<?php echo $r['id']; ?>"><i class="icon-pencil icon-large"></i> แก้ไข</button>
                                                            <button type="button" class="btn btn-danger btn-delete" id="<?php echo $r['id']; ?>"><i class="icon-trash icon-large"></i> ลบ</button>
                                                        </td>

                                                    </tr>
                                                    <?php // endif; ?>
                                                    <?php $row++; ?>
                                                <?php endforeach; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="tab2default">
                                    <div class="table-responsive">
                                        <table class="table table-hover table-striped table-bordered display" id="example2">
                                            <thead>
                                                <tr>
                                                    <th style="width:40px;">ที่</th>
                                                    <th class="no-sort">วันที่</th>
                                                    <th class="no-sort">โครงการ/กิจกรรม</th>
                                                    <th class="no-sort">หัวข้อ</th>
                                                    <th class="no-sort">รายละเอียด</th>
                                                    <th class="no-sort">การเผยแพร่</th>
                                                    <th class="no-sort">ผู้รับผิดชอบ</th>
                                                    <?php if ($this->session->userdata("status") == "ผู้ปฏิบัติงาน"): ?>
                                                        <th style="width:13%;" class="no-sort"></th>
                                                    <?php endif; ?>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $row = 1; ?>
                                                <?php foreach ($rsY as $r): ?>
                                                    <?php // if ($r['username'] != 'admin'): ?>
                                                    <tr>
                                                        <td style="text-align:center;"><?php echo $row; ?></td>
                                                        <td><?php echo $r['tb_activity_plan_start_date'] == $r['tb_activity_plan_end_date'] ? $r['tb_activity_plan_start_date'] : $r['tb_activity_plan_start_date'] . " ถึง " . $r['tb_activity_plan_end_date']; ?></td>
                                                        <td><?php echo $r['tb_activity_plan_type']; ?></td>                                              
                                                        <td><?php echo $r['tb_activity_plan_subject']; ?></td>
                                                        <td><?php echo $r['tb_activity_plan_detail']; ?></td>
                                                        <td><?php echo $r['tb_activity_plan_public'] == "Y" ? "สาธารณะ" : "ภายใน"; ?></td>
                                                        <td><?php echo $r['tb_activity_plan_create_by']; ?></td>
                                                        <td style="text-align: center;">
                                                            <button type="button" class="btn btn-warning btn-edit" id="<?php echo $r['id']; ?>"><i class="icon-pencil icon-large"></i> แก้ไข</button>
                                                            <button type="button" class="btn btn-danger btn-delete" id="<?php echo $r['id']; ?>"><i class="icon-trash icon-large"></i> ลบ</button>
                                                        </td>

                                                    </tr>
                                                    <?php // endif; ?>
                                                    <?php $row++; ?>
                                                <?php endforeach; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right side -->
            <div class="col-md-3">

                <div class="row" style="margin-top:30px;text-align:center;">
                    <div class="col-md-12" style="padding-left:0px;padding-right:4px;">
                        <button type="button" style="margin-bottom:5px;padding: 10px;" class="btn btn-info btn-submenu" onclick="javascript:location.href = '<?php echo site_url('ed-room'); ?>';"><i class="icon-folder-open icon-large"></i> กำหนดห้องเรียน</button>
                    </div>
                </div>
                <div class="row" style="margin-top:8px;text-align:center;">
                    <div class="col-md-12" style="padding-left:0px;padding-right:4px;">
                        <button type="button" style="margin-bottom:5px;padding: 10px;"  class="btn btn-primary btn-submenu" onclick="javascript:location.href = '<?php echo site_url('ed-homeroom'); ?>';"><i class="icon-group icon-large"></i> ครูประจำชั้น</button>
                    </div>
                </div>

                <div class="row" style="margin-top:8px;text-align:center;">
                    <div class="col-md-12" style="padding-left:0px;padding-right:4px;">
                        <button type="button" style="margin-bottom:5px;padding: 10px;"  class="btn btn-success btn-submenu" onclick="javascript:location.href = '<?php echo site_url('ed-schedule'); ?>';"><i class="icon-calendar icon-large"></i> ตารางสอน</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php $this->load->view('layout/my_school_footer'); ?>
</div>
<?php $this->load->view("modals/vichakarn/active_plan_ed_insert_modal"); ?>

<script>

    $('#calendar').fullCalendar({
        header: {
            left: 'prev,next today',
            center: 'title',
            right: 'month,agendaWeek,agendaDay,listYear'
        },
        height: 500,
        locale: "th",
        selectable: true,
        eventClick: function (event) {
            if (event.id !== null) {

                $.ajax({
                    url: "<?php echo site_url('Vichakarn/activity_plan_edit'); ?>",
                    method: "post",
                    data: {id: event.id},
                    dataType: "json",
                    success: function (data) {

                        $("#id").val(data.id);
                        $('#inActivityPlanSubject').val(data.tb_activity_plan_subject);
                        $('#inActivityPlanPlace').val(data.tb_activity_plan_place);
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
            }
        },
        dayClick: function (date) {

            $('#insert-modal').modal();
            $("#inActivityPlanStartDate").val(date.format());
            $("#id").val('');
            $('#inActivityPlanSubject').val('');
            $("#inActivityPlanDetail").val('');
            $("#inActivityPlanEndDate").val('');
            $("#inActivityPlanType").val('');

        },

        events: [
<?php foreach ($rsY as $r): ?>
                {
                    id: '<?php echo $r['id']; ?>',
                    title: '<?php echo $r['tb_activity_plan_subject']; ?>',
                    
    <?php echo $r['tb_activity_plan_start_date'] == $r['tb_activity_plan_end_date'] ? "start  : '" . $r['tb_activity_plan_start_date'] . "'" : "start  : '" . $r['tb_activity_plan_start_date'] . "',  end : '" . date('Y-m-d', strtotime($r['tb_activity_plan_end_date']. ' + 1 days')) . "'"; ?>

                },
<?php endforeach; ?>

        ]
    });

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


    $('#example2').DataTable({
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
    var status = "<?php //echo $this->session->userdata("status");                       ?>";
    $("div#example_length.dataTables_length").append("&nbsp;<button class='btn btn-default btn-insert'><i class='icon-print icon-large'></i> พิมพ์ข้อมูล</button>");
//    $("div#example_length.dataTables_length").append("&nbsp;<a href='<?php echo site_url('hr01'); ?>' class='btn btn-default'><i class='icon-plus icon-large'></i> บันทึกข้อมูล</a>");
    $("div#example_length.dataTables_length").append("&nbsp;<button  class='btn btn-default' data-toggle='modal' data-target='#plan-insert-modal'><i class='icon-plus icon-large'></i> บันทึกข้อมูล</button>");
//
    $("div#example2_length.dataTables_length").append("&nbsp;<button class='btn btn-default btn-insert'><i class='icon-print icon-large'></i> พิมพ์ข้อมูล</button>");
//    $("div#example_length.dataTables_length").append("&nbsp;<a href='<?php echo site_url('hr01'); ?>' class='btn btn-default'><i class='icon-plus icon-large'></i> บันทึกข้อมูล</a>");
    $("div#example2_length.dataTables_length").append("&nbsp;<button  class='btn btn-default' data-toggle='modal' data-target='#insert-modal'><i class='icon-plus icon-large'></i> บันทึกข้อมูล</button>");
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
                $('#plan-insert-modal').modal('show');

            }
        });
    });

    // delete data;
    $("#example").on("click", ".btn-delete", function () {
        var uid = $(this).attr('id');
        var status = confirm('ต้องการลบข้อมูลนี้จริงหรือไม่ ?');
        if (status) {
            $.ajax({
                url: "<?php echo site_url('Vichakarn/activity_plan_delete'); ?>",
                method: "post",
                data: {id: uid},
                success: function (data) {
                    location.reload();
                }
            });
        }
    });

    $("#example2").on("click", ".btn-edit", function () {
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
                $('#plan-insert-modal').modal('show');

            }
        });
    });

    // delete data;
    $("#example2").on("click", ".btn-delete", function () {
        var uid = $(this).attr('id');
        var status = confirm('ต้องการลบข้อมูลนี้จริงหรือไม่ ?');
        if (status) {
            $.ajax({
                url: "<?php echo site_url('Vichakarn/activity_plan_delete'); ?>",
                method: "post",
                data: {id: uid},
                success: function (data) {
                    location.reload();
                }
            });
        }
    });




</script>
