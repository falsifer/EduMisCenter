<!-- Modal -->
<div id="field-trips-import-modal" class="modal fade" role="dialog">
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
                            <label class="control-label">เลือกไฟล์ที่จะอัพโหลด</label>
                            <input type="hidden" name="tableName" value="tb_student_base" />
                            <input type="file" name="inImportExcel" id="inImportExcel" class="filestyle" />
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12 form-group">
                            <center><button type="submit" class="btn btn-success btn-insert2"><i class="icon-save icon-large"></i> บันทึกข้อมูล</button></center>
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

//    $("#import-form").on("submit", function (e) {
    $(".btn-insert2").on("click", function (e) {
        e.preventDefault();
        $.ajax({
            url: "<?php echo site_url('Import/UploadData'); ?>",
            method: "post",
            data: new FormData($('#import-form')[0]),
            cache: false,
            contentType: false,
            processData: false,
            success: function (data) {
                alert("อัพโหลดข้อมูลสำเร็จ");
                $("#import-form")[0].reset();
                location.reload();
            }
        });
    });

</script>