<div id="personal-activities-modal" class="modal fade" role="dialog">
    <div class="modal-dialog" style="width:60%;">
        <div class="modal-content">
            <div class="modal-header" style="background:#0080FF;color:#FFFFFF;">
                <button type="button" class="close" data-dismiss="modal">X</button>
                <h3 class="modal-title" id="title"></h3>
            </div>
            <div class="modal-body">
                <form method="post" id="personal-activities" enctype="multipart/form-data">
                    <div class="row">
                        <div class="form-group col-md-4">
                            <label class="control-label">กิจกรรม</label>
                            <input type="text" name="inActivitiesName" id="inActivitiesName" class="form-control" autofocus required/>
                        </div>
                        <div class="form-group col-md-2">
                            <label class="control-label">Category</label>
                            <select name="inActivitiesGroup" id="inActivitiesGroup" class="form-control" required>
                                <option value="">--ประเภท--</option>
                                <option value="เร่งด่วน">เร่งด่วน</option>
                                <option value="ปกติ">ปกติ</option>
                                <option value="โครงการ">โครงการ</option>
                                <option value="ประชุม">อบรม/ประชุม/สัมนา</option>
                            </select>
                        </div>
                        <div class="form-group col-md-3">
                            <label class="control-label">เริ่มต้น</label>
                            <div class="input-group">
                                <input type="text" name="inActivitiesBegin" id="inActivitiesBegin" class="form-control datepicker" placeholder="คลิกวันที่..." data-date-format="yyyy-mm-dd" required/>
                                <span class="input-group-addon"><i class="icon-calendar"></i></span>
                            </div>
                        </div>
                        <div class="form-group col-md-3">
                            <label class="control-label">สิ้นสุด</label>
                            <div class="input-group">
                                <input type="text" name="inActivitiesEnd" id="inActivitiesEnd" class="form-control datepicker" placeholder="คลิกวันที่..." data-date-format="yyyy-mm-dd" required/>
                                <span class="input-group-addon"><i class="icon-calendar"></i></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-4">
                            <label class="control-label">สถานที่</label>
                            <input type="text" name="inActivitiesPlace" id="inActivitiesPlace" class="form-control" />
                        </div>
                        <div class="form-group col-md-4">
                            <label class="control-label">เอกสารประกอบ</label>
                            <input type="file" name="inActivitiesDocument" id="inActivitiesDocument" class="filestyle" />
                        </div>
                        <div class="form-group col-md-4">
                            <label class="control-label">หมายเหตุ</label>
                            <input type="text" name="inActivitiesComment" id="inActivitiesComment" class="form-control" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 form-group">
                            <center><button type="submit" class="btn btn-success"><i class="icon-save"></i> บันทึก</button></center>
                        </div>
                    </div>
                    <input type="hidden" id="taskid" name="taskid" />
                </form>
            </div>
            <div class="modal-footer" style="background-color:#CEE3F6;">
                <!--<button type="button" class="btn btn-danger btn-sm" data-dismiss="modal"><i class="icon-power-off"></i></button>-->
            </div>
        </div>
    </div>
</div>
<script>
    $(".datepicker").datepicker({autoclose: true, language: 'th'});
    $('#personal-activities').on('submit', function (e) {
        e.preventDefault();
        var file = $('#inActivitiesDocument').val();
        var ext = $('#inActivitiesDocument').val().split('.').pop().toLowerCase();
        //
        if (file != '' && jQuery.inArray(ext, ['pdf', 'doc', 'docx', 'xls', 'xlsx', 'jpg', 'png']) == -1) {
            alert('เอกสารจะต้องเป็นชนิด pdf, เวิร์ด, เอ็กเซลล์, หรือชนิดภาพ jpg, png เท่านั้น');
            return false;
        }
        $.ajax({
            url: '<?php echo site_url('insert-task-list'); ?>',
            method: 'post',
            data: new FormData(this),
            cache: false,
            contentType: false,
            processData: false,
            success: function (data) {
                $('#personal-activities')[0].reset();
                location.reload();
            }
        });
    });
</script>