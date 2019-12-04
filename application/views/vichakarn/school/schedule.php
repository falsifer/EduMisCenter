<div class="box">
    <div class="box-heading">การวางแผนงานวิชาการ
<!--        <button type="button" id='btnExcelId'  style="float: right"onclick="ImportTemp(this)" class="btn btn-success btn-excel"><i class="icon-file icon-large"></i> นำเข้าข้อมูลจากไฟล์ Excel (.xls)</button>

        <button type="button" style="float: right" onclick="ExportTemp(this)" class="btn btn-success btn-excel-export"><i class="icon-download-alt icon-large"></i> รูปแบบไฟล์ Excel (.xls)</button>-->
    </div>
    <ul class="breadcrumb">
        <li><?php echo anchor(site_url(), "<i class='icon-home icon-large'></i> หน้าแรก"); ?></li>
        <!--<li><?php echo anchor(site_url('activity-planing'), " การวางแผนงานวิชาการ"); ?></li>-->
        <li>ตารางสอน</li>
    </ul>

    <div class="box-body">
        <div class="row"> 
            <div class="col-md-3 tab-menu"><?php echo anchor(site_url('ed-schedule-report'), "<i class=\"icon-print\"></i> ตารางสอนรายชั้น"); ?></div>
            <div class="col-md-3 tab-menu"><?php echo anchor(site_url('ed-section'), "<i class=\"icon-time\"></i> ข้อมูลพื้นฐานคาบเรียน"); ?></div>
            
            <div class="col-md-3 tab-menu"><?php echo anchor(site_url('ed-course-teacher'), "<i class=\"icon-user\"></i> ข้อมูลครูผู้สอน"); ?></div>
            <div class="col-md-3 tab-menu-active"><i class='icon-calendar'></i> จัดตารางสอน</div>
            <!--<div class="col-md-2 tab-menu"><?php // echo anchor(site_url('ed-course-teacher-temp'), "<i class=\"icon-group\"></i> บันทึกการสอนแทน");  ?></div>-->

        </div>
        <div class="row databox">
            <form method="post" id="room-insert-form">
                <div class="row">
                    <?php
                    $data['class'] = 'Y';
                    $data['term'] = 'Y';
                    $data['room'] = 'Y';
                    ?>
                    <?php $this->load->view('layout/my_school_filter', $data); ?>
                </div>
                <div class="row" style="margin:20px;">
