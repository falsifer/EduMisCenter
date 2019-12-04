<div class="box">
    <div class="box-heading">เพิ่มหนังสือแบบเรียน</div>
    <ul class="breadcrumb">
        <li><?php echo anchor(site_url(), "<i class='icon-home icon-large'></i> หน้าแรก"); ?></li>
        <li><?php echo anchor('bs-base', "งานคัดเลือกหนังสือแบบเรียน"); ?></li>
        <li>เพิ่มหนังสือแบบเรียน</li>
    </ul>
    <div class="box-body" >
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <form method="post" id="insert-form" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-md-3 form-group">
                            <label class="control-label">ชื่อหนังสือ</label>
                            <input type="text" name="inBsName" id="inBsName" class="form-control" autofocus  required=""/>
                        </div>
                        <div class="col-md-4 form-group">
                            <label class="control-label">รายวิชา</label>
                            <input type="text" name="inBsSubj" id="inBsSubj" class="form-control" autofocus  required=""/>
                        </div>
                        <div class="col-md-5 form-group">
                            <label class="control-label">กลุ่มสาระการเรียนรู้</label>
                            <input type="text" name="inBsSara" id="inBsSara" class="form-control" autofocus  required=""/>
                        </div>
                        <div class="col-md-2 form-group">
                            <label class="control-label">ชั้น</label>
                            <input type="text" name="inBsClass" id="inBsClass" class="form-control" autofocus  required=""/>
                        </div>
                        <div class="col-md-5 form-group">
                            <label class="control-label">ผู้จัดพิมพ์</label>
                            <input type="text" name="inBsPublisher" id="inBsPublisher" class="form-control" autofocus  required=""/>
                        </div>
                        <div class="col-md-5 form-group">
                            <label class="control-label">ผู้เรียบเรียง</label>
                            <input type="text" name="inBsWriter" id="inBsWriter" class="form-control" autofocus  required=""/>
                        </div>
                        <div class="col-md-5 form-group">
                            <label class="control-label">ปีพ.ศ.ที่เผยแพร่</label>
                            <input type="text" name="inBsYear" id="inBsYear" class="form-control" autofocus  required=""/>
                        </div>
                        <div class="col-md-3 form-group">
                            <label class="control-label">ราคา(บาท)</label>
                            <input type="number" name="inBsPrice" id="inBsPrice" class="form-control" autofocus  required=""/>
                        </div>
                        <div class="row">
                            <div class="col-md-4 form-group">
                                <label class="control-label">ภาพหนังสือ</label>
                                <input type="file" name="inBsImage" id="inBsImage" class="filestyle" />
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
        var image = $('#inBsImage').val();
        var ext1 = $("#inBsImage").val().split('.').pop().toLowerCase();

        //
        if ((image != "" && jQuery.inArray(ext1, ['jpg']) == -1)) {
            alert("ไฟล์ภาพจะต้องเป็นชนิด jpg เท่านั้น");
            $(":file").filestyle('clear');
            return false;
        }

        $.ajax({
            url: "<?php echo site_url('bs-insert'); ?>",
            method: "post",
            data: new FormData(this),
            cache: false,
            contentType: false,
            processData: false,
            success: function (data) {
                alert("บันทึกข้อมูลสำเร็จ");
//                $("#insert-form")[0].reset();
//                location.reload();
                location.href = "<?php echo site_url('bs-base'); ?>";
            }
        });
    });
</script>
