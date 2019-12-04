<div class="panel panel-primary">
    <div class="panel-heading">  กำหนดประเภทของแผน</div>
    <ul class="breadcrumb">
        <li><?php echo anchor(site_url(), "<i class='icon-home icon-large'></i> หน้าแรก"); ?></li>
        <li><?php echo anchor("provice-strategies-definetion", "แผนยุทธศาสตร์จังหวัด"); ?></li>
        <li><?php echo anchor("localgov-strategies-definetion", "แผนยุทธศาสน์ อปท."); ?></li>
        <li>กำหนดประเภทของแผน</li>
    </ul>
    <div class="panel-body">
        <div class="table-responsive">
            <table class="table table-hover table-striped table-bordered display" id="example">
                <thead>
                    <tr>
                        <th style="width:40px;">ที่</th>
                        <th class="no-sort">ประเภทแผนงานโครงการ</th>
                        <?php if ($this->session->userdata("status") == "ผู้ปฏิบัติงาน" && $this->session->userdata("responsible") == "งานวิชาการ"): ?>
                            <th style="width:10%;" class="no-sort"></th>
                        <?php endif; ?>
                    </tr>
                </thead>
                <tbody>
                    <?php $row = 1; ?>
                    <?php foreach ($rs as $r): ?>
                        <tr>
                            <td style="text-align:center;"><?php echo $row; ?></td>
                            <td><?php echo $r['localgov_plan_type'] ?></td>
                            <?php if ($this->session->userdata("status") == "ผู้ปฏิบัติงาน" && $this->session->userdata("responsible") == "งานวิชาการ"): ?>
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
    $("div#example_length.dataTables_length").append("&nbsp;<button class='btn btn-default btn-insert'><i class='icon-print icon-large'></i> พิมพ์ข้อมูล</button>");
    $("div#example_length.dataTables_length").append("&nbsp;<button class='btn btn-default btn-insert'><i class='icon-plus icon-large'></i> บันทึก</button>");
    //
    $(".btn-insert").click(function () {
        $("#insert-form").trigger("reset");
        $("h3.modal-title").text("บันทึกประเภทแผนงาน");
        $("#localgov-plan-type-modal").modal("show");
    });
    // แก้ไขข้อมูลแผนงานโครงการ
    $("#example").on("click", ".btn-edit", function () {
        var uid = $(this).attr('id');
        $.ajax({
            url: "<?php echo site_url('update-localgov-plan-type'); ?>",
            method: "post",
            data: {id: uid},
            dataType: "json",
            success: function (data) {
                $("#id").val(data.id);
                $("#inLocalgovPlanType").val(data.localgov_plan_type);
                //
                $("h3.modal-title").text("ปรับปรุงข้อมูลประเภทแผนงานโครงการ");
                $("#localgov-plan-type-modal").modal("show");
            }
        });
    });
    // ลบข้อมูลประเภทแผนการดำเนินงาน
    $("#example").on("click", ".btn-delete", function () {
        var uid = $(this).attr("id");
        var status = confirm("ต้องการลบข้อมูลนี้จริงหรือไม่ ?");
        if (status) {
            $.ajax({
                url:"<?php echo site_url('delete-localgov-plan-type'); ?>",
                method:"post",
                data:{id:uid},
                success:function(data){
                    location.reload();
                }
            });
        }
    });
</script>
<?php $this->load->view("education_plan/modals/localgov_plan_type_modal"); ?>