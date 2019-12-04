<!-- Modal -->
<div id="pr-edit-modal" class="modal fade" role="dialog">
    <div class="modal-dialog" style="width:80%;">
        <div class="modal-content">
            <div class="modal-header" style="background:#0080FF;color:#FFFFFF;">
                <button type="button" class="close" data-dismiss="modal">X</button>
                <h3 class="modal-title" id="title"></h2>
            </div>
            <div class="modal-body" style="padding:30px;">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-10 col-md-offset-1">
                            <form method="post" id="insert-form" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-md-3 form-group">
                                        <label class="control-label">ชื่อหนังสือ</label>
                                        <input type="text" name="inBsName" id="inBsName" class="form-control" autofocus  required=""/>
                                    </div>
                                    <div class="col-md-4 form-group">
                                        <label class="control-label">รายวิชา</label>
                                        <input type="text" name="inBsSubj" id="inBsSubj" class="form-control" autofocus  required=""/>
                                    </div>
                                    <div class="col-md-5 form-group">
                                        <label class="control-label">กลุ่มสาระการเรียนรู้</label>
                                        <input type="text" name="inBsSara" id="inBsSara" class="form-control" autofocus  required=""/>
                                    </div>
                                    <div class="col-md-2 form-group">
                                        <label class="control-label">ชั้น</label>
                                        <input type="text" name="inBsClass" id="inBsClass" class="form-control" autofocus  required=""/>
                                    </div>
                                    <div class="col-md-5 form-group">
                                        <label class="control-label">ผู้จัดพิมพ์</label>
                                        <input type="text" name="inBsPublisher" id="inBsPublisher" class="form-control" autofocus  required=""/>
                                    </div>
                                    <div class="col-md-5 form-group">
                                        <label class="control-label">ผู้เรียบเรียง</label>
                                        <input type="text" name="inBsWriter" id="inBsWriter" class="form-control" autofocus  required=""/>
                                    </div>
                                    <div class="col-md-5 form-group">
                                        <label class="control-label">ปี พ.ศ.ที่เผยแพร่</label>
                                        <input type="text" name="inBsYear" id="inBsYear" class="form-control" autofocus  required=""/>
                                    </div>
                                    <div class="col-md-5 form-group">
                                        <label class="control-label">ราคา(บาท)</label>
                                        <input type="number" name="inBsPrice" id="inBsPrice" class="form-control" autofocus  required=""/>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4 form-group">
                                            <label class="control-label">ภาพหนังสือ</label>
                                            <input type="file" name="inBsImage" id="inBsImage" class="filestyle" />
                                        </div>
                                    </div>
                                </div>    

                                <div class="row">
                                    <center><button type="submit" class="btn btn-success btn-insert"><i class="icon-save icon-large"></i> บันทึก</button></center>
                                </div>
                                <input type="hidden" name="id" id="id" />
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer" style="background-color:#CEE3F6;">
                <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="icon-power-off"></i></button>
            </div>
        </div>
    </div>
</div>
<script>
    $("#insert-form").on("submit", function (e) {
        e.preventDefault();

        var image = $('#inBsImage').val();
        var ext1 = $("#inBsImage").val().split('.').pop().toLowerCase();

        //
        if ((image != "" && jQuery.inArray(ext1, ['jpg']) == -1)) {
            alert("ไฟล์ภาพจะต้องเป็นชนิด jpg เท่านั้น");
            $(":file").filestyle('clear');
            return false;
        }
        $.ajax({
            url: "<?php echo site_url('bs-update'); ?>",
            method: "post",
            data: new FormData(this),
            cache: false,
            contentType: false,
            processData: false,
            success: function (data) {
                alert("บันทึกข้อมูลสำเร็จ");
                $("#insert-form")[0].reset();
                location.reload();
            }
        });
    });
</script>