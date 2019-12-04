<!-- Modal -->
<div id="hr-12-modal" class="modal fade" role="dialog">
    <div class="modal-dialog" style="width:90%;">
        <div class="modal-content">
            <div class="modal-header" style="background:#0080FF;color:#FFFFFF;">
                <button type="button" class="close" data-dismiss="modal">X</button>
                <h3 class="modal-title" id="title"></h3>
            </div>
            <div class="modal-body" style="padding-left:30px;padding-right:30px;">
                <form id="insert-form" method="post" enctype="multipart/form-data">
                    <div class="row">
                        
                        <div class="form-group col-md-12">
                            <label class="control-label">การกระทำผิด</label>
                            <input type="text" name="inHr12Detail" id="inHr12Detail" class="form-control" />
                        </div>
                        <div class="form-group col-md-8">
                            <label class="control-label">วัน/เดือน/ปี</label>
                            <div class="form-group">
                                <select name="inHr12Day" id="inHr12Day" class="my-select" required>
                                    <option value="">--วันที่--</option>
                                    <?php for ($i = 1; $i <= 31; $i++): ?>
                                        <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                    <?php endfor; ?>
                                </select>
                                <?php $arr = array('1' => "มกราคม", "2" => "กุมภาพันธ์", "3" => "มีนาคม", "4" => "เมษายน", "5" => "พฤษภาคม", "6" => "มิถุนายน", "7" => "กรกฎาคม", "8" => "สิงหาคม", "9" => "กันยายน", "10" => "ตุลาคม", "11" => "พฤศจิกายน", "12" => "ธันวาคม"); ?>
                                <select name="inHr12Month" id="inHr12Month" class="my-select" required>
                                    <option value="">--เดือน--</option>
                                    <?php foreach ($arr as $key => $value): ?>
                                        <option value="<?php echo $key; ?>"><?php echo $value; ?></option>
                                    <?php endforeach; ?>

                                </select>
                                <select name="inHr12Year" id="inHr12Year" class="my-select" required>
                                    <option value="">--พ.ศ.--</option>
                                    <?php for ($i = 2450; $i <= (date("Y") + 543); $i++): ?>
                                        <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                    <?php endfor; ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group col-md-4">
                            <label class="control-label">เอกสารประกอบ</label>
                            <input type="file" name="inHr12File" id="inHr12File" class="filestyle" />
                        </div>
                    </div>
                    <div class="row"><center><button type="submit" class="btn btn-success"><i class="icon-save icon-large"></i> บันทึก</button></center></div>
                    <input type="hidden" name="hr_id" value="<?php echo $hr['id']; ?>" />
                    <input type="hidden" name="id" id="id" />
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    $(".datepicker").datepicker({autoclose: true, language: 'th'});
    $('#insert-form').on('submit', function (e) {
        e.preventDefault();
        var file = $('#inHr12File').val();
        var ext = $('#inHr12File').val().split('.').pop().toLowerCase();
        if (file != '' && jQuery.inArray(ext, ['pdf', 'doc', 'docx']) == -1) {
            alert('ไฟล์เอกสารจะต้องเป็นชนิด pdf, doc หรือ docx เท่านั้น');
            return false;
        }
        //
        $.ajax({
            url: '<?php echo site_url('insert-human-resources-part-12'); ?>',
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