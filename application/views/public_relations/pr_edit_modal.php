<!-- Modal -->
<div id="pr-edit-modal" class="modal fade" role="dialog">
    <div class="modal-dialog" style="width:80%;">
        <div class="modal-content">
            <div class="modal-header" style="background:#0080FF;color:#FFFFFF;">
                <button type="button" class="close" data-dismiss="modal">X</button>
                <h3 class="modal-title" id="title"></h2>
            </div>
            <div class="modal-body" style="padding:30px;">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-10 col-md-offset-1">
                            <form method="post" id="insert-form" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-md-4 form-group">
                                        <label class="control-label">หัวข้อข่าว</label>
                                        <input type="text" name="inPrTopic" id="inPrTopic" class="form-control" autofocus  required=""/>
                                    </div>
                                    <div class="col-md-6 form-group">
                                        <label class="control-label">วันเดือนปีที่ประกาศ</label>
                                        <div class="form-group">
                                            <select name="inPrDay" id="inPrDay" class="my-select" required>
                                                <option value="">--วันที่--</option>
                                                <?php for ($i = 1; $i <= 31; $i++): ?>
                                                    <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                                <?php endfor; ?>
                                            </select>
                                            <?php $arr = array('1' => "มกราคม", "2" => "กุมภาพันธ์", "3" => "มีนาคม", "4" => "เมษายน", "5" => "พฤษภาคม", "6" => "มิถุนายน", "7" => "กรกฎาคม", "8" => "สิงหาคม", "9" => "กันยายน", "10" => "ตุลาคม", "11" => "พฤศจิกายน", "12" => "ธันวาคม"); ?>
                                            <select name="inPrMonth" id="inPrMonth" class="my-select" required>
                                                <option value="">--เดือน--</option>
                                                <?php foreach ($arr as $key => $value): ?>
                                                    <option value="<?php echo $key; ?>"><?php echo $value; ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                            <select name="inPrYear" id="inPrYear" class="my-select" required>
                                                <option value="">--พ.ศ.--</option>
                                                <?php for ($i = 2450; $i <= (date("Y") + 543); $i++): ?>
                                                    <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                                <?php endfor; ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>    
                                <div class="row">
                                    <div class="col-md-12 form-group">
                                        <label class="control-label">เนื้อหา</label>
                                        <textarea id="inPrDetail" name="inPrDetail" style="width:100%;height:100px;"></textarea>
                                    </div>
                                </div>
                                <div class="row">
                                    <center><button type="submit" class="btn btn-success btn-insert"><i class="icon-save icon-large"></i> บันทึกข้อมูล</button></center>
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
            url: "<?php echo site_url('pr-update'); ?>",
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