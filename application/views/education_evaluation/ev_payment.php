<div class="panel panel-primary">
    <div class="panel-heading">งานส่งเสริม-สนับสนุนฯ :: ค่าใช้จ่ายในการดำเนินงาน</div>
    <ul class="breadcrumb">
        <li><?php echo anchor(site_url(), "<i class='icon-home icon-large'></i> หน้าแรก"); ?></li>
        <li><?php echo anchor(site_url('education-evaluation'), "งานส่งเสริม-สนับสนุนฯ"); ?></li>
        <li>ค่าใช้จ่ายในการดำเนินงาน</li>
    </ul>
    <div class="panel-body">
        <div class="table-responsive">
            <table class="table table-hover table-striped table-bordered display" id="evPMTab">
                <thead>
                    <tr>
                        <th>ที่</th>
                        <th class="no-sort">วัน/เดือน/ปี</th>
                        <th class="no-sort">รายการ</th>
                        <th class="no-sort">หน่วยนับ</th>
                        <th class="no-sort">จำนวน</th>
                        <th class="no-sort">หน่วยละ (บาท)</th>
                        <th class="no-sort">รวมเป็นเงิน (บาท)</th>
                        <th class="no-sort">หมายเหตุ</th>
                        <th style="width:18%;" class="no-sort">
                            <button class='col-md-12 btn btn-primary btn-insert'><i class='icon-plus icon-large'></i> เพิ่มข้อมูล</button>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <?php $row = 1; ?>
                    <?php foreach ($rs as $r): ?>
                        <tr>
                            <td style="text-align:center;"><?php echo $row; ?></td>
                            <td><?php echo datethai($r['payment_date']); ?></td>
                            <td><?php echo $r['payment_detail']; ?></td>
                            <td><?php echo $r['unit_name']; ?></td>
                            <td style="text-align:right;"><?php echo number_format($r['payment_amount'], 2, '.', ','); ?></td>
                            <td style="text-align:right;"><?php echo number_format($r['payment_cost'], 2, '.', ','); ?></td>
                            <td style="text-align:right;"><?php echo number_format($r['payment_total'], 2, '.', ','); ?></td>
                            <td style="text-align:right;"><?php echo $r['payment_comment']; ?></td>
                            <td style="text-align:center;">
                                <button type="button" class="col-md-6 col-md-6 btn btn-warning btn-edit" id="<?php echo $r['id']; ?>"><i class="icon-pencil icon-large"></i> แก้ไข</button>
                                <button type="button" class="col-md-6 col-md-6 btn btn-danger btn-delete" id="<?php echo $r['id']; ?>"><i class="icon-trash icon-large"></i> ลบ</button>
                            </td>

                        </tr>
                        <?php $row++; ?>
                    <?php endforeach; ?>
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="6" style="font-weight:bold;text-align:center;">รวมทั้งสิ้น</td>
                        <td class="no-sort"><?php echo number_format($sum_cost['payment_total'], 2, '.', ','); ?></td>
                        <td class="no-sort"></td>
                        <td class="no-sort"></td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>

    <?php $this->load->view('layout/my_school_footer'); ?>
</div>
<!---------------------------------------------------------------------------->
<script>
    <?php
        $tabName = "evPMTab";
        $text = "งานส่งเสริม-สนับสนุนฯ :: ค่าใช้จ่ายในการดำเนินงาน";
        $title = $this->Echo_Text_Model->head_logo($text,$this->session->userdata('sch_id'));
        $colStr = "0,1,2,3,4,5,6,7";
        $btExArr = array();
        load_datatable($tabName, $btExArr, $title, $colStr);
    
    ?>
//    $('#evPMTab').DataTable({
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

//        $('div#evPMTab_length.dataTables_length').append("&nbsp;&nbsp;<a href='#' class='btn btn-default btn-insert'><i class='icon-plus icon-large'></i> บันทึก</a>");
   
    //
    $('.btn-insert').click(function () {
        $('#insert-form').trigger('reset');
        $('h3.modal-title').text('บันทึกข้อมูลค่าใช้จ่ายการส่งเสริม-สนับสนุนฯ');
        $('#ev-payment-modal').modal('show');
    });
    // edit data;
    $('#evPMTab').on('click', '.btn-edit', function () {
        var uid = $(this).attr('id');
        $.ajax({
            url: '<?php echo site_url('update-education-evaluation-payment'); ?>',
            method: 'post',
            data: {id: uid},
            dataType: 'json',
            success: function (data) {
                $('#id').val(data.id);
                $('#inPaymentDate').val(data.payment_date);
                $('#inPaymentDetail').val(data.payment_detail);
                $('#inUnitId').val(data.unit_id);
                $('#inPaymentAmount').val(data.payment_amount);
                $('#inPaymentCost').val(data.payment_cost);
                $('#inPaymentComment').val(data.payment_comment);
                //
                $('h3.modal-title').text('แก้ไขข้อมูลค่าใช้จ่ายในงานส่งเสริม-สนับสนุนฯ');
                $('#ev-payment-modal').modal('show');
            }
        });
    });
    // edit data;
    $('#evPMTab').on('click', '.btn-delete', function () {
        var uid = $(this).attr('id');
        var status = confirm('ต้องการลบข้อมูลนี้จริงหรือไม่ ?');
        if (status) {
            $.ajax({
                url: '<?php echo site_url(''); ?>',
                method: 'post',
                data: {id: uid},
                success: function (data) {

                }
            });
        }
    });
</script>
<?php $this->load->view('education_evaluation/modals/ev_payment_modal'); ?>