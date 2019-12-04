<!-- Modal -->
<div id="student-modal" class="modal fade" role="dialog">
    <div class="modal-dialog" style="width:80%;">
        <div class="modal-content">
            <div class="modal-header" style="background:#0080FF;color:#FFFFFF;">
                <button type="button" class="close" data-dismiss="modal">X</button>
                <h3 class="modal-title" id="title"></h3>
            </div>
            <div class="modal-body">
                <form id="insert-form" method="post" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-md-2 form-group">
                            <label class="control-label">รหัสนักเรียน</label>
                            <input type="text" name="inStdCode" id="inStdCode" class="form-control" required />
                        </div>
                        <div class="col-md-2 form-group">
                            <label class="control-label">คำนำหน้าชื่อ</label>
                            <select name="inStdTitleName" id="inStdTitleName" class="form-control" required>
                                <option value="">---เลือกข้อมูล---</option>
                                <option value="ด.ช.">ด.ช.</option>
                                <option value="ด.ญ.">ด.ญ.</option>
                                <option value="นาย">นาย</option>
                                <option value="นางสาว">นางสาว</option>
                            </select>
                        </div>
                        <div class="form-group col-md-3">
                            <label class="control-label">ชื่อ (ภาษาไทย)</label>
                            <input type="text" name="inStdThaiName" id="inStdThaiName" class="form-control"  required/>
                        </div>
                        <div class="form-group col-md-3">
                            <label class="control-label">นามสกุล (ภาษาไทย)</label>
                            <input type="text" name="inStdThaiLastname" id="inStdThaiLastname" class="form-control"  required/>
                        </div>
                        <div class="form-group col-md-2">
                            <label class="control-label">ชื่อเล่น</label>
                            <input type="text" name="inStdNickName" id="inStdNickName" class="form-control" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-3">
                            <label class="control-label">ชื่อ (ภาษาอังกฤษ)</label>
                            <input type="text" name="inStdEngName" id="inStdEngName" class="form-control" />
                        </div>
                        <div class="form-group col-md-3">
                            <label class="control-label">นามสกุล (ภาษาอังกฤษ)</label>
                            <input type="text" name="inStdEngLastname" id="inStdEngLastname" class="form-control" />
                        </div>
                        <div class="col-md-3 form-group">
                            <label class="control-label">เลขที่บัตรประชาชน</label>
                            <input type="text" name="inStdIdCard" id="inStdIdCard" class="form-control" placeholder="13 หลัก" required/>
                        </div>
                        <div class="col-md-3 form-group">
                            <label class="control-label">สัญชาติ</label>
                            <input type="text" name="inStdNationality" id="inStdNationality" class="form-control"  required/>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-2 form-group">
                            <label class="control-label">เชื้อชาติ</label>
                            <input type="text" name="inStdOrigin" id="inStdOrigin" class="form-control"  required/>
                        </div>
                        <div class="col-md-2 form-group">
                            <label class="control-label">ศาสนา</label>
                            <input type="text" name="inStdReligion" id="inStdReligion" class="form-control"  required/>
                        </div>
                        <div class="col-md-4 form-group">
                            <label class="control-label">วัน/เดือน/ปี เกิด</label>
                            <div class="form-group">
                                <select name="inStdDayBirthday" id="inStdDayBirthday" class="my-select" required>
                                    <option value="">-วันที่-</option>
                                    <?php for ($i = 1; $i <= 31; $i++): ?>
                                        <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                    <?php endfor; ?>
                                </select>
                                <?php $arr = array('1' => "มกราคม", "2" => "กุมภาพันธ์", "3" => "มีนาคม", "4" => "เมษายน", "5" => "พฤษภาคม", "6" => "มิถุนายน", "7" => "กรกฎาคม", "8" => "สิงหาคม", "9" => "กันยายน", "10" => "ตุลาคม", "11" => "พฤศจิกายน", "12" => "ธันวาคม"); ?>
                                <select name="inStdMonthBirthday" id="inStdMonthBirthday" class="my-select" required>
                                    <option value="">-เดือน-</option>
                                    <?php foreach ($arr as $key => $value): ?>
                                        <option value="<?php echo $key; ?>"><?php echo $value; ?></option>
                                    <?php endforeach; ?>

                                </select>
                                <select name="inStdYearBirthday" id="inStdYearBirthday" class="my-select" required>
                                    <option value="">-พ.ศ.-</option>
                                    <?php for ($i = 2450; $i <= (date("Y") + 543); $i++): ?>
                                        <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                    <?php endfor; ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4 form-group">
                            <label class="control-label">ภาพนักเรียน</label>
                            <input type="file" name="inStdPicture" id="inStdPicture" class="filestyle" />
                        </div>
                    </div>
                    <div class="row">
                        <center><button type="submit" class="btn btn-success">บันทึก</button></center>
                    </div>
                    <input type="hidden" name="id" id="id" />
                </form>
            </div>
            <div class="modal-footer" style="background-color:#CEE3F6;">
                <button type="button" class="btn btn-danger btn-lg" data-dismiss="modal"><i class="icon-power-off"></i></button>
            </div>
        </div>
    </div>
</div>
<script>
    $(".datepicker").datepicker({autoclose: true, language: 'th'});
    $("#insert-form").on("submit", function (e) {
        e.preventDefault();
        var file = $("#inStdPicture").val();
        var ext = $("#inStdPicture").val().split('.').pop().toLowerCase();
        if (file != "") {
            if (jQuery.inArray(ext, ['jpg']) == -1) {
                alert("ชนิดของไฟล์ภาพจะต้องเป็น jpg เท่านั้น");
                return false();
            }
        }
        //
        $.ajax({
            url: "<?php echo site_url('insert-student-data'); ?>",
            method: "post",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            success: function (data) {
                $("#insert-form")[0].reset();
                alert("บันทึกเรียบร้อย");
                location.reload();
            }
        });
    });
</script>