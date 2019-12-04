<!-- Modal -->
<div id="ds-level1-modal" class="modal fade" role="dialog">
    <div class="modal-dialog" style="width:50%;">
        <div class="modal-content">
            <div class="modal-header" style="background:#0080FF;color:#FFFFFF;">
                <button type="button" class="close" data-dismiss="modal">X</button>
                <h3 class="modal-title" id="title"></h3>
            </div>
            <div class="modal-body">
                <form method="post" id="ds-level1-form" style="padding-top:20px;">
                    <div class="row">
                        <div class=" col-md-10 col-md-offset-1">
                            <div class="form-group col-md-7">
                                <label class="control-label">ระดับคะแนน</label>
                                <?php echo nbs(2); ?>
                                <input type="radio" name="inQuestionScore" id="S1" class="magic-radio" value="5" required/><label for="S1">5</label><?php echo nbs(3); ?>
                                <input type="radio" name="inQuestionScore" id="S2" class="magic-radio" value="4" /><label for="S2">4</label><?php echo nbs(3); ?>
                                <input type="radio" name="inQuestionScore" id="S3" class="magic-radio" value="3" /><label for="S3">3</label><?php echo nbs(3); ?>
                                <input type="radio" name="inQuestionScore" id="S4" class="magic-radio" value="2" /><label for="S4">2</label><?php echo nbs(3); ?>
                                <input type="radio" name="inQuestionScore" id="S5" class="magic-radio" value="1" /><label for="S5">1</label>
                            </div>
                            <div class="form-group col-md-1">
                                <button type="submit" class="btn btn-default"><i class="icon-save"></i> บันทึกผล</button>
                            </div>
                        </div>
                    </div>
                    <input type="text" name="pid" id="pid"/>
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
    $('#ds-level1-form').on('submit', function (e) {
        e.preventDefault();
        var score = $('#')
        $.ajax({
            url: '<?php echo site_url('insert-ds-level-1'); ?>',
            method: 'post',
            data: $('#ds-level1-form').serialize(),
            success: function (data) {
                $('#ds-level1-form')[0].reset();
                location.reload();
            }
        });
    });
</script>