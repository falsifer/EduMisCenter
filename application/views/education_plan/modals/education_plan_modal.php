<!-- Modal -->
<div id="education-plan-modal" class="modal fade" role="dialog">
    <div class="modal-dialog" style="width:70%;">
        <div class="modal-content">
            <div class="modal-header" style="background:#0080FF;color:#FFFFFF;">
                <button type="button" class="close" data-dismiss="modal">X</button>
                <h3 class="modal-title" id="title"></h2>
            </div>
            <div class="modal-body">
                <form method="post" id="insert-form" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-md-12 form-group">
                            <label class="control-label">ชื่อแผนงานโครงการ</label>
                            <input type="text" name="inMainPlanName" id="inMainPlanName" class="form-control" autofocus required/> 
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 form-group">
                            <label class="control-label">หลักการและเหตุผล</label>
                            <textarea name="inPlanRationalCriterion" id="inPlanRationalCriterion"class='editor' > 
                            </textarea>
                        </div>
                    </div>
                      <div class="row">
                        <div class="form-group col-md-6">
                            <label class="control-label">สอดคล้องยุทธศาสตร์จังหวัด</label>
                            <select name="inProvinceStrategiesId" id="inProvinceStrategiesId" class="form-control" required>
                                <option value="">---เลือกข้อมูล---</option>
                                <?php foreach ($province as $p): ?>
                                    <option value="<?php echo $p['id']; ?>">ยุทธศาสตร์ที่ <?php echo $p['strategic_no']; ?> <?php echo $p['strategic_name']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    
                        <div class="form-group col-md-6">
                            <label class="control-label">สอดคล้องยุทธศาสตร์ อบจ.</label>
                            <select name="inLocalgovStrategiesId" id="inLocalgovStrategiesId" class="form-control" required>
                                <option value="">---เลือกข้อมูล---</option>
                                <?php foreach ($localgov as $l): ?>
                                    <option value="<?php echo $l['id'] ?>">ยุทธศาสตร์ที่ <?php echo $l['localgov_st_no']; ?> <?php echo $l['localgov_st_name']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                          </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label class="control-label">สอดคล้องยุทธศาสตร์ย่อย</label>
                            <select name="inLocalgovSubStId" id="inLocalgovSubStId" class="form-control" required>
                                <option value="">---เลือกข้อมูล---</option>
                                <?php foreach ($sub_st as $st): ?>
                                    <option value="<?php echo $st['id']; ?>"><?php echo $st['sub_st_name']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    
                        <div class="form-group col-md-3">
                            <label class="control-label">ประเภทของแผนงานโครงการ</label>
                            <select name="inPlanTypeId" id="inPlanTypeId" class="form-control" required>
                                <option value="">---เลือกข้อมูล---</option>
                                <?php foreach ($plan_type as $p_type): ?>
                                    <option value="<?php echo $p_type['id']; ?>"><?php echo $p_type['localgov_plan_type']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label class="control-label">ชื่อโครงการ</label>
                            <input type="text" name="inProjectName" id="inProjectName" class="form-control" />
                        </div>
                        <div class="form-group col-md-3">
                            <label class="control-label">ไฟล์ข้อมูลโครงการ</label>
                            <input type="file" name="inProjectFile" id="inProjectFile" class="filestyle" />
                        </div>
                    </div>
                    <div class="row">
                        <center><button type="submibt" class="btn btn-success"><i class="icon-save icon-large"></i> บันทึก</button></center>
                    </div>
                    <input type="hidden" name="id" id="id" />
                </form>
            </div>
            <div class="modal-footer" style="background-color:#CEE3F6;">
                <button type="button" class="btn btn-danger btn-lg" data-dismiss="modal"><i class="icon-power-off"></i></button>
            </div>
        </div>
    </div>
</div>
<script>
    $(".datepicker").datepicker({autoclose: true, language: 'th'});
    $("#insert-form").on("submit", function (e) {
        e.preventDefault();
        $('#inPlanRationalCriterion').html( tinymce.get('inPlanRationalCriterion').getContent() );
        var file = $("#inProjectFile").val();
        var ext = $("#inProjectFile").val().split('.').pop().toLowerCase();
        var uid = $("#id").val();
        if (uid != '') {
            if (file != "") {
                if (jQuery.inArray(ext, ['pdf', 'doc', 'docx', 'xls', 'xlsx']) == -1) {
                    alert("ไฟล์เอกสารจะต้องเป็นชนิด pdf หรือ doc, docx, xls, xlsx เท่านั้น");
                    return false;
                }
            }
        } else {
            if (file == "") {
                alert("ไฟล์เอกสารงานโครงการจะมีค่าว่างไม่ได้");
                return false;
            }
            // 
            if (jQuery.inArray(ext, ['pdf', 'doc', 'docx', 'xls', 'xlsx']) == -1) {
                alert("ไฟล์เอกสารจะต้องเป็นชนิด pdf หรือ doc, docx, xls, xlsx เท่านั้น");
                return false;
            }
            //
        }
        $.ajax({
            url: "<?php echo site_url('insert-education-plan'); ?>",
            method: "post",
//            data: new FormData(this),
//            contentType: false,
//            cache: false,
//            processData: false,
            data: $("#insert-form").serialize(),
            success: function (data) {
                $("#insert-form")[0].reset();
                location.reload();
                alert('บันทึกเรียบร้อย');
            }
        });
    });

    tinymce.init({
        selector: '.editor',
        theme: 'modern',
        height: 200,
        elements : "inPlanRationalCriterion",
    });
</script>