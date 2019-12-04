<div class="box">
    <div class="box-heading">งานครูประจำชั้น</div>
    <ul class="breadcrumb" style="margin-bottom: 0px;">
        <li><?php echo anchor(site_url(), "<i class='icon-home icon-large'></i> หน้าแรก"); ?></li>
        <li>งานครูประจำชั้น</li>
    </ul>
    <div class="box-body" >
        <style>
            .containerzz{
                margin-left: 10px;
                margin-top: 10px;
            }
            .mycardcontent {

                box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
                max-width: 100%;
                margin: auto;
                text-align: center;
                font-family: arial;
                /*margin-top: 30px;*/
                padding: 10px;
                /*padding-left: 20px;*/

            }
            .mycardcontent:hover {
                box-shadow: 0 8px 12px 0 rgba(0,0,0,0.2)
            }

            .head-title{
                margin-bottom: 10px;
            }

            [type="date"] {
                background:#fff url(https://cdn1.iconfinder.com/data/icons/cc_mono_icon_set/blacks/16x16/calendar_2.png)  97% 50% no-repeat ;
            }
            [type="date"]::-webkit-inner-spin-button {
                display: none;
            }
            [type="date"]::-webkit-calendar-picker-indicator {
                opacity: 0;
            }
            .My-btn{
                width:100%;
                height: 70px; 
                float: left;
                font-size:1.5em;
                margin-bottom: 5px;
            }
        </style>
        <script>
            var DateNow = "";
            var DateName = "";
            var ClassName = "";
        </script>

        <div class="row">
            <div class="row">
                <div class='col-md-8' >
                    <div class="row">
                        <div class="col-md-12">
                            <div id="chartStd1" style="height: 300px;  margin: 0px auto;"></div>
                        </div>
                        <div class="col-md-12">
                            <div id="chartStd2" style="height: 300px;  margin: 0px auto;"></div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div id="chartStd3" style="height: 300px;  margin: 0px auto;"></div>
                        </div>
                        <div class="col-md-6">
                            <div id="chartStd4" style="height: 300px; margin: 0px auto;"></div>
                        </div>
                    </div>
                </div>
                <div class='col-md-4'>
                    <div class='mycardcontent' style='height: 100%;width: 100%;margin-bottom: 20px;'>
                        <div style='background-color:darkcyan;height: 110px;width: 100%;font-size: 1.7em;text-align: center;vertical-align: middle;color:white;padding-top: 10px;'>
                            <p>หน้าที่รับผิดชอบ</p>
                            <select name="inEdRoomId" id="inEdRoomId" class="form-control" >
                                <?php foreach ($HomeroomList as $r) { ?>
                                    <option value="<?php echo $r->ed_roomid; ?>"><?php echo $r->ed_classname; ?> ห้อง <?php echo $r->ed_roomnumber; ?> | ปีการศึกษา <?php echo $r->EdYear; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <br/>
                        <button type='button' class='btn btn-primary My-btn' onclick='StudentBase()'>
                            <i class="icon-user icon-large"></i> สำมะโนนักเรียน
                        </button>
                        <script>
                            function StudentBase() {
                            location.href = '<?php echo site_url('hr-homeroom-std'); ?>?room_id=' + $('#inEdRoomId').val();
                            }
                        </script>
                        <br/>
                        <button type='button' class='btn btn-info My-btn'  onclick='AbsentRecordModal(this)'>
                            <i class="icon-book icon-large"></i> บัญชีเรียกชื่อนักเรียน
                        </button>
                        <script>
                            var RoomId = "";
                            function AbsentRecordModal(e) {
                            RoomId = $('#inEdRoomId').val();
                            $.ajax({
                            url: "<?php echo site_url('Homeroom/absent_record_tbody'); ?>",
                                    method: "post",
                                    data: {roomid: RoomId, datenow: $('#hiddendate').val()},
                                    success: function (data) {
//                                        $('.modal-title').html(DateName + ClassName);
//                                        $('#AbsentRecordTBody').html(data);
                                    $('#MySchoolAreaId').val("AbsentRecordBody");
                                    $('#hr-homeroom-absent-record-modal').modal('show');
                                    }
                            });
                            }
                        </script>
                        <br/>

<!--                    <button type="button" class="btn btn-warning " style="width:70%; height: 70px; float: left;font-size:1.5em;" id='<?php echo $this->session->userdata('hr_id') ?>' disabled>
                        <s><i class="icon-list icon-large" ></i> บันทึกการโฮมรูม</s> 
                    </button>
                    
                    <br/>

                    <button type="button" class="btn btn-primary " style="width:70%; height: 70px; float: left;font-size:1.5em;" id='<?php echo $this->session->userdata('hr_id') ?>' disabled>
                        <s><i class="glyphicon glyphicon-piggy-bank" ></i> จัดการเงินออมเด็ก</s> 
                    </button>
                    <br/>-->
<!--                        <button type="button" class="btn btn-success My-btn" onclick='VisitHomeCalendar(this)'  id='<?php echo $this->session->userdata('hr_id') ?>' >
                            <i class="glyphicon glyphicon-file"></i> ตารางการเยี่ยมบ้าน
                        </button>-->
                        <script>

                            function VisitHomeCalendar(e) {
                            location.href = '<?php echo site_url('hr-homeroom-vh-calendar'); ?>?room_id=' + $('#inEdRoomId').val();
                            }

                        </script>
                        <br/>
                        <button type="button" class="btn btn-success My-btn" onclick='VisitHome(this)'  id='<?php echo $this->session->userdata('hr_id') ?>'>
                            <i class="icon-home icon-large" ></i> เยี่ยมบ้านนักเรียน
                        </button>
                        <script>
                            function VisitHome(e) {
                            location.href = '<?php echo site_url('visit-home'); ?>?room_id=' + $('#inEdRoomId').val();
                            }
                        </script>
                        <br/>
                        <button type="button" class="btn btn-info My-btn" onclick='StudentWeightAndHeight(this)'  id='<?php echo $this->session->userdata('hr_id') ?>' >
                            <i class="glyphicon glyphicon-scale"></i> บันทึกน้ำหนักส่วนสูง
                        </button>
                        <script>
                            function StudentWeightAndHeight(e) {
                            location.href = '<?php echo site_url('hr-homeroom-wnh'); ?>?room_id=' + $('#inEdRoomId').val();
                            }
                        </script>
                        <br/>
                        <button type="button" class="btn btn-warning My-btn" onclick='SDQ(this)'  id='<?php echo $this->session->userdata('hr_id') ?>' >
                            <i class="glyphicon glyphicon-file"></i> ประเมิน SDQ
                        </button>
                        <script>

                            function SDQ(e) {
                            location.href = '<?php echo site_url('hr-homeroom-sdq'); ?>?room_id=' + $('#inEdRoomId').val();
                            }

                        </script>
                        <br/>

                    </div>
                </div>

            </div>
        </div>
    </div>
    <?php $this->load->view('layout/my_school_footer'); ?>
</div>
<?php $this->load->view('homeroom/hr_homeroom_absent_record_modal') ?>
<script>

    window.onload = function () {
    // student stat
    var optionsStdAb1 = {
    exportEnabled: true,
            animationEnabled: true,
            title: {
            text: "การมาเรียน <?php echo datethai(date('Y-m-d')); ?>",
                    fontSize: 14,
                    fontFamily: 'Sarabun'
            },
            data: [
            {
            type: "pie", //change it to line, area, bar, pie,column etc
                    indexLabel: "{name} - {y} คน",
                    dataPoints: [
//                        {y: 10, name: "มา"},
//                        {y: 2, name: "ลาป่วย"},
//                        {y: 1, name: "ลากิจ"},
//                        {y: 2, name: "ขาด"},
//                        {y: 2, name: "สาย"},

<?php
if (isset($absentStdStat)) {
    foreach ($absentStdStat as $r):
        ?>
        <?php
        $tmp = "";
        switch ($r['tb_student_absent_record_status']) {
            case 'A':
                $tmp = 'ขาด';
                break;
            case 'S':
                $tmp = 'ป่วย';
                break;
            case 'E':
                $tmp = 'ลา';
                break;
            case 'C':
                $tmp = 'มา';
                break;
        }
        ?>
                            {y: <?php echo $r['pnt']; ?>, name:"<?php echo $tmp; ?>"},
        <?php
    endforeach;
}
?>
                    ]
            }
            ]
    };
    $("#chartStd1").CanvasJSChart(optionsStdAb1);
    var optionsStdAb2 = {
    exportEnabled: true,
            animationEnabled: true,
            title: {
            text: "สถิติการเยี่ยมบ้าน",
                    fontSize: 16,
                    fontFamily: 'Sarabun'
            },
            data: [
            {
            type: "pie", //change it to line, area, bar, pie,column etc
                    indexLabel: "{name} - {y} คน",
                    dataPoints: [
<?php
$rs0 = $this->My_model->get_where_order('tb_visit_home_calendar', array('tb_visit_home_department'=>$this->session->userdata('department'),'tb_visit_home_calendar_status' => 0),'');
$rs1 = $this->My_model->get_where_order('tb_visit_home_calendar', array('tb_visit_home_department'=>$this->session->userdata('department'),'tb_visit_home_calendar_status' => 1),'');
?>

                    {y: <?php echo isset($rs1[0]['id'])? count($rs1): 0;?>, name: "เยี่ยมแล้ว"},
                    {y: <?php echo isset($rs0[0]['id'])? count($rs0): 0;?>, name: "ยังไม่ได้เยี่ยม"},
                    ]
            }
            ]
    };
    $("#chartStd2").CanvasJSChart(optionsStdAb2);
    var optionsStdAb3 = {
    exportEnabled: true,
            animationEnabled: true,
            title: {
            text: "วิเคราะห์น้ำหนักส่วนสูงเด็ก",
                    fontSize: 16,
                    fontFamily: 'Sarabun'
            },
            data: [
            {
            type: "pie", //change it to line, area, bar, pie,column etc
                    indexLabel: "{name} - {y} คน",
                    dataPoints: [
                    {y: 1, name: "ผอมมาก"},
                    {y: 4, name: "ผอม"},
                    {y: 10, name: "สมส่วน"},
                    {y: 4, name: "ท้วม"},
                    {y: 3, name: "อ้วน"},
                    ]
            }
            ]
    };
    //$("#chartStd3").CanvasJSChart(optionsStdAb3);
    var optionsStdAb4 = {
    exportEnabled: true,
            animationEnabled: true,
            title: {
            text: "ผลการประเมิน SDQ",
                    fontSize: 16,
                    fontFamily: 'Sarabun'
            },
            data: [
            {
            type: "pie", //change it to line, area, bar, pie,column etc
                    indexLabel: "{name} - {y} คน",
                    dataPoints: [
                    {y: 10, name: "ปกติ"},
                    {y: 2, name: "มีปัญหา"},
                    {y: 1, name: "เสี่ยง"},
                    ]
            }
            ]
    };
    //$("#chartStd4").CanvasJSChart(optionsStdAb4);
    }


     
    $('#hr-homeroom-absent-record-modal').on('hide.bs.modal', function () {
        location.reload();
    });

</script>
