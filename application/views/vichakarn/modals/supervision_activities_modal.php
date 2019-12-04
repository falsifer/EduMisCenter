<div id="supervision-activities-modal" class="modal fade" role="dialog">
    <div class="modal-dialog" style="width:65%;">
        <div class="modal-content">
            <div class="modal-header" style="background:#0080FF;color:#FFFFFF;">
                <button type="button" class="close" data-dismiss="modal">X</button>
                <h3 class="modal-title" id="title"></h3>
            </div>
            <div class="modal-body">
                <form method="post" id="insert-form" style="padding-top:20px;padding-bottom:10px;">
                    <div class="row">
                        <div class="form-group col-md-5">
                            <label class="control-label">รายการกิจกรรมหลัก</label>
                            <select name="inTaskId" id="inTaskId" class="form-control" required>
                                <option value="">---เลือกข้อมูล---</option>
                                <?php foreach ($task as $t): ?>
                                    <option value="<?php echo $t['id']; ?>"><?php echo $t['supervision_task']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group col-md-7">
                            <label class="control-label">รายการกิจกรรมย่อย</label>
                            <input type="text" name="inSupervisionActivities" id="inSupervisionActivities" class="form-control" required/>
                        </div>
                    </div>
                    <div class="row"><center><button type="submit" class="btn btn-success"><i class="icon-save icon-large"></i> บันทึก</button></center></div>
                    <input type="hidden" id="id" name="id" />
                </form>
            </div>
            <div class="modal-footer" style="background-color:#CEE3F6;">
                <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal"><i class="icon-power-off"></i></button>
            </div>
        </div>
    </div>
</div>
<script>
    $(".datepicker").datepicker({autoclose: true, language: 'th'});
    $('#insert-form').on('submit', function (e) {
        e.preventDefault();
        $.ajax({
            url: '<?php echo site_url('insert-define-education-supervision-activities'); ?>',
            method: 'post',
            data: $('#insert-form').serialize(),
            success: function (data) {
                $('#insert-form')[0].reset();
                location.reload();
            }
        });
    });
</script>