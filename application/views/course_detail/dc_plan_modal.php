<!-- Modal -->
<div id="dc-plan-modal" class="modal fade" style="overflow: auto; " role="dialog">
    <div class="modal-dialog" style="width:80%;">
        <div class="modal-content">
            <div class="modal-header" style="background:#0080FF;color:#FFFFFF;">
                <button type="button" class="close " data-dismiss="modal">X</button>
                <h3 class="modal-title" id="title"></h3>
            </div>
            <div class="modal-body" style="padding:30px;">
                <div class="container-fluid">
                    <form method="post" id="plan-modal-insert-form" enctype="multipart/form-data">
                        <input type="hidden" name="UnitIdforPlan" id="UnitIdforPlan" value="" class="form-control" />
                        <div class="row"> 
                            <div class="col-md-12  form-group">
                                <h3 id="Headplan"></h3>
                            </div>
                            <div class="col-md-12 col-md-offset-1 form-group">
                                <h4 id="HeadplanSub"></h4>
                            </div>
                        </div>
                        <div id="dashboardTAB" class="row"> 
                            <ul class="nav nav-tabs">
                                <li class="active">
                                    <a  href="#tab1" data-toggle="tab" data-id="1">
                                        <b>แผนการสอน(ตั้งต้น)</b>
                                    </a>
                                </li>
                                <li>
                                    <a href="#tab5" data-toggle="tab" data-id="5">
                                        <b>การวัดผลประเมินผล</b>
                                    </a>
                                </li>
                                <li>
                                    <a href="#tab6" data-toggle="tab" data-id="6">
                                        <b>สื่อ/แหล่งเรียนรู้ที่ใช้</b>
                                    </a>
                                </li>
                                <li id="tabProcess">

                                </li>
                                <li id="tabOther">

                                </li>
                                <li id="tabFile">

                                </li>
                            </ul>

                            <div class="tab-content">
                                <div class="tab-pane active" id="tab1" style="padding-top:10px;">                                
                                    <div class="col-md-12">
                                        <div class="row">
                                            <div class="col-md-12" >
                                                <div class="row">
                                                    <div class="col-md-2 form-group">
                                                        <label class="control-label">ลำดับที่</label>
                                                        <select name="inPlanSequence" id="inPlanSequence" class="form-control" >
                                                            <?php $hour = 10; ?>
                                                            <?php for ($i = 1; $i <= $hour; $i++) { ?>
                                                                <option value=<?php echo $i; ?>>ลำดับที่ <?php echo $i; ?></option>                                                    
                                                            <?php } ?>
                                                        </select>
                                                    </div>                                                    

                                                    <div class="col-md-2 form-group">
                                                        <label class="control-label">ตัวชี้วัดที่ใช้</label>
                                                        <select name="inPlanKpi" id="inPlanKpi" class="form-control" >
                                                        </select>
                                                    </div>
                                                    <div class="col-md-2 form-group">
                                                        <label class="control-label">จำนวนชั่วโมง</label>
                                                        <select name="inPlanHour" id="inPlanHour" class="form-control" required>                                                         
                                                        </select>
                                                    </div>
                                                    <div class="col-md-3 form-group">
                                                        <label class="control-label">สิทธ์การมองเห็น</label>
                                                        <select name="inPlanPermission" id="inPlanPermission" class="form-control" required>
                                                            <option value="Private">มองเห็นคนเดียว</option> 
                                                            <option value="School">ภายในโรงเรียนมองเห็น</option>   
                                                            <option value="Public">ทุกคนมองเห็น</option> 
                                                        </select>
                                                    </div>
                                                    <div class="col-md-3 form-group">
                                                        <label class="control-label">สถานะ</label>
                                                        <select name="inPlanStatus" id="inPlanStatus" class="form-control"  >
                                                            <option value="W">ยังไม่อนุมัติ</option>  
                                                            <option value="S">อนุมัติ</option>                                                            
                                                        </select>
                                                    </div>

                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12  form-group">
                                                        <label class="control-label">ชื่อแผนการสอน</label>
                                                        <input type="text" name="inPlanName" id="inPlanName" class="form-control" required/>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12  form-group">
                                                        <label class="control-label">สาระสำคัญ</label>                                                        
                                                        <textarea class="form-control" name="inEssence" id="inEssence" ></textarea>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12  form-group">
                                                        <label class="control-label">จุดประสงค์</label>
                                                        <textarea class="form-control" name="inPurpose" id="inPurpose" ></textarea>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12 form-group">
                                                        <label class="control-label">สาระการเรียนรู้</label>
                                                        <textarea class="form-control" name="inLearning" id="inLearning" ></textarea>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12 form-group">
                                                        <label class="control-label">ผลการเรียนรู้ที่คาดหวัง</label>
                                                        <textarea class="form-control" name="inExpect" id="inExpect" ></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>   

                                <div class="tab-pane" id="tab2" style="padding-top:10px;">

                                    <div class="col-md-12">
                                        <div class="row">
                                            <div class="col-md-2  form-group">
                                                <label class="control-label">ลำดับที่</label>
                                                <select name="inProcessSequence" id="inProcessSequence" class="form-control" >
                                                    <?php $hour = 10; ?>
                                                    <?php for ($i = 1; $i <= $hour; $i++) { ?>
                                                        <option value=<?php echo $i; ?>>ลำดับที่ <?php echo $i; ?></option>                                                    
                                                    <?php } ?>
                                                </select>
                                            </div>

                                            <div class="col-md-9  form-group">
                                                <label class="control-label">กระบวนการจัดการเรียนรู้</label>
                                                <input type="text" name="inProcessContent" id="inProcessContent" class="form-control" />
                                            </div>

                                            <div class="col-md-1  form-group">
                                                <font color="red">* </font>
                                                <button type="button" class="btn btn-info btn-insert-process"><i class="icon-plus icon-large"></i> บันทึก</button>
                                            </div>
                                            <input type="hidden" name="inProcessId" id="inProcessId" class="form-control" />
                                        </div>
                                        <br></br>
                                        <div class="row" id="ProcessListBody">
                                            <table class="table table-hover table-striped table-bordered display" >
                                                <thead>
                                                    <tr>
                                                        <th style="text-align: center; width:10%" >ลำดับที่</th>
                                                        <th style="text-align: center; width:70%" class="no-sort">กระบวนการ</th>
                                                        <th style="text-align: center; width:20%" class="no-sort">จัดการ</th>
                                                    </tr>
                                                </thead>

                                                <tbody >
                                                    <tr>
                                                        <td style="text-align: center;">1</td>
                                                        <td style="text-align: center;">Content</td>
                                                        <td style="text-align: center;">
                                                            <button type="button" class="btn btn-warning btn-edit-process"><i class="icon-pencil icon-large"></i> แก้ไข</button>
                                                            <button type="button" class="btn btn-danger btn-delete-process"><i class="icon-trash icon-large"></i> ลบ</button>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>

                                </div>

                                <div class="tab-pane" id="tab3" style="padding-top:10px;">
                                    <div class="col-md-12">
                                        <div class="row" id="OtherListBody">
                                            <table class="table table-hover table-striped table-bordered display" id="example">
                                                <thead>
                                                    <tr>
                                                        <th style="text-align: center; width:80%" class="no-sort">เนื้อหา</th>
                                                        <th style="text-align: center; width:20%" class="no-sort">จัดการ</th>
                                                    </tr>
                                                </thead>

                                                <tbody>

                                                    <tr>
                                                        <td colspan="2"><b><font color="blue">&nbsp; สมรรถนะผู้เรียน</font></b></td>
                                                    </tr>
                                                    <tr>
                                                        <td style="text-align: left;"><font color="blue">1. Content</font></td>
                                                        <td style="text-align: center;">
                                                            <button type="button" class="btn btn-success btn-check"><i class="icon-ok icon-large"></i> ใช้งาน</button>
                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <td colspan="2"><b><font color="green">&nbsp; คุณลักษณะอันพึงประสงค์</font></b></td>
                                                    </tr>
                                                    <tr>
                                                        <td style="text-align: left;"><font color="green">1. Content</font></td>
                                                        <td style="text-align: center;">
                                                            <button type="button" class="btn btn-success btn-check"><i class="icon-ok icon-large"></i> ใช้งาน</button>
                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <td colspan="2"><b><font color="brown">&nbsp; อ่านคิดวิเคราะห์เขียน</font></b></td>
                                                    </tr>
                                                    <tr>
                                                        <td style="text-align: left;"><font color="brown">1. Content</font></td>
                                                        <td style="text-align: center;">
                                                            <button type="button" class="btn btn-success btn-check"><i class="icon-ok icon-large"></i> ใช้งาน</button>
                                                        </td>
                                                    </tr>

                                                </tbody>
                                            </table>
                                        </div>

                                    </div>
                                </div>

                                <div class="tab-pane" id="tab4" style="padding-top:10px;">
                                    <div class="col-md-12">

                                        <div class="row" >

                                            <div class="col-md-4 form-group">
                                                <label class="control-label">อัพโหลดเอกสาร</label>
                                                <input type="file" name="inDocumentFile" id="inDocumentFile" class="filestyle" />
                                            </div>

                                            <div class="col-md-2  form-group">
                                                <label class="control-label">ประเภทเอกสาร</label>
                                                <select name="inDocumentType" id="inDocumentType" class="form-control" >
                                                    <option value="">----เลือกข้อมูล----</option>   
                                                    <option value="Test">แบบทดสอบ</option>         
                                                    <option value="Sheet">ใบงาน</option>  
                                                </select>
                                            </div>

                                            <div class="col-md-5  form-group">
                                                <label class="control-label">หมายเหตุ</label>
                                                <input type="text" name="inDocumentNote" id="inDocumentNote" class="form-control" />
                                            </div>
                                            <div class="col-md-1  form-group">
                                                <font color="red">* </font>
                                                <button type="button" class="btn btn-info btn-insert-file"><i class="icon-plus icon-large"></i> เพิ่ม</button>
                                            </div>
                                        </div>
                                        <div class="row" id="DocListBody">
                                            <table class="table table-hover table-striped table-bordered display" id="example">
                                                <thead>
                                                    <tr>
                                                        <th style="text-align: center; width:10%" class="no-sort">ลำดับที่</th>
                                                        <th style="text-align: center; width:20%" class="no-sort">เอกสาร</th>
                                                        <th style="text-align: center; width:20%" class="no-sort">ประเภทเอกสาร</th>
                                                        <th style="text-align: center; width:30%" class="no-sort">หมายเหตุ</th>
                                                        <th style="text-align: center; width:20%" class="no-sort">จัดการ</th>
                                                    </tr>
                                                </thead>

                                                <tbody>
                                                    <tr>
                                                        <td style="text-align: center;">1</td>
                                                        <td style="text-align: center;"></td>
                                                        <td style="text-align: center;">แบบทดสอบ</td>
                                                        <td style="text-align: center;">หมายเหตุบลาๆๆๆ</td>
                                                        <td style="text-align: center;">
                                                            <button type="button" class="btn btn-danger btn-upload-file"><i class="icon-trash icon-large"></i> ลบ</button>
                                                        </td>
                                                    </tr>

                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>


                                <div class="tab-pane" id="tab5" style="padding-top:10px;">
                                    <div class="col-md-12">
                                        <div class="row">
                                            <div class="row">
                                                <div class="col-md-12 form-group">
                                                    <label class="control-label">วิธีการวัด</label>
                                                    <textarea class="form-control" name="inEvaluateMethod" id="inEvaluateMethod" ></textarea>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12 form-group">
                                                    <label class="control-label">เครื่องมือการวัดผลและประเมินผล</label>
                                                    <textarea class="form-control" name="inEvaluateTool" id="inEvaluateTool" ></textarea>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12 form-group">
                                                    <label class="control-label">เกณฑ์การวัดผลประเมินผล</label>
                                                    <textarea class="form-control" name="inEvaluateCriterion" id="inEvaluateCriterion" ></textarea>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                                <div class="tab-pane" id="tab6" style="padding-top:10px;">
                                    <div class="col-md-12">
                                        <div class="row">
                                            <div class="col-md-12 form-group">
                                                <label class="control-label">สื่อการเรียนรู้</label>
                                                <textarea class="form-control" name="inMedia" id="inMedia" ></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <input type="hidden" name="inPlanId" id="inPlanId" class="form-control" />

                        <div class="row">
                            <center><button type="submit" class="btn btn-success btn-insert"><i class="icon-save icon-large"></i> บันทึกข้อมูล</button></center>
                        </div>

                        <br></br>
                        <div class="row" id="PlanListBody">

                        </div>

                    </form>
                </div>
            </div>
        </div>

    </div>
