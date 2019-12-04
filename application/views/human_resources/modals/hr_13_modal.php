<!-- Modal -->
<div id="hr-13-modal" class="modal fade" role="dialog">
    <div class="modal-dialog" style="width:90%;">
        <div class="modal-content">
            <div class="modal-header" style="background:#0080FF;color:#FFFFFF;">
                <button type="button" class="close" data-dismiss="modal">X</button>
                <h3 class="modal-title" id="title"></h3>
            </div>
            <div class="modal-body" style="padding-left:30px;padding-right:30px;">
                <form id="insert-form" method="post" enctype="multipart/form-data">
                    <div class="row">
                        <div class="form-group col-md-4">
                            <label class="control-label">วัน/เดือน/ปี</label>
                            <div class="form-group">
                                <select name="inHr13Day" id="inHr13Day" class="my-select" required>
                                    <option value="">--วันที่--</option>
                                    <?php for ($i = 1; $i <= 31; $i++): ?>
                                        <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                    <?php endfor; ?>
                                </select>
                                <?php $arr = array('1' => "มกราคม", "2" => "กุมภาพันธ์", "3" => "มีนาคม", "4" => "เมษายน", "5" => "พฤษภาคม", "6" => "มิถุนายน", "7" => "กรกฎาคม", "8" => "สิงหาคม", "9" => "กันยายน", "10" => "ตุลาคม", "11" => "พฤศจิกายน", "12" => "ธันวาคม"); ?>
                                <select name="inHr13Month" id="inHr13Month" class="my-select" required>
                                    <option value="">--เดือน--</option>
                                    <?php foreach ($arr as $key => $value): ?>
                                        <option value="<?php echo $key; ?>"><?php echo $value; ?></option>
                                    <?php endforeach; ?>

                                </select>
                                <select name="inHr13Year" id="inHr13Year" class="my-select" required>
                                    <option value="">--พ.ศ.--</option>
                                    <?php for ($i = 2450; $i <= (date("Y") + 543); $i++): ?>
                                        <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                    <?php endfor; ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group col-md-4">
                            <label class="control-label">เครื่องราชอิสริยาภรณ์</label>
                            <select name="inHr13Insignia" id="inHr13Insignia" class="form-control" required>
                                <option value="">---เลือกข้อมูล---</option>
                                <?php foreach ($insignia as $sig): ?>
                                    <option value="<?php echo $sig['insignia_name']; ?>"><img src="<?php echo base_url('upload/' . $sig['insignia_label_image']); ?>" /> <?php echo $sig['insignia_name']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group col-md-4">
                            <label class="control-label">เอกสารอ้างอิง</label>
                            <input type="file" name="inHr13Refer" id="inHr13Refer" class="filestyle" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-12">
                            <label class="control-label">หมายเหตุ</label>
                            <input type="text" name="inHr13Comment" id="inHr13Comment" class="form-control" />
                        </div>
                    </div>
                    <div class="row"><center><button type="submit" class="btn btn-success"><i class="icon-save icon-large"></i> บันทึก</button></center></div>
                    <input type="hidden" name="hr_id" id="hr_id" value="<?php echo $this->uri->segment(2); ?>" />
                    <input type="hidden" id="id" name="id" />
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    $(".datepicker").datepicker({autoclose: true, language: 'th'});
    //
    $('#insert-form').on("submit", function (e) {
        e.preventDefault();
        var file = $("#inHr13Refer").val();
        var file_ext = $("#inHr13Refer").val().split('.').pop().toLowerCase();
        if (file != '' && jQuery.inArray(file_ext, ['jpg', 'png']) == -1) {
            alert('ชนิดของไฟล์เอกสารอ้างอิงคือ jpg, png');
            return false;
        }
        $.ajax({
            url: '<?php echo site_url('insert-human_resources-part-13'); ?>',
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