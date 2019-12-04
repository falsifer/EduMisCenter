<!-- Modal -->
<div id="ev-activities-modal" class="modal fade" role="dialog">
    <div class="modal-dialog" style="width:70%;">
        <div class="modal-content">
            <div class="modal-header" style="background:#0080FF;color:#FFFFFF;">
                <button type="button" class="close" data-dismiss="modal">X</button>
                <h3 class="modal-title" id="title"></h3>
            </div>
            <div class="modal-body">

                <form id="insert-form" method="post">
                    <div class="row">
                        <div class="form-group col-md-4">
                            <label class="control-label">กลุ่มงานหลัก</label>
                            <select name="inEvCategoryId" id="inEvCategoryId" class="form-control" required>
                                <option value="">---เลือกข้อมูล---</option>
                                <?php foreach ($category as $cat): ?>
                                    <option value="<?php echo $cat['id']; ?>"><?php echo $cat['evaluation_category']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-5 form-group">
                            <label class="control-label">รายการงานย่อย</label>
                            <input type="text" name="inEvActivities" id="inEvActivities" class="form-control" />
                        </div>
                        <div class="col-md-1">
                            <label class="control-label">&nbsp;</label>
                            <button type="submit" class="btn btn-success"><i class="icon-save icon-large"></i> บันทึก</button>
                        </div>
                    </div>
                    <input type="hidden" name="id" id="id" />
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
            url: '<?php echo site_url('insert-education-evaluation-activities'); ?>',
            method: 'post',
            data: $('#insert-form').serialize(),
            success: function (data) {
                $('#insert-form')[0].reset();
                location.reload();
            }
        });
    });
</script>