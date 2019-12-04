<div id="rec-report-modal" class="modal fade" role="dialog">
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
                                <label class="control-label">ชื่อรายงาน</label>
                                <input type="text" name="inTbRecReportTopic" id="inTbRecReportTopic" class="form-control" autofocus />

                            </div>
                        </div> 
                        <div class="row">
                            <div class="col-md-4 form-group">
                                <label class="control-label">วันที่</label>
                                <input type="date" name="inTbRecReportDate" id="inTbRecReportDate" class="form-control" autofocus />
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label class="control-label">เรียน</label>
                                <input type="text" name="inTbRecReportFor" id="inTbRecReportFor" class="form-control" autofocus />
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label class="control-label">อ้างถึง</label>
                                <input type="text" name="inTbRecReportRefer" id="inTbRecReportRefer" class="form-control" autofocus />
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label class="control-label">สิ่งที่แนบมาด้วย</label>
                                <textarea id="inTbRecReportAttach" name="inTbRecReportAttach" style="width:100%;height:100px;"></textarea>
                            </div>
                        </div>


                        <div class="row">
                            <div class="col-md-12 form-group">
                                <label class="control-label">เนื้อหา</label>
                                <textarea id="inTbRecReportContent" name="inTbRecReportContent" style="width:100%;height:100px;"></textarea>
                            </div>
                        </div>  


                        <div class="row">
                            <div class="col-md-12 form-group">
                                <label class="control-label">สรุปผล</label>
                                <textarea id="inTbRecReportConclude" name="inTbRecReportConclude" style="width:100%;height:100px;"></textarea>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label class="control-label">เอกสารแนบ</label>
                                <input type="file" name="inTbRecReportFile" id="inTbRecReportFile" class="filestyle" />
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label class="control-label">รูปประกอบ1</label>
                                <input type="file" name="inTbRecReportImg1" id="inTbRecReportImg1" class="filestyle" />
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label class="control-label">รูปประกอบ2</label>
                                <input type="file" name="inTbRecReportImg2" id="inTbRecReportImg2" class="filestyle" />
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label class="control-label">รูปประกอบ3</label>
                                <input type="file" name="inTbRecReportImg3" id="inTbRecReportImg3" class="filestyle" />
                            </div>
                        </div>
                        <input type="hidden" name="id" id="id" />
                    </div>
                    <div class="row" style="margin-top:20px;">
                        <center><input type="submit" value="บันทึก" class="btn btn-success" /></center>
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

        var image = $('#inTbRecReportImg1').val();
        var ext1 = $("#inTbRecReportImg1").val().split('.').pop().toLowerCase();

        var image = $('#inTbRecReportIm2').val();
        var ext1 = $("#inTbRecReportImg2").val().split('.').pop().toLowerCase();

        var image = $('#inTbRecReportImg3').val();
        var ext1 = $("#inTbRecReportImg3").val().split('.').pop().toLowerCase();

        var file = $('#inTbRecReportFile').val();
        var ext2 = $("#inTbRecReportFile").val().split('.').pop().toLowerCase();


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
            url: "<?php echo site_url('rec-report-insert'); ?>",
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