<div class="container-fluid">
    <!-- Left side -->
    <div class="col-md-12">
        <div class="databox" style="padding-top:10px;border:1px solid #C9302C;">
            <h3>ปฏิทินดำเนินงานโครงการระบบบริหารจัดการศึกษาอิเล็กทรอนิกส์ 4.0</h3>
            <div id="calendar"></div>
        </div>
        <?php $this->load->view("modals/task_modal"); ?>
        <!-- TAB -->
        <div class="databox" style="margin-top:20px;border:1px solid #449D44;">

            <table class="table table-hove table-striped table-hover table-bordered" id="example">
                <thead>
                    <tr>
                        <th class="no-sort" rowspan="2">ที่</th>
                        <th class="no-sort" rowspan="2">Deadline</th>
                        <th class="no-sort" rowspan="2">งาน</th>
                        <th class="no-sort" rowspan="2">Task</th>
                        <th class="no-sort" rowspan="2">ผู้รับผิดชอบ</th>
                        <th class="no-sort" rowspan="2">ความคืบหน้า</th>
                        <th class="no-sort" rowspan="2">Comment</th>
                        <th class="no-sort" colspan="3">สถานะ</th>
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
                    <tr <?php if ($r['tb_task_priority']=="Y") echo "style='background:#FEB7A8;'"; ?>>
                            <td style="text-align:center;"><?php echo $row; ?></td>
                            
                            <td style="text-align:center;"><?php echo $r['tb_task_deadline']; ?></td>
                            
                            <td><?php echo $r['tb_task_job']; ?></td>
                            <td><?php echo $r['tb_task_title']; ?></td>                                         
                            <td><?php echo $r['tb_task_assign']; ?></td>
                            <td style="text-align:center;"><?php echo $r['tb_task_complete']; ?></td>
                            <td><?php echo $r['tb_task_comment']; ?></td>
                            <?php
                            if ($r['tb_task_status'] === 'Y') {
                                echo '<td></td>
                                    <td style="text-align:center;">' . img('images/checked.png') . '</td>
                                    <td></td>';
                            } elseif ($r['tb_task_status'] === 'N') {
                                echo '<td style="text-align:center;">' . img('images/checked.png') . '</td>
                                    <td></td>
                                    <td></td>';
                            } elseif ($r['tb_task_status'] === 'S') {
                                echo '<td></td>
                                    <td></td>
                                    <td style="text-align:center;">' . img('images/checked.png') . '</td>
                                    ';
                            }
                            ?>
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
                    url: "<?php echo site_url('Task/task_edit'); ?>",
                    method: "post",
                    data: {id: event.id},
                    dataType: "json",
                    success: function (data) {

                        $("#id").val(data.id);
                        $('#inTaskTitle').val(data.tb_task_title);
                        $("#inTaskJob").val(data.tb_task_job);
                        $("#inTaskAssign").val(data.tb_task_assign);
                        $("#inTaskComment").val(data.tb_task_comment);
                        $("#inTaskStartDate").val(data.tb_task_start_date);
                        $("#inTaskDeadline").val(data.tb_task_deadline);
                        $("#inTaskStatus").val(data.tb_task_status);
                        $("#inTaskComplete").val(data.tb_task_complete);
                        $("#inTaskPriority").val(data.tb_task_priority);
                        $('#insert-modal').modal('show');
                    }
                });
            }
        },
        dayClick: function (date) {

            $('#insert-modal').modal();
            $("#inTaskStartDate").val(date.format());
            $("#id").val('');
            $('#inTaskTitle').val('');
            $("#inTaskJob").val('');
            $("#inTaskAssign").val('');
            $("#inTaskComment").val('');
            $("#inTaskDeadline").val('');
            $("#inTaskStatus").val('');
            $("#inTaskComplete").val('');
            $("#inTaskPriority").val('');
            

        },
        events: [
<?php foreach ($rs as $r): ?>
                {
                    id: '<?php echo $r['id']; ?>',
                    <?php if($r['tb_task_priority']=='Y'){echo 'color:\'red\',';}else{echo 'color:\'green\',';} ?>
                    title: '<?php echo $r['tb_task_title']; ?> (<?php echo $r['tb_task_assign']; ?>)',
    <?php echo $r['tb_task_start_date'] == $r['tb_task_deadline'] ? "start  : '" . $r['tb_task_start_date'] . "'" : "start  : '" . $r['tb_task_start_date'] . "',  end : '" . $r['tb_task_deadline'] . "'"; ?>

                },
<?php endforeach; ?>

        ]

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




    $('.sorting_asc').removeClass('sorting_asc');
    //
    var status = "<?php //echo $this->session->userdata("status");                          ?>";
    $("div#example_length.dataTables_length").append("&nbsp;<button class='btn btn-default btn-insert'><i class='icon-print icon-large'></i> พิมพ์ข้อมูล</button>");
//    $("div#example_length.dataTables_length").append("&nbsp;<a href='<?php echo site_url('hr01'); ?>' class='btn btn-default'><i class='icon-plus icon-large'></i> บันทึกข้อมูล</a>");
    $("div#example_length.dataTables_length").append("&nbsp;<button  class='btn btn-default' data-toggle='modal' data-target='#insert-modal'><i class='icon-plus icon-large'></i> บันทึกข้อมูล</button>");
//
    $('.table-responsive').on('show.bs.dropdown', function () {
        $('.table-responsive').css("overflow", "inherit");
    });

    $('.table-responsive').on('hide.bs.dropdown', function () {
        $('.table-responsive').css("overflow", "auto");
    });



    $("#example").on("click", ".btn-edit", function () {
        var uid = $(this).attr('id');
        $.ajax({
            url: "<?php echo site_url('Task/task_edit'); ?>",
            method: "post",
            data: {id: uid},
            dataType: "json",
            success: function (data) {

                $("#id").val(data.id);
                $('#inTaskTitle').val(data.tb_task_title);
                $("#inTaskJob").val(data.tb_task_job);
                $("#inTaskAssign").val(data.tb_task_assign);
                $("#inTaskComment").val(data.tb_task_comment);
                $("#inTaskStartDate").val(data.tb_task_start_date);
                $("#inTaskDeadline").val(data.tb_task_deadline);
                $("#inTaskStatus").val(data.tb_task_status);
                $("#inTaskComplete").val(data.tb_task_complete);
                $("#inTaskPriority").val(data.tb_task_priority);
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
                url: "<?php echo site_url('Task/task_delete'); ?>",
                method: "post",
                data: {id: uid},
                success: function (data) {
                    location.reload();
                }
            });
        }
    });


</script>