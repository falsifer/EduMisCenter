<div class="box">
    <div class="box-heading">ระบบงานงบประมาณ</div>
    <ul class="breadcrumb">
        <li><?php echo anchor(site_url(), "<i class='icon-home icon-large'></i> หน้าแรก"); ?></li>
        <li>ระบบการเงิน</li>
    </ul>
    <div class="box-body">
        <div class="row">
            <!-- Left Menu -->
            <div class="col-md-2 panel" style="padding: 10px;">

                <div class="col-md-12">
                    <button type="button" style="margin-bottom:5px;" class="btn btn-success btn-submenu" onclick="javascript:location.href = '<?php echo site_url('financial-system'); ?>';"><i class="icon-money icon-large pull-left"></i>รับเงิน</button>
                    <button type="button" style="margin-bottom:5px;" class="btn btn-info btn-submenu" onclick="javascript:location.href = '<?php echo site_url('expense'); ?>';"><i class="icon-money icon-large pull-left"></i>จ่ายเงิน</button>
<!--                    <button type="button" style="margin-bottom:5px;"  class="btn btn-success btn-submenu" onclick="javascript:location.href = '<?php echo site_url('ta-loan'); ?>';"><i class="icon-list icon-large pull-left"></i>ข้อมูลเงินยืม</button>
                    <button type="button" style="margin-bottom:5px;"  class="btn btn-info btn-submenu" onclick="javascript:location.href = '<?php echo site_url('ta-loan-clearing'); ?>';"><i class="icon-edit icon-large pull-left"></i>บันทึกคืนเงินยืม</button>-->
                </div>
            </div>
            <div class="col-md-10 panel" style="padding: 10px;">
                <legend class="legend-heading">รับเงิน</legend>
                <div id="dashboardTAB" class="container-fluid">	
                    <ul class="nav nav-tabs">
                        <li class="active">
                            <a  href="#1" data-toggle="tab" data-id="1"><b>บันทึกรายรับ</b></a>
                        </li>
                        <li>
                            <a  href="#2" data-toggle="tab" data-id="2"><b>ทะเบียนรายได้หลัก</b></a>
                        </li>
                        <!--<li><a href="#3" data-toggle="tab" data-id="3"><b>ข้อมูลธนาคาร</b></a></li>-->
                    </ul>

                    <div class="tab-content">
                        <div class="tab-pane active" id="1" style="padding-top:10px;">
                            <div class="col-md-12 databox">
                                <form method="post" id="insert-fianance-form">
                                    <div class="row" style="padding: 5px;">
                                        <div class="col-md-3">
                                            <label for="inFinanceDate">วัน/เดือน/ปี</label>
                                            <input type="text" date-picker name="inFinanceDate" id="inFinanceDate" value="<?php echo date('Y-m-d'); ?>" />
                                        </div>
                                        <div class="col-md-6">
                                            <label>ประเภท</label>
                                            <select name="inFinanceType" id="inFinanceType">
                                                <option value="เงินสด">เงินสด</option>
                                                <option value="ธนาคาร">ธนาคาร</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row" style="padding: 5px;">
                                        <div class="col-md-6">
                                            <label for="inFinanceRef">เลขที่หนังสือ/เอกสาร</label>
                                            <input type="text" name="inFinanceRef" id="inFinanceRef"  class="form-control"/>

                                        </div>


                                        <div class="col-md-6">
                                            <label for="inFinanceDate">ทะเบียนหลัก</label>
                                            <select name="inFinanceTitle" id="inFinanceTitle" class="form-control">
                                                <?php foreach ($income as $r) { ?>
                                                    <option value="<?php echo $r['id'] ?>"><?php echo $r['tb_acc_income_detail'] ?></option>
                                                    <?php
                                                }
                                                ?>
                                            </select>

                                        </div>
                                    </div>
                                    <div class="row" style="padding: 5px;">
                                        <div class="col-md-12">
                                            <label for="inFinanceDetail">รายการ</label>
                                            <textarea name="inFinanceDetail" id="inFinanceDetail" rows="5"  class="form-control">
                                            </textarea>
                                        </div>

                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">

                                            <label>จำนวนเงิน</label>
                                            <input type="text" name="inFinanceAmt" id="inFinanceAmt" />
                                            บาท
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <label>หมายเหตุ</label>
                                            <textarea name="inFinanceNote" id="inFinanceNote" rows="5"  class="form-control">
                                            </textarea>
                                        </div>

                                    </div>
                                    <div class="row" style="padding: 10px;">
                                        <center>
                                            <div class="col-md-12">
                                                <button type="button" class="btn btn-success btn-finace-submit"><i class="icon-save icon-large"></i> บันทึก</button>
                                                <button type="button" class="btn btn-warning"><i class="icon-delete icon-large"></i> ล้างข้อมูล</button>
                                            </div>
                                        </center>
                                    </div>
                                </form>
                            </div>
                            <div class="box-body">
                                <div class="table-responsive">
                                    <table class="table table-hover table-striped table-bordered display" id="schIncomeTab">
                                        <thead>
                                            <tr>
                                                <th class="no-sort">ลำดับที่</th>
                                                <th class="no-sort">ประเภท</th>
                                                <th class="no-sort">เลขที่หนังสือ/เอกสาร</th>
                                                <th class="no-sort">ทะเบียนหลัก</th>
                                                <th class="no-sort">รายการ</th>
                                                <th class="no-sort">จำนวนเงิน(บาท)</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $row = 1;
                                            foreach ($incomeSC as $r) :
                                                ?>
                                                <tr>
                                                    <td><?php echo $row;
                                            $row++;
                                            ?></td>
                                                    <td><?php echo $r['tb_acc_school_income_type']; ?></td>
                                                    <td><?php echo $r['tb_acc_school_income_ref']; ?></td>
                                                    <?php
                                                    $rm = $this->My_model->get_where_row('tb_acc_income', array('id' => $r['tb_acc_income_id']));
                                                    ?>
                                                    <td><?php echo $rm['tb_acc_income_detail']; ?></td>
                                                    <td><?php echo $r['tb_acc_school_income_detail']; ?></td>
                                                    <td><?php echo number_format($r['tb_acc_school_income_amt']); ?></td>
                                                </tr>
