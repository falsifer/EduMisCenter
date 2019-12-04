<div class="box">
    <div class="box-heading">เพิ่มรายละเอียดการควบคุมภายในหน่วยงาน</div>
    <ul class="breadcrumb">
        <li><?php echo anchor(site_url(), "<i class='icon-home icon-large'></i> หน้าแรก"); ?></li>
        <li><?php echo anchor('internal-control', "การควบคุมภายในหน่วยงาน"); ?></li>
        <li>เพิ่มรายละเอียดการควบคุมภายในหน่วยงาน</li>
    </ul>
    <div class="box-body" >
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <form method="post" id="insert-form" enctype="multipart/form-data">
                    <div class="row">
                        <div class="row">
                        <div class="col-md-5 form-group">
                            <label class="control-label">หน่วยงาน</label>

                            <div class="row">


                                <select name="inTbDivisionName" id="inTbDivisionName" class="my-select" required>
                                    <option value="">-เลือกข้อมูล-</option>
                                    <?php foreach ($rt as $r): ?>
                                        <option value="<?php echo $r['tb_division_name']; ?>"><?php echo $r['tb_division_name']; ?></option>
                                    <?php endforeach; ?>
                                    
                                </select>

                            </div>
                        </div>
                        </div>   
                        <div class="row">
                        <div class="col-md-12 form-group">
                            <label class="control-label">กระบวนการปฏิบัติงาน/โครงการ/กิจกรรม/ด้านงานที่ประเมินและวัตถุประสงค์ของการควบคุม</label>
                            <textarea id="inTbInternalControlDetail1" name="inTbInternalControlDetail1" style="width:100%;height:100px;"></textarea>
                        </div>
                        </div>
                        <div class="row">
                        <div class="col-md-12 form-group">
                            <label class="control-label">ความเสี่ยงที่ยังมีอยู่</label>
                            <textarea id="inTbInternalControlDetail2" name="inTbInternalControlDetail2" style="width:100%;height:100px;"></textarea>
                        </div>
                        </div>
                        <div class="row">
                        <div class="col-md-12 form-group">
                            <label class="control-label">งวด/เวลาที่พบจุดอ่อน</label>
                            <textarea id="inTbInternalControlDetail3" name="inTbInternalControlDetail3" style="width:100%;height:100px;"></textarea>
                        </div>
                        </div>
                        <div class="row">
                        <div class="col-md-12 form-group">
                            <label class="control-label">การปรับปรุงการควบคุม</label>
                            <textarea id="inTbInternalControlDetail4" name="inTbInternalControlDetail4" style="width:100%;height:100px;"></textarea>
                        </div>
                        </div>
                        <div class="row">
                        <div class="col-md-12 form-group">
                            <label class="control-label">กำหนดเสร็จ/ผู้รับผิดชอบ</label>
                            <textarea id="inTbInternalControlDetail5" name="inTbInternalControlDetail5" style="width:100%;height:100px;"></textarea>
                        </div>
                        </div>
                        <div class="row">
                        <div class="col-md-12 form-group">
                            <label class="control-label">วิธีการติดตามและสรุปผลการประเมินผล/ข้อคิดเห็น</label>
                            <textarea id="inTbInternalControlDetail6" name="inTbInternalControlDetail6" style="width:100%;height:100px;"></textarea>
                        </div>
                        </div>
                        
                        
                    </div>    
                    
                    <div class="row">
                        <center><button type="submit" class="btn btn-success btn-insert"><i class="icon-save icon-large"></i> บันทึกข้อมูล</button></center>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <?php $this->load->view('layout/my_school_footer'); ?>
</div>
<script>
    $("#insert-form").on("submit", function (e) {
        e.preventDefault();

        $.ajax({
            url: "<?php echo site_url('internal-control-insert'); ?>",
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
