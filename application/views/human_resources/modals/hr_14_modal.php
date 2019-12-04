<!-- Modal -->
<div id="hr-14-modal" class="modal fade" role="dialog">
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
                            <?php echo form_label('รายละเอียด', '', array('class' => 'control-label')); ?>
                            <?php echo form_input(array('type' => 'text', 'name' => 'inHr14Detail', 'id' => 'inHr14Detail', 'class' => 'form-control')); ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-8">
                            <label class="control-label">วัน/เดือน/ปี</label>
                            <div class="form-group">
                                <select name="inHr14Day" id="inHr14Day" class="my-select" required>
                                    <option value="">--วันที่--</option>
                                    <?php for ($i = 1; $i <= 31; $i++): ?>
                                        <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                    <?php endfor; ?>
                                </select>
                                <?php $arr = array('1' => "มกราคม", "2" => "กุมภาพันธ์", "3" => "มีนาคม", "4" => "เมษายน", "5" => "พฤษภาคม", "6" => "มิถุนายน", "7" => "กรกฎาคม", "8" => "สิงหาคม", "9" => "กันยายน", "10" => "ตุลาคม", "11" => "พฤศจิกายน", "12" => "ธันวาคม"); ?>
                                <select name="inHr14Month" id="inHr14Month" class="my-select" required>
                                    <option value="">--เดือน--</option>
                                    <?php foreach ($arr as $key => $value): ?>
                                        <option value="<?php echo $key; ?>"><?php echo $value; ?></option>
                                    <?php endforeach; ?>

                                </select>
                                <select name="inHr14Year" id="inHr14Year" class="my-select" required>
                                    <option value="">--พ.ศ.--</option>
                                    <?php for ($i = 2450; $i <= (date("Y") + 543); $i++): ?>
                                        <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                    <?php endfor; ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group col-md-4">
                            <?php echo form_label('เอกสารประกอบ', '', array('class' => 'control-label')); ?>
                            <?php echo form_upload('inHr14Document', '', array('class' => 'filestyle', 'id' => 'inHr14Document')); ?>
                        </div>
                    </div>
                    <div class="row"><center><button type="submit" class="btn btn-success"><i class="icon-save icon-large"></i> บันทึก</button></center></div>
                    <input type="hidden" name="id" id="id" />
                    <input type="hidden" name="hr_id" id="hr_id" value="<?php echo $this->uri->segment(2); ?>" />
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    $(".datepicker").datepicker({autoclose: true, language: 'th'});
    $('#insert-form').on('submit', function (e) {
        e.preventDefault();
        var file = $('#inHr14Document').val();
        var file_ext = $('#inHr14Document').val().split('.').pop().toLowerCase();
        if (file != '' && jQuery.inArray(file_ext, ['jpg', 'png']) == -1) {
            alert('ไฟล์เอกสารประกอบจะต้องเป็นชนิด jpg หรือ png');
            return false;
        }
        //
        $.ajax({
            url: '<?php echo site_url('insert-human-resources-part-14'); ?>',
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