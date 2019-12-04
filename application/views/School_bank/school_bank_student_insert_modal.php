<!-- Modal -->
<div id="school-bank-student-insert-modal" class="modal fade" role="dialog">
    <div class="modal-dialog" style="width:90%;">
        <div class="modal-content">
            <?php $this->load->view("layout/my_school_modal_header"); ?>
            <div class="modal-body" style="padding:30px;">
                <div class="container-fluid">
                    <?php
                    $this->load->view('layout/my_school_print');
                    ?>  
                    <div class="row" id='MySchoolBankPrintArea' style='padding:30px;'>
                        <!--<div class='col-md-12'>-->
                        <?php $this->load->view('layout/my_school_logo'); ?>
                        <div class='row' id='MySchoolBankBody'>

                            <legend>ข้อมูลคะแนนความประพฤติของนักเรียนรายบุคคล</legend>
                            <br/>
                            <div  style='float: left;width:60%;padding:5px;'>
                                <div style='float: left;width:30%;padding:5px;'>
                                    <center><img name='Stdpic' id='Stdpic' src='<?php echo base_url(); ?>/images/abc.jpg' width='120px' /></center>

                                </div>
                                <div style='float: left;width:55%;padding:5px;font-size:0.9em;'>
                                    <p>ชื่อ <b>นายชัยรัธฐา อ่วมอารีย์</b> เลขที่ <b>1</b></p>
                                    <p>รหัสนักเรียน <b>446982</b></p>
                                    <!--<p></p>-->
                                    <p>ระดับชั้น <b>มัธยมศึกษาปีที่ 4 ห้อง 1</b></p>
                                    <!--<p>ผลรวมคะแนนความประพฤติปัจจุบัน 100 คะแนน โดยเป็นการหัก 20 คะแนน และการเพิ่ม 20 คะแนน</p>-->
                                </div> 
                            </div>
                            <div style='float: right;width:30%;padding:5px;'>
                                <table border='1' cellpadding='4' cellspacing='0' style='width:100%;font-size:1em !important;' >
                                    <tbody>
                                        <tr style='color:black;'>
                                            <td style='text-align: center;padding: 3px;'>คะแนนตั้งต้น</td>
                                            <td style='text-align: center;padding: 3px;'>100</td>
                                        </tr>
                                        <tr style='color:green;'>
                                            <td style='text-align: center;padding: 3px;'>คะแนนที่เพิ่ม</td>
                                            <td style='text-align: center;padding: 3px;'>20</td>
                                        </tr>
                                        <tr style='color:red;'>
                                            <td style='text-align: center;padding: 3px;'>คะแนนที่ลด</td>
                                            <td style='text-align: center;padding: 3px;'>30</td>
                                        </tr>
                                    </tbody>
                                    <tfoot>
                                        <tr style='color:blue;background-color: #eeeeee;'>
                                            <td style='text-align: center;padding: 3px;'>ผลรวมคะแนนปัจจุบัน</td>
                                            <td style='text-align: center;padding: 3px;'>90</td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>


                            <div style='clear:both;'></div>
                            <hr/>
                            <center>
                                <div style='width:90%;padding:5px;'>
                                    <h4> <b>ประวัติการบันทึกคะแนน</b> </h4>

                                    <table border='1' cellpadding='4' cellspacing='0' style='width:100%;font-size:0.9em;' >
                                        <thead>
                                            <tr style='background-color: #eeeeee;'>
                                                <th style='width:10%;text-align: center;padding: 3px;'>ที่</th>                                               
                                                <th style='width:50%;text-align: center;padding: 3px;'>ข้อมูลการบันทึก</th>
                                                <th style='width:20%;text-align: center;padding: 3px;'>ผู้บันทึก</th>
                                                <th style='width:30%;text-align: center;padding: 3px;'>วันที่บันทึก</th>
                                            </tr>
                                        </thead>
                                        <tbody  name="inTbody" id="inTbody">
                                            <tr>
                                                <td style='width:10%;text-align: center;padding: 3px;'>ที่</td>                                               
                                                <td style='width:50%;text-align: center;padding: 3px;'>ข้อมูลการบันทึก</td>
                                                <td style='width:20%;text-align: center;padding: 3px;'>ผู้บันทึก</td>
                                                <td style='width:30%;text-align: center;padding: 3px;'>วันที่บันทึก</td>
                                            </tr>
                                        </tbody>
                                    </table>

                                </div>   
                            </center>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>

    function InsertThisMoney(e) {
        if ($('#inSchoolBankType')[0].checked) {
            var mytype = 'ฝาก';
        } else {
            var mytype = 'ถอน';
        }

        $.ajax({
            url: '<?php echo site_url('School_bank/school_bank_student_insert_money'); ?>',
            method: 'post',
            data: {student_id: $('#inStdId').val(), type: mytype, amount: $('#inSchoolBankAmount').val(), note: $('#inSchoolBankNote').val()},
            beforeSend: function () {
                MyStartLoading();
            },
            success: function (data) {
                MyEndLoading();
                alert("บันทึกข้อมูลสำเร็จ");
                ShowThisModal($('#inStdId').val());
            }
        });
    }

    function DeleteThisRecord(e) {
        var status = confirm('ต้องการลบข้อมูลนี้จริงหรือไม่ ?');
        if (status) {
            $.ajax({
                url: '<?php echo site_url('School_bank/school_bank_student_delete_record'); ?>',
                method: 'post',
                data: {id: e.id},
                success: function (data) {
                    ShowThisModal($('#inStdId').val());
                }
            });
        }
    }
</script>