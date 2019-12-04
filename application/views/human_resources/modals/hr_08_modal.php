<!-- Modal -->
<div id="hr-08-modal" class="modal fade" role="dialog">
    <div class="modal-dialog" style="width:90%;">
        <div class="modal-content">
            <div class="modal-header" style="background:#0080FF;color:#FFFFFF;">
                <button type="button" class="close" data-dismiss="modal">X</button>
                <h3 class="modal-title" id="title"></h2>
            </div>
            <div class="modal-body" style="padding-left:30px;padding-right:30px;">
                <form id="insert-form" method="post" enctype="multipart/form-data">
                    <div class="row">
                        <div class="form-group col-md-4">
                            <label class="control-label">วัน/เดือน/ปี</label>
                            <div class="form-group">
                                <select name="inHr08Day" id="inHr08Day" class="my-select" required>
                                    <option value="">--วันที่--</option>
                                    <?php for ($i = 1; $i <= 31; $i++): ?>
                                        <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                    <?php endfor; ?>
                                </select>
                                <?php $arr = array('1' => "มกราคม", "2" => "กุมภาพันธ์", "3" => "มีนาคม", "4" => "เมษายน", "5" => "พฤษภาคม", "6" => "มิถุนายน", "7" => "กรกฎาคม", "8" => "สิงหาคม", "9" => "กันยายน", "10" => "ตุลาคม", "11" => "พฤศจิกายน", "12" => "ธันวาคม"); ?>
                                <select name="inHr08Month" id="inHr08Month" class="my-select" required>
                                    <option value="">--เดือน--</option>
                                    <?php foreach ($arr as $key => $value): ?>
                                        <option value="<?php echo $key; ?>"><?php echo $value; ?></option>
                                    <?php endforeach; ?>

                                </select>
                                <select name="inHr08Year" id="inHr08Year" class="my-select" required>
                                    <option value="">--พ.ศ.--</option>
                                    <?php for ($i = 2450; $i <= (date("Y") + 543); $i++): ?>
                                        <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                    <?php endfor; ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group col-md-2">
                            <label class="control-label">ตำแหน่ง</label>
                            <input type="text" name="inHr08Rank" id="inHr08Rank" class="form-control" />
                        </div>
                        <div class="form-group col-md-2">
                            <label class="control-label">ระดับ</label>
                            <input type="text" name="inHr08Level" id="inHr08Level" class="form-control" />
                        </div>
                        <div class="form-group col-md-4">
                            <label class="control-label">หน่วยงาน</label>
                            <input type="text" name="inHr08Office" id="inHr08Office" class="form-control" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-3">
                            <label class="control-label">จังหวัด</label>
                            <input type="text" name="inHr08Province" id="inHr08Province" class="form-control" />
                        </div>
                        <div class="form-group col-md-4">
                            <label class="control-label">เอกสารประกอบ</label>
                            <input type="file" name="inHr08File" id="inHr08File" class="filestyle" />
                        </div>

                        <div class="form-group col-md-5">
                            <label class="control-label">หมายเหตุ</label>
                            <input type="text" name="inHr08Comment" id="inHr08Comment" class="form-control" />
                        </div>
                    </div>
                    <div class="row"><center><button type="submit" class="btn btn-success"><i class="icon-save icon-large"></i> บันทึก</button></center></div>
                    <input type="hidden" name="hr_id" id="hr_id" value="<?php echo $human['id']; ?>" />
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
        var file = $('#inHr08File').val();
        var ext = $('#inHr08File').val().split('.').pop().toLowerCase();
        if (file != '' && jQuery.inArray(ext, ['jpg', 'png']) == -1) {
            alert('ไฟล์เอกสารจะต้องเป็นชนิด jpg หรือ png เท่านั้น');
            return false;
        }
        //
        $.ajax({
            url: '<?php echo site_url('insert-human-resources-part-08'); ?>',
            method: 'post',
            data: new FormData(this),
            contentType: false,
            cache: true,
            processData: false,
            success: function (data) {
                $('#insert-form')[0].reset();
                location.reload();
            }
        });
    });
</script>