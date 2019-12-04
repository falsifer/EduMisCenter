<div class="box">
    <div class="box-heading">การพัฒนาบุคลากรทางการศึกษา</div>
    <ul class="breadcrumb">
        <li><?php echo anchor(site_url(), "<i class='icon-home icon-large'></i> หน้าแรก"); ?></li>
        <li>การพัฒนาบุคลาการทางการศึกษา</li>
    </ul>
    <div class="box-body">
        <div class="table-responsive">
            <table class="table table-hover table-striped table-bordered display" id="example">
                <thead>
                    <tr>
                        <th style="width:40px;">ที่</th>
                        <th class="no-sort">ชื่อบุคลากร</th>
                        <th class="no-sort">วันที่ดำเนินงาน</th>
                        <th class="no-sort">ชื่อหลักสูตร</th>
                        <th class="no-sort">สถานที่</th>
                        <th class="no-sort">ระยะเวลา (วัน)</th>
                        <th class="no-sort">ระยะเวลา (ชั่วโมง)</th>
                        <th class="no-sort">งบประมาณ (บาท)</th>
                        <th class="no-sort">หน่วยงานที่จัด</th>
                        <th class="no-sort">ภาพวุฒิบัตร</th>
                        <?php if ($this->session->userdata("") == ""): ?>
                            <th style="width:13%;" class="no-sort"></th>
                        <?php endif; ?>
                    </tr>
                </thead>
                <tbody>
                    <?php $row = 1; ?>
                    <?php foreach ($rs as $r): ?>
                        <tr>
                            <td style="text-align:center;"><?php echo $row; ?></td>
                            <td style="text-align:center;"><?php echo $r['hr_thai_symbol']; ?><?php echo $r['hr_thai_name']; ?>  <?php echo $r['hr_thai_lastname']; ?></td>
                            <td><?php echo datethai($r['upgrade_date']); ?></td>
                            <td><?php echo $r['upgrade_topic'] ?></td>
                            <td><?php echo $r['upgrade_place']; ?></td>
                            <td><?php echo $r['upgrade_days'] ?></td>
                            <td><?php echo $r['upgrade_hour'] ?></td>                            
                            <td><?php echo number_format($r['upgrade_loan'], 2, '.', ','); ?></td>
                            <td><?php echo $r['upgrade_own_department']; ?></td>
                            <td>
                                <?php
                                if (file_exists("upload/" . $r['upgrade_report']) && !empty($r['upgrade_report'])) {
                                    echo anchor(base_url() . "upload/" . $r['upgrade_report'], "ไฟล์ข้อมูล", array("target" => "_blank"));
                                }
                                ?>
                            </td>
                            <?php if ($this->session->userdata("status") == "ผู้ปฏิบัติงาน"): ?>
                                <td style="text-align:center;">
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
    var status = "<?php echo $this->session->userdata("status"); ?>";
    //$("div#example_length.dataTables_length").append("&nbsp;<button class='btn btn-default btn-insert'><i class='icon-print icon-large'></i> พิมพ์ข้อมูล</button>");
    if (status == "ผู้ปฏิบัติงาน") {
        $("div#example_length.dataTables_length").append("&nbsp;<button class='btn btn-default btn-insert'><i class='icon-plus icon-large'></i> บันทึกข้อมูล</button>");

    }
    //
    $(".btn-insert").click(function () {
        $("#insert-form").trigger("reset");
        $("h3.modal-title").text("บันทึกข้อมูล");
        $("#hr-dev-modal").modal("show");
    });
    // edit data;
    $("#example").on("click", ".btn-edit", function () {
        var uid = $(this).attr('id');
        $.ajax({
            url: '<?php echo site_url('update-human-resources-dev'); ?>',
            method: 'post',
            data: {id: uid},
            dataType: 'json',
            success: function (data) {
                $("#id").val(data.id);
                $("#inUpgradeDate").val(data.upgrade_date);
                $("#inUpgradeTopic").val(data.upgrade_topic);
                $("#inUpgradePlace").val(data.upgrade_place);
                $("#inUpgradeDays").val(data.upgrade_days);
                $("#inUpgradeHour").val(data.upgrade_hour);
                $("#inUpgradeOwnDepartment").val(data.upgrade_own_department);
                $("#inHrName").val(data.aid);
                $("#inUpgradeLoan").val(data.upgrade_loan);

                //
                $("h3.modal-title").text("ปรับปรุงข้อมูล");
                $("#hr-dev-modal").modal("show");
            }
        });
    });
    // delete data;
    $("#example").on("click", ".btn-delete", function () {
        var uid = $(this).attr('id');
        var status = confirm('ต้องการลบข้อมูลนี้จริงหรือไม่ ?');
        if (status) {
            $.ajax({
                url: "<?php echo site_url('delete-human-resources-dev'); ?>",
                method: "post",
                data: {id: uid},
                success: function (data) {
                    location.reload();
                }
            });
        }
    });
</script>
<?php $this->load->view("hr_development/hr_dev_modal"); ?>