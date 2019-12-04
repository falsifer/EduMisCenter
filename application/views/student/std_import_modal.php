<!-- Modal -->
<div id="std-import-modal" class="modal fade" role="dialog">
    <div class="modal-dialog" style="width:80%;">
        <div class="modal-content">
            <div class="modal-header" style="background:#0080FF;color:#FFFFFF;">
                <button type="button" class="close" data-dismiss="modal">X</button>
                <h3 class="modal-title" id="title"></h2>
            </div>
            <div class="modal-body" style="padding:30px;">
                <form method="post" id="import-form" enctype="multipart/form-data">

                    <div class="row">
                        <div class="col-md-12  form-group">
                            <label class="control-label">เลือกไฟล์รายชื่อนักเรียน</label>
                            <input type="hidden" name="inStdClassM" id="inStdClassM"/>
                            <input type="hidden" name="tableName" value="tb_student_base" />
                            <input type="hidden" name="department" value="tb_student_base_department" />
                            <input type="hidden" name="recorder" value="tb_student_base_recorder" />
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
//    $("#std-import-modal").on('shown.bs.modal', function (e) {
//        alert($('#inStdClassM').val());
//    });
    $("#import-form").on("submit", function (e) {
        e.preventDefault();
        $.ajax({
            url: "<?php echo site_url('StudentImport/UploadDataUpdate'); ?>",
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
                $("#student-register-insert-form")[0].reset();
                $('#std-import-modal').modal('hide');
                location.reload();
            }
        });
    });

</script>