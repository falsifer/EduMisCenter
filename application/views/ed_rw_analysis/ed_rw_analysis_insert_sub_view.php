<div class="box">
    <div class="box-heading">เพิ่มข้อมูลอ่าน เขียน คิดวิเคราะห์</div>
    <ul class="breadcrumb">
        <li><?php echo anchor(site_url(), "<i class='icon-home icon-large'></i> หน้าแรก"); ?></li>
        <li><?php echo anchor('ed-rw-analysis', "อ่าน เขียน คิดวิเคราะห์"); ?></li>
        <li>เพิ่มข้อมูลอ่าน เขียน คิดวิเคราะห์</li>
    </ul>
    <div class="box-body" >
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <form method="post" id="insert-form" enctype="multipart/form-data">
                    
                    <div class="row">
                        <div class="col-md-5 form-group">
                            <label class="control-label">หัวข้อข้อมูลอ่าน เขียน คิดวิเคราะห์</label>

                            <div class="row">


                                <select name="inTbEdRwAnalysisId" id="inTbEdRwAnalysisId" class="my-select" required>
                                    <option value="">-เลือกข้อมูล-</option>
                                    <?php foreach ($rt as $r): ?>
                                        <option value="<?php echo $r['id']; ?>"><?php echo $r['tb_ed_rw_analysis_content']; ?></option>
                                    <?php endforeach; ?>
                                    
                                </select>

                            </div>
                        </div>
                        
                    </div>
                    <div class="row">
                        <div class="col-md-10 form-group">
                            <label class="control-label">รายละเอียดอ่าน เขียน คิดวิเคราะห์</label>
                            <input type="text" name="inTbEdRwAnalysisSubContent" id="inTbEdRwAnalysisSubContent" class="form-control" autofocus  required=""/>
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
            url: "<?php echo site_url('ed-rw-analysis-insert-sub'); ?>",
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