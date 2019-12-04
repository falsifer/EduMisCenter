<!-- Modal -->
<div id="arsenal-edit-modal" class="modal fade" role="dialog">
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

                                </div>    

                                <div class="row">
                                    <center><button type="submit" class="btn btn-success btn-insert"><i class="icon-save icon-large"></i> บันทึกข้อมูล</button></center>
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
        var image = $('#inBdImg1').val();
        var ext1 = $("#inBdImg1").val().split('.').pop().toLowerCase();

        var image = $('#inBdImg2').val();
        var ext1 = $("#inBdImg2").val().split('.').pop().toLowerCase();

        var image = $('#inBdImg3').val();
        var ext1 = $("#inBdImg3").val().split('.').pop().toLowerCase();
        //
        if ((image != "" && jQuery.inArray(ext1, ['jpg']) == -1)) {
            alert("ไฟล์จะต้องเป็นชนิด jpg เท่านั้น");
            $(":file").filestyle('clear');
            return false;
        }
        $.ajax({
            url: "<?php echo site_url('arsenal-update'); ?>",
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