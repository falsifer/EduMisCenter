
<!--   <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.3/css/bootstrap-select.min.css" />-->

<div class="box">
    <div class="box-heading">  ระบบจัดซื้อจัดจ้าง
    </div>
    <ul class="breadcrumb">
        <li><?php echo anchor(site_url(), "<i class='icon-home icon-large'></i> หน้าแรก"); ?></li>
        <li><?php echo anchor(site_url('home_parcel'), "<i class='icon-archive icon-large'></i> งานพัสดุ"); ?></li>
        <li><?php echo anchor(site_url('parcel'), "<i class='icon-archive icon-large'></i> ระบบจัดซื้อจัดจ้าง"); ?></li>
        <li>อนุมัติรายการจัดซื้อจัดจ้าง</li>
    </ul>
    <div class="box-body">

        <div class="row">
            <div class="col-xs-12">
                <div class="row" id="MyHead">
                    <div class="col-md-12  form-group">

                        <div class="panel-group">
                            <div class="panel panel-primary">
                                <div class="panel-body"  style="text-align: center">
                                    <p>รายการจัดซื้อจัดจ้าง ประจำปีงบประมาณ <?php echo get_budget_year(date('Y-m-d'))?></p>
                                    </div>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-12">

                        <table class="table table-striped table-bordered" id="parcelID">
                            <thead>
                                <tr>
                                    <th class="no-sort" style="width:10px">ลำดับ</th>
                                    <th class="no-sort">วันที่</th>
                                    <th class="no-sort">โครงการ</th>
                                    <th class="no-sort">ใบสั่งซื้อ</th>
<!--                                    <th class="no-sort">ใบตรวจรับ</th>
                                    <th class="no-sort">ใบเบิก</th>-->
                                    <th class="no-sort">จำนวนเงิน</th>
                                    <th class="no-sort">รายชื่อกรรมการตรวจรับ</th>
                                    <th class="no-sort" style="width:20%">&nbsp;</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $row = 1;
                                $total = 0;
                                foreach ($list as $r) {
                                    ?>
                                    <tr>
                                        <td style="text-align: center"><?php echo $row; ?></td>
                                        <td><?php echo shortdate($r['parcel_order_date']); ?></td>
                                        <td style="width:100px;"><?php echo $r['project_name']; ?></td>                                           
                                        <td style="text-align: right"><?php echo $r['order_num'] . '/' . $r['year_parcel']; ?></td>                                         
<!--                                        <td style="text-align: right"><?php echo $r['receipt_order'] . '/' . $r['year_parcel']; ?></td>
                                        <td style="text-align: right"><?php echo $r['bill_num'] . '/' . $r['year_parcel']; ?></td>-->
                                        <?php
                                        $sum = $this->Approve_purchase_model->get_purchase_total($r['itmid']);
                                        $total += $sum;
                                        ?>

                                        <td style="text-align: right"><?php echo number_format($sum) ?></td>
                                        <?php
                                        $hRs = $this->My_model->get_where_row('tb_human_resources_01', array('id' => $r['parcel_approve_rc']));
                                        ?>
                                        <td><?php echo (isset($hRs['hr_thai_name'])) ? $hRs['hr_thai_symbol'] . $hRs['hr_thai_name'] . ' ' . $hRs['hr_thai_lastname'] : ''; ?></td>
                                        <td style="text-align: center">

                                            
                                            <?php if ($r['parcel_status'] == 'รอการอนุมัติ') { ?>
                                                
                                                    <button class="col-md-12 btn btn-info btn-purchase-w"id='<?php echo $r['itmid']; ?>' >
                                                        <i class="icon-print" ></i> รายงาน
                                                    </button>
                                            <div class="btn-group col-md-12">
                                                    <button class="col-md-6 btn btn-success btn-purchase-approve"id='<?php echo $r['itmid']; ?>' >
                                                        <i class="icon-check" ></i> อนุมัติ
                                                    </button>
                                                    <button class="col-md-6 btn btn-danger btn-purchase-not-approve"id='<?php echo $r['itmid']; ?>' >
                                                        <i class="icon-remove" ></i> ไม่อนุมัติ
                                                    </button>
                                                </div>
                                           
                                            <?php } elseif ($r['parcel_status'] == 'อนุมัติ') { ?>
                                                <div class="btn-group col-md-12">
                                                    <button class="col-md-6 btn btn-info btn-purchase-approved-report"id='<?php echo $r['itmid']; ?>' >
                                                        <i class="icon-print" ></i> รายงาน
                                                    </button>
                                                    <button class="col-md-6 btn btn-primary btn-purchase-approve"id='<?php echo $r['itmid']; ?>' >
                                                        <i class="icon-check" ></i> ตรวจรับพัสดุ
                                                    </button>
                                                </div>
                                            <?php } elseif ($r['parcel_status'] == 'เรียบร้อย') { ?>
                                                    <button class="col-md-6 btn btn-info btn-purchase-success"id='<?php echo $r['itmid']; ?>' >
                                                        <i class="icon-print" ></i> รายงาน
                                                    </button>
                                            <?php } ?>
                                        </td>
                                    </tr>
                                    <?php
                                    $row++;
                                }
                                ?>



                            </tbody>
                            <tfoot>
                                <tr style='background:#efefef'>
                                    <th style='text-align: center;'></th>
                                    <th style='text-align: center;'></th>
                                    <th style='text-align: center;'></th>
                                    <th style='text-align: center;'></th>
