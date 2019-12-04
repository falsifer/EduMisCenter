<div class="panel panel-primary">
    <div class="panel-heading">รายละเอียดการจัดสรรงบประมาณให้กับสถานศึกษา (<?php echo $school['sc_thai_name'] ?>)</div>
    <ul class="breadcrumb">
        <li><?php echo anchor(site_url(), "<i class='icon-home icon-large'></i> หน้าแรก"); ?></li>
        <li><a href="<?php echo site_url('school-loan'); ?>">ข้อมูลการจัดสรรงบประมาณ</a></li>
        <li>รายละเอียด</li>
    </ul>
    <div class="panel-body">
        <div class="row">
            <div class="col-md-12">
                <table class="table table-hover table-striped table-bordered display" id="example">
                    <thead>
                        <tr>
                            <th style="width:40px;">ที่</th>
                            <th class="no-sort">รายการจัดสรร</th>
                            <th class="no-sort">งบประมาณที่ตั้งไว้</th>
                            <th class="no-sort">โอนแล้ว</th>
                            <th class="no-sort">คงเหลือ</th>
                            <th class="no-sort">โอนลด/เพิ่ม</th>
                            <th style="width:5%;border-right: none;" class="no-sort"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $row = 1; ?>
                        <?php foreach ($define as $d): ?>
                            <tr>
                                <td style="text-align:center;"><?php echo $row; ?></td>
                                <td><?php echo $d['loan_category']; ?>/<?php echo $d['loan_type'] ?>/<?php echo $d['loan_define'] ?></td>
                                <td style="text-align:right;"><?php echo number_format($d['loan_begin'], 2, '.', ',') ?></td>
                                <td style="text-align:right;">
                                    <?php
                                    $total_transfer = $this->My_model->get_sum_where('tb_loan_transfer', 'loan_transfer', array('loan_define_detail_id' => $d['id']));
                                    echo $total_transfer['loan_transfer'] != 0 ? number_format($total_transfer['loan_transfer'], 2, '.', ',') : "";
                                    ?>
                                </td>
                                <td style="text-align:right;">
                                    <?php
                                    echo $d['loan_begin'] - $total_transfer['loan_transfer'] != 0 ? number_format($d['loan_begin'] - $total_transfer['loan_transfer'], 2, '.', ',') : "";
                                    ?>
                                </td>
                                <td></td>
                                <td>
                                    <a href="<?php echo site_url('school-loan-detail-transfer/' . $this->uri->segment(2) . '/' . $d['id']); ?>" class="btn btn-info">รายละเอียด</a>
                                </td>
                            </tr>
                            <?php $row++; ?>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <?php $this->load->view('layout/my_school_footer'); ?>
</div>
<!---------------------------------------------------------------------------->
<script>
    
<?php
$tabName = "example";

$text = "รายละเอียดการจัดสรรงบประมาณให้กับสถานศึกษา (" . $school['sc_thai_name'].")";
$title = $this->Echo_Text_Model->head_logo($text, $this->session->userdata('sch_id'));
$colStr = "0,1,2,3,4,5";
$btExArr = array();
//$bt = array(
//    'name' => 'add_topic',
//    'title' => 'เพิ่มข้อมูล',
//    'icon' => 'icon-plus',
//    'class' => 'btn btn-primary  btn-add',
//    'fn' => ''
//);
//array_push($btExArr, $bt);
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
//    $('div#example_length.dataTables_length').append("&nbsp;&nbsp;<a href='<?php echo site_url('print-loan-detail-transfer/' . $this->uri->segment(2)); ?>' target='_blank' class='btn btn-primary'><i class='icon-print'></i> พิมพ์</a>");
    //
    $('.btn-add').on('click', function () {
        $('#insert-form').trigger('reset');
        $('h3.modal-title').text('บันทึกข้อมูลการจัดสรรงบประมาณ');
        $('.modal-dialog').css('min-width', '55%');
        $('#school-loan-detail-modal').modal('show');
    });
    //
    $('#example').on('click', '.btn-delete', function () {
        var uid = $(this).attr('id');
        var status = confirm('ต้องการลบข้อมูลนี้จริงหรือไม่ ?');
        if (status) {
            $.ajax({
                url: '<?php echo site_url('delete-school-loan-detail'); ?>',
                method: 'post',
                data: {id: uid},
                success: function () {
                    location.reload();
                }
            });
        }
    });
    //
    $('.table-responsive').on('show.bs.dropdown', function () {
        $('.table-responsive').css("overflow", "inherit");
    });

    $('.table-responsive').on('hide.bs.dropdown', function () {
        $('.table-responsive').css("overflow", "auto");
    });
</script>
<!---------------------------------------------------------------------------->
