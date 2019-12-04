

<div class="panel panel-primary">
    <div class="panel-heading">ข้อมูลการวางแผนอัตรากำลัง</div>
    <ul class="breadcrumb">
        <li><?php echo anchor(site_url(), "<i class='icon-home icon-large'></i> หน้าแรก"); ?></li>
        <li>การวางแผนอัตรากำลัง</li>
    </ul>
    <div class="panel-body">
        <div class="col-md-12">
            <!-- ตารางกรอบอัตรากำลัง -->       
            <br/>
            <div class="table-responsive">
                <table class="table table-hover table-bordered table-striped" id="example">
                    <thead>
                        <tr>
                            <th class="no-sort" style="width:45px;">ที่</th>
                            <th class="no-sort" style="width:20%;">ปีงบประมาณ</th>
                            <th class="no-sort">หมายเหตุ</th>
                            <?php if ($this->session->userdata('status') == 'ผู้ปฏิบัติงาน'): ?>
                                <th class="no-sort" style="width:18%;"></th>
                            <?php endif; ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $row = 1; ?>
                        <?php foreach ($rs as $r): ?>
                            <tr>
                                <td style="text-align:center;"><?php echo $row; ?></td>
                                <td style="text-align:center;"><?php echo $r['begin_year'] . ' - ' . $r['end_year']; ?></td>
                                <td><?php echo $r['plan_comment']; ?></td>
                                <td style="text-align:center;">
                                    <a href="<?php echo site_url('human-plan-detail/' . $r['id']); ?>" class="btn btn-info">รายละเอียด</a>
                                    <?php if ($this->session->userdata('status') == 'ผู้ปฏิบัติงาน'): ?>
                                        <button type="button" class="btn btn-warning btn-edit" id="<?php echo $r['id']; ?>"><i class="icon-pencil"></i> แก้ไข</button>
                                        <button type="button" class="btn btn-danger btn-delete" id="<?php echo $r['id']; ?>"><i class="icon-trash"></i> ลบ</button>
                                    <?php endif; ?>
                                </td>
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
<script type="text/javascript">
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
    // แสดงปุ่มบันทึกข้อมูล
    var status = "<?php echo $this->session->userdata('status'); ?>";
    $('div#example_length.dataTables_length').append("&nbsp;&nbsp;<button type='button' class='btn btn-default btn-insert'><i class='icon-plus'></i> กำหนดปีงบประมาณ</button>");
    // When user click btn-insert;
    $('.btn-insert').on('click', function () {
        $('#insert-form').trigger('reset');
        $('h3.modal-title').text("กำหนดปีงบประมาณสำหรับวางแผนอัตรากำลัง");
        $('#hr-plan-modal').modal('show');
    });
    // แก้ไขข้อมูลปีงบประมาณ
    $('#example').on('click', '.btn-edit', function () {
        var uid = $(this).attr('id');
        $.ajax({
            url: '<?php echo site_url('update-human-resources-plan-year'); ?>',
            method: 'post',
            data: {id: uid},
            dataType: 'json',
            success: function (data) {
                $('#id').val(data.id);
                $('#inBeginYear').val(data.begin_year);
                $('#inEndYear').val(data.end_year);
                $('#inPlanComment').val(data.plan_comment);
                //
                $('h3.modal-title').text('ปรับปรุงข้อมูลปีงบประมาณสำหรับวางแผนอัตรากำลัง');
                $('#hr-plan-modal').modal('show');
            }
        });
    });
    // ลบข้อมูลปีงบประมาณ
    $('#example').on('click', '.btn-delete', function () {
        var uid = $(this).attr('id');
        var status = confirm('ต้องการลบข้อมูลนี้จริงหรือไม่ ?');
        if (status) {
            $.ajax({
                url: '<?php echo site_url('delete-human-resources-plan-year'); ?>',
                method: 'post',
                data: {id: uid},
                success: function (data) {
                    location.reload();
                }, error: function (data) {
                    alert('เนื่องจากมีข้อมูลที่เกี่ยวข้องจึงไม่สามารถลบได้...');
                }
            });
        }
    });
</script>
<?php $this->load->view('human_planing/modals/hr_plan_modal'); ?>
