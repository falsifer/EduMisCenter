<div class="box">
    <div class="box-heading">การวางแผนงานวิชาการ</div>
    <ul class="breadcrumb">
        <li><?php echo anchor(site_url(), "<i class='icon-home icon-large'></i> หน้าแรก"); ?></li>
        <li><?php echo anchor(site_url('ed-evaluation'), "<i class='icon-list icon-large'></i> งานวัดผลและประเมินผล"); ?></li>
        <li>ใบรับรองผลการเรียน(ปถ.๐๑)</li>
    </ul>
    <div class="box-body">
        <div class="databox">
            <form method="post" id="exam-insert-form">
                <div class="row">
                    <div class="col-md-12">

                        <div class="col-md-5">

                            <input class="magic-radio form-control" type="radio" name="inStdType"  value="std_code" id="r1" checked><label class="control-label" for="r1">เลขที่นักเรียน</label>&nbsp;
                            <input class="magic-radio form-control" type="radio" name="inStdType"  value="std_idcard" id="r2" ><label class="control-label" for="r2">เลขที่บัตรประชาชน</label>
                            &nbsp;
                            <input class="magic-radio form-control" type="radio" name="inStdType"  value="std_name" id="r3" ><label class="control-label" for="r3">ชื่อ-นามสกุล</label>
                        </div>
                        <div class="col-md-5">
                            <input type="text" name="inStdName" id="inStdName" class="form-control"value="" required />
                        </div>
                        <div class="col-md-2">
                            <button type="button" class="btn btn-info btn-search"><i class="icon-search icon-large"></i> ค้นหา</button>
                        </div>

                    </div>
                </div>
                <div class="row" style="margin-top:40px;">
                    <center>
                        <div class="col-md-12" id='inData'>

                            <textarea class='editor'  name='inExam01' id="inExam01">
<div class="row" style="padding: 40px;">                            
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
<div style="margin:auto;width:85%;font-size: 26px;">
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
    <div style="width:100%;margin-top: 40px;">ขอรับรองว่า.................................</div>
<div style="width:100%;margin-top: 10px;">เลขประจำตัว................เลขที่ประจำตัวประชาชน.................................</div>
<div style="width:100%;margin-top: 10px;">เกิดวันที่............เดือน................พ.ศ...............................</div>
<div style="width:100%;margin-top: 10px;">ชื่อ - ชื่อสกุลบิดา........................... ชื่อ - ชื่อสกุลมารดา...............................</div>
<div style="width:100%;margin-top: 10px;">มีสถานภาพการเรียน ดังนี้...........................................................</div>
<div style="width:100%;margin-top: 30px;">ออกให้ ณ วันที่  <?php echo date('d'); ?>    เดือน  <?php echo month_num(date('m')); ?>  พ.ศ.  <?php echo date('Y') + 543; ?></div>
<div style="width:40%;margin-top: 45px;float: left;">
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
                        </div>
                    </center>

                </div>
        </div>


        <div class="row" style="margin:20px;">
            <center><?php echo anchor(site_url('ed-evaluation'), "<div class='btn btn-warning'><i class='icon-power-off icon-large'></i> ยกเลิก</div>"); ?>
            </center>
        </div>

        </form>
    </div>

</div>
<?php $this->load->view('layout/my_school_footer'); ?>
</div>

<script>



    $("#exam-insert-form").on("click", ".btn-search", function () {

        $.ajax({
            url: "<?php echo site_url('school/Exam/report_exam_01_view'); ?>",
            method: "post",
            data: $("#exam-insert-form").serialize(),

            success: function (data) {
                $("#inData").html(data);
                //tinyMCE.get('inExam01').setContent(data);
            },
 
        });
    });
    $("#exam-insert-form").on("click", ".btn-print", function () {
        alert('พิมพ์ใบรับรองผลการเรียน');
        $.ajax({
            url: "<?php echo site_url('school/Exam/report_exam_01_print'); ?>",
            method: "post",
            data: $("#exam-insert-form").serialize(),

            success: function (data) {

            }
        });
    });

</script>

<script>
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
</script>