<div class="container-fluid">
    <!-- Left side -->
    <div class="col-md-10">
        <div class="databox" style="padding-top:10px;border-top:2px solid #EE7808;">
            <h3>ปฏิทินการศึกษา</h3>
            <div id="calendar"></div>
        </div>
        <?php $this->load->view("modals/vichakarn/active_plan_insert_modal"); ?>
        <!-- TAB -->
        <div class="databox" style="margin-top:20px;border-top:2px solid #EE7808;">
            <div id="exTab2" class="container-fluid">	
                <ul class="nav nav-tabs">
                    <li class="active">
                        <a  href="#1" data-toggle="tab"><b>กิจกรรมเดือน <?php echo month_num(date("m")); ?> <?php echo (date("Y") + 543); ?></b></a>
                    </li>
                    <li><a href="#3" data-toggle="tab"><b>กิจกรรตลอดทั้งปี</b></a></li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active" id="1" style="padding-top:10px;">
                        <h4>กิจกรรมการศึกษาประจำเดือน <?php echo month_num(date("m")); ?></h4>
                        <table class="table table-hove table-striped table-hover table-bordered" id="example">
                            <thead>
                                <tr>
                                    <th class="no-sort" rowspan="2">ที่</th>
                                    <th class="no-sort" rowspan="2">วัน/เดือน/ปี</th>
                                    <th class="no-sort" rowspan="2">กิจกรรม</th>
                                    <th class="no-sort" rowspan="2">ผู้รับผิดชอบ</th>
                                    <th class="no-sort" rowspan="2">สถานที่</th>
                                    <th class="no-sort" colspan="3">สถานะ</th>
                                    <?php if ($this->session->userdata() == "ผู้ปฏิบัติงาน" && $this->session->userdata("responsible") == "งานธุรการ"): ?>
                                        <th class="no-sort" style="width:14%;" rowspan="2"></th>
                                    <?php endif; ?>
                                    <th rowspan="2">&nbsp;</th>
                                </tr>
                                <tr>
                                    <th class="no-sort">No Action</th>
                                    <th class="no-sort">In Action</th>
                                    <th class="no-sort">Success</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $row = 1; ?>
                                <?php foreach ($rs as $r): ?>
                                    <?php // if ($r['username'] != 'admin'): ?>
                                    <tr>
                                        <td style="text-align:center;"><?php echo $row; ?></td>
                                        <td><?php echo $r['tb_activity_plan_start_date'] == $r['tb_activity_plan_end_date'] ? $r['tb_activity_plan_start_date'] : $r['tb_activity_plan_start_date'] . " ถึง " . $r['tb_activity_plan_end_date']; ?></td>
                                        <!--td><?php // echo $r['tb_activity_plan_type'];      ?></td-->                                              
                                        <td><?php echo $r['tb_activity_plan_subject']; ?></td>
                                        <td><?php echo $r['tb_activity_plan_create_by']; ?></td>
                                        <td><?php echo $r['tb_activity_plan_place']; ?></td>
                                        <?php
                                        if ($r['tb_activity_plan_status'] === 'A') {
                                            echo '<td></td>
                                    <td style="text-align:center;">' . img('images/checked.png') . '</td>
                                    <td></td>';
                                        } elseif ($r['tb_activity_plan_status'] === 'N') {
                                            echo '<td style="text-align:center;">' . img('images/checked.png') . '</td>
                                    <td></td>
                                    <td></td>';
                                        } elseif ($r['tb_activity_plan_status'] === 'S') {
                                            echo '<td></td>
                                    <td></td>
                                    <td style="text-align:center;">' . img('images/checked.png') . '</td>
                                    ';
                                        }
                                        ?>
    <!--                                            <td><?php // echo $r['tb_activity_plan_public'] == "Y" ? "สาธารณะ" : "ภายใน";      ?></td>-->
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

                    <div class="tab-pane" id="3" style="padding-top:10px;">
                        <h4>กิจกรรมการศึกษาตลอดทั้งปี</h4>
                        <table class="table table-hove table-striped table-hover table-bordered" id="example2">
                            <thead>
                                <tr>
                                    <th class="no-sort" rowspan="2">ที่</th>
                                    <th class="no-sort" rowspan="2">วัน/เดือน/ปี</th>
                                    <th class="no-sort" rowspan="2">กิจกรรม</th>
                                    <th class="no-sort" rowspan="2">ผู้รับผิดชอบ</th>
                                    <th class="no-sort" rowspan="2">สถานที่</th>
                                    <th class="no-sort" colspan="3">สถานะ</th>
                                    <?php if ($this->session->userdata() == "ผู้ปฏิบัติงาน" && $this->session->userdata("responsible") == "งานธุรการ"): ?>
                                        <th class="no-sort" style="width:14%;" rowspan="2"></th>
                                    <?php endif; ?>
                                    <th  class="no-sort" rowspan="2">&nbsp;</th>
                                </tr>
                                <tr>
                                    <th class="no-sort">No Action</th>
                                    <th class="no-sort">In Action</th>
                                    <th class="no-sort">Success</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $row = 1; ?>
                                <?php foreach ($rsY as $r): ?>
                                    <?php // if ($r['username'] != 'admin'): ?>
                                    <tr>
                                        <td style="text-align:center;"><?php echo $row; ?></td>
                                        <td><?php echo $r['tb_activity_plan_start_date'] == $r['tb_activity_plan_end_date'] ? $r['tb_activity_plan_start_date'] : $r['tb_activity_plan_start_date'] . " ถึง " . $r['tb_activity_plan_end_date']; ?></td>
                                        <!--td><?php // echo $r['tb_activity_plan_type'];      ?></td-->                                              
                                        <td><?php echo $r['tb_activity_plan_subject']; ?></td>
                                        <td><?php echo $r['tb_activity_plan_create_by']; ?></td>
                                        <td><?php echo $r['tb_activity_plan_place']; ?></td>
                                        <?php
                                        if ($r['tb_activity_plan_status'] === 'A') {
                                            echo '<td></td>
                                    <td style="text-align:center;">' . img('images/checked.png') . '</td>
                                    <td></td>';
                                        } elseif ($r['tb_activity_plan_status'] === 'N') {
                                            echo '<td style="text-align:center;">' . img('images/checked.png') . '</td>
                                    <td></td>
                                    <td></td>';
                                        } elseif ($r['tb_activity_plan_status'] === 'S') {
                                            echo '<td></td>
                                    <td></td>
                                    <td style="text-align:center;">' . img('images/checked.png') . '</td>
                                    ';
                                        }
                                        ?>
                                        <!--<td><?php // echo $r['tb_activity_plan_public'] == "Y" ? "สาธารณะ" : "ภายใน";      ?></td>-->
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
    <!-- Right side -->
    <div class="col-md-2">
        
    </div>
    
    <!--
    <div class="col-md-2 databox" style="border-top:2px solid #EE7808;padding:0px;">
        <div class="row" style="margin-top:0px;text-align:center;">
            <div class="col-md-12" style="padding-left:0px;">
                <button type="button" class="btn btn-info btn-submenu" onclick="javascript:location.href = '<?php echo site_url('stock-of-documents'); ?>';"><i class="icon-archive icon-large pull-left"></i><?php echo nbs(3); ?>คลังเอกสารต่าง ๆ</button>
                <button type="button" class="btn btn-info btn-submenu" onclick="javascript:location.href = '<?php echo site_url('picture-stock'); ?>';"><i class="icon-camera icon-large pull-left"></i><?php echo nbs(3); ?>คลังภาพสำนักงาน</button>
            </div>
        </div>

        <div class="row" style="margin-top:8px;text-align:center;">
            <div class="col-md-12" style="padding-left:0px;padding-right:4px;">
                <button type="button" style="margin-bottom:5px;"  class="btn btn-primary btn-submenu" onclick="javascript:location.href = '<?php echo site_url('human_resources'); ?>';"><i class="icon-user icon-large pull-left"></i><?php echo nbs(3); ?>ทำเนียบบุคลากร</button>
                <button type="button" style="margin-bottom:5px;"  class="btn btn-primary btn-submenu" onclick="javascript:location.href = '<?php echo site_url('human_resources'); ?>';"><i class="icon-group icon-large pull-left"></i><?php echo nbs(3); ?>ข้อมูลอัตรากำลัง</button>
            </div>
        </div>
        <div class="row" style="margin-top:8px;text-align:center;">
            <div class="col-md-12" style="padding-left:0px;padding-right:4px;">
                <button type="button" style="margin-bottom:5px;" class="btn btn-success btn-submenu" onclick="javascript:location.href = '<?php echo site_url('km-base'); ?>';"><i class="icon-book icon-large"></i><?php echo nbs(3); ?>แหล่งเรียนรู้</button>
                <button type="button" class="btn btn-success btn-submenu" onclick="javascript:location.href = '<?php echo site_url('network-of-km'); ?>';"><i class="icon-comments icon-large"></i><?php echo nbs(3); ?>เครือข่ายสารสนเทศ</button>
            </div>
        </div>
        <div class="row" style="margin-top:8px;text-align:center;">
            <div class="col-md-12" style="padding-left:0px;padding-right:4px;">
                <button type="button" style="margin-bottom:5px;"  class="btn btn-warning btn-submenu" onclick="javascript:location.href = '<?php echo site_url('go-to-inbox'); ?>';"><i class="icon-inbox icon-large"></i><?php echo nbs(3); ?>รับ-ส่งหนังสือ</button>
                <button type="button" style="margin-bottom:5px;"  class="btn btn-warning btn-submenu" onclick="javascript:location.href = '<?php echo site_url('documents-stock'); ?>';"><i class="icon-stackexchange icon-large"></i><?php echo nbs(3); ?>การนิเทศการศึกษา</button>
            </div>
        </div>
        <div class="row" style="margin-top:8px;text-align:center;">
            <div class="col-md-12" style="padding-left:0px;padding-right:4px;">
                <button type="button" style="margin-bottom:5px;"  class="btn btn-success btn-submenu"><i class="icon-money icon-large"></i><?php echo nbs(3); ?>จัดสรรงบประมาณ</button>
                <button type="button" style="margin-bottom:5px;"  class="btn btn-success btn-submenu" onclick="javascript:location.href = '<?php echo site_url('record-employee-activities'); ?>';"><i class="icon-calendar icon-large"></i><?php echo nbs(3); ?>บันทึกการปฏิบัติงาน</button>
            </div>
        </div>
    </div>
    -->
