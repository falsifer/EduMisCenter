<!-- Modal -->
<div id="km-category-modal" class="modal fade" role="dialog">
    <div class="modal-dialog" style="width:50%;">
        <div class="modal-content">
            <div class="modal-header" style="background:#0080FF;color:#FFFFFF;">
                <button type="button" class="close" data-dismiss="modal">X</button>
                <h3 class="modal-title" id="title"></h3>
            </div>
            <div class="modal-body">
                <form method="post" id="km-category-form">
                    <div class="row">
                        <div class="form-group col-md-4">
                            <label class="control-label">ชนิดแหล่งเรียนรู้</label>
                            <select name="inKmTypeId" id="inKmTypeId" class="form-control" required>
                                <option value="">---เลือกข้อมูล---</option>
                                <?php foreach ($km_type as $type): ?>
                                    <option value="<?php echo $type['id']; ?>"><?php echo $type['km_type']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label class="control-label">ประเภทแหล่งเรียนรู้</label>
                            <input type="text" name="inKmCategoryName" id="inKmCategoryName" class="form-control" required placeholder="เช่น แหล่งเรียนรู้ตามธรรมชาติ"/>
                        </div>
                        <div class="form-group col-md-1">
                            <br/>
                            <button type="submit" class="btn btn-default"><i class="icon-save"></i> บันทึก</button>
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
    $("#km-category-form").on("submit", function (e) {
        e.preventDefault();
        $.ajax({
            url: '<?php echo site_url('insert-km-category'); ?>',
            method: 'post',
            data: $('#km-category-form').serialize(),
            success: function () {
                alert('บันทึกข้อมูลเรียบร้อย...');
                $('#km-category-form')[0].reset();
                location.reload();
            }
        });
    });
</script>