<div id="project-goal-modal" class="modal fade" role="dialog">
    <div class="modal-dialog" style="width:60%;">
        <div class="modal-content">
            <div class="modal-header" style="background:#0080FF;color:#FFFFFF;">
                <button type="button" class="close" data-dismiss="modal">X</button>
                <h3 class="modal-title" id="title"></h3>
            </div>
            <div class="modal-body">
                <form method="post" id="insert-form">
                    <div class="row" style="padding-top:20px;padding-bottom:20px;">
                        <div class="col-md-12 form-group">
                            <label class="control-label">เป้าหมาย (ผลผลิตของโครงการ)</label>
                            <select name="inGoalType" id="inGoalType" class="form-control">
                                <option value="เป้าหมายเชิงปริมาณ">เป้าหมายเชิงปริมาณ</option>
                                <option value="เป้าหมายเชิงคุณภาพ">เป้าหมายเชิงคุณภาพ</option>
                            </select>
                        </div>
                        <div class="col-md-12 form-group">
                            <label class="control-label">รายละเอียด</label>
                            <textarea name="inGoalDescription" id="inGoalDescription" class="form-control" style="height:150px;"></textarea>
                        </div>
                    </div>
                    <div class="row"><center><button type="submit" class="btn btn-success">บันทึก</button></center></div>
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
            url: "<?php echo site_url('EducationPlan/project_plan_goal_add'); ?>",
            method: "post",
            data: $("#insert-form").serialize(),
            success: function (data) {
                $("#insert-form")[0].reset();
                location.reload();
            }
        });
    });
</script>