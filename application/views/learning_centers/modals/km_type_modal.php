<!-- Modal -->
<div id="km-type-modal" class="modal fade" role="dialog">
    <div class="modal-dialog" style="width:50%;">
        <div class="modal-content">
            <div class="modal-header" style="background:#0080FF;color:#FFFFFF;">
                <button type="button" class="close" data-dismiss="modal">X</button>
                <h3 class="modal-title" id="title"></h3>
            </div>
            <div class="modal-body">
                <form method="post" id="insert-form" class="form-horizontal">
                    <div class="row">
                        <div class="col-md-8">
                            <label class="control-label col-md-3">ชนิดแหล่งเรียนรู้</label>
                            <div class="col-md-8">
                                <input type="text" name="inKmType" id="inKmType" class="form-control" required/>
                            </div>
                            <div class="col-md-1">
                                <button type="submit" class="btn btn-default"><i class="icon-save"></i> บันทึก</button>
                            </div>
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
    $("#insert-form").on("submit", function (e) {
        e.preventDefault();
        $.ajax({
            url: '<?php echo site_url('insert-km-type'); ?>',
            method: 'post',
            data: $('#insert-form').serialize(),
            success: function () {
                alert('บันทึกข้อมูลเรียบร้อย...');
                $('#insert-form')[0].reset();
                location.reload();
            }
        });
    });
</script>