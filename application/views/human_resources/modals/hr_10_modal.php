<!-- Modal -->
<div id="hr-10-modal" class="modal fade" role="dialog">
    <div class="modal-dialog" style="width:90%;">
        <div class="modal-content">
            <div class="modal-header" style="background:#0080FF;color:#FFFFFF;">
                <button type="button" class="close" data-dismiss="modal">X</button>
                <h3 class="modal-title" id="title"></h3>
            </div>
            <div class="modal-body" style="padding-left:30px;padding-right:30px;">
                <form method="post" id="insert-form" enctype="multipart/form-data">
                    <div class="row">
                        <div class="form-group col-md-4">
                            <label class="control-label">เลขประจำตัว</label>
                            <input type="text" name="inHr10Id" id="inHr10Id" class="form-control" autofocus required/>
                        </div>
                        <div class="form-group col-md-4">
                            <label class="control-label">ประเภท</label>
                            <input type="text" name="inHr10Type" id="inHr10Type" class="form-control"/>
                        </div>
                        <div class="form-group col-md-4">
                            <label class="control-label">เลขที่ใบประกอบวิชาชีพ</label>
                            <input type="text" name="inHr10No" id="inHr10No" class="form-control"/>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label class="control-label">วัน/เดือน/ปี เริ่มต้น</label>
                            <div class="form-group">
                                <select name="inHr10BeginDay" id="inHr10BeginDay" class="my-select" required>
                                    <option value="">--วันที่--</option>
                                    <?php for ($i = 1; $i <= 31; $i++): ?>
                                        <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                    <?php endfor; ?>
                                </select>
                                <?php $arr = array('1' => "มกราคม", "2" => "กุมภาพันธ์", "3" => "มีนาคม", "4" => "เมษายน", "5" => "พฤษภาคม", "6" => "มิถุนายน", "7" => "กรกฎาคม", "8" => "สิงหาคม", "9" => "กันยายน", "10" => "ตุลาคม", "11" => "พฤศจิกายน", "12" => "ธันวาคม"); ?>
                                <select name="inHr10BeginMonth" id="inHr10BeginMonth" class="my-select" required>
                                    <option value="">--เดือน--</option>
                                    <?php foreach ($arr as $key => $value): ?>
                                        <option value="<?php echo $key; ?>"><?php echo $value; ?></option>
                                    <?php endforeach; ?>

                                </select>
                                <select name="inHr10BeginYear" id="inHr10BeginYear" class="my-select" required>
                                    <option value="">--พ.ศ.--</option>
                                    <?php for ($i = 2500; $i <= (date("Y") + 550); $i++): ?>
                                        <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                    <?php endfor; ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label class="control-label">วัน/เดือน/ปี หมดอายุ</label>
                            <div class="form-group">
                                <select name="inHr10EndDay" id="inHr10EndDay" class="my-select" required>
                                    <option value="">--วันที่--</option>
                                    <?php for ($i = 1; $i <= 31; $i++): ?>
                                        <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                    <?php endfor; ?>
                                </select>
                                <?php $arr = array('1' => "มกราคม", "2" => "กุมภาพันธ์", "3" => "มีนาคม", "4" => "เมษายน", "5" => "พฤษภาคม", "6" => "มิถุนายน", "7" => "กรกฎาคม", "8" => "สิงหาคม", "9" => "กันยายน", "10" => "ตุลาคม", "11" => "พฤศจิกายน", "12" => "ธันวาคม"); ?>
                                <select name="inHr10EndMonth" id="inHr10EndMonth" class="my-select" required>
                                    <option value="">--เดือน--</option>
                                    <?php foreach ($arr as $key => $value): ?>
                                        <option value="<?php echo $key; ?>"><?php echo $value; ?></option>
                                    <?php endforeach; ?>

                                </select>
                                <select name="inHr10EndYear" id="inHr10EndYear" class="my-select" required>
                                    <option value="">--พ.ศ.--</option>
                                    <?php for ($i = 2500; $i <= (date("Y") + 550); $i++): ?>
                                        <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                    <?php endfor; ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label class="control-label">หมายเหตุ</label>
                            <input type="text" name="inHr10Comment" id="inHr10Comment" class="form-control" />
                        </div>
                        <div class="form-group col-md-6">
                            <label class="control-label">รูปภาพใบประกอบวิชาชีพ</label>
                            <input type="file" name="inHr10Image" id="inHr10Image" class="filestyle" />
                        </div>
                    </div>
                    <div class="row"><center><button type="submit" class="btn btn-success"><i class="icon-save icon-large"></i> บันทึก</button></center></div>
                    <input type="hidden" name="id" id="id" />
                    <input type="hidden" name="hr_id" value="<?php echo $human['id']; ?>" />
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    $(".datepicker").datepicker({autoclose: true, language: 'th'});
    $('#insert-form').on('submit', function (e) {
        e.preventDefault();
        var file = $('#inHr10Image').val();
        var ext = $('#inHr10Image').val().split('.').pop().toLowerCase();
        if (file != '' && jQuery.inArray(ext, ['jpg', 'png']) == -1) {
            alert('ไฟล์เอกสารจะต้องเป็นชนิด jpg หรือ png เท่านั้น');
            return false;
        }
        //
        $.ajax({
            url: '<?php echo site_url('insert-human-resources-part-10'); ?>',
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