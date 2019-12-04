<div class="panel panel-primary">
    <div class="panel-heading">กำหนดหมวดเงินโอน</div>
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
                        <th class="no-sort">หมวดใช้สอย</th>
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
                            <td><?php echo $r['loan_category']; ?></td>
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

    <div class="panel-footer" style="padding-top: 0px;">
        <div class="row">
            <div class="col-md-8" style="padding-top:8px;padding-right:8px;font-size:15px;color:#666;">
                <img src="<?php echo base_url() . 'images/box_logo.png' ?>" /> สถาบันเทคโนโลยีพระจอมเกล้าเจ้าคุณทหารลาดกระบัง
            </div>
            <div class="col-md-4" style="padding-top:8px;padding-bottom: 8px;padding-right:30px;">
                <span class="pull-right"><span style="color:#999999;">eSchool Version 4.0 (2018)</span></span>
            </div>
        </div>
    </div>
    <!---------------------------------------------------------------------------->
    <script>
<?php
$tabName = "example";

$text = "รายการกำหนดหมวดเงินโอน";
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
//        $('#example').DataTable({
//            "responsive": true,
//            "stateSave": true,
//            "bSort": false,
//            "ordering": true,
//            columnDefs: [{
//                    orderable: false,
//                    targets: "no-sort"
//                }],
//            "language": {
//                "lengthMenu": "แสดง _MENU_ แถวต่อหน้า",
//                "zeroRecords": "## ไม่มีข้อมูล ##",
//                "info": "แสดงหน้าที่ _PAGE_ ในทั้งหมด _PAGES_ หน้า",
//                "infoEmpty": "",
//                "infoFiltered": "",
//                "sSearch": "ระบุคำค้น",
//                "sPaginationType": "full_numbers"
//            }
//        });
//        $('.sorting_asc').removeClass('sorting_asc');
//        // Tool tips;
//        $(function () {
//            $('[data-toggle="tooltip"]').tooltip();
//        });
        // สร้างปุ่ม
//        var status = '<?php echo $this->session->userdata('status') ?>';
//        if (status == 'ผู้ปฏิบัติงาน') {
//            $('div#example_length.dataTables_length').append("&nbsp;&nbsp;<button type='button' class='btn btn-primary btn-add'><i class='icon-plus'></i> บันทึก</button>");
//        }
        //
        $('.btn-add').on('click', function () {
            $('h3.modal-title').text('บันทึกหมวดค่าใช้จ่าย');
            $('#loan-category-modal').modal('show');
        });

        // แก้ไขข้อมูล
        $('#example').on('click', '.btn-edit', function () {
            var uid = $(this).attr('id');
            $.ajax({
                url: '<?php echo site_url('update-loan-category'); ?>',
                method: 'POST',
                data: {id: uid},
                dataType: 'JSON',
                success: function (data) {
                    $('#id').val(data.id);
                    $('#inLoanCategory').val(data.loan_category);
                    //
                    $('h3.modal-title').text('ปรับปรุงข้อมูลหมวดค่าใช้จ่าย');
                    $('#loan-category-modal').modal('show');
                }
            });
        });

        // ลบข้อมูล
        $('#example').on('click', '.btn-delete', function () {
            var uid = $(this).attr('id');
            var status = confirm('ต้องการลบข้อมูลนี้จริงหรือไม่ ?');
            if (status) {
                $.ajax({
                    url: '<?php echo site_url('delete-loan-category'); ?>',
                    method: 'post',
                    data: {id: uid},
                    success: function () {
                        location.reload();
                    }
                });
            }
        });
    </script>
    <!---------------------------------------------------------------------------->
</div>
<?php $this->load->view('school_loan/modals/loan_category_modal'); ?>