<div id="ed-teacher-modal" class="modal fade" tabindex="-1" role="dialog">

    <div class="modal-dialog" role="document" style="width:1250px;">
        <div class="modal-content">
            <div class="modal-header" style="background:#ebebeb;">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">เพิ่มข้อมูลผู้สอน</h4>
            </div>
            <form method="post" id="teacher-insert-form">
                <div class="modal-body">

                    <div class="row" id="teacher-list">

                    </div>
                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-insert btn-success"><i class="icon-save icon-large"></i> บันทึก</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">ยกเลิก</button>
                </div>
            </form>
        </div><!-- /.modal-content -->

    </div><!-- /.modal-dialog -->

</div><!-- /.modal -->

<script>

    $("#teacher-insert-form").on("submit", function (e) {
        e.preventDefault();

        //
        $.ajax({
            url: "<?php echo site_url('school/Schedule/ed_schedule_teacher_add'); ?>",
            method: "post",
            data: $("#teacher-insert-form").serialize(),
            success: function (data) {
                alert('บันทึกข้อมูลเรียบร้อย');
                $('#ed-teacher-modal').modal('hide');
                FilterCourse(e);
//                location.href = "<?php echo site_url('ed-course-teacher/'); ?>";
            }

        });
    });



    // edit data;


    $("#example3").on("click", ".btn-edit", function () {
        var uid = $(this).attr('id');
        $.ajax({
            url: "<?php echo site_url('Supervision/supervision_rating_edit'); ?>",
            method: "post",
            data: {id: uid},
            dataType: "json",
            success: function (data) {
                $('#id').val(data.id);
                $("#inSupervisionSubTitleDetail").val(data.tb_supervision_sub_title_detail);
                $("#inSupervisionSubTitleDetail").focus();
                $("#inSupervisionSubTitleDetail").select();
                //$('#insert-subtitle-modal').modal('show');

            }
        });
    });



    $('#inDepartment').change(function () {
        var school = $('#inDepartment').val();
        if (school != '') {
            $.ajax({
                url: "<?php echo site_url('Supervision/member'); ?>",
                method: "post",
                data: {school: school},
                success: function (data) {

                    $('#member').html(data);
                }
            });
        }
    });

</script>



