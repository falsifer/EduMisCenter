<!-- Modal -->
<div id="insert-modal" class="modal fade" role="dialog">
    <div class="modal-dialog" style="width:80%;">
        <div class="modal-content">
            <div class="modal-header" style="background:#0080FF;color:#FFFFFF;">
                <button type="button" class="close" data-dismiss="modal">X</button>
                <h3 class="modal-title" id="title"></h2>
            </div>
            <div class="modal-body" style="padding:30px;">
                <form method="post" id="insert-form">
                    <div class="row">
                        <div class="form-group col-md-5">
                            <label class="control-label">ชื่อ อปท. (ภาษาไทย)</label><span class="star">&#42;</span>
                            <input type="text" name="inLocalgovThaiName" id="inLocalgovThaiName" class="form-control" required autofocus />
                        </div>
                        <div class="form-group col-md-4">
                            <label class="control-label">ชื่อ อปท. (ภาษาอังกฤษ)</label>
                            <input type="text" name="inLocalgovEngName" id="inLocalgovEngName" class="form-control" />
                        </div>
                        <div class="col-md-3 form-group">
                            <label class="control-label">ประเภท อปท.</label>
                            <select name="inLocalgovTypeId" id="inLocalgovTypeId" class="form-control">
                                <option value="">---เลือกข้อมูล---</option>
                                <?php foreach ($localgov_type as $type): ?>
                                    <option value="<?php echo $type['id']; ?>"><?php echo $type['localgov_type']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-md-1 form-group">
                            <label class="control-label">เลขที่</label><span class="star">&#42;</span>
                            <input type="text" name="inLocalgovAddNo" id="inLocalgovAddNo" class="form-control" required />
                        </div>
                        <div class="form-group col-md-1">
                            <label class="control-label">หมู่ที่</label>
                            <input type="text" name="inLocalgovAddMoo" id="inLocalgovAddMoo" class="form-control" />
                        </div>
                        <div class="col-md-3 form-group">
                            <label class="control-label">หมู่บ้าน</label>
                            <input type="text" name="inLocalgovAddVillage" id="inLocalgovAddVillage" class="form-control" />
                        </div>
                        <div class="col-md-3 form-group">
                            <label class="control-label">ถนน</label>
                            <input type="text" name="inLocalgovAddStreet" id="inLocalgovAddStreet" class="form-control" />
                        </div>
                        <div class="col-md-4 form-group">
                            <label class="control-label">แขวง/ตำบล</label><span class="star">&#42;</span>
                            <input type="text" name="inLocalgovAddTambon" id="inLocalgovAddTambon" class="form-control" required />
                        </div>
                    </div>
                    <div class="row">

                        <div class="col-md-3 form-group">
                            <label class="control-label">เขต/อำเภอ</label><span class="star">&#42;</span>
                            <input type="text" name="inLocalgovAddAmphur" id="inLocalgovAddAmphur" class="form-control" required/>
                        </div>
                        <div class="col-md-3 form-group">
                            <label class="control-label">จังหวัด</label><span class="star">&#42;</span>
                            <input type="text" name="inLocalgovAddProvince" id="inLocalgovAddProvince" class="form-control" required/>
                        </div>
                        <div class="col-md-3 form-group">
                            <label class="control-label">รหัสไปรษณีย์</label><span class="star">&#42;</span>
                            <input type="text" name="inLocalgovAddZipcode" id="inLocalgovAddZipcode" class="form-control" required/>
                        </div>
                        <div class="col-md-3 form-group">
                            <label class="control-label">โทรศัพท์</label>
                            <input type="text" name="inLocalgovAddTelephone" id="inLocalgovAddTelephone" class="form-control" />
                        </div>    
                    </div>
                    <div class="row">
                        <div class="col-md-2 form-group">
                            <label class="control-label">โทรสาร</label>
                            <input type="text" name="inLocalgovAddFax" id="inLocalgovAddFax" class="form-control" />
                        </div>
                        <div class="col-md-3 form-group">
                            <label class="control-label">อีเมล์</label>
                            <input type="text" name="inLocalgovAddEmail" id="inLocalgovAddEmail" class="form-control" />
                        </div>
                        <div class="col-md-3 form-group">
                            <label class="control-label">เวบไซต์</label>
                            <input type="text" name="inLocalgovAddWebsite" id="inLocalgovAddWebsite" class="form-control" />
                        </div>
                        <div class="col-md-4 form-group">
                            <label class="control-label">วัน/เดือน/ปี ก่อตั้ง</label>
                            <div class="form-group">
                                <select name="inLocalgovBeginDay" id="inLocalgovBeginDay" class="my-select" style="width:30%;" >
                                    <option value="">-วันที่-</option>
                                    <?php for ($i = 1; $i <= 31; $i++): ?>
                                        <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                    <?php endfor; ?>
                                </select>
                                <!-- Month -->
                                <?php $arr = array('1' => "มกราคม", "2" => "กุมภาพันธ์", "3" => "มีนาคม", "4" => "เมษายน", "5" => "พฤษภาคม", "6" => "มิถุนายน", "7" => "กรกฎาคม", "8" => "สิงหาคม", "9" => "กันยายน", "10" => "ตุลาคม", "11" => "พฤศจิกายน", "12" => "ธันวาคม"); ?>
                                <select name="inLocalgovBeginMonth" id="inLocalgovBeginMonth" class="my-select" style="width:30%;" >
                                    <option value="">-เดือน-</option>
                                    <?php foreach ($arr as $key => $value): ?>
                                        <option value="<?php echo $key; ?>"><?php echo $value; ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <select name="inLocalgovBeginYear" id="inLocalgovBeginYear" class="my-select" style="width:30%;" >
                                    <option value="">-พ.ศ.-</option>
                                    <?php for ($i = 2450; $i <= (date("Y") + 543); $i++): ?>
                                        <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                    <?php endfor; ?>
                                </select>     
                            </div> 
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3 form-group">
                            <label class="control-label">พิกัดละติจูด</label>
                            <input type="text" name="inLocalgovAddLat" id="inLocalgovAddLat" class="form-control" />
                        </div>
                        <div class="col-md-3 form-group">
                            <label class="control-label">พิกัดลองจิจูด</label>
                            <input type="text" name="inLocalgovAddLong" id="inLocalgovAddLong" class="form-control" />
                        </div>
                    </div>
                    <div class="row">
                        <center><button type="submit" class="btn btn-success"><i class="icon-save icon-large"></i> บันทึกข้อมูล</button></center>
                    </div>
                    <div class="row"><div class="col-md-12">เครื่องหมาย <span class="star">&#42;</span> จำเป็นต้องกรอก</div></div>
                </form>
            </div>
            <div class="modal-footer" style="background-color:#CEE3F6;">
                <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="icon-power-off"></i></button>
            </div>
        </div>
    </div>
</div>
<script>
    $("#insert-form").on("submit", function (e) {
        e.preventDefault();
        $.ajax({
            url: '<?php echo site_url('setting/localgov_do_insert'); ?>',
            method: 'post',
            data: $('#insert-form').serialize(),
            success: function (data) {
                $('#insert-form')[0].reset();
                location.reload();
            }
        });
    });
</script>