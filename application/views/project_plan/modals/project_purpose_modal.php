<div id="project-purpose-modal" class="modal fade" role="dialog">
    <div class="modal-dialog" style="width:60%;">
        <div class="modal-content">
            <div class="modal-header" style="background:#060150;color:#FFFFFF;">
                <button type="button" class="close" data-dismiss="modal">X</button>
                <h3 class="modal-title" id="title"></h3>
            </div>
            <div class="modal-body">
                <form method="post" id="insert-form" class="form-horizontal">
                    <div class="row" style="padding-top:20px;padding-bottom:20px;">
                        <div class="col-md-10 form-group">
                            <label class="control-label col-md-4">วัตถุประสงค์ของโครงการ</label>
                            <div class="col-md-8">
                                <input type="text" name="inPurposeDescription" id="inPurposeDescription" class="form-control" autofocus required />
                            </div>
                        </div>
                        <div class="col-md-1">
                            <button type="submit" class="btn btn-success">บันทึกข้อมุล</button>
                        </div>
                    </div>
                    <input type="hidden" name="id" id="id" />
                    <input type="hidden" name="project_id" id="project_id" value="<?php echo $this->uri->segment(2); ?>" />
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
            url: "<?php echo site_url('EducationPlan/project_plan_purpose_add'); ?>",
            method: "post",
            data: $("#insert-form").serialize(),
            success: function (data) {
                $("#insert-form")[0].reset();
                location.reload();
            }
        });
    });
</script>