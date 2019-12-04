<!-- Modal -->
<div id="dc-insert-modal" class="modal fade" role="dialog">
    <div class="modal-dialog" style="width:80%;">
        <div class="modal-content">
            <div class="modal-header" style="background:#0080FF;color:#FFFFFF;">
                <button type="button" class="close" data-dismiss="modal">X</button>
                <h3 class="modal-title" id="title">เพิ่มสาระการเรียนรู้</h2>
            </div>
            <div class="modal-body">

                <div class="row">
                    <div class="col-md-10 col-md-offset-1">
                        <form method="post" id="insert-form" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-md-5 form-group">
                                    <label class="control-label">กลุ่มสาระ</label>

                                    <div class="row">


                                        <select name="inTbGroupLearningId" id="inTbGroupLearningId" class="my-select" required>
                                            <option value="">-เลือกข้อมูล-</option>
                                            <?php foreach ($rsGl as $r): ?>
                                                <option value="<?php echo $r['id']; ?>"><?php echo $r['tb_group_learningcol_name']; ?></option>
                                            <?php endforeach; ?>

                                        </select>

                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-7 form-group">
                                        <label class="control-label">สาระที่</label>
                                        <input type="text" name="inTbGroupLearningItemSeq" id="inTbGroupLearningItemSeq" class="form-control" autofocus  required=""/>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-7 form-group">
                                        <label class="control-label">เรื่อง</label>
                                        <input type="text" name="inTbGroupLearningItemContent" id="inTbGroupLearningItemContent" class="form-control" autofocus  required=""/>
                                    </div>
                                </div>


                                <div class="row">
                                    <input type="hidden" name="itm_id" id="itm_id" />
                                    <center><button type="submit" class="btn btn-success btn-insert"><i class="icon-save icon-large"></i> บันทึก</button></center>
                                </div>
                        </form>
                    </div>
                </div>
            </div>
            </div>
            <div class="modal-footer" style="background-color:#CEE3F6;">
                <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="icon-power-off"></i></button>
            </div>
        </div>
    </div>
</div>

<script>


    $("#insert-form").on("submit", function (e) {
        e.preventDefault();

        alert($("#itm_id").val());
        $.ajax({
            url: "<?php echo site_url('dc-insert-1'); ?>",
            method: "post",
            data: new FormData(this),
            cache: false,
            contentType: false,
            processData: false,
            success: function (data) {
                alert("บันทึกข้อมูลสำเร็จ");
                $("#insert-form")[0].reset();
                location.reload();
            }
        });
    });
</script>
