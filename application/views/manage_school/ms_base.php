<div class="box">
    <div class="box-heading">ข้อมูลพื้นฐานโรงเรียน
        <button type="button" class="btn btn-info" id="insertRoom" style="float: right;margin-left: 5px;"><i class="icon-plus icon-large"></i> ตั้งค่าห้องเรียน</button>
        <button type="button" class="btn btn-info" id="insertClass" style="float: right;"><i class="icon-plus icon-large"></i> ตั้งค่าระดับชั้น</button>
    </div>
    <ul class="breadcrumb">
        <li><?php echo anchor(site_url(), "<i class='icon-home icon-large'></i> หน้าแรก"); ?></li>
        <?php if ($this->session->userdata('department') == 'กองการศึกษา') {
            ?>

            <li><?php echo anchor('administrator', 'ส่วนการจัดการระบบ'); ?></li>
        <?php } else { ?>

            <li><?php echo anchor('admin-school-base', 'ส่วนการจัดการระบบ'); ?></li>
            <?php
        }
        ?>
        <li>ข้อมูลพื้นฐานโรงเรียน</li>
    </ul>
    <div class="box-body">

        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <form method="post" id="insert-form" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-md-3 form-group">
                            <div class='row'>
                                <center>
                                    <label class="control-label">ตราสัญลักษณ์</label>
                                    <br/>
                                    <img id='logo' alt="คลิกเพื่ออัพโหลดตราสัญลักษณ์" class='btn btn-logo img-thumbnail' src="<?php echo base_url() . 'upload/' . $row[0]['sc_logo'] ?>" style='height:180px;'/>
                                    <input type="file" name="inScLogo" id="inScLogo" style='display:none' onchange="readURL2(this)"/>
                                    <script>
                                        $('.btn-logo').click(function () {
                                            $('#inScLogo').click();
                                        });
                                        function readURL2(input) {
                                            if (input.files && input.files[0]) {
                                                var reader = new FileReader();

                                                reader.onload = function (e) {
                                                    $('#logo')
                                                            .attr('src', e.target.result)
                                                            .width(180)
                                                            .height(180);
                                                };

                                                reader.readAsDataURL(input.files[0]);
                                            }
                                        }
                                    </script>
                                </center>
                            </div>
                        </div>
                        <div class="col-md-9 form-group">
                            <div class='row'>
                                <div class="col-md-5 form-group">
                                    <label class="control-label">ชื่อโรงเรียน (ภาษาไทย)</label><span class="star">&#42;</span>
                                    <input type="text" name="inScThaiName" id="inScThaiName" value="<?php echo $row[0]['sc_thai_name']; ?>" class="form-control"  required/>
                                </div>
                                <div class="col-md-5 form-group">
                                    <label class="control-label">ชื่อโรงเรียน (ภาษาอังกฤษ)</label>
                                    <input type="text" name="inScEngName" id="inScEngName" value="<?php echo $row[0]['sc_eng_name']; ?>" class="form-control" />
                                </div>
                                <div class="col-md-2 form-group">
                                    <label class="control-label">อักษรย่อ</label>
                                    <input type="text" name="inScSymbol" id="inScSymbol" value="<?php echo $row[0]['sc_symbol']; ?>" class="form-control" />
                                </div>
                            </div>
                            <div class='row'>
                                <div class="col-md-6 form-group">
                                    <label class="control-label">รหัสโรงเรียน (10 หลัก)</label><span class="star">&#42;</span>
                                    <input type="number" name="inScCode" id="inScCode" value="<?php echo $row[0]['sc_code'] ?>" class="form-control" required autofocus/>
                                </div>
                                <div class="col-md-6 form-group">
                                    <label class="control-label">รหัส Smis (8 หลัก)</label><span class="star">&#42;</span>
                                    <input type="number" name="inScSmis" id="inScSmis" value="<?php echo $row[0]['sc_smis'] ?>" class="form-control"  required/>
                                </div>

                            </div>
                            <div class='row'>
                                <div class="col-md-6 form-group">
                                    <label class="control-label">รหัส OBEC (6 หลัก)</label><span class="star">&#42;</span>
                                    <input type="number" name="inScObec" id="inScObec" value="<?php echo $row[0]['sc_obec'] ?>" class="form-control"  />
                                </div>
                                <div class="col-md-6 form-group">
                                    <label class="control-label">ประเภทโรงเรียน</label><span class="star">&#42;  <!--<button type="button" class="btn btn-link btn-classtype" id=""><i class="icon-plus icon-large"></i> ระดับชั้น</button>--></span>
                                    <select name="inScTypeId" id="inScTypeId"  class="form-control">
                                        <option value="<?php echo $row[0]['school_type_id']; ?>"><?php echo $row[0]['school_type']; ?></option>
                                        <?php foreach ($school_type as $type): ?>
                                            <option value="<?php echo $type['id']; ?>"><?php echo $type['school_type']; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>

                        </div>

                    </div>
                    <div class="row">

                    </div>
                    <div class="row">
                        <div class="col-md-2 form-group">
                            <label class="control-label">ที่อยู่เลขที่</label><span class="star">&#42;</span>
                            <input type="text" name="inScAddressNo" id="inScAddressNo" value="<?php echo $row[0]['sc_address_no']; ?>" class="form-control" />
                        </div>
                        <div class="col-md-2 form-group">
                            <?php echo form_label('หมู่ที่', '', array('class' => 'control-label')); ?>
                            <input type="text" name="inScAddressMoo" id="inScAddressMoo" value="<?php echo $row[0]['sc_address_moo']; ?>" class="form-control" />
                        </div>
                        <div class="col-md-4 form-group">
                            <?php echo form_label("หมู่บ้าน", "", array("class" => "control-label")); ?>
                            <input type="text" name="inScAddressVillage" id="inScAddressVillage" value="<?php echo $row[0]['sc_address_village']; ?>" class="form-control" />
                        </div>
                        <div class="col-md-4 form-group">
                            <?php echo form_label("ถนน", "", array("class" => "control-label")); ?>
                            <input type="text" name="inScAddressStreet" id="inScAddressStreet" value="<?php echo $row[0]['sc_address_street']; ?>" class="form-control" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3 form-group">
                            <?php echo form_label("ตำบล", "", array("class" => "control-label")); ?><span class="star">&#42;</span>
                            <input type="text" name="inScAddressTambon" id="inScAddressTambon" value="<?php echo $row[0]['sc_address_tambon']; ?>" class="form-control" required />
                        </div>
                        <div class="col-md-3 form-group">
                            <?php echo form_label("อำเภอ", "", array("class" => "control-label")); ?><span class="star">&#42;</span>
                            <input type="text" name="inScAddressAmphur" id="inScAddressAmphur" value="<?php echo $row[0]['sc_address_amphur']; ?>" class="form-control" required />
                        </div>
                        <div class="col-md-3 form-group">
                            <?php echo form_label("จังหวัด", "", array("class" => "control-label")); ?><span class="star">&#42;</span>
                            <input type="text" name="inScAddressProvince" id="inScAddressProvince" value="<?php echo $row[0]['sc_address_province']; ?>" class="form-control" required />
                        </div>
                        <div class="col-md-3 form-group">
                            <?php echo form_label("รหัสไปรษณีย์", "", array("class" => "control-label")); ?><span class="star">&#42;</span>
                            <input type="number" name="inScAddressZipcode" id="inScAddressZipcode" value="<?php echo $row[0]['sc_address_zipcode']; ?>" class="form-control" required/>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3 form-group">
                            <?php echo form_label("โทรศัพท์", "", array("class" => "control-label")); ?>
                            <input type="text" name="inScAddressTelephone" id="inScAddressTelephone" value="<?php echo $row[0]['sc_address_telephone']; ?>" class="form-control" />
                        </div>
                        <div class="col-md-3 form-group">
                            <?php echo form_label("โทรสาร", "", array("class" => "control-label")); ?>
                            <input type="text" name="inScAddressFax" id="inScAddressFax" value="<?php echo $row[0]['sc_address_fax']; ?>" class="form-control" />
                        </div>
                        <div class="col-md-3 form-group">
                            <?php echo form_label("อีเมล์", "", array("class" => "control-label")); ?>
                            <input type="text" name="inScEmail" id="inScEmail" value="<?php echo $row[0]['sc_email']; ?>" class="form-control" />
                        </div>
                        <div class="col-md-3 form-group">
                            <?php echo form_label("เวบไซต์", "", array("class" => "control-label")); ?>
                            <input type="text" name="inScWebsite" id="inScWebsite" value="<?php echo $row[0]['sc_website']; ?>" class="form-control" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3 form-group">
                            <?php echo form_label("กลุ่มเครือข่าย", "", array("class" => "control-label")); ?>
                            <input type="text" name="inScNetwork" id="inScNetwork" value="<?php echo $row[0]['sc_network']; ?>" class="form-control" />
                        </div>
                        <div class="col-md-3 form-group">
                            <?php echo form_label("อปท.ที่รับผิดชอบ", "", array("class" => "control-label")); ?>
                            <input type="text" name="inScLocalgov" id="inScLocalgov" value="<?php echo $row[0]['sc_localgov']; ?>" class="form-control" />
                        </div>
                        <div class="col-md-3 form-group">
                            <?php echo form_label("ระยะทางถึงอำเภอ (กม.)", "", array("class" => "control-label")); ?>
                            <input type="number" name="inScLongAmphur" id="inScLongAmphur" value="<?php echo $row[0]['sc_long_amphur']; ?>" class="form-control" />
                        </div>
                        <div class="col-md-3 form-group">
                            <?php echo form_label("ระยะทางถึง สพฐ. (กม.)", "", array("class" => "control-label")); ?>
                            <input type="number" name="inScLongHq" id="inScLongHq" value="<?php echo $row[0]['sc_long_hq']; ?>" class="form-control" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3 form-group">
                            <?php echo form_label("พิกัดละติจูด", "", array("class" => "control-label")); ?>
                            <input type="number" name="inScLat" id="inScLat" value="<?php echo $row[0]['sc_lat']; ?>" class="form-control" />
                        </div>
                        <div class="col-md-3 form-group">
                            <?php echo form_label("พิกัดลองจิจูด", "", array("class" => "control-label")); ?>
                            <input type="number" name="inScLong" id="inScLong" value="<?php echo $row[0]['sc_long']; ?>" class="form-control" />
                        </div>
                        <div class="col-md-5 form-group">
                            <?php echo form_label("วันที่ก่อตั้ง", "", array("class" => "control-label")); ?>
                            <div class="form-group">
                                <select name="inScBeginDay" id="inScBeginDay" class="my-select" >
                                    <option value="<?php echo $row[0]['sc_begin_day']; ?>"><?php echo $row[0]['sc_begin_day']; ?></option>
                                    <?php for ($i = 1; $i <= 31; $i++): ?>
                                        <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                    <?php endfor; ?>
                                </select>
                                <?php $arr = array('1' => "มกราคม", "2" => "กุมภาพันธ์", "3" => "มีนาคม", "4" => "เมษายน", "5" => "พฤษภาคม", "6" => "มิถุนายน", "7" => "กรกฎาคม", "8" => "สิงหาคม", "9" => "กันยายน", "10" => "ตุลาคม", "11" => "พฤศจิกายน", "12" => "ธันวาคม"); ?>
                                <select name="inScBeginMonth" id="inScBeginMonth" class="my-select" >
                                    <option value="<?php echo $row[0]['sc_begin_month']; ?>"><?php echo $row[0]['sc_begin_month']; ?></option>
                                    <?php foreach ($arr as $key => $value): ?>
                                        <option value="<?php echo $key; ?>"><?php echo $value; ?></option>
                                    <?php endforeach; ?>

                                </select>
                                <select name="inScBeginYear" id="inScBeginYear" class="my-select" >
                                    <option value="<?php echo $row[0]['sc_begin_year']; ?>"><?php echo $row[0]['sc_begin_year']; ?></option>
                                    <?php for ($i = 2450; $i <= (date("Y") + 543); $i++): ?>
                                        <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                    <?php endfor; ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row"><center><button type="submit" class="btn btn-success btn-insert"><i class="icon-save icon-large"></i> บันทึก</button></center></div>
                    <div class="row"><div class="col-md-12">เครื่องหมาย <span class="star">&#42;</span> จำเป็นต้องกรอก</div></div>
                    <input type="hidden" name="schoolid" id="schoolid" value="<?php echo $row[0]['id']; ?>" />
                </form>
            </div>
        </div>
    </div>
    <?php $this->load->view('layout/my_school_footer'); ?>
</div>

<?php $this->load->view("manage_school/ms_class_type_modal"); ?>
<script>

    $(".datepicker").datepicker({autoclose: true, language: 'th'});

    var SchoolId = <?php echo $row[0]['id']; ?>;
    $("#insert-form").on("submit", function (e) {
        e.preventDefault();
        //
        $.ajax({
            url: '<?php echo site_url('Manage_school/do_insert_school'); ?>',
            method: 'post',
            data: new FormData(this),
            cache: false,
            contentType: false,
            processData: false,
            success: function (data) {
                $("#insert-form")[0].reset();
                alert('บันทึกข้อมูลเรียบร้อย');
                location.reload();
            }
        });
    });

    // ประเภทสถานศึกษา modal 
    $("#insert-form").on("click", ".btn-classtype", function () {
        $("#ms-class-type-modal").modal("show");
    });


    // ระดับชั้น modal 
    $("#insertClass").on("click", function () {
        $("#ms-class-type-modal").modal("show");
    });

    // ห้องเรียน  
    $("#insertRoom").on("click", function () {
//        $("#room-modal").modal("show");
        location.href = '<?php echo site_url('ed-room-admin'); ?>';
    });
</script>

