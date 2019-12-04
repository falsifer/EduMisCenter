<div id="sdq-insert-modal" class="modal fade" tabindex="-1" role="dialog">

    <div class="modal-dialog" role="document" style="width:1250px;">
        <div class="modal-content">
            <div class="modal-header" style="background:#ebebeb;">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">หัวข้อพฤติกรรมประเมิน</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-10 col-md-offset-1">
                        <form method="post" id="sdq-insert-form">
                            <div class="row">
                            </div>
                            <div class="row">
                                <div class="form-group col-md-12">
                                    <label class="control-label">พฤติกรรมประเมินหัวข้อ</label><span class="star">&#42;</span>
                                    <input type="text" name="inIcaresdqTopic" id="inIcaresdqTopic" class="form-control"  />
                                </div>
                            </div>


                            <div class="row">
                                <center><button type="submit" class="btn btn-success"><i class="icon-save icon-large"></i> บันทึกข้อมูล</button></center>
                            </div>
                            <div class="row"><div class="col-md-12">เครื่องหมาย <span class="star">&#42;</span> จำเป็นต้องกรอก</div></div>
                            <input type="hidden" name="id" id="id" />
                        </form>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="table-responsive">
                            <center>
                                <table style="width:80%" class="table table-hover table-striped table-bordered display" id="sdqTopicTab">
                                    <thead>
                                        <tr>
                                            <th style="width:40px; text-align: center">ที่</th>
                                            <th class="no-sort" style="text-align: center">หัวข้อพฤติกรรมประเมิน</th>

                                            <?php if ($this->session->userdata("status") == "ผู้ปฏิบัติงาน"): ?>
                                                <th style="width:20%;" class="no-sort"></th>
                                            <?php endif; ?>
                                        </tr>
                                    </thead>
