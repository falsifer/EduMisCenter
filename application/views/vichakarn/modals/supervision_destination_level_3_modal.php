<!-- Modal -->
<div id="supervision-destination-level-3-modal" class="modal fade" role="dialog">
    <div class="modal-dialog" style="width:50%;">
        <div class="modal-content">
            <div class="modal-header" style="background:#0080FF;color:#FFFFFF;">
                <button type="button" class="close" data-dismiss="modal">X</button>
                <h3 class="modal-title" id="title"></h3>
            </div>
            <div class="modal-body">
                <form method="post" id="insert-form" style="padding-top:20px;">
                    <div class="row">
                        <div class="form-group col-md-7">
                            <label class="control-label">ระดับคะแนน</label>
                            <?php echo nbs(5); ?>
                            <input type="radio" name="inQuestionScore" id="SC1" class="magic-radio" value="5" /><label for="SC1">5</label><?php echo nbs(3); ?>
                            <input type="radio" name="inQuestionScore" id="SC2" class="magic-radio" value="4" /><label for="SC2">4</label><?php echo nbs(3); ?>
                            <input type="radio" name="inQuestionScore" id="SC3" class="magic-radio" value="3" /><label for="SC3">3</label><?php echo nbs(3); ?>
                            <input type="radio" name="inQuestionScore" id="SC4" class="magic-radio" value="2" /><label for="SC4">2</label><?php echo nbs(3); ?>
                            <input type="radio" name="inQuestionScore" id="SC5" class="magic-radio" value="1" /><label for="SC5">1</label>
                        </div>
                        <div class="form-group col-md-1">
                            <button type="submit" class="btn btn-success"><i class="icon-save"></i> บันทึกผล</button>
                        </div>
                    </div>
                    <input type="hidden" name="id" id="id"/>
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
            url: '<?php echo site_url('insert-supervision-destination-note-level-3'); ?>',
            method: 'post',
            data: $('#insert-form').serialize(),
            success: function (data) {
                $('#insert-form')[0].reset();
                location.reload();
            }
        });
    });
</script>