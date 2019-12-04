<!-- Modal -->
<div id="supervision-plan-detail-modal" class="modal fade" role="dialog">
    <div class="modal-dialog" style="width:70%;">
        <div class="modal-content">
            <div class="modal-header" style="background:#060150;color:#FFFFFF;">
                <button type="button" class="close" data-dismiss="modal">X</button>
                <h3 class="modal-title" id="title"></h3>
            </div>
            <div class="modal-body">
                <form method="post" id="insert-form">
                    <div class="row">
                        <div class="form-group col-md-4">
                            <label class="control-label">ชื่อ-สกุล ผู้รับการนิเทศ</label>
                            <select name="inHrId" id="inHrId" class="form-control" required="">
                                <option value="">---เลือกข้อมูล---</option>
                                <?php foreach ($teacher as $t): ?>
                                    <option value="<?php echo $t['id']; ?>"><?php echo $t['hr_thai_symbol'] ?><?php echo $t['hr_thai_name']; ?><?php echo nbs(3); ?><?php echo $t['hr_thai_lastname']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group col-md-4">
                            <label class="control-label">วิชา</label>
                            <select name="inSubjectId" id="inSubjectId" class="form-control" required>
                                <option value="">---เลือกข้อมูล---</option>
                                <?php foreach ($subject as $s): ?>
                                    <option value="<?php echo $s['id']; ?>">รหัสวิชา <?php echo $s['subject_code'] ?> ชื่อวิชา <?php echo $s['subject_name']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group col-md-4">
                            <label class="control-label">วัน เดือน ปี</label>
                            <input type="text" name="inPlanDetailDate" id="inPlanDetailDate" class="form-control datepicker" placeholder="คลิกวันที่..." data-date-format="yyyy-mm-dd" required />
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label class="control-label">กิจกรรม/เทคนิค/วิธีการนิเทศ</label>
                            <input type="text" name="inPlanDetailActivities" id="inPlanDetailActivities" class="form-control" required/>
                        </div>
                        <div class="form-group col-md-6">
                            <label class="control-label">สื่อ/เครื่องมือนิเทศ</label>
                            <input type="text" name="inPlanDetailMedia" id="inPlanDetailMedia" class="form-control" required/>
                        </div>
                    </div>
                    <div class="row"><center><button type="submit" class="btn btn-success"><i class="icon-save"></i> บันทึก</button></center></div>
                    <input type="hidden" name="id" id="id" />
                    <input type="hidden" name="plan_id" id="plan_id" value="<?php echo $this->uri->segment(2); ?>" />
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
            url: '<?php echo site_url('insert-supervision-plan-detail'); ?>',
            method: 'post',
            data: $('#insert-form').serialize(),
            success: function (data) {
                alert('บันทึกข้อมูลเรียบร้อย...')
                $('#insert-form')[0].reset();
                location.reload();
            }
        });
    });
</script>