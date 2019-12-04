<!------------------------------------------------------------------------------
|  Title      Supervision plan detail
| ----------------------------------------------------------------------------
| Copyright	Edutech Co.,Ltd.
| Purpose     รายละเอียดแผนการนิเทศการศึกษา
| Author	นายบัณฑิต ไชยดี
| Create Date 21/12/2018
| Last edit	-
| Comment	-
| --------------------------------------------------------------------------->
<div class="panel panel-primary">
    <div class="panel-heading">รายละเอียดแผนการนิเทศการศึกษา</div>
    <ul class="breadcrumb">
        <li><?php echo anchor(site_url(), "<i class='icon-home icon-large'></i> หน้าแรก"); ?></li>
        <li><?php echo anchor(site_url('supervision'), 'แผนงานและการดำเนินงานนิเทศ'); ?></li>
        <li>รายละเอียด</li>
    </ul>
    <div class="panel-body">
        <div class="table-responsive">
            <table class="table table-hover table-striped table-bordered display" id="example" style="width:100%;">
                <thead>
                    <tr>
                        <th style="width:40px;" rowspan="2">ที่</th>
                        <th class="no-sort" rowspan="2">ชื่อ-นามสกุล ผู้รับการนิเทศ</th>
                        <th class="no-sort" rowspan="2">วัน เดือน ปี</th>
                        <th class="no-sort" rowspan="2">วิชา</th>
                        <th class="no-sort" colspan="2">การนิเทศ กำกับ ติดตามและประเมินผล</th>
                        <?php if ($this->session->userdata("status") == "ผู้ปฏิบัติงาน"): ?>
                            <th style="width:12%;border-right: none;" class="no-sort" rowspan="2"></th>
                        <?php endif; ?>
                    </tr>
                    <tr>
                        <th class="no-sort">กิจกรรม เทคนิค วิธีการนิเทศ</th>
                        <th class="no-sort">สื่อ/เครื่องมือนิเทศ</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $row = 1; ?>
                    <?php foreach ($rs as $r): ?>
                        <tr>
                            <td style="text-align:center;"><?php echo $row; ?></td>
                            <td><?php echo $r['hr_thai_symbol']; ?><?php echo $r['hr_thai_name']; ?><?php echo nbs(3); ?><?php echo $r['hr_thai_lastname']; ?></td>
                            <td><?php echo datethai($r['plan_detail_date']); ?></td>
                            <td>รหัสวิชา <?php echo $r['subject_code']; ?> ชื่อวิชา <?php echo $r['subject_name']; ?></td>
                            <td><?php echo $r['plan_detail_activities']; ?></td>
                            <td><?php echo $r['plan_detail_media']; ?></td>
                            <?php if ($this->session->userdata("status") == "ผู้ปฏิบัติงาน"): ?>
                                <td style="text-align:center;border-right:none;">
                                    <button type="button" class="btn btn-default btn-edit" id="<?php echo $r['plan_detail_id']; ?>"><i class="icon-pencil icon-large"></i> แก้ไข</button>
                                    <button type="button" class="btn btn-default btn-delete" id="<?php echo $r['plan_detail_id']; ?>"><i class="icon-trash icon-large"></i> ลบ</button>
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
    $('div#example_length.dataTables_length').append("&nbsp;&nbsp;<a href='<?php echo site_url('print-supervision-plan-detail/' . $this->uri->segment(2)); ?>' target='_blank' class='btn btn-default btn-print'><i class='icon-print icon-large'></i> พิมพ์ข้อมูล</a>");
    //
    var status = '<?php echo $this->session->userdata('status'); ?>';
    if (status == 'ผู้ปฏิบัติงาน') {
        $('div#example_length.dataTables_length').append("&nbsp;&nbsp;<a href='#' class='btn btn-default btn-insert'><i class='icon-plus icon-large'></i> บันทึกข้อมูล</a>");
    }
    //
    $('.btn-insert').click(function () {
        $('#insert-form').trigger('reset');
        $('h3.modal-title').text('บันทึกข้อมูลแผนการนิเทศการศึกษา');
        $('#supervision-plan-detail-modal').modal('show');
    });
    // edit data;
    $('#example').on('click', '.btn-edit', function () {
        var uid = $(this).attr('id');
        $.ajax({
            url: '<?php echo site_url('update-supervision-plan-detail'); ?>',
            method: 'post',
            data: {id: uid},
            dataType: 'json',
            success: function (data) {
                $('#id').val(data.plan_detail_id);
                $('#inHrId').val(data.hr_id);
                $('#inSubjectId').val(data.subject_detail_id);
                $('#inPlanDetailDate').val(data.plan_detail_date);
                $('#inPlanDetailActivities').val(data.plan_detail_activities);
                $('#inPlanDetailMedia').val(data.plan_detail_media);
                //
                $('h3.modal-title').text('ปรับปรุงข้อมูลรายละเอียดแผนการนิเทศการศึกษา');
                $('#supervision-plan-detail-modal').modal('show');
            }
        });
    });
    // edit data;
    $('#example').on('click', '.btn-delete', function () {
        var uid = $(this).attr('id');
        var status = confirm('ต้องการลบข้อมูลนี้จริงหรือไม่ ?');
        if (status) {
            $.ajax({
                url: '<?php echo site_url('delete-supervision-plan-detail'); ?>',
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
<?php $this->load->view('vichakarn/modals/supervision_plan_detail_modal'); ?>