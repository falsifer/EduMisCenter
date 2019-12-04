<!-- Modal -->
<div id="supervision-plan-modal" class="modal fade" role="dialog">
    <div class="modal-dialog" style="width:70%;">
        <div class="modal-content">
            <div class="modal-header" style="background:#0080FF;color:#FFFFFF;">
                <button type="button" class="close" data-dismiss="modal">X</button>
                <h3 class="modal-title" id="title"></h3>
            </div>
            <div class="modal-body">
                <form method="post" id="insert-form">
                    <div class="row">
                        <div class="form-group col-md-4">
                            <label class="control-label">ชื่อผู้นิเทศ</label>
                            <select name="inSupervisionName" id="inSupervisionName" class="form-control" required="">
                                <option value="">---เลือกข้อมูล---</option>
                                <?php foreach ($supervision as $s): ?>
                                    <option value="<?php echo $s['hr_thai_symbol']; ?><?php echo $s['hr_thai_name']; ?><?php echo nbs(3); ?><?php echo $s['hr_thai_lastname']; ?>"><?php echo $s['hr_thai_symbol']; ?><?php echo $s['hr_thai_name']; ?><?php echo nbs(3); ?><?php echo $s['hr_thai_lastname']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group col-md-8">
                            <label class="control-label">กลุ่มเป้าหมาย</label>
                            <input type="text" name="inSupervisionDestination" id="inSupervisionDestination" class="form-control"  required=""/>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label class="control-label">วัตถุประสงค์ 1</label>
                            <input type="text" name="inSupervisionPurpose1" id="inSupervisionPurpose1" class="form-control"  required=""/>
                        </div>
                        <div class="form-group col-md-6">
                            <label class="control-label">วัตถุประสงค์ 2</label>
                            <input type="text" name="inSupervisionPurpose2" id="inSupervisionPurpose2" class="form-control"  required=""/>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label class="control-label">วัตถุประสงค์ 3</label>
                            <input type="text" name="inSupervisionPurpose3" id="inSupervisionPurpose3" class="form-control" />
                        </div>
                        <div class="form-group col-md-6">
                            <label class="control-label">วัตถุประสงค์ 4</label>
                            <input type="text" name="inSupervisionPurpose4" id="inSupervisionPurpose4" class="form-control" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label class="control-label">วัตถุประสงค์ 5</label>
                            <input type="text" name="inSupervisionPurpose5" id="inSupervisionPurpose5" class="form-control" />
                        </div>
                        <div class="form-group col-md-6">
                            <label class="control-label">วัตถุประสงค์ 6</label>
                            <input type="text" name="inSupervisionPurpose6" id="inSupervisionPurpose6" class="form-control" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label class="control-label">วัตถุประสงค์ 7</label>
                            <input type="text" name="inSupervisionPurpose7" id="inSupervisionPurpose7" class="form-control" />
                        </div>
                        <div class="form-group col-md-6">
                            <label class="control-label">วัตถุประสงค์ 8</label>
                            <input type="text" name="inSupervisionPurpose8" id="inSupervisionPurpose8" class="form-control" />
                        </div>
                    </div>
                    <div class="row"><center><button type="submit" class="btn btn-default"><i class="icon-save"></i> บันทึก</button></center></div>
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
    $('#insert-form').on('submit', function (event) {
        event.preventDefault();
        $.ajax({
            url: "<?php echo site_url('insert-supervision-plan'); ?>",
            method: "POST",
            data: $("#insert-form").serialize(),
            success: function (data) {
                $('#insert-form')[0].reset();
                location.reload();
            }
        });
    });
</script>