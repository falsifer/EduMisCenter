<!-- Modal -->
<div id="project-loan-year-modal" class="modal fade" role="dialog">
    <div class="modal-dialog" style="width:60%;">
        <div class="modal-content">
            <div class="modal-header" style="background:#0080FF;color:#FFFFFF;">
                <button type="button" class="close" data-dismiss="modal">X</button>
                <h3 class="modal-title" id="title"></h3>
            </div>
            <div class="modal-body">
                <form method="post" id="insert-form">
                    <div class="row">
                        <div class="col-md-6">
                            <label class="control-label">ปีงบประมาณ</label>
                            <input type="text" name="inLoanYear" id="inLoanYear" class="form-control"  autofocus required />
                        </div>
                        <div class="col-md-6">
                            <label class="control-label">งบประมาณ (บาท)</label>
                            <input type="number" name="inProjectLoan" id="inProjectLoan" class="form-control"  required />
                        </div>
                    </div>
                    <div class="row" style="margin-top:15px;">
                        <div class="col-md-12"><center><button type="submit" class="btn btn-success btn-insert">บันทึก</button></center></div>
                    </div>
                    <input type="hidden" name="id" id="id" />
                    <input type="hidden" name="project_id" id="project_id" value="<?php echo $this->uri->segment(2); ?>"/>
                </form>
            </div>
            <div class="modal-footer" style="background-color:#CEE3F6;">
                <button type="button" class="btn btn-danger btn-lg" data-dismiss="modal"><i class="icon-power-off"></i></button>
            </div>
        </div>
    </div>
</div>
<script>
    $(".datepicker").datepicker({autoclose: true, language: 'th'});
    $("#insert-form").on("submit", function (e) {
        e.preventDefault();
        $.ajax({
            url: "<?php echo site_url('insert-loan-year'); ?>",
            method: "post",
            data: $("#insert-form").serialize(),
            success: function (data) {
                $("#insert-form")[0].reset();
                location.reload();
            }
        });
    });
</script>
