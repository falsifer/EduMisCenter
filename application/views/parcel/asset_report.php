
<!--   <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.3/css/bootstrap-select.min.css" />-->

<div class="box">
    <div class="box-heading">  ระบบจัดซื้อจัดจ้าง : รายงานทะเบียนคุมทรัพย์สิน
    </div>
    <ul class="breadcrumb">
        <li><?php echo anchor(site_url(), "<i class='icon-home icon-large'></i> หน้าแรก"); ?></li>
        <li><?php echo anchor(site_url('home_parcel'), "<i class='icon-archive icon-large'></i> งานพัสดุ"); ?></li>
        <!--<li><?php echo anchor(site_url('parcel'), "<i class='icon-archive icon-large'></i> ระบบจัดซื้อจัดจ้าง"); ?></li>-->
        <li>รายงานทะเบียนคุมทรัพย์สิน</li>
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
                                    <th class="no-sort">ทะเบียนครุภัณฑ์</th>
                                    <th class="no-sort">สถานที่ตั้ง/เก็บครุภัณฑ์</th>
                                    <th class="no-sort">รายการ</th>
                                    <th class="no-sort">จำนวนหน่วย</th>
                                    <th class="no-sort">ราคาต่อหน่วย / ชุด / กลุ่ม</th>
                                    <th class="no-sort">มูลค่ารวม</th>
                                    <th class="no-sort">อายุการใช้งาน</th>
                                    <th class="no-sort">อัตราค่าเสื่อมราคา/หน่วย</th>
                                    <th class="no-sort">ค่าเสื่อมราคาประจำปี/หน่วย</th>
                                    <th class="no-sort">มุลค่าสุทธิ/หน่วย</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $row = 1;

                                foreach ($list as $r) {
                                    ?>
                                    <tr>
                                        <td style="text-align: center"><?php echo $row; ?></td>
                                        <td><?php echo shortdate($r['tb_parcel_control_rc_date']); ?></td>
                                        <td><?php echo $r['tb_parcel_control_no'] ?></td>
                                        <td><?php echo $r['tb_parcel_control_usage'] ?></td>
                                        <td><?php echo $r['name_mat']; ?>
                                        <?php
                                            if(isset($r['tb_parcel_purchase_itm_detail'])){
                                                echo " : ".$r['tb_parcel_purchase_itm_detail'];
                                            }
                                        ?>
                                        </td>                          
                                        <td style="text-align: right"><?php echo number_format($r['parcel_product_amt']); ?></td>                                         
                                        <td style="text-align: right"><?php echo number_format($r['parcel_price']); ?></td>
                                        <td style="text-align: right"><?php echo number_format($r['parcel_product_amt']*$r['parcel_price']); ?></td>
                                        <td style="text-align: right"><?php echo isset($r['tb_parcel_depreciate_age'])?$r['tb_parcel_depreciate_age']:"0"; ?></td>
                                        <?php
                                            $depRate = 0;
                                            if(isset($r['tb_parcel_depreciate_age'])){
                                                $depRate = round($r['parcel_price']/$r['tb_parcel_depreciate_age']);
                                            }
                                        ?>

                                        <td style="text-align: right"><?php echo isset($r['tb_parcel_depreciate_value'])?$r['tb_parcel_depreciate_value']:0 ?></td>
                                        <td style="text-align: right"><?php echo number_format($depRate); ?></td>
                                         <?php
                                            $net = 0;
                                            $collect = 0;
                                            $cy = date('Y')+543;
                                            $date=date_create($r['tb_parcel_control_rc_date']);
                                            $y = date_format($date, "Y");
                                            if($depRate>0){
                                                $collect = $depRate*($cy-$y);
                                                $net = $r['parcel_price']-$collect;
                                            }
                                            
                                        ?>
                                        <td style="text-align: right"><?php echo number_format($net); ?></td>
                                    </tr>
                                    <?php
                                }
                                ?>
                            </tbody>
                        </table>

                    </div>
                </div>

            </div>
        </div>



        <!-- end row -->


    </div>
</div>
<?php
//$this->load->view('parcel/reports/parcel_purchase_rc_report_modal');
//$this->load->view('parcel/modals/asset_rc_modal');
//$this->load->view('parcel/modals/approve_purchase_modal');
;
?>

<script>
<?php
$tabName = "parcelID";

$text = "รายงานทะเบียนคุมทรัพย์สิน";
$title = $this->Echo_Text_Model->head_logo($text, $this->session->userdata('sch_id'));
$colStr = "0,1,2,3,4,5,6,7,8,9,10";
$btExArr = array();
load_datatable($tabName, $btExArr, $title, $colStr);
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
//        $.ajax({
//            url: "<?php echo site_url('parcel/Asset/get_report7'); ?>",
//            method: "post",
//            data: {id: uid},
//            success: function (data) {
//                location.reload();
//            }
//            });
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
