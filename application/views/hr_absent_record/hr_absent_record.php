<div class="box">
    <div class="box-heading">บันทึกเวลามาปฏิบัติงานของบุคลากร</div>
    <ul class="breadcrumb">
        <li><?php echo anchor(site_url(), "<i class='icon-home icon-large'></i> หน้าแรก"); ?></li>
        <li>บันทึกเวลามาปฏิบัติงานของบุคลากร</li>
    </ul>
    <div class="box-body">

        <div id="calendar">
        </div>        

        <div class="row" style="margin: 20px;">
            <div class="table-responsive">
                <table class="table table-hover table-striped table-bordered" id="example">
                    <thead>
                        <tr>
                            <th style="width:40px;text-align: center;" rowspan="2" class="no-sort">ที่</th>
                            <th class="no-sort" style="text-align: center;" rowspan="2">วันที่บันทึก</th>
                            <th class="no-sort" style="text-align: center;" rowspan="2">ชื่อ-นามสกุล บุคลากร</th>
                            <th class="no-sort" style="text-align: center;" colspan="4">ข้อมูลการปฏิบัติราชการ</th>
                            <?php if ($this->session->userdata("status") == "ผู้ปฏิบัติงาน"): ?>
                                <th class="no-sort" rowspan="2" style="width:13%;"></th>
                            <?php endif; ?>
                        </tr>
                        <tr>
                            <th class="no-sort" style="width:6%;text-align: center;">มาทำงาน</th>
                            <th class="no-sort" style="width:6%;text-align: center;">ลาป่วย</th>
                            <th class="no-sort" style="width:6%;text-align: center;">ลา</th>
                            <th class="no-sort" style="width:6%;text-align: center;">ขาด</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $row = 1; ?>
                        <?php foreach ($rs as $r): ?>
                            <tr>
                                <td style="text-align:center;"><?php echo $row; ?></td>
                                <td><?php echo shortdate($r['tb_hr_absent_record_date']); ?></td>
                                <td><?php echo $r['hr_thai_symbol']; ?><?php echo $r['hr_thai_name']; ?> <?php echo $r['hr_thai_lastname']; ?></td>
                                <?php if ($r['tb_hr_absent_record_status'] == 'C'): ?>
                                    <td style="text-align:center;"><?php echo img('images/checked.png'); ?></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>

                                <?php elseif ($r['tb_hr_absent_record_status'] == 'S'): ?>
                                    <td></td>
                                    <td style="text-align:center;"><?php echo img('images/checked.png'); ?></td>
                                    <td></td>
                                    <td></td>

                                <?php elseif ($r['tb_hr_absent_record_status'] == 'E'): ?>
                                    <td></td>
                                    <td></td>
                                    <td style="text-align:center;"><?php echo img('images/checked.png'); ?></td>
                                    <td></td>

                                <?php elseif ($r['tb_hr_absent_record_status'] == 'A'): ?>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td style="text-align:center;"><?php echo img('images/checked.png'); ?></td>
                                <?php endif; ?>
                                <?php if ($this->session->userdata("status") == "ผู้ปฏิบัติงาน"): ?>
                                    <td style="text-align:center;">
                                        <button type="button" class="btn btn-warning btn-edit" id="<?php echo $r['id']; ?>"><i class="icon-pencil icon-large"></i> EDIT</button>
                                        <!--<button type="button" class="btn btn-danger btn-delete" id="<?php echo $r['id']; ?>"><i class="icon-trash icon-large"></i> DEL</button>-->
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

<?php $this->load->view("hr_absent_record/hr_absent_record_modal"); ?>

<script>

    $('#calendar').fullCalendar({
        header: {
            left: 'prev,next today',
            center: 'title',
            right: 'month,agendaWeek,agendaDay,listYear'
        },
        height: 500,
        locale: "th",
        selectable: true,

        dayClick: function (date) {

            var daynow = date.format();

            //--- Insert ครั้งแรก
            $.ajax({
                url: "<?php echo site_url('Hr_absent_record/hr_absent_record_insert'); ?>",
                method: "post",
                data: {daynow: daynow},
                success: function (data) {
                    $.ajax({
                        url: "<?php echo site_url('Hr_absent_record/hr_absent_record_edit'); ?>",
                        method: "post",
                        data: {daynow: daynow},
                        success: function (data) {
                            $('#RecordBody').html(data);
                            $('#daynow').val(daynow);
                            $('#hr-absent-record-modal').modal('show');
                        }
                    });
                }
            });

        }
    }
    );


    $("#example").on("click", ".btn-edit", function () {

        var daynow = '<?php echo date('Y-m-d'); ?>';
        $.ajax({
            url: "<?php echo site_url('Hr_absent_record/hr_absent_record_edit'); ?>",
            method: "post",
            data: {daynow: daynow},
            success: function (data) {
                $('#RecordBody').html(data);
                $('#daynow').val(daynow);
                $('#hr-absent-record-modal').modal('show');
            }
        });
    });


</script>
