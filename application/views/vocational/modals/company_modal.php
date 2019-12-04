<!-- Modal -->
<div id="company-modal" class="modal fade" role="dialog">
    <div class="modal-dialog" style="width:70%;">
        <div class="modal-content">
            <div class="modal-header" style="background:#0080FF;color:#FFFFFF;">
                <button type="button" class="close" data-dismiss="modal">X</button>
                <h3 class="modal-title" id="title"></h3>
            </div>
            <div class="modal-body">
                <form method="post" id="insert-form">
                    <div class="row">
                        <div class="form-group col-md-5">
                            <label class="control-label">ชื่อสถานประกอบการ</label>
                            <input type="text" name="inCompanyName" id="inCompanyName" class="form-control" autofocus required/>
                        </div>
                        <div class="form-group col-md-3">
                            <label class="control-label">ประเภท</label>
                            <select name="inCompanyType" id="inCompanyType" class="form-control">
                                <option value="">---เลือกข้อมูล---</option>
                            </select>
                        </div>
                        <div class="form-group col-md-2">
                            <label class="control-label">ที่อยู่เลขที่</label>
                            <input type="text" name="inCompanyAddressNo" id="inCompanyAddressNo" class="form-control" />
                        </div>
                        <div class="form-group col-md-2">
                            <label class="control-label">หมู่ที่</label>
                            <input type="text" name="inCompanyAddressMoo" id="inCompanyAddressMoo" class="form-control" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-3">
                            <label class="control-label">ซอย</label>
                            <input type="text" name="inCompanyAddressSoi" id="" class="form-control" />
                        </div>
                        <div class="form-group col-md-3">
                            <label class="control-label">ถนน</label>
                            <input type="text" name="inCompanyAddressStreet" id="" class="form-control" />
                        </div>
                        <div class="form-group col-md-3">
                            <label class="control-label">ตำบล/แขวง</label>
                            <input type="text" name="inCompanyAddressTambon" id="" class="form-control" />
                        </div>
                        <div class="form-group col-md-3">
                            <label class="control-label">อำเภอ/เขต</label>
                            <input type="text" name="inCompanyAddressAmphur" id="" class="form-control" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-3">
                            <label class="control-label">จังหวัด</label>
                            <input type="text" name="inCompanyAddressProvince" id="" class="form-control" />
                        </div>
                        <div class="form-group col-md-3">
                            <label class="control-label">รหัสไปรษณีย์</label>
                            <input type="text" name="inCompanyAddressZipcode" id="" class="form-control" />
                        </div>
                        <div class="form-group col-md-3">
                            <label class="control-label">โทรศัพท์</label>
                            <input type="text" name="inCompanyAddressTelephone" id="" class="form-control" />
                        </div>
                        <div class="form-group col-md-3">
                            <label class="control-label">โทรสาร</label>
                            <input type="text" name="inCompanyAddressFax" id="" class="form-control" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-3">
                            <label class="control-label">Email</label>
                            <input type="text" name="inCompanyAddressEmail" id="" class="form-control" />
                        </div>
                        <div class="form-group col-md-3">
                            <label class="control-label">Website</label>
                            <input type="text" name="inCompanyAddressWebiste" id="" class="form-control" />
                        </div>
                        <div class="form-group col-md-3">
                            <label class="control-label">ผู้จัดการ/ผู้ที่ติดต่อได้สะดวก</label>
                            <input type="text" name="inCompanyAddressManager" id="" class="form-control" />
                        </div>
                        <div class="form-group col-md-3">
                            <label class="control-label">โทรศัพท์มือถือ</label>
                            <input type="text" name="inCompanyAddressMobile" id="" class="form-control" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <center><button type="submit" class="btn btn-success"><i class="icon-save"></i> บันทึก</button></center>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer" style="background-color:#CEE3F6;">
                <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal"><i class="icon-power-off"></i></button>
            </div>
        </div>
    </div>
</div>
<script>
    $(".datepicker").datepicker({autoclose: true, language: 'th'});
</script>