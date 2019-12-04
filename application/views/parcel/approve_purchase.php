
<!-- ============================================================== -->
<!-- Start right Content here -->
<!-- ============================================================== -->
<div class="box">
    <div class="box-heading">  ระบบจัดซื้อจัดจ้าง
        <!--<button class="btn btn-primary waves-effect waves-light bt-insert" style="float: right" ><i class="fa fa-plus-square"></i> เพิ่มทำแผนการจัดซื้อจัดจ้าง </button>-->
        <button class="btn btn-primary waves-effect waves-light" style="float: right" data-toggle="modal" data-target="#myModal"><i class="fa fa-plus-square"></i> ค้นหาเรื่องเดิมที่ทำไว้ </button>

    </div>
    <ul class="breadcrumb">
        <li><?php echo anchor(site_url(), "<i class='icon-home icon-large'></i> หน้าแรก"); ?></li>
        <li><?php echo anchor(site_url('home_parcel'), "<i class='icon-archive icon-large'></i> งานพัสดุ"); ?></li>
        <li>ระบบจัดซื้อจัดจ้าง</li>
    </ul>
    <div class="box-body">

        <div class="row">
            <div class="col-xs-12">

                <div id="dashboardTAB" class="container-fluid">	
                    <ul class="nav nav-tabs">
                        <li class="active">
                            <a  href="#1" data-toggle="tab" data-id="1"><b>รายงานขอซื้อขอจ้าง</b></a>
                        </li>
                        <li>
                            <a  href="#2" data-toggle="tab" data-id="2"><b>คำสั่งแต่งตั้งคณะกรรมการตรวจรับ</b></a>
                        </li>
                        <li><a href="#3" data-toggle="tab" data-id="3"><b>ร้านค้าเสนอราคา</b></a></li>
                        <li><a href="#4" data-toggle="tab" data-id="4"><b>รายงานผลการพิจารณาและขออนุมัติสั่งซื้อสั่งจ้าง</b></a></li>
                        <li><a href="#5" data-toggle="tab" data-id="5"><b>ใบสั่งซื้อสั่งจ้าง</b></a></li>
                        <li><a href="#6" data-toggle="tab" data-id="6"><b>ส่งมอบพัสดุ/งานจ้าง</b></a></li>
                        <li><a href="#7" data-toggle="tab" data-id="7"><b>ตรวจรับ</b></a></li>
                        <li><a href="#8" data-toggle="tab" data-id="8"><b>ขออนุมัติจ่าย</b></a></li>
                    </ul>

                    <div class="tab-content">
                        <div class="tab-pane active" id="1" style="padding-top:10px;">
                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="card-box">
                                        <form name="frmSearch" id="frmSearch" method="post">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <div align="center">
                                                        <h4>การจัดซื้อ โดยวิธีเฉพาะเจาะจง</h4>
                                                        <p>ส่วนการจัดเตรียมข้อมูลสำหรับรายงานขอซื้อหรือขอจ้าง</p>
                                                        <p>(ตามข้อ 22 ของ ระเบียบกระทรวงการคลัง ว่าด้วยการจัดซื้อจัดจ้างและการบริหารพัสดุภาครัฐ พ.ศ. 2560)</p>
                                                    </div>
                                                    <hr>
                                                </div>

                                            </div>
                                            <div class="row">
                                                <div class="col-sm-4">
                                                    <fieldset class="form-group">
                                                        <label for="exampleInputEmail1">ฝ่าย/กลุ่มสาระ/งาน ที่มีความประสงค์จะขอซื้อ</label>

                                                    </fieldset>
                                                </div>
                                                <div class="col-sm-8">
                                                    <!--<fieldset class="form-group">-->

                                    <!--<input type="text" class="form-control" id="exampleInputEmail1" name="lastname_mem" placeholder="">-->
                                                    <section>
                                                        <input class="magicsearch" name="inDeparPlan" id="inDeparPlan" style="width : 100%; height: 40px !important;" placeholder="...">
                                                    </section>
                                                    <!--</fieldset>-->
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-sm-4">
                                                    <fieldset class="form-group">
                                                        <label for="exampleInputEmail1">ได้รับอนุมัติเงินจากแผนงาน</label>

                                                    </fieldset>
                                                </div>
                                                <div class="col-sm-8">
                                                    <fieldset class="form-group">

                                    <!--<input type="text" class="form-control" id="exampleInputEmail1" name="lastname_mem" placeholder="">-->
                                                        <section>
                                                            <input class="magicsearch" name="inSchPlan" id="inSchPlan" style="width : 100%; height: 40px !important;" placeholder="...">
                                                        </section>
                                                    </fieldset>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-sm-4">
                                                    <fieldset class="form-group">
                                                        <label for="exampleInputEmail1">งาน / โครงการ</label>

                                                    </fieldset>
                                                </div>
                                                <div class="col-sm-8">
                                                    <fieldset class="form-group">

                                    <!--<input type="text" class="form-control" id="exampleInputEmail1" name="lastname_mem" placeholder="">-->
                                                        <section>
                                                            <input class="magicsearch" name="inSchProjectPlan" id="inSchProjectPlan" style="width : 100%; height: 40px !important;" placeholder="...">
                                                        </section>
                                                    </fieldset>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-sm-4">
                                                    <fieldset class="form-group">
                                                        <label for="exampleInputEmail1">วัตถุประสงค์หรือเหตุผลความจำเป็นในการจัดซื้อ เพื่อ</label>

                                                    </fieldset>
                                                </div>
                                                <div class="col-sm-8">
                                                    <fieldset class="form-group">

                                                        <input type="text" class="form-control" id="inParcelPurpose" name="inParcelPurpose" placeholder="">

                                                    </fieldset>
                                                </div>
                                            </div>


                                            <div class="row">
                                                <div class="col-sm-4">
                                                    <fieldset class="form-group">
                                                        <label for="exampleInputEmail1">กำหนดเวลาที่ต้องการใช้งาน และส่งมอบ ภายใน</label>

                                                    </fieldset>
                                                </div>
                                                <div class="col-sm-1">
                                                    <fieldset class="form-group">

                                                        <input type="text" class="form-control" id="inUseDay" name="inUseDay" placeholder="">

                                                    </fieldset>
                                                </div>
                                                <div class="col-sm-1">
                                                    วัน
                                                </div>

                                            </div>

                                            <div class="row">
                                                <div class="col-sm-4">
                                                    <fieldset class="form-group">
                                                        <label for="exampleInputEmail1">รายชื่อผู้ตรวจรับพัสดุ ในครั้งนี้</label>

                                                    </fieldset>
                                                </div>
                                                <div class="col-sm-8">
                                                    <fieldset class="form-group">
                                                        <?php
                                                        $rs = $this->My_model->get_where_order('tb_human_resources_01', array('hr_office' => $this->session->userdata('department')), 'hr_thai_name,hr_thai_lastname');
                                                        ?>
                                                        <select class="form-control" name="inPurchaseRC">

                                                            <option value="">---เลือก---</option>
                                                            <?php
                                                            foreach ($rs as $r) :
                                                                ?>
                                                                <option value="<?php echo $r['id'] ?>"><?php echo $r['hr_thai_symbol'] . ' ' . $r['hr_thai_name'] . ' ' . $r['hr_thai_lastname']; ?></option>
                                                                <?php
                                                            endforeach;
                                                            ?>
                                                        </select>

                                                    </fieldset>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-sm-5">
                                                    <fieldset class="form-group">
                                                        <label for="exampleInputEmail1">ชื่อผู้ประกอบการที่มีคุณสมบัติตรงตามเงื่อนไขในการจัดซื้อครั้งนี้ คือ</label>

                                                    </fieldset>
                                                </div>
                                                <div class="col-sm-7">
                                                    <?php
                                                    $rs = $this->My_model->get_all_order('tb_parcel_seller', 'name_seller');
                                                    ?>
                                                    <fieldset class="form-group">
                                                        <select class="form-control" name="inSeller">

                                                            <option value="">---เลือก---</option>
                                                            <?php
                                                            foreach ($rs as $r) :
                                                                ?>
                                                                <option value="<?php echo $r['id'] ?>"><?php echo $r['name_seller']; ?></option>
                                                                <?php
                                                            endforeach;
                                                            ?>
                                                        </select>
                                                    </fieldset>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <?php
                                                $rs = $this->My_model->get_where_row('tb_parcel_purchase', array('year_parcel' => $yearly['year_parcel'], 'max(order_num)'));
                                                if (!$rs) {
                                                    $rs = $this->My_model->get_where_row('tb_parcel_number', array('year_parcel' => $yearly['year_parcel']));
                                                }
                                                ?>
                                                <div class="col-sm-2">
                                                    <fieldset class="form-group">
                                                        <label for="exampleInputEmail1">ใบสั่งซื้อ เลขที่</label>

                                                    </fieldset>
                                                </div>
                                                <div class="col-sm-2">
                                                    <fieldset class="form-group">
                                                        <label for="exampleInputEmail1"><?php echo ($rs['order_num'] + 1) . '/' . $rs['year_parcel']; ?></label>
                                                        <input type="hidden" id="inOrderNum" name="inOrderNum" value="<?php echo ($rs['order_num'] + 1); ?>" />
                                                    </fieldset>
                                                </div>
                                                <div class="col-sm-1">
                                                    <fieldset class="form-group">
                                                        <label for="exampleInputEmail1">ลงวันที่</label>

                                                    </fieldset>
                                                </div>
                                                <div class="col-sm-4">
                                                    <fieldset class="form-group">
                                                        <input type="text" class="form-control" id="inOrderNumDate" name="inOrderNumDate" placeholder="">
                                                    </fieldset>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-sm-2">
                                                    <fieldset class="form-group">
                                                        <label for="exampleInputEmail1">ใบตรวจรับ เลขที่</label>

                                                    </fieldset>
                                                </div>
                                                <div class="col-sm-2">
                                                    <fieldset class="form-group">
                                                        <label for="exampleInputEmail1"><?php echo ($rs['receipt_order'] + 1) . '/' . $rs['year_parcel']; ?></label>
                                                        <input type="hidden" id="inReceiptOrder" name="inReceiptOrder" value="<?php echo ($rs['receipt_order'] + 1); ?>" />
                                                    </fieldset>
                                                </div>
                                                <div class="col-sm-1">
                                                    <fieldset class="form-group">
                                                        <label for="exampleInputEmail1">ลงวันที่</label>

                                                    </fieldset>
                                                </div>
                                                <div class="col-sm-4">
                                                    <fieldset class="form-group">
                                                        <input type="text" class="form-control" id="inReceiptOrdeDate" name="inReceiptOrdeDate" placeholder="">
                                                    </fieldset>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-sm-2">
                                                    <fieldset class="form-group">
                                                        <label for="exampleInputEmail1">ใบเบิก เลขที่</label>

                                                    </fieldset>
                                                </div>
                                                <div class="col-sm-2">
                                                    <fieldset class="form-group">
                                                        <label for="exampleInputEmail1"><?php echo ($rs['bill_num'] + 1) . '/' . $rs['year_parcel']; ?></label>
                                                        <input type="hidden" id="inBillNum" name="inBillNum" value="<?php echo ($rs['bill_num'] + 1); ?>" />
                                                    </fieldset>
                                                </div>
                                                <div class="col-sm-1">
                                                    <fieldset class="form-group">
                                                        <label for="exampleInputEmail1">ลงวันที่</label>

                                                    </fieldset>
                                                </div>
                                                <div class="col-sm-4">
                                                    <fieldset class="form-group">
                                                        <input type="text" class="form-control" id="inBillNumDate" name="inBillNumDate" placeholder="">
                                                    </fieldset>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <input type="hidden" id="id" name="id" />  
                                                <input type="hidden" name='year_parcel' id='year_parcel' value="<?php echo $rs['year_parcel']; ?>" />
                                                <button name="search" type="button" class="btn btn-primary btn-insert"><i class="icon-save"></i> บันทึก</button>
                                                <button class="btn btn-clear">ยกเลิก</button>
                                            </div>
                                            <div class='row' style="margin-top: 30px;">
                                                <table class="table table-bordered" id='tabId'>
                                                    <thead class="thead-default">
                                                        <tr>
                                                            <th colspan="8" class="breadcrumb" style="text-align: right">
                                                                <button type="button" class="btn btn-primary btn-insert-itm"><i class="icon-plus"></i> เพิ่มรายการ</button>
                                                            </th>
                                                        </tr>
                                                        <tr>
                                                            <th rowspan="2" style="text-align: center;">ลำดับ<br>ที่</th>
                                                            <th rowspan="2" style="text-align: center;">รายละเอียดของพัสดุที่จะซื้อ</th>
                                                            <th rowspan="2" style="text-align: center;">จำนวน<br>หน่วย</th>
                                                            <th rowspan="2" style="text-align: center;">ราคา</th>
                                                            <th rowspan="2" style="text-align: center;">หน่วยละ</th>
                                                            <th colspan="2" style="text-align: center;">จำนวนและวงเงินที่ขอซื้อครั้งนี้</th>
                                                        </tr>
                                                        <tr>
                                                            <th style="text-align: center;">หน่วยละ</th>
                                                            <th style="text-align: center;">จำนวนเงิน</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="dynFrm">


                                                    </tbody>
                                                </table>


                                            </div>
                                            <div class="row">
                                                <center>
                                                    <button name="search" type="button"  class="btn btn-success btn-print"><i class="icon-print "></i> พิมพ์เอกสารจัดซื้อจัดจ้าง</button>
                                                </center>
                                            </div>

                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="2" style="padding-top:10px;">
                            tab2
                        </div>
                        <div class="tab-pane" id="3" style="padding-top:10px;">
                            tab3
                        </div>
                        <div class="tab-pane" id="4" style="padding-top:10px;">
                            tab4
                        </div>
                        <div class="tab-pane" id="5" style="padding-top:10px;">
                            tab5
                        </div>
                        <div class="tab-pane" id="6" style="padding-top:10px;">
                            tab6
                        </div>
                        <div class="tab-pane" id="7" style="padding-top:10px;">
                            tab7
                        </div>
                        <div class="tab-pane" id="8" style="padding-top:10px;">
                            tab
                        </div>
                    </div>
                </div>

            </div>
        </div>



        <!-- end row -->


    </div>
