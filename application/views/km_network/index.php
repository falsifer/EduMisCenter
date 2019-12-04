<div class="panel panel-primary">
    <div class="panel-heading">เครือข่ายข้อมูลสารสนเทศทางการศึกษา</div>
    <ul class="breadcrumb">
        <li><?php echo anchor(site_url(), "<i class='icon-home icon-large'></i> หน้าแรก"); ?></li>
        <li>เครือข่ายข้อมูลสารสนเทศฯ</li>
    </ul>
    <div class="panel-body">
        <div class="table-responsive">
            <table class="table table-hover table-striped table-bordered display" id="example">
                <thead>
                    <tr>
                        <th style="width:40px;">ที่</th>
                        <th class="no-sort">วันที่นำเสนอ</th>
                        <th class="no-sort">หัวข้อการนำเสนอ</th>
                        <th class="no-sort">วัตถุประสงค์</th>
                        <th class="no-sort">ภาพ 1</th>
                        <th class="no-sort">ภาพ 2</th>
                        <th class="no-sort">ภาพ 3</th>
                        <th class="no-sort">ภาพ 4</th>
                        <th class="no-sort">เอกสาร</th>
                        <th class="no-sort">ผู้นำเสนอ</th>
                        <?php if ($this->session->userdata("status") == "ผู้ปฏิบัติงาน"): ?>
                            <th style="width:13%;" class="no-sort"></th>
                        <?php endif; ?>
                    </tr>
                </thead>
                <tbody>
                    <?php $row = 1; ?>
                    <?php foreach ($rs as $r): ?>
                        <tr>
                            <td style="text-align:center;"><?php echo $row; ?></td>
                            <td><?php echo datethai($r['km_network_date']); ?></td>
                            <td><button class="btn btn-link km-detail" id="<?php echo $r['id']; ?>"><?php echo $r['km_network_topic']; ?></button></td>
                            <td><?php echo $r['km_network_purpose']; ?></td>
                            <td style="text-align:center;">
                                <?php if (file_exists('upload/' . $r['km_network_img1']) && !empty($r['km_network_img1'])): ?>
                                    <?php echo anchor(base_url() . "upload/" . $r['km_network_img1'], img("images/camera.png"), array("rel" => "lytebox")); ?>
                                <?php endif; ?>
                            </td>
                            <td style="text-align:center;">
                                <?php if (file_exists('upload/' . $r['km_network_img2']) && !empty($r['km_network_img2'])): ?>
                                    <?php echo anchor(base_url() . "upload/" . $r['km_network_img2'], img("images/camera.png"), array("rel" => "lytebox")); ?>
                                <?php endif; ?>

                            </td>
                            <td style="text-align:center;">
                                <?php if (file_exists('upload/' . $r['km_network_img3']) && !empty($r['km_network_img3'])): ?>
                                    <?php echo anchor(base_url() . "upload/" . $r['km_network_img3'], img("images/camera.png"), array("rel" => "lytebox")); ?>
                                <?php endif; ?>

                            </td>
                            <td style="text-align:center;">
                                <?php if (file_exists('upload/' . $r['km_network_img4']) && !empty($r['km_network_img4'])): ?>
                                    <?php echo anchor(base_url() . "upload/" . $r['km_network_img4'], img("images/camera.png"), array("rel" => "lytebox")); ?>
                                <?php endif; ?>

                            </td>
                            <td style="text-align:center;">
                                <?php if (file_exists('upload/' . $r['km_network_doc']) && !empty($r['km_network_doc'])): ?>
                                    <?php echo anchor(base_url() . "upload/" . $r['km_network_doc'], img('images/pdf.png'), array("target" => "_blank")); ?>
                                <?php endif; ?>

                            </td>
                            <td><?php echo $r['km_network_owner']; ?></td>
                            <td>
                                <?php if ($this->session->userdata('status') == 'ผู้ปฏิบัติงาน' && $this->session->userdata('name') == $r['km_network_owner']): ?>
                                    <button type="button" class="btn btn-warning btn-edit" id="<?php echo $r['id']; ?>"><i class="icon-pencil icon-large"></i> แก้ไข</button>
                                    <button type="button" class="btn btn-danger btn-delete" id="<?php echo $r['id']; ?>"><i class="icon-trash icon-large"></i> ลบ</button>
                                <?php endif; ?>
                            </td>
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
    //
    var status = "<?php echo $this->session->userdata("status"); ?>";
    $("div#example_length.dataTables_length").append("&nbsp;<button class='btn btn-default btn-insert'><i class='icon-plus icon-large'></i> บันทึก</button>");
    //
    $(".btn-insert").click(function () {
        $("#insert-form").trigger("reset");
        $("h3.modal-title").text("บันทึก");
        $("#km-network-modal").modal("show");
    });
    // press km detail link
    $(".km-detail").click(function () {
        var uid = $(this).attr("id");
        $.ajax({
            url: '<?php echo site_url('km-network-show-detail'); ?>',
            method: 'post',
            data: {id: uid},
            success: function (data) {
                $("h3.modal-title").text("รายละเอียด");
                $("#detail").html(data);
                $("#km-detail-modal").modal("show");
            }
        });
    });
    // edit data;
    $("#example").on("click", ".btn-edit", function () {
        var uid = $(this).attr("id");
        $.ajax({
            url: "<?php echo site_url("update-network-of-km"); ?>",
            method: "post",
            data: {id: uid},
            dataType: 'json',
            success: function (data) {
                $("#id").val(data.id);
                $("#inKmNetworkDate").val(data.km_network_date);
                $("#inKmNetworkTopic").val(data.km_network_topic);
                $("#inKmNetworkPurpose").val(data.km_network_purpose);
                $("#inKmNetworkDetail").val(data.km_network_detail);
                // 
                $("h3.modal-title").text("ปรับปรุงข้อมูล");
                $("#km-network-modal").modal("show");
            }
        });
    });
    // delete
    $("#example").on("click", ".btn-delete", function () {
        var uid = $(this).attr('id');
        var status = confirm('ต้องการลบข้อมูลนี้จริงหรือไม่ ?');
        if (status) {
            $.ajax({
                url: "<?php echo site_url("delete-network-of-km"); ?>",
                method: "post",
                data: {id: uid},
                success: function (data) {
                    location.reload();
                }
            });
        }
    });

</script>
<?php $this->load->view("km_network/km_network_modal"); ?>
<?php $this->load->view("km_network/km_detail_modal"); ?>