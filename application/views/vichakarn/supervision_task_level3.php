
<div class="panel panel-primary">
    <div class="panel-heading">กำหนดรายการกิจกรรมย่อยสำหรับการนิเทศ</div>
    <ul class="breadcrumb">
        <li><?php echo anchor(site_url(), "<i class='icon-home icon-large'></i> หน้าแรก"); ?></li>
        <li><a href="<?php echo site_url('define-education-supervision-task'); ?>">กำหนดรายการกิจกรรมสำหรับการนิเทศ</a></li>
        <li><?php echo anchor('define-supervision-task_level2/' . $this->uri->segment(2), 'กำหนดรายการย่อย 2'); ?></li>
        <li>กำหนดรายการกิจกรรมย่อย 3</li>
    </ul>
    <div class="panel-body">
        <div class="table-responsive" style="margin-bottom:15px;">
            <table class="table">
                <tr>
                    <td style="width:15%;border:none;">กิจกรรมหลัก</td><td><?php echo $level1['question_level1'] ?></td>
                </tr>
                <tr>
                    <td style="width:15%;border:none;">กิจกรรมย่อยลำดับที่ 2</td><td><?php echo $level2['question_level2']; ?></td>
                </tr>
                <?php if ($this->session->userdata('status') == 'ผู้ปฏิบัติงาน'): ?>
                    <form method="post" id="insert-form">
                        <tr>
                            <td style="border:none;">กิจกรรมย่อยลำดับที่ 3</td><td><input type="text" name="inQuestionLevel3" id="inQuestionLevel3"  class="form-control" style="width:35%;display:inline-block;" required autofocus/>&nbsp;<button type="submit" class="btn btn-success"><i class="icon-save"></i> บันทึก</button></td>
                        </tr>
                        <input type="hidden" name="level2_id" id="level2_id" value="<?php echo $this->uri->segment(3); ?>" />
                    </form>
                <?php else: ?>

                <?php endif; ?>
            </table>
        </div>
        <div class="row">
            <div class="col-md-12">
                <table class="table table-hover table-striped table-bordered display" id="example">
                    <thead>
                        <tr>
                            <th style="width:40px;">ที่</th>
                            <th class="no-sort">กิจกรรมนิเทศระดับที่ 3</th>
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
                                <td><?php echo $r['question_level3']; ?></td>
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
    var status = '<?php echo $this->session->userdata('status'); ?>';
    if (status == 'ผู้ปฏิบัติงาน') {
        //$('div#example_length.dataTables_length').append("&nbsp;&nbsp;<a href='#' class='btn btn-default btn-insert'><i class='icon-plus icon-large'></i> บันทึก</a>");
    }
    // inset data;
    $('#insert-form').on('submit', function (e) {
        e.preventDefault();
        $.ajax({
            url: '<?php echo site_url('insert-define-supervision-task-level-3'); ?>',
            method: 'post',
            data: $('#insert-form').serialize(),
            success: function (data) {
                //alert('บันทึกข้อมูลเรียบร้อย');
                $('#insert-form')[0].reset();
                location.reload();
            }
        });
    });
    // edit data;
    $('#example').on('click', '.btn-edit', function () {
        var uid = $(this).attr('id');
        $.ajax({
            url: '<?php echo site_url('update-define-supervision-task-level-3'); ?>',
            method: 'post',
            data: {id: uid},
            dataType: 'json',
            success: function (data) {
                $('#id').val(data.id);
                $('#inQuestionLevel3').val(data.question_level3);
                $('#inQuestionLevel3').focus();
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
<?php
//$this->load->view('vichakarn/modals/supervision_activities_modal'); ?>