<div class="box">
    <div class="box-heading">เพิ่มงานวิจัย</div>
    <ul class="breadcrumb">
        <li><?php echo anchor(site_url(), "<i class='icon-home icon-large'></i> หน้าแรก"); ?></li>
        <li><?php echo anchor("hr-member-profile", "ข้อมูลผู้ใช้"); ?></li>
        <li><?php echo anchor('er-base', "งานวิจัยเพื่อพัฒนาคุณภาพการศึกษาในสถานศึกษา"); ?></li>
        <li>เพิ่มงานวิจัย</li>
    </ul>
    <div class="box-body" >
        <div class="row">
            <div class="col-md-12">
                <form method="post" id="insert-form" enctype="multipart/form-data">
                    <div class="col-md-4 form-group">
                        <label class="control-label">งานวิจัยเรื่อง</label>
                        <input type="text" name="inErName" id="inErName" class="form-control" autofocus  required/>
                    </div>
                    <div class="col-md-4 form-group">
                        <label class="control-label">ระดับชั้น/ห้อง</label>
                        <select name="inErEdRoom" id="inErEdRoom" class="form-control">
                            <option value=''>---เลือกข้อมูล---</option>
                            <?php foreach ($ed_room as $r) { ?>                               
                                <option value='<?php echo $r['room_id'] ?>'> <?php echo $r['tb_ed_school_class_name'] . "ปีที่ " . $r['tb_ed_school_class_level'] . "/" . $r['tb_classroom_room'] ?></option>
                            <?php } ?>
                        </select> 
                    </div>
                    <div class="col-md-4 form-group">
                        <label class="control-label">กลุ่มสาระ</label>
                        <select name="inErGroupLearning" id="inErGroupLearning" class="form-control">
                            <option value=''>---เลือกข้อมูล---</option>
                            <?php foreach ($group_learning_list as $r) { ?>                               
                                <option value='<?php echo $r['id'] ?>'><?php echo $r['ed_year'] ?>| <?php echo $r['tb_group_learningcol_name'] ?></option>
                            <?php } ?>
                        </select> 
                    </div>
                    <div class="col-md-2 form-group">
                        <label class="control-label">ภาคเรียนที่</label>
                        <select name="inErTerm" id="inErTerm" class="form-control">
                            <option value='1'>ภาคเรียนที่  1</option>
                            <option value='2'>ภาคเรียนที่ 2</option>
                        </select> 
                    </div>
                    <div class="col-md-2 form-group">
                        <label class="control-label">ปีการศึกษา</label>
                        <input type="number" name="inErYear" id="inErYear" class="form-control" value='<?php echo get_edyear() ?>'/>
                    </div>

                    <div class="col-md-4 form-group">
                        <label class="control-label">เจ้าของผลงาน</label>
                        <input type="text" name="inErOnw" id="inErOnw" class="form-control" value='<?php echo $this->session->userdata('name'); ?>'/>
                    </div>

                    <div class="col-md-4 form-group">
                        <label class="control-label">ไฟล์แนบ</label>
                        <input type="file" name="inErFile" id="inErFile" class="filestyle" />
                    </div>


                    <div class="row">
                        <center><button type="submit" class="btn btn-success btn-insert"><i class="icon-save icon-large"></i> บันทึก</button></center>
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
        var image = $('#inErFile').val();
        var ext1 = $("#inErFile").val().split('.').pop().toLowerCase();

        //
        if ((image != "" && jQuery.inArray(ext1, ['pdf']) == -1)) {
            alert("ไฟล์จะต้องเป็นชนิด pdf เท่านั้น");
            $(":file").filestyle('clear');
            return false;
        }

        $.ajax({
            url: "<?php echo site_url('er-insert'); ?>",
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
