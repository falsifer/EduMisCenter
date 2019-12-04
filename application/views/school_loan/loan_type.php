<div class="panel panel-primary">
    <div class="panel-heading">ประเภทงบประมาณ</div>
    <ul class="breadcrumb">
        <li><?php echo anchor(site_url(), "<i class='icon-home icon-large'></i> หน้าแรก"); ?></li>
        <li>รายละเอียด</li>
    </ul>
    <div class="panel-body">
        <div class="table-responsive">
            <table class="table table-hover table-striped table-bordered display" id="example">
                <thead>
                    <tr>
                        <th style="width:40px;">ที่</th>
                        <th class="no-sort">หมวดเงินโอน</th>
                        <th class="no-sort">ประเภทเงินโอน</th>
                        <?php if ($this->session->userdata("status") == "ผู้ปฏิบัติงาน"): ?>
                            <th style="width:18%;border-right: none;" class="no-sort"></th>
                        <?php endif; ?>
                    </tr>
                </thead>
                <tbody>
                    <?php $row = 1; ?>
                    <?php foreach ($rs as $r): ?>
                        <tr>
                            <td style="text-align:center;"><?php echo $row; ?></td>
                            <td><?php echo $r['loan_category'] ?></td>
                            <td><?php echo $r['loan_type']; ?></td>
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

    <?php $this->load->view('layout/my_school_footer');?>
</div>
<!---------------------------------------------------------------------------->
<script>
    <?php
$tabName = "example";

$text = "รายการประเภทงบประมาณ";
$title = $this->Echo_Text_Model->head_logo($text, $this->session->userdata('sch_id'));
$colStr = "0,1";
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
//    // สร้างปุ่ม
//    var status = '<?php echo $this->session->userdata('status') ?>';
//    if (status == 'ผู้ปฏิบัติงาน') {
//        $('div#example_length.dataTables_length').append("&nbsp;&nbsp;<button class='btn btn-primary btn-add'><i class='icon-plus'></i> บันทึก</button>");
//    }
    // show modal
    $('.btn-add').on('click', function () {
        $('#insert-form').trigger('reset');
        $('h3.modal-title').text('บันทึกข้อมูลประเภทงบประมาณ');
        $('.modal-dialog').css('min-width','50%');
        $('#loan-type-modal').modal('show');
    });
    // loan type edit;
    $('#example').on('click', '.btn-edit', function () {
        var uid = $(this).attr('id');
        $.ajax({
            url: '<?php echo site_url('update-loan-type'); ?>',
            method: 'POST',
            data: {id: uid},
            dataType: 'JSON',
            success: function (data) {
                $('#id').val(data.id);
                $('#inLoanCategoryId').val(data.loan_category_id);
                $('#inLoanType').val(data.loan_type);
                $('h3.modal-title').text('ปรับปรุงข้อมูลประเภทงบประมาณ');
                $('#loan-type-modal').modal('show');
            }
        });
    });
    // delete data
    $('#example').on('click', '.btn-delete', function () {
        var uid = $(this).attr('id');
        var status = confirm('ต้องการลบข้อมูลนี้จริงหรือไม่ ?');
        if(status){
            $.ajax({
                url:'<?php echo site_url('delete-loan-type'); ?>',
                method:'POST',
                data:{id:uid},
                success:function(){
                    location.reload();
                }
            });
        }
    });
</script>
<!---------------------------------------------------------------------------->
<?php $this->load->view('school_loan/modals/loan_type_modal'); ?>