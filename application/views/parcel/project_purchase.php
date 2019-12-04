
<!--   <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.3/css/bootstrap-select.min.css" />-->

<div class="box">
    <div class="box-heading">  ระบบจัดซื้อจัดจ้าง
        <button class="btn btn-primary waves-effect waves-light" style="float: right" data-toggle="modal" data-target="#myModal"><i class="icon icon-plus"></i> ขออนุมัติจัดซื้อจัดจ้าง </button>

    </div>
    <ul class="breadcrumb">
        <li><?php echo anchor(site_url(), "<i class='icon-home icon-large'></i> หน้าแรก"); ?></li>
        <li><?php echo anchor(site_url('home_parcel'), "<i class='icon-archive icon-large'></i> งานพัสดุ"); ?></li>
        <li><?php echo anchor(site_url('parcel'), "<i class='icon-archive icon-large'></i> ระบบจัดซื้อจัดจ้าง"); ?></li>
        <li>รายการจัดซื้อจัดจ้าง</li>
    </ul>
    <div class="box-body">

        <div class="row">
            <div class="col-xs-12">
                <div class="row" id="MyHead">
                    <div class="col-md-12  form-group">

                        <div class="panel-group">
                            <div class="panel panel-primary">
                                <div class="panel-body"  style="text-align: center">
                                    <p>รายการจัดซื้อจัดจ้าง</p>
                                    <h4>โครงการ<?php
                                        $pRs = $this->My_model->get_where_row('tb_project_school', array('id' => $project_id));
                                        $project_name = $pRs['project_name'];
                                        $project_response = $pRs['responsible'];
                                        echo $project_name;
                                        ?>
                                    </h4>
                                    <span style="font-size:0.9em">งบประมาณโครงการ</span>
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
                                    <!--<th class="no-sort">วัตถุประสงค์หรือเหตุผลความจำเป็นในการจัดซื้อ</th>-->
                                    <th class="no-sort">ใบสั่งซื้อ</th>
                                    <th class="no-sort">ใบตรวจรับ</th>
                                    <th class="no-sort">ใบเบิก</th>
                                    <th class="no-sort">จำนวนเงิน</th>
                                    <th class="no-sort">รายชื่อกรรมการตรวจรับ</th>
                                    <th class="no-sort">สถานะ</th>
                                    <th class="no-sort" style="width:30%">&nbsp;</th>
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
                                        <!--<td style="width:100px;"><?php echo $r['parcel_purpose']; ?></td>-->                                           
                                        <td style="text-align: right"><?php echo $r['order_num'] . '/' . $r['year_parcel']; ?></td>                                         
                                        <td style="text-align: right"><?php echo $r['receipt_order'] . '/' . $r['year_parcel']; ?></td>
                                        <td style="text-align: right"><?php echo $r['bill_num'] . '/' . $r['year_parcel']; ?></td>
                                        <?php
                                        $sum = $this->Approve_purchase_model->get_purchase_total($r['itmid']);
