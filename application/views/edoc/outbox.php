<div class="container-fluid">
    <div class="box">
        <div class="box-heading">งานรับ-ส่งหนังสือ</div>
        <ul class="breadcrumb">
            <li><?php echo anchor(site_url(), "<i class='icon-home icon-large'></i> หน้าแรก"); ?></li>
            <li>ทะเบียนหนังสือส่ง</li>
        </ul>
        <div class="box-body">

            <div class="row" style="margin-bottom:10px;">
                <div class="col-md-12">
                    <button type="button" class="btn btn-default btn-inbox"><i class="icon-inbox icon-large"></i> หนังสือเข้า</button>
                    <button type="button" class="btn btn-primary btn-outbox"><i class="icon-inbox icon-large"></i> หนังสือออก</button>
                    <?php if ($this->session->userdata("status") == "ผู้ปฏิบัติงาน"): ?>
                        <?php echo nbs(); ?>
                        <button type="button" class="btn btn-default btn-send"><i class="icon-plus-sign icon-large"></i> ส่งหนังสือ</button>
                    <?php endif; ?>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-hover table-striped table-bordered display" id="example">
                    <thead>
                        <tr>
                            <th style="width:40px;">ที่</th>
                            <th class="no-sort">วันที่ส่ง</th>
                            <th class="no-sort">เลขที่หนังสือ</th>
                            <th class="no-sort">ผู้รับ</th>
                            <th class="no-sort">เรื่อง</th>
                            <th class="no-sort">ชั้นความเร็ว</th>
                            <th class="no-sort">หนังสือ</th>
                            <th class="no-sort">Status</th>
                            <?php if ($this->session->userdata("status") == "ผู้ปฏิบัติงาน"): ?>
                                <th style="width:10%;" class="no-sort"></th>
                            <?php endif; ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $row = 1; ?>
                        <?php foreach ($rs as $r): ?>
                            <tr>
                                <td style="text-align:center;"><?php echo $row; ?></td>
                                <td><?php echo shortdate($r['outbox_date']); ?></td>
                                <td><?php echo $r['outbox_send_no']; ?></td>
                                <td><?php echo $r['outbox_send_to']; ?></td>
                                <td><?php echo $r['outbox_topic']; ?></td>
                                <td style="text-align:center;"><?php echo $r['outbox_level']; ?></td>
                                <td style="text-align:center;">
                                    <?php if (file_exists("upload/" . $r['outbox_file']) && !empty($r['outbox_file'])): ?>
                                        <a href="<?php echo base_url() . 'upload/' . $r['outbox_file']; ?>" target="_blank">ดาวน์โหลด</a>
                                    <?php endif; ?>
                                </td>
                                <td><?php echo $r['outbox_status']; ?></td>
                                <?php if ($this->session->userdata("status") == "ผู้ปฏิบัติงาน"): ?>
                                    <td style="text-align:center;">
                                        <button type="button" class="btn btn-warning btn-edit" id="<?php echo $r['id']; ?>"><i class="icon-pencil icon-large"></i> EDIT</button>
                                        <button type="button" class="btn btn-danger btn-delete" id="<?php echo $r['id']; ?>"><i class="icon-trash icon-large"></i> DEL</button>
                                    </td>
                                <?php endif; ?>

                            </tr>
                            <?php $row++; ?>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="box-footer" style="padding-top: 0px;">
            <div class="row">
                <div class="col-md-8"></div>
                <div class="col-md-4" style="padding-top:8px;padding-bottom: 8px;padding-right:30px;">
                    <span class="pull-right"><span style="color:#999999;">eSchool Version 4.0 (2018)</span></span>
                </div>
            </div>
        </div>
    </div>
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
    $(".btn-inbox").on("click", function () {
        location.href = "<?php echo site_url('go-to-inbox'); ?>";
    });
    $(".btn-outbox").on("click", function () {
        location.href = "<?php echo site_url('go-to-outbox'); ?>";
    });
    // Send document;
    $(".btn-send").click(function () {
        $("#insert-form").trigger("reset");
        $("h3.modal-title").text("ส่งหนังสือ");
        $("#edoc-send-modal").modal("show");
    });
    // Edit data
    $('#example').on('click', '.btn-edit', function () {
        var uid = $(this).attr('id');
        $.ajax({
            url: '<?php echo site_url('update-outbox-document'); ?>',
            method: 'post',
            data: {id: uid},
            dataType: 'json',
            success: function (data) {
                $('#id').val(data.id);
                $('#inOutboxDate').val(data.outbox_date);
                $('#inOutboxSendNo').val(data.outbox_send_no);
                $('#inOutboxTopic').val(data.outbox_topic);
                $('#inOutboxAttach').val(data.outbox_attach);
                $('#inOutboxDetail').val(data.outbox_detail);
                $('#inOutboxLevel').val(data.outbox_level);
                $('#inOutboxComment').val(data.outbox_comment);
                //
                if ($('#id').val(data.id) != '') {
                    $('#send-to').html('');
                }

                //
                $('h3.modal-title').text('ปรับปรุงข้อมูลหนังสือส่ง');
                $('#edoc-send-modal').modal('show');
            }
        });
    });
    // delete edoc
    $('#example').on('click', '.btn-delete', function () {
        var uid = $(this).attr('id');
        var status = confirm('ต้องการลบข้อมูลนี้จริงหรือไม่ ?');
        if (status) {
            $.ajax({
                url: '<?php echo site_url('delete_document-to-send'); ?>',
                method: 'post',
                data: {id: uid},
                success: function (data) {
                    location.reload();
                }
            });
        }
    });
</script>
<?php $this->load->view("edoc/edoc_send_modal"); ?>