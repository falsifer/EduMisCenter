<!-- Modal -->
<div id="bd-edit-modal" class="modal fade" role="dialog">
    <div class="modal-dialog" style="width:80%;">
        <div class="modal-content">
            <div class="modal-header" style="background:#0080FF;color:#FFFFFF;">
                <button type="button" class="close" data-dismiss="modal">X</button>
                <h3 class="modal-title" id="title"></h2>
            </div>
            <div class="modal-body" style="padding:30px;">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-10 col-md-offset-1">
                            <form method="post" id="insert-form" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-md-3 form-group">
                                        <label class="control-label">ประเภท</label>
                                        <div class="row">
                                
                                            <?php $arr = array("ห้องเรียน" => "ห้องเรียน", "ห้องสมุด" => "ห้องสมุด", "ห้องคอมพิวเตอร์" => "ห้องคอมพิวเตอร์", "ห้องปฏิบัติการทางภาษา" => "ห้องปฏิบัติการทางภาษา", "ห้องปฐมพยาบาล" => "ห้องปฐมพยาบาล", "ห้องจริยศึกษา" => "ห้องจริยศึกษา", "ห้องแนะแนว" => "ห้องแนะแนว", "ห้องร้านค้าสหกรณ์" => "ห้องร้านค้าสหกรณ์", "ห้องประชุม" => "ห้องประชุม"); ?>
                                            <select name="inBdType" id="inBdType" class="my-select" required>
                                                <option value="">-เลือกข้อมูล-</option>
                                                <?php foreach ($arr as $key => $value): ?>
                                                    <option value="<?php echo $key; ?>"><?php echo $value; ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                
                                        </div>
                                    </div>
                                    <div class="col-md-6 form-group">
                                        <label class="control-label">ลักษณะ/รายละเอียด</label>
                                        <input type="text" name="inBdDetail" id="inBdDetail" class="form-control" autofocus  required=""/>
                                    </div>
                                    <div class="col-md-3 form-group">
                                        <label class="control-label">จำนวนนักเรียนที่รับได้(คน)</label>
                                        <input type="text" name="inBdCap" id="inBdCap" class="form-control" autofocus  required=""/>
                                    </div>
                                    <div class="col-md-3 form-group">
                                        <label class="control-label">จำนวนห้อง</label>
                                        <input type="text" name="inBdRoom" id="inBdRoom" class="form-control" autofocus  required=""/>
                                    </div>
                                    <div class="col-md-3 form-group">
                                        <label class="control-label">ราคา/มูลค่า(บาท)</label>
                                        <input type="text" name="inBdValue" id="inBdValue" class="form-control" autofocus  required=""/>
                                    </div>
                                    <div class="col-md-3 form-group">
                                        <label class="control-label">ปี่ที่ได้รับ</label>
                                        <input type="text" name="inBdYear" id="inBdYear" class="form-control" autofocus  required=""/>
                                    </div>
                                    <div class="col-md-3 form-group">
                                        <label class="control-label">สภาพ</label>
                            
                                            <div class="form-group">
                                
                                                <?php $arr = array('ใช้งานได้' => "ใช้งานได้", "ใช้งานไม่ได้" => "ใช้งานไม่ได้", "ชำรุด/ต้องซ่อมบำรุง" => "ชำรุด/ต้องซ่อมบำรุง"); ?>
                                            <select name="inBdStatus" id="inBdStatus" class="my-select" required>
                                                <option value="">-เลือกข้อมูล-</option>
                                                <?php foreach ($arr as $key => $value): ?>
                                                <option value="<?php echo $key; ?>"><?php echo $value; ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                
                                            </div>
                                    </div>
                                    
                                    <div class="row">
                                        <div class="col-md-4 form-group">
                                            <label class="control-label">รูปภาพประกอบ1</label>
                                            <input type="file" name="inBdImg1" id="inBdImg1" class="filestyle" />
                                        </div>
                       
                                        <div class="col-md-4 form-group">
                                            <label class="control-label">รูปภาพประกอบ2</label>
                                            <input type="file" name="inBdImg2" id="inBdImg2" class="filestyle" />
                                        </div>
                        
                                        <div class="col-md-4 form-group">
                                            <label class="control-label">รูปภาพประกอบ3</label>
                                            <input type="file" name="inBdImg3" id="inBdImg3" class="filestyle" />
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
        var image = $('#inBdImg1').val();
        var ext1 = $("#inBdImg1").val().split('.').pop().toLowerCase();
        
        var image = $('#inBdImg2').val();
        var ext1 = $("#inBdImg2").val().split('.').pop().toLowerCase();
        
        var image = $('#inBdImg3').val();
        var ext1 = $("#inBdImg3").val().split('.').pop().toLowerCase();
        //
        if ((image != "" && jQuery.inArray(ext1, ['jpg']) == -1)) {
            alert("ไฟล์จะต้องเป็นชนิด jpg เท่านั้น");
            $(":file").filestyle('clear');
            return false;
        }
        $.ajax({
            url: "<?php echo site_url('bd-update'); ?>",
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