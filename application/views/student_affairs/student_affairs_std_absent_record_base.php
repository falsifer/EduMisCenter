<style>
    .TdSelect{
        width: 10%;
        text-align: center;
        cursor: pointer;
    }
    .TdSelect:hover {
        background-color: wheat;
    }

</style>﻿
<div class="box">
    <div class="box-heading">สถิติการมาเรียนของนักเรียน (<?php echo datethaifull(date('Y-m-d')) ?>)</div>
    <ul class="breadcrumb">
        <li><?php echo anchor(site_url(), "<i class='icon-home icon-large'></i> หน้าแรก"); ?></li>
        <li>สถิติการมาเรียนของนักเรียน</li>
    </ul>

    <div class="box-body">
        <div class="row">
            <div class="col-md-12" >

                <div class='col-md-8' style='margin-top:20px;'>
                    <legend id='LegendHead'> สถิติการมาเรียนประจำวันที่ (<?php echo datethaifull(date('Y-m-d')) ?>)</legend>
                </div>
                <div class='col-md-4' style='margin-top:20px;'>
                    <input autocomplete="off" type="text" name="inDatePickerStdAbsentRecord" id="inDatePickerStdAbsentRecord"  onchange="GoThisDate(this)" class="form-control datepicker"  value='<?php echo date('Y')+543 .date('-m-d') ?>' placeholder="คลิกวันที่..."  data-date-language="th-th" data-date-format="yyyy-mm-dd" required />
                </div>

                <div class='col-md-12' style='margin-top:20px;'>
                    <table  class="table table-hover table-striped table-bordered display" id="StdAbsentRecSchoolTable">
                        <?php echo $ToDay; ?>                        
                    </table> 
                </div>

            </div>
        </div>
    </div>
    <?php $this->load->view('layout/my_school_footer'); ?>


</div>
<?php $this->load->view('student_affairs/student_affairs_std_absent_record_status_modal'); ?>
<script>
    $(".datepicker").datepicker({autoclose: true, language: 'th-th'});
    function GoThisDate(e) {
        var date = $('#inDatePickerStdAbsentRecord').val();
        $.ajax({
            url: '<?php echo site_url('Student_affairs/get_std_absent_record_by_date'); ?>',
            method: 'post',
            data: {date: date},
            beforeSend: function () {
                MyStartLoading();
            },
            success: function (data) {
                MyEndLoading();
                $.ajax({
                    url: '<?php echo site_url('Student_affairs/get_headthai_by_date'); ?>',
                    method: 'post',
                    data: {date: date},
                    success: function (data) {
                        if (data) {
                            $("#LegendHead").html(data);
                        }
                    }
                });
                if (data) {
                    $("#StdAbsentRecSchoolTable").html(data);
                }
            }
        });



    }


    function SelectThisStatus(e) {
        var date = $('#inDatePickerStdAbsentRecord').val();
        var StrArray = e.split(',');
//        alert("A");
        if (StrArray[2] == 0) {
            alert("ไม่มีสถิติ");
        } else {
//            alert("B");
            $.ajax({
                url: '<?php echo site_url('Student_affairs/get_std_absent_record_status_modal_by_room_id_status'); ?>',
                method: 'post',
                data: {room_id: StrArray[0], status: StrArray[1], date: date},
                beforeSend: function () {
                    MyStartLoading();
                },
                success: function (data) {
                    MyEndLoading();
//                    alert("C");
                    if (data) {
                        $("#StdAbsentRecStatusTBody").html(data);
                        $("#student-affairs-std-absent-record-status-modal").modal('show');
                    }
                }
            });
        }
    }

    function SelectThisRoom(id) {
        alert(id);
    }
</script>