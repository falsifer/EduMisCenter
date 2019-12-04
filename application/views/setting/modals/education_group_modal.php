<!-- Modal -->
<div id="education-group-modal" class="modal fade" role="dialog">
    <div class="modal-dialog" style="width:60%;">
        <div class="modal-content">
            <div class="modal-header" style="background:#0080FF;color:#FFFFFF;">
                <button type="button" class="close" data-dismiss="modal">X</button>
                <h3 class="modal-title" id="title"></h3>
            </div>
            <div class="modal-body">
                <form id="insert-form" method="post">
                    <div class="row">
                        <div class="form-group col-md-2">
                            <label class="control-label">พุทธศักราช</label>
                            <input type="text" name="inEdYear" id="inEdYear" class="form-control" required autofocus />
                        </div>
                        <div class="form-group col-md-2">
                            <label class="control-label">กลุ่มสาระที่</label>
                            <input type="text" name="inEducationGroupNo" id="inEducationGroupNo" class="form-control" required autofocus />
                        </div>
                        <div class="form-group col-md-6">
                            <label class="control-label">คำอธิบายกลุ่มสาระ</label>
                            <input type="text" name="inEducationGroupName" id="inEducationGroupName" class="form-control" required autofocus />
                        </div>
                        <div class="form-group col-md-2">
                            <label class="control-label">ตัวย่อ</label>
                            <input type="text" name="inEducationGroupCode" id="inEducationGroupCode" class="form-control" required autofocus />
                        </div>
                    </div>
                    <div class="row"><center><button type="submit" class="btn btn-success"><i class="icon-save icon-large"></i> บันทึก</button></center></div>
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
            url: '<?php echo site_url('insert-education-group'); ?>',
            method: 'post',
            data: $('#insert-form').serialize(),
            success: function (data) {
                $('#insert-form')[0].reset();
                location.reload();
            }
        });
    });
</script>