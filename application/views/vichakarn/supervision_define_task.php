<div class="panel panel-primary">
    <div class="panel-heading">กำหนดรายการกิจกรรมสำหรับการนิเทศ</div>
    <ul class="breadcrumb">
        <li><?php echo anchor(site_url(), "<i class='icon-home icon-large'></i> หน้าแรก"); ?></li>
        <li><a href="<?php echo site_url('supervision'); ?>">การนิเทศการเรียนการสอน</a></li>
        <li>กำหนดกิจกรรมฯ</li>
    </ul>
    <div class="panel-body">



        <div class="row">
            <div class="col-md-12">
                <table class="table table-hover table-striped table-bordered display" id="example">
                    <thead>
                        <tr>
                            <th class="no-sort" style="width:45px;">ที่</th>
                            <th class="no-sort">กิจกรรม</th>
                            <?php if ($this->session->userdata("status") == "ผู้ปฏิบัติงาน"): ?>
                                <th style="width:18%;border-right: none;" class="no-sort"></th>
                            <?php endif; ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $row = 1; ?>
                        <?php foreach ($rs as $r): ?>
                            <tr>
                                <td style="text-align:center;"><?php echo $row; ?></td>
                                <td><?php echo anchor('define-supervision-task_level2/' . $r['id'], $r['question_level1']); ?></td>
                                <?php if ($this->session->userdata("status") == "ผู้ปฏิบัติงาน"): ?>
                                    <td style="text-align:center;border-right:none;">
                                        <div class="btn-group">
                                            <button type="button" class="btn-edit btn btn-warning" id="<?php echo $r['id']; ?>"><i class="icon-pencil icon-large"></i> แก้ไข</button>
                                            <button type="button" class="btn-delete btn btn-danger" id="<?php echo $r['id']; ?>"><i class="icon-trash"></i> ลบ</button>
                                        </div>
                                    </td>
                                <?php endif; ?>
                            </tr>
                            <?php $row++; ?>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <?php $this->load->view('layout/my_school_footer'); ?>
</div>
<script>
    $('#example').DataTable({
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
    $('.sorting_asc').removeClass('sorting_asc');
    // Tool tips;
    $(function () {
        $('[data-toggle="tooltip"]').tooltip();
    });
    //
    var status = '<?php echo $this->session->userdata('status'); ?>';
    if (status == 'ผู้ปฏิบัติงาน') {
        $('div#example_length.dataTables_length').append("&nbsp;&nbsp;<a href='#' class='btn btn-primary btn-insert'><i class='icon-plus icon-large'></i> เพิ่มข้อมูล</a>");
    }
    //
    $('.btn-insert').click(function () {
        $('#insert-form').trigger('reset');
        $('h3.modal-title').text('กำหนดกิจกรรมลำดับที่ 1');
        $('#supervision-define-task-modal').modal('show');
    });
    // edit data;
    $('#example').on('click', '.btn-edit', function () {
        var uid = $(this).attr('id');
        $.ajax({
            url: '<?php echo site_url('update-define-education-supervision-task'); ?>',
            method: 'post',
            data: {id: uid},
            dataType: 'json',
            success: function (data) {
                $('#id').val(data.id);
                $('#inSupervisionTask').val(data.question_level1);
                //
                $('h3.modal-title').text('ปรับปรุงข้อมูลหัวข้อหลักสำหรับการนิเทศ');
                $('#supervision-define-task-modal').modal('show');
            }
        });
    });
    // edit data;
    $('#example').on('click', '.btn-delete', function () {
        var uid = $(this).attr('id');

        var status = confirm('ต้องการลบข้อมูลนี้จริงหรือไม่ ?');
        if (status) {
            $.ajax({
                url: '<?php echo site_url('delete-define-education-supervision-task'); ?>',
                method: 'post',
                data: {id: uid},
                success: function (data) {
                    location.reload();
                }
            });
        }
    });
</script>
<?php $this->load->view('vichakarn/modals/supervision_define_task_modal'); ?>