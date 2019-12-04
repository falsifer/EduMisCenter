<!-- Modal -->
<div id="hr-plan-modal" class="modal fade" role="dialog">
    <div class="modal-dialog" style="width:50%;">
        <div class="modal-content">
            <div class="modal-header" style="background:#0080FF;color:#FFFFFF;">
                <button type="button" class="close" data-dismiss="modal">X</button>
                <h3 class="modal-title" id="title"></h3>
            </div>
            <div class="modal-body">

                <form method="post" id="insert-form">
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label class="control-label">ปีงบประมาณเริ่มต้น</label>
                            <input type="number" name="inBeginYear" id="inBeginYear" class="form-control" required autofocus/>
                        </div>
                        <div class="form-group col-md-6">
                            <label class="control-label">ปีงบประมาณสิ้นสุด</label>
                            <input type="number" name="inEndYear" id="inEndYear" class="form-control" required/>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 form-group">
                            <label class="control-label">หมายเหตุ</label>
                            <input type="text" name="inPlanComment" id="inPlanComment" class="form-control" />
                        </div>
                    </div>
                    <div class="row" style="margin-top:15px;">
                        <div class="col-md-12"><center><button type="submit" class="btn btn-success"><i class="icon-save"></i> บันทึก</button></center></div>
                    </div>
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
    //
    $('#insert-form').on('submit', function (e) {
        e.preventDefault();
        var begin_year = $('#inBeginYear').val();
        var end_year = $('#inEndYear').val();
        if (begin_year > end_year) {
            alert('ปีงบประมาณเริ่มต้นจะมีค่ามากกว่าปีงบประมาณสิ้นสุดไม่ได้');
            $('#inBeginYear').val('');
            $('#inEndYear').val('');
            return false;
        }
        //
        $.ajax({
            url: '<?php echo site_url('insert-human-resources-plan-year'); ?>',
            method: 'post',
            data: $("#insert-form").serialize(),
            success: function (data) {
                $('#insert-form')[0].reset();
                location.reload();
            }
        });
    });
</script>