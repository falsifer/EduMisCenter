<div class="panel panel-primary">
    <div class="panel-heading">ปรับปรุงรายละเอียดหน่วยงาน</div>
    <ul class="breadcrumb">
        <li><?php echo anchor(site_url(), "<i class='icon-home icon-large'></i> หน้าแรก"); ?></li>
        <li><?php echo anchor('administrator', 'ส่วนจัดการระบบ'); ?></li>
        <li>ปรับปรุงรายละเอียดหน่วยงาน</li>
    </ul>
    <div class="panel-body">
        <!--<div class="container">-->
        <div class="row">
            <div class='col-md-12'>
                <?php if (file_exists('upload/' . $rs['org_logo']) && !empty($rs["org_logo"])): ?>
                    <?php echo img(array("src" => "upload/" . $rs["org_logo"], "style" => "width:150px;height:150px;position:relative;left:5px;top:5px;margin-bottom:15px;")); ?>
                <?php endif; ?>
            </div>
            <form id="insert-form" method="post" enctype="multipart/form-data" action="<?php echo site_url('Setting/organization_insert'); ?>">

                <div class="col-md-5 form-group">
                    <label class="control-label">ชื่อหน่วยงาน (ภาษาไทย)</label>
                    <input type="text" name="inOrgThaiName" id="inOrgThaiName" value="<?php echo $rs['org_thai_name']; ?>" class="form-control" required autofocus/>
                </div>
                <div class="col-md-5 form-group">
                    <label class="control-label">ชื่อหน่วยงาน (ภาษาอังกฤษ)</label>
                    <input type="text" name="inOrgEngName" id="inOrgEngName" class="form-control" value="<?php echo $rs['org_eng_name']; ?>"/>
                </div>
                <div class="col-md-2 form-group">
                    <label class="control-label">ชื่อย่อ</label>
                    <input type="text" name="inOrgSymbol" id="inOrgSymbol" class="form-control" value="<?php echo $rs['org_symbol']; ?>"/>
                </div>


                <div class="col-md-2 form-group">
                    <label class="control-label">ที่อยู่เลขที่</label>
                    <input type="text" name="inOrgAddressNo" id="inOrgAddressNo" class="form-control" value="<?php echo $rs['org_address_no']; ?>" />
                </div>
                <div class="col-md-1 form-group">
                    <label class="control-label">หมู่ที่</label>
                    <input type="text" name="inOrgAddressMoo" id="inOrgAddressMoo" class="form-control" value="<?php echo $rs['org_address_moo']; ?>" />
                </div>
                <div class="col-md-3 form-group">
                    <label class="control-label">หมู่บ้าน</label>
                    <input type="text" name="inOrgAddressVillage" id="inOrgAddressVillage" class="form-control" value="<?php echo $rs['org_address_village']; ?>" />
                </div>
                <div class="col-md-3 form-group">
                    <label class="control-label">ถนน</label>
                    <input type="text" name="inOrgAddressStreet" id="inOrgAddressStreet" class="form-control" value="<?php echo $rs['org_address_street']; ?>" />
                </div>
                <div class="col-md-3 form-group">
                    <label class="control-label">แขวง/ตำบล</label>
                    <input type="text" name="inOrgAddressTambon" id="inOrgAddressTambon" class="form-control" value="<?php echo $rs['org_address_tambon']; ?>" />
                </div>

                <div class="col-md-3 form-group">
                    <label class="control-label">เขต/อำเภอ</label>
                    <input type="text" name="inOrgAddressAmphur" id="inOrgAddressAmphur" class="form-control" value="<?php echo $rs['org_address_amphur']; ?>" />
                </div>
                <div class="col-md-3 form-group">
                    <label class="control-label">จังหวัด</label>
                    <input type="text" name="inOrgAddressProvince" id="inOrgAddressProvince" class="form-control" value="<?php echo $rs['org_address_province']; ?>" />
                </div>
                <div class="col-md-3 form-group">
                    <label class="control-label">รหัสไปรษณีย์</label>
                    <input type="text" name="inOrgAddressZipcode" id="inOrgAddressZipcode" class="form-control"  value="<?php echo $rs['org_address_zipcode']; ?>"/>
                </div>
                <div class="col-md-3 form-group">
                    <label class="control-label">โทรศัพท์</label>
                    <input type="text" name="inOrgAddressTelephone" id="inOrgAddressTelephone" class="form-control" value="<?php echo $rs['org_address_telephone']; ?>" />
                </div>

                <div class="col-md-3 form-group">
                    <label class="control-label">โทรสาร (FAX)</label>
                    <input type="text" name="inOrgAddressFax" id="inOrgAddressFax" class="form-control" value="<?php echo $rs['org_address_fax']; ?>" />
                </div>
                <div class="col-md-3 form-group">
                    <label class="control-label">อีเมล</label>
                    <input type="text" name="inOrgAddressEmail" id="inOrgAddressEmail" class="form-control" value="<?php echo $rs['org_address_email']; ?>" />
                </div>
                <div class="col-md-3 form-group">
                    <label class="control-label">เว็บไซต์</label>
                    <input type="text" name="inOrgAddressWebsite" id="inOrgAddressWebsite" class="form-control" value="<?php echo $rs['org_address_website']; ?>" />
                </div>
                <div class="col-md-3 form-group">
                    <label class="control-label">ห่างจากอำเภอ (กม.)</label>
                    <input type="text" name="inOrgFromAmphur" id="inOrgFromAmphur" class="form-control" value="<?php echo $rs['org_from_amphur']; ?>" />
                </div>

                <div class="col-md-2 form-group">
                    <label class="control-label">พิกัดละติจูด</label>
                    <input type="text" name="inOrgAddressLat" id="inOrgAddressLat" class="form-control"  value="<?php echo $rs['org_address_lat']; ?>" />
                </div>
                <div class="col-md-2 form-group">
                    <label class="control-label">พิกัดลองจิจูด</label>
                    <input type="text" name="inOrgAddressLong" id="inOrgAddressLong" class="form-control"  value="<?php echo $rs['org_address_long']; ?>"/>
                </div>
                <div class="col-md-4 form-group">
                    <label class="control-label">ก่อตั้งเมื่อ</label>
                    <div class="form-group">
                        <select name="inOrgBeginDay" id="inOrgBeginDay" class="my-select" >
                            <option value="<?php echo $rs['org_begin_day']; ?>"><?php echo $rs['org_begin_day']; ?></option>
                            <?php for ($i = 1; $i <= 31; $i++): ?>
                                <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                            <?php endfor; ?>
                        </select>
                        <?php $arr = array('1' => "มกราคม", "2" => "กุมภาพันธ์", "3" => "มีนาคม", "4" => "เมษายน", "5" => "พฤษภาคม", "6" => "มิถุนายน", "7" => "กรกฎาคม", "8" => "สิงหาคม", "9" => "กันยายน", "10" => "ตุลาคม", "11" => "พฤศจิกายน", "12" => "ธันวาคม"); ?>
                        <select name="inOrgBeginMonth" id="inOrgBeginMonth" class="my-select" >
                            <option value="<?php echo $rs['org_begin_month']; ?>"><?php echo month_num($rs['org_begin_month']); ?></option>
                            <?php foreach ($arr as $key => $value): ?>
                                <option value="<?php echo $key; ?>"><?php echo $value; ?></option>
                            <?php endforeach; ?>

                        </select>
                        <select name="inOrgBeginYear" id="inOrgBeginYear" class="my-select">
                            <option value="<?php echo $rs['org_begin_year'] ?>"><?php echo $rs['org_begin_year'] ?></option>
                            <?php for ($i = 2450; $i <= (date("Y") + 543); $i++): ?>
                                <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                            <?php endfor; ?>
                        </select>
                    </div>                            
                </div>
                <div class="col-md-4 form-group ">
                    <label class="control-label">ตรา/สัญลักษณ์</label>
                    <input type="file" name="inOrgLogo" id="inOrgLogo" class="filestyle" /> 
                </div>
                <div class="col-md-12">
                    <center><button type="submit" class="btn btn-success"><i class="icon-save icon-large"></i> บันทึก</button></center>
                </div>

                <div class="col-md-12">เครื่องหมาย <span class="star">&#42;</span> จำเป็นต้องกรอก</div>

                <input type="hidden" id="id" name="id" value="<?php echo $rs['id']; ?>" />
            </form>
        </div>
        <!--</div>-->
    </div>

    <?php $this->load->view('layout/my_school_footer'); ?>
</div>
<script>
    $("#insert-form").on("submit", function (e) {
        e.preventDefault();
        //

        var logo = $("#inOrgLogo").val();
        var ext = $("#inOrgLogo").val().split('.').pop().toLowerCase();
        if (logo != '' && jQuery.inArray(ext, ['jpg', 'png']) == -1) {
            alert('ไฟล์ตราสัญลักษณ์จะต้องเป็นชนิด jpg หรือ png เท่านั้น');
            return false;
        }
        $.ajax({
            url: "<?php echo site_url('setting/organization_insert'); ?>",
            method: "post",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            success: function (data) {
                $("#insert-form")[0].reset();
                location.href = "<?php echo site_url(); ?>";
            }

        });
    });
</script>