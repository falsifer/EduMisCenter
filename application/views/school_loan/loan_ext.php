<div class="panel panel-primary">
    <div class="panel-heading">ข้อมูลการจัดสรรงบประมาณให้สถานศึกษาที่ขอรับการสนับสนุน</div>
    <ul class="breadcrumb">
        <li><?php echo anchor(site_url(), "<i class='icon-home icon-large'></i> หน้าแรก"); ?></li>
        <li>รายละเอียด</li>
    </ul>
    <div class="panel-body">
        <div class="row">
            <div class="col-md-12">
            <table class="table table-hover table-striped table-bordered display" id="example">
                <thead>
                    <tr>
                        <th style="width:40px;">ที่</th>
                        <th class="no-sort" style="width:110px;">วัน เดือน ปี</th>
                        <th class="no-sort" style="width:25%;">ชื่อโครงการ</th>
                        <th class="no-sort">ประเภทโครงการ</th>
                        <th class="no-sort">งบประมาณ (บาท)</th>
                        <th class="no-sort">สถานที่ดำเนินงาน</th>
                        <th class="no-sort">โรงเรียน</th>
                        <th class="no-sort">ผู้ประสานงาน/โทรศํพท์</th>
                        <th class="no-sort">เอกสาร</th>
                        <th style="width:8%;border-right: none;" class="no-sort"></th>
                    </tr>
                </thead>
                <tbody>
                    <?php $row = 1; ?>
                    <?php foreach ($rs as $r): ?>
                        <tr>
                            <td style="text-align:center;"><?php echo $row; ?></td>
                            <td><?php echo shortdate($r['ext_date']); ?></td>
                            <td><?= $r['ext_name'] ?></td>
                            <td><?= $r['ext_type']; ?></td>
                            <td style="text-align:right;"><?= number_format($r['ext_loan'], 2, '.', ',') ?></td>
                            <td><?= $r['ext_place']; ?></td>
                            <td><?= $r['ext_school']; ?></td>
                            <td><?= $r['ext_coordinator']; ?> / <?= $r['ext_coordinator_mobile'] ?></td>
                            <td>
                                <?php if (file_exists('upload/' . $r['ext_document']) && !empty($r['ext_document'])): ?>
                                <a href="<?= base_url('upload/' . $r['ext_document']); ?>" target="_blank" style="color:blue;">เอกสาร</a>
                                <?php endif; ?>
                            </td>
                            <td style="text-align:center;">
                                <a href="<?= site_url('payment-loan-management-external/'.$r['id']);?>">
                                <button type="button" class="btn btn-info btn-ext-payment"><i class="icon-bar-chart"></i> ข้อมูลการเบิกจ่าย</a></button>
                               </a>
                                    <?php if ($this->session->userdata("status") == "ผู้ปฏิบัติงาน"): ?>
                                <div class="btn-group">
                                    <button type="button" class="btn btn-warning btn-edit" id="<?php echo $r['id']; ?>"><i class="icon-pencil"></i> แก้ไข</button>
                                    <button type="button" class="btn btn-danger btn-delete" id="<?php echo $r['id']; ?>"><i class="icon-trash"></i> ลบ</button>
                                </div>
                                        <?php endif; ?>
                            </td>
<!--                            <td style="text-align:center;border-right:none;">
                                <div class="btn-group pull-right">
                                    <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        ดำเนินการ <span class="caret"></span>
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li><a href="<?= site_url('payment-loan-management-external/'.$r['id']);?>"><i class="icon-bar-chart"></i> ข้อมูลการเบิกจ่าย</a></li>
                                        <?php if ($this->session->userdata("status") == "ผู้ปฏิบัติงาน"): ?>
                                            <li role="separator" class="divider"></li>
                                            <li><a href="#" class="btn-edit" id="<?= $r['id'] ?>"><i class="icon-pencil"></i> แก้ไข</a></li>
                                            <li><a href="#" class="btn-delete" id="<?= $r['id'] ?>"><i class="icon-trash"></i> ลบ</a></li>
                                        <?php endif; ?>
                                    </ul>
                                </div>
                            </td>-->
                        </tr>
                        <?php $row++; ?>
                    <?php endforeach; ?>
                </tbody>
            </table>
                </div>
        </div>
    </div>

    <?php $this->load->view('layout/my_school_footer');?>
</div>
<!---------------------------------------------------------------------------->
<script>
        <?php
$tabName = "example";

$text = "ข้อมูลการจัดสรรงบประมาณให้สถานศึกษาที่ขอรับการสนับสนุน";
$title = $this->Echo_Text_Model->head_logo($text, $this->session->userdata('sch_id'));
$colStr = "0,1,2,3,4,5,6,7";
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
//        $('div#example_length.dataTables_length').append("&nbsp;&nbsp;<a href='<?= site_url('print-loan-management-external');?>' class='btn btn-primary' target='_blank'><i class='icon-print'></i> พิมพ์</a>");
//    var status = '<?= $this->session->userdata('status'); ?>';
//    if (status == 'ผู้ปฏิบัติงาน') {
//        $('div#example_length.dataTables_length').append("&nbsp;&nbsp;<button class='btn btn-primary btn-add'><i class='icon-plus'></i> บันทึก</button>");
//    }
    // btn-add
    $('.btn-add').on('click', function () {
        $('#insert-form').trigger('reset');
        $('h3.modal-title').text('บันทึกข้อมูลโครงการที่โรงเรียนขอรับการสนับสนุน');
        $('.modal-dialog').css('width', '60%');
        $('#ext-loan-modal').modal('show');
    });

    //
//    $('.table-responsive').on('show.bs.dropdown', function () {
//        $('.table-responsive').css("overflow", "inherit");
//    });
//
//    $('.table-responsive').on('hide.bs.dropdown', function () {
//        $('.table-responsive').css("overflow", "auto");
//    });
    // update data
    $('#example').on('click', '.btn-edit', function () {
        var uid = $(this).attr('id');
        $.ajax({
            url: '<?= site_url('update-loan-management-external'); ?>',
            method: 'POST',
            data: {id: uid},
            dataType: 'JSON',
            success: function (data) {
                $('#id').val(data.id);
                $('#inExtDate').val(data.ext_date);
                $('#inExtName').val(data.ext_name);
                $('#inExtType').val(data.ext_type);
                $('#inExtPlace').val(data.ext_place);
                $('#inExtLoan').val(data.ext_loan);
                $('#inExtSchool').val(data.ext_school);
                $('#inExtLeader').val(data.ext_leader);
                $('#inExtLeaderMobile').val(data.ext_leader_mobile);
                $('#inExtCoordinator').val(data.ext_coordinator);
                $('#inExtCoordinatorMobile').val(data.ext_coordinator_mobile);
                $('h3.modal-title').text('ปรับปรุงข้อมูลโครงการที่โรงเรียนขอรับการสนับสนุน');
                $('.modal-dialog').css('width', '60%');
                $('#ext-loan-modal').modal('show');
            }
        });
    });
    // delete data
    $('#example').on('click', '.btn-delete', function () {
        var uid = $(this).attr('id');
        var status = confirm('ต้องการลบข้อมูลนี้จริงหรือไม่ ?');
        if (status) {
            $.ajax({
                url: '<?= site_url('delete-loan-management-external') ?>',
                method: 'POST',
                data: {id: uid},
                success: function () {
                    location.reload();
                }
            });
        }
    });
</script>
<?php $this->load->view('school_loan/modals/ext_loan_modal'); ?>