<!--                                    <th style='text-align: center;'></th>
                                    <th style='text-align: center;'></th>-->
                                    <th style='text-align: right;'></th>
                                    <th style='text-align: left;'></th>
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
$this->load->view('parcel/reports/parcel_purchase_w_report_modal');
$this->load->view('parcel/reports/parcel_purchase_approved_report_modal');
$this->load->view('parcel/modals/approve_purchase_modal');
$this->load->view('parcel/modals/approve_purchase_itm_modal');
?>

<script>
<?php
$tabName = "parcelID";

$text = "รายการอนุมัติจัดซื้อจัดจ้าง ประจำปีงบประมาณ ".get_budget_year(date('Y-m-d'));
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
                        .column(4)
                        .data()
                        .reduce(function (a, b) {
                            return intVal(a) + intVal(b);
                        }, 0);
                $(api.column(3).footer()).html('รวม');
                $(api.column(4).footer()).html(gtotal.toLocaleString('en'));
                $(api.column(5).footer()).html('บาท');

            }";


load_datatable($tabName, $btExArr, $title, $colStr, $footer);
?>
  //btn-not-approve
  $('.btn-purchase-approve').on("click", function (e) {
        var uid = $(this).attr('id');
        var status = confirm('ท่านต้องการอนุมัติจริงหรือไม่ ?');
        if (status) {
            $.ajax({
                url: "<?php echo site_url('parcel/Approve_purchase/send_approve'); ?>",
                method: "post",
                data: {id: uid,status:'อนุมัติ'},
                success: function (data) {
                    location.reload();
                }
            });
        }
    });
    
    $('.btn-purchase-not-approve').on("click", function (e) {
        var uid = $(this).attr('id');
        var status = confirm('ท่านไม่ต้องการอนุมัติจริงหรือไม่ ?');
        if (status) {
            $.ajax({
                url: "<?php echo site_url('parcel/Approve_purchase/send_approve'); ?>",
                method: "post",
                data: {id: uid,status:'ไม่อนุมัติ'},
                success: function (data) {
                    location.reload();
                }
            });
        }
    });

    $('.btn-purchase-w').on("click", function (e) {
        var uid = $(this).attr('id');

        $.ajax({
            url: "<?php echo site_url('parcel/Approve_purchase/get_report1'); ?>",
            method: "post",
            data: {id: uid},
            success: function (data) {

                tinyMCE.get('inMemMoPurchaseW').setContent(data);
                tinyMCE.get('inMemMoPurchaseW').getBody().setAttribute('contenteditable', false);
                $.ajax({
                    url: "<?php echo site_url('parcel/Approve_purchase/get_report2'); ?>",
                    method: "post",
                    data: {id: uid},
                    success: function (data) {
                        tinyMCE.get('inMemMoPurchaseAppendW').setContent(data);
                        tinyMCE.get('inMemMoPurchaseAppendW').getBody().setAttribute('contenteditable', false);
                        //
                        $.ajax({
                            url: "<?php echo site_url('parcel/Approve_purchase/get_report3'); ?>",
                            method: "post",
                            data: {id: uid},
                            success: function (data) {
                                tinyMCE.get('inMemMoPurchaseRestW').setContent(data);
                                tinyMCE.get('inMemMoPurchaseRestW').getBody().setAttribute('contenteditable', false);
                                $("#parcel-w-report-modal").modal("show");

                            }
                        });
                    }
                });

            }
        });
    });


    $('.btn-purcase-approve-report').on("click", function (e) {
        var uid = $(this).attr('id');
        $.ajax({
            url: "<?php echo site_url('parcel/Approve_purchase/get_report4'); ?>",
            method: "post",
            data: {id: uid},
            success: function (data) {
                tinyMCE.get('inPurchasseOrderRpt').setContent(data);
                $.ajax({
                    url: "<?php echo site_url('parcel/Approve_purchase/get_report5'); ?>",
                    method: "post",
                    data: {id: uid},
                    success: function (data) {
                        tinyMCE.get('inPurchasseOrderAppend').setContent(data);
                        $.ajax({
                            url: "<?php echo site_url('parcel/Approve_purchase/get_report6'); ?>",
                            method: "post",
                            data: {id: uid},
                            success: function (data) {

                                tinyMCE.get('inReceiptOrderRpt').setContent(data);
                                $("#parcel-report-modal").modal("show");
                            }
                        });
                    }
                });
            }
        });
    });

    $('.btn-purchase-edit').on("click", function (e) {
        var uid = $(this).attr('id');

        $.ajax({
            url: "<?php echo site_url('parcel/Approve_purchase/get_purchase_edit'); ?>",
            method: "post",
            dataType: "json",
            data: {id: uid},
            success: function (data) {
                $('#inUseDay').val(data.parcel_use_date);
                $('#inParcelPurpose').val(data.parcel_purpose);
                $('#inSeller').val(data.parcel_seller_id);
                $('#inOrderNumDate').val(data.parcel_order_date);
                $('#inBillNumDate').val(data.parcel_bill_date);
                $('#inReceiptOrdeDate').val(data.parcel_receipt_date);
                $('#inBillNum').val(data.bill_num);
                $('#inBillNumLabel').html(data.bill_num + "/" + data.year_parcel);
                $('#inReceiptOrder').val(data.receipt_order);
                $('#inReceiptOrderLabel').html(data.receipt_order + "/" + data.year_parcel);
                $('#inOrderNum').val(data.order_num);
                $('#inOrderNumLabel').html(data.order_num + "/" + data.year_parcel);
                $('#parcel_id').val(data.id);
                $('#inPurchaseRC').selectpicker('val', [data.parcel_approve_rc]);

                $.ajax({
                    url: "<?php echo site_url('parcel/Approve_purchase/get_project_plan_itm'); ?>",
                    method: "post",
                    data: {parcel_id: data.id},
                    success: function (data) {

                        $("#dynFrm").html(data);
                        $("#myModal").modal("show");
//                        cnt++;
//                        $('#inParcelSeq').val(cnt);
                    }
                });


            }

        });
    });


    $('.btn-purchase-delete').on("click", function (e) {
        var uid = $(this).attr('id');
        var status = confirm('ต้องการลบข้อมูลนี้จริงหรือไม่ ?');
        if (status) {
            $.ajax({
                url: "<?php echo site_url('parcel/Approve_purchase/purchase_delete'); ?>",
                method: "post",
                data: {id: uid},
                success: function (data) {
                    location.reload();

                }

            });
        }
    });


    var cnt = 1;
    //
    $('.btn-insert-itm').on("click", function (e) {
        $('#inParcelSeq').val(cnt);
        $("#my-plan-modal").modal("show");
    });

    $('.btn-parcel-purchase').on('click', function (event) {
        location.reload();
    });


    $('.btn-insert').on("click", function (e) {
        $.ajax({
            url: "<?php echo site_url('parcel/Approve_purchase/insert_project_plan'); ?>",
            method: "post",
            data: $("#frmSearch").serialize(),
            dataType: "json",
            success: function (data) {

                alert('บันทึกเรียบร้อย กรุณาเพิ่มรายการจัดซื้อ');
                $('#parcel_id').val(data.id);
                $('#inParcelSeq').val(cnt);
                $("#my-plan-modal").modal("show");
            }
        });
    });
    $('.btn-item-add').on("click", function (e) {
        $.ajax({
            url: "<?php echo site_url('parcel/Approve_purchase/insert_project_plan_itm'); ?>",
            method: "post",
            data: $("#frmItm").serialize(),
            success: function (data) {
                $("#frmItm")[0].reset();
                $("#dynFrm").append(data);
                cnt++;
                $('#inParcelSeq').val(cnt);
            }
        });
    });
    $('.btn-print').on("click", function (e) {
        $("#parcel-report-modal").modal("show");
        $('#memoNo').html($('#inOrderNum').val() + '/' + $('#year_parcel').val());
    });






</script>
