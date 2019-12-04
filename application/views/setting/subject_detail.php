<div class="panel panel-primary">
    <div class="panel-heading">ข้อมูลรายวิชา</div>
    <ul class="breadcrumb">
        <li><?php echo anchor(site_url(), "<i class='icon-home icon-large'></i> หน้าแรก"); ?></li>
        <li>ข้อมูลรายวิชา</li>
    </ul>
    <div class="panel-body">
        <div class="table-responsive">
            <table class="table table-hover table-striped table-bordered display" id="example">
                <thead>
                    <tr>
                        <th style="width:55px;">ที่</th>
                        <th class="no-sort">รหัสวิชา</th>
                        <th class="no-sort">ชื่อวิชา</th>
                        <th class="no-sort">คำอธิบาย</th>
                        <th class="no-sort">กลุ่มสาระการเรียนรู้</th>
                        <?php if ($this->session->userdata("status") == "ผู้ปฏิบัติงาน"): ?>
                            <th style="width:13%;border-right: none;" class="no-sort"></th>
                        <?php endif; ?>
                    </tr>
                </thead>
                <tbody>
                    <?php $row = 1; ?>
                    <?php foreach ($rs as $r): ?>
                        <tr>
                            <td style="text-align:center;"><?php echo $row; ?></td>
                            <td><?php echo $r['subject_code']; ?></td>
                            <td><?php echo $r['subject_name']; ?></td>
                            <td><?php echo $r['subject_detail'];?></td>
                            <td><?php echo $r['education_group_name'] ?></td>
                            <?php if ($this->session->userdata("status") == "ผู้ปฏิบัติงาน"): ?>
                                <td style="text-align:center;border-right:none;">
                                    <button type="button" class="btn btn-warning btn-edit" id="<?php echo $r['subject_id']; ?>"><i class="icon-pencil icon-large"></i> แก้ไข</button>
                                    <button type="button" class="btn btn-danger btn-delete" id="<?php echo $r['subject_id']; ?>"><i class="icon-trash icon-large"></i> ลบ</button>
                                </td>
                            <?php endif; ?>
                        </tr>
                        <?php $row++; ?>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

    <?php $this->load->view('layout/my_school_footer'); ?>
</div>
<!---------------------------------------------------------------------------->
<script>
    $('#example').DataTable({
        "responsive": true,
        "stateSave": true,
        "bSort": false,
        "ordering": true,
        'autowidth': false,
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
    $('.sorting_asc').removeClass('sorting_asc');
    // Tool tips;
    $(function () {
        $('[data-toggle="tooltip"]').tooltip();
    });
    //
    var status = '<?php echo $this->session->userdata('status'); ?>';
    if (status == 'ผู้ปฏิบัติงาน') {
        $('div#example_length.dataTables_length').append("&nbsp;&nbsp;<a href='#' class='btn btn-default btn-insert'><i class='icon-plus icon-large'></i> บันทึก</a>");
    }
    //
    $('.btn-insert').click(function () {
        $('#insert-form').trigger('reset');
        $('h3.modal-title').text('บันทึกข้อมูลรายวิชา');
        $('#subject-detail-modal').modal('show');
    });
    // edit data;
    $('#example').on('click', '.btn-edit', function () {
        var uid = $(this).attr('id');
        $.ajax({
            url: '<?php echo site_url('update-subject-detail'); ?>',
            method: 'post',
            data: {id: uid},
            dataType: 'json',
            success: function (data) {
                $('#id').val(data.id);
                $('#inSubjectCode').val(data.subject_code);
                $('#inSubjectName').val(data.subject_name);
                $('#inSubjectDetail').val(data.subject_detail);
                $('#inLearningGroupId').val(data.learning_group_id);
                $('#inLevelId').val(data.level_id);
                //
                $('h3.modal-title').text('');
                $('#subject-detail-modal').modal('show');
            }
        });
    });
    // edit data;
    $('#example').on('click', '.btn-delete', function () {
        var uid = $(this).attr('id');
        var status = confirm('ต้องการลบข้อมูลนี้จริงหรือไม่ ?');
        if (status) {
            $.ajax({
                url: '<?php echo site_url('delete-subject-detail'); ?>',
                method: 'post',
                data: {id: uid},
                success: function (data) {
                    location.reload();
                }
            });
        }
    });
</script>
<?php $this->load->view('setting/modals/subject_detail_modal'); ?>