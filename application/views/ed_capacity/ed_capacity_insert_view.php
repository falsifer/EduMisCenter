<div class="box">
    <div class="box-heading">เพิ่มสมรรถนะผู้เรียน</div>
    <ul class="breadcrumb">
        <li><?php echo anchor(site_url(), "<i class='icon-home icon-large'></i> หน้าแรก"); ?></li>
        <li><?php echo anchor('ed-capacity', "สมรรถนะผู้เรียน"); ?></li>
        <li>เพิ่มสมรรถนะผู้เรียน</li>
    </ul>
    <div class="box-body" >
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <form method="post" id="insert-form" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-md-2 form-group">
                            <label class="control-label">หัวข้อที่</label>
                            <input type="text" name="inTbEdCapacitySeq" id="inTbEdCapacitySeq" class="form-control" autofocus  required=""/>
                        </div>
                        
                    </div>
                    <div class="row">
                        <div class="col-md-10 form-group">
                            <label class="control-label">รายละเอียดหัวข้อสมรรถนะผู้เรียน</label>
                            <input type="text" name="inTbEdCapacityContent" id="inTbEdCapacityContent" class="form-control" autofocus  required=""/>
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
            url: "<?php echo site_url('ed-capacity-insert'); ?>",
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