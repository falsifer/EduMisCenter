<!-- Modal -->
<div id="hr-04-modal" class="modal fade" role="dialog">
    <div class="modal-dialog" style="width:90%;">
        <div class="modal-content">
            <div class="modal-header" style="background:#0080FF;color:#FFFFFF;">
                <button type="button" class="close" data-dismiss="modal">X</button>
                <h3 class="modal-title" id="title"></h3>
            </div>
            <div class="modal-body" style="padding-left:30px;padding-right:30px;">
                <form method="post" id="insert-form">
                    <div class="row">
                        <div class="col-md-4">
                            <label class="control-label">วัน/เดือน/ปี</label>
                            <div class="form-group">
                                <select name="inHr04Day" id="inHr04Day" class="my-select" required>
                                    <option value="">--วันที่--</option>
                                    <?php for ($i = 1; $i <= 31; $i++): ?>
                                        <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                    <?php endfor; ?>
                                </select>
                                <?php $arr = array('1' => "มกราคม", "2" => "กุมภาพันธ์", "3" => "มีนาคม", "4" => "เมษายน", "5" => "พฤษภาคม", "6" => "มิถุนายน", "7" => "กรกฎาคม", "8" => "สิงหาคม", "9" => "กันยายน", "10" => "ตุลาคม", "11" => "พฤศจิกายน", "12" => "ธันวาคม"); ?>
                                <select name="inHr04Month" id="inHr04Month" class="my-select" required>
                                    <option value="">--เดือน--</option>
                                    <?php foreach ($arr as $key => $value): ?>
                                        <option value="<?php echo $key; ?>"><?php echo $value; ?></option>
                                    <?php endforeach; ?>

                                </select>
                                <select name="inHr04Year" id="inHr04Year" class="my-select" required>
                                    <option value="">--พ.ศ.--</option>
                                    <?php for ($i = 2450; $i <= (date("Y") + 543); $i++): ?>
                                        <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                    <?php endfor; ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group col-md-4">
                            <label class="control-label">ตำแหน่ง</label>
                            <input type="text" name="inHr04Rank" id="inHr04Rank" class="form-control" required/>
                        </div>
                        <div class="form-group col-md-4">
                            <label class="control-label">ปฏิบัติหน้าที่</label>
                            <input type="text" name="inHr04Operation" id="inHr04Operation" class="form-control" required/>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-5">
                            <label class="control-label">สังกัดหน่วยงาน</label>
                            <input type="text" name="inHr04Organization" id="inHr04Organization" class="form-control" />
                        </div>
                        <div class="form-group col-md-3">
                            <label class="control-label">ระยะเวลา</label>
                            <input type="text" name="inHr04Long" id="inHr04Long" class="form-control" placeholder="เช่น 1 ปี 2 เดือน"/>
                        </div>
                        <div class="form-group col-md-4">
                            <label class="control-label">เอกสารอ้างอิง</label>
                            <input type="file" name="inHr04File" id="inHr04File" class="filestyle" />
                        </div>
                    </div>
                    <div class="row"><center><button type="submit" class="btn btn-success"><i class="icon-save icon-large"></i> บันทึก</button></center></center></div>
                    <input type="hidden" name="hr_id" value="<?php echo $this->uri->segment(2);?>" />
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
    //
    $('#insert-form').on('submit', function (e) {
        e.preventDefault();
        var file = $('#inHr04File').val();
        var file_ext = $('#inHr04File').val().split('.').pop().toLowerCase();
        //
        if(file != '' && jQuery.inArray(file_ext,['jpg'])==-1){
            alert('ไฟล์เอกสารอ้างอิงจะต้องเป็น jpg เท่านั้น');
            return false;
        }
        //
        $.ajax({
            url:'<?php echo site_url('insert-human-resources-part-04'); ?>',
            method:'post',
            data:new FormData(this),
            contentType:false,
            cache:false,
            processData:false,
            success:function(data){
                $('#insert-form')[0].reset();
                location.reload();
            }
        });

    });
</script>