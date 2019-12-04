<!-- Modal -->
<div id="ev-progress-modal" class="modal fade" role="dialog">
    <div class="modal-dialog" style="width:70%;">
        <div class="modal-content">
            <div class="modal-header" style="background:#0080FF;color:#FFFFFF;">
                <button type="button" class="close" data-dismiss="modal">X</button>
                <h3 class="modal-title" id="title"></h3>
            </div>
            <div class="modal-body">
                <form method="post" id="insert-form">
                    <div class="row">
                        <div class="form-group col-md-3">
                            <label class="control-label">วันที่ดำเนินงาน</label>
                            <input type="text" name="inProgressDate" id="inProgressDate" autocomplete="off" class="form-control datepicker" data-date-format="yyyy-mm-dd" placeholder="คลิกวันที่..." required /> 
                        </div>
                        <div class="form-group col-md-5">
                            <label class="control-label">การดำเนินงาน</label>
                            <input type="text" name="inProgressDetail" id="inProgressDetail" class="form-control" required />
                        </div>
                        <div class="form-group col-md-4">
                            <label class="control-label">ผู้ดำเนินงาน</label>
                            <input type="text" name="inProgressPerson" id="inProgressPerson" class="form-control" required />
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-8">
                            <label class="control-label">หมายเหตุ</label>
                            <input type="text" name="inProgressComment" id="inProgressComment" class="form-control"/>
                        </div>
                    </div>
                    <div class="row"><center><button type="submit" class="btn btn-success"><i class="icon-save icon-large"></i> บันทึก</button></center></div>
                    <input type="hidden" name="ev_id" id="ev_id" value="<?php echo $this->uri->segment(2); ?>" />
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
    $(".datepicker").datepicker({autoclose: true, language: 'th-th'});
    $('#insert-form').on('submit', function (e) {
        e.preventDefault();
        $.ajax({
            url: '<?php echo site_url('insert-education-evaluation-progress'); ?>',
            method: 'post',
            data: $('#insert-form').serialize(),
            success: function (data) {
                $('#insert-form')[0].reset();
                location.reload();
            }
        });
    });
</script>