</div>




<?php
$this->load->view('parcel/modals/approve_purchase_itm_modal');

$this->load->view('parcel/modals/approve_purchase_modal');
        

$this->load->view('parcel/reports/parcel_purchase_report_modal');

$this->db->distinct();

$this->db->select('responsible');

$this->db->where(array('project_department' => $this->session->userdata('department')));

$this->db->order_by('responsible');

$divi = $this->db->get('tb_project_school')->result_array();
?>

<script>
    var dataSource2 = <?php echo json_encode($divi); ?>;

    $('#inDeparPlan').magicsearch({
        dataSource: dataSource2,
        fields: ['responsible'],
        id: 'responsible',
        format: '%responsible%',
        isClear: false,
        success: function ($input, data) {
            return true;
        }
    });
    var cnt = 1;
    //
    $('.btn-insert-itm').on("click", function (e) {
//        

        $.ajax({
            url: "<?php echo site_url('parcel/Approve_purchase/get_product'); ?>",
            method: "post",
            dataType: "json",
            success: function (data) {

                $('#inParcelProduct').magicsearch({
                    dataSource: data,
                    fields: ['name_mat'],
                    id: 'id',
                    format: '%name_mat%',
                    isClear: false,
                    success: function ($input, data) {
                        $('#inParcelProductId').val(data.id);
                        $('#inParcelUnitMat').val(data.unit_mat);
                        return true;
                    }
                });
            }
        });
        $('#inParcelSeq').val(cnt);
        $("#my-plan-modal").modal("show");

    });


    $('#inSchPlan').on("click", function () {
        var plan = [{'main_plan_name': 'แผนการจัดซื้อจัดจ้างประจำปี'}]
        var txt = $('#inDeparPlan').val()
        $.ajax({
            url: "<?php echo site_url('parcel/Approve_purchase/get_plan'); ?>",
            method: "post",
            data: {txt: txt},
            dataType: "json",
            success: function (data) {
                alert(data.length);
                if (data.length == 0) {
                    data = plan;
                }
                $('#inSchPlan').magicsearch({
                    dataSource: data,
                    fields: ['main_plan_name'],
                    id: 'id',
                    format: '%main_plan_name%',
                    isClear: false,
                    success: function ($input, data) {
                        return true;
                    }
                });

            }
        });
    });

    $('#inSchProjectPlan').on("click", function () {

        var txt = $('#inDeparPlan').val();
        var txtP = $('#inSchPlan').val();

        $.ajax({
            url: "<?php echo site_url('parcel/Approve_purchase/get_project_plan'); ?>",
            method: "post",
            data: {txt: txt, txtP: txtP},
            dataType: "json",
            success: function (data) {

                $('#inSchProjectPlan').magicsearch({
                    dataSource: data,
                    fields: ['project_name'],
                    id: 'id',
                    format: '%project_name%',
                    isClear: false,
                    success: function ($input, data) {
                        return true;
                    }
                });
                //  generate : plan suggest box filter by division
            }
        });


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
                $.ajax({
                    url: "<?php echo site_url('parcel/Approve_purchase/get_product'); ?>",
                    method: "post",
                    dataType: "json",
                    success: function (data) {

                        $('#inParcelProduct').magicsearch({
                            dataSource: data,
                            fields: ['name_mat'],
                            id: 'id',
                            format: '%name_mat%',
                            isClear: false,
                            success: function ($input, data) {
                                $('#inParcelProductId').val(data.id);
                                $('#inParcelUnitMat').val(data.unit_mat);

                                return true;
                            }
                        });
                    }
                });
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
//        alert($('id').val())

        $("#parcel-report-modal").modal("show");
        $('#memoNo').html($('#inOrderNum').val() + '/' + $('#year_parcel').val());
    });

</script>