<?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="2" style="padding-top:10px;">
                            <div class="col-md-12 databox">
                                <form method="post" id="insert-income-form">
                                    <div class="row" style="padding: 5px;">
                                        <div class="col-md-6">
                                            <label for="inAccIncomeCode">รหัสทะเบียนรายรับ</label>
                                            <input type="text" class="form-control" name="inAccIncomeCode" id="inAccIncomeCode"/>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="inAccCode">รหัสบัญชี</label>
                                            <input type="text" class="form-control" name="inAccCode" id="inAccCode"/>
                                        </div>
                                    </div>
                                    <div class="row" style="padding: 5px;">
                                        <div class="col-md-12">
                                            <label for="inAccIncomeDetail">ชื่อทะเบียนรายรับ</label>
                                            <input type="text" class="form-control" name="inAccIncomeDetail" id="inAccIncomeDetail"/>
                                        </div>

                                    </div>

                                    <div class="row" style="padding: 10px;">
                                        <center>
                                            <div class="col-md-12">
                                                <input type="hidden" name="inAccIncomeId" id="inAccIncomeId" />
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
                                                    <th class="no-sort">รหัสทะเบียนรายรับ</th>
                                                    <th class="no-sort">ชื่อทะเบียนรายรับ</th>
                                                    <th class="no-sort">รหัสบัญชี</th>
                                                    <th class="no-sort">&nbsp;</th>
                                                </tr>
                                            </thead>
                                            <tbody>
<?php foreach ($income as $r) : ?>
                                                    <tr>
                                                        <td><?php echo $r['tb_acc_income_code']; ?></td>
                                                        <td><?php echo $r['tb_acc_income_detail']; ?></td>
                                                        <td><?php echo $r['tb_acc_code']; ?></td>
                                                        <td style="text-align:center;">
                                                            <button type="button" class="btn btn-warning btn-edit" id="<?php echo $r['id']; ?>" ><i class="icon-pencil icon-large"></i> แก้ไข</button>
                                                            <button type="button" class="btn btn-danger btn-delete" id="<?php echo $r['id']; ?>"><i class="icon-trash icon-large"></i> ลบ</button>
                                                        </td>
                                                    </tr>
