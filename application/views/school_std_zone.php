<div class="box">
    <div class="box-heading"><i class='icon-home icon-large'></i> ระบบบริหารจัดการศึกษาอิเล็กทรอนิกส์ (Thailand 4.0)<span class="pull-right" style="margin-right:15px;"><?php echo $this->session->userdata('department'); ?></span></div>
    <!--    <ul class="breadcrumb">
            <li><i class='icon-home icon-large'></i> หน้าแรก</li>
        </ul>-->
    <div class="box-body">
        <div class="row">
            <div class=" col-md-12" style="margin: 15px 0px;">

                <div class="panel">
                    <div class="panel-heading">งานประชาสัมพันธ์</div>
                    <div class="panel-body">
                        <?php
                        $advertising = $this->My_model->get_where_order('tb_public_relations', array('pr_status' => 'สาธารณะ'), 'pr_date desc');

                        foreach ($advertising as $r) {
                            ?>
                            <div class="panel databox" style="margin: 15px 0px;padding: 10px;">
                                <div class="row">
                                    <div class="col-md-12">
                                        <?php echo $r['pr_topic'] ?> 
                                    </div>
                                </div>
                                <div class="row panel" style="margin:10px 3px;padding: 4px;">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <?php
                                            $outp = "";
                                            if (file_exists('upload/' . $r['pr_image_1']) && !empty($r['pr_image_1'])) {
                                                $outp .= img(array('src' => base_url() . 'upload/' . $r['pr_image_1'], 'style' => 'width:262px;height:209px;', 'class' => 'img-thumbnail')) . nbs(3);
                                            }
                                            if (file_exists('upload/' . $r['pr_image_2']) && !empty($r['pr_image_2'])) {
                                                $outp .= img(array('src' => base_url() . 'upload/' . $r['pr_image_2'], 'style' => 'width:262px;height:209px;', 'class' => 'img-thumbnail')) . nbs(3);
                                            }
                                            if (file_exists('upload/' . $r['pr_image_3']) && !empty($r['pr_image_3'])) {
                                                $outp .= img(array('src' => base_url() . 'upload/' . $r['pr_image_3'], 'style' => 'width:262px;height:209px;', 'class' => 'img-thumbnail')) . nbs(3);
                                            }
                                            if (file_exists('upload/' . $r['pr_image_4']) && !empty($r['pr_image_4'])) {
                                                $outp .= img(array('src' => base_url() . 'upload/' . $r['pr_image_4'], 'style' => 'width:262px;height:209px;', 'class' => 'img-thumbnail')) . nbs(3);
                                            }
                                            echo $outp;
                                            ?>
                                        </div>
                                    </div>
                                    <div class="row" style="margin:10px 3px;">
                                        <div class="col-md-12">
                                            <?php echo substr($r['pr_detail'],0,300)."..."; ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="row" style="text-align:right;">
                                    <?php
                                    $rs = $this->My_model->get_where_row('tb_human_resources_01', 'CONCAT(hr_thai_symbol,hr_thai_name,\' \',hr_thai_lastname)=\'' . $r['pr_owner'].'\'');
                                    if (isset($rs['hr_image']))
                                        $img = $rs['hr_image'];
                                    ?>
                                    <div class="col-md-12">
                                        <?php if (isset($img)) { ?>
                                            <img src="<?php echo base_url() ?>/upload/<?php echo $img; ?>" class="img-circle" width="26px" height="28px;" />
                                            <?php
                                        }
                                        ?>
                                        <?php echo $r['pr_owner']; ?> ( <?php echo $r['pr_department']; ?> )
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
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
            if (event.type){

            var uid = event.id;
            $.ajax({
            url: '<?php echo site_url('update-task-list'); ?>',
                    method: 'post',
                    data: {id: uid},
                    dataType: 'json',
                    success: function (data) {
                    $('#id').val(data.id);
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
            } else{
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
                    $('#plan-insert-modal').modal('show');
                    }
            });
            }

            }
            },
            dayClick: function (date) {

            $('#plan-insert-modal').modal();
            $("#inActivityPlanStartDate").val(date.format());
            $("#id").val('');
            $('#inActivityPlanSubject').val('');
            $("#inActivityPlanDetail").val('');
            $("#inActivityPlanEndDate").val('');
            $("#inActivityPlanType").val('');
            },
            events: [
<?php foreach ($rsAct as $r): ?>
                {
                id: '<?php echo $r['id']; ?>',
                        title: '<?php echo $r['tb_activity_plan_subject']; ?>',
    <?php echo $r['tb_activity_plan_start_date'] == $r['tb_activity_plan_end_date'] ? "start  : '" . $r['tb_activity_plan_start_date'] . "'" : "start  : '" . $r['tb_activity_plan_start_date'] . "',  end : '" . $r['tb_activity_plan_end_date'] . "'"; ?>

                },
<?php endforeach; ?>

<?php foreach ($rsActY as $r): ?>
                {
                id: '<?php echo $r['id']; ?>',
                        title: '<?php echo $r['tb_activity_plan_subject']; ?>',
    <?php echo $r['tb_activity_plan_start_date'] == $r['tb_activity_plan_end_date'] ? "start  : '" . $r['tb_activity_plan_start_date'] . "'" : "start  : '" . $r['tb_activity_plan_start_date'] . "',  end : '" . $r['tb_activity_plan_end_date'] . "'"; ?>

                },
<?php endforeach; ?>

<?php foreach ($rsActY as $r): ?>
                {
                id: '<?php echo $r['id']; ?>',
                        title: '<?php echo $r['tb_activity_plan_subject']; ?>',
    <?php echo $r['tb_activity_plan_start_date'] == $r['tb_activity_plan_end_date'] ? "start  : '" . $r['tb_activity_plan_start_date'] . "'" : "start  : '" . $r['tb_activity_plan_start_date'] . "',  end : '" . $r['tb_activity_plan_end_date'] . "'"; ?>

                },
<?php endforeach; ?>

<?php foreach ($task as $r): ?>
                {
                id: '<?php echo $r['id']; ?>',
                        type : 'task',
                        color: 'green',
                        title: '<?php echo $r['activities_name']; ?>',
    <?php echo $r['activities_begin'] == $r['activities_end'] ? "start  : '" . $r['activities_begin'] . "'" : "start  : '" . $r['activities_begin'] . "',  end : '" . $r['activities_end'] . "'"; ?>

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
    $('#task-list_length.dataTables_length').append("&nbsp;&nbsp;<button class='btn btn-default btn-insert-task'><i class='icon-comments'></i> บันทึก</button>");
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
            $('#id').val(data.id);
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
<?php $this->load->view("edoc/edoc_send_modal"); ?>
<?php $this->load->view('public_relations/modals/public_detail_modal'); ?>
<?php $this->load->view('accessories/modals/personal_activities'); ?>

