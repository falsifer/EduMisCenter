<!-- Modal -->
<div id="electronic-leave-detail-modal" class="modal fade" role="dialog">
    <div class="modal-dialog" style="width:70%;">
        <div class="modal-content" >
            <?php $this->load->view('layout/my_school_modal_header'); ?> 
            <?php
            $data['AreaID'] = 'ElectronicLeaveDetailBody';
            $this->load->view('layout/my_school_print', $data);
            ?> 
            <style>
                .modal-body{
                    height: 500px;
                    overflow-y: auto;
                }
                .row{
                    margin-bottom: 10px;
                }
            </style>

            <div class="modal-body" style="padding:30px;" >
                <div class="container-fluid">
                    <form method="post" id="insert-form" enctype="multipart/form-data">
                        <div id="ElectronicLeaveDetailBody" >                            
                        </div> 
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function ApproveThis(e) {
        var AbsentRec = $('#Approver').val();
        var Startdate = $('#StartDate').val();
        var Numdate = $('#Numdate').val();
        var HrId = $('#HrId').val();
        var Status = "YES";

        $.ajax({
            url: "<?php echo site_url('Electronic_Leave/electronic_leave_approve_this'); ?>",
            method: "post",
            data: {id: e.id,
                status: Status,
                apid: $('#inApproveId').val(),
                apnote: $('#inApproveNote').val(),
                ApproverSeq: AbsentRec,
                Startdate: Startdate,
                HrId: HrId,
                Numdate: Numdate},

            success: function (data) {
                ApproveSearch(e);
                $.ajax({
                    url: "<?php echo site_url('Electronic_Leave/electronic_leave_detail'); ?>",
                    method: "post",
                    data: {id: DetailId},
                    success: function (data) {
                        $('#ElectronicLeaveDetailBody').html(data);
                        $('#MySchoolAreaId').val("ElectronicLeaveDetailBody");
                    }
                });
            }
        });
    }

    function NotApprovedThis(e) {
        var AbsentRec = $('#Approver').val();
        var Startdate = $('#StartDate').val();
        var Numdate = $('#Numdate').val();
        var HrId = $('#HrId').val();
        var Status = "NO";

        $.ajax({
            url: "<?php echo site_url('Electronic_Leave/electronic_leave_approve_this'); ?>",
            method: "post",
            data: {id: e.id,
                status: Status,
                apid: $('#inApproveId').val(),
                apnote: $('#inApproveNote').val(),
                ApproverSeq: AbsentRec,
                Startdate: Startdate,
                HrId: HrId,
                Numdate: Numdate},

            success: function (data) {
                ApproveSearch(e);
                $.ajax({
                    url: "<?php echo site_url('Electronic_Leave/electronic_leave_detail'); ?>",
                    method: "post",
                    data: {id: DetailId},
                    success: function (data) {
                        $('#ElectronicLeaveDetailBody').html(data);
                        $('#MySchoolAreaId').val("ElectronicLeaveDetailBody");
                    }
                });
            }
        });
    }
</script>
