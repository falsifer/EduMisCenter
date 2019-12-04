
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
                            <a  href="#1" data-toggle="tab" data-id="1"><b>วิชาการ</b></a>
                        </li>
                        <li>
                            <a  href="#2" data-toggle="tab" data-id="2"><b>งานบริหารทั่วไป</b></a>
                        </li>
                        <li><a href="#3" data-toggle="tab" data-id="3"><b>บุคลากร</b></a></li>
                        <li><a href="#4" data-toggle="tab" data-id="4"><b>งบประมาณ</b></a></li>
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
                            <div class="col-md-12">
                                <legend class="legend-heading" style="padding:10px;">น้ำหนักของนักเรียน<?php echo $this->session->userdata('department'); ?></legend>
                                <div id="top_x_div_std"  class="databox"></div>
                            </div>
                            <div class="col-md-12">
                                <legend class="legend-heading" style="padding:10px;">ส่วนสูงของนักเรียน<?php echo $this->session->userdata('department'); ?></legend>
                                <div id="top_x_div_std_w"  class="databox"></div>
                            </div>
                            <div class="col-md-12">
                                <legend class="legend-heading" style="padding:10px;">การมาเรียนของนักเรียน<?php echo $this->session->userdata('department'); ?></legend>
                                <div class="col-md-12">
                                    <div id="top_x_div_icare_std"  class="databox"></div>
                                </div>
                                <div id="top_x_div_icare_std_absent"  class="databox"></div>
                            </div>
                            <div class="col-md-12">
                                <legend class="legend-heading" style="padding:10px;">สรุปข้อมูลและสถิติงานดูแลช่วยเหลือนักเรียน<?php echo $this->session->userdata('department'); ?></legend>

                                <div class="col-md-12">
                                    <div id="top_x_div_icare_ln"  class="databox"></div> 
                                </div>
                                <div class="col-md-12">
                                    <div id="top_x_div_icare_hl"  class="databox"></div> 
                                </div>
                                <div class="col-md-12">
                                    <div id="top_x_div_icare_fm"  class="databox"></div> 
                                </div>
                                <div class="col-md-12">
                                    <div id="top_x_div_icare_ot"  class="databox"></div> 
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="3" style="padding-top:10px;">
                            <div class="col-md-12">
                                <div id="top_x_div_em_absent"  class="databox"></div>
                            </div>
                            <div class="col-md-12">
                                <div id="top_x_div5"  class="databox"></div>
                            </div>
                            <div class="col-md-12">
                                <div id="top_x_div6"  class="databox"></div>
                            </div>
                            <div class="col-md-12">
                                <div id="top_x_div_em_group"  class="databox"></div>
                            </div>
                        </div>
                        <div class="tab-pane" id="4" style="padding-top:10px;">
                            <div class="col-md-12">
                                <div id="top_x_div_budget"  class="databox"></div>
                            </div>
                            <div class="col-md-12">
                                <div id="top_x_div_budget_q"  class="databox"></div>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>



        <!-- end row -->


    </div>
</div>

