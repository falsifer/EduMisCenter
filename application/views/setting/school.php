<div class="panel panel-primary">
    <div class="panel-heading">รายชื่อโรงเรียน</div>
    <ul class="breadcrumb">
        <li><?php echo anchor(site_url(), "<i class='icon-home icon-large'></i> หน้าแรก"); ?></li>
        <li><?php echo anchor('admin-school-base', 'ส่วนการจัดการระบบ'); ?></li>
        <li>รายละเอียด</li>
    </ul>
    <div class="panel-body">
        <div class="table-responsive">
            <table class="table table-hover table-striped table-bordered display" id="example">
                <thead>
                    <tr>
                        <th style="width:40px;">ที่</th>
                        <th class="no-sort">รหัสโรงเรียน</th>
                        <th class="no-sort">ชื่อโรงเรียน</th>
                        <th class="no-sort">ประเภท</th>
                        <th class="no-sort">ผู้บริหาร</th>
                        <th class="no-sort">เครือข่าย</th>
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
                            <td><?php echo $r['sc_code']; ?></td>
                            <td><?php echo $r['sc_thai_name']; ?></td>
                            <td><?php echo $r['school_type']; ?></td>
                            <td><?php echo $r['hr_thai_symbol'] . '' . $r['hr_thai_name'] . nbs(3) . $r['hr_thai_lastname']; ?></td>
                            <td><?php echo $r['sc_network']; ?></td>
                            <?php if ($this->session->userdata("status") == "ผู้ปฏิบัติงาน"): ?>
                                <td style="text-align:center;">
                                    <button type="button" class="btn btn-warning btn-edit" id="<?php echo $r['school_id']; ?>"><i class="icon-pencil icon-large"></i> แก้ไข</button>
                                    <button type="button" class="btn btn-danger btn-delete" id="<?php echo $r['school_id']; ?>"><i class="icon-trash icon-large"></i> ลบ</button>
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
    // ตรวจสอบสิทธิ์การใช้งาน
    var status = "<?php echo $this->session->userdata('status'); ?>";
    if (status == "ผู้ปฏิบัติงาน") {
        $("div#example_length.dataTables_length").append("&nbsp;&nbsp;<button class='btn btn-primary btn-insert'><i class='icon-plus icon-large'></i> บันทึก</button>");
    }
    //
    $(".btn-insert").click(function () {
        $("#insert-form").trigger("reset");
        $("h3.modal-title").text("บันทึกโรงเรียน");
        $("#school-modal").modal("show");
    });
    // edit button 
    $("#example").on("click", ".btn-edit", function () {
        var uid = $(this).attr("id");
        $.ajax({
            url: "<?php echo site_url('update-school-data'); ?>",
            method: 'post',
            data: {id: uid},
            dataType: "json",
            success: function (data) {
                $("#id").val(data.id);
                $("#inScCode").val(data.sc_code);
                $("#inScSmis").val(data.sc_smis);
                $("#inScObec").val(data.sc_obec);
                $("#inScTypeId").val(data.school_type_id);
                $("#inScThaiName").val(data.sc_thai_name);
                $("#inScEngName").val(data.sc_eng_name);
                $("#inScSymbol").val(data.sc_symbol);
                $("#inScAddressNo").val(data.sc_address_no);
                $("#inScAddressMoo").val(data.sc_address_moo);
                $("#inScAddressVillage").val(data.sc_address_village);
                $("#inScAddressStreet").val(data.sc_address_street);
                $("#inScAddressTambon").val(data.sc_address_tambon);
                $("#inScAddressAmphur").val(data.sc_address_amphur);
                $("#inScAddressProvince").val(data.sc_address_province);
                $("#inScAddressZipcode").val(data.sc_address_zipcode);
                $("#inScAddressTelephone").val(data.sc_address_telephone);
                $("#inScAddressFax").val(data.sc_address_fax);
                $("#inScEmail").val(data.sc_email);
                $("#inScWebsite").val(data.sc_website);
                $("#inScNetwork").val(data.sc_network);
                $("#inScLocalgov").val(data.sc_localgov);
                $("#inScLongHq").val(data.sc_localgov);
                $("#inScLongAmphur").val(data.sc_long_amphur);
                $("#inScLat").val(data.sc_lat);
                $("#inScLong").val(data.sc_long);
                $("#inScBeginDay").val(data.sc_begin_day);
                $("#inScBeginMonth").val(data.sc_begin_month);
                $("#inScBeginYear").val(data.sc_begin_year);
                // 
                $("h3.modal-title").text("ปรับปรุงข้อมูลโรงเรียน");
                $("#school-modal").modal("show");

            }
        });
    });
    // delete button
    $("#example").on("click", ".btn-delete", function () {
        var uid = $(this).attr('id');
        var status = confirm('ต้องการลบข้อมูลนี้จริงหรือไม่ ?');
        if (status) {
            $.ajax({
                url: "<?php echo site_url('delete-school'); ?>",
                method: "post",
                data: {id: uid},
                success: function (data) {
                    //location.reload();
                }
            });
        }
    });
</script>
<?php $this->load->view("modals/school_modal"); ?>