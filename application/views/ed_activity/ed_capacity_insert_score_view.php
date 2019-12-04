<div class="box">
    <div class="box-heading">บันทึกคะแนนสมรรถนะผู้เรียน</div>
    <ul class="breadcrumb">
        <li><?php echo anchor(site_url(), "<i class='icon-home icon-large'></i> หน้าแรก"); ?></li>
        <li><?php echo anchor('ed-capacity', "สมรรถนะผู้เรียน"); ?></li>
        <li>บันทึกคะแนนสมรรถนะผู้เรียน</li>
    </ul>
    <div class="box-body" >
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <form method="post" id="insert-form" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-md-5 form-group">
                            <label class="control-label">รายชื่อ</label>

                            <div class="row">


                                <select name="inTbStudentId" id="inTbStudentId" class="my-select" required>
                                    <option value="">-เลือกข้อมูล-</option>
                                    <?php foreach ($ru as $r): ?>
                                        <option value="<?php echo $r['id']; ?>"><?php echo $r['std_titlename']; ?><?php echo $r['std_firstname']; ?>  <?php echo $r['std_lastname']; ?></option>
                                    <?php endforeach; ?>
                                    
                                </select>

                            </div>
                        </div>
                        
                    </div>
                    <div class="row">
                        <div class="col-md-5 form-group">
                            <label class="control-label">กิจกรรม</label>

                            <div class="row">


                                <select name="inTbEdActivityId" id="inTbEdActivityId" class="my-select" required>
                                    <option value="">-เลือกข้อมูล-</option>
                                    <?php foreach ($rt as $r): ?>
                                        <option value="<?php echo $r['id']; ?>"><?php echo $r['tb_ed_activity_content']; ?></option>
                                    <?php endforeach; ?>
                                    
                                </select>

                            </div>
                        </div>
                        
                    </div>
                    <div class="row">
<!--                        <div class="col-md-2 form-group">
                            <label class="control-label">คะแนน</label>
                            <input type="text" name="TbEdActivityScore" id="TbEdActivityScore" class="form-control" autofocus  required=""/>
                        </div>-->
                        <div class="col-md-3 form-group">
                        <label class="control-label">ผลการประเมิน</label>
                            
                        <div class="row">
                                
                                <?php $arr = array("ผ่าน" => "ผ่าน", "ไม่ผ่าน" => "ไม่ผ่าน"); ?>
                                <select name="TbEdActivityScore" id="TbEdActivityScore" class="my-select" required>
                                    <option value="">-เลือกข้อมูล-</option>
                                    <?php foreach ($arr as $key => $value): ?>
                                        <option value="<?php echo $key; ?>"><?php echo $value; ?></option>
                                    <?php endforeach; ?>
                                </select>
                                
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
            url: "<?php echo site_url('ed-capacity-insert-score'); ?>",
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
