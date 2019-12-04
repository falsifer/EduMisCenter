<!-- Modal -->
<div id="hr-position-modal" class="modal fade" role="dialog">
    <div class="modal-dialog" style="width:80%;">
        <div class="modal-content">
            <div class="modal-header" style="background:#0080FF;color:#FFFFFF;">
                <button type="button" class="close" data-dismiss="modal">X</button>
                <h3 class="modal-title" id="title"></h3>
            </div>
            <div class="modal-body" style="padding:30px;">
                <div class="container-fluid">
                    <form method="post" id="insert-form" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-md-3 form-group">
                                <label class="control-label">เลขที่ประจำตำแหน่ง</label>
                                <input type="text" name="inHrPositionCode" id="inHrPositionCode" class="form-control" autofocus  required/>
                            </div>
                            <div class="col-md-5 form-group">
                                <label class="control-label">ชื่อตำแหน่ง</label>
                                <input type="text" name="inHrPositionName" id="inHrPositionName" class="form-control" autofocus  required/>
                            </div>
                            <div class="col-md-4 form-group">
                                <label class="control-label">อยู่ภายใต้ตำแหน่ง</label>
                                <select name="inHrPositionUnder" id="inHrPositionUnder" class="form-control">
                                    <option value="0">---ไม่อยู่ภายใต้ตำแหน่ง---</option>
                                    <?php foreach ($rs as $r): ?>
                                        <option value="<?php echo $r['id']; ?>"><?php echo $r['tb_hr_position_code']; ?> : <?php echo $r['tb_hr_position_name']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
<!--                            <div class="col-md-2 form-group">
                                <label class="control-label">ขั้นของตำแหน่ง</label>
                                <select name="inHrPositionTier" id="inHrPositionTier" class="form-control">
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                    <option value="6">6</option>
                                </select>
                            </div>-->
                        </div>    
                        <div class="row">
                            <div class="col-md-12 form-group">
                                <label class="control-label">รายละเอียดของตำแหน่ง</label>
                                <textarea id="inHrPositionDetail" name="inHrPositionDetail" style="width:100%;height:100px;"></textarea>
                            </div>
                        </div>  
                        <div class="row">
                            <center><button type="submit" class="btn btn-success btn-insert"><i class="icon-save icon-large"></i> บันทึก</button></center>
                        </div>
                        <input type="hidden" name="id" id="id" />
                    </form>
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
        //
        $.ajax({
            url: "<?php echo site_url('Admin_school/hr_position_insert'); ?>",
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