<?php endforeach; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="3" style="padding-top:10px;">
                            <div class="col-md-12 databox">
                                <form method="post" id="insert-bookbank-form">
                                    <div class="row" style="padding: 5px;">
                                        <div class="col-md-6">
                                            <label for="inFinanceDate">เลขที่บัญชีธนาคาร</label>
                                            <input type="text" class="form-control" name="inFinanceDate" id="inFinanceDate"/>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="inFinanceDate">ชื่อบัญชี</label>
                                            <input type="text" class="form-control" name="inFinanceDate" id="inFinanceDate"/>
                                        </div>
                                    </div>
                                    <div class="row" style="padding: 5px;">
                                        <div class="col-md-6">
                                            <label for="inFinanceDate">ชื่อธนาคาร</label>
                                            <input type="text" class="form-control" name="inFinanceDate" id="inFinanceDate"/>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="inFinanceDate">สาขา</label>
                                            <input type="text" class="form-control" name="inFinanceDate" id="inFinanceDate"/>
                                        </div>
                                    </div>
                                    <div class="row" style="padding: 5px;">
                                        <div class="col-md-6">
                                            <label for="inFinanceDate">ประเภทเงินฝาก</label>
                                            <select name="inFinanceTitle" id="inFinanceTitle" class="form-control">
                                                <option value="ออมทรัพย์">ออมทรัพย์</option>
                                                <option value="ฝากประจำ">ฝากประจำ</option>
                                                <option value="กระแสรายวัน">กระแสรายวัน</option>
                                            </select>

                                        </div>
                                        <div class="col-md-6">
                                            <label for="inFinanceDate">กองทุน</label>
                                            <select name="inFinanceTitle" id="inFinanceTitle" class="form-control">
                                                <option value="ทั่วไป">ทั่วไป</option>
                                                <option value="เฉพาะกิจ">เฉพาะกิจ</option>
                                                <option value="สินทรัพย์">สินทรัพย์</option>
                                            </select>

                                        </div>

                                    </div>
                                    <div class="row" style="padding: 5px;">
                                        <div class="col-md-6">
                                            <label for="inFinanceDate">เงินยกมาครั้งแรก(บาท)</label>
                                            <input type="text" class="form-control" name="inFinanceDate" id="inFinanceDate"/>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="inFinanceDate">วันที่ยกมา</label>
                                            <input type="text" class="form-control" placeholder="<?php echo date('d-m-Y'); ?>"/>
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
                                <!--<div class="box-body">-->
                                <div class="table-responsive">
                                    <table class="table table-hover table-striped table-bordered display" id="example2">
                                        <thead>
                                            <tr>
                                                <th class="no-sort">ที่</th>
                                                <th class="no-sort">เลขที่บัญชี</th>
                                                <th class="no-sort">ชื่อบัญชี</th>
                                                <th class="no-sort">ธนาคาร</th>
                                                <th class="no-sort">สาขา</th>
                                                <th class="no-sort">ประเภท</th>
                                                <th class="no-sort">กองทุน</th>
                                                <th class="no-sort">เงินยกมาครั้งแรก(บาท)</th>
                                                <th class="no-sort">วันที่ยกมา</th>
                                            </tr>
                                        </thead>
                                        <tbody>
<?php $row = 1; ?>
<?php foreach ($bookbank as $r) : ?>
                                                <tr>
                                                    <td><?php echo $row; ?></td>
                                                    <td><?php echo $r['tb_acc_book_no']; ?></td>
                                                    <td><?php echo $r['tb_acc_book_name']; ?></td>
                                                    <td><?php echo $r['tb_acc_bank_name']; ?></td>
                                                    <td><?php echo $r['tb_acc_bank_branch']; ?></td>
                                                    <td><?php echo $r['tb_acc_book_type']; ?></td>
                                                    <td><?php echo $r['tb_acc_book_loan']; ?></td>
                                                    <td><?php echo number_format($r['tb_acc_book_balance'], 2); ?></td>
                                                    <td><?php echo $r['tb_acc_book_balance_date']; ?></td>
                                                </tr>
    <?php $row++; ?>
<?php endforeach; ?>
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
</div>

<script>
    $(".datepicker").datepicker({autoclose: true, language: 'th'});

    $('#schIncomeTab').DataTable({
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

    $('#insert-income-form').on('submit', function (e) {
        //alert($('#inAccIncomeDetail').val());
        $.ajax({
            url: "<?php echo site_url('school/Account/insert_income'); ?>",
            method: "post",
            data: $('#insert-income-form').serialize(),
//                    data: new FormData(this),
//                    cache: false,
//                    contentType: false,
//                    processData: false,
            success: function (data) {
                $("#insert-income-form")[0].reset();
                location.reload();
            }
        });
    });
    
    
    $("#example").on("click", ".btn-edit", function () {
        var uid = $(this).attr('id');
        var eyear = $(this).attr('eYear');

        $.ajax({
            url: "<?php echo site_url('school/Account/income_edit'); ?>",
            method: "post",
            data: {id: uid},
            dataType: "json",
            success: function (data) {

                $("#inAccIncomeId").val(data.id);
                $("#inAccIncomeCode").val(data.tb_acc_income_code);
                $("#inAccIncomeDetail").val(data.tb_acc_income_detail);
                $("#inAccCode").val(data.tb_acc_code);
            }
        });
    });

    $("#example").on("click", ".btn-delete", function () {
        var status = confirm('ต้องการลบข้อมูลนี้จริงหรือไม่ ?');
        var uid = $(this).attr('id');
        if (status) {
            $.ajax({
                url: "<?php echo site_url('school/Account/income_delete'); ?>",
                method: "post",
                data: {id: uid},
                success: function (data) {
                    alert('ลบข้อมูลสำเร็จ !');
                    location.reload();
                }
            });
        }
    });
    

    $('.btn-finace-submit').on('click', function (e) {

        $.ajax({
            url: "<?php echo site_url('school/Account/insert_income_school'); ?>",
            method: "post",
            data: $("#insert-fianance-form").serialize(),
            success: function (data) {
                location.reload();
            }
        });
    });


</script>
