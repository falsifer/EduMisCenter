<div class="box">
    <div class="box-heading">เพิ่มข้อมูลผลการทดสอบการศึกษาแห่งชาติ</div>
    <ul class="breadcrumb">
        <li><?php echo anchor(site_url(), "<i class='icon-home icon-large'></i> หน้าแรก"); ?></li>
        <li><?php echo anchor('ed-onet', "ผลการทดสอบการศึกษาแห่งชาติ"); ?></li>
        <li>เพิ่มข้อมูลผลการทดสอบการศึกษาแห่งชาติ</li>
    </ul>
    <div class="box-body" >
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
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
                        <div class="col-md-3 form-group">
                            <label class="control-label">คะแนน</label>
                            <input type="text" name="inTbEdOnetScore" id="inTbEdOnetScore" class="form-control" autofocus  required=""/>
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
            url: "<?php echo site_url('ed-onet-insert'); ?>",
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
