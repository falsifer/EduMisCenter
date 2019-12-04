<!-- Modal -->
<div id="hr-plan-detail-modal" class="modal fade" role="dialog">
    <div class="modal-dialog" style="width:50%;">
        <div class="modal-content">
            <div class="modal-header" style="background:#0080FF;color:#FFFFFF;">
                <button type="button" class="close" data-dismiss="modal">X</button>
                <h3 class="modal-title" id="title"></h3>
            </div>
            <div class="modal-body">
                <form method="post" id="planing-detail-insert">
                    <div class="row">
                        <div class="form-group col-md-3">
                            <label class="control-label">ปีงบประมาณ</label>
                            <select name="inPlaningYear" id="inPlaningYear" class="form-control">
                                <option value="">---ข้อมูล---</option>
                                <?php foreach ($planing_year as $year): ?>
                                    <option value="<?php echo $year['planing_year']; ?>"><?php echo $year['planing_year']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group col-md-5">
                            <label class="control-label">ส่วนราชการ</label>
                            <select name="inPlaningOffice" id="inPlaningOffice" class="form-control">
                                <option value="">---ข้อมูล---</option>
                                <?php foreach ($school as $sc): ?>
                                    <option value="<?php echo $sc['sc_thai_name']; ?>"><?php echo $sc['sc_thai_name']; ?></option>
                                <?php endforeach; ?>
                                <option value="ส่วน/กอง การศึกษา">ส่วน/กอง การศึกษา</option>
                            </select>
                        </div>
                        <div class="form-group col-md-4">
                            <label class="control-label">ตำแหน่ง</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <label class="control-label">หมายเหตุ</label>
                            <input type="text" name="inPlaningComment" id="inPlaningComment" class="form-control" />
                        </div>
                    </div>
                    <div class="row" style="margin-top:10px;">
                        <div class="col-md-12">
                            <center><button type="submit" class="btn btn-success"><i class="icon-save"></i> บันทึก</button></center>
                        </div>
                    </div>
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
    $('#planing-detail-insert').on('submit', function (e) {
        e.preventDefault();
        $.ajax({
            url: '<?php echo site_url('insert-human-planing-detail'); ?>',
            method: 'post',
            data: $('#planing-detail-insert').serialize(),
            success: function (data) {
                $('#planing-detail-insert')[0].reset();
                location.reload();
            }
        });
    });
</script>