</div>

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
//        select: function (startDate, endDate) {
//
//            $('#insert-modal').modal();
//            $("#inActivityPlanStartDate").val(startDate.format());
//            $("#inActivityPlanEndDate").val(endDate.format());
//        },
        events: [
<?php foreach ($rsY as $r): ?>
                {
                    id: '<?php echo $r['id']; ?>',
                    title: '<?php echo $r['tb_activity_plan_subject']; ?>',
    <?php echo $r['tb_activity_plan_start_date'] == $r['tb_activity_plan_end_date'] ? "start  : '" . $r['tb_activity_plan_start_date'] . "'" : "start  : '" . $r['tb_activity_plan_start_date'] . "',  end : '" . $r['tb_activity_plan_end_date'] . "'"; ?>

                },
<?php endforeach; ?>

        ]
//        events: [
//            {
//                title: 'วันหยุดไม่ทำงาน',
//                start: '2018-11-01',
//                end: '2018-11-01',
//                url: 'http://www.google.com',
//                /*rendering: 'background',*/
//                color: '#ff9f89'
//            },
//            {
//                title: 'Long Event',
//                start: '2018-11-07',
//                end: '2018-11-10',
//                color: '#d4e157'
//
//            },
//            {
//                id: 999,
//                title: 'Repeating Event',
//                start: '2018-11-09T16:00:00',
//                color:'#bcaaa4'
//            },
//            {
//                id: 999,
//                title: 'Repeating Event',
//                start: '2018-11-16T16:00:00'
//            },
//            {
//                title: 'Conference',
//                start: '2018-11-11',
//                end: '2018-11-13',
//                color:'#1de9b6'
//            },
//            {
//                title: 'วันลอยกระทง',
//                start: '2018-11-22',
//                end: '2018-11-13'
//            },
//            {
//                title: 'Meeting',
//                start: '2018-11-12T10:30:00',
//                end: '2018-11-12T12:30:00'
//            },
//            {
//                title: 'Lunch',
//                start: '2018-11-12T12:00:00'
//            },
//            {
//                title: 'Meeting',
//                start: '2018-11-12T14:30:00'
//            },
//            {
//                title: 'Happy Hour',
//                start: '2018-11-12T17:30:00'
//            },
//            {
//                title: 'Dinner',
//                start: '2018-11-12T20:00:00'
//            },
//            {
//                title: 'Birthday Party',
//                start: '2018-11-13T07:00:00'
//            },
//            {
//                title: 'Click for Google',
//                url: 'http://google.com/',
//                start: '2018-11-28'
//            }
//        ]

    });


    $('#example').DataTable({
        "responsive": true,
        "stateSave": true,
        "bSort": false,
        "ordering": false,
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
        "ordering": false,
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
    var status = "<?php //echo $this->session->userdata("status");                        ?>";
    $("div#example_length.dataTables_length").append("&nbsp;<button class='btn btn-default btn-insert'><i class='icon-print icon-large'></i> พิมพ์ข้อมูล</button>");
//    $("div#example_length.dataTables_length").append("&nbsp;<a href='<?php echo site_url('hr01'); ?>' class='btn btn-default'><i class='icon-plus icon-large'></i> บันทึก</a>");
    $("div#example_length.dataTables_length").append("&nbsp;<button  class='btn btn-default' data-toggle='modal' data-target='#insert-modal'><i class='icon-plus icon-large'></i> บันทึก</button>");
//
    $("div#example2_length.dataTables_length").append("&nbsp;<button class='btn btn-default btn-insert'><i class='icon-print icon-large'></i> พิมพ์ข้อมูล</button>");
//    $("div#example_length.dataTables_length").append("&nbsp;<a href='<?php echo site_url('hr01'); ?>' class='btn btn-default'><i class='icon-plus icon-large'></i> บันทึก</a>");
    $("div#example2_length.dataTables_length").append("&nbsp;<button  class='btn btn-default' data-toggle='modal' data-target='#insert-modal'><i class='icon-plus icon-large'></i> บันทึก</button>");
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
                $('#insert-modal').modal('show');

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
