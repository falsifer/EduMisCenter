<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">   
    <div class="modal-dialog modal-lg">
        <form name="frmSearch" id="frmSearch" method="post"> 

            <!--<form class="form-horizontal" method="post" enctype="multipart/form-data">-->

            <div class="modal-content">
<!--                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title" id="my-plan-modalLabel">ค้นหารายการจัดซื้อจัดจ้าง</h4>
                </div>-->
                <?php
                $data['MyHeadTitle'] = 'ค้นหารายการจัดซื้อจัดจ้าง';
                $this->load->view('layout/my_school_modal_header', $data);
                ?>
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

            </div><!-- /.modal-content -->
        </form>
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
