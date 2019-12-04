<div id="myModal"  class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog"style="width:95%;height: 600px;overflow-y: scroll; " >


        <div class="modal-content">
            <!--            <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            <h4 class="modal-title" id="myModalLabel">การทำเรื่องจัดซื้อจัดจ้าง โดยวิธีเฉพาะเจาะจง</h4>
                        </div>-->
            <?php
            $data['MyHeadTitle'] = 'การทำเรื่องจัดซื้อจัดจ้าง โดยวิธีเฉพาะเจาะจง';
            $this->load->view('layout/my_school_modal_header', $data);
            ?>
            <div class="modal-body">
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
                                <?php
                                $pRs = $this->My_model->get_where_row('tb_project_school', array('id' => $project_id));
                                $project_name = $pRs['project_name'];
                                $project_response = $pRs['responsible'];
                                ?>
                                <div class="row">
                                    <div class="col-sm-4">
                                        <fieldset class="form-group">
                                            <label for="exampleInputEmail1">ฝ่าย/กลุ่มสาระ/งาน ที่มีความประสงค์จะขอซื้อ</label>

                                        </fieldset>
                                    </div>
                                    <div class="col-sm-8">
                                        <input type="text" name='inDeparPlan' id="inDeparPlan"class="form-control" value='<?php echo $project_response; ?>'/>
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
                                            <input type="text" name='inSchProjectPlan' id="inSchProjectPlan"class="form-control" value='<?php echo $project_name; ?>'/>
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

                                            <input type="text" onkeyup="MyOnChange(this)" class="form-control" id="inUseDay" name="inUseDay" placeholder="">

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
                                            $rs = $this->My_model->get_where_order('tb_human_resources_01', array('hr_department' => $this->session->userdata('department')), 'hr_thai_name,hr_thai_lastname');
                                            ?>
                                            <select class="form-control" name="inPurchaseRC[]" multiple>
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
                                            <select class="selectpicker" data-show-subtext="true" name="inSeller" id="inSeller" data-live-search="true">
                                                <option value="">---เลือก---</option>
                                <?php
                                foreach ($rs as $r) {
                                    echo "<option value=\"" . $r['id'] . "\" >" . $r['name_seller'] . "</option>";
                                }
                                ?>
                                <!--                                <option data-subtext="Rep California">Tom Foolery</option>
                                                                <option data-subtext="Sen California">Bill Gordon</option>
                                                                <option data-subtext="Sen Massacusetts">Elizabeth Warren</option>
                                                                <option data-subtext="Rep Alabama">Mario Flores</option>
                                                                <option data-subtext="Rep Alaska">Don Young</option>
                                                                <option data-subtext="Rep California" disabled="disabled">Marvin Martinez</option>-->
                            </select>
