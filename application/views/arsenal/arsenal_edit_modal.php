<div id="arsenal-edit-modal" class="modal fade" role="dialog">
    <div class="modal-dialog" style="width:70%;">
        <div class="modal-content">
            <div class="modal-header" style="background:#0080FF;color:#FFFFFF;">
                <button type="button" class="close" data-dismiss="modal">X</button>
                <h3 class="modal-title" id="title"></h3>
            </div>
            <div class="modal-body">
                <form method="post" enctype="multipart/form-data" id="insert-form">
                    <div class="col-md-12 ">

                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label class="control-label">รูปภาพ</label>
                                <input type="file" name="inTbArsenalImg" id="inTbArsenalImg" class="filestyle" />
                            </div>
                        </div> 
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label class="control-label">เอกสาร</label>
                                <input type="file" name="inTbArsenalDoc" id="inTbArsenalDoc" class="filestyle" />
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label class="control-label">ลิ้งค์</label>
                                <input type="text" name="inTbArsenalLink" id="inTbArsenalLink" class="form-control" />
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 form-group">
                                <label class="control-label">ข้อมูล</label>
                                <textarea id="inTbArsenalData" name="inTbArsenalData" style="width:100%;height:100px;"></textarea>
                            </div>
                        </div>
                        <input type="hidden" name="id" id="id" />
                    </div>
                    <div class="row" style="margin-top:20px;">
                        <center><input type="submit" value="บันทึกข้อมูล" class="btn btn-success" /></center>
                    </div>

                </form>
            </div>
            <div class="modal-footer" style="background-color:#CEE3F6;">
                <button type="button" class="btn btn-danger btn-lg" data-dismiss="modal"><i class="icon-power-off"></i></button>
            </div>
        </div>
    </div>
</div>
<script>
    $("#insert-form").on("submit", function (e) {
        e.preventDefault();

        var image = $('#inTbArsenalImg').val();
        var ext1 = $("#inTbArsenalImg").val().split('.').pop().toLowerCase();

        var file = $('#inTbArsenalData').val();
        var ext2 = $("#inTbArsenalData").val().split('.').pop().toLowerCase();


        //
        if ((image != "" && jQuery.inArray(ext1, ['jpg']) == -1)) {
            alert("ไฟล์จะต้องเป็นชนิด jpg เท่านั้น");
            $(":file").filestyle('clear');
            return false;
        }
        if (file != "" && jQuery.inArray(ext2, ['pdf']) == -1) {
            alert('ไฟล์เอกสารจะต้องเป็นชนิด pdf เท่านั้น');
            $(":file").filestyle('clear');
            return false;
        }

        $.ajax({
            url: "<?php echo site_url('arsenal-insert'); ?>",
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