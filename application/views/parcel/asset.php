
<!--   <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.3/css/bootstrap-select.min.css" />-->

<div class="box">
    <div class="box-heading">  ระบบจัดซื้อจัดจ้าง : ตรวจรับการจัดซื้อ/จัดจ้าง
    </div>
    <ul class="breadcrumb">
        <li><?php echo anchor(site_url(), "<i class='icon-home icon-large'></i> หน้าแรก"); ?></li>
        <li><?php echo anchor(site_url('home_parcel'), "<i class='icon-archive icon-large'></i> งานพัสดุ"); ?></li>
        <!--<li><?php echo anchor(site_url('parcel'), "<i class='icon-archive icon-large'></i> ระบบจัดซื้อจัดจ้าง"); ?></li>-->
        <li>ตรวจรับการจัดซื้อ/จัดจ้าง</li>
    </ul>
    <div class="box-body">

        <div class="row">
            <div class="col-xs-12">

                <div class="row">
                    <div class="col-sm-12">

                        <table class="table table-striped table-bordered" id="parcelID">
                            <thead>
                                <tr>
                                    <th class="no-sort" style="width:10px">ลำดับ</th>
                                    <th class="no-sort">วันที่</th>
                                    <!--<th class="no-sort">วัตถุประสงค์หรือเหตุผลความจำเป็นในการจัดซื้อ</th>-->
                                    <th class="no-sort">ใบสั่งซื้อ</th>
                                    <th class="no-sort">ใบตรวจรับ</th>
                                    <th class="no-sort">ใบเบิก</th>
                                    <th class="no-sort">จำนวนเงิน</th>
                                    <th class="no-sort">รายชื่อกรรมการตรวจรับ</th>
                                    <th class="no-sort">สถานะ</th>
                                    <th class="no-sort" style="width:30%;text-align: center">ตรวจรับการจัดซื้อ/จัดจ้าง</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $row = 1;
                                $total = 0;
                                foreach ($list as $r) {
                                    if ($r['parcel_status'] == 'อนุมัติ' || $r['parcel_status'] == 'ตรวจรับ') {
                                        ?>
                                        <tr>
                                            <td style="text-align: center"><?php echo $row; ?></td>
                                            <td><?php echo shortdate($r['parcel_order_date']); ?></td>
                                            <td style="text-align: right"><?php echo $r['order_num'] . '/' . $r['year_parcel']; ?></td>                                         
                                            <td style="text-align: right"><?php echo $r['receipt_order'] . '/' . $r['year_parcel']; ?></td>
                                            <td style="text-align: right"><?php echo $r['bill_num'] . '/' . $r['year_parcel']; ?></td>
                                            <?php
                                            $sum=0;
                                            if (isset($r['id'])) {
                                                $sum = $this->Approve_purchase_model->get_purchase_total($r['id']);
                                                $total += $sum;
                                            }
                                            ?>

                                            <td style="text-align: right"><?php echo number_format($sum) ?></td>
                                            <?php
                                            $hRs = $this->My_model->get_where_row('tb_human_resources_01', array('id' => $r['parcel_approve_rc']));
                                            ?>
                                            <td><?php echo (isset($hRs['hr_thai_name'])) ? $hRs['hr_thai_symbol'] . $hRs['hr_thai_name'] . ' ' . $hRs['hr_thai_lastname'] : ''; ?></td>
                                            <td><?php echo $r['parcel_status']; ?></td>
                                            <td style="text-align: center">
                                                <?php if ($r['parcel_status'] == 'อนุมัติ') { ?>

                                                    <button class="col-md-12 btn btn-success btn-parcel-rc-save"id='<?php echo $r['id']; ?>' >
                                                        <i class="icon-save" ></i> บันทึกรายการตรวจรับ
                                                    </button>

                                                <?php } elseif ($r['parcel_status'] == 'ตรวจรับ') { ?>

<!--                                                    <button class="col-md-12 btn btn-info btn-purchase-rc"id='<?php echo $r['id']; ?>' >
                                                        <i class="icon-print" ></i> รายงาน
                                                    </button>
                                                    <div class="btn-group col-md-12">
                                                        <button class="col-md-6 btn btn-warning btn-purchase-rc-edit"id='<?php echo $r['id']; ?>' >
                                                            <i class="icon-print" ></i> แก้ไขรายการ
                                                        </button>
                                                        <button data-toggle="collapse" data-target="#confirmApp" class="col-md-6 btn btn-success"id='<?php echo $r['id']; ?>' >
                                                            <i class="icon-save" ></i> บันทึกผลการอนุมัติ
                                                        </button>
                                                    </div>
                                                    <div class="collapse " id="confirmApp">-->
                                                        <!--<div class="btn-group col-md-12 ">-->
                                                            <button class="col-md-12 btn btn-success" onclick='parcelControl(<?php echo $r['id']; ?>)' >
                                                                <i class="icon-check" ></i> ลงทะเบียนครุภัณฑ์
                                                            </button>
<!--                                                            <button class="col-md-6 btn btn-danger btn-purchase-not-approve"id='<?php echo $r['id']; ?>' >
                                                                <i class="icon-remove" ></i> ไม่อนุมัติ
                                                            </button>-->
                                                        <!--</div>-->
                                                    <!--</div>-->

                                                <?php } ?>

                                            </td>
                                        </tr>
                                        <?php
                                        $row++;
                                    }
                                }
                                ?>



                            </tbody>
                            <tfoot>
                                <tr style='background:#efefef'>
                                    <th style='text-align: center;'></th>
                                    <!--<th style='text-align: center;'></th>-->
                                    <th style='text-align: center;'></th>
                                    <th style='text-align: center;'></th>
                                    <th style='text-align: center;'></th>
                                    <th style='text-align: center;'></th>
                                    <th style='text-align: right;'></th>
                                    <th style='text-align: left;'></th>
                                    <th style='text-align: center;'></th>
                                    <th style='text-align: center;'></th>
                                </tr>
                            </tfoot>

                        </table>

                    </div>
                </div>

            </div>
        </div>



        <!-- end row -->


    </div>
