<div class="box">
    <div class="box-heading"><i class='icon-calendar icon-large'></i> ปฏิทินการศึกษา<span class="pull-right" style="margin-right:15px;"><?php echo $this->session->userdata('department'); ?></span></div>
    <!--    <ul class="breadcrumb">
            <li><i class='icon-home icon-large'></i> หน้าแรก</li>
        </ul>-->
    <div class="box-body">

        <div class="row">
            <div class=" col-md-12" style="margin: 0px;">
                <!-- ปฏิทินกิจกรรม -->
                <div class="row">
                    <div class="col-md-12">
                        <div class="databox">
                            <div id="calendarSch">
                            </div>

                            <!--                            <div class="panel with-nav-tabs panel-default">
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
                                                                            <table class="table table-hover table-striped table-bordered display" id="actTab">
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
                            <?php foreach ($rsAct as $r): ?>
                                <?php // if ($r['username'] != 'admin'): ?>
                                                                                            <tr>
                                                                                                <td style="text-align:center;"><?php echo $row; ?></td>
                                                                                                <td><?php echo $r['tb_activity_plan_start_date'] == $r['tb_activity_plan_end_date'] ? $r['tb_activity_plan_start_date'] : $r['tb_activity_plan_start_date'] . " ถึง " . $r['tb_activity_plan_end_date']; ?></td>
                                                                                                <td><?php echo $r['tb_activity_plan_type']; ?></td>                                              
                                                                                                <td><?php echo $r['tb_activity_plan_subject']; ?></td>
                                                                                                <td><?php echo $r['tb_activity_plan_detail']; ?></td>
                                                                                                <td><?php echo $r['tb_activity_plan_public'] == "Y" ? "สาธารณะ" : "ภายใน"; ?></td>
                                                                                                <td><?php echo $r['tb_activity_plan_recorder']; ?></td>
                                                                                                <td style="text-align: center;">
                                                                                                    <button type="button" class="btn btn-warning btn-edit" id="<?php echo $r['id']; ?>"><i class="icon-pencil icon-large"></i> แก้ไข</button>
                                                                                                    <button type="button" class="btn btn-danger btn-delete" id="<?php echo $r['id']; ?>"><i class="icon-trash icon-large"></i> ลบ</button>
                                                                                                </td>
                                
                                                                                            </tr>
                                <?php // endif;  ?>
                                <?php $row++; ?>
                            <?php endforeach; ?>
                                                                                </tbody>
                                                                            </table>
                                                                        </div>
                                                                    </div>
                                                                    <div class="tab-pane fade" id="tab2default">
                                                                        <div class="table-responsive">
                                                                            <table class="table table-hover table-striped table-bordered display" id="actTab2">
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
                            <?php foreach ($rsActY as $r): ?>
                                <?php // if ($r['username'] != 'admin'): ?>
                                                                                            <tr>
                                                                                                <td style="text-align:center;"><?php echo $row; ?></td>
                                                                                                <td><?php echo $r['tb_activity_plan_start_date'] == $r['tb_activity_plan_end_date'] ? $r['tb_activity_plan_start_date'] : $r['tb_activity_plan_start_date'] . " ถึง " . $r['tb_activity_plan_end_date']; ?></td>
                                                                                                <td><?php echo $r['tb_activity_plan_type']; ?></td>                                              
                                                                                                <td><?php echo $r['tb_activity_plan_subject']; ?></td>
                                                                                                <td><?php echo $r['tb_activity_plan_detail']; ?></td>
                                                                                                <td><?php echo $r['tb_activity_plan_public'] == "Y" ? "สาธารณะ" : "ภายใน"; ?></td>
                                                                                                <td><?php echo $r['tb_activity_plan_recorder']; ?></td>
                                                                                                <td style="text-align: center;">
                                                                                                    <button type="button" class="btn btn-warning btn-edit" id="<?php echo $r['id']; ?>"><i class="icon-pencil icon-large"></i> แก้ไข</button>
                                                                                                    <button type="button" class="btn btn-danger btn-delete" id="<?php echo $r['id']; ?>"><i class="icon-trash icon-large"></i> ลบ</button>
                                                                                                </td>
                                
                                                                                            </tr>
                                <?php // endif;  ?>
                                <?php $row++; ?>
                            <?php endforeach; ?>
                                                                                </tbody>
                                                                            </table>
                                                                        </div>
                                                                    </div>
                            
                                                                </div>
                                                            </div>
                                                        </div>-->
                        </div>
                    </div>
                </div>

                <?php $this->load->view("modals/vichakarn/active_plan_insert_modal"); ?>

                <!-- รายการงานที่ต้องทำ -->
                <div class="panel" style="margin:15px 0px;">
                    <div class="panel-heading">รายการงาน (Task List)</div>
                    <div class="panel-body">
                        <!--<div class="table-responsive">-->
                        <table class="table table-hover table-striped table-condensed" id="task-list">
                            <thead>
                                <tr>
                                    <th class="no-sort" style="width:40px;">ที่</th>
                                    <th class="no-sort">กิจกรรม</th>
                                    <th class="no-sort" style="width:25%;">เริ่มต้น - สิ้นสุด</th>
                                    <th class="no-sort">เอกสาร</th>
                                    <th class="no-sort">หมายเหตุ</th>
                                    <th class="no-sort" style="width:18%;"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $row = 1; ?>
                                <?php foreach ($task as $list): ?>
                                    <tr>
                                        <?php if ($list['activities_status'] == "Y"): ?>
                                            <td style="text-align:center;"><?php echo $row; ?></td>
                                            <td style="color:#888;text-decoration:line-through;"><?php echo $list['activities_name']; ?></td>
                                            <td style="color:#888;text-decoration:line-through;"><?php echo datethai($list['activities_begin']); ?> - <?php echo datethai($list['activities_end']); ?></td>
                                            <td style='text-align:center;'>
                                                <?php if (file_exists('upload/' . $list['activities_document']) && !empty($list['activities_document'])): ?>
                                                    <?php echo anchor(base_url() . 'upload/' . $list['activities_document'], img("images/document.png"), array('target' => '_blank')); ?>
                                                <?php endif; ?>
                                            </td>
                                            <td style="color:#888;text-decoration:line-through;"><?php echo $list['activities_comment'] ?></td>
                                        <?php else: ?>
                                            <td style="text-align:center;"><?php echo $row; ?></td>
                                            <td><?php echo $list['activities_name']; ?></td>
                                            <td><?php echo datethai($list['activities_begin']); ?> - <?php echo datethai($list['activities_end']); ?></td>
                                            <td style='text-align:center;'>
                                                <?php if (file_exists('upload/' . $list['activities_document']) && !empty($list['activities_document'])): ?>
                                                    <?php echo anchor(base_url() . 'upload/' . $list['activities_document'], img("images/document.png"), array('target' => '_blank')); ?>
                                                <?php endif; ?>
                                            </td>
                                            <td><?php echo $list['activities_comment'] ?></td>
                                        <?php endif; ?>
                                        <td>
                                            <?php if ($list['activities_status'] == 'Y'): ?>
                                                <button type="button" class="btn btn-warning btn-task-edit" id="<?php echo $list['id']; ?>" disabled><i class="icon-pencil"></i></button>
                                                <button type="button" class="btn btn-danger btn-task-delete" id="<?php echo $list['id']; ?>" disabled><i class="icon-trash"></i></button>
                                                <button type="button" class="btn btn-danger btn-task-success" id="<?php echo $list['id']; ?>" data-toggle="tooltip" title="คลิกเมื่องานเสร็จแล้ว"><i class="icon-remove"></i></button>
                                            <?php else: ?>
                                                <button type="button" class="btn btn-warning btn-task-edit" id="<?php echo $list['id']; ?>"><i class="icon-pencil"></i></button>
                                                <button type="button" class="btn btn-danger btn-task-delete" id="<?php echo $list['id']; ?>"><i class="icon-trash"></i></button>
                                                <button type="button" class="btn btn-success btn-task-success" id="<?php echo $list['id']; ?>" data-toggle="tooltip" title="คลิกเมื่องานเสร็จแล้ว"><i class="icon-ok"></i></button>
                                                <?php endif; ?>
                                        </td>
                                    </tr>
                                    <?php $row++; ?>
                                <?php endforeach; ?>

                            </tbody>
                        </table>
                        <!--</div>-->
                    </div>
                </div>



            </div>
        </div>
    </div> <!-- end of col-md-9 -->
    <?php $this->load->view('layout/my_school_footer'); ?>