//                                        $sum = $this->My_model->sum_where('tb_parcel_purchase_itm', 'parcel_price', array('parcel_purchase_id' => $r['itmid']));
                                        $total += $sum;
                                        ?>

                                        <td style="text-align: right"><?php echo number_format($sum) ?></td>
                                        <?php
                                        $hRs = $this->My_model->get_where_row('tb_human_resources_01', array('id' => $r['parcel_approve_rc']));
                                        ?>
                                        <td><?php echo (isset($hRs['hr_thai_name'])) ? $hRs['hr_thai_symbol'] . $hRs['hr_thai_name'] . ' ' . $hRs['hr_thai_lastname'] : ''; ?></td>
                                        <td><?php echo $r['parcel_status']; ?></td>
                                        <td style="text-align: center">

                                            <?php if ($r['parcel_status'] == 'ฉบับร่าง') { ?>
                                                <div class="btn-group col-md-12">
                                                    <button class="col-md-6 btn btn-warning btn-purchase-edit"id='<?php echo $r['itmid']; ?>' >
                                                        <i class="icon-pencil" ></i> แก้ไข
                                                    </button>   
                                                    <button class="col-md-6 btn btn-danger btn-purchase-delete"id='<?php echo $r['itmid']; ?>' >
                                                        <i class="icon-trash" ></i> ลบ
                                                    </button> 
                                                </div>
                                                <div class="btn-group col-md-12">
                                                    <button class="col-md-6 btn btn-info btn-purchase"id='<?php echo $r['itmid']; ?>' >
                                                        <i class="icon-print" ></i> รายงานฉบับร่าง
                                                    </button>
                                                    <button class="col-md-6 btn btn-primary btn-approve"id='<?php echo $r['itmid']; ?>' >
                                                        <i class="glyphicon glyphicon-send" ></i> ส่งอนุมัติ
                                                    </button>
                                                </div>
                                            <?php } elseif ($r['parcel_status'] == 'รอการอนุมัติ') { ?>
                                                <div class="btn-group col-md-12">
                                                    <button class="col-md-6 btn btn-info btn-purchase-w"id='<?php echo $r['itmid']; ?>' >
                                                        <i class="icon-print" ></i> รายงาน
                                                    </button>
                                                    <button data-toggle="collapse" data-target="#confirmApp" class="col-md-6 btn btn-success"id='<?php echo $r['itmid']; ?>' >
                                                        <i class="icon-save" ></i> บันทึกผลการอนุมัติ
                                                    </button>
                                                </div>
                                                <div class="collapse " id="confirmApp">
                                                    <div class="btn-group col-md-12 ">
                                                        <button class="col-md-6 btn btn-success btn-purchase-approve"id='<?php echo $r['itmid']; ?>' >
                                                            <i class="icon-check" ></i> อนุมัติ
                                                        </button>
                                                        <button class="col-md-6 btn btn-danger btn-purchase-not-approve"id='<?php echo $r['itmid']; ?>' >
                                                            <i class="icon-remove" ></i> ไม่อนุมัติ
                                                        </button>
                                                    </div>
                                                </div>
                                            <?php } elseif ($r['parcel_status'] == 'อนุมัติ') { ?>
                                                <!--<div class="btn-group col-md-12">-->
                                                    <button class="col-md-12 btn btn-info btn-purcase-approve-report"id='<?php echo $r['itmid']; ?>' >
                                                        <i class="icon-print" ></i> รายงานการอนุมัติ
                                                    </button>
<!--                                                    <button class="col-md-6 btn btn-primary btn-parcel_rc"id='<?php echo $r['itmid']; ?>' >
                                                        <i class="icon-check" ></i> ตรวจรับพัสดุ
                                                    </button>-->
                                                <!--</div>-->
                                            <?php } elseif ($r['parcel_status'] == 'เรียบร้อย') { ?>
                                                <button class="col-md-6 btn btn-info btn-purchase-success"id='<?php echo $r['itmid']; ?>' >
                                                    <i class="icon-print" ></i> รายงาน
                                                </button>
                                            <?php } elseif ($r['parcel_status'] == 'ไม่อนุมัติ') { ?>
                                                <div class="btn-group col-md-12">
                                                    <button class="col-md-6 btn btn-warning btn-purchase-edit"id='<?php echo $r['itmid']; ?>' >
                                                        <i class="icon-pencil" ></i> แก้ไขรายงานไม่อนุมัติ
                                                    </button>   
                                                    <button class="col-md-6 btn btn-danger btn-purchase-delete"id='<?php echo $r['itmid']; ?>' >
                                                        <i class="icon-trash" ></i> ลบ
                                                    </button> 
                                                </div>
                                                <div class="btn-group col-md-12">
                                                    <button class="col-md-6 btn btn-info btn-purchase"id='<?php echo $r['itmid']; ?>' >
                                                        <i class="icon-print" ></i> รายงานฉบับร่าง
                                                    </button>
                                                    <button class="col-md-6 btn btn-primary btn-approve"id='<?php echo $r['itmid']; ?>' >
                                                        <i class="glyphicon glyphicon-send" ></i> ส่งอนุมัติ
                                                    </button>
                                                </div>
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
$this->load->view('parcel/reports/parcel_purchase_w_report_modal');
$this->load->view('parcel/reports/parcel_purchase_report_modal');
$this->load->view('parcel/reports/parcel_purchase_approved_report_modal');
$this->load->view('parcel/modals/approve_purchase_modal');
$this->load->view('parcel/modals/approve_purchase_itm_modal');
?>

<script>
<?php
$tabName = "parcelID";

$text = "รายการจัดซื้อจัดจ้าง" . $project_name;
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
    $('.btn-approve').on("click", function (e) {
        var uid = $(this).attr('id');
        var status = confirm('เนื่องจากส่งข้อมูลแล้วไม่สามารถแก้ไขรายการได้อีก ท่านต้องการส่งข้อมูลเพื่ออนุมัติจริงหรือไม่ ?');
        if (status) {
            $.ajax({
                url: "<?php echo site_url('parcel/Approve_purchase/send_approve'); ?>",
                method: "post",
                data: {id: uid, status: 'รอการอนุมัติ'},
                success: function (data) {
                    location.reload();
                }
            });
        }
    });

    $('.btn-purchase').on("click", function (e) {
        var uid = $(this).attr('id');

        $.ajax({
            url: "<?php echo site_url('parcel/Approve_purchase/get_report1'); ?>",
            method: "post",
            data: {id: uid},
            success: function (data) {

                tinyMCE.get('inMemMoPurchase').setContent(data);
                $.ajax({
                    url: "<?php echo site_url('parcel/Approve_purchase/get_report2'); ?>",
                    method: "post",
                    data: {id: uid},
                    success: function (data) {
                        tinyMCE.get('inMemMoPurchaseAppend').setContent(data);
                        //
                        $.ajax({
                            url: "<?php echo site_url('parcel/Approve_purchase/get_report3'); ?>",
                            method: "post",
                            data: {id: uid},
                            success: function (data) {
                                tinyMCE.get('inMemMoPurchaseRest').setContent(data);
                                $("#parcel-report-modal").modal("show");

                            }
                        });
                    }
                });

            }
        });
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
                        var period = prompt("แจ้งลงนามในสัญญาภายใน", "7 วัน");

                        if (period != null) {
                            $.ajax({
                                url: "<?php echo site_url('parcel/Approve_purchase/get_report6'); ?>",
                                method: "post",
                                data: {id: uid,period:period},
                                success: function (data) {

                                    tinyMCE.get('inPurchaseContract').setContent(data);
                                    $("#parcel-app-report-modal").modal("show");
                                }
                            });
                        }
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

//                {"id":"10","parcel_seller_id":"6","parcel_department":"",
//                "parcel_plan":"","parcel_project_plan":"","parcel_purpose":"",
//                "parcel_use_date":"0","parcel_order_rc":"6","parcel_approve_rc":"27",
//                "parcel_resposible":"6","parcel_resposible_leader":"6","order_num":"2",
//                "parcel_order_date":"2562-05-24","receipt_order":"2","parcel_receipt_date":"2562-05-24",
//                "bill_num":"2","parcel_bill_date":"2562-05-24","year_parcel":"2562",
//                "parcel_status":"","department":""}
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


    $('.btn-purchase-approve').on("click", function (e) {
        var uid = $(this).attr('id');
        var status = confirm('ท่านต้องการอนุมัติจริงหรือไม่ ?');
        if (status) {
            $.ajax({
                url: "<?php echo site_url('parcel/Approve_purchase/send_approve'); ?>",
                method: "post",
                data: {id: uid, status: 'อนุมัติ'},
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
                data: {id: uid, status: 'ไม่อนุมัติ'},
                success: function (data) {
                    location.reload();
                }
            });
        }
    });



</script>
