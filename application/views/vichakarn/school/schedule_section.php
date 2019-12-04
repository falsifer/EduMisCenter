<div class="box">
    <div class="box-heading">การวางแผนงานวิชาการ</div>
    <ul class="breadcrumb">
        <li><?php echo anchor(site_url(), "<i class='icon-home icon-large'></i> หน้าแรก"); ?></li>
        <!--<li><?php echo anchor(site_url('ed-activity-planing'), " การวางแผนงานวิชาการ"); ?></li>-->
        <li>ตารางสอน</li>
    </ul>

    <div class="box-body">
        <div class="row"> 
            <div class="col-md-3 tab-menu"><?php echo anchor(site_url('ed-schedule-report'), "<i class=\"icon-print\"></i> ตารางสอนรายชั้น"); ?></div>
            <div class="col-md-3 tab-menu-active"><i class="icon-time"></i> ข้อมูลพื้นฐานคาบเรียน</div>
            <div class="col-md-3 tab-menu"><?php echo anchor(site_url('ed-course-teacher'), "<i class=\"icon-user\"></i> ข้อมูลครูผู้สอน"); ?></div>
            <div class="col-md-3 tab-menu"><?php echo anchor(site_url('ed-schedule'), "<i class='icon-calendar'></i> จัดตารางสอน"); ?></div>
            
            
            <!--<div class="col-md-2 tab-menu"><?php // echo anchor(site_url('ed-course-teacher-temp'), "<i class=\"icon-group\"></i> บันทึกการสอนแทน");    ?></div>-->

        </div>
        <div class="row databox">
            <form method="post" id="section-insert-form">
                <div class="row">

                    <div class="col-md-4">
                        <label class="control-label">คาบที่</label><span class="star">&#42;</span>
                        <select name="inSectionClassSub" id="inSectionClassSub" class="form-control" required>
                            <option value="">---เลือกข้อมูล---</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                            <option value="6">6</option>
                            <option value="7">7</option>
                            <option value="8">8</option>
                            <option value="9">9</option>
                            <option value="10">10</option>
                            <option value="11">11</option>
                            <option value="12">12</option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <label class="control-label">ตั้งแต่เวลา</label><span class="star">&#42;</span>
                        <input type="time" name="inSectionStart" id="inSectionStart" class="form-control" required />

                    </div>
                    <div class="col-md-1"><label class="control-label">-</label></div>
                    <div class="col-md-2">
                        <label class="control-label">ถึงเวลา</label><span class="star">&#42;</span>
                        <input type="time" name="inSectionEnd" id="inSectionEnd" class="form-control" required />

                    </div>

                </div>

                <div class="row" style="margin-top:20px;">
                    <center><button type="submit" class="btn btn-success"><i class="icon-save icon-large"></i> บันทึก</button>
                    <!--&nbsp;<button type="button" class="btn btn-danger btn-clear"><i class="icon-remove icon-large"></i> ยกเลิก</button>-->
                    </center>
                </div>
                <input type="hidden" name="id" id="id" />
            </form>
        </div>
        <!--<div class="table-responsive">-->
            <table class="table table-hover table-striped table-bordered display" id="example">
                <thead>
                    <tr>
                        <th class="no-sort">คาบที่</th>
                        <th class="no-sort">ช่วงเวลา</th>
                        <?php if ($this->session->userdata("status") == "ผู้ปฏิบัติงาน"): ?>
                            <th style="width:13%;" class="no-sort"></th>
                        <?php endif; ?>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $row = 1;
                    ?>
                    <?php foreach ($section as $r): ?>

                        <tr>
                            <td style="width: 10%;"><?php echo $r['tb_ed_section_class_sub']; ?></td>
                            <td style="width: 60%;"><?php echo $r['tb_ed_section_start'] . ' - ' . $r['tb_ed_section_end']; ?></td>
                            <?php if ($this->session->userdata("status") == "ผู้ปฏิบัติงาน"): ?>
                                <td style="width: 30%;text-align:center;">
                                    <button type="button" class="btn btn-warning btn-edit" id="<?php echo $r['id']; ?>"><i class="icon-pencil icon-large"></i> แก้ไข</button>
                                    <button type="button" class="btn btn-danger btn-delete" id="<?php echo $r['id']; ?>"><i class="icon-trash icon-large"></i> ลบ</button>
                                </td>
                            <?php endif; ?>
                        </tr>

                        <?php $row++; ?>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <!--</div>-->
    </div>
    <div class="box-footer" style="padding-top: 0px;">
        <div class="row">
            <div class="col-md-8">
                <?php echo img("images/kmk_logo.png"); ?>
            </div>
            <div class="col-md-4" style="padding-top:8px;padding-bottom: 8px;padding-right:30px;">
                <span class="pull-right"><span style="color:#999999;">eSchool Version 1.0</span></span>
            </div>
        </div>
    </div>
</div>

<script>

    $("#example").on("click", ".btn-delete", function () {

        var uid = $(this).attr('id');
//        alert(uid);
        var status = confirm('ต้องการลบข้อมูลนี้จริงหรือไม่ ?');
        if (status) {
            $.ajax({
                url: "<?php echo site_url('school/Schedule/ed_schedule_section_delete'); ?>",
                method: "post",
                data: {id: uid},
                success: function (data) {
                    location.reload();
                }
            });
        }

    });

    $("#example").on("click", ".btn-edit", function () {
        var uid = $(this).attr('id');
        $.ajax({
            url: "<?php echo site_url('school/Schedule/ed_schedule_section_edit'); ?>",
            method: "post",
            data: {id: uid},
            dataType: "json",
            success: function (data) {

                $("#id").val(data.id);
                $("#inSectionEnd").val(data.tb_ed_section_end);
                $("#inSectionStart").val(data.tb_ed_section_start);
                $("#inSectionClassSub").val(data.tb_ed_section_class_sub);


            }
        });
    });

    $("#section-insert-form").on("click", ".btn-clear", function () {
        $("#section-insert-form")[0].reset();
    });

    $("#section-insert-form").on("submit", function (e) {
        e.preventDefault();

        //
        $.ajax({
            url: "<?php echo site_url('school/Schedule/ed_schedule_section_add'); ?>",
            method: "post",
            data: $("#section-insert-form").serialize(),
            success: function (data) {
                $("#section-insert-form")[0].reset();
                location.href = "<?php echo site_url('ed-section/'); ?>";
            }

        });
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
    var status = "<?php //echo $this->session->userdata("status");                         ?>";
//    $("div#example_length.dataTables_length").append("&nbsp;<button class='btn btn-default btn-insert' data-toggle='modal' data-target='#ed-room-modal'><i class='icon-print icon-large'></i> พิมพ์ข้อมูล</button>");
    $('.table-responsive').on('show.bs.dropdown', function () {
        $('.table-responsive').css("overflow", "inherit");
    });

    $('.table-responsive').on('hide.bs.dropdown', function () {
        $('.table-responsive').css("overflow", "auto");
    });



</script>