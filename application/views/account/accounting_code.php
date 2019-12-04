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
                <legend class="legend-heading">กำหนดรหัสบัญชี</legend>
                <div class="col-md-12 databox">
                    <form method="post" id="insert-income-form">
                        <div class="row" style="padding: 5px;">
                            <div class="col-md-12">
                                <label for="inFinanceDate">หมวดบัญชี</label>
                                <select name="inFinanceTitle" id="inFinanceTitle" class="form-control">
                                    <option value="สินทรัพย์">สินทรัพย์</option>
                                    <option value="หนี้สิน">หนี้สิน</option>
                                    <option value="ทุน">ทุน</option>
                                    <option value="รายได้">รายได้</option>
                                    <option value="รายจ่าย">รายจ่าย</option>
                                </select>

                            </div>
                        </div>
                        <div class="row" style="padding: 5px;">
                            <div class="col-md-6">
                                <label for="inFinanceDate">รหัสบัญชี</label>
                                <input type="text" class="form-control" name="inFinanceDate" id="inFinanceDate"/>
                            </div>

                        </div>
                        <div class="row" style="padding: 5px;">
                            <div class="col-md-12">
                                <label for="inFinanceDate">ชื่อบัญชี</label>
                                <input type="text" class="form-control" name="inFinanceDate" id="inFinanceDate"/>
                            </div>

                        </div>


                        <div class="row" style="padding: 10px;">
                            <center>
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-success"><i class="icon-save icon-large"></i> บันทึก</button>
                                    <button type="button" class="btn btn-warning"><i class="icon-delete icon-large"></i> ล้างข้อมูล</button>
                                </div>
                            </center>
                        </div>
                    </form>
                    <div class="box-body">
                        <div class="table-responsive">
                            <table class="table table-hover table-striped table-bordered display" id="example">
                                <thead>
                                    <tr>
                                        <th class="no-sort">รหัสบัญชี</th>
                                        <th class="no-sort">ชื่อบัญชี</th>
                                        <th class="no-sort">หมวดบัญชี</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($acc_code as $r) : ?>
                                        <tr>
                                            <td><?php echo $r['tb_acc_code']; ?></td>
                                            <td><?php echo $r['tb_acc_title']; ?></td>
                                            <td><?php echo $r['tb_acc_type']; ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
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