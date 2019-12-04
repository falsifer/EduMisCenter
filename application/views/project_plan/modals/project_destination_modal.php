<!-- Modal -->
<div id="project-destination-modal" class="modal fade" role="dialog">
    <div class="modal-dialog" style="width:60%;">
        <div class="modal-content">
            <div class="modal-header" style="background:#060150;color:#FFFFFF;">
                <button type="button" class="close" data-dismiss="modal">X</button>
                <h3 class="modal-title" id="title"></h3>
            </div>
            <div class="modal-body">
                <form id="insert-form" method="post" class="form-horizontal">
                    <div class="row" style="padding-top:30px;padding-bottom:30px;">
                        <div class="col-md-10 form-group">
                            <label class="control-label col-md-3">ผลที่คาดว่าจะได้รับ</label>
                            <div class="col-md-8">
                                <input type="text" name="inDestination" id="inDestination" class="form-control" autofocus required />
                            </div>
                            <div class="col-md-1">
                                <button type="submit" class="btn btn-success">บันทึก</button>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" id="id" name="id" />
                    <input type="hidden" name="project_id" id="project_id" value="1" />
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
            url: "<?php echo site_url('EducationPlan/project_plan_destination_add'); ?>",
            method: "POST",
            data: $("#insert-form").serialize(),
            success: function (data) {
                $("#insert-form")[0].reset();
                location.reload();
                alert("บันทึกเรียบร้อย...");
            }
        });
    });
</script>