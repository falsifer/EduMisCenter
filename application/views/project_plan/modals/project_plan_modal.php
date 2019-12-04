<!-- Modal -->
<div id="education-plan-modal" class="modal fade" role="dialog">
    <div class="modal-dialog" style="width:90%;">
        <div class="modal-content">
            <!--            <div class="modal-header" style="background:#060150;color:#FFFFFF;">
                            <button type="button" class="close" data-dismiss="modal">X</button>
                            <h3 class="modal-title" id="title"></h2>
                        </div>-->
            <?php
            $this->load->view('layout/my_school_modal_header');
            ?>
            <div class="modal-body">
                <form method="post" enctype="multipart/form-data" id="insert-plan-form">
                    <div class="row">
                        <div class="col-md-12 form-group">
                            <label class="control-label">ชื่อแผน</label>
                            <select name="inMainPlanName" id="inMainPlanName"  class="form-control" required>
                                <option>----เลือก----</option>
                                <?php
                                foreach ($plan as $p) {
                                    if (($plan_ref != null || $plan_ref != "") && ($plan_ref == $p['tb_project_plan_name'])) {
                                        echo "<option value='" . $p['tb_project_plan_name'] . "' selected>" . $p['tb_project_plan_name'] . "</option>";
                                    } else {
                                        echo "<option value='" . $p['tb_project_plan_name'] . "'>" . $p['tb_project_plan_name'] . "</option>";
                                    }
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 form-group">
                            <label class="control-label">ตั้งเบิกงบ</label>
                            <select name="inProjectPlanBudget" id="inProjectPlanBudget"  class="form-control" required>
                                <option>----เลือก----</option>
                                <?php
                                foreach ($budget as $p) {
                                    echo "<option value='" . $p['tb_acc_income_detail'] . "'>" . $p['tb_acc_income_detail'] . "</option>";
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-12">
                            <label class="control-label">ชื่อโครงการ</label>
                            <input type="text" name="inProjectName" id="inProjectName" class="form-control" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-12">
                            <label class="control-label">หน่วยงานที่รับผิดชอบหลัก</label>
                            <input type="text" name="inResponsible" id="inResponsible" class="form-control" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="icon-calendar"></i> วันที่เริ่มโครงการ</span>
                                <input type="text" name="inProjectStart" id="inProjectStart" autocomplete="off" class="form-control datepicker"  placeholder="คลิกวันที่..."  data-date-language="th-th" data-date-format="yyyy-mm-dd" required/>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="icon-calendar"></i> วันที่สิ้นสุดโครงการ</span>
                                <input type="text" name="inProjectEnd" id="inProjectEnd" autocomplete="off" class="form-control datepicker"  placeholder="คลิกวันที่..."  data-date-language="th-th" data-date-format="yyyy-mm-dd" required/>
                            </div>
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
                            <label class="control-label">สอดคล้องยุทธศาสตร์กอง/สำนักการศึกษาฯ</label>
                            <select name="inEducationStId" id="inEducationStId" class="form-control">
                                <option value="">---เลือกข้อมูล---</option>
                                <?php foreach ($edu_st as $p): ?>
                                    <option value="<?php echo $p['id']; ?>">ยุทธศาสตร์ที่ <?php echo $p['education_st_no']; ?> <?php echo $p['education_st_name']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="form-group col-md-6">
                            <label class="control-label">สอดคล้องยุทธศาสตร์โรงเรียน</label>
                            <select name="inSchoolStId" id="inSchoolStId" class="form-control" >
                                <option value="">---เลือกข้อมูล---</option>
                                <?php foreach ($school_st as $st): ?>
                                    <option value="<?php echo $st['id']; ?>">ยุทธศาสตร์ที่ <?php echo $st['school_strategic_no']; ?> <?php echo $st['school_strategic_name']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="form-group col-md-6">
                            <label class="control-label">ประเภทของแผนงานโครงการ</label>
                            <select name="inPlanTypeId" id="inPlanTypeId" class="form-control" >
                                <option value="">---เลือกข้อมูล---</option>
                                <?php foreach ($division as $p_type): ?>
                                    <option value="<?php echo $p_type['id']; ?>"><?php echo $p_type['tb_division_name']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>


                        <div class="form-group col-md-6">
                            <label class="control-label">ไฟล์ข้อมูลโครงการ</label>
                            <input type="file" name="inProjectFile" id="inProjectFile" class="filestyle" />
                        </div>
                    </div>
                    <div class="row">
                        <center><button type="submit" class="btn btn-success"><i class="icon-save icon-large"></i> บันทึก</button></center>
                    </div>
                    <input type="hidden" name="id" id="id" />
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    $(".datepicker").datepicker({autoclose: true, language: 'th-th'});
    $("#insert-plan-form").on("submit", function (e) {
//        e.preventDefault();
        $('#inPlanRationalCriterion').html(tinymce.get('inPlanRationalCriterion').getContent());

        $.ajax({
            url: "<?php echo site_url('ProjectPlan/insert_project_plan'); ?>",
            method: "post",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
//            data: $("#insert-plan-form").serialize(),
            success: function (data) {
//                alert(data);
//                $("#insert-plan-form")[0].reset();
                alert('บันทึกเรียบร้อย');
                location.reload();

            }
        });
    });

//    tinymce.init({
//        selector: '.editor',
//        theme: 'modern',
//        height: 200,
//        elements : "inPlanRationalCriterion",
//    });
</script>