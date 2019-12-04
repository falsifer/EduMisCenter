<!-- Modal -->
<div id="supervision-destination-modal" class="modal fade" role="dialog">
    <div class="modal-dialog" style="width:60%;">
        <div class="modal-content">
            <div class="modal-header" style="background:#060150;color:#FFFFFF;">
                <button type="button" class="close" data-dismiss="modal">X</button>
                <h3 class="modal-title" id="title"></h3>
            </div>
            <div class="modal-body">
                <form method="post" id="insert-form">
                    <div class="row">
                        <div class="form-group col-md-4">
                            <label class="control-label">การนำนวัตกรรมไปใช้ในขั้นตอนที่</label>
                            <input type="text" name="inSolutionInStep" id="inSolutionInStep" class="form-control" />
                        </div>
                        <div class="form-group col-md-5">
                            <label class="control-label">สาระที่นิเทศ</label>
                            <input type="text" name="inSupervisionIssue" id="inSupervisionIssue" class="form-control" />
                        </div>
                        <div class="form-group col-md-3">
                            <label class="control-label">ผู้รับการนิเทศ</label>
                            <select name="inSupervisionTo" id="inSupervisionTo" class="form-control" required>
                                <option value="">---เลือกข้อมูล---</option>
                                <?php foreach ($teacher as $t): ?>
                                    <option value="<?php echo $t['hr_thai_symbol'] ?><?php echo $t['hr_thai_name']; ?><?php echo nbs(2); ?><?php echo $t['hr_thai_lastname']; ?>"><?php echo $t['hr_thai_symbol'] ?><?php echo $t['hr_thai_name']; ?><?php echo nbs(2); ?><?php echo $t['hr_thai_lastname']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-3">
                            <label class="control-label">วัน เดือน ปี ที่นิเทศ</label>
                            <input type="text" name="inSupervisionDate" id="inSupervisionDate" class="form-control datepicker" data-date-format="yyyy-mm-dd" placeholder="คลิกวันที่..."  required/>
                        </div>
                        <div class="form-group col-md-9">
                            <label class="control-label">หมายเหตุ</label>
                            <input type="text" name="inSupervisionComment" id="inSupervisionComment" class="form-control" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12"><center><button type="submit" class="btn btn-success"><i class="icon-save"></i> บันทึก</button></center></div>
                    </div>
                    <input type="hidden" name="schedule_detail_id" id="plan_id" value="<?php echo $this->uri->segment(2); ?>" />
                    <input type="hidden" name="id" id="id" />
                </form>
            </div>
            <div class="modal-footer" style="background-color:#CEE3F6;">
                <button type="button" class="btn btn-default btn-sm" data-dismiss="modal"><i class="icon-power-off"></i></button>
            </div>
        </div>
    </div>
</div>
<script>
    $(".datepicker").datepicker({autoclose: true, language: 'th'});
    $('#insert-form').on('submit', function (e) {
        e.preventDefault();
        $.ajax({
            url: '<?php echo site_url('insert-supervision-destination-note'); ?>',
            method: 'post',
            data: $('#insert-form').serialize(),
            success: function (data) {
                alert('บันทึกข้อมูลเรียบร้อย');
                $('#insert-form')[0].reset();
                location.reload();
            }
        });
    });
</script>