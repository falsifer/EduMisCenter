<!-- Modal -->
<div id="school-modal" class="modal fade" role="dialog">
    <div class="modal-dialog" style="width:80%;">
        <div class="modal-content">
            <div class="modal-header" style="background:#0080FF;color:#FFFFFF;">
                <button type="button" class="close" data-dismiss="modal">X</button>
                <h3 class="modal-title" id="title"></h2>
            </div>
            <div class="modal-body">
                <form id="insert-form" method="post">
                    <div class="row">
                        <div class="col-md-3 form-group">
                            <label class="control-label">รหัสโรงเรียน (10 หลัก)</label><span class="star">&#42;</span>
                            <input type="text" name="inScCode" id="inScCode" class="form-control" required autofocus/>
                        </div>
                        <div class="col-md-3 form-group">
                            <label class="control-label">รหัส Smis (8 หลัก)</label><span class="star">&#42;</span>
                            <input type="text" name="inScSmis" id="inScSmis" class="form-control"  required/>
                        </div>
                        <div class="col-md-3 form-group">
                            <label class="control-label">รหัส OBEC (6 หลัก)</label><span class="star">&#42;</span>
                            <input type="text" name="inScObec" id="inScObec" class="form-control" required />
                        </div>
                        <div class="col-md-3 form-group">
                            <label class="control-label">ประเภทโรงเรียน</label><span class="star">&#42;</span>
                            <select name="inScTypeId" id="inScTypeId" class="form-control">
                                <option value="">--ประเภทโรงเรียน--</option>
                                <?php foreach ($school_type as $type): ?>
                                    <option value="<?php echo $type['id']; ?>"><?php echo $type['school_type']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 form-group">
                            <label class="control-label">ชื่อโรงเรียน (ภาษาไทย)</label><span class="star">&#42;</span>
                            <input type="text" name="inScThaiName" id="inScThaiName" class="form-control"  required/>
                        </div>
                        <div class="col-md-4 form-group">
                            <label class="control-label">ชื่อโรงเรียน (ภาษาอังกฤษ)</label>
                            <input type="text" name="inScEngName" id="inScEngName" class="form-control" />
                        </div>
                        <div class="col-md-4 form-group">
                            <label class="control-label">ชื่อย่อ</label>
                            <input type="text" name="inScSymbol" id="inScSymbol" class="form-control" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-2 form-group">
                            <label class="control-label">ที่อยู่เลขที่</label><span class="star">&#42;</span>
                            <?php echo form_input(array("type" => "text", "name" => "inScAddressNo", "id" => "inScAddressNo", "class" => "form-control", "required" => "required")); ?>
                        </div>
                        <div class="col-md-2 form-group">
                            <?php echo form_label('หมู่ที่', '', array('class' => 'control-label')); ?>
                            <?php echo form_input(array('type' => 'text', 'name' => 'inScAddressMoo', 'id' => "inScAddressMoo", "class" => "form-control")); ?>
                        </div>
                        <div class="col-md-4 form-group">
                            <?php echo form_label("หมู่บ้าน", "", array("class" => "control-label")); ?>
                            <?php echo form_input(array("type" => "text", "name" => "inScAddressVillage", "id" => "inScAddressVillage", "class" => "form-control")); ?>
                        </div>
                        <div class="col-md-4 form-group">
                            <?php echo form_label("ถนน", "", array("class" => "control-label")); ?>
                            <?php echo form_input(array("type" => "text", "name" => "inScAddressStreet", "id" => "inScAddressStreet", "class" => "form-control")); ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3 form-group">
                            <?php echo form_label("ตำบล", "", array("class" => "control-label")); ?><span class="star">&#42;</span>
                            <input type="text" name="inScAddressTambon" id="inScAddressTambon" class="form-control" required />
                        </div>
                        <div class="col-md-3 form-group">
                            <?php echo form_label("อำเภอ", "", array("class" => "control-label")); ?><span class="star">&#42;</span>
                            <input type="text" name="inScAddressAmphur" id="inScAddressAmphur" class="form-control" required />
                        </div>
                        <div class="col-md-3 form-group">
                            <?php echo form_label("จังหวัด", "", array("class" => "control-label")); ?><span class="star">&#42;</span>
                            <input type="text" name="inScAddressProvince" id="inScAddressProvince" class="form-control" required />
                        </div>
                        <div class="col-md-3 form-group">
                            <?php echo form_label("รหัสไปรษณีย์", "", array("class" => "control-label")); ?><span class="star">&#42;</span>
                            <input type="text" name="inScAddressZipcode" id="inScAddressZipcode" class="form-control" required/>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3 form-group">
                            <?php echo form_label("โทรศัพท์", "", array("class" => "control-label")); ?>
                            <input type="text" name="inScAddressTelephone" id="inScAddressTelephone" class="form-control" />
                        </div>
                        <div class="col-md-3 form-group">
                            <?php echo form_label("โทรสาร", "", array("class" => "control-label")); ?>
                            <input type="text" name="inScAddressFax" id="inScAddressFax" class="form-control" />
                        </div>
                        <div class="col-md-3 form-group">
                            <?php echo form_label("อีเมล์", "", array("class" => "control-label")); ?>
                            <input type="text" name="inScEmail" id="inScEmail" class="form-control" />
                        </div>
                        <div class="col-md-3 form-group">
                            <?php echo form_label("เวบไซต์", "", array("class" => "control-label")); ?>
                            <input type="text" name="inScWebsite" id="inScWebsite" class="form-control" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3 form-group">
                            <?php echo form_label("กลุ่มเครือข่าย", "", array("class" => "control-label")); ?>
                            <input type="text" name="inScNetwork" id="inScNetwork" class="form-control" />
                        </div>
                        <div class="col-md-3 form-group">
                            <?php echo form_label("อปท.ที่รับผิดชอบ", "", array("class" => "control-label")); ?>
                            <input type="text" name="inScLocalgov" id="inScLocalgov" class="form-control" value="<?php echo $this->session->userdata('localgov'); ?>"/>
                        </div>
                        <div class="col-md-3 form-group">
                            <?php echo form_label("ระยะทางถึงอำเภอ (กม.)", "", array("class" => "control-label")); ?>
                            <input type="text" name="inScLongAmphur" id="inScLongAmphur" class="form-control" />
                        </div>
                        <div class="col-md-3 form-group">
                            <?php echo form_label("ระยะทางถึง สพฐ. (กม.)", "", array("class" => "control-label")); ?>
                            <input type="text" name="inScLongHq" id="inScLongHq" class="form-control" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3 form-group">
                            <?php echo form_label("พิกัดละติจูด", "", array("class" => "control-label")); ?>
                            <input type="text" name="inScLat" id="inScLat" class="form-control" />
                        </div>
                        <div class="col-md-3 form-group">
                            <?php echo form_label("พิกัดลองจิจูด", "", array("class" => "control-label")); ?>
                            <input type="text" name="inScLong" id="inScLong" class="form-control" />
                        </div>
                        <div class="col-md-5 form-group">
                            <?php echo form_label("วันที่ก่อตั้ง", "", array("class" => "control-label")); ?>
                            <div class="form-group">
                                <select name="inScBeginDay" id="inScBeginDay" class="my-select" >
                                    <option value="">--วันที่--</option>
                                    <?php for ($i = 1; $i <= 31; $i++): ?>
                                        <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                    <?php endfor; ?>
                                </select>
                                <?php $arr = array('1' => "มกราคม", "2" => "กุมภาพันธ์", "3" => "มีนาคม", "4" => "เมษายน", "5" => "พฤษภาคม", "6" => "มิถุนายน", "7" => "กรกฎาคม", "8" => "สิงหาคม", "9" => "กันยายน", "10" => "ตุลาคม", "11" => "พฤศจิกายน", "12" => "ธันวาคม"); ?>
                                <select name="inScBeginMonth" id="inScBeginMonth" class="my-select" >
                                    <option value="">--เดือน--</option>
                                    <?php foreach ($arr as $key => $value): ?>
                                        <option value="<?php echo $key; ?>"><?php echo $value; ?></option>
                                    <?php endforeach; ?>

                                </select>
                                <select name="inScBeginYear" id="inScBeginYear" class="my-select" >
                                    <option value="">--พ.ศ.--</option>
                                    <?php for ($i = 2450; $i <= (date("Y") + 543); $i++): ?>
                                        <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                    <?php endfor; ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row"><center><button type="submit" class="btn btn-success btn-insert"><i class="icon-save icon-large"></i> บันทึกข้อมูล</button></center></div>
                    <div class="row"><div class="col-md-12">เครื่องหมาย <span class="star">&#42;</span> จำเป็นต้องกรอก</div></div>
                    <input type="hidden" name="id" id="id" />
                </form>
            </div>
            <div class="modal-footer" style="background-color:#CEE3F6;">
                <button type="button" class="btn btn-danger btn-small" data-dismiss="modal"><i class="icon-power-off"></i></button>
            </div>
        </div>
    </div>
</div>
<script>
    $(".datepicker").datepicker({autoclose: true, language: 'th'});
    $("#insert-form").on("submit", function (e) {
        e.preventDefault();
        //
        $.ajax({
            url: '<?php echo site_url('Setting/do_insert_school'); ?>',
            method: 'post',
            data: $("#insert-form").serialize(),
            success: function (data) {
                $("#insert-form")[0].reset();
                alert('บันทึกข้อมูลเรียบร้อย');
                location.reload();
            }
        });
    });
</script>