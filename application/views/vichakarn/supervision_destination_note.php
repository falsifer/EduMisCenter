
<!------------------------------------------------------------------------------
|  Title        Supervision destination note
| ----------------------------------------------------------------------------
| Copyright	Edutech Co.,Ltd.
| Purpose       บันทึกเกี่ยวกับผู้รับการนิเทศ
| Author	นายบัณฑิต ไชยดี
| Create Date   24 ธันวาคม 2018
| Last edit	-
| Comment	-
| --------------------------------------------------------------------------->
<div class="col-md-10 col-md-offset-1">
    <div class="panel panel-primary">
        <div class="panel-heading">บันทึกการนิเทศ</div>
        <ul class="breadcrumb">
            <li><?php echo anchor(site_url(), "<i class='icon-home icon-large'></i> หน้าแรก"); ?></li>
            <li><a href="<?php echo site_url('supervision'); ?>">แผนงานและการดำเนินงานนิเทศ</a></li>
            <li>บันทึกการนิเทศ</li>
            <!-- Print data -->
            <span class="pull-right"><?php //echo anchor(current_url(), img('images/printer.png') . " พิมพ์ข้อมูล");  ?></span>
        </ul>
        <div class="panel-body">
            <h4>ข้อมูลเบื้องต้น</h4>
            <div class="col-md-12" style="border:4px double #ddd;padding:15px;margin-bottom:15px;">
                <div class="table-responsive">
                    <table class="table">
                        <?php if (!empty($supervision_note)): ?>
                            <tr>
                                <td style="width:25%;border:none;border-bottom:1px dashed #ccc;">การนำนวัตกรรมไปใช้ในขั้นตอนที่</td><td style="border:none;border-bottom:1px dashed #ccc;"><?php echo $supervision_note['solution_in_step']; ?></td>
                            </tr>
                            <tr>
                                <td style="border:none;border-bottom:1px dashed #ccc;">สาระที่นิเทศ</td><td style="border:none;border-bottom:1px dashed #ccc;"><?php echo $supervision_note['supervision_issue']; ?></td>
                            </tr>
                            <tr>
                                <td style="border:none;border-bottom:1px dashed #ccc;">ผู้รับการนิเทศ</td><td style="border:none;border-bottom:1px dashed #ccc;"><?php echo $supervision_note['supervision_to']; ?></td>
                            </tr>
                            <tr>
                                <td style="border:none;border-bottom:1px dashed #ccc;">วัน เดือน ปี ที่นิเทศ</td><td style="border:none;border-bottom:1px dashed #ccc;"><?php echo datethai($supervision_note['supervision_date']); ?></td>
                            </tr>
                            <tr>
                                <td style="border:none;border-bottom:1px dashed #ccc;">หมายเหตุ</td><td style="border:none;border-bottom:1px dashed #ccc;"><?php echo $supervision_note['supervision_comment']; ?></td>
                            </tr>
                        <?php else: ?>
                            <tr>
                                <td style="border:none;border-bottom:1px dashed #ccc;">การนำนวัตกรรมไปใช้ในขั้นตอนที่</td><td style="border:none;border-bottom:1px dashed #ccc;"></td>
                            </tr>
                            <tr>
                                <td style="border:none;border-bottom:1px dashed #ccc;">สาระที่นิเทศ</td><td style="border:none;border-bottom:1px dashed #ccc;"></td>
                            </tr>
                            <tr>
                                <td style="border:none;border-bottom:1px dashed #ccc;">ผู้รับการนิเทศ</td><td style="border:none;border-bottom:1px dashed #ccc;"></td>
                            </tr>
                            <tr>
                                <td style="border:none;border-bottom:1px dashed #ccc;">วัน เดือน ปี ที่นิเทศ</td><td style="border:none;border-bottom:1px dashed #ccc;"></td>
                            </tr>
                            <tr>
                                <td style="border:none;border-bottom:1px dashed #ccc;">หมายเหตุ</td><td style="border:none;border-bottom:1px dashed #ccc;"></td>
                            </tr>
                        <?php endif; ?>
                    </table>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <?php if (!empty($supervision_note) OR ! empty($opinion)): ?>
                        <center>
                            <?php if (!empty($rs)): ?>
                                <button type="button" class="btn btn-warning btn-edit" id="<?php echo $supervision_note['id']; ?>" disabled=""><i class="icon-pencil"></i> แก้ไข</button>
                                <button type="button" class="btn btn-danger btn-delete" id="<?php echo $supervision_note['id']; ?>" disabled=""><i class="icon-trash"></i> ลบ</button>
                            <?php else: ?>
                                <button type="button" class="btn btn-warning btn-edit" id="<?php echo $supervision_note['id']; ?>"><i class="icon-pencil"></i> แก้ไข</button>
                                <button type="button" class="btn btn-danger btn-delete" id="<?php echo $supervision_note['id']; ?>"><i class="icon-trash"></i> ลบ</button>
                            <?php endif; ?>
                        </center>
                    <?php else: ?>
                        <center><button type="button" class="btn btn-primary btn-supervision-note-insert"><i class="icon-plus"></i> เพิ่มข้อมูล</button></center>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Show table data -->
            <?php if (!empty($supervision_note)): ?>
                <div class="well" style="margin-top:10px;margin-bottom:10px;">
                    <h4>ผลการนิเทศ</h4>
                    <div class="row" style="margin-top:20px;">
                        <table class="table table-hover table-bordered" id="example" style="background:#fff;">
                            <thead>
                                <tr>
                                    <th class="no-sort">ที่</th>
                                    <th class="no-sort">วัตถุประสงค์</th>
                                    <th class="no-sort">กิจกรรม/วิธีการ/สื่อที่ใช้</th>
                                    <th class="no-sort">ผลที่เกิดกับผู้รับการนิเทศ</th>
                                    <?php if ($this->session->userdata('status') == 'ผู้ปฏิบัติงาน'): ?>
                                    <th class="no-sort" style="width:22%"></th>
                                    <?php endif; ?>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $row = 1; ?>
                                <?php foreach ($rs as $r): ?>
                                    <tr>
                                        <td style="text-align:center;"><?php echo $row; ?></td>
                                        <td><?php echo $r['detail_destination']; ?></td>
                                        <td><?php echo $r['destination_activities']; ?></td>
                                        <td><?php echo $r['destination_result']; ?></td>
                                        <?php if ($this->session->userdata('status') == 'ผู้ปฏิบัติงาน'): ?>
                                            <td style="text-align:center;">
                                                <div class="btn-group">
                                                    <button type="button" class="col-md-6 btn btn-warning btn-note-edit" id="<?php echo $r['id']; ?>"><i class="icon-pencil"></i> แก้ไข</button>
                                                    <button type="button" class="col-md-6 btn btn-danger btn-note-delete" id="<?php echo $r['id']; ?>"><i class="icon-trash"></i> ลบ</button>
                                                </div>
                                            </td>
                                        <?php endif; ?>
                                    </tr>
                                    <?php $row++; ?>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                    <hr/>
                </div>
            <?php endif; ?>

            <!-- ข้อคิดเห็น/ข้อตกลง -->
            <h4>ข้อคิดเห็น/ข้อตกลงร่วมระหว่างผู้นิเทศและผู้รับการนิเทศในครั้งต่อไป</h4>
            <?php if (!empty($supervision_note)): ?>
                <?php if (!empty($opinion)): ?>
                    <?php if ($this->session->userdata('status') == 'ผู้ปฏิบัติงาน'): ?>
                        <div class="row">
                            <div class="col-md-12">
                                <form method="post" id="opinion-form">
                                    <div class="row">
                                        <div class="form group col-md-12">
                                            <textarea name="inOpinionDetail" id="inOpinionDetail" class="form-control" style="height:180px;border:4px double #ddd;" placeholder="คลิกเพื่อพิมพ์..."><?php echo $opinion['opinion_detail']; ?></textarea>
                                        </div>
                                    </div>
                                    <div class="row" style="margin-top:10px;">
                                        <div class="formg-group col-md-12 btn-group">
                                            <center>
                                                <button type="submit" class="col-md-6 btn btn-warning"><i class="icon-save"></i> แก้ไข</button>
                                                <button type="button" class="col-md-6 btn btn-danger btn-opinion-delete" id="<?php echo $opinion['schedule_detail_id']; ?>"><i class="icon-trash"></i> ลบ</button>
                                            </center>
                                        </div>
                                    </div>
                                    <input type="hidden" name="schedule_detail_id" value="<?php echo $opinion['schedule_detail_id']; ?>" />
                                    <input type="hidden" name="status" value="ปรับปรุงข้อมูล" />
                                </form>
                            </div>
                        </div>
                    <?php else: ?>
                        <div class="row">
                            <div class="col-md-12">
                                <?php echo $opinion['opinion_detail']; ?>
                            </div>
                        </div>
                    <?php endif; ?>
                <?php else: ?>
                    <?php if ($this->session->userdata('status') == 'ผู้ปฏิบัติงาน'): ?>
                        <div class="row">
                            <div class="col-md-12">
                                <form method="post" id="opinion-form">
                                    <div class="row">
                                        <div class="form group col-md-12">
                                            <textarea name="inOpinionDetail" id="inOpinionDetail" class="form-control" style="height:180px;border:4px double #ddd;" placeholder="คลิกเพื่อพิมพ์..."></textarea>
                                        </div>
                                    </div>
                                    <div class="row" style="margin-top:10px;">
                                        <div class="formg-group col-md-12">
                                            <center><button type="submit" class="btn btn-success"><i class="icon-save"></i> บันทึก</button></center>
                                        </div>
                                    </div>
                                    <input type="hidden" name="schedule_detail_id" value="<?php echo $this->uri->segment(2); ?>" />
                                </form>
                            </div>
                        </div>
                    <?php endif; ?>
                <?php endif; ?>
            <?php endif; ?>

            <!-- สรุปผล/ข้อคิดเห็น -->
            <?php if (!empty($supervision_note)): ?>
                <h4>สรุปผล/ข้อคิดเห็นของผู้นิเทศ</h4>
                <?php if (!empty($summary)): ?>
                    <?php if ($this->session->userdata('status') == 'ผู้ปฏิบัติงาน'): ?>
                        <form method="post" id="summary-form">
                            <div class="row">
                                <div class="col-md-12 form-grup">
                                    <textarea class="form-control" style="height:180px;border:4px double #ddd;" name="inSummary" id="inSummary" placeholder="คลิกเพื่อพิมพ์..."><?php echo $summary['supervision_summary']; ?></textarea>
                                </div>
                            </div>
                            <div class="row" style="margin-top:10px;">
                                <div class="form-group col-md-12">
                                    <center>
                                        <button type="submit" class="btn btn-warning"><i class="icon-pencil"></i> แก้ไข</button>
                                        <button type="button" class="btn btn-danger btn-summary-delete" id="<?php echo $summary['schedule_detail_id']; ?>"><i class="icon-trash"></i> ลบ</button>
                                    </center>
                                </div>
                            </div>
                            <input type="hidden" name="schedule_detail_id" id="schedule_detail_id" value="<?php echo $summary['schedule_detail_id']; ?>" /> 
                            <input type="hidden" name="status" value="ปรับปรุงข้อมูล" />
                        </form>
                    <?php else: ?>
                        <div class="row">
                            <div class="col-md-12">
                                <?php echo $summary['supervision_summary']; ?>
                            </div>
                        </div>
                    <?php endif; ?>
                <?php else: ?>
                    <?php if ($this->session->userdata('status') == 'ผู้ปฏิบัติงาน'): ?>
                        <form method="post" id="summary-form">
                            <div class="row">
                                <div class="col-md-12 form-grup">
                                    <textarea class="form-control" style="height:180px;border:4px double #ddd;" name="inSummary" id="inSummary" placeholder="คลิกเพื่อพิมพ์..." required></textarea>
                                </div>
                            </div>
                            <div class="row" style="margin-top:10px;">
                                <div class="form-group col-md-12">
                                    <center><button type="submit" class="btn btn-success"><i class="icon-save"></i> บันทึก</button></center>
                                </div>
                            </div>
                            <input type="hidden" name="schedule_detail_id" value="<?php echo $this->uri->segment(2); ?>" />
                        </form>
                    <?php endif; ?>
                <?php endif; ?>
            <?php endif; ?>
        </div>
        <?php $this->load->view('layout/my_school_footer'); ?>
    </div>
