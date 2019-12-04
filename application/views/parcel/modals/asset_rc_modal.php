<div id="myModal"  class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog"style="width:90%; " >


        <div class="modal-content">
            <!--            <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            <h4 class="modal-title" id="myModalLabel">การทำเรื่องจัดซื้อจัดจ้าง โดยวิธีเฉพาะเจาะจง</h4>
                        </div>-->
            <?php
            $data['MyHeadTitle'] = 'บันทึกรายการตรวจรับการจัดซื้อ/จัดจ้าง';
            $this->load->view('layout/my_school_modal_header', $data);
            ?>
            <div class="modal-body">
                <form method="post" id="insert-rc-form">
                    <div class="row">
                        <div class="form-group col-md-3">
                            <label class="control-label">ผลการตรวจรับ</label>
                            <select class="form-control" name="inParcelRcStatus" id="inParcelRcStatus" required>
                                <option value="ครบถ้วนตามสัญญา">ครบถ้วนตามสัญญา</option>
                                <option value="ไม่ครบถ้วนตามสัญญา">ไม่ครบถ้วนตามสัญญา</option>
                            </select>
                        </div>
                        <div class="form-group col-md-5">
                            <label class="control-label">ค่าปรับ(บาท) <span style="font-style: italic;font-size: 0.8em"> ไม่มีค่าปรับระบุ 0</span></label>
                            <input type="number" name="inParcelRcFine" id="inParcelRcFine" class="form-control" value="0" required />
                        </div>
                        <div class="form-group col-md-12">
                            <label class="control-label">หมายเหตุ</label>
                            <textarea name="inParcelRcNote" id="inParcelRcNote" class="form-control">
                            </textarea>
                        </div>
                    </div>
                    <div class="row"><center><button type="button" class="btn btn-success" onclick="addRC()"><i class="icon-save icon-large"></i> บันทึก</button></center></div>
                    <input type="hidden" name="id" id="id" />
                    <input type="hidden" name="inParcelPurchaseId" id="inParcelPurchaseId" />
                </form>
            </div>

        </div><!-- /.modal-content -->

    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<script>
function addRC(){
        $.ajax({
            url: "<?php echo site_url('parcel/Asset/parcel_rc_insert'); ?>",
            method: 'post',
            data: $('#insert-rc-form').serialize(),
            success: function (data) {
                $('#insert-rc-form')[0].reset();
                alert('บันทึกข้อมูลเรียบร้อย');
                location.reload();
            }
        });
    }
</script>