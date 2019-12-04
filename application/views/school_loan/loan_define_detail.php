<div class="panel panel-primary">
    <div class="panel-heading">ข้อมูลการกำหนดงบประมาณตั้งไว้สำหรับ<?php echo $school['sc_thai_name']; ?></div>
    <ul class="breadcrumb">
        <li><?php echo anchor(site_url(), "<i class='icon-home icon-large'></i> หน้าแรก"); ?></li>
        <li><a href="<?php echo site_url('school-loan'); ?>">รายชื่อโรงเรียนที่จัดสรร งปม.</a></li>
        <li>รายละเอียด</li>
    </ul>
    <div class="panel-body">
        <div class="row">
            <?php if ($this->session->userdata('status') == 'ผู้ปฏิบัติงาน'): ?>
                <div class="col-md-12">
                    <div class="databox">
                        <div class="row">
                        <form method="post" id="insert-form">
                            <div class="col-md-12">
                                <div class="form-group col-md-2">
                                    <label class="control-label">ปีงบประมาณ</label>
                                    <input type="text" name="inLoanYear" id="inLoanYear" class="form-control" value="<?php echo get_budget_year(date('Y-m-d')) ?>" required autofocus/>
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="control-label">รายการ</label>
                                    <select name="inLoanDefineId" id="inLoanDefineId" class="form-control" required>
                                        <option value="">---เลือกข้อมูล---</option>
                                        <?php foreach ($define as $d): ?>
                                            <option value="<?php echo $d['id'] ?>"><?php echo $d['loan_category'] ?>/<?php echo $d['loan_type'] ?>/<?php echo $d['loan_define'] ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="form-group col-md-2">
                                    <label class="control-label">งบประมาณตั้งไว้ (บาท)</label>
                                    <input type="number" name="inLoanBegin" id="inLoanBegin" class="form-control" required/>
                                </div>
                            </div>
                            <div class="col-md-12">
                  
                                    <center><button type="submit" class="btn btn-success"><i class="icon-save"></i> บันทึก</button></center>
                        
                            </div>
                            <input type="hidden" name="school_id" id="school_id" value="<?php echo $this->uri->segment(2) ?>" />
                            <input type="hidden" name="id" id="id" />
                        </form>
                        </div>
                    </div>
                </div>
            <?php endif; ?>        

            <div class="col-md-12" style="margin-top:20px;">
                <table class="table table-hover table-striped table-bordered display" id="example">
                    <thead>
                        <tr>
                            <th style="width:40px;">ที่</th>
                            <th class="no-sort">ปีงบประมาณ</th>
                            <th class="no-sort">หมวด</th>
                            <th class="no-sort">ประเภท</th>
                            <th class="no-sort">รายการ</th>
                            <th class="no-sort">งบประมาณตั้งไว้ (บาท)</th>
                            <?php if ($this->session->userdata("status") == "ผู้ปฏิบัติงาน"): ?>
                                <th style="width:13%;border-right: none;" class="no-sort"></th>
                            <?php endif; ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $row = 1; ?>
                        <?php foreach ($rs as $r): ?>
                            <tr>
                                <td style="text-align:center;"><?php echo $row; ?></td>
                                <td><?php echo $r['loan_year'] ?></td>
                                <td><?php echo $r['loan_category']; ?></td>
                                <td><?php echo $r['loan_type']; ?></td>
                                <td><?php echo $r['loan_define']; ?></td>
                                <td style="text-align:right;"><?php echo number_format($r['loan_begin'], 2, '.', ','); ?></td>
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
    </div>

    <?php $this->load->view('layout/my_school_footer'); ?>
</div>
<!---------------------------------------------------------------------------->
<script>

<?php
$tabName = "example";

$text = "ข้อมูลการกำหนดงบประมาณตั้งไว้สำหรับ" . $school['sc_thai_name'];
$title = $this->Echo_Text_Model->head_logo($text, $this->session->userdata('sch_id'));
$colStr = "0,1,2,3,4,5";
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
    // Tool tips;
    // สร้างปุ่ม
//    $('div#example_length.dataTables_length').append("&nbsp;&nbsp; | <a href='<?php echo site_url('print-loan-define-detail/' . $this->uri->segment(2)); ?>' class='btn btn-primary' target='_blank'><i class='icon-print'></i> พิมพ์</a>");
    // insert data
    $('#insert-form').on('submit', function (e) {
        e.preventDefault();
        $.ajax({
            url: '<?php echo site_url('insert-loan-define-detail'); ?>',
            method: 'post',
            data: $('#insert-form').serialize(),
            success: function () {
                alert('บันทึกข้อมูลเรียบร้อย');
                $('#insert-form')[0].reset();
                location.reload();
            }
        });
    });
    // edit data
    $('#example').on('click', '.btn-edit', function () {
        var uid = $(this).attr('id');
        $.ajax({
            url: '<?php echo site_url('update-loan-define-detail'); ?>',
            method: 'post',
            data: {id: uid},
            dataType: 'json',
            success: function (data) {
                $('#id').val(data.id);
                $('#inLoanYear').val(data.loan_year);
                $('#inLoanDefineId').val(data.loan_define_id);
                $('#inLoanBegin').val(data.loan_begin);
            }
        });
    });
    // delete data
    $('#example').on('click', '.btn-delete', function () {
        var uid = $(this).attr('id');
        var status = confirm('ต้องการลบข้อมูลนี้จริงหรือไม่ ?');
        if (status) {
            $.ajax({
                url: '<?php echo site_url('delete-loan-define-detail'); ?>',
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
