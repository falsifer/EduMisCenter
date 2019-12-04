<!-- Modal -->
<div id="er-edit-modal" class="modal fade" role="dialog">
    <div class="modal-dialog" style="width:90%;">
        <div class="modal-content">
            <div class="modal-header" style="background:#0080FF;color:#FFFFFF;">
                <button type="button" class="close" data-dismiss="modal">X</button>
                <h3 class="modal-title" id="title"></h3>
            </div>
            <div class="modal-body" style="padding:30px;">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <form method="post" id="insert-form" enctype="multipart/form-data">
                                <div class="col-md-4 form-group">
                                    <label class="control-label">ชื่องานวิจัย</label>
                                    <input type="text" name="inErName" id="inErName" class="form-control" autofocus  required/>
                                </div>
                                <?php if ($this->session->userdata('department') != "กองการศึกษา") { ?>
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
                                                <option value='<?php echo $r['id'] ?>'><?php echo $r['education_group_name'] ?></option>
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
                                <?php } ?>
                                <div class="col-md-4 form-group">
                                    <label class="control-label">เจ้าของผลงาน</label>
                                    <input type="text" name="inErOnw" id="inErOnw" class="form-control" value='<?php echo $this->session->userdata('name'); ?>' readonly/>
                                </div>

                                <div class="col-md-4 form-group">
                                    <label class="control-label">ไฟล์แนบ</label><font style='color:red;font-size:0.8em;'>* ไฟล์ต้องเป็น .PDF เท่านั้น</font>
                                    <input type="file" name="inErFile" id="inErFile" class="filestyle" />
                                </div>


                                <div class="col-md-12 form-group" style='margin-top:20px;'>
                                    <center>
                                        <button type="submit" class="btn btn-success btn-insert"><i class="icon-save icon-large"></i> บันทึก</button>
                                    </center>
                                </div>
                                <input type='hidden' id='id' name='id' value=''/>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer" style="background-color:#CEE3F6;">
                <!--<button type="button" class="btn btn-danger" data-dismiss="modal"><i class="icon-power-off"></i></button>-->
            </div>
        </div>
    </div>
</div>
<script>
    $("#insert-form").on("submit", function (e) {
        e.preventDefault();

//        var image = $('#inErFile').val();
//        var ext1 = $("#inErFile").val().split('.').pop().toLowerCase();
//
//        //
//        if ((image != "" && jQuery.inArray(ext1, ['pdf']) == -1)) {
//            alert("ไฟล์ภาพจะต้องเป็นชนิด pdf เท่านั้น");
//            $(":file").filestyle('clear');
//            return false;
//        }

        $.ajax({
            url: "<?php echo site_url('Edu_research/er_insert'); ?>",
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