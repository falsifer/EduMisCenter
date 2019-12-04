<div class="panel panel-primary">
    <div class="panel-heading">ทำเนียบบุคลากร :: ประวัติการศึกษา</div>
    <ul class="breadcrumb">
        <li><?php echo anchor(site_url(), "<i class='icon-home icon-large'></i> หน้าแรก"); ?></li>
        <?php
        $hr_id = $this->session->userdata('hr_id');
        $checker = $this->uri->segment(2);

        if ($hr_id != $checker) {
            ?>
            <li><?php echo anchor("human_resources", "ทำเนียบบุคลากร"); ?></li>
        <?php } else { ?>
            <li><?php echo anchor("hr-member-profile", "ข้อมูลผู้ใช้"); ?></li>
        <?php } ?>
        <li>ประวัติการศึกษา</li>
    </ul>
    <div class="panel-body">
        <!--<div class="table-responsive">-->
        <table class="table table-hover table-striped table-bordered display" id="example">
            <thead>
                <tr>
                    <th style="width:40px;">ที่</th>
                    <th class="no-sort">ปี พ.ศ.</th>
                    <th class="no-sort">ระดับการศึกษา</th>
                    <th class="no-sort">คณะวิชา</th>
                    <th class="no-sort">สาขาวิชา</th>
                    <th class="no-sort">สถาบันการศึกษา</th>
                    <th class="no-sort">หมายเหตุ</th>
                    <!--<th class="no-sort" style="width:5%;border-right: none;"></th>-->
                    <th class="no-sort" style="width:20%;"></th>
                </tr>
            </thead>
            <tbody>
                <?php $row = 1; ?>
                <?php foreach ($rs as $r): ?>
                    <tr>
                        <td style="text-align:center;"><?php echo $row; ?></td>
                        <td><?php echo $r['edu_year']; ?></td>
                        <td><?php echo $r['edu_level']; ?></td>
                        <td><?php echo $r['edu_group'] ?></td>
                        <td><?php echo $r['edu_branch']; ?></td>
                        <td><?php echo $r['edu_university']; ?></td>
                        <td><?php echo $r['edu_comment']; ?></td>
                        <td style="text-align:center;border-right: 0px;">
                            <button type="button" class="btn btn-warning btn-edit form-control" id="<?php echo $r['id']; ?>"><i class="icon-pencil icon-large"></i> แก้ไข</button>

                            <button type="button" class="btn btn-danger btn-delete form-control" id="<?php echo $r['id']; ?>"><i class="icon-trash icon-large"></i> ลบ</button>
                        </td>
                    </tr>
                    <?php $row++; ?>
                <?php endforeach; ?>
            </tbody>
        </table>
        <!--</div>-->
    </div>

    <div class="panel-footer" style="padding-top: 0px;">
        <!--        <div class="row">
                    <div class="col-md-8" style="padding-top:3px;padding-right:8px;font-size:15px;color:#666;">
                        <img src="<?php echo base_url() . 'images/box_logo.png' ?>" /> สถาบันเทคโนโลยีพระจอมเกล้าเจ้าคุณทหารลาดกระบัง
                    </div>
                    <div class="col-md-4" style="padding-top:8px;padding-bottom: 8px;padding-right:30px;">
                        <span class="pull-right"><span style="color:#999999;">eSchool Version 4.0 (2018)</span></span>
                    </div>
                </div>-->
    </div>
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
//    $('div#example_length.dataTables_length').append("&nbsp;&nbsp;<a href='<?php echo site_url('print-human-resources-part-15/' . $this->uri->segment(2)); ?>' target='_blank' class='btn btn-default btn-print'><i class='icon-print icon-large'></i> พิมพ์</a>");
    //
  
        $('div#example_length.dataTables_length').append("&nbsp;&nbsp;<a href='#' class='btn btn-primary btn-insert'><i class='icon-plus icon-large'></i> เพิ่มข้อมูล</a>");
  
    //
    $('.btn-insert').click(function () {
        $('#insert-form').trigger('reset');
        $('h3.modal-title').text('บันทึกข้อมูลประวัติการศึกษา');
        $('#hr-15-modal').modal('show');
    });
    // edit data;
    $('#example').on('click', '.btn-edit', function () {
        var uid = $(this).attr('id');
        $.ajax({
            url: '<?php echo site_url('update-human-resources-part-15'); ?>',
            method: 'post',
            data: {id: uid},
            dataType: 'json',
            success: function (data) {
                $('#id').val(data.id);
                $('#inEduYear').val(data.edu_year);
                $('#inEduLevel').val(data.edu_level);
                $('#inEduGroup').val(data.edu_group);
                $('#inEduBranch').val(data.edu_branch);
                $('#inEduUniversity').val(data.edu_university);
                $('#inEduComment').val(data.edu_comment);
                //
                $('h3.modal-title').text('ปรับปรุงข้อมูลประวัติการศึกษา');
                $('#hr-15-modal').modal('show');
            }
        });
    });
    // edit data;
    $('#example').on('click', '.btn-delete', function () {
        var uid = $(this).attr('id');
        var status = confirm('ต้องการลบข้อมูลนี้จริงหรือไม่ ?');
        if (status) {
            $.ajax({
                url: '<?php echo site_url('delete-human-resources-part-15'); ?>',
                method: 'post',
                data: {id: uid},
                success: function (data) {
                    location.reload();
                }
            });
        }
    });
</script>
<!---------------------------------------------------------------------------->
<?php $this->load->view('human_resources/modals/hr_15_modal'); ?>