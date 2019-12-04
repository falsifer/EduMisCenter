<?php
// if ($chk) {

$school = $this->My_model->get_where_row('tb_school', array('sc_thai_name' => $this->session->userdata("department")));
?>

    <!--<textarea class='editor'  name='inExam01' id="inExam01">-->
<!--    <div class="row" style="padding: 40px;">                            
    <div style="float: left">
                                    <label style="font-size: 20px">เลขที่<span>......./.......</span></label>
                                </div>  
    <div style="float: right">
                                    <label  style="font-size: 20px">ปถ.๐๑</label>
                                </div>
                               </div> 
    <div style="clear: both"></div>
    <div class="row"><center><img src="<?php echo base_url(); ?>images/krut.jpg" width="100"></center></div>
                            <div class="row"><center>
                                    <h1 style="font-size: 36px;">ใบรับรองผลการเรียน</h1>
    </center></div>
    <div style="width: 100%;">
    <div style="margin:auto;width:85%;font-size: 28px;">
        <div>
        <label><?php echo $this->session->userdata("department"); ?></label>
<?php echo nbs(3); ?>
        <label>สังกัด</label>
        <label id="inSchoolName"><?php echo $glv[0]['org_thai_name']; ?></label>
        <br>
        ตำบล<?php echo $school['sc_address_tambon']; ?>
<?php echo nbs(2); ?>
        อำเภอ<?php echo $school['sc_address_amphur']; ?>
<?php echo nbs(2); ?>
        จังหวัด<?php echo $school['sc_address_province']; ?></div>
      
        <div style="width:100%;margin-top: 40px;">ขอรับรองว่า<?php echo nbs(2) . $std['std_titlename'] . nbs(1) . $std['std_firstname'] . nbs(1) . $std['std_lastname']; ?></div>
    <div style="width:100%;margin-top: 10px;">เลขประจำตัว<?php echo nbs(2) . $std['std_code'] . nbs(4); ?>เลขที่ประจำตัวประชาชน<?php echo nbs(2) . $std['std_idcard']; ?></div>
    <div style="width:100%;margin-top: 10px;">เกิดวันที่<?php echo nbs(3) . $std['std_birth_day'] . nbs(3); ?>เดือน<?php echo nbs(3) . month_num($std['std_birth_month']) . nbs(3); ?>พ.ศ.<?php echo nbs(3) . $std['std_birth_year']; ?></div>


    <div style="width:100%;margin-top: 10px;">ชื่อ - ชื่อสกุลบิดา
<?php if (!empty($dad)) { ?>
    <?php echo nbs(3) . $dad['fm_titlename'] . nbs(1) . $dad['fm_firstname'] . nbs(1) . $dad['fm_lastname'] . nbs(4); ?>
<?php
} else {
    echo '.............................';
}
?>
        ชื่อ - ชื่อสกุลมารดา
<?php if (!empty($mom)) { ?>
    <?php echo nbs(3) . $mom['fm_titlename'] . nbs(1) . $mom['fm_firstname'] . nbs(1) . $mom['fm_lastname'] . nbs(4); ?>
<?php
} else {
    echo '.............................';
}
?>
        
    </div>
    <div style="width:100%;margin-top: 10px;">มีสถานภาพการเรียน ดังนี้...........................................................</div>
    <div style="width:100%;margin-top: 30px;">ออกให้ ณ วันที่  <?php echo date('d'); ?>    เดือน  <?php echo month_num(date('m')); ?>  พ.ศ.  <?php echo date('Y') + 543; ?></div>
    <div style="width:40%;margin-top: 50px;float: left;">
        <div style="border:solid 1px;height:160px;width: 120px;font-size: 16px; text-align: center;vertical-align: middle;">
            <br><br>ติดรูปถ่าย<BR>๓x๔ ซม.
        </div>
        <div style="width: 120px;font-size: 22px; text-align: center;margin-top: 30px;">
            .................................<br>
            (...............................)<br>
            นายทะเบียน
        </div>
    </div>
    <div style="width:60%;margin-top: 80px;float: right;text-align: center;font-size: 24px;">
        
            .................................<br>
            (...............................)<br>
            ผู้อำนวยการสถานศึกษา<br>
