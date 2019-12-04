<!------------------------------------------------------------------------------
|  Title        superision_destination_level_2
| ----------------------------------------------------------------------------
| Copyright	Edutech Co.,Ltd.
| Purpose       แสดงแบบสอบถามระดับที่ 2 
| Author	นายบัณฑิต ไชยดี
| Create Date   31/12/2018
| Last edit	-
| Comment	-
| --------------------------------------------------------------------------->
<div class="panel panel-primary">
    <div class="panel-heading">แบบนิเทศการจัดการเรียนรู้ระดับที่ 2 ในหัวข้อหลัก <?php echo $l1['question_level1']; ?></div>
    <ul class="breadcrumb">
        <li><?php echo anchor(site_url(), "<i class='icon-home icon-large'></i> หน้าแรก"); ?></li>
        <li><?php echo anchor('supervision-destination-note/' . $this->uri->segment(2), 'แบบนิเทศระดับที่ 1'); ?></li>
        <li>แบบนิเทศระดับที่ 2</li>
    </ul>
    <div class="panel-body">
        <div class="table-responsive">
            <table class="table table-hover table-striped table-bordered display" id="example" style="width:100%;">
                <thead>
                    <tr>
                        <th style="width:40px;" rowspan="2">ที่</th>
                        <th class="no-sort" rowspan="2">กิจกรรมการนิเทศ</th>
                        <th class="no-sort"  colspan="5">ระดับความคิดเห็นต่อการประเมิน</th>
                        <?php if ($this->session->userdata("status") == "ผู้ปฏิบัติงาน"): ?>
                            <th style="width:15%;border-right: none;" class="no-sort" rowspan="2"></th>
                        <?php endif; ?>
                    </tr>
                    <tr>
                        <th class="no-sort">5</th>
                        <th class="no-sort">4</th>
                        <th class="no-sort">3</th>
                        <th class="no-sort">2</th>
                        <th class="no-sort">1</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $row = 1; ?>
                    <?php foreach ($rs as $r): ?>
                        <tr>
                            <td style="text-align:center;"><?php echo $row; ?></td>
                            <td><?php echo anchor('', $r['question_level2']); ?></td>
                            <!-- Show level iii -->
                            <?php $level_iii = $this->My_model->get_where_order('tb_question_level3', array("level2_id" => $r['id']), 'id asc'); ?>
                            <?php if ($level_iii != ''): ?>
                            <td colspan="5" style="text-align:center;">[ คลิกปุ่ม <u>ความคิดเห็น</u> เพื่อให้คะแนน ] --></td>
                            <td style="text-align:center;"><a href="<?php echo site_url('supervision-destination-note-level-3/'.$this->uri->segment(2).'/'.$this->uri->segment(3).'/'.$r['id']); ?>" class="btn btn-default">ความคิดเห็น</a></td>
                            <?php else: ?>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            <?php endif; ?>
                        </tr>
                        <?php $row++; ?>
                    <?php endforeach; ?>
                </tbody>
            </table>
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
    $('div#example_length.dataTables_length').append("&nbsp;&nbsp;<a href='#' class='btn btn-default btn-print'><i class='icon-print icon-large'></i> พิมพ์</a>");
    //
    var status = '<?php echo $this->session->userdata('status'); ?>';
    if (status == 'ผู้ปฏิบัติงาน') {
        $('div#example_length.dataTables_length').append("&nbsp;&nbsp;<a href='#' class='btn btn-default btn-insert'><i class='icon-plus icon-large'></i> บันทึก</a>");
    }
    //
    $('.btn-insert').click(function () {
        $('#insert-form').trigger('reset');
        $('h3.modal-title').text('');
        $('#hr-08-modal').modal('show');
    });
    // edit data;
    $('#example').on('click', '.btn-edit', function () {
        var uid = $(this).attr('id');
        $.ajax({
            url: '<?php echo site_url(''); ?>',
            method: 'post',
            data: {id: uid},
            dataType: 'json',
            success: function (data) {
                $('#id').val(data.id);

                //
                $('h3.modal-title').text('');
                $('#-modal').modal('show');
            }
        });
    });
    // edit data;
    $('#example').on('click', '.btn-delete', function () {
        var uid = $(this).attr('id');
        var status = confirm('ต้องการลบข้อมูลนี้จริงหรือไม่ ?');
        if (status) {
            $.ajax({
                url: '<?php echo site_url(''); ?>',
                method: 'post',
                data: {id: uid},
                success: function (data) {

                }
            });
        }
    });
</script>
<!---------------------------------------------------------------------------->