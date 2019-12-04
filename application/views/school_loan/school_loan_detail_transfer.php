<div class="panel panel-primary">
    <div class="panel-heading">รายละเอียดการจัดสรรงบประมาณแต่ละรายการ</div>
    <ul class="breadcrumb">
        <li><?php echo anchor(site_url(), "<i class='icon-home icon-large'></i> หน้าแรก"); ?></li>
        <li><a href="<?php echo site_url('school-loan'); ?>">รายชื่อโรงเรียนที่จัดสรรงบประมาณ</a></li>
        <li><a href="<?php echo site_url('school-loan-detail/' . $this->uri->segment(2)); ?>">รายละเอียดการจัดสรรงบประมาณ</a></li>
        <li>รายละเอียด</li>
    </ul>
    <div class="panel-body">

        <div class="well">
            <h4>
                รายการ : <?php echo $define['loan_category'] ?>/<?php echo $define['loan_type'] ?>/<?php echo $define['loan_define'] ?>
                <?php echo nbs(3); ?>
                งบประมาณตั้งไว้:  <?php echo number_format($define['loan_begin'], 2, '.', ','); ?> บาท
            </h4>
        </div>

        <div class="table-responsive">
            <table class="table table-hover table-striped table-bordered display" id="example">
                <thead>
                    <tr>
                        <th style="width:40px;">ที่</th>
                        <th class="no-sort">ไตรมาสที่</th>
                        <th class="no-sort">วันที่โอนงบประมาณ</th>
                        <th class="no-sort">จำนวนเงินที่โอน (บาท)</th>
                        <th class="no-sort">งบประมาณคงเหลือ (บาท)</th>
                        <?php if ($this->session->userdata("status") == "ผู้ปฏิบัติงาน"): ?>
                            <th style="width:18%;border-right: none;" class="no-sort"></th>
                        <?php endif; ?>
                    </tr>
                </thead>
                <tbody>
                    <?php $row = 1; ?>
                    <?php $total_loan_transfer = 0; ?>
                    <?php foreach ($rs as $r): ?>
                        <?php $total_loan_transfer = $total_loan_transfer + $r['loan_transfer']; ?>
                        <tr>
                            <td style="text-align:center;"><?php echo $row; ?></td>
                            <td style="text-align:center;"><?php echo $r['loan_term']; ?></td>
                            <td style=""><?php echo datethai($r['loan_date']) ?></td>
                            <td style="text-align:right;"><?php echo number_format($r['loan_transfer'], 2, '.', ',') ?></td>
                            <td style="text-align:right;"><?php echo number_format($r['loan_begin'] - $total_loan_transfer, 2, '.', ',') ?></td>
                            <?php if ($this->session->userdata("status") == "ผู้ปฏิบัติงาน"): ?>
                                <td style="text-align:center;border-right:none;">
                                    <div class="btn-group">
                                        <button type="button" class="col-md-6 btn btn-warning btn-edit" id="<?php echo $r['id']; ?>"><i class="icon-pencil icon-large"></i> แก้ไข</button>
                                        <button type="button" class="col-md-6 btn btn-danger btn-delete" id="<?php echo $r['id']; ?>"><i class="icon-trash icon-large"></i> ลบ</button>
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

    <?php $this->load->view('layout/my_school_footer'); ?>
</div>
<!---------------------------------------------------------------------------->
<script>
<?php
$tabName = "example";

$text = "รายละเอียดการจัดสรรงบประมาณแต่ละรายการ รายการ : ". $define['loan_category'] ."/". $define['loan_type'] ."<p>".$define['loan_define']."</p><p>งบประมาณตั้งไว้: ".number_format($define['loan_begin'], 2, '.', ',')." บาท</p>";
$title = $this->Echo_Text_Model->head_logo($text, $this->session->userdata('sch_id'));
$colStr = "0,1,2,3,4";
$btExArr = array();

$bt = array(
    'name' => 'add_topic',
    'title' => 'เพิ่มข้อมูล',
    'icon' => 'icon-plus',
    'class' => 'btn btn-primary  btn-add',
    'fn' => ''
);
array_push($btExArr, $bt);

load_datatable($tabName, $btExArr, $title, $colStr);
?>

    $('.table-responsive').on('show.bs.dropdown', function () {
        $('.table-responsive').css("overflow", "inherit");
    });

    $('.table-responsive').on('hide.bs.dropdown', function () {
        $('.table-responsive').css("overflow", "auto");
    });
    //
    $('.btn-add').click(function () {
        $('#insert-form').trigger('reset');
        $('.modal-title').text('บันทึกการจัดสรรงบประมาณ');
        $('.modal-dialog').css('min-width', '50%');
        $('#loan-detail-transfer-modal').modal('show');
    });
    // edit data
    $('#example').on('click', '.btn-edit', function () {
        var uid = $(this).attr('id');
        $.ajax({
            url: '<?php echo site_url('update-loan-detail-transfer'); ?>',
            method: 'POST',
            data: {id: uid},
            dataType: 'JSON',
            success: function (data) {
                $('#id').val(data.id);
                $('#inLoanTerm').val(data.loan_term);
                $('#inLoanDate').val(data.loan_date);
                $('#inLoanTransfer').val(data.loan_transfer);
                $('.modal-title').text('บันทึกการจัดสรรงบประมาณ');
                $('.modal-dialog').css('min-width', '50%');
                $('#loan-detail-transfer-modal').modal('show');
            }
        });
    });
    // delete data
    $('#example').on('click', '.btn-delete', function () {
        var uid = $(this).attr('id');
        var status = confirm('ต้องการลบข้อมูลนี้จริงหรือไม่ ?');
        if (status) {
            $.ajax({
                url: '<?php echo site_url('delete-loan-detail-transfer'); ?>',
                method: 'POST',
                data: {id: uid},
                success: function () {
                    location.reload();
                }
            });
        }
    });
</script>
<!---------------------------------------------------------------------------->
<?php $this->load->view('school_loan/modals/loan_detail_transfer_modal'); ?>