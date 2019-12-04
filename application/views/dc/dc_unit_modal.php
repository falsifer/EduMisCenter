<!-- Modal -->
<div id="dc-unit-modal" class="modal fade" role="dialog">
    <div class="modal-dialog" style="width:80%;">
        <div class="modal-content">
            <div class="modal-header" style="background:#0080FF;color:#FFFFFF;">
                <button type="button" class="close" data-dismiss="modal">X</button>
                <h3 class="modal-title" id="title"></h3>
            </div>
            <div class="modal-body" style="padding:30px;">

                <div class="container-fluid">
                    <form method="post" id="unit-modal-insert-form" enctype="multipart/form-data">
                        <div class="row">                                    
                            <b id="HeadUnit"></b>
                            <br></br>
                            <input type="hidden" name="insertID" id="insertID" value="" class="form-control" />
                            <input type="hidden" name="Cls" id="Cls" value="" class="form-control" />
                            <input type="hidden" name="Lev" id="Lev" value="" class="form-control" />
                        </div>
                        <div class="row">
                            <div class="col-md-6" id="RecordBody">
                                <b>เนื้อหาของหน่วย</b>
                                <br></br>
                                <div class="row">
                                    <div class="col-md-12 form-group">
                                        <label class="control-label">ชื่อหน่วยการเรียนรู้</label>
                                        <input type="text" name="inName" id="inName" class="form-control" required/>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 form-group">
                                        <label class="control-label">ลำดับหน่วยการเรียนรู้</label>
                                        <select name="inSequence" id="inSequence" class="form-control" required>
                                            <option value="1">หน่วยการเรียนรู้ที่ 1</option>
                                            <option value="2">หน่วยการเรียนรู้ที่ 2</option>
                                            <option value="3">หน่วยการเรียนรู้ที่ 3</option>
                                            <option value="4">หน่วยการเรียนรู้ที่ 4</option>
                                            <option value="5">หน่วยการเรียนรู้ที่ 5</option>
                                            <option value="6">หน่วยการเรียนรู้ที่ 6</option>
                                            <option value="7">หน่วยการเรียนรู้ที่ 7</option>
                                            <option value="8">หน่วยการเรียนรู้ที่ 8</option>
                                            <option value="9">หน่วยการเรียนรู้ที่ 9</option>
                                            <option value="10">หน่วยการเรียนรู้ที่ 10</option>
                                        </select>
                                    </div>
                                    <div class="col-md-3 form-group">
                                        <label class="control-label">เวลา(ชั่วโมง)</label>
                                        <input type="text" name="inHour" id="inHour" class="form-control" required/>
                                    </div>
                                    <div class="col-md-3 form-group">
                                        <label class="control-label">คะแนน</label>
                                        <input type="text" name="inScore" id="inScore" class="form-control" required/>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 form-group">
                                        <label class="control-label">สาระสำคัญ</label>
                                        <textarea class="form-control" name="inContent" id="inContent" ></textarea>
                                    </div>
                                </div>
                                <input type="hidden" name="UnitId" id="UnitId"  />
                                <div class="row">
                                    <center><button type="submit" class="btn btn-success btn-insert"><i class="icon-save icon-large"></i> บันทึกข้อมูล</button></center>
                                </div>
                            </div>

                            <div class="col-md-5 col-md-offset-1"  id="RecordBody">
                                <div class="row">
                                    <b>มาตรฐาน(ตัวชี้วัด)/จุดประสงค์การเรียนรู้</b>
                                    <br></br>
                                    <div class="row" id="StandardTable">

                                    </div>
                                </div>
                            </div>
                        </div>


                        <br></br>

                        <!--table-->
                        <table class="table table-hover table-striped table-bordered display" id="example">
                            <thead>
                                <tr>
                                    <th style="width:40px;">ที่</th>
                                    <th class="no-sort">ชื่อหน่วยการเรียนรู้</th>
                                    <th class="no-sort">เวลา(ชั่วโมง)</th>
                                    <th class="no-sort">น้ำหนักคะแนน</th>
                                    <th class="no-sort"></th>
                                    <th class="no-sort"></th>
                                </tr>
                            </thead>

                            <tbody id="UnitListBody">

                            </tbody>
                        </table>

                    </form>
                </div>
            </div>
        </div>

    </div>
</div>

<?php $this->load->view("dc/dc_plan_modal"); ?>
<script>
    function ReloadStandardTable() {
        $('#KpiListTable').DataTable({
            "responsive": true,
            "stateSave": true,
            "bSort": false,
            "ordering": true,
            columnDefs: [{
                    orderable: false,
                    targets: "no-sort"
                }],
            "language": {
                "lengthMenu": "แสดง _MENU_ แถวต่อหน้า",
                "zeroRecords": "## ไม่มีข้อมูล ##",
                "info": "แสดงหน้าที่ _PAGE_ ในทั้งหมด _PAGES_ หน้า",
                "infoEmpty": "",
                "infoFiltered": "",
                "sSearch": "ระบุคำค้น",
                "sPaginationType": "full_numbers"
            }
        });
    }

    function KpiList() {
        $.ajax({
            url: "<?php echo site_url('Dc/get_standard_list'); ?>",
            method: "post",
            data: {id: MyId},
            success: function (data) {
                $('#StandardTable').html(data);
//                ReloadStandardTable();
            }
        });
    }
