<div class="box">
    <div class="box-heading">บันทึกเวลามาเรียน</div>
    <ul class="breadcrumb">
        <li><?php echo anchor(site_url(), "<i class='icon-home icon-large'></i> หน้าแรก"); ?></li>
        <li>บันทึกเวลามาเรียน</li>
    </ul>
    <div class="box-body">
        <style>
            /*            .btn:hover{
                            background-color: rgba(0,0,0,0.8);
                            opacity: .4;
                        }*/
            .containerzz{
                margin-left: 10px;
                margin-top: 10px;
            }

        </style>
        <div class="row">
            <div class="col-md-12">
                <div class="row">
                    <!--                    <div class="col-md-1" >
                                            <button type="button" style="height: 500px;"class="btn btn-secondary btn-edit" id=""><i class="icon-arrow-left icon-large"></i></button>
                                        </div>-->
                    <div class="col-md-8 col-md-offset-1">
                        <div class="row" style="margin-bottom: 10px">
                            <center>
                                <button type="button" class="btn btn-secondary" onclick="ArrowLeft(this)"><i class="icon-arrow-left icon-large"></i></button>
                                <label class="control-label">วันที่ 18 เดือน กุมภาพันธ์ พ.ศ. 2540</label> 
                                <button type="button" class="btn btn-secondary" onclick="ArrowRight(this)"><i class="icon-arrow-right icon-large"></i></button>
                            </center>
                        </div> 
                        <div class="row">
                            <table class="table table-hover table-striped table-bordered display" id="example">
                                <thead>
                                    <tr>
                                        <th style="text-align:center; width:5%;" rowspan="2">ที่</th>
                                        <th class="sorting"  style="text-align:center; width:50%;" rowspan="2">ชื่อ-นามสกุล</th>
                                        <th class="sorting"  style="text-align:center; width:5%; color: green;" colspan="2" >มา</th>
                                        <th class="sorting"  style="text-align:center; width:5%; color: orange;" colspan="2">ลา</th>
                                        <th class="sorting"  style="text-align:center; width:5%; color: red;" rowspan="2">ขาด</th>
                                        <th class="sorting"  style="text-align:center; width:20%;" rowspan="2">หมายเหตุ</th>
                                    </tr>
                                    <tr>
                                        <th class="sorting"  style="text-align:center; width:5%; color: green;">มา</th>
                                        <th class="sorting"  style="text-align:center; width:5%; color: green;">สาย</th>
                                        <th class="sorting"  style="text-align:center; width:5%; color: orange;">ลาป่วย</th>
                                        <th class="sorting"  style="text-align:center; width:5%; color: orange;">ลากิจ</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td style="text-align:center; ">1</td>
                                        <td style="text-align:center; ">นายชัยรัธฐา อ่วมอารีย์</td>
                                        <td style="text-align:center; ">
                                            <!--<label class="containerzz" >-->
                                                <input type="checkbox" checked="checked"/>
<!--                                                <span class="checkmark"></span>
                                            </label>-->
                                        </td>
                                        <td style="text-align:center; ">
                                            <label class="containerzz">
                                                <input type="checkbox" name="e" value="E" id="" onchange=""/>
                                                <span class="checkmark"></span>
                                            </label>
                                        </td>
                                        <td style="text-align:center; ">
                                            <label class="containerzz">
                                                <input type="checkbox" name="e" value="E" id="" onchange=""/>
                                                <span class="checkmark"></span>
                                            </label>
                                        </td>
                                        <td style="text-align:center; ">
                                            <label class="containerzz">
                                                <input type="checkbox" name="e" value="E" id="" onchange=""/>
                                                <span class="checkmark"></span>
                                            </label>
                                        </td>
                                        <td style="text-align:center; ">
                                            <label class="containerzz">
                                                <input type="checkbox" name="e" value="E" id="" onchange=""/>
                                                <span class="checkmark"></span>
                                            </label>
                                        </td>
                                        <td style="text-align:center; ">
                                            <input type="text" placeholder="หมายเหตุ..." name="e" value="" id=""/>
                                        </td>
                                    </tr>                                
                                </tbody>
                            </table>
                        </div> 
                    </div>
                    <!--                    <div class="col-md-1">
                                            <button type="button" style="height: 500px;"class="btn btn-secondary btn-edit" id=""><i class="icon-arrow-right icon-large"></i></button>
                                        </div>-->
                    <div class="col-md-3">
                        <div id="datepicker" data-date="" onclick="DayOnClick(this)"></div>
                        <input type="hidden" id="my_hidden_input">
                    </div>

                </div>    
            </div>
        </div>
        <?php
//        $data['class'] = 'Y';
//        $data['room'] = 'Y';
//        $this->load->view('layout/my_school_filter', $data);
//        
        ?>


        <!--        <div id="calendar">
                </div>    -->
    </div>
    <?php $this->load->view('layout/my_school_footer'); ?>
</div>

<?php $this->load->view("homeroom/std_absent_record_modal"); ?>

<script>
    var RoomId = 0;
    
    function ArrowLeft(e) {
        var date = $('#datepicker').datepicker('getDate');
        date.setDate(date.getDate() - 1);
        $('#datepicker').datepicker("setDate", date);
    }

    function ArrowRight(e) {
        var date = $('#datepicker').datepicker('getDate');
        date.setDate(date.getDate() + 1);
        $('#datepicker').datepicker("setDate", date);
    }

    function DayOnClick(e) {
        var daynow = $('#datepicker').datepicker('getFormattedDate');
        $.ajax({
            url: "<?php echo site_url('Homeroom/std_absent_record_insert'); ?>",
            method: "post",
            data: {daynow: daynow, cid: cid, rid: rid},
            success: function (data) {
            }
        });
    }

    $('#datepicker').datepicker({
        format: 'yyyy/mm/dd',
        language: 'th-th'
    });

    $('#datepicker').on('changeDate', function () {
        $('#my_hidden_input').val(
                $('#datepicker').datepicker('getFormattedDate')
                );
    });


    var cid = 0;
    var rid = 0;
    $('#calendar').fullCalendar({
        header: {
            left: 'prev,next today',
            center: 'title',
            right: 'month,agendaWeek,agendaDay,listYear'
        },
        height: 500,
        locale: "th",
        selectable: true,

        dayClick: function (date) {

            cid = $("#MyClass").val();
            rid = $("#MyRoom").val();

//            alert(cid + "abc" + rid);
            var daynow = date.format();
            //--- Insert ครั้งแรก
            $.ajax({
                url: "<?php echo site_url('Homeroom/std_absent_record_insert'); ?>",
                method: "post",
                data: {daynow: daynow, cid: cid, rid: rid},
                success: function (data) {
                    $.ajax({
                        url: "<?php echo site_url('Homeroom/std_absent_record_edit'); ?>",
                        method: "post",
                        data: {daynow: daynow, cid: cid, rid: rid},
                        success: function (data) {
                            $('#RecordBody').html(data);
//                            $('#stdclass').val(stdclass);
//                            $('#stdlevel').val(stdlevel);
                            $('#daynow').val(daynow);
                            $('#std-absent-record-modal').modal('show');
                        }
                    });
                }
            });

        }
    }
    );
</script>
