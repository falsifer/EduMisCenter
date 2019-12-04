<div class="panel panel-primary">
    <div class="panel-heading">  ข้อมูลการปฏิบัติงานของบุคลากร</div>
    <ul class="breadcrumb">
        <li><?php echo anchor(site_url(), "<i class='icon-home icon-large'></i> หน้าแรก"); ?></li>
        <li>ข้อมูลการปฏิบัติงาน</li>
    </ul>
    <div class="panel-body">
        <div class="table-responsive">
            <table class="table table-hover table-striped table-bordered" id="example">
                <thead>
                    <tr>
                        <th style="width:40px;" rowspan="2" class="no-sort">ที่</th>
                        <th class="no-sort" rowspan="2">วันที่บันทึก</th>
                        <th class="no-sort" rowspan="2">ชื่อ-นามสกุล บุคลากร</th>
                        <th class="no-sort" colspan="9">ข้อมูลการปฏิบัติราชการ</th>
                        <th class="no-sort" rowspan="2" style="width:130px;">จากวันที่ - วันที่</th>
                        <?php if ($this->session->userdata("status") == "ผู้ปฏิบัติงาน"): ?>
                            <th class="no-sort" rowspan="2" style="width:13%;"></th>
                        <?php endif; ?>
                    </tr>
                    <tr>
                        <th class="no-sort" style="width:6%;">มาทำงาน</th>
                        <th class="no-sort" style="width:6%;">ลาป่วย</th>
                        <th class="no-sort" style="width:6%;">ลากิจ</th>
                        <th class="no-sort" style="width:6%;">ขาด</th>
                        <th class="no-sort" style="width:6%;">ไป<br/>ราชการ</th>
                        <th class="no-sort" style="width:6%;">ลาพักผ่อน</th>
                        <th class="no-sort" style="width:6%;">ลาคลอด</th>
                        <th class="no-sort" style="width:6%;">ลาบวช<br/>/ฮัจช์</th>
                        <th class="no-sort" style="width:6%;">ลา<br/>ศึกษาต่อ</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $row = 1; ?>
                    <?php foreach ($rs as $r): ?>
                        <tr>
                            <td style="text-align:center;"><?php echo $row; ?></td>
                            <td><?php echo shortdate($r['activities_date_record']); ?></td>
                            <td><?php echo $r['hr_thai_symbol']; ?><?php echo $r['hr_thai_name']; ?> <?php echo $r['hr_thai_lastname']; ?></td>
                            <?php if ($r['hr_activities'] == 'มาทำงาน'): ?>
                                <td style="text-align:center;"><?php echo img('images/checked.png'); ?></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            <?php elseif ($r['hr_activities'] == 'ลาป่วย'): ?>
                                <td></td>
                                <td style="text-align:center;"><?php echo img('images/checked.png'); ?></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            <?php elseif ($r['hr_activities'] == 'ลากิจ'): ?>
                                <td></td>
                                <td></td>
                                <td style="text-align:center;"><?php echo img('images/checked.png'); ?></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            <?php elseif ($r['hr_activities'] == 'ขาด'): ?>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td style="text-align:center;"><?php echo img('images/checked.png'); ?></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            <?php elseif ($r['hr_activities'] == 'ไปราชการ'): ?>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td style="text-align:center;"><?php echo img('images/checked.png'); ?></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            <?php elseif ($r['hr_activities'] == 'ลาพักผ่อน'): ?>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td style="text-align:center;"><?php echo img('images/checked.png'); ?></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            <?php elseif ($r['hr_activities'] == 'ลาคลอด'): ?>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td style="text-align:center;"><?php echo img('images/checked.png'); ?></td>
                                <td></td>
                                <td></td>
                            <?php elseif ($r['hr_activities'] == 'ลาบวช/ฮัจช์'): ?>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td style="text-align:center;"><?php echo img('images/checked.png'); ?></td>
                                <td></td>
                            <?php elseif ($r['hr_activities'] == 'ลาศึกษาต่อ'): ?>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td style="text-align:center;"><?php echo img('images/checked.png'); ?></td>
                            <?php endif; ?>
                                <td>
                                    <?php echo shortdate($r['activities_begin_date']);?> - <?php echo shortdate($r['activities_end_date']); ?>
                                </td>
                            <?php if ($this->session->userdata("status") == "ผู้ปฏิบัติงาน"): ?>
                                <td>
                                    <button type="button" class="btn btn-warning btn-edit" id="<?php echo $r['id']; ?>"><i class="icon-pencil icon-large"></i> แก้ไข</button>
                                    <button type="button" class="btn btn-danger btn-delete" id="<?php echo $r['id']; ?>"><i class="icon-trash icon-large"></i> ลบ</button>
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
    <?php
        $tabName = "example";
        $text = "ข้อมูลการปฏิบัติงานของบุคลากร";
        $title = $this->Echo_Text_Model->head_logo($text,$this->session->userdata('sch_id'));
        $colStr = "0,1,2,3,4,5,6,7,8,9,10,11,12";
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
    //
    var status = "<?php echo $this->session->userdata("status"); ?>";
    var responsible = "<?php echo $this->session->userdata('responsible'); ?>";
    if (status == "ผู้ปฏิบัติงาน") {
        $("div#example_length.dataTables_length").append("&nbsp;<button class='btn btn-primary btn-insert'><i class='icon-plus icon-large'></i> เพิ่มข้อมูล</button>");
    }
    //
    $(".btn-insert").click(function () {
        $("#insert-form").trigger("reset");
        $("h3.modal-title").text("บันทึกการปฏิบัติงานของบุคลากร");
        $("#employee-modal").modal("show");
    });
    // edit data;
    $("#example").on("click", ".btn-edit", function () {
        var uid = $(this).attr("id");
        $.ajax({
            url: "<?php echo site_url('update-employee-activities'); ?>",
            method: "post",
            data: {id: uid},
            dataType: "JSON",
            success: function (data) {
                $("#id").val(data.id);
                $("#inHrDateRecord").val(data.activities_date_record);
                $("#inHrId").val(data.hr_id);
                $("#inHrActivities").val(data.hr_activities);
                $('#inActivitiesBeginDate').val(data.activities_begin_date);
                $('#inActivitiesEndDate').val(data.activities_end_date);
                $('#inActivitiesComment').val(data.activities_comment);
                $("h3.modal-title").text("ปรับปรุงข้อมูลการปฏิบัติงานของบุคลากร");
                $("#employee-modal").modal("show");
            }
        });
    });
    // delete data;
    $("#example").on("click", ".btn-delete", function () {
        var uid = $(this).attr('id');
        var status = confirm('ต้องการลบช้อมูลนี้จริงหรือไม่ ?');
        if (status) {
            $.ajax({
                url: "<?php echo site_url('delete-employee-activities'); ?>",
                method: "POST",
                data: {id: uid},
                success: function (data) {
                    location.reload();
                }
            });
        }
    });
</script>
<?php $this->load->view("employee_activities/employee_modal"); ?>