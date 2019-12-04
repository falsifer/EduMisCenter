<div id="strategy-define-modal" class="modal fade" role="dialog">
    <div class="modal-dialog" style="width:60%;">
        <div class="modal-content">
            <div class="modal-header" style="background:#0080FF;color:#FFFFFF;">
                <button type="button" class="close" data-dismiss="modal">X</button>
                <h3 class="modal-title" id="title"></h3>
            </div>
            <div class="modal-body">
                <form method="post" id="strategy-define-form">
                    <div class="row">
                        <div class="form-group col-md-4">
                            <label class="control-label">ยุทธศาสตร์</label>
                            <select name="inStrategicDefineId" id="inStrategicDefineId" class="form-control" required>
                                <option value="">---เลือกข้อมูล---</option>
                                <?php foreach ($strategic as $st): ?>
                                    <option value="<?php echo $st['id'] ?>"><?php echo $st['strategic_define'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group col-md-8">
                            <label class="control-label">กลยุทธ์</label>
                            <input type="text" name="inStrategyDefine" id="inStrategyDefine" class="form-control" required/>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-12">
                            <center><button type="submit" class="btn btn-default btn-insert"><i class="icon-save"></i> บันทึก</button></center>
                        </div>
                    </div>
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
    $(".datepicker").datepicker({autoclose: true, language: 'th', format: 'yyyy-mm-dd'});
    $('#strategy-define-form').on('submit', function (e) {
        e.preventDefault();
        $.ajax({
            url: '<?php echo site_url('insert-strategy-define'); ?>',
            method: 'post',
            data: $('#strategy-define-form').serialize(),
            success: function (data) {
                alert('บันทึกข้อมูลเรียบร้อย');
                $('#strategy-define-form')[0].reset();
                location.reload();
            }
        });
    });
</script>