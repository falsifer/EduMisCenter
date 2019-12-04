<!------------------------------------------------------------------------------
|  Title    supervison destination level 3
| ----------------------------------------------------------------------------
| Copyright	Edutech Co.,Ltd.
| Purpose       แบบนิเทศระดับที่ 3
| Author	นายบัณฑิต ไชยดี
| Create Date
| Last edit	-
| Comment	-
| --------------------------------------------------------------------------->
<div class="panel panel-primary">
    <div class="panel-heading">แบบนิเทศการจัดการเรียนรู้ระดับที่ 3 (ระดับที่ 2 :)</div>
    <ul class="breadcrumb">
        <li><?php echo anchor(site_url(), "<i class='icon-home icon-large'></i> หน้าแรก"); ?></li>
        <li><?php echo anchor("supervision-destination-note-level-2/" . $this->uri->segment(2) . '/' . $this->uri->segment(3), "แบบนิเทศฯ ระดับที่ 2"); ?></li>
        <li>แบบนิเทศฯ ระดับที่ 3</li>
    </ul>
    <div class="panel-body">
        <div class="table-responsive">
            <table class="table table-hover table-striped table-bordered display" id="example" style="width:100%;">
                <thead>
                    <tr>
                        <th style="width:40px;" rowspan="2">ที่</th>
                        <th class="no-sort" rowspan="2">กิจกรรมการนิเทศ</th>
                        <th class="no-sort" colspan="5">ระดับความคิดเห็นต่อการประเมิน</th>
                        <?php if ($this->session->userdata("status") == "ผู้ปฏิบัติงาน"): ?>
                            <th style="width:13%;" class="no-sort" rowspan="2"></th>
                        <?php endif; ?>
                    </tr>
                    <tr>
                        <th class="no-sort" style="width:4%;">5</th>
                        <th class="no-sort" style="width:4%;">4</th>
                        <th class="no-sort" style="width:4%;">3</th>
                        <th class="no-sort" style="width:4%;">2</th>
                        <th class="no-sort" style="width:4%;">1</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $row = 1; ?>
                    <?php foreach ($rs as $r): ?>
                        <tr>
                            <td style="text-align:center;"><?php echo $row; ?></td>
                            <td><?php echo $r['question_level3']; ?></td>
                            <td style="text-align:center;"><?php echo $r['question_score'] == 5 ? img('images/checked.png') : ''; ?></td>
                            <td style="text-align:center;"><?php echo $r['question_score'] == 4 ? img('images/checked.png') : ''; ?></td>
                            <td style="text-align:center;"><?php echo $r['question_score'] == 3 ? img('images/checked.png') : ''; ?></td>
                            <td style="text-align:center;"><?php echo $r['question_score'] == 2 ? img('images/checked.png') : ''; ?></td>
                            <td style="text-align:center;"><?php echo $r['question_score'] == 1 ? img('images/checked.png') : ''; ?></td>
                            <?php if ($this->session->userdata("status") == "ผู้ปฏิบัติงาน"): ?>
                                <td style="text-align:left;border-right:none;">
                                    <button type="button" class="btn btn-default btn-opinion" id="<?php echo $r['id']; ?>">บันทึก</button>
                                    <!-- กรณีช่อง question_score มีการให้คะแนนจึงปรากฎปุ่มนี้ -->
                                    <?php if ($r['question_score'] != 0): ?>
                                        <button type="button" class="btn btn-default btn-cancel" id="<?php echo $r['id']; ?>">ยกเลิก</button>
                                    <?php endif; ?>
                                </td>
                            <?php endif; ?>
                        </tr>
                        <?php $row++; ?>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <div class="row">
            <div class="col-md-12">
                <center><h3><?php echo $sum_score['question_score'] != 0 ? 'ระดับคะแนน ' . $sum_score['question_score'] : ''; ?></h3></center>
            </div>
        </div>

    </div>

    <?php $this->load->view('layout/my_school_footer'); ?>
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
    $('#example').on('click', '.btn-opinion', function () {
        var uid = $(this).attr('id');
        $.ajax({
            url: '<?php echo site_url('define-supervision-level3-score'); ?>',
            method: 'post',
            data: {id: uid},
            dataType: 'json',
            success: function (data) {
                $('#id').val(data.id);
                //
                $('h3.modal-title').text('ระดับคะแนนที่ประเมิน');
                $('#supervision-destination-level-3-modal').modal('show');
            }
        });
    });
    // ยกเลิกระดับคะแนน
    $('#example').on('click', '.btn-cancel', function () {
        var uid = $(this).attr('id');
        var status = confirm('คุณต้องการยกเลิกการให้คะแนนในหัวข้อนี้จริงหรือไม่ ?');
        if (status) {
            $.ajax({
                url: '<?php echo site_url('cancel-supervision-level3-score'); ?>',
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
<?php $this->load->view('vichakarn/modals/supervision_destination_level_3_modal'); ?>