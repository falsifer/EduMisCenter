<div class="box">
    <div class="box-heading">งานครูปฐมวัย</div>
    <ul class="breadcrumb" style="margin-bottom: 0px;">
        <li><?php echo anchor(site_url(), "<i class='icon-home icon-large'></i> หน้าแรก"); ?></li>
        <li>งานครูปฐมวัย</li>
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
        </style>


        <div class="container">
            <div class="row">
<!--                <div class='col-md-8'>

                </div>-->
                <div class='col-md-4'>
                    <div class='mycardcontent' style='height: 70%;width: 100%;margin-bottom: 20px;'>
                        <div style='background-color:darkcyan;height: 110px;width: 100%;font-size: 1.7em;text-align: center;vertical-align: middle;color:white;padding-top: 10px;'>
                            <p>ระดับชั้นที่รับผิดชอบ</p>
                            <select name="inEdRoomId" id="inEdRoomId" class="form-control" >
                                <?php foreach ($HomeroomList as $r) { ?>
                                    <option value="<?php echo $r->ed_roomid; ?>"><?php echo $r->ed_classname; ?> ห้อง <?php echo $r->ed_roomnumber; ?> | ปีการศึกษา <?php echo $r->EdYear; ?></option>
                                <?php } ?>
                            </select>
                        </div>

                        <center>
                            <div style='width: 100%;'>
                                <div style='width: 100%;margin-top:5px;'>
                                    <center>
                                        <input type="hidden" id='hiddendate' value='<?php echo date('Y') + 543 . date('-m-d'); ?>'>
                                        <button type="button" data-toggle="collapse" data-target="#MySchoolDatePicker" class="btn btn-primary" style='width:100%;'><font id='MySchoolDateHead' style='font-size:1.2em;' style='width: 80%;float: left;'><?php echo datethaifull(date('Y-m-d')); ?></font> <i class="icon-calendar icon-large" style='width: 20%;'></i> </button>                                     
                                    </center>
                                </div> 
                                <div style='padding: 20px;background-color:wheat;' class='collapse' id='MySchoolDatePicker'>
                                    <div id="datepicker"></div>
                                    <script>
                                        var DateNow = "";
                                        var DateName = "";
                                        var ClassName = "";
                                        $('#datepicker').datepicker({
                                            format: 'yyyy-mm-dd',
                                            language: 'th-th'
                                        });

                                        $('#datepicker').on('changeDate', function () {

                                            DateNow = $('#datepicker').datepicker('getFormattedDate');
                                            DateName = date_thai_name(DateNow);

                                            $('#hiddendate').val(DateNow);
                                            $('#MySchoolDateHead').html(DateName);

                                            ClassName = $('#inEdRoomId').html();
                                            $('.modal-title').html(DateName + ClassName);
                                        });

                                    </script>
                                </div>
                            </div>
                        </center>

                        <hr/>
                        <button type='button' class='btn btn-info' style="width:100%; height: 70px;margin-bottom: 10px; float: left;font-size:1.5em;" onclick='AbsentRecordModal(this)'>
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
                                        $('.modal-title').html(DateName + ClassName);
                                        $('#AbsentRecordTBody').html(data);
                                        $('#MySchoolAreaId').val("AbsentRecordBody");
                                        $('#hr-homeroom-absent-record-modal').modal('show');
                                    }
                                });
                            }
                        </script>

                        <button type="button" class="btn btn-info " onclick='StudentWeightAndHeight(this)' style="width:100%; height: 70px;margin-bottom: 10px; float: left;font-size:1.5em;" id='<?php echo $this->session->userdata('hr_id') ?>' >
                            <i class="icon-file icon-large"> แบบบันทึกพัฒนาการเด็ก</i>
                        </button>
                        <script>
                            function StudentWeightAndHeight(e) {
                                location.href = '<?php echo site_url('hr-homeroom-wnh'); ?>?room_id=' + $('#inEdRoomId').val();
                            }
                        </script>

                        <button type="button" class="btn btn-info " onclick='StudentWeightAndHeight(this)' style="width:100%; height: 70px;margin-bottom: 10px; float: left;font-size:1.5em;" id='<?php echo $this->session->userdata('hr_id') ?>' >
                            <i class="glyphicon glyphicon-scale"> บันทึกน้ำหนักส่วนสูง</i>
                        </button>
                        <script>
                            function StudentWeightAndHeight(e) {
                                location.href = '<?php echo site_url('hr-homeroom-wnh'); ?>?room_id=' + $('#inEdRoomId').val();
                            }
                        </script>
                    </div>
                </div>


            </div>
        </div>
    </div>
    <?php $this->load->view('layout/my_school_footer'); ?>
</div>
<?php $this->load->view('homeroom/hr_homeroom_absent_record_modal') ?>
