<div class="box">
    <div class="box-heading">การทัศนศึกษา</div>
    <ul class="breadcrumb">
        <li><?php echo anchor(site_url(), "<i class='icon-home icon-large'></i> หน้าแรก"); ?></li>
        <li>การทัศนศึกษา</li>
    </ul>
    <div class="box-body">

        <div class="table-responsive">
            <div class="col-md-12 col-md-offset-11">
                <button type="button" class="btn btn-info btn-page-print" onclick="PagePrint(this)"><i class="icon-print icon-large"></i> สั่งพิมพ์</button>
                <br></br>
            </div>
            <table class="table table-hover table-striped table-bordered display" id="example">
                <thead>
                    <tr>
                        <th style="width:40px;">ที่</th>
                        <th class="no-sort">ชื่อกิจกรรมทัศนศึกษา</th>

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
                            <td><button class="btn btn-link btn-detail" id="<?php echo $r['id']; ?>"><?php echo $r['tb_field_trips_content']; ?></button></td>


                            <?php if ($this->session->userdata("status") == "ผู้ปฏิบัติงาน") : ?>
                                <td style="text-align:center;">
                                    <button type="button" class="btn btn-warning btn-edit" id="<?php echo $r['id']; ?>"><i class="icon-pencil icon-large"></i> แก้ไข</button>
                                    <button type="button" class="btn btn-danger btn-delete" id="<?php echo $r['id']; ?>"><i class="icon-trash icon-large"></i> ลบ</button>
                                    <button type="button" class="btn btn-info btn-print" id="<?php echo $r['id']; ?>"><i class="icon-print icon-large"></i> สั่งพิมพ์</button>
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
    // page print
    function PagePrint(e) {
        alert("PagePrint!");
    }

    // row print 
    $("#example").on("click", ".btn-print", function () {
        var uid = $(this).attr('id');
        alert("row print ! " + uid);
    });

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
        location.href = "<?php echo site_url('field-trips-insert-view'); ?>";
    });
    // detail
    $("#example").on("click", ".btn-detail", function () {
        var uid = $(this).attr("id");
        $.ajax({
            url: "<?php echo site_url('field-trips-base-detail'); ?>",
            method: "POST",
            data: {id: uid},
            success: function (data) {
                $("#detail").html(data);
                $("h3.modal-title").text("รายละเอียดกิจกรรมทัศนศึกษา");
                $("#ft-detail-modal").modal("show");
            }
        });
    });
    // edit 
    $("#example").on("click", ".btn-edit", function () {
        var uid = $(this).attr('id');
        $.ajax({
            url: "<?php echo site_url('field-trips-edit'); ?>",
            method: "post",
            data: {id: uid},
            dataType: "json",
            success: function (data) {
                $("#id").val(data.id);
                $("#inTbFieldTripsContent").val(data.tb_field_trips_content);
                $("#inTbFieldTripsDetail").val(data.tb_field_trips_detail);
                $("#inTbFieldTripsDate").val(data.tb_field_trips_date);
                $("#inTbFieldTripsPlace").val(data.tb_field_trips_place);
                $("#inTbFieldTripsBudget").val(data.tb_field_trips_budget);
                $("#inTbFieldTripsAmount").val(data.tb_field_trips_amount);
                //------------------------------------------------//
                $("h3.modal-title").text("ปรับปรุงรายละเอียดกิจกรรมทัศนศึกษา");
                $("#ft-edit-modal").modal("show");
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
                url: '<?php echo site_url('field-trips-delete'); ?>',
                method: 'post',
                data: {id: uid},
                success: function (data) {
                    location.reload();
                }
            });
        }
    });
</script>
<?php $this->load->view("field_trips/field_trips_edit_modal"); ?>
<?php $this->load->view("field_trips/field_trips_detail_modal"); ?>