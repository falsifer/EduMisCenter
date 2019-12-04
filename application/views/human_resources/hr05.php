<div class="panel panel-primary">
    <div class="panel-heading">ทำเนียบบุคลากร [ ประวัติการรับราชการ ] <?php echo $human['hr_thai_symbol']; ?><?php echo $human['hr_thai_name']; ?>&nbsp;&nbsp;<?php echo $human['hr_thai_lastname']; ?></div>
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
        <li>ประวัติการรับราชการ</li>
    </ul>
    <div class="panel-body">
        <!--<div class="table-responsive" style="margin-top:30px;">-->
            <table class="table table-hover table-striped table-bordered display" id="example">
                <thead>
                    <tr>
                        <th style="width:40px;">ที่</th>
                        <th class="no-sort">วัน/เดือน/ปี</th>
                        <th class="no-sort">หน่วยงาน</th>
                        <th class="no-sort">ตำแหน่ง</th>
                        <th class="no-sort">ระดับ</th>
                        <th class="no-sort">ขั้นเงินเดือน</th>
                        <th class="no-sort">เอกสารอ้างอิง</th>
                        <?php if ($this->session->userdata("status") == "ผู้ปฏิบัติงาน"): ?>
                            <th style="width:20%;" class="no-sort"></th>
                        <?php endif; ?>
                    </tr>
                </thead>
                <tbody>
                    <?php $row = 1; ?>
                    <?php foreach ($rs as $r): ?>
                        <tr>
                            <td style="text-align:center;"><?php echo $row; ?></td>
                            <td><?php echo $r['hr05_day']; ?> <?php echo month_num($r['hr05_month']); ?><?php echo nbs(2); ?><?php echo $r['hr05_year']; ?></td>
                            <td><?php echo $r['hr05_office']; ?></td>
                            <td><?php echo $r['hr05_rank']; ?></td>
                            <td><?php echo $r['hr05_level']; ?> </td>
                            <td><?php echo number_format($r['hr05_salary'], 2, '.', ','); ?></td>
                            <td style="text-align:center;">
                                <?php if (file_exists('upload/' . $r['hr05_file']) && !empty($r['hr05_file'])): ?>
                                <a href="<?php echo base_url()."upload/".$r['hr05_file'] ?>" rel="lytebox">เอกสาร</a>
                                <?php endif; ?>
                            </td>
                            <td style="text-align:center;">
                                <button type="button" class="btn btn-warning btn-edit" id="<?php echo $r['id']; ?>"><i class="icon-pencil icon-large"></i> แก้ไข</button>
                                <button type="button" class="btn btn-danger btn-delete" id="<?php echo $r['id']; ?>"><i class="icon-trash icon-large"></i> ลบ</button>
                            </td>
                        </tr>
                        <?php $row++; ?>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <!--</div>-->
    </div>

    <div class="panel-footer" style="padding-top: 0px;">
        
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
//        $('div#example_length.dataTables_length').append("&nbsp;&nbsp;<a href='<?php echo site_url('print-human-resources-part-05/'.$human['id']); ?>' class='btn btn-default btn-print' target='_blank'><i class='icon-print icon-large'></i> พิมพ์</a>");
//    var status = "<?php echo $this->session->userdata('status'); ?>";
//    if (status == 'ผู้ปฏิบัติงาน') {
        $('div#example_length.dataTables_length').append("&nbsp;&nbsp;<a href='#' class='btn btn-primary btn-insert'><i class='icon-plus icon-large'></i> เพิ่มข้อมูล</a>");
//    }
    //
    $('.btn-insert').click(function () {
        $('#insert-form').trigger('reset');
        $('h3.modal-title').text('บันทึกประวัติการรับราชการ');
        $('#hr-05-modal').modal('show');
    });

    //
    $("#insert-form").on("submit", function (e) {
        $.ajax({
            url: "<?php echo site_url('human_resources/hr05_insert'); ?>",
            method: "POST",
            data: $("#insert-form").serialize(),
            success: function (data) {
                $("#insert-form")[0].reset();
                location.reload();
            }
        });
        e.preventDefault();
    });
    //
    $("#example").on("click", ".btn-edit", function () {
        var uid = $(this).attr('id');
        $.ajax({
            url: "<?php echo site_url('update-human-resources-part-05'); ?>",
            method: "POST",
            data: {id: uid},
            dataType: "JSON",
            success: function (data) {
                $("#id").val(data.id);
                $('#inHr05Day').val(data.hr05_day);
                $('#inHr05Month').val(data.hr05_month);
                $('#inHr05Year').val(data.hr05_year);
                $('#inHr05Rank').val(data.hr05_rank);
                $('#inHr05Level').val(data.hr05_level);
                $('#inHr05Salary').val(data.hr05_salary);
                $('#inHr05Office').val(data.hr05_office);
                $('h3.modal-title').text('ปรับปรุงประวัติการรับราชการ');
                $('#hr-05-modal').modal('show');
            }
        });
    });
    //
    $("#example").on("click", ".btn-delete", function () {
        var uid = $(this).attr('id');
        var status = confirm('ต้องการลบข้อมูลนี้จริงหรือไม่ ?');
        if (status) {
            $.ajax({
                url: "<?php echo site_url('delete-human-resources-part-05'); ?>",
                method: "post",
                data: {id: uid},
                success: function (data) {
                    location.reload();
                }
            });
        }
    });
</script>
<?php $this->load->view('human_resources/modals/hr_05_modal'); ?>
