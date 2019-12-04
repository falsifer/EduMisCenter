<!-- Modal -->
<div id="dc-std-insert-modal" class="modal fade" role="dialog">
    <div class="modal-dialog" style="width:80%;">
        <div class="modal-content">
            <div class="modal-header" style="background:#0080FF;color:#FFFFFF;">
                <button type="button" class="close" data-dismiss="modal">X</button>
                <h3 class="modal-title" id="title">เพิ่มมาตรฐานการเรียนรู้</h2>
            </div>
            <div class="modal-body">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <form method="post" id="insert-std-form" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label class="control-label">กลุ่มสาระ</label>
                            <select name="inStdTbGroupLearningId" id="inStdTbGroupLearningId" class="my-select" onchange="Filter(this)" required>
                                <option value="">-เลือกข้อมูล-</option>
                                <?php foreach ($rsGl as $r): ?>
                                    <option value="<?php echo $r['id']; ?>"><?php echo $r['tb_group_learningcol_name']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-6 form-group">
                            <label class="control-label">สาระการเรียนรู้</label>
                            <select name="inTbGroupLearningItemId" id="inTbGroupLearningItemId" class="my-select" required>
                                <option value="">-เลือกข้อมูล-</option>
                                
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label class="control-label">มาตรฐานที่</label>
                            <input type="text" name="inTbStandardLearningCode" id="inTbStandardLearningCode" class="form-control" autofocus  required=""/>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label class="control-label">รายละเอียดมาตรฐาน</label>
                            <input type="text" name="inTbStandardLearningContent" id="inTbStandardLearningContent" class="form-control" autofocus  required=""/>
                        </div>
                    </div>    


                    <div class="row">
                        <input type="hidden" name="std_id" id="std_id" />
                        <center><button type="submit" class="btn btn-success btn-insert"><i class="icon-save icon-large"></i> บันทึก</button></center>
                    </div>
                </form>

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


        $("#insert-std-form").on("submit", function (e) {
        e.preventDefault();
        

        $.ajax({
            url: "<?php echo site_url('dc-insert-2'); ?>",
            method: "post",
            data: new FormData(this),
            cache: false,
            contentType: false,
            processData: false,
            success: function (data) {
                alert("บันทึกข้อมูลสำเร็จ");
                $("#insert-std-form")[0].reset();
                location.reload();
            }
        });
    });
    
    function Filter(e)
    {
        var gl_id = e.value;
        $.ajax({
                url: "<?php echo site_url('Develop_courses/group_learning_item_list'); ?>",
                method: "post",
                data: {gl_id: gl_id},
                success: function (data) {
                    $('#inTbGroupLearningItemId').html(data);
                }
            });
    }
    
    
    </script>
