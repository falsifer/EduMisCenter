<div class="box">
    <div class="box-heading">เพิ่มคุณลักษณะอันพึงประสงค์</div>
    <ul class="breadcrumb">
        <li><?php echo anchor(site_url(), "<i class='icon-home icon-large'></i> หน้าแรก"); ?></li>
        <li><?php echo anchor('ed-charactor', "คุณลักษณะอันพึงประสงค์"); ?></li>
        <li>เพิ่มคุณลักษณะอันพึงประสงค์</li>
    </ul>
    <div class="box-body" >
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <form method="post" id="insert-form" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-md-5 form-group">
                            <label class="control-label">หัวข้อคุณลักษณะอันพึงประสงค์</label>

                            <div class="row">


                                <select name="inTbEdCharactorId" id="inTbEdCharactorId" class="my-select" required>
                                    <option value="">-เลือกข้อมูล-</option>
                                    <?php foreach ($rt as $r): ?>
                                        <option value="<?php echo $r['id']; ?>"><?php echo $r['tb_ed_charactor']; ?></option>
                                    <?php endforeach; ?>
                                    
                                </select>

                            </div>
                        </div>
                        
                    </div>
                    <div class="row">
                        <div class="col-md-10 form-group">
                            <label class="control-label">รายละเอียดหัวข้อคุณลักษณะอันพึงประสงค์</label>
<!--                            <input type="text" name="inTbEdCharactorSubContent" id="inTbEdCharactorSubContent" class="form-control" autofocus  required=""/>-->
                            <textarea id="inTbEdCharactorSubContent" name="inTbEdCharactorSubContent" style="width:100%;height:100px;"></textarea>
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
            url: "<?php echo site_url('ed-charactor-insert-sub'); ?>",
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