</div>
<!---------------------------------------------------------------------------->
<script>
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
    // id data-table-ii
    $('#data-table-ii').DataTable({
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
    // แสดงปุ่มพิมพ์แบบประเมิน
    $('div#data-table-ii_length.dataTables_length').append("&nbsp;&nbsp;<a href='<?php echo site_url('print-define-destination-note/' . $this->uri->segment(2)); ?>' class='btn btn-primary' target='_blank'>สั่งพิมพ์</a>");
    //
    $('.sorting_asc').removeClass('sorting_asc');
    $('.btn-supervision-note-insert').on('click', function () {
        $('#insert-form').trigger('reset');
        $('h3.modal-title').text('บันทึกข้อมูลการนิเทศ');
        $('#supervision-destination-modal').modal('show');
    });
    //
    $('div#example_length.dataTables_length').append("&nbsp;&nbsp;<button type='button' class='btn btn-primary btn-insert'><i class='icon-plus'></i> เพิ่มข้อมูล</button>");
    // แก้ไขข้อมูลบันทึกการนิเทศ
    $('.btn-edit').on('click', function () {
        var uid = $(this).attr('id');
        $.ajax({
            url: '<?php echo site_url('update-supervision-destination-note'); ?>',
            method: 'post',
            data: {id: uid},
            dataType: 'json',
            success: function (data) {
                $('#id').val(data.id);
                $("#inSupervisionName").val(data.supervision_name);
                $('#inSolutionInStep').val(data.solution_in_step);
                $('#inSupervisionIssue').val(data.supervision_issue);
                $('#inSupervisionTo').val(data.supervision_to);
                $('#inSupervisionDate').val(data.supervision_date);
                $('#inSupervisionComment').val(data.supervision_comment);
                // 
                $('h3.modal-title').text('ปรับปรุงข้อมูลบันทึกการนิเทศ');
                $('#supervision-destination-modal').modal('show');
            }
        });
    });
    // ลบข้อมูลบันทึกการนิเทศ
    $('.btn-delete').on('click', function () {
        var uid = $(this).attr('id');
        var status = confirm('ต้องการลบข้อมูลนี้จริงหรือไม่ ?');
        if (status) {
            $.ajax({
                url: '<?php echo site_url('delete-supervision-destination-note'); ?>',
                method: 'post',
                data: {id: uid},
                success: function (data) {
                    location.reload();
                }
            });
        }
    });
    // บันทึกข้อมูลการนิเทศ
    $('.btn-insert').click(function () {
        $('#destination-note-form').trigger('reset');
        $('h3.modal-title').text('บันทึกข้อมูลผลการนิเทศ');
        $('#supervision-destination-note-detail-modal').modal('show');
    });
    // edit data;
    $('#example').on('click', '.btn-note-edit', function () {
        var uid = $(this).attr('id');
        $.ajax({
            url: '<?php echo site_url('update-supervision-destination-note-detail'); ?>',
            method: 'post',
            data: {id: uid},
            dataType: 'json',
            success: function (data) {
                $('#note-id').val(data.id);
                $('#inDetailDestination').val(data.detail_destination);
                $('#inDetailActivities').val(data.destination_activities);
                $('#inDestinationResult').val(data.destination_result);
                //
                $('h3.modal-title').text('แก้ไขข้อมูลผลการนิเทศ');
                $('#supervision-destination-note-detail-modal').modal('show');
            }
        });
    });
    // delete data;
    $('#example').on('click', '.btn-note-delete', function () {
        var uid = $(this).attr('id');
        var status = confirm('ต้องการลบข้อมูลนี้จริงหรือไม่ ?');
        if (status) {
            $.ajax({
                url: '<?php echo site_url('delete-supervision-destination-note-detail'); ?>',
                method: 'post',
                data: {id: uid},
                success: function (data) {
                    location.reload();
                }
            });
        }
    });
    // ข้อคิดเห็น
    $('#opinion-form').on('submit', function (e) {
        e.preventDefault();
        $.ajax({
            url: '<?php echo site_url('insert-supervision-destination-opinion'); ?>',
            method: 'post',
            data: $('#opinion-form').serialize(),
            success: function (data) {
                alert('บันทึกข้อมูลเรียบร้อย...');
                $('#opinion-form')[0].reset();
                location.reload();
            }
        });
    });
    // ลบข้อคิดเห็น
    $('.btn-opinion-delete').on('click', function () {
        var uid = $(this).attr('id');
        var status = confirm('ต้องการลบข้อมูลนี้จริงหรือไม่ ?');
        if (status) {
            $.ajax({
                url: '<?php echo site_url('delete-supervision-destination-opinion'); ?>',
                method: 'post',
                data: {id: uid},
                success: function (data) {
                    location.reload();
                }
            });
        }
    });
    // สรุปผล-ข้อคิดเห็น
    $('#summary-form').on('submit', function (e) {
        e.preventDefault();
        $.ajax({
            url: '<?php echo site_url('insert-supervision-summary'); ?>',
            method: 'post',
            data: $('#summary-form').serialize(),
            success: function (data) {
                alert('บันทึกข้อมูลเรียบร้อย');
                $('#summary-form')[0].reset();
                location.reload();
            }
        });
    });
    // delete data;
    $('.btn-summary-delete').on('click', function () {
        var uid = $(this).attr('id');
        var status = confirm('ต้องการลบข้อมูลนี้จริงหรือไม่ ?');
        if (status) {
            $.ajax({
                url: '<?php echo site_url('delete-supervision-summary'); ?>',
                method: 'post',
                data: {id: uid},
                success: function (data) {
                    location.reload();
                }
            });
        }
    });
    // บันทึกระดับความคิดเห็น
    $('#data-table-ii').on('click', '.btn-level-opinion', function () {
        var uid = $(this).attr('id');
        $.ajax({
            url: '<?php echo site_url('push-ds-level-1'); ?>',
            method: 'post',
            data: {id: uid},
            dataType: "JSON",
            success: function (data) {
                $('#pid').val(data.id);
                $('h3.modal-title').text('ระดับความเห็นต่อการปฏิบัติ');
                $('#ds-level1-modal').modal('show');
            }
        });
    }
    );
</script>
<!---------------------------------------------------------------------------->
<?php $this->load->view('vichakarn/modals/supervision_destination_modal'); ?>
<?php $this->load->view('vichakarn/modals/supervision_destination_note'); ?>
<?php $this->load->view('vichakarn/modals/supervision_destination_note_detail_modal'); ?>
<?php $this->load->view('vichakarn/modals/ds_level1_modal'); ?>