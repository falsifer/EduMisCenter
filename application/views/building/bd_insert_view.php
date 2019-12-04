<div class="box">
    <div class="box-heading">เพิ่มรายละเอียดการดูแลอาคารสถานที่และสภาพแวดล้อม</div>
    <ul class="breadcrumb">
        <li><?php echo anchor(site_url(), "<i class='icon-home icon-large'></i> หน้าแรก"); ?></li>
        <li><?php echo anchor('bd-base', "การดูแลอาคารสถานที่และสภาพแวดล้อม"); ?></li>
        <li>เพิ่มรายละเอียดการดูแลอาคารสถานที่และสภาพแวดล้อม</li>
    </ul>
    <div class="box-body" >
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
                            <input type="number" name="inBdCap" id="inBdCap" class="form-control" autofocus  required=""/>
                        </div>
                        <div class="col-md-3 form-group">
                            <label class="control-label">จำนวนห้อง</label>
                            <input type="number" name="inBdRoom" id="inBdRoom" class="form-control" autofocus  required=""/>
                        </div>
                        <div class="col-md-3 form-group">
                            <label class="control-label">ราคา/มูลค่า(บาท)</label>
                            <input type="number" name="inBdValue" id="inBdValue" class="form-control" autofocus  required=""/>
                        </div>
                        <div class="col-md-3 form-group">
                            <label class="control-label">ปีที่ได้รับ</label>
                            <input type="number" name="inBdYear" id="inBdYear" class="form-control" autofocus  required=""/>
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
                        <center><button type="submit" class="btn btn-success btn-insert"><i class="icon-save icon-large"></i> บันทึก</button></center>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="box-footer" style="padding-top: 0px;">
        <div class="row">
            <div class="col-md-8">
                <?php echo img("images/kmk_logo.png"); ?>
            </div>
            <div class="col-md-4" style="padding-top:8px;padding-bottom: 8px;padding-right:30px;">
                <span class="pull-right"><span style="color:#999999;">eSchool Version 1.0</span></span>
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
            url: "<?php echo site_url('bd-insert'); ?>",
            method: "post",
            data: new FormData(this),
            cache: false,
            contentType: false,
            processData: false,
            success: function (data) {
                alert("บันทึกข้อมูลสำเร็จ");
//                $("#insert-form")[0].reset();
//                location.reload();
                location.href = "<?php echo site_url('bd-base'); ?>";
            }
        });
    });
</script>
