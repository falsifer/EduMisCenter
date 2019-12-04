<!-- Modal -->
<div id="school-director-modal" class="modal fade" role="dialog">
    <div class="modal-dialog" style="width:60%;">
        <div class="modal-content">
            <div class="modal-header" style="background:#0080FF;color:#FFFFFF;">
                <button type="button" class="close" data-dismiss="modal">X</button>
                <h3 class="modal-title" id="title"></h2>
            </div>
            <div class="modal-body">
                <form method="post" id="insert-form" class="form-horizontal" style="padding-top:30px;">
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label class="control-label col-md-3">ชื่อ-นามสกุล</label>
                            <div class="col-md-9">
                                <select name="inHrId" id="inHrId" class="form-control">
                                    <option value="">---เลือกข้อมูล---</option>
                                    <?php foreach ($human as $h): ?>
                                        <option value="<?php echo $h['id']; ?>"><?php echo $h['hr_thai_symbol'] ?><?php echo $h['hr_thai_name']; ?> <?php echo $h['hr_thai_lastname']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6 form-group">
                            <label class="control-label col-md-3">โรงเรียน</label>
                            <div class="col-md-9">
                                <select name="inSchoolId" id="inSchoolId" class="form-control">
                                    <option value="">---เลือกข้อมูล---</option>
                                    <?php foreach ($school as $sc): ?>
                                        <option value="<?php echo $sc['id']; ?>"><?php echo $sc['sc_thai_name']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row" style="margin-top:10px;margin-bottom:10px;">
                        <center><button type="submit" class="btn btn-success btn-insert"><i class="icon-save icon-large"></i> บันทึกข้อมูล</button></center>
                    </div>
                    <input type="hidden" name="id" id="id" />
                </form>
            </div>
            <div class="modal-footer" style="background-color:#CEE3F6;">
                <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="icon-power-off"></i></button>
            </div>
        </div>
    </div>
</div>
<script>
    $(".datepicker").datepicker({autoclose: true, language: 'th'});
    //
    $("#insert-form").on("submit", function (e) {
        e.preventDefault();
        $.ajax({
            url: "<?php echo site_url('insert-school-director'); ?>",
            method: "POST",
            data: $("#insert-form").serialize(),
            success: function (data) {
                $("#insert-form")[0].reset();
                location.reload();
            }
        });
    });
</script>