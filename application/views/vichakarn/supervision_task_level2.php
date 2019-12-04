
<div class="panel panel-primary">
    <div class="panel-heading">กำหนดรายการกิจกรรมย่อยสำหรับการนิเทศ</div>
    <ul class="breadcrumb">
        <li><?php echo anchor(site_url(), "<i class='icon-home icon-large'></i> หน้าแรก"); ?></li>
        <li><a href="<?php echo site_url('define-education-supervision-task'); ?>">กำหนดรายการกิจกรรมสำหรับการนิเทศ</a></li>
        <li>กำหนดรายการกิจกรรมย่อย</li>
    </ul>
    <div class="panel-body">

        <!-- Add data -->
        <?php if ($this->session->userdata('status') == 'ผู้ปฏิบัติงาน'): ?>
            <div class="container-fluid">
                <form method="post" id="insert-form">
                    <div class="col-md-10 well">
                        <div class="row">
                            <div class="col-md-4">
                                <label class="control-label">กิจกรรมนิเทศระดับ 1</label>
                                <div class="form-control-static"><?php echo $task['question_level1']; ?></div>
                            </div>
                            <div class="col-md-5">
                                <label class="control-label">กิจกรรมนิเทศระดับ 2</label>
                                <input type="text" name="inQuestionLevel2" id="inQuestionLevel2" class="form-control" required autofocus/>
                            </div>
                            <div class="col-md-1">
                                <label class="control-label">&nbsp;</label>
                                <button type="submit" class="btn btn-success"><i class="icon-save"></i> บันทึก</button>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" id="id" name="id" />
                    <input type="hidden" name="level1_id" id="level1_id" value="<?php echo $this->uri->segment(2); ?>" />
                </form>
            </div>
        <?php endif; ?>

        <div class="table-responsive">
            <table class="table table-hover table-striped table-bordered display" id="example">
                <thead>
                    <tr>
                        <th style="width:40px;">ที่</th>
                        <th class="no-sort">กิจกรรมนิเทศระดับที่ 2</th>
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
                            <td><?php echo anchor('define-supervision-task-level3/' . $r['level1_id'] . '/' . $r['id'], $r['question_level2']); ?></td>
                            <?php if ($this->session->userdata("status") == "ผู้ปฏิบัติงาน"): ?>
                                <td style="text-align:center;border-right:none;">
                                    <div class="btn-group">
                                        <button type="button" class="col-md-6 btn btn-warning btn-edit" id="<?php echo $r['id']; ?>"><i class="icon-pencil icon-large"></i> แก้ไข</button>
                                        <button type="button" class="col-md-6 btn btn-danger btn-delete" id="<?php echo $r['id']; ?>"><i class="icon-trash icon-large"></i> ลบ</button>
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

    <?php $this->load->view('layout/my_school_footer'); ?>
</div>
<!---------------------------------------------------------------------------->
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
//    var status = '<?php echo $this->session->userdata('status'); ?>';
//    if (status == 'ผู้ปฏิบัติงาน') {
//        $('div#example_length.dataTables_length').append("&nbsp;&nbsp;<a href='#' class='btn btn-primary btn-insert'><i class='icon-plus icon-large'></i> เพิ่มข้อมูล</a>");
//    }
    //
    $('#insert-form').on('submit', function (e) {
        e.preventDefault();
        $.ajax({
            url: '<?php echo site_url('insert-define-supervision-task-level-2'); ?>',
            method: 'post',
            data: $('#insert-form').serialize(),
            success: function (data) {
                $('#insert-form')[0].reset();
                location.reload();
            }
        });
    });
    // edit data;
    $('#example').on('click', '.btn-edit', function () {
        var uid = $(this).attr('id');
        $.ajax({
            url: '<?php echo site_url('update-define-supervision-task-level-2'); ?>',
            method: 'post',
            data: {id: uid},
            dataType: 'json',
            success: function (data) {
                $('#id').val(data.id);
                $('#inLevel1Id').val(data.level1_id);
                $('#inQuestionLevel2').val(data.question_level2);
                //
                $('h3.modal-title').text('ปรับปรุงข้อมูลกิจกรรมย่อยสำหรับการนิเทศ');
                $('#supervision-activities-modal').modal('show');
            }
        });
    });
    // edit data;
    $('#example').on('click', '.btn-delete', function () {
        var uid = $(this).attr('id');
        var status = confirm('ต้องการลบข้อมูลนี้จริงหรือไม่ ?');
        if (status) {
            $.ajax({
                url: '<?php echo site_url('delete-define-supervision-task-level-2'); ?>',
                method: 'post',
                data: {id: uid},
                success: function (data) {
                    location.reload();
                }
            });
        }
    });
</script>
