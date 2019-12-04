<div class="panel panel-primary">
    <div class="panel-heading">ข้อมูลการจัดสรรงบประมาณสำหรับโรงเรียนที่ขอรับการสนับสนุน</div>
    <ul class="breadcrumb">
        <li><?php echo anchor(site_url(), "<i class='icon-home icon-large'></i> หน้าแรก"); ?></li>
        <li>ข้อมูลการจัดสรรงบประมาณ</li>
    </ul>
    <div class="panel-body">
        <div class="table-responsive">
            <table class="table table-hover table-striped table-bordered display" id="example">
                <thead>
                    <tr>
                        <th style="width:40px;">ที่</th>
                        <th class="no-sort" style="width:10%;">ปีงบประมาณ</th>
                        <th class="no-sort">ประเภทงบอุดหนุน</th>
                        <th class="no-sort">จำนวนเงิน</th>
                        <th class="no-sort">เอกสารอ้างอิง</th>
                        <th class="no-sort">หมายเหตุ</th>
                        <?php if ($this->session->userdata("status") == "ผู้ปฏิบัติงาน"): ?>
                            <th style="width:18%;" class="no-sort"></th>
                        <?php endif; ?>
                    </tr>
                </thead>
                <tbody>
                    <?php $row = 1; ?>
                    <?php foreach ($rs as $r): ?>
                        <tr>
                            <td style="text-align:center;"><?php echo $row; ?></td>
                            <td style="text-align:center;"><?php echo $r['loan_year']; ?></td>
                            <td><?php echo $r['loan_group'] ?></td>
                            <td><?php echo number_format($r['loan_amount'], 2, '.', ','); ?></td>
                            <td style="text-align:center;">
                                <?php if (file_exists('upload/' . $r['loan_document']) && !empty($r['loan_document'])): ?>
                                    <?php echo anchor(base_url() . 'upload/' . $r['loan_document'], 'เอกสาร', array('target' => '_blank')); ?>
                                <?php endif; ?>
                            </td>
                            <td><?php echo $r['loan_comment']; ?></td>
                            <td style="text-align:center;">
                                <button type="button" class="btn btn-info btn-ext-payment"><i class="icon-book"></i> ข้อมูล</button>
                               <!-- <a href="<?php echo site_url('loan-payment-detail_ext/' . $r['id']); ?>" class="btn btn-primary">DETAIL</a> -->
                                <?php if ($this->session->userdata("status") == "ผู้ปฏิบัติงาน"): ?>
                                <div class="btn-group">
                                    <button type="button" class="btn btn-warning btn-edit" id="<?php echo $r['id']; ?>"><i class="icon-pencil"></i> แก้ไข</button>
                                    <button type="button" class="btn btn-danger btn-delete" id="<?php echo $r['id']; ?>"><i class="icon-trash"></i> ลบ</button>
                                </div>
                                        <?php endif; ?>
                            </td>
                        </tr>
                        <?php $row++; ?>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

    <?php $this->load->view('layout/my_school_footer');?>
</div>
<!---------------------------------------------------------------------------->
<script>
    <?php
$tabName = "example";

$text = "ข้อมูลการจัดสรรงบประมาณสำหรับโรงเรียนที่ขอรับการสนับสนุน";
$title = $this->Echo_Text_Model->head_logo($text, $this->session->userdata('sch_id'));
$colStr = "0,1,2,3,5";
$btExArr = array();

$bt = array(
    'name' => 'add_topic',
    'title' => 'เพิ่มข้อมูล',
    'icon' => 'icon-plus',
    'class' => 'btn btn-primary btn-ext-loan-insert',
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
//    //
//        $("div#example_length.dataTables_length").append("&nbsp;<a href='<?php echo site_url('print-loan-management-external'); ?>' target='_blank' class='btn btn-default'><i class='icon-print'></i> พิมพ์</a>");
//    var status = "<?php echo $this->session->userdata("status"); ?>";
//    if (status == 'ผู้ปฏิบัติงาน') {
//        $("div#example_length.dataTables_length").append("&nbsp;<button class='btn btn-default btn-ext-loan-insert'><i class='icon-plus icon-large'></i> บันทึก</button>");
//    }
    $(".btn-ext-loan-insert").click(function () {
        $("#insert-form").trigger("reset");
        $("h3.modal-title").text("บันทึกข้อมูลการจัดสรรงบประมาณให้กับโรงเรียนที่ขอรับการสนับสนุน");
        $("#loan-management-ext-modal").modal("show");
    });
    // แก้ไขข้อมูล
    $("#example").on("click", ".btn-edit", function () {
        var uid = $(this).attr("id");
        $.ajax({
            url: '<?php echo site_url('update-loan-management-external'); ?>',
            method: "POST",
            data: {id: uid},
            dataType: "JSON",
            success: function (data) {
                $("#id").val(data.id);
                $('#inLoanYear').val(data.loan_year);
                $('#inLoanGroup').val(data.loan_group);
                $("#inLoanAmount").val(data.loan_amount);
                $('#inSchoolName').val(data.school_name);
                $('#inLoanComment').val(data.loan_comment);
                //
                $("h3.modal-title").text("ปรับปรุงข้อมูลการจัดสรรงบประมาณให้กับโรงเรียนที่ขอรับการสนับสนุน");
                $("#loan-management-ext-modal").modal("show");
            }
        });
    });

    // delete data;
    $('#example').on('click', '.btn-delete', function () {
        var uid = $(this).attr('id');
        var status = confirm('ต้องการลบข้อมูลนี้จริงหรือไม่ ?');
        if (status) {
            $.ajax({
                url: '<?php echo site_url('delete-loan-management-external'); ?>',
                method: 'post',
                data: {id: uid},
                success: function (data) {
                    location.reload();
                }
            });
        }
    });
    // รายการค่าใช้จ่าย
    $('#example').on('click', '.btn-ext-payment', function () {
        alert('กำลังพัฒนา');
    });
</script>
<?php $this->load->view("school_loan/loan_management_ext_modal"); ?>