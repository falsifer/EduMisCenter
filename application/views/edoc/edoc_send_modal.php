<!-- Modal -->
<div id="edoc-send-modal" class="modal fade" role="dialog">
    <div class="modal-dialog" style="width:70%;">
        <div class="modal-content">
            <div class="modal-header" style="background:#0080FF;color:#FFFFFF;">
                <button type="button" class="close" data-dismiss="modal">X</button>
                <h3 class="modal-title" id="title"></h2>
            </div>
            <div class="modal-body">
                <form method="post" id="insert-form" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-md-2 form-group">
                            <label class="control-label">วัน/เดือน/ปี ส่ง</label>
                            <input type="text" name="inOutboxDate" id="inOutboxDate" class="form-control datepicker" data-date-format="yyyy-mm-dd" placeholder="คลิกวันที่..." required/>
                        </div>
                        <div class="col-md-3 form-group">
                            <label class="control-label">เลขที่หนังสือส่ง</label>
                            <input type="text" name="inOutboxSendNo" id="inOutboxSendNo" class="form-control" required />
                        </div>
                        <div class="col-md-7 form-group">
                            <label class="control-label">เรื่อง</label>
                            <input type="text" name="inOutboxTopic" id="inOutboxTopic" class="form-control" required />
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-5">
                            <label class="control-label">สิ่งที่ส่งมาด้วย</label>
                            <input type="text" name="inOutboxAttach" id="inOutboxAttach" class="form-control" />
                        </div>
                        <div class="form-group col-md-6">
                            <label class="control-label">รายละเอียดเพิ่มเติม</label>
                            <input type="text" name="inOutboxDetail" id="inOutboxDetail" class="form-control" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div id="send-to">
                                <label class="control-label"><b>ส่งถึง</b></label>
                                <div class="well">
                                    <?php foreach ($school as $s): ?>
                                        <input type="checkbox" class="magic-checkbox" name="inOutboxSendTo[]" id="<?php echo $s['sc_code'] ?>" value="<?php echo $s['sc_thai_name'] ?>" />&nbsp;<label for="<?php echo $s['sc_code'] ?>"><?php echo $s['sc_thai_name'] ?></label>
                                    <?php endforeach; ?>
                                        <input type="checkbox" class="magic-checkbox" name="inOutboxSendTo[]" id="ed" value="กองการศึกษา" />&nbsp;<label for="ed">กองการศึกษา</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row" style="margin-top:15px;">
                        <div class="col-md-2 form-group">
                            <label class="control-label">ชั้นความเร็ว</label>
                            <select name="inOutboxLevel" id="inOutboxLevel" class="form-control">
                                <option value="">---ชั้นความเร็ว---</option>
                                <option value="ด่วนที่สุด">ด่วนที่สุด</option>
                                <option value="ด่วนมาก">ด่วนมาก</option>
                                <option value="ด่วน">ด่วน</option>
                                <option value="ปกติ">ปกติ</option>
                            </select>
                        </div>
                        <div class="col-md-4 form-group">
                            <label class="control-label">ไฟล์เอกสาร</label>
                            <input type="file" name="inOutboxFile" id="inOutboxFile" class="filestyle" />
                        </div>
                        <div class="col-md-6 form-group">
                            <label class="control-label">หมายเหตุ</label>
                            <input type="text" name="inEdocComment" id="inEdocComment" class="form-control" />
                        </div>
                    </div>
                    <div class="row">
                        <center><button class="btn btn-success btn-insert"><i class="icon-save icon-large"></i> บันทึก</button></center>
                    </div>
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
        //
        var file = $("#inOutboxFile").val();
        var ext = $("#inOutboxFile").val().split('.').pop().toLowerCase();
        var uid = $('#id').val();
        if (uid != '') {
            if (file != '' && jQuery.inArray(ext, ['pdf']) == -1) {
                alert("ชนิดเอกสารจะต้องเป็น pdf เท่านั้น");
                return false;
            }
        } else {
            //
            if (file == "") {
                alert('ไฟล์เอกสารจะมีค่าว่างไม่ได้');
                return false;
            }
            // 
            if (jQuery.inArray(ext, ['pdf']) == -1) {
                alert("ชนิดเอกสารจะต้องเป็น pdf เท่านั้น");
                $(":file").filestyle('clear');
                return false;
            }
        }
        //
        $.ajax({
            url: '<?php echo site_url('send-document-to'); ?>',
            method: 'post',
            data: new FormData(this),
            cache: false,
            contentType: false,
            processData: false,
            success: function (data) {
                $("#insert-form")[0].reset();
                location.reload();
            }
        });
    });
</script>
