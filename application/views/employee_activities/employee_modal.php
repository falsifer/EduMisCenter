<!-- Modal -->
<div id="employee-modal" class="modal fade" role="dialog">
    <div class="modal-dialog" style="width:60%;">
        <div class="modal-content">
            <div class="modal-header" style="background:#0080FF;color:#FFFFFF;">
                <button type="button" class="close" data-dismiss="modal">X</button>
                <h3 class="modal-title" id="title"></h2>
            </div>
            <div class="modal-body">
                <form method="post" id="insert-form">
                    <div class="row">
                        <div class="col-md-3 form-group">
                            <label class="control-label">วันที่บันทึก</label>
                            <input type="text" name="inHrDateRecord" id="inHrDateRecord" class="form-control datepicker" data-date-format="yyyy-mm-dd" placeholder="คลิกวันที่..." required />
                        </div>
                        <div class="col-md-5 form-group">
                            <label class="control-label">ชื่อ-นามสกุล</label>
                            <select name="inHrId" id="inHrId" class="form-control">
                                <option value="">---เลือกข้อมูล---</option>
                                <?php foreach ($hr as $h): ?>
                                    <option value="<?php echo $h['id']; ?>"><?php echo $h['hr_thai_symbol']; ?><?php echo $h['hr_thai_name']; ?> <?php echo $h['hr_thai_lastname']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-4 form-group">
                            <label class="control-label">การปฏิบัติงาน</label>
                            <div class="form-group">
                                <select name="inHrActivities" id="inHrActivities" class="form-control">
                                    <option value="">---เลือกข้อมูล---</option>
                                    <option value="มาทำงาน">มาทำงาน</option>
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
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3 form-group">
                            <label class="control-label">จากวันที่</label>
                            <input type="text" name="inActivitiesBeginDate" id="inActivitiesBeginDate" class="form-control datepicker" data-date-format="yyyy-mm-dd" placeholder="คลิกวันที่..." required/>
                        </div>
                        <div class="col-md-3 form-group">
                            <label class="control-label">ถึงวันที่</label>
                            <input type="text" name="inActivitiesEndDate" id="inActivitiesEndDate" class="form-control datepicker" data-date-format="yyyy-mm-dd" placeholder="คลิกวันที่..." required/>
                        </div>
                        <div class="form-group col-md-6">
                            <label class="control-label">หมายเหตุ</label>
                            <input type="text" name="inActivitiesComment" id="inActivitiesComment" class="form-control" />
                        </div>
                    </div>
                    <div class="row">
                        <center><button type="submit" class="btn btn-success icon-insert"><i class="icon-save icon-large"></i> บันทึก</button></center>
                    </div>
                    <input type="hidden" name="id" id="id" />
                </form>
            </div>
            <div class="modal-footer" style="background-color:#CEE3F6;">
                <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="icon-power-off"></i></button>
            </div>
        </div>
    </div>
</div>
<script>
    $(".datepicker").datepicker({autoclose: true, language: 'th'});
    $("#insert-form").on("submit", function (e) {
        e.preventDefault();
        $.ajax({
            url: "<?php echo site_url('insert-employee-activities'); ?>",
            method: 'post',
            data: $("#insert-form").serialize(),
            success: function (data) {
                $("#insert-form")[0].reset();
                location.reload();
            }
        });
    });
</script>