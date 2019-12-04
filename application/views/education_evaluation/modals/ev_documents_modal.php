<div id="ev-documents-modal" class="modal fade" role="dialog">
    <div class="modal-dialog" style="width:80%;">
        <div class="modal-content">
            <div class="modal-header" style="background:#0080FF;color:#FFFFFF;">
                <button type="button" class="close" data-dismiss="modal">X</button>
                <h3 class="modal-title" id="title"></h3>
            </div>
            <div class="modal-body">
                <form method="post" id="insert-form" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-md-3 form-group">
                            <label class="control-label">วันที่บันทึกข้อมูล</label>
                            <input type="text" name="inDocumentsDate" id="inDocumentsDate" class="form-control datepicker" data-date-format="yyyy-mm-dd" placeholder="คลิกวันที่..." />
                        </div>
                        <div class="col-md-3 form-group">
                            <label class="control-label">ประเภทเอกสาร</label>
                            <select name="inDocumentsType" id="inDocumentsType" class="form-control">
                                <option value="">---เลือกข้อมูล---</option>
                                <option value="เอกสารประกอบ">เอกสารประกอบ</option>
                                <option value="ภาพประกอบ">ภาพประกอบ</option>
                            </select>
                        </div>
                        <div class="form-group col-md-4">
                            <label class="control-label">ไฟล์เอกสาร</label>
                            <input type="file" name="inDocumentsFile" id="inDocumentsFile" class="filestyle" />
                        </div>
                        <div class="col-md-1 form-group">
                            <label class="control-label">&nbsp;</label>
                            <button type="submit" class="btn btn-success"><i class="icon-save icon-large"></i> บันทึก</button>
                        </div>
                    </div>
                    <input type="hidden" name="ev_id" id="ev_id" value="<?php echo $this->uri->segment(2); ?>" />
                    <input type="hidden" name="id" id="id" />
                </form>
            </div>
            <div class="modal-footer" style="background-color:#CEE3F6;">
                <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal"><i class="icon-power-off"></i></button>
            </div>
        </div>
    </div>
</div>
<script>
    $(".datepicker").datepicker({autoclose: true, language: 'th'});
    $('#insert-form').on('submit', function (e) {
        e.preventDefault();
        var file = $('#inDocumentsFile').val();
        var ext = $('#inDocumentsFile').val().split('.').pop().toLowerCase();
        var type = $('#inDocumentsType').val();
        //
        if (file == '') {
            alert('ไฟล์ข้อมูลประกอบการดำเนินงานจะมีค่าว่างไม่ได้');
            return false;
        }
        //
        if (type == 'เอกสารประกอบ') {
            if (jQuery.inArray(ext, ['pdf', 'doc', 'docx']) == -1) {
                alert('เอกสารประกอบจะต้องเป็นชนิด pdf, doc, docx เท่านั้น');
                return false;
            }
        } else {
            if (jQuery.inArray(ext, ['jpg', 'png']) == -1) {
                alert('เอกสารประกอบจะต้องเป็นชนิด jpg หรือ png เท่านั้น');
                return false;
            }
        }
        //
        $.ajax({
            url: '<?php echo site_url('insert-education-evaluation-documents'); ?>',
            method: 'post',
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            success: function (data) {
                $('#insert-form')[0].reset();
                location.reload();
            }
        });
    });
</script>
