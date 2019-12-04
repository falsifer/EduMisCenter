<!-- Modal -->
<div id="education-level-type-modal" class="modal fade" role="dialog">
    <div class="modal-dialog" style="width:60%;">
        <div class="modal-content">
            <div class="modal-header" style="background:#0080FF;color:#FFFFFF;">
                <button type="button" class="close" data-dismiss="modal">X</button>
                <h3 class="modal-title" id="title"></h3>
            </div>
            <div class="modal-body">
                <form id="insert-form" method="post">
                    <div class="row">
                        <div class="form-group col-md-3">
                            <label class="control-label">ประเภทชั้นเรียน</label>
                            <input type="text" name="inLevelType" id="inLevelType" class="form-control" required autofocus />
                        </div>
                        <div class="form-group col-md-9">
                            <label class="control-label">คำอธิบาย</label>
                            <input type="text" name="inLevelTypeDescription" id="inLevelTypeDescription" class="form-control" />
                        </div>
                    </div>
                    <div class="row"><center><button type="submit" class="btn btn-success"><i class="icon-save icon-large"></i> บันทึก</button></center></div>
                    <input type="hidden" name="id" id='id' />
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
            url: '<?php echo site_url('insert-education-level-type'); ?>',
            method: 'post',
            data: $('#insert-form').serialize(),
            success: function (data) {
                $('#insert-form')[0].reset();
                location.reload();
            }
        });
    });
</script>