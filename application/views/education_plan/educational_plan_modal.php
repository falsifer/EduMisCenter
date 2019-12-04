<!-- Modal -->
<div id="educational-plan-modal" class="modal fade" role="dialog">
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
                            <label class="control-label">วันที่บันทึกแผน</label><span class="star">&#42;</span>
                            <input type="text" name="inEducationalPlanDate" id="inEducationalPlanDate" class="form-control datepicker" data-date-format="yyyy-mm-dd" placeholder="คลิกวันที่..." required/>
                        </div>
                        <div class="col-md-9 form-group">
                            <label class="control-label">ชื่อแผนพัฒนาการศึกษา</label><span class="star">&#42;</span>
                            <input type="text" name="inEducationalPlanTopic" id="inEducationalPlanTopic" class="form-control"  required/>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <label class="control-label">คำอธิบายโดยสังเขป</label>
                            <textarea name="inEducationalPlanDescription" id="inEducationalPlanDescription" class="form-control" style="width:100%;height:150px;"></textarea>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-5 form-group">
                            <label class="control-label">ไฟล์เอกสาร</label><span class="star">&#42;</span>
                            <input type="file" name="inEducationalPlanFile" id="inEducationalPlanFile" class="filestyle" />
                        </div>
                    </div>
                    <div class="row"><center><button type="submit" class="btn btn-success"><i class="icon-save icon-large"></i> บันทึกข้อมูล</button></center></div>
                    <div class="row"><div class="col-md-12">เครื่องหมาย <span class="star">&#42;</span> จำเป็นต้องกรอก</div></div>
                    <input type="hidden" name="id" id="id" />
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
    $("#insert-form").on("submit", function (e) {
        e.preventDefault();
        var file = $("#inEducationalPlanFile").val();
        var ext = $("#inEducationalPlanFile").val().split('.').pop().toLowerCase();
        var id = $("#id").val();
        if (id != '') {
            if (file != '' && jQuery.inArray(ext, ['pdf']) == -1) {
                alert('ชนิดไฟล์เอกสารจะต้องเป็น pdf เท่านั้น');
                $(":file").filestyle("clear");
                return false;
            }

        } else {
            if (file == "") {
                alert("ไฟล์เอกสารแผนงานจะต้องกรอก");
                return false;
            }
            //
            if (jQuery.inArray(ext, ['pdf']) == -1) {
                alert('ชนิดไฟล์เอกสารจะต้องเป็น pdf เท่านั้น');
                return false;
            }
        }
        //
        $.ajax({
            url: "<?php echo site_url('insert-educational-plan'); ?>",
            method: "POST",
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