<!--                    <center>
                        <button type="button" class="btn btn-info btn-filter"><i class="icon-filter icon-large"></i> กรองข้อมูล</button>
                    </center>-->
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="table-responsive">
                            <table class="table table-hover table-striped table-bordered display" id="scheduleTab">
                                <thead>
                                    <tr>

                                        <th class="no-sort" style="text-align: center;">วัน</th>
                                        <th class="no-sort" style="text-align: center;">คาบที่ 1</th>
                                        <th class="no-sort" style="text-align: center;">คาบที่ 2</th>
                                        <th class="no-sort" style="text-align: center;">คาบที่ 3</th>
                                        <th class="no-sort" style="text-align: center;">คาบที่ 4</th>
                                        <th class="no-sort" style="text-align: center;">คาบที่ 5</th>
                                        <th class="no-sort" style="text-align: center;">คาบที่ 6</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <tr>
                                        <td style="text-align: center;">จ.</td>
                                        <td style="text-align: center;" id="mon1"></td>
                                        <td style="text-align: center;" id="mon2"></td>
                                        <td style="text-align: center;" id="mon3"></td>
                                        <td style="text-align: center;" id="mon4"></td>
                                        <td style="text-align: center;" id="mon5"></td>
                                        <td style="text-align: center;" id="mon6"></td>
                                    </tr>
                                    <tr>
                                        <td style="text-align: center;">อ.</td>
                                        <td style="text-align: center;" id="tue1"></td>
                                        <td style="text-align: center;" id="tue2"></td>
                                        <td style="text-align: center;" id="teu3"></td>
                                        <td style="text-align: center;" id="tue4"></td>
                                        <td style="text-align: center;" id="tue5"></td>
                                        <td style="text-align: center;" id="tue6"></td>
                                    </tr>
                                    <tr>
                                        <td style="text-align: center;">พ.</td>
                                        <td style="text-align: center;" id="wed1"></td>
                                        <td style="text-align: center;" id="wed2"></td>
                                        <td style="text-align: center;" id="wed3"></td>
                                        <td style="text-align: center;" id="wed4"></td>
                                        <td style="text-align: center;" id="wed5"></td>
                                        <td style="text-align: center;" id="wed6"></td>
                                    </tr>
                                    <tr>
                                        <td style="text-align: center;">พฤ.</td>
                                        <td style="text-align: center;" id="thu1"></td>
                                        <td style="text-align: center;" id="thu2"></td>
                                        <td style="text-align: center;" id="thu3"></td>
                                        <td style="text-align: center;" id="thu4"></td>
                                        <td style="text-align: center;" id="thu5"></td>
                                        <td style="text-align: center;" id="thu6"></td>
                                    </tr>
                                    <tr>
                                        <td style="text-align: center;">ศ.</td>
                                        <td style="text-align: center;" id="fri1"></td>
                                        <td style="text-align: center;" id="fri2"></td>
                                        <td style="text-align: center;" id="fri3"></td>
                                        <td style="text-align: center;" id="fri4"></td>
                                        <td style="text-align: center;" id="fri5"></td>
                                        <td style="text-align: center;" id="fri6"></td>
                                    </tr>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-10 col-md-offset-1">
                        <div class="table-responsive">
                            <table class="table table-hover table-striped table-bordered display" id="courseTab">
                                <thead>
                                    <tr>

                                        <th class="no-sort">รหัสวิชา</th>
                                        <th class="no-sort">วิชา</th>
                                        <th class="no-sort">คาบ</th>
                                        <!--<th class="no-sort">คงเหลือ</th>-->
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php foreach ($course as $r): ?>
                                        <tr>
                                            <td style="text-align: center;"><?php echo $r['tb_course_code']; ?></td>
                                            <td><?php echo $r['tb_subject_name']; ?></td>
                                            <td><?php echo $r['tb_course_hour_week']; ?></td>
                                            <!--<td><?php echo $r['balance']; ?></td>-->
                                        </tr>


                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>

                <!--                <div class="row" style="margin-top:20px;">
                                    <center><button type="submit" class="btn btn-success"><i class="icon-save icon-large"></i> บันทึกข้อมูล</button>
                                        &nbsp;<button type="button" class="btn btn-danger btn-clear"><i class="icon-remove icon-large"></i> ยกเลิก</button>
                                    </center>
                                </div>-->
                <input type="hidden" name="id" id="id" />
            </form>
        </div>

    </div>
    <?php $this->load->view('layout/my_school_footer'); ?>

</div>


<?php $this->load->view("vichakarn/school/schedule_import_modal"); ?>


