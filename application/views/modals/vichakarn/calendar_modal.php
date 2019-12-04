<div id="calendar-modal" class="modal fade" role="dialog">
    <div class="modal-dialog" style="width:55%;">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">X</button>
                <h3 class="modal-title" id="title"></h3>
            </div>
            <div class="modal-body">
                <form method="post" id="calendar-form" enctype="multi-part/form-data">
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label class="control-label">กิจกรรม</label>
                            <input type="text" name="inTitle" id="inTitle" class="form-control" autofocus required/>
                        </div>
                        <div class="form-group col-md-3">
                            <label class="control-label">เริ่มต้น</label>
                            <input type="text" name="inStart" id="inStart" class="form-control datepicker"  required placeholder="คลิกวันที่..." />
                        </div>
                        <div class="form-group col-md-3">
                            <label class="control-label">สิ้นสุด</label>
                            <input type="text" name="inEnd" id="inEnd" class="form-control datepicker" required placeholder="คลิกวันที่..."/>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label class="control-label">สถานที่</label>
                            <input type="text" name="inPlace" id="inPlace" class="form-control" />
                        </div>
                        <div class="form-group col-md-6">
                            <label class="control-label">หมายเหตุ</label>
                            <input type="text" name="inComment" id="inComment" class="form-control" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 set-btn-delete">
                            <center><button type="submit" class="btn btn-success"><i class="icon-save"></i> บันทึก</button></center>
                        </div>
                    </div>
                    <input type="hidden" name="pid" id="pid" />
                    
                </form>
            </div>
        </div>
    </div>
    <script>
        $(".datepicker").datepicker({autoclose: true, language: 'th',format:'yyyy-mm-dd'});
        $('#calendar-form').on('submit', function (e) {
            e.preventDefault();
            $.ajax({
                url: '<?php echo site_url('insert-calendar-task'); ?>',
                method: 'POST',
                data: new FormData(this),
                cache: false,
                contentType: false,
                processData: false,
                success: function (data) {
                    $("#calendar-form")[0].reset();
                    location.reload();
                }
            });
        });
    </script>