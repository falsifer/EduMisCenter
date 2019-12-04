<!-- Modal -->
<div id="teaching-task-course-unit-manage-modal" class="modal fade" role="dialog">
    <div class="modal-dialog" style="width:95%;">
        <div class="modal-content">
            <?php $this->load->view('layout/my_school_modal_header'); ?> 
            <div class="modal-body" style="padding:30px;max-height: 600px;overflow-y: auto;">
                <div class="container-fluid">
                    <div class="row">
                        
                        <table class="table table-hover table-bordered display" id="KpiTable">
                            <thead>
                                <tr style='background-color: #eeeeee;'>
                                    <th style="width:5%; text-align: center">ที่</th>
                                    <th style="width:10%;text-align: center">สาระ</th>
                                    <th style="width:20%;text-align: center">ตัวชี้วัด</th>
                                    <th style="width:40%;text-align: center">รายละเอียด</th>
                                    <!--<th style="width:10%;text-align: center">คะแนนเต็ม</th>-->
                                    <th style="width:15%;text-align: center">จัดการ</th>
                                </tr>
                            </thead>
                            <tbody id="KpiLearningTBody">

                            </tbody>
                        </table>

                    </div>


                </div>
            </div>
        </div>
    </div>
</div>
<script>
//-------- ใช้สำหรับเช็ค

    function SelectThisKpi(e) {

        var StatusId = e.id;
        var UnitId = $('#InUnitId').val();
        //--- ตัวแปรสำหรับโหลดข้อมูล
        $.ajax({
            url: "<?php echo site_url('Dc/unit_check'); ?>",
            method: "post",
            data: {sid: StatusId, uid: UnitId},
            success: function (data) {
                $.ajax({
                    url: "<?php echo site_url('Teacher/manage_course_unit'); ?>",
                    method: "post",
                    data: {id: $('#InUnitId').val()},
                    beforeSend: function () {
                        MyStartLoading();
                    }, success: function (data) {
                        MyEndLoading();
                        $("#KpiLearningTBody").html(data);
                    }
                });
            }
        });
    }



    //-------- ใช้สำหรับยกเลิกการเช็ค
    function UnSelectThisKpi(e) {
        var StatusId = e.id;
        $.ajax({
            url: "<?php echo site_url('Dc/unit_uncheck'); ?>",
            method: "post",
            data: {id: StatusId},
            success: function (data) {
                $.ajax({
                    url: "<?php echo site_url('Teacher/manage_course_unit'); ?>",
                    method: "post",
                    data: {id: $('#InUnitId').val()},
                    beforeSend: function () {
                        MyStartLoading();
                    }, success: function (data) {
                        MyEndLoading();
                        $("#KpiLearningTBody").html(data);
                    }
                });
            }
        });
    }
</script>