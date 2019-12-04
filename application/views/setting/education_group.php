<div class="panel panel-primary">
    <div class="panel-heading">กลุ่มสาระการเรียนรู้</div>
    <ul class="breadcrumb">
        <li><?php echo anchor(site_url(), "<i class='icon-home icon-large'></i> หน้าแรก"); ?></li>
        <li>กลุ่มสาระการเรียนรู้</li>
    </ul>
    <div class="panel-body">
        <div class="databox">
            <div class="row" style="margin:auto;">
                <div class="col-md-6">
                    <div class="col-md-2"><label class="control-label">พุทธศักราช</label></div>
                    <div class="col-md-6"><select name="inEdYear" id="inEdYear" class="form-control">
                            <option value="0">---ทั้งหมด---</option>
                            <?php foreach ($edYear as $y): ?>
                                <option value="<?php echo $y['ed_year']; ?>"><?php echo $y['ed_year']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="table-responsive">
        <table class="table table-hover table-striped table-bordered display" id="example">
            <thead>
                <tr>
                    <th style="width:55px;">ที่</th>
                    <th class="no-sort">คำอธิบาย</th>
                    <th class="no-sort">ตัวย่อ</th>
                    <?php if ($this->session->userdata("status") == "ผู้ปฏิบัติงาน"): ?>
                        <th style="width:13%;border-right: none;" class="no-sort"></th>
                    <?php endif; ?>
                </tr>
            </thead>
            <tbody id="tabFilter">
                <?php $tmp = ''; ?>
                <?php foreach ($rs as $r): ?>
                    <?php if ($tmp != $r['ed_year']): ?>
                        <?php $tmp = $r['ed_year']; ?>
                        <tr>
                            <td style="border-right:none;"></td>
                            <td style="font-weight: bold;" colspan="3">พุทธศักราช <?php echo $r['ed_year']; ?></td>
                            <td style="display:none;"></td>
                            <?php if ($this->session->userdata("status") == "ผู้ปฏิบัติงาน"): ?>
                                <td style="display:none;">
                                </td>
                            <?php endif; ?>
                        </tr>
                        <tr>
                            <td style="text-align:center;"><?php echo $r['tb_group_learning_seq']; ?></td>
                            <td><?php echo $r['tb_group_learningcol_name']; ?></td>
                            <td><?php echo $r['tb_group_learning_code']; ?></td>
                            <?php if ($this->session->userdata("status") == "ผู้ปฏิบัติงาน"): ?>
                                <td style="text-align:center;border-right:none;">
                                    <button type="button" class="btn btn-warning btn-edit" id="<?php echo $r['id']; ?>"><i class="icon-pencil icon-large"></i> แก้ไข</button>
                                    <button type="button" class="btn btn-danger btn-delete" id="<?php echo $r['id']; ?>"><i class="icon-trash icon-large"></i> ลบ</button>
                                </td>
                            <?php endif; ?>
                        </tr>
                    <?php else: ?>
                        <tr>
                            <td style="text-align:center;"><?php echo $r['tb_group_learning_seq']; ?></td>
                            <td><?php echo $r['tb_group_learningcol_name']; ?></td>
                            <td><?php echo $r['tb_group_learning_code']; ?></td>
                            <?php if ($this->session->userdata("status") == "ผู้ปฏิบัติงาน"): ?>
                                <td style="text-align:center;border-right:none;">
                                    <button type="button" class="btn btn-warning btn-edit" id="<?php echo $r['id']; ?>"><i class="icon-pencil icon-large"></i> แก้ไข</button>
                                    <button type="button" class="btn btn-danger btn-delete" id="<?php echo $r['id']; ?>"><i class="icon-trash icon-large"></i> ลบ</button>
                                </td>
                            <?php endif; ?>
                        </tr>
                    <?php endif; ?>

                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <?php $this->load->view('layout/my_school_footer'); ?>
</div>



<!---------------------------------------------------------------------------->
<script>
    $('#example').DataTable({
        "responsive": true,
        "stateSave": true,
        "bSort": false,
        "ordering": false,
        columnDefs: [{
                orderable: false,
                targets: "no-sort"
            }],
        "pageLength": 100,
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
        $('h3.modal-title').text('บันทึกกลุ่มสาระการเรียนรู้');
        $('#education-group-modal').modal('show');
    });
    // edit data;
    $('#example').on('click', '.btn-edit', function () {
        var uid = $(this).attr('id');
        $.ajax({
            url: '<?php echo site_url('update-education-group'); ?>',
            method: 'post',
            data: {id: uid},
            dataType: 'json',
            success: function (data) {
                $('#id').val(data.id);
                $('#inEducationGroupNo').val(data.tb_group_learning_seq);
                $('#inEducationGroupName').val(data.tb_group_learningcol_name);
                $('#inEducationGroupCode').val(data.tb_group_learning_code);
                //
                $('h3.modal-title').text('');
                $('#education-group-modal').modal('show');
            }
        });
    });
    // edit data;
    $('#example').on('click', '.btn-delete', function () {
        var uid = $(this).attr('id');
        var status = confirm('ต้องการลบข้อมูลนี้จริงหรือไม่ ?');
        if (status) {
            $.ajax({
                url: '<?php echo site_url('delete-education-group'); ?>',
                method: 'post',
                data: {id: uid},
                success: function (data) {
                    location.reload();
                }
            });
        }
    });


    $('#inEdYear').change(function () {
        var uid = $('#inEdYear').val();
        $.ajax({
            url: '<?php echo site_url('Setting/education_group_list'); ?>',
            method: 'post',
            data: {edYear: uid},
            success: function (data) {
                $('#tabFilter').html(data);
                $('#example').ajax.reload();
            }
        });

    });

</script>
<!---------------------------------------------------------------------------->
<?php $this->load->view('setting/modals/education_group_modal'); ?>