<!-- Modal -->
<div id="my-plan-modal" class="modal fade" role="dialog">   
    <div class="modal-dialog modal-lg">
        <form name="frmItm" id="frmItm" method="post"> 

            <!--<form class="form-horizontal" method="post" enctype="multipart/form-data">-->

            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title" id="my-plan-modalLabel">เพิ่มรายการจัดซื้อจัดจ้าง</h4>
                </div>
                <div class="modal-body" style="padding: 20px;">
                    <div class="row">
                        <div class="col-md-1">
                            ลำดับที่
                        </div>
                        <div class="col-md-4">
                            รายละเอียดของพัสดุที่จะซื้อ
                        </div>
                        <div class="col-md-1">
                            จำนวนหน่วย
                        </div>
                        <div class="col-md-2">
                            ราคา
                        </div>
                        <div class="col-md-2">
                            หน่วยละ	
                        </div>
                        <div class="col-md-2">
                            ราคาที่ขอซื้อครั้งนี้
                        </div>
                        <!--                        <div class="col-md-2">
                                                    รวมจำนวนเงินที่ขอซื้อครั้งนี้</div>-->
                    </div>
                    <div class="row">
                        <div class="col-md-1">
                            <input type="text" name="inParcelSeq" id="inParcelSeq" class="form-control" />
                        </div>
                        <div class="col-md-4">
                            <input type="hidden" name="inParcelUnitMat" id="inParcelUnitMat" />

                            <input type="hidden" name="inParcelProductId" id="inParcelProductId" />
                            <section>
                                <input class="magicsearch" name="inParcelProduct" id="inParcelProduct" style="width : 100%; height: 40px !important;" placeholder="...">
                            </section>
                        </div>
                        <div class="col-md-1">
                            <input type="text" name="inParcelProductAmt" id="inParcelProductAmt" class="form-control" />
                        </div>
                        <div class="col-md-2">
                            <select name="inParcelStdType" id="inParcelStdType">
                                <option value="ราคามาตรฐาน">ราคามาตรฐาน</option>
                                <option value="ราคาที่ได้มาจากการสืบจากท้องตลาด">ราคาท้องตลาด</option>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <input type="text" name="inParcelStdPrice" id="inParcelStdPrice" class="form-control" />
                        </div>
                        <div class="col-md-2">
                            <input type="text" name="inParcelPrice" id="inParcelPrice" class="form-control" />
                        </div>
                        <!--                        <div class="col-md-2">
                                                    <input type="text" readonly name="inParcelTotalPrice" id="inParcelTotalPrice" class="form-control" />
                                                </div>-->


                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" id="parcel_id" name="parcel_id" />    
                    <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">Close</button>
                    <button name="save" type="button" class="btn btn-primary btn-item-add">นำรายการเข้า</button>
                </div>
            </div><!-- /.modal-content -->
        </form>
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">   
    <div class="modal-dialog modal-lg">
        <form name="frmSearch" id="frmSearch" method="post"> 

            <!--<form class="form-horizontal" method="post" enctype="multipart/form-data">-->

            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title" id="my-plan-modalLabel">ค้นหารายการจัดซื้อจัดจ้าง</h4>
                </div>
                <div class="modal-body" style="padding: 20px;">
                    <div class="row">
                        <div class="col-md-1">
                            ลำดับที่
                        </div>
                        <div class="col-md-4">
                            รายละเอียดของพัสดุที่จะซื้อ
                        </div>
                        <div class="col-md-1">
                            จำนวนหน่วย
                        </div>
                        <div class="col-md-2">
                            ราคา
                        </div>
                        <div class="col-md-2">
                            หน่วยละ	
                        </div>
                        <div class="col-md-2">
                            ราคาที่ขอซื้อครั้งนี้
                        </div>
                        <!--                        <div class="col-md-2">
                                                    รวมจำนวนเงินที่ขอซื้อครั้งนี้</div>-->
                    </div>
                    <div class="row">
                        <div class="col-md-1">
                            <input type="text" name="inParcelSeq" id="inParcelSeq" class="form-control" />
                        </div>
                        <div class="col-md-4">
                            <input type="hidden" name="inParcelUnitMat" id="inParcelUnitMat" />

                            <input type="hidden" name="inParcelProductId" id="inParcelProductId" />
                            <section>
                                <input class="magicsearch" name="inParcelProduct" id="inParcelProduct" style="width : 100%; height: 40px !important;" placeholder="...">
                            </section>
                        </div>
                        <div class="col-md-1">
                            <input type="text" name="inParcelProductAmt" id="inParcelProductAmt" class="form-control" />
                        </div>
                        <div class="col-md-2">
                            <select name="inParcelStdType" id="inParcelStdType">
                                <option value="ราคามาตรฐาน">ราคามาตรฐาน</option>
                                <option value="ราคาที่ได้มาจากการสืบจากท้องตลาด">ราคาท้องตลาด</option>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <input type="text" name="inParcelStdPrice" id="inParcelStdPrice" class="form-control" />
                        </div>
                        <div class="col-md-2">
                            <input type="text" name="inParcelPrice" id="inParcelPrice" class="form-control" />
                        </div>
                        <!--                        <div class="col-md-2">
                                                    <input type="text" readonly name="inParcelTotalPrice" id="inParcelTotalPrice" class="form-control" />
                                                </div>-->


                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" id="parcel_id" name="parcel_id" />    
                    <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">Close</button>
                    <button name="save" type="button" class="btn btn-primary btn-item-add">ค้นหา</button>
                </div>
            </div><!-- /.modal-content -->
        </form>
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<?php
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