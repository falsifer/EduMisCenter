<!-- Modal -->
<div id="assessment-group-modal" class="modal fade" role="dialog">
    <div class="modal-dialog" style="width:50%;">
        <div class="modal-content">
            <div class="modal-header" style="background:#0080FF;color:#FFFFFF;">
                <button type="button" class="close" data-dismiss="modal">X</button>
                <h3 class="modal-title" id="title"></h3>
            </div>
            <div class="modal-body">
                <form method="post" id="insert-form">
                    <div class="row">
                        <div class="form-group col-md-10">
                            <label class="control-label">รายการประเมิน</label>
                            <input type="text" name="inHumanAssessmentGroup" id="inHumanAssessmentGroup" class="form-control" required autofocus />
                        </div>
                        <div class="form-group col-md-1">
                            <label class="control-label">&nbsp;</label>
                            <button type="submit" class="btn btn-primary"><i class="icon-save"></i> บันทึก</button>
                        </div>
                    </div>
                    <input type="hidden" name="id" id="id" />
                </form>
            </div>
            <div class="modal-footer" style="background-color:#CEE3F6;">
                <button type="button" class="btn btn-primary btn-sm" data-dismiss="modal"><i class="icon-power-off"></i></button>
            </div>
        </div>
    </div>
</div>
<script>
    $(".datepicker").datepicker({autoclose: true, language: 'th'});
    $('#insert-form').on('submit', function (e) {
        e.preventDefault();
        $.ajax({
            url: '<?php echo site_url('insert-assessment-definetion-group'); ?>',
            method: 'post',
            data: $("#insert-form").serialize(),
            success: function (data) {
                $('#insert-form')[0].reset();
                location.reload();
            }
        });
    });
</script>