<!--                                    <tbody>
                                        <tr>
                                            <td style="text-align: center;">1.</td>
                                            <td style="text-align: left;">ห่วงใยความรู้สึกคนอื่น</td>
                                            <?php if ($this->session->userdata("status") == "ผู้ปฏิบัติงาน"): ?>
                                                <td style="text-align:center;">
                                                    <button type="button" class="btn btn-info btn-show" id=""><i class="icon-plus icon-large"></i> แก้ไข</button>
                                                    <button type="button" class="btn btn-warning btn-show" id=""><i class="icon-plus icon-large"></i> ลบ</button>
                                                </td>
                                            <?php endif; ?>
                                        </tr>                                           
                                        <tr>    
                                            <td style="text-align: center;">2.</td>
                                            <td style="text-align: left;">อยู่ไม่นิ่ง นั่งนิ่งๆ ไม่ได้</td>
                                            <?php if ($this->session->userdata("status") == "ผู้ปฏิบัติงาน"): ?>
                                                <td style="text-align:center;">
                                                    <button type="button" class="btn btn-info btn-show" id=""><i class="icon-plus icon-large"></i> แก้ไข</button>
                                                    <button type="button" class="btn btn-warning btn-show" id=""><i class="icon-plus icon-large"></i> ลบ</button>
                                                </td>
                                            <?php endif; ?>
                                        </tr>    
                                        <tr>    
                                            <td style="text-align: center;">3.</td>
                                            <td style="text-align: left;">มักจะบ่นว่าปวดศีรษะ ปวดท้อง หรือไม่สบาย</td>
                                            <?php if ($this->session->userdata("status") == "ผู้ปฏิบัติงาน"): ?>
                                                <td style="text-align:center;">
                                                    <button type="button" class="btn btn-info btn-show" id=""><i class="icon-plus icon-large"></i> แก้ไข</button>
                                                    <button type="button" class="btn btn-warning btn-show" id=""><i class="icon-plus icon-large"></i> ลบ</button>
                                                </td>
                                            <?php endif; ?>
                                        </tr>    
                                        <tr>    
                                            <td style="text-align: center;">4.</td>
                                            <td style="text-align: left;">เต็มใจแบ่งปันสิ่งของให้เพื่อน (ขนม ของเล่น ดินสอ เป็นต้น)</td>
                                            <?php if ($this->session->userdata("status") == "ผู้ปฏิบัติงาน"): ?>
                                                <td style="text-align:center;">
                                                    <button type="button" class="btn btn-info btn-show" id=""><i class="icon-plus icon-large"></i> แก้ไข</button>
                                                    <button type="button" class="btn btn-warning btn-show" id=""><i class="icon-plus icon-large"></i> ลบ</button>
                                                </td>
                                            <?php endif; ?>
                                        </tr>    
                                        <tr>    
                                            <td style="text-align: center;">5.</td>
                                            <td style="text-align: left;">มักจะอาละวาด หรือโมโหร้าย</td>
                                            <?php if ($this->session->userdata("status") == "ผู้ปฏิบัติงาน"): ?>
                                                <td style="text-align:center;">
                                                    <button type="button" class="btn btn-info btn-show" id=""><i class="icon-plus icon-large"></i> แก้ไข</button>
                                                    <button type="button" class="btn btn-warning btn-show" id=""><i class="icon-plus icon-large"></i> ลบ</button>
                                                </td>
                                            <?php endif; ?>
                                        </tr>    
                                        <tr>    
                                            <td style="text-align: center;">6.</td>
                                            <td style="text-align: left;">ค่อนข้างแยกตัว ชอบเล่นคนเดียว</td>
                                            <?php if ($this->session->userdata("status") == "ผู้ปฏิบัติงาน"): ?>
                                                <td style="text-align:center;">
                                                    <button type="button" class="btn btn-info btn-show" id=""><i class="icon-plus icon-large"></i> แก้ไข</button>
                                                    <button type="button" class="btn btn-warning btn-show" id=""><i class="icon-plus icon-large"></i> ลบ</button>
                                                </td>
                                            <?php endif; ?>
                                        </tr>    
                                        <tr>    
                                            <td style="text-align: center;">7.</td>
                                            <td style="text-align: left;">เชื่อฟัง มักจะทำตามผู้ใหญ่ต้องการ</td>
                                            <?php if ($this->session->userdata("status") == "ผู้ปฏิบัติงาน"): ?>
                                                <td style="text-align:center;">
                                                    <button type="button" class="btn btn-info btn-show" id=""><i class="icon-plus icon-large"></i> แก้ไข</button>
                                                    <button type="button" class="btn btn-warning btn-show" id=""><i class="icon-plus icon-large"></i> ลบ</button>
                                                </td>
                                            <?php endif; ?>
                                        </tr>    
                                        <tr>    
                                            <td style="text-align: center;">8.</td>
                                            <td style="text-align: left;">กังวลใจหลายเรื่อง ดูวิตกกังวลเสมอ</td>
                                            <?php if ($this->session->userdata("status") == "ผู้ปฏิบัติงาน"): ?>
                                                <td style="text-align:center;">
                                                    <button type="button" class="btn btn-info btn-show" id=""><i class="icon-plus icon-large"></i> แก้ไข</button>
                                                    <button type="button" class="btn btn-warning btn-show" id=""><i class="icon-plus icon-large"></i> ลบ</button>
                                                </td>
                                            <?php endif; ?>
                                        </tr>    
                                        <tr>    
                                            <td style="text-align: center;">9.</td>
                                            <td style="text-align: left;">เป็นที่พึ่งได้เวลาที่คนอื่นเสียใจ อารมณ์ไม่ดีหรือไม่สบายใจ</td>
                                            <?php if ($this->session->userdata("status") == "ผู้ปฏิบัติงาน"): ?>
                                                <td style="text-align:center;">
                                                    <button type="button" class="btn btn-info btn-show" id=""><i class="icon-plus icon-large"></i> แก้ไข</button>
                                                    <button type="button" class="btn btn-warning btn-show" id=""><i class="icon-plus icon-large"></i> ลบ</button>
                                                </td>
                                            <?php endif; ?>
                                        </tr>    
                                        <tr>    
                                            <td style="text-align: center;">10.</td>
                                            <td style="text-align: left;">อยู่ไม่สุข วุ่นวายอย่างมาก</td>
                                            <?php if ($this->session->userdata("status") == "ผู้ปฏิบัติงาน"): ?>
                                                <td style="text-align:center;">
                                                    <button type="button" class="btn btn-info btn-show" id=""><i class="icon-plus icon-large"></i> แก้ไข</button>
                                                    <button type="button" class="btn btn-warning btn-show" id=""><i class="icon-plus icon-large"></i> ลบ</button>
                                                </td>
                                            <?php endif; ?>
                                        </tr>                                           
                                    </tbody>-->
                                </table>
                            </center>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">ยกเลิก</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->

</div><!-- /.modal -->

<script>
    $.ajax({
                    url: "<?php echo site_url('Icare/sdq_list'); ?>",
                    method: "post",
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: function (data) {
     
                        $('#sdqTopicTab').html(data);
                    }
                });
    $("#sdq-insert-form").on("submit", function (e) {
        e.preventDefault();
        //

        $.ajax({
            url: "<?php echo site_url('Icare/sdq_insert'); ?>",
            method: "post",
            data: new FormData(this),
            cache: false,
            contentType: false,
            processData: false,
            success: function (data) {
                alert("บันทึกข้อมูลสำเร็จ");
                $("#sdq-insert-form")[0].reset();
                $.ajax({
                    url: "<?php echo site_url('Icare/sdq_list'); ?>",
                    method: "post",
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: function (data) {
                        $('#sdqTopicTab').html(data);
                    }
                });

            }
        });
    });



</script>
