<div class="box">
    <div class="box-heading">โครงสร้างหลักสูตรการสอน</div>
    <ul class="breadcrumb">
        <li><?php echo anchor(site_url(), "<i class='icon-home icon-large'></i> หน้าแรก"); ?></li>
        <li><?php echo anchor('development-course', "สารสนเทศหลักสูตรการสอน"); ?></li>
        <li>โครงสร้างหลักสูตรการสอน</li>
    </ul>
    <div class="box-body">
        <div class="row">
            <div class="col-md-12 ">
                <table class="table table-hover table-striped table-bordered display" id="teacher">
                    <thead>
                        <tr>
                            <th class="no-sort">ระดับชั้น</th>
                            <th class="no-sort">รหัสวิชา</th>
                            <th class="no-sort">ชื่อวิชา</th>
                            <th class="no-sort">หน่วยกิต</th>
                            <th class="no-sort">คาบ</th>
                            <th class="no-sort">ชั่วโมง</th>
                            <th class="no-sort">ครูผู้สอน</th>
                            <?php if ($this->session->userdata("status") == "ผู้ปฏิบัติงาน"): ?>
                                <th style="width:13%;" class="no-sort"></th>
                            <?php endif; ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $row = 1;
                        $cid = 0;

                        foreach ($courseD as $r):
                            ?>
                            <?php
                            if ($r['cid'] != $cid) {
                                $cid = $r['cid'];
                                ?>
                                <tr>
                                    <td><?php echo $r['tb_ed_school_class_name'] . ' ' . $r['tb_ed_school_class_level']; ?></td>
                                    <td><?php echo $r['tb_course_code']; ?></td>
                                    <td><?php echo $r['tb_subject_name']; ?></td>
                                    <td><?php echo $r['tb_course_credit']; ?></td>
                                    <td><?php echo $r['tb_course_hour_week']; ?></td>
                                    <td><?php echo $r['tb_course_hour_term']; ?></td>
                                    <td><?php echo $teacher_arr[$r['cid']]; ?></td>
        <?php if ($this->session->userdata("status") == "ผู้ปฏิบัติงาน"): ?>
                                        <td style="text-align:center;">

                                            <button type="button" class='btn btn-info btn-insert' sbj="<?php echo $r['tb_subject_name']; ?>" code="<?php echo $r['tb_course_code']; ?>" id="<?php echo $r['cid']; ?>"><i class='icon-plus icon-large'></i> เพิ่ม/แก้ไขครูผู้สอน</button>
                                            <!--<button type="button" class="btn btn-warning btn-edit" id="<?php echo $r['cid']; ?>"><i class="icon-pencil icon-large"></i> แก้ไข</button>-->
                                            <!--<button type="button" class="btn btn-danger btn-delete" id="<?php echo $r['cid']; ?>"><i class="icon-trash icon-large"></i> ลบ</button>-->
                                        </td>
                                <?php endif; ?>
                                </tr>
                            <?php }
                            ?>


                            <?php $row++; ?>
<?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

<?php $this->load->view('layout/my_school_footer'); ?>
</div>
<?php $this->load->view("vichakarn/modals/ed_teacher_modal"); ?>
<script>


    $("#teacher").on("click", ".btn-insert", function () {
        var uid = $(this).attr('id');
        var sbj = $(this).attr('sbj');
        var code = $(this).attr('code');
        var txtHead = 'เพิ่มรายชื่อครูผู้สอนสำหรับวิชา ' + code + ' ' + sbj;


        $.ajax({
            url: "<?php echo site_url('school/Schedule/ed_teacher_list_by_course'); ?>",
            method: "post",
            data: {sbj: sbj, code: code, id: uid},
//            dataType: "json",
            success: function (data) {
                $("h4.modal-title").text(txtHead);
                $("#teacher-list").html(data);
                $('#ed-teacher-modal').modal('show');
            }
        });
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
                if (data.tb_ed_section_class === 'อนุบาล') {
                    $('input[name="inSectionClass"]')[0].checked = true;
                } else if (data.tb_ed_section_class === 'ประถมศึกษา') {
                    $('input[name="inSectionClass"]')[1].checked = true;
                } else if (data.tb_ed_section_class === 'มัธยมศึกษา') {
                    $('input[name="inSectionClass"]')[2].checked = true;
                } else {
                    $('input[name="inSectionClass"]')[3].checked = true;
                }

                $('#ed-teacher-modal').modal('show');

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

    $('#teacher').DataTable({
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
    $("div#teacher_length.dataTables_length").append("&nbsp;<button class='btn btn-default btn-insert-course' ><i class='icon-plus icon-large'></i> เพิ่มรายวิชาที่สอน</button>");
    $("div#teacher_length.dataTables_length").append("&nbsp;<button class='btn btn-default btn-insert' data-toggle='modal' data-target='#ed-teacher-print-modal'><i class='icon-print icon-large'></i> พิมพ์ข้อมูล</button>");
    $('.table-responsive').on('show.bs.dropdown', function () {
        $('.table-responsive').css("overflow", "inherit");
    });

    $('.table-responsive').on('hide.bs.dropdown', function () {
        $('.table-responsive').css("overflow", "auto");
    });

    $(".btn-insert-course").on("click", function () {
        location.href = "<?php echo site_url('insert-course/'); ?>";
    });


</script>