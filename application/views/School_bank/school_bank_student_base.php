<div class="box">
    <div class="box-heading">บันทึกเงินออมทรัพย์นักเรียนรายบุคคล</div>
    <ul class="breadcrumb">
        <li><?php echo anchor(site_url(), "<i class='icon-home icon-large'></i> หน้าแรก"); ?></li>
        <li>บันทึกเงินออมทรัพย์นักเรียนรายบุคคล</li>
    </ul>
    <div class="box-body">
        <div class="row">
            <div class="col-md-12">
                <?php
                $data['class'] = 'Y';
                $data['room'] = 'Y';
                $this->load->view('layout/my_school_filter', $data);
                ?>   
                <div id='StudentBody'>
                    <table class='table table-bordered table-hover' id='StudentTable'>
                        <thead>
                            <tr style='background: #eeeeee;'>
                                <th style='width: 5%;text-align: center;'>ที่</th>
                                <th style='width: 10%;text-align: center;'>รหัสนักเรียน</th>
                                <th style='width: 20%;text-align: center;'>ชื่อ-นามสกุล</th>
                                <th style='width: 15%;text-align: center;'>ระดับชั้น</th>
                                <th style='width: 10%;text-align: center;'>ฝาก</th>
                                <th style='width: 10%;text-align: center;'>ถอน</th>
                                <th style='width: 10%;text-align: center;'>รวม</th>
                                <th style='width: 20%;text-align: center;'></th>
                            </tr>
                        </thead> 
                        <tbody id='StudentTBody'>



                        </tbody> 
                    </table>   
                </div>
            </div>
        </div>
    </div>
    <?php $this->load->view('layout/my_school_footer'); ?>
</div>
<?php $this->load->view("school_bank/school_bank_student_insert_modal"); ?>
<script>
    $(".datepicker").datepicker({autoclose: true, language: 'th-th'});
    window.onload = function () {
        ReloadTable();
    };

    function ReloadTable() {

<?php
$tabName = "StudentTable";
$title = $this->Echo_Text_Model->head_logo('เงินออมทรัพย์นักเรียน', $this->session->userdata('sch_id'));
$colStr = "0,1,2,3,4,5,6,7";
$btExArr = array();
//$bt = array(
//    'name' => 'add_topic',
//    'title' => 'เพิ่มข้อมูล',
//    'icon' => 'icon-plus',
//    'class' => 'btn btn-primary',
//    'fn' => 'InsertThis()'
//);
//array_push($btExArr, $bt);
load_datatable($tabName, $btExArr, $title, $colStr);
?>

    }


    var RmId = "";

    function MyRoomOnChange(e) {
        RmId = e.value;
        MyStdFilter();
    }

    function MyStdFilter() {
        $.ajax({
            url: '<?php echo site_url('School_bank/school_bank_student_list_by_filter'); ?>',
            method: 'post',
            data: {room_id: RmId},
            beforeSend: function () {
                MyStartLoading();
            },
            success: function (data) {
                MyEndLoading();
                if (data) {
                    $("#StudentBody").html(data);
                    ReloadTable();
                }

            }
        });
    }

</script>

<script>

    function ShowThisModal(e) {
//        alert(e.id);
//        alert(e);
        $('#MySchoolAreaId').val("MySchoolBankPrintArea");
        $.ajax({
            url: "<?php echo site_url('School_bank/get_school_bank_student_by_stdid'); ?>",
            method: "POST",
            data: {id: e},
            success: function (data) {
                $("#MySchoolBankBody").html(data);
                $("#school-bank-student-insert-modal").modal("show");
            }
        });



    }

</script>
