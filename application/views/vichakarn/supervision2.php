<div class="container-fluid">
    <!-- Left side -->
    <div class="col-md-12">
        <div class="databox" style="padding-top:10px;border:1px solid #C9302C;">
            <h3>ปฏิทินดำเนินงานนิเทศการศึกษา</h3>
            <div id="calendar"></div>
        </div>
        <?php $this->load->view("modals/vichakarn/supervision_insert_modal"); ?>

        <!-- TAB -->
        <div class="databox" style="margin-top:20px;border:1px solid #449D44;">
            <h4>การนิเทศการศึกษา ประจำเดือน<?php echo month_num(date("m")); ?> <button type="button" class="btn btn-save btn-default" ><i class="icon-plus icon-large"></i> เพิ่มหัวข้อการนิเทศ</button></h4>
            <table class="table table-hove table-striped table-hover table-bordered" id="example">
                <thead>
                    <tr>
                        <th class="no-sort" rowspan="2">ที่</th>
                        <th class="no-sort" rowspan="2">งาน</th>
                        <th class="no-sort" rowspan="2">หัวข้อ</th>
                        <th class="no-sort" rowspan="2">ระดับผลการประเมิน</th>
                        <th rowspan="2">&nbsp;</th>
                    </tr>    


                </thead>
                <tbody>


                    <?php $row = 1; ?>
                    <?php foreach ($rs as $r): ?>
                        <?php // if ($r['username'] != 'admin'): ?>
                        <tr>
                            <td style="text-align:center;"><?php echo $row; ?></td>
                            <td><?php echo $r['tb_division_name']; ?></td>
                            <td><?php echo $r['tb_supervision_issue_detail']===null? '<button type="button" class="btn btn-save btn-default" id="'.$r['id'].'"><i class="icon-plus icon-large"></i> เพิ่มหัวข้อ</button>' : $r['tb_supervision_issue_detail']; ?></td>                                         
                            <td><?php echo $r['rating'] == null ? 'ยังไม่ได้ทำการนิเทศ' : $r['rating']; ?></td>

                            <?php if ($r['rating'] === null) { ?> 
                                <td style="text-align: center;">
                                    <button type="button" class="btn btn-save btn-default" id="<?php echo $r['id']; ?>"><i class="icon-pencil icon-large"></i> บันทึกผลการนิเทศ</button>
                                </td>
                            <?php } else { ?>
                                <td style="text-align: center;">
                                    <button type="button" class="btn btn-warning btn-edit" id="<?php echo $r['id']; ?>"><i class="icon-pencil icon-large"></i> แก้ไข</button>
                                    <button type="button" class="btn btn-danger btn-delete" id="<?php echo $r['id']; ?>"><i class="icon-trash icon-large"></i> ลบ</button>
                                </td>
                            <?php } ?>
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
<?php foreach ($rs as $r): ?>

<?php if($r['tb_supervision_start_date']!==null){ ?>
                {
                    id: '<?php echo $r['c.id']; ?>',
                    title: '<?php echo $r['tb_supervision_issue_deatil']; ?>',
    <?php echo $r['tb_supervision_start_date'] == $r['tb_supervision_deadline'] ? "start  : '" . $r['tb_supervision_start_date'] . "'" : "start  : '" . $r['tb_supervision_start_date'] . "',  end : '" . $r['tb_supervision_end_date'] . "'"; ?>

                },
                        
<?php } ?>
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
    var status = "<?php //echo $this->session->userdata("status");                       ?>";
    $("div#example_length.dataTables_length").append("&nbsp;<button class='btn btn-default btn-insert'><i class='icon-print icon-large'></i> พิมพ์ข้อมูล</button>");
//    $("div#example_length.dataTables_length").append("&nbsp;<a href='<?php echo site_url('hr01'); ?>' class='btn btn-default'><i class='icon-plus icon-large'></i> บันทึกข้อมูล</a>");
    $("div#example_length.dataTables_length").append("&nbsp;<button  class='btn btn-default' data-toggle='modal' data-target='#insert-modal'><i class='icon-plus icon-large'></i> บันทึกข้อมูล</button>");
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