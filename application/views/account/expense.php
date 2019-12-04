<div class="box">
    <div class="box-heading">ระบบงานงบประมาณ</div>
    <ul class="breadcrumb">
        <li><?php echo anchor(site_url(), "<i class='icon-home icon-large'></i> หน้าแรก"); ?></li>
        <li>ข้อมูลรายจ่าย</li>
    </ul>
    <div class="box-body">
        
        <div class="row">
            <!-- Left Menu -->
            <div class="col-md-2 panel" style="padding: 10px;">
                <div class="col-md-12">
                    <button type="button" style="margin-bottom:5px;" class="btn btn-success btn-submenu" onclick="javascript:location.href = '<?php echo site_url('financial-system'); ?>';"><i class="icon-money icon-large pull-left"></i>รับเงิน</button>
                    <button type="button" style="margin-bottom:5px;" class="btn btn-info btn-submenu" onclick="javascript:location.href = '<?php echo site_url('expense'); ?>';"><i class="icon-money icon-large pull-left"></i>จ่ายเงิน</button>
               <!--     <button type="button" style="margin-bottom:5px;"  class="btn btn-success btn-submenu" onclick="javascript:location.href = '<?php echo site_url('ta-loan'); ?>';"><i class="icon-list icon-large pull-left"></i>ข้อมูลเงินยืม</button>
                    <button type="button" style="margin-bottom:5px;"  class="btn btn-info btn-submenu" onclick="javascript:location.href = '<?php echo site_url('ta-loan-clearing'); ?>';"><i class="icon-edit icon-large pull-left"></i>บันทึกคืนเงินยืม</button>
               --> 
               </div>
            </div>
            <div class="col-md-10 panel" style="padding: 10px;">
               <legend class="legend-heading">จ่ายเงิน</legend>
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
                                            <label for="inFinanceDate">เลขที่หนังสือ/เอกสาร</label>
                                            <input type="text" name="inFinanceRef" id="inFinanceRef"  class="form-control"/>

                                        </div>


                                        <div class="col-md-6">
                                            <label for="inFinanceDate">ทะเบียนหลัก</label>
                                            <select name="inFinanceTitle" id="inFinanceTitle" class="form-control">
                                                    <?php foreach($income as $r){?>
                                                    <option value="<?php echo $r['id']?>"><?php echo $r['tb_acc_income_detail']?></option>
                                                    <?php
                                                    }
                                                    ?>
                                                </select>

                                        </div>
                                    </div>
                                    <div class="row" style="padding: 5px;">
                                        <div class="col-md-12">
                                            <label for="inFinanceDate">รายการ</label>
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
                                            <table class="table table-hover table-striped table-bordered display" id="example">
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
                                                    <?php $row=1; foreach ($expenseSC as $r) : ?>
                                                        <tr>
                                                            <td><?php echo $row; $row++; ?></td>
                                                            <td><?php echo $r['tb_acc_school_expense_type']; ?></td>
                                                            <td><?php echo $r['tb_acc_school_expense_ref']; ?></td>
                                                            <?php
                                                                $rm = $this->My_model->get_where_row('tb_acc_income',array('id'=>$r['tb_acc_income_id']));
                                                            ?>
                                                            <td><?php echo $rm['tb_acc_income_detail']; ?></td>
                                                            <td><?php echo $r['tb_acc_school_expense_detail']; ?></td>
                                                            <td><?php echo number_format($r['tb_acc_school_expense_amt']); ?></td>
                                                        </tr>
                                                    <?php endforeach; ?>
                                                </tbody>
                                            </table>
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

       $('.btn-finace-submit').on('click',function(e){
            $.ajax({
            url: "<?php echo site_url('school/Account/insert_expense_school'); ?>",
            method: "post",
            data: $("#insert-fianance-form").serialize(),
            success: function (data) {
                location.reload();
            }
        });
        });
    </script>
  