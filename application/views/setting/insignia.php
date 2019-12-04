<div class="panel panel-primary">
    <div class="panel-heading">ประเภทเครื่องราชอิสริยาภรณ์</div>
    <ul class="breadcrumb">
        <li><?php echo anchor(site_url(), "<i class='icon-home icon-large'></i> หน้าแรก"); ?></li>
        <li>ประเภทเครื่องราชฯ</li>
    </ul>
    <div class="panel-body">
        <div class="table-responsive">
            <table class="table table-hover table-striped table-bordered display" id="example">
                <thead>
                    <tr>
                        <th style="width:40px;">ที่</th>
                        <th class="no-sort">ประเภทเครื่องราชอิสริยาภรณ์</th>
                        <th class="no-sort">ภาพแพรแถบ</th>
                        <th class="no-sort">ภาพเหรียญตรา</th>
                        <th style="width:15%;" class="no-sort"></th>
                    </tr>
                </thead>
                <tbody>
                    <?php $row = 1; ?>
                    <?php foreach ($rs as $r): ?>
                        <tr>
                            <td style="text-align:center;"><?php echo $row; ?></td>
                            <td><?php echo $r['insignia_name']; ?></td>
                            <td style="text-align:center;">
                                <?php if (file_exists('upload/' . $r['insignia_label_image']) && !empty($r['insignia_label_image'])): ?>
                                <a href="<?php echo base_url().'upload/'.$r['insignia_label_image']; ?>" rel="lytebox"><img src="<?php echo base_url('upload/' . $r['insignia_label_image']); ?>" style="width:90px;height:30px;" /></a>
                                <?php endif; ?>
                            </td>
                            <td style="text-align:center;">
                                <!--
                                <?php if (file_exists('upload/' . $r['insignai_coin_image']) && !empty($r['insignia_coin_image'])): ?>
                                <a href="<?php echo base_url().'upload/'.$r['insignia_coin_image'] ?>" rel="lytebox"><img src="<?php echo base_url('upload/' . $r['insignia_coin_image']); ?>" style="width:30px;height:55px;" /></a>
                                <?php endif; ?>
                                -->
                            </td>
                            <td style="text-align:center;">
                                <button type="button" class="col-md-6 btn btn-warning btn-edit" id="<?php echo $r['id']; ?>"><i class="icon-pencil icon-large"></i> แก้ไข</button>
                                <button type="button" class="col-md-6 btn btn-danger btn-delete" id="<?php echo $r['id']; ?>"><i class="icon-trash icon-large"></i> ลบ</button>
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
//    $("div#example_length.dataTables_length").append("&nbsp;<button class='btn btn-default btn-insert'><i class='icon-print icon-large'></i> พิมพ์ข้อมูล</button>");
    $("div#example_length.dataTables_length").append("&nbsp;<button class='btn btn-primary btn-insert'><i class='icon-plus icon-large'></i> เพิ่มข้อมูล</button>");
    //
    $(".btn-insert").click(function () {
        $("#insert-form").trigger("reset");
        $("h3.modal-title").text("บันทึกเครื่องราชอิสริยาภรณ์");
        $("#insignia-modal").modal("show");
    });
    // Tool tips;
    $(function () {
        $('[data-toggle="tooltip"]').tooltip();
    });
    //
    $("#example").on("click", ".btn-edit", function () {
        var uid = $(this).attr("id");
        $.ajax({
            url: "<?php echo site_url('update-insignia-data'); ?>",
            method: 'POST',
            data: {id: uid},
            dataType: 'JSON',
            success: function (data) {
                $('#id').val(data.id);
                $('#inSigniaName').val(data.insignia_name);
                //
                $('h3.modal-title').text('ปรับปรุงข้อมูลเครื่องราชฯ');
                $('#insignia-modal').modal('show');
            }
        });
    });
    // delete data
    $('#example').on('click', '.btn-delete', function () {
        var uid = $(this).attr('id');
        var status = confirm('ต้องการลบข้อมูลนี้จริงหรือไม่ ?');
        if (status) {
            $.ajax({
                url: '<?php echo site_url('delete-insignia-data'); ?>',
                method: 'post',
                data: {id: uid},
                success: function (data) {
                    location.reload();
                }
            });
        }
    });
</script>
<?php $this->load->view('modals/insignia_modal'); ?>