</div>

<?php $this->load->view("dc/dc_plan_result_modal"); ?>
<script>
    var MyPlanId = 0;
//---- update or insert
    $("#plan-modal-insert-form").on("submit", function (e) {
        e.preventDefault();
        $MyStatus = $("#inPlanId").val();
        if ($MyStatus == "") {
            $.ajax({
                url: "<?php echo site_url('Dc/insert_plan'); ?>",
                method: "post",
                data: new FormData(this),
                cache: false,
                contentType: false,
                processData: false,
                success: function (data) {
                    alert("บันทึกข้อมูลสำเร็จ");
                    $("#plan-modal-insert-form")[0].reset();
                    location.reload();
                }
            });
        } else {
            $.ajax({
                url: "<?php echo site_url('Dc/update_plan'); ?>",
                method: "post",
                data: new FormData(this),
                cache: false,
                contentType: false,
                processData: false,
                success: function (data) {
                    alert("บันทึกข้อมูลสำเร็จ");
                    $("#plan-modal-insert-form")[0].reset();
                    location.reload();
                }
            });
        }

    });

    //--- สรุปแผนการสอน
    $("#PlanListBody").on("click", ".btn-plan-result", function () {
        var uid = $(this).attr('id');
        $.ajax({
            url: "<?php echo site_url('Dc/get_result_plan'); ?>",
            method: "post",
            data: {id: uid},
            success: function (data) {
                
                $("#result-modal-insert-form").html(data);
                $('#MySchoolAreaId').val("result-modal-insert-form");
                //$("#HeadPlanResult").html("<b>กลุ่มสาระ : " + ugrouplearningname + " วิชา : " + uhead + " | ระดับชั้น" + uclss + " ปีที่ " + ulev + "</br>");
                //$("#HeadPlanResultSub").html("<b>หน่วยที่ : " + ugrouplearningname + " เรื่อง : " + uhead + " เวลาเรียน : " + uhead + " ชั่วโมง | แผนการเรียนรู้ที่" + uclss + " เรื่อง " + ulev + " เวลาเรียน : " + uhead + " ชั่วโมง</br>");
                $("#dc-plan-modal").modal("hide");
                $("#dc-plan-result-modal").modal("show");
            }
        });


    });

    //--- ลบแผนการสอน
    $("#PlanListBody").on("click", ".btn-plan-delete", function () {
        var status = confirm('ต้องการลบข้อมูลนี้จริงหรือไม่ ?');
        if (status) {
            $.ajax({
                url: "<?php echo site_url('Dc/delete_plan'); ?>",
                method: 'post',
                success: function (data) {
                    $("#plan-modal-insert-form")[0].reset();
                    location.reload();
                }
            });
        }
    });
    //----- แก้ไขแผนการสอน
    $("#PlanListBody").on("click", ".btn-plan-edit", function () {
        var uid = $(this).attr('id');
        var UnitId = $("#UnitIdforPlan").val();
        var PlanHour = 0;
        $.ajax({
            url: "<?php echo site_url('Dc/edit_plan_list'); ?>",
            method: "post",
            data: {id: uid},
            dataType: "json",
            success: function (data) {
                //--- คำนวณจำนวนชั่วโมงที่เหลือใหม่
                MyUnitId = data.tb_unit_learning_id;
                MyPlanId = data.PlanId;

                $("#inPlanId").val(data.PlanId);
                $("#inPlanSequence").val(data.tb_lesson_plan_sequence);
                $("#inPlanKpi").val(data.tb_kpi_standard_learning_id);

                $("#inPlanPermission").val(data.tb_lesson_plan_permission);
                $("#inPlanStatus").val(data.tb_lesson_plan_status);
                $("#inPlanName").val(data.tb_lesson_plan_name);
                $("#inEssence").val(data.tb_lesson_plan_essence_content);
                $("#inPurpose").val(data.tb_lesson_plan_purpose_content);
                $("#inLearning").val(data.tb_lesson_plan_learning_content);
                $("#inExpect").val(data.tb_lesson_plan_expect_content);
                $("#inEvaluateMethod").val(data.tb_lesson_plan_evaluate_method_content);
                $("#inEvaluateTool").val(data.tb_lesson_plan_evaluate_tool_content);
                $("#inEvaluateCriterion").val(data.tb_lesson_plan_evaluate_criterion_content);
                $("#inMedia").val(data.tb_lesson_plan_media_content);

                PlanHour = data.tb_lesson_plan_hour;

                if ($("#inPlanStatus").val() == "S") {
                    $.ajax({
                        url: "<?php echo site_url('Dc/get_plan_edit_hour_list'); ?>",
                        method: "post",
                        data: {UnitId: MyUnitId, MyPlanId: MyPlanId},
                        success: function (data) {
                            $("#inPlanHour").html(data);
                            $("#inPlanHour").val(PlanHour);
                        }
                    });
                } else {
                    $.ajax({
                        url: "<?php echo site_url('Dc/get_plan_hour_list'); ?>",
                        method: "post",
                        data: {id: MyUnitId},
                        success: function (data) {
                            $("#inPlanHour").html(data);
                            $("#inPlanHour").val(PlanHour);
                        }
                    });
                }

            }
        });

        $('#tabProcess').html("<a  href=\"#tab2\" data-toggle=\"tab\" data-id=\"2\" ><b>กระบวนการจัดการเรียนรู้</b></a>");
        $('#tabOther').html("<a  href=\"#tab3\" data-toggle=\"tab\" data-id=\"3\" ><b>อื่นๆ</b></a>");
        $('#tabFile').html("<a  href=\"#tab4\" data-toggle=\"tab\" data-id=\"4\" ><b>เอกสารแนบ</b></a>");



        //--- Gen Table Process เรียกข้อมูลกระบวนการทำงานออกมาโชว์
        $.ajax({
            url: "<?php echo site_url('Dc/get_process_list'); ?>",
            method: "post",
            data: {id: uid},
            success: function (data) {
                $('#ProcessListBody').html(data);
            }
        });
        //--- Gen Table doc เรียกตารางข้อมูลเอกสาร
        $.ajax({
            url: "<?php echo site_url('Dc/get_doc_list'); ?>",
            method: "post",
            data: {id: uid},
            success: function (data) {
                $('#DocListBody').html(data);
            }
        });
        //--- Gen Table Other เรียกตารางข้อมูล คุณลักษณะ อ่านคิดวิเคราะห์เขียน สมรรถนะ
        $.ajax({
            url: "<?php echo site_url('Dc/get_other_list'); ?>",
            method: "post",
            data: {id: uid},
            success: function (data) {
                $('#OtherListBody').html(data);
            }
        });

    });

    //----- คัดลอกแผนการสอน
    $("#PlanListBody").on("click", ".btn-plan-copy", function () {
        var uid = $(this).attr('id');
        $.ajax({
            url: "<?php echo site_url('Dc/edit_plan_list'); ?>",
            method: "post",
            data: {id: uid},
            dataType: "json",
            success: function (data) {
                $("#inPlanId").val("");
                $("#inPlanSequence").val(data.tb_lesson_plan_sequence);
                $("#inPlanKpi").val(data.tb_kpi_standard_learning_id);
                $("#inPlanHour").val(data.tb_lesson_plan_hour);
                $("#inPlanPermission").val(data.tb_lesson_plan_permission);
                $("#inPlanStatus").val(data.tb_lesson_plan_status);
                $("#inPlanName").val(data.tb_lesson_plan_name);
                $("#inEssence").val(data.tb_lesson_plan_essence_content);
                $("#inPurpose").val(data.tb_lesson_plan_purpose_content);
                $("#inLearning").val(data.tb_lesson_plan_learning_content);
                $("#inExpect").val(data.tb_lesson_plan_expect_content);
                $("#inEvaluateMethod").val(data.tb_lesson_plan_evaluate_method_content);
                $("#inEvaluateTool").val(data.tb_lesson_plan_evaluate_tool_content);
                $("#inEvaluateCriterion").val(data.tb_lesson_plan_evaluate_criterion_content);
                $("#inMedia").val(data.tb_lesson_plan_media_content);
            }
        });
    });
    //--- insert process บันทึกกระบวนการ
    $("#plan-modal-insert-form").on("click", ".btn-insert-process", function () {

        var MyContent = $("#inProcessContent").val();
        var MySequence = $("#inProcessSequence").val();
        var ProcessId = $("#inProcessId").val();
        $.ajax({
            url: "<?php echo site_url('Dc/insert_process'); ?>",
            method: "post",
            data: {PlanId: MyPlanId, MyContent: MyContent, MySequence: MySequence, ProcessId: ProcessId},
            success: function (data) {
                alert("บันทึกข้อมูลสำเร็จ");
                //--- ลบเสร็จโหลดข้อมูลใหม่
                $.ajax({
                    url: "<?php echo site_url('Dc/get_process_list'); ?>",
                    method: "post",
                    data: {id: MyPlanId},
                    success: function (data) {
                        $("#inProcessSequence").val("");
                        $("#inProcessContent").val("");
                        $('#ProcessListBody').html(data);
                    }
                });
            }
        });
    });
    //----- แก้ไขกระบวนการ
    $("#plan-modal-insert-form").on("click", ".btn-process-edit", function () {
        var uid = $(this).attr('id');
        $.ajax({
            url: "<?php echo site_url('Dc/edit_process_list'); ?>",
            method: "post",
            data: {id: uid},
            dataType: "json",
            success: function (data) {
                $("#inProcessId").val(data.id);
                $("#inProcessSequence").val(data.tb_lesson_plan_process_sequence);
                $("#inProcessContent").val(data.tb_lesson_plan_process_content);
            }
        });
    });
    //----- ลบกระบวนการ
    $("#plan-modal-insert-form").on("click", ".btn-process-delete", function () {
        var uid = $(this).attr('id');
        var status = confirm('ต้องการลบข้อมูลนี้จริงหรือไม่ ?');
        if (status) {
            $.ajax({
                url: "<?php echo site_url('Dc/delete_process_list'); ?>",
                method: "post",
                data: {id: uid},
                success: function (data) {
                    //--- ลบเสร็จโหลดข้อมูลใหม่
                    $.ajax({
                        url: "<?php echo site_url('Dc/get_process_list'); ?>",
                        method: "post",
                        data: {id: MyPlanId},
                        success: function (data) {
                            $("#inProcessSequence").val("");
                            $("#inProcessContent").val("");
                            $('#ProcessListBody').html(data);
                        }
                    });
                }
            });
        }
    });
    $("#plan-modal-insert-form").on("click", ".btn-insert-file", function (e) {
        e.preventDefault();
        if ($('#inDocumentFile').val() != "") {
            $.ajax({
                url: "<?php echo site_url('Dc/insert_file'); ?>",
                data: new FormData($("#plan-modal-insert-form")),
                cache: false,
                contentType: false,
                processData: false,
//                method: "post",
//                data: $("#plan-modal-insert-form").serialize(),
                success: function (data) {

                    $("#inDocumentFile").val("");
                    $("#inDocumentType").val("");
                    $("#inDocumentNote").val("");
                    alert("อัพโหลดสำเร็จ");
                    //--- Gen Table doc เรียกตารางข้อมูลเอกสาร
                    $.ajax({
                        url: "<?php echo site_url('Dc/get_doc_list'); ?>",
                        method: "post",
                        data: {id: MyPlanId},
                        success: function (data) {
                            $('#DocListBody').html(data);
                        }
                    });
                }
            });
        }
    });
    //----- ลบกระบวนการ
    $("#plan-modal-insert-form").on("click", ".btn-doc-delete", function () {
        var uid = $(this).attr('id');
        var status = confirm('ต้องการลบข้อมูลนี้จริงหรือไม่ ?');
        if (status) {
            $.ajax({
                url: "<?php echo site_url('Dc/delete_doc_list'); ?>",
                method: "post",
                data: {id: uid},
                success: function (data) {
                    //--- Gen Table doc เรียกตารางข้อมูลเอกสาร
                    $.ajax({
                        url: "<?php echo site_url('Dc/get_doc_list'); ?>",
                        method: "post",
                        data: {id: MyPlanId},
                        success: function (data) {
                            $('#DocListBody').html(data);
                        }
                    });
                }
            });
        }
    });
    //----- เลือกอ่านคิดวิเคราะห์เขียน(1)
    $("#plan-modal-insert-form").on("click", ".btn-rwa-uncheck", function () {
        var uid = $(this).attr('id');
        $.ajax({
            url: "<?php echo site_url('Dc/rwa_insert'); ?>",
            method: "post",
            data: {MyId: uid, PlanId: MyPlanId},
            success: function (data) {
                //--- Gen Table Other เรียกตารางข้อมูล คุณลักษณะ อ่านคิดวิเคราะห์เขียน สมรรถนะ
                $.ajax({
                    url: "<?php echo site_url('Dc/get_other_list'); ?>",
                    method: "post",
                    data: {id: MyPlanId},
                    success: function (data) {
                        $('#OtherListBody').html(data);
                    }
                });
            }
        });
    });
    //----- ยกเลิกเลือกอ่านคิดวิเคราะห์เขียน(1)
    $("#plan-modal-insert-form").on("click", ".btn-rwa-check", function () {
        var uid = $(this).attr('id');
        $.ajax({
            url: "<?php echo site_url('Dc/rwa_delete'); ?>",
            method: "post",
            data: {id: uid},
            success: function (data) {
                //--- Gen Table Other เรียกตารางข้อมูล คุณลักษณะ อ่านคิดวิเคราะห์เขียน สมรรถนะ
                $.ajax({
                    url: "<?php echo site_url('Dc/get_other_list'); ?>",
                    method: "post",
                    data: {id: MyPlanId},
                    success: function (data) {
                        $('#OtherListBody').html(data);
                    }
                });
            }
        });
    });
    //----- เลือกคุณลักษณะอันพึงประสงค์(2)
    $("#plan-modal-insert-form").on("click", ".btn-cha-uncheck", function () {
        var uid = $(this).attr('id');
        $.ajax({
            url: "<?php echo site_url('Dc/cha_insert'); ?>",
            method: "post",
            data: {MyId: uid, PlanId: MyPlanId},
            success: function (data) {
                //--- Gen Table Other เรียกตารางข้อมูล คุณลักษณะ อ่านคิดวิเคราะห์เขียน สมรรถนะ
                $.ajax({
                    url: "<?php echo site_url('Dc/get_other_list'); ?>",
                    method: "post",
                    data: {id: MyPlanId},
                    success: function (data) {
                        $('#OtherListBody').html(data);
                    }
                });
            }
        });
    });
    //----- ยกเลิกเลือกคุณลักษณะอันพึงประสงค์(2)
    $("#plan-modal-insert-form").on("click", ".btn-cha-check", function () {
        var uid = $(this).attr('id');
        $.ajax({
            url: "<?php echo site_url('Dc/cha_delete'); ?>",
            method: "post",
            data: {id: uid},
            success: function (data) {
                //--- Gen Table Other เรียกตารางข้อมูล คุณลักษณะ อ่านคิดวิเคราะห์เขียน สมรรถนะ
                $.ajax({
                    url: "<?php echo site_url('Dc/get_other_list'); ?>",
                    method: "post",
                    data: {id: MyPlanId},
                    success: function (data) {
                        $('#OtherListBody').html(data);
                    }
                });
            }
        });
    });
    //----- เลือกสมรรถนะผู้เรียน(3)
    $("#plan-modal-insert-form").on("click", ".btn-cap-uncheck", function () {
        var uid = $(this).attr('id');
        $.ajax({
            url: "<?php echo site_url('Dc/cap_insert'); ?>",
            method: "post",
            data: {MyId: uid, PlanId: MyPlanId},
            success: function (data) {
                //--- Gen Table Other เรียกตารางข้อมูล คุณลักษณะ อ่านคิดวิเคราะห์เขียน สมรรถนะ
                $.ajax({
                    url: "<?php echo site_url('Dc/get_other_list'); ?>",
                    method: "post",
                    data: {id: MyPlanId},
                    success: function (data) {
                        $('#OtherListBody').html(data);
                    }
                });
            }
        });
    });
    //----- ยกเลิกสมรรถนะผู้เรียน(3)
    $("#plan-modal-insert-form").on("click", ".btn-cap-check", function () {
        var uid = $(this).attr('id');
        $.ajax({
            url: "<?php echo site_url('Dc/cap_delete'); ?>",
            method: "post",
            data: {id: uid},
            success: function (data) {
                //--- Gen Table Other เรียกตารางข้อมูล คุณลักษณะ อ่านคิดวิเคราะห์เขียน สมรรถนะ
                $.ajax({
                    url: "<?php echo site_url('Dc/get_other_list'); ?>",
                    method: "post",
                    data: {id: MyPlanId},
                    success: function (data) {
                        $('#OtherListBody').html(data);
                    }
                });
            }
        });
    });

</script>