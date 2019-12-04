<div class="panel panel-primary">
    <div class="panel-heading">ข้อมูลที่อยู่<?php echo $hr['hr_thai_symbol'] . '' . $hr['hr_thai_name'] ?><?php echo nbs(2); ?><?php echo $hr['hr_thai_lastname']; ?> </div>
    <ul class="breadcrumb">
        <li><?php echo anchor(site_url(), "<i class='icon-home icon-large'></i> หน้าแรก"); ?></li>
        <?php
        $hr_id = $this->session->userdata('hr_id');
        $checker = $this->uri->segment(2);

        if ($hr_id != $checker) {
            ?>
            <li><?php echo anchor("human_resources", "ทำเนียบบุคลากร"); ?></li>
        <?php } else { ?>
            <li><?php echo anchor("hr-member-profile", "ข้อมูลผู้ใช้"); ?></li>
        <?php } ?>
        <li>ข้อมูลที่อยู่</li>
    </ul>

    <div class="panel-body">
        <form method="post" id="insert-form">
            <div class="row">
                <div class="col-md-12">
                    <!-- ที่อยู่ตามทะเบียนบ้าน -->
                    <legend>ที่อยู่ตามทะเบียนบ้าน</legend>

                    <div class="form-group col-md-2">
                        <label class="control-label">ที่อยู่เลขที่</label>
                        <input type="text" name="inHrAddressNo" id="inHrAddressNo" value="<?php echo isset($rs['hr_address_no'])?$rs['hr_address_no']:""; ?>" class="form-control" />
                    </div>
                    <div class="form-group col-md-2">
                        <label class="control-label">หมู่ที่</label>
                        <input type="number" name="inHrAddressMoo" id="inHrAddressMoo" value="<?php echo isset($rs['hr_address_moo'])?$rs['hr_address_moo']:""; ?>" class="form-control" />
                    </div>
                    <div class="form-group col-md-4">
                        <label class="control-label">หมู่บ้าน</label>
                        <input type="text" name="inHrAddressVillage" id="inHrAddressVillage" value="<?php echo isset($rs['hr_address_village'])?$rs['hr_address_village']:""; ?>" class="form-control" />
                    </div>
                    <div class="form-group col-md-4">
                        <label class="control-label">ซอย</label>
                        <input type="text" name="inHrAddressSoi" id="inHrAddressSoi" value="<?php echo isset($rs['hr_address_soi'])?$rs['hr_address_soi']:""; ?>" class="form-control" />
                    </div>

                    <div class="form-group col-md-4">
                        <label class="control-label">ถนน</label>
                        <input type="text" name="inHrAddressStreet" id="inHrAddressStreet" value="<?php echo isset($rs['hr_address_street'])?$rs['hr_address_street']:""; ?>" class="form-control" />
                    </div>
                    <div class="form-group col-md-4">
                        <label class="control-label">ตำบล</label>
                        <input type="text" name="inHrAddressTambon" id="inHrAddressTambon" value="<?php echo isset($rs['hr_address_tambon'])?$rs['hr_address_tambon']:""; ?>" class="form-control" />
                    </div>
                    <div class="form-group col-md-4">
                        <label class="control-label">อำเภอ</label>
                        <input type="text" name="inHrAddressAmphur" id="inHrAddressAmphur" value="<?php echo isset($rs['hr_address_amphur'])?$rs['hr_address_amphur']:""; ?>" class="form-control" />
                    </div>

                    <div class="form-group col-md-4">
                        <label class="control-label">จังหวัด</label>
                        <input type="text" name="inHrAddressProvince" id="inHrAddressProvince" value="<?php echo isset($rs['hr_address_province'])?$rs['hr_address_province']:""; ?>" class="form-control" />
                    </div>
                    <div class="form-group col-md-4">
                        <label class="control-label">รหัสไปรษณีย์</label>
                        <input type="number" name="inHrAddressZipcode" id="inHrAddressZipcode" value="<?php echo isset($rs['hr_address_zipcode'])?$rs['hr_address_zipcode']:""; ?>" class="form-control" />
                    </div>
                    <div class="form-group col-md-4">
                        <label class="control-label">หมายเลขโทรศัพท์</label>
                        <input type="text" name="inHrAddressTelephone" id="inHrAddressTelephone" value="<?php echo isset($rs['hr_address_telephone'])?$rs['hr_address_telephone']:""; ?>" class="form-control" />
                    </div>

                    <div class="form-group col-md-4">
                        <label class="control-label">พิกัดละติจูด</label>
                        <input type="number" name="inHrAddressLat" id="inHrAddressLat" value="<?php echo isset($rs['hr_address_lat'])?$rs['hr_address_lat']:""; ?>" class="form-control" />
                    </div>
                    <div class="form-group col-md-4">
                        <label class="control-label">พิกัดลองจิจูด</label>
                        <input type="number" name="inHrAddressLong" id="inHrAddressLong" value="<?php echo isset($rs['hr_address_long'])?$rs['hr_address_long']:""; ?>" class="form-control" />
                    </div>
                </div>
                <div class="col-md-12">
                    <!-- ที่อยู่ที่ติดต่อ-->
                    <legend>ที่อยู่ที่ติดต่อได้สะดวก</legend>

                    <div class="form-group col-md-2">
                        <label class="control-label">ที่อยู่เลขที่</label>
                        <input type="text" name="inTmpAddressNo" id="inTmpAddressNo" value="<?php echo isset($rs['tmp_address_no'])?$rs['tmp_address_no']:""; ?>" class="form-control" />
                    </div>
                    <div class="form-group col-md-2">
                        <label class="control-label">หมู่ที่</label>
                        <input type="number" name="inTmpAddressMoo" id="inTmpAddressMoo" value="<?php echo isset($rs['tmp_address_moo'])?$rs['tmp_address_moo']:""; ?>" class="form-control" />
                    </div>
                    <div class="form-group col-md-4">
                        <label class="control-label">หมู่บ้าน</label>
                        <input type="text" name="inTmpAddressVillage" id="inTmpAddressVillage" value="<?php echo isset($rs['tmp_address_village'])?$rs['tmp_address_village']:""; ?>" class="form-control" />
                    </div>
                    <div class="form-group col-md-4">
                        <label class="control-label">ซอย</label>
                        <input type="text" name="inTmpAddressSoi" id="inTmpAddressSoi" value="<?php echo isset($rs['tmp_address_soi'])?$rs['tmp_address_soi']:""; ?>" class="form-control" />
                    </div>

                    <div class="form-group col-md-4">
                        <label class="control-label">ถนน</label>
                        <input type="text" name="inTmpAddressStreet" id="inTmpAddressStreet" value="<?php echo isset($rs['tmp_address_street'])?$rs['tmp_address_street']:""; ?>" class="form-control" />
                    </div>
                    <div class="form-group col-md-4">
                        <label class="control-label">ตำบล</label>
                        <input type="text" name="inTmpAddressTambon" id="inTmpAddressTambon" value="<?php echo isset($rs['tmp_address_tambon'])?$rs['tmp_address_tambon']:""; ?>" class="form-control" />
                    </div>
                    <div class="form-group col-md-4">
                        <label class="control-label">อำเภอ</label>
                        <input type="text" name="inTmpAddressAmphur" id="inTmpAddressAmphur" value="<?php echo isset($rs['tmp_address_amphur'])?$rs['tmp_address_amphur']:""; ?>" class="form-control" />
                    </div>

                    <div class="form-group col-md-4">
                        <label class="control-label">จังหวัด</label>
                        <input type="text" name="inTmpAddressProvince" id="inTmpAddressProvince" value="<?php echo isset($rs['tmp_address_province'])?$rs['tmp_address_province']:""; ?>" class="form-control" />
                    </div>
                    <div class="form-group col-md-4">
                        <label class="control-label">รหัสไปรษณีย์</label>
                        <input type="number" name="inTmpAddressZipcode" id="inTmpAddressZipcode" value="<?php echo isset($rs['tmp_address_zipcode'])?$rs['tmp_address_zipcode']:""; ?>" class="form-control" />
                    </div>
                    <div class="form-group col-md-4">
                        <label class="control-label">หมายเลขโทรศัพท์</label>
                        <input type="text" name="inTmpAddressTelephone" id="inTmpAddressTelephone" value="<?php echo isset($rs['tmp_address_telephone'])?$rs['tmp_address_telephone']:""; ?>" class="form-control" />
                    </div>

                    <div class="form-group col-md-4">
                        <label class="control-label">พิกัดละติจูด</label>
                        <input type="number" name="inTmpAddressLat" id="inTmpAddressLat" value="<?php echo isset($rs['tmp_address_lat'])?$rs['tmp_address_lat']:""; ?>" class="form-control" />
                    </div>
                    <div class="form-group col-md-4">
                        <label class="control-label">พิกัดลองจิจูด</label>
                        <input type="number" name="inTmpAddressLong" id="inTmpAddressLong" value="<?php echo isset($rs['tmp_address_long'])?$rs['tmp_address_long']:""; ?>" class="form-control" />
                    </div>
                </div>
            </div>
            <input type="hidden" name="hr_id" id="hr_id" value="<?php echo $this->uri->segment(2); ?>"/>
            <!--<input type="text" name="id" id="id" value="<?php echo $rs['id']; ?>" readonly/>-->



            <div class="row"><center><button type="submit" class="btn btn-success"><i class="icon-save icon-large"></i> บันทึก</button></center></div>
        </form>


    </div>


</div>


<!---------------------------------------------------------------------------->
<script>
    $('#insert-form').on('submit', function (e) {
        e.preventDefault();
        $.ajax({
            url: '<?php echo site_url('insert-human-resources-02'); ?>',
            method: 'post',
            data: $('#insert-form').serialize(),
            success: function (data) {
                alert('บันทึกเรียบร้อย');
                $('#insert-form')[0].reset();
                location.reload();
//                location.href = '<?php echo site_url('human-resources-part-02/' . $this->uri->segment(2)); ?>';
            }
        });
    });
    // edit data;


    // Delete data;
    $('.btn-delete').click(function () {
        var uid = $(this).attr('id');
        var status = confirm('ต้องการลบข้อมูลนี้จริงหรือไม่ ?');
        if (status) {
            $.ajax({
                url: '<?php echo site_url('delete-human-resources-02'); ?>',
                method: 'post',
                data: {id: uid},
                success: function (data) {
                    location.reload();
                }
            });
        }
    });

</script>
