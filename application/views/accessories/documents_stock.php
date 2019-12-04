<div class="panel panel-primary">
    <div class="panel-heading">คลังแบบฟอร์มเอกสาร</div>
    <ul class="breadcrumb">
        <li><?php echo anchor(site_url(), "<i class='icon-home icon-large'></i> หน้าแรก"); ?></li>
        <li>คลังแบบฟอร์มเอกสาร</li>
    </ul>
    <div class="panel-body">
        <div class="table-responsive">
            <table class="table table-hover table-striped table-bordered display" id="example">
                <thead>
                    <tr>
                        <th style="width:40px;">ที่</th>
                        <th class="no-sort">ชื่อเอกสาร</th>
                        <th class="no-sort">ประเภทเอกสาร</th>
                        <th class="no-sort">เจ้าของเอกสาร</th>
                        <th class="no-sort">ดาวน์โหลด</th>
                        <th class="no-sort">หมายเหตุ</th>
                        <?php if ($this->session->userdata("status") == "ผู้ปฏิบัติงาน"): ?>
                            <th style="width:13%;" class="no-sort"></th>
                        <?php endif; ?>
                    </tr>
                </thead>
                <tbody>
                    <?php $row = 1; ?>
                    <?php foreach ($rs as $r): ?>
                        <tr>
                            <td style="text-align: center;"><?php echo $row; ?></td>
                            <td><?php echo $r['doc_name']; ?></td>
                            <td><?php echo $r['document_type']; ?></td>
                            <td><?php echo $r['doc_owner']; ?></td>
                            <td style="text-align:center;">
                                <?php if (file_exists("upload/" . $r['doc_file']) && !empty($r['doc_file'])): ?>
                                    <?php echo anchor(base_url() . 'upload/' . $r['doc_file'], "เอกสาร", array("target" => "_blank")); ?>
                                <?php else: ?>
                                    <span style="color:#999;">เอกสาร</span>
                                <?php endif; ?>
                            </td>
                            <td><?php echo $r['doc_comment']; ?></td>
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
    var status = "<?php echo $this->session->userdata('status'); ?>";
    var res = "<?php echo $this->session->userdata('responsible'); ?>";
    if (status == "ผู้ปฏิบัติงาน") {
        $("div#example_length.dataTables_length").append("&nbsp;&nbsp;<button class='btn btn-primary btn-insert'><i class='icon-plus icon-large'></i> เพิ่มข้อมูล</button>");
    }
    //
    $(".btn-insert").click(function () {
        $("#insert-form").trigger("reset");
        $("h3.modal-title").text("บันทึกเอกสารในคลัง");
        $("#documents-stock-modal").modal('show');
    });

    // edit;
    $("#example").on("click", ".btn-edit", function () {
        var uid = $(this).attr("id");
        $.ajax({
            url: "<?php echo site_url('update-document-from-stock'); ?>",
            method: "post",
            data: {id: uid},
            dataType: "json",
            success: function (data) {
                $("#id").val(data.id);
                $("#inDocumentsName").val(data.doc_name);
                $("#inDocumentTypeId").val(data.document_type_id);
                $("#inDocInDate").val(data.doc_in_date);
                $("#inDocOwner").val(data.doc_owner);
                $("#inDocComment").val(data.doc_comment);
                //
                $("h3.modal-title").text("ปรับปรุงข้อมูลเอกสารในคลัง");
                $("#documents-stock-modal").modal("show");
            }
        });
    });

    // delete data;
    $("#example").on("click", ".btn-delete", function () {
        var uid = $(this).attr("id");
        var status = confirm("ต้องการลบข้อมูลนี้จริงหรือไม่ ?");
        if (status) {
            $.ajax({
                url: "<?php echo site_url('delete-document-form-stock'); ?>",
                method: "post",
                data: {id: uid},
                success: function () {
                    location.reload();
                }
            });
        }
    });
</script>
<?php $this->load->view("modals/accessories/documents_stock_modal"); ?>