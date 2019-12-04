<!-- Modal -->
<div id="picture-group-modal" class="modal fade" role="dialog">
    <div class="modal-dialog" style="width:50%;">
        <div class="modal-content">
            <div class="modal-header" style="background:#0080FF;color:#FFFFFF;">
                <button type="button" class="close" data-dismiss="modal">X</button>
                <h3 class="modal-title" id="title"></h3>
            </div>
            <div class="modal-body">
                <form method="post" id="picture-group-form" class="form-horizontal">
                    <div class="row">
                        <div class="col-md-12 form-group" style="padding-top:30px;">
                            <label class="control-label col-md-2">ชื่อกลุ่มภาพ</label>
                            <div class="col-md-8">
                                <input type="text" name="inPictureGroup" id="inPictureGroup" class="form-control" autofocus required />
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
    $('#picture-group-form').on('submit', function (e) {
        e.preventDefault;
        $.ajax({
            url: '<?php echo site_url('insert-picture-group'); ?>',
            method: 'post',
            data: $('#picture-group-form').serialize(),
            success: function (data) {
                $('#picture-group-form')[0].reset();
                location.reload();
            }
        });
    });
</script>