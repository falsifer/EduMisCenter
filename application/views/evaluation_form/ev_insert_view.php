<div class="box">
    <div class="box-heading">เพิ่มหัวข้อที่ใช้ประเมิน</div>
    <ul class="breadcrumb">
        <li><?php echo anchor(site_url(), "<i class='icon-home icon-large'></i> หน้าแรก"); ?></li>
        <li><?php echo anchor('ev-base', "รายชื่อผู้รับการประเมิน"); ?></li>
        <li>เพิ่มหัวข้อที่ใช้ประเมิน</li>
    </ul>
    <div class="box-body">
        <div class="table-responsive">
            <table class="table table-hover table-striped table-bordered display" id="example">
                <thead>
                    <tr>
                        <th style="width:40px;">ที่</th>
                        <th class="no-sort">ชื่อหัวข้อการประเมิน</th>
                        <?php if ($this->session->userdata("status") == "ผู้ปฏิบัติงาน" /* && $this->session->userdata("responsible") == "งานธุรการ" */): ?>
                            <th style="width:13%;" class="no-sort"></th>
                        <?php endif; ?>
                    </tr>
                </thead>
                <tbody>
                    <?php $row = 1; ?>
                    <?php foreach ($rs as $r): ?>
                        <tr>
                            <td style="text-align: center;"><?php echo $row; ?></td>
                            <td><button class="btn btn-link btn-detail" id="<?php echo $r['id']; ?>"><?php echo $r['ev_basename']; ?></button></td>
                            <?php if ($this->session->userdata("status") == "ผู้ปฏิบัติงาน" /* && $this->session->userdata("responsible") == "งานธุรการ" */): ?>
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
        $("div#example_length.dataTables_length").append("&nbsp;&nbsp;<button type='button' class='btn btn-default btn-insert'><i class='icon-plus icon-large'></i> เพิ่มหัวข้อการประเมิน</button>");
    }
    $(".btn-insert").on("click", function () {
        $("h3.modal-title").text("เพิ่มหัวข้อการประเมิน");
        $("#ev-insert-modal").modal("show");
    });

    $("#example").on("click", ".btn-edit", function () {

        var uid = $(this).attr('id');
        $.ajax({
            url: "<?php echo site_url('ev-edit'); ?>",
            method: "post",
            data: {id: uid},
            dataType: "json",
            success: function (data) {

                $("#id").val(data.id);
                $("#inEvBasename").val(data.ev_basename);
                $("#inEvSubname1").val(data.ev_subname1);
                $("#inEvSubname2").val(data.ev_subname2);
                $("#inEvSubname3").val(data.ev_subname3);
                $("#inEvSubname4").val(data.ev_subname4);
                $("#inEvSubname5").val(data.ev_subname5);

                //------------------------------------------------//
                $("h3.modal-title").text("ปรับปรุงข้อมูล");
                $("#ev-insert-modal").modal("show");
            }
        });
    }
    );

    // delete 
    $('#example').on('click', '.btn-delete', function () {
        var uid = $(this).attr('id');
        var status = confirm('ต้องการลบข้อมูลนี้จริงหรือไม่ ?');
        if (status) {
            $.ajax({
                url: '<?php echo site_url('ev-delete'); ?>',
                method: 'post',
                data: {id: uid},
                success: function (data) {
                    location.reload();

                }
            });
        }
    });
</script>
<?php $this->load->view("evaluation_form/ev_insert_modal"); ?>