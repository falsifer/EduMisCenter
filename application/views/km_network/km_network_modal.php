<!-- Modal -->
<div id="km-network-modal" class="modal fade" role="dialog">
    <div class="modal-dialog" style="width:70%;">
        <div class="modal-content">
            <div class="modal-header" style="background:#0080FF;color:#FFFFFF;">
                <button type="button" class="close" data-dismiss="modal">X</button>
                <h3 class="modal-title" id="title"></h2>
            </div>
            <div class="modal-body">
                <form method="post" id="insert-form" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-md-3 form-group">
                            <label class="control-label">วันที่นำเสนอ</label><span class="star">&#42;</span>
                            <input type="text" name="inKmNetworkDate" id="inKmNetworkDate" class="form-control datepicker" data-date-format="yyyy-mm-dd" placeholder="คลิกวันที่..." required/>
                        </div>
                        <div class="col-md-5 form-group">
                            <label class="control-label">หัวข้อการสำเสนอ</label><span class="star">&#42;</span>
                            <input type="text" name="inKmNetworkTopic" id="inKmNetworkTopic" class="form-control"  required/>
                        </div>
                        <div class="col-md-4 form-group">
                            <label class="control-label">วัตถุประสงค์</label><span class="star">&#42;</span>
                            <input type="text" name="inKmNetworkPurpose" id="inKmNetworkPurpose" class="form-control"  required/>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 form-group">
                            <label class="control-label">รายละเอียด</label><span class="star">&#42;</span>
                            <textarea  name="inKmNetworkDetail" id="inKmNetworkDetail" style="height:180px;width:100%;"></textarea>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3 form-group">
                            <label class="control-label">ภาพประกอบ 1</label>
                            <input type="file" name="inKmNetworkImage1" id="inKmNetworkImage1" class="filestyle" />
                        </div>
                        <div class="col-md-3 form-group">
                            <label class="control-label">ภาพประกอบ 2</label>
                            <input type="file" name="inKmNetworkImage2" id="inKmNetworkImage2" class="filestyle" />
                        </div>
                        <div class="col-md-3 form-group">
                            <label class="control-label">ภาพประกอบ 3</label>
                            <input type="file" name="inKmNetworkImage3" id="inKmNetworkImage3" class="filestyle" />
                        </div>
                        <div class="col-md-3 form-group">
                            <label class="control-label">ภาพประกอบ 4</label>
                            <input type="file" name="inKmNetworkImage4" id="inKmNetworkImage4" class="filestyle" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label class="control-label">ไฟล์เอกสาร</label>
                            <input type="file" name="inKmNetworkDoc" id="inKmNetworkDoc" class="filestyle" />
                        </div>
                    </div>
                    <div class="row">
                        <center><button type="submit" class="btn btn-success btn-insert"><i class="icon-save icon-large"></i> บันทึก</button></center>
                    </div>
                    <input type="hidden" id="id" name="id" />
                </form>
            </div>
            <div class="modal-footer" style="background-color:#CEE3F6;">
                <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="icon-power-off"></i></button>
            </div>
        </div>
    </div>
</div>
<script>
    $(".datepicker").datepicker({autoclose: true, language: 'th'});
    $("#summernote").summernote({
        tabsize: 2,
        height: 130
    });
    //
    $("#insert-form").on("submit", function (e) {
        e.preventDefault();
        //
        var file1 = $("#inKmNetworkImage1").val();
        var ext1 = $("#inKmNetworkImage1").val().split('.').pop().toLowerCase();
        var file2 = $("#inKmNetworkImage2").val();
        var ext2 = $("#inKmNetworkImage2").val().split('.').pop().toLowerCase();
        var file3 = $("#inKmNetworkImage3").val();
        var ext3 = $("#inKmNetworkImage3").val().split('.').pop().toLowerCase();
        var file4 = $("#inKmNetworkImage4").val();
        var ext4 = $("#inKmNetworkImage4").val().split('.').pop().toLowerCase();
        var file5 = $("#inKmNetworkDoc").val();
        var ext5 = $("#inKmNetworkDoc").val().split('.').pop().toLowerCase();
        //

        if (file1 != "" && jQuery.inArray(ext1, ['jpg']) == -1) {
            alert('ไฟล์ภาพที่ 1 จะต้องเป็นชนิด jpg เท่านั้น');
            return false;
        }
        if (file2 != "" && jQuery.inArray(ext2, ['jpg']) == -1) {
            alert('ไฟล์ภาพที่ 2 จะต้องเป็นชนิด jpg เท่านั้น');
            return false;
        }
        if (file3 != "" && jQuery.inArray(ext3, ['jpg']) == -1) {
            alert('ไฟล์ภาพที่ 3 จะต้องเป็นชนิด jpg เท่านั้น');
            return false;
        }
        if (file4 != "" && jQuery.inArray(ext4, ['jpg']) == -1) {
            alert('ไฟล์ภาพจะต้องเป็นชนิด jpg เท่านั้น');
            return false;
        }
        if (file5 != "" && jQuery.inArray(ext5, ['pdf']) == -1) {
            alert('ไฟล์เอกสารจะต้องเป็นชนิด pdf เท่านั้น');
            return false;
        }
        //
        $.ajax({
            url: '<?php echo site_url('insert-network-of-km'); ?>',
            method: 'post',
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            success: function (data) {
                $("#insert-form")[0].reset();
                location.reload();
            }
        });
    });
</script>
