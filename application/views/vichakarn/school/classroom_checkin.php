<div class="box">
    <div class="box-heading">ระบบงานวัดผลและประเมินผล</div>
    <ul class="breadcrumb">
        <li><?php echo anchor(site_url(), "<i class='icon-home icon-large'></i> หน้าแรก"); ?></li>
        <li><?php echo anchor(site_url() . '/ed-evaluation', "<i class='icon-user icon-large'></i> งานวัดผลและประเมินผล"); ?></li>
        <li>บันทึกเข้าห้องเรียน</li>
    </ul>
    <div class="box-body">
        <form method="post" id="room-insert-form">
            <div class="row">
                <div class="col-md-4 form-group">
                    <label class="control-label">วันที่</label><span class="star">&#42;</span>
                    <input type="text" name="inEducationalPlanDate" id="inEducationalPlanDate" class="form-control datepicker" data-date-format="yyyy-mm-dd" value="<?php echo date('Y'); ?>-<?php echo date('m-d'); ?>" required/>
                </div>
                <div class="col-md-4">
                    <label class="control-label">ชั้น</label><span class="star">&#42;</span>
                    <select name="inClassroomLevel" id="inClassroomLevel" class="form-control" required>
                        <option value="">---เลือกข้อมูล---</option>
                        <option value="ประถมศึกษาปีที่ 1/1">ประถมศึกษาปีที่ 1/1</option>
                        <option value="ประถมศึกษาปีที่ 2/1">ประถมศึกษาปีที่ 2/1</option>
                        <option value="ประถมศึกษาปีที่ 3/1">ประถมศึกษาปีที่ 3/1</option>
                        <option value="ประถมศึกษาปีที่ 4/1">ประถมศึกษาปีที่ 4/1</option>
                        <option value="ประถมศึกษาปีที่ 5/1">ประถมศึกษาปีที่ 5/1</option>
                        <option value="ประถมศึกษาปีที่ 6/1">ประถมศึกษาปีที่ 6/1</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <label class="control-label">วิชา</label><span class="star">&#42;</span>
                    <select name="inClassroomRoom" id="inClassroomRoom" class="form-control" required>
                        <option value="">---เลือกข้อมูล---</option>
                        <option value="1">ภาษาไทย</option>
                        <option value="2">คณิตศาสตร์</option>
                        <option value="3">สังคมศึกษา</option>
                        <option value="4">ศิลปะ</option>
                    </select>
                </div>
            </div>

            <input type="hidden" name="id" id="id" />
        </form>
        <div class="table-responsive">
            <?php foreach ($std as $r): ?>
                <div class="panel col-md-3" style="margin: 5px;padding: 5px;">
                    <center>
                        <div class="row">

                            <div class="col-md-12">
                                <h3 id="inStdName"><?php echo $r['std_titlename'] . ' ' . $r['std_firstname'] . ' ' . $r['std_lastname']; ?></h3>
                            </div>
                            <div class="col-md-12">
                                <img src="<?php base_url(); ?>/eschool/upload/<?php $r['pic_name'] ?>" width="200" />
                            </div>
                            <div class="col-md-12" style="margin: 5px 0px;">
                                <input type="button" class="btn btn-default col-md-4" name="checkin<?php $r['id'] ?>" id="checkin" value="มา" />
                                <input type="button" class="btn btn-default col-md-4" name="absent<?php $r['id'] ?>" id="absent" value="ขาด" />
                                <input type="button" class="btn btn-default col-md-4" name="sick<?php $r['id'] ?>" id="sick" value="ลา" />
                            </div>

                        </div>
                    </center>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <div class="box-footer" style="padding-top: 0px;">
        <div class="row">
            <div class="col-md-8">
                <?php echo img("images/kml_logo.png"); ?>
            </div>
            <div class="col-md-4" style="padding-top:8px;padding-bottom: 8px;padding-right:30px;">
                <span class="pull-right"><span style="color:#999999;">eSchool Version 1.0</span></span>
            </div>
        </div>
    </div>
</div>

<script>
    $(".datepicker").datepicker({autoclose: true, language: 'th'});
    $('#example').DataTable({
        "responsive": true,
        "stateSave": true,
        "bSort": false,
        "ordering": true,
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
    var res = "<?php echo $this->session->userdata('responsible'); ?>";
    if (status == "ผู้ปฏิบัติงาน") {
        $("div#example_length.dataTables_length").append("&nbsp;&nbsp;<button type='button' class='btn btn-primary btn-insert'><i class='icon-plus icon-large'></i> เพิ่มข้อมูล</button>");
    }

    $('.btn-default').on("click", function (e) {
        if (confirm($('#inStdName').html() + " " + $(this).val() + " ใช่หรือไม่?")) {
            if ($(this).val() === 'มา') {
                $(this).removeClass().addClass('btn btn-success col-md-4');
                $('#absent').removeClass().addClass('btn btn-default col-md-4');
                $('#sick').removeClass().addClass('btn btn-default col-md-4');
            } else if ($(this).val() === 'ขาด') {
                $(this).removeClass().addClass('btn btn-danger col-md-4');
                $('#checkin').removeClass().addClass('btn btn-default col-md-4');
                $('#sick').removeClass().addClass('btn btn-default col-md-4');
            } else if ($(this).val() === 'ลา') {
                $(this).removeClass().addClass('btn btn-warning col-md-4');
                $('#absent').removeClass().addClass('btn btn-default col-md-4');
                $('#checkin').removeClass().addClass('btn btn-default col-md-4');
            }
        }
    });

</script>
<?php //$this->load->view("modals/vichakarn/km_detail_modal"); ?>
<?php
//$this->load->view("modals/vichakarn/km_edit_modal"); ?>