<!-- Modal -->
<div id="hr-06-modal" class="modal fade" role="dialog">
    <div class="modal-dialog" style="width:90%;">
        <div class="modal-content">
            <div class="modal-header" style="background:#0080FF;color:#FFFFFF;">
                <button type="button" class="close" data-dismiss="modal">X</button>
                <h3 class="modal-title" id="title"></h2>
            </div>
            <div class="modal-body" style="padding-left:30px;padding-right:30px;">
                <form method="post" id="insert-form">
                    <div class="row">
                        <div class="col-md-2 form-group">
                            <label class="control-label">ปีการศึกษา</label>
                            <input type="text" name="inHr06LoanYear" id="inHr06LoanYear" class="form-control" required autofocus/>
                        </div>
                        <div class="form-group col-md-3">
                            <label class="control-label">วิชาที่สอน</label>
                            <input type="text" name="inHr06Subject" id="inHr06Subject" class="form-control" required/>
                        </div>
                        <div class="form-group col-md-3">
                            <label class="control-label">ระดับชั้น</label>
                            <input type="text" name="inHr06Grade" id="inHr06Grade" class="form-control" required/>
                        </div>
                        <div class="form-group col-md-2">
                            <label class="control-label">จำนวนชั่วโมง</label>
                            <input type="text" name="inHr06Amount" id="inHr06Amount" class="form-control" required/>
                        </div>
                        <div class="form-group col-md-2">
                            <label class="control-label">จำนวนนักเรียน (คน)</label>
                            <input type="text" name="inHr06Student" id="inHr06Student" class="form-control" required/>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 form-group">
                            <label class="control-label">หมายเหตุ</label>
                            <input type="text" name="inHr06Comment" id="inHr06Comment" class="form-control" />
                        </div>
                    </div>
                    <div class="row"><center><button type="submit" class="btn btn-success"><i class="icon-save icon-large"></i> บันทึก</button></center></div>
                    <input type="hidden" id="hr_id" name="hr_id" value="<?php echo $human['id']; ?>" />
                    <input type="hidden" id="id" name="id" />
                </form>
            </div>
        </div>
    </div>
</div>
<script>
//    $(".datepicker").datepicker({autoclose: true, language: 'th'});
    $("#insert-form").on("submit", function (e) {
        e.preventDefault();
        $.ajax({
            url: "<?php echo site_url('insert-human-resources-part-06'); ?>",
            method: "POST",
            data: $("#insert-form").serialize(),
            success: function (data) {
                $("#insert-form")[0].reset();
                location.reload();
            }
        });
    });
</script>