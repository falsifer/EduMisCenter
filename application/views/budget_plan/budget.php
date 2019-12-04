<div class="box">
    <div class="box-heading">งบประมาณ</div>
    <ul class="breadcrumb">
        <li><?php echo anchor(site_url(), "<i class='icon-home icon-large'></i> หน้าแรก"); ?></li>
        <li>งบประมาณ</li>
    </ul>
    <div class="box-body">
        <div class="row">
            <div class="col-md-12" style="padding: 10px;">

                <form method="post" id="insert-income-form">
                    <div class="row" style="padding: 5px;">
                        <div class="col-md-6">
                            <label for="inAccIncomeCode">รหัสทะเบียนรายรับ</label>
                            <input type="text" class="form-control" name="inAccIncomeCode" id="inAccIncomeCode"/>
                        </div>
                        <div class="col-md-6">
                            <label for="inAccCode">รหัสบัญชี</label>
                            <input type="text" class="form-control" name="inAccCode" id="inAccCode"/>
                        </div>
                    </div>
                    <div class="row" style="padding: 5px;">
                        <div class="col-md-12">
                            <label for="inAccIncomeDetail">ชื่อทะเบียนรายรับ</label>
                            <input type="text" class="form-control" name="inAccIncomeDetail" id="inAccIncomeDetail"/>
                        </div>

                    </div>

                    <div class="row" style="padding: 10px;">
                        <center>
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-success"><i class="icon-save icon-large"></i> บันทึก</button>
                                <button type="button" class="btn btn-warning"><i class="icon-delete icon-large"></i> ล้างข้อมูล</button>
                            </div>
                        </center>
                    </div>
                </form>
                <div class="box-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-striped table-bordered display" id="example">
                            <thead>
                                <tr>
                                    <th class="no-sort">รหัสทะเบียนรายรับ</th>
                                    <th class="no-sort">ชื่อทะเบียนรายรับ</th>
                                    <th class="no-sort">รหัสบัญชี</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($income as $r) : ?>
                                    <tr>
                                        <td><?php echo $r['tb_acc_income_code']; ?></td>
                                        <td><?php echo $r['tb_acc_income_detail']; ?></td>
                                        <td><?php echo $r['tb_acc_code']; ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>


            </div>
        </div>


    </div>
</div>

<script>
    $(".datepicker").datepicker({autoclose: true, language: 'th'});

    $('#schIncomeTab').DataTable({
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

<?php
        $tabName = "example";
        $text = "แผนการใช้จ่ายเงิน";
        $title = $this->Echo_Text_Model->head_logo($text,$this->session->userdata('sch_id'));
        $colStr = "0,1,2";
        $btExArr = array();
        load_datatable($tabName, $btExArr, $title, $colStr);
    
    ?>
    $('#example2').DataTable({
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

    $('#insert-income-form').on('submit', function (e) {
        //alert($('#inAccIncomeDetail').val());
        $.ajax({
            url: "<?php echo site_url('school/Account/insert_income'); ?>",
            method: "post",
            data: new FormData(this),
            cache: false,
            contentType: false,
            processData: false,
            success: function (data) {
                $("#insert-form")[0].reset();
                location.reload();
            }
        });
    });

    $('.btn-finace-submit').on('click', function (e) {

        $.ajax({
            url: "<?php echo site_url('school/Account/insert_income_school'); ?>",
            method: "post",
            data: $("#insert-fianance-form").serialize(),
            success: function (data) {
                location.reload();
            }
        });
    });


</script>
