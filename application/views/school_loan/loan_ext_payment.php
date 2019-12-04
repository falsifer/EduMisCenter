<div class="panel panel-primary">
    <div class="panel-heading">รายการเบิกจ่ายในโครงการขอรับการสนับสนุน</div>
    <ul class="breadcrumb">
        <li><?php echo anchor(site_url(), "<i class='icon-home icon-large'></i> หน้าแรก"); ?></li>
        <li><a href="<?= site_url('loan-management-external'); ?>">ข้อมูลการจัดสรรงบประมาณ</a></li>
        <li>รายละเอียด</li>
    </ul>
    <div class="panel-body">
        <div class="row" style="margin-bottom:10px;">
            <div class="col-md-12">
                <h4><?= $project['ext_name']; ?></h4>
            </div>
        </div>
        <div class="table-responsive">
            <table class="table table-hover table-striped table-bordered display" id="example" style="width:100%;">
                <thead>
                    <tr>
                        <th style="width:40px;">ที่</th>
                        <th class="no-sort">วัน เดือน ปี</th>
                        <th class="no-sort">รายการ</th>
                        <th class="no-sort">จำนวน</th>
                        <th class="no-sort">ราคา/หน่วย</th>
                        <th class="no-sort">เป็นเงิน</th>
                        <th class="no-sort">หมายเหตุ</th>
                        <?php if ($this->session->userdata("status") == "ผู้ปฏิบัติงาน"): ?>
                            <th style="width:13%;border-right: none;" class="no-sort"></th>
                        <?php endif; ?>
                    </tr>
                </thead>
                <tbody>
                    <?php $row = 1; ?>
                    <?php $total_loan = 0; ?>
                    <?php foreach ($rs as $r): ?>
                        <tr>
                            <td style="text-align:center;"><?php echo $row; ?></td>
                            <td><?php echo shortdate($r['payment_date']); ?></td>
                            <td><?= $r['payment_title'] ?></td>
                            <td><?= number_format($r['payment_amount'], 2, '.', ',') ?></td>
                            <td><?= number_format($r['payment_cost'], 2, '.', ',') ?></td>
                            <td><?= number_format($r['payment_total'], 2, '.', ',') ?></td>
                            <td><?= $r['payment_comment'] ?></td>
                            <?php if ($this->session->userdata("status") == "ผู้ปฏิบัติงาน"): ?>
                                <td style="text-align:center;border-right:none;">
                                    <div class="btn-group">
                                    <button type="button" class="col-nd-6 btn btn-warning btn-edit" id="<?php echo $r['payment_id']; ?>"><i class="icon-pencil icon-large"></i> แก้ไข</button>
                                    <button type="button" class="col-nd-6 btn btn-danger btn-delete" id="<?php echo $r['payment_id']; ?>"><i class="icon-trash icon-large"></i> ลบ</button>
                                </div>
                                    </td>
                            <?php endif; ?>
                        </tr>
                        <?php $row++; ?>
                        <?php $total_loan = $total_loan + $r['payment_total']; ?>
                    <?php endforeach; ?>
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="5" style="text-align:center;">รวมเป็นเงิน</td>
                        <td><?= number_format($total_loan, 2, '.', ',') ?></td>
                        <?php if ($this->session->userdata("status") == "ผู้ปฏิบัติงาน"): ?>
                            <td colspan="2"></td>
                        <?php else: ?>
                            <td></td>
                        <?php endif; ?>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>

    <?php $this->load->view('layout/my_school_footer');?>
</div>
<!---------------------------------------------------------------------------->
<script>
        <?php
$tabName = "example";

$text = "รายการเบิกจ่ายในโครงการขอรับการสนับสนุน".$project['ext_name'];
$title = $this->Echo_Text_Model->head_logo($text, $this->session->userdata('sch_id'));
$colStr = "0,1,2,3,4,5,6";
$btExArr = array();

$bt = array(
    'name' => 'add_topic',
    'title' => 'เพิ่มข้อมูล',
    'icon' => 'icon-plus',
    'class' => 'btn btn-primary btn-add',
    'fn' => ''
);
array_push($btExArr, $bt);

load_datatable($tabName, $btExArr, $title, $colStr);
?>
//    $('#example').DataTable({
//        "responsive": true,
//        "stateSave": true,
//        "bSort": false,
//        "ordering": true,
//        columnDefs: [{
//                orderable: false,
//                targets: "no-sort"
//            }],
//        "language": {
//            "lengthMenu": "แสดง _MENU_ แถวต่อหน้า",
//            "zeroRecords": "## ไม่มีข้อมูล ##",
//            "info": "แสดงหน้าที่ _PAGE_ ในทั้งหมด _PAGES_ หน้า",
//            "infoEmpty": "",
//            "infoFiltered": "",
//            "sSearch": "ระบุคำค้น",
//            "sPaginationType": "full_numbers"
//        }
//    });
//    $('.sorting_asc').removeClass('sorting_asc');
//    // Tool tips;
//    $(function () {
//        $('[data-toggle="tooltip"]').tooltip();
//    });
    // สร้างปุ่ม
//        $('div#example_length.dataTables_length').append("&nbsp;&nbsp;<a href='<?= site_url('print-payment-external/'.$this->uri->segment(2));?>' class='btn btn-primary' target='_blank'><i class='icon-print'></i> พิมพ์</a>");
//    var status = '<?= $this->session->userdata('status'); ?>';
//    if (status == 'ผู้ปฏิบัติงาน') {
//        $('div#example_length.dataTables_length').append("&nbsp;&nbsp;<button class='btn btn-primary btn-add'><i class='icon-plus'></i> บันทึก</button>");
//    }
    //
//    $('.table-responsive').on('show.bs.dropdown', function () {
//        $('.table-responsive').css("overflow", "inherit");
//    });
//
//    $('.table-responsive').on('hide.bs.dropdown', function () {
//        $('.table-responsive').css("overflow", "auto");
//    });
    //
    $('.btn-add').on('click', function () {
        $('#insert-form').trigger('reset');
        $('h3.modal-title').text('บันทึกข้อมูลค่าใช้จ่ายในโครงการ');
        $('.modal-dialog').css('width', '50%');
        $('#loan-ext-payment-modal').modal('show');
    });
    // update data
    $('#example').on('click', '.btn-edit', function () {
        var uid = $(this).attr('id');
        $.ajax({
            url: '<?= site_url('update-payment-external'); ?>',
            method: 'POST',
            data: {id: uid},
            dataType: 'JSON',
            success: function (data) {
                $('#id').val(data.id);
                $('#inPaymentDate').val(data.payment_date);
                $('#inPaymentTitle').val(data.payment_title);
                $('#inPaymentAmount').val(data.payment_amount);
                $('#inUnitId').val(data.unit_id);
                $('#inPaymentCost').val(data.payment_cost);
                $('#inPaymentComment').val(data.payment_comment);
                $('h3.modal-title').text('ปรับปรุงข้อมูลค่าใช้จ่ายในโครงการ');
                $('.modal-dialog').css('width', '50%');
                $('#loan-ext-payment-modal').modal('show');
            }
        });
    });
    // delete data
    $('#example').on('click', '.btn-delete', function () {
        var uid = $(this).attr('id');
        var status = confirm('ต้องการลบข้อมูลนี้จริงหรือไม่ ?');
        if (status) {
            $.ajax({
                url: '<?= site_url('delete-payment-external'); ?>',
                method: 'POST',
                data: {id: uid},
                success: function () {
                    location.reload();
                }
            });
        }
    });
</script>
<?php $this->load->view('school_loan/modals/loan_ext_payment_modal'); ?>