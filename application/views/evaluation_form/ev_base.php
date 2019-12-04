<div class="box">
    <div class="box-heading">รายชื่อผู้รับการประเมิน</div>
    <ul class="breadcrumb">
        <li><?php echo anchor(site_url(), "<i class='icon-home icon-large'></i> หน้าแรก"); ?></li>
        <li>รายชื่อผู้รับการประเมิน</li>
    </ul>
    <div class="box-body">
        <div class="table-responsive">
            <table class="table table-hover table-striped table-bordered display" id="example">
                <thead>
                    <tr>
                        <th style="width:40px;">ที่</th>
          
                        <th class="no-sort">สังกัด</th>
                        <th class="no-sort">คะแนนที่ได้ร้อยละ</th>
                        <th class="no-sort">ผลการประเมิน</th>
                        <?php if ($this->session->userdata("status") == "ผู้ปฏิบัติงาน" /*&& $this->session->userdata("responsible") == "งานธุรการ"*/): ?>
                            <th style="width:13%;" class="no-sort"></th>
                        <?php endif; ?>
                    </tr>
                </thead>
                <tbody>
                    <?php $row = 1; ?>
                    <?php foreach ($rs as $r): ?>
                        <tr>
                            <td style="text-align: center;"><?php echo $row; ?></td>
                            
                            <td>กองการศึกษา</td>
                            <td><?php echo $r['ev_score']; ?>/100</td>
                            <?php if ($r['ev_score'] >= 50) : ?>
                                <td>ผ่าน</td>
                            <?php endif; ?>
                            <?php if ($r['ev_score'] < 50) : ?>
                                <td>ไม่ผ่าน</td>
                            <?php endif; ?>
                            <?php if ($this->session->userdata("status") == "ผู้ปฏิบัติงาน" /*&& $this->session->userdata("responsible") == "งานธุรการ"*/): ?>
                                <td style="text-align:center;">
                                    <button type="button" class="btn btn-warning btn-edit" id="<?php echo $r['id']; ?>"><i class="icon-pencil icon-large"></i> เริ่มการประเมิน</button>
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

    // append insert button
    var status = "<?php echo $this->session->userdata('status'); ?>";
    var res = "<?php echo $this->session->userdata('responsible'); ?>";
    if (status == "ผู้ปฏิบัติงาน") {
        $("div#example_length.dataTables_length").append("&nbsp;&nbsp;<button type='button' class='btn btn-default btn-insert'><i class='icon-plus icon-large'></i> หัวข้อที่ใช้ประเมิน</button>");
    }
    $(".btn-insert").on("click", function () {
        location.href = "<?php echo site_url('ev-insert-view'); ?>";
    });

    $("#example").on("click", ".btn-edit", function () {
        location.href = "<?php echo site_url('ev-form'); ?>";
    });

</script>


<?php $this->load->view("evaluation_form/ev_modal"); ?>