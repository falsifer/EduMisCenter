<!-- Modal -->
<div id="insert-hr-plan-detail" class="modal fade" role="dialog">
    <div class="modal-dialog" style="width:65%;">
        <div class="modal-content">
            <div class="modal-header" style="background:#0080FF;color:#FFFFFF;">
                <button type="button" class="close" data-dismiss="modal">X</button>
                <h3 class="modal-title" id="title"></h3>
            </div>
            <div class="modal-body">
                <form method="post" id="plan-detail-insert">
                    <div class="row">
                        <div class="form-group col-md-3">
                            <label class="control-label">เลือกปี</label>
                            <select name="inPlanYear" id="inPlanYear" class="form-control">
                                <option value="">--ข้อมูล--</option>
                                <?php for ($i = $plan['begin_year']; $i <= $plan['end_year']; $i++): ?>
                                    <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                <?php endfor; ?>
                            </select>
                        </div>
                        <div class="form-group col-md-3">
                            <label class="control-label">ตำแหน่ง</label>
                            <select name="inRankId" id="inRankId" class="form-control">
                                <option value="">--ข้อมูล--</option>
                                <?php foreach ($rank as $r): ?>
                                    <option value="<?php echo $r['id']; ?>"><?php echo $r['rank_name']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group col-md-3">
                            <label class="control-label">ระดับ</label>
                            <input type="text" name="inLevel" id="inLevel" class="form-control" />
                        </div>
                        <div class="form-group col-md-3">
                            <label class="control-label">อัตรากำลังเดิม</label>
                            <input type="text" name="inOldHr" id="inOldHr" class="form-control" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-2">
                            <label class="control-label">เพิ่ม (อัตรา)</label>
                            <input type="text" name="inIncrease" id="inIncrease" class="form-control"/>
                        </div>
                        <div class="form-group col-md-2">
                            <label class="control-label">ลด (อัตรา)</label>
                            <input type="text" name="inDecrease" id="inDecrease" class="form-control"/>
                        </div>

                        <div class="form-group col-md-8">
                            <label class="control-label">หมายเหตุ</label>
                            <input type="text" name="inComment" id="inComment" class="form-control" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <center><button type="submit" class="btn btn-success"><i class="icon-save"></i> บันทึก</button></center>
                        </div>
                    </div>
                    <input type="hidden" name="hr_plan_id" id="hr_plan_id" value="<?php echo $this->uri->segment(2); ?>" />
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
    $('#plan-detail-insert').on('submit', function (e) {
        e.preventDefault();
        $.ajax({
            url: '<?php echo site_url('insert-human-plan-detail'); ?>',
            method: 'post',
            data: $('#plan-detail-insert').serialize(),
            success: function (data) {
                $('#plan-detail-insert')[0].reset();
                location.reload();
            }
        });
    });
</script>