<div class="panel panel-primary">
    <div class="panel-heading">  ข้อมูลองค์กรปกครองส่วนท้องถิ่น</div>
    <ul class="breadcrumb">
        <li><?php echo anchor(site_url(), "<i class='icon-home icon-large'></i> หน้าแรก"); ?></li>
        <li><?php echo anchor('administrator', 'ส่วนการจัดการระบบ'); ?></li>
        <li>รายละเอียด</li>
    </ul>
    <div class="panel-body">
        <div class="table-responsive">
            <table class="table table-hover table-striped table-bordered display" id="example">
                <thead>
                    <tr>
                        <th style="width:40px;">ที่</th>
                        <th class="no-sort">ชื่อองค์กรปกครองส่วนท้องถิ่น</th>
                        <th class="no-sort">ตำบล</th>
                        <th class="no-sort">อำเภอ</th>
                        <th class="no-sort">จังหวัด</th>
                        <th class="no-sort">email</th>
                        <th class="no-sort">website</th>
                        <th style="width:13%;" class="no-sort"></th>

                    </tr>
                </thead>
                <tbody>
                    <?php $row = 1; ?>
                    <?php foreach ($rs as $r): ?>
                        <tr>
                            <td style="text-align: center;"><?php echo $row; ?></td>
                            <td><button class="btn btn-link btn-detail" id="<?php echo $r['id']; ?>"><?php echo $r['localgov_thai_name']; ?></button></td>
                            <td><?php echo $r['localgov_add_tambon']; ?></td>
                            <td><?php echo $r['localgov_add_amphur']; ?></td>
                            <td><?php echo $r['localgov_add_province']; ?></td>
                            <td><?php echo $r['localgov_add_email']; ?></td>
                            <td><?php echo $r['localgov_add_website']; ?></td>
                            <td style="text-align:center;">
                                <button type="button" class="btn btn-warning btn-edit" id="<?php echo $r['id']; ?>"><i class="icon-pencil icon-large"></i> แก้ไข</button>
                                <button type="button" class="btn btn-danger btn-delete" id="<?php echo $r['id']; ?>"><i class="icon-trash icon-large"></i> ลบ</button>
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
    // append insert button

    $("div#example_length.dataTables_length").append("&nbsp;&nbsp;<button type='button' class='btn btn-default btn-insert'><i class='icon-plus icon-large'></i> บันทึก</button>");


    // press btn-insert;
    $(".btn-insert").click(function () {
        $("#insert-form").trigger('reset');
        $("h3.modal-title").text("บันทึกรายละเอียดองค์กรปกครองส่วนท้องถิ่น");
        $("#insert-modal").modal("show");
    });
    // edit
    $("#example").on("click", ".btn-edit", function () {
        var uid = $(this).attr("id");
        $.ajax({
            url: "<?php echo site_url('setting/localgov_edit'); ?>",
            method: "POST",
            data: {id: uid},
            dataType: "JSON",
            success: function (data) {
                $("#id").val(data.id);
                $('#inLocalgovThaiName').val(data.localgov_thai_name);
                $("#inLocalgovEngName").val(data.localgov_eng_name);
                $("#inLocalgovTypeId").val(data.localgov_type_id);
                $("#inLocalgovAddNo").val(data.localgov_add_no);
                $("#inLocalgovAddMoo").val(data.localgov_add_moo);
                $("#inLocalgovAddVillage").val(data.localgov_add_village);
                $("#inLocalgovAddStreet").val(data.localgov_add_street);
                $("#inLocalgovAddTambon").val(data.localgov_add_tambon);
                $("#inLocalgovAddAmphur").val(data.localgov_add_amphur);
                $("#inLocalgovAddProvince").val(data.localgov_add_province);
                $("#inLocalgovAddZipcode").val(data.localgov_add_zipcode);
                $("#inLocalgovAddTelephone").val(data.localgov_add_telephone);
                $("#inLocalgovAddFax").val(data.localgov_add_fax);
                $("#inLocalgovAddEmail").val(data.localgov_add_email);
                $("#inLocalgovAddWebsite").val(data.localgov_add_website);
                $("#inLocalgovAddLat").val(data.localgov_add_lat);
                $("#inLocalgovAddLong").val(data.localgov_add_long);
                $("#inLocalgovBeginDay").val(data.localgov_begin_day);
                $("#inLocalgovBeginMonth").val(data.localgov_begin_month);
                $("#inLocalgovBeginYear").val(data.localgov_begin_year);

                // 
                $('h3.modal-title').text('แก้ไขข้อมูลองค์กรปกครองส่วนท้องถิ่น');
                $('#insert-modal').modal('show');
            }
        });
    });

    // detail
    $("#example").on("click", ".btn-detail", function () {
        var uid = $(this).attr("id");
        $.ajax({
            url: "<?php echo site_url('setting/localgov_each_detail'); ?>",
            method: "POST",
            data: {id: uid},
            success: function (data) {
                $("#detail").html(data);
                $("h3.modal-title").text("รายละเอียดองค์กรปกครองส่วนท้องถิ่น");
                $("#my-modal").modal("show");
            }
        });
    });

    // delete data;
    $('#example').on('click', '.btn-delete', function () {
        var uid = $(this).attr('id');
        var status = confirm('ต้องการลบข้อมูลนี้จริงหรือไม่ ?');
        if (status) {
            $.ajax({
                url: '<?php echo site_url('setting/localgov_delete'); ?>',
                method: 'post',
                data: {id: uid},
                success: function (data) {
                    location.reload();
                }
            });
        }
    });
</script>
<?php $this->load->view("modals/localgov_modal"); ?>
<?php $this->load->view("modals/localgov_data_modal"); ?>