</div>
<?php
$this->load->view('parcel/reports/parcel_purchase_rc_report_modal');
$this->load->view('parcel/modals/asset_rc_modal');
//$this->load->view('parcel/modals/approve_purchase_modal');
;
?>

<script>
<?php
$tabName = "parcelID";

$text = "รายการจัดซื้อจัดจ้าง";
$title = $this->Echo_Text_Model->head_logo($text, $this->session->userdata('sch_id'));
$colStr = "0,1,2,3,4,5,6,7";
$btExArr = array();

$footer = "\"footerCallback\": function (row, data, start, end, display) {
                var api = this.api(), data;

                var intVal = function (i) {
                    return typeof i === 'string' ?
                            i.replace(/[\$,]/g, '') * 1 :
                            typeof i === 'number' ?
                            i : 0;
                };



                var gtotal =  api
                        .column(5)
                        .data()
                        .reduce(function (a, b) {
                            return intVal(a) + intVal(b);
                        }, 0);
                $(api.column(4).footer()).html('รวม');
                $(api.column(5).footer()).html(gtotal.toLocaleString('en'));
                $(api.column(6).footer()).html('บาท');

            }";


load_datatable($tabName, $btExArr, $title, $colStr, $footer);
?>

    $('.btn-purchase-rc-edit').on("click", function (e) {
        var uid = $(this).attr('id');

        $.ajax({
            url: "<?php echo site_url('parcel/Asset/parcel_rc_edit'); ?>",
            method: "post",
            dataType: "json",
            data: {id: uid},
            success: function (data) {
                $('#id').val(data.id);
                $('#inParcelPurchaseId').val(data.tb_parcel_purchase_id);
                $('#inParcelRcStatus').val(data.tb_parcel_rc_status);
                $('#inParcelRcFine').val(data.tb_parcel_rc_fine);
                $('#inParcelRcNote').val(data.tb_parcel_rc_note);
                $("#myModal").modal("show");
            }
        });
    });

    $('.btn-parcel-rc-save').on("click", function (e) {
        var uid = $(this).attr('id');
        $('#inParcelPurchaseId').val(uid);
        $("#myModal").modal("show");

    });

    $('.btn-purchase-rc').on("click", function (e) {
        var uid = $(this).attr('id');

        $.ajax({
            url: "<?php echo site_url('parcel/Asset/get_report7'); ?>",
            method: "post",
            data: {id: uid},
            success: function (data) {

                tinyMCE.get('inReceiptOrderRpt').setContent(data);
//                tinyMCE.get('inMemMoPurchaseW').getBody().setAttribute('contenteditable', false);
                $.ajax({
                    url: "<?php echo site_url('parcel/Asset/get_report8'); ?>",
                    method: "post",
                    data: {id: uid},
                    success: function (data) {
                        tinyMCE.get('inOrderPaymentRpt').setContent(data);
                        $("#parcel-rc-report-modal").modal("show");

                    }
                });

            }
        });
    });
    
    function parcelControl(uid){
        var status = confirm('ท่านต้องการลงทะเบียนครุภัณฑ์ ?');
        if (status) {
            var usage = prompt("กรุณาระบุสถานที่ตั้ง/เก็บครุภัณฑ์", "");
            if (usage != null) {
                $.ajax({
                    url: "<?php echo site_url('parcel/Asset/send_approve'); ?>",
                    method: "post",
                    data: {id: uid, status: 'เรียบร้อย'},
                    success: function (data) {
//                        alert(uid);
                        $.ajax({
                            url: "<?php echo site_url('parcel/Asset/parcel_control_insert'); ?>",
                            method: "post",
                            data: {id: uid, usage: usage},
                            success: function (data) {
                                location.reload();
                            }
                        });
                    }
                });
            }
        }
    }

    $('.btn-purchase-approve').on("click", function (e) {
        var uid = $(this).attr('id');

        var status = confirm('ท่านต้องการอนุมัติจริงหรือไม่ ?');
        if (status) {
            var usage = prompt("กรุณาระบุสถานที่ตั้ง/เก็บครุภัณฑ์", "");
            if (usage != null) {
                $.ajax({
                    url: "<?php echo site_url('parcel/Asset/send_approve'); ?>",
                    method: "post",
                    data: {id: uid, status: 'เรียบร้อย'},
                    success: function (data) {
                        alert(uid);
                        $.ajax({
                            url: "<?php echo site_url('parcel/Asset/parcel_control_insert'); ?>",
                            method: "post",
                            data: {id: uid, usage: usage},
                            success: function (data) {
                                location.reload();
                            }
                        });
                    }
                });
            }
        }
    });
    $('.btn-purchase-not-approve').on("click", function (e) {
        var uid = $(this).attr('id');
        var status = confirm('ท่านไม่ต้องการอนุมัติจริงหรือไม่ ?');
        if (status) {
            $.ajax({
                url: "<?php echo site_url('parcel/Asset/send_approve'); ?>",
                method: "post",
                data: {id: uid, status: 'ตรวจรับ'},
                success: function (data) {
                    location.reload();
                }
            });
        }
    });



</script>
