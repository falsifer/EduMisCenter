<div class="panel panel-primary">
    <div class="panel-heading">ปฏิทินปฏิบัติงาน (ปฏิทินการศึกษา)</div>
    <ul class="breadcrumb">
        <li><?php echo anchor(site_url(), "<i class='icon-home icon-large'></i> หน้าแรก"); ?></li>
        <li>
            <div class="dropdown" style="display:inline-block;">
                <button class="btn btn-link" data-toggle="dropdown">ปฏิทินการศึกษา (Education event calendar) <span class="caret"></span></button>
                <ul class="dropdown-menu">
                    <li><a href="<?php echo site_url('education-planing'); ?>">แผนพัฒนาการศึกษา (Education Plan)</a></li>
                    <li><a href="<?php echo site_url('education-event-calendar'); ?>">ปฏิทินการศึกษา (Education event calendar)</a></li>
                </ul>
            </div>
        </li>
    </ul>
    <div class="panel-body">
        <div class="row">
            <div class="col-md-5 well">
                <div id="education-calendar"></div>
            </div>
            <div class="col-md-7">
                <div class="table-responsive">
                    <table class="table table-hover table-striped table-bordered display" id="example">
                        <thead>
                            <tr>
                                <th style="width:40px;">ที่</th>
                                <th class="no-sort">วัน/เดือน/ปี</th>
                                <th class="no-sort">กิจกรรม</th>
                                <th class="no-sort">ผู้รับผิดชอบ</th>
                                <?php if ($this->session->userdata("status") == "ผู้ปฏิบัติงาน"): ?>
                                    <th style="width:18%;border-right: none;" class="no-sort"></th>
                                <?php endif; ?>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $row = 1; ?>
                            <?php foreach ($rs as $r): ?>
                                <tr>
                                    <td style="text-align:center;"><?php echo $row; ?></td>
                                    <td><?php echo shortdate($r['start_event']); ?> - <?php echo shortdate($r['end_event']) ?></td>
                                    <td><?php echo $r['title'] ?></td>
                                    <td><?php echo $r['event_owner'] ?></td>
                                    <?php if ($this->session->userdata("status") == "ผู้ปฏิบัติงาน"): ?>
                                        <td>
                                            <button type="button" class="btn btn-warning btn-edit" id="<?php echo $r['id'] ?>"><i class="icon-pencil"></i> Edit</button>
                                            <button type="button" class="btn btn-danger btn-delete" id="<?php echo $r['id'] ?>"><i class="icon-trash"></i> Del</button>
                                        </td>
                                    <?php endif; ?>
                                </tr>
                                <?php $row++; ?>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="panel-footer" style="padding-top: 0px;">
        <div class="row">
            <div class="col-md-8" style="padding-top:8px;padding-right:8px;font-size:15px;color:#666;">
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
        }
    });
    $('.sorting_asc').removeClass('sorting_asc');
    // Tool tips;
    $(function () {
        $('[data-toggle="tooltip"]').tooltip();
    });
    // 
    $("div#example_length.dataTables_length").append("&nbsp;&nbsp;<button class='btn btn-primary btn-calendar-print'><i class='icon-print'></i> พิมพ์</button>");
    $("div#example_length.dataTables_length").append("&nbsp;&nbsp;<button class='btn btn-primary btn-insert-calendar'><i class='icon-plus'></i> บันทึก</button>");
    //
    $("#inMonth").change(function () {
        $("#inMonth option:selected").each(function () {
            alert($(this).text());
        });
    });
    //
    var my_calendar = $('#education-calendar').fullCalendar({
        editable: true,
        locale: 'th',
        height: 550,
        header: {
            left: 'prev,next',
            center: 'title'
        },
        events: '<?php echo site_url('get-education-calendar'); ?>',
        selectable: true,
        selectHelper: true,
        eventClick: function (event) {
            var uid = event.id;
            $.ajax({
                url: "<?php echo site_url('get-education-calendar-one'); ?>",
                method: "POST",
                data: {id: uid},
                success: function (data) {
                    $("h3.modal-title").text("รายละเอียดกิจกรรม");
                    $('#cal-detail').html(data);
                    $('#education-calendar-detail').modal('show');
                }
            });
        },
        eventResize: function (event) {
            var start = $.fullCalendar.formatDate(event.start, "Y-MM-DD");
            var end = $.fullCalendar.formatDate(event.end, "Y-MM-DD");
            var title = event.title;
            var id = event.id;
            //
            $.ajax({
                url: '<?php echo site_url('update-resize-education-calendar'); ?>',
                type: 'post',
                data: {title: title, start: start, end: end, id: id},
                success: function () {
                    my_calendar.fullCalendar('refetchEvents');
                    alert('ปรับปรุงข้อมูลเรียบร้อย...');
                    location.reload();
                }
            });
        },
        eventDrop: function (event) {
            var start = $.fullCalendar.formatDate(event.start, "Y-MM-DD");
            var end = $.fullCalendar.formatDate(event.end, "Y-MM-DD");
            var title = event.title;
            var id = event.id;
            //
            $.ajax({
                url: '<?php echo site_url('update-drag-education-calendar'); ?>',
                type: 'post',
                data: {title: title, start: start, end: end, id: id},
                success: function () {
                    alert('ปรับปรุงข้อมูลเรียบร้อย...');
                    my_calendar.fullCalendar('refetchEvents');
                    location.reload();
                }
            });
        }
    });
    //
    $('.btn-insert-calendar').click(function () {
        $("#education-calendar-form").trigger('reset');
        $("h3.modal-title").text("บันทึกกิจกรรม");
        $('#education-calendar-modal').modal('show');
    });
    // edit event calendar;
    $('#example').on('click', '.btn-edit', function () {
        var uid = $(this).attr('id');
        $.ajax({
            url: '<?php echo site_url('update-education-event-calendar'); ?>',
            method: 'post',
            data: {id: uid},
            dataType: 'json',
            success: function (data) {
                $("#id").val(data.id);
                $("#inStartEvent").val(data.start_event);
                $('#inEndEvent').val(data.end_event);
                $("#inTitle").val(data.title);
                $("#inEventPlace").val(data.event_place);
                $("#inEventOwner").val(data.event_owner);
                $("#inEventComment").val(data.event_comment);
                //
                $("h3.modal-title").text("ปรับปรุงข้อมูล");
                $("#education-calendar-modal").modal("show");
            }
        });
    });
    // delete event calendar
    $("#example").on('click', '.btn-delete', function () {
        var uid = $(this).attr('id');
        var status = confirm('ต้องการลบข้อมูลนี้จริงหรือไม่ ?');
        if (status) {
            $.ajax({
                url: '<?php echo site_url('delete-education-event-calendar'); ?>',
                method: 'post',
                data: {id: uid},
                success: function () {
                    location.reload();
                }
            });
        }
    });

</script>
<!---------------------------------------------------------------------------->
<?php $this->load->view("education_plan/modals/education_calendar_modal"); ?>
<?php $this->load->view("education_plan/modals/education_calendar_detail"); ?>