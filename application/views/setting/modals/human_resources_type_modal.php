<!-- Modal -->
<div id="human-resources-type-modal" class="modal fade" role="dialog">
    <div class="modal-dialog" style="width:60%;">
        <div class="modal-content">
            <div class="modal-header" style="background:#0080FF;color:#FFFFFF;">
                <button type="button" class="close" data-dismiss="modal">X</button>
                <h3 class="modal-title" id="title"></h3>
            </div>
            <div class="modal-body">
                <form id="insert-form" method="post" class="form-horizontal">
                    <div class="row" style="padding-top:30px;">
                        <div class="form-group col-md-10">
                            <label class="control-label col-md-4">ประเภทบุคลากร</label>
                            <div class="col-md-7">
                                <input type="text" name="inHrType" id="inHrType" class="form-control" required autofocus placeholder="เช่น ครูผู้สอน"/>
                            </div>
                            <div class="col-md-1">
                                <button type="submit" class="btn btn-success"><i class="icon-save"></i> บันทึก</button>
                            </div>
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
            url: '<?php echo site_url('insert-human-resources-type'); ?>',
            method: 'post',
            data: $('#insert-form').serialize(),
            success: function (data) {
                $('#insert-form')[0].reset();
                location.reload();
            }
        });
    });
</script>