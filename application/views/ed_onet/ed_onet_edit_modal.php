<!-- Modal -->
<div id="ed-onet-edit-modal" class="modal fade" role="dialog">
    <div class="modal-dialog" style="width:80%;">
        <div class="modal-content">
            <div class="modal-header" style="background:#0080FF;color:#FFFFFF;">
                <button type="button" class="close" data-dismiss="modal">X</button>
                <h3 class="modal-title" id="title"></h2>
            </div>
            <div class="modal-body" style="padding:30px;">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12 col-md-offset-1">
                            <form method="post" id="insert-form" enctype="multipart/form-data">
                                <div class="row">
                        <div class="col-md-4 form-group">
                        <label class="control-label">ชั้น</label>
                            
                        <div class="row">
                                
                                <?php $arr = array("ป.6" => "ป.6", "ม.3" => "ม.3", "ม.6" => "ม.6"); ?>
                                <select name="inTbEdOnetClass" id="inTbEdOnetClass" class="my-select" required>
                                    <option value="">-เลือกข้อมูล-</option>
                                    <?php foreach ($arr as $key => $value): ?>
                                        <option value="<?php echo $key; ?>"><?php echo $value; ?></option>
                                    <?php endforeach; ?>
                                </select>
                                
                        </div>
                        </div>
                        
                        <div class="col-md-5 form-group">
                        <label class="control-label">กลุ่มสาระ</label>
                            
                        <div class="row">
                                
                                <?php $arr = array("คณิตศาสตร์" => "คณิตศาสตร์", "วิทยาศาสตร์" => "วิทยาศาสตร์", "ภาษาอังกฤษ" => "ภาษาอังกฤษ", "ภาษาไทย" => "ภาษาไทย", "สังคมศึกษา ศาสนาและวัฒนธรรม" => "สังคมศึกษา ศาสนาและวัฒนธรรม"); ?>
                                <select name="inTbEdOnetSubj" id="inTbEdOnetSubj" class="my-select" required>
                                    <option value="">-เลือกข้อมูล-</option>
                                    <?php foreach ($arr as $key => $value): ?>
                                        <option value="<?php echo $key; ?>"><?php echo $value; ?></option>
                                    <?php endforeach; ?>
                                </select>
                                
                        </div>
                        </div>
                        <div class="row">
                        <div class="col-md-2 form-group">
                            <label class="control-label">คะแนน</label>
                            <input type="text" name="inTbEdOnetScore" id="inTbEdOnetScore" class="form-control" autofocus  required=""/>
                        </div>
                        
                        </div>
                        
                    </div>    

                                <div class="row">
                                    <center><button type="submit" class="btn btn-success btn-insert"><i class="icon-save icon-large"></i> บันทึกข้อมูล</button></center>
                                </div>
                                <input type="hidden" name="id" id="id" />
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
        
        $.ajax({
            url: "<?php echo site_url('ed-onet-update'); ?>",
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