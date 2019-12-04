<!-- Modal -->
<div id="classroom-online-assignment-assign-modal" class="modal fade" role="dialog">
    <div class="modal-dialog" style="width:90%;">
        <div class="modal-content">
            <?php $this->load->view('layout/my_school_modal_header'); ?>
            <style>
                .modal-body{
                    min-height: 300px;
                    overflow-y: auto;
                }
                .row{
                    margin-bottom: 10px;
                }
            </style>
            <div class="modal-body" style="padding:30px;" >
                <div class="container-fluid">
                    <div class='row'>
                        <div class='col-md-12'>
                            <table class="table table-striped table-bordered"  id="ClassOnlineAssignmentAssignTable">
                                <thead>
                                    <tr>
                                        <th style="width:5%;text-align: center;">ที่</th>
                                        <th style="width:30%;text-align: center;">ชื่อ-นามสกุล</th>
                                        <th style="width:20%;text-align: center;">ชื่อเล่น</th>
                                        <!--<th style="width:20%;text-align: center;">ประเภทสมาชิก</th>-->
                                        <!--<th style="width:15%;text-align: center;">สถานะ</th>-->

                                        <th style="width:30%;text-align: center;"></th>
                                    </tr>
                                </thead>
                                <tbody id="ClassOnlineAssignmentAssignTbody">

                                </tbody>
                            </table>
                        </div>
                    </div>                    
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $('#ClassOnlineAssignmentAssignTable').DataTable({
        "responsive": true,
        "stateSave": true,
        "bSort": false,
        "ordering": false,
        "pagging": false,
        "searching": false,
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
        },
    });
</script>
<script>

    function AssignThisMember(id) {
//        alert($('#inClassOnlineAssignmentId').val());
        $.ajax({
            url: '<?php echo site_url('Classroom_online/classroom_online_assignment_assign_member'); ?>',
            method: 'post',
            data: {id: id, work_id: $('#inClassOnlineAssignmentId').val()},
            success: function (data) {
                AssignModal();
            }
        });
    }

    function ClearThisAssignMember(id) {
        $.ajax({
            url: '<?php echo site_url('Classroom_online/classroom_online_assignment_clear_assign_member'); ?>',
            method: 'post',
            data: {id: id},
            success: function (data) {
                AssignModal();
            }
        });
    }


</script>