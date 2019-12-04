<div class="panel panel-primary">
    <div class="panel-heading">ทำเนียบบุคลากร [ ประวัติการฝึกอบรม-ศึกษาดูงาน ]</div>
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
        <li>ประวัติการฝึกอบรม-ศึกษาดูงาน</li>
    </ul>
    <div class="panel-body">
        <!--<div class="table-responsive" style="margin-top:30px;">-->
        <table class="table table-hover table-striped table-bordered display" id="example">
            <thead>
                <tr>
                    <th style="width:45px;">ที่</th>
                    <th >จากวันที่-ถึงวันที่</th>
                    <th >ระยะเวลา</th>
                    <th >สถานที่</th>
                    <th >เรื่อง/รายละเอียด</th>
                    
                    <!--<th class="no-sort">ประเทศ</th>-->
                    <th >เอกสารประกอบ</th>
                    <!--<th class="no-sort">หมายเหตุ</th>-->
                    <?php if ($this->session->userdata("status") == "ผู้ปฏิบัติงาน"): ?>
                        <th style="width:14%;"></th>
                    <?php endif; ?>
                </tr>
            </thead>
            <tbody>
                <?php $row = 1; ?>
                <?php foreach ($rs as $r): ?>
                    <tr>
                        <td style="text-align:center;"><?php echo $row; ?></td>
                        <td><?php echo datethaifull($r['hr07_begin_date'])." - ".datethaifull($r['hr07_end_date']); ?></td>
                         <td style='text-align: center;'><?php echo $r['hr07_day']; ?> วัน <br/>นับเป็น <?php echo $r['hr07_hour']; ?> ชั่วโมง</td>
                        <td><?php echo $r['hr07_place']; ?></td>
                        <td><?php echo $r['hr07_topic']; ?></td>
                        <!--<td><?php echo $r['hr07_province']; ?></td>-->
                        <!--<td><?php echo $r['hr07_country']; ?></td>-->
                        <td style="text-align:center;">
                            <?php if (file_exists('upload/' . $r['hr07_file']) && !empty($r['hr07_file'])): ?>
                                <?php echo anchor(base_url() . 'upload/' . $r['hr07_file'], 'เอกสาร', array("target" => "_BLANK")); ?>
                            <?php endif; ?>
                        </td>
                        <!--<td><?php echo $r['hr07_comment']; ?></td>-->
                        <?php if ($this->session->userdata("status") == "ผู้ปฏิบัติงาน") : ?>
                            <td style="text-align:center;">
                                <button type="button" class="btn btn-warning btn-edit" id="<?php echo $r['id']; ?>" ><i class="icon-pencil icon-large"></i> แก้ไข</button>
                                <button type="button" class="btn btn-danger btn-delete" id="<?php echo $r['id']; ?>" ><i class="icon-trash icon-large"></i> ลบ</button>
                            </td>                        
                        <?php endif; ?>
                    </tr>
                    <?php $row++; ?>
                <?php endforeach; ?>
            </tbody>
        </table>
        <!--</div>-->
    </div>

    <div class="panel-footer" style="padding-top: 0px;">
        <!--        <div class="row">
                    <div class="col-md-8" style="padding-top:8px;">
                    </div>
                    <div class="col-md-4" style="padding-top:8px;padding-bottom: 8px;padding-right:30px;">
                        <span class="pull-right"><?php echo img("images/footer_logo.png"); ?><?php echo nbs(); ?><span style="color:#999999;">eSchool Version 4.0 (2018)</span></span>
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
    //
//        $('div#example_length.dataTables_length').append("&nbsp;&nbsp;<a href='<?php echo site_url('print-human-resources-part-07/' . $human['id']); ?>' class='btn btn-default btn-print' target='_blank'><i class='icon-print icon-large'></i> พิมพ์</a>");

    $('div#example_length.dataTables_length').append("&nbsp;&nbsp;<a href='#' class='btn btn-primary btn-insert'><i class='icon-plus icon-large'></i> เพิ่มข้อมูล</a>");

    //
    $('.btn-insert').click(function () {
        $("#insert-form").trigger("reset");
        $("h3.modal-title").text("บันทึกข้อมูลประวัติการฝึกอบรม-ศึกษาดูงาน");
        $("#hr-07-modal").modal("show");
    });
    // edit data;
    $('#example').on('click', '.btn-edit', function () {
        var uid = $(this).attr('id');
        $.ajax({
            url: '<?php echo site_url('update-human-resources-part-07'); ?>',
            method: 'post',
            data: {id: uid},
            dataType: 'json',
            success: function (data) {
                $('#id').val(data.id);
                $('#inHr07StartDatePicker').val(data.hr07_begin_date);
//                $('#inHr07BeginMonth').val(data.hr07_begin_month);
//                $('#inHr07BeginYear').val(data.hr07_begin_year);
                $('#inHr07EndDatePicker').val(data.hr07_end_date);
//                $('#inHr07EndMonth').val(data.hr07_end_month);
//                $('#inHr07EndYear').val(data.hr07_end_year);

                $('#inHr07Place').val(data.hr07_place);
                $('#inHr07Topic').val(data.hr07_topic);
                
                $('#inHr07Detail').val(data.hr07_detail);
                $('#inHr07Hour').val(data.hr07_hour);
                $('#inHr07Day').val(data.hr07_day);
                
                $('#inHr07Comment').val(data.hr07_comment);
                
                //
                $('h3.modal-title').text('ปรับปรุงข้อมูลประวัติการศึกษาดูงาน-ฝึกอบรม');
                $('.btn-add').html("<i class='icon-save icon-large'></i> บันทึก").removeClass('btn btn-success').addClass('btn btn-primary');
                $('#hr-07-modal').modal('show');
            }
        });
    });
    // delete;
    $('#example').on('click', '.btn-delete', function () {
        var uid = $(this).attr('id');
        var status = confirm('ต้องการลบข้อมูลนี้จริงหรือไม่ ?');
        if (status) {
            $.ajax({
                url: '<?php echo site_url('delete-human-resources-part-07'); ?>',
                method: 'post',
                data: {id: uid},
                success: function () {
                    location.reload();
                }
            });
        }
    });
</script>
<?php $this->load->view("human_resources/modals/hr_07_modal"); ?>