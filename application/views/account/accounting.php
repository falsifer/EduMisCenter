<div class="box">
    <div class="box-heading">ระบบงานงบประมาณ</div>
    <ul class="breadcrumb">
        <li><?php echo anchor(site_url(), "<i class='icon-home icon-large'></i> หน้าแรก"); ?></li>
        <li>ระบบบัญชี</li>
    </ul>
    <div class="box-body">
        <div class="row">
            <!-- Left Menu -->
            <div class="col-md-3 panel" style="padding: 5px;">

                <div class="col-md-12">
                    <button type="button" style="margin-bottom:5px;" class="btn btn-success btn-submenu" onclick="javascript:location.href = '<?php echo site_url('acc-code'); ?>';"><i class="icon-folder-open icon-large pull-left"></i>กำหนดรหัสบัญชี</button>
                    <button type="button" style="margin-bottom:5px;" class="btn btn-info btn-submenu" onclick="javascript:location.href = '<?php echo site_url('accounting-system'); ?>';"><i class="icon-money icon-large pull-left"></i>บันทึกรายการบัญชี</button>
                    <!--<button type="button" style="margin-bottom:5px;"  class="btn btn-primary btn-submenu" onclick="javascript:location.href = '<?php echo site_url('acc-ledger'); ?>';"><i class="icon-list icon-large pull-left"></i>บัญชีแยกประเภท</button>-->
                    <!--<button type="button" style="margin-bottom:5px;"  class="btn btn-info btn-submenu" onclick="javascript:location.href = '<?php echo site_url('ta-loan-clearing'); ?>';"><i class="icon-edit icon-large pull-left"></i>บันทึกคืนเงินยืม</button>-->
                </div>
            </div>
            <div class="col-md-9 panel" style="padding: 5px;">
                <legend class="legend-heading">บันทึกรายการบัญชี</legend>
                <div class="table-responsive">
                    <table class="table table-hover table-striped table-bordered display" id="example">
                        <thead>
                            <tr>
                                <th class="no-sort">ที่</th>
                                <th class="no-sort">วัน/เดือน/ปี</th>
                                <th class="no-sort">รายการ</th>
                                <th class="no-sort">เลขที่บัญชี</th>
                                <th class="no-sort">เดบิต</th>
                                <th class="no-sort">เครดิต</th>
                            </tr>
                        </thead>
                        <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>12/11/2561</td>
                                    <td>เงินสด</td>
                                    <td>101</td>
                                    <td>10,000.00</td>
                                    <td>-</td>
                                </tr>
                                <tr>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>เงินอุดหนุนค่าใช้จ่ายรายหัว</td>
                                    <td>41211</td>
                                    <td>-</td>
                                    <td>10,000.00</td>
                                </tr>
                        </tbody>
                    </table>
                </div>
                <!--</div>-->
            </div>
        </div>
    </div>
</div>

</div>
</div>

<div class="box-footer" style="padding-top: 0px;">
    <div class="row">
        <div class="col-md-8">
            <?php echo img("images/kml_logo.png"); ?>
        </div>
        <div class="col-md-4" style="padding-top:8px;padding-bottom: 8px;padding-right:30px;">
            <span class="pull-right"><span style="color:#999999;">eSchool Version 1.0</span></span>
        </div>
    </div>
</div>
</div>

<script>
    $(".datepicker").datepicker({autoclose: true, language: 'th'});
    $('#example').DataTable({
        "responsive": true,
        "stateSave": true,
        "bSort": false,
        "ordering": false,
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
//        if (status == "ผู้ปฏิบัติงาน") {
//            $("div#example_length.dataTables_length").append("&nbsp;&nbsp;<button type='button' class='btn btn-default btn-insert'><i class='icon-plus icon-large'></i> บันทึกข้อมูล</button>");
//        }

    $('.btn-default').on("click", function (e) {
        if (confirm($('#inStdName').html() + " " + $(this).val() + " ใช่หรือไม่?")) {
            if ($(this).val() === 'มา') {
                $(this).removeClass().addClass('btn btn-success col-md-4');
                $('#absent').removeClass().addClass('btn btn-default col-md-4');
                $('#sick').removeClass().addClass('btn btn-default col-md-4');
            } else if ($(this).val() === 'ขาด') {
                $(this).removeClass().addClass('btn btn-danger col-md-4');
                $('#checkin').removeClass().addClass('btn btn-default col-md-4');
                $('#sick').removeClass().addClass('btn btn-default col-md-4');
            } else if ($(this).val() === 'ลา') {
                $(this).removeClass().addClass('btn btn-warning col-md-4');
                $('#absent').removeClass().addClass('btn btn-default col-md-4');
                $('#checkin').removeClass().addClass('btn btn-default col-md-4');
            }
        }
    });
    $('#example2').DataTable({
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


</script>
<?php //$this->load->view("modals/vichakarn/km_detail_modal"); ?>
<?php
//$this->load->view("modals/vichakarn/km_edit_modal"); ?>