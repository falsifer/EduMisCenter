<!-- Modal -->
<div id="admin-school-division-modal" class="modal fade" role="dialog">
    <div class="modal-dialog" style="width:90%;">
        <div class="modal-content">
            <div class="modal-header" style="background:#0080FF;color:#FFFFFF;">
                <button type="button" class="close" data-dismiss="modal">X</button>
                <h3 class="modal-title" id="title"></h3>
            </div>
            <div class="modal-body" style="padding:30px;">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <form method="post" id="insert-form" enctype="multipart/form-data">

                                <div class="col-md-9 form-group">
                                    <label class="control-label">ชื่อฝ่าย</label>
                                    <input type="text" name="inDivisionName" id="inDivisionName" class="form-control" autofocus  required/>
                                </div>
                                <div class="col-md-3 form-group">
                                    <button type="submit" style='margin-top:25px;' class="btn btn-success btn-insert"><i class="icon-save icon-large"></i> บันทึก</button>
                                </div>
                                <input type="hidden" name="id" id="id" />
                            </form> 
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $("#insert-form").on("submit", function (e) {
        e.preventDefault();
        //
        $.ajax({
            url: "<?php echo site_url('Admin_school/admin_school_division_insert'); ?>",
            method: "post",
            data: new FormData(this),
            cache: false,
            contentType: false,
            processData: false,
            success: function (data) {
                $("#insert-form")[0].reset();
                location.reload();
            }
        });
    });
</script>