<!--                                            <select class="form-control" name="inSeller">

                                                <option value="">---เลือก---</option>
                                                <?php
                                                foreach ($rs as $r) :
                                                    ?>
                                                    <option value="<?php echo $r['id'] ?>"><?php echo $r['name_seller']; ?></option>
                                                    <?php
                                                endforeach;
                                                ?>
                                            </select>-->
                                        </fieldset>
                                    </div>
                                </div>

                                <div class="row">
                                    <?php
                                    $rs = $this->Edutech_model->get_max_where_col('tb_parcel_purchase', 'order_num', array('year_parcel' => $yearly['year_parcel']));
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
                                            <label for="exampleInputEmail1" id="inOrderNumLabel"><?php echo ($rs['col'] + 1) . '/' . $yearly['year_parcel']; ?></label>
                                            <input type="hidden" id="inOrderNum" name="inOrderNum" value="<?php echo ($rs['col'] + 1); ?>" />
                                        </fieldset>
                                    </div>

                                    <div class="col-sm-4">
                                        <div class="input-group">
                                            <span class="input-group-addon">ลงวันที่</span>
                                            <input type="text" name="inOrderNumDate" id="inOrderNumDate" class="form-control datepicker"  placeholder="คลิกวันที่..."  data-date-language="th-th" data-date-format="yyyy-mm-dd" required/>
                                            <span class="input-group-addon"><i class="icon-calendar"></i></span>
                                        </div>
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
                                            <label for="exampleInputEmail1" id="inReceiptOrderLabel"><?php echo ($rs['col'] + 1) . '/' . $yearly['year_parcel']; ?></label>
                                            <input type="hidden" id="inReceiptOrder" name="inReceiptOrder" value="<?php echo ($rs['col'] + 1); ?>" />
                                        </fieldset>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="input-group">
                                            <span class="input-group-addon">ลงวันที่</span>
                                            <input type="text" name="inReceiptOrdeDate" id="inReceiptOrdeDate" class="form-control datepicker"  placeholder="คลิกวันที่..."  data-date-language="th-th" data-date-format="yyyy-mm-dd" required/>
                                            <span class="input-group-addon"><i class="icon-calendar"></i></span>
                                        </div>
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
                                            <label for="exampleInputEmail1" id="inBillNumLabel"><?php echo ($rs['col'] + 1) . '/' . $yearly['year_parcel']; ?></label>
                                            <input type="hidden" id="inBillNum" name="inBillNum" value="<?php echo ($rs['col'] + 1); ?>" />
                                        </fieldset>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="input-group">
                                            <span class="input-group-addon">ลงวันที่</span>
                                            <input type="text" name="inBillNumDate" id="inBillNumDate" class="form-control datepicker"  placeholder="คลิกวันที่..."  data-date-language="th-th" data-date-format="yyyy-mm-dd" required/>
                                            <span class="input-group-addon"><i class="icon-calendar"></i></span>
                                        </div>
                                    </div>

                                </div>
                                <div class="modal-footer">
                                    <input type="hidden" id="id" name="id" />  
                                    <input type="hidden" name='year_parcel' id='year_parcel' value="<?php echo $yearly['year_parcel']; ?>" />
                                    <button name="search" type="button" class="btn btn-success btn-insert"><i class="icon-save"></i> บันทึก</button>
                                    <button class="btn btn-danger btn-clear"><i class="icon-remove"></i> ยกเลิก</button>
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
                                                <th rowspan="2" style="text-align: center;width:5%">ลำดับ<br>ที่</th>
                                                <th rowspan="2" style="text-align: center;width:30%">รายละเอียดของพัสดุที่จะซื้อ</th>
                                                <th rowspan="2" style="text-align: center;">จำนวน<br>หน่วย</th>
                                                <th rowspan="2" style="text-align: center;">ราคา</th>
                                                <th rowspan="2" style="text-align: center;">หน่วยละ</th>
                                                <th colspan="2" style="text-align: center;">จำนวนและวงเงินที่ขอซื้อครั้งนี้</th>
                                                <th rowspan="2" style="text-align: center;width:5%">&nbsp</th>
                                            </tr>
                                            <tr>
                                                <th style="text-align: center;">หน่วยละ</th>
                                                <th style="text-align: center;">จำนวนเงิน</th>
                                            </tr>
                                        </thead>
                                        <tbody id="dynFrm">


                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                            </tr>
                                        </tfoot>
                                    </table>


                                </div>
                                <div class="row">
                                    <center>
                                        <button name="search" type="button"  class="btn btn-success btn-parcel-purchase"><i class="icon-check "></i> ตกลง</button>
                                    </center>
                                </div>

                            </form>
                            <script>
                                $(".datepicker").datepicker({autoclose: true, language: 'th-th'});
                                $("#inOrderNumDate").datepicker("setDate", new Date());
                                function MyOnChange(e) {
                                    var date = new Date();
                                    date.setDate(date.getDate() + e.value);
                                    var dd = date.getDate();
                                    var mm = date.getMonth() + 1;
                                    var y = date.getFullYear();

                                    $("#inOrderNumDate").datepicker("setDate", new Date(y + '-' + mm + '-' + dd));
                                }
                            </script>
                        </div>
                    </div>
                </div>
            </div>

        </div><!-- /.modal-content -->

    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<script>
$('#inSeller').on('change.bs.select', function (e, clickedIndex, isSelected, previousValue) {
        var uid = $('#inSeller').selectpicker('val');
        $('#inSeller').val(uid);

});


<?php
$tabName = "tabId";

$text = "รายการจัดซื้อจัดจ้าง" . $project_name;
$title = $this->Echo_Text_Model->head_logo($text, $this->session->userdata('sch_id'));
$colStr = "0,1,2,3,4,5,6";
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
                        .column(6)
                        .data()
                        .reduce(function (a, b) {
                            return intVal(a) + intVal(b);
                        }, 0);
                $(api.column(5).footer()).html('รวม');
                $(api.column(6).footer()).html(gtotal.toLocaleString('en'));
                $(api.column(7).footer()).html('บาท');

            }";


load_datatable($tabName, $btExArr, $title, $colStr, $footer);
?>
</script>