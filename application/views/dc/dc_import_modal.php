
<!-- Modal -->
<div id="course-import-modal" class="modal fade" role="dialog">
    <div class="modal-dialog" style="width:80%;">
        <div class="modal-content">
            <div class="modal-header" style="background:#0080FF;color:#FFFFFF;">
                <button type="button" class="close" data-dismiss="modal">X</button>
                <h3 class="modal-title" id="title"></h2>
            </div>
            <div class="modal-body" style="padding:30px;">
                <form method="post" id="course-import-form" enctype="multipart/form-data">

                    <div class="row">
                        <div class="col-md-12  form-group">
                            <label class="control-label">เลือกไฟล์รายชื่อนักเรียน</label>
                            <span class="star" style="font-size: 1em !important;">&#42;ไฟล์ต้องจัดรูปแบบตาม >> &nbsp;<button type="button" onclick="ExportTemp(this)" class="btn-link btn-excel-export"><i class="icon-download-alt icon-large"></i> ไฟล์ Excel (.xls)</button> เท่านั้น</span>
                            <input type="hidden" name="inStdClass" id="inStdClass"/>
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
            <div class="modal-footer" style="background-color:#CEE3F6;">
                <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="icon-power-off"></i></button>
            </div>
        </div>
    </div>
</div>

<script>


    $("#course-import-form").on("submit", function (e) {
        e.preventDefault();
        $.ajax({
            url: "<?php echo site_url('CourseImport/UploadDataUpdate'); ?>",
            method: "post",
            data: new FormData(this),
            cache: false,
            contentType: false,
            processData: false,
            beforeSend: function () {
                MyStartLoading();
            },
            success: function (data) {
                alert(" อัพโหลดข้อมูลสำเร็จ");
                $("#course-import-form")[0].reset();
                $('#course-import-modal').modal('hide');
//                location.reload();
            }
        });
    });



</script>