<!-- Modal -->
<div id="ic-assessment-modal" class="modal fade" role="dialog">
    <div class="modal-dialog" style="width:80%;">
        <div class="modal-content">
            <div class="modal-header" style="background:#0080FF;color:#FFFFFF;">
                <button type="button" class="close" data-dismiss="modal">X</button>
                <h3 class="modal-title" id="title"></h2>
            </div>
            <div class="modal-body" style="padding:30px;">
                <div class="container-fluid">


                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-5">
                                <label class="control-label">content</label>

                            </div>

                            <div class="col-md-6 col-md-offset-1">
                                <textarea id="inTbInternalControlDetail<?php echo $i ?>" name="inTbInternalControlDetail<?php echo $i ?>" style="width:100%;height:100px;"></textarea>

                            </div>
                        </div>



                        <?php for ($i = 1; $i <= 6; $i++) { ?>
                            <div class="row">
                                <div class="col-md-5">
                                    <label class="control-label" id="detail-<?php echo $i ?>">content</label>

                                </div>

                                <div class="col-md-6 col-md-offset-1">
                                    <textarea id="inTbInternalControlDetail<?php echo $i ?>" name="inTbInternalControlDetail<?php echo $i ?>" style="width:100%;height:100px;"></textarea>

                                </div>
                            </div>
                            <br></br>
                        <?php } ?>

                    </div>
                </div>



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
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 form-group">
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
                                <center><button type="submit" class="btn btn-success btn-insert"><i class="icon-save icon-large"></i> บันทึก</button></center>
                            </div>
                            <input type="hidden" name="id" id="id" />
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer" style="background-color:#CEE3F6;">
            <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="icon-power-off"></i></button>
        </div>
    </div>
</div>
</div>
<script>
    $("#insert-form").on("submit", function (e) {
        e.preventDefault();


        $.ajax({
            url: "<?php echo site_url('internal-control-update'); ?>",
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