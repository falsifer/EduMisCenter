<div class="box">
    <div class="box-heading">ตารางนัดเยี่ยมบ้าน</div>
    <ul class="breadcrumb">
        <li><?php echo anchor(site_url(), "<i class='icon-home icon-large'></i> หน้าแรก"); ?></li>
        <li><?php echo anchor(site_url('hr-homeroom'), "งานครูประจำชั้น"); ?></li>
        <li>ตารางนัดเยี่ยมบ้าน</li>
    </ul>
    <div class="box-body">
        <div class="row">
            <div class="col-md-12">
                <div class='col-md-12' style='margin-bottom:25px;'> 
                    <button class='btn btn-primary btn-lg col-xs-6' style='border:1px black solid;' onclick='GoVhCalendar()'>ตารางการเยี่ยมบ้านนักเรียน</button>
                    <button class='btn btn-link btn-lg col-xs-6' style='border:1px black solid;' onclick='GoVhView()'>บันทึกการเยี่ยมบ้านนักเรียน</button>
                    <!--<button class='btn btn-primary btn-lg col-xs-4' ><b>สถิติเกี่ยวกับการเยี่ยมบ้าน</b></button>-->
                </div>
                <script>
                    function GoVhCalendar() {
                    location.href = '<?php echo site_url('hr-homeroom-vh-calendar') . '?room_id=' . $this->input->get('room_id'); ?>';
                    }
                    function GoVhView() {
                    location.href = '<?php echo site_url('visit-home') . '?room_id=' . $this->input->get('room_id'); ?>';
                    }
                </script>
                <table class='table table-bordered table-hover' id='MyTable'>
                    <thead>
                        <tr style='background: #eeeeee;'>
                            <!--<th style='width: 5%;text-align: center;'>ที่</th>-->  
                            <th style='width: 20%;text-align: center;'>วันที่เยี่ยม</th>
                            <th style='width: 15%;text-align: center;'>ชื่อ-นามสกุล</th>                            
                            <th style='width: 30%;text-align: center;'>สถานที่</th>                            
                            <th style='width: 10%;text-align: center;'>สถานะ</th>                        
                            <th style='width: 10%;text-align: center;'></th>
                        </tr>
                    </thead> 
                    <tbody id='MyTBody'>
                        <?php echo $Tbody; ?>
                    </tbody> 
                </table> 
            </div>
        </div>
    </div>
    <?php $this->load->view('layout/my_school_footer'); ?>
</div>
<?php $this->load->view("homeroom/hr_homeroom_vh_calendar_modal"); ?>
<?php // $this->load->view("homeroom/hr_homeroom_visit_home_insert_modal"); ?>
<?php $this->load->view("homeroom/hr_homeroom_visit_home_detail_modal"); ?>
<script>
 
    window.onload = function () {
    ReloadTable();
    };
    function ReloadTable() {

<?php
$tabName = "MyTable";
$title = $this->Echo_Text_Model->head_logo('ตารางนัดเยี่ยมบ้าน', $this->session->userdata('sch_id'));
$colStr = "0,1,2,3,4,5";
$btExArr = array();
$bt = array(
//    'name' => 'add_topic',
//    'title' => 'เพิ่มข้อมูล',
//    'icon' => 'icon-plus',
//    'class' => 'btn btn-primary',
//    'fn' => 'InsertThis()'
);
array_push($btExArr, $bt);
load_datatable($tabName, $btExArr, $title, $colStr);
?>

    }
</script>

<script>

    function InsertThis(e) {
    $("#vh-calendar-insert-form")[0].reset();
    $("#inStdId").val(e.id);
    $("#hr-homeroom-vh-calendar-modal").modal("show");
    }


    function EditThis(e) {
//        alert(e.id)
    $.ajax({
    url: '<?php echo site_url('Homeroom/hr_homeroom_vh_calendar_edit'); ?>',
            method: 'post',
            data: {id: e.id},
            dataType: 'JSON',
            success: function (data) {
//                $("#vh-calendar-insert-form")[0].reset();
//                alert(data.id);
            $('#inVitsitHomeCalendarDate').val(data.tb_visit_home_calendar_date);
            $('#inVitsitHomeCalendarLocation').val(data.tb_visit_home_calendar_location);
            $('#inStdId').val(data.tb_student_base_id);
            $('#id').val(data.id);
            $("#hr-homeroom-vh-calendar-modal").modal("show");
            }
    });
    }

    function InsertVhThis(e) {
//        alert(e);

    $.ajax({
    url: '<?php echo site_url('Homeroom/hr_homeroom_vh_get_std_by_id'); ?>',
            method: 'post',
            data: {id: e.id},
            success: function (data) {
            var obj = JSON.parse(data);
            $('#VhClId').val(e.name);
            $('#inVhStdTitleName').val(obj.inVhStdTitleName);
            $('#inVhStdFirstName').val(obj.inVhStdFirstName);
            $('#inVhStdLastName').val(obj.inVhStdLastName);
            $('#inVhStdClassName').val(obj.inVhStdClassName);
            $('#inVhStdIdCard').val(obj.inVhStdIdCard);
            $('#inVhStdNickName').val(obj.inVhStdNickName);
            $('#inVhStdCode').val(obj.inVhStdCode);
            $('#inVhPrTitleName').val(obj.inVhPrTitleName);
            $('#inVhPrFirstName').val(obj.inVhPrFirstName);
            $('#inVhPrLastName').val(obj.inVhPrLastName);
            $('#inVhPrRelation').val(obj.inVhPrRelation);
            $('#inVhPrCareer').val(obj.inVhPrCareer);
            $('#inVhPrCareerSalary').val(obj.inVhPrCareerSalary);
            $('#inVhPrIdcard').val(obj.inVhPrIdcard);
            document.getElementById("inVhStdPicture").src = obj.inVhStdPicture;
            $("#visit-home-modal").modal("show");
            }
    });
    }


//    function ShowVhThis(e) {
//        $.ajax({
//            url: '<?php echo site_url('Homeroom/hr_homeroom_vh_show_detail'); ?>',
//            method: 'post',
//            data: {id: e.id},
//            success: function (data) {
//                $('#MyDetailBody').html(data);
//                $("#hr-homeroom-visit-home-detail-modal").modal("show");
//            }
//        });
//    }

    function DeleteThis(e) {
    var status = confirm('ต้องการลบข้อมูลนี้จริงหรือไม่ ?');
    if (status) {
    $.ajax({
    url: '<?php echo site_url('Homeroom/hr_homeroom_vh_calendar_delete'); ?>',
            method: 'post',
            data: {id: e.id},
            success: function (data) {
            location.reload();
            }
    });
    }
    }

</script>
