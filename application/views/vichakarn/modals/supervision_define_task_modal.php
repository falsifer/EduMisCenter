<div id="supervision-define-task-modal" class="modal fade" role="dialog">
    <div class="modal-dialog" style="width:60%;">
        <div class="modal-content">
            <div class="modal-header" style="background:#0080FF;color:#FFFFFF;">
                <button type="button" class="close" data-dismiss="modal">X</button>
                <h3 class="modal-title" id="title"></h3>
            </div>
            <div class="modal-body">
                <form method="post" id="insert-form">
                    <div class="row">
                        <div class="form-group col-md-7 col-md-offset-1">
                            <label class="control-label">กิจกรรมลำดับที่ 1</label>
                            <input type="text" name="inSupervisionTask" id="inSupervisionTask" class="form-control" required autofocus/>
                        </div>
                        <div class="col-md-2">
                            <br/>
                            <button type="submit" class="btn btn-success"><i class="icon-save icon-large"></i> บันทึก</button>
                        </div>

                    </div>
                    <input type="hidden" id="id" name="id" />
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
            url: '<?php echo site_url('insert-define-education-supervision-task'); ?>',
            method: 'post',
            data: $('#insert-form').serialize(),
            success: function (data) {
                
                $('#insert-form')[0].reset();
                location.reload();
            }
        });
    });
</script>