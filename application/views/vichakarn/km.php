<div class="box">
    <div class="box-heading">แหล่งเรียนรู้ภายใน-ภายนอก</div>
    <ul class="breadcrumb">
        <li><?php echo anchor(site_url(), "<i class='icon-home icon-large'></i> หน้าแรก"); ?></li>
<!--        <li><?php echo anchor('administrator', 'ส่วนการจัดการระบบ'); ?></li>-->
        <li>แหล่งเรียนรู้ภายใน-ภายนอก</li>
    </ul>
    <div class="box-body">
        <div class="table-responsive">
            <table class="table table-hover table-striped table-bordered display" id="example">
                <thead>
                    <tr>
                        <th style="width:40px;">ที่</th>
                        <th class="no-sort">ชื่อแหล่งเรียนรู้</th>
                        <th class="no-sort">ประเภทแหล่งเรียนรู้</th>
                        <th class="no-sort">ชนิดแหล่งเรียนรู้</th>
                        <th class="no-sort">ที่อยู่-ที่ตั้ง</th>
                        <?php if ($this->session->userdata("status") == "ผู้ปฏิบัติงาน" && $this->session->userdata("responsible") == "งานธุรการ"): ?>
                            <th style="width:13%;" class="no-sort"></th>
                        <?php endif; ?>
                    </tr>
                </thead>
                <tbody>
                    <?php $row = 1; ?>
                    <?php foreach ($rs as $r): ?>
                        <tr>
                            <td style="text-align: center;"><?php echo $row; ?></td>
                            <td><button class="btn btn-link btn-detail" id="<?php echo $r['bid']; ?>"><?php echo $r['km_name']; ?></button></td>
                            <td><?php echo $r['km_type']; ?></td>
                            <td><?php echo $r['km_kind']; ?></td>
                            <td><?php echo $r['km_add_no']; ?></td>
                            <?php if ($this->session->userdata("status") == "ผู้ปฏิบัติงาน" && $this->session->userdata("responsible") == "งานธุรการ"): ?>
                                <td style="text-align:center;">
                                    <button type="button" class="btn btn-warning btn-edit" id="<?php echo $r['bid']; ?>"><i class="icon-pencil icon-large"></i> แก้ไข</button>
                                    <button type="button" class="btn btn-danger btn-delete" id="<?php echo $r['bid']; ?>"><i class="icon-trash icon-large"></i> ลบ</button>
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
        $("div#example_length.dataTables_length").append("&nbsp;&nbsp;<button type='button' class='btn btn-primary btn-insert'><i class='icon-plus icon-large'></i> เพิ่มข้อมูล</button>");
    }
    $(".btn-insert").on("click", function () {
        location.href = "<?php echo site_url('insert-learning-center'); ?>";
    });

    // detail
    $("#example").on("click", ".btn-detail", function () {
        var uid = $(this).attr("id");
        $.ajax({
            url: "<?php echo site_url('km-base-detail'); ?>",
            method: "POST",
            data: {id: uid},
            success: function (data) {
                $("#detail").html(data);
                $("h3.modal-title").text("รายละเอียดแหล่งเรียนรู้");
                $("#km-detail-modal").modal("show");
            }
        });
    });

    // edit 
    $("#example").on("click", ".btn-edit", function () {
        var uid = $(this).attr('id');
        $.ajax({
            url: "<?php echo site_url('km-edit'); ?>",
            method: "post",
            data: {id: uid},
            dataType: "json",
            success: function (data) {
                $("#bid").val(data.bid);
                $("#inKmName").val(data.km_name);
                $("#inKmType").val(data.km_type);
                $("#inKmKind").val(data.km_kind);
                $("#inKmAddNo").val(data.km_add_no);
                $("#inKmAddMoo").val(data.km_add_moo);
                $("#inKmAddVillage").val(data.km_add_village);
                $("#inKmAddRoad").val(data.km_add_road);
                $("#inKmAddTambol").val(data.km_add_tambol);
                $("#inKmAddAmphur").val(data.km_add_amphur);
                $("#inKmAddProvince").val(data.km_add_province);
                $("#inKmAddZipcode").val(data.km_add_zipcode);
                $("#inKmPhone").val(data.km_phone);
                $("#inKmEmail").val(data.km_email);
                $("#inKmWebsite").val(data.km_website);
                $("#inKmHistory").val(data.km_history);
                $("#inKmBenefit").val(data.km_benefit);


                //
                $("h3.modal-title").text("ปรับปรุงข้อมูลแหล่งเรียนรู้");
                $("#km-edit-modal").modal("show");
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
                url: '<?php echo site_url('vichakarn/km_delete'); ?>',
                method: 'post',
                data: {id: uid},
                success: function (data) {
                    location.reload();

                }
            });
        }
    });
</script>
<?php $this->load->view("modals/vichakarn/km_detail_modal"); ?>
<?php $this->load->view("modals/vichakarn/km_edit_modal"); ?>