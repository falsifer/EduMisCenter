<!-- Modal -->
<div id="hr-dev-modal" class="modal fade" role="dialog">
    <div class="modal-dialog" style="width:70%;">
        <div class="modal-content">
            <div class="modal-header" style="background:#FB8659;color:#FFFFFF;">
                <button type="button" class="close" data-dismiss="modal">X</button>
                <h3 class="modal-title" id="title"></h2>
            </div>
            <div class="modal-body">
                <form method="post" id="insert-form" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-md-3 form-group">
                            <label class="control-label">วันที่ดำเนินงาน</label>
                            <input type="text" name="inUpgradeDate" id="inUpgradeDate" class="form-control datepicker" data-date-format="yyyy-mm-dd" placeholder="คลิกวันที่..." required=""/>
                        </div>
                        <div class="col-md-5 form-group">
                            <label class="control-label">กิจกรรมหรือโครงการ</label>
                            <input type="text" name="inUpgradeTopic" id="inUpgradeTopic" class="form-control" />
                        </div>
                        <div class="form-group col-md-4">
                            <label class="control-label">ชื่อบุคลากรที่เข้ารับการพัฒนา</label>
                            <select name="inHrName" id="inHrName" class="form-control">
                                <option value="">---เลือกข้อมูล---</option>
                                <?php foreach ($hrrs as $rs): ?>
                                    <option value="<?php echo $rs['id']; ?>"><?php echo $rs['hr_thai_symbol']; ?><?php echo $rs['hr_thai_name']; ?>  <?php echo $rs['hr_thai_lastname']; ?></option>
                                <?php endforeach; ?>  
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-4">
                            <label class="control-label">สถานที่</label>
                            <input type="text" name="inUpgradePlace" id="inUpgradePlace" class="form-control" />
                        </div>
                        <div class="form-group col-md-2">
                            <label class="control-label">ระยะเวลา (วัน)</label>
                            <input type="text" name="inUpgradeDays" id="inUpgradeDays" class="form-control" />
                        </div>
                        <div class="form-group col-md-2">
                            <label class="control-label">จำนวนชั่วโมง</label>
                            <input type="text" name="inUpgradeHour" id="inUpgradeHour" class="form-control" />
                        </div>
                        <div class="form-group col-md-4">
                            <label class="control-label">งบประมาณ (บาท)</label>
                            <input type="text" name="inUpgradeLoan" id="inUpgradeLoan" class="form-control" />
                        </div>

                    </div>
                    <div class="row">
                        <div class="form-group col-md-4">
                            <label class="control-label">หน่วยงานที่จัด</label>
                            <input type="text" name="inUpgradeOwnDepartment" id="inUpgradeOwnDepartment" class="form-control" />
                        </div>
                        <div class="col-md-4 form-group">
                            <label class="control-label">วุฒิบัตร</label>
                            <input type="file" name="inUpgradeReport" id="inUpgradeReport" class="filestyle" />
                        </div>
                    </div>
                    <div class="row" style="margin-top:10px;">
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
    $("#insert-form").on("submit", function (e) {
        e.preventDefault();
        //
//        var project = $("#inUpgradeProject").val();
//        var project_ext = $("#inUpgradeProject").val().split('.').pop().toLowerCase();
//        var report = $("#inUpgradeReport").val();
//        var report_ext = $("#inUpgradeReport").val().split('.').pop().toLowerCase();
//        //
//        if (project != "" && jQuery.inArray(project_ext, ['pdf']) == -1) {
//            alert("เอกสารงานโครงการจะต้องเป็นชนิด pdf เท่านั้น");
//            return false;
//        }
//        //
//        if (report != "" && jQuery.inArray(report_ext, ['pdf']) == -1) {
//            alert("เอกสารงานรายงานสรุปผลจะต้องเป็นชนิด pdf เท่านั้น");
//            return false;
//        }
        //
        $.ajax({
            url: "<?php echo site_url('insert_human_resources_dev'); ?>",
            method: "POST",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            success: function (data) {
                $("#insert-form")[0].reset();
                location.reload();
            }
        });
    });
</script>