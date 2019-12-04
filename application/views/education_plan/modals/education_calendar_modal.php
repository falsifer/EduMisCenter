<div id="education-calendar-modal" class="modal fade" role="dialog">
    <div class="modal-dialog" style="width:55%;">
        <div class="modal-content">
            <div class="modal-header" style="background:#0080FF;color:#FFFFFF;">
                <button type="button" class="close" data-dismiss="modal">X</button>
                <h3 class="modal-title" id="title"></h3>
            </div>
            <div class="modal-body">
                <form method="post" id="education-calendar-form">
                    <div class="row">
                        <div class="form-group col-md-3">
                            <label class="control-label">วันที่เริ่มต้น (Start Date)</label>
                            <input type="text" name="inStartEvent" id="inStartEvent" class="form-control datepicker" placeholder="คลิกวันที่..." required/>
                        </div>
                        <div class="form-group col-md-3">
                            <label class="control-label">วันที่สิ้นสุด (End Date)</label>
                            <input type="text" name="inEndEvent" id="inEndEvent" class="form-control datepicker" placeholder="คลิกวันที่..." required/>
                        </div>
                        <div class="form-group col-md-6">
                            <label class="control-label">กิจกรรม</label>
                            <input type="text" name="inTitle" id="inTitle" class="form-control" required/>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-3">
                            <label class="control-label">สถานที่</label>
                            <input type="text" name="inEventPlace" id="inEventPlace" class="form-control" />
                        </div>
                        <div class="form-group col-md-3">
                            <label class="control-label">ผู้รับผิดชอบกิจกรรม</label>
                            <input type="text" name="inEventOwner" id="inEventOwner" class="form-control" />
                        </div>
                        <div class="form-group col-md-6">
                            <label class="control-label">หมายเหตุ</label>
                            <input type="text" name="inEventComment" id="inEventComment" class="form-control" />
                        </div>
                    </div>
                    <div class="row">
                        <center><button type="submit" class="btn btn-default"><i class="icon-save"></i> บันทึก</button></center>
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
    $(".datepicker").datepicker({autoclose: true, language: 'th', format: 'yyyy-mm-dd'});
    $("#education-calendar-form").on("submit", function (e) {
        e.preventDefault();
        $.ajax({
            url: "<?php echo site_url('insert-education-event-calendar') ?>",
            method: "POST",
            data: $('#education-calendar-form').serialize(),
            success: function () {
                alert('Save data successfully...');
                $('#education-calendar-form')[0].reset();
                location.reload();
            }
        });
    });
</script>