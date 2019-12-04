<div class="panel panel-primary">
    <div class="panel-heading">รายละเอียดแผนการนิเทศการเรียนการสอน<?php echo $subject_title; ?></div>
    <ul class="breadcrumb">
        <li><?php echo anchor(site_url(), "<i class='icon-home icon-large'></i> หน้าแรก"); ?></li>
        <li><a href="<?php echo site_url('supervision-schedule'); ?>">ตารางแผนการจัดการนิเทศฯ</a></li>
        <li>รายละเอียดแผนฯ</li>
    </ul>
    <div class="panel-body" style="padding-top:5px;">

        <div class="row">
            <div class="col-md-12">
                <div class="databox">
                    <div class="databox-heading">ข้อมูลทั่วไป</div>
                    <div class="databox-body">
                        <div class="table-responsive">
                            <table class="table">
                                <tr>
                                    <td style="width:20%;font-weight:bold;">เทอมที่</td><td><?php echo $schedule_title['loan_term']; ?></td>
                                    <td style="width:20%;font-weight:bold;">ปีการศึกษา</td><td><?php echo $schedule_title['loan_year']; ?></td>
                                </tr>
                                <tr>
                                    <td style="width:20%;font-weight:bold;">กลุ่มสาระการเรียนรู้</td><td><?php echo $schedule_title['learning_group']; ?></td>
                                    <td style="width:20%;font-weight:bold;">โรงเรียนเป้าหมาย</td><td><?php echo $schedule_title['school_name']; ?></td>
                                </tr>
                                
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table table-hover table-striped table-bordered" id="example" style="width:100%;">
                <thead>
                    <tr>
                        <th style="width:40px;" rowspan="2" class="no-sort">ที่</th>
                        <th class="no-sort" rowspan="2">วัน/เดือน/ปี</th>
                        <th class="no-sort" colspan="3">รายการนิเทศ/สังเกตการสอน</th>
                        <th class="no-sort" rowspan="2">ผู้รับการนิเทศ</th>
                        <th class="no-sort" rowspan="2">ผู้นิเทศ</th>
                       <th style="width:13%;border-right: none;" class="no-sort" rowspan="2"></th>
                       
                    </tr>
                    <tr>
                        <th class="no-sort">ระดับชั้น</th>
                        <th class="no-sort">รหัสวิชา</th>
                        <th class="no-sort">ชื่อวิชา</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $row = 1; ?>
                    <?php foreach ($rs as $r): ?>
                        <tr>
                            <td style="text-align:center;"><?php echo $row ?></td>
                            <td><?php echo datethai($r['schedule_date']) ?></td>
                            <td style="text-align:center;"><?php echo $r['class']; ?></td>
                            <td style="text-align:center;"><?php echo $r['tb_course_code']; ?></td>
                            <td><?php echo $r['tb_subject_name']; ?></td>
                            <td><?php echo $r['teacher_name'] ?></td>
                            <td><?php echo $r['supervision_name'] ?></td>
                            <?php if ($this->session->userdata("status") == "ผู้ปฏิบัติงาน"): ?>
                                <td style="text-align:center;border-right:none;">
                                    <button type="button" class="btn btn-default btn-edit" id="<?php echo $r['detail_id']; ?>"><i class="icon-pencil icon-large"></i> แก้ไข</button>
                                    <button type="button" class="btn btn-default btn-delete" id="<?php echo $r['detail_id']; ?>"><i class="icon-trash icon-large"></i> ลบ</button>
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
    <?php
        $tabName = "example";
        $text = "รายละเอียดแผนการนิเทศการเรียนการสอน";
        $title = $this->Echo_Text_Model->head_logo($text,$this->session->userdata('sch_id'));
        $colStr = "0,1,2,3,4,5,6";
        $btExArr = array();
        load_datatable($tabName, $btExArr, $title, $colStr);
    
    ?>
//    $('#example').DataTable({
//        "responsive": true,
//        "stateSave": true,
//        "bSort": false,
//        "ordering": true,
//        columnDefs: [{
//                orderable: false,
//                targets: "no-sort"
//            }],
//        "language": {
//            "lengthMenu": "แสดง _MENU_ แถวต่อหน้า",
//            "zeroRecords": "## ไม่มีข้อมูล ##",
//            "info": "แสดงหน้าที่ _PAGE_ ในทั้งหมด _PAGES_ หน้า",
//            "infoEmpty": "",
//            "infoFiltered": "",
//            "sSearch": "ระบุคำค้น",
//            "sPaginationType": "full_numbers"
//        }
//    });
//    $('.sorting_asc').removeClass('sorting_asc');
    // Tool tips;
//    $(function () {
//        $('[data-toggle="tooltip"]').tooltip();
//    });
//    $('div#example_length.dataTables_length').append("&nbsp;&nbsp;<a href='<?php echo site_url('print-supervision-schedule-detail/' . $this->uri->segment(2)); ?>' target='_blank' class='btn btn-default btn-print'><i class='icon-print icon-large'></i> พิมพ์ข้อมูล</a>");
    //
    var status = '<?php echo $this->session->userdata('status'); ?>';
    if (status == 'ผู้ปฏิบัติงาน') {
        $('div#example_length.dataTables_length').append("&nbsp;&nbsp;<a href='#' class='btn btn-primary btn-insert'><i class='icon-plus icon-large'></i> บันทึก</a>");
    }
    //
    $('.btn-insert').click(function () {
        $('#insert-form').trigger('reset');
        $('h3.modal-title').text('บันทึกข้อมูลการนิเทศการจัดการเรียนการสอน');
        $('#supervision-schedule-detail-modal').modal('show');
    });
    // edit data;
    $('#example').on('click', '.btn-edit', function () {
        var uid = $(this).attr('id');
        $.ajax({
            url: '<?php echo site_url('update-supervision-schedule-detail'); ?>',
            method: 'post',
            data: {id: uid},
            dataType: 'json',
            success: function (data) {
                $('#id').val(data.detail_id);
                $('#inScheduleDate').val(data.schedule_date);
                $('#inSubjectDetailId').val(data.subject_detail_id);
                $('#inTeacherName').val(data.teacher_name);
                $('#inSupervisionName').val(data.supervision_name);
                //
                $('h3.modal-title').text('ปรับปรุงข้อมูลการนิเทศการจัดการเรียนการสอน');
                $('#supervision-schedule-detail-modal').modal('show');
            }
        });
    });
    // edit data;
    $('#example').on('click', '.btn-delete', function () {
        var uid = $(this).attr('id');
        var status = confirm('ต้องการลบข้อมูลนี้จริงหรือไม่ ?');
        if (status) {
            $.ajax({
                url: '<?php echo site_url('delete-supervision-schedule-detail'); ?>',
                method: 'post',
                data: {id: uid},
                success: function (data) {
                    location.reload();
                }
            });
        }
    });
</script>
<?php $this->load->view('vichakarn/modals/supervision_schedule_detail_modal'); ?>