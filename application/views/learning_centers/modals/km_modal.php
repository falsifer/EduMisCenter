<!-- Modal -->
<div id="km-modal" class="modal fade" role="dialog">
    <div class="modal-dialog" style="width:60%;">
        <div class="modal-content">
            <div class="modal-header" style="background:#0080FF;color:#FFFFFF;">
                <button type="button" class="close" data-dismiss="modal">X</button>
                <h3 class="modal-title" id="title"></h3>
            </div>
            <div class="modal-body">
                <form method="post" id="km-form" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-md-4 form-group">
                            <label class="control-label">ชื่อแหล่งเรียนรู้ (ภาษาไทย)</label>
                            <input type="text" name="inKmThaiName" id="inKmThaiName" class="form-control" required/>
                        </div>
                        <div class="col-md-3 form-group">
                            <label class="control-label">ชื่อแหล่งเรียนรู้ (ภาษาอังกฤษ)</label>
                            <input type="text" name="inKmEngName" id="inKmEngName" class="form-control" required/>
                        </div>
                        <div class="form-group col-md-2">
                            <label class="control-label">ชื่อย่อ (ถ้ามี)</label>
                            <input type="text" name="inKmSymbol" id="inKmSymbol" class="form-control" />
                        </div>
                        <div class="form-group col-md-3">
                            <label class="control-label">ชนิด/ประเภท</label>
                            <select name="inKmCategoryId" id="inKmCategoryId" class="form-control">
                                <option value="">---เลือกข้อมูล---</option>
                                <?php foreach ($km_category as $cat): ?>
                                    <option value="<?php echo $cat['id']; ?>"><?php echo $cat['km_type'] . ' - ' . $cat['km_category_name'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-2">
                            <label class="control-label">ที่อยู่เลขที่</label>
                            <input type="text" name="inKmAddressNo" id="inKmAddressNo" class="form-control" />
                        </div>
                        <div class="form-group col-md-2">
                            <label class="control-label">หมู่ที่</label>
                            <input type="text" name="inKmAddressMoo" id="inKmAddressMoo" class="form-control" />
                        </div>
                        <div class="form-group col-md-4">
                            <label class="control-label">ซอย</label>
                            <input type="text" name="inKmAddressSoi" id="inKmAddressSoi" class="form-control" />
                        </div>
                        <div class="form-group col-md-4">
                            <label class="control-label">หมู่บ้าน</label>
                            <input type="text" name="inKmAddressVillage" id="inKmAddressVillage" class="form-control" />
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-4">
                            <label class="control-label">ถนน</label>
                            <input type="text" name="inKmAddressStreet" id="inKmAddressStreet" class="form-control" />
                        </div>
                        <div class="form-group col-md-4">
                            <label class="control-label">ตำบล/แขวง</label>
                            <input type="text" name="inKmAddressTambon" id="inKmAddressTambon" class="form-control" />
                        </div>
                        <div class="form-group col-md-4">
                            <label class="control-label">อำเภอ/เขต</label>
                            <input type="text" name="inKmAddressAmphur" id="inKmAddressAmphur" class="form-control" />
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-4">
                            <label class="control-label">จังหวัด</label>
                            <input type="text" name="inKmAddressProvince" id="inKmAddressProvince" class="form-control" />
                        </div>
                        <div class="form-group col-md-4">
                            <label class="control-label">รหัสไปรษณีย์</label>
                            <input type="text" name="inKmAddressZipcode" id="inKmAddressZipcode" class="form-control" />
                        </div>
                        <div class="form-group col-md-4">
                            <label class="control-label">โทรศัพท์</label>
                            <input type="text" name="inKmAddressTelephone" id="inKmAddressTelephone" class="form-control" />
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-4">
                            <label class="control-label">โทรศัพท์มือถือ</label>
                            <input type="text" name="inKmAddressMobile" id="inKmAddressMobile" class="form-control" />
                        </div>
                        <div class="form-group col-md-4">
                            <label class="control-label">เวบไซต์</label>
                            <input type="text" name="inKmAddressWebsite" id="inKmAddressWebsite" class="form-control" />
                        </div>
                        <div class="form-group col-md-4">
                            <label class="control-label">อีเมล</label>
                            <input type="text" name="inKmAddressEmail" id="inKmAddressEmail" class="form-control" />
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-3">
                            <label class="control-label">ผู้รับผิดชอบ</label>
                            <input type="text" name="inKmManager" id="inKmManager" class="form-control" />
                        </div>
                        <div class="form-group col-md-3">
                            <label class="control-label">พิกัดละติจูด</label>
                            <input type="text" name="inKmAddressLat" id="inKmAddressLat" class="form-control" />
                        </div>
                        <div class="form-group col-md-3">
                            <label class="control-label">พิกัดลองจิจูด</label>
                            <input type="text" name="inKmAddressLong" id="inKmAddressLong" class="form-control" />
                        </div>
                        <div class="form-group col-md-3">
                            <label class="control-label">ภาพแหล่งเรียนรู้</label>
                            <input type="file" name="inKmImage" id="inKmImage" class="filestyle" />
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <center><button type="submit" class="btn btn-default"><i class="icon-save"></i> บันทึก</button></center>
                        </div>
                    </div>
                    <input type="hidden" name="id" id="id" />
                </form>
            </div>
            <div class="modal-footer" style="background-color:#CEE3F6;">
                <button type="button" class="btn btn-default btn-sm" data-dismiss="modal"><i class="icon-power-off"></i></button>
            </div>
        </div>
    </div>
</div>
<script>
    $(".datepicker").datepicker({autoclose: true, language: 'th', format: 'yyyy-mm-dd'});
    $('#km-form').on("submit", function (e) {
        e.preventDefault();
        var file = $("#inKmImage").val();
        var file_ext = $('#inKmImage').val().split('.').pop().toLowerCase();
        //
        if (file != '') {
            if (jQuery.inArray(file_ext, ['jpg', 'png']) == -1) {
                alert('ไฟล์ภาพประกอบจะต้องเป็นชนิด jpg หรือ png เท่านั้น');
                return false;
            }
        }
        //
        $.ajax({
            url: '<?php echo site_url('km-insert'); ?>',
            method: 'post',
            data: new FormData(this),
            cache: false,
            contentType: false,
            processData: false,
            success: function () {
                alert('บันทึกข้อมูลเรียบร้อย...');
                $('#km-form')[0].reset();
                location.reload();
            }
        });
    });
</script>