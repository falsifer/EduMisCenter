<div class="box">
    <div class="box-heading">แบบประเมินผลการปฏิบัติงาน</div>
    <ul class="breadcrumb">
        <li><?php echo anchor(site_url(), "<i class='icon-home icon-large'></i> หน้าแรก"); ?></li>
        <li>แบบประเมินผลการปฏิบัติงาน</li>
    </ul>
    <div class="box-body">

        <table class="table table-hover table-striped table-bordered display" id="example">
            <thead>
                <tr>
                    <th style="text-align:center; width:10%;">ที่</th>
                    <th class="no-sort" style="text-align:center; width:30%;">ชื่อ-นามสกุล</th>
                    <th class="no-sort" style="text-align:center; width:10%;">ตำแหน่ง</th>
                    <!--<th class="no-sort" style="text-align:center; width:15%;">คะแนน(คิดเป็น %)</th>-->
                    <!--<th class="no-sort" style="text-align:center; width:15%;">ผลการประเมิน</th>-->
                    <th class="no-sort" style="text-align:center; width:30%;">จัดการ</th>
                </tr>
            </thead>
            <tbody>
                <?php $row = 1; ?>
                <?php foreach ($rs as $r): ?>
                    <tr>
                        <td style="text-align:center;"><?php echo $row; ?></td>
                        <td>
                            <?php if (file_exists("upload/" . $r["hr_image"]) && !empty($r["hr_image"])): ?>
                                <?php echo img(array("src" => "upload/" . $r["hr_image"], "style" => "width:50px;height:50px;border:1px solid #ccc;border-right:1px solid #666;border-bottom:1px solid #666;")); ?>
                                <?php echo nbs(2); ?>
                            <?php endif; ?>
                            <?php echo $r['hr_thai_symbol']; ?><?php echo $r['hr_thai_name']; ?><?php echo nbs(2); ?><?php echo $r['hr_thai_lastname']; ?>
                        </td>
                        <td><?php echo $r['hr_rank']; ?></td>
    <!--                        <td>content %</td>
                        <td>content score</td>-->

                        <td style="text-align:center;">
                            <button type="button" class="btn btn-primary btn-assessment" id="<?php echo $r['id']; ?>"><i class="icon-ok icon-large"></i> ประเมินผล</button>
                            <button type="button" class="btn btn-warning btn-result" id="<?php echo $r['id']; ?>"><i class="icon-file icon-large"></i> สรุปผล</button>
                        </td>

                    </tr>
                    <?php $row++; ?>
                <?php endforeach; ?>
            </tbody>
        </table>

    </div>

    <?php $this->load->view('layout/my_school_footer'); ?>
</div>

<?php $this->load->view("ap/ap_topic_modal"); ?>
<?php $this->load->view("ap/ap_assessment_modal"); ?>
<?php $this->load->view("ap/ap_result_modal"); ?>
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
        },
    });
    $('.sorting_asc').removeClass('sorting_asc');
    //
    var status = "<?php echo $this->session->userdata("status"); ?>";
    //$("div#example_length.dataTables_length").append("&nbsp;<button class='btn btn-default btn-insert'><i class='icon-print icon-large'></i> พิมพ์ข้อมูล</button>");
    if (status == "ผู้ปฏิบัติงาน") {
        $("div#example_length.dataTables_length").append("&nbsp;<button class='btn btn-info btn-topic'><i class='icon-plus icon-large'></i> เพิ่มหัวข้อการประเมิน</button>");
    }


    var HrId = 0;
    $(".btn-topic").on("click", function () {
        $.ajax({
            url: "<?php echo site_url('Ap/get_ap_topic'); ?>",
            success: function (data) {
                $("#TopicBody").html(data);
                $("h3.modal-title").text("เพิ่มหัวข้อที่ใช้ประเมิน");
                $("#ap-topic-modal").modal("show");
            }
        });
    });


    $(".btn-assessment").on("click", function () {
        var uid = $(this).attr('id');
        $.ajax({
            url: "<?php echo site_url('Ap/get_hr_ap'); ?>",
            method: "POST",
            data: {id: uid},
            success: function (data) {
                HrId = uid;
                $("#AssessmentBody").html(data);
                $("h3.modal-title").text("ประเมินผล");
                $("#ap-assessment-modal").modal("show");
            }
        });
    });

    $(".btn-result").on("click", function () {
        var uid = $(this).attr('id');
        $.ajax({
            url: "<?php echo site_url('Ap/get_ap_result'); ?>",
            method: "POST",
            data: {id: uid},
            success: function (data) {
                HrId = uid;
                $("#ResultBody").html(data);
                $("h3.modal-title").text("สรุปผล");
                $("#ap-result-modal").modal("show");
            }
        });
    });

</script>
