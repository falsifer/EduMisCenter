<!-- Modal -->
<div id="st-modal" class="modal fade" role="dialog">
    <div class="modal-dialog" style="width:80%;">
        <div class="modal-content">
            <div class="modal-header" style="background:#060150;color:#FFFFFF;">
                <button type="button" class="close" data-dismiss="modal">X</button>
                <h3 class="modal-title" id="title"></h3>
            </div>
            <div class="modal-body">
                <form method="post" id="insert-school-st-form" class="form-horizontal">
                    <div class="row" style="padding-top:30px;padding-bottom:30px;">
                        <div class="form-group col-md-12">
                             <div class="col-md-2">
                            <label class="control-label">กลยุทธ์ที่</label>
                           
                                <input type="number" name="inSchoolStsNo" id="inSchoolStsNo" class="form-control" autofocus required />
                            </div>
                             <div class="col-md-9">
                            <label class="control-label">ชื่อกลยุทธ์</label>
                           
                                <input type="text" name="inSchoolStsName" id="inSchoolStsName" class="form-control" autofocus required />
                            </div>
                        </div>
                        <div class="form-group col-md-12">
                            <center>
                                <button type="submit" class="btn btn-success"><i class="icon-save icon-large"></i> บันทึก</button>
                            </center>
                        </div>
                    </div>
                    <input type="hidden" name="stsid" id="stsid" />
                    <input type="hidden" name="stid" id="stid" />
                </form>
            </div>
            <div class="modal-footer" style="background-color:#CEE3F6;">
                <button type="button" class="btn btn-danger btn-lg" data-dismiss="modal"><i class="icon-power-off"></i></button>
            </div>
        </div>
    </div>
</div>
<script>

    $("#insert-school-st-form").on("submit", function (e) {
        e.preventDefault();
        $.ajax({
            url: "<?php echo site_url('EducationPlan/school_strategies_insert'); ?>",
            method: "post",
            data: $("#insert-school-st-form").serialize(),
            success: function (data) {
                $("#insert-school-st-form")[0].reset();
                location.reload();
            }
        });
    });
</script>