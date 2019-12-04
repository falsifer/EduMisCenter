
<!------------------------------------------------------------------------------
|  Title        Supervision final
| ----------------------------------------------------------------------------
| Copyright	Edutech Co.,Ltd.
| Purpose       บันทึก/สรุปผลการนิเทศ
| Author	นายบัณฑิต ไชยดี
| Create Date   25 December 2018
| Last edit	-
| Comment	-
| --------------------------------------------------------------------------->
<div class="col-md-10 col-md-offset-1">
    <div class="panel panel-primary">
        <div class="panel-heading">บันทึก/สรุปผลการนิเทศ</div>
        <ul class="breadcrumb">
            <li><?php echo anchor(site_url(), "<i class='icon-home icon-large'></i> หน้าแรก"); ?></li>
            <li><a href="<?php echo site_url('supervision'); ?>">แผนงานและการดำเนินการนิเทศ</a></li>
            <li>บันทึก-สรุปผลฯ</li>
            <!-- Print data -->
            <span class="pull-right"><?php //echo anchor(current_url(), img('images/printer.png') . " พิมพ์ข้อมูล");   ?></span>
        </ul>
        <div class="panel-body">
            <div class="col-md-12" style="padding:15px;border:3px double #ddd;">
                <?php if (!empty($normal)): ?>
                    <!-- edit data -->
                    <?php if ($this->session->userdata('status') == 'ผู้ปฏิบัติงาน'): ?>
                        <form method="post" id="supervision-final-form">
                            <div class="row">
                                <div class="form-group col-md-8">
                                    <label class="control-label">ชื่องานหรือโครงการ (การนิเทศ)</label>
                                    <input type="text" name="inFinalProject" id="inFinalProject" class="form-control" value="<?php echo $normal['final_project']; ?>" required autofocus/>
                                </div>
                                <div class="col-md-4">
                                    <label class="control-label">ผู้นิเทศ</label>
                                    <div class="form-control-static"><?php echo $sp_name['supervision_name']; ?></div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-12">
                                    <div class="row-fluid">
                                        <label class="control-label">ขั้นตอนการนำนวัตกรรมไปใช้</label>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <div class="input-group">
                                                <div class="input-group-addon">1.</div>
                                                <input type="text" name="inFinalActivities1" id="inFinalActivities1" class="form-control" value="<?php echo $normal['final_activities_1']; ?>" />
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="input-group">
                                                <div class="input-group-addon">4.</div>
                                                <input type="text" name="inFinalActivities4" id="inFinalActivities4" class="form-control" value="<?php echo $normal['final_activities_4']; ?>" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <div class="input-group">
                                                <div class="input-group-addon">2.</div>
                                                <input type="text" name="inFinalActivities2" id="inFinalActivities2" class="form-control"  value="<?php echo $normal['final_activities_2']; ?>"/>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="input-group">
                                                <div class="input-group-addon">5.</div>
                                                <input type="text" name="inFinalActivities5" id="inFinalActivities5" class="form-control" value="<?php echo $normal['final_activities_5']; ?>" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <div class="input-group">
                                                <div class="input-group-addon">3.</div>
                                                <input type="text" name="inFinalActivities3" id="inFinalActivities3" class="form-control" value="<?php echo $normal['final_activities_3']; ?>" />
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="input-group">
                                                <div class="input-group-addon">6.</div>
                                                <input type="text" name="inFinalActivities6" id="inFinalActivities6" class="form-control" value="<?php echo $normal['final_activities_6']; ?>" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col-md-12">
                                    <div class="row-fluid">
                                        <label class="control-label">วัตถุประสงค์</label>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <div class="input-group">
                                                <div class="input-group-addon">1.</div>
                                                <input type="text" name="inFinalPurpose1" id="inFinalPurpose1" class="form-control" value="<?php echo $normal['final_purpose_1']; ?>" />
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="input-group">
                                                <div class="input-group-addon">4.</div>
                                                <input type="text" name="inFinalPurpose4" id="inFinalPurpose4" class="form-control" value="<?php echo $normal['final_purpose_4']; ?>" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <div class="input-group">
                                                <div class="input-group-addon">2.</div>
                                                <input type="text" name="inFinalPurpose2" id="inFinalPurpose2" class="form-control" value="<?php echo $normal['final_purpose_2']; ?>" />
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="input-group">
                                                <div class="input-group-addon">5.</div>
                                                <input type="text" name="inFinalPurpose5" id="inFinalPurpose5" class="form-control" value="<?php echo $normal['final_purpose_5']; ?>" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <div class="input-group">
                                                <div class="input-group-addon">3.</div>
                                                <input type="text" name="inFinalPurpose3" id="inFinalPurpose3" class="form-control"  value="<?php echo $normal['final_purpose_3']; ?>"/>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="input-group">
                                                <div class="input-group-addon">6.</div>
                                                <input type="text" name="inFinalPurpose6" id="inFinalPurpose6" class="form-control" value="<?php echo $normal['final_purpose_6']; ?>" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12 form-group">
                                    <center>
                                        <button type="submit" class="btn btn-warning btn-final-edit" id="<?php echo $normal['schedule_detail_id'] ?>"><i class="icon-pencil"></i> แก้ไข</button>
                                        <button type="button" class="btn btn-danger btn-final-delete" id="<?php echo $normal['schedule_detail_id'] ?>"><i class="icon-trash"></i> ลบ</button>
                                    </center>
                                </div>
                            </div>
                            <input type="hidden" name="schedule_detail_id" value="<?php echo $normal['schedule_detail_id']; ?>" />
                            <input type="hidden" name="status" value="ปรับปรุงข้อมูล" />
                        </form>                        
                    <?php else: ?>
                        <!-- ผู้ใช้งานทั่วไป -->

                    <?php endif; ?>
                <?php else: ?>
                    <!-- add data -->
                    <?php if ($this->session->userdata('status') == 'ผู้ปฏิบัติงาน'): ?>
                        <form method="post" id="supervision-final-form">
                            <div class="row">
                                <div class="form-group col-md-8">
                                    <label class="control-label">ชื่องานหรือโครงการ (การนิเทศ)</label>
                                    <input type="text" name="inFinalProject" id="inFinalProject" class="form-control" required autofocus/>
                                </div>
                                <div class="col-md-4">
                                    <label class="control-lael">ผู้นิเทศ</label>
                                    <div class="form-control-static"><?php echo $sp_name['supervision_name']; ?></div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-12">
                                    <div class="row-fluid">
                                        <label class="control-label">ขั้นตอนการนำนวัตกรรมไปใช้</label>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <div class="input-group">
                                                <div class="input-group-addon">1.</div>
                                                <input type="text" name="inFinalActivities1" id="inFinalActivities1" class="form-control" />
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="input-group">
                                                <div class="input-group-addon">4.</div>
                                                <input type="text" name="inFinalActivities4" id="inFinalActivities4" class="form-control" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <div class="input-group">
                                                <div class="input-group-addon">2.</div>
                                                <input type="text" name="inFinalActivities2" id="inFinalActivities2" class="form-control" />
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="input-group">
                                                <div class="input-group-addon">5.</div>
                                                <input type="text" name="inFinalActivities5" id="inFinalActivities5" class="form-control" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <div class="input-group">
                                                <div class="input-group-addon">3.</div>
                                                <input type="text" name="inFinalActivities3" id="inFinalActivities3" class="form-control" />
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="input-group">
                                                <div class="input-group-addon">6.</div>
                                                <input type="text" name="inFinalActivities6" id="inFinalActivities6" class="form-control" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col-md-12">
                                    <div class="row-fluid">
                                        <label class="control-label">วัตถุประสงค์</label>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <div class="input-group">
                                                <div class="input-group-addon">1.</div>
                                                <input type="text" name="inFinalPurpose1" id="inFinalPurpose1" class="form-control" />
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="input-group">
                                                <div class="input-group-addon">4.</div>
                                                <input type="text" name="inFinalPurpose4" id="inFinalPurpose4" class="form-control" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <div class="input-group">
                                                <div class="input-group-addon">2.</div>
                                                <input type="text" name="inFinalPurpose2" id="inFinalPurpose2" class="form-control" />
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="input-group">
                                                <div class="input-group-addon">5.</div>
                                                <input type="text" name="inFinalPurpose5" id="inFinalPurpose5" class="form-control" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <div class="input-group">
                                                <div class="input-group-addon">3.</div>
                                                <input type="text" name="inFinalPurpose3" id="inFinalPurpose3" class="form-control" />
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="input-group">
                                                <div class="input-group-addon">6.</div>
                                                <input type="text" name="inFinalPurpose6" id="inFinalPurpose6" class="form-control" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12 form-group">
                                    <center><button type="submit" class="btn btn-success"><i class="icon-save"></i> บันทึก</button></center>
                                </div>
                            </div>
                            <input type="hidden" name="schedule_detail_id" value="<?php echo $this->uri->segment(2); ?>" />
                            <input type="hidden" name="status" value="" />
                        </form>
                    <?php endif; ?>
                <?php endif; ?>
            </div>

            <?php if ($normal): ?>
                <div class="col-md-12" style="padding:15px;border:3px double #ddd;margin-top:10px;margin-bottom:10px;">
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered table-striped" id="example">
                            <thead>
                                <tr>
                                    <th class="no-sort">ที่</th>
                                    <th class="no-sort">วัน เดือน ปี</th>
                                    <th class="no-sort">ผู้รับการนิเทศ</th>
                                    <th class="no-sort">กิจกรรม/วิธีการ/สื่อที่ใช้</th>
                                    <th class="no-sort">ผลที่เกิดขึ้น/ข้อมูลที่ปรากฎ</th>
                                    <?php if ($this->session->userdata('status') == 'ผู้ปฏิบัติงาน'): ?>
                                        <th class="no-sort" style="width:25%;"></th>
                                    <?php endif; ?>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $row = 1; ?>
                                <?php foreach ($rs as $r): ?>
                                    <tr>
                                        <td style="text-align:center;"><?php echo $row; ?></td>
                                        <td><?php echo datethai($r['supervision_date']); ?></td>
                                        <td><?php echo $r['supervision_target']; ?></td>
                                        <td><?php echo $r['supervision_media']; ?></td>
                                        <td><?php echo $r['supervision_feedback']; ?></td>
                                        <?php if ($this->session->userdata('status') == 'ผู้ปฏิบัติงาน'): ?>
                                            <td style="text-align:center;">
                                                <div class="btn-group">
                                                    <button type="button" class="col-md-6 btn btn-warning btn-final-detail-edit" id="<?php echo $r['id']; ?>"><i class="icon-pencil"></i> แก้ไข</button>
                                                    <button type="button" class="col-md-6 btn btn-danger btn-final-detail-delete" id="<?php echo $r['id']; ?>"><i class="icon-trash"></i> ลบ</button>
                                                </div>
                                            </td>
                                        <?php endif; ?>
                                    </tr>
                                    <?php $row++; ?>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            <?php endif; ?>

            <!-- ความเห็นของผู้นิเทศ -->
            <?php if (!empty($normal)): ?>
                <?php if (!empty($supervision_opinion)): ?>
                    <?php if ($this->session->userdata('status') == 'ผู้ปฏิบัติงาน'): ?>
                        <form method="post" id="final-opinion-form">
                            <div class="row">
                                <div class="form-group col-md-12">
                                    <label class="control-label">ความเห็นของผู้นิเทศ</label>
                                    <textarea class="form-control" name="inSupervisionOpinion" id="inSupervisionOpinion" style="height:160px;border:3px double #ddd;"><?php echo $supervision_opinion['supervision_opinion'] ?></textarea>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-12">
                                    <label class="control-label">สรุปผลการนิเทศ</label>
                                    <textarea class="form-control" name="inSupervisionSummary" id="inSupervisionSummary" style="height:160px;border:3px double #ddd;"><?php echo $supervision_opinion['supervision_summary'] ?></textarea>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <center> 
                                        <button type="submit" class="btn btn-success"><i class="icon-save"></i> บันทึก</button>
                                        <button type="button" class="btn btn-danger btn-final-opinion-delete" id="<?php echo $supervision_opinion['schedule_detail_id']; ?>"><i class="icon-trash"></i> ลบ</button>
                                    </center>
                                </div>
                            </div>
                            <input type="hidden" name="schedule_detail_id" value="<?php echo $supervision_opinion['schedule_detail_id']; ?>" />
                            <input type="hidden" name="status" value="ปรับปรุงข้อมูล" />
                        </form>
                    <?php else: ?>
                        <div class="row">
                            <div class="col-md-12">
                                <?php echo $normal['supervision_opinion']; ?>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <?php echo $normal['supervision_symmary']; ?>
                            </div>
                        </div>
                    <?php endif; ?>
                <?php else: ?>
                    <?php if ($this->session->userdata('status') == 'ผู้ปฏิบัติงาน'): ?>
                        <form method="post" id="final-opinion-form">
                            <div class="row">
                                <div class="form-group col-md-12">
                                    <label class="control-label">ความเห็นของผู้นิเทศ</label>
                                    <textarea class="form-control" name="inSupervisionOpinion" id="inSupervisionOpinion" style="height:160px;border:3px double #eee;" placeholder="คลิกเพื่อพิมพ์..." required></textarea>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-12">
                                    <label class="control-label">สรุปผลการนิเทศ</label>
                                    <textarea class="form-control" name="inSupervisionSummary" id="inSupervisionSummary" style="height:160px;border:3px double #ddd;" placeholder="คลิกเพื่อพิมพ์..." required></textarea>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <center> <button type="submit" class="btn btn-success"><i class="icon-save"></i> บันทึก</button></center>
                                </div>
                            </div>
                            <input type="hidden" name="schedule_detail_id" value="<?php echo $this->uri->segment(2); ?>" />
                            <input type="hidden" name="status" value="" />
                        </form>
                    <?php endif; ?>
                <?php endif; ?>
            <?php endif; ?>

        </div><!-- box-body -->

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
    $('.sorting_asc').removeClass('sorting_asc');
    // Tool tips;
    $(function () {
        $('[data-toggle="tooltip"]').tooltip();
    });
    //
    var status = '<?php echo $this->session->userdata('status'); ?>';
    if (status == 'ผู้ปฏิบัติงาน') {
        $('div#example_length.dataTables_length').append("&nbsp;&nbsp;<a href='#' class='btn btn-primary btn-supervision-final-detail'><i class='icon-plus icon-large'></i> เพิ่มข้อมูล</a>");
    }
    //
    $('#supervision-final-form').on('submit', function (e) {
        e.preventDefault();
        $.ajax({
            url: '<?php echo site_url('insert-supervision-final'); ?>',
            method: 'post',
            data: $('#supervision-final-form').serialize(),
            success: function (data) {
                alert('บันทึกข้อมูลเรียบร้อย...');
                $('#supervision-final-form')[0].reset();
                location.reload();
            }
        });
    });

    // .btn-final-delete;
    $('.btn-final-delete').on('click', function () {
        var uid = $(this).attr('id');
        var status = confirm('ต้องการลบข้อมูลนี้จริงหรือไม่ ?');
        if (status) {
            $.ajax({
                url: '<?php echo site_url('delete-supervision-final'); ?>',
                method: 'post',
                data: {id: uid},
                success: function (data) {
                    location.reload();
                }
            });
        }
    });
    // Insert ความเห็นและสรุปผล ของผู้นิเทศ
    $('#final-opinion-form').on('submit', function (e) {
        e.preventDefault();
        $.ajax({
            url: '<?php echo site_url('insert-supervision-final-opinion'); ?>',
            method: 'post',
            data: $('#final-opinion-form').serialize(),
            success: function (data) {
                alert('บันทึกข้อมูลเรียบร้อย...');
                $('#final-opinion-form')[0].reset();
                location.reload();
            }
        });
    });
    // delete data;
    $('.btn-final-opinion-delete').on('click', function () {
        var uid = $(this).attr('id');
        var status = confirm('ต้องการลบข้อมูลนี้จริงหรือไม่ ?');
        if (status) {
            $.ajax({
                url: '<?php echo site_url('delete-supervision-final-opinion'); ?>',
                method: 'post',
                data: {id: uid},
                success: function (data) {
                    location.reload();
                }
            });
        }
    });
    // Final detail (ตารางแสดงข้อมูล)
    $('.btn-supervision-final-detail').on('click', function () {
        $('h3.modal-title').text('บันทึกข้อมูลตารางสรุปผลการนิเทศ');
        $('#supervision-final-detail-modal').modal('show');
    });

    // btn-final-detail-edit;
    $('#example').on('click', '.btn-final-detail-edit', function () {
        var uid = $(this).attr('id');
        $.ajax({
            url: '<?php echo site_url('update-supervision-final-detail'); ?>',
            method: 'post',
            data: {id: uid},
            dataType: 'json',
            success: function (data) {
                $('#id').val(data.id);
                $('#inSupervisionDate').val(data.supervision_date);
                $('#inSupervisionTarget').val(data.supervision_target);
                $('#inSupervisionMedia').val(data.supervision_media);
                $('#inSupervisionFeedback').val(data.supervision_feedback);
                //
                $('h3.modal-title').text('แก้ไขข้อมูลตารางสรุปผลการนิเทศ');
                $('#supervision-final-detail-modal').modal('show');
            }
        });
    });
    // supervision_final_detail_delete
    $('#example').on('click', '.btn-final-detail-delete', function () {
        var uid = $(this).attr('id');
        var status = confirm('ต้องการลบข้อมูลนี้จริงหรือไม่ ?');
        if (status) {
            $.ajax({
                url: '<?php echo site_url('delete-supervision-final-delete'); ?>',
                method: 'post',
                data: {id: uid},
                success: function (data) {
                    location.reload();
                }
            });
        }

    });
</script>
<!---------------------------------------------------------------------------->
<?php $this->load->view('vichakarn/modals/supervision_final_detail_modal'); ?>