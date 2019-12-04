<!-- Modal -->
<div id="hr-homeroom-absent-record-modal" class="modal fade" role="dialog">
    <div class="modal-dialog" style="width:90%;">
        <div class="modal-content" >

            <?php
            $data['MyHeadTitle'] = 'แบบบัญชีเรียกชื่อนักเรียน';
            $this->load->view('layout/my_school_modal_header', $data);
            ?>             
            <?php
            $data['AreaID'] = 'AbsentRecordBody';
            $this->load->view('layout/my_school_print', $data);
            ?>     

            <style>
                .modal-body{
                    height: 500px;
                    overflow-y: auto;
                }
                .row{
                    margin-bottom: 10px;
                }

            </style>

            <div class="modal-body" style="padding:30px;" >
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-3" >

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

                                                $.ajax({
                                                    url: "<?php echo site_url('Homeroom/absent_record_tbody'); ?>",
                                                    method: "post",
                                                    data: {roomid: RoomId, datenow: $('#hiddendate').val()},
                                                    success: function (data) {
                                                        $('#AbsentRecordTBody').html(data);
                                                    }
                                                });
                                            });

                                        </script>

                                    </div>
                                </div>
                            </center>
                        </div>
                        <div class="col-md-9" id="AbsentRecordBody">                            
                            <form method="post" id="absent-record-insert-form" enctype="multipart/form-data">
                                <div class="row" style="margin-bottom: 10px">
                                    <center><label class="modal-title"></label></center>
                                </div> 
                                <div class="row">
                                    <table class="table table-hover table-striped table-bordered display" id="example">
                                        <thead>
                                            <tr>
                                                <th style="text-align:center; width:5%;" rowspan="2">ที่</th>
                                                <th class="sorting"  style="text-align:center; width:40%;" rowspan="2">ชื่อ-นามสกุล</th>
                                                <th class="sorting"  style="text-align:center; width:10%; color: green;" colspan="2" >มา</th>
                                                <th class="sorting"  style="text-align:center; width:10%; color: orange;" colspan="2">ลา</th>
                                                <th class="sorting"  style="text-align:center; width:5%; color: red;" rowspan="2">ขาด</th>
                                                <th class="sorting"  style="text-align:center; width:30%;" rowspan="2">หมายเหตุ</th>
                                            </tr>
                                            <tr>
                                                <th class="sorting"  style="text-align:center;  color: green;">มา</th>
                                                <th class="sorting"  style="text-align:center;  color: green;">สาย</th>
                                                <th class="sorting"  style="text-align:center;  color: orange;">ลาป่วย</th>
                                                <th class="sorting"  style="text-align:center;  color: orange;">ลากิจ</th>
                                            </tr>
                                        </thead>

                                        <tbody id='AbsentRecordTBody'>

                                        </tbody>
                                    </table>
                                </div> 
                            </form>
                        </div>
                    </div>   
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function UpdateStatus(e) {
        var recordid = e.substr(2, 11);
        $.ajax({
            url: "<?php echo site_url('Homeroom/std_absent_record_update_status'); ?>",
            method: "post",
            data: {myarray: e, datenow: DateNow},
            success: function (data) {
                $('#myrow' + recordid).html(data);
            }
        });
    }
</script>
