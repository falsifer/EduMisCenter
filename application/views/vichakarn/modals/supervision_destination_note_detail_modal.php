<!-- Modal -->
<div id="supervision-destination-note-detail-modal" class="modal fade" role="dialog">
    <div class="modal-dialog" style="width:60%;">
        <div class="modal-content">
            <div class="modal-header" style="background:#0080FF;color:#FFFFFF;">
                <button type="button" class="close" data-dismiss="modal">X</button>
                <h3 class="modal-title" id="title"></h3>
            </div>
            <div class="modal-body">
                <form method="post" id="destination-note-form">
                    <div class="row">
                        <div class="col-md-4 form-group">
                            <label class="control-label">วัตถุประสงค์</label>
                            <input type="text" name="inDetailDestination" id="inDetailDestination" class="form-control" required/>
                        </div>
                        <div class="col-md-4 form-group">
                            <label class="control-label">กิจกรรม/วิธีการ/สื่อ ที่ใช้</label>
                            <input type="text" name="inDetailActivities" id="inDetailActivities" class="form-control" />
                        </div>
                        <div class="col-md-4 form-group">
                            <label class="control-label">ผลที่เกิดกับผู้รับการนิเทศ</label>
                            <input type="text" name="inDestinationResult" id="inDestinationResult" class="form-control" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <center><button type="submit" class="btn btn-success"><i class="icon-save"></i> บันทึก</button></center>
                        </div>
                    </div>
                    <input type="hidden" name="schedule_detail_id" value="<?php echo $this->uri->segment(2); ?>" />
                    <input type="hidden" name="note-id" id="note-id" />
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
    $('#destination-note-form').on('submit', function (e) {
        e.preventDefault();
        $.ajax({
            url: '<?php echo site_url('insert-supervision-destination-note-detail'); ?>',
            method: 'post',
            data: $("#destination-note-form").serialize(),
            success: function (data) {
                $('#destination-note-form')[0].reset();
                location.reload();
            }
        });
    });

</script>
