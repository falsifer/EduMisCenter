
<!-- Modal -->
<div id="course-import-modal" class="modal fade" role="dialog">
    <div class="modal-dialog" style="width:80%;">
        <div class="modal-content">
            <!--<div class="modal-header" style="background:#0080FF;color:#FFFFFF;">-->
                <?php
                    $this->load->view('layout/my_school_modal_header');
                ?>
            <!--</div>-->
            <div class="modal-body" style="padding:30px;">
                <form method="post" id="course-import-form" enctype="multipart/form-data">

                    <div class="row">
                        <div class="col-md-12  form-group">
                            <label class="control-label">เลือกไฟล์ Excel</label>
                            <input type="hidden" name="inEdTerm" id="inEdTerm"/>
                            <input type="hidden" name="inCourseId" id="inCourseId"/>
                            <input type="hidden" name="department" value="tb_course_department" />
                            <input type="hidden" name="recorder" value="tb_course_recorder" />
                            <input type="file" name="inImportExcel" id="inImportExcel" class="filestyle" />
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12 form-group">
                            <center><button type="submit" class="btn btn-success btn-insert"><i class="icon-save icon-large"></i> บันทึกข้อมูล</button></center>
                        </div>
                    </div>

                </form>
            </div>

        </div>
    </div>
</div>

<script>


    $("#course-import-form").on("submit", function (e) {
        e.preventDefault();
        $.ajax({
            url: "<?php echo site_url('StudentScore/ImportExcel'); ?>",
            method: "post",
            data: new FormData(this),
            cache: false,
            contentType: false,
            processData: false,
            beforeSend: function () {
                MyStartLoading();
            },
            success: function (data) {
//                alert(data);
                alert(" อัพโหลดข้อมูลสำเร็จ");
//                $("#course-import-form")[0].reset();
//                $('#course-import-modal').modal('hide');
                location.reload();
            }
        });
    });



</script>