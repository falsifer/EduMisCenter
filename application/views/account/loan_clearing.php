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
                    <button type="button" style="margin-bottom:5px;"  class="btn btn-success btn-submenu" onclick="javascript:location.href = '<?php echo site_url('ta-loan'); ?>';"><i class="icon-list icon-large pull-left"></i>ข้อมูลเงินยืม</button>
                    <button type="button" style="margin-bottom:5px;"  class="btn btn-info btn-submenu" onclick="javascript:location.href = '<?php echo site_url('ta-loan-clearing'); ?>';"><i class="icon-edit icon-large pull-left"></i>บันทึกคืนเงินยืม</button>
                </div>
            </div>
            <div class="col-md-10 panel" style="padding: 10px;">
                <legend class="legend-heading">บันทึกคืนเงินยืม</legend>
                <div class="col-md-12 databox">
                    <form method="post" id="insert-fianance-form">
                        <div class="row" style="padding: 5px;">

                            <div class="col-md-4">
                                <i class="icon-search"></i>&nbsp;ค้นหา&nbsp;&nbsp;
                                <label for="inFinanceDate">เลขที่หนังสือ/เอกสาร</label>
                                <input type="text" name="inFinanceDate" id="inFinanceDate"  class="form-control"/>

                            </div>
                            <!--                                        <div class="col-md-3">
                                                                        <label for="inFinanceDate">วัน/เดือน/ปี</label>
                                                                        <input type="text" date-picker name="inFinanceDate" id="inFinanceDate" value="<?php echo date('d/m/Y'); ?>" />
                                                                    </div>
                                                                    <div class="col-md-5">
                                                                        <label>ประเภท</label>
                            <?php echo nbs(3); ?><input class="magic-radio form-control" type="radio" name="inFinanceType"  value="Cash" id="cash" checked><label for="cash">เงินสด</label>&nbsp;
                                                                        <input class="magic-radio form-control" type="radio" name="inFinanceType"  value="Bank" id="bank" ><label for="bank">ธนาคาร</label>
                                                                    </div>-->
                        </div>
                        <div class="row" style="padding: 5px;">

                            <div class="col-md-12">

                                <label for="inFinanceDate">ทะเบียนหลัก</label>
                                <select name="inFinanceTitle" id="inFinanceTitle" class="form-control" readonly>
                                    <option value="เงินอุดหนุนค่าใช้จ่ายรายหัว">เงินอุดหนุนค่าใช้จ่ายรายหัว</option>
                                </select>

                            </div>
                        </div>
                        <div class="row" style="padding: 5px;">
                            <div class="col-md-12">
                                <label for="inFinanceDate">รายการ</label>
                                <textarea name="inFinanceDate" id="inFinanceDate" rows="5"  class="form-control"readonly>
                                </textarea>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-md-12">

                                <label>จำนวนเงิน(บาท)</label>
                                <input type="text" name="inFinanceDate" id="inFinanceDate" class="form-control"readonly />

                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <label>หมายเหตุ</label>
                                <textarea name="inFinanceDate" id="inFinanceDate" rows="5"  class="form-control" readonly>
                                </textarea>
                            </div>

                        </div>
                        <hr>
                        <div class=" box" style="padding: 20px;">
                            <div class="row">
                                <legend>รายการคืนเงิน</legend>
                                <div class="col-md-3">
                                    <label for="inFinanceDate">วัน/เดือน/ปี</label>
                                    <input type="text" date-picker name="inFinanceDate" id="inFinanceDate"  class="form-control"/ value="<?php echo date('d/m/Y'); ?>" />
                                </div>
                                <div class="col-md-6">
                                    <label for="inFinanceDate">เลขที่หนังสือ/เอกสาร</label>
                                    <input type="text" name="inFinanceDate" id="inFinanceDate"  class="form-control"/>

                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">

                                    <label>จำนวนเงิน(บาท)</label>
                                    <input type="text" name="inFinanceDate" id="inFinanceDate" class="form-control" />

                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <label>หมายเหตุ</label>
                                    <textarea name="inFinanceDate" id="inFinanceDate" rows="5"  class="form-control" >
                                    </textarea>
                                </div>

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

    // append insert button
    var status = "<?php echo $this->session->userdata('status'); ?>";
    var res = "<?php echo $this->session->userdata('responsible'); ?>";
    if (status == "ผู้ปฏิบัติงาน") {
        $("div#example_length.dataTables_length").append("&nbsp;&nbsp;<button type='button' class='btn btn-default btn-insert'><i class='icon-plus icon-large'></i> บันทึกข้อมูล</button>");
    }

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

</script>
<?php //$this->load->view("modals/vichakarn/km_detail_modal"); ?>
<?php
//$this->load->view("modals/vichakarn/km_edit_modal"); ?>