</script>

<script>
//----- แผนการสอน modal
    $("#UnitListBody").on("click", ".btn-plan", function () {
        var uid = $(this).attr('id');
//        uhead = $("#head" + uid).val();
//        uclss = $("#cls" + uid).val();
//        ulev = $("#lev" + uid).val();
        $.ajax({
            url: "<?php echo site_url('Dc/get_head_plan'); ?>",
            method: "post",
            data: {id: uid},
            dataType: "json",
            success: function (data) {

                $("#UnitIdforPlan").val(uid);
                $("#Headplan").html("<b>การจัดการแผนการสอน ประจำวิชา : " + uhead + " | ระดับชั้น" + uclss + " ปีที่ " + ulev + "</br>");
                $("#HeadplanSub").html("ชื่อหน่วย : " + data.tb_unit_learning_name + " | จำนวน : " + data.tb_unit_learning_hour + " ชั่วโมง | คะแนนเต็ม : " + data.tb_unit_learning_score + " คะแนน");

                $.ajax({
                    url: "<?php echo site_url('Dc/get_plan_hour_list'); ?>",
                    method: "post",
                    data: {id: uid},
                    success: function (data) {
                        $("#inPlanHour").html(data);
                    }
                });

                $.ajax({
                    url: "<?php echo site_url('Dc/get_plan_kpi_list'); ?>",
                    method: "post",
                    data: {id: uid},
                    success: function (data) {
                        $("#inPlanKpi").html(data);
                    }
                });

                $.ajax({
                    url: "<?php echo site_url('Dc/get_plan_list'); ?>",
                    method: "post",
                    data: {id: uid},
                    success: function (data) {
                        $("#PlanListBody").html(data);
                        $("#dc-unit-modal").modal("hide");
                        $("h3.modal-title").text("การจัดการแผนการสอน");

                        $("#dc-plan-modal").modal("show");
                    }
                });
            }
        });



    });

//----- จัดการตัวชี้วัด modal
    var MySchoolClassId = 0;
    var MyId = 0;
    $("#UnitListBody").on("click", ".btn-edit", function () {

        var cls = $("#Cls").val();
        var lev = $("#Lev").val();

        MyId = $(this).attr('id');

        $.ajax({
            url: "<?php echo site_url('Dc/edit_unit_list'); ?>",
            method: "post",
            data: {id: MyId},
            dataType: "json",
            success: function (data) {
                $("#inName").val(data.tb_unit_learning_name);
                $("#inSequence").val(data.tb_unit_learning_sequence);
                $("#inHour").val(data.tb_unit_learning_hour);
                $("#inScore").val(data.tb_unit_learning_score);
                $("#inContent").val(data.tb_unit_learning_content);
                $("#UnitId").val(data.id);
            }
        });

        MySchoolClassId = $("#MySchoolClassId").val();

        KpiList();

    });

//----- ลบหน่วยการเรียนรู้
    $("#UnitListBody").on("click", ".btn-delete", function () {
        var uid = $(this).attr('id');

        $.ajax({
            url: "<?php echo site_url('Dc/delete_unit_list'); ?>",
            method: "post",
            data: {id: uid},
            dataType: "json",
            success: function (data) {
                $("#unit-modal-insert-form")[0].reset();
                location.reload();
            }
        });

        KpiList();
    });

//-------- ใช้สำหรับเช็ค
    $("#StandardTable").on("click", ".btn-uncheck", function () {
        var StatusId = $(this).attr('id');
//        alert(StatusId);
        var UnitId = $('#UnitId').val();
        //--- ตัวแปรสำหรับโหลดข้อมูล
        $.ajax({
            url: "<?php echo site_url('Dc/unit_check'); ?>",
            method: "post",
            data: {sid: StatusId, uid: UnitId},
            success: function (data) {
                KpiList();
            }
        });
    });

//-------- ใช้สำหรับยกเลิกการเช็ค
//    $("#StandardTable").on("click", ".btn-check", function () {
//        var StatusId = $(this).attr('id');
//        $.ajax({
//            url: "<?php echo site_url('Dc/unit_uncheck'); ?>",
//            method: "post",
//            data: {id: StatusId},
//            success: function (data) {
//                KpiList();
//            }
//        });
//    });

    $("#unit-modal-insert-form").on("submit", function (e) {
        e.preventDefault();
        $.ajax({
            url: "<?php echo site_url('Dc/standard_list'); ?>",
            method: "post",
            data: new FormData(this),
            cache: false,
            contentType: false,
            processData: false,
            success: function (data) {
                $('#standard-table').html(data);
            }
        });

        $.ajax({
            url: "<?php echo site_url('Dc/insert_unit_list'); ?>",
            method: "post",
            data: new FormData(this),
            cache: false,
            contentType: false,
            processData: false,
            success: function (data) {
                alert("บันทึกข้อมูลสำเร็จ");
                $("#unit-modal-insert-form")[0].reset();
                location.reload();
            }
        });
    });
</script>
<script>
    //-- จุดประสงค์การเรียนรู้
    function SelectThisPurpose(e) {
        var UnitId = $('#UnitId').val();
        $.ajax({
            url: "<?php echo site_url('Dc/purpose_check'); ?>",
            method: "post",
            data: {recordid: e.id, uid: UnitId},
            success: function (data) {
                KpiList();
            }
        });
    }
</script>