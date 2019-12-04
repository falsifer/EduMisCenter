<!-- Modal -->
<div id="hr-11-modal" class="modal fade" role="dialog">
    <div class="modal-dialog" style="width:70%;">
        <div class="modal-content">
            <div class="modal-header" style="background:#0080FF;color:#FFFFFF;">
                <button type="button" class="close" data-dismiss="modal">X</button>
                <h3 class="modal-title" id="title"></h3>
            </div>
            <div class="modal-body" style="padding-left:30px;padding-right:30px;">
                <form id="insert-form" method="post" enctype="multipart/form-data">
                    <div class="row">
                        <div class="form-group col-md-3">
                            <label class="control-label">วัน/เดือน/ปี</label>
                            <input type="text" name="inHr11Date" id="inHr11Date" class="form-control datepicker" data-date-format="yyyy-mm-dd" placeholder="คลิกวันที่..." />
                        </div>
                        <div class="form-group col-md-4">
                            <label class="control-label">ประเภทการลา</label>
                            <select name="inHr11Type" id="inHr11Type" class="form-control">
                                <option value="">---เลือกข้อมูล---</option>
                                <option value="มาสาย">มาสาย</option>
                                <option value="ลาป่วย">ลาป่วย</option>
                                <option value="ลากิจ">ลากิจ</option>
                                <option value="ขาด">ขาด</option>
                                <option value="ไปราชการ">ไปราชการ</option>
                                <option value="ลาพักผ่อน">ลาพักผ่อน</option>
                                <option value="ลาคลอด">ลาคลอด</option>
                                <option value="ลาบวช/ฮัจช์">ลาบวช/ฮัจช์</option>
                                <option value="ลาศึกษาต่อ">ลาศึกษาต่อ</option>
                            </select>
                        </div>
                        <div class="form-group col-md-5">
                            <label class="control-label">เอกสารประกอบ</label>
                            <input type="file" name="inHr11File" id="inHr11File" class="filestyle" />
                        </div>
                    </div>
                    <div class="row"><center><button type="submit" class="btn btn-success"><i class="icon-save icon-large"></i> บันทึก</button></center></div>
                    <input type="hidden" name="hr_id" value="<?php echo $human['id']; ?>" />
                    <input type="hidden" name="id" id="id" />
                </form>
            </div>
            <div class="modal-footer" style="background-color:#CEE3F6;">
                <button type="button" class="btn btn-link" data-dismiss="modal">ปิดหน้าต่างนี้</button>
            </div>
        </div>
    </div>
</div>
<script>
    $(".datepicker").datepicker({autoclose: true, language: 'th'});
    $('#insert-form').on('submit', function (e) {
        e.preventDefault();
        var file = $('#inHr11File').val();
        var ext = $('#inHr11File').val().split('.').pop().toLowerCase();
        if (file != '' && jQuery.inArray(ext, ['pdf', 'doc', 'docx']) == -1) {
            alert('ไฟล์เอกสารจะต้องเป็นชนิด pdf, doc หรือ docx เท่านั้น');
            return false;
        }
        //
        $.ajax({
            url: '<?php echo site_url('insert-human-resources-part-11'); ?>',
            method: 'post',
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            success: function (data) {
                alert('บันทึกข้อมูลเรียบร้อยแล้ว...');
                $('#insert-form')[0].reset();
                location.reload();
            }
        });
    });
</script>