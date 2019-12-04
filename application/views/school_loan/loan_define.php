<div class="panel panel-primary">
    <div class="panel-heading">กำหนดรายการค่าใช้จ่าย</div>
    <ul class="breadcrumb">
        <li><?php echo anchor(site_url(), "<i class='icon-home icon-large'></i> หน้าแรก"); ?></li>
        <li>รายละเอียด</li>
    </ul>
    <div class="panel-body">

        <?php if ($this->session->userdata('status') == 'ผู้ปฏิบัติงาน'): ?>
            <div class="row">
                <div class="col-md-12">
                    <form method="post" id="insert-form" style="padding-top:30px;">
                        <div class="row">
                            <div class="form-group col-md-1">
                                <label class="control-label">หมวด/ประเภท</label>
                            </div>
                            <div class="form-group col-md-3">
                                <select name="inLoanTypeId" id="inLoanTypeId" class="form-control">
                                    <option value="">---ข้อมูล---</option>
                                    <?php foreach ($type as $t): ?>
                                        <option value="<?php echo $t['id'] ?>"><?php echo $t['loan_category'] ?> / <?php echo $t['loan_type'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="form-group col-md-1">
                                <label class="control-label">รายการ</label>
                                </div>
                                <div class="form-group col-md-5">
                                <input type="text" name="inLoanDefine" id="inLoanDefine" class="form-control" />
                            </div>

                            <div class="col-md-2">
                                <center><button type="submit" class="btn btn-success"><i class="icon-save"></i> บันทึก</button></center>
                            </div>
                        </div>
                        <input type="hidden" name="id" id="id" />
                    </form>        
                </div>
            </div>
        <?php endif; ?>


        <div class="table-responsive">
            <table class="table table-hover table-striped table-bordered display" id="example">
                <thead>
                    <tr>
                        <th style="width:40px;">ที่</th>
                        <th class="no-sort">หมวด</th>
                        <th class="no-sort">ประเภท</th>
                        <th class="no-sort">รายการ</th>
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
                            <td><?php echo $r['loan_type'] ?></td>
                            <td><?php echo $r['loan_define'] ?></td>
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

$text = "รายงานรายการค่าใช้จ่าย";
$title = $this->Echo_Text_Model->head_logo($text, $this->session->userdata('sch_id'));
$colStr = "0,1,2,3";
$btExArr = array();


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
    // insert data;
    $('#insert-form').on('submit', function (e) {
        e.preventDefault();
        $.ajax({
            url: '<?php echo site_url('insert-loan-define'); ?>',
            method: 'post',
            data: $('#insert-form').serialize(),
            success: function () {
                alert('บันทึกข้อมูลเรียบร้อย');
                $('#insert-form')[0].reset();
                location.reload();
            }
        });
    });    // edit data
    $('#example').on('click', '.btn-edit', function () {
        var uid = $(this).attr('id');
        $.ajax({
            url: '<?php echo site_url('update-loan-define'); ?>',
            method: 'post',
            data: {id: uid},
            dataType: 'json',
            success: function (data) {
                $('#id').val(data.id);
                $('#inLoanTypeId').val(data.loan_type_id);
                $('#inLoanDefine').val(data.loan_define);
            }
        });
    });
    // delete data;
    $('#example').on('click', '.btn-delete', function () {
        var uid = $(this).attr('id');
        var status = confirm('ต้องการลบข้อมูลนี้จริงหรือไม่ ?');
        if (status) {
            $.ajax({
                url: '<?php echo site_url('delete-loan-define'); ?>',
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