<script>



    $("#room-insert-form").on("click", ".btn-clear", function () {
        $("#room-insert-form")[0].reset();
    });

    $("#room-insert-form").on("submit", function (e) {
        e.preventDefault();

        //
        $.ajax({
            url: "<?php echo site_url('school/Vichakarn/schedule_add'); ?>",
            method: "post",
            data: $("#room-insert-form").serialize(),
            success: function (data) {
                $("#room-insert-form")[0].reset();
                location.href = "<?php echo site_url('ed-schedule/'); ?>";
            }

        });
    });

    function MyTermOnChange(e) {

        var yearly = $('#MyEdYear').val();
        var term = $("#MyTerm :selected").val();
        var lev = $("#MyClass :selected").text();
        var rid = $("#MyRoom :selected").val();

        if (yearly != "" && term != '' && lev != '' && rid != '') {
            $.ajax({
                url: "<?php echo site_url('school/Schedule/list_course'); ?>",
                method: "post",
                data: {yearly: yearly, lev: lev, rid: rid, eterm: term},
                success: function (data) {

                    $('#courseTab').html(data);
                }
            });

            $.ajax({
                url: "<?php echo site_url('school/Schedule/list_section'); ?>",
                method: "post",
                data: {yearly: yearly, lev: lev, rid: rid, eterm: term},
                success: function (data) {

                    $('#scheduleTab').html(data);
                }
            });
        }
    }

    function MyRoomOnChange(e) {

        var yearly = $('#MyEdYear').val();
        var term = $("#MyTerm :selected").val();
        var lev = $("#MyClass :selected").text();
        var rid = $("#MyRoom :selected").val();

        $.ajax({
            url: "<?php echo site_url('school/Schedule/list_course'); ?>",
            method: "post",
            data: {yearly: yearly, lev: lev, rid: rid, eterm: term},
            success: function (data) {

                $('#courseTab').html(data);
            }
        });

        $.ajax({
            url: "<?php echo site_url('school/Schedule/list_section'); ?>",
            method: "post",
            data: {yearly: yearly, lev: lev, rid: rid, eterm: term},
            success: function (data) {

                $('#scheduleTab').html(data);
            }
        });

    }

    function updateSchedule(e, sid, dd) {

        var cdid = e.value;
        var rid = $("#MyRoom :selected").val();
        var yearly = $('#MyEdYear').val();
        var lev = $("#MyClass :selected").text();
        var term = $('#MyTerm').val();

        $.ajax({
            url: "<?php echo site_url('school/Schedule/update_schedule'); ?>",
            method: "post",
            data: {rid: rid, sid: sid, cdid: cdid, dd: dd, term: term},
            success: function (data) {
                $.ajax({
                    url: "<?php echo site_url('school/Schedule/list_section'); ?>",
                    method: "post",
                    data: {yearly: yearly, lev: lev, rid: rid},
                    success: function (data) {
                        MyRoomOnChange(e);
//                        $('#scheduleTab').html(data);
//                        $.ajax({
//                            url: "<?php echo site_url('school/Schedule/list_course'); ?>",
//                            method: "post",
//                            data: {yearly: yearly, lev: lev, rid: rid},
//                            success: function (data) {
//                                $('#courseTab').html(data);
//                            }
//                        });
                    }
                });
            }
        });
    }


    function delSec(ii, sid, dd, e) {
        var status = confirm('ต้องการลบข้อมูลนี้จริงหรือไม่ ?');
        if (status) {
            $.ajax({
                url: "<?php echo site_url('school/Schedule/ed_schedule_delete'); ?>",
                method: "post",
                data: {id: ii},
                success: function (data) {
                    alert('ลบข้อมูลสำเร็จ !');
                    var rid = $("#MyRoom :selected").val();
                    var yearly = $('#MyEdYear').val();
                    var lev = $("#MyClass :selected").text();
                    var term = $('#MyTerm').val();
                    $.ajax({

                        url: "<?php echo site_url('school/Schedule/list_section'); ?>",
                        method: "post",
                        data: {yearly: yearly, lev: lev, rid: rid},
                        success: function (data) {
                            MyRoomOnChange(e);
                        }
                    });
                }
            });
        }
    }

    function ExportTemp(e) {
        e.preventDefault;


        $.ajax({
            url: '<?php echo site_url('CourseImport/ExportScheduleTemplate'); ?>',
            method: 'post',

            success: function (data) {
                window.open('<?php echo site_url('CourseImport/ExportScheduleTemplate'); ?>', '_blank');
            }
        });
    }

    function ImportTemp(e) {

//        if ($("#MyClass").val() != "") {
//            $("#inStdClass").val($("#MyClass").val());

        $("#schedule-import-modal").modal("show");
//        }
    }
</script>