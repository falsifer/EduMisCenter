<!-- Modal -->
<div id="study-activities-modal" class="modal fade" role="dialog">
    <div class="modal-dialog" style="width:70%;">
        <div class="modal-content">
            <div class="modal-header" style="background:#0080FF;color:#FFFFFF;">
                <button type="button" class="close" data-dismiss="modal">X</button>
                <h3 class="modal-title" id="title"></h3>
            </div>
            <div class="modal-body">
                <form method="post" id="study-activities-form">
                    <div class="row">
                        <div class="form-group col-md-2">
                            <label class="control-label">ครั้งที่</label>
                            <input type="text" name="inStudyActivitiesNo" id="inStudyActivitiesNo" class="form-control" required />
                        </div>
                        <div class="form-group col-md-8">
                            <label class="control-label">กิจกรรม</label>
                            <input type="text" name="inStudyActivitiesDetail" id="inStudyActivitiesDetail" class="form-control" required />
                        </div>
                        <div class="form-group col-md-2">
                            <label class="control-label">ใช้เวลา (นาที)</label>
                            <input type="text" name="inStudyActivitiesTime" id="inStudyActivitiesTime" class="form-control" required />
                        </div>
                    </div>
                    <div class="row"><center><button type="submit" class="btn btn-default"><i class="icon-save"></i> บันทึก</button></center></div>
                    <input type="hidden" name="schedule_detail_id" id="schedule_detail_id" value="<?php echo $this->uri->segment(2); ?>" />
                    <input type="hidden" name="activities_id" id="activities_id" />
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
    // บันทึกกิจกรรมการเรียนการสอน
    $('#study-activities-form').on('submit', function (e) {
        e.preventDefault();
        $.ajax({
            url: '<?php echo site_url('insert-observ-study-activities'); ?>',
            method: 'post',
            data: $('#study-activities-form').serialize(),
            success: function (data) {
                alert('บันทึกเรียบร้อย...');
                $('#study-activities-form')[0].reset();
                location.reload();
            }
        });
    });
</script>