</div>

<script>


    $('#calendarSch').fullCalendar({
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
            var uid = event.id;
//            alert(uid);
            if (event.type){
//            alert(uid);
            $.ajax({
            url: "<?php echo site_url('School_calendar/get_task_list_detail_by_id'); ?>",
                    method: "post",
                    data: {id: uid},
//                    dataType: "json",
                    success: function (data) {
                    $("#SchoolCalendatDetailModal").html(data);
                    $('#school-activity-detail-modal').modal('show');
//                    alert('A');
                    }
            });
            } else{
//             alert(uid);
            $.ajax({
            url: "<?php echo site_url('School_calendar/get_activity_plan_detail_by_id'); ?>",
                    method: "post",
                    data: {id: uid},
//                    dataType: "json",
                    success: function (data) {
//                    alert('A');
                    $("#SchoolCalendatDetailModal").html(data);
                    $('#school-activity-detail-modal').modal('show');
                    }
            });
            }

            }},
//            dayClick: function (date) {
//
//            $('#plan-insert-modal').modal();
//            $("#inActivityPlanStartDate").val(date.format());
//            $("#id").val('');
//            $('#inActivityPlanSubject').val('');
//            $("#inActivityPlanDetail").val('');
//            $("#inActivityPlanEndDate").val('');
//            $("#inActivityPlanType").val('');
//            },
            events: [
<?php foreach ($rsAct as $r): ?>
                {
                id: '<?php echo $r['id']; ?>',
                        title: '<?php echo $r['tb_activity_plan_subject']; ?>',
    <?php echo $r['tb_activity_plan_start_date'] == $r['tb_activity_plan_end_date'] ? "start  : '" . $r['tb_activity_plan_start_date'] . "'" : "start  : '" . $r['tb_activity_plan_start_date'] . "',  end : '" . date('Y-m-d', strtotime($r['tb_activity_plan_end_date'] . ' + 1 days')) . "'"; ?>

                },
<?php endforeach; ?>



<?php foreach ($task as $r): ?>
                {
                id: '<?php echo $r['id']; ?>',
                        type : 'task',
                        color: 'green',
                        title: '<?php echo $r['activities_name']; ?>',
    <?php echo $r['activities_begin'] == $r['activities_end'] ? "start  : '" . $r['activities_begin'] . "'" : "start  : '" . $r['activities_begin'] . "',  end : '" . date('Y-m-d', strtotime($r['activities_end']. ' + 1 days')) . "'"; ?>

                },
<?php endforeach; ?>

            ]

    });
    $('#actTab').DataTable({
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
    $("div#actTab_length.dataTables_length").append("&nbsp;<button  class='btn btn-default' data-toggle='modal' data-target='#plan-insert-modal'><i class='icon-plus icon-large'></i> บันทึกข้อมูล</button>");
    $('#actTab2').DataTable({
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
    $("div#actTab2_length.dataTables_length").append("&nbsp;<button  class='btn btn-default' data-toggle='modal' data-target='#plan-insert-modal'><i class='icon-plus icon-large'></i> บันทึกข้อมูล</button>");
// inbox
    $('#inbox-sch-table').DataTable({
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
    // outbox
    $('#outbox-sch-table').DataTable({
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
    $("div#outbox-sch-table_length.dataTables_length").append("&nbsp;&nbsp;<a href='#' class='btn btn-default btn-send'><i class='icon-file-alt'></i> ส่งหนังสือ</a>");
    $('.sorting_asc').removeClass('sorting_asc');
    $("div.panel-heading").css('background-color', '#FFA726').css('color', '#FFFFFF');
    $("div.panel-body").css('border', '1px solid #ffa726');
    //
    // Send document;
    $(".btn-send").click(function () {
    $("#insert-form").trigger("reset");
    $("h3.modal-title").text("ส่งหนังสือ");
    $("#edoc-send-modal").modal("show");
    });
    $(".btn-download").click(function () {
    var uid = $(this).attr('id');
    $.ajax({
    url: "<?php echo site_url('Eschool/edoc_download'); ?>",
            method: "post",
            data: {id: uid},
            dataType: "json",
            success: function (data) {
            location.href = "<?php echo base_url(); ?>upload/" + data.outbox_file;
            }
    });
    });
    // รายการงาน
    $('#task-list').DataTable({
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
    // task list activities;
    $('#task-list_length.dataTables_length').append("&nbsp;&nbsp;<button class='btn btn-primary btn-insert-task'><i class='icon-plus'></i> เพิ่มข้อมูล</button>");
    $('.btn-insert-task').on('click', function () {
    $("h3.modal-title").text("บันทึกกิจกรรม");
    $('#personal-activities-modal').modal('show');
    });
    // edit task
    $('#task-list').on('click', '.btn-task-edit', function () {
    var uid = $(this).attr('id');
    $.ajax({
    url: '<?php echo site_url('update-task-list'); ?>',
            method: 'post',
            data: {id: uid},
            dataType: 'json',
            success: function (data) {
            $('#taskid').val(data.id);
            $('#inActivitiesName').val(data.activities_name);
            $('#inActivitiesGroup').val(data.activities_group);
            $('#inActivitiesBegin').val(data.activities_begin);
            $('#inActivitiesEnd').val(data.activities_end);
            $('#inActivitiesPlace').val(data.activities_place);
            $('#inActivitiesComment').val(data.activities_comment);
            //
            $('h3.modal-title').text('ปรับปรุงข้อมูลกิจกรรม');
            $('#personal-activities-modal').modal('show');
            }
    });
    });
    // delete task
    $('#task-list').on('click', '.btn-task-delete', function () {
    var uid = $(this).attr('id');
    var status = confirm('ต้องการลบข้อมูลนี้จริงหรือไม่ ?');
    if (status) {
    $.ajax({
    url: '<?php echo site_url('delete-task-list'); ?>',
            method: 'post',
            data: {id: uid},
            success: function (data) {
            location.reload();
            }
    });
    }
    });
    // click on btn-task-success;
    $('#task-list').on('click', '.btn-task-success', function () {
    var uid = $(this).attr('id');
    $.ajax({
    url: '<?php echo site_url('check-task-list'); ?>',
            method: 'post',
            data: {id: uid},
            success: function (data) {
            location.reload();
            }
    });
    });
    //
    $('.sorting_asc').removeClass('sorting_asc');
    // Send message button;
    $('#send-message_length.dataTables_length').append("&nbsp;&nbsp;<button type='button' class='btn btn-default btn-send-message'>ส่งข้อความ</button>");
    // send message
    $('.btn-send-message').on('click', function () {
    $('h3.modal-title').text('ส่งจดหมายหรือข้อความ');
    $('#send-message-modal').modal('show');
    });


</script>
<?php $this->load->view("vichakarn/modals/school_activity_detail_modal"); ?>
<?php $this->load->view("edoc/edoc_send_modal"); ?>
<?php $this->load->view('public_relations/modals/public_detail_modal'); ?>
<?php $this->load->view('accessories/modals/personal_activities'); ?>

