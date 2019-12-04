<!-- Modal -->
<div id="dc-kpi-insert-modal" class="modal fade" role="dialog">
    <div class="modal-dialog" style="width:80%;">
        <div class="modal-content">
            <div class="modal-header" style="background:#0080FF;color:#FFFFFF;">
                <button type="button" class="close" data-dismiss="modal">X</button>
                <h3 class="modal-title" id="title">เพิ่มตัวชี้วัด</h2>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <form method="post" id="insert-kpi-form" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-md-4 form-group">
                                    <label class="control-label">กลุ่มสาระ</label>
                                    <select name="inTbKpiGroupLearningId" id="inTbKpiGroupLearningId" class="my-select" onchange="FilterKpi(this)" required>
                                        <option value="">-เลือกข้อมูล-</option>
                                        <?php foreach ($rsGl as $r): ?>
                                            <option value="<?php echo $r['id']; ?>"><?php echo $r['tb_group_learningcol_name']; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="col-md-4 form-group">
                                    <label class="control-label">สาระการเรียนรู้</label>
                                    <select name="inTbKpiGroupLearningItemId" id="inTbKpiGroupLearningItemId" class="my-select" onchange="FilterKpiGL(this)" required>
                                        <option value="">-เลือกข้อมูล-</option>
                                    </select>
                                </div>
                                <div class="col-md-4 form-group">
                                    <label class="control-label">ชั้น</label>
                                    <select name="inSchoolClassId" id="inSchoolClassId" onchange="GenClass(this)"class="my-select" required>
                                        <option value="">-เลือกข้อมูล-</option>
                                        <?php foreach ($rClass as $rowC) { ?>
                                            <option value="<?php echo $rowC['id']; ?>"><?php echo $rowC['tb_ed_school_class_name']; ?>ปีที่ <?php echo $rowC['tb_ed_school_class_level']; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 form-group">
                                    <label class="control-label">มาตรฐาน</label>
                                    <select name="inTbKpiStandardLearningId" id="inTbKpiStandardLearningId" class="my-select" required>
                                        <option value="">-เลือกข้อมูล-</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2 form-group">
                                    <label class="control-label">ชั้น</label>
                                    <input type="text" name="inTbKpiStandardLearningLevel" id="inTbKpiStandardLearningLevel" class="form-control" autofocus  required="" readonly/>
                                </div>
                                <div class="col-md-2 form-group">
                                    <label class="control-label">ลำดับที่</label>
                                    <input type="text" name="inTbKpiStandardLearningSeq" id="inTbKpiStandardLearningSeq" class="form-control" autofocus  required=""/>
                                </div>
                                <div class="col-md-8 form-group">
                                    <label class="control-label">รายละเอียด</label>
                                    <input type="text" name="inTbKpiStandardLearningContent" id="inTbKpiStandardLearningContent" class="form-control" autofocus  required=""/>
                                </div>
                            </div>
                            <div class="row">
                                <input type="hidden" name="kpi_id" id="kpi_id" />
                                <center><button type="submit" class="btn btn-success btn-insert"><i class="icon-save icon-large"></i> บันทึก</button></center>
                            </div>
                        </form>
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
// Chairatto 
    function GenClass(e) {

        var MyValue = e.value;
        var MyReturn = "";
        switch (MyValue) {
            case "4":
                MyReturn = "ม.๑";
                break;
            case "5":
                MyReturn = "ม.๒";
                break;
            case "6":
                MyReturn = "ม.๓";
                break;
            case "7":
                MyReturn = "ม.๔";
                break;
            case "8":
                MyReturn = "ม.๕";
                break;
            case "9":
                MyReturn = "ม.๖";
                break;
            case "10":
                MyReturn = "ป.๑";
                break;
            case "11":
                MyReturn = "ป.๒";
                break;
            case "12":
                MyReturn = "ป.๓";
                break;
            case "13":
                MyReturn = "ป.๔";
                break;
            case "14":
                MyReturn = "ป.๕";
                break;
            case "15":
                MyReturn = "ป.๖";
                break;
        }
//        alert(MyReturn);
        $('#inTbKpiStandardLearningLevel').val(MyReturn);
    }

</script>>
<script>


    $("#insert-kpi-form").on("submit", function (e) {
        e.preventDefault();


        $.ajax({
            url: "<?php echo site_url('dc-insert-3'); ?>",
            method: "post",
            data: new FormData(this),
            cache: false,
            contentType: false,
            processData: false,
            success: function (data) {
                alert("บันทึกข้อมูลสำเร็จ");
                $("#insert-kpi-form")[0].reset();
                location.reload();
            }
        });
    });


    $('#insert-kpi-form').bind('hide', function () {
        $("#insert-kpi-form")[0].reset();
    });




    function FilterKpi(e)
    {
        var gl_id = e.value;
        $.ajax({
            url: "<?php echo site_url('Develop_courses/group_learning_item_list'); ?>",
            method: "post",
            data: {gl_id: gl_id},
            success: function (data) {
                $('#inTbKpiGroupLearningItemId').html(data);
            }
        });
    }

    function FilterKpiGL(e)
    {
        var gli_id = e.value;
        $.ajax({
            url: "<?php echo site_url('Develop_courses/std_item_list'); ?>",
            method: "post",
            data: {gli_id: gli_id},
            success: function (data) {
                $('#inTbKpiStandardLearningId').html(data);
            }
        });
    }
</script>
