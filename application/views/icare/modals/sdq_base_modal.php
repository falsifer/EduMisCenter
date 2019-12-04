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
                                <div class="form-group col-md-12">
                                    <label class="control-label">ประเภท</label><span class="star">&#42;</span>
                                    <select name="inIcaresdqType" id="inIcaresdqType" class="form-control">
                                        <option value="ด้านอารมณ์">ด้านอารมณ์</option>
                                        <option value="ด้านอารมณ์">ด้านความประพฤติ/เกเร</option>
                                        <option value="ด้านอารมณ์">ด้านพฤติกรรมไม่อยู่นิ่ง/สมาธิสั้น</option>
                                        <option value="ด้านอารมณ์">ด้านอารมณ์</option>
                                    </select>
                                </div>
                            </div><div class="row">
                                <div class="form-group col-md-12">
                                    <label class="control-label">พฤติกรรมประเมินหัวข้อ</label><span class="star">&#42;</span>
                                    <input type="text" name="inIcaresdqTopic" id="inIcaresdqTopic" class="form-control"  />
                                </div>
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

    
    // edit data
    $("#sdqTopicTab").on("click", ".btn-sdq-edit", function () {
        var uid = $(this).attr("id");

        $.ajax({
            url: "<?php echo site_url('Icare/sdq_edit'); ?>",
            method: "post",
            data: {id: uid},
            dataType: "json",
            success: function (data) {
                $('#inIcaresdqTopic').val(data.tb_icare_sdq_topic);
                $('#id').val(data.id);
            }
        });
    });

</script>
