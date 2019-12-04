<!-- sample modal content -->

<div id="my-plan-modal" class="modal fade" role="dialog">   
    <div class="modal-dialog modal-lg">
        <form name="frmItm" id="frmItm" method="post"> 

            <!--<form class="form-horizontal" method="post" enctype="multipart/form-data">-->

            <div class="modal-content">
                <!--                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                    <h4 class="modal-title" id="my-plan-modalLabel">เพิ่มรายการจัดซื้อจัดจ้าง</h4>
                                </div>-->
                <?php
                $data['MyHeadTitle'] = 'เพิ่มรายการจัดซื้อจัดจ้าง';
                $this->load->view('layout/my_school_modal_header', $data);
                ?>
                <div class="modal-body" style="padding: 20px;">
                    <div class="row">
                        <div class="col-md-1">
                            ลำดับที่
                        </div>
                        <div class="col-md-4">
                            รายการ
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
                            <input type="hidden" name="inParcelProductName" id="inParcelProductName" />
                            <input type="hidden" name="inParcelProductId" id="inParcelProductId" />
<!--                            <section>
                                <input class="magicsearch" name="inParcelProduct" id="inParcelProduct" style="width : 100%; height: 40px !important;" placeholder="...">
                            </section>
                            -->
                            <select class="selectpicker" data-show-subtext="true" name="inParcelProduct" id="inParcelProduct" data-live-search="true">

                                <?php
                                foreach ($prod as $r) {
                                    $rs = $this->My_model->get_where_row('tb_parcel_category', array('id' => $r['category_id']));
                                    echo "<option value=\"" . $r['id'] . "\" data-subtext=\"" . $rs['name_cat'] . "\">" . $r['name_mat'] . "</option>";
                                }
                                ?>
                                <!--                                <option data-subtext="Rep California">Tom Foolery</option>
                                                                <option data-subtext="Sen California">Bill Gordon</option>
                                                                <option data-subtext="Sen Massacusetts">Elizabeth Warren</option>
                                                                <option data-subtext="Rep Alabama">Mario Flores</option>
                                                                <option data-subtext="Rep Alaska">Don Young</option>
                                                                <option data-subtext="Rep California" disabled="disabled">Marvin Martinez</option>-->
                            </select>


                        </div>
                        <div class="col-md-1">
                            <input type="number" name="inParcelProductAmt" id="inParcelProductAmt" class="form-control" />
                        </div>
                        <div class="col-md-2">
                            <select name="inParcelStdType" id="inParcelStdType">
                                <option value="ราคามาตรฐาน">ราคามาตรฐาน</option>
                                <option value="ราคาที่ได้มาจากการสืบจากท้องตลาด">ราคาท้องตลาด</option>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <input type="number" name="inParcelStdPrice" id="inParcelStdPrice" class="form-control" />
                        </div>
                        <div class="col-md-2">
                            <input type="number" name="inParcelPrice" id="inParcelPrice" class="form-control" />
                        </div>
                        <div class="col-md-12">
                            <label class="control-label">รายละเอียด</label>
                            <textarea name="inParcelPurchaseItmDetail" id="inParcelPurchaseItmDetail" class="form-control"></textarea>
                        </div>


                    </div>
                    <div class="row" style="margin-top: 20px;">
                        <center>
                        <input type="hidden" id="parcel_id" name="parcel_id" />    
                        <button name="save" type="button" class="btn btn-success btn-item-add"><i class="icon-shopping-cart icon-large"></i> นำรายการเข้า</button>
                        </center>
                    </div>
                </div>

            </div><!-- /.modal-content -->
        </form>

    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<script>
  $('#inParcelProduct').on('change.bs.select', function (e, clickedIndex, isSelected, previousValue) {
        var uid = $('#inParcelProduct').selectpicker('val');
        var txt =$('#inParcelProduct').find('[value='+uid+']').text();
        $('#inParcelProductId').val(uid);
        $('#inParcelProductName').val(txt);
});
</script>