<div class="box">
    <div class="box-heading">แบบประเมิน SDQ</div>
    <ul class="breadcrumb">
        <li><?php echo anchor(site_url(), "<i class='icon-home icon-large'></i> หน้าแรก"); ?></li>
        <!--<   li><?php echo anchor(site_url('icare'), " ระบบดูแลช่วยเหลือนักเรียน/เยี่ยมบ้านนักเรียน"); ?></li>-->
        <li>แบบประเมิน SDQ</li>
    </ul>
    <div style="padding: 30px;">
        <div class="row"> 
            <div class="col-md-2 tab-menu"><?php echo anchor(site_url('sdq-base'), "<i class='icon-edit'></i> การประเมิน SDQ"); ?></div>
            <div class="col-md-2 tab-menu"><?php echo anchor(site_url('sdq-type'), "<i class=\"icon-list-alt\"></i> พฤติกรรมแต่ละด้าน"); ?></div>
            <div class="col-md-2 tab-menu-active"><i class="icon-list"></i> หัวข้อพฤติกรรม</div>
            <div class="col-md-2 tab-menu"><?php echo anchor(site_url('sdq-temp-print'), "<i class=\"icon-print\"></i> พิมพ์แบบเปล่า"); ?></div>
        </div>
        <div class="row" style="background: #f7f7f7;padding:50px;">
            <div class="panel">
                <div class="modal-header" style="background:#ebebeb;">
                    <h4 class="modal-title">หัวข้อพฤติกรรมประเมิน</h4>
                </div>
                <div class="modal-body">
                    <div class="row" style="border-bottom: solid 5px #efefef;margin-bottom: 10px;">
                        <div class="col-md-10 col-md-offset-1">
                            <form method="post" id="sdq-insert-form">
                                <div class="row">
                                    <div class="form-group col-md-12">
                                        <label class="control-label">ประเภท</label><span class="star">&#42;</span>
                                        <select name="inIcareSdqType" id="inIcareSdqType" class="form-control">
                                            <?php foreach ($sdq_type as $r): ?>
                                                <option value="<?php echo $r['id']; ?>"><?php echo $r['tb_sdq_type']; ?></option>
                                            <?php endforeach; ?>

                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-12">
                                        <label class="control-label">พฤติกรรมประเมินหัวข้อ</label><span class="star">&#42;</span>
                                        <div class="input-group">
                                            <span class="input-group-addon">ที่.</span>
                                            <input type="text" name="inIcareSdqSeq" id="inIcareSdqSeq" class="form-control" style="width:10%;background:transparent;" required autofocus=""/>
                                            <input type="text" name="inIcaresdqTopic" id="inIcaresdqTopic" class="form-control" style="width:90%;background:transparent;"  />
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-12">
                                        <label class="control-label">คะแนนประเมิน</label>
                                        <input class="magic-radio form-control" type="radio" name="inIcareSdqZero"  value="F" id="r1" ><label for="r1">ไม่จริงได้ 0</label>&nbsp;
                                        <input class="magic-radio form-control" type="radio" name="inIcareSdqZero"  value="T" id="r2" checked><label for="r2">จริงได้ 0</label>&nbsp;<span class="star">&#42;</span>
                                    </div>
                                </div>
                                <div class="row">
                                    <center><button type="submit" class="btn btn-success"><i class="icon-save icon-large"></i> บันทึก</button>
                                        <button type="button" class="btn btn-warning"><i class=" icon-large"></i> ล้างข้อมูล</button>
                                    </center>
                                </div>
                                <div class="row"><div class="col-md-12">เครื่องหมาย <span class="star">&#42;</span> จำเป็นต้องกรอก</div></div>
                                <input type="hidden" name="id" id="id" />
                            </form>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 ">

                            <center>
                                <table style="width:100%" class="table table-hover table-striped table-bordered display" id="sdqTopicTab">
                                    <thead>
                                        <tr>
                                            <th style="width:40px; text-align: center">ที่</th>
                                            <th class="no-sort" style="text-align: center">หัวข้อพฤติกรรมประเมิน</th>
                                            <th class="no-sort" style="text-align: center">ไม่จริง</th>
                                            <th class="no-sort" style="text-align: center">อาจจะจริง</th>
                                            <th class="no-sort" style="text-align: center">จริง</th>
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
                <div class="modal-footer">
                    &nbsp;
                </div>
            </div><!-- /.modal-content -->
        </div>

    </div>
    <?php $this->load->view('layout/my_school_footer'); ?>
</div>
<div class="col-md-12">

</div>
<script>

    $('#sdqTopicTab').DataTable({
        "responsive": true,
        "stateSave": true,
        "bSort": false,
        "ordering": false,
        columnDefs: [{
                orderable: false,
                targets: "no-sort"
            }],
        "language": {
            "lengthMenu": "แสดง _MENU_ แถวต่อหน้า",
            "zeroRecords": "## ไม่มีข้อมูล ##",
            "info": "แสดงหน้าที่ _PAGE_ ในทั้งหมด _PAGES_ หน้า",
            "infoEmpty": "",
            "infoFiltered": "",
            "sSearch": "ระบุคำค้น",
            "sPaginationType": "full_numbers"
        }
    });
    $('.sorting_asc').removeClass('sorting_asc');

    // append insert button
    var status = "<?php echo $this->session->userdata('status'); ?>";
//    if (status == "ผู้ปฏิบัติงาน") {
//        $("div#sdqTab_length.dataTables_length").append("&nbsp;&nbsp;<button type='button' class='btn btn-info btn-insert'><i class='icon-plus icon-large'></i> เพิ่มหัวข้อพฤติกรรมประเมิน</button>");
//        $("div#sdqTab_length.dataTables_length").append("&nbsp;&nbsp;<button type='button' class='btn btn-warning btn-print'><i class='icon-print icon-large'></i> พิมพ์แบบประเมินเปล่า</button>");
//    }
//
//    $(".btn-insert").on("click", function () {
//        $("#sdq-insert-modal").modal("show");
//    });
//
//    $(".btn-print").on("click", function () {
//        $("#sdq-print-modal").modal("show");
//    });

    $(".btn-warning").on("click", function () {
        
        $("#sdq-insert-form")[0].reset();
        $('#id').val('');
    });



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
                $('#inIcareSdqSeq').val(data.tb_icare_sdq_seq);
                $('#inIcareSdqType').val(data.tb_icare_sdq_type);
                if (data.tb_icare_sdq_zero_points === 'F') {
                    $('input[name="inIcareSdqZero"]')[0].checked = true;
                } else {
                    $('input[name="inIcareSdqZero"]')[1].checked = true;
                }
                $('#id').val(data.id);
            }
        });
    });

    // delete data
    $("#sdqTopicTab").on("click", ".btn-sdq-delete", function () {
        var uid = $(this).attr("id");
        var status = confirm('ต้องการลบข้อมูลนี้จริงหรือไม่ ?');
        if (status) {
            $.ajax({
                url: "<?php echo site_url('Icare/sdq_delete'); ?>",
                method: 'post',
                data: {id: uid},
                success: function (data) {
                    location.reload();
                }
            });
        }
    });

</script>