<?php echo $this->session->userdata("department"); ?>
        
    </div>
    <div style="clear: both"></div>
    <div style="width:100%;margin-top: 10px;text-align: center;font-size: 22px;">
        
            (ใบรับรองมีอายุกำหนด ๖๐ วัน)
        
    </div>
    </div>
        </div>
    </textarea>
    <script>alert('ออกใบรับรองผลการเรียน');</script>-->

<?php // } else {  ?>


    <!--<textarea class='editor'  name='inExam01' id="inExam01">-->
<div class="row" style="padding: 40px;">                            
    <!--    <div style="float: left">
                                        <label style="font-size: 20px">เลขที่<span>......./.......</span></label>
                                    </div>  -->
    <div style="float: right">
        <label  style="font-size: 20px">ปพ.7</label>
    </div>
</div> 
<div style="clear: both"></div>
<div class="row"><center><img src="<?php echo base_url(); ?>images/krut.jpg" width="100"></center></div>
<div class="row"><center>
        <h1 style="font-size: 36px;">ใบรับรองผลการศึกษา</h1>
    </center></div>
<div style="width: 100%;">
    <div style="margin:auto;width:85%;font-size: 26px;">
        <div>
            <label><?php echo $this->session->userdata("department"); ?></label>
            <?php echo nbs(3); ?>
            <label>สังกัด</label>
            <label id="inSchoolName"><?php echo $this->session->userdata("localgov"); ?></label>
            <br>
            ตำบล<?php echo $school['sc_address_tambon']; ?>
<?php echo nbs(2); ?>
            อำเภอ<?php echo $school['sc_address_amphur']; ?>
<?php echo nbs(2); ?>
            จังหวัด<?php echo $school['sc_address_province']; ?></div>
        <div style="width:100%;margin-top: 40px;">ขอรับรองว่า.................................</div>
        <div style="width:100%;margin-top: 10px;">เลขประจำตัว................เลขที่ประจำตัวประชาชน.................................</div>
        <div style="width:100%;margin-top: 10px;">เกิดวันที่............เดือน................พ.ศ...............................</div>
        <div style="width:100%;margin-top: 10px;">ชื่อ - ชื่อสกุลบิดา........................... ชื่อ - ชื่อสกุลมารดา...............................</div>
        <div style="width:100%;margin-top: 10px;">มีสถานภาพการเรียน ดังนี้...........................................................</div>
        <div style="width:100%;margin-top: 30px;">ออกให้ ณ วันที่  <?php echo date('d'); ?>    เดือน  <?php echo month_num(date('m')); ?>  พ.ศ.  <?php echo date('Y') + 543; ?></div>
        <div style="width:40%;margin-top: 50px;float: left;">
            <div style="border:solid 1px;height:160px;width: 120px;font-size: 16px; text-align: center;vertical-align: middle;">
                <br><br>ติดรูปถ่าย<BR>๓x๔ ซม.
            </div>
            <div style="width: 120px;font-size: 22px; text-align: center;margin-top: 30px;">
                .................................<br>
                (...............................)<br>
                นายทะเบียน
            </div>
        </div>
        <div style="width:60%;margin-top: 80px;float: right;text-align: center;font-size: 24px;">

            .................................<br>
            (...............................)<br>
            ผู้อำนวยการสถานศึกษา<br>
<?php echo $this->session->userdata("department"); ?>

        </div>
        <div style="clear: both"></div>
        <div style="width:100%;margin-top: 10px;text-align: center;font-size: 22px;">

            (ใบรับรองมีอายุกำหนด ๖๐ วัน)

        </div>
    </div>
</div>
<!--    </textarea>
    <script>alert('ไม่พบข้อมูล');</script>-->
<?php // }  ?>


<!--<script>
    tinymce.init({
        content_css: '../assets/css/report.css',
        selector: '.editor',
        theme: 'modern',
        height: 1123,
        width: 850,
        elements: "inExam01",
        plugins: "print",
        toolbar: "print"
    });
</script>-->